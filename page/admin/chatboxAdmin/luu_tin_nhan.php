<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$maNguoiGui = $_POST['maNguoiGui'] ?? null;
$maNguoiNhan = $_POST['maNguoiNhan'] ?? null;
$noiDung = trim($_POST['noiDung'] ?? '');

if (!$maNguoiGui || !$maNguoiNhan || $noiDung === '') {
    echo 'fail';
    exit;
}

$ngayGui = date("Y-m-d");
$thoiGianGui = date("H:i:s");

$sql = "INSERT INTO tinnhan (maNguoiGui, maNguoiNhan, ngayGui, thoiGianGui, noiDung)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss", $maNguoiGui, $maNguoiNhan, $ngayGui, $thoiGianGui, $noiDung);

if ($stmt->execute()) {
    echo "$ngayGui $thoiGianGui";
} else {
    echo 'fail';
}
?>