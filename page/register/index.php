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
    <title>Page Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="layout/css/register.css">
</head>
<?php
if (!isset($_GET['register'])) {
    $register = 1;
} else {
    $register = $_GET['register'];
}
?>
<?php
// Đảm bảo BASE_PATH được định nghĩa
require_once 'myclass/user.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form đăng ký 
    $hoTen = trim($_POST['hoTen']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $sdt = trim($_POST['sdt']);
    $diachi = trim($_POST['diachi']);
    $agree = isset($_POST['agree']);

    $user = new User();
    $result = $user->register($hoTen, $email, $password, $confirmPassword, $sdt, $diachi, $agree);
    echo $result;
}
?>

<body>
    <!-- Start Register -->
    <div class="register-form-container">
        <div class="form-register">
            <form action="" method="post">
                <h1>Đăng Ký</h1>
                <div class="input-box">
                    <div class="input-field">
                        <input type="text" name="hoTen" placeholder="Họ và tên" id="hoTen" required>
                        <i class='bx bxs-user'></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" id="email" required>
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <div class="input-field">
                        <input type="tel" name="sdt" placeholder="Số điện thoại" id="sdt" required>
                        <i class='bx bxs-phone'></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password" id="password" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="confirmPassword" placeholder="Xác nhận Password"
                            id="confirmPassword" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                </div>
                <a href="index.php?services" target="_blank" rel="noopener noreferrer">Chính sách và điều khoản của
                    chúng tôi</a>
                <label><input type="checkbox" name="agree">Tôi đã đọc và đồng ý với các chính sách.</label>
                <button type="submit" class="btn" name="btn-regis">Đăng ký</button>
            </form>
        </div>
    </div>
    <!-- End Register -->
    <script src="layout/js/register.js"></script>
</body>

</html>