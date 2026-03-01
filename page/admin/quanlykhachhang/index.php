<?php
if (!isset($_GET['quanlykhachhang'])) {
    $quanlykhachhang = 1;
} else {
    $quanlykhachhang = intval($_GET['quanlykhachhang']);
}

// Đảm bảo rằng trang hiện tại không nhỏ hơn 1
if ($quanlykhachhang < 1) {
    $quanlykhachhang = 1;
}

include 'config.php';

// Lấy từ khóa tìm kiếm nếu có
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Số lượng đơn hàng hiển thị trên mỗi trang
$results_per_page = 10;
$page_first_result = ($quanlykhachhang - 1) * $results_per_page;

// Đảm bảo rằng page_first_result không âm
if ($page_first_result < 0) {
    $page_first_result = 0;
}

// Truy vấn để lấy tổng số khách hàng
$total_sql = "
    SELECT COUNT(*) AS total, maKH, ten, email, SDT, diaChi
    FROM khachhang kh
    JOIN nguoidung nd ON kh.maNguoiDung = nd.maNguoiDung";

// Nếu có từ khóa tìm kiếm, thêm điều kiện vào truy vấn
if (!empty($searchTerm)) {
    $total_sql .= " AND (nd.maNguoiDung LIKE '%$searchTerm%' OR kh.maKH LIKE '%$searchTerm%' OR nd.ten LIKE '%$searchTerm%' OR nd.email LIKE '%$searchTerm%' OR nd.diaChi LIKE '%$searchTerm%')";
}

$total_result = $conn->query($total_sql);
$total_orders = $total_result->fetch_assoc()['total']; // Tổng số đơn hàng
$number_of_page = ceil($total_orders / $results_per_page); // Tính số trang

// Truy vấn để lấy danh sách khách hàng với phân trang
$sql = "
     SELECT *
    FROM khachhang kh
    JOIN nguoidung nd ON kh.maNguoiDung = nd.maNguoiDung";

// Nếu có từ khóa tìm kiếm, thêm điều kiện vào truy vấn
if (!empty($searchTerm)) {
    $sql .= " AND (nd.maNguoiDung LIKE '%$searchTerm%' OR kh.maKH LIKE '%$searchTerm%' OR nd.ten LIKE '%$searchTerm%' OR nd.email LIKE '%$searchTerm%' OR nd.diaChi LIKE '%$searchTerm%')";
}

$sql .= " LIMIT $page_first_result, $results_per_page"; // Thêm điều kiện LIMIT
$result = $conn->query($sql);
?>

<style>
    .card.strpied-tabled-with-hover {
        border-radius: 15px;
        overflow: hidden;
        margin: 0 auto;
        display: block;
        width: 100%;
        max-width: 1200px;
    }

    .card.strpied-tabled-with-hover .table thead th,
    .card.strpied-tabled-with-hover .table tbody td {
        /* border: none; */
    }

    .card.strpied-tabled-with-hover .table thead {
        background-color: #f8f9fa;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        margin: 0 5px;
        padding: 5px 10px;
        background-color: #f1f1f1;
        color: #333;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #9370DB;
        /* Màu tím */
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #D8BFD8;
        /* Màu tím nhạt hơn */
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class=" strpied-tabled-with-hover bg-white">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-center">DANH SÁCH KHÁCH HÀNG</h3>
                        <form method="post" class="form-inline mt-4" style="position: relative; left:800px">
                            <input type=" text" name="searchTerm" class="form-control"
                                placeholder="Tìm kiếm theo tên khách, sdt..."
                                value="<?= htmlspecialchars($searchTerm) ?>" style="width: 300px; margin-right: 10px;">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><b>Mã Khách Hàng</b></th>
                                    <th><b>Tên Khách Hàng</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Số Điện Thoại</b></th>
                                    <th><b>Địa Chỉ</b></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td><a href='indexAdmin.php?chitietkhachhang&maKH=" . $row['maKH'] . "'>" . $row['maKH'] . "</a></td>";
                                        echo "<td>" . $row['ten'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['sdt'] . "</td>";
                                        echo "<td>" . $row['diaChi'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<script>alert('Không có khách hàng nào trên hệ thống!'); window.location.href = 'indexAdmin.php?quanlykhachhang'</script>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $number_of_page; $i++): ?>
                            <?php if ($i == $quanlykhachhang): ?>
                                <a class="active"
                                    href="indexAdmin.php?quanlykhachhang=<?= $i ?>&searchTerm=<?= htmlspecialchars($searchTerm) ?>"><?= $i ?></a>
                            <?php else: ?>
                                <a
                                    href="indexAdmin.php?quanlykhachhang=<?= $i ?>&searchTerm=<?= htmlspecialchars($searchTerm) ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>