<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$maNguoiGui = isset($_GET['maNguoiGui']) ? intval($_GET['maNguoiGui']) : 0;
$maNguoiNhan = isset($_GET['maNguoiNhan']) ? intval($_GET['maNguoiNhan']) : 0;

if ($maNguoiGui <= 0 || $maNguoiNhan <= 0) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT maNguoiGui, maNguoiNhan, ngayGui, thoiGianGui, noiDung 
        FROM tinnhan 
        WHERE (maNguoiGui = ? AND maNguoiNhan = ?) 
           OR (maNguoiGui = ? AND maNguoiNhan = ?)
        ORDER BY ngayGui ASC, thoiGianGui ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $maNguoiGui, $maNguoiNhan, $maNguoiNhan, $maNguoiGui);
$stmt->execute();
$result = $stmt->get_result();

$tinNhan = [];
while ($row = $result->fetch_assoc()) {
    $row['thoiGianDayDu'] = $row['ngayGui'] . ' ' . $row['thoiGianGui'];
    $tinNhan[] = $row;
}

echo json_encode($tinNhan);

$stmt->close();
$conn->close();
?>