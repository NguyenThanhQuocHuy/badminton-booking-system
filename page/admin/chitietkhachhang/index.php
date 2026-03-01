<?php
if (!isset($_GET['chitietkhachhang'])) {
    $chitietkhachhang = 1;
} else {
    $chitietkhachhang = intval($_GET['chitietkhachhang']);
}
$obj = new database();
$results_per_page = 5; // Số đơn hàng hiển thị trên mỗi trang
$maKH = $_GET['maKH'];
// Lấy giá trị bộ lọc nếu có
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Truy vấn để lấy tổng số đơn hàng
$total_sql = "
    SELECT COUNT(*) as total 
    FROM donthuesan dt 
    WHERE maKH like '$maKH';
";

$total_result = $obj->xuatdulieu($total_sql);
$total_orders = $total_result[0]['total']; // Tổng số đơn hàng
$number_of_page = ceil($total_orders / $results_per_page); // Tính số trang
$page_first_result = max(0, ($chitietkhachhang - 1) * $results_per_page);

// Truy vấn lấy danh sách đơn hàng
$sql = "
    SELECT 
    *
FROM 
    donthuesan dt
WHERE maKH like '$maKH'
";

// Áp dụng bộ lọc cho truy vấn lấy danh sách đơn hàng
if ($filter === 'pending') {
    $sql .= " AND dt.tinhTrangThanhToan = 'Cho xac nhan'";
} elseif ($filter === 'nopay') {
    $sql .= " AND dt.tinhTrangThanhToan = 'Chua thanh toan'";
} elseif ($filter === 'pay') {
    $sql .= " AND dt.tinhTrangThanhToan = 'Da thanh toan'";
} elseif ($filter === 'all') {
    // Tất cả đơn hàng (không cần WHERE)
}

if ($filter !== 'pending' || $filter !== 'nopay' || $filter !== 'pay') {
    // Chỉ áp dụng LIMIT nếu không có bộ lọc "pending"
    $sql .= " ORDER BY dt.maDon DESC LIMIT $page_first_result, $results_per_page;";
} else {
    // Nếu bộ lọc là "pending", không cần LIMIT
    $sql .= " ORDER BY dt.maDon DESC;";
}

$donhang = $obj->xuatdulieu($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $maDon = $_POST['maDon'];
    $tinhTrangThanhToan = $_POST['tinhTrangThanhToan'];

    // Lấy tình trạng hiện tại của đơn hàng
    $currentStatusSql = "SELECT tinhTrangThanhToan FROM donthuesan WHERE maDon = '$maDon'";
    $currentStatusResult = $obj->xuatdulieu($currentStatusSql);
    $currentStatus = $currentStatusResult[0]['tinhTrangThanhToan'] ?? '';

    // Kiểm tra điều kiện cập nhật
    if ($currentStatus === 'Cho xac nhan' && $tinhTrangThanhToan === 'Da thanh toan') {
        // Cập nhật từ 'Cho xác nhận' sang 'Đã thanh toán'
        $updateSql = "UPDATE donthuesan SET tinhTrangThanhToan = '$tinhTrangThanhToan' WHERE maDon = '$maDon'";
        $result = $obj->suadulieu($updateSql);
        echo "<script>alert('Cập nhật trạng thái thanh toán thành công.');</script>";
    } else if ($currentStatus === 'Cho xac nhan' && $tinhTrangThanhToan === 'Cho lien he') {
        // Cập nhật từ 'Cho xác nhận' sang 'Chờ liên hệ'
        $updateSql = "UPDATE donthuesan SET tinhTrangThanhToan = '$tinhTrangThanhToan' WHERE maDon = '$maDon'";
        $result = $obj->suadulieu($updateSql);
        echo "<script>alert('Cập nhật trạng thái thành công.');</script>";
    } else if ($currentStatus === 'Chua thanh toan' && $tinhTrangThanhToan === 'Da thanh toan') {
        // Cập nhật từ 'Chua thanh toan' sang 'Đã thanh toán'
        $updateSql = "UPDATE donthuesan SET tinhTrangThanhToan = '$tinhTrangThanhToan' WHERE maDon = '$maDon'";
        $result = $obj->suadulieu($updateSql);
        echo "<script>alert('Cập nhật trạng thái thanh toán thành công.');</script>";
    } else if ($currentStatus === 'Cho lien he' && $tinhTrangThanhToan === 'Da thanh toan') {
        // Cập nhật từ 'Chờ liên hệ' sang 'Đã thanh toán'
        $updateSql = "UPDATE donthuesan SET tinhTrangThanhToan = '$tinhTrangThanhToan' WHERE maDon = '$maDon'";
        $result = $obj->suadulieu($updateSql);
        echo "<script>alert('Cập nhật trạng thái thanh toán thành công.');</script>";
    } else {
        // Nếu không cho phép cập nhật, thông báo lỗi
        echo "<script>alert('Cập nhật trạng thái thanh toán thất bại!');</script>";
    }

    echo "<script>setTimeout(function() {
        window.location.href = 'indexAdmin.php?chitietkhachhang=$chitietkhachhang&filter=$filter&maKH=$maKH';
    });</script>"; // 2000ms = 2 giây
    exit();
}
?>

