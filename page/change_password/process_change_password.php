<?php
session_start();
include("../../myclass/connect.php"); // Đảm bảo file kết nối đúng đường dẫn

$db = new myDatabase();  // Tạo đối tượng
$conn = $db->conn;       // Lấy kết nối để dùng cho câu lệnh SQL
if (!isset($_SESSION['maNguoiDung'])) {
    echo "<script>alert('Bạn chưa đăng nhập.'); window.location.href='index.php';</script>";
    exit();
}

$maNguoiDung = $_SESSION['maNguoiDung'];
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_new_password = $_POST['confirm_new_password'] ?? '';

// Kiểm tra mật khẩu mới có khớp không
if ($new_password !== $confirm_new_password) {
    echo "<script>alert('Mật khẩu mới không khớp.'); window.history.back();</script>";
    exit();
}

// Lấy mật khẩu hiện tại trong CSDL
$query = "SELECT password FROM taikhoan WHERE maNguoiDung = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $maNguoiDung);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "<script>alert('Không tìm thấy tài khoản.'); window.location.href='index.php';</script>";
    exit();
}

$row = $result->fetch_assoc();

// Kiểm tra mật khẩu cũ đúng không
if (md5($current_password) !== $row['password']) {
    echo "<script>alert('Mật khẩu cũ không đúng.'); window.history.back();</script>";
    exit();
}

// Mã hóa và cập nhật mật khẩu mới bằng md5
$new_password_hashed = md5($new_password);
$update_query = "UPDATE taikhoan SET password = ? WHERE maNguoiDung = ?";
$update_stmt = $conn->prepare($update_query);
$update_stmt->bind_param("si", $new_password_hashed, $maNguoiDung);
$update_stmt->execute();

if ($update_stmt->affected_rows > 0) {
    echo "<script>alert('Đổi mật khẩu thành công.'); window.location.href='../../index.php?home';</script>";
} else {
    echo "<script>alert('Không có thay đổi hoặc có lỗi xảy ra.'); window.history.back();</script>";
}
?>