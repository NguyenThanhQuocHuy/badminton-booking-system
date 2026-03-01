<?php
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$maNguoiGui = isset($_POST['maNguoiGui']) ? intval($_POST['maNguoiGui']) : 0;
$maNguoiNhan = isset($_POST['maNguoiNhan']) ? intval($_POST['maNguoiNhan']) : 0;

if ($maNguoiGui <= 0 || $maNguoiNhan <= 0) {
    exit;
}

$sql = "UPDATE tinnhan SET daXem = 1 
        WHERE maNguoiGui = ? AND maNguoiNhan = ? AND daXem = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $maNguoiGui, $maNguoiNhan);
$stmt->execute();
$stmt->close();
$conn->close();
?>