CREATE DATABASE EDW;
GO
USE EDW;
GO

-- 2. Tạo Schemas
CREATE SCHEMA stg;
GO

CREATE SCHEMA dw;
GO

-- 3. Tạo Staging Table (Python load dữ liệu vào)
CREATE TABLE stg.BookSalesRaw (
    PublishingYear INT NULL,
    BookName NVARCHAR(500),
    Author NVARCHAR(250),
    language_code NVARCHAR(20),
    Author_Rating DECIMAL(3,2),
    Book_average_rating DECIMAL(3,2),
    Book_ratings_count BIGINT,
    genre NVARCHAR(200),
    gross_sales DECIMAL(18,2),
    publisher_revenue DECIMAL(18,2),
    sale_price DECIMAL(10,2),
    sales_rank INT,
    Publisher NVARCHAR(250),
    units_sold BIGINT,
    LoadDT DATETIME2 DEFAULT SYSUTCDATETIME()
);
GO

-- 4. Dimension Tables
-- Publisher Dimension
CREATE TABLE dw.dimPublisher (
    PublisherKey INT IDENTITY PRIMARY KEY CLUSTERED,
    PublisherName NVARCHAR(250) UNIQUE
);
GO

-- Author Dimension
CREATE TABLE dw.dimAuthor (
    AuthorKey INT IDENTITY PRIMARY KEY CLUSTERED,
    AuthorName NVARCHAR(250) UNIQUE,
    AuthorRating DECIMAL(3,2) NULL
);
GO

-- Book Dimension (SCD2)
CREATE TABLE dw.dimBook (
    BookSK INT IDENTITY PRIMARY KEY CLUSTERED,
    BookNaturalKey NVARCHAR(1000),  -- ví dụ BookName|Author
    BookName NVARCHAR(500),
    AuthorKey INT,
    PublisherKey INT,
    Genre NVARCHAR(200),
    PublishingYear INT,
    LanguageCode NVARCHAR(20),
    CurrentFlag BIT DEFAULT 1,
    EffectiveFrom DATETIME2,
    EffectiveTo DATETIME2 NULL,
    HashValue NVARCHAR(64), -- để track thay đổi
    CONSTRAINT UX_dimBook_Natural_Current UNIQUE (BookNaturalKey, CurrentFlag)
);
GO

-- Date Dimension
CREATE TABLE dw.dimDate (
    DateKey INT PRIMARY KEY CLUSTERED,   -- format YYYYMMDD
    FullDate DATE,
    Year INT,
    Quarter INT,
    Month INT,
    Day INT
);
GO

-- 5. Fact Table (Sales)
CREATE TABLE dw.factSales (
    SalesID BIGINT IDENTITY NOT NULL,
    DateKey INT NOT NULL,        -- FK tới dimDate
    BookSK INT NOT NULL,         -- FK tới dimBook
    AuthorKey INT NULL,          -- FK tới dimAuthor
    PublisherKey INT NULL,       -- FK tới dimPublisher
    UnitsSold BIGINT,
    SalePrice DECIMAL(18,2),
    GrossSales DECIMAL(18,2),
    PublisherRevenue DECIMAL(18,2),
    SalesRank INT,
    LoadDate DATE NOT NULL DEFAULT CONVERT(date, SYSUTCDATETIME())
);
GO

-- Tạo Clustered Columnstore Index cho Fact (best practice)
CREATE CLUSTERED COLUMNSTORE INDEX CCI_FactSales ON dw.factSales;
GO
