<?php
session_start();
ob_start();

// Kiểm tra nếu đăng xuất
if (isset($_GET['logoutAdmin'])) {
    session_unset();
    session_destroy();
    header('Location: loginAdmin.php');
    exit();
}

// Kiểm tra nếu chưa đăng nhập
if (!isset($_SESSION['admin_id'])) {
    header('Location: loginAdmin.php');
    exit();
}

include("class/classdatabase.php");
include("layout/sidebar.php");

$roleId = $_SESSION['roleId']; // Lấy roleId từ session

// Mảng các trang và quyền truy cập tương ứng
$pages = [
    'quanlydanhmuc' => [1, 2],
    'quanlynhanvien' => 1,
    'quanlythetv' => [1, 2],
    'quanlythuetra' => [1, 2],
    'baocao' => 1,
    'chitietdonthue' => [1, 2],
    'quanlysan' => [1, 2],
    'quanlydonhang' => [1, 2],
    'quanlykhuyenmai' => 1,
    'quanlychinhsach' => 1,
    'quanlykhachhang' => [1, 2],
    'chitietkhachhang' => [1, 2],
    'chatboxAdmin' => [1,2],
    'home' => null // Mặc định trang home không cần kiểm tra quyền
];

$pagead = 'home'; // Mặc định là trang home

// Kiểm tra xem trang yêu cầu có tồn tại trong mảng và kiểm tra quyền
foreach ($pages as $key => $requiredRole) {
    if (isset($_GET[$key])) {
        $pagead = $key;

        // Nếu trang yêu cầu quyền, kiểm tra xem người dùng có quyền hay không
        if ($requiredRole !== null && !in_array($roleId, (array) $requiredRole)) {
            echo '<script>alert("Bạn không có quyền truy cập vào trang này."); window.history.back();</script>';
            exit();
        }
        break;
    }
}

// Include các file page tương ứng
include("page/admin/" . $pagead . "/index.php");
include("layout/footerAdmin.php");
?>