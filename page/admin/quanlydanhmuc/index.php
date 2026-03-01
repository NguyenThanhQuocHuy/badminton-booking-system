<?php
if (!isset($_GET['quanlydanhmuc'])) {
    $quanlydanhmuc = 1;
} else {
    $quanlydanhmuc = $_GET['quanlydanhmuc'];
}

$obj = new database();
$sql = "SELECT * FROM loaisan";
$danhmuc = $obj->xuatdulieu($sql);

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addCategory'])) {
        $tenLoai = $_POST['tenLoai'];
        $moTa = $_POST['moTa'];
        $tongSoLuong = $_POST['tongSoLuong'];
        $sql = "INSERT INTO loaisan (tenLoai, moTa, tongSoLuong) VALUES ('$tenLoai', '$moTa', '$tongSoLuong')";
        if ($obj->themdulieu($sql)) {
            $message = "Thêm mới loại sân thành công";
        } else {
            $message = "Thêm mới loại sân thất bại";
        }
    }

    if (isset($_POST['btXoa'])) {
        $maLoai = $_POST['btXoa'];
        $sql = "DELETE FROM loaisan WHERE maLoai='$maLoai'";
        $result = $obj->xoadulieu($sql);

        if ($result === true) {
            $message = "Xóa loại sân thành công";
        } else {
            if (str_contains($result, 'a foreign key constraint fails')) {
                $message = "Không thể xóa loại sân! Dữ liệu liên quan vẫn còn tồn tại.";
            } else {
                $message = "Lỗi khi xóa loại sân: " . $result;
            }
        }
    }

    if (isset($_POST['btSua'])) {
        $maLoai = $_POST['maLoai'];
        $tenLoai = $_POST['tenLoai'];
        $moTa = $_POST['moTa'];
        $tongSoLuong = $_POST['tongSoLuong'];
        $sql = "UPDATE loaisan SET tenLoai='$tenLoai', moTa='$moTa', tongSoLuong='$tongSoLuong' WHERE maLoai='$maLoai'";
        if ($obj->suadulieu($sql)) {
            $message = "Cập nhật loại sân thành công";
        } else {
            $message = "Cập nhật loại sân thất bại";
        }
    }
}
?>
<script>
    // Show alert message if exists
    <?php if ($message): ?>
        alert("<?= $message ?>");
        window.location.href = "indexAdmin.php?quanlydanhmuc"; // Redirect after alert
    <?php endif; ?>
</script>
<style>
    .modal.show {
        display: block !important;
        /* Đảm bảo modal hiển thị */
    }

    .modal-dialog {
        position: fixed !important;
        top: 10% !important;
        left: 50% !important;
        transform: translate(-50%, -10%) !important;
        margin: 0 !important;
        z-index: 1055 !important;
        max-width: 800px;
        width: 90%;

    }

    .modal-body {
        overflow-y: auto;
        max-height: 70vh;
        padding: 2rem;
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class=" strpied-tabled-with-hover bg-white ">
                    <div class="card-header bg-white">
                        <h4 class="card-title text-center">DANH SÁCH LOẠI SÂN</h4>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i
                                class="fa fa-plus-circle"></i>Thêm
                            mới</button>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form method="post">
                            <table class="table table-hover table-striped">
                                    <thead>
                                        <th><b>Mã Loại</b></th>
                                        <th><b>Tên Loại</b></th>
                                        <th><b>Mô Tả</b></th>
                                        <th><b>Tổng Số Lượng</b></th>
                                        <th><b>Thao Tác</b></th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($danhmuc as $item): ?>
                                            <tr>
                                                <td><?= $item["maLoai"] ?></td>
                                                <td><?= $item["tenLoai"] ?></td>
                                                <td><?= $item["moTa"] ?></td>
                                                <td><?= $item["tongSoLuong"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editCategoryModal"
                                                        onclick="document.getElementById('editMaLoai').value='<?= $item['maLoai'] ?>';
                                                                document.getElementById('editTenLoai').value='<?= $item['tenLoai'] ?>';
                                                                document.getElementById('editMoTa').value='<?= $item['moTa'] ?>';
                                                                document.getElementById('editTongSoLuong').value='<?= $item['tongSoLuong'] ?>';">
                                                        Sửa
                                                    </button>
                                                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa loại sân này không?')"
                                                        type="submit" name="btXoa" value="<?= $item["maLoai"] ?>" class="btn btn-danger">Xóa</button>
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


        <!-- Modal Thêm Danh Mục -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form method="POST" id="addCategoryForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-center">THÊM LOẠI SÂN MỚI</h3>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="ten" class="form-label">Tên LOẠI SÂN</label>
                                <input type="text" class="form-control" name="tenLoai" id="tenLoai" required>
                            </div>
                            <div class="mb-3">
                                <label for="moTa" class="form-label">MÔ TẢ</label>
                                <textarea class="form-control" name="moTa" id="moTa" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tongSoLuong" class="form-label">SỐ LƯỢNG </label>
                                <input type="number" class="form-control" name="tongSoLuong" id="tongSoLuong" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" name="addCategory">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Sửa Danh Mục -->
        <div id="editCategoryModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form method="POST" id="editCategoryForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-center">SỬA LOẠI SÂN</h3>

                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="maLoai" id="editMaLoai">
                            <div class="mb-3">
                                <label for="editTen" class="form-label">Tên loại sân</label>
                                <input type="text" class="form-control" name="tenLoai" id="editTenLoai" required>
                            </div>
                            <div class="mb-3">
                                <label for="editMoTa" class="form-label">Mô Tả</label>
                                <textarea class="form-control" name="moTa" id="editMoTa" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editTongSoLuong" class="form-label">Số lượng </label>
                                <input type="number" class="form-control" name="tongSoLuong" id="editTongSoLuong" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="btSua" class="btn btn-primary">Cập Nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>