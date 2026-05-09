-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2026 at 04:00 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qlhv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_ad` int(10) NOT NULL auto_increment,
  `hotenadmin` varchar(50) NOT NULL,
  `loigioithieu` varchar(10000) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY  (`id_ad`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_ad`, `hotenadmin`, `loigioithieu`, `user_id`) VALUES
(1, 'Thuong Hoai', 'haha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `baitaplythuyet`
--

CREATE TABLE `baitaplythuyet` (
  `id_btlt` int(10) NOT NULL auto_increment,
  `tieude` varchar(50) NOT NULL,
  `filebt` varchar(50) NOT NULL,
  `batdaunop` varchar(50) NOT NULL,
  `ketthucnop` varchar(50) NOT NULL,
  `ngaydang` varchar(50) NOT NULL,
  `id_giangday` int(10) NOT NULL,
  PRIMARY KEY  (`id_btlt`),
  KEY `id_giangday` (`id_giangday`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `baitaplythuyet`
--

INSERT INTO `baitaplythuyet` (`id_btlt`, `tieude`, `filebt`, `batdaunop`, `ketthucnop`, `ngaydang`, `id_giangday`) VALUES
(1, 'Bài Tập Nhóm', 'Bai_Tap_Nhom_ERP.docx', '2023-12-01T17:25', '2023-12-03T17:25', '2023-12-01 17:27:35', 5),
(2, 'Bài Tập 1', 'Bai_Tap_Nhom_ERP.docx', '2023-12-01T10:00', '2023-12-12T10:00', '2023-12-03 10:00:29', 5),
(7, 'Bài Tập ERP ( Làm Cá Nhân )', 'Bai_Tap_Ca_Nhan.docx', '2023-12-07T18:20', '2023-12-08T18:20', '2023-12-06 18:21:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `baitapthuchanh`
--

CREATE TABLE `baitapthuchanh` (
  `id_btth` int(10) NOT NULL auto_increment,
  `tieude` varchar(50) NOT NULL,
  `batdaunop` varchar(50) NOT NULL,
  `ketthucnop` varchar(50) NOT NULL,
  `ngaydang` varchar(50) NOT NULL,
  `loaibai` varchar(50) NOT NULL,
  `id_giangday` int(10) NOT NULL,
  PRIMARY KEY  (`id_btth`),
  KEY `id_sinhvien` (`ngaydang`,`id_giangday`),
  KEY `id_giangday` (`id_giangday`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `baitapthuchanh`
--

INSERT INTO `baitapthuchanh` (`id_btth`, `tieude`, `batdaunop`, `ketthucnop`, `ngaydang`, `loaibai`, `id_giangday`) VALUES
(2, 'Nộp Bài Kiểm Tra TH1', '2023-12-06T16:00', '2023-12-06T19:00', '2023-12-06 16:33:07', 'KTTH', 1),
(4, 'pkkp', '2026-04-30T17:00', '2026-04-30T18:01', '2026-04-30 17:00:50', 'KTTH', 1),
(5, 'nộp ngay bây giờ', '2026-05-02T12:24', '2026-05-29T12:24', '2026-05-02 12:24:52', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `id_chuyennganh` int(10) NOT NULL auto_increment,
  `machuyennganh` varchar(50) NOT NULL,
  `tenchuyennganh` varchar(50) NOT NULL,
  `id_khoa` int(10) NOT NULL,
  PRIMARY KEY  (`id_chuyennganh`),
  KEY `id_khoa` (`id_khoa`),
  KEY `id_khoa_2` (`id_khoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`id_chuyennganh`, `machuyennganh`, `tenchuyennganh`, `id_khoa`) VALUES
(1, 'HTTT', 'Hệ Thống Thông Tin', 1),
(2, 'CNTT', 'Công Nghệ Thông Tin', 1),
(3, 'KHMT', 'Khoa Học Máy Tính', 1),
(16, 'KTPM', 'Kỹ Thuật Phần Mềm', 1),
(17, 'QTKD', 'Quản Trị Kinh Doanh', 2),
(18, 'QTNNL', 'Quản Trị Nguồn Nhân Lực', 2),
(19, 'ELAW', 'Luật Kinh Tế', 3),
(20, 'ILAW', 'Luật Quốc Tế', 3),
(21, 'KeT', 'Kế Toán', 20),
(22, 'KiT', 'Kiểm Toán', 20),
(23, 'KTHH', 'Kỹ Thuật Hóa Học', 23),
(24, 'HPT', 'Hóa Phân Tích', 23),
(25, 'SHYD', 'Sinh Học Y Dược', 4),
(26, 'SHNN', 'Sinh Học Nông Nghiệp', 4),
(27, 'SHTM', 'Sinh Học Thẩm Mỹ', 4),
(28, 'YDP', 'Y Dược Phẩm', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ct_hocphan`
--

CREATE TABLE `ct_hocphan` (
  `id_chitiethp` int(10) NOT NULL auto_increment,
  `id_hocphan` int(10) NOT NULL,
  `loaihp` varchar(50) NOT NULL,
  `soTC` int(10) NOT NULL,
  `TCLT` int(10) NOT NULL,
  `TCTH` int(10) NOT NULL,
  PRIMARY KEY  (`id_chitiethp`),
  KEY `id_hocphan` (`id_hocphan`),
  KEY `id_hocphan_2` (`id_hocphan`),
  KEY `id_hocphan_3` (`id_hocphan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `ct_hocphan`
--

INSERT INTO `ct_hocphan` (`id_chitiethp`, `id_hocphan`, `loaihp`, `soTC`, `TCLT`, `TCTH`) VALUES
(1, 1, 'LT & TH', 3, 2, 1),
(2, 2, 'LT & TH', 3, 1, 2),
(3, 3, 'LT & TH', 3, 1, 2),
(4, 4, 'LT & TH', 3, 2, 1),
(6, 6, 'LT & TH', 3, 1, 2),
(8, 8, 'LT', 3, 3, 0),
(34, 34, 'LT', 3, 3, 0),
(46, 46, 'LT', 3, 3, 0),
(47, 47, 'LT & TH', 3, 1, 2),
(48, 48, 'LT', 3, 3, 0),
(49, 49, 'LT', 2, 2, 0),
(50, 50, 'LT', 3, 3, 0),
(51, 51, 'LT', 3, 3, 0),
(52, 52, 'LT', 4, 4, 0),
(53, 53, 'LT', 3, 3, 0),
(60, 60, 'LT', 3, 3, 0),
(61, 61, 'LT', 3, 3, 0),
(62, 62, 'LT', 3, 3, 0),
(63, 63, 'LT', 3, 3, 0),
(64, 64, 'LT', 2, 2, 0),
(65, 65, 'LT', 3, 0, 0),
(66, 66, 'LT & TH', 3, 1, 2),
(67, 67, 'LT', 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `diem`
--

CREATE TABLE `diem` (
  `id_diem` int(10) NOT NULL auto_increment,
  `TK1` varchar(50) NOT NULL,
  `TK2` varchar(50) NOT NULL,
  `TK3` varchar(50) NOT NULL,
  `GK` varchar(50) NOT NULL,
  `TH1` varchar(50) NOT NULL,
  `TH2` varchar(50) NOT NULL,
  `TH3` varchar(50) NOT NULL,
  `CK` varchar(50) NOT NULL,
  `diemtb` varchar(50) NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  PRIMARY KEY  (`id_diem`),
  KEY `id_sinhvien` (`id_sinhvien`),
  KEY `id_hocphan` (`id_hocphan`),
  KEY `id_lophocphan` (`id_lophocphan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `diem`
--

INSERT INTO `diem` (`id_diem`, `TK1`, `TK2`, `TK3`, `GK`, `TH1`, `TH2`, `TH3`, `CK`, `diemtb`, `id_lophocphan`, `id_sinhvien`, `id_hocphan`) VALUES
(26, '6', '5', '5', '6', '5', '6', '7', '6', '9.7', 1, 7, 1),
(27, '2', '10', '9', '8', '7', '8', '9', '4', '8.5', 1, 1, 1),
(28, '10', '9', '9', '8', '9', '8', '9', '8', '8.5', 7, 7, 2),
(29, '9', '9', '8', '9', '8', '9', '9', '10', '', 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dkhp`
--

CREATE TABLE `dkhp` (
  `id_dkhp` int(10) NOT NULL auto_increment,
  `id_sinhvien` int(10) NOT NULL,
  `id_hocphan` varchar(10) NOT NULL,
  `ngaydk` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_dkhp`),
  KEY `id_sinhvien` (`id_sinhvien`,`id_hocphan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `dkhp`
--

INSERT INTO `dkhp` (`id_dkhp`, `id_sinhvien`, `id_hocphan`, `ngaydk`) VALUES
(1, 7, '1', '2023-12-03 21:25:32'),
(2, 1, '1', '2023-12-04 17:16:30'),
(11, 8, '1', '2023-12-05 11:19:44'),
(12, 9, '1', '2023-12-05 11:19:44'),
(13, 21, '1', '2023-12-05 11:19:44'),
(14, 7, '2', '2023-12-06 06:52:47'),
(15, 7, '3', '2023-12-06 06:53:04'),
(16, 7, '4', '2023-12-06 06:53:19'),
(17, 1, '4', '2023-12-08 00:04:34'),
(18, 8, '4', '2023-12-08 00:04:34'),
(19, 9, '4', '2023-12-08 00:04:34'),
(20, 21, '4', '2023-12-08 00:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `filediem`
--

CREATE TABLE `filediem` (
  `id_filediem` int(10) NOT NULL auto_increment,
  `filediem` varchar(100) NOT NULL,
  `ngaydang` varchar(50) NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  `id_giangvien` int(10) NOT NULL,
  PRIMARY KEY  (`id_filediem`),
  KEY `id_giangvien` (`id_giangvien`),
  KEY `id_giangvien_2` (`id_giangvien`),
  KEY `id_giangvien_3` (`id_giangvien`),
  KEY `id_hocphan` (`id_hocphan`),
  KEY `id_lophocphan` (`id_lophocphan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `filediem`
--

INSERT INTO `filediem` (`id_filediem`, `filediem`, `ngaydang`, `id_lophocphan`, `id_hocphan`, `id_giangvien`) VALUES
(8, 'mau_nhap_diem.xlsx', '2023-12-08 18:31:44', 1, 1, 1),
(9, 'DSSV.Công Nghệ Mới Trong Phát Triển Ứng Dụng CNTT.DHHTTT15B.xlsx', '2023-12-12 09:35:15', 7, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `filenopbtlt`
--

CREATE TABLE `filenopbtlt` (
  `id_filenopbtlt` int(10) NOT NULL auto_increment,
  `tieude` varchar(50) NOT NULL,
  `filenop` varchar(50) NOT NULL,
  `ngaynop` varchar(50) NOT NULL,
  `id_btlt` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  PRIMARY KEY  (`id_filenopbtlt`),
  KEY `id_btlt` (`id_btlt`,`id_sinhvien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `filenopbtlt`
--


-- --------------------------------------------------------

--
-- Table structure for table `filenopbtth`
--

CREATE TABLE `filenopbtth` (
  `id_filenopbtth` int(10) NOT NULL auto_increment,
  `tieude` varchar(50) NOT NULL,
  `filenop` varchar(50) NOT NULL,
  `ngaynop` varchar(50) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_btth` int(10) NOT NULL,
  PRIMARY KEY  (`id_filenopbtth`),
  KEY `id_sinhvien` (`id_sinhvien`,`id_btth`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `filenopbtth`
--

INSERT INTO `filenopbtth` (`id_filenopbtth`, `tieude`, `filenop`, `ngaynop`, `id_sinhvien`, `id_btth`) VALUES
(11, '2268809122_Hoai', 'baocao_lab5_final.docx', '2026-05-02 12:27:53', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `giangday`
--

CREATE TABLE `giangday` (
  `id_giangday` int(10) NOT NULL auto_increment,
  `id_giangvien` int(10) NOT NULL,
  `id_giangvienTH1` int(10) NOT NULL,
  `id_giangvienTH2` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  PRIMARY KEY  (`id_giangday`),
  KEY `id_giangvien` (`id_giangvien`,`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_giangvien_2` (`id_giangvien`),
  KEY `id_giangvien(TH)` (`id_giangvienTH1`),
  KEY `id_giangvienTH2` (`id_giangvienTH2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `giangday`
--

INSERT INTO `giangday` (`id_giangday`, `id_giangvien`, `id_giangvienTH1`, `id_giangvienTH2`, `id`) VALUES
(1, 1, 1, 0, 1),
(2, 2, 2, 1, 4),
(4, 6, 0, 0, 14),
(5, 1, 1, 0, 7),
(6, 1, 4, 0, 12),
(7, 1, 2, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `id_giangvien` int(10) NOT NULL auto_increment,
  `magiangvien` varchar(50) NOT NULL,
  `hotengiangvien` varchar(50) NOT NULL,
  `gioitinh` varchar(50) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `diachi` varchar(50) NOT NULL,
  `hocvi` varchar(50) NOT NULL,
  `quatrinhcongtac` varchar(1000) NOT NULL,
  `cosogiangday` varchar(50) NOT NULL,
  `chungchi` varchar(50) NOT NULL,
  `chungchikhac` varchar(1000) NOT NULL,
  `congtrinhkhoahoctieubieu` varchar(1000) NOT NULL,
  `id_chuyennganh` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY  (`id_giangvien`),
  KEY `id_taikhoan` (`user_id`),
  KEY `id_chuyennganh` (`id_chuyennganh`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`id_giangvien`, `magiangvien`, `hotengiangvien`, `gioitinh`, `sdt`, `diachi`, `hocvi`, `quatrinhcongtac`, `cosogiangday`, `chungchi`, `chungchikhac`, `congtrinhkhoahoctieubieu`, `id_chuyennganh`, `user_id`) VALUES
(1, 'TT@#123', 'Trần Phúc Minh Châu', 'Nam', '0324536212', 'Q1, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 1, 13),
(2, 'TV@123!', 'TRẦN T V', 'Nữ', '0986543782', 'Q.Gò Vấp, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 1, 14),
(3, 'AT!@#234', 'LÊ A T', 'Nữ', '0786843432', 'Q12, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 2, 15),
(4, 'HK#!@65', 'TRƯƠNG H K', 'Nam', '0437428435', 'H.Hóc Môn, TP.HCM', 'Giáo Sư', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 3, 16),
(5, 'TB@432', 'NGUYỄN T B', 'Nữ', '0324332423', 'H.Bình Chánh, TP.HCM', 'Thạc Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 5, 17),
(6, 'VH#!@564', 'TRỊNH V H', 'Nam', '0437343438', 'Q.7, TP.HCM', 'Tiến Sĩ', 'Đang cập nhật...', 'Cơ Sở 1 ( TP.HCM )', 'Đang cập nhật...', 'Đang cập nhật...', 'Đang cập nhật...', 7, 18);

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `id_hocky` int(10) NOT NULL auto_increment,
  `tenhocky` varchar(50) NOT NULL,
  `nienkhoa` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_hocky`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hocky`
--

INSERT INTO `hocky` (`id_hocky`, `tenhocky`, `nienkhoa`) VALUES
(1, '1', '2023-2024'),
(2, '2', '2023-2024'),
(3, '1', '2024-2025'),
(4, '2', '2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `id_hocphan` int(10) NOT NULL auto_increment,
  `mahocphan` varchar(50) NOT NULL,
  `tenhocphan` varchar(50) NOT NULL,
  `id_khoa` int(10) NOT NULL,
  PRIMARY KEY  (`id_hocphan`),
  KEY `id_khoa` (`id_khoa`),
  KEY `id_khoa_2` (`id_khoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`id_hocphan`, `mahocphan`, `tenhocphan`, `id_khoa`) VALUES
(1, '4203003190', 'Hoạch Định Tài Nguyên Doanh Nghiệp', 1),
(2, '4203003191', 'Công Nghệ Mới Trong Phát Triển Ứng Dụng CNTT', 1),
(3, '4203003192', 'Lập Trình Phân Tích Dữ Liệu 2', 1),
(4, '4203003193', 'Các Hệ Thống Thông Minh Doanh Nghiệp', 1),
(6, '4203003195', 'Phát Triển Ứng Dụng', 1),
(8, '4203003197', 'Quản Lý Dự Án', 1),
(34, '4203003300', 'Tư Tưởng Hồ Chí Minh', 3),
(46, '4203003301', 'Đường Lối Cách Mạng Của Đảng Cộng Sản Việt Nam', 3),
(47, '4203003196', 'Phân Tích Thiết Kế Hệ Thống', 1),
(48, '4203003198', 'Quản Trị Tác Nghiệp TMĐT', 1),
(49, '4203003302', 'Pháp Luật Đại Cương', 3),
(50, '4203003303', 'Luật Kinh Tế Chính Trị', 3),
(51, '4203003304', 'Luật Môi Trường', 3),
(52, '4203003401', 'Quản Trị Chuỗi Cung Ứng', 2),
(53, '4203003402', 'Quản Trị Bán Hàng', 2),
(60, '4203003403', 'Hành Vi Tổ Chức', 2),
(61, '4203003404', 'Quản Trị Nguồn Nhân Lực', 2),
(62, '4203003405', 'Quản Trị Doanh Nghiệp', 2),
(63, '4203003406', 'Giao Tiếp Kinh Doanh', 2),
(64, '4203003407', 'Quản Trị Chiến Lược', 2),
(65, '4203003408', 'Kinh Tế Vĩ Mô', 2),
(66, '4203003194', 'Hệ Quản Trị Cơ Sở Dữ Liệu', 1),
(67, '4203003409', 'Toán Cao Cấp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hoctap`
--

CREATE TABLE `hoctap` (
  `id_hoctap` int(10) NOT NULL auto_increment,
  `id_sinhvien` int(10) NOT NULL,
  `id_giangvienTH` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  PRIMARY KEY  (`id_hoctap`),
  KEY `id_sinhvien` (`id_sinhvien`,`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_giangvienTH` (`id_giangvienTH`),
  KEY `id_giangvienTH_2` (`id_giangvienTH`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `hoctap`
--

INSERT INTO `hoctap` (`id_hoctap`, `id_sinhvien`, `id_giangvienTH`, `id`) VALUES
(1, 7, 1, 1),
(2, 1, 1, 1),
(11, 8, 2, 4),
(12, 9, 2, 4),
(13, 21, 2, 4),
(14, 7, 1, 7),
(15, 7, 2, 9),
(16, 7, 4, 12),
(17, 1, 4, 12),
(18, 8, 4, 12),
(19, 9, 4, 12),
(20, 21, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `khoavien`
--

CREATE TABLE `khoavien` (
  `id_khoa` int(10) NOT NULL auto_increment,
  `makhoa` varchar(50) NOT NULL,
  `tenkhoa` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_khoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `khoavien`
--

INSERT INTO `khoavien` (`id_khoa`, `makhoa`, `tenkhoa`) VALUES
(1, 'CNTT', 'Công Nghệ Thông Tin'),
(2, 'QTKD', 'Quản Trị Kinh Doanh'),
(3, 'LAW', 'Luật'),
(4, 'CNSH', 'Công Nghệ Sinh Học'),
(19, 'CNTP', 'Công Nghệ Thực Phẩm'),
(20, 'KTKT', 'Kế Toán - Kiểm Toán'),
(21, 'TCNH', 'Tài Chính Ngân Hàng'),
(22, 'TMDL', 'Thương Mại Du Lịch'),
(23, 'CNHH', 'Công Nghệ Hóa Học'),
(24, 'CNDM', 'Công Nghệ Dệt May'),
(25, 'QHCC', 'Quan Hệ Công Chúng'),
(26, '90', 'CONG AN'),
(28, 'LKT', 'Luật Kinh Tế');

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan`
--

CREATE TABLE `lophocphan` (
  `id_lophocphan` int(10) NOT NULL auto_increment,
  `malophocphan` varchar(50) NOT NULL,
  `tenlophocphan` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_lophocphan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `lophocphan`
--

INSERT INTO `lophocphan` (`id_lophocphan`, `malophocphan`, `tenlophocphan`) VALUES
(1, '420300319001', 'DHHTTT15A'),
(4, '420300319002', 'DHHTTT15B'),
(5, '420300319003', 'DHHTTT15C'),
(6, '420300319101', 'DHHTTT15A'),
(7, '420300319102', 'DHHTTT15B'),
(8, '420300319103', 'DHHTTT15C'),
(9, '420300319201', 'DHKHDL15A'),
(10, '420300319202', 'DHKHDL15B'),
(11, '420300319203', 'DHKHDL15C'),
(12, '420300319301', 'DHHTTT15A'),
(13, '420300319302', 'DHHTTT15B'),
(14, '420300330201', 'DHL15'),
(15, '420300319401', 'fef'),
(16, '420300319402', 'frfff'),
(18, '4203003409', 'DHHTTT18BTT');

-- --------------------------------------------------------

--
-- Table structure for table `monlop`
--

CREATE TABLE `monlop` (
  `id` int(10) NOT NULL auto_increment,
  `thuhocLT` varchar(50) NOT NULL,
  `thuhocTH` varchar(50) NOT NULL,
  `tietbatdauLT` varchar(50) NOT NULL,
  `tietketthucLT` varchar(50) NOT NULL,
  `tietbatdauTH` varchar(50) NOT NULL,
  `tietketthucTH` varchar(50) NOT NULL,
  `phonghocLT` varchar(50) NOT NULL,
  `phonghocTH` varchar(50) NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_hocphan` (`id_hocphan`,`id_lophocphan`),
  KEY `id_lophocphan` (`id_lophocphan`),
  KEY `id_hocphan_2` (`id_hocphan`),
  KEY `id_hocphan_3` (`id_hocphan`),
  KEY `id_lophocphan_2` (`id_lophocphan`),
  KEY `id_lophocphan_3` (`id_lophocphan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `monlop`
--

INSERT INTO `monlop` (`id`, `thuhocLT`, `thuhocTH`, `tietbatdauLT`, `tietketthucLT`, `tietbatdauTH`, `tietketthucTH`, `phonghocLT`, `phonghocTH`, `id_hocphan`, `id_lophocphan`) VALUES
(1, '3', '4', '1', '3', '4', '6', 'X10.05', 'H5.02', 1, 1),
(4, '2', '6', '13', '15', '7', '9', 'X10.09', 'H5.03', 1, 4),
(5, '3', '5', '4', '6', '1', '3', 'X10.04', 'H5.03', 1, 5),
(6, '3', '5', '1', '3', '4', '6', 'X10.03', 'H4.03', 2, 6),
(7, '3', '5', '1', '3', '4', '6', 'X11.09', 'H4.02', 2, 7),
(8, '6', '4', '10', '12', '7', '9', 'X11.05', 'H4.01', 2, 8),
(9, '7', '8', '4', '6', '1', '3', 'A1.02', 'H4.03', 3, 9),
(10, '6', '8', '13', '15', '4', '6', 'A2.04', 'H4.01', 3, 10),
(11, '5', '2', '13', '15', '1', '3', 'A2.03', 'H4.02', 3, 11),
(12, '3', '5', '7', '9', '10', '12', 'X8.03', 'H7.04', 4, 12),
(13, '4', '8', '10', '12', '1', '3', 'X11.03', 'H5.03', 4, 13),
(14, '2', '', '7', '9', '', '', 'V8.02', '', 47, 14),
(15, '2', '2', '1', '3', '1', '3', 'rer', 'rewr', 5, 15),
(16, '2', '2', '1', '3', '1', '3', 'feff', 'ewfe', 5, 16),
(18, '2', '2', '1', '3', '1', '3', 'B3.03', 'H5.01', 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id_sinhvien` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `tensinhvien` varchar(50) NOT NULL,
  `masosinhvien` int(10) NOT NULL,
  `gioitinh` varchar(50) NOT NULL,
  `ngaysinh` varchar(50) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `ngaycap` varchar(50) NOT NULL,
  `noicap` varchar(50) NOT NULL,
  `diachilienhe` varchar(50) NOT NULL,
  `hokhauthuongtru` varchar(50) NOT NULL,
  `ngayvaotruong` varchar(50) NOT NULL,
  `khoa` varchar(50) NOT NULL,
  `lopCN` varchar(50) NOT NULL,
  `cosodaotao` varchar(50) NOT NULL,
  `trangthai` int(10) NOT NULL,
  `id_chuyennganh` int(10) NOT NULL,
  PRIMARY KEY  (`id_sinhvien`),
  UNIQUE KEY `id_taikhoan_3` (`user_id`),
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `id_taikhoan` (`user_id`),
  KEY `id_taikhoan_2` (`user_id`),
  KEY `id_chuyennganh` (`id_chuyennganh`),
  KEY `id_taikhoan_4` (`user_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_3` (`user_id`),
  KEY `user_id_4` (`user_id`),
  KEY `user_id_5` (`user_id`),
  KEY `user_id_6` (`user_id`),
  KEY `id_chuyennganh_2` (`id_chuyennganh`),
  KEY `user_id_7` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id_sinhvien`, `user_id`, `tensinhvien`, `masosinhvien`, `gioitinh`, `ngaysinh`, `sdt`, `ngaycap`, `noicap`, `diachilienhe`, `hokhauthuongtru`, `ngayvaotruong`, `khoa`, `lopCN`, `cosodaotao`, `trangthai`, `id_chuyennganh`) VALUES
(1, 2, 'NGUYỄN VĂN ANH', 19843211, 'Nam', '29-04-2004', '0324564732', '02-02-2023', 'Tây Ninh', 'Dương Minh Châu, Tây Ninh', 'Tây Ninh', '2019-08-14', '2019-2023', 'DH_CN_A', 'Cơ Sở 1 ( TP.HCM )', 1, 1),
(2, 3, 'NGUYỄN THỊ CHÍNH', 19435634, 'Nữ', '2001-08-16', '0432568918', '2022-12-01', 'TP.HCM', 'Hóc Môn, TP.HCM', 'TP.HCM', '2019-08-13', '2019-2023', 'DH_CN_B', 'Cơ Sở 1 ( TP.HCM )', 1, 2),
(3, 4, 'TRẦN HOÀNG ANH', 18231456, 'Nam', '2000-12-13', '0436275463', '2021-05-03', 'Bình Dương', 'Phú Giáo, Bình Dương', 'Bình Dương', '2018-08-14', '2018-2022', 'DH_CN_C', 'Cơ Sở 1 ( TP.HCM )', 1, 4),
(4, 5, 'PHÙNG NHÃ DƯƠNG', 17654321, 'Nữ', '1999-09-01', '0983462513', '2023-06-04', 'Bến Tre', 'Châu Thành, Bến Tre', 'Bến Tre', '2017-08-13', '2017-2021', 'DH_CN_D', 'Cơ Sở 1 ( TP.HCM )', 1, 8),
(5, 6, 'CAO QUÝ XUÂN', 21009876, 'Nữ', '2003-03-12', '0765237646', '2023-07-05', 'Bình Thuận', 'Phan Thiết, Bình Thuận', 'Bình Thuận', '2021-08-20', '2021-2025', 'DH_CN_E', 'Cơ Sở 1 ( TP.HCM )', 1, 5),
(6, 7, 'DƯƠNG CÔNG VINH', 20211473, 'Nam', '2002-05-06', '0356276432', '2022-03-04', 'Hà Nội', 'Hai Bà Trưng, Hà Nội', 'Hà Nội', '2020-08-15', '2020-2024', 'DH_CN_F', 'Cơ Sở 1 ( TP.HCM )', 1, 6),
(7, 8, 'NGUYỄN VĂN PHÚC', 19443131, 'Nam', '19-10-2001', '0393328400', '02-03-2023', 'Bình Phước', 'Chơn Thành, Bình Phước', 'Bình Phước', '2019-07-22', '2019-2023', 'DHHTTT15A', 'Cơ Sở 1 ( TP.HCM )', 1, 1),
(8, 9, 'LÊ THÀNH VINH', 19834251, 'Nam', '2001-08-15', '0322356423', '2021-08-01', 'Thanh Hóa', 'Thọ Xuân, Thanh Hóa', 'Thanh Hóa', '2019-08-16', '2019-2023', 'DHHTTT15A', 'Cơ Sở 1 ( TP.HCM )', 1, 1),
(9, 10, 'NGUYỄN NGỌC HIỆP', 12345678, 'Nữ', '2001-08-16', '0234543217', '2021-03-02', 'Sóc Trăng', 'Sóc Trăng', 'Sóc Trăng', '2019-08-14', '2019-2023', 'DH_CN_G', 'Cơ Sở 1 ( TP.HCM )', 1, 1),
(10, 11, 'NGUYỄN THANH VÂN', 13543212, 'Nữ', '2000-11-10', '0132474348', '2020-04-01', 'Trà Vinh', 'Trà Vinh', 'Trà Vinh', '2020-08-17', '2020-2024', 'DH_CN_H', 'Cơ Sở 1 ( TP.HCM )', 1, 14),
(11, 19, 'TRẦN TRỌNG TIẾN', 19234762, 'Nam', '2001-07-16', '0364249437', '2021-04-02', 'Đà Nẵng', 'Đà Nẵng', 'Đà Nẵng', '2019-08-14', '2019-2023', 'DH_CN_I', 'Cơ Sở 1 ( TP.HCM )', 1, 9),
(21, 29, 'NGUYỄN NHẬT NAM', 18934251, 'Nam', '2001-07-16', '0324756438', '2021-07-16', 'update...', 'update...', 'update...', '2021-07-16', 'update...', 'update...', 'update...', 1, 1),
(22, 30, 'hfh', 16527384, '', '2026-05-01', 'khjk', '2026-05-01', '', '', '', '2026-05-01', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `thongketruycap`
--

CREATE TABLE `thongketruycap` (
  `id_thongke` int(10) NOT NULL auto_increment,
  `ngaytruycap` varchar(50) NOT NULL,
  `mahocphan` varchar(50) NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_giangvien` int(10) NOT NULL,
  PRIMARY KEY  (`id_thongke`),
  KEY `id_hocphan` (`mahocphan`,`id_lophocphan`,`id_sinhvien`,`id_giangvien`),
  KEY `id_hocphan_2` (`mahocphan`),
  KEY `id_lophocphan` (`id_lophocphan`),
  KEY `id_sinhvien` (`id_sinhvien`),
  KEY `id_giangvien` (`id_giangvien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `thongketruycap`
--

INSERT INTO `thongketruycap` (`id_thongke`, `ngaytruycap`, `mahocphan`, `id_lophocphan`, `id_sinhvien`, `id_giangvien`) VALUES
(1, '2023-12-07 16:23:37', 'c4ca4238a0b923820dcc509a6f75849b', 4, 0, 1),
(2, '2026-05-02 12:44:05', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, 1),
(3, '2023-12-12 19:35:08', 'c4ca4238a0b923820dcc509a6f75849b', 1, 7, 0),
(4, '2023-12-07 16:20:53', 'c81e728d9d4c2f636f067f89cc14862c', 7, 7, 0),
(5, '2023-12-07 16:19:25', 'a87ff679a2f3e71d9181a67b7542122c', 12, 7, 0),
(6, '2023-12-06 18:26:46', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 9, 7, 0),
(7, '2026-05-02 13:03:15', 'c81e728d9d4c2f636f067f89cc14862c', 7, 0, 1),
(8, '2026-05-01 20:21:48', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 9, 0, 1),
(9, '2026-05-02 12:43:57', 'a87ff679a2f3e71d9181a67b7542122c', 12, 0, 1),
(10, '2026-05-02 13:24:17', 'a87ff679a2f3e71d9181a67b7542122c', 12, 1, 0),
(11, '2026-05-02 13:23:56', 'c4ca4238a0b923820dcc509a6f75849b', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `id_tintuc` int(10) NOT NULL auto_increment,
  `tieude` varchar(1000) NOT NULL,
  `noidung` varchar(10000) NOT NULL,
  `ngaydangtai` varchar(50) NOT NULL,
  `tacgia` varchar(50) NOT NULL,
  `anhdaidien` varchar(10000) NOT NULL,
  PRIMARY KEY  (`id_tintuc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`id_tintuc`, `tieude`, `noidung`, `ngaydangtai`, `tacgia`, `anhdaidien`) VALUES
(1, 'Seminar môn học: Lập trình phân tán với công nghệ Java', 'Ngày 16 tháng 11 năm 2023, tại phòng B2.14, bộ môn Kỹ Thuật Phần Mềm đã tổ chức seminar môn học: “Lập Trình Phân Tán Với Công Nghệ Java”. Mục đích nhầm rà soát, kiểm tra, thảo luận, đánh giá lại đề cương và chuẩn đầu ra của môn học để chuẩn bị cho học kỳ mới và định hướng phát triển phù hợp với xu thế ngành cho những năm học tiếp theo.<p></p>Tham gia buổi seminar gồm: Cô Nguyễn Thị Hạnh (trưởng bộ môn) chủ trì buổi seminar, cô Nguyễn Thị Hoàng Khánh (giảng viên phụ trách môn học) trình bày báo cáo seminar, toàn bộ giảng viên bộ môn Kỹ Thuật Phần Mềm và một số giảng viên thuộc bộ môn khác trong khoa Công Nghệ Thông Tin.<p></p><img src="https://qn.iuh.edu.vn/uploads/2023/05/Seminarbommon_HuynhTanHat_19.05.2023_01-1024x768.jpg" width="100%"><p></p>Cô Khánh trình bày báo cáo về đề cương môn học, chuẩn đầu ra của môn học, cách thức tổ chức giảng dạy, bài tập thực hành, và cách thức đánh giá kết quả học tập của sinh viên.<p></p>Các giảng viên tham gia buổi seminar đã thảo luận, đánh giá, đưa ra những ý kiến đóng góp kiến tích cực.<p></p>Sau buổi seminar, bô môn đã thống nhất và đưa ra những quyết định như sau:<p></p>Đề cương môn học được cập nhật phù hợp với xu hướng phát triển của ngành.\n<p></p>Chuẩn đầu ra của môn học được thống nhất.<p></p>\nCách thức tổ chức giảng dạy, bài tập thực hành, và cách thức đánh giá kết quả học tập của sinh viên.<p></p>\nCác giảng viên tham gia giảng dạy môn học.<p></p>\nGhi nhận những đóng góp tích cực từ toàn thể quý thầy cô tham dự.', '2023-12-01 17:09:04', 'BM KTPM', 'https://qn.iuh.edu.vn/uploads/2023/05/Seminarbommon_HuynhTanHat_19.05.2023_01-1024x768.jpg'),
(2, 'Kiến tập tại FPT Software', 'Vào sáng 09/11/2023, Khoa Công nghệ thông tin (CNTT) đã đồng hành cùng FPT Software (FSoft) đã tổ chức một buổi kiến tập tại Campus F-Town 3 của FPT Software HCM dành cho các sinh viên khoa CNTT. Đoàn kiến tập gồm có 180 sinh viên và 12 giảng viên thuộc tất cả các chuyên ngành của khoa CNTT.<p></p>\n\nTại buổi kiến tập, các bạn sinh viên đã khám phá rất nhiều điều thú vị:<p></p>\n\nTham quan tòa nhà F-Town 3 với cơ sở vật chất xin xò, đạt chuẩn quốc tế và lọt vào top những công trình kiến trúc độc đáo tại Việt Nam.<p></p>\nĐược gặp gỡ - giao lưu với các anh chị hiện đang công tác tại FSoft, các anh chị đã chia sẻ và giải đáp tất tần tật về các hoạt động, chính sách, mục tiêu của FSoft.<p></p>\nHiểu rõ hơn về các hoạt động hỗ trợ sinh viên của FSoft.<p></p>\nĐược chia sẻ các xu hướng nghề nghiệp trong lĩnh vực công nghệ thông tin.<p></p>\nLàm sao để trở thành một FSofter cùng với quyền lợi và cơ hội thăng tiến trong sự nghiệp.<p></p>\nNhận được nhiều phần quà hấp dẫn khi tham gia giao lưu, đặt câu hỏi, trả lời câu hỏi, …<p></p>\nBuổi kiến tập tại FSoft đã đã mang lại cho các bạn sinh viên những trải nghiệm thú vị, thiết thực và định hướng được rõ ràng hơn về nghề nghiệp trong tương lai.<p></p>\n\nKhoa CNTT chân thành cảm ơn nhóm đại diện của FSoft HCM đã chuẩn bị và tiếp đón đoàn sinh viên và giảng viên thật chu đáo và nồng nhiệt.<p></p>', '2023-12-04 23:27:52', 'Khoa CNTT', 'https://tse2.mm.bing.net/th?id=OIP.O82TSn8LPIdsKzzywfsFewHaE7&pid=Api&P=0&h=180'),
(23, 'IUH khai giảng năm học 2026', 'Lễ khai giảng diễn ra long trọng tại hội trường lớn.', '2026-05-01 16:41:34', 'Phòng Đào tạo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV1ntP7E_7zkrCxy2now2lYg40S3qpzQY3Nw&s'),
(24, 'Sinh viên IUH đạt giải quốc gia', 'Đội tuyển xuất sắc giành giải nhất cuộc thi AI.', '2026-05-01 16:41:34', 'Khoa CNTT', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV1ntP7E_7zkrCxy2now2lYg40S3qpzQY3Nw&s'),
(25, 'Hội thảo công nghệ AI', 'Chuyên gia chia sẻ xu hướng AI mới nhất.', '2026-05-01 16:41:34', 'Ban tổ chức', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV1ntP7E_7zkrCxy2now2lYg40S3qpzQY3Nw&s'),
(26, 'Thông báo tuyển sinh', 'IUH công bố chỉ tiêu tuyển sinh 2026.', '2026-05-01 16:41:34', 'Ban tuyển sinh', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV1ntP7E_7zkrCxy2now2lYg40S3qpzQY3Nw&s'),
(27, 'Chiến dịch mùa hè xanh', 'Sinh viên tham gia hoạt động tình nguyện.', '2026-05-01 16:41:34', 'Đoàn trường', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV1ntP7E_7zkrCxy2now2lYg40S3qpzQY3Nw&s');

-- --------------------------------------------------------

--
-- Table structure for table `tltk`
--

CREATE TABLE `tltk` (
  `id_tltk` int(10) NOT NULL auto_increment,
  `tieude` varchar(50) NOT NULL,
  `filetailieu` varchar(100) NOT NULL,
  `ngaydang` varchar(50) NOT NULL,
  `loaitailieu` varchar(50) NOT NULL,
  `id_giangday` int(10) NOT NULL,
  PRIMARY KEY  (`id_tltk`),
  KEY `id_giangday` (`id_giangday`),
  KEY `id_giangday_2` (`id_giangday`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tltk`
--

INSERT INTO `tltk` (`id_tltk`, `tieude`, `filetailieu`, `ngaydang`, `loaitailieu`, `id_giangday`) VALUES
(2, 'Tài Liệu ERP', 'ERP.pdf', '2023-12-01 17:23:54', 'GT', 5),
(4, 'Tài Liệu Thực Hành ERP', 'BTThucHanh_QUITRINHMUAHANG_SANXUAT_BANHANG (1).pptx', '2023-12-01 17:28:02', 'BTTH', 5),
(7, 'Slide Bài Giảng', 'C01_TongQuanERP.pdf', '2023-12-01 18:04:03', 'Slide', 5),
(24, 'Tài liệu TH ERP', 'baocao_lab5_final.docx', '2026-05-02 12:54:24', 'BTTH', 1),
(25, 'SLIDE ERP', 'baocao_lab5_final.docx', '2026-05-02 12:55:46', 'Slide', 1),
(26, 'TÀI LIỆU ERP', 'baocao_lab5_final.docx', '2026-05-02 12:58:38', 'GT', 1),
(27, 'TÀI LIỆU TH NEW', 'Presentation1.pptx', '2026-05-02 13:00:23', 'BTTH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL auto_increment,
  `user_code` varchar(50) NOT NULL,
  `tenuser` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL,
  `vaitro` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cccd` varchar(50) NOT NULL,
  `anh` varchar(500) NOT NULL,
  `ttguigmailctk` varchar(50) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_code`, `tenuser`, `matkhau`, `vaitro`, `email`, `cccd`, `anh`, `ttguigmailctk`) VALUES
(1, 'c24dbb16d73e64d2a861c4aab0f28017', 'Phuc Nguyen', 'ad26764588c57e0df0b1908a2ea8110b', '2', 'phucable@gmail.com', '0462010001691', 'https://img4.thuthuatphanmem.vn/uploads/2019/12/16/hinh-nen-4k-thien-nhien-dep_024352261.jpg', '0'),
(2, '14a6cee614215777ba6d0c7da6564a1e', 'NVA', 'e10adc3949ba59abbe56e057f20f883e', '0', 'thuonghoaicute103@gmail.com', '123456543213', 'https://tse3.mm.bing.net/th?id=OIP.muVHXnoxN5sqaWcWPYaP9AHaHa&pid=Api&P=0&h=180', '1'),
(3, '2fed525adfda0d4c12f10aa06969ed52', 'NTC', 'e10adc3949ba59abbe56e057f20f883e', '0', 'cdf@gmail.com', '234543212346', 'https://tse2.mm.bing.net/th?id=OIP.YzD-_W1DbK6T_RJsubfP-AHaHu&pid=Api&P=0&h=180', '1'),
(4, '000afb078ba06cc67f7dc8af85f51653', 'THA', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ngh@gmail.com', '564327891653', 'https://tse1.mm.bing.net/th?id=OIP.qilJV7ubqk5vAxS2OosDpwHaEK&pid=Api&P=0&h=180', '1'),
(5, 'e068ff48f0966deade935517d6b4686a', 'PND', 'e10adc3949ba59abbe56e057f20f883e', '0', 'dscav123@gmail.com', '202134759732', 'https://tse1.mm.bing.net/th?id=OIP.__KSg8Z9Gel4X72iZq7-TQAAAA&pid=Api&P=0&h=180', '1'),
(6, '016c49feb11d7b59b43334f3d0abc625', 'CQX', 'e10adc3949ba59abbe56e057f20f883e', '0', 'csd@gmail.com', '468392273299', 'https://tse2.mm.bing.net/th?id=OIP.Fp17kvdPgldtZy5Ltc0SyAHaFj&pid=Api&P=0&h=180', '0'),
(7, '876decd843c23e5326cb2bc0bad96ba7', 'DCV', 'e10adc3949ba59abbe56e057f20f883e', '0', 'hyd@gmail.com', '374393232329', 'https://tse3.explicit.bing.net/th?id=OIP.ftPQ-uCCPygrJ0xt56I-0AHaE5&pid=Api&P=0&h=180', '1'),
(8, '92ce57f69cd43af85d3ff171984854b2', 'NVP', 'e10adc3949ba59abbe56e057f20f883e', '0', 'phucable@gmail.com', '462010001690', 'https://tse3.mm.bing.net/th?id=OIP.PPWrG4bdXOR1pdbEepawkQHaE8&pid=Api&P=0&h=180', '1'),
(9, '38b32a214ffd3419ef83013be6b49391', 'LTV', 'e10adc3949ba59abbe56e057f20f883e', '0', 'levinh@gmail.com', '123456543212', 'https://tse3.mm.bing.net/th?id=OIP.0DrnRWMVgN8AvQ6Eu9H_hwHaEp&pid=Api&P=0&h=180', '1'),
(10, '25d55ad283aa400af464c76d713c07ad', 'NNH', 'e10adc3949ba59abbe56e057f20f883e', '0', 'nnh@gmail.com', '434267846575', 'ttps://tse3.mm.bing.net/th?id=OIP.PPWrG4bdXOR1pdbEepawkQHaE8&pid=Api&P=0&h=180', '0'),
(11, 'b7eca66772ae7f9c87850b22198956ee', 'NTV', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ntv@gmail.com', '743643937534', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(13, '354f31b1031ca6dddf783514597ab0b2', 'NTT', 'e10adc3949ba59abbe56e057f20f883e', '1', 'kewwihuy@gmail.com', '034521678543', 'https://tse1.mm.bing.net/th?id=OIP.UVTTiTmngViDKz-1ylEfVgHaEK&pid=Api&P=0&h=180', '0'),
(14, '03248bac15a680f70d8e40491890805e', 'TTV', 'e10adc3949ba59abbe56e057f20f883e', '1', 'tv@gmail.com', '032453628163', 'https://tse2.mm.bing.net/th?id=OIP.nQu8R0IhYo4v3wVrNJ1O0wHaEK&pid=Api&P=0&h=180', '0'),
(15, '228e9061edbaf03310f27808291591ef', 'LAT', 'e10adc3949ba59abbe56e057f20f883e', '1', 'at@gmail.com', '065748362746', 'https://tse1.mm.bing.net/th?id=OIP.AXveYTaAri_83-WLMvoVAQHaE8&pid=Api&P=0&h=180', '0'),
(16, 'bba72ca3dd728f039abd56f3e8a1c6a7', 'THK', 'e10adc3949ba59abbe56e057f20f883e', '1', 'hk@gmail.com', '098563333732', 'https://tse1.mm.bing.net/th?id=OIP.IH9e7CoH0QjKu-RKqOIpRQHaEo&pid=Api&P=0&h=180', '0'),
(17, 'ff18fc2eabec6ddb5ed492fd0483e062', 'NTB', 'e10adc3949ba59abbe56e057f20f883e', '1', 'tb@gmail.com', '000326323200', 'https://tse4.mm.bing.net/th?id=OIP.0JuZAC5zIFrNGR3IyAenxwHaEK&pid=Api&P=0&h=180', '0'),
(18, '9e0c8c7b39444e4c928e1e05de87f793', 'TVH', 'e10adc3949ba59abbe56e057f20f883e', '1', 'vh@gmail..com', '046343200434', 'https://tse2.mm.bing.net/th?id=OIP.DCheUVZyF_GmJWFFo6cJ0QAAAA&pid=Api&P=0&h=180', '0'),
(19, '8020461cbd8d99ed35c2b2ddedd0523f', 'TTT', 'e10adc3949ba59abbe56e057f20f883e', '0', 'ttt@gmail.com', '364343248344', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(29, '626fd80919df0b3cbd8c0442a83b9ee5', 'NNN', 'e10adc3949ba59abbe56e057f20f883e', '0', 'nnn@gmail.com', 'update...', 'https://tse1.mm.bing.net/th?id=OIP.iU95PJkpUrKOCmgWC7x-iQHaGX&pid=Api&rs=1&c=1&qlt=95&w=134&h=115', '0'),
(30, 'ef7f70f24ca58db41dcef5d01d928982', '', 'c70fd4260c9eb90bc0ba9d047c068eb8', '0', 'uuu', '', 'hh', '0');
