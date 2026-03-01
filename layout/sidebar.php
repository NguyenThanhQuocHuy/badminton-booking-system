<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="layout/images/apple-icon.png">
    <link rel="icon" type="image/png" href="layout/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Câu lạc bộ cầu lông SmashBooking</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="layout/css/bootstrapAD.min.css" rel="stylesheet" />
    <link href="layout/css/light-bootstrap-dashboard.css?v=2.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="layout/css/demo.css" rel="stylesheet" />
    <style>
        .sidebar .nav-item.dropdown {
            position: relative;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 15px 20px;
            transition: background-color 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);

        }

        .sidebar .dropdown-menu {
            display: none;

            position: absolute;
            left: 100%;
            top: 0;
            background-color: #2c2c2c;

            padding: 0;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .sidebar .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        .sidebar .dropdown-item {
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.2)
        }
    </style>
</head>
<?php
// Kiểm tra nếu chưa đăng nhập
if (!isset($_SESSION['admin_id'])) {
    header('Location: loginAdmin.php');
    exit();
}
// Khởi tạo biến $roleId
$roleId = isset($_SESSION['roleId']) ? $_SESSION['roleId'] : null; // Lấy roleId từ session
?>

<body>

    <div class="wrapper">
        <div class="sidebar" data-image="layout/images/sidebar-4.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="indexAdmin.php?home" class="simple-text">
                        mashBooking
                    </a>
                </div>
                <ul class="nav">
                    <?php if ($roleId == 1): // Quản lý ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-home"></i>
                                <p>Phản hồi</p>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="indexAdmin.php?chatboxAdmin">Liên hệ khách hàng</a>
                            </div>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlynhanvien">
                                <i class="fa fa-id-badge"></i>
                                <p>Quản lý nhân viên</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlychinhsach">
                                <i class="nc-icon nc-notes"></i>
                                <p>Quản lý chính sách</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlykhuyenmai">
                                <i class="nc-icon nc-notes"></i>
                                <p>Quản lý khuyến mãi</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlysan">
                                <i class="nc-icon nc-notes"></i>
                                <p>Quản lý sân</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlydanhmuc">
                                <i class="nc-icon nc-notes"></i>
                                <p>Quản lý danh mục</p>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlythetv">
                                <i class="fa fa-id-card-o"></i>
                                <p>Quản lý thẻ TV</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlykhachhang">
                                <i class="fa fa-id-card-o"></i>
                                <p>Quản lý Khách Hàng</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlythuetra">
                                <i class="fa fa-refresh"></i>
                                <p>Quản lý Trả Sân</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlydonhang">
                                <i class="fa fa-refresh"></i>
                                <p>Quản lý Đơn Hàng</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?baocao">
                                <i class="fa fa-refresh"></i>
                                <p>Báo cáo</p>
                            </a>
                        </li>
                    <?php elseif ($roleId == 2): // Nhân viên ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-home"></i>
                                <p>Phản hồi</p>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="indexAdmin.php?chatboxAdmin">Liên hệ khách hàng</a>
                            </div>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlysan">
                                <i class="nc-icon nc-notes"></i>
                                <p>Quản lý sân</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlydanhmuc">
                                <i class="nc-icon nc-notes"></i>
                                <p>Quản lý loại sân</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlythetv">
                                <i class="fa fa-id-card-o"></i>
                                <p>Quản lý thẻ TV</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlykhachhang">
                                <i class="fa fa-id-card-o"></i>
                                <p>Quản lý Khách Hàng</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlythuetra">
                                <i class="fa fa-refresh"></i>
                                <p>Quản lý Trả Sân</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlydonhang">
                                <i class="fa fa-refresh"></i>
                                <p>Quản lý Đơn Hàng</p>
                            </a>
                        </li>
                    <?php elseif ($roleId == 3): // Nhân viên bán hàng ?>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlythetv">
                                <i class="fa fa-id-card-o"></i>
                                <p>Quản lý thẻ TV</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlythuetra">
                                <i class="fa fa-refresh"></i>
                                <p>Quản lý Trả sách</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="indexAdmin.php?quanlydonhang">
                                <i class="fa fa-refresh"></i>
                                <p>Quản lý Đơn Hàng</p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="indexAdmin.php?logoutAdmin">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <!-- <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>
                </div>
            </div> -->