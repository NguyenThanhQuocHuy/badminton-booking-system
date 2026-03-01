<?php
include 'page/admin/quanlythuetra/config.php';

if (!isset($_GET['maDon'])) {
    die("Không tìm thấy mã đơn thuê.");
}
$maDon = $conn->real_escape_string($_GET['maDon']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['maDon']) && isset($_POST['tinhTrangThueHidden'])) {
        $newStatus = $_POST['tinhTrangThue'] ?? $_POST['tinhTrangThueHidden'];
        $uploadOk = 1;
        $fileName = "";

        if (!empty($_FILES["hinhAnhTraSan"]["name"])) {
            $targetDir = "layout/images/uploads/";
            $fileName = basename($_FILES["hinhAnhTraSan"]["name"]);
            $uploadFile = $targetDir . $fileName;
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["hinhAnhTraSan"]["tmp_name"]);
            if ($check === false || $_FILES["hinhAnhTraSan"]["size"] > 5000000 || !in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                echo "<script>alert('File ảnh không hợp lệ.');</script>";
                $uploadOk = 0;
            }

            if ($uploadOk && !move_uploaded_file($_FILES["hinhAnhTraSan"]["tmp_name"], $uploadFile)) {
                echo "<script>alert('Không thể tải ảnh.');</script>";
                $uploadOk = 0;
            }
        }

        if ($uploadOk) {
            $updateQuery = "
                UPDATE donthuesan
                SET tinhTrangThue = 'Da hoan thanh'
                " . (!empty($fileName) ? ", hinhAnhTraSan = '$fileName'" : "") . "
                WHERE maDon = '$maDon'
            ";
            if ($conn->query($updateQuery)) {
                echo "<script>alert('Cập nhật trạng thái thành công.');</script>";
            } else {
                echo "<script>alert('Lỗi truy vấn: " . $conn->error . "');</script>";
            }
        }

        echo "<script>window.location.href = window.location.href;</script>";
    }
}

// Lấy thông tin đơn thuê
$sql = "
    SELECT ds.*, s.tenSan
    FROM donthuesan ds
    JOIN san s ON ds.maSan = s.maSan
    WHERE ds.maDon = '$maDon'
";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) die("Không tìm thấy đơn thuê.");
?>
<style>
    .c-card {
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-radius: 12px;
    padding: 20px;
}

.card-body p {
    margin-bottom: 10px;
    font-size: 15px;
    line-height: 1.6;
}

.card-body b {
    color: #333;
    display: inline-block;
    min-width: 160px;
}

.card-body img {
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.card-body form {
    margin-top: 20px;
    padding: 15px;
    background: #f7f7f7;
    border-radius: 8px;
    border: 1px dashed #bbb;
}

.card-body .form-control {
    margin-bottom: 10px;
}

.card-body .btn-success {
    width: 100%;
}

@media (max-width: 768px) {
    .card-body .col-md-6 {
        margin-bottom: 20px;
    }
}
/* Hiệu ứng phóng to ảnh khi click */
.zoomable-img {
    cursor: pointer;
    transition: 0.3s ease-in-out;
}

#imageModal {
    display: none;
    position: fixed;
    z-index: 10000;
    padding-top: 50px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.8);
}

#imageModal img {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 90%;
}

#imageModal span {
    position: absolute;
    top: 30px;
    right: 35px;
    color: white;
    font-size: 30px;
    font-weight: bold;
    cursor: pointer;
}
</style>
<div class="content">
    <div class="container-fluid">
        <a href="indexAdmin.php?quanlythuetra" class="btn btn-danger">Quay về</a>
        <h4 class="text-center my-3">CHI TIẾT ĐƠN THUÊ SÂN</h4>
        <div class="card c-card">
            <div class="card-body row">
                <div class="col-md-6">
                    <p><b>Mã đơn:</b> <?= $row['maDon'] ?></p>
                    <p><b>Ngày thuê:</b> <?= $row['ngayThue'] ?></p>
                    <p><b>Khung giờ:</b> <?= $row['thoiGianThue'] ?></p>
                    <p><b>Sân:</b> <?= $row['tenSan'] ?></p>
                    <p><b>Phương thức thanh toán:</b> <?= $row['phuongThucThanhToan'] ?></p>
                    <p><b>Trạng thái thuê:</b> <?= $row['tinhTrangThue'] ?></p>
                    <p><b>Ảnh thanh toán:</b><br>
                        <?php if ($row['hinhAnhThanhToan']): ?>
                            <img src="layout/images/uploads/<?= $row['hinhAnhThanhToan'] ?>" width="150" class="zoomable-img">
                        <?php else: ?>
                            <i>Chưa có ảnh</i>
                        <?php endif; ?>
                    </p>
                    <p><b>Ảnh khi trả sân (nếu có):</b><br>
                        <?php if ($row['hinhAnhTraSan']): ?>
                            <img src="layout/images/uploads/<?= $row['hinhAnhTraSan'] ?>" width="150" class="zoomable-img">
                        <?php else: ?>
                            <i>Chưa có ảnh</i>
                        <?php endif; ?>
                    </p>

                    <?php if ($row['tinhTrangThue'] !== 'Da hoan thanh'): ?>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="maDon" value="<?= $row['maDon'] ?>">
                            <input type="hidden" name="tinhTrangThueHidden" value="<?= $row['tinhTrangThue'] ?>">
                            <label for="hinhAnhTraSan">Ảnh khi trả sân (nếu có vấn đề):</label>
                            <input type="file" name="hinhAnhTraSan" accept="image/*" class="form-control mb-2">
                            <button type="submit" name="tinhTrangThue" value="Da hoan thanh" class="btn btn-success">Xác nhận Đã trả</button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <p><b>Giá mỗi giờ:</b> <?= number_format($row['giaMoiGio']) ?> VNĐ</p>
                    <p><b>Tổng tiền gốc:</b> <?= number_format($row['tongTienGoc']) ?> VNĐ</p>
                    <p><b>Giảm thành viên:</b> -<?= number_format($row['giamThanhVien']) ?> VNĐ</p>
                    <p><b>Giảm khuyến mãi:</b> -<?= number_format($row['giamKhuyenMai']) ?> VNĐ</p>
                    <p><b>Tổng thanh toán:</b> <?= number_format($row['tongThanhTien']) ?> VNĐ</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="imageModal">
    <span onclick="document.getElementById('imageModal').style.display='none'">&times;</span>
    <img id="modalImg" src="">
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImg");

    document.querySelectorAll(".zoomable-img").forEach(function(img) {
        img.addEventListener("click", function() {
            modal.style.display = "block";
            modalImg.src = this.src;
        });
    });
});
</script>