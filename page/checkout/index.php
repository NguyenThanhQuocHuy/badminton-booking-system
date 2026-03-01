<?php
session_start(); // ✅ PHẢI CÓ TRƯỚC MỌI OUTPUT
if (!isset($_GET['checkout'])) {
    $checkout = 1;
} else {
    $checkout = $_GET['checkout'];
}
$conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");
if (!$conn) {
    die("Lỗi kết nối CSDL: " . mysqli_connect_error());
}
// ✅ Khi người dùng xác nhận thanh toán
if (isset($_POST['xacnhan'])) {
    $maSan = $_POST['maSan'];
    $ngayThue = $_POST['ngayThue'];
    $thoiGianThue = $_POST['thoiGianThue'];
    $tongTienGoc = $_POST['tienThue'];
    $tongThanhTien = $_POST['tongTien'];
    $maKH = $_POST['maKH'];
    $code = $_POST['code'];
    $maThe = !empty($_POST['maThe']) ? $_POST['maThe'] : null;
    $maKM = !empty($_POST['maKM']) ? $_POST['maKM'] : null;

    // Tính các giá trị cần thiết
    $gioArr = explode(',', $thoiGianThue);
    $giaMoiGio = $tongTienGoc / count($gioArr);
    $giamThanhVien = $maThe ? ($tongTienGoc * 0.5) : 0;
    $giamKhuyenMai = $maKM ? ($tongTienGoc - $giamThanhVien - $tongThanhTien) : 0;

    // Không có ảnh thanh toán vì chưa upload nên để NULL
    $hinhAnhThanhToan = null;


        $_SESSION['checkout_data'] = [
            'maSan' => $maSan,
            'ngayThue' => $ngayThue,
            'thoiGianThue' => $thoiGianThue,
            'giaMoiGio' => $giaMoiGio,
            'tongTienGoc' => $tongTienGoc,
            'giamThanhVien' => $giamThanhVien,
            'giamKhuyenMai' => $giamKhuyenMai,
            'tongThanhTien' => $tongThanhTien,
            'code' => $code,
            'maKH' => $maKH,
            'maThe' => $maThe,
            'maKM' => $maKM,
        ];
        header("Location: index.php?payment");
        exit();
}

// Sinh mã code 6 ký tự ngẫu nhiên: chỉ gồm chữ và số
function taoMaCode($length = 6) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $code;
}

$code = taoMaCode(); // tạo code 6 ký tự ngẫu nhiên, ví dụ: "A7D3X9"

function layMaKhachHang($conn, $maNguoiDung) {
    $query = "SELECT maKH, maThe FROM khachhang WHERE maNguoiDung = $maNguoiDung LIMIT 1;";
    $result = $conn->query($query);
    return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
}

function layTatCaKhuyenMai($conn) {
    $query = "SELECT maKM, tenKM, phanTramKM FROM khuyenmai ORDER BY maKM DESC;";
    $result = $conn->query($query);
    $ds = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ds[] = $row;
        }
    }
    return $ds;
}

if (isset($_GET['checkout'])) {
    // Lấy dữ liệu từ URL
    $maSan = intval($_GET['maSan']);
    $ngayThue = $_GET['ngayThue'];
    $gioThueArr = explode(',', $_GET['thoiGianThue']);
    sort($gioThueArr); // Sắp xếp tăng dần

    // Tính thời gian thuê dạng "HH:00 - HH+1:00"
    $thoiGianThue = [];
    foreach ($gioThueArr as $start) {
        $endHour = (int)substr($start, 0, 2) + 1;
        $end = str_pad($endHour, 2, '0', STR_PAD_LEFT) . ":00";
        $thoiGianThue[] = "$start - $end";
    }
    $thoiGianThueText = implode(', ', $thoiGianThue);
    $soLuong = count($gioThueArr);

    // Lấy thông tin sân
    $query = "SELECT tenSan, giaThue FROM san WHERE maSan = $maSan LIMIT 1;";
    $result = $conn->query($query);
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Không tìm thấy sân.";
        exit();
    }
    $san = mysqli_fetch_assoc($result);

    // Lấy người dùng
    $maNguoiDung = $_SESSION['maNguoiDung'];
    $khachHang = layMaKhachHang($conn, $maNguoiDung);
    $maKH = $khachHang['maKH'];
    $maThe = $khachHang['maThe'] ?? null;

    $khuyenMais = layTatCaKhuyenMai($conn);

    $giaGoc = $soLuong * $san['giaThue'];
    $giamThe = $maThe ? 0.5 : 1;
    $giaSauThe = $giaGoc * $giamThe;
