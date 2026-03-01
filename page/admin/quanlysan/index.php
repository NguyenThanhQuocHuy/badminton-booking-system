<?php
if (!isset($_GET['quanlysan'])) {
    $quanlysan = 1;
} else {
    $quanlysan = (int) $_GET['quanlysan'];
}
$obj = new database();

// Cài đặt số lượng sân trên mỗi trang
$limit = 10;
$start = max(0, ($quanlysan - 1) * $limit);

// Truy vấn danh sách sân
$sql = "SELECT san.*, loaisan.tenLoai AS tenLoai FROM san 
        INNER JOIN loaisan ON san.maLoai = loaisan.maLoai
        LIMIT $start, $limit";
$danhsachsan = $obj->xuatdulieu($sql);

// Truy vấn số lượng tổng sân để phân trang
$sqlTotal = "SELECT COUNT(*) as total FROM san";
$totalSan = $obj->xuatdulieu($sqlTotal);
$totalSan = $totalSan[0]['total'];
$totalPages = ceil($totalSan / $limit);

// Xử lý thêm/sửa/xóa
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm sân mới
    if (isset($_POST['addSan'])) {
        $tenSan = $_POST['tenSan'];
        $giaThue = $_POST['giaThue'];
        $moTa = $_POST['moTa'];
        $kichThuoc = $_POST['kichThuoc'];
        $tinhTrang = $_POST['tinhTrang'];
        $maLoai = $_POST['maLoai'];

        // Xử lý hình ảnh
        $hinhAnh = null;
        if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] == 0) {
            $targetDir = "layout/images/";
            $fileName = time() . '_' . basename($_FILES['hinhAnh']['name']);
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['hinhAnh']['tmp_name'], $targetFilePath)) {
                $hinhAnh = $fileName;
            } else {
                $message = "Lỗi khi tải ảnh lên";
            }
        }

        $sql = "INSERT INTO san (tenSan, giaThue, moTa, kichThuoc, tinhTrang, hinhAnh, maLoai)
                VALUES ('$tenSan', '$giaThue', '$moTa', '$kichThuoc', '$tinhTrang', '$hinhAnh', '$maLoai')";
        if ($obj->themdulieu($sql)) {
            $message = "Thêm sân thành công";
        } else {
            $message = "Thêm sân thất bại";
        }
    }

    // Xóa sân
    if (isset($_POST['btXoa'])) {
        $maSan = $_POST['btXoa'];
        $sql = "DELETE FROM san WHERE maSan='$maSan'";
        $obj->xoadulieu($sql);
        $message = "Xóa sân thành công";
    }

    // Sửa sân
    if (isset($_POST['btSua'])) {
        $maSan = $_POST['maSan'];
        $tenSan = $_POST['tenSan'];
        $giaThue = $_POST['giaThue'];
        $moTa = $_POST['moTa'];
        $kichThuoc = $_POST['kichThuoc'];
        $tinhTrang = $_POST['tinhTrang'];
        $maLoai = $_POST['maLoai'];
        $hinhAnh = $_POST['oldHinhAnh'];

        if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] == 0) {
            $targetDir = "layout/images/";
            $fileName = time() . '_' . basename($_FILES['hinhAnh']['name']);
            $targetFilePath = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['hinhAnh']['tmp_name'], $targetFilePath)) {
                $hinhAnh = $fileName;
            } else {
                $message = "Lỗi khi cập nhật ảnh";
            }
        }

        $sql = "UPDATE san SET tenSan='$tenSan', giaThue='$giaThue', moTa='$moTa', kichThuoc='$kichThuoc',
                tinhTrang='$tinhTrang', hinhAnh='$hinhAnh', maLoai='$maLoai'
                WHERE maSan='$maSan'";
        if ($obj->suadulieu($sql)) {
            $message = "Cập nhật sân thành công";
        } else {
            $message = "Cập nhật sân thất bại";
        }
    }
}
?>
<script>
    <?php if ($message): ?>
        alert("<?= $message ?>");
        window.location.href = "indexAdmin.php?quanlysan"; // Cập nhật lại đường dẫn phù hợp
    <?php endif; ?>
