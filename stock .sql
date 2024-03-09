-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 03:39 PM
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
-- Table structure for table `advances`
--

CREATE TABLE `advances` (
  `id` int(11) NOT NULL,
  `payer` int(11) NOT NULL,
  `note` text NOT NULL,
  `advance_recipient` int(11) NOT NULL,
  `money` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `taxcode` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `taxcode`, `address`, `phone`, `note`) VALUES
(1, 'abc abc', '123', 'HCMa', '0878688777', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'IT');

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
(1, 'Administrator', 'a:60:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:14:\"createCategory\";i:9;s:14:\"updateCategory\";i:10;s:12:\"viewCategory\";i:11;s:14:\"deleteCategory\";i:12;s:11:\"createStore\";i:13;s:11:\"updateStore\";i:14;s:9:\"viewStore\";i:15;s:11:\"deleteStore\";i:16;s:11:\"viewReports\";i:17;s:13:\"updateCompany\";i:18;s:11:\"viewProfile\";i:19;s:13:\"updateSetting\";i:20;s:13:\"createPayment\";i:21;s:13:\"updatePayment\";i:22;s:11:\"viewPayment\";i:23;s:13:\"deletePayment\";i:24;s:17:\"createExpenditure\";i:25;s:17:\"updateExpenditure\";i:26;s:15:\"viewExpenditure\";i:27;s:17:\"deleteExpenditure\";i:28;s:12:\"createIncome\";i:29;s:12:\"updateIncome\";i:30;s:10:\"viewIncome\";i:31;s:12:\"deleteIncome\";i:32;s:10:\"createFund\";i:33;s:10:\"updateFund\";i:34;s:8:\"viewFund\";i:35;s:10:\"deleteFund\";i:36;s:15:\"createMaterials\";i:37;s:15:\"updateMaterials\";i:38;s:13:\"viewMaterials\";i:39;s:15:\"deleteMaterials\";i:40;s:14:\"createCustomer\";i:41;s:14:\"updateCustomer\";i:42;s:12:\"viewCustomer\";i:43;s:14:\"deleteCustomer\";i:44;s:14:\"createSupplier\";i:45;s:14:\"updateSupplier\";i:46;s:12:\"viewSupplier\";i:47;s:14:\"deleteSupplier\";i:48;s:16:\"createDepartment\";i:49;s:16:\"updateDepartment\";i:50;s:14:\"viewDepartment\";i:51;s:16:\"deleteDepartment\";i:52;s:14:\"createPosition\";i:53;s:14:\"updatePosition\";i:54;s:12:\"viewPosition\";i:55;s:14:\"deletePosition\";i:56;s:15:\"createTmaterial\";i:57;s:15:\"updateTmaterial\";i:58;s:13:\"viewTmaterial\";i:59;s:15:\"deleteTmaterial\";}'),
(4, 'Owners', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}'),
(5, 'ABC', 'a:2:{i:0;s:14:\"updateCategory\";i:1;s:12:\"viewCategory\";}');

-- --------------------------------------------------------

--
-- Table structure for table `hangmuc`
--

