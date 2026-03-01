<?php
ob_start();
session_start();
error_reporting(0);
if (isset($_GET['register'])) {
    $page = 'register';
    include("page/" . $page . "/index.php");
    exit();
} else if (isset($_GET['login'])) {
    $page = 'login';
    include("page/" . $page . "/index.php"); // include vào đang ở cấp Page ngoài cùng
    exit();
}
include("layout/header.php");
if (isset($_GET['about'])) {
    $page = 'about';
} else if (isset($_GET['policy'])) {
    $page = 'policy';
} else if (isset($_GET['product'])) {
    $page = 'product';
} else if (isset($_GET['productdetails'])) {
    $page = 'productdetails';
} else if (isset($_GET['order'])) {
    $page = 'order';   
} else if (isset($_GET['checkout'])) {
    $page = 'checkout'; 
} else if (isset($_GET['payment'])) {
    $page = 'payment'; 
} else if (isset($_GET['cate'])) {
    $page = 'producttype';
} else if (isset($_GET['cate'])) {
    $page = 'category';
} else if (isset($_GET['contact'])) {
    $page = 'contact';
} else if (isset($_GET['search'])) {
    $page = 'search';
} else if (isset($_GET['profile'])) {
    $page = 'profile';
} else if (isset($_GET['change_password'])) {
    $page = 'change_password';   
} else if (isset($_GET['updateProfile'])) {
    $page = 'updateProfile'; 
} else if (isset($_GET['personal_information'])) {
    $page = 'personal_information';
} else if (isset($_GET['history'])) {
    $page = 'history';
} else if (isset($_GET['logout'])) {
    $page = 'logout';
} else {
    $page = 'home';
}
if (isset($_GET['logout'])) {
    // Hủy session và trở lại trang chủ
    session_start(); 
    session_unset();
    session_destroy();
    header("Location: index.php?home");
    exit();
} else if (isset($_GET['invoice_details'])) {
    $page = 'invoice_details';
}
include("page/" . $page . "/index.php");
include("page/chatbox/index.php");
include("layout/footer.php");
ob_end_flush();
?>