<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$maNguoiGui = isset($_POST['maNguoiGui']) ? intval($_POST['maNguoiGui']) : 0;
$maNguoiNhan = isset($_POST['maNguoiNhan']) ? intval($_POST['maNguoiNhan']) : 0;
$noiDung = isset($_POST['noiDung']) ? trim($_POST['noiDung']) : '';

if ($maNguoiGui <= 0 || $maNguoiNhan <= 0 || $noiDung === '') {
    echo "fail";
    exit;
}

// Kiểm tra tồn tại người gửi
$sqlCheck = "SELECT COUNT(*) AS count FROM nguoidung WHERE maNguoiDung = ?";
$stmt = $conn->prepare($sqlCheck);
$stmt->bind_param("i", $maNguoiGui);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();
if ($res['count'] == 0) {
    echo "fail";
    exit;
}
$stmt->close();

// Kiểm tra tồn tại người nhận
$stmt = $conn->prepare($sqlCheck);
$stmt->bind_param("i", $maNguoiNhan);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();
if ($res['count'] == 0) {
    echo "fail";
    exit;
}
$stmt->close();

// Lấy ngày và giờ hiện tại
$ngayGui = date('Y-m-d');
$thoiGianGui = date('H:i:s');

$stmt = $conn->prepare("INSERT INTO tinnhan (maNguoiGui, maNguoiNhan, ngayGui, thoiGianGui, noiDung) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $maNguoiGui, $maNguoiNhan, $ngayGui, $thoiGianGui, $noiDung);

if ($stmt->execute()) {
    echo $ngayGui . ' ' . $thoiGianGui;
} else {
    echo "fail";
}

$stmt->close();
$conn->close();
?>