CREATE TABLE `hangmuc` (
  `idHangMuc` int(11) NOT NULL,
  `loaiHangMuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hangmuc`
--

INSERT INTO `hangmuc` (`idHangMuc`, `loaiHangMuc`) VALUES
(1, 'Ăn Uống'),
(5, 'ABD'),
(6, 'Tiệc'),
(7, 'Dự án'),
(8, 'Cho Vay');

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
(1, 'Tài Khoản Ngân Hàng'),
(2, 'Tiền Mặt');

-- --------------------------------------------------------

--
-- Table structure for table `materialic_item`
--

CREATE TABLE `materialic_item` (
  `id` int(11) NOT NULL,
  `idBangThu` int(11) NOT NULL,
  `idVatTu` int(11) NOT NULL,
  `soLuong` int(11) DEFAULT NULL,
  `giaTien` varchar(255) DEFAULT NULL,
  `tongTien` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materialic_item`
--

INSERT INTO `materialic_item` (`id`, `idBangThu`, `idVatTu`, `soLuong`, `giaTien`, `tongTien`) VALUES
(40, 46, 370, 12, '123', '1476.00');

-- --------------------------------------------------------

--
-- Table structure for table `material_item`
--

CREATE TABLE `material_item` (
  `id` int(11) NOT NULL,
  `idBangChi` int(11) NOT NULL,
  `idVatTu` int(11) NOT NULL,
  `soLuong` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `tongTien` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_item`
--

INSERT INTO `material_item` (`id`, `idBangChi`, `idVatTu`, `soLuong`, `rate`, `tongTien`) VALUES
(553, 193, 325, '1', '1', '1'),
(590, 28, 370, '123', '123', '15129');

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
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`) VALUES
(1, 'lead');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `taxcode` varchar(255) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `taxcode`, `address`, `phone`, `note`) VALUES
(1, '1212', '312', '12312333222', '123123132', 'dsfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `idTaiKhoan` int(11) NOT NULL,
  `tenTaiKhoan` varchar(255) DEFAULT NULL,
  `loaithanhtoan_id` int(11) DEFAULT NULL,
  `loaiTien` char(5) DEFAULT NULL,
  `soTienBanDau` varchar(255) DEFAULT NULL,
  `income` varchar(255) DEFAULT NULL,
  `expense` varchar(255) DEFAULT NULL,
  `recharge` varchar(255) DEFAULT NULL,
  `remain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`idTaiKhoan`, `tenTaiKhoan`, `loaithanhtoan_id`, `loaiTien`, `soTienBanDau`, `income`, `expense`, `recharge`, `remain`) VALUES
(1, 'ATM', 1, 'vnd', '1,000,000.00', '0.00', '0.00', NULL, '1,000,000.00'),
(2, 'Ví', 2, 'vnd', '1,000,000.00', '0.00', '0.00', NULL, '1,000,000.00'),
(4, 'acs', 2, 'vnd', '50,000.00', '25.00', '0.00', NULL, '50,025.00'),
(5, 'avd', 2, 'cfd', '123,443,434.00', '0.00', '0.00', NULL, '123,443,434.00'),
(7, 'Công Quỹ', 1, 'VND', '20,000,000.00', '15.00', '151,933,952.00', NULL, '-131,933,937.00');

-- --------------------------------------------------------

--
-- Table structure for table `taobangchi`
--

CREATE TABLE `taobangchi` (
  `idBangChi` int(11) NOT NULL,
  `idHangMuc` int(11) DEFAULT NULL,
  `tenHangMuc` varchar(255) DEFAULT NULL,
  `ghiChu` text NOT NULL,
  `materialStatus` int(11) DEFAULT NULL,
  `idTaiKhoan` int(11) NOT NULL,
  `nguoiChi` varchar(255) NOT NULL,
  `ngayChi` date NOT NULL,
  `nguoiNhan` int(11) NOT NULL,
  `soTien` varchar(255) NOT NULL,
  `tongTien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taobangchi`
--

INSERT INTO `taobangchi` (`idBangChi`, `idHangMuc`, `tenHangMuc`, `ghiChu`, `materialStatus`, `idTaiKhoan`, `nguoiChi`, `ngayChi`, `nguoiNhan`, `soTien`, `tongTien`) VALUES
(28, 8, '123', '123', 1, 7, '123', '2024-03-08', 0, '132', '15261.00');

-- --------------------------------------------------------

--
-- Table structure for table `taobangthu`
--

CREATE TABLE `taobangthu` (
  `idBangThu` int(11) NOT NULL,
  `idHangMuc` int(11) NOT NULL,
  `tenHangMuc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ghiChu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `materialStatus` int(11) DEFAULT NULL,
  `idTaiKhoan` int(11) NOT NULL,
  `nguoiThu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ngayThu` date NOT NULL,
  `soTienThu` varchar(255) NOT NULL,
  `tongTien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taobangthu`
--

INSERT INTO `taobangthu` (`idBangThu`, `idHangMuc`, `tenHangMuc`, `ghiChu`, `materialStatus`, `idTaiKhoan`, `nguoiThu`, `ngayThu`, `soTienThu`, `tongTien`) VALUES
(46, 8, '123', '123', 1, 5, '1', '2024-03-08', '1', '1477.00'),
(47, 8, '123', '123', 0, 5, '1', '2024-03-08', '1', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `remitter` int(11) NOT NULL,
  `from_account` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `to_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `typematerial`
--

CREATE TABLE `typematerial` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `typematerial`
--

INSERT INTO `typematerial` (`id`, `name`) VALUES
(1, 'Vật Tư'),
(8, 'Hang Hoá');

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
  `gender` int(11) NOT NULL,
  `dateobirth` date DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `cardID` int(11) DEFAULT NULL,
  `dateID` date DEFAULT NULL,
  `placeID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `typecontract` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `taxcode` int(11) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `daywork` date DEFAULT NULL,
  `duration` date DEFAULT NULL,
  `banka` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_position` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`, `dateobirth`, `address`, `address1`, `cardID`, `dateID`, `placeID`, `typecontract`, `taxcode`, `salary`, `daywork`, `duration`, `banka`, `bank`, `id_department`, `id_position`, `manager_id`) VALUES
(1, 'admin', '$2y$10$ZrBk2zWOLhPAaOhncDBJv.pKAfhFYywahFQXY4NXDmhOcaRtLdAfS', 'admin@admin.com', 'admin', 'a', '12345678910', 1, '2024-02-01', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'ta123', '$2y$10$3SUBN2dBSimGtPKvIKGjs.04jur4xpWZrkmbUjvhDvypvpiGy1mq6', 'conq@gm.com', 'df', 'vd', '061254523', 1, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'tan123', '$2y$10$hZQfR7fC/2AoLqu6/Y/az.EobuT33He0tZhdRjjwi7rD4s/zDicKu', '123@213.com', 'abc', 'abc', '0878688777', 1, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'abc123', '$2y$10$7tJJlHWXytXoSrHTUNcbG.4sbYaahRijjVhhoQNt3gIMZb52trFVm', 'abc123@gmail.com', 'A', 'B', '09456521231', 1, '2024-02-01', '123asda', '', 1234567890, '2024-02-01', 'abc', 'abc', 1234316, 500000000, '2024-02-01', '2024-02-29', '1223345436567', 'abc', 1, 1, 8);

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
(9, 8, 5),
(10, 9, 4),
(11, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vattu`
--

CREATE TABLE `vattu` (
  `idVatTu` int(11) NOT NULL,
  `tenVatTu` varchar(255) NOT NULL,
  `loaiVatTu` int(11) DEFAULT NULL,
  `soLuong` varchar(255) NOT NULL,
  `giaTien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vattu`
--

INSERT INTO `vattu` (`idVatTu`, `tenVatTu`, `loaiVatTu`, `soLuong`, `giaTien`) VALUES
(370, 'abcv', 0, '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advances`
--
ALTER TABLE `advances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hangmuc`
--
ALTER TABLE `hangmuc`
  ADD PRIMARY KEY (`idHangMuc`);

--
-- Indexes for table `loaithanhtoan`
--
ALTER TABLE `loaithanhtoan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialic_item`
--
ALTER TABLE `materialic_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_item`
--
ALTER TABLE `material_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhansu`
--
ALTER TABLE `nhansu`
  ADD PRIMARY KEY (`idNhanSu`),
  ADD KEY `idDuAnThu` (`idDuAnThu`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
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
  ADD KEY `FK_HangMucChi` (`idHangMuc`);

--
-- Indexes for table `taobangthu`
--
ALTER TABLE `taobangthu`
  ADD PRIMARY KEY (`idBangThu`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typematerial`
--
ALTER TABLE `typematerial`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `vattu`
--
ALTER TABLE `vattu`
  ADD PRIMARY KEY (`idVatTu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advances`
--
ALTER TABLE `advances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hangmuc`
--
ALTER TABLE `hangmuc`
  MODIFY `idHangMuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loaithanhtoan`
--
ALTER TABLE `loaithanhtoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materialic_item`
--
ALTER TABLE `materialic_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `material_item`
--
ALTER TABLE `material_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

--
-- AUTO_INCREMENT for table `nhansu`
--
ALTER TABLE `nhansu`
  MODIFY `idNhanSu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `idTaiKhoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taobangchi`
--
ALTER TABLE `taobangchi`
  MODIFY `idBangChi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `taobangthu`
--
ALTER TABLE `taobangthu`
  MODIFY `idBangThu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typematerial`
--
ALTER TABLE `typematerial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vattu`
--
ALTER TABLE `vattu`
  MODIFY `idVatTu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
