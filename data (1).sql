-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 14, 2025 at 02:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `van_phong_pham`
--
CREATE DATABASE IF NOT EXISTS `van_phong_pham` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `van_phong_pham`;



-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Thiên Long', 'Thương hiệu văn phòng phẩm Việt Nam nổi tiếng.', '2025-04-14 12:34:39', '2025-04-14 12:34:39'),
(2, 'Campus', 'Chất lượng Nhật Bản, mẫu mã đẹp.', '2025-04-14 12:34:39', '2025-04-14 12:34:39'),
(3, 'Deli', 'Thương hiệu Trung Quốc phổ biến tại Việt Nam.', '2025-04-14 12:34:39', '2025-04-14 12:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO categories (category_id, name, description) VALUES
(1,'Bút Chì', 'Các loại bút chì dùng cho học tập, vẽ, kỹ thuật.'),
(2,'Bút bi', 'Bút bi các màu dùng viết hàng ngày.'),
(3,'Bút mực', 'Bút mực nước, bút luyện chữ.'),
(4,'Bút tẩy', 'Bút tẩy mực, xóa chì.'),
(5,'Bút dạ quang', 'Bút highlight nhiều màu.'),
(6,'Bút lông', 'Bút lông bảng, bút lông màu.'),
(7,'Sổ các loại', 'Sổ tay, sổ ghi chép, sổ lò xo.'),
(8,'Giấy note', 'Giấy ghi chú các kích cỡ.'),
(9, 'Vở', 'Vở học sinh, vở ô ly, vở kẻ ngang.'),
(10, 'Nhãn vở Nhãn tên', 'Nhãn dán vở, nhãn tên học sinh.'),
(11, 'Bút vẽ', 'Bút chì màu, bút kỹ thuật, bút đi nét.'),
(12,'Màu vẽ', 'Màu nước, màu bột, màu sáp, màu chì.'),
(13,'Khay - cọ vẽ', 'Khay pha màu, cọ vẽ các loại.'),
(14,'Giá khung vẽ', 'Khung vẽ, giá vẽ cho học sinh và họa sĩ.'),
(15,'Thước', 'Thước kẻ, eke, compa, bộ dụng cụ hình học.'),
(16,'Bìa kẹp', 'Bìa hồ sơ, bìa kẹp tài liệu.'),
(17,'Máy tính cầm tay', 'Máy tính khoa học, máy tính học sinh.');


-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `sticker_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_status` BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `sender_id`, `receiver_id`, `message`, `sticker_id`, `created_at`) VALUES
(1, 1, 2, 'Chào bạn', NULL, '2025-04-14 12:34:40'),
(2, 2, 1, NULL, 1, '2025-04-14 12:34:40'),
(3, 1, 2, 'Bạn cần giúp gì không?', 1, '2025-04-14 12:34:40'),
(4, 2, 1, 'Tôi cần mua một sản phẩm', 1, '2025-04-14 12:34:40'),
(5, 1, 2, 'Bạn cần mua sản phẩm gì?', 1, '2025-04-14 12:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `price_min` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` int(11) DEFAULT 0,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `price_min`, `discount`, `start_date`, `end_date`, `status`, `code`) VALUES
(1, 100000.00, 2, '2024-03-31 17:00:00', '2024-06-29 17:00:00', '1', 'SALE10'),
(2, 200000.00, 5, '2024-04-30 17:00:00', '2024-07-30 17:00:00', '1', 'SALE20'),
(3, 300000.00, 7, '2024-05-31 17:00:00', '2024-07-30 17:00:00', '1', 'SALE30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL CHECK (`total_price` >= 0),
  `payment_id` int(11) DEFAULT NULL,
  `payment_method` enum('cod','momo','money') NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `transport_id` varchar(50) NOT NULL,
  `trangThaiGiao` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`,`payment_id`, `payment_method`, `coupon_id`, `is_paid`,`transport_id`, `trangThaiGiao`, `created_at`, `updated_at`) VALUES
(1, 3, 667496, NULL, 'momo', 3, 1, 'express', '1', '2025-03-20 17:00:00', '2025-04-11 17:00:00'),
(2, 9, 366895, NULL, 'money', 3, 0, 'standard', '2', '2025-04-01 10:00:00', '2025-04-11 17:00:00'),
(3, 10, 368000, NULL, 'cod', 3, 0, 'express', '0', '2025-04-05 09:30:00', '2025-04-11 17:00:00'),
(4, 2, 213100, NULL, 'COD', 1, 1,'eco', '1', '2025-04-25 09:00:00', '2025-04-25 09:00:00'),
(5, 9, 393600, NULL, 'momo', 3, 1, 'eco', '0','2025-04-25 10:30:00', '2025-04-25 10:30:00'),
(6, 3, 226200, NULL, 'COD', 1, 1, 'standard', '2','2025-04-26 08:15:00', '2025-04-26 08:15:00'),
(7, 3, 44000, NULL, 'COD', null, 1, 'eco', '3','2025-04-26 14:00:00', '2025-04-26 14:00:00'),
(8, 3, 246350, NULL, 'momo', 2, 1, 'eco', '3','2025-04-27 11:45:00', '2025-04-27 11:45:00'),

(9, 2, 124600, NULL, 'money', null, 1, 'standard', '1', '2025-04-01 09:30:00', '2025-04-01 09:30:00'),
(10, 2, 87700, NULL, 'momo', NULL, 1, 'eco', '2', '2025-04-02 13:45:00', '2025-04-02 13:45:00'),
(11, 2, 59200, NULL, 'money', null, 0, 'express', '0', '2025-04-03 11:00:00', '2025-04-03 11:00:00'),
(12, 2, 108000, NULL, 'momo', null, 1, 'standard', '1', '2025-04-04 14:20:00', '2025-04-04 14:20:00'),
(13, 3, 51600, NULL, 'money', NULL, 0, 'eco', '2', '2025-04-05 15:00:00', '2025-04-05 15:00:00'),
(14, 9, 88900, NULL, 'momo', null, 1, 'express', '0', '2025-04-06 08:40:00', '2025-04-06 08:40:00'),
(15, 9, 97000, NULL, 'cod', NULL, 1, 'standard', '1', '2025-04-07 10:50:00', '2025-04-07 10:50:00'),
(16, 9, 94600, NULL, 'momo', null, 1, 'express', '2', '2025-04-08 12:00:00', '2025-04-08 12:00:00'),
(17, 10, 91500, NULL, 'money', NULL, 0, 'eco', '0', '2025-04-09 09:10:00', '2025-04-09 09:10:00'),
(18, 3, 77000, NULL, 'cod', null, 1, 'eco', '3', '2025-04-10 16:00:00', '2025-04-10 16:00:00'),
(19, 3, 92000, NULL, 'momo', null, 1, 'standard', '1', '2025-04-11 18:30:00', '2025-04-11 18:30:00'),
(20, 3, 77000, NULL, 'money', NULL, 1, 'eco', '2', '2025-04-12 10:10:00', '2025-04-12 10:10:00'),
(21, 2, 92000, NULL, 'momo', null, 1, 'standard', '0', '2025-04-13 11:20:00', '2025-04-13 11:20:00'),
(22, 2, 77000, NULL, 'cod', NULL, 1, 'eco', '3', '2025-04-14 14:40:00', '2025-04-14 14:40:00'),
(23, 2, 84000, NULL, 'momo', null, 1, 'express', '1', '2025-04-15 15:30:00', '2025-04-15 15:30:00');
-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `tenDonHang` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(500) NOT NULL,
  `ghiChu` text DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_type_id`, `tenDonHang`, `phone`, `address`, `ghiChu`, `cost`, `quantity`, `price`) VALUES
-- Đơn hàng 1
(1, 1, 97, 'Bút mực Thiên Long xịn', '0967890123', 'Hà Nội, Quận 1, Phố X', NULL, 9500.00, 5, 47500.00),
(2, 1, 100, 'Bút mực Thiên Long xịn nhất combo 2 chục cái', '0123456789', 'Hà Nội, Quận 1, Phố X', NULL, 142500.00, 1, 142500.00),
(3, 1, 117, 'Bút xóa keo FlexOffice', '0123456789', 'Hà Nội, Quận 1, Phố X', NULL, 12825.00, 2, 25650.00),
(4, 1, 165, 'Combo 20 bút dạ quang', '0123456789', 'Hà Nội, Quận 1, Phố X', NULL, 156610.00, 3, 469830.00),

(5, 2, 103, 'Bút mực Thiên Long xịn', '0987654321', 'TP HCM, Quận 5, Phố Y', NULL, 152000.00, 2, 304000.00),
(6, 2, 118, 'Bút xóa nước CP-012', '0987654321', 'TP HCM, Quận 5, Phố Y', NULL, 14250.00, 2, 28500.00),
(7, 2, 168, 'Bút kim kỹ thuật Drawing Pen', '0987654321', 'TP HCM, Quận 5, Phố Y', NULL, 9500.00, 2, 19000.00),

(8, 3, 104, 'Bút mực Thiên Long xịn', '0777777777', 'Đà Nẵng, Quận Hải Châu, Phố Z', NULL, 114000.00, 2, 228000.00),
(9, 3, 119, 'Bút xóa nước CP-015', '0777777777', 'Đà Nẵng, Quận Hải Châu, Phố Z', NULL, 16625.00, 3, 49875.00),
(10, 3, 169, 'Bút lông 3 màu', '0777777777', 'Đà Nẵng, Quận Hải Châu, Phố Z', NULL, 9500.00, 3, 28500.00),
(11, 3, 170, 'Bút lông kim Beebee', '0777777777', 'Đà Nẵng, Quận Hải Châu, Phố Z', NULL, 9500.00, 4, 38000.00),
(12, 3, 176, 'Combo 10 chiếc bút', '0777777777', 'Đà Nẵng, Quận Hải Châu, Phố Z', NULL, 9500.00, 2, 19000.00),

(13, 4, 202, 'Bút Vẽ Artdoor 1', '0912345678', '123 Lê Lợi, Quận 1, TP.HCM', 'Giao giờ hành chính', 9500, 10, 95000),
(14, 4, 203, 'Bút Vẽ Artdoor 2', '0912345678', '123 Lê Lợi, Quận 1, TP.HCM', 'Giao giờ hành chính', 9500, 10, 95000),

(15, 5, 215, 'Giá Campuchia', '0987654321', '456 Trần Hưng Đạo, Quận 5, TP.HCM', 'Liên hệ trước khi giao', 190000, 1, 190000),
(16, 5, 216, 'Giá để bàn', '0987654321', '456 Trần Hưng Đạo, Quận 5, TP.HCM', 'Liên hệ trước khi giao', 190000, 1, 190000),

(17, 6, 220, 'Giá trắng', '0967890123', '789 Nguyễn Trãi, Quận 10, TP.HCM', 'Giao sau 17h', 190000, 1, 190000),

(18, 7, 210, 'Bút Chì HB Kèm Đầu Tẩy', '0967890123', '321 Cách Mạng Tháng 8, Quận 3, TP.HCM', 'Giao ngay', 9500, 2, 19000),

(19, 8, 211, 'Bút Chì Màu', '0967890123', '654 Điện Biên Phủ, Quận Bình Thạnh, TP.HCM', 'Giao giờ hành chính', 9500, 10, 95000),
(20, 8, 345, 'Bút vẽ 100 màu', '0967890123', '654 Điện Biên Phủ, Quận Bình Thạnh, TP.HCM', 'Giao giờ hành chính', 133000, 1, 133000),

(43, 9, 480, 'Thước bộ Điểm 10 1', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 14250, 2, 28500),
(21, 9, 481, 'Thước bộ Điểm 10 2', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 14250, 2, 28500),
(22, 9, 482, 'Thước bộ Điểm 10 3', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 14250, 2, 28500),

(23, 10, 483, 'Thước bộ Điểm 10 4', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 14250, 2, 28500),
(24, 10, 484, 'Thước dẻo PVC Điểm 10 1', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 17100, 2, 34200),
(25, 11, 485, 'Thước dẻo PVC Điểm 10 2', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 17100, 2, 34200),
(26, 12, 486, 'Thước dẻo PVC Điểm 10 3', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 17100, 2, 34200),
(27, 12, 487, 'Thước dẻo PVC Điểm 10 4', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 17100, 2, 34200),

(28, 13, 488, 'Thước thẳng Điểm 10 Disney Mickey 1', '0967890123', '123 Đường ABC, Quận 1', 'Không có ghi chú', 13300, 2, 26600),

(29, 14, 489, 'Thước thẳng Điểm 10 Disney Mickey 2', '0987654321', '123 Đường ABC, Quận 1', 'Không có ghi chú', 13300, 2, 26600),
(30, 14, 490, 'Thước thẳng Điểm 10 Disney Princess SR-029PR', '0987654321', '123 Đường ABC, Quận 1', 'Không có ghi chú', 16150, 2, 32300),

(31, 15, 491, 'Thước thẳng Điểm 10 Doraemon 1', '0987654321', '123 Đường ABC, Quận 1', 'Không có ghi chú', 14250, 2, 28500),
(32, 15, 492, 'Thước thẳng Điểm 10 Doraemon 1', '0987654321', '123 Đường ABC, Quận 1', 'Không có ghi chú', 14250, 2, 28500),

(33, 16, 493, 'Thước thẳng Flexoffice FO-SR01', '0987654321', '123 Đường ABC, Quận 1', 'Không có ghi chú', 16150, 2, 32300),
(34, 16, 494, 'Thước thẳng Flexoffice FO-SR02', '0987654321', '123 Đường ABC, Quận 1', 'Không có ghi chú', 16150, 2, 32300),

(35, 17, 495, 'Thước thẳng Thiên Long 30 cm SR-031', '0777777777', '123 Đường ABC, Quận 1', 'Không có ghi chú', 17100, 2, 34200),
(36, 17, 496, 'Thước thẳng Thiên Long SR-026', '0777777777', '123 Đường ABC, Quận 1', 'Không có ghi chú', 14250, 2, 32300),

(37, 18, 414, 'Sổ tay mini vịt bơi', '0967890123', '123 Đường ABC, Quận 1', 'Không có ghi chú', 26000, 2, 52000),
(38, 19, 415, 'Sổ tay mini phi hành gia', '0967890123', '123 Đường ABC, Quận 1', 'Không có ghi chú', 26000, 2, 52000),
(39, 20, 416, 'Sổ tay mini hành tinh', '0967890123', '123 Đường ABC, Quận 1', 'Không có ghi chú', 26000, 2, 52000),
(40, 21, 417, 'Sổ tay mini khủng long', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 26000, 2, 52000),
(41, 22, 418, 'Sổ tay mini pony', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 26000, 2, 52000),
(42, 23, 419, 'Sổ tay mini cute gấu dâu', '0912345678', '123 Đường ABC, Quận 1', 'Không có ghi chú', 27000, 2, 54000);

-- --------------------------------------------------------


--
-- Cấu trúc bảng cho bảng `payment_information`
--

CREATE TABLE `payment_information` (
  `payment_id` int(11) NOT NULL,
  `information` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Đang đổ dữ liệu cho bảng `payment_information`
--

INSERT INTO `payment_information` (`payment_id`, `information`, `created_date`) VALUES
(25, '{\"partnerCode\":\"MOMOBKUN20180529\",\"orderId\":\"1744985318\",\"requestId\":\"1744985318\",\"amount\":\"897925\",\"orderInfo\":\"Thanh to\\u00e1n qua MoMo QR code\",\"orderType\":\"momo_wallet\",\"transId\":\"3299348882\",\"resultCode\":\"0\",\"message\":\"Th\\u00e0nh c\\u00f4ng.\",\"payType\":\"aio_qr\",\"responseTime\":\"1744985327825\",\"extraData\":\"\",\"signature\":\"12f4b1cbe899a8c1239935064069ab755bc37190a3bd753b49e4ac6f30fbea80\"}', '2025-04-18 14:09:11');


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Dumping data for table `products`
--

INSERT INTO products (product_id, name, description, category_id, brand_id, status) VALUES
(1001, 'Bút chì bấm Neon Thiên Long Colokit', 'Thương hiệu: Colokit.
Quy cách: 1 cây / kiện.
Kích thước bút:	152 mm.
Kích thước min chì:	90 mm.
Độ cứng min chì	2B:.
Tiện dụng:	Dùng cho loại min chì 2.0 mm và độ cứng 3H, 2H, H, HB, B, 2B, 3B, 4B, 5B, 6B.
Chất liệu:	Vỏ bút bằng nhựa ABS.
Tiêu chuẩn:	TCCS 19:2008/TL-BCB.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.', 1, 1, '1'),
(1002, 'Bút chì gỗ 2B Điểm 10', 'Thông số kĩ thuật :.
Tên danh mục:	Bút chì.
Thương hiệu:	Điểm 10.
Đầu gôm	có:.
Kiểu dáng:	Thân gỗ, màu ngẫu nhiên..
Độ cứng ruột chì:	2B.
Chiều dài bút:	165 ±1.
Đóng gói:	10 cây / hộp, 96 hộp (960 cây)/Thùng.
Trọng lượng:	8 gram.

Bút chì gỗ 2B Điểm 10 TP-GP06 được sử dụng phổ biến tại các văn phòng, công sở và hữu ích cho học sinh, sinh viên. Bút chì nhỏ gọn, có tính ứng dụng cao và màu viết đẹp nên được tin dùng trong thời gian vừa qua.

- Ruột bút 2B với ưu điểm cho nét đậm, ngòi mềm, là loại ruột chì khá phổ biến. Ruột bút 2B có màu chì đậm, lõi chắc chắn, mêm mịn, ít bột chì, đảm bảo cho bạn những trang viết rõ nét, đều màu và mịn đẹp. Nhờ đó mà những nét tô vẽ của bạn thêm tinh tế và có độ thẩm mỹ cao..

- Khi sử dụng, ngòi không bị gãy vụn, ít hao, dễ xóa sạch bằng gôm, đặc biệt hạn chế làm bẩn tay và quần áo..

- Bút chì gỗ 2B Điểm 10 TP-GP06 được thiết kế nhỏ gọn thân thẳng giúp bạn dễ dàng cầm nắm và điều chỉnh nét vẽ, đồng thời, bút còn dễ cất giữ trong bóp, giỏ xách khi đi học, tiện dùng khi cần..
', 1, 1, '1'),
(1003, 'Bút chì gỗ HB Flexoffice FO', 'Thông số kĩ thuật :.
Tên danh mục:	Bút chì.
Thương hiệu:	Flexoffice.
Đầu gôm:	Có.
Kiểu dáng:	Dạng thằng lục giác.
Độ cứng ruột chì:	HB.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	12 cây/hộp.
Trọng lượng:	8 gram.
Bút chì gỗ HB Flexoffice FO-GP03 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập..

Đặc điểm:.

- Bút chì thân gỗ có sẵn gôm, thân dạng hình lục giác, dễ cầm nắm khi viết. Thân có thiết kế đơn giản, sơn hai màu đỏ và đen..
- Ruột chì loại HB, cứng và đen. Nét đậm vừa phải, ít gãy, dễ gôm tẩy..
- Thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập..

Lưu trữ & bảo quản:.

- Hạn chế rơi nhiều lần, va đập mạnh khi vận chuyển và sử dụng..
- Lưu trữ và trưng bày nơi thoáng mát..
- Tránh xa nguồn nhiệt và những nơi có ánh nắng trực tiếp chiếu vào.', 1, 1, '1'),
(1004, 'Bút chì gỗ Thiên Long GP-03 màu ngẫu nhiên', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Đầu gôm:	Không.
Kiểu dáng:	Dạng thằng lục giác, màu ngẫu nhiên..
Độ cứng ruột chì:	2B.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	10 cây/hộp.
Trọng lượng:	7 gram.
Bút chì gỗ Thiên Long GP-03 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập..
Đặc điểm:.

- Nét đậm, để lại nhiều than chì trên giấy.
- Lướt rất nhẹ nhàng trên bề mặt viết.
- Dùng để đánh bóng các bức vẽ, đạt đến nhiều mức độ sáng tối khác nhau. Ngoài ra khá hữu dụng trong việc tô đậm vào ô trả lời trắc nghiệm nhanh nhất..
- Thân lục giác, 2B..

Lưu trữ & bảo quản:.

- Hạn chế rơi nhiều lần, va đập mạnh khi vận chuyển và sử dụng..
- Lưu trữ và trưng bày nơi thoáng mát..
- Tránh xa nguồn nhiệt và những nơi có ánh nắng trực tiếp chiếu vào.', 1, 1, '1'),
(1005, 'Bút chì bấm Điểm 10', 'Thông số kĩ thuật :.

Tên danh mục:	Bút .
Thương hiệu:	Điểm 10.
Kiểu dáng:	Dạng thằng tròn, màu ngẫu nhiên. .
Độ cứng ruột chì:	HB 0.5 mm.
Đóng gói:	30 cây/hộp.
Trọng lượng:	9 gram.

Bút chì bấm Điểm 10 TP-PC01 là loại bút chì bấm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế..
- Cơ chế bấm rất nhạy, rất nhẹ tay.
- Sử dụng min chì thông dụng trên thị trường, thay ruột chì dễ dàng.

Lợi ích:.

- Các bạn tuổi teen có thêm một bộ sưu tập dụng cụ học tập thú cưng đầy cá tính, năng động, tràn sức sống..
- Cách phối màu trên thân bút độc đáo, ấn tượng đem đến cho các bạn teen niềm vui thích học tập..

Bảo quản:.

- Lưu trữ nơi khô ráo, thoáng mát, tránh xa nguồn nhiệt..
- Thùng carton phải vận chuyển theo đúng hướng dẫn trên thùng, tránh va đập mạnh..', 1, 1, '1'),
(1006, 'Bút chì bấm Thiên Long', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Đầu gôm:	Có.
Kiểu dáng:	Dạng thằng tròn, màu ngẫu nhiên..
Đóng gói:	10 cây / hộp.
Trọng lượng:	100 gram.

Thuộc loại bút chì bấm mang thương hiệu Thiên Long. Bút chì bấm Thiên Long PC-024 cóchất lượng bền bỉ, đáng tin cậy. Thiết kế hiện đại, các chi tiết sắc xảo và tinh tế..

Đặc điểm :.

- Bút có trang bị gôm ở đuôi bút, tiện lợi và dễ dàng sử dụng..
- Min chì cứng, khó gãy, nét viết thanh mảnh, sắc nét..
- Ngòi bút HB 0.5mm.
- Giắt bút chắc chắn thuận tiện cho việc gài lên túi áo .

Bảo quản:.

- Tránh va đập mạnh làm gãy chì..
- Tránh xa nguồn nhiệt.', 1, 1, '1'),
(1007, 'Bút chì bấm Thiên Long PC', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Kiểu dáng:	Dạng thằng lục giác.
Độ cứng ruột chì:	HB.
Đóng gói:	10 cây / hộp.

Bút chì bấm có thân bằng nhựa. Sử dụng min chì thông dụng trên thị trường.Thay ruột chì dễ dàng, nhanh chóng và tiện lợi.Sử dụng cơ chế bấm rất nhạy, bấm nhẹ tay. Bút chì bấm HB Thiên Long PC-023 được sử dụng phổ biến tại các văn phòng, công sở và hữu ích cho học sinh, sinh viên..

Đặc điểm :.

- Bút chì nhỏ gọn, có tính ứng dụng cao và màu viết đẹp nên được tin dùng trong thời gian vừa qua. Ruột bút HB với ưu điểm cho nét đậm, ngòi mềm, là loại ruột chì khá phổ biến..

- Ruột bút HB có màu chì đậm, ngòi mềm hạn chế gãy khi chuốt và đảm bảo cho bạn những trang viết rõ nét, đều màu và mịn đẹp. Nhờ đó mà những nét tô vẽ của bạn thêm tinh tế và có độ thẩm mỹ cao. Khi sử dụng, ngòi không bị gãy vụn, ít hao, dễ xóa sạch bằng gôm, đặc biệt hạn chế làm bẩn tay và quần áo..

Hiện nay, bút chì HB Thiên Long đang dần trở nên gần gũi đối với các bạn học sinh, nhất là dùng trong môn học vẽ, hình học, thi trắc nghiệm,... Nó là dụng cụ không thể thiếu với các nhà thiết kế, nhân viên văn phòng chuyên về các hoạt động sáng tạo và cho nhiều mục đích cá nhân khác..

Bảo quản:.

Lưu trữ nơi khô ráo, thoáng mát, tránh xa nguồn nhiệt..', 1, 1, '1'),
(1008, 'Bút chì bấm Thiên Long PC 018', 'Thông số kĩ thuật :.Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Kiểu dáng:	Dạng thằng tròn, màu ngẫu nhiên..
Độ cứng ruột chì:	HB.
Đóng gói:	20 cây/hộp.
Trọng lượng:	9 gram.
Harajuku - xuất phát từ Nhật Bản - đã trở thành tên của cả một xu hướng thời trang khi giới trẻ nơi đây tìm ra cho mình một phong cách “không giống ai”: phá cách, nổi loạn, đầy sắc màu và rất ấn tượng.
Dựa trên phong cách Harajuku đến từ Nhật Bản, được Việt hóa cho phù hợp với các bạn học sinh Việt Nam, bút chì bấm PC-018 được phối màu sinh động, cá tính, ấn tượng theo một quy luật không trật tự. Kiểu dáng giống bút chì bấm thông thường nhưng thân bút được thiết kế theo phong cách thời trang Harajuku của Nhật Bản, phù hợp cho tuổi teen..

Đặc điểm:.

- PC-018 Harajuku là loại bút chì bấm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế..
- Cơ chế bấm rất nhạy, rất nhẹ tay ..
- Sử dụng min chì thông dụng trên thị trường, thay ruột chì dễ dàng.

Lợi ích:
.
- Các bạn tuổi teen có thêm một dụng cụ học tập theo thời trang Harajuku đầy cá tính, năng động, tràn sức sống..
- Cách phối màu trên thân bút độc đáo, ấn tượng đem đến cho các bạn teen niềm vui thích học tập..

Bảo quản:.

- Lưu trữ nơi khô ráo, thoáng mát, tránh xa nguồn nhiệt..
- Thùng carton phải vận chuyển theo đúng hướng dẫn trên thùng, tránh va đập mạnh..', 1, 1, '1'),
(1009, 'Bút chì bấm Thiên Long PC 022', '
Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Kiểu dáng:	Dạng thằng lục giác.
Độ cứng ruột chì:	2B.
Đóng gói:	10 cây/hộp.
Trọng lượng:	9 gram.
Bút chì bấm có thân bằng nhựa. Sử dụng min chì thông dụng trên thị trường. Thay ruột chì dễ dàng, nhanh chóng và tiện lợi. Sử dụng cơ chế bấm rất nhạy, bấm nhẹ tay. Bút chì bấm 2B Thiên Long PC-022 được sử dụng phổ biến tại các văn phòng, công sở và hữu ích cho học sinh, sinh viên..
Đặc điểm :.

- Bút chì nhỏ gọn, có tính ứng dụng cao và màu viết đẹp nên được tin dùng trong thời gian vừa qua. Ruột bút 2B với ưu điểm cho nét đậm, ngòi mềm, là loại ruột chì khá phổ biến..
- Ruột bút 2B có màu chì đậm, ngòi mềm hạn chế gãy khi chuốt và đảm bảo cho bạn những trang viết rõ nét, đều màu và mịn đẹp. Nhờ đó mà những nét tô vẽ của bạn thêm tinh tế và có độ thẩm mỹ cao. Khi sử dụng, ngòi không bị gãy vụn, ít hao, dễ xóa sạch bằng gôm, đặc biệt hạn chế làm bẩn tay và quần áo..
- Bút chì bấm 2B Thiên Long PC-022 được thiết kế nhỏ gọn thân lục giác giúp bạn dễ dàng cầm nắm và điều chỉnh nét vẽ, đồng thời, bút còn dễ cất giữ trong bóp, giỏ xách khi đi học, tiện dùng khi cần. Bút có gắn sẵn gôm ở chuôi chì tiện lợi khi sử dụng..
- Có tính ứng dụng cao.

Hiện nay, bút chì 2B Thiên Long đang dần trở nên gần gũi đối với các bạn học sinh, nhất là dùng trong môn học vẽ, hình học, thi trắc nghiệm,... Nó là dụng cụ không thể thiếu với các nhà thiết kế, nhân viên văn phòng chuyên về các hoạt động sáng tạo và cho nhiều mục đích cá nhân khác..

Bảo quản:.

Lưu trữ nơi khô ráo, thoáng mát, tránh xa nguồn nhiệt.', 1, 1, '1'),
(1010, 'Bút chì gỗ 2B Flexoffice', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Flexoffice.
Đầu gôm:	Có.
Kiểu dáng:	Dạng thằng lục giác.
Độ cứng ruột chì:	2B.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	12 cây / hộp.
Trọng lượng:	8 gram.
Bút chì gỗ 2B Flexoffice FO-GP06/VN thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập..

Đặc điểm:.

- Bút chì thân gỗ có sẵn gôm, thân dạng hình lục giác, dễ cầm nắm khi viết. Thân có thiết kế đơn giản, sơn màu xanh..
- Ruột chì loại 2B, cứng và đen. Chì ra đều mịn, cho cảm giác viết và vẽ êm ái..
- Thích hợp cho các hoạt động như viết , vẽ phác thảo và vẽ fine -art.

Lưu trữ & bảo quản:.

- Hạn chế rơi nhiều lần và va đập mạnh khi vận chuyển và sử dụng..
- Lưu trữ và trưng bày nơi thoáng mát..
- Tránh xa nguồn nhiệt và những nơi có ánh nắng trực tiếp chiếu vào.', 1, 1, '1'),
(1011, 'Bút chì gỗ cao cấp Bizner BIZ', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Bizner.
Mã sản phẩm:	BIZ-P03.
Đầu gôm:	Không.
Kiểu dáng:	Dạng thẳng lục giác.
Độ cứng ruột chì:	H.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	10 cây/hộp.
Trọng lượng:	 7 gram.
Hiện nay, Bút chì gỗ cao cấp Thiên Long - Bizner BIZ-P03 đang dần trở nên gần gũi đối với các bạn học sinh, nhất là dùng trong môn học vẽ, hình học, phác thảo, tốc ký,  thi trắc nghiệm... Nó là dụng cụ không thể thiếu với các nhà thiết kế, nhân viên văn phòng chuyên về các hoạt động sáng tạo và cho nhiều mục đích cá nhân khác..

Đặc điểm:.

- Bút chì thuộc dòng bút cao cấp Bizner.

- Thiết kế đơn giản nhưng tinh tế và sang trọng..

- Độ cứng ruột chì: H - cho nét vẽ sắc nét, viết trơn êm, nét viết ra đều..

- Thân bút hình lục giác, dễ cầm, không trơn, không mỏi tay khi cầm viết .

- Thích hợp cho phác thảo và tốc ký.

Bảo quản:.

- Hạn chế rơi nhiều lần, va đập mạnh khi vận chuyển và sử dụng..
- Lưu trữ và trưng bày nơi thoáng mát.', 1, 1, '1'),
(1012, 'Bút chì gỗ HB Điểm 10', '
Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Điểm 10.
Đầu gôm	có:.
Kiểu dáng:	Thân gỗ, màu ngẫu nhiên..
Độ cứng ruột chì:	HB.
Chiều dài bút:	165 ±1.
Đóng gói:	10 cây / hộp, 96 hộp (960 cây)/Thùng.
Trọng lượng:	8 gram.
Bút chì gỗ HB Điểm 10 TP-GP05 được sử dụng phổ biến tại các văn phòng, công sở và hữu ích cho học sinh, sinh viên. Bút chì nhỏ gọn, có tính ứng dụng cao và màu viết đẹp nên được tin dùng trong thời gian vừa qua.

- Ruột bút HB với ưu điểm cho nét đậm, ngòi mềm, là loại ruột chì khá phổ biến. Ruột bút HB có màu chì đậm, ngòi mềm hạn chế gãy khi chuốt và đảm bảo cho bạn những trang viết rõ nét, đều màu và mịn đẹp. Nhờ đó mà những nét tô vẽ của bạn thêm tinh tế và có độ thẩm mỹ cao..

- Khi sử dụng, ngòi không bị gãy vụn, ít hao, dễ xóa sạch bằng gôm, đặc biệt hạn chế làm bẩn tay và quần áo..

- Bút chì gỗ HB Điểm 10 TP-GP05 được thiết kế nhỏ gọn thân thẳng giúp bạn dễ dàng cầm nắm và điều chỉnh nét vẽ, đồng thời, bút còn dễ cất giữ trong bóp, giỏ xách khi đi học, tiện dùng khi cần.', 1, 1, '1'),
(1013, 'Bút chì gỗ Neon Thiên Long', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Colokit.
Kiểu dáng:	Dạng thẳng lục giác.
Độ cứng ruột chì:	2B.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	5 cây/vĩ.
Trọng lượng:	8 gram.

Bút chì gỗ 2B Colokit GP-C01 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập..

Đặc điểm:.

- Nét đậm, để lại nhiều than chì trên giấy.
- Lướt rất nhẹ nhàng trên bề mặt viết.
- Dùng để đánh bóng các bức vẽ, đạt đến nhiều mức độ sáng tối khác nhau. Ngoài ra khá hữu dụng trong việc tô đậm vào ô trả lời trắc nghiệm nhanh nhất..
- Thân lục giác có nhiều màu sắc thân, 2B.', 1, 1, '1'),
(1014, 'Bút chì khúc Thiên Long', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Kiểu dáng:	Dạng thằng tròn, màu ngẫu nhiên..
Độ cứng ruột chì:	HB.
Đóng gói:	20 cây/lon.
Trọng lượng:	12 gram.

Bút chì khúc HB Thiên Long PC-09 được sử dụng phổ biến tại các văn phòng, công sở và hữu ích cho học sinh, sinh viên..
Bút chì nhỏ gọn, có tính ứng dụng cao và màu viết đẹp nên được tin dùng trong thời gian vừa qua. Ruột bút HB với ưu điểm cho nét đậm, ngòi mềm, là loại ruột chì khá phổ biến..
Ruột bút HB có màu chì đậm, ngòi mềm hạn chế gãy khi chuốt và đảm bảo cho bạn những trang viết rõ nét, đều màu và mịn đẹp. Nhờ đó mà những nét tô vẽ của bạn thêm tinh tế và có độ thẩm mỹ cao. Khi sử dụng, ngòi không bị gãy vụn, ít hao, dễ xóa sạch bằng gôm, đặc biệt hạn chế làm bẩn tay và quần áo..

Bút chì khúc HB Thiên Long PC-09 được thiết kế nhỏ gọn thân tròn giúp bạn dễ dàng cầm nắm và điều chỉnh nét vẽ. Đồng thời, bút còn dễ cất giữ trong bóp, giỏ xách khi đi học, tiện dùng khi cần. Bút có gắn sẵn gôm ở chuôi chì tiện lợi khi sử dụng..
Đặc điểm:.
- Thân tròn, ruột 11 khúc chì, có nắp đậy,.
- Trên nắp có gôm, có thể thay được ruột chì, lon nhựa PVC..
Bảo quản:.
- Tránh va đập mạnh làm gãy chì.
- Tránh xa nguồn nhiệt.', 1, 1, '1'),
(1015, 'Bút chì mỹ thuật Thiên Long 2B', 'Thông số kĩ thuật :.

Tên danh mục	Bút chì.
Thương hiệu	Thiên Long.
Đầu gôm	Không.
Kiểu dáng	Dạng thằng lục giác.
Độ cứng ruột chì	2B.
Chiều dài bút	165 ±1.
Đường kính ruột chì	2mm ±0.5.
Đóng gói	10 cây/hộp.
Trọng lượng	7 gram.
Bút chì gỗ Thiên Long GP-018 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập. Đặc biệt thích hợp cho các em học sinh tiểu học. .

Đặc điểm:.

- Bút chì thân gỗ, thân dạng hình lục giác, dễ cầm nắm khi viết. Thân thiết kế đơn giản nhưng sang trọng, sơn một màu vàng..

- Ruột chì loại 2B, mềm và đen. Nét đậm, lướt nhẹ nhàng trên bề mặt giấy..

Lưu trữ & bảo quản:.

- Hạn chế rơi nhiều lần, va đập mạnh khi vận chuyển và sử dụng..
- Lưu trữ và trưng bày nơi thoáng mát..
- Tránh xa nguồn nhiệt và những nơi có ánh nắng trực tiếp chiếu vào.', 1, 1, '1'),
(1016, 'Bút chì mỹ thuật Thiên Long 3B', 'Thông số kĩ thuật :.

Tên danh mục	Bút chì.
Thương hiệu	Thiên Long.
Kiểu dáng	Dạng thằng lục giác.
Độ cứng ruột chì	3B.
Chiều dài bút	165 ±1.
Đường kính ruột chì	2mm ±0.5.
Đóng gói	10 cây/hộp.
Trọng lượng	8 gram.
Bút chì mỹ thuật Thiên Long 3B GP-022 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập.
.
Đặc điểm:
.
- Ruột chì mềm, nét đậm, ít bột chì.
- Thân gỗ mềm dễ chuốt.
- Bền đẹp không gãy chì.
- Bút dùng để viết, vẽ phác thảo trên giấy tập học sinh, sổ tay, giấy photocopy, gỗ hoặc giấy vẽ chuyên dụng.
- Lướt rất nhẹ nhàng trên bề mặt viết.
- Dùng để đánh bóng các bức vẽ, đạt đến nhiều mức độ sáng tối khác nhau. Ngoài ra khá hữu dụng trong việc tô đậm vào ô trả lời trắc nghiệm nhanh nhất..
- Thân lục giác, 3B..
- Thân bút được thiết kế hiện đại với họa tiết xoắn quanh bút cho cây bút sinh động và thu hút.
.
Bảo quản:.

- Tránh va đập mạnh làm gãy chì..
- Tránh xa nguồn nhiệt .', 1, 1, '1'),
(1017, 'Bút chì mỹ thuật Thiên Long 4B', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Kiểu dáng:	Dạng thằng lục giác.
Độ cứng ruột chì:	4B.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	10 cây/hộp.
Trọng lượng:	8 gram.
Bút chì mỹ thuật Thiên Long 4B GP-023 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập.
.
Đặc điểm:.

- Ruột chì mềm, nét đậm, ít bột chì.
- Thân gỗ mềm dễ chuốt.
- Bền đẹp không gãy chì.
- Bút dùng để viết, vẽ phác thảo trên giấy tập học sinh, sổ tay, giấy photocopy, gỗ hoặc giấy vẽ chuyên dụng.
- Lướt rất nhẹ nhàng trên bề mặt viết.
- Dùng để đánh bóng các bức vẽ, đạt đến nhiều mức độ sáng tối khác nhau. Ngoài ra khá hữu dụng trong việc tô đậm vào ô trả lời trắc nghiệm nhanh nhất..
- Thân lục giác, 4B..
- Thân bút được thiết kế hiện đại với họa tiết xoắn quanh bút cho cây bút sinh động và thu hút
.
Bảo quản:.

- Tránh va đập mạnh làm gãy chì..
- Tránh xa nguồn nhiệt .', 1, 1, '1'),
(1018, 'Bút chì mỹ thuật Thiên Long 5B', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Kiểu dáng:	Dạng thằng lục giác.
Độ cứng ruột chì:	5B.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	10 cây/hộp.
Trọng lượng:	8 gram.

Bút chì mỹ thuật Thiên Long 5B GP-024 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập..
Đặc điểm:.

- Ruột chì mềm, nét đậm, ít bột chì.
- Thân gỗ mềm dễ chuốt.
- Bền đẹp không gãy chì.
- Bút dùng để viết, vẽ phác thảo trên giấy tập học sinh, sổ tay, giấy photocopy, gỗ hoặc giấy vẽ chuyên dụng.
- Lướt rất nhẹ nhàng trên bề mặt viết.
- Dùng để đánh bóng các bức vẽ, đạt đến nhiều mức độ sáng tối khác nhau. Ngoài ra khá hữu dụng trong việc tô đậm vào ô trả lời trắc nghiệm nhanh nhất..
- Thân lục giác, 5B..
- Thân bút được thiết kế hiện đại với họa tiết xoắn quanh bút cho cây bút sinh động và thu hút.

Bảo quản:.

- Tránh va đập mạnh làm gãy chì..
- Tránh xa nguồn nhiệt .', 1, 1, '1'),
(1019, 'Bút chì mỹ thuật Thiên Long 6B', 'Thông số kĩ thuật :.

Tên danh mục:	Bút chì.
Thương hiệu:	Thiên Long.
Kiểu dáng:	Dạng thằng lục giác.
Độ cứng ruột chì:	6B.
Chiều dài bút:	165 ±1.
Đường kính ruột chì:	2mm ±0.5.
Đóng gói:	10 cây/hộp.
Trọng lượng:	8 gram.

Bút chì mỹ thuật Thiên Long 6B GP-025 thích hợp cho các hoạt động như ghi chép, vẽ nháp, học tập..
Đặc điểm:.

- Ruột chì mềm, nét đậm, ít bột chì.
- Thân gỗ mềm dễ chuốt.
- Bền đẹp không gãy chì.
- Bút dùng để viết, vẽ phác thảo trên giấy tập học sinh, sổ tay, giấy photocopy, gỗ hoặc giấy vẽ chuyên dụng.
- Lướt rất nhẹ nhàng trên bề mặt viết.
- Dùng để đánh bóng các bức vẽ, đạt đến nhiều mức độ sáng tối khác nhau. Ngoài ra khá hữu dụng trong việc tô đậm vào ô trả lời trắc nghiệm nhanh nhất..
- Thân lục giác, 6B..
- Thân bút được thiết kế hiện đại với họa tiết xoắn quanh bút cho cây bút sinh động và thu hút.

Bảo quản:.

- Tránh va đập mạnh làm gãy chì..
- Tránh xa nguồn nhiệt .', 1, 1, '1'),
(1020, 'Bút chì nhựa Thiên Long GP', 'Thông số kĩ thuật :.

Tên danh mục	Bút chì.
Thương hiệu	Thiên Long.
Đầu gôm	Không.
Kiểu dáng	Dạng thằng lục giác.
Độ cứng ruột chì	HB.
Chiều dài bút	165 ±1.
Đường kính ruột chì	2mm ±0.5.
Đóng gói	10 cây/hộp.
Trọng lượng	8 gram.
Bút chì nhựa HB Thiên Long GP-016 được sử dụng phổ biến tại các văn phòng, công sở và hữu ích cho học sinh, sinh viên. Bút chì nhỏ gọn, có tính ứng dụng cao và màu viết đẹp nên được tin dùng trong thời gian vừa qua. Ruột bút HB với ưu điểm cho nét đậm, ngòi mềm, là loại ruột chì khá phổ biến..

- Ruột bút HB có màu chì đậm, ngòi mềm hạn chế gãy khi chuốt và đảm bảo cho bạn những trang viết rõ nét, đều màu và mịn đẹp. Nhờ đó mà những nét tô vẽ của bạn thêm tinh tế và có độ thẩm mỹ cao..

- Khi sử dụng, ngòi không bị gãy vụn, ít hao, dễ xóa sạch bằng gôm, đặc biệt hạn chế làm bẩn tay và quần áo..

- Bút chì nhựa HB Thiên Long GP-016 được thiết kế nhỏ gọn thân lục giác giúp bạn dễ dàng cầm nắm và điều chỉnh nét vẽ, đồng thời, bút còn dễ cất giữ trong bóp, giỏ xách khi đi học, tiện dùng khi cần..

- Hiện nay, bút chì HB Thiên Long đang dần trở nên gần gũi đối với các bạn học sinh, nhất là dùng trong môn học vẽ, hình học, thi trắc nghiệm,... Nó là dụng cụ không thể thiếu với các nhà thiết kế, nhân viên văn phòng chuyên về các hoạt động sáng tạo và cho nhiều mục đích cá nhân khác..
Đặc điểm:.
- Nét đậm, để lại nhiều than chì trên giấy.
- Thân lục giác, HB..

Bảo quản:
.
- Tránh va đập mạnh làm gãy chì..
- Tránh xa nguồn nhiệt.', 1, 1, '1'),
(1021, 'Bút bi Điểm 10 TP-06', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Khối lượng mực:	0.12 - 0.15 g.
Đóng gói:	20 cây/hộp, 60 hộp/thùng.
Trọng lượng:	9 gram.

Bút có thiết kế tối giản, nhưng tinh tế và ấn tượng. Toàn bộ thân bút làm từ nhựa màu trong, phối hợp hoàn hảo với màu ruột bút bên trong.
Đặc điểm:.
-  Bút bi dạng bấm cò.
- Nơi tì ngón tay có tiết diện hình tam giác vừa vặn với tay cầm giúp giảm trơn tuột khi viết thường xuyên.

Lợi ích:.
- Đầu bi nhỏ cho nét chữ thanh mảnh.
- Cơ chế bấm nằm gọn dưới giắt bút, giúp thuận tay khi sử dụng.
- Thay ruột khi hết mực.', 2, 1, '1'),
(1022, 'Bút Bi Flexoffice FO-03', 'Thông số kĩ thuật :

Thương hiệu:	Flexoffice.
Đường kính viên bi:	0.5 mm.
Khối lượng mực:	0.12 - 0.15 g.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.

Bút bi FO-03 là sản phẩm do Tập đoàn văn phòng phẩm Thiên Long sản xuất, mang nhãn hiệu FlexOffice. Bút FO-03 thiết kế trẻ trung , nhỏ gọn , dễ sử dụng . Sản phẩm được sản xuất theo công nghệ hiện đại, kiểu dáng phù hợp cho đối tượng học sinh, nhân viên văn phòng, tiểu thương, lao động phổ thông. Dạng bút bi cửa sổ bấm. Nút bấm và lò xo rất nhạy và bền, không bung, không kẹt, không tự rơi ra ngoài của sổ bấm. Tay cầm có hoa văn , giúp cầm bút không trơn , trượt khi viết. Mực không độc hại tiêu chuẩn quốc tế.

Đặc tính sản phẩm:.
- Cán bút trong suốt bằng nhựa PS, cán bút được in PAD và dán tem barcode.
- Cấu tạo 3 cạnh dễ cắm , chắc tay.
- Nút cò cùng màu mực.
- Ống ruột màu, xoắn trắng.
- Đầu bi 0.5mm, viết trơn êm, màu mực đậm tươi, mực ra đều và liên tục.

Lưu ý :
Bấm lại sau khi sử dụng.

Bảo quản: Không được làm rớt.
Bảo quản nơi khô ráo, thoáng mát.', 2, 1, '1'),
(1023, 'Bút Bi Flexoffice FO-023', 'Thông số kĩ thuật :.

Thương hiệu:	Flexoffice.
Đường kính viên bi:	0.7 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	8 gram.

BÚT BI SNAPE FO-023 là sản phẩm do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu FlexOffice. Sản phẩm được sản xuất theo công nghệ hiện đại, kiểu dáng phù hợp cho đối tượng học sinh, nhân viên văn phòng, sinh viên , giáo viên…
Những đặc điểm nổi bật của bút bi FO-023:

- Bút bi FO-023 được sản xuất theo công nghệ mới.
- Nét viết trơn, êm, mực ra đều và liên tục.
- Dạng bút bi cửa sổ bấm. Nút bấm và lò xo rất nhạy và bền, không bung, không kẹt, không tự rơi ra ngoài của sổ bấm.
- Công nghệ Smooth writing tiên tiến , viết trơn , êm , mực ra đều liên tục.
- Đầu bi 0.7mm, viết trơn êm, màu mực đậm tươi, mực ra đều và liên tục.
- Thiết kế đẹp, đơn giản , rất chắc chắn , dễ cầm và chắc tay

Lưu ý :

Bấm lại sau khi sử dụng.

Bảo quản:

Bảo quản nơi khô ráo, thoáng mát.', 2, 1, '1'),
(1024, 'Bút Bi Flexoffice FO-024', 'Thông số kĩ thuật :.

Thương hiệu:	Flexoffice.
Đường kính viên bi:	0.7 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.

BÚT BI Matixs FO-024 là sản phẩm do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu FlexOffice. Sản phẩm được sản xuất theo công nghệ hiện đại, kiểu dáng phù hợp cho đối tượng học sinh, nhân viên văn phòng, sinh viên , giáo viên…

 

Những đặc điểm nổi bật của bút bi FO-024:

- Bút bi FO-024 được sản xuất theo công nghệ mới.
- Nét viết trơn, êm, mực ra đều và liên tục.
- Công nghệ Smooth writing tiên tiến , viết trơn , êm , mực ra đều liên tục.
- Đầu bi 0.7mm, viết trơn êm, màu mực đậm tươi, mực ra đều và liên tục.
- Thiết kế đẹp, đơn giản , nhỏ gọn , rất chắc chắn , dễ cầm và chắc tay.
- Cán bút bằng nhựa trong suốt in trasfer film.
- Tảm và dắt bút cùng màu mực. Dắt bút được in PAD.
- Ống ruột màu trắng đục.

Lưu ý :

- Bấm lại sau khi sử dụng , sản phẩm có nhiều chi tiết nhỏ , không phù hợp với trẻ dưới 3 tuổi.

Bảo quản:

- Bảo quản nơi khô ráo, thoáng mát.
', 2, 1, '1'),
(1025, 'Bút Bi Flexoffice FO-026', 'Thông số kĩ thuật :.

Tên danh mục:	Bút bi.
Thương hiệu:	Flexoffice.
Đường kính viên bi:	0.7 mm.
Màu mực:	Xanh, đỏ, đen.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.
Mô tả chi tiết Bút bi FO-026.

BÚT BI Senior FO-026 là sản phẩm do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu FlexOffice.

Bút bi dạng bấm . Kiểu dáng thiết kế theo phong cách mạnh mẽ, trẻ trung, năng động và hiện đại.

Bao bì ấn tượng và sinh động, tăng thêm tính cạnh tranh khi trưng bày.

Sản phẩm được sản xuất theo công nghệ hiện đại, kiểu dáng phù hợp cho đối tượng học sinh, nhân viên văn phòng, giáo viên ….
Dắt bút và nút bấm được xi chrome hiện đại , tinh tế . Thân bút bằng nhựa màu trắng nhũ với grip nhựa cầm chắc và êm tay.

Những đặc điểm nổi bật của bút bi FO-026:.

Bút bi FO-026 được sản xuất theo công nghệ mới.

Mực không độc hại với người sử dụng , đạt tiêu chuẩn an toàn quốc tế.
Ống ruột bút màu xám.

Đầu bi 0.7mm, công nghệ smooth writing , viết trơn êm, màu mực đậm tươi, mực ra đều và liên tục.

Thiết kế đẹp, đơn giản , rất chắc chắn , dễ cầm và chắc tay.
Màu sắc: Xanh, đỏ, đen.

Lưu ý : sản phẩm có nhiều chi tiết nhỏ , không phù hợp với trẻ dưới 3 tuổi.
Bảo quản: Bảo quản nơi khô ráo, thoáng mát.', 2, 1, '1'),
(1026, 'Bút Bi Flexoffice FO-036', 'Thông số kĩ thuật :

Thương hiệu:	Flexoffice.
Đường kính viên bi:	0.7 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	8 gram.

Bút bi Flexoffice FO-036 là sản phẩm do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu FlexOffice. Sản phẩm được sản xuất theo công nghệ hiện đại, kiểu dáng phù hợp cho đối tượng học sinh, nhân viên văn phòng, sinh viên , giáo viên…

Những đặc điểm nổi bật của Bút bi Flexoffice FO-036:

- Bút bi FO-036 được sản xuất theo công nghệ mới.
- Nét viết trơn, êm, mực ra đều và liên tục.
- Công nghệ Smooth writing tiên tiến , viết trơn , êm , mực ra đều liên tục.
- Đầu bi 0.7mm, viết trơn êm, màu mực đậm tươi, mực ra đều và liên tục.
- Thiết kế đẹp, đơn giản , nhỏ gọn , rất chắc chắn , dễ cầm và chắc tay.

Lưu ý :

Bấm lại sau khi sử dụng.

Bảo quản:

Bảo quản nơi khô ráo, thoáng mát.', 2, 1, '1'),
(1027, 'Bút bi Maxxie Thiên Long Điểm 10 TP-05', 'Thông số kĩ thuật :

Thương hiệu	Thiên Long
Đường kính viên bi	0.5 mm
Khối lượng mực	0.12 - 0.15 g
Đóng gói	20 cây/hộp
Trọng lượng	9 gram/cây
Bút có thiết kế tối giản, nhưng tinh tế và ấn tượng. Toàn bộ thân bút làm từ nhựa cao cấp, phối hợp hoàn hảo với màu ruột bút bên trong.
Đặc điểm:
- Nơi tì ngón tay có tiết diện hình tam giác vừa vặn với tay cầm giúp giảm trơn tuột khi viết thường xuyên.
- Độ dài viết được: 1.600-2.000m

Lợi ích:
- Đầu bi nhỏ cho nét chữ thanh mảnh.', 2, 1, '1'),
(1028, 'Bút bi Starup Thiên Long Flexoffice FO-039', 'Bút bi Starup Thiên Long Flexoffice FO-039

Thông số kĩ thuật :

Thương hiệu:	Flexoffice.
Đường kính viên bi:	0.5 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	8 gram

BÚT BI Startup FO-039 là sản phẩm do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu FlexOffice.Lấy cảm hứng từ phong trào "Startup", bút bi FO-39 được thiết kế hết sức trẻ trung năng động, mang đậm tinh thần của tuổi trẻ đam mê, giàu năng lượng. Đơn giản , tinh tế và tiện dụng. Sản phẩm được sản xuất theo công nghệ hiện đại, kiểu dáng phù hợp cho đối tượng học sinh, nhân viên văn phòng, tiểu thương, lao động phổ thông.

- Dạng bút bi cửa sổ bấm. Nút bấm và lò xo rất nhạy và bền, không bung, không kẹt, không tự rơi ra ngoài của sổ bấm.
- Tay cầm có hoa văn , giúp cầm bút không trơn , trượt khi viết.
- Sản phẩm được sản xuất theo công nghệ hiện đại, kiểu dáng phù hợp cho đối tượng học sinh, nhân viên văn phòng, giáo viên ….

Những đặc điểm nổi bật của bút bi FO-039:


- Cán bút bằng nhựa trong suốt.
- Định mức mực: 0.2g ±0.02g.
- Đường kính viên bi: 0.5mm.
- Đầu bi 0.5mm, công nghệ smooth writing , viết trơn êm, màu mực đậm tươi, mực ra đều và liên tục.

Lưu ý :

- Sản phẩm có nhiều chi tiết nhỏ , không phù hợp với trẻ dưới 3 tuổi.

Bảo quản:

- Bảo quản nơi khô ráo, thoáng mát.', 2, 1, '1'),
(1029, 'Bút bi Thiên Long Flexoffice FO-030VN 0.7mm', 'Thông số kĩ thuật :.

Tên danh mục:	Bút bi.
Thương hiệu:	Flexoffice.
Đầu bi:	0.7 mm.
Quy cách:	1 bút/ kiện.
Khuyến cáo:	Để nơi thoáng mát, tránh nguồn nhiệt. Không thích hợp cho trẻ dưới 3 tuổi.
Đặc tính sản phẩm:.

- Nét viết trơn, êm, mực ra đều và liên tục.', 2, 1, '1'),
(1030, 'Bút Bi Thiên Long TL-08', 'Thông số kĩ thuật :.
Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.8 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	8 gram.

Cây bút nổi tiếng có tuổi đời trên 20 năm của Tập đoàn Thiên Long nhưng vẫn được khách hàng ưa chuộng và tin dùng bởi thiết kế tối giản nhưng dễ sử dụng, chất lượng ổn định và bền bỉ.
Đặc điểm:.

Đầu bi: 0.8 mm.
Bút bi dạng bấm cò.

Lợi ích:/
Đa dạng màu sắc rất tiện dụng phù hợp cho mọi người nên TL-08 là loại bút bi được khách hàng tin tưởng sử dụng suốt hơn 20 năm qua.
Thay ruột khi hết mực.', 2, 1, '1'),
(1031, 'Bút bi Thiên Long Simply TL-062', 'Bút bi Thiên Long Simply TL-062.

Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.38 mm.
Đóng gói:	20 cây/hộp.
Trọng lượng:	9 gram.

Tính năng nổi bật:

Bút có thiết kế đơn giản, toàn bộ thân bút làm từ nhựa trong pha màu nhạt, nhìn được phần ruột bút bên trong.
Đặc điểm:
Bút bi dạng nắp đậy.

Lợi ích:

Đầu bi nhỏ tạo nét viết thanh mảnh.
Sản phẩm được thiết kế trẻ trung năng động phù hợp cho học sinh, sinh viên.

Bảo quản:.

Tránh va đập mạnh làm sản phẩm.
Tránh xa nguồn nhiệt.
', 2, 1, '1'),
(1032, 'Bút Bi Thiên Long TL-023', 'Thông số kĩ thuật :

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.8 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.

Bút có thiết kế đơn giản, thân tròn.Thân bút nhựa trong, tảm có đệm mềm (grip) giúp cầm êm tay và giảm trơn trợt khi viết.

Đặc điểm:

- Đầu bi: 0.8 mm.
- Grip cùng màu mực.
- Thân bút thanh mảnh cơ chế bấm khế tiện dụng phù hợp cho mọi người.
- Thay ruột khi hết mực.', 2, 1, '1'),
(1033, 'Bút Bi Thiên Long TL-025', 'Thông số kĩ thuật :

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.8 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.

Bút có thiết kế đơn giản, thân tròn.Thân bút nhựa trong, tảm có đệm mềm (grip) giúp cầm êm tay và giảm trơn trợt khi viết.

Đặc điểm:

- Đầu bi: 0.8 mm.
- Grip cùng màu mực.
- Thân bút thanh mảnh cơ chế bấm khế tiện dụng phù hợp cho mọi người.
- Thay ruột khi hết mực.', 2, 1, '1'),
(1034, 'Bút Bi Thiên Long TL-031', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Khối lượng mực:	0.12 - 0.15 g.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.

Một sản phẩm dành cho giới văn phòng. Bút có thiết kế hiện đại, thân nhỏ và thon dài, dễ cầm nắm khi viết. Thân bút làm từ nhựa cứng, giắt bút bằng kim loại mạ crom sáng bóng, sang trọng.

Đặc điểm:.
- Đầu bi: 0.5mm.
- Bút bi dạng bấm khế.
- Giắt bút vòng bằng kim loại, nút xi kim loai sáng bóng.

Lợi ích:.
- Đầu bi nhỏ cho nét chữ thanh mảnh.
- Kiểu dáng hiện đại, sang trọng phù hợp cho sinh viên,giáo viên và nhân viên văn phòng.', 2, 1, '1'),
(1035, 'Bút Bi Thiên Long TL-034(FS)', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	7 gram.

Bút có thiết kế đơn giản, thân tròn, nhỏ và khá ngắn, rất phù hợp với tay cầm của học sinh. Phần tảm bút bằng nhựa trong. Nắp và thân bút bằng nhựa trắng đục.
Đặc điểm:.

- Đầu bi: 0.5mm.
- Bút bi dạng đậy nắp.

Lợi ích:.

- Đầu bi nhỏ tạo nét chữ thanh mảnh.
- Thiết kế thon gọn vừa tay cầm cho các em học sinh.

Bảo quản:.

- Tránh va đập mạnh làm hư sản phẩm.', 2, 1, '1'),
(1036, 'Bút Bi Thiên Long TL-079', 'Thông số kỹ thuật: .

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Khối lượng mực:	0.12 - 0.15 g.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.
Bút có thiết kế hiện đại, kết hợp hài hòa giữa phần thân dưới bằng nhựa trong nhỏ và thon dài với phần giắt bút màu nhựa trắng đục khỏe khoắn.Cảm giác cầm bút rất thoải mái, viết rất êm. Nét viết thanh mảnh và sắc nét.

Đặc tính sản phẩm:

- Đầu bút dạng Needle , kích thước 0.5mm.

- Màu mực Trendee TL-079 đậm, tươi, mực ra đều và liên tục.

- Cây bút đẹp, nhỏ nhọn khá nhẹ nhàng, thú vị, nét viết trơn êm, sắc sảo, chữ viết đẹp.

- Ở tất cả sản phẩm bút bi TL-079, tên bút "Trendee" được dập nổi trên thân.

- Sản phẩm có đầu bấm và lo xo nhạy và bền, không bung, không kẹt, vướng.

- Thân bút bằng nhựa nhìn thấy rõ ruột bút và màu mực bên trong.
Lưu ý :.

Bấm lại sau khi sử dụng.

Bảo quản:.

Bảo quản nơi khô ráo, thoáng mát.', 2, 1, '1'),
(1037, 'Bút Bi Thiên Long TL-095', 'Thông số kĩ thuật :

Thương hiệu:	Thiên Long
Đường kính viên bi:	0.5 mm
Đóng gói:	20 cây / hộp
Trọng lượng:	10 gram

Thiết kế đột phá với cơ cấu bấm sáng tạo: Ruột tự động bật lên khi cài giắt bút vào túi áo.Kiểu dáng hiện đại, phần tay cầm có đệm cao su mềm (grip) giúp cho cầm bút rất thoải mái.Viết rất trơn, êm, mực ra đều, liên tục.

ĐẶC BIỆT:.        

- Đầu bi: 0.5mm 

LỢI ÍCH :         

- Đầu bi nhỏ tạo nét viết thanh mảnh.         

- Sản phẩm được thiết kế trẻ trung năng động phù hợp cho học sinh, sinh viên.

BẢO QUẢN :         

- Tránh va đập mạnh làm sản phẩm.         

- Tránh xa nguồn nhiệt.', 2, 1, '1'),
(1038, 'Bút Bi Thiên Long TL-097', '
Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Khối lượng mực:	0.12 - 0.15 g.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.

Bút có thiết kế đơn giản, toàn bộ thân bút làm từ nhựa trong, nút bấm bằng nhựa cùng màu với ruột bút. Viết rất trơn, êm, mực ra đều, liên tục.

Đặc tính sản phẩm:.

- Đầu bi: 0.5mm.

Lợi ích:
.
- Đầu bi nhỏ tạo nét viết thanh mảnh.
- Sản phẩm được thiết kế trẻ trung năng động phù hợp cho học sinh, sinh viên.

Lưu ý :.

Bấm lại sau khi sử dụng.

Bảo quản:.

Bảo quản nơi khô ráo, thoáng mát.', 2, 1, '1'),
(1039, 'Bút Bi Thiên Long TL-093', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.6 mm.
Đóng gói:	20 cây / hộp.
Trọng lượng:	8 gram.

Bút có cấu tạo khác hoàn toàn với các dạng bút truyền thống. Mực được bơm thẳng vào thân bút để sử dụng.Bút đùn là dạng bút không ruột, mực được bơm thẳng vào vỏ bút (hay nói cách khác là ruột bút cũng chính là thân bút). Chính vì thế mà trọng lượng của bút nhẹ hơn, phù hợp những người cần viết nhiều, tốc ký, ít gây mỏi tay.

Thân bút bằng nhựa trắng đục pha màu dạng sọc thẳng.Nắp bút bằng nhựa trong. Nét chữ thanh mảnh, sắc nét, gọn gàng.', 2, 1, '1'),
(1040, 'Hộp 20 Bút Bi Thiên Long TL-027', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Khối lượng mực:	0.12 - 0.15 g.
Đóng gói:	20 cây / hộp.
Trọng lượng:	9 gram.

Đây là một trong những cây bút đang được học sinh sử dụng nhiều nhất tại Việt Nam. Bút có thiết kế tối giản, nhưng tinh tế và ấn tượng. Toàn bộ thân bút làm từ nhựa trong, phối hợp hoàn hảo với màu ruột bút bên trong.

Đặc điểm:.
- Đầu bi: 0.5mm.
- Bút bi dạng bấm cò.
- Nơi tì ngón tay có tiết diện hình tam giác vừa vặn với tay cầm giúp giảm trơn tuột khi viết thường xuyên.

Lợi ích:
- Đầu bi nhỏ cho nét chữ thanh mảnh.
- Cơ chế bấm nằm gọn dưới giắt bút, giúp thuận tay khi sử dụng.
- Thay ruột khi hết mực.', 2, 1, '1'),
(1041, 'Bút bi điểm 10 Sweetme_TP-08', 'Thông số kĩ thuật :.

Thương hiệu:	Điểm 10.
Đường kính viên bi:	0.6 mm.
Khối lượng mực:	0.12 - 0.15 g.
Đóng gói:	01 cây/ kiện.
Trọng lượng:	9 gram.

Bút bi Điểm 10 Sweetme TP-08 là một trong những cây bút đang được học sinh sử dụng nhiều nhất tại Việt Nam. Bút có thiết kế tối giản, nhưng tinh tế và ấn tượng. Toàn bộ thân bút có các họa tiết hoạt hình sinh động dễ thương.

Đặc điểm:.
-  Bút bi dạng nắp đậy.

Lợi ích:.
- Đầu bi nhỏ cho nét chữ thanh mảnh.', 2, 1, '1'),
(1042, 'Bộ bút gel Hoshi Thiên Long BST-GELHS(Bút mực)', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Màu mực:	02 Cây Mực Xanh và 01 Cây Mực Đen.
Kích thước:	16 x 9.5 x 3cm.
Tiêu chuẩn:	TCCS 020:2011/TL-GEL.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Đặc tính sản phẩm: 
.
- Bút gel Hoshi Thiên Long - Công nghệ Nhật Bản, tự động khóa ngòi khi cài nếu bút ở trạng thái thu ngòi.', 3, 1, '1'),
(1043, 'Bút gelB - Minimalist Butter Gel Thiên Long - Premium tip - Mực Xanh(Bút mực)', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.6 mm.
Tiêu chuẩn:	TCCS 009:2011/TL-BGEL.
Kích thước:	141mm (GelB-028); 149mm (GelB-029).
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.', 3, 1, '1'),
(1044, 'Bút gelB - Minimalist Butter Gel Thiên Long GBLB 023(Bút mực)', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Tiêu chuẩn:	TCCS 009:2011/TL-BGEL.
Kích thước:	133.16 x 15 mm.
Đóng gói:	01 cây/ kiện.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.', 3, 1, '1'),
(1045, 'Bút gel B -Butter Gel PRO-079 Thiên Long GELB-018(Bút mực)', 'Thông số kĩ thuật :.
Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Tiêu chuẩn:	TCCS 009:2011/TL-BGEL.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Bút có thiết kế hiện đại, kết hợp hài hòa giữa phần thân dưới bằng nhựa nhiều màu sắc và thon dài với phần giắt bút màu nhựa trắng đục khỏe khoắn. Cảm giác cầm bút rất thoải mái, viết rất êm. Nét viết thanh mảnh và sắc nét.

Đặc tính sản phẩm:.

- Cây bút đẹp, nhỏ nhọn khá nhẹ nhàng, thú vị, nét viết trơn êm, sắc sảo, chữ viết đẹp.

- Sản phẩm có đầu bấm và lo xo nhạy và bền, không bung, không kẹt, vướng.', 3, 1, '1'),
(1046, 'Bút gel B Buttersmooth Gel Thiên Long GELB-032 Mực Xanh, Màu ngẫu nhiên(Bút mực)', 'Thông số kĩ thuật:.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Tiêu chuẩn:	TCCS 009:2011/TL-BGEL.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.

Bút có thiết kế hiện đại, kết hợp hài hòa giữa phần thân dưới bằng nhựa nhiều màu sắc và thon dài với phần giắt bút được phối màu theo từng thức uống khoái khẩu. Cảm giác cầm bút rất thoải mái, viết rất êm. Nét viết thanh mảnh và sắc nét.

Đặc tính sản phẩm:.

- Cây bút đẹp, nhỏ nhọn khá nhẹ nhàng, thú vị, nét viết trơn êm, sắc sảo, chữ viết đẹp.

- Sản phẩm có đầu bấm và lò xo nhạy và bền, không bung, không kẹt, vướng.', 3, 1, '1'),
(1047, 'Bút gel B Buttersmooth Gel Thiên Long GELB-031 Mực Xanh, Màu ngẫu nhiên(Bút mực)', 'Thông số kĩ thuật.
Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Tiêu chuẩn:	TCCS 009:2011/TL-BGEL.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Bút có thiết kế hiện đại, kết hợp hài hòa giữa phần thân dưới bằng nhựa nhiều màu sắc và thon dài với phần giắt bút được phối màu theo từng thức uống khoái khẩu. Cảm giác cầm bút rất thoải mái, viết rất êm. Nét viết thanh mảnh và sắc nét.

Đặc tính sản phẩm:.

- Cây bút đẹp, nhỏ nhọn khá nhẹ nhàng, thú vị, nét viết trơn êm, sắc sảo, chữ viết đẹp.

- Sản phẩm có đầu bấm và lò xo nhạy và bền, không bung, không kẹt, vướng.', 3, 1, '1'),
(1048, 'Bút Gel Thiên Long Doraemon GEL-012DO Nature - Mực (Bút mực) ', 'Thông số kĩ thuật :

Tên danh mục:	Bút Gel .
Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Tính năng nổi bật:.

Bút có thiết kế đơn giản nhưng khoa học, thân tròn, nhỏ rất phù hợp với tay cầm của học sinh tiểu học.
Thân bút bằng nhựa trắng đục, in transfer fllm hình nhân vật Doraemon rất thu hút.
Mực màu đậm và tươi sáng, viết êm trơn, ra đều và liên tục.
Lợi ích:.
Grip giúp êm tay và chống trơn tuột khi sử dụng lâu.
Thiết kế bút hiện đại, được in bằng kỹ thuật cao cấp làm tăng thêm tính sang trọng cho sản phẩm, phù hợp cho giới văn phòng.', 3, 1, '1'),
(1049, 'Bút gel Thiên Long Happy Obby GEL-056(Bút mực)', 'Thông số kĩ thuật.

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Tiêu chuẩn:	TCCS 020:2011/TL-GEL.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.', 3, 1, '1'),
(1050, 'Combo 5,10,20 Bút gel B Buttersmooth Gel Thiên Long GELB-032 Mực Xanh, Màu ngẫu nhiên(Bút mực)', '
Thông số kĩ thuật

Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Tiêu chuẩn:	TCCS 009:2011/TL-BGEL.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.

Bút có thiết kế hiện đại, kết hợp hài hòa giữa phần thân dưới bằng nhựa nhiều màu sắc và thon dài với phần giắt bút được phối màu theo từng thức uống khoái khẩu. Cảm giác cầm bút rất thoải mái, viết rất êm. Nét viết thanh mảnh và sắc nét.

Đặc tính sản phẩm:.
- Cây bút đẹp, nhỏ nhọn khá nhẹ nhàng, thú vị, nét viết trơn êm, sắc sảo, chữ viết đẹp.

- Sản phẩm có đầu bấm và lò xo nhạy và bền, không bung, không kẹt, vướng.', 3, 1, '1'),
(1052, 'Combo 20 Bút gel B Buttersmooth Gel Thiên Long GELB-034 Mực Xanh, Màu ngẫu nhiên(Bút mực)
', '
Thông số kĩ thuật :.
Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Tiêu chuẩn:	TCCS 009:2011/TL-BGEL.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.

Bút có thiết kế hiện đại, kết hợp hài hòa giữa phần thân dưới bằng nhựa nhiều màu sắc và thon dài với phần giắt bút được phối màu theo từng món ăn khoái khẩu. Cảm giác cầm bút rất thoải mái, viết rất êm. Nét viết thanh mảnh và sắc nét.

Đặc tính sản phẩm:.

- Cây bút đẹp, nhỏ nhọn khá nhẹ nhàng, thú vị, nét viết trơn êm, sắc sảo, chữ viết đẹp.

- Sản phẩm có đầu bấm và lò xo nhạy và bền, không bung, không kẹt, vướng.', 3, 1, '1'),
(1053, 'Combo 20 Bút Gel Thiên Long Doraemon GEL-012DO Nature - Mực tím(Bút mực) ', 'Thông số kĩ thuật :.

Tên danh mục:	Bút Gel .
Thương hiệu:	Thiên Long.
Đường kính viên bi:	0.5 mm.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Tính năng nổi bật:.

Bút có thiết kế đơn giản nhưng khoa học, thân tròn, nhỏ rất phù hợp với tay cầm của học sinh tiểu học.
Thân bút bằng nhựa trắng đục, in transfer fllm hình nhân vật Doraemon rất thu hút.
Mực màu đậm và tươi sáng, viết êm trơn, ra đều và liên tục.

Lợi ích:.
Grip giúp êm tay và chống trơn tuột khi sử dụng lâu.
Thiết kế bút hiện đại, được in bằng kỹ thuật cao cấp làm tăng thêm tính sang trọng cho sản phẩm, phù hợp cho giới văn phòng.', 3, 1, '1'),

(1054, 'Bút tẩy Điểm 10 TP-CP01', '
Thông số kĩ thuật :.

Tên danh mục:	Bút tẩy.
Thương hiệu:	Thiên Long.
Dung tích mực:	5 ml.
Hình dáng thân bút:	Thân tròn, màu ngẫu nhiên.
Đóng gói:	10 cây/hộp.

Bút tẩy Điểm 10 TP-CP01 có kiểu dáng thân tròn, vừa tầm tay, thuận tiện khi sử dụng. Cán bằng nhựa đủ màu thể hiện sự trẻ trung, năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt.

Đặc điểm : 

- Kiểu dáng bút được thiết kế hết sức ấn tượng, thích hợp với người dùng trẻ tuổi là học sinh, sinh viên. 

- Thân bút tròn, bằng nhựa mềm dễ cầm và không mỏi tay khi xóa.
- Thân bút có nhiều màu sắc: Xanh lá và nâu.
- Công nghệ vượt trội giúp mực xuống đều hơn.
- Bút ít bị tắc mực, độ che phủ bề mặt tốt hơn và mau khô, giúp cho chữ viết rõ ràng, không bị lem, nhòe. 

-Dung tích mực: 5 ml.

Lưu ý :
- Đặt bút hướng lên khi không sử dụng.
- Lưu trữ nơi khô ráo, thoáng mát, tránh tiếp xúc trực tiếp với ánh nắng mặt trời.
- Lắc đều bút trước khi sử dụng.',4, 1, '1'),
(1055, 'Bút tẩy FlexOffice FO-CP01 PLUS', 'Thông số kĩ thuật :.

Tên danh mục:	Bút tẩy.
Thương hiệu:	Flexoffice.
Dung tích mực:	12 ml.
Hình dáng thân bút:	Thân dẹp.
Đóng gói:	20 cây/hộp.
Trọng lượng:	29 gram.
Bút tẩy Thiên Long - FlexOffice FO-CP01 Plus có kiểu dáng thân dẹp, vừa tầm tay, thuận tiện khi sử dụng. Cán bằng nhựa màu xanh dương thể hiện sự trẻ trung, năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt. 

Đặc điểm :
- Mực dạng dung môi lỏng.
- Công nghệ vượt trội giúp mực xuống đều hơn.
- Bút ít bị tắc mực, độ che phủ bề mặt tốt hơn và mau khô, giúp cho chữ viết rõ ràng, không bị lem, nhòe.
- An toàn với tầng Ozone.

Lưu ý :
- Đặt bút hướng lên khi không sử dụng.
- Lưu trữ nơi khô ráo, thoáng mát, tránh tiếp xúc trực tiếp với ánh nắng mặt trời.
- Lắc đều bút trước khi sử dụng.

Đặc biệt : Tăng thêm 2ml dung tích so với FO CP-01.',4, 1, '1'),
(1056, 'Bút tẩy FlexOffice FO-CP02VN', 'Thông số kĩ thuật :

Tên danh mục:	Bút tẩy.
Thương hiệu:	Flexoffice.
Dung tích mực:	12 ml.
Hình dáng thân bút:	Thân dẹp.
Đóng gói:	12 cây/hộp.
Trọng lượng:	33 gram.
Bút tẩy FlexOffice FO-CP02VN có kiểu dáng thân dẹp, vừa tầm tay, thuận tiện khi sử dụng. Cán bằng nhựa màu xanh dương thể hiện sự trẻ trung, năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt. 

Đặc điểm :.
- Mực dạng dung môi lỏng.
- Công nghệ vượt trội giúp mực xuống đều hơn.
- Bút ít bị tắc mực, độ che phủ bề mặt tốt hơn và mau khô, giúp cho chữ viết rõ ràng, không bị lem, nhòe.
- Xóa nhanh khô.
- Che phủ tốt.
- An toàn với tầng Ozone.

- Đầu bút siêu bền ngay cả khi sử dụng trên bề mặt như gỗ, đá hoa cương...

Lưu ý :
- Đặt bút hướng lên khi không sử dụng.
- Lưu trữ nơi khô ráo , thoáng mát , tránh tiếp xúc trực tiếp với ánh nắng mặt trời.
- Lắc đều bút trước khi sử dụng.
',4, 1, '1'),
(1057, 'Bút tẩy kéo  - Correction Tape Thiên Long', 'Bút tẩy kéo  - Correction Tape Thiên Long

Bút tẩy kéo Thiên Long với tone màu pastel dễ thương, có độ che phủ tốt, phù hợp với nhiều loại bút và có thể viết ngay sau khi xóa.

 
🔹TÍNH NĂNG SẢN PHẨM.

▪️ Khô siêu nhanh, viết được ngay sau khi xóa.

▪️ Thiết kế tone màu pastel bắt mắt, hiện đại.

▪️ Băng xóa mượt, có độ che phủ tốt, không bong tróc.

▪️ Kiểu dáng đa dạng, nhỏ gọn, êm tay.

▪️ CT-007 có đệm cao su êm tay, ngòi xoay 90º linh hoạt khi sử dụng.

▪️ CT-008 có nắp đậy bảo vệ ngòi bút, chế độ giảm ồn và che phủ tốt.

▪️ CT-009 có thiết kế nhỏ gọn kèm hình ảnh động vật dễ thương trên thân bút kèm theo nắp đậy bảo vệ ngòi bút.

 
🔹TIÊU CHUẨN VÀ BẢO QUẢN.

▪️ Tiêu chuẩn: Sản xuất theo TCCS 039:2011/TL-XK. Đạt chuẩn Châu Âu EN 71/3.

▪️ Độ rộng băng xóa: 5 mm.

▪️ Chiều dài băng xóa: 8m (CT-007), 12m (CT-008), 5m (CT-009).

▪️ Kích thước: 90 x 46 mm (CT-007), 103 x 52 mm (CT-008), 72 x 33 mm (CT-009).

▪️ Trọng lượng: 19.5 gram (CT-007), 25 gram (CT-008), 12 gram (CT-009).

▪️ Chất liệu: PS - POM.

▪️ Bảo quản: Không thích hợp cho trẻ dưới 3 tuổi. Bảo quản nơi khô ráo, thoáng mát. Tránh xa nguồn nhiệt, hóa chất. Tránh ánh nắng trực tiếp chiếu vào sản phẩm.',4, 1, '1'),
(1058, 'Bút tẩy kéo FlexOffice FO-CT02 (Màu ngẫu nhiên)', 'Thông số kĩ thuật :.

Tên danh mục:	Bút tẩy kéo.
Thương hiệu:	Flexoffice.
Bề rộng băng xóa:	5 mm.
Bề dài băng xóa:	8 m.
Đóng gói:	1 cây/blister.

Khác với sản phẩm Bút tẩy truyền thống, băng xóa kéo FO-CT02 là kết hợp của sự tiện lợi, nhanh chóng, vô cùng an toàn và thân thiện với môi trường. Sản phẩm được thiết kế trẻ trung, năng động, màu sắc tươi sáng, đây là sản phẩm rất phù hợp cho giới văn phòng hiện đại.

Đặc tính :
- An toàn, không độc hại.
- Băng dài 8m, rộng 5mm, dẻo dai, độ bám dính tốt.
- Thiết kế hiện đại, kiểu dáng nhỏ gọn, tiện dụng, xóa nhẹ, êm tay.
- Bề mặt xóa nhẵn mịn, không để lại vết khi scan, fax.',4, 1, '1'),
(1059, 'Bút tẩy nước CP-12', 'Thông số kĩ thuật :

Tên danh mục:	Bút tẩy.
Thương hiệu:	Thiên Long.
Dung tích mực:	3 ml.
Đóng gói:	01 Cây/ kiện.
Khuyến cáo:	Nhiệt độ: 10 ~ 55º C, Độ ẩm: 55 ~ 95% RH, Tránh xa nguồn nhiệt, dầu mỡ.',4, 1, '1'),
(1060, 'Bút tẩy nước Thiên Long CP-015', 'Thông số kĩ thuật :.

Tên danh mục:	Bút tẩy.
Thương hiệu:	Thiên Long.
Dung tích mực:	5 ml.
Đóng gói:	01 Cây/ kiện.
Khuyến cáo:	Nhiệt độ: 10 ~ 55º C, Độ ẩm: 55 ~ 95% RH, Tránh xa nguồn nhiệt, dầu mỡ.',4, 1, '1'),
(1061, 'Bút tẩy Thiên Long CP-02', 'Thông số kĩ thuật :

Tên danh mục:	Bút tẩy.
Thương hiệu:	Thiên Long.
Dung tích mực:	12 ml.
Hình dáng thân bút:	Thân dẹp.
Đóng gói:	10 cây/hộp.
Trọng lượng:	34 gram.

Bút tẩy Thiên Long CP-02 có kiểu dáng thân dẹp, vừa tầm tay, thuận tiện khi sử dụng. Cán bằng nhựa màu xanh lá thể hiện sự trẻ trung, năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt.

Đặc điểm : 

- Công nghệ vượt trội giúp mực xóa nhanh khô, che phủ tốt, không độc hại và an toàn với tầng ozone.

- Dung tích mực: 12 ml.
Lưu ý :
- Đặt bút hướng lên khi không sử dụng.
- Lưu trữ nơi khô ráo, thoáng mát, tránh tiếp xúc trực tiếp với ánh nắng mặt trời.
- Lắc đều bút trước khi sử dụng.',4, 1, '1'),
(1062, 'Bút tẩy Thiên Long CP-05', 'Thông số kĩ thuật :
.
Tên danh mục:	Bút tẩy.
Thương hiệu:	Thiên Long.
Dung tích mực:	7 ml.
Hình dáng thân bút:	Thân trụ tròn.
Đóng gói:	10 cây/hộp.
Trọng lượng:	27 gram.

Bút tẩy Thiên Long CP-05 có kiểu dáng thân trụ tròn, vừa tầm tay, thuận tiện khi sử dụng. Cán bằng nhựa màu xanh lá thể hiện sự trẻ trung, năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt.

Đặc điểm: .

- Công nghệ đột phá mới giúp cho bút có thể đặt theo mọi hướng khi sử dụng, trưng bày, bảo quản... mà không sợ bút bị nghẹt mực như các Bút tẩy thông thường.
- Độ che phủ bề mặt tốt và mau khô, giúp cho chữ viết rõ ràng, không bị lem, nhòe. 

- Không độc hại và an toàn với tầng ozone.

Lưu ý :.
- Lưu trữ nơi khô ráo, thoáng mát, tránh tiếp xúc trực tiếp với ánh nắng mặt trời.
- Lắc đều bút trước khi sử dụng.',4, 1, '1'),
(1063, 'Bút tẩy Thiên Long CP-06', '
Tên danh mục:	Bút tẩy.
Thương hiệu:	Thiên Long.
Dung tích mực:	7 ml.
Hình dáng thân bút:	Thân tròn, màu ngẫu nhiên.
Đóng gói:	10 cây/hộp.

Bút tẩy Thiên Long CP-06 có kiểu dáng thân tròn, vừa tầm tay, thuận tiện khi sử dụng. Cán bằng nhựa đủ màu thể hiện sự trẻ trung, năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt.

Đặc điểm : .

- Kiểu dáng bút được thiết kế hết sức ấn tượng, thích hợp với người dùng trẻ tuổi là học sinh, sinh viên. 

- Thân bút tròn, bằng nhựa mềm dễ cầm và không mỏi tay khi xóa.
- Thân bút có nhiều màu sắc: Hồng, xanh dương, xanh lá, cam.
- Công nghệ vượt trội giúp mực xuống đều hơn.
- Bút ít bị tắc mực, độ che phủ bề mặt tốt hơn và mau khô, giúp cho chữ viết rõ ràng, không bị lem, nhòe.

- Dung tích mực: 7 ml.

Lưu ý :.
- Đặt bút hướng lên khi không sử dụng.
- Lưu trữ nơi khô ráo, thoáng mát, tránh tiếp xúc trực tiếp với ánh nắng mặt trời.
- Lắc đều bút trước khi sử dụng.

',4, 1, '1'),
(1064, 'Bút dạ quang FlexOffice FO-HL01', 'Thông số kĩ thuật :.

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Flexoffice.
Bề rộng nét viết:	đầu bút nhỏ : 1mm , đầu bút lớn : 5mm
Số đầu bút:	2.
Đóng gói:	10 cây/hộp.
Trọng lượng:	10 gram.
Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

Bút dạ quang FO-HL01 là sản phẩm mới thuộc dòng sản phẩm Officemate series do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu Flexoffice.

ĐẶC ĐIỂM NỔI BẬT :
- Bút dạ quang FO-HL01 có 2 đầu bút: một đầu nhỏ và một đầu lớn, giúp đa dạng nét viết, thuận tiện khi sử dụng. Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
- Kiểu dáng thon gọn, trẻ trung. Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang FO-HL01.

ĐẶC TÍNH SẢN PHẨM:
- Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
- Thiết kế hai đầu bút thuận tiện. Đầu bút và ruột bút bằng polyester. Vỏ bọc bằng nhựa PP. 

- Bề rộng nét viết: đầu bút nhỏ 1mm và đầu bút lớn 5mm.
- Bút dạ quang FO-HL01 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.

TUỔI THỌ & BẢO QUẢN:
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

KHUYẾN CÁO:
- Đậy nắp ngay sau khi sử dụng.
- Không đánh dấu, không viết lên các bề mặt không phải là giấy.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 5, 1, '1'),
(1065, 'Bút dạ quang FlexOffice FO-HL02', 'Thông số kĩ thuật :.

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Flexoffice.
Bề rộng nét viết:	5 mm.
Số đầu bút:	1.
Đóng gói:	10 cây/hộp.
Trọng lượng:	26 gram.
Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang FO-HL02 là sản phẩm mới thuộc dòng sản phẩm Officemate series do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu Flexoffice.

Đặc điểm nổi bật:
- Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
- Kiểu dáng thon gọn, trẻ trung, không lăn khi đặt trên bàn .
- Lượng mực nhiều , tăng thời gian sử dụng .
- Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang FO-HL02.

Đặc tính sản phẩm bút dạ quang FO-HL02 :
- Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
- Đầu bút và ruột bút bằng polyester, dạng vát xéo. Vỏ bọc bằng nhựa PP.
- Bề rộng nét viết: 4mm
- Bút dạ quang FO-HL02 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.

Tuổi thọ & bảo quản:
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

Khuyến cáo:
- Đậy nắp ngay sau khi sử dụng.
- Không đánh dấu, không viết lên các bề mặt không phải là giấy.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 5, 1, '1'),
(1066, 'Bút dạ quang Hoshi Thiên Long HL-018HS', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Kích thước thân:	140mm; Ø12.37.
Bề rộng nét viết:	1.0mm và 4.0mm.
Tiêu chuẩn:	TCCS 016:2011/TL-BDQ.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.', 5, 1, '1'),
(1067, 'Bút dạ quang màu pastel - Eco Style Highlighter Thien Long HL-015ECO', 'Thông số kĩ thuật :.

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	4.0 mm.
Chất liệu:	TEXa® G2341 (Certified Biobased USDA - Mỹ) và Vỏ trấu phế phẩm nông nghiệp.
Đóng gói:	01 cây/ kiện.
Trọng lượng:	25 gram.
Kích thước bút:	108.3 x 21.2 x 14.8 mm.
Tiêu chuẩn:	TCCS 016:2011/TL-BDQ.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Đặc tính sản phẩm:.

Bút dùng để đánh dấu trên giấy tập học sinh, các loại sách hoặc giấy photocopy mà không làm mất nét chữ bên dưới.', 5, 1, '1'),
(1068, 'Bút dạ quang màu Pastel Thiên Long Flexoffice Pazto FO-HL009VN', 'Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice
Trọng lượng:	26 gram
Xuất xứ:	Việt Nam
Kích thước:	108.7 x 23.9 mm
Đóng gói:	01 cây/ kiện
Bảo quản:	Tránh xa nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.

Thiết kế với 5 tone màu pastel bắt mắt, với thiết kế đơn giản, hiện đại, hợp thời trang, hợp xu hướng.

Tone màu Pastel - màu Vintage - màu dịu mát và ấm áp, mang lại sự nhẹ nhàng, thanh lịch, thoải mái…cho cảm giác mới lạ, nổi bật cá tính.

Không làm lem chữ, không để lại vết khi photocopy. Mực có thể rửa và giặt sạch nếu dính trên da và vải.', 5, 1, '1'),
-- (1069, 'Bút dạ quang màu Pastel Thiên Long Pazto HL-016', 'Thông Số Kỹ Thuật.
-- Thương hiệu:	Thiên Long.
-- Trọng lượng:	10 gram.
-- Xuất xứ:	Việt Nam.
-- Kích thước:	136.9 x 15.7 mm.
-- Nét viết:	4.0 và 1.0 mm.
-- Đóng gói:	01 cây/ kiện.
-- Bảo quản:	Tránh xa nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.

-- Thiết kế với 5 tone màu pastel bắt mắt, với thiết kế đơn giản, hiện đại, hợp thời trang, hợp xu hướng.

-- Tone màu Pastel - màu Vintage - màu dịu mát và ấm áp, mang lại sự nhẹ nhàng, thanh lịch, thoải mái…cho cảm giác mới lạ, nổi bật cá tính.

-- Không làm lem chữ, không để lại vết khi photocopy. Mực có thể rửa và giặt sạch nếu dính trên da và vải. Bộ bút dạ quang màu rửa được gồm: Pastel Yellow, Pastel Turquoise, Pastel Magenta, Pastel Red, Pastel Green.', 5, 1, '1'),
(1070, 'Bút dạ quang Thiên Long HL-07', 'Thông số kĩ thuật :.

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	5 mm.
Số đầu bút:	1.
Đóng gói:	10 cây/hộp.
Trọng lượng:	24 gram.
Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang HL-07 là sản phẩm mới do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu Thiên Long.

Đặc điểm nổi bật: 

- Kiểu dáng cách điệu từ chiếc USB, trẻ trung rất thích hợp với học sinh, sinh viên, NVVP.
- Đầu bút bằng sợi polyester viết êm, được nhập khẩu từ Nhật Bản.
- Màu mực tươi sáng, độ phản quang cao. Thích hợp trên nhiều loại giấy. Không làm lem nét chữ khi đánh dấu và không để lại vết khi qua photocopy.', 5, 1, '1'),
(1071, 'Bút dạ quang Thiên Long HL-012', 'Thông số kĩ thuật :

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	5 mm.
Số đầu bút:	1.
Đóng gói:	10 cây/hộp.
Trọng lượng:	25 gram.
Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang HL012 là sản phẩm do Tập đoàn Thiên Long sản xuất.
Bút dạ quang HL012 có những đặc điểm nổi bật:.
- Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
- Kiểu dáng thon gọn, trẻ trung, không lăn khi đặt trên bàn.
- Bút có kiểu dáng đơn giản, hiện đại. Thân vuông nhìn khỏe mạnh rất thích hợp với NVVP, SV...
- Lượng mực nhiều, tăng thời gian sử dụng .
- Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang HL012.

Đặc tính sản phẩm bút dạ quang HL012.
- Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
- Đầu bút và ruột bút bằng polyester, dạng vát xéo. Vỏ bọc bằng nhựa PP.
- Bề rộng nét viết: 5mm.
- Bút dạ quang HL012 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.
TUỔI THỌ & BẢO QUẢN:.
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

KHUYẾN CÁO:.
- Đậy nắp ngay sau khi sử dụng.
- Không đánh dấu, không viết lên các bề mặt không phải là giấy.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 5, 1, '1'),
(1072, 'Combo 10 Bút dạ quang màu Pastel Thiên Long Flexoffice Pazto FO-HL009VN', 'Thông Số Kỹ Thuật.
Thương hiệu:	Flexoffice.
Trọng lượng:	260 gram.
Xuất xứ:	Việt Nam.
Kích thước bút:	108.7 x 23.9 mm.
Đóng gói:	10 cây/ hộp/ kiện.
Bảo quản:	Tránh xa nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Thiết kế với 5 tone màu pastel bắt mắt, với thiết kế đơn giản, hiện đại, hợp thời trang, hợp xu hướng.

Tone màu Pastel - màu Vintage - màu dịu mát và ấm áp, mang lại sự nhẹ nhàng, thanh lịch, thoải mái…cho cảm giác mới lạ, nổi bật cá tính.

Không làm lem chữ, không để lại vết khi photocopy. Mực có thể rửa và giặt sạch nếu dính trên da và vải.', 5, 1, '1'),
(1073, 'Combo 12 bút dạ quang màu pastel - Eco Style Highlighter Thiên Long HL-015ECO', '
Thông số kĩ thuật :

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Thiên Long
Bề rộng nét viết:	4.0mm.
Chất liệu:	TEXa® G2341 (Certified Biobased USDA - Mỹ) và Vỏ trấu phế phẩm nông nghiệp.
Đóng gói:	12 cây/ kiện.
Trọng lượng:	300 gram.
Kích thước bút:	108.3 x 21.2 x 14.8 mm.
Tiêu chuẩn:	TCCS 016:2011/TL-BDQ.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Đặc tính sản phẩm:.

Bút dùng để đánh dấu trên giấy tập học sinh, các loại sách hoặc giấy photocopy mà không làm mất nét chữ bên dưới.', 5, 1, '1'),
(1074, ' Combo 20 Bút dạ quang FlexOffice FO-HL01', 'Thông số kĩ thuật :.

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Flexoffice.
Bề rộng nét viết:	đầu bút nhỏ : 1mm , đầu bút lớn : 5mm.
Số đầu bút:	2.
Đóng gói:	10 cây/hộp.
Trọng lượng:	10 gram.
Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

Bút dạ quang FO-HL01 là sản phẩm mới thuộc dòng sản phẩm Officemate series do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu Flexoffice.
ĐẶC ĐIỂM NỔI BẬT :.
- Bút dạ quang FO-HL01 có 2 đầu bút: một đầu nhỏ và một đầu lớn, giúp đa dạng nét viết, thuận tiện khi sử dụng. Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
- Kiểu dáng thon gọn, trẻ trung. Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang FO-HL01.

ĐẶC TÍNH SẢN PHẨM:.
- Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
- Thiết kế hai đầu bút thuận tiện. Đầu bút và ruột bút bằng polyester. Vỏ bọc bằng nhựa PP. 

- Bề rộng nét viết: đầu bút nhỏ 1mm và đầu bút lớn 5mm.
- Bút dạ quang FO-HL01 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.

TUỔI THỌ & BẢO QUẢN:.
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

KHUYẾN CÁO:.
- Đậy nắp ngay sau khi sử dụng.
- Không đánh dấu, không viết lên các bề mặt không phải là giấy.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 5, 1, '1'),
-- (1075, 'Combo 20 Bút dạ quang FlexOffice FO-HL02', '
-- Thông số kĩ thuật :.

-- Tên danh mục:	Bút dạ quang
-- Thương hiệu:	Flexoffice.
-- Bề rộng nét viết:	5 mm.
-- Số đầu bút:	1.
-- Đóng gói:	10 cây/hộp.
-- Trọng lượng:	26 gram.
-- Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

-- Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang FO-HL02 là sản phẩm mới thuộc dòng sản phẩm Officemate series do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu Flexoffice.

-- Đặc điểm nổi bật:.
-- - Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
-- - Kiểu dáng thon gọn, trẻ trung, không lăn khi đặt trên bàn .
-- - Lượng mực nhiều , tăng thời gian sử dụng .
-- - Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang FO-HL02.

-- Đặc tính sản phẩm bút dạ quang FO-HL02 :.
-- - Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
-- - Đầu bút và ruột bút bằng polyester, dạng vát xéo. Vỏ bọc bằng nhựa PP.
-- - Bề rộng nét viết: 4mm.
-- - Bút dạ quang FO-HL02 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.

-- Tuổi thọ & bảo quản:.
-- - Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
-- - Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
-- - Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

-- Khuyến cáo:.
-- - Đậy nắp ngay sau khi sử dụng.
-- - Không đánh dấu, không viết lên các bề mặt không phải là giấy.
-- - Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 3, 1, '1'),
(1076, ' Combo 20 Bút dạ quang FlexOffice FO-HL05', 'Thông số kĩ thuật :.

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Flexoffice.
Bề rộng nét viết:	4 mm.
Số đầu bút:	1.
Đóng gói:	10 cây/hộp.
Trọng lượng:	25 gram.
Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang FO-HL05 là sản phẩm mới thuộc dòng sản phẩm Officemate series do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu Flexoffice.

Đặc điểm nổi bật:.

- Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
- Kiểu dáng thon gọn, trẻ trung, không lăn khi đặt trên bàn .
- Lượng mực nhiều, tăng thời gian sử dụng .
- Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang FO-HL05.

Đặc tính sản phẩm bút dạ quang FO-HL05 :.

- Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
- Đầu bút và ruột bút bằng polyester, dạng vát xéo. Vỏ bọc bằng nhựa PP.
- Bề rộng nét viết: 4mm.
- Bút dạ quang FO-HL05 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.

Tuổi thọ & bảo quản:.
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

Khuyến cáo:
- Đậy nắp ngay sau khi sử dụng.
- Không đánh dấu, không viết lên các bề mặt không phải là giấy.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 5, 1, '1'),
-- (1077, 'Combo 20 Bút dạ quang FlexOffice FO-HL07', 'Thông số kĩ thuật :.

-- Tên danh mục:	Bút dạ quang.
-- Thương hiệu:	Thiên Long.
-- Bề rộng nét viết:	5 mm.
-- Số đầu bút:	1.
-- Đóng gói:	10 cây/hộp.
-- Trọng lượng:	24 gram.
-- Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

-- Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang HL-07 là sản phẩm mới do Tập đoàn Thiên Long sản xuất, mang nhãn hiệu Thiên Long.
-- Đặc điểm nổi bật: .

-- - Kiểu dáng cách điệu từ chiếc USB, trẻ trung rất thích hợp với học sinh, sinh viên, NVVP.
-- - Đầu bút bằng sợi polyester viết êm, được nhập khẩu từ Nhật Bản
-- - Màu mực tươi sáng, độ phản quang cao. Thích hợp trên nhiều loại giấy. Không làm lem nét chữ khi đánh dấu và không để lại vết khi qua photocopy.

-- Tuổi thọ & bảo quản:.
-- - Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
-- - Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
-- - Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

-- Khuyến cáo:.
-- - Đậy nắp ngay sau khi sử dụng.
-- - Không đánh dấu, không viết lên các bề mặt không phải là giấy.
-- - Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 3, 1, '1'),
(1078, 'Combo 20 Bút dạ quang FlexOffice FO-HL03 (FS)', 'Thông số kĩ thuật :

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Thiên Long
Bề rộng nét viết:	đầu bút nhỏ 0.6 mm, đầu bút lớn 4 mm.
Số đầu bút:	2.
Đóng gói:	5 cây / vĩ.
Trọng lượng:	10 gram.
Màu sắc:	Vàng / Cam / Hồng / Xanh / Lá.

Bút dạ quang còn được gọi là Bút đánh dấu.Bút dạ quang HL03 là sản phẩm do Tập đoàn Thiên Long sản xuất.

Bút dạ quang HL03 có những đặc điểm nổi bật.
- Bút dạ quang HL03 có 2 đầu bút: Một đầu nhỏ và một đầu lớn, giúp đa dạng nét viết, thuận tiện khi sử dụng. Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
- Kiểu dáng thon gọn, trẻ trung Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy đây là đặt điểm vượt trội của bút dạ quang HL03.

Đặc tính sản phẩm bút dạ quang HL03.
- Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
- Thiết kế hai đầu bút thuận tiện. Đầu bút và ruột bút bằng polyester. Vỏ bọc bằng nhựa PP. Bề rộng nét viết:.
- Đầu bút nhỏ 0.6mm và đầu bút lớn 4mm.
- Bút dạ quang FO-HL03 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.

Tuổi thọ và bảo quản:.
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

Khuyến cáo:
- Đậy nắp ngay sau khi sử dụng.
- Không đánh dấu, không viết lên các bề mặt không phải là giấy.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 5, 1, '1'),
(1079, ' Combo 20 Bút dạ quang FlexOffice FO-HL012', 'Thông số kĩ thuật :.

Tên danh mục:	Bút dạ quang.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	5 mm.
Số đầu bút:	1.
Đóng gói:	10 cây/hộp.
Trọng lượng:	25 gram.
Màu sắc:	Vàng/Cam/Hồng/Xanh/Lá.

Bút dạ quang còn được gọi là Bút đánh dấu. Bút dạ quang HL012 là sản phẩm do Tập đoàn Thiên Long sản xuất.
Bút dạ quang HL012 có những đặc điểm nổi bật:.
- Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế.
- Kiểu dáng thon gọn, trẻ trung, không lăn khi đặt trên bàn.
- Bút có kiểu dáng đơn giản, hiện đại. Thân vuông nhìn khỏe mạnh rất thích hợp với NVVP, SV...
- Lượng mực nhiều, tăng thời gian sử dụng .
- Màu dạ quang mạnh, không làm lem nét chữ của mực khi viết chồng lên và không để lại vết khi qua photocopy. Đây là đặc điểm vượt trội của bút dạ quang HL012.

Đặc tính sản phẩm bút dạ quang HL012.
- Màu mực tươi sáng, phản quang tốt. Nét viết hoặc đánh dấu đều và liên tục. Không độc hại.
- Đầu bút và ruột bút bằng polyester, dạng vát xéo. Vỏ bọc bằng nhựa PP.
- Bề rộng nét viết: 5mm.
- Bút dạ quang HL012 có 5 màu mực: Vàng, cam, hồng, xanh lá, xanh biển.

TUỔI THỌ & BẢO QUẢN:.
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

KHUYẾN CÁO:.
- Đậy nắp ngay sau khi sử dụng.
- Không đánh dấu, không viết lên các bề mặt không phải là giấy.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.', 5, 1, '1'),
(1080, 'Bút kim kỹ thuật- Drawing Pen Thiên Long Colokit', '
Thông số kĩ thuật :.

Tên danh mục:	Bút kim kỹ thuật.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	0.2mm(DW-C001); 0.3mm(DW-C002); 0.4mm(DW-C003); 0.5mm(DW-C005).
Kích thước bút:	136 x 9.5mm.
Tiêu chuẩn:	TCCS 0179:2024/TL-BVKT; tiêu chuẩn châu Âu EN 71/3.
Xuất xứ:	Việt Nam.
Sản xuất:	Trung Quốc.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.', 6, 1, '1'),
(1081, 'Bút lông dầu 3 màu xanh, đỏ, đen', 'Bút lông ghi Flashcard hàng tốt màu đẹp.



👉 Công dụng: Dùng để viết lên flashcard để học từ mới học tiếng anh, nhật, hàn...

👉 Quy cách: 2 ngòi, 1 đầu bút kích thước : 0.8 mm và 6mm.

👉 Số lượng: 1 cây  / 3 cây.
👉 Màu: xanh dương/đen/đỏ.



⭐ Đặc điểm nổi bật: .

✔️Bút này có thể ghi trên nhựa, gỗ, giấy bóng, nilon, gạch men, bìa flashcard bóng.

✔️Cho nên đây là 1 sản phẩm cực kỳ hoàn hảo nếu bạn đang sử dụng thẻ flashcard để học, thì nó là thanh bảo kiếm cho bạn dễ ✔️dang sử dụng.

✔️Mực viết liền khô liền, không bị lem. Màu sắc tươi sáng, nét không quá to cũng không quá nhỏ, xài rất ok.



LỜI CAM KẾT.

- Giao hàng đúng số lượng, đúng chất lượng  như trong mục sản phẩm đã đăng.

- Trong quá trình vận chuyển nếu hàng hoá bị biến dạng mình cam kết sẽ đổi trả lại hàng cho bạn, mọi chi phí phát sinh mình sẽ thanh toán hết.', 6, 1, '1'),
(1082, 'Bút lông kim Beebee Thiên Long FL-04', 'Thông số kĩ thuật :.

Tên danh mục:	Bút lông kim.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	0.3 - 0.4 mm.
Đóng gói:	10 cây/hộp.
Trọng lượng:	10 gram.
Màu mực:	Xanh/Đỏ/Đen/Tím.

Bút lông kim Beebee Thiên Long FL-04 thiết kế bút an toàn đạt theo tiêu chuẩn ISO 11540 (tiêu chuẩn về các yêu cầu an toàn về nắp của các sản phẩm dùng để viết hoặc đánh dấu dành cho trẻ em từ 14 tuổi trở xuống).

ĐẶC ĐIỂM :.
- Nét viết nhỏ, viết êm với đầu bi 0,3mm.
- Dáng bút thon gọn dễ cầm, xinh xắn kết hợp với thiết kế ngộ nghĩnh, sinh động phù hợp với trẻ em.
- Sản phẩm sử dụng đầu bút bằng kim loại, ngòi bút bằng nhựa acetal, chịu được độ mài mòn cao.
- Mực đậm nhanh khô, màu tươi sáng. Mực không bị lem, phù hợp cho cách viết chữ của các bé cấp 01.

TUỔI THỌ & BẢO QUẢN:.
- Tuổi thọ trung bình của sản phẩm: 24 tháng tính từ ngày sản xuất.
- Bảo quản nơi khô ráo, thoáng mát, tuyệt đối tránh xa nguồn nhiệt, hóa chất.
- Tránh ánh nắng trực tiếp chiếu vào sản phẩm.

KHUYẾN CÁO:
- Đậy nắp ngay sau khi sử dụng.
- Tránh làm bẩn hoặc thấm mực lên quần, áo, túi áo, vật có bề mặt thấm hút cao.
- Không sử dụng cho trẻ dưới 3 tuổi.
- Không để thấm ướt những trang giấy đã viết bằng sản phẩm bút lông kim.
- Không để những trang giấy đã viết bằng sản phẩm bút lông kim dưới ánh sáng mặt trời trực tiếp.', 6, 1, '1'),
(1083, 'Bút lông kim Thiên Long Doraemon TP-FL04DO', 'Thông số kĩ thuật :.

Tên danh mục:	Bút lông kim.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	0.3 mm.
Đóng gói:	10 cây/hộp.
Trọng lượng:	10 gram.
Màu mực:	Xanh/Đỏ/Đen/Tím.
- Đầu ngòi 0.3mm.
- Nét viết thanh mảnh, nhỏ, trơn, êm.

- Dáng bút thon gọn dễ cầm, xinh xắn thích hợp với trẻ em.
- Thân in hình Doraemon rất được các bạn trẻ yêu mến và sinh động tạo sự thích thú cho các em rèn luyện chữ viết.', 6, 1, '1'),
(1084, 'Bút lông kim Thiên Long FL-04AK', 'Thông số kĩ thuật .

Tên danh mục:	Bút lông kim.
Thương hiệu:	Thiên Long.
Bề rộng nét viết:	0.3 mm.
Đóng gói:	01 cây kiện.
Xuất xứ:	Việt Nam.
Sản xuất:	Việt Nam.
Tiêu chuẩn:	TCCS 0022011TL-BLK.
Khuyến cáo:	Tránh nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.', 6, 1, '1'),
(1085, 'COMBO 10 Chiếc Bút Lông Dầu Thiên Long PM - 09, Đầu Bút Marker Êm Trơn Dễ Xóa - Bách Hóa Tổng Hợp
', '
✅ THÔNG TIN SẢN PHẨM CỦA BÚT LÔNG DẦU THIÊN: .

- Loại sản phẩm: Bút Lông Dầu Thiên Long.

- Chất liệu: Thân bút làm bằng nhựa cao cấp.

- Màu sắc: .

+ Xanh.

+ Đỏ .

+ Đen.

- Kích thước: 0,8mm và 6mm.





✅ MÔ TẢ SẢN PHẨM CỦA BÚT LÔNG DẦU THIÊN LONG PM - 09: 
.
- Tập đoàn Thiên Long là công ty hàng đầu trong ngành văn phòng phẩm tại Việt Nam, chuyên cung cấp các sản phẩm và dịch vụ chất lượng cao cho quý khách hàng.

- Sản phẩm có kiểu dáng hiện đại gồm 2 đầu bút khác nhau: Đầu nhỏ và đầu lớn giúp đa dạng nét viết, thuận tiện khi sử dụng.

- Bút lông dầu Thiên Long PM-09 sở hữu thiết kế thanh mảnh, thon gọn, vừa tay cầm, mang đến trải nghiệm viết mượt mà và thoải mái.

- Phần thân bút được làm từ nhựa cao cấp, bền bỉ, chắc chắn.

- Bút sử dụng loại mực dầu chất lượng cao, lên màu đều, đậm nét, khô mực nhanh. Màu sắc đa dạng, tươi sáng, giúp bạn thỏa sức sáng tạo và làm nổi bật những ý tưởng của mình.

- Màu mực đậm tươi, mực ra đều và liên tục. Độ bám dính của mực tốt trên các vật liệu: Giấy, gỗ, da, nhựa, thủy tinh, kim loại, gốm, sứ, đĩa CD...

- Phù hợp cho: Nhân viên văn phòng, học sinh, sinh viên, thợ cơ khí xây dựng...

- Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn chất lượng quốc tế, kiểu dáng được cải tiến ấn tượng, thân bút cầm chắc tay , dễ cầm nắm , không gây mỏi tay khi sử dụng.





✅ ƯU ĐIỂM SẢN PHẨM CỦA BÚT LÔNG DẦU THIÊN LONG ĐA NĂNG CAO CẤP:.

- Bút lông dầu Thiên Long PM-09 có thể sử dụng để vẽ, tô màu, viết chữ, làm sổ tay, thiết kế đồ họa,... Sản phẩm phù hợp với nhiều đối tượng và mục đích sử dụng khác nhau.

- Bút có nắp đậy chắc chắn, giúp bảo quản đầu bút tốt hơn và tránh bị lem mực. Thiết kế nhỏ gọn, dễ dàng mang theo bên mình để sử dụng mọi lúc mọi nơi.

- Đầu bút tạo ra những đường nét mềm mại, tự nhiên, không bị gợn.

- Thiết kế thân thiện với người dùng, màu sắc trang nhã.

- Phù hợp với học sinh, sinh viên, văn phòng và những người yêu thích sáng tạo sử dụng để vẽ, tô màu, viết chữ, làm sổ tay, thiết kế đồ họa,...

- Làm từ nhựa cao cấp, không chứa chất độc hại, an toàn cho người sử dụng, đặc biệt là trẻ em.', 6, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_image_id` int(11) NOT NULL,
  `product_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_image_id`, `product_id`, `image_url`) VALUES
(1,1001, 'But/But_chi/But_chi_bam_Neon_Thien_Long_Colokit/1.webp'),
(2,1001, 'But/But_chi/But_chi_bam_Neon_Thien_Long_Colokit/3.webp'),
(3,1001, 'But/But_chi/But_chi_bam_Neon_Thien_Long_Colokit/4.webp'),
(4, 1002, 'But/But_chi/But_chi_go_2B_Diem_10/1.png'),
(5, 1002, 'But/But_chi/But_chi_go_2B_Diem_10/3.png'),
(6, 1002, 'But/But_chi/But_chi_go_2B_Diem_10/4.png'),
(7, 1003, 'But/But_chi/But_chi_go_HB_Flexoffice_FO/1.webp'),
(8, 1003, 'But/But_chi/But_chi_go_HB_Flexoffice_FO/3.webp'),
(9, 1003, 'But/But_chi/But_chi_go_HB_Flexoffice_FO/4.webp'),
(11, 1004, 'But/But_chi/But_chi_go_Thien_Long_GP-03_mau_ngau_nhien/1.webp'),
(12, 1004, 'But/But_chi/But_chi_go_Thien_Long_GP-03_mau_ngau_nhien/2.jpg'),
(13, 1004, 'But/But_chi/But_chi_go_Thien_Long_GP-03_mau_ngau_nhien/4.webp'),
(14, 1004, 'But/But_chi/But_chi_go_Thien_Long_GP-03_mau_ngau_nhien/5.jpg'),
(15, 1005, 'But/But_chi/But_chi_bam_Diem_10/1.webp'),
(16, 1005, 'But/But_chi/But_chi_bam_Diem_10/2.webp'),
(17, 1005, 'But/But_chi/But_chi_bam_Diem_10/3.webp'),
(18, 1005, 'But/But_chi/But_chi_bam_Diem_10/4.webp'),
(19, 1006, 'But/But_chi/But_chi_bam_Thien_Long/1.webp'),
(20, 1006, 'But/But_chi/But_chi_bam_Thien_Long/3.webp'),
(21, 1006, 'But/But_chi/But_chi_bam_Thien_Long/4.webp'),
(22, 1007, 'But/But_chi/But_chi_bam_Thien_Long_PC/1.webp'),
(23, 1007, 'But/But_chi/But_chi_bam_Thien_Long_PC/3.webp'),
(24, 1007, 'But/But_chi/But_chi_bam_Thien_Long_PC/4.webp'),
(25, 1007, 'But/But_chi/But_chi_bam_Thien_Long_PC/5.webp'),
(26, 1008, 'But/But_chi/But_chi_bam_Thien_Long_PC_018/1.webp'),
(27, 1008, 'But/But_chi/But_chi_bam_Thien_Long_PC_018/2.webp'),
(28, 1008, 'But/But_chi/But_chi_bam_Thien_Long_PC_018/4.webp'),
(29, 1008, 'But/But_chi/But_chi_bam_Thien_Long_PC_018/5.webp'),
(30, 1009, 'But/But_chi/But_chi_bam_Thien_Long_PC-022/1.webp'),
(31, 1009, 'But/But_chi/But_chi_bam_Thien_Long_PC-022/2.webp'),
(32, 1009, 'But/But_chi/But_chi_bam_Thien_Long_PC-022/4.webp'),
(33, 1010, 'But/But_chi/But_chi_go_2B_Flexoffice/2.webp'),
(34, 1010, 'But/But_chi/But_chi_go_2B_Flexoffice/3.webp'),
(35, 1010, 'But/But_chi/But_chi_go_2B_Flexoffice/4.webp'),
(36, 1011, 'But/But_chi/But_chi_go_cao_cap_Bizner_BIZ/1.webp'),
(37, 1011, 'But/But_chi/But_chi_go_cao_cap_Bizner_BIZ/2.webp'),
(38, 1011, 'But/But_chi/But_chi_go_cao_cap_Bizner_BIZ/4.webp'),
(39, 1011, 'But/But_chi/But_chi_go_cao_cap_Bizner_BIZ/5.webp'),
(40, 1012, 'But/But_chi/But_chi_go_HB_Diem_10/1.webp'),
(41, 1012, 'But/But_chi/But_chi_go_HB_Diem_10/2.webp'),
(42, 1012, 'But/But_chi/But_chi_go_HB_Diem_10/3.webp'),
(43, 1012, 'But/But_chi/But_chi_go_HB_Diem_10/5.webp'),
(44, 1012, 'But/But_chi/But_chi_go_HB_Diem_10/6.webp'),
(45, 1013, 'But/But_chi/But_chi_go_Neon_Thien_Long/2.webp'),
(46, 1014, 'But/But_chi/But_chi_khuc_Thien_Long/1.webp'),
(47, 1014, 'But/But_chi/But_chi_khuc_Thien_Long/4.jpg'),
(48, 1015, 'But/But_chi/But_chi_my_thuat_Thien_Long_2B/1.webp'),
(49, 1015, 'But/But_chi/But_chi_my_thuat_Thien_Long_2B/2.webp'),
(50, 1015, 'But/But_chi/But_chi_my_thuat_Thien_Long_2B/4.webp'),
(51, 1015, 'But/But_chi/But_chi_my_thuat_Thien_Long_2B/5.webp'),
(52, 1015, 'But/But_chi/But_chi_my_thuat_Thien_Long_2B/6.jpg'),
(53, 1016, 'But/But_chi/But_chi_my_thuat_Thien_Long_3B/2.webp'),
(54, 1016, 'But/But_chi/But_chi_my_thuat_Thien_Long_3B/3.webp'),
(55, 1016, 'But/But_chi/But_chi_my_thuat_Thien_Long_3B/4.webp'),
(56, 1017, 'But/But_chi/But_chi_my_thuat_Thien_Long_4B/1.webp'),
(57, 1017, 'But/But_chi/But_chi_my_thuat_Thien_Long_4B/3.webp'),
(58, 1018, 'But/But_chi/But_chi_my_thuat_Thien_Long_5B/1.webp'),
(59, 1018, 'But/But_chi/But_chi_my_thuat_Thien_Long_5B/3.webp'),
(60, 1019, 'But/But_chi/But_chi_my_thuat_Thien_Long_6B/1.webp'),
(61, 1019, 'But/But_chi/But_chi_my_thuat_Thien_Long_6B/3.webp'),
(62, 1019, 'But/But_chi/But_chi_my_thuat_Thien_Long_6B/4.webp'),
(63, 1020, 'But/But_chi/But_chi_nhua_Thien_Long_GP/1.webp'),
(64, 1020, 'But/But_chi/But_chi_nhua_Thien_Long_GP/2.webp'),

(65, 1041, 'But/But_bi/But_bi_Diem_10_Sweetme_TP-08/1.webp'),
(66, 1041, 'But/But_bi/But_bi_Diem_10_Sweetme_TP-08/2.webp'),
(67, 1041, 'But/But_bi/But_bi_Diem_10_Sweetme_TP-08/3.webp'),
(68, 1021, 'But/But_bi/But_bi_Diem_10_TP-06/1.webp'),
(69, 1021, 'But/But_bi/But_bi_Diem_10_TP-06/2.webp'),
(70, 1021, 'But/But_bi/But_bi_Diem_10_TP-06/3.webp'),
(71, 1022, 'But/But_bi/But_Bi_Flexoffice_FO-03/1.jpg'),
(72, 1022, 'But/But_bi/But_Bi_Flexoffice_FO-03/1.webp'),
(73, 1022, 'But/But_bi/But_Bi_Flexoffice_FO-03/2.webp'),
(75, 1023, 'But/But_bi/But_Bi_Flexoffice_FO-023/4.jpg'),
(76, 1023, 'But/But_bi/But_Bi_Flexoffice_FO-023/3.jpg'),
(77, 1024, 'But/But_bi/But_Bi_Flexoffice_FO-024/1.webp'),
(78, 1025, 'But/But_bi/But_Bi_Flexoffice_FO-026/1.jpg'),
(79, 1026, 'But/But_bi/But_Bi_Flexoffice_FO-036/4.webp'),
(80, 1027, 'But/But_bi/But_bi_Maxxie_Thien_Long_Diem_10_TP-05/5.webp'),
(81, 1028, 'But/But_bi/But_bi_Starup_Thien_Long_Flexoffice_FO-039/1.png'),
(82, 1028, 'But/But_bi/But_bi_Starup_Thien_Long_Flexoffice_FO-039/3.webp'),
(83, 1028, 'But/But_bi/But_bi_Starup_Thien_Long_Flexoffice_FO-039/4.png'),
(84, 1028, 'But/But_bi/But_bi_Starup_Thien_Long_Flexoffice_FO-039/5.webp'),
(85, 1029, 'But/But_bi/But_bi_Thien_Long_Flexoffice_FO-030VN_0.7mm/1.jpg'),
(112, 1029, 'But/But_bi/But_bi_Thien_Long_Flexoffice_FO-030VN_0.7mm/2.jpg'),
(113, 1029, 'But/But_bi/But_bi_Thien_Long_Flexoffice_FO-030VN_0.7mm/3.webp'),
(114, 1029, 'But/But_bi/But_bi_Thien_Long_Flexoffice_FO-030VN_0.7mm/5.jpg'),
(86, 1030, 'But/But_bi/But_Bi_Thien_Long_TL-08/1.webp'),
(87, 1030, 'But/But_bi/But_Bi_Thien_Long_TL-08/5.webp'),
(88, 1030, 'But/But_bi/But_Bi_Thien_Long_TL-08/6.webp'),
(89, 1031, 'But/But_bi/But_bi_Thien_Long_Simply_TL-062/1.webp'),
(90, 1032, 'But/But_bi/But_Bi_Thien_Long_TL-023/1.jpg'),
(91, 1033, 'But/But_bi/But_Bi_Thien_Long_TL-025/4.webp'),
(92, 1034, 'But/But_bi/But_Bi_Thien_Long_TL-031/1.jpg'),
(93, 1034, 'But/But_bi/But_Bi_Thien_Long_TL-031/3.webp'),
(94, 1034, 'But/But_bi/But_Bi_Thien_Long_TL-031/5.webp'),
(95, 1035, 'But/But_bi/But_Bi_Thien_Long_TL-034FS/5.webp'),
(96, 1036, 'But/But_bi/But_Bi_Thien_Long_TL-079/1.webp'),
(97, 1036, 'But/But_bi/But_Bi_Thien_Long_TL-079/2.webp'),
(98, 1036, 'But/But_bi/But_Bi_Thien_Long_TL-079/3.webp'),
(99, 1037, 'But/But_bi/But_Bi_Thien_Long_TL-095/1.webp'),
(100, 1037, 'But/But_bi/But_Bi_Thien_Long_TL-095/5.webp'),
(101, 1038, 'But/But_bi/But_Bi_Thien_Long_TL-097/1.webp'),
(102, 1038, 'But/But_bi/But_Bi_Thien_Long_TL-097/2.webp'),
(103, 1038, 'But/But_bi/But_Bi_Thien_Long_TL-097/4.webp'),
(104, 1038, 'But/But_bi/But_Bi_Thien_Long_TL-097/5.webp'),
(105, 1039, 'But/But_bi/But_Bi_Thien_Long_TL-039/1.webp'),
(106, 1039, 'But/But_bi/But_Bi_Thien_Long_TL-039/2.webp'),
(107, 1039, 'But/But_bi/But_Bi_Thien_Long_TL-039/4.webp'),
(108, 1039, 'But/But_bi/But_Bi_Thien_Long_TL-039/5.webp'),
(109, 1040, 'But/But_bi/Hop_20_But_Bi_Thien_Long_TL-027/1.webp'),
(110, 1040, 'But/But_bi/Hop_20_But_Bi_Thien_Long_TL-027/2.webp'),
(111, 1040, 'But/But_bi/Hop_20_But_Bi_Thien_Long_TL-027/4.webp'),
-- (115, 1042, 'But/But_bi/Bo_but_gel_Hoshi_Thien_Long_BST-/2.webp'),

(116, 1042, 'But/But_muc/Bo_but_gel_Hoshi_Thien_Long_BST-GELHS/2.webp'),
(117, 1043, 'But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long - Premium_tip - Muc_Xanh/1.webp'),
(118, 1043, 'But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long - Premium_tip - Muc_Xanh/2.webp'),
(119, 1044, 'But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long_GELB-023/1.webp'),
(120, 1044, 'But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long_GELB-023/2.webp'),
(121, 1044, 'But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long_GELB-023/4.webp'),
(122, 1045, 'But/But_muc/But_gel_B -Butter_Gel_PRO-079_Thien_Long_GELB-018/1.webp'),
(123, 1045, 'But/But_muc/But_gel_B -Butter_Gel_PRO-079_Thien_Long_GELB-018/2.webp'),
(124, 1045, 'But/But_muc/But_gel_B -Butter_Gel_PRO-079_Thien_Long_GELB-018/3.webp'),
(125, 1045, 'But/But_muc/But_gel_B -Butter_Gel_PRO-079_Thien_Long_GELB-018/4.webp'),
(126, 1045, 'But/But_muc/But_gel_B -Butter_Gel_PRO-079_Thien_Long_GELB-018/6.webp'),
(127, 1047, 'But/But_muc/But_gel_B-Buttersmooth_Gel_Thien_Long_GELB-031_Muc_xanh-Mau_ngau_nhien/2.webp'),
(128, 1046, 'But/But_muc/But_gel_B_ Buttersmooth_Gel_Thien_Long_GELB-032_Muc_Xanh_Mau_ngau_nhien - Copy/2.webp'),
(129, 1048, 'But/But_muc/But_Gel_Thien_Long_Doraemon_GEL-012DO_Nature - Muc_tim - Copy/2.webp'),
(130, 1049, 'But/But_muc/But_gel_Thien_Long_Happy_Obby_GEL-056/1.webp'),
(131, 1049, 'But/But_muc/But_gel_Thien_Long_Happy_Obby_GEL-056/3.webp'),
(132, 1049, 'But/But_muc/But_gel_Thien_Long_Happy_Obby_GEL-056/4.webp'),
(133, 1049, 'But/But_muc/But_gel_Thien_Long_Happy_Obby_GEL-056/5.webp'),
(134, 1049, 'But/But_muc/But_gel_Thien_Long_Happy_Obby_GEL-056/6.webp'),
(135, 1052, 'But/But_muc/Combo_20_But_gel_B _Buttersmooth_Gel_Thien_Long_GELB-034-Muc_xanh/1.webp'),
(136, 1052, 'But/But_muc/Combo_20_But_gel_B _Buttersmooth_Gel_Thien_Long_GELB-034-Muc_xanh/2.webp'),
(137, 1052, 'But/But_muc/Combo_20_But_gel_B _Buttersmooth_Gel_Thien_Long_GELB-034-Muc_xanh/3.webp'),
(138, 1053, 'But/But_muc/Combo_20_But_Gel_Thien_Long_Doraemon_GEL-012DO_Nature - Muc_tim/2.webp'),
(139, 1050, 'But/But_muc/Combo_5_10_20_But_gel_B_ Buttersmooth_Gel_Thien_Long_GELB-032_Muc_Xanh_Mau_ngau_nhien/2.webp'),

(172, 1054, 'But/But_tay/But_xoa_Diem_10_TP-CP01/3.webp'),
(140, 1054, 'But/But_tay/But_xoa_Diem_10_TP-CP01/4.webp'),
(141, 1055, 'But/But_tay/But_xoa_FlexOffice_FO-CP01_PLUS/1.webp'),
(142, 1055, 'But/But_tay/But_xoa_FlexOffice_FO-CP01_PLUS/3.webp'),
(143, 1055, 'But/But_tay/But_xoa_FlexOffice_FO-CP01_PLUS/4.webp'),
(144, 1055, 'But/But_tay/But_xoa_FlexOffice_FO-CP01_PLUS/5.webp'),
(145, 1056, 'But/But_tay/But_xoa_FlexOffice_FO-CP02VN/1.webp'),
(146, 1056, 'But/But_tay/But_xoa_FlexOffice_FO-CP02VN/3.webp'),
(147, 1056, 'But/But_tay/But_xoa_FlexOffice_FO-CP02VN/4.webp'),
(149, 1057, 'But/But_tay/But_xoa_keo - Correction_Tape_Thien_Long/1.webp'),
(151, 1057, 'But/But_tay/But_xoa_keo - Correction_Tape_Thien_Long/4.webp'),
(152, 1057, 'But/But_tay/But_xoa_keo - Correction_Tape_Thien_Long/5.webp'),
(153, 1058, 'But/But_tay/But_xoa_keo_FlexOffice_FO-CT02 (Mau_ngau_nhien)/2.webp'),
(154, 1058, 'But/But_tay/But_xoa_keo_FlexOffice_FO-CT02 (Mau_ngau_nhien)/3.webp'),
(155, 1058, 'But/But_tay/But_xoa_keo_FlexOffice_FO-CT02 (Mau_ngau_nhien)/4.webp'),
(156, 1059, 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-012/1.webp'),
(158, 1059, 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-012/3.webp'),
(159, 1059, 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-012/4.webp'),
(160, 1060, 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-015/1.webp'),
(161, 1060, 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-015/3.webp'),
(162, 1060, 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-015/5.webp'),
(164, 1061, 'But/But_tay/But_xoa_Thien_Long_CP-02/2.webp'),
(165, 1061, 'But/But_tay/But_xoa_Thien_Long_CP-02/3.webp'),
(166, 1061, 'But/But_tay/But_xoa_Thien_Long_CP-02/4.webp'),
(167, 1061, 'But/But_tay/But_xoa_Thien_Long_CP-02/5.webp'),
(168, 1062, 'But/But_tay/But_xoa_Thien_Long_CP-05/2.webp'),
(169, 1062, 'But/But_tay/But_xoa_Thien_Long_CP-05/3.webp'),
(170, 1063, 'But/But_tay/But_xoa_Thien_Long_CP-06/2.webp'),
(171, 1063, 'But/But_tay/But_xoa_Thien_Long_CP-06/3.webp'),

(173, 1064, 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL01/1.webp'),
(174, 1065, 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL02/1.webp'),
(175, 1066, 'But/But_da_quang/But_da_quang_Hoshi_Thien_Long HL-018HS/1.webp'),
(176, 1066, 'But/But_da_quang/But_da_quang_Hoshi_Thien_Long HL-018HS/3.webp'),
(177, 1066, 'But/But_da_quang/But_da_quang_Hoshi_Thien_Long HL-018HS/4.webp'),
(178, 1066, 'But/But_da_quang/But_da_quang_Hoshi_Thien_Long HL-018HS/6.webp'),
(179, 1067, 'But/But_da_quang/But_da_quang_mau_pastel - Eco_Style_Highlighter_Thien_Long_HL-015ECO/1.webp'),
(180, 1067, 'But/But_da_quang/But_da_quang_mau_pastel - Eco_Style_Highlighter_Thien_Long_HL-015ECO/2.webp'),
(181, 1068, 'But/But_da_quang/Combo_10_But_da_quang_mau_Pastel_Thien_Long_Flexoffice_Pazto_FO-HL009VN/1.webp'),
(182, 1068, 'But/But_da_quang/Combo_10_But_da_quang_mau_Pastel_Thien_Long_Flexoffice_Pazto_FO-HL009VN/2.webp'),
(183, 1068, 'But/But_da_quang/Combo_10_But_da_quang_mau_Pastel_Thien_Long_Flexoffice_Pazto_FO-HL009VN/3.webp'),
(184, 1068, 'But/But_da_quang/Combo_10_But_da_quang_mau_Pastel_Thien_Long_Flexoffice_Pazto_FO-HL009VN/4.webp'),
(185, 1068, 'But/But_da_quang/Combo_10_But_da_quang_mau_Pastel_Thien_Long_Flexoffice_Pazto_FO-HL009VN/5.webp'),
(186, 1073, 'But/But_da_quang/Combo_12_but_da_quang_mau_ pastel - Eco_Style_Highlighter_Thien_Long HL-015ECO/1.webp'),
(187, 1073, 'But/But_da_quang/Combo_12_but_da_quang_mau_ pastel - Eco_Style_Highlighter_Thien_Long HL-015ECO/2.webp'),
(188, 1073, 'But/But_da_quang/Combo_12_but_da_quang_mau_ pastel - Eco_Style_Highlighter_Thien_Long HL-015ECO/4.webp'),
(189, 1073, 'But/But_da_quang/Combo_12_but_da_quang_mau_ pastel - Eco_Style_Highlighter_Thien_Long HL-015ECO/5.webp'),
(190, 1073, 'But/But_da_quang/Combo_12_but_da_quang_mau_ pastel - Eco_Style_Highlighter_Thien_Long HL-015ECO/6.webp'),
(191, 1074, 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL01/1.webp'),
(192, 1074, 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL01/7.webp'),
(193, 1079, 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL02/1.webp'),
(194, 1076, 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL05/1.webp'),
(195, 1070, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long HL-07/1.webp'),
(196, 1071, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-012/1.webp'),
(197, 1078, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-03 (FS/1.webp)'),
(198, 1078, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-03 (FS/2.webp)'),
(199, 1078, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-03 (FS/3.webp)'),
(200, 1078, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-03 (FS/4.webp)'),
(201, 1078, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-03 (FS/5.webp)'),
(202, 1078, 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-03 (FS/6.webp)'),

(203, 1080, 'But/But_long/But_kim_ky_thuat- Drawing_Pen_Thien_Long_Colokit/1.webp)'),
(204, 1080, 'But/But_long/But_kim_ky_thuat- Drawing_Pen_Thien_Long_Colokit/2.webp)'),
(205, 1080, 'But/But_long/But_kim_ky_thuat- Drawing_Pen_Thien_Long_Colokit/3.webp)'),
(206, 1080, 'But/But_long/But_kim_ky_thuat- Drawing_Pen_Thien_Long_Colokit/5.webp)'),
(207, 1080, 'But/But_long/But_kim_ky_thuat- Drawing_Pen_Thien_Long_Colokit/6.webp)'),
(208, 1081, 'But/But_long/But_long_dau_3_mau_xanh_đo_đen/1.webp)'),
(209, 1081, 'But/But_long/But_long_dau_3_mau_xanh_đo_đen/2.webp)'),
(210, 1081, 'But/But_long/But_long_dau_3_mau_xanh_đo_đen/3.webp)'),
(211, 1082, 'But/But_long/But_long_kim_Beebee_Thien_Long_FL-04/1.webp)'),
(212, 1082, 'But/But_long/But_long_kim_Beebee_Thien_Long_FL-04/2.webp)'),
(213, 1082, 'But/But_long/But_long_kim_Beebee_Thien_Long_FL-04/3.webp)'),
(214, 1082, 'But/But_long/But_long_kim_Beebee_Thien_Long_FL-04/6.webp)'),
(215, 1083, 'But/But_long/But_long_kim_Thien_Long_Doraemon_TP-FL04DO/1.webp)'),
(216, 1083, 'But/But_long/But_long_kim_Thien_Long_Doraemon_TP-FL04DO/3.webp)'),
(217, 1083, 'But/But_long/But_long_kim_Thien_Long_Doraemon_TP-FL04DO/4.webp)'),
(218, 1084, 'But/But_long/But_long_kim_Thien_Long_FL-04AK/1.jpg)'),
(219, 1084, 'But/But_long/But_long_kim_Thien_Long_FL-04AK/2.webp)'),
(220, 1084, 'But/But_long/But_long_kim_Thien_Long_FL-04AK/4.webp)'),
(221, 1084, 'But/But_long/But_long_kim_Thien_Long_FL-04AK/6.webp)'),
(222, 1085, 'But/But_long/COMBO_10_Chiec_But_Long_Dau_Thien_Long_PM - 09/1.webp)');





-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `product_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `priceOld` decimal(10,2) DEFAULT NULL,
  `priceCurrent` decimal(10,2) NOT NULL,
  `discount_price` int default 0,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
INSERT INTO `product_type` (`product_type_id`, `product_id`, `name`, `image`, `priceOld`, `priceCurrent`, `discount_price`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1001, 'Bút chì bấm Neon Thiên Long Colokit', 'But/But_chi/But_chi_bam_Neon_Thien_Long_Colokit/2.jpg', 5000.00, 4750.00, 5, 200, '0', '2025-04-14 12:34:40', '2025-04-14 12:34:40'),
(2, 1002, 'Bút chì gỗ 2B Điểm 10', 'But/But_chi/But_chi_go_2B_Diem_10/2.png', 5000.00, 4750.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(3, 1003, 'Bút chì gỗ HB Flexoffice FO', 'But/But_chi/But_chi_go_HB_Flexoffice_FO/2.webp', 5000.00, 4750.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(4, 1004, 'Bút chì gỗ Thiên Long GP-03 màu ngẫu nhiên', 'But/But_chi/But_chi_go_Thien_Long_GP-03_mau_ ngau_nhien/3.jpg', 6000.00, 5700.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(5, 1005, 'Bút chì bấm Điểm 10', 'But/But_chi/But_chi_bam_Diem_10/5.webp', 8000.00, 7600.00, 5, 150, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(6, 1006, 'Bút chì bấm Thiên Long', 'But/But_chi/But_chi_bam_Thien_Long/2.webp', 9000.00, 8550.00, 5, 180, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(7, 1007, 'Bút chì bấm Thiên Long PC', 'But/But_chi/But_chi_bam_Thien_Long_PC/2.jpg', 10000.00, 9500.00, 5, 170, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(8, 1008, 'Bút chì bấm Thiên Long PC-018', 'But/But_chi/But_chi_bam_Thien_Long_PC_018/3.webp', 9500.00, 9025.00, 5, 190, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(9, 1009, 'Bút chì bấm Thiên Long PC-022', 'But/But_chi/But_chi_bam_Thien_Long_PC-022/3.webp', 10000.00, 9500.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(10, 1010, 'Bút chì gỗ 2B Flexoffice', 'But/But_chi/But_chi_go_2B_Flexoffice/1.webp', 5000.00, 4750.00, 5, 160, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(11, 1011, 'Bút chì gỗ cao cấp Bizner BIZ', 'But/But_chi/But_chi_go_cao_cap_Bizner_BIZ/3.webp', 12000.00, 11400.00, 5, 140, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(12, 1012, 'Bút chì gỗ HB Điểm 10(màu hồng)', 'But/But_chi/But_chi_go_HB_Diem_10/4.webp',6000.00, 5700.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(13, 1012, 'Bút chì gỗ HB Điểm 10(màu vàng)', 'But/But_chi/But_chi_go_HB_Diem_10/7.webp',6000.00, 5700.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(14, 1013, 'Bút chì gỗ Neon Thiên Long(xanh lá)', 'But/But_chi/But_chi_go_Neon_Thien_Long/1.webp', 6000.00, 5700.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(15, 1013, 'Bút chì gỗ Neon Thiên Long(xanh dương)', 'But/But_chi/But_chi_go_Neon_Thien_Long/3.webp', 6000.00, 5700.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(16, 1013, 'Bút chì gỗ Neon Thiên Long(hồng)', 'But/But_chi/But_chi_go_Neon_Thien_Long/4.webp', 6000.00, 5700.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(17, 1014, 'Bút chì khúc Thiên Long', 'But/But_chi/But_chi_khuc_Thien_Long/2.webp', 7000.00, 6650.00, 700.00, 190, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(18, 1015, 'Bút chì mỹ thuật Thiên Long 2B', 'But/But_chi/But_chi_my_thuat_Thien_Long_2B/3.jpg', 8000.00, 7600.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(19, 1016, 'Bút chì mỹ thuật Thiên Long 3B', 'But/But_chi/But_chi_my_thuat_Thien_Long_3B/1.webp', 10000.00, 9500.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(20, 1017, 'Bút chì mỹ thuật Thiên Long 4B', 'But/But_chi/But_chi_my_thuat_Thien_Long_4B/2.webp', 12000.00, 11400.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(21, 1018, 'Bút chì mỹ thuật Thiên Long 5B', 'But/But_chi/But_chi_my_thuat_Thien_Long_5B/2.webp', 14000.00, 13300.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(22, 1019, 'Bút chì mỹ thuật Thiên Long 6B', 'But/But_chi/But_chi_my_thuat_Thien_Long_6B/2.webp', 16000.00, 15200.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),
(23, 1020, 'Bút chì nhựa Thiên Long GP', 'But/But_chi/But_chi_nhua_Thien_Long_GP/3.webp', 9000.00, 8550.00, 5, 200, '0', '2025-04-23 00:00:00', '2025-04-23 00:00:00'),

(24, 1041, 'Bút bi Điểm 10 Sweetme TP-08', 'But/But_bi/But_bi_Diem_10_Sweetme_TP-08/2.webp', 7000.00, 6650.00, 5, 150, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(25, 1021, 'Bút bi Điểm 10 TP-06', 'But/But_bi/But_bi_Diem_10_TP-06/2.webp', 7000.00, 6650.00, 5, 150, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(26, 1021, 'Bút bi Điểm 10 TP-06', 'But/But_bi/But_bi_Diem_10_TP-06/3.webp', 7000.00, 6650.00, 5, 150, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(27, 1021, 'Bút bi Điểm 10 TP-06', 'But/But_bi/But_bi_Diem_10_TP-06/4.webp', 7000.00, 6650.00, 5, 150, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(28, 1022, 'Bút bi Flexoffice FO-03', 'But/But_bi/But_bi_Flexoffice_FO-03/1.jpg', 8000.00, 7600.00, 5, 120, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(29, 1023, 'Bút bi Flexoffice 1', 'But/But_bi/But_bi_Flexoffice_FO-023/2.webp', 9000.00, 8550.00, 5, 130, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(30, 1023, 'Bút bi Flexoffice 2', 'But/But_bi/But_bi_Flexoffice_FO-023/3.jpg', 9000.00, 8550.00, 5, 130, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(31, 1023, 'Bút bi Flexoffice 3', 'But/But_bi/But_bi_Flexoffice_FO-023/4.jpg', 9000.00, 8550.00, 5, 130, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(32, 1024, 'Bút bi Flexoffice FO-024', 'But/But_bi/But_bi_Flexoffice_FO-024/4.webp', 10000.00, 9500.00, 5, 110, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(33, 1025, 'Bút bi Flexoffice 1', 'But/But_bi/But_bi_Flexoffice_FO-026/3.webp', 10000.00, 9500.00, 5, 140, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(34, 1025, 'Bút bi Flexoffice 2', 'But/But_bi/But_bi_Flexoffice_FO-026/4.webp', 10000.00, 9500.00, 5, 140, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(35, 1025, 'Bút bi Flexoffice 3', 'But/But_bi/But_bi_Flexoffice_FO-026/5.webp', 10000.00, 9500.00, 5, 140, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(36, 1026, 'Bút bi Flexoffice ', 'But/But_bi/But_bi_Flexoffice_FO-036/2.webp', 10000.00, 9500.00, 5, 135, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(37, 1027, 'Bút bi Maxide Thiên Long Điểm 10 TP-05 1', 'But/But_bi/But_bi_Maxide_Thien_Long_Diem_10_TP-05/2.webp', 12000.00, 11400.00, 5, 145, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(38, 1027, 'Bút bi Maxide Thiên Long Điểm 10 TP-05 2', 'But/But_bi/But_bi_Maxide_Thien_Long_Diem_10_TP-05/4.webp', 12000.00, 11400.00, 5, 145, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(39, 1028, 'Bút bi Starup Thiên Long Flexoffice FO-039', 'But/But_bi/But_bi_Starup_Thien_Long_Flexoffice_FO-039/2.webp', 20000.00, 19000, 5, 100, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(40, 1029, 'Bút bi Thiên Long Flexoffice FO-030VN 0.7mm 1', 'But/But_bi/But_bi_Thien_Long_Flexoffice_FO-030VN_0.7mm/4.webp', 20000.00, 19000.00, 5, 125, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(41, 1029, 'Bút bi Thiên Long Flexoffice FO-030VN 0.7mm 2', 'But/But_bi/But_bi_Thien_Long_Flexoffice_FO-030VN_0.7mm/6.webp', 20000.00, 19000.00, 5, 125, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(42, 1030, 'Bút bi Thiên Long 1', 'But/But_bi/But_bi_Thien_Long_TL-08/2.webp', 5000.00, 4750.00, 5, 160, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(43, 1030, 'Bút bi Thiên Long 2', 'But/But_bi/But_bi_Thien_Long_TL-08/3.webp', 5000.00, 4750.00, 5, 160, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(44, 1030, 'Bút bi Thiên Long 3', 'But/But_bi/But_bi_Thien_Long_TL-08/4.webp', 5000.00, 4750.00, 5, 160, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(45, 1031, 'Bút bi Thiên Long 4', 'But/But_bi/But_bi_Thien_Long_Simply_TL-062/2.webp', 5000.00, 4750.00, 5, 160, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(64, 1031, 'Bút bi Thiên Long 5', 'But/But_bi/But_bi_Thien_Long_Simply_TL-062/3.webp', 5000.00, 4750.00, 5, 160, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),
(65, 1031, 'Bút bi Thiên Long 6', 'But/But_bi/But_bi_Thien_Long_Simply_TL-062/4.webp', 5000.00, 4750.00, 5, 160, '1', '2025-04-23 10:00:00', '2025-04-23 10:00:00'),

(47, 1032, 'Bút Bi Thiên Long 1', 'But/But_bi/But_Bi_Thien_Long_TL-023/3.jpg', 7000, 6650, 5, 100, '1', '2025-04-24 10:00:00', '2025-04-24 10:00:00'),
(70, 1032, 'Bút Bi Thiên Long 2', 'But/But_bi/But_Bi_Thien_Long_TL-023/2.webp', 7000, 6650, 5, 100, '1', '2025-04-24 10:00:00', '2025-04-24 10:00:00'),
(71, 1032, 'Bút Bi Thiên Long 3', 'But/But_bi/But_Bi_Thien_Long_TL-023/4.webp', 7000, 6650, 5, 100, '1', '2025-04-24 10:00:00', '2025-04-24 10:00:00'),
(48, 1033, 'Bút Bi Thiên Long 1', 'But/But_bi/But_Bi_Thien_Long_TL-025/1.webp', 8000, 7600, 5, 100, '1', '2025-04-24 10:01:00', '2025-04-24 10:01:00'),
(50, 1033, 'Bút Bi Thiên Long 2', 'But/But_bi/But_Bi_Thien_Long_TL-025/3.webp', 8000, 7600, 5, 100, '1', '2025-04-24 10:01:00', '2025-04-24 10:01:00'),
(51, 1033, 'Bút Bi Thiên Long 3', 'But/But_bi/But_Bi_Thien_Long_TL-025/5.webp', 8000, 7600, 5, 100, '1', '2025-04-24 10:01:00', '2025-04-24 10:01:00'),
(49, 1034, 'Bút Bi Thiên Long TL-031', 'But/But_bi/But_Bi_Thien_Long_TL-031/2.webp', 9000, 8550, 5, 100, '1', '2025-04-24 10:02:00', '2025-04-24 10:02:00'),
(53, 1035, 'Bút Bi Thiên Long 1', 'But/But_bi/But_Bi_Thien_Long_TL-034(FS)/1.webp', 9500, 9025, 5, 100, '1', '2025-04-24 10:03:00', '2025-04-24 10:03:00'),
(73, 1035, 'Bút Bi Thiên Long 2', 'But/But_bi/But_Bi_Thien_Long_TL-034(FS)/2.webp', 9500, 9025, 5, 100, '1', '2025-04-24 10:03:00', '2025-04-24 10:03:00'),
(74, 1035, 'Bút Bi Thiên Long 3', 'But/But_bi/But_Bi_Thien_Long_TL-034(FS)/3.webp', 9500, 9025, 5, 100, '1', '2025-04-24 10:03:00', '2025-04-24 10:03:00'),
(75, 1035, 'Bút Bi Thiên Long 4', 'But/But_bi/But_Bi_Thien_Long_TL-034(FS)/4.webp', 9500, 9025, 5, 100, '1', '2025-04-24 10:03:00', '2025-04-24 10:03:00'),
(54, 1036, 'Bút Bi Thiên Long 1', 'But/But_bi/But_Bi_Thien_Long_TL-079/4.webp', 8500, 8075, 5, 100, '1', '2025-04-24 10:04:00', '2025-04-24 10:04:00'),
(55, 1036, 'Bút Bi Thiên Long 2', 'But/But_bi/But_Bi_Thien_Long_TL-079/5.webp', 8500, 8075, 5, 100, '1', '2025-04-24 10:04:00', '2025-04-24 10:04:00'),
(56, 1036, 'Bút Bi Thiên Long 3', 'But/But_bi/But_Bi_Thien_Long_TL-079/6.webp', 8500, 8075, 5, 100, '1', '2025-04-24 10:04:00', '2025-04-24 10:04:00'),
(57, 1037, 'Bút Bi Thiên Long 1', 'But/But_bi/But_Bi_Thien_Long_TL-095/2.webp', 8800, 8360, 5, 100, '1', '2025-04-24 10:05:00', '2025-04-24 10:05:00'),
(58, 1037, 'Bút Bi Thiên Long 2', 'But/But_bi/But_Bi_Thien_Long_TL-095/3.webp', 8800, 8360, 5, 100, '1', '2025-04-24 10:05:00', '2025-04-24 10:05:00'),
(76, 1037, 'Bút Bi Thiên Long 3', 'But/But_bi/But_Bi_Thien_Long_TL-095/4.webp', 8800, 8360, 5, 100, '1', '2025-04-24 10:05:00', '2025-04-24 10:05:00'),
(59, 1038, 'Bút Bi Thiên Long 1', 'But/But_bi/But_Bi_Thien_Long_TL-097/3.webp', 8600, 8170, 5, 100, '1', '2025-04-24 10:06:00', '2025-04-24 10:06:00'),
(62, 1038, 'Bút Bi Thiên Long 2', 'But/But_bi/But_Bi_Thien_Long_TL-097/3.webp', 8600, 8170, 5, 100, '1', '2025-04-24 10:06:00', '2025-04-24 10:06:00'),
(63, 1039, 'Bút Bi Thiên Long TL-093', 'But/But_bi/But_Bi_Thien_Long_TL-093/3.webp', 9100, 8645, 5, 100, '1', '2025-04-24 10:07:00', '2025-04-24 10:07:00'),
(69, 1040, 'Hộp 20 Bút Bi Thiên Long TL-027', 'But/But_bi/Hop_20_But_Bi_Thien_Long_TL-027/3.webp', 60000, 57000, 5, 100, '1', '2025-04-24 10:08:00', '2025-04-24 10:08:00'),


(80, 1042, 'Bút mực Thiên Long xịn','But/But_muc/Bo_but_gel_Hoshi_Thien_Long_BST-GELHS/1.webp', 10000.00, 9500.00, 5, 150, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(81, 1043, 'Bút mực Thiên Long xịn','But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long - Premium_tip - Muc_Xanh/3.webp', 10000.00, 9500.00, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(83, 1044, 'Bút mực Thiên Long xịn nhất','But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long_GELB-023/3.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(79, 1044, 'Bút mực Thiên Long xịn nhì','But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long_GELB-023/5.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(84, 1044, 'Bút mực Thiên Long xịn tam','But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long_GELB-023/2.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(85, 1044, 'Bút mực Thiên Long xịn tứ','But/But_muc/But_gel_B - Minimalist_Butter_Gel_Thien_Long_GELB-023/4.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(86, 1045, 'Bút mực Thiên Long xịn','But/But_muc/But_gel_B -Butter_Gel_PRO-079_Thien_Long_GELB-018/5.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(91, 1047, 'Bút mực Thiên Long xịn','But/But_muc/But_gel_B-Buttersmooth_Gel_Thien_Long_GELB-031_Muc_xanh-Mau_ngau_nhien/1.webp',10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(92, 1046, 'Bút mực Thiên Long xịn','But/But_muc/But_gel_B_ Buttersmooth_Gel_Thien_Long_GELB-032_Muc_Xanh_Mau_ngau_nhien - Copy/1.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(93, 1048, 'Bút mực Thiên Long xịn','But/But_muc/But_Gel_Thien_Long_Doraemon_GEL-012DO_Nature - Muc_tim - Copy/1.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(97, 1049, 'Bút mực Thiên Long xịn','But/But_muc/But_gel_Thien_Long_Happy_Obby_GEL-056/2.webp', 10000.00, 9500.00, 5, 350, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(100, 1052,'Bút mực Thiên Long xịn nhất', 'But/But_muc/Combo_20_But_gel_B _Buttersmooth_Gel_Thien_Long_GELB-034-Muc_xanh/4.webp', 150000, 142500, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(101, 1052,'Bút mực Thiên Long xịn nhì', 'But/But_muc/Combo_20_But_gel_B _Buttersmooth_Gel_Thien_Long_GELB-034-Muc_xanh/5.webp', 150000, 142500, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(103, 1053,'Bút mực Thiên Long xịn', 'But/But_muc/Combo_20_But_Gel_Thien_Long_Doraemon_GEL-012DO_Nature - Muc_tim/1.webp', 160000, 152000, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(104, 1050,'Bút mực Thiên Long xịn', 'But/But_muc/Combo_5_10_20_But_gel_B_ Buttersmooth_Gel_Thien_Long_GELB-032_Muc_Xanh_Mau_ngau_nhien/1.webp', 120000, 114000, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),


(110, 1054, 'But_xoa_Diem_10_TP-CP01_3', 'But/But_tay/But_xoa_Diem_10_TP-CP01/1.webp', 12000, 11400, 5, 55, '1', NOW(), NOW()),
(111, 1054, 'But_xoa_Diem_10_TP-CP01_4', 'But/But_tay/But_xoa_Diem_10_TP-CP01/2.webp', 15000, 14250, 5, 65, '1', NOW(), NOW()),
(112, 1055, 'But_xoa_FlexOffice_FO-CP01_PLUS_1', 'But/But_tay/But_xoa_FlexOffice_FO-CP01_PLUS/2.webp', 18000, 17100, 5, 70, '1', NOW(), NOW()),
(113, 1056, 'But_xoa_FlexOffice_FO-CP02VN_1', 'But/But_tay/But_xoa_FlexOffice_FO-CP02VN/2.webp', 11000, 10450, 5, 20, '1', NOW(), NOW()),
(114, 1057, 'But_xoa_keo_Thien_Long_1', 'But/But_tay/But_xoa_keo - Correction_Tape_Thien_Long/2.webp', 14000, 13300, 5, 52, '1', NOW(), NOW()),
(115, 1057, 'But_xoa_keo_Thien_Long_4', 'But/But_tay/But_xoa_keo - Correction_Tape_Thien_Long/3.webp', 16000, 15200, 5, 38, '1', NOW(), NOW()),
(116, 1057, 'But_xoa_keo_Thien_Long_5', 'But/But_tay/But_xoa_keo - Correction_Tape_Thien_Long/6.webp', 15000, 14250, 5, 60, '1', NOW(), NOW()),
(117, 1058, 'But_xoa_keo_FlexOffice_CT02_2', 'But/But_tay/But_xoa_keo_FlexOffice_FO-CT02 (Mau_ngau_nhien)/1.webp', 13500, 12825, 5, 44, '1', NOW(), NOW()),
(118, 1059, 'But_xoa_nuoc_CP-012_1', 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-012/2.webp', 15000, 14250, 5, 72, '1', NOW(), NOW()),
(119, 1060, 'But_xoa_nuoc_CP-015_1', 'But/But_tay/But_xoa_nuoc_Thien_Long_CP-015/2.webp', 17500, 16625, 5, 43, '1', NOW(), NOW()),
(120, 1061, 'But_xoa_Thien_Long_CP-02_2', 'But/But_tay/But_xoa_Thien_Long_CP-02/1.webp', 12500, 11875, 5, 50, '1', NOW(), NOW()),
(121, 1062, 'But_xoa_Thien_Long_CP-05_2', 'But/But_tay/But_xoa_Thien_Long_CP-05/1.webp', 18000, 17100, 5, 56, '1', NOW(), NOW()),
(122, 1063, 'But_xoa_Thien_Long_CP-06_2', 'But/But_tay/But_xoa_Thien_Long_CP-06/1.webp', 19000, 18050, 5, 45, '1', NOW(), NOW()),


(123, 1064, 'Bút dạ quang FlexOffice 1', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL01/2.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(124, 1064, 'Bút dạ quang FlexOffice 2', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL01/3.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(125, 1064, 'Bút dạ quang FlexOffice 3', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL01/4.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(126, 1064, 'Bút dạ quang FlexOffice 4', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL01/5.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(127, 1064, 'Bút dạ quang FlexOffice 5', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL01/6.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(129, 1065, 'Bút dạ quang FlexOffice 1', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL02/2.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(130, 1065, 'Bút dạ quang FlexOffice 2', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL02/3.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(131, 1065, 'Bút dạ quang FlexOffice 3', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL02/4.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(132, 1065, 'Bút dạ quang FlexOffice 4', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL02/5.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(133, 1065, 'Bút dạ quang FlexOffice 5', 'But/But_da_quang/But_da_quang_FlexOffice_FO-HL02/6.webp', 17780, 16891, 5, 50, '1', NOW(), NOW()),
(134, 1066, 'Bút dạ quang Hoshi Thiên Long 1', 'But/But_da_quang/But_da_quang_Hoshi_Thien_Long HL-018HS/2.webp', 12063, 11460, 5, 40, '1', NOW(), NOW()),
(135, 1066, 'Bút dạ quang Hoshi Thiên Long 2', 'But/But_da_quang/But_da_quang_Hoshi_Thien_Long HL-018HS/5.webp', 12063, 11460, 5, 40, '1', NOW(), NOW()),
(136, 1067, 'Bút dạ quang màu pastel 1', 'But/But_da_quang/But_da_quang_mau_pastel - Eco_Style_Highlighter_Thien_Long_HL-015ECO/3.webp', 11499, 10924, 5, 55, '1', NOW(), NOW()),
(137, 1067, 'Bút dạ quang màu pastel 2', 'But/But_da_quang/But_da_quang_mau_pastel - Eco_Style_Highlighter_Thien_Long_HL-015ECO/4.webp', 11499, 10924, 5, 55, '1', NOW(), NOW()),
(138, 1067, 'Bút dạ quang màu pastel 3', 'But/But_da_quang/But_da_quang_mau_pastel - Eco_Style_Highlighter_Thien_Long_HL-015ECO/5.webp', 11499, 10924, 5, 55, '1', NOW(), NOW()),
(139, 1068, 'Combo 10 bút dạ quang màu Pastel Thiên Long Flexoffice Pazto FO-HL009VN', 'But/But_da_quang/Combo_10_But_da_quang_mau_Pastel_Thien_Long_Flexoffice_Pazto_FO-HL009VN/6.webp', 17904, 17009, 5, 70, '1', NOW(), NOW()),
(140, 1070, 'Combo 20 bút dạ quang 1', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long HL-07/2.webp', 18575, 17646, 5, 65, '1', NOW(), NOW()),
(141, 1070, 'Combo 20 bút dạ quang 2', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long HL-07/3.webp', 18575, 17646, 5, 65, '1', NOW(), NOW()),
(142, 1070, 'Combo 20 bút dạ quang 3', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long HL-07/4.jpg', 18575, 17646, 5, 65, '1', NOW(), NOW()),
(143, 1070, 'Combo 20 bút dạ quang 4', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long HL-07/4.webp', 18575, 17646, 5, 65, '1', NOW(), NOW()),
(144, 1070, 'Combo 20 bút dạ quang 5', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long HL-07/6.webp', 18575, 17646, 5, 65, '1', NOW(), NOW()),
(145, 1071, 'Combo 20 bút dạ quang 1', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-012/2.jpg', 10810, 10270, 5, 50, '1', NOW(), NOW()),
(146, 1071, 'Combo 20 bút dạ quang 2', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-012/3.jpg', 10810, 10270, 5, 50, '1', NOW(), NOW()),
(147, 1071, 'Combo 20 bút dạ quang 3', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-012/4.webp', 10810, 10270, 5, 50, '1', NOW(), NOW()),
(148, 1071, 'Combo 20 bút dạ quang 4', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-012/5.jpg', 10810, 10270, 5, 50, '1', NOW(), NOW()),
(149, 1071, 'Combo 20 bút dạ quang 5', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-012/6.webp', 10810, 10270, 5, 50, '1', NOW(), NOW()),
(150, 1072, 'Combo 20 bút dạ quang 6', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-012/6.webp', 10810, 10270, 5, 50, '1', NOW(), NOW()),
(151, 1073, 'Combo 12 bút dạ quang màu pastel - Eco Style Highlighter Thiên Long HL-015ECO', 'But/But_da_quang/Combo_12_but_da_quang_mau_ pastel - Eco_Style_Highlighter_Thien_Long HL-015ECO/3.webp', 15478, 14704, 5, 45, '1', NOW(), NOW()),
(152, 1074, 'Combo 20 bút dạ quang 1', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL01/2.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(153, 1074, 'Combo 20 bút dạ quang 2', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL01/3.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(154, 1074, 'Combo 20 bút dạ quang 3', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL01/4.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(155, 1074, 'Combo 20 bút dạ quang 4', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL01/5.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(156, 1074, 'Combo 20 bút dạ quang 5', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL01/6.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(157, 1076, 'Combo 20 bút dạ quang 1', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL05/2.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(158, 1076, 'Combo 20 bút dạ quang 2', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL05/3.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(159, 1076, 'Combo 20 bút dạ quang 3', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL05/4.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(160, 1076, 'Combo 20 bút dạ quang 4', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL05/5.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(161, 1076, 'Combo 20 bút dạ quang 5', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL05/6.webp', 195890, 186100, 5, 40, '1', NOW(), NOW()),
(162, 1078, 'Combo 20 bút dạ quang Thiên Long HL-03 (FS)', 'But/But_da_quang/Combo_20_But_da_quang_Thien_Long_HL-03 (FS)/3.webp', 10768, 10230, 5, 75, '1', NOW(), NOW()),
(163, 1079, 'Combo 20 bút dạ quang 1', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL02/2.webp', 164850, 156610, 5, 55, '1', NOW(), NOW()),
(164, 1079, 'Combo 20 bút dạ quang 2', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL02/3.jpg', 164850, 156610, 5, 55, '1', NOW(), NOW()),
(165, 1079, 'Combo 20 bút dạ quang 3', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL02/4.webp', 164850, 156610, 5, 55, '1', NOW(), NOW()),
(166, 1079, 'Combo 20 bút dạ quang 4', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL02/5.webp', 164850, 156610, 5, 55, '1', NOW(), NOW()),
(167, 1079, 'Combo 20 bút dạ quang 5', 'But/But_da_quang/Combo_20_But_da_quang_FlexOffice_FO-HL02/6.webp', 164850, 156610, 5, 55, '1', NOW(), NOW()),


(168, 1080, 'Bút kim kỹ thuật Drawing Pen Thiên Long Colokit 1', 'But/But_long/But_kim_ky_thuat- Drawing_Pen_Thien_Long_Colokit/4.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(169, 1081, 'Bút lông đầu 3 màu xanh đỏ đen 1', 'But/But_long/But_long_dau_3_mau_xanh_đo_đen/4.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(170, 1082, 'Bút lông kim Beebee Thiên Long FL-04 1', 'But/But_long/But_long_kim_Beebee_Thien_Long_FL-04/4.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(171, 1082, 'Bút lông kim Beebee Thiên Long FL-04 2', 'But/But_long/But_long_kim_Beebee_Thien_Long_FL-04/5.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(172, 1083, 'Bút lông kim Thiên Long Doraemon TP-FL04DO 1', 'But/But_long/But_long_kim_Thien_Long_Doraemon_TP-FL04DO/2.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(173, 1083, 'Bút lông kim Thiên Long Doraemon TP-FL04DO 3', 'But/But_long/But_long_kim_Thien_Long_Doraemon_TP-FL04DO/5.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(174, 1084, 'Bút lông kim Thiên Long FL-04AK 1', 'But/But_long/But_long_kim_Thien_Long_FL-04AK/3.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(175, 1084, 'Bút lông kim Thiên Long FL-04AK 2', 'But/But_long/But_long_kim_Thien_Long_FL-04AK/5.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(176, 1085, 'Combo 10 chiếc bút 1', 'But/But_long/COMBO_10_Chiec_But_Long_Dau_Thien_Long_PM - 09/2.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(177, 1085, 'Combo 10 chiếc bút 2', 'But/But_long/COMBO_10_Chiec_But_Long_Dau_Thien_Long_PM - 09/3.webp', 10000, 9500, 5, 50, '1', NOW(), NOW()),
(178, 1085, 'Combo 10 chiếc bút 3', 'But/But_long/COMBO_10_Chiec_But_Long_Dau_Thien_Long_PM - 09/4.webp', 10000, 9500, 5, 50, '1', NOW(), NOW());


INSERT INTO products (product_id, name, description, category_id, brand_id, status) VALUES
(1086, 'Bìa kẹp A5 Thiên Long Flexoffice PP FO-CB012','Thông Số Kỹ Thuật.
Thương hiệu:	Flexoffice.
Trọng lượng:	169 gram.
Quy cách:	1 Bìa/túi (224 x 157 mm)
Đơn vị tính:	bìa.
Độ dày:	1.4 mm.
Chất liệu:	Nhựa PP.
Bảo quản:	Tránh xa nguồn nhiệt, dầu mỡ.
- Kiểu dáng trang nhã , sang trọng , thiết kế chắc chắn , không cong vênh , luôn giữ hồ sơ phẳng , lịch sự và tạo cám giác thoải mái khi sử dụng.
- Làm từ nhựa PP , bề mặt siêu mịn , viết êm tay . dễ dàng ghi chép , ký duyệt trên tài liệu.
- Kẹp bằng kim loại cao cấp , sáng bóng , có lớp tráng dầu chống sét hạn chế oxy hóa theo thời gian , cứng cáp không han gỉ , độ bền cao.
- Được sản xuất theo công nghệ hiện đại , đạt tiêu chuẩn quốc tế , thân thiện với môi trường .

Đặc điểm : 
- Sử dụng phù hợp với khổ giấy A5.
- Bìa cứng chắc, đường hàn có độ bền cao.
- Kẹp bền chắc có tính đàn hồi cao giúp kẹp chặt tài liệu, hồ sơ.
- Hai góc kép được bọc nhựa, giúp kẹp chặt và không làm tài liệu nhăn hoặc rách .
- Simili bọc ngoài có hoa văn đẹp. mềm mại tạo cảm giác êm tay khi ký duyệt hoặc ghi chú trên hồ sơ, tài liệu.
- Khả năng chứa 100 tờ A5.', 16, 1, '1'),
(1087, 'Bao bìa thư (Bìa kẹp)' ,'Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice.
Kích thước:	340 x 240 x 0.12 mm.
Trọng lượng:	19.8 gram.
Sức chứa:	100 tờ A4.
Tiêu chuẩn:	TCCS 0108:2019/TL-BFPP.
Màu sắc:	Trong suốt.
Chất liệu:	Nhựa PP.
Bảo quản:	Nhiệt độ: 10 ~ 55º C, Độ ẩm: 55 ~ 95% RH, Tránh xa nguồn nhiệt, dầu mỡ.
Đặc điểm sản phẩm:.

- Bìa phong bì thư A4 Travel File FO-BT002 dùng để chuyển phát, lưu trữ các tài liệu, hồ sơ,...
- Nhựa trong suốt, siêu mềm dẻo, chống nước hoàn toàn.', 16, 1, '1'),
(1088, 'Bìa còng - Bìa hồ sơ Thiên Long Flexoffice A4 - F4(Bìa kẹp)','Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice.
Kích thước:	A4 - F4.
Kích thước:	A4: 320 x 282 x 90 mm; F4: 350 x 282 x 90 mm.
Chất liệu:	Nhựa PP.
Màu sắc:	Xanh và Xanh đậm.
Còng: 	Thép không gỉ.
Độ dày: 	90 mm.
Khả năng lưu trữ:	650 tờ A4.
Bảo quản:	Để nơi thoáng mát, tránh nguồn nhiệt. Không thích hợp cho trẻ dưới 3 tuổi.
Đặc Điểm:.

Khóa và thanh kẹp giấy bằng thép chắc chắn, có lớp mạ chống oxi hóa, giữ được tính năng ổn định sau nhiều lần sử dụng.

Bìa dày dặn , cứng cáp , có thể lưu giữ tài liệu nhiều hơn .

Một bìa chứa được 650 tờ A4, giúp việc lưu giữ tài liệu, hồ sơ, báo cáo, tranh ảnh, tạp chí, catalogue, project…và có thể kết hợp với bìa lá, bìa lỗ, bìa phân trang nhanh chóng và tiện lợi hơn.

Có thể lưu được các loại bìa: Bìa lỗ, bìa kẹp nhựa,...', 16, 1, '1'),
(1089, 'Bìa còng Flexoffice 50A4 FO-BC01 (Bìa kẹp)','Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice.
Kích thước:	A4.
Quy cách:	1 Bìa/túi.
Đơn vị tính:	bìa.
Màu sắc:	Xanh, xanh đậm.
Chất liệu:	1 mặt si.
Độ dày: 	50 mm.
Khả năng lưu trữ:	330 tờ A4.
Bảo quản:	Nhiệt độ: 10 ~ 55º C, Độ ẩm: 55 ~ 95% RH, Tránh xa nguồn nhiệt, dầu mỡ.
Đặc Điểm:.

Bìa còng Thiên Long - Flexoffice 50A4 FO-BC01 có khổ A4. Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế, thuận tiện khi sử dụng.

Một mặt bìa được sản xuất từ vật liệu simili cao cấp, mặt trong phủ màng OPP.

Khóa và thanh kẹp giấy bằng thép chắc chắn, có lớp mạ chống oxi hóa, giữ được tính năng ổn định sau nhiều lần sử dụng.

Bìa dày dặn , cứng cáp , có thể lưu giữ tài liệu nhiều hơn .

Giúp việc lưu giữ tài liệu, hồ sơ, báo cáo, tranh ảnh, tạp chí, catalogue, project … nhanh chóng và tiện lợi hơn.

Có thể lưu được các loại bìa: Bìa lỗ, bìa kẹp nhựa,...', 16, 1, '1'),
(1090, 'Bìa còng (Bìa kẹp)','Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice.
Kích thước:	A4.
Quy cách:	1 Bìatúi, lưu trữ 330 tờ A4.
Đơn vị tính:	bìa.
Màu sắc:	Xanh, xanh đậm.
Chất liệu:	1 mặt si.
Độ dày: 	50 mm.
Khả năng lưu trữ:	330 tờ  A4.
Bảo quản:	Nhiệt độ 10 ~ 55º C, Độ ẩm 55 ~ 95% RH, Tránh xa nguồn nhiệt, dầu mỡ.
Đặc Điểm.

Bìa còng Thiên Long - Flexoffice 50A4 FO-BC11 có khổ A4. Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế, thuận tiện khi sử dụng.

Một mặt bìa được sản xuất từ vật liệu simili cao cấp, mặt trong phủ màng OPP.

Khóa và thanh kẹp giấy bằng thép chắc chắn, có lớp mạ chống oxi hóa, giữ được tính năng ổn định sau nhiều lần sử dụng.

Bìa dày dặn , cứng cáp , có thể lưu giữ tài liệu nhiều hơn .

Giúp việc lưu giữ tài liệu, hồ sơ, báo cáo, tranh ảnh, tạp chí, catalogue, project … nhanh chóng và tiện lợi hơn.

Có thể lưu được các loại bìa Bìa lỗ, bìa kẹp nhựa,...', 16, 1, '1'),
(1091, 'Bìa còng Flexoffice 70A4 FO-BC14 (Bìa kẹp)','Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice.
Kích thước:	F4.
Quy cách:	1 Bìa/túi.
Đơn vị tính:	bìa.
Màu sắc:	Xanh, xanh đậm.
Chất liệu:	1 mặt si.
Độ dày:	70 mm.
Khả năng lưu trữ:	500 tờ  F4.
Bảo quản:	Nhiệt độ: 10 ~ 55º C, Độ ẩm: 55 ~ 95% RH, Tránh xa nguồn nhiệt, dầu mỡ.
Đặc Điểm:

Bìa còng Thiên Long - Flexoffice 70F4 FO-BC14 có khổ F4. Sản phẩm được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế, thuận tiện khi sử dụng.

Một mặt bìa được sản xuất từ vật liệu simili cao cấp, mặt trong phủ màng OPP.

Khóa và thanh kẹp giấy bằng thép chắc chắn, có lớp mạ chống oxi hóa, giữ được tính năng ổn định sau nhiều lần sử dụng.

Bìa dày dặn , cứng cáp , có thể lưu giữ tài liệu nhiều hơn .

Giúp việc lưu giữ tài liệu, hồ sơ, báo cáo, tranh ảnh, tạp chí, catalogue, project … nhanh chóng và tiện lợi hơn.

Có thể lưu được các loại bìa: Bìa lỗ, bìa kẹp nhựa,...', 16, 1, '1'),
(1092, 'Bìa học sinh 30 A4 Thiên LongDB-002 (Bìa kẹp)','Thông Số Kỹ Thuật:.

Thương hiệu:	Flexoffice.
Trọng lượng:	210 gram.
Lưu trữ:	150 tờ A4 (80gsm).
Kích thước:	310 x 232 x 20 mm.
Chất liệu:	Nhựa PP.
Độ dày cover:	0.6 mm.
Độ dày pocket:	0.03 mm.
Tiêu chuẩn:	TCCS 077:2013/TL-BNL.
Cảnh báo:	Tránh xa nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Đặc điểm :.

- Sản phẩm Bìa lá A4 Thiên Long DB-002 được sản xuất từ nhựa PP chất lượng cao, an toàn với người sử dụng, màu sắc nhiều người yêu thích.

- Bề mặt trơn láng, hạn chế trầy xước và bám bẩn.

- Các lá được hàn trên công nghệ hàn siêu âm, có khả năng chịu ứng sức kéo cao.', 16, 1, '1'),
(1093, 'Bìa kẹp đơn Flexoffice FO-CB04','Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice.
Trọng lượng:	133 gram.
Quy cách:	1 Bìa/túi.
Đơn vị tính:	bìa.
Chất liệu:	Nhựa Mica.
Bảo quản:	Tránh xa nguồn nhiệt, dầu mỡ.
- Kiểu dáng trang nhã , sang trọng , thiết kế chắc chắn , không cong vênh , luôn giữ hồ sơ phẳng , lịch sự và tạo cám giác thoải mái khi sử dụng.
- Làm từ nhựa Mica , bề mặt siêu mịn , viết êm tay . dễ dàng ghi chép , ký duyệt trên tài liệu
- Kẹp bằng kim loại cao cấp , sáng bóng , có lớp tráng dầu chống sét hạn chế oxy hóa theo thời gian , cứng cáp không han gỉ , độ bền cao.
- Được sản xuất theo công nghệ hiện đại , đạt tiêu chuẩn quốc tế , thân thiện với môi trường .', 16, 1, '1'),
(1094, 'Bìa kẹp màu Pastel nhựa PP Thiên Long Flexoffice FO-CB03','Thông Số Kỹ Thuật.

Thương hiệu:	Flexoffice.
Trọng lượng:	169.6 gram.
Lưu trữ:	100 tờ A4.
Kích thước:	320 x 231 mm, độ dày 1.2 mm.
Chất liệu:	Nhựa PP.
Bảo quản:	Để nơi thoáng mát, tránh nguồn nhiệt. Không thích hợp cho trẻ dưới 3 tuổi.
- Kiểu dáng trang nhã với màu sắc Pastel trẻ trung, năng động, thiết kế chắc chắn, không cong vênh, luôn giữ hồ sơ phẳng, lịch sự và tạo cảm giác thoải mái khi nhìn những chữ in trên bìa để trên bàn chờ trình ký.
- Có thiết kế vị trí ghi phòng ban hạn chế việc thất lạc bìa và hồ sơ. Giúp cho không gian bàn làm việc nhìn chuyên nghiệp và màu sắc đẹp mắt hơn.
- Bìa trình ký kép màu Pastel làm từ nhựa PP, bề mặt siêu mịn, viết êm tay. Dễ dàng ghi chép, ký duyệt trên tài liệu.', 16, 1, '1'),
(1095, 'Bìa nút A4 Thiên Long Officemate FO-CBF02 họa tiết caro (Bìa kẹp)','Thông Số Kỹ Thuật.

Thương hiệu:	Officemate.
Kích thước:	340mm x 240mm.
Trọng lượng:	25 gram.
Quy cách:	12 bìa/túi PP; 25 túi PP/thùng carton (300 bìa). Lưu trữ 50 tờ A4.
Đơn vị tính:	Bìa.
Màu sắc:	Trong suốt.
Độ trong suốt:	Cao.
Độ dày: 	0.12 mm.
Bảo quản:	Nhiệt độ: 10 ~ 55º C, Độ ẩm: 55 ~ 95% RH, Tránh xa nguồn nhiệt, dầu mỡ.
Chi tiết sản phẩm:.

PHÙ HỢP CHO SINH VIÊN VÀ NHÂN VIÊN VĂN PHÒNG.
Được sản xuất theo công nghệ hiện đại, đạt tiêu chuẩn quốc tế.

Có đường hàn đẹp mắt, chắc chắn, không bavia.

Luôn giữ hồ sơ, chứng từ phẳng phiu, sạch sẽ và tạo cảm giác thoải mái khi sử dụng .

Sản phẩm có kiểu dáng hiện đại, màu sắc trang nhã dễ dàng cho việc lựa chọn màu sắc yêu thích.

Đặc điểm:.

Vật liệu PP đặc biệt chịu va đập cao.
Đường hàn chắc.
Nút có độ bền cao.
Sản phẩm có in hoa văn đẹp và sắc nét.

Lợi ích: Bìa nút FO-CBF02 được làm bằng nhựa PP không độc hại.', 16, 1, '1'),
(1096, 'Bìa nút màu Pastel F4 Thiên Long CBF-003 (Bìa kẹp)','Thông Số Kỹ Thuật:.

Thương hiệu:	Flexoffice.
Trọng lượng:	33 gram.
Lưu trữ:	125 tờ A4 (80gsm).
Kích thước:	360 x 250 mm.
Chất liệu:	Nhựa PP.
Độ dày: 	0.18 mm.
Tiêu chuẩn:	TCCS 075:2013/TL-BNU.
Cảnh báo:	Tránh xa nguồn nhiệt, hóa chất. Không thích hợp cho trẻ dưới 3 tuổi.
Đặc điểm :.

- Sản phẩm Bìa nút F4 Thiên Long CBF-003 được sản xuất từ nhựa PP chất lượng cao, an toàn với người sử dụng, màu sắc nhiều người yêu thích.

- Dùng để lưu trữ các tài liệu, hồ sơ, báo cáo, tranh ảnh...phù hợp với khổ giấy A5, A4.', 16, 1, '1'),
(1097, 'Máy tính cầm tay Flexoffice_FLEXIO_CAL-02S', 'Thông số kĩ thuật :.

Thương hiệu:	FlexOffice.
Kích thước:	146 x 103 mm.
Trọng lượng:	116g.
Quy cách:	01 cái/hộp nhỏ; 20 hộp nhỏ/hộp lớn; 4 hộp lớn/thùng.
Bảo quản;	Nơi khô ráo, tránh lửa.
Tính năng nổi bật:.

• Mẫu mã đẹp. Sản phẩm được thiết kế nhỏ gọn, vừa tay cầm tạo cảm giác vừa thoải mái vừa chắc chắn và thuận tiện khi sử dụng.

• Các phím bấm được thiết kế rộng, làm từ nhựa ABS giúp thao tác nhanh và chính xác.

• Bề mặt kim loại sáng bóng.
• Màn hình LCD rộng và sáng, hiển thị số rõ nét. Màn hình thiết kế nghiêng dễ nhìn, được làm bằng chất liệu Acrylic, hiển thị 12 chữ số.

• Bao bì làm bằng chất liệu giấy cao cấp, sang trọng, thiết kế đẹp.

• Có nhiều chức năng như tính tổng, nhớ giá trị, căn bậc 2, xóa lùi số đã nhập... rất thuận tiện.

• Có thể sử dụng 2 nguồn năng lượng: Pin và năng lượng ánh sáng.

• Sản phẩm được bảo hành 24 tháng.', 17, 1, '1'),
(1098, 'Máy tính cầm tay Flexoffice FLEXIO CAL-03S', 'Thông số kĩ thuật :.

Thương hiệu:	FlexOffice.
Kích thước:	175 x 125 mm.
Trọng lượng:	116g.
Quy cách:	01 cái/hộp nhỏ; 10 hộp nhỏ/hộp lớn; 6 hộp lớn/thùng.
Bảo quản:	Nơi khô ráo, tránh lửa.
Tính năng nổi bật:.

• Mẫu mã đẹp. Sản phẩm được thiết kế nhỏ gọn, vừa tay cầm tạo cảm giác vừa thoải mái vừa chắc chắn và thuận tiện khi sử dụng.

• Các phím bấm được thiết kế rộng, làm từ nhựa ABS giúp thao tác nhanh và chính xác.

• Bề mặt kim loại sáng bóng.
• Màn hình LCD rộng và sáng, hiển thị số rõ nét. Màn hình thiết kế nghiêng dễ nhìn, được làm bằng chất liệu Acrylic, hiển thị 12 chữ số.

• Bao bì làm bằng chất liệu giấy cao cấp, sang trọng, thiết kế đẹp.

• Có nhiều chức năng như tính tổng, nhớ giá trị, căn bậc 2, xóa lùi số đã nhập,... rất thuận tiện.

• Có thể sử dụng 2 nguồn năng lượng: Pin và năng lượng ánh sáng.

• Sản phẩm được bảo hành 24 tháng.', 17, 1, '1'),
(1099, 'Máy tính cầm tay Flexoffice FLEXIO CAL-04S', '
Thông số kĩ thuật :.

Thương hiệu	FlexOffice.
Kích thước	177 x 107 mm.
Trọng lượng	155g.
Quy cách	01 cái/hộp nhỏ; 20 hộp nhỏ/hộp lớn; 4 hộp lớn/thùng.
Bảo quản	Nơi khô ráo, tránh lửa.
Tính năng nổi bật:.

• Mẫu mã đẹp. Sản phẩm được thiết kế nhỏ gọn, vừa tay cầm tạo cảm giác vừa thoải mái vừa chắc chắn và thuận tiện khi sử dụng.

• Các phím bấm được thiết kế rộng, làm từ nhựa ABS giúp thao tác nhanh và chính xác.
• Bề mặt kim loại sáng bóng.

• Màn hình LCD rộng và sáng, hiển thị số rõ nét. Màn hình thiết kế nghiêng dễ nhìn, được làm bằng chất liệu Acrylic, hiển thị 12 chữ số.

• Bao bì làm bằng chất liệu giấy cao cấp, sang trọng, thiết kế đẹp.

• Có nhiều chức năng như tính tổng, nhớ giá trị, căn bậc 2, xóa lùi số đã nhập,... rất thuận tiện.

• Có thể sử dụng 2 nguồn năng lượng: Pin và năng lượng ánh sáng.

• Sản phẩm được bảo hành 24 tháng.', 17, 1, '1'),
(1100, 'Máy tính cầm tay Flexoffice_FLEXIO_CAL-05P', '
Thông số kĩ thuật :.

Thương hiệu	FlexOffice.
Kích thước	177 x 107 mm.
Trọng lượng	155g.
Quy cách	01 cái/hộp nhỏ; 20 hộp nhỏ/hộp lớn; 4 hộp lớn/thùng.
Bảo quản	Nơi khô ráo, tránh lửa.
Tính năng nổi bật:.

• Mẫu mã đẹp. Sản phẩm được thiết kế nhỏ gọn, vừa tay cầm tạo cảm giác vừa thoải mái vừa chắc chắn và thuận tiện khi sử dụng.

• Các phím bấm được thiết kế rộng, làm từ nhựa ABS giúp thao tác nhanh và chính xác.
• Bề mặt kim loại sáng bóng.

• Màn hình LCD rộng và sáng, hiển thị số rõ nét. Màn hình thiết kế nghiêng dễ nhìn, được làm bằng chất liệu Acrylic, hiển thị 12 chữ số.

• Bao bì làm bằng chất liệu giấy cao cấp, sang trọng, thiết kế đẹp.

• Có nhiều chức năng như tính tổng, nhớ giá trị, căn bậc 2, xóa lùi số đã nhập,... rất thuận tiện.

• Có thể sử dụng 2 nguồn năng lượng: Pin và năng lượng ánh sáng.

• Sản phẩm được bảo hành 24 tháng.', 17, 1, '1');



INSERT INTO `product_images` (`product_image_id`, `product_id`, `image_url`) VALUES
(223, 1086, 'San_pham_khac/Bia_kẹp/Bia_ kep_ A5_Thien_Long_Flexoffice_PP_FO-CB012/1.webp'),
(224, 1086, 'San_pham_khac/Bia_kẹp/Bia_ kep_ A5_Thien_Long_Flexoffice_PP_FO-CB012/2.webp'),
(225, 1087, 'San_pham_khac/Bia_kẹp/Bia_bao_thu_A4_Travel_File_Thien_Long_Flexoffice_luu_tru_100_to_A4/1.webp'),
(226, 1087, 'San_pham_khac/Bia_kẹp/Bia_bao_thu_A4_Travel_File_Thien_Long_Flexoffice_luu_tru_100_to_A4/2.webp'),
(227, 1087, 'San_pham_khac/Bia_kẹp/Bia_bao_thu_A4_Travel_File_Thien_Long_Flexoffice_luu_tru_100_to_A4/3.webp'),
(228, 1088, 'San_pham_khac/Bia_kẹp/Bia_cong - Bia_ho_ so_Thien_Long_Flexoffice_A4 - F4/1.webp'),
(229, 1088, 'San_pham_khac/Bia_kẹp/Bia_cong - Bia_ho_ so_Thien_Long_Flexoffice_A4 - F4/3.webp'),
(230, 1088, 'San_pham_khac/Bia_kẹp/Bia_cong - Bia_ho_ so_Thien_Long_Flexoffice_A4 - F4/4.webp'),
(231, 1089, 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_50A4 FO-BC01/1.webp'),
(232, 1089, 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_50A4 FO-BC01/2.webp'),
(241, 1089, 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_50A4 FO-BC01/4.webp'),
(233, 1090, 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_50A4 FO-BC11/1.webp'),
(234, 1090, 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_50A4 FO-BC11/3.webp'),
(235, 1091, 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_70F4 FO-BC14/1.jpg'),
(236, 1091, 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_70F4 FO-BC14/3.jpg'),
(237, 1092, 'San_pham_khac/Bia_kẹp/Bia_hoc_sinh_30_A4_Thien_Long_DB-002/2.webp'),
(238, 1092, 'San_pham_khac/Bia_kẹp/Bia_hoc_sinh_30_A4_Thien_Long_DB-002/3.webp'),
(239, 1092, 'San_pham_khac/Bia_kẹp/Bia_hoc_sinh_30_A4_Thien_Long_DB-002/4.webp'),
(240, 1093, 'San_pham_khac/Bia_kẹp/Bia_kep_don_Flexoffice_FO-CB04/1.webp'),
(242, 1094, 'San_pham_khac/Bia_kẹp/Bia_kep_mau_Pastel_nhua_PP_Thien_Long_Flexoffice_FO-CB03/2.webp'),
(243, 1094, 'San_pham_khac/Bia_kẹp/Bia_kep_mau_Pastel_nhua_PP_Thien_Long_Flexoffice_FO-CB03/7.webp'),
(244, 1095, 'San_pham_khac/Bia_kẹp/Bia_nut_A4_Thien_Long_Officemate_FO-CBF02_hoa_tiet_caro/2.webp'),
(246, 1096, 'San_pham_khac/Bia_kẹp/Bia_nut_mau_Pastel_F4_Thien_Long_CBF-003/1.webp'),
(247, 1096, 'San_pham_khac/Bia_kẹp/Bia_nut_mau_Pastel_F4_Thien_Long_CBF-003/3.webp'),
(248, 1096, 'San_pham_khac/Bia_kẹp/Bia_nut_mau_Pastel_F4_Thien_Long_CBF-003/5.webp'),

(249, 1097, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-02S/1.webp'),
(250, 1097, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-02S/2.webp'),
(251, 1097, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-02S/4.webp'),
(252, 1098, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-03S/1.webp'),
(253, 1098, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-03S/3.webp'),
(254, 1098, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-03S/4.webp'),
(255, 1099, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-04S/1.webp'),
(256, 1099, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-04S/2.webp'),
(257, 1099, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-04S/4.webp'),
(258, 1099, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-04S/5.webp'),
(259, 1100, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-05P/1.webp'),
(260, 1100, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-05P/2.webp'),
(261, 1100, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-05P/3.webp'),
(262, 1100, 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-05P/5.webp');




INSERT INTO `product_type` (`product_type_id`, `product_id`, `name`, `image`, `priceOld`, `priceCurrent`, `discount_price`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(180, 1086, 'Bìa kẹp A5 Thiên Long Flexoffice PP FO-CB012', 'San_pham_khac/Bia_kẹp/Bia_ kep_ A5_Thien_Long_Flexoffice_PP_FO-CB012/3.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(181, 1087, 'Bìa bao thư A4 Travel File Thiên Long Flexoffice lưu trữ 100 tờ A4', 'San_pham_khac/Bia_kẹp/Bia_bao_thu_A4_Travel_File_Thien_Long_Flexoffice_luu_tru_100_to_A4/4.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(182, 1088, 'Bìa còng - Bìa hồ sơ Thiên Long Flexoffice A4 - F4', 'San_pham_khac/Bia_kẹp/Bia_cong - Bia_ho_ so_Thien_Long_Flexoffice_A4 - F4/2.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(183, 1089, 'Bìa còng Flexoffice 50A4 FO-BC01', 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_50A4 FO-BC01/2.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(184, 1090, 'Bìa còng Flexoffice 50A4 FO-BC11', 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_50A4 FO-BC11/2.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(185, 1091, 'Bìa còng Flexoffice 70F4 FO-BC14', 'San_pham_khac/Bia_kẹp/Bia_cong_Flexoffice_70F4 FO-BC14/2.jpg', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(186, 1092, 'Bìa học sinh 30 A4 Thiên Long DB-002', 'San_pham_khac/Bia_kẹp/Bia_hoc_sinh_30_A4_Thien_Long_DB-002/1.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(187, 1093, 'Bìa kẹp đơn Flexoffice FO-CB04', 'San_pham_khac/Bia_kẹp/Bia_kep_don_Flexoffice_FO-CB04/2.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(188, 1094, 'Bìa kẹp màu Pastel 1', 'San_pham_khac/Bia_kẹp/Bia_kep_mau_Pastel_nhua_PP_Thien_Long_Flexoffice_FO-CB03/2.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(189, 1094, 'Bìa kẹp màu Pastel 2', 'San_pham_khac/Bia_kẹp/Bia_kep_mau_Pastel_nhua_PP_Thien_Long_Flexoffice_FO-CB03/3.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(190, 1094, 'Bìa kẹp màu Pastel 3', 'San_pham_khac/Bia_kẹp/Bia_kep_mau_Pastel_nhua_PP_Thien_Long_Flexoffice_FO-CB03/4.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(191, 1094, 'Bìa kẹp màu Pastel 4', 'San_pham_khac/Bia_kẹp/Bia_kep_mau_Pastel_nhua_PP_Thien_Long_Flexoffice_FO-CB03/5.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(192, 1094, 'Bìa kẹp màu Pastel 5', 'San_pham_khac/Bia_kẹp/Bia_kep_mau_Pastel_nhua_PP_Thien_Long_Flexoffice_FO-CB03/6.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(193, 1095, 'Bìa nút A4 Thiên Long Officemate FO-CBF02 hoa tiết caro', 'San_pham_khac/Bia_kẹp/Bia_nut_A4_Thien_Long_Officemate_FO-CBF02_hoa_tiet_caro/1.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(194, 1096, 'Bìa nút màu 1', 'San_pham_khac/Bia_kẹp/Bia_nut_mau_Pastel_F4_Thien_Long_CBF-003/2.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(195, 1096, 'Bìa nút màu 2', 'San_pham_khac/Bia_kẹp/Bia_nut_mau_Pastel_F4_Thien_Long_CBF-003/4.webp', 10000, 9500, 5, 100, '0', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),

(196, 1097, 'Máy tính Flexoffice FLEXIO CAL-025', 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-02S/3.webp', 100000, 95000, 5, 50, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(197, 1098, 'Máy tính Flexoffice FLEXIO CAL-035', 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-03S/2.webp', 120000, 115000, 5, 50, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(198, 1099, 'Máy tính Flexoffice FLEXIO CAL-045', 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-04S/3.webp', 130000, 125000, 5, 50, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(199, 1100, 'Máy tính Flexoffice FLEXIO CAL-05P', 'San_pham_khac/May_tinh_cam_tay/May_tinh_Flexoffice_FLEXIO_CAL-05P/4.webp', 135000, 129000, 6, 50, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00');




INSERT INTO products (product_id, name, description, category_id, brand_id, status) VALUES
(1101, 'Bút Vẽ Artdoor (Bút vẽ)', '', 11, 1, '1'),
(1102, 'Bút Chì 2B Gỗ Nusign (Bút vẽ)', '', 11, 1, '1'),
(1103, 'Bút Chì Bướm (Bút vẽ)', '', 11, 1, '1'),
(1104, 'Bút Chì Gấu Trúc (Bút vẽ)', '', 11, 1, '1'),
(1105, 'Bút Chì Gỗ Có Tẩy (Bút vẽ)', '', 11, 1, '1'),
(1106, 'Bút Chì HB Kèm Đầu Tẩy (Bút vẽ)', '', 11, 1, '1'),
(1107, 'Bút Chì Màu (Bút vẽ)', '', 11, 1, '1'),
(1108, 'Bút Chì Vẽ (Bút vẽ)', '', 11, 1, '1'),
(1109, 'Bút Gỗ (Bút vẽ)', '', 11, 1, '1'),
(1110, 'Bút Phác Thảo (Bút vẽ)', '', 11, 1, '1'),

(1111, 'Giá Campuchia (Giá-Khung vẽ)', '', 14, 1, '1'),
(1112, 'Giá để bàn (Giá-Khung vẽ)', '', 14, 1, '1'),
(1113, 'Giá gỗ (Giá-Khung vẽ)', '', 14, 1, '1'),
(1114, 'Giá gỗ để bàn (Giá-Khung vẽ)', '', 14, 1, '1'),
(1115, 'Giá sắt (Giá-Khung vẽ)', '', 14, 1, '1'),
(1116, 'Giá trắng (Giá-Khung vẽ)', '', 14, 1, '1'),

(1117, 'Cọ brushes (Khay-cọ vẽ)', '', 13, 1, '1'),
(1118, 'Cọ cao cấp (Khay-cọ vẽ)', '', 13, 1, '1'),
(1119, 'Cọ lớn (Khay-cọ vẽ)', '', 13, 1, '1'),
(1120, 'Cọ sơn (Khay-cọ vẽ)', '', 13, 1, '1'),
(1121, 'Cọ vẽ (Khay-cọ vẽ)', '', 13, 1, '1'),
(1122, 'Khay Deli (Khay-cọ vẽ)', '', 13, 3, '1'),
(1123, 'Khay gỗ (Khay-cọ vẽ)', '', 13, 1, '1'),
(1124, 'Khay nhựa (Khay-cọ vẽ)', '', 13, 1, '1'),
(1125, 'Khay pha màu (Khay-cọ vẽ)', '', 13, 1, '1'),
(1126, 'Khay pha trộn (Khay-cọ vẽ)', '', 13, 1, '1'),
(1127, 'Khay pha trong suốt (Khay-cọ vẽ)', '', 13, 1, '1'),


(1128, 'Bút acrylic (Màu vẽ)', '', 12, 1, '1'),
(1129, 'Bút không phai (Màu vẽ)', '', 12, 1, '1'),
(1130, 'Bút market (Màu vẽ)', '', 12, 1, '1'),
(1131, 'Bút market brush (Màu vẽ)', '', 12, 1, '1'),
(1132, 'Bút nước (Màu vẽ)', '', 12, 1, '1'),
(1133, 'Bút vẽ 100 màu (Màu vẽ)', '', 12, 1, '1'),
(1134, 'Bút vẽ mỹ thuật (Màu vẽ)', '', 12, 1, '1'),
(1135, 'Màu solid (Màu vẽ)', '', 12, 1, '1'),
(1136, 'Sáp (Màu vẽ)', '', 12, 1, '1'),
(1137, 'Sáp màu (Màu vẽ)', '', 12, 1, '1');


INSERT INTO `product_images` (`product_image_id`, `product_id`, `image_url`) VALUES
(263, 1101, 'Dung_cu_ve/But_ve/Artdoor/01.webp'),
(264, 1101, 'Dung_cu_ve/But_ve/Artdoor/02.webp'),
(265, 1101, 'Dung_cu_ve/But_ve/Artdoor/04.webp'),
(266, 1102, 'Dung_cu_ve/But_ve/Bút Chì 2B Gỗ Nusign/01.webp'),
(267, 1102, 'Dung_cu_ve/But_ve/Bút Chì 2B Gỗ Nusign/02.webp'),
(268, 1102, 'Dung_cu_ve/But_ve/Bút Chì 2B Gỗ Nusign/04.webp'),
(269, 1102, 'Dung_cu_ve/But_ve/Bút Chì 2B Gỗ Nusign/05.webp'),
(270, 1103, 'Dung_cu_ve/But_ve/Bút chì bướm/01.webp'),
(271, 1103, 'Dung_cu_ve/But_ve/Bút chì bướm/02.webp'),
(272, 1104, 'Dung_cu_ve/But_ve/Bút chì gấu trúc/01.webp'),
(273, 1104, 'Dung_cu_ve/But_ve/Bút chì gấu trúc/02.webp'),
(274, 1104, 'Dung_cu_ve/But_ve/Bút chì gấu trúc/04.webp'),
(275, 1105, 'Dung_cu_ve/But_ve/Bút Chì Gỗ Có Tẩy/01.webp'),
(276, 1105, 'Dung_cu_ve/But_ve/Bút Chì Gỗ Có Tẩy/02.webp'),
(277, 1106, 'Dung_cu_ve/But_ve/bút chì HB kèm đầu tẩy/01.webp'),
(278, 1106, 'Dung_cu_ve/But_ve/bút chì HB kèm đầu tẩy/02.webp'),
(279, 1106, 'Dung_cu_ve/But_ve/bút chì HB kèm đầu tẩy/04.webp'),
(280, 1106, 'Dung_cu_ve/But_ve/bút chì HB kèm đầu tẩy/05.webp'),
(281, 1107, 'Dung_cu_ve/But_ve/Bút Chì Màu/01.webp'),
(282, 1107, 'Dung_cu_ve/But_ve/Bút Chì Màu/02.webp'),
(283, 1107, 'Dung_cu_ve/But_ve/Bút Chì Màu/03.webp'),
(284, 1107, 'Dung_cu_ve/But_ve/Bút Chì Màu/04.webp'),
(285, 1107, 'Dung_cu_ve/But_ve/Bút Chì Màu/05.webp'),
(286, 1108, 'Dung_cu_ve/But_ve/Bút chì vẽ/02.webp'),
(287, 1109, 'Dung_cu_ve/But_ve/Bút gỗ/01.webp'),
(288, 1109, 'Dung_cu_ve/But_ve/Bút gỗ/03.webp'),
(289, 1109, 'Dung_cu_ve/But_ve/Bút gỗ/04.webp'),
(290, 1109, 'Dung_cu_ve/But_ve/Bút gỗ/05.webp'),
(291, 1110, 'Dung_cu_ve/But_ve/Bút phác thảo/01.webp'),
(292, 1110, 'Dung_cu_ve/But_ve/Bút phác thảo/03.webp'),
(293, 1110, 'Dung_cu_ve/But_ve/Bút phác thảo/04.webp'),
(294, 1110, 'Dung_cu_ve/But_ve/Bút phác thảo/05.webp'),

(300, 1111, 'Dung_cu_ve/Giá - Khung vẽ/Giá Campuchia/01.webp'),
(301, 1111, 'Dung_cu_ve/Giá - Khung vẽ/Giá Campuchia/03.webp'),
(302, 1112, 'Dung_cu_ve/Giá - Khung vẽ/Giá để bàn/02.webp'),
(303, 1112, 'Dung_cu_ve/Giá - Khung vẽ/Giá để bàn/03.webp'),
(304, 1112, 'Dung_cu_ve/Giá - Khung vẽ/Giá để bàn/04.webp'),
(299, 1112, 'Dung_cu_ve/Giá - Khung vẽ/Giá để bàn/05.webp'),
(305, 1113, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ/02.webp'),
(306, 1113, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ/03.webp'),
(307, 1113, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ/04.webp'),
(308, 1113, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ/05.webp'),
(309, 1114, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ để bàn/01.webp'),
(310, 1114, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ để bàn/02.webp'),
(311, 1114, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ để bàn/03.webp'),
(312, 1114, 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ để bàn/05.webp'),
(313, 1115, 'Dung_cu_ve/Giá - Khung vẽ/Giá sắt/02.webp'),
(314, 1115, 'Dung_cu_ve/Giá - Khung vẽ/Giá sắt/03.webp'),
(315, 1115, 'Dung_cu_ve/Giá - Khung vẽ/Giá sắt/04.webp'),
(316, 1115, 'Dung_cu_ve/Giá - Khung vẽ/Giá sắt/05.webp'),
(317, 1116, 'Dung_cu_ve/Giá - Khung vẽ/Giá trắng/01.webp'),


(318, 1117, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ brushes/01.webp'),
(319, 1118, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ cao cấp/01.webp'),
(320, 1118, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ cao cấp/03.webp'),
(321, 1118, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ cao cấp/04.webp'),
(322, 1118, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ cao cấp/05.webp'),
(323, 1119, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ lớn/01.webp'),
(324, 1119, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ lớn/02.webp'),
(325, 1119, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ lớn/03.webp'),
(326, 1120, 'Dung_cu_ve/Khay - Cọ vẽ/Cọ sơn/01.webp'),
(327, 1121, 'Dung_cu_ve/Khay - Cọ vẽ/Co vẽ/01.webp'),
(328, 1122, 'Dung_cu_ve/Khay - Cọ vẽ/Khay deli/01.webp'),
(329, 1122, 'Dung_cu_ve/Khay - Cọ vẽ/Khay deli/03.webp'),
(330, 1122, 'Dung_cu_ve/Khay - Cọ vẽ/Khay deli/04.webp'),
(331, 1123, 'Dung_cu_ve/Khay - Cọ vẽ/Khay gỗ/02.webp'),
(332, 1123, 'Dung_cu_ve/Khay - Cọ vẽ/Khay gỗ/03.webp'),
(333, 1123, 'Dung_cu_ve/Khay - Cọ vẽ/Khay gỗ/04.webp'),
(334, 1124, 'Dung_cu_ve/Khay - Cọ vẽ/Khay nhựa/02.webp'),
(335, 1124, 'Dung_cu_ve/Khay - Cọ vẽ/Khay nhựa/03.webp'),
(336, 1125, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha màu/02.webp'),
(337, 1125, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha màu/03.webp'),
(338, 1125, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha màu/04.webp'),
(339, 1126, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trộn/01.webp'),
(340, 1126, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trộn/02.webp'),
(341, 1126, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trộn/03.webp'),
(342, 1127, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trong suốt/02.webp'),
(343, 1127, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trong suốt/03.webp'),
(344, 1127, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trong suốt/04.webp'),
(345, 1127, 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trong suốt/05.webp'),


(350, 1128, 'Dung_cu_ve/Màu vẽ/Bút acrylic/01.webp'),
(351, 1128, 'Dung_cu_ve/Màu vẽ/Bút acrylic/02.webp'),
(352, 1128, 'Dung_cu_ve/Màu vẽ/Bút acrylic/04.webp'),
(353, 1129, 'Dung_cu_ve/Màu vẽ/Bút không phai/01.webp'),
(354, 1129, 'Dung_cu_ve/Màu vẽ/Bút không phai/02.webp'),
(355, 1129, 'Dung_cu_ve/Màu vẽ/Bút không phai/03.webp'),
(356, 1129, 'Dung_cu_ve/Màu vẽ/Bút không phai/04.webp'),
(357, 1130, 'Dung_cu_ve/Màu vẽ/Bút market/02.webp'),
(358, 1130, 'Dung_cu_ve/Màu vẽ/Bút market/03.webp'),
(359, 1130, 'Dung_cu_ve/Màu vẽ/Bút market/04.webp'),
(360, 1130, 'Dung_cu_ve/Màu vẽ/Bút market/05.webp'),
(361, 1130, 'Dung_cu_ve/Màu vẽ/Bút market/06.webp'),
(362, 1131, 'Dung_cu_ve/Màu vẽ/Bút market brush/01.webp'),
(363, 1131, 'Dung_cu_ve/Màu vẽ/Bút market brush/02.webp'),
(364, 1131, 'Dung_cu_ve/Màu vẽ/Bút market brush/03.webp'),
(366, 1131, 'Dung_cu_ve/Màu vẽ/Bút market brush/05.webp'),
(367, 1132, 'Dung_cu_ve/Màu vẽ/Bút nước/01.webp'),
(368, 1132, 'Dung_cu_ve/Màu vẽ/Bút nước/02.webp'),
(370, 1132, 'Dung_cu_ve/Màu vẽ/Bút nước/04.webp'),
(371, 1132, 'Dung_cu_ve/Màu vẽ/Bút nước/05.webp'),
(372, 1133, 'Dung_cu_ve/Màu vẽ/Bút vẽ 100 màu/02.webp'),
(373, 1133, 'Dung_cu_ve/Màu vẽ/Bút vẽ 100 màu/03.webp'),
(374, 1134, 'Dung_cu_ve/Màu vẽ/Bút vẽ mỹ thuật/01.webp'),
(375, 1134, 'Dung_cu_ve/Màu vẽ/Bút vẽ mỹ thuật/03.webp'),
(376, 1135, 'Dung_cu_ve/Màu vẽ/Màu solid/02.webp'),
(377, 1135, 'Dung_cu_ve/Màu vẽ/Màu solid/03.webp'),
(378, 1135, 'Dung_cu_ve/Màu vẽ/Màu solid/04.webp'),
(379, 1135, 'Dung_cu_ve/Màu vẽ/Màu solid/05.webp'),
(380, 1135, 'Dung_cu_ve/Màu vẽ/Màu solid/06.webp'),
(381, 1136, 'Dung_cu_ve/Màu vẽ/Sáp/01.webp'),
(382, 1136, 'Dung_cu_ve/Màu vẽ/Sáp/02.webp'),
(384, 1136, 'Dung_cu_ve/Màu vẽ/Sáp/04.webp'),
(385, 1137, 'Dung_cu_ve/Màu vẽ/Sáp màu/01.webp'),
(387, 1137, 'Dung_cu_ve/Màu vẽ/Sáp màu/03.webp'),
(388, 1137, 'Dung_cu_ve/Màu vẽ/Sáp màu/04.webp'),
(389, 1137, 'Dung_cu_ve/Màu vẽ/Sáp màu/05.webp');



INSERT INTO `product_type` (`product_type_id`, `product_id`, `name`, `image`, `priceOld`, `priceCurrent`, `discount_price`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(202, 1101, 'Bút Vẽ Artdoor 1', 'Dung_cu_ve/But_ve/Artdoor/03.webp', 10000, 9500, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(203, 1101, 'Bút Vẽ Artdoor 2', 'Dung_cu_ve/But_ve/Artdoor/05.webp',  10000, 9500, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(204, 1102, 'Bút Chì 2B Gỗ Nusign', 'Dung_cu_ve/But_ve/Bút Chì 2B Gỗ Nusign/03.webp', 10000, 9500, 5, 100, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(205, 1103, 'Bút Chì Bướm', 'Dung_cu_ve/But_ve/Bút chì bướm/03.webp',  10000, 9500, 5, 90, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(206, 1104, 'Bút Chì Gấu Trúc', 'Dung_cu_ve/But_ve/Bút chì gấu trúc/03.webp',  10000, 9500, 5, 80, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(207, 1105, 'Bút Chì Gỗ Có Tẩy 1', 'Dung_cu_ve/But_ve/Bút Chì Gỗ Có Tẩy/03.webp', 10000, 9500, 5, 70, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(208, 1105, 'Bút Chì Gỗ Có Tẩy 2', 'Dung_cu_ve/But_ve/Bút Chì Gỗ Có Tẩy/04.webp', 10000, 9500, 5, 70, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(209, 1105, 'Bút Chì Gỗ Có Tẩy 3', 'Dung_cu_ve/But_ve/Bút Chì Gỗ Có Tẩy/05.webp', 10000, 9500, 5, 70, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(210, 1106, 'Bút Chì HB Kèm Đầu Tẩy', 'Dung_cu_ve/But_ve/bút chì HB kèm đầu tẩy/03.webp', 10000, 9500, 5, 60, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(211, 1107, 'Bút Chì Màu', 'Dung_cu_ve/But_ve/Bút Chì Màu/06.webp',  10000, 9500, 5, 120, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(212, 1108, 'Bút Chì Vẽ', 'Dung_cu_ve/But_ve/Bút chì vẽ/02.webp',  10000, 9500, 5, 75, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(213, 1109, 'Bút Gỗ', 'Dung_cu_ve/But_ve/Bút gỗ/03.webp',  10000, 9500, 5, 85, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(214, 1110, 'Bút Phác Thảo', 'Dung_cu_ve/But_ve/Bút phác thảo/02.webp',  10000, 9500, 5, 65, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),

(215, 1111, 'Giá Campuchia', 'Dung_cu_ve/Giá - Khung vẽ/Giá Campuchia/02.webp', 200000, 190000, 5, 30, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(216, 1112, 'Giá để bàn','Dung_cu_ve/Giá - Khung vẽ/Giá để bàn/01.webp', 200000, 190000, 5, 25, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(217, 1113, 'Giá gỗ 1', 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ/01.webp', 200000, 190000, 5,  20, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(201, 1113, 'Giá gỗ 2', 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ/02.webp', 200000, 190000, 5,  20, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(218, 1114, 'Giá gỗ để bàn', 'Dung_cu_ve/Giá - Khung vẽ/Giá gỗ để bàn/04.webp', 200000, 190000, 5,  15, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(219, 1115, 'Giá sắt', 'Dung_cu_ve/Giá - Khung vẽ/Giá sắt/01.webp', 200000, 190000, 5, 18, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),
(220, 1116, 'Giá trắng', 'Dung_cu_ve/Giá - Khung vẽ/Giá trắng/02.webp', 200000, 190000, 5, 12, '1', '2025-04-24 00:00:00', '2025-04-24 00:00:00'),

(222, 1117, 'Cọ brushes', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ brushes/02.webp', 200000, 190000, 5, 100, '1', NOW(), NOW()),
(223, 1118, 'Cọ cao cấp', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ cao cấp/02.webp', 50000, 45000, 10, 80, '1', NOW(), NOW()),
(224, 1119, 'Cọ lớn', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ lớn/04.webp', 40000, 38000, 5, 120, '1', NOW(), NOW()),
(225, 1120, 'Cọ sơn 1', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ sơn/den.webp', 40000, 38000, 5, 90, '1', NOW(), NOW()),
(226, 1120, 'Cọ sơn 2', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ sơn/hong.webp', 40000, 38000, 5, 90, '1', NOW(), NOW()),
(227, 1120, 'Cọ sơn 3', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ sơn/trang.webp', 40000, 38000, 5, 90, '1', NOW(), NOW()),
(228, 1121, 'Cọ vẽ 1', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ vẽ/02 Xanh.webp', 40000, 38000, 5, 75, '1', NOW(), NOW()),
(229, 1121, 'Cọ vẽ 2', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ vẽ/03 Hồng.webp', 40000, 38000, 5, 75, '1', NOW(), NOW()),
(230, 1121, 'Cọ vẽ 3', 'Dung_cu_ve/Khay - Cọ vẽ/Cọ vẽ/04 Xanh lá.webp', 40000, 38000, 5, 75, '1', NOW(), NOW()),
(231, 1122, 'Khay Deli', 'Dung_cu_ve/Khay - Cọ vẽ/Khay deli/02.webp', 40000, 38000, 5, 75, '1', NOW(), NOW()),
(232, 1123, 'Khay gỗ', 'Dung_cu_ve/Khay - Cọ vẽ/Khay gỗ/01.webp', 40000, 38000, 5, 60, '1', NOW(), NOW()),
(233, 1124, 'Khay nhựa', 'Dung_cu_ve/Khay - Cọ vẽ/Khay nhựa/01.webp', 40000, 38000, 5, 150, '1', NOW(), NOW()),
(234, 1125, 'Khay pha màu', 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha màu/01.webp',40000, 38000, 5, 100, '1', NOW(), NOW()),
(235, 1126, 'Khay pha trộn 1', 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trộn/03.webp',40000, 38000, 5, 90, '1', NOW(), NOW()),
(236, 1126, 'Khay pha trộn 2', 'Dung_cu_ve/Khay - Cọ vẽ/Khay pha trộn/05.webp',40000, 38000, 5, 90, '1', NOW(), NOW()),
(237, 1127, 'Khay pha trong suốt', 'Dung_cu_ve/Khay - Cọ vẽ/Khay trong suốt/01.webp', 40000, 38000, 5, 70, '1', NOW(), NOW()),

(340, 1128, 'Bút acrylic', 'Dung_cu_ve/Màu vẽ/Bút acrylic/02.webp', 500000, 475000, 5, 47, '1', '2025-04-24 15:51:06', '2025-04-24 15:51:06'),
(341, 1129, 'Bút không phai', 'Dung_cu_ve/Màu vẽ/Bút không phai/03.webp',  500000, 475000, 5, 29, '1', '2025-04-24 15:51:06', '2025-04-24 15:51:06'),
(342, 1130, 'Bút market', 'Dung_cu_ve/Màu vẽ/Bút market/03.webp', 90000, 85000, 5, 40, '1', NOW(), NOW()),
(343, 1131, 'Bút market brush', 'Dung_cu_ve/Màu vẽ/Bút market brush/04.webp', 110000, 104500, 5, 35, '1', NOW(), NOW()),
(344, 1132, 'Bút nước', 'Dung_cu_ve/Màu vẽ/Bút nước/02.webp', 90000, 85000, 10000, 45, '1', NOW(), NOW()),
(345, 1133, 'Bút vẽ 100 màu', 'Dung_cu_ve/Màu vẽ/Bút vẽ 100 màu/01.webp', 140000, 133000, 5, 25, '1', NOW(), NOW()),
(346, 1134, 'Bút vẽ mỹ thuật', 'Dung_cu_ve/Màu vẽ/Bút vẽ mĩ thuật/02.webp', 130000, 123500, 5, 30, '1', NOW(), NOW()),
(347, 1135, 'Màu solid', 'Dung_cu_ve/Màu vẽ/Màu solid/01.webp', 115000, 109250, 5, 40, '1', NOW(), NOW()),
(348, 1136, 'Sáp', 'Dung_cu_ve/Màu vẽ/Sáp/02.webp', 100000, 95000, 5, 38, '1', NOW(), NOW()),
(349, 1137, 'Sáp màu', 'Dung_cu_ve/Màu vẽ/Sáp màu/02.webp', 120000, 114000, 5, 32, '1', NOW(), NOW());



INSERT INTO products (product_id, name, description, category_id, brand_id, status) VALUES
(1138, 'Giấy note ghi chú vuông', '', 8, 1, '1'),
(1139, 'Giấy note, giấy ghi chú', '', 8, 1, '1'),
(1140, 'Giấy note capybara', '', 8, 1, '1'),
(1141, 'Giấy note cơ bản', '', 8, 1, '1'),
(1142, 'Giấy note cô gái', '', 8, 1, '1'),
(1143, 'Giấy note dreamy', '', 8, 1, '1'),
(1144, 'Giấy note gấu thỏ mèo', '', 8, 1, '1'),
(1145, 'Giấy note hình thú', '', 8, 1, '1'),
(1146, 'Giấy note thanh lịch', '', 8, 1, '1'),
(1147, 'Giấy note trong suốt', '', 8, 1, '1'),

(1148, 'Nhãn cute (Nhãn vở nhãn tên)', '', 10, 1, '1'),
(1149, 'Nhãn hoa (Nhãn vở nhãn tên)', '', 10, 1, '1'),
(1150, 'Nhãn hottrend (Nhãn vở nhãn tên)', '', 10, 1, '1'),
(1151, 'Nhãn khủng long (Nhãn vở nhãn tên)', '', 10, 1, '1'),
(1152, 'Nhãn nơ (Nhãn vở nhãn tên)', '', 10, 1, '1'),
(1153, 'Nhãn shark (Nhãn vở nhãn tên)', '', 10, 1, '1'),
(1154, 'Nhãn thú (Nhãn vở nhãn tên)', '', 10, 1, '1'),
(1155, 'Nhãn vở hs (Nhãn vở nhãn tên)', '', 10, 1, '1'),

(1156, 'Sổ chân mèo', '', 7, 1, '1'),
(1157, 'Sổ còng', '', 7, 1, '1'),
(1158, 'Sổ còng KNOTE', '', 7, 1, '1'),
(1159, 'Sổ còng sơn mài', '', 7, 1, '1'),
(1160, 'Sổ hoa tím', '', 7, 1, '1'),
(1161, 'Sổ tặng bút', '', 7, 1, '1'),
(1162, 'Sổ tay capybara', '', 7, 1, '1'),
(1163, 'Sổ tay mini', '', 7, 1, '1'),
(1164, 'Sổ tay mini cute', '', 7, 1, '1'),
(1165, 'Sổ tím', '', 7, 1, '1'),

(1166, 'Vở 4 mùa', '', 9, 1, '1'),
(1167, 'Vở ABC', '', 9, 1, '1'),
(1168, 'Vở bạn nhỏ', '', 9, 1, '1'),
(1169, 'Vở Gradient', '', 9, 1, '1'),
(1170, 'Vở học sinh', '', 9, 1, '1'),
(1171, 'Vở Oxygen', '', 9, 1, '1');

INSERT INTO `product_images` (`product_image_id`, `product_id`, `image_url`) VALUES
(392, 1138, 'san_pham_ve_giay/Giấy note/Giấy note ghi chú vuông/01.webp'),
(393, 1138, 'san_pham_ve_giay/Giấy note/Giấy note ghi chú vuông/03.webp'),
(394, 1138, 'san_pham_ve_giay/Giấy note/Giấy note ghi chú vuông/04.webp'),
(395, 1138, 'san_pham_ve_giay/Giấy note/Giấy note ghi chú vuông/05.webp'),
(396, 1138, 'san_pham_ve_giay/Giấy note/Giấy note ghi chú vuông/06.webp'),
(397, 1139, 'san_pham_ve_giay/Giấy note/Giấy note, giấy ghi chú/01.webp'),
(398, 1139, 'san_pham_ve_giay/Giấy note/Giấy note, giấy ghi chú/02.webp'),
(399, 1139, 'san_pham_ve_giay/Giấy note/Giấy note, giấy ghi chú/03.webp'),
(400, 1139, 'san_pham_ve_giay/Giấy note/Giấy note, giấy ghi chú/05.webp'),
(401, 1139, 'san_pham_ve_giay/Giấy note/Giấy note, giấy ghi chú/06.webp'),
(402, 1140, 'san_pham_ve_giay/Giấy note/Note capybara/01.webp'),
(403, 1140, 'san_pham_ve_giay/Giấy note/Note capybara/03.webp'),
(404, 1140, 'san_pham_ve_giay/Giấy note/Note capybara/04.webp'),
(405, 1141, 'san_pham_ve_giay/Giấy note/Note cơ bản/01.webp'),
(406, 1142, 'san_pham_ve_giay/Giấy note/Note cô gái/02.webp'),
(407, 1142, 'san_pham_ve_giay/Giấy note/Note cô gái/04.webp'),
(408, 1143, 'san_pham_ve_giay/Giấy note/Note dreamy/01.webp'),
(409, 1143, 'san_pham_ve_giay/Giấy note/Note dreamy/02.webp'),
(410, 1143, 'san_pham_ve_giay/Giấy note/Note dreamy/03.webp'),
(411, 1144, 'san_pham_ve_giay/Giấy note/Note gấu thỏ mèo/02.webp'),
(412, 1144, 'san_pham_ve_giay/Giấy note/Note gấu thỏ mèo/03.webp'),
(413, 1144, 'san_pham_ve_giay/Giấy note/Note gấu thỏ mèo/04.webp'),
(414, 1144, 'san_pham_ve_giay/Giấy note/Note gấu thỏ mèo/05.webp'),
(415, 1145, 'san_pham_ve_giay/Giấy note/Note hình thú/01.webp'),
(416, 1145, 'san_pham_ve_giay/Giấy note/Note hình thú/02.webp'),
(417, 1145, 'san_pham_ve_giay/Giấy note/Note hình thú/03.webp'),
(418, 1146, 'san_pham_ve_giay/Giấy note/Note thanh lịch/01.webp'),
(419, 1147, 'san_pham_ve_giay/Giấy note/Note trong suốt/02.webp'),
(420, 1147, 'san_pham_ve_giay/Giấy note/Note trong suốt/03.webp'),
(421, 1147, 'san_pham_ve_giay/Giấy note/Note trong suốt/04.webp'),

(422, 1148, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn cute/01.webp'),
(423, 1148, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn cute/02.webp'),
(424, 1148, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn cute/04.webp'),
(425, 1149, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hoa/02.webp'),
(426, 1149, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hoa/03.webp'),
(427, 1150, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hottrend/01.webp'),
(428, 1151, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn khủng long/01.webp'),
(429, 1152, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn nơ/01.webp'),
(430, 1153, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn shark/01.webp'),
(431, 1154, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn thú/01.webp'),
(432, 1155, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn vở hs/02.webp'),
(433, 1155, 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn vở hs/03.webp'),

(435, 1156, 'san_pham_ve_giay/Sổ các loại/Sổ chân mèo/01.webp'),
(436, 1157, 'san_pham_ve_giay/Sổ các loại/Sổ còng/01.webp'),
(437, 1158, 'san_pham_ve_giay/Sổ các loại/Sổ còng KNOTE/02.webp'),
(438, 1158, 'san_pham_ve_giay/Sổ các loại/Sổ còng KNOTE/03.webp'),
(439, 1158, 'san_pham_ve_giay/Sổ các loại/Sổ còng KNOTE/04.webp'),
(440, 1158, 'san_pham_ve_giay/Sổ các loại/Sổ còng KNOTE/05.webp'),
(441, 1159, 'san_pham_ve_giay/Sổ các loại/Sổ còng sơn mài/01.webp'),
(442, 1159, 'san_pham_ve_giay/Sổ các loại/Sổ còng sơn mài/03.webp'),
(443, 1160, 'san_pham_ve_giay/Sổ các loại/Sổ hoa tím/01.webp'),
(445, 1160, 'san_pham_ve_giay/Sổ các loại/Sổ hoa tím/03.webp'),
(446, 1160, 'san_pham_ve_giay/Sổ các loại/Sổ hoa tím/04.webp'),
(447, 1160, 'san_pham_ve_giay/Sổ các loại/Sổ hoa tím/05.webp'),
(448, 1161, 'san_pham_ve_giay/Sổ các loại/Sổ tặng bút/01.webp'),
(449, 1162, 'san_pham_ve_giay/Sổ các loại/Sổ tay capybara/02.webp'),
(450, 1162, 'san_pham_ve_giay/Sổ các loại/Sổ tay capybara/03.webp'),
(451, 1163, 'san_pham_ve_giay/Sổ các loại/Sổ tay mini/01.webp'),
(452, 1163, 'san_pham_ve_giay/Sổ các loại/Số tay mini cute/05.webp'),
(453, 1164, 'san_pham_ve_giay/Sổ các loại/Sổ tim/01.webp'),
(454, 1164, 'san_pham_ve_giay/Sổ các loại/Sổ tim/02.webp'),
(455, 1165, 'san_pham_ve_giay/Sổ các loại/Sổ tim/03.webp'),

(456, 1166, 'san_pham_ve_giay/Vở/Vở 4 mùa/01.webp'),
(457, 1166, 'san_pham_ve_giay/Vở/Vở 4 mùa/03.webp'),
(458, 1166, 'san_pham_ve_giay/Vở/Vở 4 mùa/04.webp'),
(459, 1166, 'san_pham_ve_giay/Vở/Vở 4 mùa/05.webp'),
(460, 1167, 'san_pham_ve_giay/Vở/Vở ABC/01.webp'),
(461, 1168, 'san_pham_ve_giay/Vở/Vở bạn nhỏ/01.webp'),
(462, 1168, 'san_pham_ve_giay/Vở/Vở bạn nhỏ/02.webp'),
(463, 1168, 'san_pham_ve_giay/Vở/Vở bạn nhỏ/03.webp'),
(464, 1169, 'san_pham_ve_giay/Vở/Vở Gradient/01.webp'),
(465, 1170, 'san_pham_ve_giay/Vở/Vở học sinh/02.webp'),
(466, 1170, 'san_pham_ve_giay/Vở/Vở học sinh/03.webp'),
(467, 1171, 'san_pham_ve_giay/Vở/Vở Oxygen/02.webp'),
(468, 1171, 'san_pham_ve_giay/Vở/Vở Oxygen/03.webp'),
(469, 1171, 'san_pham_ve_giay/Vở/Vở Oxygen/04.webp');



INSERT INTO `product_type` (`product_type_id`, `product_id`, `name`, `image`, `priceOld`, `priceCurrent`, `discount_price`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(352, 1138, 'Giấy note ghi chú vuông', 'san_pham_ve_giay/Giấy note/Giấy note ghi chú vuông/02.webp', 44500, 44000, 5, 100, '1', NOW(), NOW()),
(353, 1139, 'Giấy note, giấy ghi chú', 'san_pham_ve_giay/Giấy note/Giấy note, giấy ghi chú/04.webp', 42500, 42000, 5, 90, '1', NOW(), NOW()),
(354, 1140, 'Note capybara', 'san_pham_ve_giay/Giấy note/Note capybara/02.webp', 43500, 43000, 5, 80, '1', NOW(), NOW()),
(355, 1141, 'Note cơ bản 1', 'san_pham_ve_giay/Giấy note/Note cơ bản/02.webp', 35500, 35000, 5, 120, '1', NOW(), NOW()),
(356, 1141, 'Note cơ bản 2', 'san_pham_ve_giay/Giấy note/Note cơ bản/03.webp', 35500, 35000, 5, 120, '1', NOW(), NOW()),
(357, 1141, 'Note cơ bản 3', 'san_pham_ve_giay/Giấy note/Note cơ bản/04.webp', 35500, 35000, 5, 120, '1', NOW(), NOW()),
(358, 1141, 'Note cơ bản 4', 'san_pham_ve_giay/Giấy note/Note cơ bản/05.webp', 35500, 35000, 5, 120, '1', NOW(), NOW()),
(359, 1141, 'Note cơ bản 5', 'san_pham_ve_giay/Giấy note/Note cơ bản/06.webp', 35500, 35000, 5, 120, '1', NOW(), NOW()),
(360, 1142, 'Note cô gái 6', 'san_pham_ve_giay/Giấy note/Note cô gái/02.webp', 41500, 41000, 5, 85, '1', NOW(), NOW()),
(361, 1142, 'Note cô gái 7', 'san_pham_ve_giay/Giấy note/Note cô gái/03.webp', 41500, 41000, 5, 85, '1', NOW(), NOW()),
(362, 1142, 'Note cô gái 8', 'san_pham_ve_giay/Giấy note/Note cô gái/05.webp', 41500, 41000, 5, 85, '1', NOW(), NOW()),
(363, 1142, 'Note cô gái 9', 'san_pham_ve_giay/Giấy note/Note cô gái/06.webp', 41500, 41000, 5, 85, '1', NOW(), NOW()),
(364, 1143, 'Note dreamy', 'san_pham_ve_giay/Giấy note/Note dreamy/06.webp', 43500, 43000, 5, 75, '1', NOW(), NOW()),
(365, 1144, 'Note gấu thỏ mèo', 'san_pham_ve_giay/Giấy note/Note gấu thỏ mèo/01.webp', 44500, 44000, 5, 65, '1', NOW(), NOW()),
(366, 1145, 'Note hình thú', 'san_pham_ve_giay/Giấy note/Note hình thú/04.webp', 46500, 46000, 5, 60, '1', NOW(), NOW()),
(367, 1146, 'Note thanh lịch 1', 'san_pham_ve_giay/Giấy note/Note thanh lịch/02.webp', 45500, 45000, 5, 70, '1', NOW(), NOW()),
(368, 1146, 'Note thanh lịch 2', 'san_pham_ve_giay/Giấy note/Note thanh lịch/03.webp', 45500, 45000, 5, 70, '1', NOW(), NOW()),
(369, 1146, 'Note thanh lịch 3', 'san_pham_ve_giay/Giấy note/Note thanh lịch/04.webp', 45500, 45000, 5, 70, '1', NOW(), NOW()),
(370, 1146, 'Note thanh lịch 4', 'san_pham_ve_giay/Giấy note/Note thanh lịch/05.webp', 45500, 45000, 5, 70, '1', NOW(), NOW()),
(371, 1147, 'Note trong suốt 5', 'san_pham_ve_giay/Giấy note/Note trong suốt/01.webp', 48500, 48000, 5, 68, '1', NOW(), NOW()),

(373, 1148, 'Nhãn cute', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn cute/03.webp', 25500, 25000, 5, 100, '1', NOW(), NOW()),
(374, 1149, 'Nhãn hoa', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hoa/01.webp', 24500, 24000, 5, 95, '1', NOW(), NOW()),
(375, 1150, 'Nhãn hottrend màu cam', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hottrend/02.webp', 26500, 26000, 5, 90, '1', NOW(), NOW()),
(376, 1150, 'Nhãn hottrend màu tím', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hottrend/03.webp', 26500, 26000, 5, 90, '1', NOW(), NOW()),
(377, 1150, 'Nhãn hottrend màu xanh dương', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hottrend/05.webp', 26500, 26000, 5, 90, '1', NOW(), NOW()),
(378, 1150, 'Nhãn hottrend màu xanh dương nhạt', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hottrend/06.webp', 26500, 26000, 5, 90, '1', NOW(), NOW()),
(379, 1150, 'Nhãn hottrend màu hồng', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn hottrend/04.webp', 26500, 26000, 5, 90, '1', NOW(), NOW()),
(380, 1151, 'Nhãn khủng long', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn khủng long/02.webp', 27500, 27000, 5, 80, '1', NOW(), NOW()),
(381, 1152, 'Nhãn nơ màu xanh', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn nơ/02.webp', 25500, 25000, 5, 88, '1', NOW(), NOW()),
(382, 1152, 'Nhãn nơ màu xám', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn nơ/03.webp', 25500, 25000, 5, 88, '1', NOW(), NOW()),
(383, 1152, 'Nhãn nơ màu tím', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn nơ/04.webp', 25500, 25000, 5, 88, '1', NOW(), NOW()),
(384, 1152, 'Nhãn nơ màu hồng', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn nơ/05.webp', 25500, 25000, 5, 88, '1', NOW(), NOW()),
(385, 1153, 'Nhãn shark', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn shark/01.webp', 26500, 26000, 5, 85, '1', NOW(), NOW()),
(386, 1153, 'Nhãn shark', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn shark/02.webp', 26500, 26000, 5, 85, '1', NOW(), NOW()),
(387, 1154, 'Nhãn thú 1', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn thú/01.webp', 24500, 24000, 5, 82, '1', NOW(), NOW()),
(388, 1154, 'Nhãn thú 2', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn thú/02.webp', 24500, 24000, 5, 82, '1', NOW(), NOW()),
(389, 1154, 'Nhãn thú 3', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn thú/03.webp', 24500, 24000, 5, 82, '1', NOW(), NOW()),
(390, 1154, 'Nhãn thú 4', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn thú/04.webp', 24500, 24000, 5, 82, '1', NOW(), NOW()),
(391, 1154, 'Nhãn thú 5', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn thú/05.webp', 24500, 24000, 5, 82, '1', NOW(), NOW()),
(392, 1155, 'Nhãn vở hs', 'san_pham_ve_giay/Nhãn vở - Nhãn tên/Nhãn vở hs/01.webp', 25500, 25000, 5, 98, '1', NOW(), NOW()),

(395, 1156, 'Sổ chân mèo', 'san_pham_ve_giay/Sổ các loại/Sổ chân mèo/02.webp', 25500, 25000, 5, 100, '1', NOW(), NOW()),
(396, 1156, 'Sổ chân mèo', 'san_pham_ve_giay/Sổ các loại/Sổ chân mèo/03.webp', 25500, 25000, 5, 100, '1', NOW(), NOW()),
(397, 1156, 'Sổ chân mèo', 'san_pham_ve_giay/Sổ các loại/Sổ chân mèo/04.webp', 25500, 25000, 5, 100, '1', NOW(), NOW()),
(398, 1156, 'Sổ chân mèo', 'san_pham_ve_giay/Sổ các loại/Sổ chân mèo/05.webp', 25500, 25000, 5, 100, '1', NOW(), NOW()),
(399, 1157, 'Sổ còng xanh dương', 'san_pham_ve_giay/Sổ các loại/Sổ còng/02.webp', 26500, 26000, 5, 98, '1', NOW(), NOW()),
(400, 1157, 'Sổ còng hông', 'san_pham_ve_giay/Sổ các loại/Sổ còng/03.webp', 26500, 26000, 5, 98, '1', NOW(), NOW()),
(401, 1158, 'Sổ còng KNOTE 1', 'san_pham_ve_giay/Sổ các loại/Sổ còng KNOTE/01.webp', 27500, 27000, 5, 92, '1', NOW(), NOW()),
(402, 1158, 'Sổ còng KNOTE 2', 'san_pham_ve_giay/Sổ các loại/Sổ còng KNOTE/04.webp', 27500, 27000, 5, 92, '1', NOW(), NOW()),
(403, 1159, 'Sổ còng sơn mài tím', 'san_pham_ve_giay/Sổ các loại/Sổ còng sơn mài/tim.webp', 28500, 28000, 5, 85, '1', NOW(), NOW()),
(404, 1159, 'Sổ còng sơn mài trắng', 'san_pham_ve_giay/Sổ các loại/Sổ còng sơn mài/trang.webp', 28500, 28000, 5, 85, '1', NOW(), NOW()),
(405, 1159, 'Sổ còng sơn mài xanh lá', 'san_pham_ve_giay/Sổ các loại/Sổ còng sơn mài/xanh.webp', 28500, 28000, 5, 85, '1', NOW(), NOW()),
(406, 1159, 'Sổ còng sơn mài xanh dương', 'san_pham_ve_giay/Sổ các loại/Sổ còng sơn mài/xanhDuong.webp', 28500, 28000, 5, 85, '1', NOW(), NOW()),
(407, 1160, 'Sổ hoa tím', 'san_pham_ve_giay/Sổ các loại/Sổ hoa tím/02.webp', 26500, 26000, 5, 88, '1', NOW(), NOW()),
(408, 1161, 'Sổ tặng bút đen', 'san_pham_ve_giay/Sổ các loại/Sổ tặng bút/02.webp', 27500, 27000, 5, 90, '1', NOW(), NOW()),
(409, 1161, 'Sổ tặng bút xanh lá', 'san_pham_ve_giay/Sổ các loại/Sổ tặng bút/03.webp', 27500, 27000, 5, 90, '1', NOW(), NOW()),
(410, 1161, 'Sổ tặng bút hồng', 'san_pham_ve_giay/Sổ các loại/Sổ tặng bút/04.webp', 27500, 27000, 5, 90, '1', NOW(), NOW()),
(411, 1161, 'Sổ tặng bút xanh dương', 'san_pham_ve_giay/Sổ các loại/Sổ tặng bút/05.webp', 27500, 27000, 5, 90, '1', NOW(), NOW()),
(412, 1161, 'Sổ tặng bút xám', 'san_pham_ve_giay/Sổ các loại/Sổ tặng bút/06.webp', 27500, 27000, 5, 90, '1', NOW(), NOW()),
(413, 1162, 'Sổ tay capybara', 'san_pham_ve_giay/Sổ các loại/Sổ tay capybara/01.webp', 25500, 25000, 5, 80, '1', NOW(), NOW()),
(414, 1163, 'Sổ tay mini vịt bơi', 'san_pham_ve_giay/Sổ các loại/Sổ tay mini/01.webp', 26500, 26000, 5, 78, '1', NOW(), NOW()),
(415, 1163, 'Sổ tay mini phi hành gia', 'san_pham_ve_giay/Sổ các loại/Sổ tay mini/02.webp', 26500, 26000, 5, 78, '1', NOW(), NOW()),
(416, 1163, 'Sổ tay mini hành tinh', 'san_pham_ve_giay/Sổ các loại/Sổ tay mini/03.webp', 26500, 26000, 5, 78, '1', NOW(), NOW()),
(417, 1163, 'Sổ tay mini khủng long', 'san_pham_ve_giay/Sổ các loại/Sổ tay mini/04.webp', 26500, 26000, 5, 78, '1', NOW(), NOW()),
(418, 1163, 'Sổ tay mini pony', 'san_pham_ve_giay/Sổ các loại/Sổ tay mini/05.webp', 26500, 26000, 5, 78, '1', NOW(), NOW()),
(419, 1164, 'Sổ tay mini cute gấu dâu', 'san_pham_ve_giay/Sổ các loại/Số tay mini cute/01.webp', 27500, 27000, 5, 83, '1', NOW(), NOW()),
(420, 1164, 'Sổ tay mini cute trắi đào', 'san_pham_ve_giay/Sổ các loại/Số tay mini cute/02.webp', 27500, 27000, 5, 83, '1', NOW(), NOW()),
(421, 1164, 'Sổ tay mini cute loopy', 'san_pham_ve_giay/Sổ các loại/Số tay mini cute/03.webp', 27500, 27000, 5, 83, '1', NOW(), NOW()),
(422, 1164, 'Sổ tay mini cute labubu', 'san_pham_ve_giay/Sổ các loại/Số tay mini cute/04.webp', 27500, 27000, 5, 83, '1', NOW(), NOW()),
(423, 1164, 'Sổ tay mini cute shark', 'san_pham_ve_giay/Sổ các loại/Số tay mini cute/05.webp', 27500, 27000, 5, 83, '1', NOW(), NOW()),
(424, 1165, 'Sổ tim', 'san_pham_ve_giay/Sổ các loại/Sổ tim/03.webp', 29500, 29000, 5, 90, '1', NOW(), NOW()), 

(425, 1166, 'Vở 4 mùa', 'san_pham_ve_giay/Vở/Vở 4 mùa/02.webp', 11000, 10000, 5, 100, '1', NOW(), NOW()),
(426, 1167, 'Vở ABC vàng', 'san_pham_ve_giay/Vở/Vở ABC/02.webp', 12500, 11500, 5, 90, '1', NOW(), NOW()),
(427, 1167, 'Vở ABC hồng', 'san_pham_ve_giay/Vở/Vở ABC/03.webp', 12500, 11500, 5, 90, '1', NOW(), NOW()),
(428, 1167, 'Vở ABC xanh', 'san_pham_ve_giay/Vở/Vở ABC/04.webp', 12500, 11500, 5, 90, '1', NOW(), NOW()),
(429, 1168, 'Vở bạn nhỏ xanh dường', 'san_pham_ve_giay/Vở/Vở bạn nhỏ/04.webp', 13500, 12500, 5, 85, '1', NOW(), NOW()),
(430, 1168, 'Vở bạn nhỏ hồng', 'san_pham_ve_giay/Vở/Vở bạn nhỏ/05.webp', 13500, 12500, 5, 85, '1', NOW(), NOW()),
(431, 1168, 'Vở bạn nhỏ xanh lá', 'san_pham_ve_giay/Vở/Vở bạn nhỏ/06.webp', 13500, 12500, 5, 85, '1', NOW(), NOW()),
(432, 1168, 'Vở bạn nhỏ vàng', 'san_pham_ve_giay/Vở/Vở bạn nhỏ/07.webp', 13500, 12500, 5, 85, '1', NOW(), NOW()),
(433, 1169, 'Vở Gradient xanh vàng', 'san_pham_ve_giay/Vở/Vở Gradient/02.webp', 12000, 11000, 5, 88, '1', NOW(), NOW()),
(434, 1169, 'Vở Gradient hồng', 'san_pham_ve_giay/Vở/Vở Gradient/03.webp', 12000, 11000, 5, 88, '1', NOW(), NOW()),
(435, 1169, 'Vở Gradient xanh dương', 'san_pham_ve_giay/Vở/Vở Gradient/04.webp', 12000, 11000, 5, 88, '1', NOW(), NOW()),
(436, 1170, 'Vở học sinh', 'san_pham_ve_giay/Vở/Vở học sinh/01.webp', 15000, 14000, 5, 95, '1', NOW(), NOW()),
(437, 1171, 'Vở Oxygen', 'san_pham_ve_giay/Vở/Vở Oxygen/01.webp', 13000, 12000, 5, 92, '1', NOW(), NOW());



INSERT INTO products (product_id, name, description, category_id, brand_id, status) VALUES
(1175, 'Thước bộ Điểm 10 TP-SR09DO', 'Thông số kĩ thuật :.

Thương hiệu:	Điểm 10.
Kích thước:	nhiều loại.
Trọng lượng:	40 gram.
Quy cách:	1 bộ/Túi.
Màu sắc:	Trong suốt.
Độ trong suốt:	cao.
Tính năng nổi bật:.

Thước bộ SR-09/DO là sản phẩm thước bộ gồm: 1 thước thẳng 15 cm, 1 thước eke 45, 1 thước eke 60, 1 thước đo góc 180.

Thước bộ SR-09/DO là sản phẩm thước bộ gồm: 1 thước thẳng 15 cm, 1 thước eke 45, 1 thước eke 60, 1 thước đo góc 180.

Thước SR-09/DO là thước bẳng nhựa trong thích hợp cho học sinh.

Bao bì dạng túi PVC bên trong có 4 cây. Hình ảnh Doraemon sinh động. In ấn trên thước và trên bao bì phù hợp với nhiều đối tượng sử dụng.

Công dụng: Dùng để kẻ đường thẳng và đo góc.', 15, 1, '1'),
(1176, 'Thước dẻo PVC Điểm 10 SR-025', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Kích thước:	15 cm.
Trọng lượng:	25 gram.
Quy cách:	1 thước/ túi, 200 túi/ thùng.
Màu sắc:	xanh, đỏ, xanh lá dạ quang.
Độ trong suốt:	cao.
Tính năng nổi bật:.

Thước dẻo SR-025 là thước thẳng bằng nhựa PVC, có chiều dài chia vạch 15cm, thích hợp cho học sinh sinh viên…

Thước SR-025 có 3 màu: xanh, đỏ, xanh lá dạ quang.

Thước có độ bền, độ dẻo cao, không bị rạn nứt khi uốn cong.

Vật liệu PVC an toàn cho người sử dụng. Màu sắc phong phú.

Công dụng: Dùng để kẻ đường thẳng.', 15, 1, '1'),
(1177, 'Thước thẳng Điểm 10 Disney', 'Thông số kĩ thuật :.

Thương hiệu:	Điểm 10.
Kích thước:	20 (cm).
Trọng lượng:	20 gram.
Quy cách:	1 cái/ túi, 200 cái/ thùng.
Màu sắc:	Trong suốt.
Độ trong suốt: 	Cao.
Tính năng nổi bật:.

Thước SR-029/MI là thước thẳng bằng nhựa trong có chiều dài 20cm thích hợp cho học sinh và văn phòng.

Kiểu dáng thuận tiện cho học sinh và nhân viên văn phòng. Bao bì túi OPP tiện cho việc trưng bày, bảo quản, đóng gói, vận chuyển.

Công dụng: Dùng để kẻ đường thẳng.

Đặc điểm nổi bật:

Thước thẳng được chế tạo từ nhựa dẻo có độ bền cao. Được sử dụng nhiều trong học tập, cơ khí, vẽ các bảng kĩ thuật, xây dựng, vẽ tranh..., 
dùng để đo dộ dài và kích thước của một vật. Trên thước có vạch, các vạch cách nhau 1 mm, để đo dộ dài chi tiết hơn.', 15, 1, '1'),
(1178, 'Thước thẳng Điểm 10 Disney', 'Thông số kĩ thuật :.

Thương hiệu:	Điểm 10.
Kích thước:	20 (cm).
Trọng lượng:	20 gram.
Quy cách:	1 cái/ túi, 200 cái/ thùng.
Màu sắc:	Trong suốt.
Tính năng nổi bật:.

Thước  SR-029/PR là thước thẳng bằng nhựa trong có chiều dài 20cm thích hợp cho học sinh và văn phòng.

Hình ảnh Công chúa Disney sinh động, bắt mắt.

Kiểu dáng thuận tiện cho học sinh và nhân viên văn phòng. Bao bì túi OPP tiện cho việc trưng bày, bảo quản, đóng gói, vận chuyển.

Công dụng: Dùng để kẻ đường thẳng.', 15, 1, '1'),
(1179, 'Thước thẳng Điểm 10 Doraemon SR-011DO', 'Thông số kĩ thuật :.

Thương hiệu:	Điểm 10.
Kích thước:	20 (cm).
Trọng lượng:	15 gram.
Quy cách:	1 cái/ túi opp.
Màu sắc:	trắng trong.
Đặc điểm : .

- Là loại thước thẳng dùng cho học sinh, chiều dài 20cm.
- Thước được cấu tạo từ nhựa cứng, trong suốt, bền khi sử dụng.
- Mặt thước có nhãn để học sinh ghi tên.
- Nhựa chất lượng cao, an toàn không độc hại.
- Sử dụng hình ảnh Doraemon rất dễ thương và thu hút.', 15, 1, '1'),
(1180, 'Thước thẳng Flexoffice FO-SR01', 'Thông số kĩ thuật :.

Thương hiệu:	Flexoffice.
Kích thước:	30 cm.
Quy cách:	1 thước/ túi.
Màu sắc:	Trong suốt.
Độ trong suốt:	Có.
Tính năng nổi bật:.

- Là loại thước thẳng chuyên dùng trong văn phòng, dài 30cm.

- Thước được cấu tạo từ nhựa cứng chất lượng cao, trong suốt ít trầy xước, có độ bền cao.

- Các mốc kích thước 0; 5; 10; 15; 20; 25; 30 được làm nổi bật giúp xác định dễ dàng, nhanh chóng.

- Thước có hai đơn vị đo: inch và cm. Các vạch được in ấn sắc nét, rõ ràng, bền với thời gian.

- Thân thước in các ô lưới vuông lớn 10x10 mm và 5x5 mm thuận tiện cho việc tạo ô vẽ các chi tiết, hình học.', 15, 1, '1'),
(1181, 'Thước thẳng Flexoffice FO-SR02', 'Thông số kĩ thuật :.

Thương hiệu:	Flexoffice.
Kích thước:	20 cm.
Quy cách:	1 thước/ túi.
Màu sắc:	Trong suốt.
Độ trong suốt:	Có.
Tính năng nổi bật:.

- Là loại thước thẳng chuyên dùng trong văn phòng, dài 20cm.

- Thước được cấu tạo từ nhựa cứng chất lượng cao, trong suốt ít trầy xước, có độ bền cao.', 13, 1, '1'),
(1182, 'Thước thẳng Thiên Long 30 cm SR-031', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Kích thước:	30 (cm).
Trọng lượng:	45 gram.
Quy cách:	1 thước/ túi.
Màu sắc:	trong suốt.
Độ trong suốt:	có.
Tính năng nổi bật:.

- Là loại thước thẳng phù hợp cho mọi đối tượng, dài 30cm.

- Thước được cấu tạo từ nhựa cứng chất lượng cao, độ dày 4,1 mm, trong suốt ít trầy xước, có độ bền cao.

- Các mốc kích thước 0;5; 10; 20; 30; 40; 50 được làm nổi bật giúp xác định dễ dàng, nhanh chóng.

- Thước có hai đơn vị đo: inch và cm. Các vạch được in ấn sắc nét, rõ ràng, bền với thời gian. Đặc biệt, ở phần vạch Inch có chia tỷ lệ: 1/16 và 1/8 tạo sự linh hoạt khi chia tỉ lệ.', 13, 1, '1'),
(1183, 'Thước thẳng Thiên Long SR-026', 'Thông số kĩ thuật :.

Thương hiệu:	Thiên Long.
Kích thước:	50 (cm).
Trọng lượng:	105 gram.
Quy cách:	1 thước/ túi.
Màu sắc:	trong suốt.
Độ trong suốt:	có.
Tính năng nổi bật:.

- Là loại thước thẳng chuyên dùng trong kỹ thuật, dài 50cm.

- Thước được cấu tạo từ nhựa cứng chất lượng cao, trong suốt ít trầy xước, có độ bền cao.

- Các mốc kích thước 0; 10; 20; 30; 40; 50 được làm nổi bật giúp xác định dễ dàng, nhanh chóng.

- Thước có hai đơn vị đo: inch và cm. Các vạch được in ấn sắc nét, rõ ràng, bền với thời gian. Đặc biệt, ở phần vạch Inch có chia tỷ lệ: 1/16 và 1/8 tạo sự linh hoạt khi chia tỉ lệ.

- Thân thước in các ô lưới vuông lớn 10x10 mm và 5x5 mm thuận tiện cho việc tạo ô vẽ các chi tiết, hình học.', 13, 1, '1');



INSERT INTO `product_images` (`product_image_id`, `product_id`, `image_url`) VALUES
(472, 1175, 'San_pham_khac/Thuoc/Thuoc_bo_Diem_10_TP-SR09DO/1.webp'),
(473, 1175, 'San_pham_khac/Thuoc/Thuoc_bo_Diem_10_TP-SR09DO/2.webp'),
(474, 1176, 'San_pham_khac/Thuoc/Thuoc_deo_PVC_Diem_10_SR-025/1.webp'),
(475, 1176, 'San_pham_khac/Thuoc/Thuoc_deo_PVC_Diem_10_SR-025/6.webp'),
(476, 1177, 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_ Disney_Mickey_SR-029MI/1.webp'),
(477, 1178, 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_Disney_Princess_SR-029PR/2.jpg'),
(478, 1179, 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_Doraemon_SR-011DO/3.webp'),
(479, 1179, 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_Doraemon_SR-011DO/4.webp'),
(480, 1179, 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_Doraemon_SR-011DO/5.webp'),
(481, 1180, 'San_pham_khac/Thuoc/Thuoc_thang_Flexoffice_FO-SR01/1.webp'),
(482, 1180, 'San_pham_khac/Thuoc/Thuoc_thang_Flexoffice_FO-SR01/2.webp'),
(483, 1181, 'San_pham_khac/Thuoc/Thuoc_thang_Flexoffice_FO-SR02/1.webp'),
(484, 1182, 'San_pham_khac/Thuoc/Thuoc_thang_Thien_Long_30 cm_SR-031/1.webp'),
(485, 1182, 'San_pham_khac/Thuoc/Thuoc_thang_Thien_Long_30 cm_SR-031/3.webp'),
(486, 1183, 'San_pham_khac/Thuoc/Thuoc_thang_Thien_Long_SR-026/2.webp'),
(487, 1183, 'San_pham_khac/Thuoc/Thuoc_thang_Thien_Long_SR-026/3.webp'),
(488, 1183, 'San_pham_khac/Thuoc/Thuoc_thang_Thien_Long_SR-026/4.webp');




INSERT INTO `product_type` (`product_type_id`, `product_id`, `name`, `image`, `priceOld`, `priceCurrent`, `discount_price`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(480, 1175, 'Thước bộ Điểm 10 1', 'San_pham_khac/Thuoc/Thuoc_bo_Diem_10_TP-SR09DO/3.webp', 15000, 14250, 5, 100, 1, NOW(), NOW()),
(481, 1175, 'Thước bộ Điểm 10 2', 'San_pham_khac/Thuoc/Thuoc_bo_Diem_10_TP-SR09DO/4.webp', 15000, 14250, 5, 100, 1, NOW(), NOW()),
(482, 1175, 'Thước bộ Điểm 10 3', 'San_pham_khac/Thuoc/Thuoc_bo_Diem_10_TP-SR09DO/5.webp', 15000, 14250, 5, 100, 1, NOW(), NOW()),
(483, 1175, 'Thước bộ Điểm 10 4', 'San_pham_khac/Thuoc/Thuoc_bo_Diem_10_TP-SR09DO/6.webp', 15000, 14250, 5, 100, 1, NOW(), NOW()),
(484, 1176, 'Thước dẻo PVC Điểm 10 1', 'San_pham_khac/Thuoc/Thuoc_deo_PVC_Diem_10_SR-025/2.webp', 18000, 17100, 5, 100, 1, NOW(), NOW()),
(485, 1176, 'Thước dẻo PVC Điểm 10 2', 'San_pham_khac/Thuoc/Thuoc_deo_PVC_Diem_10_SR-025/3.webp', 18000, 17100, 5, 100, 1, NOW(), NOW()),
(486, 1176, 'Thước dẻo PVC Điểm 10 3', 'San_pham_khac/Thuoc/Thuoc_deo_PVC_Diem_10_SR-025/4.webp', 18000, 17100, 5, 100, 1, NOW(), NOW()),
(487, 1176, 'Thước dẻo PVC Điểm 10 4', 'San_pham_khac/Thuoc/Thuoc_deo_PVC_Diem_10_SR-025/5.webp', 18000, 17100, 5, 100, 1, NOW(), NOW()),
(488, 1177, 'Thước thẳng Điểm 10 Disney Mickey 1', 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_ Disney_Mickey_SR-029MI/2.webp', 14000, 13300, 5, 100, 1, NOW(), NOW()),
(489, 1177, 'Thước thẳng Điểm 10 Disney Mickey 2', 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_ Disney_Mickey_SR-029MI/3.webp', 14000, 13300, 5, 100, 1, NOW(), NOW()),
(490, 1178, 'Thước thẳng Điểm 10 Disney Princess SR-029PR', 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_Disney_Princess_SR-029PR/1.webp', 17000, 16150, 5, 100, 1, NOW(), NOW()),
(491, 1179, 'Thước thẳng Điểm 10 Doraemon 1', 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_Doraemon_SR-011DO/1.webp', 15000, 14250, 5, 100, 1, NOW(), NOW()),
(492, 1179, 'Thước thẳng Điểm 10 Doraemon 2', 'San_pham_khac/Thuoc/Thuoc_thang_Diem_10_Doraemon_SR-011DO/2.webp', 15000, 14250, 5, 100, 1, NOW(), NOW()),
(493, 1180, 'Thước thẳng Flexoffice FO-SR01', 'San_pham_khac/Thuoc/Thuoc_thang_Flexoffice_FO-SR01/3.webp', 17000, 16150, 5, 100, 1, NOW(), NOW()),
(494, 1181, 'Thước thẳng Flexoffice FO-SR02', 'San_pham_khac/Thuoc/Thuoc_thang_Flexoffice_FO-SR02/1.webp', 17000, 16150, 5, 100, 1, NOW(), NOW()),
(495, 1182, 'Thước thẳng Thiên Long 30 cm SR-031', 'San_pham_khac/Thuoc/Thuoc_thang_Thien_Long_30 cm_SR-031/2.webp', 18000, 17100, 5, 100, 1, NOW(), NOW()),
(496, 1183, 'Thước thẳng Thiên Long SR-026', 'San_pham_khac/Thuoc/Thuoc_thang_Thien_Long_SR-026/1.webp', 15000, 14250, 5, 100, 1, NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(11) DEFAULT 0 CHECK (`rating` >= 0 and `rating` <= 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `comment`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1002, 2, 'Bút viết tốt, mực đều.', 5, '2025-04-14 12:34:40', '2025-04-14 12:34:40'),
(2, 1001, 3, 'Giấy đẹp, in rõ nét.', 4, '2025-04-14 12:34:40', '2025-04-14 12:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `stickers`
--

CREATE TABLE `stickers` (
  `sticker_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stickers`
--

INSERT INTO `stickers` (`sticker_id`, `name`, `image_url`) VALUES
(1, 'Sticker 1', 'images/sticker/1.png'),
(2, 'Sticker 2', 'images/sticker/2.png'),
(3, 'Sticker 3', 'images/sticker/3.png'),
(4, 'Sticker 4', 'images/sticker/4.png'),
(5, 'Sticker 5', 'images/sticker/5.png'),
(6, 'Sticker 6', 'images/sticker/6.png'),
(7, 'Sticker 7', 'images/sticker/7.png'),
(8, 'Sticker 8', 'images/sticker/8.png'),
(9, 'Sticker 9', 'images/sticker/9.png'),
(10, 'Sticker 10', 'images/sticker/10.png'),
(11, 'Sticker 11', 'images/sticker/11.png'),
(12, 'Sticker 12', 'images/sticker/12.png'),
(13, 'Sticker 13', 'images/sticker/13.png'),
(14, 'Sticker 14', 'images/sticker/14.png'),
(15, 'Sticker 15', 'images/sticker/15.png'),
(16, 'Sticker 16', 'images/sticker/16.png'),
(17, 'Sticker 17', 'images/sticker/17.png'),
(18, 'Sticker 18', 'images/sticker/18.png'),
(19, 'Sticker 19', 'images/sticker/19.png'),
(20, 'Sticker 20', 'images/sticker/20.png'),
(21, 'Sticker 21', 'images/sticker/21.png'),
(22, 'Sticker 22', 'images/sticker/22.png'),
(23, 'Sticker 23', 'images/sticker/23.png'),
(24, 'Sticker 24', 'images/sticker/24.png'),
(25, 'Sticker 25', 'images/sticker/25.png'),
(26, 'Sticker 26', 'images/sticker/26.png'),
(27, 'Sticker 27', 'images/sticker/27.png'),
(28, 'Sticker 28', 'images/sticker/28.png'),
(29, 'Sticker 29', 'images/sticker/29.png'),
(30, 'Sticker 30', 'images/sticker/30.png'),
(31, 'Sticker 31', 'images/sticker/31.png'),
(32, 'Sticker 32', 'images/sticker/32.png');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `transport_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`transport_id`, `name`, `price`) VALUES
('eco', 'Giao hàng tiết kiệm', 25000.00),
('express', 'Giao hàng nhanh', 30000.00),
('standard', 'Giao hàng hỏa tốc', 40000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `google_id` varchar(20) DEFAULT NULL,
  `remember_token` VARCHAR(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `phone`, `address`, `role`, `status`,`google_id`, `created_at`) VALUES
(1, 'Nguyen Van A', 'sancaulongnhom6@gmail.com', '$2y$10$J87cjjH/2woiysxx7HFmO.DYdpBCLEq1/wTFcnneoCR8rnHIk7nB2', '0900000001', 'Hanoi', 'admin', '1', NULL, '2025-04-14 12:34:39'),
(2, 'Tran Thi A', 'a@example.com', '$2y$10$LvrejsO5ThsYrsMzdfXy8e0t2NdqU4SMWBwkfQVhnY1kSu8T5liKW', '0123456787', 'Hanoi', 'user', '1', NULL, '2025-04-14 12:34:39'),
(3, 'Tran Thi B', 'b@example.com', '$2y$10$Bh5l5SFhUgCfHm9q1qq70uiR3oYGQBz7BISusvOPlctrC3cYH6Pxy', '0123456789', 'HCM City', 'user', '1', NULL, '2025-04-14 12:34:39'),
(9, 'Bảo Võ Duy', 'baovd9891@ut.edu.vn', '$2y$10$wC6F37BlTm822Le8HYpPiOXU.eHyjGrWkEJA0AF2BJFvJN//cksp.', NULL, NULL, 'user', '1', '103054620497096929831', '2025-04-20 10:00:57'),
(10, 'Bảo Võ', 'voduybao19052005@gmail.com', '$2y$10$x0ZOuiDBPPCfkIY2xc.uXupJe3OzX6pP6LicJdUgHXu4/dfTHyDGi', NULL, NULL, 'user', '1', '101081944381504999215', '2025-04-20 10:01:35');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `sticker_id` (`sticker_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_payment` (`payment_id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `transport_id` (`transport_id`);


--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Chỉ mục cho bảng `payment_information`
--
ALTER TABLE `payment_information`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stickers`
--
ALTER TABLE `stickers`
  ADD PRIMARY KEY (`sticker_id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transport_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `google_id` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `payment_information`
--
ALTER TABLE `payment_information`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1184;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=489;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stickers`
--
ALTER TABLE `stickers`
  MODIFY `sticker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_ibfk_3` FOREIGN KEY (`sticker_id`) REFERENCES `stickers` (`sticker_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`product_type_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `product_type_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