<style>
    .status-paid {
        color: green;
        /* Màu xanh lá cho "Đã thanh toán" */
        font-weight: bold;
    }

    .status-pending {
        color: red;
        /* Màu đỏ cho "Chờ xác nhận" */
        font-weight: bold;
    }

    .status-unpaid {
        color: orange;
        /* Màu vàng cho "Chưa thanh toán" */
        font-weight: bold;
    }

    /* Các kiểu khác cho modal và bảng nếu cần */
    .modal.show {
        display: block !important;
    }

    .modal-dialog {
        position: fixed !important;
        top: 10% !important;
        left: 50% !important;
        transform: translate(-50%, -10%) !important;
        margin: 0 !important;
        z-index: 1055 !important;
        max-width: 500px;
        width: 90%;
    }

    .modal-body {
        overflow-y: auto;
        max-height: 70vh;
        padding: 2rem;
    }

    .clickable {
        cursor: pointer;
        color: blue;
        text-decoration: underline;
    }

    .pagination {
        display: flex;
        justify-content: center;
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
    /* Modal image */
    .modal-image {
        display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 60px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content-image {
        margin: auto;
        display: block;
        max-width: 80%;
        max-height: 80%;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    .close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="strpied-tabled-with-hover bg-white">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-center">DANH SÁCH ĐƠN</h3>
                        <h4 class="card-title text-center">(MÃ KHÁCH HÀNG: <?= $maKH ?>)</h4>
                        <form method="get" action="indexAdmin.php">
                            <input type="hidden" name="maKH" value="<?= $maKH ?>">
                            <input type="hidden" name="chitietkhachhang" value="<?= $chitietkhachhang ?>">

                            <select name="filter" class="form-control" onchange="this.form.submit()"
                                style="height: 45px;width: 200px; margin-right: 10px;">
                                <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>Tất cả</option>
                                <option value="pending" <?= $filter === 'pending' ? 'selected' : '' ?>>Chờ xác nhận
                                <option value="nopay" <?= $filter === 'nopay' ? 'selected' : '' ?>>Chưa thanh toán
                                <option value="pay" <?= $filter === 'pay' ? 'selected' : '' ?>>Đã thanh toán
                                </option>
                            </select>

                        </form>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form method="post">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><b>Mã Đơn</b></th>
                                        <th style="width: 200px;"><b>Ngày Thuê</b></th>
                                        <th><b>Tổng Gốc</b></th>
                                        <th><b>Tổng Thành tiền</b></th>
                                        <th><b>Mã xác nhận</b></th>
                                        <th><b>Hinh ảnh</b></th>
                                        <th><b>Tình Trạng Thanh Toán</b></th>
                                        <th><b>Thao Tác</b></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($donhang) && is_array($donhang)): ?>
                                        <?php foreach ($donhang as $order): ?>
                                            <tr>
                                                <td class="clickable"
                                                    onclick="openModal(<?= $order['maDon'] ?>, '<?= $order['tinhTrangThanhToan'] ?>')">
                                                    <?= $order['maDon'] ?>
                                                </td>
                                                <td><?= $order['ngayThue'] ?></td>
                                                <td><?= number_format($order['tongTienGoc'], 0, ',', '.') ?> VND</td>
                                                <td><?= number_format($order['tongThanhTien'], 0, ',', '.') ?> VND</td>
                                                <td><?= $order['code'] ?></td>
                                                <td>
                                                    <?php if (!empty($order['hinhAnhThanhToan'])): ?>
                                                        <img src="layout/images/uploads/<?= $order['hinhAnhThanhToan'] ?>"
                                                            alt="Hình thanh toán"
                                                            style="width: 100px; height: auto; cursor: pointer;"
                                                            onclick="openImageModal('layout/images/uploads/<?= $order['hinhAnhThanhToan'] ?>')">
                                                    <?php else: ?>
                                                        <span>Không có</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span
                                                        class="<?=
                                                            $order['tinhTrangThanhToan'] == 'Da thanh toan' ? 'status-paid' :
                                                            ($order['tinhTrangThanhToan'] == 'Cho xac nhan' ? 'status-pending' :
                                                                ($order['tinhTrangThanhToan'] == 'Cho lien he' ? 'status-unpaid' :
                                                                    ($order['tinhTrangThanhToan'] == 'Chua thanh toan' ? 'status-unpaid' : ''))) ?>">
                                                        <?= $order['tinhTrangThanhToan'] ?>
                                                    </span>
                                                </td>
                                                <td><a href='indexAdmin.php?chitietdonthue&maDon=<?= $order['maDon'] ?>'>Xem chi
                                                        tiết</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Không có đơn hàng nào</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="pagination" style="text-align: center; margin-top: 20px;">
                        <?php for ($i = 1; $i <= $number_of_page; $i++): ?>
                            <?php if ($i == $chitietkhachhang): ?>
                                <a class="active"
                                    href="indexAdmin.php?chitietkhachhang=<?= $i ?>&filter=<?= $filter ?>&maKH=<?= $maKH ?>"><?= $i ?></a>
                            <?php else: ?>
                                <a
                                    href="indexAdmin.php?chitietkhachhang=<?= $i ?>&filter=<?= $filter ?>&maKH=<?= $maKH ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal and other scripts -->
                    <div id="imageModal" class="modal-image">
                        <span class="close" onclick="closeImageModal()">&times;</span>
                        <img class="modal-content-image" id="modalImage">
                    </div>

                    <script>
                        function openImageModal(src) {
                            var modal = document.getElementById('imageModal');
                            var modalImg = document.getElementById('modalImage');

                            modal.style.display = 'block';
                            modalImg.src = src;
                        }

                        function closeImageModal() {
                            var modal = document.getElementById('imageModal');
                            modal.style.display = 'none';
                        }

                        function openModal(maDon, currentStatus) {
                            document.getElementById('modalMaDon').value = maDon;
                            document.getElementById('tinhTrangThanhToan').value = currentStatus;
                            $('#orderModal').modal('show');
                        }
                    </script>

<!-- Modal for updating payment status -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="orderModalLabel">CẬP NHẬT TÌNH TRẠNG THANH TOÁN</h4>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="post">
                    <input type="hidden" name="maDon" id="modalMaDon">
                    <div class="form-group">
                        <label for="tinhTrangThanhToan">Tình Trạng Thanh Toán</label>
                        <select name="tinhTrangThanhToan" id="tinhTrangThanhToan" class="form-control">
                            <option value="Cho xac nhan">Chờ xác nhận</option>
                            <option value="Cho lien he">Chờ liên hệ</option>
                            <option value="Da thanh toan">Đã thanh toán</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="update" class="btn btn-success" style="float: right;">Xác nhận</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(maDon, currentStatus) {
        document.getElementById('modalMaDon').value = maDon;
        document.getElementById('tinhTrangThanhToan').value = currentStatus;
        $('#orderModal').modal('show');
    }
</script>