-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 28, 2025 lúc 03:27 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cnmoi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chinhsach`
--

CREATE TABLE `chinhsach` (
  `maChinhSach` int(10) NOT NULL,
  `ten` varchar(250) NOT NULL,
  `noiDung` text NOT NULL,
  `hinhAnh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chinhsach`
--

INSERT INTO `chinhsach` (`maChinhSach`, `ten`, `noiDung`, `hinhAnh`) VALUES
(1, 'Các Nguyên Tắc Sử Dụng Sân Cầu Lông', '1. Thời gian thuê và thanh toán\r\n•	Người thuê phải đặt lịch trước qua điện thoại, trực tiếp hoặc hệ thống đặt sân online (nếu có).\r\n•	Thanh toán được thực hiện trước khi vào sân, bằng tiền mặt hoặc chuyển khoản.\r\n•	Trường hợp hủy sân, cần báo trước ít nhất 2 giờ để được hoàn tiền hoặc đổi lịch.\r\n________________________________________\r\n2. Trang phục và dụng cụ\r\n•	Người chơi phải mang giày thể thao đế bằng (non-marking) để tránh làm hỏng mặt sân.\r\n•	Mặc trang phục thể thao gọn gàng, lịch sự, phù hợp với hoạt động thể thao.\r\n•	Người chơi tự chuẩn bị vợt và cầu lông. Trung tâm chỉ hỗ trợ cho thuê nếu có yêu cầu trước.\r\n________________________________________\r\n3. An toàn và trật tự\r\n•	Không hút thuốc, không mang thức ăn, đồ uống có ga vào khu vực sân.\r\n•	Tránh nói to, la hét hoặc có hành vi gây mất trật tự, ảnh hưởng đến người khác.\r\n•	Nếu xảy ra chấn thương, báo ngay cho nhân viên trực sân để được hỗ trợ kịp thời.\r\n________________________________________\r\n4. Ý thức giữ gìn và bảo vệ tài sản chung\r\n•	Không xả rác bừa bãi. Rác phải được bỏ đúng nơi quy định.\r\n•	Tuyệt đối không tác động mạnh lên tường, trần, lưới hoặc hệ thống đèn chiếu sáng.\r\n•	Nếu làm hư hỏng cơ sở vật chất, người gây ra có trách nhiệm bồi thường theo quy định.\r\n________________________________________\r\n5. Tôn trọng và công bằng\r\n•	Không chiếm sân khi đã hết giờ. Hãy rời sân đúng thời gian để người khác sử dụng.\r\n•	Tôn trọng đối thủ, trọng tài (nếu có) và tất cả người chơi khác.\r\n•	Nếu có tranh chấp, xử lý trên tinh thần hòa giải và lịch sự. Có thể nhờ quản lý can thiệp khi cần thiết.\r\n________________________________________\r\n6. Xử lý vi phạm\r\n•	Người chơi vi phạm các nguyên tắc trên có thể bị:\r\no	Nhắc nhở\r\no	Từ chối cho thuê sân lần tiếp theo\r\no	Ngừng chơi ngay lập tức nếu vi phạm nghiêm trọng\r\n________________________________________\r\n📞 Liên hệ hỗ trợ:\r\n•	Hotline: 0938130581\r\n•	Email: nguyenthanhquochuy127@gmail.com\r\n', 'chinhsach1.png'),
(2, 'CHÍNH SÁCH DỊCH VỤ TẠI CÂU LẠC BỘ CẦU LÔNG', '1. 🎯 Dịch vụ cung cấp\r\nChúng tôi cung cấp các dịch vụ đa dạng và chuyên nghiệp bao gồm:\r\n\r\nThuê sân cầu lông theo giờ (sân thảm PVC, sàn gỗ, sân ngoài trời)\r\n\r\nĐặt sân online qua website hoặc app (có hỗ trợ chọn khung giờ & loại sân)\r\n\r\nTổ chức giải đấu – sự kiện thể thao\r\n\r\nLớp học cầu lông (cho người mới bắt đầu, nâng cao, trẻ em & người lớn)\r\n\r\nCho thuê dụng cụ cầu lông (vợt, cầu, giày…)\r\n\r\nDịch vụ nước uống, tủ đồ cá nhân, phòng thay đồ\r\n\r\nHỗ trợ huấn luyện viên cá nhân (nếu khách có nhu cầu)\r\n\r\n2. ⏱️ Chính sách đặt và hủy sân\r\nĐặt sân trước tối thiểu 1 giờ trước khung giờ chơi.\r\n\r\nHủy sân trước 4 giờ sẽ được hoàn tiền hoặc bảo lưu lượt chơi.\r\n\r\nHủy trong vòng 4 giờ: không hoàn tiền nhưng có thể chuyển nhượng lượt đặt cho người khác.\r\n\r\nTrường hợp mưa bão, sự cố kỹ thuật từ CLB, khách hàng sẽ được hoàn tiền 100% hoặc dời lịch.\r\n\r\n3. 💳 Chính sách thanh toán\r\nChấp nhận các hình thức: Tiền mặt, chuyển khoản, ví điện tử (Momo, ZaloPay...)\r\n\r\nVới gói thuê dài hạn hoặc học viên CLB, áp dụng chính sách ưu đãi riêng.\r\n\r\nCó hóa đơn điện tử hoặc biên nhận nếu khách yêu cầu.\r\n\r\n4. 👟 Quy định sử dụng sân\r\nTrang phục thể thao, giày cầu lông không đế đinh là bắt buộc.\r\n\r\nKhông mang đồ ăn vào khu vực sân.\r\n\r\nBảo quản tài sản cá nhân; CLB không chịu trách nhiệm với mất mát ngoài khu vực an toàn.\r\n\r\nTôn trọng người chơi khác, không chen lấn hoặc vượt quá giờ thuê sân.\r\n\r\n5. 📞 Hỗ trợ khách hàng\r\nHotline: 09xx xxx xxx (7:00 – 22:00 hằng ngày)\r\n\r\nEmail: support@badmintonclub.vn\r\n\r\nFanpage: facebook.com/badmintonclub\r\n\r\n', 'chinhsach2.jpg'),
(3, 'CHÍNH SÁCH BẢO MẬT THÔNG TIN KHÁCH HÀNG', 'Badminton Club cam kết tôn trọng và bảo vệ quyền riêng tư của khách hàng.\r\n\r\n1. 📌 Mục đích thu thập thông tin\r\nChúng tôi thu thập thông tin cá nhân của khách hàng để:\r\n\r\nHỗ trợ đặt sân, đăng ký lớp học, giải đấu\r\n\r\nGửi thông báo liên quan đến dịch vụ (lịch đặt sân, hủy sân, ưu đãi…)\r\n\r\nCải thiện chất lượng dịch vụ và chăm sóc khách hàng\r\n\r\nGửi thông tin khuyến mãi, ưu đãi (nếu được khách hàng đồng ý)\r\n\r\n2. 🧾 Thông tin được thu thập\r\nCác thông tin mà chúng tôi có thể thu thập bao gồm:\r\n\r\nHọ tên, số điện thoại, email\r\n\r\nNgày sinh, giới tính (nếu khách tự nguyện cung cấp)\r\n\r\nLịch sử đặt sân, thanh toán, tham gia hoạt động tại CLB\r\n\r\n3. 🔐 Bảo mật và lưu trữ thông tin\r\nTất cả thông tin khách hàng được lưu trữ trên máy chủ bảo mật cao, chỉ nhân viên có thẩm quyền được truy cập.\r\n\r\nChúng tôi không chia sẻ, trao đổi hay bán thông tin cá nhân của khách hàng cho bên thứ ba khi chưa được sự đồng ý.\r\n\r\nDữ liệu sẽ được lưu trữ trong hệ thống trong suốt thời gian khách hàng sử dụng dịch vụ và 1 năm sau đó.\r\n\r\n4. 🔄 Chỉnh sửa & xóa thông tin\r\nKhách hàng có quyền:\r\n\r\nKiểm tra, cập nhật hoặc yêu cầu xóa thông tin cá nhân bất kỳ lúc nào bằng cách liên hệ với bộ phận hỗ trợ.\r\n\r\nNgừng nhận thông tin quảng cáo bằng cách chọn \"Hủy đăng ký\" trong email hoặc liên hệ trực tiếp với CLB.\r\n\r\n5. 📞 Liên hệ\r\nNếu có thắc mắc về Chính sách bảo mật, vui lòng liên hệ:\r\n📧 Email: info@badmintonclub.vn\r\n📞 Hotline: 09xx xxx xxx (7:00 – 22:00 mỗi ngày)\r\n\r\n', 'chinhsach3.jpg'),
(9, 'test', 'new', '1746436897_thi tiếng anh đầu vào.PNG');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donthuesan`
--

