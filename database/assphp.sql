-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th8 10, 2023 lúc 12:21 AM
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
-- Cơ sở dữ liệu: `assphp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `product_id` int(20) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `category_description` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(1, 'Smart Phone', 'Apple iPhone series', '../uploads/iphone_14_Pro_Max_tim.png'),
(2, 'Laptop', 'Apple Macbook series', '../uploads/macbook13_m2_gray.webp'),
(3, 'Tablet', 'Apple iPad series', '../uploads/ipad-pro-13-select-wifi-spacegray-202210-02.webp'),
(6, 'Watch', 'Apple Watch Series', '../uploads/watch_category.png'),
(8, 'Airpods', 'Apple Airpods series', '../uploads/MME73_AV1.jpeg'),
(9, 'Accessory', 'Apple Accessories', '../uploads/accessory.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(20) NOT NULL,
  `purchase_id` int(20) DEFAULT NULL,
  `product_id` int(20) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `purchase_id`, `product_id`, `quantity`, `product_name`) VALUES
(1, 1, 2, 2, 'iPhone 14 Pro Max 512GB | VNA Authentic'),
(2, 1, 3, 3, 'Apple Macbook Pro 13 M2 2022 16GB 512GB'),
(3, 1, 7, 2, 'iPhone 13 Pro Max 128GB | VNA Authentic'),
(4, 1, 9, 2, 'Apple Watch Seres 6 | VNA Authentic'),
(5, 1, 11, 4, 'iPhone 13 128GB | VNA Authentic'),
(6, 1, 10, 1, 'Airpods Pro 3 Mate White | VNA Authentic'),
(7, 2, 2, 1, NULL),
(8, 3, 2, 1, NULL),
(9, 3, 9, 1, NULL),
(10, 3, 4, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productImages`
--

CREATE TABLE `productImages` (
  `image_id` int(20) NOT NULL,
  `product_id` int(20) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(20) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` int(50) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `category_id` int(20) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `product_description`, `category_id`, `product_image`) VALUES
(2, 'iPhone 14 Pro Max 512GB | VNA Authentic', 1099, 'Color: Purple', 1, '../uploads/64d0dd2e62096_14promax_1.png'),
(3, 'Apple Macbook Pro 13 M2 2022 16GB 512GB', 2000, 'Color: Gray', 2, '../uploads/macbook13_m2_gray.webp'),
(4, 'iPad Pro 11 inch 512GB | VNA Authentic', 1000, 'Color: Gray', 3, '../uploads/ipad-pro-13-select-wifi-spacegray-202210-02.webp'),
(7, 'iPhone 13 Pro Max 128GB | VNA Authentic', 999, 'Color: Green', 1, '../uploads/iphone13-pro-max-xanh-la-1.jpg'),
(9, 'Apple Watch Seres 6 | VNA Authentic', 500, 'Color: Black', 6, '../uploads/watch_category.png'),
(10, 'Airpods Pro 3 Mate White | VNA Authentic', 250, 'Color: white', 8, '../uploads/MME73_AV1.jpeg'),
(11, 'iPhone 13 128GB | VNA Authentic', 899, 'Color: Xanh dương', 1, '../uploads/13_128GB.webp'),
(12, 'iPhone 13 Pro Max 128GB | VNA Authentic', 999, 'Color: xanh nhạt', 1, '../uploads/13promax_xanhnhat.webp'),
(13, 'iPhone 14 128GB | VNA Authentic', 899, 'Color: Black', 1, '../uploads/ip14128gb_black.webp'),
(14, 'iPhone 12 Pro Max 128GB | VNA Authentic', 999, 'Color: Blue', 1, '../uploads/64d0e324756c9_13promax_xanhnhat.webp'),
(15, 'Apple MacBook Air M1 256GB 2020', 800, 'Color: Gold', 2, '../uploads/macbook-air-silver-select-201810_01.webp'),
(16, 'Apple Macbook Air M2 2022 8GB 256GB', 1200, 'Color: Black', 2, '../uploads/macbook_air_m2_1_1.webp'),
(17, 'Apple Macbook Pro 13 M2 2022 8GB 256GB', 1300, 'Color: Space Gray', 2, '../uploads/mbp-spacegray-select-202206.webp'),
(18, 'Macbook Air 15 inch M2 2023 8GB 256GB', 1500, 'Color: Black', 2, '../uploads/macbook-air-15-inch-m2-2023-1.webp'),
(19, 'Apple MacBook Pro 13 Touch Bar M1 256GB 2020', 1000, 'Color: Space Gray', 2, '../uploads/_0001_macbook_pro_13-in_space_gray_with_intel_processor_pure_side_left_screen__usen_3.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchase_info`
--

CREATE TABLE `purchase_info` (
  `purchase_id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `customer_firstname` varchar(255) DEFAULT NULL,
  `customer_lastname` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(15) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `total_amount` int(100) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `purchase_info`
--

INSERT INTO `purchase_info` (`purchase_id`, `user_id`, `customer_firstname`, `customer_lastname`, `customer_phone`, `shipping_address`, `total_amount`, `payment_method`, `order_date`) VALUES
(1, 4, 'Minh', 'Le', '0988710632', 'Hanoi', 5747, 'Cash On Delivery', '2023-08-07 17:00:00'),
(2, 4, 'Chang', 'Chang', '0326283484', 'Quang ninh', 1099, 'Cash On Delivery', '2023-08-07 17:00:00'),
(3, 4, 'Minh', 'Le', '0988710632', 'Hanoi', 2599, 'Cash On Delivery', '2023-08-08 17:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `classify` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `code`, `status`, `classify`) VALUES
(3, 'Admin', 'Minh', 'leminh1997ks@gmail.com', '$2y$10$eVaWpE6pbqrdzVu2s/frKuWEWoeTiDTSVs0yE8rjNajpYbxoafo2a', '0', 'verified', 'Admin'),
(4, 'Minh', 'Le', 'minhlxph30963@fpt.edu.vn', '$2y$10$MZCjBTEb0f0Wj3c9KFsAmOw2GBJnXCvsuyZrMuW6brORsWsCcRbOC', '0', 'verified', 'User');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_purchase_id` (`purchase_id`),
  ADD KEY `fk_product_id_order` (`product_id`),
  ADD KEY `fk_product_name_order` (`product_name`);

--
-- Chỉ mục cho bảng `productImages`
--
ALTER TABLE `productImages`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `product_name` (`product_name`);

--
-- Chỉ mục cho bảng `purchase_info`
--
ALTER TABLE `purchase_info`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `fk_purchase_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `productImages`
--
ALTER TABLE `productImages`
  MODIFY `image_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `purchase_info`
--
ALTER TABLE `purchase_info`
  MODIFY `purchase_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_product_id_order` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_product_name_order` FOREIGN KEY (`product_name`) REFERENCES `products` (`product_name`),
  ADD CONSTRAINT `fk_purchase_id` FOREIGN KEY (`purchase_id`) REFERENCES `purchase_info` (`purchase_id`);

--
-- Các ràng buộc cho bảng `productImages`
--
ALTER TABLE `productImages`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Các ràng buộc cho bảng `purchase_info`
--
ALTER TABLE `purchase_info`
  ADD CONSTRAINT `fk_purchase_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
