-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 04:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `anuongthu`
--

CREATE TABLE `anuongthu` (
  `idAnUongThu` int(11) NOT NULL,
  `idLoaiHangMucThu` int(11) NOT NULL,
  `TenAnUong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `active`) VALUES
(4, 'ok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_parent_id`) VALUES
(5, 'Blue', 2),
(6, 'White', 2),
(7, 'M', 3),
(8, 'L', 3),
(9, 'Green', 2),
(10, 'Black', 2),
(12, 'Grey', 2),
(13, 'S', 3),
(14, '15', 4);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `active`) VALUES
(4, 'ABC Inc.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(4, 'Microscope', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chomuonchi`
--

CREATE TABLE `chomuonchi` (
  `idChoMuonChi` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL,
  `donViChoMuon` varchar(255) NOT NULL,
  `thoHanTra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chomuonthu`
--

CREATE TABLE `chomuonthu` (
  `idChoMuonThu` int(11) NOT NULL,
  `idLoaiHangMucThu` int(11) NOT NULL,
  `donViChoVay` varchar(255) NOT NULL,
  `thoiHanTra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'ABC Inc.', '13', '10', '1234 Main St. Los Angeles, CA 98765 U.S.A.', '(123) 456-7890', 'United States of America', 'Sample message<br>', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `dautuchi`
--

CREATE TABLE `dautuchi` (
  `idDauTuChi` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL,
  `tenDuAnChi` varchar(255) NOT NULL,
  `tenNguoiNhan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daututhu`
--

CREATE TABLE `daututhu` (
  `idDauTu` int(11) NOT NULL,
  `idLoaiHangMucThu` int(11) NOT NULL,
  `tenDuAn` varchar(255) NOT NULL,
  `donViDauTu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `duanchi`
--

CREATE TABLE `duanchi` (
  `idDuAnChi` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL,
  `tenDuAn` varchar(255) NOT NULL,
  `idvatTu` varchar(255) NOT NULL,
  `ship` varchar(255) NOT NULL,
  `thueNgoai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `duanthu`
--

CREATE TABLE `duanthu` (
  `idDuAnThu` int(11) NOT NULL,
  `idLoaiHangMucThu` int(11) NOT NULL,
  `tenDuAn` varchar(255) NOT NULL,
  `idVatTu` int(11) NOT NULL,
  `idNhanSu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Administrator', 'a:68:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";i:36;s:21:\"createExpenditureType\";i:37;s:21:\"updateExpenditureType\";i:38;s:19:\"viewExpenditureType\";i:39;s:21:\"deleteExpenditureType\";i:40;s:16:\"createIncomeType\";i:41;s:16:\"updateIncomeType\";i:42;s:14:\"viewIncomeType\";i:43;s:16:\"deleteIncomeType\";i:44;s:25:\"createExpenditureCategory\";i:45;s:25:\"updateExpenditureCategory\";i:46;s:23:\"viewExpenditureCategory\";i:47;s:25:\"deleteExpenditureCategory\";i:48;s:20:\"createIncomeCategory\";i:49;s:20:\"updateIncomeCategory\";i:50;s:18:\"viewIncomeCategory\";i:51;s:20:\"deleteIncomeCategory\";i:52;s:13:\"createPayment\";i:53;s:13:\"updatePayment\";i:54;s:11:\"viewPayment\";i:55;s:13:\"deletePayment\";i:56;s:17:\"createExpenditure\";i:57;s:17:\"updateExpenditure\";i:58;s:15:\"viewExpenditure\";i:59;s:17:\"deleteExpenditure\";i:60;s:12:\"createIncome\";i:61;s:12:\"updateIncome\";i:62;s:10:\"viewIncome\";i:63;s:12:\"deleteIncome\";i:64;s:10:\"createFund\";i:65;s:10:\"updateFund\";i:66;s:8:\"viewFund\";i:67;s:10:\"deleteFund\";}'),
(4, 'Owners', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}');

-- --------------------------------------------------------

--
-- Table structure for table `hangmucchi`
--

CREATE TABLE `hangmucchi` (
  `idHangMucChi` int(11) NOT NULL,
  `tenHangMucChi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hangmucchi`
--

INSERT INTO `hangmucchi` (`idHangMucChi`, `tenHangMucChi`) VALUES
(1, 'Ăn Uống'),
(5, 'ABD'),
(6, 'Tiệc'),
(7, 'Dự án');

-- --------------------------------------------------------

--
-- Table structure for table `hangmucthu`
--

CREATE TABLE `hangmucthu` (
  `idHangMucThu` int(11) NOT NULL,
  `tenHangMucThu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hangmucthu`
--

INSERT INTO `hangmucthu` (`idHangMucThu`, `tenHangMucThu`) VALUES
(2, '123'),
(3, '456');

-- --------------------------------------------------------

--
-- Table structure for table `hatang`
--

CREATE TABLE `hatang` (
  `idHaTang` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL,
  `loaiHaTang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaihangmucchi`
--

CREATE TABLE `loaihangmucchi` (
  `idLoaiHangMucChi` int(11) NOT NULL,
  `tenLoaiHangMucChi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaihangmucchi`
--

INSERT INTO `loaihangmucchi` (`idLoaiHangMucChi`, `tenLoaiHangMucChi`) VALUES
(7, 'Ăn Uống'),
(8, 'Dự Án 1'),
(9, 'Thuế'),
(10, 'Văn Phòng Phẩm');

-- --------------------------------------------------------

--
-- Table structure for table `loaihangmucthu`
--

CREATE TABLE `loaihangmucthu` (
  `idLoaiHangMucThu` int(11) NOT NULL,
  `tenLoaiHangMucThu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaihangmucthu`
--

INSERT INTO `loaihangmucthu` (`idLoaiHangMucThu`, `tenLoaiHangMucThu`) VALUES
(2, 'Dự Án');

-- --------------------------------------------------------

--
-- Table structure for table `loaithanhtoan`
--

CREATE TABLE `loaithanhtoan` (
  `id` int(11) NOT NULL,
  `loaiThanhToan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaithanhtoan`
--

INSERT INTO `loaithanhtoan` (`id`, `loaiThanhToan`) VALUES
(1, 'Thẻ Ngân Hàng'),
(2, 'Tiền Mặt');

-- --------------------------------------------------------

--
-- Table structure for table `loai_hangchi`
--

CREATE TABLE `loai_hangchi` (
  `id` int(11) NOT NULL,
  `idHangMucChi` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loai_hangchi`
--

INSERT INTO `loai_hangchi` (`id`, `idHangMucChi`, `idLoaiHangMucChi`) VALUES
(1, 1, 7),
(2, 2, 5),
(3, 3, 3),
(4, 4, 5),
(5, 5, 8),
(6, 6, 7),
(7, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `loai_hangthu`
--

CREATE TABLE `loai_hangthu` (
  `id` int(11) NOT NULL,
  `idHangMucThu` int(11) DEFAULT NULL,
  `idLoaiHangMucThu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loai_hangthu`
--

INSERT INTO `loai_hangthu` (`id`, `idHangMucThu`, `idLoaiHangMucThu`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `luong`
--

CREATE TABLE `luong` (
  `idLuong` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL,
  `loaiLuong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhansu`
--

CREATE TABLE `nhansu` (
  `idNhanSu` int(11) NOT NULL,
  `idDuAnThu` int(11) NOT NULL,
  `tenThanhVien` varchar(255) NOT NULL,
  `soGio` float NOT NULL,
  `donGia` float NOT NULL,
  `thanhTien` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `customer_name`, `customer_address`, `customer_phone`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `net_amount`, `discount`, `paid_status`, `user_id`) VALUES
(2, 'BILPR-F6C5', 'q', '3', '5586322', '1700469858', '545.00', '13', '70.85', '10', '54.50', '655.35', '15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `qty`, `rate`, `amount`) VALUES
(4, 2, 2, '1', '545', '545.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` text DEFAULT NULL,
  `brand_id` text NOT NULL,
  `category_id` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `qty`, `image`, `description`, `attribute_value_id`, `brand_id`, `category_id`, `store_id`, `availability`) VALUES
(2, 'fgdg', '4', '545', '44', '<p>You did not select a file to upload.</p>', '<p>45</p>', 'null', '[\"4\"]', '[\"4\"]', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(3, 'bg', 1),
(4, 'FE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `idTaiKhoan` int(11) NOT NULL,
  `tenTaiKhoan` varchar(255) NOT NULL,
  `loaithanhtoan_id` int(11) NOT NULL,
  `loaiTien` char(5) NOT NULL,
  `soTienBanDau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`idTaiKhoan`, `tenTaiKhoan`, `loaithanhtoan_id`, `loaiTien`, `soTienBanDau`) VALUES
(1, 'ATM', 1, 'vnd', '1,000,000.00'),
(2, 'Ví', 2, 'vnd', '1,000,000.00'),
(4, 'acs', 2, 'vnd', '50,000.00'),
(5, 'avd', 2, 'cfd', '123,443,434.00'),
(7, 'Công Quỹ', 1, 'VND', '20,000,000.00');

-- --------------------------------------------------------

--
-- Table structure for table `taobangchi`
--

CREATE TABLE `taobangchi` (
  `idBangChi` int(11) NOT NULL,
  `idHangMucChi` int(11) NOT NULL,
  `idTaiKhoan` int(11) NOT NULL,
  `nguoiChi` varchar(255) NOT NULL,
  `ngayChi` date NOT NULL,
  `soTien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taobangchi`
--

INSERT INTO `taobangchi` (`idBangChi`, `idHangMucChi`, `idTaiKhoan`, `nguoiChi`, `ngayChi`, `soTien`) VALUES
(1, 1, 1, 'CDF', '2023-11-21', '23,434.00'),
(3, 7, 1, 'efd', '2023-11-27', '34,678.00'),
(8, 7, 2, 'ds', '2023-11-22', '50,000.00'),
(9, 7, 2, '65', '2023-11-22', '40,000.00'),
(10, 7, 1, 'cd', '2023-11-22', '25,000.00'),
(12, 6, 2, 'ko', '2023-11-29', '25,000.00'),
(13, 7, 4, '966', '2023-11-17', '152,220.00');

-- --------------------------------------------------------

--
-- Table structure for table `taobangthu`
--

CREATE TABLE `taobangthu` (
  `idBangThu` int(11) NOT NULL,
  `idHangMucThu` int(11) NOT NULL,
  `idTaiKhoan` int(11) NOT NULL,
  `nguoiThu` varchar(255) NOT NULL,
  `ngayThu` date NOT NULL,
  `soTienThu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taobangthu`
--

INSERT INTO `taobangthu` (`idBangThu`, `idHangMucThu`, `idTaiKhoan`, `nguoiThu`, `ngayThu`, `soTienThu`) VALUES
(1, 3, 1, 'abc', '2023-11-29', '1236'),
(2, 3, 1, 'knf', '2023-11-21', '12562'),
(3, 2, 1, 'ABC', '2023-11-22', '200000'),
(4, 3, 1, 'yy', '2023-11-22', '3,000,005.00'),
(5, 3, 1, 'ok', '2023-11-22', '1,500,000.00'),
(7, 3, 1, 'ewds', '2023-11-23', '1,213,213.00'),
(11, 3, 1, '1522s', '2023-11-21', '625,226.00');

-- --------------------------------------------------------

--
-- Table structure for table `thue`
--

CREATE TABLE `thue` (
  `idThue` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL,
  `tenThue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'admin', '$2y$10$ZrBk2zWOLhPAaOhncDBJv.pKAfhFYywahFQXY4NXDmhOcaRtLdAfS', 'admin@admin.com', 'admin', 'a', '12345678910', 1),
(8, 'ta123', '$2y$10$tD9d1N0TXGyh2rtKOGDuFe5A0SL6EpJBXYjd3Snq3ziElAh3xlhPq', 'conq@gm.com', 'df', 'vd', '061254523', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(9, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vanphongphamchi`
--

CREATE TABLE `vanphongphamchi` (
  `idVanPhongPhamChi` int(11) NOT NULL,
  `idLoaiHangMucChi` int(11) NOT NULL,
  `tenVanPhongPhamChi` varchar(255) NOT NULL,
  `idVatTuChi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vattuchi`
--

CREATE TABLE `vattuchi` (
  `idVatTuChi` int(11) NOT NULL,
  `idDuAnChi` int(11) NOT NULL,
  `tenVatTu` varchar(255) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `giaTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vattuthu`
--

CREATE TABLE `vattuthu` (
  `idVatTuThu` int(11) NOT NULL,
  `idDuAnThu` int(11) NOT NULL,
  `tenVatTu` varchar(255) NOT NULL,
  `soLuong` float NOT NULL,
  `giaTien` float NOT NULL,
  `Tong` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anuongthu`
--
ALTER TABLE `anuongthu`
  ADD PRIMARY KEY (`idAnUongThu`),
  ADD KEY `idLoaiHangMucThu` (`idLoaiHangMucThu`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chomuonchi`
--
ALTER TABLE `chomuonchi`
  ADD PRIMARY KEY (`idChoMuonChi`),
  ADD KEY `idLoaiHangMucChi` (`idLoaiHangMucChi`);

--
-- Indexes for table `chomuonthu`
--
ALTER TABLE `chomuonthu`
  ADD PRIMARY KEY (`idChoMuonThu`),
  ADD KEY `idLoaiHangMucThu` (`idLoaiHangMucThu`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dautuchi`
--
ALTER TABLE `dautuchi`
  ADD PRIMARY KEY (`idDauTuChi`),
  ADD KEY `idLoaiHangMucChi` (`idLoaiHangMucChi`);

--
-- Indexes for table `daututhu`
--
ALTER TABLE `daututhu`
  ADD PRIMARY KEY (`idDauTu`),
  ADD KEY `idLoaiHangMucThu` (`idLoaiHangMucThu`);

--
-- Indexes for table `duanchi`
--
ALTER TABLE `duanchi`
  ADD PRIMARY KEY (`idDuAnChi`),
  ADD KEY `idLoaiHangMucChi` (`idLoaiHangMucChi`);

--
-- Indexes for table `duanthu`
--
ALTER TABLE `duanthu`
  ADD PRIMARY KEY (`idDuAnThu`),
  ADD KEY `idLoaiHangMucThu` (`idLoaiHangMucThu`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hangmucchi`
--
ALTER TABLE `hangmucchi`
  ADD PRIMARY KEY (`idHangMucChi`);

--
-- Indexes for table `hangmucthu`
--
ALTER TABLE `hangmucthu`
  ADD PRIMARY KEY (`idHangMucThu`);

--
-- Indexes for table `hatang`
--
ALTER TABLE `hatang`
  ADD PRIMARY KEY (`idHaTang`),
  ADD KEY `idLoaiHangMucChi` (`idLoaiHangMucChi`);

--
-- Indexes for table `loaihangmucchi`
--
ALTER TABLE `loaihangmucchi`
  ADD PRIMARY KEY (`idLoaiHangMucChi`);

--
-- Indexes for table `loaihangmucthu`
--
ALTER TABLE `loaihangmucthu`
  ADD PRIMARY KEY (`idLoaiHangMucThu`);

--
-- Indexes for table `loaithanhtoan`
--
ALTER TABLE `loaithanhtoan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loai_hangchi`
--
ALTER TABLE `loai_hangchi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loai_hangthu`
--
ALTER TABLE `loai_hangthu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`idLuong`),
  ADD KEY `idLoaiHangMucChi` (`idLoaiHangMucChi`);

--
-- Indexes for table `nhansu`
--
ALTER TABLE `nhansu`
  ADD PRIMARY KEY (`idNhanSu`),
  ADD KEY `idDuAnThu` (`idDuAnThu`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`idTaiKhoan`);

--
-- Indexes for table `taobangchi`
--
ALTER TABLE `taobangchi`
  ADD PRIMARY KEY (`idBangChi`),
  ADD KEY `FK_HangMucChi` (`idHangMucChi`);

--
-- Indexes for table `taobangthu`
--
ALTER TABLE `taobangthu`
  ADD PRIMARY KEY (`idBangThu`),
  ADD KEY `FK_HangMucThu` (`idHangMucThu`),
  ADD KEY `FK_TKThu` (`idTaiKhoan`);

--
-- Indexes for table `thue`
--
ALTER TABLE `thue`
  ADD PRIMARY KEY (`idThue`),
  ADD KEY `idLoaiHangMucChi` (`idLoaiHangMucChi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vanphongphamchi`
--
ALTER TABLE `vanphongphamchi`
  ADD PRIMARY KEY (`idVanPhongPhamChi`),
  ADD KEY `idLoaiHangMucChi` (`idLoaiHangMucChi`);

--
-- Indexes for table `vattuchi`
--
ALTER TABLE `vattuchi`
  ADD PRIMARY KEY (`idVatTuChi`),
  ADD KEY `idDuAnChi` (`idDuAnChi`);

--
-- Indexes for table `vattuthu`
--
ALTER TABLE `vattuthu`
  ADD PRIMARY KEY (`idVatTuThu`),
  ADD KEY `idDuAnThu` (`idDuAnThu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anuongthu`
--
ALTER TABLE `anuongthu`
  MODIFY `idAnUongThu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chomuonchi`
--
ALTER TABLE `chomuonchi`
  MODIFY `idChoMuonChi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chomuonthu`
--
ALTER TABLE `chomuonthu`
  MODIFY `idChoMuonThu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dautuchi`
--
ALTER TABLE `dautuchi`
  MODIFY `idDauTuChi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daututhu`
--
ALTER TABLE `daututhu`
  MODIFY `idDauTu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duanchi`
--
ALTER TABLE `duanchi`
  MODIFY `idDuAnChi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duanthu`
--
ALTER TABLE `duanthu`
  MODIFY `idDuAnThu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hangmucchi`
--
ALTER TABLE `hangmucchi`
  MODIFY `idHangMucChi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hangmucthu`
--
ALTER TABLE `hangmucthu`
  MODIFY `idHangMucThu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hatang`
--
ALTER TABLE `hatang`
  MODIFY `idHaTang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loaihangmucchi`
--
ALTER TABLE `loaihangmucchi`
  MODIFY `idLoaiHangMucChi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loaihangmucthu`
--
ALTER TABLE `loaihangmucthu`
  MODIFY `idLoaiHangMucThu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaithanhtoan`
--
ALTER TABLE `loaithanhtoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loai_hangchi`
--
ALTER TABLE `loai_hangchi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loai_hangthu`
--
ALTER TABLE `loai_hangthu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `luong`
--
ALTER TABLE `luong`
  MODIFY `idLuong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhansu`
--
ALTER TABLE `nhansu`
  MODIFY `idNhanSu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `idTaiKhoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taobangchi`
--
ALTER TABLE `taobangchi`
  MODIFY `idBangChi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `taobangthu`
--
ALTER TABLE `taobangthu`
  MODIFY `idBangThu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
