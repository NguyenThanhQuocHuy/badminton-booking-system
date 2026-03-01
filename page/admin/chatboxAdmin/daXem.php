<?php
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) die("Lỗi kết nối: " . $conn->connect_error);

$maNguoiGui = $_POST['maNguoiGui'] ?? null;
$maNguoiNhan = $_POST['maNguoiNhan'] ?? null;

if (!$maNguoiGui || !$maNguoiNhan) exit;

$sql = "UPDATE tinnhan SET daXem = 1 WHERE maNguoiGui = ? AND maNguoiNhan = ? AND daXem = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $maNguoiGui, $maNguoiNhan);
$stmt->execute();
?>