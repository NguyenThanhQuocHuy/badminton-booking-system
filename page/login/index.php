<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="layout/css/login.css">


</head>
<?php
if (!isset($_GET['login'])) {
    $login = 1;
} else {
    $login = $_GET['login'];
}
?>
<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");

if (isset($_POST['btnLogin'])) {
    // Lấy email và password từ form
    $email = $_POST['CustomerEmail'];
    $password = md5($_POST['CustomerPassword']);

    // Kiểm tra thông tin đăng nhập trong bảng 'taikhoan'
    $query = "SELECT * FROM taikhoan WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result); // Lấy thông tin người dùng từ bảng 'taikhoan'
        $maNguoiDung = $user['maNguoiDung']; // Lấy maNguoiDung từ tài khoản

        // Lưu trạng thái đăng nhập vào session
        $_SESSION['btnLogin'] = 1;
        $_SESSION['user'] = $email;
        $_SESSION['maNguoiDung'] = $maNguoiDung; // Lưu maNguoiDung vào session

        // Chuyển hướng đến trang home/index.php
        echo '<script>
            alert("Đăng nhập thành công");
            window.location.href = "index.php?home"; // Chuyển hướng đến trang home
          </script>';
    } else {
        echo '<script>
            alert("Sai email hoặc mật khẩu");
          </script>';
    }
}
// Đóng kết nối sau khi hoàn tất công việc
mysqli_close($conn);
?>

<!-- Start Login -->
<div class="login-form-container">
    <div class="form-login">
        <form method="post" action="" id="customer_login" accept-charset="UTF-8" data-login-with-shop-sign-in="true"
            novalidate="novalidate">
            <h1 class="title-login"> Đăng nhập </h1>
            <div class="field">
                <input type="email" name="CustomerEmail" class="form-control" id="CustomerEmail" autocomplete="email"
                    autocorrect="off" autocapitalize="off" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="field">
                <input type="password" value="" name="CustomerPassword" class="form-control" id="CustomerPassword"
                    autocomplete="current-password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="checkbox">
                <label><input type="checkbox">Ghi nhớ tôi</label>
                <a href="#recover"> Quên mật khẩu? </a>
            </div>
            <button type="submit" name="btnLogin" class="btn"> Đăng nhập </button>
            <div class="register-link">
                <p>Chưa có tài khoản?<a href="index.php?register"> Đăng ký </a></p>
            </div>
        </form>
    </div>
</div>
<!-- End Login -->




</body>

</html>