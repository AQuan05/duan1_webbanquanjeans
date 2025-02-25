-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2025 at 05:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `da1`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 15, '2025-02-20 01:27:38', '2025-02-20 01:27:38'),
(6, 16, '2025-02-20 01:28:53', '2025-02-20 01:28:53'),
(7, 17, '2025-02-23 11:25:24', '2025-02-23 11:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `total_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `parent_id` int DEFAULT NULL,
  `description` text,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `parent_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(28, 'Jean nam', NULL, NULL, 'Active', '2025-02-20 01:30:27', '2025-02-20 01:30:27'),
(29, 'Jean cao cấp', NULL, NULL, 'Active', '2025-02-20 01:30:41', '2025-02-20 01:30:41'),
(30, 'Jean thời trang', NULL, NULL, 'Active', '2025-02-20 01:30:54', '2025-02-20 01:30:54'),
(31, 'Jean vải cao cấp', NULL, NULL, 'Active', '2025-02-20 01:31:15', '2025-02-20 01:31:15'),
(32, 'jean chất lượng', NULL, NULL, 'Active', '2025-02-20 01:31:32', '2025-02-20 01:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `content` text NOT NULL,
  `rating` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `product_id`, `user_id`, `order_id`, `content`, `rating`, `created_at`) VALUES
(7, 45, 16, 51, 'sản phẩm ok đấy', NULL, '2025-02-22 12:52:44'),
(18, 46, 16, 51, 'quá chất lượng', NULL, '2025-02-23 11:17:29'),
(19, 56, 16, 51, 'quá ưng ý luôn', NULL, '2025-02-23 11:18:30'),
(20, 56, 16, 64, 'không có gì để chê', NULL, '2025-02-23 11:23:54'),
(21, 50, 17, 66, 'Không có gì để bàn', NULL, '2025-02-23 11:28:38'),
(22, 50, 17, 67, 'miễn bàn rồi', NULL, '2025-02-23 11:31:12'),
(23, 45, 17, 67, 'quá ổn luôn', NULL, '2025-02-23 11:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` int NOT NULL,
  `status_id` int DEFAULT '1',
  `order_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `pttt` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `status_id`, `order_reason`, `user_address`, `Phone`, `pttt`, `created_at`, `updated_at`) VALUES
(51, 16, 10400000, 4, NULL, '1P, Trịnh Văn Bô', '0965841335', 'vnpay', '2025-02-20 02:35:39', '2025-02-21 01:52:45'),
(52, 16, 2100000, 3, NULL, '1P, Trịnh Văn Bô1P, Trịnh Văn Bô', '0356984563', 'tructiep', '2025-02-21 16:57:45', '2025-02-21 16:57:54'),
(53, 16, 1900000, 4, NULL, 'Trịnh Văn Bô', '0987456321', 'tructiep', '2025-02-21 17:04:43', '2025-02-21 17:04:57'),
(54, 16, 500000, 0, NULL, '1P, Trịnh Văn Bô1P, Trịnh Văn Bô', '0321698547', 'tructiep', '2025-02-21 17:24:58', '2025-02-22 22:33:01'),
(55, 16, 900000, 3, NULL, 'Xuân Phương', '0456987321', 'tructiep', '2025-02-21 17:25:20', '2025-02-21 17:34:05'),
(56, 16, 2000000, 3, NULL, 'Hà Đông', '0654987321', 'tructiep', '2025-02-21 17:38:05', '2025-02-21 17:38:29'),
(57, 16, 2000000, 0, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-22 23:47:46', '2025-02-22 23:47:59'),
(58, 16, 1900000, 0, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-22 23:49:29', '2025-02-22 23:49:40'),
(59, 16, 2000000, 0, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-22 23:52:10', '2025-02-22 23:52:23'),
(60, 16, 1050000, 0, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-23 00:01:34', '2025-02-23 00:01:56'),
(61, 16, 2000000, 0, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-23 00:07:48', '2025-02-23 00:18:43'),
(62, 16, 200000, 0, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-23 00:22:32', '2025-02-23 00:22:52'),
(63, 16, 2000000, 0, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-23 00:35:59', '2025-02-23 00:52:58'),
(64, 16, 2000000, 4, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-23 00:51:53', '2025-02-23 11:23:25'),
(65, 16, 1050000, 1, NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', 'tructiep', '2025-02-23 00:54:49', '2025-02-23 00:54:49'),
(66, 17, 850000, 4, NULL, '1P, Trịnh Văn Bô', '0654987321', 'tructiep', '2025-02-23 11:28:04', '2025-02-23 11:28:23'),
(67, 17, 1350000, 4, NULL, 'Hà Đông', '0961697388', 'tructiep', '2025-02-23 11:30:26', '2025-02-23 11:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(31, 51, 56, 'Quần jean aristino G7', 1, '2000000.00'),
(32, 51, 55, 'Quần jean aristino', 1, '1050000.00'),
(33, 51, 54, 'Jean carera', 1, '200000.00'),
(34, 51, 53, 'Quần jean slimfit', 1, '1500000.00'),
(35, 51, 52, 'Quần jean nam doki', 1, '650000.00'),
(36, 51, 51, 'Quần jean nam giá rẻ', 1, '750000.00'),
(37, 51, 50, 'Quần jean nam carrera', 1, '850000.00'),
(38, 51, 49, 'Quần jean nam xanh', 1, '950000.00'),
(39, 51, 48, 'Jean Tarmor', 1, '1000000.00'),
(40, 51, 47, 'Quần jean slimfit ', 1, '450000.00'),
(41, 51, 46, 'Quần jean diesel', 1, '500000.00'),
(42, 51, 45, 'Jean daiz', 1, '500000.00'),
(43, 52, 55, 'Quần jean aristino', 2, '1050000.00'),
(44, 53, 49, 'Quần jean nam xanh', 2, '950000.00'),
(45, 54, 45, 'Jean daiz', 1, '500000.00'),
(46, 55, 44, 'Quần jean nam cao cấp', 2, '450000.00'),
(47, 56, 48, 'Jean Tarmor', 2, '1000000.00'),
(48, 57, 48, 'Jean Tarmor', 2, '1000000.00'),
(49, 58, 49, 'Quần jean nam xanh', 2, '950000.00'),
(50, 59, 56, 'Quần jean aristino G7', 1, '2000000.00'),
(51, 60, 55, 'Quần jean aristino', 1, '1050000.00'),
(52, 61, 56, 'Quần jean aristino G7', 1, '2000000.00'),
(53, 62, 54, 'Jean carera', 1, '200000.00'),
(54, 63, 56, 'Quần jean aristino G7', 1, '2000000.00'),
(55, 64, 56, 'Quần jean aristino G7', 1, '2000000.00'),
(56, 65, 55, 'Quần jean aristino', 1, '1050000.00'),
(57, 66, 50, 'Quần jean nam carrera', 1, '850000.00'),
(58, 67, 50, 'Quần jean nam carrera', 1, '850000.00'),
(59, 67, 45, 'Jean daiz', 1, '500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category_id` int NOT NULL,
  `description` text,
  `status` int DEFAULT NULL,
  `price` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image`, `category_id`, `description`, `status`, `price`, `created_at`, `updated_at`) VALUES
(42, 'Quần jean nam', 'jean-xanh_800x800-removebg-preview.png', 29, 'Quần jean cao cấp chất lượng kiểu mới', NULL, 300000, '2025-02-20 01:55:07', '2025-02-20 01:55:07'),
(43, 'Quần jean cao cấp', 'Jean-cao-cap_800x800-removebg-preview.png', 29, 'Jeam nam chất lượng cao', NULL, 250000, '2025-02-20 01:57:46', '2025-02-20 01:57:46'),
(44, 'Quần jean nam cao cấp', 'quan-jean-nam-800x800-removebg-preview.png', 29, 'jeam chất vải cao cấp', NULL, 450000, '2025-02-20 01:58:18', '2025-02-20 01:58:18'),
(45, 'Jean daiz', 'jean-daiz_900x900-removebg-preview.png', 28, 'Quần jean kiểu mới chất lượng vải khỏi phải bàn', NULL, 500000, '2025-02-20 02:00:09', '2025-02-20 02:00:09'),
(46, 'Quần jean diesel', 'jean-nam-diesel-sleenker_900x900-removebg-preview.png', 28, 'KIỂU DÁNG: Slim  - Quần Jeans với kiểu dáng Regular suông vừa phải, mang đến sự thoải mái nhờ cơ chế vải co giãn nhẹ, giúp các chuyển động của cơ thể trở nên thoải mái hơn, nhẹ nhàng hơn.  - Thiết kế các may chỉ nổi tạo nên nét khỏe khoắn, nam tính cho từng chiếc quần, kết hợp với thiết kế túi sau đơn giản cho người mặc sự thanh lịch nhưng vẫn trẻ trung, năng động  CHẤT LIỆU:  97% Cotton, 3% Spandex  - Chất liệu co giãn thoải mái, thoáng mát, thấm hút mồ hôi tốt  - Mặt vải mềm không giây thô ráp cho da, màu sắc luôn tươi mới và bền bỉ sau nhiều lần giặt', NULL, 500000, '2025-02-20 02:02:02', '2025-02-20 02:02:02'),
(47, 'Quần jean slimfit ', 'jean-slimfit_900x900-removebg-preview.png', 28, '- Quần Jeans chất liệu 98% cotton, 2% spandex mềm mại, thoáng mát, mang lại sự thoải mái cho người mặc.  - Form quần slim fit, kiểu dáng ôm gọn đem lại cảm giác dễ chịu, dễ dàng di chuyển, hoạt động.  - Đây chắc hẳn là dáng quần không thể thiếu trong tủ đồ, quần dễ dàng kết hợp với nhiều trang phục. Phối với áo thun hoặc polo cho phong cách năng động, hoặc kết hợp với áo sơ mi để tạo vẻ lịch lãm.', NULL, 450000, '2025-02-20 02:02:54', '2025-02-20 02:02:54'),
(48, 'Jean Tarmor', 'jean-Tarmor_900x900-removebg-preview.png', 30, 'Thuộc tính sản phẩm Chất liệu:  ►100% Cotton mềm mại, thấm hút mồ hôi tốt, độ bền cao.  Kiểu dáng:  ►Form Baggy rộng ở phần hông và thuôn dần tới gấu quần tạo cảm giác phóng khoáng.  Chi tiết:  ►Màu sắc cơ bản dễ phối đồ, có 1 màu Xanh duy nhất cho bạn lựa chọn.   ►Dễ dàng kết hợp với nhiều loại trang phục khác nhau: áo thun, áo polo..', NULL, 1000000, '2025-02-20 02:05:22', '2025-02-20 02:05:22'),
(49, 'Quần jean nam xanh', 'quan-jean-nam-800x800-removebg-preview.png', 30, 'Thuộc tính sản phẩm - Chất liệu: Vải Jean dày dặn, có độ đứng form tôn dáng khi mặc. Sản phẩm có độ bền cao, không phai màu khi giặt giũ - Form dáng: Dáng quần Straight suông thoải mái, che được nhiều khuyết điểm. Đây là form quần có tỷ lệ mông, đùi và ống quần không chênh lệch nhau quá nhiều tạo thành dáng suông từ trên xuống dưới', NULL, 950000, '2025-02-20 02:06:19', '2025-02-20 02:06:19'),
(50, 'Quần jean nam carrera', 'quan-jean-nam-carrera-jean_900x900-removebg-preview.png', 30, 'Thuộc tính sản phẩm - Chất liệu: Vải Jean dày dặn, có độ đứng form tôn dáng khi mặc. Sản phẩm có độ bền cao, không phai màu khi giặt giũ - Form dáng: Dáng quần Straight suông thoải mái, che được nhiều khuyết điểm. Đây là form quần có tỷ lệ mông, đùi và ống quần không chênh lệch nhau quá nhiều tạo thành dáng suông từ trên xuống dưới', NULL, 850000, '2025-02-20 02:07:38', '2025-02-20 02:07:38'),
(51, 'Quần jean nam giá rẻ', 'quan-jean-nam-gia-re_700x700-removebg-preview.png', 31, 'Quần jean nam THOL với chất liệu jean co giãn thoải mái, mẫu mã đơn giản nhưng vẫn mang nét tinh tế do đường nét và màu sắc sắc hài hòa, thích hợp mặc trong nhiều hoàn cảnh như đi chơi, hẹn hò, dự tiệc, đi làm. Vói chất liệu cao cấp, kiểu dáng trẻ trung, quần jean THOL thể hiện gu thời trang sành điệu cho phái mạnh', NULL, 750000, '2025-02-20 02:08:29', '2025-02-20 02:08:29'),
(52, 'Quần jean nam doki', 'quan-jean-nam-doki_1000x1000-removebg-preview.png', 31, 'Thuộc tính sản phẩm Chất liệu:  ►100% Cotton mềm mại, thấm hút mồ hôi tốt, độ bền cao.  Kiểu dáng:  ►Form Baggy rộng ở phần hông và thuôn dần tới gấu quần tạo cảm giác phóng khoáng.  Chi tiết:  ►Màu sắc cơ bản dễ phối đồ, có 1 màu Xanh duy nhất cho bạn lựa chọn.   ►Dễ dàng kết hợp với nhiều loại trang phục khác nhau: áo thun, áo polo..', NULL, 650000, '2025-02-20 02:09:04', '2025-02-20 02:09:04'),
(53, 'Quần jean slimfit', 'jean-slimfit_900x900-removebg-preview.png', 31, 'CHẤT LIỆU: Thành phần Cotton là sợi vải tự nhiên lấy từ nguyên liệu chính là sợi bông, có độ mềm mịn, mang đến cảm giác dễ chịu, thoải mái cho người mặc. Thấm hút mồ hôi tốt. Thành phần Spandex co dãn 2 chiều giúp cử động thoải mái nhưng vẫn giữ được phom dáng ban đầu.  THIẾT KẾ: Sản phẩm có đường chỉ may tỉ mỉ, tinh tế. Phom Slimfit ôm vừa, tôn dáng người mặc, sản phẩm giặt mài thời trang.  MỤC ĐÍCH SỬ DỤNG: Bạn có thể sử dụng polo cho ngày đi làm, đi học, rèn luyện thể thao, đi dạo, xuống phố và kết hợp cùng áo Polo, T-shirt, sơ mi,....', NULL, 1500000, '2025-02-20 02:10:18', '2025-02-20 02:10:18'),
(54, 'Jean carera', 'quan-jean-nam-carrera-jean_900x900-removebg-preview.png', 32, 'Black Slim Fit Men\'s Long Jeans  Điểm nổi bật: Form quần slim tôn dáng Đường chỉ nổi trang trí túi sau màu đỏ nổi bật tăng cá tính người mặc  * Thiết kế và sản xuất tại Sài Gòn, Việt Nam. Crafted with care by Viet Thang Jean, Vietnam.  Chất liệu: Vải denim mềm mịn co giãn. Chất liệu 99% Cotton, 1% Spandex ( ~11.5 oz). Khóa kéo zipper YKK cao cấp. Nút cài thương hiệu V-SIXTYFOUR độc quyền.', NULL, 200000, '2025-02-20 02:15:36', '2025-02-20 02:15:36'),
(55, 'Quần jean aristino', 'jean-nam-aristino-slim-fit_1000x1000-removebg-preview.png', 32, 'Tên sản phẩm: Quần jean Nam Aristino Cotton AJNR03 Mã rút gọn: AJNR03 Thiết kế:  Thiết kế túi xẻ 2 bên, túi vuông phía sau quần. Gam màu xanh chàm vơi nhiều sắc độ khác nhau mang đến nhiều lựa chọn Chất liệu: 99% Cotton 1% Spandex Size: 29,30,31,32,33,34,35 Màu: Xanh chàm sáng', NULL, 1050000, '2025-02-20 02:16:29', '2025-02-20 02:16:29'),
(56, 'Quần jean aristino G7', 'quan-jean-nam-aristino-slim_1000x1000-removebg-preview.png', 32, 'KIỂU DÁNG: Suông Ống Rộng  CHI TIẾT:  - Quần jeans phom dáng Suông Ống Rộng nhưng vẫn đảm bảo thoải mái tối đa khi mặc.  - Quần vải demin, màu sắc trung tính, linh hoạt khi kết hợp với các loại trang phục khác nhau, theo nhiều phong cách khác nhau.  CHẤT LIỆU:  - 100% Cotton mềm mịn, thoáng khí, thấm mồ hôi vượt trội và thân thiện với làn da  - 0% Spandex giúp quần co giãn thoải mái', NULL, 2000000, '2025-02-20 02:18:23', '2025-02-20 02:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `description`, `created_at`, `updated_at`) VALUES
(0, 'client', NULL, '2025-02-19 00:42:47', '2025-02-19 00:46:00'),
(1, 'admin', NULL, '2025-02-19 00:42:47', '2025-02-19 00:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int NOT NULL,
  `status_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(0, 'Đã hủy'),
(1, 'Chưa xác nhận'),
(2, 'Đã xác nhận\r\n'),
(3, 'Đang giao hàng'),
(4, 'Giao hàng thành công\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `role_id` int DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_phone` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role_id`, `username`, `email`, `password`, `status`, `user_address`, `user_phone`, `created_at`, `updated_at`) VALUES
(15, 1, 'Admin123', 'admin123@gmail.com', 'admin123123', NULL, NULL, NULL, '2025-02-20 01:27:38', '2025-02-20 01:27:56'),
(16, 0, 'Quan05', 'quan05@gmail.com', 'quan0512345', NULL, 'Số 7 Hòe Thị Phương Canh', '0987654321', '2025-02-20 01:28:53', '2025-02-22 15:26:04'),
(17, 0, 'Toan005', 'toan005@gmail.com', 'toan005005', NULL, NULL, NULL, '2025-02-23 11:25:24', '2025-02-23 11:25:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `cart_items_Ibfk_2` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orders_ibfk_2` (`status_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_items_ibfk_2` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `lk_product_categories` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_items_Ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `lk_product_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
