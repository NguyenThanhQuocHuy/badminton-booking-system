<?php
if (!isset($_GET['history'])) {
    $history = 1;
} else {
    $history = $_GET['history'];
}

if (!isset($_SESSION['maNguoiDung'])) {
    header("Location: index.php?login");
    exit();
}

$conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy maNguoiDung từ session
$maNguoiDung = $_SESSION['maNguoiDung'];

// Tìm maKH tương ứng trong bảng khachhang
$queryKH = "SELECT maKH FROM khachhang WHERE maNguoiDung = '$maNguoiDung'";
$resultKH = mysqli_query($conn, $queryKH);
$rowKH = mysqli_fetch_assoc($resultKH);

// Nếu tìm được maKH
if ($rowKH) {
    $maKH = $rowKH['maKH'];

    // Truy vấn lịch sử thuê sân
    $query = "SELECT * FROM donthuesan WHERE maKH = '$maKH' ORDER BY maDon ASC";
    $result = mysqli_query($conn, $query);
} else {
    $result = false;
}


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử thuê sân</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .container-main {
            margin-top: 20px;
            margin-bottom: 30px;
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

        .tnb {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            vertical-align: middle;
        }

        .text-muted {
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container container-main">
        <div class="row">
            <!-- Menu bên trái -->
            <div class="col-md-3">
                <div class="menu">
                    <ul>
                        <li><a href="index.php?personal_information">Thông tin cá nhân</a></li>
                        <li><a href="index.php?updateProfile">Cập nhật thông tin</a></li>
                        <li><a href="index.php?change_password">Đổi mật khẩu</a></li>
                        <li><a href="index.php?history">Lịch sử thuê sân</a></li>
                        <li><a href="index.php?logout">Đăng Xuất</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung lịch sử -->
            <div class="col-md-9">
                <div class="tnb">
                    <h2 class="mb-4">Lịch sử thuê sân</h2>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Mã Đơn</th>
                                        <th>Ngày Thuê</th>
                                        <th>Giờ Thuê</th>
                                        <th>Trạng Thái Thanh Toán</th>
                                        <th>Phương Thức</th>
                                        <th>Tổng Thành Tiền</th>
                                        <th>Trạng Thái Thuê</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><a href="index.php?history&maDon=<?= $row['maDon'] ?>"><?= $row['maDon'] ?></a></td>
                                            <td><?= date('d/m/Y', strtotime($row['ngayThue'])) ?></td>
                                            <td><?= $row['thoiGianThue'] ?></td>
                                            <td><?= $row['tinhTrangThanhToan'] ?></td>
                                            <td><?= $row['phuongThucThanhToan'] ?? "<span class='text-muted'>Chưa có</span>" ?></td>
                                            <td><?= number_format($row['tongThanhTien'], 0, ',', '.') ?> đ</td>
                                            <td><?= $row['tinhTrangThue'] ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Bạn chưa có đơn thuê sân nào.</p>
                    <?php endif; ?>
                </div>
                <?php
                if (isset($_GET['maDon'])) {
                    $maDon = intval($_GET['maDon']);
                    $queryDetail = "SELECT d.*, s.tenSan, kh.maKH, kh.maThe, km.phanTramKM 
                                    FROM donthuesan d
                                    JOIN san s ON d.maSan = s.maSan
                                    LEFT JOIN khachhang kh ON d.maKH = kh.maKH
                                    LEFT JOIN khuyenmai km ON d.maKM = km.maKM
                                    WHERE d.maDon = $maDon AND d.maKH = '$maKH'";
                    $resultDetail = mysqli_query($conn, $queryDetail);

                    if ($resultDetail && mysqli_num_rows($resultDetail) > 0) {
                        $hd = mysqli_fetch_assoc($resultDetail);
                        $gioThueArr = explode(',', $hd['thoiGianThue']);
                        $soGio = count($gioThueArr);
                        ?>
                        <div class="card mt-4 position-relative">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Hóa đơn thuê sân #<?= $hd['maDon'] ?></h5>
                                <a href="index.php?history" class="btn-close btn-close-white" aria-label="Đóng">X</a>
                            </div>
                            <div class="card-body">
                                <p><strong>Ngày thuê:</strong> <?= date('d/m/Y', strtotime($hd['ngayThue'])) ?></p>
                                <p><strong>Sân:</strong> <?= $hd['tenSan'] ?></p>
                                <p><strong>Khung giờ:</strong> <?= $hd['thoiGianThue'] ?></p>
                                <p><strong>Giá mỗi giờ:</strong> <?= number_format($hd['giaMoiGio'], 0, ',', '.') ?> đ</p>
                                <p><strong>Tình trạng thuê:</strong> <?= $hd['tinhTrangThue'] ?></p>

                                <hr>
                                <h6>Chi tiết thanh toán:</h6>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Số giờ</th>
                                        <td><?= $soGio ?> giờ</td>
                                    </tr>
                                    <tr>
                                        <th>Tiền gốc</th>
                                        <td><?= number_format($hd['tongTienGoc'], 0, ',', '.') ?> đ</td>
                                    </tr>
                                    <tr>
                                        <th>Giảm thẻ thành viên</th>
                                        <td>-<?= number_format($hd['giamThanhVien'], 0, ',', '.') ?> đ</td>
                                    </tr>
                                    <tr>
                                        <th>Giảm khuyến mãi</th>
                                        <td>-<?= number_format($hd['giamKhuyenMai'], 0, ',', '.') ?> đ</td>
                                    </tr>
                                    <tr class="table-success">
                                        <th>Tổng thanh toán</th>
                                        <td><strong><?= number_format($hd['tongThanhTien'], 0, ',', '.') ?> đ</strong></td>
                                    </tr>
                                </table>

                                <p><strong>Mã xác nhận:</strong> <code><?= $hd['code'] ?></code></p>
                                <p><strong>Trạng thái thanh toán:</strong> <?= $hd['tinhTrangThanhToan'] ?></p>
                                <p><strong>Phương thức:</strong> <?= $hd['phuongThucThanhToan'] ?: 'Chưa có' ?></p>
                                <?php if ($hd['hinhAnhThanhToan']): ?>
                                    <p><strong>Hình ảnh thanh toán:</strong><br>
                                        <img src="layout/images/uploads/<?= $hd['hinhAnhThanhToan'] ?>" alt="Thanh toán" style="max-width: 300px;">
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<div class='alert alert-warning mt-3'>Không tìm thấy hóa đơn.</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>