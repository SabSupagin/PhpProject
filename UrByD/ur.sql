-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 พ.ย. 2020 เมื่อ 01:00 PM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ur`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_category`
--

CREATE TABLE `aby_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_category`
--

INSERT INTO `aby_category` (`category_id`, `category_name`) VALUES
(1, 'เครื่องดื่ม '),
(2, 'อาหาร');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_order`
--

CREATE TABLE `aby_order` (
  `order_id` varchar(7) NOT NULL,
  `order_sum_price` decimal(18,2) DEFAULT NULL,
  `staff_id` varchar(7) NOT NULL,
  `order_createddate` datetime DEFAULT NULL,
  `order_discount` int(11) NOT NULL,
  `order_seat` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_order`
--

INSERT INTO `aby_order` (`order_id`, `order_sum_price`, `staff_id`, `order_createddate`, `order_discount`, `order_seat`, `ord_id`) VALUES
('OR0001', '356.00', 'US0002', '2020-10-01 05:28:12', 0, 5, 1),
('OR0002', '356.00', 'US0002', '2020-10-22 23:02:16', 50, 1, 1),
('OR0003', '7.00', 'US0002', '2020-10-22 23:02:59', 0, 1, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_order_detail`
--

CREATE TABLE `aby_order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `product_id` varchar(7) NOT NULL,
  `order_detail_qty` int(11) NOT NULL,
  `order_id` varchar(7) NOT NULL,
  `order_detail_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_order_detail`
--

INSERT INTO `aby_order_detail` (`order_detail_id`, `product_id`, `order_detail_qty`, `order_id`, `order_detail_price`) VALUES
(1, 'PR0002', 1, 'OR0001', 300),
(2, 'PR0002', 8, 'OR0002', 14),
(3, 'PR0001', 1, 'OR0002', 320),
(4, 'PR0002', 1, 'OR0003', 14);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_order_status`
--

CREATE TABLE `aby_order_status` (
  `ord_id` int(11) NOT NULL,
  `ord_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_order_status`
--

INSERT INTO `aby_order_status` (`ord_id`, `ord_name`) VALUES
(1, 'ยังไม่จ่ายเงิน'),
(2, 'จ่ายเงิน');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_prefix`
--

CREATE TABLE `aby_prefix` (
  `prefix_id` int(11) NOT NULL,
  `prefix_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_prefix`
--

INSERT INTO `aby_prefix` (`prefix_id`, `prefix_name`) VALUES
(1, 'เด็กชาย'),
(2, 'เด็กหญิง'),
(3, 'นาย'),
(4, 'นาง'),
(5, 'นางสาว'),
(6, 'คุณ');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_product`
--

CREATE TABLE `aby_product` (
  `product_id` varchar(7) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_stock` varchar(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `product_cost` decimal(18,2) DEFAULT NULL,
  `product_price` decimal(18,2) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `product_description` varchar(50) DEFAULT NULL,
  `product_img` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_product`
--

INSERT INTO `aby_product` (`product_id`, `product_name`, `product_stock`, `unit_id`, `product_cost`, `product_price`, `category_id`, `product_description`, `product_img`) VALUES
('PR0001', 'เหล้าหงส์ทอง', '30', 7, '300.00', '320.00', 1, 'ไม่มี', 'หงส์ทอง.jpg '),
('PR0002', 'น้ําเปล่า', '28', 2, '7.00', '20.00', 1, '', 'น้ำเปล่า.jpg '),
('PR0003', 'เหล้าBLEND2852', '22', 7, '290.00', '350.00', 1, '', 'product_5fa2d7b788ddb.jpg  '),
('PR0004', 'เหล้าREGENCY', '15', 8, '380.00', '450.00', 1, '', 'product_5fa2d85d9b7aa.JPG '),
('PR0005', 'เบียร์Chang', '150', 2, '50.00', '70.00', 1, '', 'product_5fa2da9d16264.png'),
('PR0006', 'โซดา', '58', 2, '6.00', '20.00', 1, '', 'product_5fa2dadb25029.jpg'),
('PR0007', 'เบียร์LEO', '84', 2, '45.00', '65.00', 1, '', 'product_5fa2db366cc91.jpg'),
('PR0008', 'เบียร์MY', '40', 2, '40.00', '60.00', 1, '', 'product_5fa2dbcaebffc.jpg'),
('PR0009', 'เบียร์Heineken', '36', 2, '70.00', '120.00', 1, '', 'product_5fa2dc287def5.jpg'),
('PR0010', 'น้ำอัดลม เอส', '260', 2, '9.00', '40.00', 1, '', 'product_5fa2dc995cdb7.jpg'),
('PR0011', 'น้ำแข็ง', '80', 10, '5.00', '20.00', 1, '', 'product_5fa2dde25580e.jpg '),
('PR0012', 'เฟรนฟรายส์', '32', 5, '25.00', '60.00', 2, '', 'product_5fa2decfb6f22.jpg'),
('PR0013', 'ปูอัดซาซิมิ', '21', 5, '35.00', '80.00', 2, '', 'product_5fa2df1203b65.jpg'),
('PR0014', 'เอ็นไก่ทอด', '30', 5, '45.00', '100.00', 2, '', 'product_5fa2df4c6df5b.jpg'),
('PR0015', 'ข้าวเกรียบกุ้ง', '25', 5, '25.00', '60.00', 2, '', 'product_5fa2df72d965b.jpg'),
('PR0016', 'ต้มยำรวมมิตร', '15', 11, '65.00', '150.00', 2, '', 'product_5fa2dfb6a6d05.jpg');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_purchase_order`
--

CREATE TABLE `aby_purchase_order` (
  `po_id` varchar(7) NOT NULL,
  `staff_id` varchar(7) NOT NULL,
  `po_createddate` datetime DEFAULT NULL,
  `po_enddate` datetime DEFAULT NULL,
  `pos_id` int(11) NOT NULL,
  `supplier_id` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_purchase_order`
--

INSERT INTO `aby_purchase_order` (`po_id`, `staff_id`, `po_createddate`, `po_enddate`, `pos_id`, `supplier_id`) VALUES
('HT0001', 'US0001', '2020-10-15 00:00:00', '2020-10-16 09:10:11', 3, 'SU0002'),
('HT0002', 'US0002', '2020-10-19 17:48:09', NULL, 1, 'SU0001'),
('HT0003', 'US0002', '2020-10-21 21:32:08', '2020-10-22 21:16:48', 1, 'SU0002'),
('HT0004', 'US0002', '2020-10-22 21:15:04', '2020-11-05 16:20:27', 2, 'SU0001');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_purchase_order_detail`
--

CREATE TABLE `aby_purchase_order_detail` (
  `pod_id` int(11) NOT NULL,
  `po_id` varchar(7) NOT NULL,
  `product_id` varchar(7) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_qty2` int(11) DEFAULT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_purchase_order_detail`
--

INSERT INTO `aby_purchase_order_detail` (`pod_id`, `po_id`, `product_id`, `product_qty`, `product_qty2`, `product_price`) VALUES
(1, 'HT0001', 'PR0001', 5, 0, 300),
(24, 'HT0002', 'PR0002', 9, 0, 7),
(25, 'HT0002', 'PR0001', 1, 0, 300),
(29, 'HT0003', 'PR0002', 10, 0, 7),
(30, 'HT0003', 'PR0001', 10, 0, 300),
(31, 'HT0004', 'PR0001', 9, 5, 300);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_purchase_order_status`
--

CREATE TABLE `aby_purchase_order_status` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_purchase_order_status`
--

INSERT INTO `aby_purchase_order_status` (`pos_id`, `pos_name`) VALUES
(1, 'รอสินค้า'),
(2, 'ได้รับสินค้าแล้ว'),
(3, 'ยกเลิก');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_role`
--

CREATE TABLE `aby_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_role`
--

INSERT INTO `aby_role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'พนักงานใช้ระบบ'),
(3, 'ผู้บริหาร'),
(4, 'พนักงานทั่วไป');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_staff`
--

CREATE TABLE `aby_staff` (
  `staff_id` varchar(7) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `prefix_id` int(11) NOT NULL,
  `staff_telephone` varchar(10) NOT NULL,
  `staff_address` varchar(300) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_staff`
--

INSERT INTO `aby_staff` (`staff_id`, `staff_name`, `prefix_id`, `staff_telephone`, `staff_address`, `username`, `password`, `role_id`, `us_id`) VALUES
('US0001', 'ภัทราพร โยธรรม ', 5, '0874596325', '99/37 หมู่18 หมู่บ้าน ขวัญใจโดม ต.คลองหนึ่ง อ.คลองหลวง จ.ปทุมธานี  12120', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1),
('US0002', 'น้้าทิพย์  ประเสรฐิช่วง', 6, '0863524136', '114 หมู่ท7 ี่ ถ.ศรีจันทร์ ต.พระลับ อ.เมอืง จ.ขอนแก่น 40000 ', 'Hotzay', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_supplier`
--

CREATE TABLE `aby_supplier` (
  `supplier_id` varchar(7) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(300) NOT NULL,
  `supplier_telephone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_supplier`
--

INSERT INTO `aby_supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_telephone`) VALUES
('SU0001', 'บริษัท วันบีลีฟ จำกัด', '31 ซอยรามอินทรา 86 แยก 2 ถนนรามอินทรา แขวงมีนบุรี เขตมีนบุรี กรุงเทพ 10510 แขวงมีนบุรี เขตมีนบุรี จังหวัดกรุงเทพมหานคร 10510 ประเทศไทย', '022762258'),
('SU0002', 'วันโอวัน โกลเบิ้ล จำกัด', 'วันโอวัน โกลเบิ้ล จำกัด', '020661580');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_unit`
--

CREATE TABLE `aby_unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_unit`
--

INSERT INTO `aby_unit` (`unit_id`, `unit_name`) VALUES
(1, 'แพค'),
(2, 'ขวด'),
(3, 'โหล'),
(4, 'กล่อง'),
(5, 'จาน'),
(7, 'กลม'),
(8, 'แบน'),
(10, 'ถัง'),
(11, 'ถ้วย');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `aby_user_status`
--

CREATE TABLE `aby_user_status` (
  `us_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `aby_user_status`
--

INSERT INTO `aby_user_status` (`us_id`, `name`) VALUES
(1, 'อนุญาต'),
(2, 'ไม่อนุญาต');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aby_category`
--
ALTER TABLE `aby_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `aby_order`
--
ALTER TABLE `aby_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_staff_id3` (`staff_id`);

--
-- Indexes for table `aby_order_detail`
--
ALTER TABLE `aby_order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `fk_product_id2` (`product_id`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- Indexes for table `aby_order_status`
--
ALTER TABLE `aby_order_status`
  ADD PRIMARY KEY (`ord_id`);

--
-- Indexes for table `aby_prefix`
--
ALTER TABLE `aby_prefix`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `aby_product`
--
ALTER TABLE `aby_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_unit_id` (`unit_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `aby_purchase_order`
--
ALTER TABLE `aby_purchase_order`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `fk_staff_id` (`staff_id`),
  ADD KEY `fk_pos_id` (`pos_id`),
  ADD KEY `fk_supplier_id125` (`supplier_id`);

--
-- Indexes for table `aby_purchase_order_detail`
--
ALTER TABLE `aby_purchase_order_detail`
  ADD PRIMARY KEY (`pod_id`),
  ADD KEY `fk_po_id` (`po_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indexes for table `aby_purchase_order_status`
--
ALTER TABLE `aby_purchase_order_status`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `aby_role`
--
ALTER TABLE `aby_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `aby_staff`
--
ALTER TABLE `aby_staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `fk_prefix_id` (`prefix_id`);

--
-- Indexes for table `aby_supplier`
--
ALTER TABLE `aby_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `aby_unit`
--
ALTER TABLE `aby_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `aby_user_status`
--
ALTER TABLE `aby_user_status`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aby_category`
--
ALTER TABLE `aby_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `aby_order_detail`
--
ALTER TABLE `aby_order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `aby_order_status`
--
ALTER TABLE `aby_order_status`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aby_prefix`
--
ALTER TABLE `aby_prefix`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `aby_purchase_order_detail`
--
ALTER TABLE `aby_purchase_order_detail`
  MODIFY `pod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `aby_purchase_order_status`
--
ALTER TABLE `aby_purchase_order_status`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aby_role`
--
ALTER TABLE `aby_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `aby_unit`
--
ALTER TABLE `aby_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `aby_user_status`
--
ALTER TABLE `aby_user_status`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aby_order`
--
ALTER TABLE `aby_order`
  ADD CONSTRAINT `fk_staff_id3` FOREIGN KEY (`staff_id`) REFERENCES `aby_staff` (`staff_id`);

--
-- Constraints for table `aby_order_detail`
--
ALTER TABLE `aby_order_detail`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `aby_order` (`order_id`),
  ADD CONSTRAINT `fk_product_id2` FOREIGN KEY (`product_id`) REFERENCES `aby_product` (`product_id`);

--
-- Constraints for table `aby_product`
--
ALTER TABLE `aby_product`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `aby_category` (`category_id`),
  ADD CONSTRAINT `fk_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `aby_unit` (`unit_id`);

--
-- Constraints for table `aby_purchase_order`
--
ALTER TABLE `aby_purchase_order`
  ADD CONSTRAINT `fk_pos_id` FOREIGN KEY (`pos_id`) REFERENCES `aby_purchase_order_status` (`pos_id`),
  ADD CONSTRAINT `fk_staff_id` FOREIGN KEY (`staff_id`) REFERENCES `aby_staff` (`staff_id`),
  ADD CONSTRAINT `fk_supplier_id125` FOREIGN KEY (`supplier_id`) REFERENCES `aby_supplier` (`supplier_id`);

--
-- Constraints for table `aby_purchase_order_detail`
--
ALTER TABLE `aby_purchase_order_detail`
  ADD CONSTRAINT `fk_po_id` FOREIGN KEY (`po_id`) REFERENCES `aby_purchase_order` (`po_id`),
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `aby_product` (`product_id`);

--
-- Constraints for table `aby_staff`
--
ALTER TABLE `aby_staff`
  ADD CONSTRAINT `fk_prefix_id` FOREIGN KEY (`prefix_id`) REFERENCES `aby_prefix` (`prefix_id`),
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `aby_role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
