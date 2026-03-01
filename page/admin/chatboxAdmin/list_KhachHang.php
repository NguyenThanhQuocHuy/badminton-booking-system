<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = new mysqli("localhost", "huy", "123456", "cnmoi");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}
$adminId = 2;

// Lấy danh sách khách hàng đã nhắn tin với admin
$sql = "
    SELECT DISTINCT nd.maNguoiDung, nd.ten,
        (SELECT COUNT(*) FROM tinnhan 
         WHERE maNguoiGui = nd.maNguoiDung 
         AND maNguoiNhan = $adminId 
         AND daXem = 0) AS chuaDoc
    FROM tinnhan tn
    JOIN nguoidung nd ON nd.maNguoiDung = IF(tn.maNguoiGui = $adminId, tn.maNguoiNhan, tn.maNguoiGui)
    JOIN khachhang kh ON kh.maNguoiDung = nd.maNguoiDung
    WHERE $adminId IN (tn.maNguoiGui, tn.maNguoiNhan)
";

$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>