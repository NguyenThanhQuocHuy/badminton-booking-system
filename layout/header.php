<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<style>
        /* CSS for Hover Dropdown */
        #avatarIcon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            object-fit: cover; /* Đảm bảo ảnh không bị méo nếu tỉ lệ không đều */
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu {
            display: block;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            min-width: 200px;
            padding: 0;
        }

        .dropdown-item {
            padding: 10px;
            color: brown;
            text-decoration: none;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        #sanPham {
            cursor: pointer;
        }

        .nav-item.dropdown:hover .dropdown-menusp {
            display: block;
        }

        .dropdown-menusp {
            display: none;
            position: absolute;
            right: -75px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            min-width: 250px;
            z-index: 1000;
            color: brown !important;
        }

        .dropdown-menu a.dropdown-item {
            padding: 12px 16px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s;
        }

        .dropdown-menu a.dropdown-item:hover {
            background-color: #f0f0f0;
            color: #007bff;
        }
        .dropdown-itemsp {
            padding: 10px;
            color: brown !important;
            text-decoration: none;
            display: block;
        }

        .dropdown-itemsp:hover {
            background-color: #f1f1f1;
        }



        /* Style cho menu thông báo */
        #notificationMenu {

            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            min-width: 350px;

        }

        /* Hiển thị menu khi hover */
        .nav-item.dropdown:hover #notificationMenu {
            display: block;
        }

        /* Tiêu đề thông báo */
        #notificationMenu b {
            font-size: 16px;
            color: #333;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            display: block;
            font-weight: 600;
        }

        /* Mục thông báo */
        #notificationMenu .dropdown-item {
            padding: 15px;
            color: #555;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        /* Biểu tượng đơn hàng */
        #notificationMenu .dropdown-item::before {
            content: '\f291';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 18px;
            color: #0d6efd;
            /* Màu cam nhấn */
        }

        /* Hover cho mục thông báo */
        #notificationMenu .dropdown-item:hover {
            background-color: #f9f9f9;
            color: #000;
        }

        /* Thông báo trống */
        #notificationMenu p {
            padding: 15px;
            color: #888;
            font-style: italic;
            text-align: center;
        }
    </style>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="layout/images/logo_phu.png" type="image/png">
      <title>Câu lạc bộ cầu lông SmashBooking</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="layout/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="layout/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="layout/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="layout/css/responsive.css" rel="stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="index.php?home"><img width="250" src="layout/images/logo_chinh1.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <!--<li class="nav-item active">
                           <a class="nav-link" href="index.php?trangchu">Trang chủ <span class="sr-only">(current)</span></a>
                        </li>-->
                       <!--<li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li class="nav-item"><a href="index.php?about">About</a></li>
                              <li class="nav-item"><a href="index.php?testimonial">Testimonial</a></li>
                           </ul>
                        </li>-->
                        <!--<li class="nav-item">
                           <a class="nav-link" href="index.php?gioithieu">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?chinhsach">Chính sách</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?product">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?blog_list">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?contact">Contact</a>
                        </li>-->
                        <!---->
                        <?php
                           $currentPage = $_GET ? array_key_first($_GET) : 'home';
                        ?>

                        <li class="nav-item <?php echo ($currentPage == 'home') ? 'active' : ''; ?>">
                           <a class="nav-link" href="index.php?home">Trang chủ</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'about') ? 'active' : ''; ?>">
                           <a class="nav-link" href="index.php?about">Giới thiệu</a>
                        </li>
                        <li class="nav-item dropdown <?php echo ($currentPage == 'product') ? 'active' : ''; ?>">
                           <a class="nav-link" href="index.php?product=1">Sản phẩm</a>
                           <div id="userMenuSP" class="dropdown-menusp">
                            <?php
                            $conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");
                            if ($conn) {
                                $str = "SELECT *FROM loaisan";
                                $result = $conn->query($str);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<a href='index.php?cate={$row['maLoai']}' class='dropdown-itemsp'>"
                                            . "{$row['tenLoai']}"
                                            . "</a>";
                                    }
                                }
                            }
                            ?>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'policy') ? 'active' : ''; ?>">
                           <a class="nav-link" href="index.php?policy">Chính sách</a>
                        </li>
                        <!--<li class="nav-item <?php //echo ($currentPage == 'contact') ? 'active' : ''; ?>">
                           <a class="nav-link" href="index.php?contact">Contact</a>
                        </li>-->
                        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-2"
                           style="font-weight: 500 !important; font-size: large">
                           <?php
                            if (!isset($_SESSION['maNguoiDung'])) {
                                // Nếu chưa đăng nhập
                                echo "
                                <li class='nav-item'><a class='nav-link' href='index.php?register'>Đăng ký</a></li>
                                <li class='nav-item'><a class='nav-link' href='index.php?login'>Đăng nhập</a></li>
                                ";
                            } else {
                                // Nếu đã đăng nhập
                                echo "
                                <li class='nav-item dropdown'>
                                    <a class='nav-link' href='#'>
                                        <img src='layout/images/user-icon.webp' id='avatarIcon' alt='User Icon'>
                                    </a>
                                    <div id='userMenu' class='dropdown-menu'>
                                        <a class='dropdown-item' href='index.php?personal_information'>Thông tin cá nhân</a>
                                        <a class='dropdown-item' href='index.php?updateProfile'>Cập nhật thông tin</a>
                                        <a class='dropdown-item' href='index.php?change_password'>Đổi mật khẩu</a>
                                        <a class='dropdown-item' href='index.php?history'>Xem lịch sử thuê sân</a>
                                        <a class='dropdown-item' href='index.php?checkout'>Thanh toán</a>
                                        <a class='dropdown-item' href='index.php?logout'>Đăng xuất</a>
                                    </div>
                                </li>
                                <li class='nav-item'><a class='nav-link' href='index.php?home'><img id='avatarIcon' src='layout/images/chuong.png'></a></li>
                                ";
                            }
                            ?>

                        </ul>
                        <!---->
                     </ul>
                  </div>
               </nav>
            </div>
         </header>
</body>
 <!-- jQery -->
 <script src="js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="js/custom.js"></script>