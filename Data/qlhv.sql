/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50051
 Source Host           : localhost:3306
 Source Schema         : qlhv

 Target Server Type    : MySQL
 Target Server Version : 50051
 File Encoding         : 65001

 Date: 25/05/2026 23:56:30
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_ad` int(10) NOT NULL AUTO_INCREMENT,
  `hotenadmin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `loigioithieu` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_ad`),
  INDEX `user_id` USING BTREE(`user_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for baitap_tracnghiem
-- ----------------------------
DROP TABLE IF EXISTS `baitap_tracnghiem`;
CREATE TABLE `baitap_tracnghiem`  (
  `id_bttracnghiem` int(10) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mota` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `thoigianlambai` int(10) NOT NULL DEFAULT 30 COMMENT 'Thời gian làm bài (phút)',
  `soluongcauhoi` int(10) NOT NULL DEFAULT 10,
  `diemmotcau` float NOT NULL DEFAULT 1,
  `batdaunop` datetime NOT NULL,
  `ketthucnop` datetime NOT NULL,
  `ngaydang` datetime NOT NULL,
  `id_giangday` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_bttracnghiem`),
  INDEX `id_giangday` USING BTREE(`id_giangday`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for baitaplythuyet
-- ----------------------------
DROP TABLE IF EXISTS `baitaplythuyet`;
CREATE TABLE `baitaplythuyet`  (
  `id_btlt` int(10) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `filebt` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `batdaunop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ketthucnop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaydang` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_giangday` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_btlt`),
  INDEX `id_giangday` USING BTREE(`id_giangday`)
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for baitapthuchanh
-- ----------------------------
DROP TABLE IF EXISTS `baitapthuchanh`;
CREATE TABLE `baitapthuchanh`  (
  `id_btth` int(10) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `batdaunop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ketthucnop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaydang` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `loaibai` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_giangday` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_btth`),
  INDEX `id_sinhvien` USING BTREE(`ngaydang`, `id_giangday`),
  INDEX `id_giangday` USING BTREE(`id_giangday`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cauhoi_tracnghiem
-- ----------------------------
DROP TABLE IF EXISTS `cauhoi_tracnghiem`;
CREATE TABLE `cauhoi_tracnghiem`  (
  `id_cauhoi` int(10) NOT NULL AUTO_INCREMENT,
  `noidung` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hinhanh` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokho` enum('de','trungbinh','kho') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'trungbinh',
  `id_bttracnghiem` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_cauhoi`),
  INDEX `id_bttracnghiem` USING BTREE(`id_bttracnghiem`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for chitiet_tracnghiem
-- ----------------------------
DROP TABLE IF EXISTS `chitiet_tracnghiem`;
CREATE TABLE `chitiet_tracnghiem`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_nopbai` int(10) NOT NULL,
  `id_cauhoi` int(10) NOT NULL,
  `id_dapan_chon` int(10) NULL DEFAULT NULL,
  `dung_sai` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY USING BTREE (`id`),
  INDEX `id_nopbai` USING BTREE(`id_nopbai`),
  INDEX `id_cauhoi` USING BTREE(`id_cauhoi`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for chuyennganh
-- ----------------------------
DROP TABLE IF EXISTS `chuyennganh`;
CREATE TABLE `chuyennganh`  (
  `id_chuyennganh` int(10) NOT NULL AUTO_INCREMENT,
  `machuyennganh` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tenchuyennganh` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_khoa` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_chuyennganh`),
  INDEX `id_khoa` USING BTREE(`id_khoa`),
  INDEX `id_khoa_2` USING BTREE(`id_khoa`)
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ct_hocphan
-- ----------------------------
DROP TABLE IF EXISTS `ct_hocphan`;
CREATE TABLE `ct_hocphan`  (
  `id_chitiethp` int(10) NOT NULL AUTO_INCREMENT,
  `id_hocphan` int(10) NOT NULL,
  `loaihp` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `soTC` int(10) NOT NULL,
  `TCLT` int(10) NOT NULL,
  `TCTH` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_chitiethp`),
  INDEX `id_hocphan` USING BTREE(`id_hocphan`),
  INDEX `id_hocphan_2` USING BTREE(`id_hocphan`),
  INDEX `id_hocphan_3` USING BTREE(`id_hocphan`)
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for dapan_tracnghiem
-- ----------------------------
DROP TABLE IF EXISTS `dapan_tracnghiem`;
CREATE TABLE `dapan_tracnghiem`  (
  `id_dapan` int(10) NOT NULL AUTO_INCREMENT,
  `noidung` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ladapan_dung` tinyint(1) NOT NULL DEFAULT 0,
  `id_cauhoi` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_dapan`),
  INDEX `id_cauhoi` USING BTREE(`id_cauhoi`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for diem
-- ----------------------------
DROP TABLE IF EXISTS `diem`;
CREATE TABLE `diem`  (
  `id_diem` int(10) NOT NULL AUTO_INCREMENT,
  `TK1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TK2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TK3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `GK` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TH1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TH2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TH3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CK` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `diemtb` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_diem`),
  INDEX `id_sinhvien` USING BTREE(`id_sinhvien`),
  INDEX `id_hocphan` USING BTREE(`id_hocphan`),
  INDEX `id_lophocphan` USING BTREE(`id_lophocphan`)
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for dkhp
-- ----------------------------
DROP TABLE IF EXISTS `dkhp`;
CREATE TABLE `dkhp`  (
  `id_dkhp` int(10) NOT NULL AUTO_INCREMENT,
  `id_sinhvien` int(10) NOT NULL,
  `id_hocphan` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaydk` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id_dkhp`),
  INDEX `id_sinhvien` USING BTREE(`id_sinhvien`, `id_hocphan`)
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for filediem
-- ----------------------------
DROP TABLE IF EXISTS `filediem`;
CREATE TABLE `filediem`  (
  `id_filediem` int(10) NOT NULL AUTO_INCREMENT,
  `filediem` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaydang` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  `id_giangvien` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_filediem`),
  INDEX `id_giangvien` USING BTREE(`id_giangvien`),
  INDEX `id_giangvien_2` USING BTREE(`id_giangvien`),
  INDEX `id_giangvien_3` USING BTREE(`id_giangvien`),
  INDEX `id_hocphan` USING BTREE(`id_hocphan`),
  INDEX `id_lophocphan` USING BTREE(`id_lophocphan`)
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for filenopbtlt
-- ----------------------------
DROP TABLE IF EXISTS `filenopbtlt`;
CREATE TABLE `filenopbtlt`  (
  `id_filenopbtlt` int(10) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `filenop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaynop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_btlt` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_filenopbtlt`),
  INDEX `id_btlt` USING BTREE(`id_btlt`, `id_sinhvien`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for filenopbtth
-- ----------------------------
DROP TABLE IF EXISTS `filenopbtth`;
CREATE TABLE `filenopbtth`  (
  `id_filenopbtth` int(10) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `filenop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaynop` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_btth` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_filenopbtth`),
  INDEX `id_sinhvien` USING BTREE(`id_sinhvien`, `id_btth`)
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for giangday
-- ----------------------------
DROP TABLE IF EXISTS `giangday`;
CREATE TABLE `giangday`  (
  `id_giangday` int(10) NOT NULL AUTO_INCREMENT,
  `id_giangvien` int(10) NOT NULL,
  `id_giangvienTH1` int(10) NOT NULL,
  `id_giangvienTH2` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_giangday`),
  INDEX `id_giangvien` USING BTREE(`id_giangvien`, `id`),
  INDEX `id` USING BTREE(`id`),
  INDEX `id_2` USING BTREE(`id`),
  INDEX `id_giangvien_2` USING BTREE(`id_giangvien`),
  INDEX `id_giangvien(TH)` USING BTREE(`id_giangvienTH1`),
  INDEX `id_giangvienTH2` USING BTREE(`id_giangvienTH2`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for giangvien
-- ----------------------------
DROP TABLE IF EXISTS `giangvien`;
CREATE TABLE `giangvien`  (
  `id_giangvien` int(10) NOT NULL AUTO_INCREMENT,
  `magiangvien` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hotengiangvien` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gioitinh` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sdt` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `diachi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hocvi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quatrinhcongtac` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cosogiangday` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `chungchi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `chungchikhac` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `congtrinhkhoahoctieubieu` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_chuyennganh` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_giangvien`),
  INDEX `id_taikhoan` USING BTREE(`user_id`),
  INDEX `id_chuyennganh` USING BTREE(`id_chuyennganh`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hocky
-- ----------------------------
DROP TABLE IF EXISTS `hocky`;
CREATE TABLE `hocky`  (
  `id_hocky` int(10) NOT NULL AUTO_INCREMENT,
  `tenhocky` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nienkhoa` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id_hocky`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hocphan
-- ----------------------------
DROP TABLE IF EXISTS `hocphan`;
CREATE TABLE `hocphan`  (
  `id_hocphan` int(10) NOT NULL AUTO_INCREMENT,
  `mahocphan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tenhocphan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_khoa` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_hocphan`),
  INDEX `id_khoa` USING BTREE(`id_khoa`),
  INDEX `id_khoa_2` USING BTREE(`id_khoa`)
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hoctap
-- ----------------------------
DROP TABLE IF EXISTS `hoctap`;
CREATE TABLE `hoctap`  (
  `id_hoctap` int(10) NOT NULL AUTO_INCREMENT,
  `id_sinhvien` int(10) NOT NULL,
  `id_giangvienTH` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_hoctap`),
  INDEX `id_sinhvien` USING BTREE(`id_sinhvien`, `id`),
  INDEX `id` USING BTREE(`id`),
  INDEX `id_2` USING BTREE(`id`),
  INDEX `id_3` USING BTREE(`id`),
  INDEX `id_giangvienTH` USING BTREE(`id_giangvienTH`),
  INDEX `id_giangvienTH_2` USING BTREE(`id_giangvienTH`)
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for khoavien
-- ----------------------------
DROP TABLE IF EXISTS `khoavien`;
CREATE TABLE `khoavien`  (
  `id_khoa` int(10) NOT NULL AUTO_INCREMENT,
  `makhoa` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tenkhoa` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id_khoa`)
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for lophocphan
-- ----------------------------
DROP TABLE IF EXISTS `lophocphan`;
CREATE TABLE `lophocphan`  (
  `id_lophocphan` int(10) NOT NULL AUTO_INCREMENT,
  `malophocphan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tenlophocphan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id_lophocphan`)
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for monlop
-- ----------------------------
DROP TABLE IF EXISTS `monlop`;
CREATE TABLE `monlop`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `thuhocLT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `thuhocTH` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tietbatdauLT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tietketthucLT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tietbatdauTH` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tietketthucTH` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phonghocLT` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phonghocTH` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_hocphan` int(10) NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id`),
  INDEX `id_hocphan` USING BTREE(`id_hocphan`, `id_lophocphan`),
  INDEX `id_lophocphan` USING BTREE(`id_lophocphan`),
  INDEX `id_hocphan_2` USING BTREE(`id_hocphan`),
  INDEX `id_hocphan_3` USING BTREE(`id_hocphan`),
  INDEX `id_lophocphan_2` USING BTREE(`id_lophocphan`),
  INDEX `id_lophocphan_3` USING BTREE(`id_lophocphan`)
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for nopbai_tracnghiem
-- ----------------------------
DROP TABLE IF EXISTS `nopbai_tracnghiem`;
CREATE TABLE `nopbai_tracnghiem`  (
  `id_nopbai` int(10) NOT NULL AUTO_INCREMENT,
  `id_bttracnghiem` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `diem` float NULL DEFAULT NULL,
  `socautraloi_dung` int(10) NULL DEFAULT NULL,
  `thoigian_nop` datetime NULL DEFAULT NULL,
  `trangthai` enum('chuabot','daday') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'chuabot',
  PRIMARY KEY USING BTREE (`id_nopbai`),
  INDEX `id_bttracnghiem` USING BTREE(`id_bttracnghiem`),
  INDEX `id_sinhvien` USING BTREE(`id_sinhvien`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sinhvien
-- ----------------------------
DROP TABLE IF EXISTS `sinhvien`;
CREATE TABLE `sinhvien`  (
  `id_sinhvien` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `tensinhvien` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `masosinhvien` int(10) NOT NULL,
  `gioitinh` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaysinh` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sdt` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaycap` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `noicap` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `diachilienhe` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hokhauthuongtru` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngayvaotruong` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `khoa` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lopCN` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cosodaotao` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `trangthai` int(10) NOT NULL,
  `id_chuyennganh` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_sinhvien`),
  UNIQUE INDEX `id_taikhoan_3` USING BTREE(`user_id`),
  UNIQUE INDEX `user_id_2` USING BTREE(`user_id`),
  INDEX `id_taikhoan` USING BTREE(`user_id`),
  INDEX `id_taikhoan_2` USING BTREE(`user_id`),
  INDEX `id_chuyennganh` USING BTREE(`id_chuyennganh`),
  INDEX `id_taikhoan_4` USING BTREE(`user_id`),
  INDEX `user_id` USING BTREE(`user_id`),
  INDEX `user_id_3` USING BTREE(`user_id`),
  INDEX `user_id_4` USING BTREE(`user_id`),
  INDEX `user_id_5` USING BTREE(`user_id`),
  INDEX `user_id_6` USING BTREE(`user_id`),
  INDEX `id_chuyennganh_2` USING BTREE(`id_chuyennganh`),
  INDEX `user_id_7` USING BTREE(`user_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for thongketruycap
-- ----------------------------
DROP TABLE IF EXISTS `thongketruycap`;
CREATE TABLE `thongketruycap`  (
  `id_thongke` int(10) NOT NULL AUTO_INCREMENT,
  `ngaytruycap` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mahocphan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_lophocphan` int(10) NOT NULL,
  `id_sinhvien` int(10) NOT NULL,
  `id_giangvien` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_thongke`),
  INDEX `id_hocphan` USING BTREE(`mahocphan`, `id_lophocphan`, `id_sinhvien`, `id_giangvien`),
  INDEX `id_hocphan_2` USING BTREE(`mahocphan`),
  INDEX `id_lophocphan` USING BTREE(`id_lophocphan`),
  INDEX `id_sinhvien` USING BTREE(`id_sinhvien`),
  INDEX `id_giangvien` USING BTREE(`id_giangvien`)
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tintuc
-- ----------------------------
DROP TABLE IF EXISTS `tintuc`;
CREATE TABLE `tintuc`  (
  `id_tintuc` int(10) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `noidung` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaydangtai` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tacgia` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `anhdaidien` varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id_tintuc`)
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tltk
-- ----------------------------
DROP TABLE IF EXISTS `tltk`;
CREATE TABLE `tltk`  (
  `id_tltk` int(10) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `filetailieu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ngaydang` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `loaitailieu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_giangday` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`id_tltk`),
  INDEX `id_giangday` USING BTREE(`id_giangday`),
  INDEX `id_giangday_2` USING BTREE(`id_giangday`)
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tenuser` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `matkhau` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vaitro` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cccd` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `anh` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ttguigmailctk` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY USING BTREE (`user_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