CREATE TABLE `donthuesan` (
  `maDon` int(10) UNSIGNED NOT NULL,
  `ngayThue` date DEFAULT NULL,
  `thoiGianThue` varchar(250) NOT NULL,
  `tinhTrangThanhToan` varchar(250) DEFAULT NULL,
  `phuongThucThanhToan` varchar(250) DEFAULT NULL,
  `hinhAnhThanhToan` varchar(250) DEFAULT NULL,
  `giaMoiGio` double NOT NULL,
  `tongTienGoc` double NOT NULL,
  `giamThanhVien` double NOT NULL,
  `giamKhuyenMai` double NOT NULL,
  `tongThanhTien` double NOT NULL,
  `tinhTrangThue` varchar(250) NOT NULL,
  `hinhAnhTraSan` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `maSan` int(11) NOT NULL,
  `maKH` int(11) NOT NULL,
  `maThe` int(11) DEFAULT NULL,
  `maKM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donthuesan`
--

INSERT INTO `donthuesan` (`maDon`, `ngayThue`, `thoiGianThue`, `tinhTrangThanhToan`, `phuongThucThanhToan`, `hinhAnhThanhToan`, `giaMoiGio`, `tongTienGoc`, `giamThanhVien`, `giamKhuyenMai`, `tongThanhTien`, `tinhTrangThue`, `hinhAnhTraSan`, `code`, `maSan`, `maKH`, `maThe`, `maKM`) VALUES
(1, '2025-04-27', '09:00 - 10:00', 'Da thanh toan', 'Bank', 'thanhtoan1.jpg', 200000, 200000, 0, 0, 200000, 'Đã hoàn thành', '', 'vfgc127', 3, 7, 0, 0),
(2, '2025-05-02', '07:00 - 08:00', 'Da thanh toan', 'Bank', 'thanhtoan1.jpg', 300000, 300000, 0, 0, 300000, 'Da hoan thanh', '', 'vdvdv2', 2, 7, 0, 0),
(64, '2025-05-03', '20:00 - 21:00, 21:00 - 22:00', 'Da thanh toan', 'Bank', '68160b3db3f2a_UseCase_ThueSan.jpg', 300000, 600000, 0, 60000, 540000, 'Đang thuê', '', 'F31GKL', 2, 7, 0, 1),
(65, '2025-05-03', '22:00 - 23:00', 'Da thanh toan', 'Bank', '68160c0ede191_fool (1).jpg', 300000, 300000, 0, 30000, 270000, 'Đang thuê', '', 'O3EW2I', 2, 7, 0, 1),
(66, '2025-05-03', '23:00 - 24:00', 'Da thanh toan', 'Tiền mặt', NULL, 300000, 300000, 0, 30000, 270000, 'Đang thuê', '', 'RW10EE', 2, 7, 0, 1),
(67, '2025-05-04', '17:00 - 18:00', 'Da thanh toan', 'Bank', '681732e1ccf68_thi.PNG', 300000, 300000, 0, 30000, 270000, 'Da hoan thanh', 'Minh chứng 2.png', 'TEXJ9L', 2, 7, 0, 1),
(68, '2025-05-07', '22:00 - 23:00, 23:00 - 24:00', 'Da thanh toan', 'Bank', '681b63ba45a42_Gmail.PHU1.PNG', 250000, 500000, 0, 150000, 350000, 'Da hoan thanh', '', 'TH8GYR', 1, 7, 0, 2),
(69, '2025-05-08', '21:00 - 22:00, 22:00 - 23:00, 23:00 - 24:00', 'Da thanh toan', 'Tiền mặt', NULL, 250000, 750000, 0, 225000, 525000, 'Đang thuê', '', 'TDXYGV', 1, 7, 0, 2),
(70, '2025-05-09', '15:00 - 16:00', 'Da thanh toan', 'Bank', '681da9be56acc_p2.PNG', 150000, 150000, 0, 45000, 105000, 'Da hoan thanh', 'Minh chứng 1.png', 'IY5KQS', 5, 7, 0, 2),
(71, '2025-05-09', '15:00 - 16:00, 16:00 - 17:00', 'Da thanh toan', 'Bank', '681daf56ce93e_tham khảo.PNG', 300000, 600000, 300000, 90000, 210000, 'Da hoan thanh', '', '7R186I', 2, 9, 987654321, 2),
(72, '2025-05-11', '07:00 - 08:00, 08:00 - 09:00', 'Da thanh toan', 'Bank', '681f5a9ef191f_NHỮNG LƯU Ý CHỦ YẾU PHỤC VỤ CHO HT.JPG', 250000, 500000, 0, 150000, 350000, 'Đang thuê', '', 'WF8M95', 1, 7, 0, 2),
(73, '2025-05-12', '10:00 - 11:00, 11:00 - 12:00', 'Da thanh toan', 'Tiền mặt', NULL, 250000, 500000, 0, 150000, 350000, 'Đang thuê', '', 'D3JRA3', 1, 7, 0, 2),
(74, '2025-05-11', '21:00 - 22:00', 'Da thanh toan', 'Tiền mặt', NULL, 250000, 250000, 0, 75000, 175000, 'Đang thuê', '', 'RQWXTZ', 1, 7, 0, 2),
(75, '2025-05-24', '14:00 - 15:00', 'Da thanh toan', 'Tiền mặt', NULL, 250000, 250000, 0, 75000, 175000, 'Đang thuê', '', '28P6EB', 1, 7, 0, 2),
(76, '2025-05-25', '07:00 - 08:00', 'Da thanh toan', 'Tiền mặt', NULL, 250000, 250000, 0, 50000, 200000, 'Đang thuê', '', '7AB2QZ', 1, 7, 0, 1),
(77, '2025-05-27', '07:00 - 08:00', 'Da thanh toan', 'Tiền mặt', NULL, 250000, 250000, 0, 75000, 175000, 'Đang thuê', '', 'CAUDTI', 1, 7, 0, 2),
(78, '2025-05-28', '12:00 - 13:00, 13:00 - 14:00', 'Da thanh toan', 'Bank', '68368c8b6e372_NHỮNG LƯU Ý CHỦ YẾU PHỤC VỤ CHO HT.JPG', 250000, 500000, 0, 150000, 350000, 'Da hoan thanh', 'Screenshot_2021-10-21-11-14-11-55.jpg', 'XMALVS', 1, 7, 0, 2),
(79, '2025-05-28', '16:00 - 17:00, 17:00 - 18:00', 'Da thanh toan', 'Bank', '6836c63a87ba6_domain_ThueSan.jpg', 200000, 400000, 0, 120000, 280000, 'Da hoan thanh', '', 'NS7D7L', 3, 7, 0, 2),
(80, '2025-05-29', '07:00 - 08:00', 'Chua thanh toan', 'Tiền mặt', NULL, 300000, 300000, 150000, 45000, 105000, 'Đang thuê', '', 'SOFHMN', 1, 7, 123456789, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `maKH` int(10) UNSIGNED NOT NULL,
  `maNguoiDung` int(11) NOT NULL,
  `maThe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`maKH`, `maNguoiDung`, `maThe`) VALUES
(1, 1, 938130581),
(7, 9, 123456789),
(8, 10, 2),
(9, 12, 987654321);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `maKM` int(10) UNSIGNED NOT NULL,
  `tenKM` varchar(250) NOT NULL,
  `noiDungChuongTrinh` text NOT NULL,
  `phanTramKM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`maKM`, `tenKM`, `noiDungChuongTrinh`, `phanTramKM`) VALUES
(1, 'Khuyến mãi cho người mới', 'Danh cho những khách hàng mới tạo tài khoản lần đầu', 20),
(2, 'Khuyến mãi 30/4 - 1/5', 'Thời gian khuyến mãi kéo dài từ ngày 15/04 - 30/05 để mừng ngày giải phóng miền nam việt nam', 30),
(3, 'tets', 'sknnc', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisan`
--

CREATE TABLE `loaisan` (
  `maLoai` int(10) UNSIGNED NOT NULL,
  `tenLoai` varchar(250) NOT NULL,
  `moTa` text NOT NULL,
  `tongSoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisan`
--

INSERT INTO `loaisan` (`maLoai`, `tenLoai`, `moTa`, `tongSoLuong`) VALUES
(1, 'Sân thảm PVC chuyên dụng (Đấu đơn)', 'Là loại thảm tổng hợp từ nhựa PVC (Polyvinyl chloride), Chuẩn quốc tế, thường dùng trong thi đấu nhờ khả năng chống trượt, giảm chấn vượt trội.', 1),
(2, 'Sân gỗ (Đấu đơn)', 'Mang lại độ đàn hồi tốt, phù hợp với nhà thi đấu đa năng, yêu cầu bảo trì thường xuyên.', 1),
(3, 'Sân bê tông (Đấu đơn)', 'Kinh tế, dễ thi công, phù hợp cho sân ngoài trời phong trào.', 2),
(4, 'Sân thảm PVC chuyên dụng (Đấu đôi)', 'Là loại thảm tổng hợp từ nhựa PVC (Polyvinyl chloride), Chuẩn quốc tế, thường dùng trong thi đấu nhờ khả năng chống trượt, giảm chấn vượt trội.', 1),
(5, 'Sân gỗ (Đấu đôi)', 'Mang lại độ đàn hồi tốt, phù hợp với nhà thi đấu đa năng, yêu cầu bảo trì thường xuyên.', 1),
(6, 'Sân bê tông (Đấu đôi)', 'Kinh tế, dễ thi công, phù hợp cho sân ngoài trời phong trào.', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `maNguoiDung` int(10) UNSIGNED NOT NULL,
  `ten` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `sdt` varchar(15) NOT NULL,
  `diaChi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`maNguoiDung`, `ten`, `email`, `sdt`, `diaChi`) VALUES
(1, 'Người quản lý', 'quanly@gmail.com', '0938130581', '421 ABC'),
(2, 'Nhân viên lễ tân', 'nvletan@gmail.com', '0935123489', '127 ABD'),
(3, 'Nguyễn Thanh Quốc Huy', 'hhuynguyen127@gmail.com', '0939005217', '520 ZXY'),
(9, 'Nguyễn Quỳnh Bảo Ngọc', 'Bao@gmail.com', '0123456789', '451 Tân kỳ Tân quý'),
(10, 'Nguyễn Thanh Quốc Huy', 'huy@gmail.com', '0938250501', ''),
(11, 'Nguyễn Văn An', 'an@gmail.com', '0938205999', '421/1A DGHC'),
(12, 'Nguyễn Huy Hoàng', 'hoang@gmail.com', '0987654321', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `maNhanVien` int(10) UNSIGNED NOT NULL,
  `chucVu` varchar(250) NOT NULL,
  `ngayVaoLam` date NOT NULL,
  `maNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`maNhanVien`, `chucVu`, `ngayVaoLam`, `maNguoiDung`) VALUES
(1, 'Quản lý', '2025-04-16', 1),
(2, 'Nhân viên', '2025-04-16', 2),
(3, 'Nhân viên', '2025-05-06', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `roleId` int(10) UNSIGNED NOT NULL,
  `roleName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'Quản lý'),
(2, 'Nhân viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san`
--

CREATE TABLE `san` (
  `maSan` int(10) UNSIGNED NOT NULL,
  `tenSan` varchar(250) NOT NULL,
  `giaThue` varchar(250) NOT NULL,
  `moTa` text NOT NULL,
  `kichThuoc` varchar(250) NOT NULL,
  `tinhTrang` varchar(250) NOT NULL,
  `hinhAnh` varchar(250) NOT NULL,
  `maLoai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san`
--

INSERT INTO `san` (`maSan`, `tenSan`, `giaThue`, `moTa`, `kichThuoc`, `tinhTrang`, `hinhAnh`, `maLoai`) VALUES
(1, 'Sân PVC 1', '300000', '📌 Đặc điểm:\r\nLà loại thảm tổng hợp từ nhựa PVC (Polyvinyl chloride), chuyên sản xuất cho các môn thể thao trong nhà.\r\n\r\nGồm nhiều lớp: Lớp bề mặt chống trượt, lớp đàn hồi, lớp gia cố chịu lực.\r\n\r\nĐược cuộn thành từng tấm và trải trên bề mặt sàn (thường là sàn xi măng phẳng hoặc gỗ).\r\n\r\n✅ Ưu điểm:\r\nChống trơn trượt cao, đảm bảo an toàn khi di chuyển nhanh và đổi hướng đột ngột.\r\n\r\nĐộ bám tốt – hỗ trợ các kỹ thuật di chuyển (lết, xoay gót, chuyển hướng).\r\n\r\nÊm chân, giúp hạn chế chấn thương đầu gối, mắt cá chân.\r\n\r\nDễ lắp đặt và tháo dỡ, phù hợp sân tạm thời hoặc thi đấu lưu động.\r\n\r\n❌ Nhược điểm:\r\nChi phí đầu tư cao hơn sân xi măng thông thường.\r\n\r\nCần bảo quản kỹ, không dùng giày đinh hoặc vật sắc nhọn.\r\n\r\n🎯 Ứng dụng:\r\nSân thi đấu chuyên nghiệp, trung tâm huấn luyện thể thao, trường học chất lượng cao.', '5.18m x 13.4m (Đấu đôi)', 'Hoạt động', 'PVC1.jpg', 1),
(2, 'Sân PVC 2', '300000', '📌 Đặc điểm:\r\nLà loại thảm tổng hợp từ nhựa PVC (Polyvinyl chloride), chuyên sản xuất cho các môn thể thao trong nhà.\r\n\r\nGồm nhiều lớp: Lớp bề mặt chống trượt, lớp đàn hồi, lớp gia cố chịu lực.\r\n\r\nĐược cuộn thành từng tấm và trải trên bề mặt sàn (thường là sàn xi măng phẳng hoặc gỗ).\r\n\r\n✅ Ưu điểm:\r\nChống trơn trượt cao, đảm bảo an toàn khi di chuyển nhanh và đổi hướng đột ngột.\r\n\r\nĐộ bám tốt – hỗ trợ các kỹ thuật di chuyển (lết, xoay gót, chuyển hướng).\r\n\r\nÊm chân, giúp hạn chế chấn thương đầu gối, mắt cá chân.\r\n\r\nDễ lắp đặt và tháo dỡ, phù hợp sân tạm thời hoặc thi đấu lưu động.\r\n\r\n❌ Nhược điểm:\r\nChi phí đầu tư cao hơn sân xi măng thông thường.\r\n\r\nCần bảo quản kỹ, không dùng giày đinh hoặc vật sắc nhọn.\r\n\r\n🎯 Ứng dụng:\r\nSân thi đấu chuyên nghiệp, trung tâm huấn luyện thể thao, trường học chất lượng cao.', '6.1m x 13.4m (Đấu đôi)', 'Hoạt động', 'PVC2.jpg', 4),
(3, 'Sân gỗ 1', '200000', '📌 Đặc điểm kỹ thuật:\r\nChất liệu: Gỗ cứng (thường là gỗ sồi, gỗ cao su ép).\r\n\r\nThiết kế: Lắp ghép từng tấm, có lớp sơn phủ chống trượt.\r\n\r\nLắp trong nhà thi đấu, nơi không tiếp xúc mưa nắng.\r\n\r\n✅ Ưu điểm:\r\nBề mặt êm, độ đàn hồi tốt, giảm sốc khi tiếp đất.\r\n\r\nĐẹp mắt, sang trọng, thường thấy trong các sân vận động tiêu chuẩn quốc tế.\r\n\r\n❌ Nhược điểm:\r\nGiá cao, khó thi công so với các loại khác.\r\n\r\nRất kỵ nước: dễ cong vênh, nứt nẻ nếu bị ẩm hoặc thấm nước.\r\n\r\nCần hệ thống thoát ẩm và kiểm soát nhiệt độ tốt.', '5.18m x 13.4m (Đấu đơn)', 'Hoạt động', 'G1.jpg', 2),
(4, 'Sân gỗ 2', '250000', '📌 Đặc điểm kỹ thuật:\r\nChất liệu: Gỗ cứng (thường là gỗ sồi, gỗ cao su ép).\r\n\r\nThiết kế: Lắp ghép từng tấm, có lớp sơn phủ chống trượt.\r\n\r\nLắp trong nhà thi đấu, nơi không tiếp xúc mưa nắng.\r\n\r\n✅ Ưu điểm:\r\nBề mặt êm, độ đàn hồi tốt, giảm sốc khi tiếp đất.\r\n\r\nĐẹp mắt, sang trọng, thường thấy trong các sân vận động tiêu chuẩn quốc tế.\r\n\r\n❌ Nhược điểm:\r\nGiá cao, khó thi công so với các loại khác.\r\n\r\nRất kỵ nước: dễ cong vênh, nứt nẻ nếu bị ẩm hoặc thấm nước.\r\n\r\nCần hệ thống thoát ẩm và kiểm soát nhiệt độ tốt.', '6.1m x 13.4m (Đấu đôi)', 'Hoạt động', 'G2.jpg', 5),
(5, 'Sân bê tông 1', '150000', '📌 Đặc điểm kỹ thuật:\r\nChất liệu: Xi măng trộn cát đá, bề mặt đánh bóng hoặc thô.\r\n\r\nThi công đơn giản, chỉ cần nền đất chắc chắn.\r\n\r\n✅ Ưu điểm:\r\nChi phí thấp, dễ triển khai ở mọi địa hình.\r\n\r\nĐộ bền cao, ít cần bảo trì.\r\n\r\nPhù hợp với khu dân cư, trường học, khu vui chơi ngoài trời.\r\n\r\n❌ Nhược điểm:\r\nCứng, không đàn hồi → gây mỏi chân, đau khớp nếu chơi lâu dài.\r\n\r\nDễ gây trượt ngã nếu ướt hoặc có bụi bẩn.\r\n\r\nKhông đạt tiêu chuẩn thi đấu chuyên nghiệp.', '5.18m x 13.4m (Đấu đơn)', 'Hoạt động', 'BT1.jpg', 3),
(6, 'Sân bê tông 2', '150000', '📌 Đặc điểm kỹ thuật:\r\nChất liệu: Xi măng trộn cát đá, bề mặt đánh bóng hoặc thô.\r\n\r\nThi công đơn giản, chỉ cần nền đất chắc chắn.\r\n\r\n✅ Ưu điểm:\r\nChi phí thấp, dễ triển khai ở mọi địa hình.\r\n\r\nĐộ bền cao, ít cần bảo trì.\r\n\r\nPhù hợp với khu dân cư, trường học, khu vui chơi ngoài trời.\r\n\r\n❌ Nhược điểm:\r\nCứng, không đàn hồi → gây mỏi chân, đau khớp nếu chơi lâu dài.\r\n\r\nDễ gây trượt ngã nếu ướt hoặc có bụi bẩn.\r\n\r\nKhông đạt tiêu chuẩn thi đấu chuyên nghiệp.', '5.18m x 13.4m (Đấu đơn)', 'Hoạt động', 'BT2.jpg', 3),
(7, 'Sân bê tông 3', '200000', '📌 Đặc điểm kỹ thuật:\r\nChất liệu: Xi măng trộn cát đá, bề mặt đánh bóng hoặc thô.\r\n\r\nThi công đơn giản, chỉ cần nền đất chắc chắn.\r\n\r\n✅ Ưu điểm:\r\nChi phí thấp, dễ triển khai ở mọi địa hình.\r\n\r\nĐộ bền cao, ít cần bảo trì.\r\n\r\nPhù hợp với khu dân cư, trường học, khu vui chơi ngoài trời.\r\n\r\n❌ Nhược điểm:\r\nCứng, không đàn hồi → gây mỏi chân, đau khớp nếu chơi lâu dài.\r\n\r\nDễ gây trượt ngã nếu ướt hoặc có bụi bẩn.\r\n\r\nKhông đạt tiêu chuẩn thi đấu chuyên nghiệp.', '6.1m x 13.4m (Đấu đôi)', 'Hoạt động', 'BT3.jpg', 6),
(8, 'Sân test', '200000', 'abc - xyz', '5.18m x 13.4m (Đấu đơn)', 'Bảo trì', '1746773772_thi.PNG', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `maTK` int(10) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `maNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`maTK`, `email`, `password`, `maNguoiDung`) VALUES
(1, 'quanly@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 1),
(2, 'nvletan@gmail.com', '3d2172418ce305c7d16d4b05597c6a59', 2),
(3, 'hhuynguyen127@gmail.com', '33333', 3),
(9, 'BaoNgoc@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', 9),
(10, 'huy@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 10),
(11, 'an@gmail.com', '79b7cdcd14db14e9cb498f1793817d69', 11),
(12, 'hoang@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thethanhvien`
--

CREATE TABLE `thethanhvien` (
  `maThe` int(10) UNSIGNED NOT NULL,
  `maNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thethanhvien`
--

INSERT INTO `thethanhvien` (`maThe`, `maNguoiDung`) VALUES
(1, 1),
(123456789, 9),
(2, 10),
(987654321, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinnhan`
--

CREATE TABLE `tinnhan` (
  `maTinNhan` int(11) NOT NULL,
  `maNguoiGui` int(11) NOT NULL,
  `maNguoiNhan` int(11) NOT NULL,
  `ngayGui` date NOT NULL,
  `thoiGianGui` varchar(200) NOT NULL,
  `noiDung` text NOT NULL,
  `daXem` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tinnhan`
--

INSERT INTO `tinnhan` (`maTinNhan`, `maNguoiGui`, `maNguoiNhan`, `ngayGui`, `thoiGianGui`, `noiDung`, `daXem`) VALUES
(17, 2, 9, '2025-05-18', '08:54:56', 'chào bạn', 1),
(18, 2, 9, '2025-05-18', '13:57:55', 'chào bạn', 1),
(19, 9, 2, '2025-05-18', '09:07:34', 'chào admin', 1),
(20, 9, 2, '2025-05-18', '09:07:45', 'chào admin', 1),
(21, 9, 2, '2025-05-18', '14:08:20', 'chào admin', 1),
(22, 2, 9, '2025-05-18', '14:08:30', 'ok cảm ơn bạn', 1),
(23, 2, 9, '2025-05-18', '14:26:41', 'hêllo', 1),
(24, 2, 9, '2025-05-18', '14:30:22', 'chào', 1),
(25, 9, 2, '2025-05-18', '14:38:00', 'chào', 1),
(26, 9, 2, '2025-05-18', '14:42:10', 'chào', 1),
(27, 9, 2, '2025-05-18', '14:51:13', 'hêlolo dancak', 1),
(28, 2, 9, '2025-05-18', '14:57:21', 'ok cảm ơn bạn', 1),
(29, 9, 2, '2025-05-18', '14:58:19', ':)))', 1),
(30, 2, 9, '2025-05-18', '14:58:57', 'VM', 1),
(31, 2, 9, '2025-05-18', '14:59:59', 'cscnskncs', 1),
(32, 9, 2, '2025-05-18', '15:00:17', 'cscs', 1),
(33, 9, 2, '2025-05-19', '08:04:51', 'chào bạn admin', 1),
(34, 9, 2, '2025-05-19', '08:05:47', 'Chào bạn admin', 1),
(35, 2, 9, '2025-05-19', '08:06:46', 'chào bạn ngọc', 1),
(36, 2, 9, '2025-05-19', '08:07:09', 'chào bạn ngọc', 1),
(37, 2, 9, '2025-05-19', '08:14:59', 'chào bạn huy', 1),
(38, 9, 2, '2025-05-19', '08:15:06', 'tôi là ngọc', 1),
(39, 2, 9, '2025-05-19', '08:15:27', 'chào bạn ngọc', 1),
(40, 2, 9, '2025-05-19', '08:15:29', 'chào bạn ngọc', 1),
(41, 2, 9, '2025-05-19', '08:20:04', 'hello', 1),
(42, 9, 2, '2025-05-19', '08:20:10', 'chào bạn', 1),
(44, 12, 2, '2025-05-19', '08:28:35', 'chào bạn', 1),
(45, 2, 9, '2025-05-19', '08:29:08', 'Bạn cần tôi giúp gì không', 1),
(46, 9, 2, '2025-05-19', '08:46:19', 'chào bạn', 1),
(47, 9, 2, '2025-05-19', '08:46:40', 'alo alo', 1),
(48, 2, 9, '2025-05-19', '08:47:22', 'tôi nghe đây bạn cần giúp gì', 1),
(49, 2, 9, '2025-05-19', '09:01:56', 'chào bạn', 1),
(50, 9, 2, '2025-05-19', '09:02:24', 'tôi đây', 1),
(51, 9, 2, '2025-05-19', '09:02:38', 'bạn cần gì', 1),
(52, 2, 9, '2025-05-19', '09:10:34', 'chúc mừng bạn..', 1),
(53, 9, 2, '2025-05-19', '09:13:04', 'mừng chuyện gì thế bạn ?', 1),
(54, 9, 2, '2025-05-19', '09:13:29', 'bạn có thể cho bạn biết nhiều hơn không', 1),
(55, 2, 12, '2025-05-19', '09:18:34', 'Chào bạn Hoàng', 1),
(56, 2, 12, '2025-05-19', '09:18:43', 'Bạn cần chúng tôi giúp gì không', 1),
(57, 2, 12, '2025-05-19', '09:19:18', 'Chúng tôi đang có 1 vài chương trình khuyến mãi rất phù hợp với bạn', 1),
(58, 2, 12, '2025-05-19', '09:19:42', 'alo', 1),
(59, 12, 2, '2025-05-19', '09:20:37', 'không CẦN ĐÂU', 1),
(60, 2, 12, '2025-05-19', '09:21:00', 'vậy bạn cần tôi giúp gì', 1),
(61, 2, 9, '2025-05-19', '09:21:52', 'chúng tôi có rất nhiều chương trình khuyến mãi thích hợp với bạn', 1),
(62, 9, 2, '2025-05-19', '09:33:35', 'chào bạn admin', 1),
(63, 9, 2, '2025-05-19', '09:33:40', 'tôi cần hỗ trợ', 1),
(64, 2, 9, '2025-05-19', '15:03:37', 'hello', 1),
(65, 2, 9, '2025-05-19', '15:03:50', 'helll', 1),
(66, 2, 9, '2025-05-19', '15:03:58', '123456', 1),
(67, 9, 2, '2025-05-19', '15:04:33', 'chaoff admin', 1),
(68, 9, 2, '2025-05-19', '15:04:38', 'tooi laf ngocj', 1),
(69, 2, 9, '2025-05-19', '15:17:15', 'chào bạn ngọc', 1),
(70, 2, 9, '2025-05-19', '15:17:26', 'tôi có thể giúp gì cho bạn không', 1),
(71, 2, 9, '2025-05-19', '15:31:54', 'chào bạn', 1),
(72, 2, 9, '2025-05-19', '15:36:25', 'chào bạn bạn ổn không', 1),
(73, 2, 9, '2025-05-19', '15:39:32', 'alo alo 12345', 1),
(74, 2, 9, '2025-05-20', '10:37:21', 'chào bạn chúc ngày mới tốt lành', 1),
(75, 9, 2, '2025-05-20', '10:37:47', 'vâng cảm ơn bạn', 1),
(76, 2, 9, '2025-05-20', '12:11:32', 'chào bạn Ngọc', 1),
(77, 9, 2, '2025-05-20', '12:12:17', 'bạn cần gfi', 1),
(78, 9, 2, '2025-05-28', '10:58:39', 'Chào bạn admin??', 1),
(79, 9, 2, '2025-05-28', '15:07:38', 'chào admin', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userroles`
--

CREATE TABLE `userroles` (
  `userId` int(10) UNSIGNED NOT NULL,
  `roleId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `userroles`
--

INSERT INTO `userroles` (`userId`, `roleId`) VALUES
(1, 1),
(2, 2),
(3, 3),
(11, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chinhsach`
--
ALTER TABLE `chinhsach`
  ADD PRIMARY KEY (`maChinhSach`);

--
-- Chỉ mục cho bảng `donthuesan`
--
ALTER TABLE `donthuesan`
  ADD PRIMARY KEY (`maDon`),
  ADD KEY `maSan` (`maSan`),
  ADD KEY `maKH` (`maKH`),
  ADD KEY `maThe` (`maThe`),
  ADD KEY `maKM` (`maKM`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`maKH`),
  ADD KEY `maNguoiDung` (`maNguoiDung`),
  ADD KEY `maThe` (`maThe`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`maKM`);

--
-- Chỉ mục cho bảng `loaisan`
--
ALTER TABLE `loaisan`
  ADD PRIMARY KEY (`maLoai`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`maNguoiDung`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`maNhanVien`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Chỉ mục cho bảng `san`
--
ALTER TABLE `san`
  ADD PRIMARY KEY (`maSan`),
  ADD KEY `maLoai` (`maLoai`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`maTK`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Chỉ mục cho bảng `thethanhvien`
--
ALTER TABLE `thethanhvien`
  ADD PRIMARY KEY (`maThe`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Chỉ mục cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD PRIMARY KEY (`maTinNhan`),
  ADD KEY `maNguoiGui` (`maNguoiGui`),
  ADD KEY `maNguoiNhan` (`maNguoiNhan`);

--
-- Chỉ mục cho bảng `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`userId`,`roleId`),
  ADD KEY `maRole` (`userId`),
  ADD KEY `maNguoiDung` (`roleId`),
  ADD KEY `roleId` (`roleId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chinhsach`
--
ALTER TABLE `chinhsach`
  MODIFY `maChinhSach` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `donthuesan`
--
ALTER TABLE `donthuesan`
  MODIFY `maDon` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `maKH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `maKM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaisan`
--
ALTER TABLE `loaisan`
  MODIFY `maLoai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `maNhanVien` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `san`
--
ALTER TABLE `san`
  MODIFY `maSan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `maTK` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `thethanhvien`
--
ALTER TABLE `thethanhvien`
  MODIFY `maThe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=987654322;

--
-- AUTO_INCREMENT cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  MODIFY `maTinNhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
