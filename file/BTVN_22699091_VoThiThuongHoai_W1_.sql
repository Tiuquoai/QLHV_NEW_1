--Võ Thị Thương Hoài_Week01_BaiTapVeNha
--1) tạo cơ sở dữ liệu:
CREATE DATABASE Sales
ON PRIMARY
(
    NAME = Sales_Data,
    FILENAME = 'D:\VTTH\Sales\Sales_Data.mdf',
    SIZE = 10MB,
    MAXSIZE = 100MB,
    FILEGROWTH = 5MB
)
LOG ON
(
    NAME = Sales_Log,
    FILENAME = 'D:\VTTH\Sales\Sales_Log.ldf',
    SIZE = 5MB,
    MAXSIZE = 50MB,
    FILEGROWTH = 5MB
);
GO

--1.1) tạo kiểu dữ liệu người dùng:
CREATE TYPE dbo.Mota FROM NVARCHAR(40) NULL;
CREATE TYPE dbo.IDKH FROM CHAR(10) NOT NULL;
CREATE TYPE dbo.DT   FROM CHAR(12) NULL;
GO

--2) Tạo bảng:
--Bảng sản phẩm
CREATE TABLE SanPham
(
    Masp CHAR(6) PRIMARY KEY,
    TenSp VARCHAR(20),
    NgayNhap DATE,
    DVT CHAR(10),
    SoLuongTon INT,
    DonGiaNhap MONEY
);

--Bảng khách hàng
CREATE TABLE KhachHang
(
    MaKH IDKH PRIMARY KEY,
    TenKH NVARCHAR(30),
    DiaChi NVARCHAR(40),
    DienThoai DT
);

--Bảng hóa đơn
CREATE TABLE HoaDon
(
    MaHD CHAR(10) PRIMARY KEY,
    NgayLap DATE,
    NgayGiao DATE,
    MaKH IDKH,
    DienGiai Mota
);

--Bảng chi tiết hóa đơn
CREATE TABLE ChiTietHD
(
    MaHD CHAR(10),
    Masp CHAR(6),
    SoLuong INT,
    PRIMARY KEY (MaHD, Masp)
);

--3) Đổi kiểu cột DienGiai
ALTER TABLE HoaDon
ALTER COLUMN DienGiai NVARCHAR(100);

--4) Thêm cột TyLeHoaHong
ALTER TABLE SanPham
ADD TyLeHoaHong FLOAT;

--5) Xóa cột NgayNhap
ALTER TABLE SanPham
DROP COLUMN NgayNhap;

--6) Tạo khóa ngoại
ALTER TABLE HoaDon
ADD CONSTRAINT FK_HoaDon_KhachHang
FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH);

ALTER TABLE ChiTietHD
ADD CONSTRAINT FK_CTHD_HoaDon
FOREIGN KEY (MaHD) REFERENCES HoaDon(MaHD);

ALTER TABLE ChiTietHD
ADD CONSTRAINT FK_CTHD_SanPham
FOREIGN KEY (Masp) REFERENCES SanPham(Masp);

--7) Ràng buộc cho HoaDon
ALTER TABLE HoaDon
ADD CONSTRAINT CK_NgayGiao
CHECK (NgayGiao >= NgayLap);

ALTER TABLE HoaDon
ADD CONSTRAINT CK_MaHD
CHECK (MaHD LIKE '[A-Z][A-Z][A-Z][A-Z][A-Z][A-Z][0-9][0-9][0-9][0-9]');

ALTER TABLE HoaDon
ADD CONSTRAINT DF_NgayLap
DEFAULT GETDATE() FOR NgayLap;

--8) Ràng buộc cho SanPham
ALTER TABLE dbo.SanPham
ADD CONSTRAINT CK_SoLuongTon CHECK (SoLuongTon BETWEEN 0 AND 500);

ALTER TABLE dbo.SanPham
ADD CONSTRAINT CK_DonGiaNhap CHECK (DonGiaNhap > 0);

ALTER TABLE dbo.SanPham
ADD CONSTRAINT CK_DVT CHECK (DVT IN ('KG', N'Thùng', N'Hộp', N'Cái'));

-- Nếu NgayNhap còn tồn tại thì mới add DEFAULT
IF COL_LENGTH('dbo.SanPham', 'NgayNhap') IS NOT NULL
BEGIN
    ALTER TABLE dbo.SanPham
    ADD CONSTRAINT DF_NgayNhap DEFAULT (GETDATE()) FOR NgayNhap;
END
GO

--9) Nhập dữ liệu mẫu
INSERT INTO HoaDon (MaHD, NgayGiao, MaKH, DienGiai)
VALUES ('HDABCD1234', GETDATE(), 'KH00000001', N'Hóa đơn bán hàng');

INSERT INTO ChiTietHD
VALUES ('HDABCD1234', 'SP0001', 10);

--10) xóa hóa đơn
DELETE FROM HoaDon WHERE MaHD = 'HD00000123';
--Không xóa được.Vì ChiTietHD đang tham chiếu khóa ngoại
DELETE FROM ChiTietHD WHERE MaHD = 'HD00000123';
DELETE FROM HoaDon WHERE MaHD = 'HD00000123';

--11) Nhập ChiTietHD sai MaHD
INSERT INTO ChiTietHD VALUES ('HD99999999', 'SP0001', 5);
INSERT INTO ChiTietHD VALUES ('1234567890', 'SP0001', 5);
--Không nhập được.Vì không tồn tại MaHD trong bảng HoaDon

--12) Đổi tên CSDL
ALTER DATABASE Sales SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
ALTER DATABASE Sales MODIFY NAME = BanHang;
ALTER DATABASE BanHang SET MULTI_USER;

--13) Copy CSDL & Attach
--Detach
EXEC sp_detach_db 'BanHang';
--Attach
CREATE DATABASE BanHang
ON
(
    FILENAME = 'D:\QLBH\Sales_Data.mdf'
),
(
    FILENAME = 'D:\QLBH\Sales_Log.ldf'
)
FOR ATTACH;

--14) Backup CSDL
BACKUP DATABASE BanHang
TO DISK = 'D:\QLBH\BanHang.bak'
WITH INIT;

--15) xóa csdl
DROP DATABASE BanHang;

--16) Restore CSDL
RESTORE DATABASE BanHang
FROM DISK = 'D:\QLBH\BanHang.bak'
WITH REPLACE;