?>
<div class="container mt-5">
    <h2>Xác nhận đặt sân</h2>
    <p><strong>Sân:</strong> <?= $san['tenSan'] ?></p>
    <p><strong>Ngày thuê:</strong> <?= $ngayThue ?></p>
    <p><strong>Giờ thuê:</strong> <?= $thoiGianThueText ?></p>
    <p><strong>Giá mỗi giờ:</strong> <?= number_format($san['giaThue'], 0, '.', '.') ?> VND</p>
    <p><strong>Tổng tiền gốc:</strong> <?= number_format($giaGoc, 0, '.', '.') ?> VND</p>

    <form method="post">
        <input type="hidden" name="maSan" value="<?= $maSan ?>">
        <input type="hidden" name="ngayThue" value="<?= $ngayThue ?>">
        <input type="hidden" name="thoiGianThue" value="<?= $thoiGianThueText ?>">
        <input type="hidden" name="tienThue" value="<?= $giaGoc ?>">
        <input type="hidden" name="maKH" value="<?= $maKH ?>">
        <input type="hidden" name="maThe" value="<?= $maThe ?>">
        <input type="hidden" name="code" value="<?= $code ?>">

        <label for="maKM"><strong>Chọn khuyến mãi:</strong></label>
        <select name="maKM" class="form-select mb-3">
            <option value="">Không áp dụng</option>
            <?php foreach ($khuyenMais as $km): ?>
                <option value="<?= $km['maKM'] ?>" data-pt="<?= $km['phanTramKM'] ?>">
                    <?= $km['tenKM'] ?> (<?= $km['phanTramKM'] ?>%)
                </option>
            <?php endforeach; ?>
        </select>

        <p><strong>Ưu đãi thành viên:</strong> <?= $maThe ? "Có (giảm 50%)" : "Không" ?></p>
        <?php if ($maThe): ?>
            <p><strong>Tiền giảm từ thành viên:</strong> <?= number_format($giaGoc * 0.5, 0, '.', '.') ?> VND</p>
        <?php endif; ?>
        <p><strong>Tiền giảm từ khuyến mãi:</strong> <span id="giamKM">0</span> VND</p>
        <p><strong>Tổng thành tiền:</strong> <span class="text-danger fw-bold" id="tongTien"><?= number_format($giaSauThe, 0, '.', '.') ?> VND</span></p>

        <input type="hidden" name="tongTien" value="<?= $giaSauThe ?>">

        <button class="btn btn-primary" name="xacnhan">Xác nhận thanh toán</button>
    </form>
</div>

<script>
    const selectKM = document.querySelector('select[name="maKM"]');
    const form = document.querySelector('form');
    const spanTong = document.getElementById('tongTien');
    const spanGiamKM = document.getElementById('giamKM');
    const giaGoc = <?= $giaGoc ?>;
    const giamThe = <?= $giamThe ?>;

    function updateTongTien() {
        const selected = selectKM.options[selectKM.selectedIndex];
        const pt = parseInt(selected.getAttribute('data-pt')) || 0;
        const giaSauThe = giaGoc * giamThe;
        const giamKM = giaSauThe * pt / 100;
        const tongCuoi = giaSauThe - giamKM;

        spanGiamKM.innerText = Math.round(giamKM).toLocaleString('vi-VN');
        spanTong.innerText = Math.round(tongCuoi).toLocaleString('vi-VN') + " VND";
        form.querySelector('input[name="tongTien"]').value = Math.round(tongCuoi);
    }

    selectKM.addEventListener('change', updateTongTien);
</script>
<?php
}

?>