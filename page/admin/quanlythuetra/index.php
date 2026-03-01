<?php
if (!isset($_GET['quanlythuetra'])) {
    $quanlythuetra = 1;
} else {
    $quanlythuetra = intval($_GET['quanlythuetra']);
}

if ($quanlythuetra < 1) {
    $quanlythuetra = 1;
}

include 'config.php';

$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

$results_per_page = 5;
$page_first_result = ($quanlythuetra - 1) * $results_per_page;
if ($page_first_result < 0) $page_first_result = 0;

// Đếm tổng số đơn đang thuê và đã thanh toán
$total_sql = "
    SELECT COUNT(DISTINCT ds.maDon) AS total
    FROM donthuesan ds
    JOIN khachhang kh ON ds.maKH = kh.maKH
    JOIN nguoidung nd ON kh.maNguoiDung = nd.maNguoiDung
    WHERE ds.tinhTrangThue = 'Đang thuê' AND ds.tinhTrangThanhToan = 'Da thanh toan'";

if (!empty($searchTerm)) {
    $total_sql .= " AND (ds.maDon LIKE '%$searchTerm%' OR ds.maKH LIKE '%$searchTerm%' OR nd.ten LIKE '%$searchTerm%')";
}

$total_result = $conn->query($total_sql);
$total_orders = $total_result->fetch_assoc()['total'];
$number_of_page = ceil($total_orders / $results_per_page);

// Lấy dữ liệu theo phân trang
$sql = "
    SELECT ds.maDon, ds.maKH, nd.ten, ds.ngayThue, ds.thoiGianThue, ds.tinhTrangThue
    FROM donthuesan ds
    JOIN khachhang kh ON ds.maKH = kh.maKH
    JOIN nguoidung nd ON kh.maNguoiDung = nd.maNguoiDung
    WHERE ds.tinhTrangThue = 'Đang thuê' AND ds.tinhTrangThanhToan = 'Da thanh toan'";

if (!empty($searchTerm)) {
    $sql .= " AND (ds.maDon LIKE '%$searchTerm%' OR ds.maKH LIKE '%$searchTerm%' OR nd.ten LIKE '%$searchTerm%')";
}

$sql .= " ORDER BY ds.ngayThue DESC, ds.thoiGianThue ASC
          LIMIT $page_first_result, $results_per_page";

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
        border: none;
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
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #D8BFD8;
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="strpied-tabled-with-hover bg-white">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-center">DANH SÁCH ĐƠN THUÊ SÂN</h4>
                        <form method="post" class="form-inline mt-4 mb-4">
                            <input type="text" name="searchTerm" class="form-control"
                                placeholder="Tìm mã đơn, mã KH, tên KH"
                                value="<?= htmlspecialchars($searchTerm) ?>" style="width: 300px; margin-right: 10px;">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><b>Mã Đơn</b></th>
                                    <th><b>Mã Khách</b></th>
                                    <th><b>Tên Khách Hàng</b></th>
                                    <th><b>Ngày Thuê</b></th>
                                    <th><b>Khung Giờ</b></th>
                                    <th><b>Tình Trạng</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td><a href='indexAdmin.php?chitietdonthue&maDon=" . $row['maDon'] . "'>" . $row['maDon'] . "</a></td>";
                                        echo "<td>" . $row['maKH'] . "</td>";
                                        echo "<td>" . $row['ten'] . "</td>";
                                        echo "<td>" . $row['ngayThue'] . "</td>";
                                        echo "<td>" . $row['thoiGianThue'] . "</td>";
                                        echo "<td class='text-success'>" . $row['tinhTrangThue'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td class='text-center' colspan='6'>Không có đơn thuê nào đang hoạt động</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $number_of_page; $i++): ?>
                            <?php if ($i == $quanlythuetra): ?>
                                <a class="active"
                                   href="indexAdmin.php?quanlythuetra=<?= $i ?>"><?= $i ?></a>
                            <?php else: ?>
                                <a href="indexAdmin.php?quanlythuetra=<?= $i ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>