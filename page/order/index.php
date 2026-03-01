<?php
// Kết nối CSDL
$conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");

// Lấy mã sân từ URL
if (isset($_GET['maSan'])) {
    $maSan = intval($_GET['maSan']);
    $query = "SELECT 
                s.maSan, s.tenSan, s.giaThue, s.kichThuoc, s.hinhAnh 
              FROM san s
              WHERE s.maSan = $maSan
              LIMIT 1;";
    $result = $conn->query($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $san = mysqli_fetch_assoc($result);
    } else {
        echo "Không tìm thấy sân.";
        exit();
    }
} else {
    echo "Không có mã sân.";
    exit();
}
?>

<!doctype html>
<html lang="vi">
<head>
    <title>Đặt Sân</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Đặt sân: <?php echo htmlspecialchars($san['tenSan']); ?></h2>

    <div class="row">
        <div class="col-md-6">
            <img src="layout/images/<?php echo htmlspecialchars($san['hinhAnh']); ?>" 
                class="img-fluid mb-4" style="border-radius:10px;">
            <p><b>Kích thước:</b> <?php echo htmlspecialchars($san['kichThuoc']); ?></p>
            <p><b>Giá thuê:</b> <span class="text-success">
                <?php echo number_format($san['giaThue'], 0, '.', '.'); ?> VND/Giờ
            </span></p>
        </div>

        <div class="col-md-6">
            <form id="booking-form">
                <input type="hidden" name="maSan" value="<?php echo $san['maSan']; ?>">

                <div class="mb-3">
                    <label for="ngayThue">Thời gian:</label>
                    <input type="date" id="ngayThue" name="ngayThue" class="form-control" required min="<?= date('Y-m-d') ?>">
                </div>

                <a href="page/order/get_available_times.php" id="find-available-times" class="btn btn-success mb-3" style="border-radius:10px; text-decoration: none;">
                    <i class="bi bi-calendar-check"></i> Tìm giờ trống
                </a>

                <div id="available-times" class="mb-3">
                    <!-- Radio buttons giờ thuê sẽ hiện ở đây -->
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <span id="price-display" class="text-danger fw-bold"></span>
                    <button type="button" id="submit-button" class="btn btn-primary" style="border-radius:10px;" disabled>Đặt sân</button>
                </div>

                <!-- Hidden để gửi giờ thuê -->
                <input type="hidden" name="thoiGianThue" id="selected-time" required>

            </form>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>

<script>
// JavaScript phần dưới, giữ nguyên nhưng thêm e.preventDefault() để ngăn chuyển trang
$(document).ready(function() {
    $('#find-available-times').click(function(e) {
        e.preventDefault(); // ← Ngăn thẻ <a> chuyển trang

        const selectedDate = $('#ngayThue').val();
        const maSan = <?php echo $maSan; ?>;

        if (!selectedDate) {
            alert('Vui lòng chọn ngày trước!');
            return;
        }

        $.ajax({
            url: `page/order/get_available_times.php`,
            method: 'GET',
            data: { date: selectedDate, maSan: maSan },
            dataType: 'json',
            success: function(data) {
                let html = '';

                if (data.length > 0) {
                    data.forEach(function(slot) {
                        if (slot.booked) {
                            html += `
                                <div class="form-check text-muted">
                                    <input class="form-check-input" type="checkbox" disabled>
                                    <label class="form-check-label">
                                        ${slot.label} (Đang thuê)
                                    </label>
                                </div>
                            `;
                        } else {
                            html += `
                                <div class="form-check">
                                    <input class="form-check-input time-checkbox" type="checkbox" value="${slot.start}" id="time-${slot.start}">
                                    <label class="form-check-label" for="time-${slot.start}">
                                        ${slot.label}
                                    </label>
                                </div>
                            `;
                        }
                    });
                } else {
                    html = '<p>Không còn giờ trống.</p>';
                }

                $('#available-times').html(html);

                // Bắt sự kiện khi người dùng chọn giờ
                $('.time-checkbox').on('change', function () {
                    const selected = $('.time-checkbox:checked').map(function () {
                        return $(this).val();
                    }).get();

                    const pricePerSlot = <?php echo $san['giaThue']; ?>;
                    const total = selected.length * pricePerSlot;

                    $('#selected-time').val(selected.join(',')); // gửi lên dạng chuỗi: 07:00,08:00
                    $('#price-display').text(new Intl.NumberFormat().format(total) + ' VND');
                    $('#submit-button').prop('disabled', selected.length === 0);
                });
            },
            error: function() {
                $('#available-times').html('<p>Có lỗi xảy ra khi tải giờ trống.</p>');
            }
        });
    });
});
$('#submit-button').on('click', function () {
    const ngayThue = $('#ngayThue').val();
    const thoiGianThue = $('#selected-time').val();
    const maSan = <?php echo $maSan; ?>;

    if (!ngayThue || !thoiGianThue) {
        alert("Vui lòng chọn ngày và giờ thuê!");
        return;
    }

    // Chuyển hướng sang trang xác nhận hóa đơn
    const url = `index.php?checkout&maSan=${maSan}&ngayThue=${encodeURIComponent(ngayThue)}&thoiGianThue=${encodeURIComponent(thoiGianThue)}`;
    window.location.href = url;
});
</script>

</body>
</html>
