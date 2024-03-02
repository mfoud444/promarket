

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promarketDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL COMMENT 'ADMINS ID',
  `admin_name` varchar(64) NOT NULL,
  `admin_email` varchar(64) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_password` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `admin_type` enum('Root Admin','Content Manager','Sales Manager','Technical Operator') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `admin_email`, `admin_image`, `admin_password`, `admin_status`, `admin_type`, `created_at`, `updated_at`) VALUES
(1, 'Content Manager', 'contentmanager@gmail.com', 'ADMINIMAGE_20230928002358_rootadmin.png', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Active', 'Content Manager', '2023-09-28 00:23:58', NULL),
(2, 'Technical Operator', 'technicaloperator@gmail.com', 'ADMINIMAGE_20230928002518_rootadmin.png', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Active', 'Technical Operator', '2023-09-28 00:25:18', NULL),
(3, 'Root Admin', 'rootadmin@gmail.com', 'ADMINIMAGE_20230928002622_rootadmin.png', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Active', 'Root Admin', '2023-09-28 00:26:22', NULL),
(4, 'Sales Manager', 'salesmanager@gmail.com', 'ADMINIMAGE_20230928002754_rootadmin.png', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Active', 'Sales Manager', '2023-09-28 00:27:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL COMMENT 'BRANDS ID',
  `brand_name` varchar(64) NOT NULL,
  `brand_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `brand_image` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'CATEGORIES ID',
  `category_name` varchar(64) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `category_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_status`, `created_at`, `updated_at`, `category_image`) VALUES
(1, 'الرسم والاعمال اليدوية', 'Active', '2023-10-17 21:01:59', '2023-10-17 21:01:59', 'Category_20231018000414_Hand Holding Pen.jpeg'),
(2, 'قسم البخور', 'Active', '2023-10-17 21:01:59', '2023-10-17 21:01:59', 'Category_20231018000503_download (1).jpeg'),
(3, 'قسم صناعة التوابل', 'Active', '2023-10-17 21:01:59', '2023-10-17 21:01:59', 'Category_20231018000646_66.jpeg'),
(4, 'قسم الطعام', 'Active', '2023-10-17 21:01:59', '2023-10-17 21:01:59', 'Category_20231018000755_Anime food.jpeg'),
(5, 'قسم المنسوجات اليدوية', 'Active', '2023-10-17 21:01:59', '2023-10-17 21:01:59', 'Category_20231018000829_download.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL COMMENT 'CONTACTS ID',
  `contacts_name` varchar(64) NOT NULL,
  `contacts_email` varchar(64) NOT NULL,
  `contacts_phone` varchar(32) NOT NULL,
  `contacts_overview` varchar(512) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contacts_name`, `contacts_email`, `contacts_phone`, `contacts_overview`, `created_at`, `updated_at`) VALUES
(18, 'user1 demo', 'user2@gmail.com', '+966 123456789', 'Grate Job', '2023-09-28 19:12:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL COMMENT 'CUSTOMERS ID',
  `customer_name` varchar(128) NOT NULL,
  `customer_email` varchar(64) NOT NULL,
  `customer_mobile` varchar(16) NOT NULL,
  `customer_address` varchar(256) NOT NULL,
  `customer_password` varchar(128) NOT NULL,
  `customer_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_email`, `customer_mobile`, `customer_address`, `customer_password`, `customer_status`, `created_at`, `updated_at`) VALUES
(1, 'User Demo', 'user1@gmail.com', '+966 53 332 4648', 'Saudia Arabia , Al Baha', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2023-09-22 08:40:58', NULL),
(2, 'User 2', 'user2@gmail.com', '+966552224595', 'Al Baha', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Active', '2023-09-28 18:25:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL COMMENT 'DELIVERIES ID',
  `customer_id` int(11) NOT NULL,
  `shipping_charge` enum('50','120') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `customer_id`, `shipping_charge`, `created_at`, `updated_at`) VALUES
(17, 2, '50', '2023-10-24 16:05:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL COMMENT 'DISCOUNT ID',
  `discount_code` varchar(256) NOT NULL,
  `price_discount_amount` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL COMMENT 'INVOICE ID',
  `invoice_id` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_amount` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `customer_id`, `shipping_id`, `order_id`, `transaction_amount`, `created_at`, `updated_at`) VALUES
