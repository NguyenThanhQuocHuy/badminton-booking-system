<?php
// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
session_start();
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header("Location: index.php?login");
    exit();
}
$email = $_SESSION['user'];
$conn = mysqli_connect("localhost", "nhomptud", "123456", "ptud");
if ($conn) {
    $query = "
        SELECT taikhoan.email, nguoidung.ten, nguoidung.diaChi, nguoidung.SDT
        FROM taikhoan
        INNER JOIN nguoidung ON taikhoan.maNguoiDung = nguoidung.maNguoiDung
        WHERE taikhoan.email = '$email'
    ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Không tìm thấy thông tin người dùng!');</script>";
        header("Location: index.php?login");
        exit();
    }
} else {
    echo "<script>alert('Kết nối cơ sở dữ liệu thất bại!');</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <link href="../layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="../layout/css/style.css" rel="stylesheet">
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

            padding: 10px;
            margin-left: -10px;
            /* border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
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

        #accountLinks {
            margin-top: 10px;
            /* display: none;  */
        }
    </style>
</head>

<body>

    <div class="container container-main">
        <div class="row">
            <!-- Menu bên trái -->
            <div class="col-md-2">
                <div class="menu">
                    <ul>
                        <li>
                            <a href="#" id="accountToggle">Tài khoản của tôi</a>
                            <ul id="accountLinks" style="display: none;">
                                <li><a href="index.php?updateProfile">Cập nhật thông tin</a></li>
                                <li><a href="index.php?change_password">Đổi mật khẩu</a></li>
                                <li><a href="index.php?history&maNguoiDung=<?php echo $_SESSION['maNguoiDung']; ?>">Lịch sử thuê sách</a></li>
                                <li><a href="index.php?logout">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Hiển thị thông tin cá nhân -->
            <div class="col-md-10">
                <div class="tnb">
                    <h2 class="mb-4">Thông Tin Cá Nhân</h2>
                    <table class="table table-bordered">
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Họ tên</th>
                            <td><?php echo htmlspecialchars($user['ten'] ?? 'Chưa cập nhật'); ?></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td><?php echo htmlspecialchars($user['diaChi'] ?? 'Chưa cập nhật'); ?></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td><?php echo htmlspecialchars($user['SDT'] ?? 'Chưa cập nhật'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('accountToggle').addEventListener('click', function () {
            var links = document.getElementById('accountLinks');
            if (links.style.display === "none" || links.style.display === "") {
                links.style.display = "block"; // Hiển thị các đường link
            } else {
                links.style.display = "none"; // Ẩn các đường link
            }
        });
    </script>

</body>

</html>