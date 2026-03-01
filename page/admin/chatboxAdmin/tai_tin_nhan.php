<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$maNguoiGui = $_GET['maNguoiGui'] ?? null;
$maNguoiNhan = $_GET['maNguoiNhan'] ?? null;

if (!$maNguoiGui || !$maNguoiNhan) {
    echo json_encode([]);
    exit;
}

$sql = "
    SELECT * FROM tinnhan
    WHERE (maNguoiGui = ? AND maNguoiNhan = ?)
       OR (maNguoiGui = ? AND maNguoiNhan = ?)
    ORDER BY ngayGui ASC, thoiGianGui ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $maNguoiGui, $maNguoiNhan, $maNguoiNhan, $maNguoiGui);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages, JSON_UNESCAPED_UNICODE);
?>