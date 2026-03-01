<?php
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$maNguoiGui = isset($_GET['maNguoiGui']) ? intval($_GET['maNguoiGui']) : 0;
$maNguoiNhan = isset($_GET['maNguoiNhan']) ? intval($_GET['maNguoiNhan']) : 0;

if ($maNguoiGui <= 0 || $maNguoiNhan <= 0) {
    echo json_encode(['unread' => 0]);
    exit;
}

$sql = "SELECT COUNT(*) as chuaDoc 
        FROM tinnhan 
        WHERE maNguoiGui = ? AND maNguoiNhan = ? AND daXem = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $maNguoiGui, $maNguoiNhan);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

echo json_encode(['unread' => (int)$result['chuaDoc']]);

$stmt->close();
$conn->close();
?>