(8, 'COD#63248', 2, 9, 13, 0, '2023-10-18 18:04:36', NULL),
(9, 'COD#62546', 2, 10, 14, 0, '2023-10-18 18:05:18', NULL),
(10, 'COD#42345', 2, 11, 15, 0, '2023-10-18 18:08:20', NULL),
(11, 'COD#59616', 2, 12, 16, 0, '2023-10-18 18:25:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'ORDERS ID',
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `sub_total` double NOT NULL,
  `tax` double NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `discount_amount` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_method` enum('SSL COMMERZ','PayPal','Cash On Delivery') NOT NULL DEFAULT 'Cash On Delivery',
  `transaction_id` varchar(256) NOT NULL,
  `transaction_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Paid',
  `order_item_status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `sub_total`, `tax`, `delivery_charge`, `discount_amount`, `grand_total`, `payment_method`, `transaction_id`, `transaction_status`, `order_item_status`, `created_at`, `updated_at`) VALUES
(13, 2, '2023-10-18 18:03:45', 150, 1.8, 50, 0, 202, 'Cash On Delivery', 'COD#2', 'Unpaid', 'Pending', '2023-10-18 18:03:45', NULL),
(14, 2, '2023-10-18 18:05:07', 40, 0.48, 50, 0, 90, 'Cash On Delivery', 'COD#2', 'Unpaid', 'Pending', '2023-10-18 18:05:07', NULL),
(15, 2, '2023-10-18 18:08:09', 40, 0.48, 50, 0, 90, 'Cash On Delivery', 'COD#2', 'Unpaid', 'Pending', '2023-10-18 18:08:09', NULL),
(16, 2, '2023-10-18 18:25:15', 249, 2.988, 50, 0, 302, 'Cash On Delivery', 'COD#2', 'Unpaid', 'Pending', '2023-10-18 18:25:15', NULL),
(17, 2, '2023-10-24 16:05:06', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:05:06', NULL),
(18, 2, '2023-10-24 16:09:03', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:09:03', NULL),
(19, 2, '2023-10-24 16:12:37', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:12:37', NULL),
(20, 2, '2023-10-24 16:13:57', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:13:57', NULL),
(21, 2, '2023-10-24 16:15:49', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:15:49', NULL),
(22, 2, '2023-10-24 16:16:15', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:16:15', NULL),
(23, 2, '2023-10-24 16:16:33', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:16:33', NULL),
(24, 2, '2023-10-24 16:16:48', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:16:48', NULL),
(25, 2, '2023-10-24 16:17:26', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:17:26', NULL),
(26, 2, '2023-10-24 16:18:08', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:18:08', NULL),
(27, 2, '2023-10-24 16:18:23', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:18:23', NULL),
(28, 2, '2023-10-24 16:19:13', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:19:13', NULL),
(29, 2, '2023-10-24 16:20:18', 0, 0, 50, 0, 50, 'Cash On Delivery', 'COD#2', 'Paid', 'Pending', '2023-10-24 16:20:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL COMMENT 'ORDER ITEMS ID',
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `prod_quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `customer_id`, `order_id`, `product_id`, `product_price`, `prod_quantity`, `created_at`, `updated_at`) VALUES
(19, 2, 13, 110, 150, 1, '2023-10-18 18:03:45', NULL),
(20, 2, 14, 122, 40, 1, '2023-10-18 18:05:08', NULL),
(21, 2, 15, 122, 40, 1, '2023-10-18 18:08:09', NULL),
(22, 2, 16, 124, 99, 1, '2023-10-18 18:25:15', NULL),
(23, 2, 16, 110, 150, 1, '2023-10-18 18:25:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'PRODUCTS ID',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_summary` text NOT NULL,
  `product_details` text NOT NULL,
  `product_master_image` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` double DEFAULT NULL,
  `product_discount_price` double DEFAULT NULL,
  `discount_start` datetime DEFAULT NULL,
  `discount_ends` datetime DEFAULT NULL,
  `product_status` enum('In Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `product_featured` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `product_tags` varchar(512) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `products_image_one` text DEFAULT NULL,
  `products_image_two` text DEFAULT NULL,
  `products_image_three` text DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `product_name`, `product_summary`, `product_details`, `product_master_image`, `product_quantity`, `product_price`, `product_discount_price`, `discount_start`, `discount_ends`, `product_status`, `product_featured`, `product_tags`, `created_at`, `updated_at`, `products_image_one`, `products_image_two`, `products_image_three`, `brand_id`) VALUES
(106, 1, 1, 'لوحات بالألوان الزيتية ', '٤ مجسمات فخار ( الالوان عشوائية )', '٤ مجسمات فخار ( الالوان عشوائية )', 'PRODUCT_20231018001422_صورة16.jpg', 34, 70, NULL, NULL, NULL, 'Out of Stock', 'NO', 'مجسمات فخار', '2023-10-18 00:14:22', NULL, '', '', '', NULL),
(107, 1, 1, 'لوحات كبير للحائط', '                 \r\nلوحة جداريه 165x150', '                 \r\nلوحة جداريه 165x150', 'PRODUCT_20231018155518_صورة14.jpg', 80, 20, NULL, NULL, NULL, 'Out of Stock', 'NO', 'لوحة جداريه', '2023-10-18 15:55:18', NULL, '', '', '', NULL),
(108, 1, 2, 'مجسمات بالفخار ', '           \r\n٤ مجسمات فخار ( الالوان عشوائية )', '           \r\n٤ مجسمات فخار ( الالوان عشوائية )', 'PRODUCT_20231018155745_صورة17.jpg', 60, 120, NULL, NULL, NULL, 'Out of Stock', 'NO', '  مجسمات فخار-  ( الالوان عشوائية )', '2023-10-18 15:57:45', NULL, '', '', '', NULL),
(109, 1, 2, 'اكسسوارات مصنوعة باليد', 'اساور خرز ب درجات الازرق مقاس واحد قابل للتعديل', 'اساور خرز ب درجات الازرق مقاس واحد قابل للتعديل ', 'PRODUCT_20231018155930_صورة15.jpg', 70, 50, NULL, NULL, NULL, 'Out of Stock', 'NO', 'اساور- خرز - ', '2023-10-18 15:59:30', NULL, '', '', '', NULL),
(110, 2, 3, 'العود السعودي   الملكي', '4 علب عود سعودي', '4 علب عود سعودي', 'PRODUCT_20231018160141_صورة12.png', 30, 150, NULL, NULL, NULL, 'Out of Stock', 'NO', ' علب -عود سعودي', '2023-10-18 16:01:41', NULL, '', '', '', NULL),
(111, 2, 3, 'العود الأزرق', '									4 علب عود ازرق 								', '									4 علب عود ازرق 								', 'PRODUCT_20231018160412_صورة10.jpg', 60, 200, NULL, NULL, NULL, 'Out of Stock', 'NO', ' علب عود ازرق ', '2023-10-18 16:04:12', NULL, '', '', '', NULL),
(112, 2, 4, ' المبثوث الملكي ', '5 علب مبثوث', '5 علب مبثوث', 'PRODUCT_20231018160533_صورة13.jpg', 80, 50, NULL, NULL, NULL, 'Out of Stock', 'NO', 'علب مبثوث', '2023-10-18 16:05:33', NULL, '', '', '', NULL),
(113, 2, 4, 'مبثوث ( اثير )', 'علبتين من مبثوث اثير ', 'علبتين من مبثوث اثير ', 'PRODUCT_20231018160816_صورة11.jpg', 90, 170, NULL, NULL, NULL, 'Out of Stock', 'NO', ' مبثوث اثير ', '2023-10-18 16:08:16', NULL, '', '', '', NULL),
(114, 3, 5, 'بهارات الفلفل الأسود', '5 علب من الفلفل الأسود ويقدم على حسب الكمية المرادة', '5 علب من الفلفل الأسود ويقدم على حسب الكمية المرادة', 'PRODUCT_20231018160948_صورة8.jpg', 70, 79, NULL, NULL, NULL, 'Out of Stock', 'NO', 'علب من الفلفل الأسود', '2023-10-18 16:09:48', NULL, '', '', '', NULL),
(115, 3, 5, ' بهارات الكريول ', '6 علب ويقدم على حسب الكمية المرادة', '6 علب ويقدم على حسب الكمية المرادة', 'PRODUCT_20231018161116_صورة6.jpg', 900, 89, NULL, NULL, NULL, 'Out of Stock', 'NO', ' بهارات الكريول ', '2023-10-18 16:11:16', NULL, '', '', '', NULL),
(116, 3, 6, 'بهارات مشكلة', '5 علب  ويقدم على حسب الكمية المرادة', '5 علب  ويقدم على حسب الكمية المرادة', 'PRODUCT_20231018161225_صورة9.jpg', 89, 90, NULL, NULL, NULL, 'Out of Stock', 'NO', 'بهارات مشكلة', '2023-10-18 16:12:25', NULL, '', '', '', NULL),
(117, 3, 6, ' بهارات بيضاء', '6 علب ويقدم على حسب الكمية المرادة', '6 علب ويقدم على حسب الكمية المرادة', 'PRODUCT_20231018161331_صورة7.jpg', 77, 89, NULL, NULL, NULL, 'Out of Stock', 'NO', ' بهارات بيضاء', '2023-10-18 16:13:31', NULL, '', '', '', NULL),
(118, 4, 7, 'حلى الأوريو ', 'حلا الأوريو يكفي ٨الى ١٠ اشخاص', 'حلا الأوريو يكفي ٨الى ١٠ اشخاص', 'PRODUCT_20231018161441_صورة4.jpg', 900, 60, NULL, NULL, NULL, 'Out of Stock', 'NO', 'حلى الأوريو ', '2023-10-18 16:14:41', NULL, '', '', '', NULL),
(119, 4, 7, 'حلى الخشخش', 'حلا الخشاش يكفي ٥ الى ٩ اشخاص ', 'حلا الخشاش يكفي ٥ الى ٩ اشخاص ', 'PRODUCT_20231018161545_صورة2.jpg', 40, 120, NULL, NULL, NULL, 'Out of Stock', 'NO', 'حلا الخشاش  ', '2023-10-18 16:15:45', NULL, '', '', '', NULL),
(120, 4, 8, 'معجنات محشوة', 'معجنات محشوه بالجبنة والدجاج ٤٠ قطعة', 'معجنات محشوه بالجبنة والدجاج ٤٠ قطعة', 'PRODUCT_20231018161646_صورة5.jpg', 90, 78, NULL, NULL, NULL, 'Out of Stock', 'NO', 'معجنات محشوة', '2023-10-18 16:16:46', NULL, '', '', '', NULL),
(121, 4, 8, 'معجنات لمرضى السكر', 'معجنات لمرضى السكر ٢٤ قطعه', 'معجنات لمرضى السكر ٢٤ قطعه', 'PRODUCT_20231018161753_صورة3.jpg', 88, 70, NULL, NULL, NULL, 'Out of Stock', 'NO', 'معجنات لمرضى السكر', '2023-10-18 16:17:53', NULL, '', '', '', NULL),
(122, 5, NULL, ' دمى منسوجة باليد  ', 'دميه بحجم كفة اليد استخدام متعدد ( تعليقة مفاتيح - زينه مكتب - دميه )', 'دميه بحجم كفة اليد استخدام متعدد ( تعليقة مفاتيح - زينه مكتب - دميه )', 'PRODUCT_20231018162150_صورة1.jpg', 90, 40, NULL, NULL, NULL, 'Out of Stock', 'NO', ' دمى منسوجة باليد  ', '2023-10-18 16:21:50', NULL, '', '', '', NULL),
(124, 5, NULL, 'معاطف شتوية منسوجة بالقطن', 'معطف ابيض مصنوع من القطن قياس واحد ( M )', 'معطف ابيض مصنوع من القطن قياس واحد ( M )', 'PRODUCT_20231018174442_ooo.png', 78, 99, NULL, NULL, NULL, 'Out of Stock', 'NO', 'معاطف شتوية منسوجة بالقطن', '2023-10-18 17:44:42', NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(11) NOT NULL COMMENT 'SHIPPING ID',
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shipcstmr_name` varchar(128) NOT NULL,
  `shipcstmr_mobile` varchar(32) NOT NULL,
  `shipcstmr_streetadd` varchar(256) NOT NULL,
  `shipcstmr_city` varchar(64) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `customer_id`, `order_id`, `shipcstmr_name`, `shipcstmr_mobile`, `shipcstmr_streetadd`, `shipcstmr_city`, `created_at`, `updated_at`) VALUES
