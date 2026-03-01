<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    .container-main {
        margin-top: 15px;
        margin-bottom: 20px;
    }

    .tnb {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .menu {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .menu ul {
        list-style-type: none;
        padding: 0;
    }

    .menu ul li {
        margin-bottom: 10px;
    }

    .menu ul li a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
    }

    .menu ul li a:hover {
        color: #007bff;
    }
</style>

<body>
    <?php
    if (!isset($_GET['change_password'])) {
        $change_password = 1;
    } else {
        $change_password = $_GET['change_password'];
    }
    ?>
    <div class="container container-main">
        <div class="row">
            <!-- Menu bên trái -->
            <div class="col-md-3">
                <div class="menu">
                    <ul>
                        <li><a href="index.php?personal_information">Thông tin cá nhân</a></li>
                        <li><a href="index.php?updateProfile">Cập nhật thông tin</a></li>
                        <li><a href="index.php?change_password">Đổi Mật khẩu </a></li>
                        <li><a href="index.php?history">Lịch sử thuê sân</a></li>
                        <li><a href="index.php?logout">Đăng Xuất</a></li>
                    </ul>
                </div>
            </div>

            <!-- Form đổi mật khẩu -->
            <div class="col-md-9">
                <div class="tnb">
                    <h2 class="mb-4">Đổi Mật Khẩu</h2>
                    <form method="POST" action="page/change_password/process_change_password.php">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu cũ</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                required placeholder="Nhập mật khẩu cũ">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required
                                placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_new_password" class="form-label">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirm_new_password"
                                name="confirm_new_password" required placeholder="Nhập lại mật khẩu mới">
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                        <a href="index.php" class="btn btn-secondary"> Quay về trang chủ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>