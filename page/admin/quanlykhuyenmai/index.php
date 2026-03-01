<?php
if (!isset($_GET['quanlykhuyenmai'])) {
    $quanlykhuyenmai = 1;
} else {
    $quanlykhuyenmai = $_GET['quanlykhuyenmai'];
}
?>
<?php
require_once 'myclass/promotion.php';

// Tạo đối tượng Promotion
$promotion = new Promotion();

// Xử lý thêm khuyến mãi
if (isset($_POST['addPromotion'])) {
    $tenKM = $_POST['tenKM'];
    $noiDungChuongTrinh = $_POST['noiDungChuongTrinh'];
    $phanTramKM = $_POST['phanTramKM'];
    $promotion->addPromotion($tenKM, $noiDungChuongTrinh, $phanTramKM);
}

// Xử lý sửa khuyến mãi
if (isset($_POST['btSua'])) {
    $maKM = $_POST['maKM'];
    $tenKM = $_POST['tenKM'];
    $noiDungChuongTrinh = $_POST['noiDungChuongTrinh'];
    $phanTramKM = $_POST['phanTramKM'];
    $promotion->editPromotion($maKM, $tenKM, $noiDungChuongTrinh, $phanTramKM);
}

// Xử lý xóa khuyến mãi
if (isset($_POST['btXoa'])) {
    $maKM = $_POST['btXoa'];
    $promotion->deletePromotion($maKM);
}

// Lấy danh sách khuyến mãi từ cơ sở dữ liệu
$khuyenmai = $promotion->getPromotions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khuyến mãi</title>
    <style>
        .card.strpied-tabled-with-hover {
            border-radius: 15px;
            overflow: hidden;
        }

        .card.strpied-tabled-with-hover .table thead th,
        .card.strpied-tabled-with-hover .table tbody td {
            border: none;
        }

        .card.strpied-tabled-with-hover .table thead {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="strpied-tabled-with-hover bg-white">
                        <div class="card-header bg-white">
                            <h4 class="card-title text-center">DANH SÁCH KHUYẾN MÃI</h4>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i
                                    class="fa fa-plus-circle"></i>Thêm mới</button>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <form method="post">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Mã KM</th>
                                        <th>Tên KM</th>
                                        <th>Nội Dung Chương Trình</th>
                                        <th>Phần Trăm KM</th>
                                        <th>Thao Tác</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($khuyenmai as $item): ?>
                                            <tr>
                                                <td><?= $item["maKM"] ?></td>
                                                <td><?= $item["tenKM"] ?></td>
                                                <td><?= $item["noiDungChuongTrinh"] ?></td>
                                                <td><?= $item["phanTramKM"] ?>%</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editPromotionModal"
                                                        onclick="document.getElementById('editMaKM').value='<?= $item['maKM'] ?>'; 
                                                              document.getElementById('editTenKM').value='<?= $item['tenKM'] ?>'; 
                                                              document.getElementById('editNoiDungChuongTrinh').value='<?= $item['noiDungChuongTrinh'] ?>'; 
                                                              document.getElementById('editPhanTramKM').value='<?= $item['phanTramKM'] ?>';">
                                                        Sửa
                                                    </button>
                                                    <button
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa khuyến mãi này không?')"
                                                        type="submit" name="btXoa" value="<?= $item["maKM"] ?>"
                                                        class="btn btn-danger">Xóa</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Thêm Khuyến Mãi -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <form method="POST" id="addPromotionForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title text-center">THÊM KHUYẾN MÃI MỚI</h3>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="tenKM" class="form-label">Tên Khuyến Mãi</label>
                                    <input type="text" class="form-control" name="tenKM" id="tenKM" required>
                                </div>
                                <div class="mb-3">
                                    <label for="noiDungChuongTrinh" class="form-label">Nội Dung Chương Trình</label>
                                    <textarea class="form-control" name="noiDungChuongTrinh"
                                        id="noiDungChuongTrinh"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="phanTramKM" class="form-label">Phần Trăm Khuyến Mãi</label>
                                    <input type="number" class="form-control" name="phanTramKM" id="phanTramKM"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary" name="addPromotion">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Sửa Khuyến Mãi -->
            <div id="editPromotionModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <form method="POST" id="editPromotionForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title text-center">SỬA KHUYẾN MÃI</h3>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body"> <input type="hidden" name="maKM" id="editMaKM">
                                <div class="mb-3">
                                    <label for="editTenKM" class="form-label">Tên Khuyến Mãi</label>
                                    <input type="text" class="form-control" name="tenKM" id="editTenKM" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editNoiDungChuongTrinh" class="form-label">Nội Dung Chương Trình</label>
                                    <textarea class="form-control" name="noiDungChuongTrinh"
                                        id="editNoiDungChuongTrinh"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editPhanTramKM" class="form-label">Phần Trăm Khuyến Mãi</label>
                                    <input type="number" class="form-control" name="phanTramKM" id="editPhanTramKM"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" name="btSua" class="btn btn-primary">Cập Nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>