</script>
<style>
    .modal-body {
        max-height: 50vh;
        overflow-y: auto;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title text-center">DANH SÁCH SÂN</h4>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSanModal">
                            <i class="fa fa-plus-circle"></i> Thêm mới
                        </button>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form method="post">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã Sân</th>
                                        <th>Tên Sân</th>
                                        <th>Giá Thuê</th>
                                        <th>Mô Tả</th>
                                        <th>Kích Thước</th>
                                        <th>Tình Trạng</th>
                                        <th>Loại Sân</th>
                                        <th>Hình Ảnh</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($danhsachsan as $san): ?>
                                        <tr>
                                            <td><?= $san["maSan"] ?></td>
                                            <td><?= $san["tenSan"] ?></td>
                                            <td><?= number_format($san["giaThue"]) ?> đ</td>
                                            <td><?= $san["moTa"] ?></td>
                                            <td><?= $san["kichThuoc"] ?></td>
                                            <td><?= $san["tinhTrang"] ?></td>
                                            <td><?= $san["tenLoai"] ?></td>
                                            <td><img src="layout/images/<?= $san['hinhAnh'] ?>" alt="ảnh sân" width="60"></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSanModal" onclick='editSan(<?= json_encode($san) ?>)'>Sửa</button>
                                                <button type="submit" name="btXoa" value="<?= $san["maSan"] ?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa sân này?')">Xóa</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <!-- Phân trang -->
                    <div class="pagination text-center">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?quanlydausach=<?= $i ?>" class="btn btn-info"><?= $i ?></a>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Thêm Sân -->
<div id="addSanModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sân mới</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="tenSan" class="form-control mb-2" placeholder="Tên sân" required>
                    <input type="number" name="giaThue" class="form-control mb-2" placeholder="Giá thuê (VNĐ)" required>
                    <textarea name="moTa" class="form-control mb-2" placeholder="Mô tả"></textarea>
                    <input type="text" name="kichThuoc" class="form-control mb-2" placeholder="Kích thước" required>
                    <select name="tinhTrang" class="form-control mb-2">
                        <option value="Hoạt động">Hoạt động</option>
                        <option value="Bảo trì">Bảo trì</option>
                    </select>
                    <select name="maLoai" class="form-control mb-2">
                        <?php foreach ($obj->xuatdulieu("SELECT * FROM loaisan") as $loai): ?>
                            <option value="<?= $loai['maLoai'] ?>"><?= $loai['tenLoai'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="file" name="hinhAnh" class="form-control" accept="image/*" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="addSan" class="btn btn-primary">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Sửa Sân -->
<div id="editSanModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sửa thông tin sân</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="maSan" id="editMaSan">
                    <input type="text" name="tenSan" id="editTenSan" class="form-control mb-2" required>
                    <input type="number" name="giaThue" id="editGiaThue" class="form-control mb-2" required>
                    <textarea name="moTa" id="editMoTa" class="form-control mb-2"></textarea>
                    <input type="text" name="kichThuoc" id="editKichThuoc" class="form-control mb-2" required>
                    <select name="tinhTrang" id="editTinhTrang" class="form-control mb-2">
                        <option value="Hoạt động">Hoạt động</option>
                        <option value="Bảo trì">Bảo trì</option>
                    </select>
                    <select name="maLoai" id="editMaLoai" class="form-control mb-2">
                        <?php foreach ($obj->xuatdulieu("SELECT * FROM loaisan") as $loai): ?>
                            <option value="<?= $loai['maLoai'] ?>"><?= $loai['tenLoai'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="file" name="hinhAnh" id="editHinhAnh" class="form-control" accept="image/*">
                    <input type="hidden" name="oldHinhAnh" id="editOldHinhAnh">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btSua" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function editSan(san) {
    document.getElementById('editMaSan').value = san.maSan;
    document.getElementById('editTenSan').value = san.tenSan;
    document.getElementById('editGiaThue').value = san.giaThue;
    document.getElementById('editMoTa').value = san.moTa;
    document.getElementById('editKichThuoc').value = san.kichThuoc;
    document.getElementById('editTinhTrang').value = san.tinhTrang;
    document.getElementById('editMaLoai').value = san.maLoai;
    document.getElementById('editOldHinhAnh').value = san.hinhAnh;
}
</script>
