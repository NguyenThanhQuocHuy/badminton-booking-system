<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
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
        if (!isset($_GET['personal_information'])) {
            $personal_information = 1;
        } else {
            $personal_information = $_GET['personal_information'];
        }
    ?>
    <?php
    session_start();
    include("mylass/connect.php"); // Kết nối đến CSDL

    if (!isset($_SESSION['maNguoiDung'])) {
        echo "<div class='alert alert-danger'>Bạn chưa đăng nhập. Vui lòng đăng nhập để xem thông tin cá nhân.</div>";
        exit();
    }

    $maNguoiDung = $_SESSION['maNguoiDung'];

    // Truy vấn lấy thông tin cá nhân
    $query = "SELECT nd.ten, nd.email, nd.sdt, nd.diachi, kh.maThe 
              FROM nguoidung nd 
              JOIN khachhang kh ON nd.maNguoiDung = kh.maNguoiDung 
              WHERE nd.maNguoiDung = ?";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $maNguoiDung);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Không tìm thấy thông tin người dùng.</div>";
        exit();
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

            <!-- Thông tin cá nhân -->
            <div class="col-md-9">
                <div class="tnb">
                    <h2 class="mb-4">Thông Tin Cá Nhân</h2>
                    <p><strong>Họ và tên:</strong> <?= htmlspecialchars($row['ten'] ?? '') !== '' ? htmlspecialchars($row['ten']) : 'chưa có' ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($row['email'] ?? '') !== '' ? htmlspecialchars($row['email']) : 'chưa có' ?></p>
                    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($row['sdt'] ?? '') !== '' ? htmlspecialchars($row['sdt']) : 'chưa có' ?></p>
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($row['diachi'] ?? '') !== '' ? htmlspecialchars($row['diachi']) : 'chưa có' ?></p>
                    <p><strong>Mã thẻ thành viên:</strong> <?= htmlspecialchars($row['maThe'] ?? '') !== '' ? htmlspecialchars($row['maThe']) : 'chưa có' ?></p>
                    <a href="index.php" class="btn btn-secondary">Quay về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
