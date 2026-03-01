<?php
session_start();
if (!isset($_GET['payment'])) {
    $payment = 1;
} else {
    $payment = $_GET['payment'];
}
//echo '<pre>'; print_r($_SESSION); echo '</pre>';
$conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");

if (!isset($_SESSION['checkout_data'])) {
    echo "Không có dữ liệu thanh toán.";
    exit();
}

$data = $_SESSION['checkout_data'];
$maSan = $data['maSan'];
$ngayThue = $data['ngayThue'];
$thoiGianThue = $data['thoiGianThue'];
$giaMoiGio = $data['giaMoiGio'];
$tongTienGoc = $data['tongTienGoc'];
$giamThanhVien = $data['giamThanhVien'];
$giamKhuyenMai = $data['giamKhuyenMai'];
$tongThanhTien = $data['tongThanhTien'];
$maKH = $data['maKH'];
$maThe = $data['maThe'];
$maKM = $data['maKM'];
$code = $data['code'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán đặt sân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Thanh toán đặt sân</h2>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Thông tin đặt sân</strong>
        </div>
        <div class="card-body">
            <p><strong>Mã sân:</strong> <?= $maSan ?></p>
            <p><strong>Ngày thuê:</strong> <?= $ngayThue ?></p>
            <p><strong>Thời gian thuê:</strong> <?= $thoiGianThue ?></p>
            <p><strong>Giá mỗi giờ:</strong> <?= number_format($giaMoiGio, 0, '.', '.') ?> VND</p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Chi tiết hóa đơn</strong>
        </div>
        <div class="card-body">
            <p><strong>Tổng tiền gốc:</strong> <?= number_format($tongTienGoc, 0, '.', '.') ?> VND</p>
            <p><strong>Giảm thành viên:</strong> <?= number_format($giamThanhVien, 0, '.', '.') ?> VND</p>
            <p><strong>Giảm khuyến mãi:</strong> <?= number_format($giamKhuyenMai, 0, '.', '.') ?> VND</p>
            <p><strong>Tổng cần thanh toán:</strong> <span class="text-danger fw-bold"><?= number_format($tongThanhTien, 0, '.', '.') ?> VND</span></p>
        </div>
    </div>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="phuongThucThanhToan" class="form-label"><strong>Phương thức thanh toán:</strong></label>
            <select name="phuongThucThanhToan" class="form-select" id="phuongThuc">
                <option value="Tiền mặt">Tiền mặt</option>
                <option value="Bank">Chuyển khoản</option>
            </select>
        </div>
        <div class="card mb-3" id="thongTinChuyenKhoan" style="display:none">
            <div class="card-header"><strong>Thông tin chuyển khoản</strong></div>
            <div class="card-body row">
                <div class="col-md-8">
                    <p><strong>Mã xác thực:</strong> <span id="maCode"><?= $code ?></span></p>
                    <p><strong>Tên tài khoản:</strong> Nguyễn Thanh Quốc Huy</p>
                    <p><strong>Số tài khoản:</strong> 1234567890</p>
                    <p><strong>Ngân hàng:</strong> Techcombank</p>
                    <p><strong>Tổng cần chuyển:</strong> <span class="text-danger fw-bold"><?= number_format($tongThanhTien, 0, '.', '.') ?> VND</span></p>
                    <p><strong>Nội dung chuyển khoản:</strong> Vui lòng ghi rõ <code>[Mã xác thực] <?= $code ?></code></p>
                </div>
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                    <strong class="mb-2">Mã QR thanh toán:</strong>
                    <img src="layout/images/QRcode.png" alt="QR Code" class="img-fluid" style="max-width: 180px; border: 1px solid #ccc; padding: 5px; border-radius: 8px;">
                </div>
            </div>
        </div>
        <div class="mb-3" id="uploadSection" style="display:none">
            <label for="hinhAnhThanhToan" class="form-label"><strong>Upload hình ảnh chuyển khoản:</strong></label>
            <input type="file" name="hinhAnhThanhToan" accept="image/*" class="form-control">
        </div>
        <button class="btn btn-success" name="thanhToan">Hoàn tất thanh toán</button>
    </form>
</div>

</body>
</html>

<?php
if (isset($_POST['thanhToan'])) {
    $phuongThuc = $_POST['phuongThucThanhToan'];
    $hinhAnh = null;

    // Nếu là chuyển khoản thì yêu cầu hình ảnh và đặt trạng thái là "Đã thanh toán"
    if ($phuongThuc === 'Bank') {
        if (!isset($_FILES['hinhAnhThanhToan']) || $_FILES['hinhAnhThanhToan']['error'] !== 0) {
            echo "<script>
                alert('❌ Vui lòng tải lên hình ảnh xác nhận chuyển khoản trước khi hoàn tất thanh toán.');
                window.location.href = 'index.php?payment';
            </script>";
            exit();
        }

        // Lưu hình ảnh
        $targetDir = "layout/images/uploads/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $fileName = uniqid() . "_" . basename($_FILES["hinhAnhThanhToan"]["name"]);
        $targetFile = $targetDir . $fileName;
        move_uploaded_file($_FILES["hinhAnhThanhToan"]["tmp_name"], $targetFile);
        $hinhAnh = $fileName;

        $tinhTrangThanhToan = "Cho xac nhan";
    } else {
        // Nếu là tiền mặt thì trạng thái là "Chưa thanh toán"
        $tinhTrangThanhToan = "Chua thanh toan";
    }

    $tinhTrangThue = "Đang thuê";

    $sql = "INSERT INTO donthuesan 
        (ngayThue, thoiGianThue, tinhTrangThanhToan, phuongThucThanhToan, hinhAnhThanhToan, giaMoiGio, tongTienGoc, giamThanhVien, giamKhuyenMai, tongThanhTien, tinhTrangThue, code, maSan, maKH, maThe, maKM)
        VALUES (
            '{$data['ngayThue']}', '{$data['thoiGianThue']}', '$tinhTrangThanhToan', '$phuongThuc', " . 
            ($hinhAnh ? "'$hinhAnh'" : "NULL") . ", '{$data['giaMoiGio']}', '{$data['tongTienGoc']}',
            '{$data['giamThanhVien']}', '{$data['giamKhuyenMai']}', '{$data['tongThanhTien']}',
            '$tinhTrangThue', '{$data['code']}', '{$data['maSan']}', '{$data['maKH']}', " . 
            ($data['maThe'] !== "NULL" ? "'{$data['maThe']}'" : "NULL") . ", " . 
            ($data['maKM'] !== "NULL" ? "'{$data['maKM']}'" : "NULL") . 
        ")";

    if (mysqli_query($conn, $sql)) {
        unset($_SESSION['checkout_data']);
        echo "<script>
            alert('✅ Đặt sân thành công!');
            window.location.href = 'index.php?home';
        </script>";
        exit();
    } else {
        $errorMsg = addslashes(mysqli_error($conn));
        echo "<script>
            alert('❌ Lỗi thanh toán: $errorMsg');
        </script>";
        exit();
    }
}
?>
<script>
/*const phuongThuc = document.getElementById('phuongThuc');
const uploadSection = document.getElementById('uploadSection');
const thongTinChuyenKhoan = document.getElementById('thongTinChuyenKhoan');

phuongThuc.addEventListener('change', function () {
    const isTransfer = this.value === 'chuyenkhoan';
    uploadSection.style.display = isTransfer ? 'block' : 'none';
    thongTinChuyenKhoan.style.display = isTransfer ? 'block' : 'none';
});*/
</script>
<script>
const phuongThuc = document.getElementById('phuongThuc');
const uploadSection = document.getElementById('uploadSection');
const thongTinChuyenKhoan = document.getElementById('thongTinChuyenKhoan');

function handlePhuongThucChange() {
    const isTransfer = phuongThuc.value === 'Bank';
    uploadSection.style.display = isTransfer ? 'block' : 'none';
    thongTinChuyenKhoan.style.display = isTransfer ? 'block' : 'none';
}
phuongThuc.addEventListener('change', handlePhuongThucChange);
// Gọi hàm khi trang vừa load
window.addEventListener('DOMContentLoaded', handlePhuongThucChange);
</script>
