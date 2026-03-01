<?php
date_default_timezone_set('Asia/Ho_Chi_Minh'); // QUAN TRỌNG

$conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");
if (!$conn) {
    http_response_code(500);
    echo json_encode(["error" => "Kết nối CSDL thất bại"]);
    exit();
}

$date = $_GET['date'] ?? '';
$maSan = intval($_GET['maSan'] ?? 0);

if (!$date || $maSan <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "Thiếu thông tin ngày hoặc mã sân"]);
    exit();
}

$booked = [];
$query = "SELECT thoiGianThue FROM donthuesan 
          WHERE ngayThue = ? AND maSan = ? AND tinhTrangThue = 'Đang thuê'";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $date, $maSan);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $ranges = explode(',', $row['thoiGianThue']);
    foreach ($ranges as $range) {
        $parts = explode(' - ', trim($range));
        if (count($parts) === 2) {
            $booked[] = trim($parts[0]);
        }
    }
}
$stmt->close();

// Log thử cho debug
// error_log("Booked: " . json_encode($booked));

$slots = [];
$today = date('Y-m-d');
$currentHour = intval(date('H'));

for ($h = 7; $h < 24; $h++) {
    $start = sprintf('%02d:00', $h);
    $end = sprintf('%02d:00', $h + 1);

    // Ẩn giờ đã qua nếu hôm nay
    if ($date == $today && $h <= $currentHour) {
        continue;
    }

    // Ẩn giờ đã bị đặt
    if (in_array($start, $booked)) {
        continue;
    }

    $slots[] = [
        'label' => "$start - $end",
        'start' => $start
    ];
}

header('Content-Type: application/json');
echo json_encode($slots);