<?php
$conn = new mysqli('localhost', 'huy', '123456', 'cnmoi'); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tổng hợp số sân đã thuê, doanh thu, tổng số sân
$sql = "
SELECT 
    (SELECT COUNT(*) FROM donthuesan) AS soDonThue,
    (SELECT SUM(tongThanhTien) FROM donthuesan) AS tongDoanhThu,
    (SELECT COUNT(*) FROM san) AS tongSoSan
";

// Thống kê số lượng sân theo từng loại
$sql_san_theo_loai = "
SELECT l.tenLoai, COUNT(s.maSan) AS soLuongSan
FROM loaisan l
LEFT JOIN san s ON s.maLoai = l.maLoai
GROUP BY l.tenLoai
";

// Thống kê số đơn thuê theo từng loại sân
$sql_don_theo_loai = "
SELECT l.tenLoai, COUNT(d.maDon) AS soDonThue
FROM donthuesan d
JOIN san s ON d.maSan = s.maSan
JOIN loaisan l ON s.maLoai = l.maLoai
GROUP BY l.tenLoai
";

// Thực thi truy vấn chính
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $soDonThue = $row['soDonThue'];
    $tongDoanhThu = $row['tongDoanhThu'];
    $tongSoSan = $row['tongSoSan'];
} else {
    $soDonThue = $tongDoanhThu = $tongSoSan = 0;
}

// Truy vấn phụ
$loaiSan_result = $conn->query($sql_san_theo_loai);
$loaiSan = [];
while ($row = $loaiSan_result->fetch_assoc()) {
    $loaiSan[] = $row;
}

$donTheoLoai_result = $conn->query($sql_don_theo_loai);
$donTheoLoai = [];
while ($row = $donTheoLoai_result->fetch_assoc()) {
    $donTheoLoai[] = $row;
}
// Thống kê giờ cao điểm (giờ bắt đầu được thuê nhiều nhất)
$sql_gio_cao_diem = "
SELECT HOUR(STR_TO_DATE(SUBSTRING_INDEX(thoiGianThue, ' - ', 1), '%H:%i')) AS gio, COUNT(*) AS soLanThue
FROM donthuesan
GROUP BY gio
ORDER BY soLanThue DESC
LIMIT 5
";

// Thống kê phương thức thanh toán
$sql_pttt = "
SELECT phuongThucThanhToan AS phuongThuc, COUNT(*) AS soLan
FROM donthuesan
WHERE phuongThucThanhToan IS NOT NULL AND phuongThucThanhToan != ''
GROUP BY phuongThucThanhToan
";

// Giờ cao điểm
$gioCaoDiem_result = $conn->query($sql_gio_cao_diem);
$gioCaoDiem = [];
while ($row = $gioCaoDiem_result->fetch_assoc()) {
    $gioCaoDiem[] = [
        'gio' => $row['gio'] . 'h',
        'soLanThue' => $row['soLanThue']
    ];
}

// Phương thức thanh toán
$pttt_result = $conn->query($sql_pttt);
$pttt = [];
while ($row = $pttt_result->fetch_assoc()) {
    $pttt[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo</title>
    <link href="../layout/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 70%;  
            margin: 0 auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 2rem;
            color: #007bff;
            font-weight: bold;
        }

        .mb-4 {
            margin-bottom: 30px !important;
        }

        h4 {
            color: #343a40;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <!-- HTML hiển thị thống kê -->
<h1 class="text-center mb-4">Báo Cáo</h1>
<div class="row text-center mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tổng số sân</h5>
                <p class="card-text display-4"><?= $tongSoSan ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tổng lượt thuê</h5>
                <p class="card-text display-4"><?= $soDonThue ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tổng doanh thu</h5>
                <p class="card-text display-4"><?= number_format($tongDoanhThu, 0, ',', '.') ?> VND</p>
            </div>
        </div>
    </div>
</div>
<!-- Biểu đồ loại sân -->
<div class="row">
    <div class="col-md-6">
        <h4 class="text-center">Số lượng sân theo loại</h4>
        <canvas id="loaiSanChart"></canvas>
    </div>
    <div class="col-md-6">
        <h4 class="text-center">Số lượt thuê theo loại sân</h4>
        <canvas id="donTheoLoaiChart"></canvas>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-6">
        <h4 class="text-center">Giờ cao điểm được thuê nhiều nhất</h4>
        <canvas id="gioCaoDiemChart"></canvas>
    </div>
    <div class="col-md-6">
        <h4 class="text-center">Tỉ lệ phương thức thanh toán</h4>
        <canvas id="ptttChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const loaiSanLabels = <?= json_encode(array_column($loaiSan, 'tenLoai')) ?>;
    const loaiSanData = <?= json_encode(array_column($loaiSan, 'soLuongSan')) ?>;

    const donLoaiLabels = <?= json_encode(array_column($donTheoLoai, 'tenLoai')) ?>;
    const donLoaiData = <?= json_encode(array_column($donTheoLoai, 'soDonThue')) ?>;

    new Chart(document.getElementById('loaiSanChart'), {
        type: 'bar',
        data: {
            labels: loaiSanLabels,
            datasets: [{
                label: 'Số sân',
                data: loaiSanData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    new Chart(document.getElementById('donTheoLoaiChart'), {
        type: 'bar',
        data: {
            labels: donLoaiLabels,
            datasets: [{
                label: 'Lượt thuê',
                data: donLoaiData,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    const gioCaoDiemLabels = <?= json_encode(array_column($gioCaoDiem, 'gio')) ?>;
    const gioCaoDiemData = <?= json_encode(array_column($gioCaoDiem, 'soLanThue')) ?>;

    const ptttLabels = <?= json_encode(array_column($pttt, 'phuongThuc')) ?>;
    const ptttData = <?= json_encode(array_column($pttt, 'soLan')) ?>;

    new Chart(document.getElementById('gioCaoDiemChart'), {
        type: 'bar',
        data: {
            labels: gioCaoDiemLabels,
            datasets: [{
                label: 'Lượt thuê',
                data: gioCaoDiemData,
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    new Chart(document.getElementById('ptttChart'), {
        type: 'doughnut',
        data: {
            labels: ptttLabels,
            datasets: [{
                label: 'Phương thức thanh toán',
                data: ptttData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        }
    });
</script>

</div>
</body>
</html>
