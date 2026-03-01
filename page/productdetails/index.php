<?php
// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");

// Lấy maSan từ URL
if (isset($_GET['productdetails'])) {
    $maSan = intval($_GET['productdetails']);
    // Truy vấn thông tin chi tiết của sản phẩm dựa trên maSan
    $query = "SELECT 
                l.maLoai, l.tenLoai, l.moTa AS moTaLoai,
                s.maSan, s.tenSan, s.giaThue, s.moTa AS moTaSan, 
                s.kichThuoc, s.tinhTrang, s.hinhAnh, s.maLoai
              FROM san s
              JOIN loaisan l ON s.maLoai = l.maLoai
              WHERE s.maSan = $maSan
              LIMIT 1;";
    $result = $conn->query($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Sản phẩm không tồn tại.";
        exit();
    }
} else {
    echo "Không tìm thấy mã sản phẩm.";
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Chi tiết sân</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="intro-excerpt">
                    <h1><?php echo htmlspecialchars($product['tenLoai']); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-5 mb-md-0">
                <div class="p-2 p-lg-4 border bg-white">
                    <img src="layout/images/<?php echo htmlspecialchars($product['hinhAnh']); ?>"
                        style="width: 100%; height: auto;" class="img-fluid product-thumbnail">
                    
                    <div class="row mt-4">
                        <div class="col-md-6 text-center mb-2">
                            <button class="btn btn-secondary" onclick="window.location='index.php?product'"
                                style="border-radius: 10px;">Quay về</button>
                        </div>
                        <div class="col-md-6 text-center mb-2">
                            <?php if (isset($_SESSION['maNguoiDung'])): ?>
                                <button class="btn btn-success" onclick="window.location='index.php?order&maSan=<?php echo $product['maSan']; ?>'"
                                    style="border-radius: 10px;">Đặt Sân</button>
                            <?php else: ?>
                                <button class="btn btn-success" onclick="window.location='index.php?login'"
                                    style="border-radius: 10px;">Đăng nhập để đặt sân</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="p-2 p-lg-4 border bg-white">
                    <h2>Thông tin sân</h2>
                    <p><b>Số hiệu sân:</b> <?php echo htmlspecialchars($product['tenSan']); ?></p>
                    <p><b>Kích thước:</b> <?php echo htmlspecialchars($product['kichThuoc']); ?></p>
                    <p><b>Tình trạng:</b> <?php echo htmlspecialchars($product['tinhTrang']); ?></p>
                    <h4 class="text-success">Giá thuê: 
                        <b><?php echo number_format($product['giaThue'], 0, '.', '.'); ?> VND</b>
                    </h4>
                </div>
                <div class="p-2 p-lg-4 border bg-white mt-2">
                    <h3>Mô tả sân</h3>
                    <p style="text-align: justify;"><?php echo nl2br(htmlspecialchars($product['moTaSan'])); ?></p>

                    <h3>Mô tả loại sân</h3>
                    <p style="text-align: justify;"><?php echo nl2br(htmlspecialchars($product['moTaLoai'])); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