(9, 2, 13, 'user2 Demo', '+966123456789', 'Al Baha', 'Al Baha', '2023-10-18 18:04:30', NULL),
(10, 2, 14, 'user2 Demo', '+966123456789', 'Al Baha', 'Al Baha', '2023-10-18 18:05:17', NULL),
(11, 2, 15, 'user2 Demo', '+966123456789', 'Al Baha', 'Al Baha', '2023-10-18 18:08:16', NULL),
(12, 2, 16, 'user2 Demo', '+966123456789', 'Al Baha', 'Al Baha', '2023-10-18 18:25:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopcarts`
--

CREATE TABLE `shopcarts` (
  `id` int(11) NOT NULL COMMENT 'SHOPCARTS ID',
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL COMMENT 'SUBCATEGORIES ID',
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(128) NOT NULL,
  `subcategory_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `subcategory_banner` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_status`, `subcategory_banner`, `created_at`, `updated_at`) VALUES
(1, 1, 'الرسم والفن', 'Active', 'SUBCATBANNER__20231018153115_Wh.jpeg', '2023-10-17 21:02:02', '2023-10-17 21:02:02'),
(2, 1, 'الأعمال اليدوية', 'Active', 'SUBCATBANNER__20231018154628_ii.jpng.png', '2023-10-17 21:02:02', '2023-10-17 21:02:02'),
(3, 2, 'العود', 'Active', 'SUBCATBANNER__20231018153920_WhatsApp Image 2023-10-18 at 12.15.59 AM.jpeg', '2023-10-17 21:02:02', '2023-10-17 21:02:02'),
(4, 2, 'مبثوث ومعمول', 'Active', 'SUBCATBANNER__20231018154029_333.jpeg', '2023-10-17 21:02:02', '2023-10-17 21:02:02'),
(5, 3, 'البهارات الحارة', 'Active', 'SUBCATBANNER__20231018154107_444.jpeg', '2023-10-17 21:02:02', '2023-10-17 21:02:02'),
(6, 3, 'بهارات الكبسة', 'Active', 'SUBCATBANNER__20231018154148_55.jpeg', '2023-10-17 21:02:02', '2023-10-17 21:02:02'),
(7, 4, 'الحلى', 'Active', 'SUBCATBANNER__20231018154227_66.jpeg', '2023-10-17 21:02:02', '2023-10-17 21:02:02'),
(8, 4, 'المعجنات', 'Active', 'SUBCATBANNER__20231018154307_777.jpeg', '2023-10-17 21:02:02', '2023-10-17 21:02:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
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
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shipping_id` (`shipping_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ADMINS ID', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CATEGORIES ID', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CONTACTS ID', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CUSTOMERS ID', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DELIVERIES ID', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DISCOUNT ID';

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'INVOICE ID', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDERS ID', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDER ITEMS ID', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRODUCTS ID', AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHIPPING ID', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shopcarts`
--
ALTER TABLE `shopcarts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHOPCARTS ID', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SUBCATEGORIES ID', AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shippings_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD CONSTRAINT `shopcarts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shopcarts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
