<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Thông Tin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<style>
    .container-main {
        margin-top: 15px;
        margin-bottom: 20px;
    }

    .tnb, .menu {
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
        if (!isset($_GET['updateProfile'])) {
            $updateProfile = 1;
        } else {
            $updateProfile = $_GET['updateProfile'];
        }
    ?>
    <?php

    if (!isset($_SESSION['maNguoiDung'])) {
        echo "<div class='alert alert-danger'>Bạn chưa đăng nhập. Vui lòng đăng nhập để xem thông tin cá nhân.</div>";
        exit();
    }

    $maNguoiDung = $_SESSION['maNguoiDung'];

    // Xử lý khi submit cập nhật
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ten = $_POST['ten'] ?? '';
        $email = $_POST['email'] ?? '';
        $sdt = $_POST['sdt'] ?? '';
        $diachi = $_POST['diachi'] ?? '';

        $query = "UPDATE nguoidung SET ten = ?, email = ?, sdt = ?, diachi = ? WHERE maNguoiDung = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $ten, $email, $sdt, $diachi, $maNguoiDung);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật thông tin thành công'); window.location.href='index.php?personal_information';</script>";
            exit();
        } else {
            echo "<div class='alert alert-danger'>Lỗi khi cập nhật: " . $conn->error . "</div>";
        }
    }

    // Truy vấn lấy thông tin hiện tại
    $query = "SELECT ten, email, sdt, diachi FROM nguoidung WHERE maNguoiDung = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $maNguoiDung);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
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

            <!-- Form cập nhật thông tin -->
            <div class="col-md-9">
                <div class="tnb">
                    <h2 class="mb-4">Cập Nhật Thông Tin</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="ten">Họ và tên:</label>
                            <input type="text" class="form-control" name="ten" value="<?= htmlspecialchars($row['ten'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại:</label>
                            <input type="text" class="form-control" name="sdt" value="<?= htmlspecialchars($row['sdt'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ:</label>
                            <input type="text" class="form-control" name="diachi" value="<?= htmlspecialchars($row['diachi'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="index.php?personal_information" class="btn btn-secondary">Huỷ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
