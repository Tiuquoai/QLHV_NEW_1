-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 19, 2023 lúc 05:10 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlhv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id_ad` int(10) NOT NULL,
  `hotenadmin` varchar(50) NOT NULL,
  `loigioithieu` varchar(10000) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id_ad`, `hotenadmin`, `loigioithieu`, `user_id`) VALUES
(1, 'Phuc Nguyen Follo', 'Xin chào mn ! Minh là Admin hệ thống tạm kkk :) <br/>\r\nMốt đổi chủ nha :) . À mà thôi !', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baitaplythuyet`
--

CREATE TABLE `baitaplythuyet` (
  `id_btlt` int(10) NOT NULL,
  `tieude` varchar(50) DEFAULT NULL,
  `filebt` varchar(50) DEFAULT NULL,
  `batdaunop` varchar(50) DEFAULT NULL,
  `ketthucnop` varchar(50) DEFAULT NULL,
  `ngaydang` varchar(50) DEFAULT NULL,
  `id_giangday` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `baitaplythuyet`
--

INSERT INTO `baitaplythuyet` (`id_btlt`, `tieude`, `filebt`, `batdaunop`, `ketthucnop`, `ngaydang`, `id_giangday`) VALUES
(8, 'Bài Tập ERP ( Nhóm ) Số 1', 'BTN_So1.docx', '2023-12-10T18:00', '2023-12-11T18:00', '2023-12-10 10:33:17', 113),
(9, 'Bài Tập Nhóm ERP ( Số 2 )', 'Bai_Tap_Nhom_So_2.docx', '2023-12-11T17:38', '2023-12-12T17:38', '2023-12-10 10:39:04', 113),
(10, 'Bài Tập :3', 'ERP_PhucNguyen.docx', '2023-12-10T17:43', '2023-12-12T17:43', '2023-12-10 10:43:02', 113);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baitapthuchanh`
--

CREATE TABLE `baitapthuchanh` (
  `id_btth` int(10) NOT NULL,
  `tieude` varchar(50) DEFAULT NULL,
  `batdaunop` varchar(50) DEFAULT NULL,
  `ketthucnop` varchar(50) DEFAULT NULL,
  `ngaydang` varchar(50) DEFAULT NULL,
  `loaibai` varchar(50) DEFAULT NULL,
  `id_giangday` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `baitapthuchanh`
--

INSERT INTO `baitapthuchanh` (`id_btth`, `tieude`, `batdaunop`, `ketthucnop`, `ngaydang`, `loaibai`, `id_giangday`) VALUES
(2, 'Nộp Bài TH Tuần Số 1', '2023-12-10T18:00', '2023-12-17T18:00', '2023-12-10 11:01:44', 'TH', 113),
(3, 'Nộp Bài TH Tuần Số 2', '2023-12-17T09:00', '2023-12-24T09:00', '2023-12-10 11:26:26', 'TH', 113),
(4, 'Nộp Bài Kiểm Tra Thực Hành Số 1', '2023-12-11T09:00', '2023-12-13T10:30', '2023-12-10 11:27:46', 'KTTH', 113);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `id_chuyennganh` int(10) NOT NULL,
  `machuyennganh` varchar(50) NOT NULL,
  `tenchuyennganh` varchar(50) NOT NULL,
  `id_khoa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyennganh`
--

INSERT INTO `chuyennganh` (`id_chuyennganh`, `machuyennganh`, `tenchuyennganh`, `id_khoa`) VALUES
(56, 'HTTT', 'Hệ Thống Thông Tin', 40),
(57, 'CNTT', 'Công Nghệ Thông Tin', 40),
(58, 'KHMT', 'Khoa Học Máy Tính', 40),
(59, 'KTPM', 'Kỹ Thuật Phần Mềm', 40),
(60, 'QTKD', 'Quản Trị Kinh Doanh', 41),
(61, 'QTNNL', 'Quản Trị Nguồn Nhân Lực', 41),
(62, 'ELAW', 'Luật Kinh Tế', 42),
(63, 'ILAW', 'Luật Quốc Tế', 42),
(74, 'KeT', 'Kế Toán', 45),
(75, 'KiT', 'Kiểm Toán', 45),
(76, 'KTHH', 'Kỹ Thuật Hóa Học', 48),
(77, 'HPT', 'Hóa Phân Tích', 48),
(86, 'SHYD', 'Sinh Học Y Dược', 56),
(87, 'SHNN', 'Sinh Học Nông Nghiệp', 56),
(88, 'SHTM', 'Sinh Học Thẩm Mỹ', 56),
(89, 'YDP', 'Y Dược Phẩm', 56);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_hocphan`
--

CREATE TABLE `ct_hocphan` (
  `id_chitiethp` int(10) NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  `loaihp` varchar(50) DEFAULT NULL,
  `soTC` int(10) DEFAULT NULL,
  `TCLT` int(10) DEFAULT NULL,
  `TCTH` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_hocphan`
--

INSERT INTO `ct_hocphan` (`id_chitiethp`, `id_hocphan`, `loaihp`, `soTC`, `TCLT`, `TCTH`) VALUES
(44, 247, 'LT & TH', 3, 2, 1),
(45, 248, 'LT & TH', 3, 1, 2),
(46, 249, 'LT & TH', 3, 1, 2),
(47, 250, 'LT & TH', 3, 2, 1),
(48, 251, 'LT & TH', 3, 1, 2),
(49, 252, 'LT & TH', 3, 1, 2),
(50, 253, 'LT & TH', 3, 1, 2),
(51, 254, 'LT', 3, 3, 0),
(52, 255, 'LT', 3, 3, 0),
(53, 256, 'LT', 3, 3, 0),
(54, 257, 'LT', 3, 3, 0),
(55, 258, 'LT', 2, 2, 0),
(56, 259, 'LT', 3, 3, 0),
(57, 260, 'LT', 3, 3, 0),
(73, 276, 'LT', 3, 0, 0),
(77, 280, 'LT', 3, 0, 0),
(82, 285, 'LT', 4, 4, 0),
(83, 286, 'LT', 3, 3, 0),
(84, 287, 'LT', 3, 3, 0),
(85, 288, 'LT', 3, 3, 0),
(86, 289, 'LT', 3, 3, 0),
(87, 290, 'LT', 3, 3, 0),
(88, 291, 'LT', 2, 2, 0),
(90, 293, 'LT', 3, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem`
--

CREATE TABLE `diem` (
  `id_diem` int(10) NOT NULL,
  `TK1` varchar(50) NOT NULL,
  `TK2` varchar(50) NOT NULL,
  `TK3` varchar(50) NOT NULL,
  `GK` varchar(50) NOT NULL,
  `TH1` varchar(50) NOT NULL,
  `TH2` varchar(50) NOT NULL,
  `TH3` varchar(50) NOT NULL,
  `CK` varchar(50) NOT NULL,
  `diemtb` varchar(50) DEFAULT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_hocphan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diem`
--

INSERT INTO `diem` (`id_diem`, `TK1`, `TK2`, `TK3`, `GK`, `TH1`, `TH2`, `TH3`, `CK`, `diemtb`, `id_lophocphan`, `id_sinhvien`, `id_hocphan`) VALUES
(6, '8', '9', '', '10', '8', '9', '9', '10', '9.4', 8, 96, 247),
(7, '6', '7', '', '5.5', '7', '9', '7', '7', '6.9', 8, 90, 247),
(8, '7', '5', '', '7', '5', '7', '8', '8', '6.7', 8, 97, 247),
(9, '9', '7', '', '6', '8', '5', '8', '7.5', '8.6', 8, 101, 247),
(10, '9', '7', '', '8', '9', '9', '7', '9.5', '7.1', 8, 98, 247),
(11, '7.5', '7', '', '9', '6', '8', '5', '8', '7.5', 8, 102, 247);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dkhp`
--

CREATE TABLE `dkhp` (
  `id_dkhp` int(10) NOT NULL,
  `id_sinhvien` varchar(10) NOT NULL,
  `id_hocphan` varchar(10) NOT NULL,
  `ngaydk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dkhp`
--

INSERT INTO `dkhp` (`id_dkhp`, `id_sinhvien`, `id_hocphan`, `ngaydk`) VALUES
(150, '96', '247', '2023-12-13 23:56:10'),
(152, '96', '247', '2023-12-13 23:57:34'),
(154, '96', '247', '2023-12-13 23:58:04'),
(156, '96', '247', '2023-12-14 00:00:11'),
(158, '96', '247', '2023-12-14 00:00:43'),
(160, '96', '247', '2023-12-14 00:04:19'),
(162, '96', '247', '2023-12-14 00:07:23'),
(163, '97', '247', '2023-12-14 00:07:31'),
(164, '90', '247', '2023-12-14 00:07:51'),
(165, '98', '247', '2023-12-14 00:07:51'),
(166, '111', '247', '2023-12-14 00:07:51'),
(167, '112', '247', '2023-12-14 00:07:51'),
(168, '96', '248', '2023-12-14 00:08:18'),
(170, '93', '248', '2023-12-14 00:19:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `filediem`
--

CREATE TABLE `filediem` (
  `id_filediem` int(10) NOT NULL,
  `filediem` varchar(100) NOT NULL,
  `ngaydang` varchar(50) NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  `id_giangvien` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `filediem`
--

INSERT INTO `filediem` (`id_filediem`, `filediem`, `ngaydang`, `id_lophocphan`, `id_hocphan`, `id_giangvien`) VALUES
(3, 'DSSV.Hoạch Định Tài Nguyên Doanh Nghiệp.DHHTTT15A.xlsx', '2023-12-10 11:43:16', 8, 247, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `filenopbtlt`
--

CREATE TABLE `filenopbtlt` (
  `id_filenopbtlt` int(10) NOT NULL,
  `tieude` varchar(50) NOT NULL,
  `filenop` varchar(50) NOT NULL,
  `ngaynop` varchar(50) NOT NULL,
  `id_btlt` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `filenopbtlt`
--

INSERT INTO `filenopbtlt` (`id_filenopbtlt`, `tieude`, `filenop`, `ngaynop`, `id_btlt`, `id_sinhvien`) VALUES
(2, 'Hoạch Định DHHTTT15A _ Nhóm 1', 'HOA_SEN_GROUP.pptx', '2023-12-10 11:56:44', 8, 96);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `filenopbtth`
--

CREATE TABLE `filenopbtth` (
  `id_filenopbtth` int(10) NOT NULL,
  `tieude` varchar(50) DEFAULT NULL,
  `filenop` varchar(50) NOT NULL,
  `ngaynop` varchar(50) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_btth` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `filenopbtth`
--

INSERT INTO `filenopbtth` (`id_filenopbtth`, `tieude`, `filenop`, `ngaynop`, `id_sinhvien`, `id_btth`) VALUES
(6, '19443131_NguyenVanPhuc_NopBTTHTuan01', '19443131_NguyenVanPhuc_NopBTTHTuan01_2.zip', '2023-12-12 09:48:12', 96, 2),
(7, '19443131_NGUYENVANPHUC_THKTERP', '19443131_NguyenVanPhuc_NopKTTHERP_2.docx', '2023-12-12 10:29:43', 96, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangday`
--

CREATE TABLE `giangday` (
  `id_giangday` int(10) NOT NULL,
  `id_giangvien` int(10) DEFAULT NULL,
  `id_giangvienTH1` int(10) DEFAULT NULL,
  `id_giangvienTH2` int(10) DEFAULT NULL,
  `id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giangday`
--

INSERT INTO `giangday` (`id_giangday`, `id_giangvien`, `id_giangvienTH1`, `id_giangvienTH2`, `id`) VALUES
(124, 7, 8, 0, 5),
(125, 8, 8, 0, 10),
(126, 10, 10, 0, 16),
(127, 8, 7, 0, 17),
(128, 9, 9, 0, 31),
(129, 7, 7, 9, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `id_giangvien` int(10) NOT NULL,
  `magiangvien` varchar(50) DEFAULT NULL,
  `hotengiangvien` varchar(50) DEFAULT NULL,
  `gioitinh` varchar(50) DEFAULT NULL,
  `sdt` varchar(50) DEFAULT NULL,
  `diachi` varchar(50) DEFAULT NULL,
  `hocvi` varchar(50) DEFAULT NULL,
  `quatrinhcongtac` varchar(1000) DEFAULT NULL,
  `cosogiangday` varchar(50) DEFAULT NULL,
  `chungchi` varchar(50) DEFAULT NULL,
  `chungchikhac` varchar(1000) DEFAULT NULL,
  `congtrinhkhoahoctieubieu` varchar(1000) DEFAULT NULL,
  `id_chuyennganh` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`id_giangvien`, `magiangvien`, `hotengiangvien`, `gioitinh`, `sdt`, `diachi`, `hocvi`, `quatrinhcongtac`, `cosogiangday`, `chungchi`, `chungchikhac`, `congtrinhkhoahoctieubieu`, `id_chuyennganh`, `user_id`) VALUES
(7, 'TT@#123', 'NGUYỄN T X', 'Nữ', '0324536212', 'Số 12, Nguyễn Thị Minh Khai, Q1, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'IELTS 6.0', '<br/>\r\n- Chứng chỉ ATTT\r\n<br/>\r\n- ...', 'Đang cập nhật...', 56, 437),
(8, 'TV@123!', 'TRẦN T V', 'Nữ', '0986543782', 'Q.Gò Vấp, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 56, 438),
(9, 'AT!@#234', 'LÊ A T', 'Nữ', '0786843432', 'Q12, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 57, 439),
(10, 'HK#!@65', 'TRƯƠNG H K', 'Nam', '0437428435', 'H.Hóc Môn, TP.HCM', 'Giáo Sư', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 58, 440),
(14, 'TB@432', 'NGUYỄN T B', 'Nữ', '0324332423', 'H.Bình Chánh, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 60, 444),
(15, 'VH#!@564', 'TRỊNH V H', 'Nam', '0437343438', 'Q.7, TP.HCM', 'Tiến Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 62, 445),
(25, 'NAV123', 'NGUYỄN ANH VĂN', '', '', '', '', '', '', '', '', '', 56, 457),
(26, 'NSS@!12', 'NGUYỄN SANG SANG', '', '', '', '', '', '', '', '', '', 63, 458);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

CREATE TABLE `hocky` (
  `id_hocky` int(10) NOT NULL,
  `tenhocky` varchar(50) NOT NULL,
  `nienkhoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`id_hocky`, `tenhocky`, `nienkhoa`) VALUES
(1, '1', '2023-2024'),
(2, '2', '2023-2024'),
(3, '1', '2024-2025'),
(4, '2', '2024-2025');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocphan`
--

CREATE TABLE `hocphan` (
  `id_hocphan` int(10) NOT NULL,
  `mahocphan` varchar(50) NOT NULL,
  `tenhocphan` varchar(50) NOT NULL,
  `id_khoa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hocphan`
--

INSERT INTO `hocphan` (`id_hocphan`, `mahocphan`, `tenhocphan`, `id_khoa`) VALUES
(247, '4203003190', 'Hoạch Định Tài Nguyên Doanh Nghiệp', 40),
(248, '4203003191', 'Công Nghệ Mới Trong Phát Triển Ứng Dụng CNTT', 40),
(249, '4203003192', 'Lập Trình Phân Tích Dữ Liệu 2', 40),
(250, '4203003193', 'Các Hệ Thống Thông Minh Doanh Nghiệp', 40),
(251, '4203003194', 'Hệ Quản Trị Cơ Sở Dữ Liệu', 40),
(252, '4203003195', 'Phát Triển Ứng Dụng', 40),
(253, '4203003196', 'Phân Tích Thiết Kế Hệ Thống', 40),
(254, '4203003197', 'Quản Lý Dự Án', 40),
(255, '4203003198', 'Quản Trị Tác Nghiệp TMĐT', 40),
(256, '4203003300', 'Tư Tưởng Hồ Chí Minh', 42),
(257, '4203003301', 'Đường Lối Cách Mạng Của Đảng Cộng Sản Việt Nam', 42),
(258, '4203003302', 'Pháp Luật Đại Cương', 42),
(259, '4203003303', 'Luật Kinh Tế Chính Trị', 42),
(260, '4203003304', 'Luật Môi Trường', 42),
(285, '4203003401', 'Quản Trị Chuỗi Cung Ứng', 41),
(286, '4203003402', 'Quản Trị Bán Hàng', 41),
(287, '4203003403', 'Hành Vi Tổ Chức', 41),
(288, '4203003404', 'Quản Trị Nguồn Nhân Lực', 41),
(289, '4203003405', 'Quản Trị Doanh Nghiệp', 41),
(290, '4203003406', 'Giao Tiếp Kinh Doanh', 41),
(291, '4203003407', 'Quản Trị Chiến Lược', 41),
(293, '4203003408', 'Kinh Tế Vĩ Mô', 41);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoctap`
--

CREATE TABLE `hoctap` (
  `id_hoctap` int(10) NOT NULL,
  `id_sinhvien` int(10) DEFAULT NULL,
  `id_giangvienTH` int(10) DEFAULT NULL,
  `id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoctap`
--

INSERT INTO `hoctap` (`id_hoctap`, `id_sinhvien`, `id_giangvienTH`, `id`) VALUES
(39, 96, 8, 5),
(40, 97, 8, 5),
(41, 90, 8, 5),
(42, 98, 8, 5),
(43, 111, 8, 5),
(44, 112, 8, 5),
(45, 96, 7, 12),
(47, 93, 7, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoavien`
--

CREATE TABLE `khoavien` (
  `id_khoa` int(10) NOT NULL,
  `makhoa` varchar(50) NOT NULL,
  `tenkhoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoavien`
--

INSERT INTO `khoavien` (`id_khoa`, `makhoa`, `tenkhoa`) VALUES
(40, 'CNTT', 'Công Nghệ Thông Tin'),
(41, 'QTKD', 'Quản Trị Kinh Doanh'),
(42, 'LAW', 'Luật'),
(44, 'CNTP', 'Công Nghệ Thực Phẩm'),
(45, 'KTKT', 'Kế Toán - Kiểm Toán'),
(46, 'TCNH', 'Tài Chính Ngân Hàng'),
(47, 'TMDL', 'Thương Mại Du Lịch'),
(48, 'CNHH', 'Công Nghệ Hóa Học'),
(54, 'CNDM', 'Công Nghệ Dệt May'),
(55, 'QHCC', 'Quan Hệ Công Chúng'),
(56, 'CNSH', 'Công Nghệ Sinh Học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophocphan`
--

CREATE TABLE `lophocphan` (
  `id_lophocphan` int(10) NOT NULL,
  `malophocphan` varchar(50) DEFAULT NULL,
  `tenlophocphan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lophocphan`
--

INSERT INTO `lophocphan` (`id_lophocphan`, `malophocphan`, `tenlophocphan`) VALUES
(8, '420300319001', 'DHHTTT15A'),
(13, '420300319002', 'DHHTTT15B'),
(14, '420300319101', 'DHHTTT15A'),
(15, '420300319102', 'DHHTTT15B'),
(16, '420300319202', 'DHKHDL15B'),
(17, '420300319201', 'DHKHDL15A'),
(19, '420300319501', 'DHCNTT15A'),
(20, '420300319502', 'DHHTTT15A'),
(21, 'rgrgr', 'gfgsg'),
(22, 'vbfd', 'vfdvfd'),
(23, 'frgreg', 'rgg'),
(24, 'dff', 'fg'),
(25, 'ytyt', 'tytr'),
(26, 'grg', 'greg'),
(27, 're', 'fre'),
(29, 'trt', 'tr'),
(30, 'ef', 'ffe'),
(31, 'ff', 'efe'),
(32, 'freferf', 'frer'),
(33, 'gfdf', 'gfg'),
(34, '420300319301', 'DHHTTT15A');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monlop`
--

CREATE TABLE `monlop` (
  `id` int(10) NOT NULL,
  `thuhocLT` varchar(50) DEFAULT NULL,
  `thuhocTH` varchar(50) DEFAULT NULL,
  `tietbatdauLT` varchar(50) DEFAULT NULL,
  `tietketthucLT` varchar(50) DEFAULT NULL,
  `tietbatdauTH` varchar(50) DEFAULT NULL,
  `tietketthucTH` varchar(50) DEFAULT NULL,
  `phonghocLT` varchar(50) DEFAULT NULL,
  `phonghocTH` varchar(50) DEFAULT NULL,
  `id_hocphan` int(10) DEFAULT NULL,
  `id_lophocphan` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `monlop`
--

INSERT INTO `monlop` (`id`, `thuhocLT`, `thuhocTH`, `tietbatdauLT`, `tietketthucLT`, `tietbatdauTH`, `tietketthucTH`, `phonghocLT`, `phonghocTH`, `id_hocphan`, `id_lophocphan`) VALUES
(5, '3', '5', '4', '6', '7', '9', 'X10.05', 'H5.02', 247, 8),
(10, '2', '3', '4', '6', '10', '12', 'X10.05', 'H5.02', 247, 13),
(11, '6', '4', '4', '6', '7', '9', 'X11.09', 'H4.03', 248, 14),
(12, '2', '7', '13', '15', '1', '3', 'X11.05', 'H4.02', 248, 15),
(13, '7', '3', '4', '6', '10', '12', 'A1.03', 'H4.01', 249, 16),
(14, '7', '8', '10', '12', '4', '6', 'A1.03', 'H4.01', 249, 17),
(16, '2', '6', '1', '3', '7', '9', 'X8.04', 'V11.03', 252, 19),
(17, '4', '6', '1', '3', '4', '6', 'X8.04', 'H4.03', 252, 20),
(18, '3', '', '1', '3', '', '', 'gfdg', '', 274, 21),
(19, '2', '', '1', '3', '', '', 'vfd', '', 274, 22),
(20, '2', '', '1', '3', '', '', 'rgr', '', 275, 23),
(21, '2', '', '1', '3', '', '', 'fdvfd', '', 275, 24),
(22, '2', '', '1', '3', '', '', 'ytr', '', 276, 25),
(23, '2', '', '1', '3', '', '', 're', '', 277, 26),
(24, '2', '', '1', '3', '', '', 'fref', '', 278, 27),
(26, '2', '', '1', '3', '', '', 'tree', '', 280, 29),
(27, '2', '', '1', '3', '', '', 'frf', '', 281, 30),
(28, '2', '', '1', '3', '', '', 'fe', '', 282, 31),
(29, '2', '', '1', '3', '', '', 'grw', '', 283, 32),
(30, '2', '', '1', '3', '', '', 'gfgd', '', 292, 33),
(31, '3', '7', '1', '3', '10', '12', 'V8.05', 'H7.04', 250, 34);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id_sinhvien` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `tensinhvien` varchar(50) DEFAULT NULL,
  `masosinhvien` varchar(10) DEFAULT NULL,
  `gioitinh` varchar(50) DEFAULT NULL,
  `ngaysinh` varchar(50) DEFAULT NULL,
  `sdt` varchar(10) DEFAULT NULL,
  `ngaycap` varchar(50) DEFAULT NULL,
  `noicap` varchar(50) DEFAULT NULL,
  `diachilienhe` varchar(50) DEFAULT NULL,
  `hokhauthuongtru` varchar(50) DEFAULT NULL,
  `ngayvaotruong` varchar(50) DEFAULT NULL,
  `khoa` varchar(50) DEFAULT NULL,
  `lopCN` varchar(50) DEFAULT NULL,
  `cosodaotao` varchar(50) DEFAULT NULL,
  `trangthai` varchar(50) DEFAULT NULL,
  `id_chuyennganh` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`id_sinhvien`, `user_id`, `tensinhvien`, `masosinhvien`, `gioitinh`, `ngaysinh`, `sdt`, `ngaycap`, `noicap`, `diachilienhe`, `hokhauthuongtru`, `ngayvaotruong`, `khoa`, `lopCN`, `cosodaotao`, `trangthai`, `id_chuyennganh`) VALUES
(90, 403, 'NGUYỄN VĂN ANH', '19843211', 'Nam', '2001-07-14', '0324564730', '2023-02-02', 'Tây Ninh', 'Dương Minh Châu, Tây Ninh', 'Tây Ninh', '2019-08-14', '2019-2023', 'DH_CN_A', 'Cơ Sở 1 ( TP.HCM )', '1', 56),
(91, 404, 'NGUYỄN THỊ CHÍNH', '19435634', 'Nữ', '2001-08-16', '0432568918', '2022-12-01', 'TP.HCM', 'Hóc Môn, TP.HCM', 'TP.HCM', '2019-08-13', '2019-2023', 'DH_CN_B', 'Cơ Sở 1 ( TP.HCM )', '1', 57),
(92, 405, 'TRẦN HOÀNG ANH', '18231456', 'Nam', '2000-12-13', '0436275463', '2021-05-03', 'Bình Dương', 'Phú Giáo, Bình Dương', 'Bình Dương', '2018-08-14', '2018-2022', 'DH_CN_C', 'Cơ Sở 1 ( TP.HCM )', '1', 59),
(93, 406, 'PHÙNG NHÃ DƯƠNG', '17654321', 'Nữ', '1999-09-01', '0983462513', '2023-06-04', 'Bến Tre', 'Châu Thành, Bến Tre', 'Bến Tre', '2017-08-13', '2017-2021', 'DH_CN_D', 'Cơ Sở 1 ( TP.HCM )', '1', 63),
(94, 407, 'CAO QUÝ XUÂN', '21009876', 'Nữ', '2003-03-12', '0765237646', '2023-07-05', 'Bình Thuận', 'Phan Thiết, Bình Thuận', 'Bình Thuận', '2021-08-20', '2021-2025', 'DH_CN_E', 'Cơ Sở 1 ( TP.HCM )', '1', 60),
(95, 408, 'DƯƠNG CÔNG VINH', '20211473', 'Nam', '2002-05-06', '0356276432', '2022-03-04', 'Hà Nội', 'Hai Bà Trưng, Hà Nội', 'Hà Nội', '2020-08-15', '2020-2024', 'DH_CN_F', 'Cơ Sở 1 ( TP.HCM )', '1', 61),
(96, 409, 'NGUYỄN VĂN PHÚC', '19443131', 'Nam', '2001-12-09', '0325927624', '2023-03-02', 'Bình Phước', 'Chơn Thành, Bình Phước', 'Hương Toàn, Hương Trà, Thừa Thiên Huế', '2019-07-22', '2019-2023', 'DHHTTT15A', 'Cơ Sở 1 ( TP.HCM )', '1', 56),
(97, 410, 'LÊ THÀNH VINH', '19834251', 'Nam', '2001-08-15', '0322356423', '2021-08-01', 'Thanh Hóa', 'Thọ Xuân, Thanh Hóa', 'Thanh Hóa', '2019-08-16', '2019-2023', 'DHHTTT15A', 'Cơ Sở 1 ( TP.HCM )', '1', 56),
(98, 411, 'NGUYỄN NGỌC HIỆP', '12345678', 'Nữ', '2001-08-16', '0234543217', '2021-03-02', 'Sóc Trăng', 'Sóc Trăng', 'Sóc Trăng', '2019-08-14', '2019-2023', 'DH_CN_G', 'Cơ Sở 1 ( TP.HCM )', '1', 56),
(99, 412, 'NGUYỄN THANH VÂN', '13543212', 'Nữ', '2000-11-10', '0132474348', '2020-04-01', 'Trà Vinh', 'Trà Vinh', 'Trà Vinh', '2020-08-17', '2020-2024', 'DH_CN_H', 'Cơ Sở 1 ( TP.HCM )', '1', 69),
(110, 453, 'TRẦN TRỌNG TIẾN', '19234762', 'Nam', '2001-07-16', '0364249437', '2021-04-02', 'Đà Nẵng', 'Đà Nẵng', 'Đà Nẵng', '2019-08-14', '2019-2023', 'DH_CN_I', 'Cơ Sở 1 ( TP.HCM )', '1', 74),
(111, 454, 'NGUYỄN NHẬT NAM', '18934251', 'Nam', '2001-07-16', '0324756438', '2021-07-16', 'update...', 'update...', 'update...', '2021-07-16', 'update...', 'update...', 'update...', '1', 56),
(112, 459, 'NGUYỄN HOÀNG MỸ', '16534214', 'Nữ', '2001-07-02', '0546282488', '2021-07-13', 'update...', 'update...', 'update...', '2021-07-16', 'update...', 'update...', 'update...', '1', 56),
(113, 460, 'TRẦN TIẾN MINH', '16754633', 'Nam', '2023-12-13', '0473432575', '2023-12-13', '', '', '', '2023-12-13', '', '', '', '', 74),
(114, 461, 'NGUYỄN THỊ THẬP', '18964327', 'Nữ', '2023-12-13', '0327432844', '2023-12-13', '', '', '', '2023-12-13', '', '', '', '', 63);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongketruycap`
--

CREATE TABLE `thongketruycap` (
  `id_thongke` int(10) NOT NULL,
  `ngaytruycap` varchar(50) NOT NULL,
  `mahocphan` varchar(50) NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_sinhvien` int(10) DEFAULT NULL,
  `id_giangvien` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongketruycap`
--

INSERT INTO `thongketruycap` (`id_thongke`, `ngaytruycap`, `mahocphan`, `id_lophocphan`, `id_sinhvien`, `id_giangvien`) VALUES
(1, '2023-12-02 08:04:36', 'c4ca4238a0b923820dcc509a6f75849b', 4, 0, 1),
(2, '2023-12-03 04:25:52', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, 1),
(3, '2023-12-03 15:29:00', 'c4ca4238a0b923820dcc509a6f75849b', 1, 7, 0),
(4, '2023-12-13 22:43:07', '3cec07e9ba5f5bb252d13f5f431e4bbb', 8, 96, NULL),
(5, '2023-12-10 15:28:55', '621bf66ddb7c962aa0d22ac97d69b793', 15, 96, NULL),
(6, '2023-12-14 00:21:01', '3cec07e9ba5f5bb252d13f5f431e4bbb', 8, NULL, 7),
(7, '2023-12-12 11:04:10', '3cec07e9ba5f5bb252d13f5f431e4bbb', 13, NULL, 7),
(8, '2023-12-10 15:28:52', '077e29b11be80ab57e1a2ecabb7da330', 16, 96, NULL),
(9, '2023-12-12 11:13:34', '3cec07e9ba5f5bb252d13f5f431e4bbb', 8, 97, NULL),
(10, '2023-12-10 15:18:30', '621bf66ddb7c962aa0d22ac97d69b793', 14, 97, NULL),
(11, '2023-12-12 13:32:46', '621bf66ddb7c962aa0d22ac97d69b793', 14, NULL, 7),
(12, '2023-12-12 04:11:49', '03c6b06952c750899bb03d998e631860', 20, 96, NULL),
(13, '2023-12-14 00:21:08', '03c6b06952c750899bb03d998e631860', 20, NULL, 7),
(14, '2023-12-14 00:21:13', '621bf66ddb7c962aa0d22ac97d69b793', 15, NULL, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `id_tintuc` int(10) NOT NULL,
  `tieude` varchar(1000) NOT NULL,
  `noidung` mediumtext NOT NULL,
  `ngaydangtai` varchar(50) NOT NULL,
  `tacgia` varchar(50) NOT NULL,
  `anhdaidien` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`id_tintuc`, `tieude`, `noidung`, `ngaydangtai`, `tacgia`, `anhdaidien`) VALUES
(4, 'Seminar môn học: Lập trình phân tán với công nghệ Java', 'Ngày 16 tháng 11 năm 2023, tại phòng B2.14, bộ môn Kỹ Thuật Phần Mềm đã tổ chức seminar môn học: “Lập Trình Phân Tán Với Công Nghệ Java”. Mục đích nhầm rà soát, kiểm tra, thảo luận, đánh giá lại đề cương và chuẩn đầu ra của môn học để chuẩn bị cho học kỳ mới và định hướng phát triển phù hợp với xu thế ngành cho những năm học tiếp theo.<p></p>Tham gia buổi seminar gồm: Cô Nguyễn Thị Hạnh (trưởng bộ môn) chủ trì buổi seminar, cô Nguyễn Thị Hoàng Khánh (giảng viên phụ trách môn học) trình bày báo cáo seminar, toàn bộ giảng viên bộ môn Kỹ Thuật Phần Mềm và một số giảng viên thuộc bộ môn khác trong khoa Công Nghệ Thông Tin.<p></p><img src=\"https://qn.iuh.edu.vn/uploads/2023/05/Seminarbommon_HuynhTanHat_19.05.2023_01-1024x768.jpg\" width=\"100%\"><p></p>Cô Khánh trình bày báo cáo về đề cương môn học, chuẩn đầu ra của môn học, cách thức tổ chức giảng dạy, bài tập thực hành, và cách thức đánh giá kết quả học tập của sinh viên.<p></p>Các giảng viên tham gia buổi seminar đã thảo luận, đánh giá, đưa ra những ý kiến đóng góp kiến tích cực.<p></p>Sau buổi seminar, bô môn đã thống nhất và đưa ra những quyết định như sau:<p></p>Đề cương môn học được cập nhật phù hợp với xu hướng phát triển của ngành.\n<p></p>Chuẩn đầu ra của môn học được thống nhất.<p></p>\nCách thức tổ chức giảng dạy, bài tập thực hành, và cách thức đánh giá kết quả học tập của sinh viên.<p></p>\nCác giảng viên tham gia giảng dạy môn học.<p></p>\nGhi nhận những đóng góp tích cực từ toàn thể quý thầy cô tham dự.', '2023-12-07 10:18:21', 'BM KTPM', 'https://qn.iuh.edu.vn/uploads/2023/05/Seminarbommon_HuynhTanHat_19.05.2023_01-1024x768.jpg'),
(5, 'Kiến tập tại FPT Software', 'Vào sáng 09/11/2023, Khoa Công nghệ thông tin (CNTT) đã đồng hành cùng FPT Software (FSoft) đã tổ chức một buổi kiến tập tại Campus F-Town 3 của FPT Software HCM dành cho các sinh viên khoa CNTT. Đoàn kiến tập gồm có 180 sinh viên và 12 giảng viên thuộc tất cả các chuyên ngành của khoa CNTT.<p></p>\n\nTại buổi kiến tập, các bạn sinh viên đã khám phá rất nhiều điều thú vị:<p></p>\n\nTham quan tòa nhà F-Town 3 với cơ sở vật chất xin xò, đạt chuẩn quốc tế và lọt vào top những công trình kiến trúc độc đáo tại Việt Nam.<p></p>\nĐược gặp gỡ - giao lưu với các anh chị hiện đang công tác tại FSoft, các anh chị đã chia sẻ và giải đáp tất tần tật về các hoạt động, chính sách, mục tiêu của FSoft.<p></p>\nHiểu rõ hơn về các hoạt động hỗ trợ sinh viên của FSoft.<p></p>\nĐược chia sẻ các xu hướng nghề nghiệp trong lĩnh vực công nghệ thông tin.<p></p>\nLàm sao để trở thành một FSofter cùng với quyền lợi và cơ hội thăng tiến trong sự nghiệp.<p></p>\nNhận được nhiều phần quà hấp dẫn khi tham gia giao lưu, đặt câu hỏi, trả lời câu hỏi, …<p></p>\nBuổi kiến tập tại FSoft đã đã mang lại cho các bạn sinh viên những trải nghiệm thú vị, thiết thực và định hướng được rõ ràng hơn về nghề nghiệp trong tương lai.<p></p>\n\nKhoa CNTT chân thành cảm ơn nhóm đại diện của FSoft HCM đã chuẩn bị và tiếp đón đoàn sinh viên và giảng viên thật chu đáo và nồng nhiệt.<p></p>', '2023-12-07 10:18:21', 'Khoa CNTT', 'https://tse2.mm.bing.net/th?id=OIP.O82TSn8LPIdsKzzywfsFewHaE7&pid=Api&P=0&h=180');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tltk`
--

CREATE TABLE `tltk` (
  `id_tltk` int(10) NOT NULL,
  `tieude` varchar(50) DEFAULT NULL,
  `filetailieu` varchar(100) DEFAULT NULL,
  `ngaydang` varchar(50) NOT NULL,
  `loaitailieu` varchar(50) DEFAULT NULL,
  `id_giangday` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tltk`
--

INSERT INTO `tltk` (`id_tltk`, `tieude`, `filetailieu`, `ngaydang`, `loaitailieu`, `id_giangday`) VALUES
(13, 'Tài Liệu ERP', 'ODOO_11_DEVELOPMENT_COOKBOOK_SECOND_EDITION.pdf', '2023-12-10 09:55:55', 'GT', 113),
(14, 'Tài Liệu ERP 2', 'HOA_SEN_GROUP.pptx', '2023-12-10 09:56:55', 'GT', 113),
(15, 'Tài Liệu Thực Hành ERP', 'BTThucHanh_QUITRINHMUAHANG_SANXUAT_BANHANG_DaLoaiBoThucThi.pptx', '2023-12-10 10:02:15', 'BTTH', 113),
(16, 'Slide ERP', 'BTThucHanh_QUITRINHMUAHANG_SANXUAT_BANHANG_DaLoaiBoThucThi.pptx', '2023-12-10 10:13:54', 'Slide', 113),
(17, 'Code Tham Khảo', 'Code_TimKiemGiongNoi.txt', '2023-12-14 00:22:18', 'BTTH', 129);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_code` varchar(50) NOT NULL,
  `tenuser` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL,
  `vaitro` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cccd` varchar(50) NOT NULL,
  `anh` varchar(500) NOT NULL,
  `ttguigmailctk` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `user_code`, `tenuser`, `matkhau`, `vaitro`, `email`, `cccd`, `anh`, `ttguigmailctk`) VALUES
(1, '7293d9a83fd1b004bd308a75a494a900', 'Admin LMS', 'ad26764588c57e0df0b1908a2ea8110b', '2', 'phucable@gmail.com', '0462010001691', 'https://img4.thuthuatphanmem.vn/uploads/2019/12/16/hinh-nen-4k-thien-nhien-dep_024352261.jpg', '0'),
(403, '14a6cee614215777ba6d0c7da6564a1e', 'NVA', 'e10adc3949ba59abbe56e057f20f883e', '0', 'a@gmail.com', '123456543213', 'https://tse3.mm.bing.net/th?id=OIP.muVHXnoxN5sqaWcWPYaP9AHaHa&pid=Api&P=0&h=180', '0'),
(404, '2fed525adfda0d4c12f10aa06969ed52', 'NTC', 'e10adc3949ba59abbe56e057f20f883e', '0', 'cdf@gmail.com', '234543212346', 'https://tse2.mm.bing.net/th?id=OIP.YzD-_W1DbK6T_RJsubfP-AHaHu&pid=Api&P=0&h=180', '0'),
(405, '000afb078ba06cc67f7dc8af85f51653', 'THA', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ngh@gmail.com', '564327891653', 'https://tse1.mm.bing.net/th?id=OIP.qilJV7ubqk5vAxS2OosDpwHaEK&pid=Api&P=0&h=180', '0'),
(406, 'e068ff48f0966deade935517d6b4686a', 'PND', 'e10adc3949ba59abbe56e057f20f883e', '0', 'dscav123@gmail.com', '202134759732', 'https://tse1.mm.bing.net/th?id=OIP.__KSg8Z9Gel4X72iZq7-TQAAAA&pid=Api&P=0&h=180', '0'),
(407, '016c49feb11d7b59b43334f3d0abc625', 'CQX', 'e10adc3949ba59abbe56e057f20f883e', '0', 'csd@gmail.com', '468392273299', 'https://tse2.mm.bing.net/th?id=OIP.Fp17kvdPgldtZy5Ltc0SyAHaFj&pid=Api&P=0&h=180', '0'),
(408, '876decd843c23e5326cb2bc0bad96ba7', 'DCV', 'e10adc3949ba59abbe56e057f20f883e', '0', 'hyd@gmail.com', '374393232329', 'https://tse3.explicit.bing.net/th?id=OIP.ftPQ-uCCPygrJ0xt56I-0AHaE5&pid=Api&P=0&h=180', '0'),
(409, '92ce57f69cd43af85d3ff171984854b2', 'PN', 'e10adc3949ba59abbe56e057f20f883e', '0', 'phucable@gmail.com', '0462010001692', 'tn.jpg', '1'),
(410, '38b32a214ffd3419ef83013be6b49391', 'LTV', 'e10adc3949ba59abbe56e057f20f883e', '0', 'levinh@gmail.com', '123456543212', 'https://tse3.mm.bing.net/th?id=OIP.0DrnRWMVgN8AvQ6Eu9H_hwHaEp&pid=Api&P=0&h=180', '0'),
(411, '25d55ad283aa400af464c76d713c07ad', 'NNH', 'e10adc3949ba59abbe56e057f20f883e', '0', 'nnh@gmail.com', '434267846575', 'ttps://tse3.mm.bing.net/th?id=OIP.PPWrG4bdXOR1pdbEepawkQHaE8&pid=Api&P=0&h=180', '0'),
(412, 'b7eca66772ae7f9c87850b22198956ee', 'NTV', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ntv@gmail.com', '743643937534', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(437, '354f31b1031ca6dddf783514597ab0b2', 'NTX', 'e10adc3949ba59abbe56e057f20f883e', '1', 'ntx@gmail.com', '034521678543', 'https://tse1.mm.bing.net/th?id=OIP.UVTTiTmngViDKz-1ylEfVgHaEK&pid=Api&P=0&h=180', '1'),
(438, '03248bac15a680f70d8e40491890805e', 'TTV', 'e10adc3949ba59abbe56e057f20f883e', '1', 'tv@gmail.com', '032453628163', 'https://tse2.mm.bing.net/th?id=OIP.nQu8R0IhYo4v3wVrNJ1O0wHaEK&pid=Api&P=0&h=180', '0'),
(439, '228e9061edbaf03310f27808291591ef', 'LAT', 'e10adc3949ba59abbe56e057f20f883e', '1', 'at@gmail.com', '065748362746', 'https://tse1.mm.bing.net/th?id=OIP.AXveYTaAri_83-WLMvoVAQHaE8&pid=Api&P=0&h=180', '0'),
(440, 'bba72ca3dd728f039abd56f3e8a1c6a7', 'THK', 'e10adc3949ba59abbe56e057f20f883e', '1', 'hk@gmail.com', '098563333732', 'https://tse1.mm.bing.net/th?id=OIP.IH9e7CoH0QjKu-RKqOIpRQHaEo&pid=Api&P=0&h=180', '0'),
(444, 'ff18fc2eabec6ddb5ed492fd0483e062', 'NTB', 'e10adc3949ba59abbe56e057f20f883e', '1', 'tb@gmail.com', '000326323200', 'https://tse4.mm.bing.net/th?id=OIP.0JuZAC5zIFrNGR3IyAenxwHaEK&pid=Api&P=0&h=180', '0'),
(445, '9e0c8c7b39444e4c928e1e05de87f793', 'TVH', 'e10adc3949ba59abbe56e057f20f883e', '1', 'vh@gmail..com', '046343200434', 'https://tse2.mm.bing.net/th?id=OIP.DCheUVZyF_GmJWFFo6cJ0QAAAA&pid=Api&P=0&h=180', '0'),
(453, '8020461cbd8d99ed35c2b2ddedd0523f', 'TTT', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ttt@gmail.com', '364343248344', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(454, '626fd80919df0b3cbd8c0442a83b9ee5', 'NNN', 'e10adc3949ba59abbe56e057f20f883e', '0', 'nnn@gmail.com', 'update...', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(457, '164f258dcdc72961d72160d641499f31', 'NAV', 'e10adc3949ba59abbe56e057f20f883e', '1', '', '', '', '0'),
(458, '1354f521e62b1191c350c1038721b374', 'NSS', 'e10adc3949ba59abbe56e057f20f883e', '1', '', '', '', '0'),
(459, '680646901bca4bdc422ae47b92970e85', 'NHM', 'e10adc3949ba59abbe56e057f20f883e', '0', 'nhm@gmail.com', 'update...', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(460, '3edc05bc1d20693595179d4fa27b39dd', 'TTM', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ttm@gmail.com', '', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(461, '666e29b189a83367706d31d8f62bab54', 'NTT', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ntt@gmail.com', '', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_ad`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `baitaplythuyet`
--
ALTER TABLE `baitaplythuyet`
  ADD PRIMARY KEY (`id_btlt`),
  ADD KEY `id_giangday` (`id_giangday`);

--
-- Chỉ mục cho bảng `baitapthuchanh`
--
ALTER TABLE `baitapthuchanh`
  ADD PRIMARY KEY (`id_btth`),
  ADD KEY `id_sinhvien` (`ngaydang`,`id_giangday`),
  ADD KEY `id_giangday` (`id_giangday`);

--
-- Chỉ mục cho bảng `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD PRIMARY KEY (`id_chuyennganh`),
  ADD KEY `id_khoa` (`id_khoa`),
  ADD KEY `id_khoa_2` (`id_khoa`);

--
-- Chỉ mục cho bảng `ct_hocphan`
--
ALTER TABLE `ct_hocphan`
  ADD PRIMARY KEY (`id_chitiethp`),
  ADD KEY `id_hocphan` (`id_hocphan`),
  ADD KEY `id_hocphan_2` (`id_hocphan`),
  ADD KEY `id_hocphan_3` (`id_hocphan`);

--
-- Chỉ mục cho bảng `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`id_diem`),
  ADD KEY `id_sinhvien` (`id_sinhvien`),
  ADD KEY `id_hocphan` (`id_hocphan`),
  ADD KEY `id_lophocphan` (`id_lophocphan`);

--
-- Chỉ mục cho bảng `dkhp`
--
ALTER TABLE `dkhp`
  ADD PRIMARY KEY (`id_dkhp`),
  ADD KEY `id_sinhvien` (`id_sinhvien`,`id_hocphan`);

--
-- Chỉ mục cho bảng `filediem`
--
ALTER TABLE `filediem`
  ADD PRIMARY KEY (`id_filediem`),
  ADD KEY `id_giangvien` (`id_giangvien`),
  ADD KEY `id_giangvien_2` (`id_giangvien`),
  ADD KEY `id_giangvien_3` (`id_giangvien`),
  ADD KEY `id_hocphan` (`id_hocphan`),
  ADD KEY `id_lophocphan` (`id_lophocphan`);

--
-- Chỉ mục cho bảng `filenopbtlt`
--
ALTER TABLE `filenopbtlt`
  ADD PRIMARY KEY (`id_filenopbtlt`),
  ADD KEY `id_btlt` (`id_btlt`,`id_sinhvien`);

--
-- Chỉ mục cho bảng `filenopbtth`
--
ALTER TABLE `filenopbtth`
  ADD PRIMARY KEY (`id_filenopbtth`),
  ADD KEY `id_sinhvien` (`id_sinhvien`,`id_btth`);

--
-- Chỉ mục cho bảng `giangday`
--
ALTER TABLE `giangday`
  ADD PRIMARY KEY (`id_giangday`),
  ADD KEY `id_giangvien` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`id_giangvien`),
  ADD KEY `id_taikhoan` (`user_id`),
  ADD KEY `id_chuyennganh` (`id_chuyennganh`);

--
-- Chỉ mục cho bảng `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`id_hocky`);

--
-- Chỉ mục cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`id_hocphan`),
  ADD KEY `id_khoa` (`id_khoa`),
  ADD KEY `id_khoa_2` (`id_khoa`);

--
-- Chỉ mục cho bảng `hoctap`
--
ALTER TABLE `hoctap`
  ADD PRIMARY KEY (`id_hoctap`),
  ADD KEY `id_sinhvien` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Chỉ mục cho bảng `khoavien`
--
ALTER TABLE `khoavien`
  ADD PRIMARY KEY (`id_khoa`);

--
-- Chỉ mục cho bảng `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`id_lophocphan`);

--
-- Chỉ mục cho bảng `monlop`
--
ALTER TABLE `monlop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hocphan` (`id_hocphan`,`id_lophocphan`),
  ADD KEY `id_lophocphan` (`id_lophocphan`),
  ADD KEY `id_hocphan_2` (`id_hocphan`),
  ADD KEY `id_hocphan_3` (`id_hocphan`),
  ADD KEY `id_lophocphan_2` (`id_lophocphan`),
  ADD KEY `id_lophocphan_3` (`id_lophocphan`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id_sinhvien`),
  ADD UNIQUE KEY `id_taikhoan_3` (`user_id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `id_taikhoan` (`user_id`),
  ADD KEY `id_taikhoan_2` (`user_id`),
  ADD KEY `id_taikhoan_4` (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_3` (`user_id`),
  ADD KEY `user_id_4` (`user_id`),
  ADD KEY `user_id_5` (`user_id`),
  ADD KEY `user_id_6` (`user_id`),
  ADD KEY `id_chuyennganh_3` (`id_chuyennganh`);

--
-- Chỉ mục cho bảng `thongketruycap`
--
ALTER TABLE `thongketruycap`
  ADD PRIMARY KEY (`id_thongke`),
  ADD KEY `id_hocphan` (`mahocphan`,`id_lophocphan`,`id_sinhvien`,`id_giangvien`),
  ADD KEY `id_hocphan_2` (`mahocphan`),
  ADD KEY `id_lophocphan` (`id_lophocphan`),
  ADD KEY `id_sinhvien` (`id_sinhvien`),
  ADD KEY `id_giangvien` (`id_giangvien`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id_tintuc`);

--
-- Chỉ mục cho bảng `tltk`
--
ALTER TABLE `tltk`
  ADD PRIMARY KEY (`id_tltk`),
  ADD KEY `id_giangday` (`id_giangday`),
  ADD KEY `id_giangday_2` (`id_giangday`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id_ad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `baitaplythuyet`
--
ALTER TABLE `baitaplythuyet`
  MODIFY `id_btlt` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `baitapthuchanh`
--
ALTER TABLE `baitapthuchanh`
  MODIFY `id_btth` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `chuyennganh`
--
ALTER TABLE `chuyennganh`
  MODIFY `id_chuyennganh` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `ct_hocphan`
--
ALTER TABLE `ct_hocphan`
  MODIFY `id_chitiethp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT cho bảng `diem`
--
ALTER TABLE `diem`
  MODIFY `id_diem` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `dkhp`
--
ALTER TABLE `dkhp`
  MODIFY `id_dkhp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT cho bảng `filediem`
--
ALTER TABLE `filediem`
  MODIFY `id_filediem` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `filenopbtlt`
--
ALTER TABLE `filenopbtlt`
  MODIFY `id_filenopbtlt` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `filenopbtth`
--
ALTER TABLE `filenopbtth`
  MODIFY `id_filenopbtth` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `giangday`
--
ALTER TABLE `giangday`
  MODIFY `id_giangday` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `id_giangvien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `hocky`
--
ALTER TABLE `hocky`
  MODIFY `id_hocky` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `id_hocphan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT cho bảng `hoctap`
--
ALTER TABLE `hoctap`
  MODIFY `id_hoctap` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `khoavien`
--
ALTER TABLE `khoavien`
  MODIFY `id_khoa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `lophocphan`
--
ALTER TABLE `lophocphan`
  MODIFY `id_lophocphan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `monlop`
--
ALTER TABLE `monlop`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id_sinhvien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT cho bảng `thongketruycap`
--
ALTER TABLE `thongketruycap`
  MODIFY `id_thongke` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id_tintuc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tltk`
--
ALTER TABLE `tltk`
  MODIFY `id_tltk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
