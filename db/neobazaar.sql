-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table neobazaar.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `address_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_and_street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apartment_floor_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.addresses: ~0 rows (approximately)
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;

-- Dumping structure for table neobazaar.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `blog_header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `post_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.blogs: ~3 rows (approximately)
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` (`blog_id`, `blog_category_id`, `user_id`, `blog_header`, `slug`, `full_image`, `thumbnail_image`, `description`, `post_date`, `status`, `created_at`, `updated_at`) VALUES
	(4, 2, 1, 'Not your ordinary multi service.', 'not-your-ordinary-multi-service', 'images/blogs/4/1blogpost1-1024x512.jpg', 'images/blogs/4/2blogpost2-1024x512.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Malesuada sodales quisque litora dapibus primis lacinia condimentum non mauris, rutrum duis vitae fringilla vulputate nulla neque. Per convallis pulvinar sem faucibus blandit commodo nec vulputate, class fames accumsan duis eleifend quisque phasellus.</p>', '2021-02-02', 1, '2021-02-01 04:17:51', '2021-02-07 06:27:38'),
	(5, 3, 1, 'We design functional best multi', 'we-design-functional-best-multi', 'images/blogs/5/1blogpost4-1024x512.jpg', 'images/blogs/5/2blogpost5-1024x512.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Malesuada sodales quisque litora dapibus primis lacinia condimentum non mauris, rutrum duis vitae fringilla vulputate nulla neque. Per convallis pulvinar sem faucibus blandit commodo nec vulputate, class fames accumsan duis eleifend quisque phasellus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Malesuada sodales quisque litora dapibus primis lacinia condimentum non mauris, rutrum duis vitae fringilla vulputate nulla neque. Per convallis pulvinar sem faucibus blandit commodo nec vulputate, class fames accumsan duis eleifend quisque phasellus.</p>', '2021-02-07', 1, '2021-02-07 06:28:27', '2021-02-07 11:22:56'),
	(6, 3, 1, 'We bring you the best by working', 'we-bring-you-the-best-by-working', 'images/blogs/6/1blogpost7-1024x512.jpg', 'images/blogs/6/2blogpost7-1024x512.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Malesuada sodales quisque litora dapibus primis lacinia condimentum non mauris, rutrum duis vitae fringilla vulputate nulla neque. Per convallis pulvinar sem faucibus blandit commodo nec vulputate, class fames accumsan duis eleifend quisque phasellus.</p><blockquote style="" class="blockquote">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Malesuada sodales quisque litora dapibus primis lacinia condimentum non mauris, rutrum duis vitae fringilla vulputate nulla neque. Per convallis pulvinar sem faucibus blandit commodo nec vulputate, class fames accumsan duis eleifend quisque phasellus.</blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Malesuada sodales quisque litora dapibus primis lacinia condimentum non mauris, rutrum duis vitae fringilla vulputate nulla neque. Per convallis pulvinar sem faucibus blandit commodo nec vulputate, class fames accumsan duis eleifend quisque phasellus.</p>', '2021-02-07', 1, '2021-02-07 06:29:08', '2021-02-08 06:56:23');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;

-- Dumping structure for table neobazaar.blog_categories
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `blog_category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.blog_categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` (`blog_category_id`, `category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'Healthy', 'healthy', 1, '2021-01-30 09:40:13', '2021-02-07 06:17:44'),
	(3, 'Fashion', 'fashion', 1, '2021-01-30 10:04:18', '2021-02-07 06:17:57'),
	(4, 'Leafy green', 'leafy-green', 1, '2021-02-07 06:18:17', '2021-02-07 06:18:17');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;

-- Dumping structure for table neobazaar.blog_reviews
CREATE TABLE IF NOT EXISTS `blog_reviews` (
  `blog_review_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `reply_id` bigint(20) unsigned DEFAULT NULL,
  `review` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_review_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.blog_reviews: ~1 rows (approximately)
/*!40000 ALTER TABLE `blog_reviews` DISABLE KEYS */;
INSERT INTO `blog_reviews` (`blog_review_id`, `blog_id`, `user_id`, `reply_id`, `review`, `reply`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 1, 'dfsadf', 'sdfsdf', 1, '2021-02-08 05:39:34', '2021-02-08 06:09:59'),
	(2, 4, 1, 1, 'dsfasd', 'sssss', 1, '2021-02-08 06:33:40', '2021-02-08 06:33:52');
/*!40000 ALTER TABLE `blog_reviews` ENABLE KEYS */;

-- Dumping structure for table neobazaar.districts
CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.districts: ~64 rows (approximately)
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` (`district_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Comilla', NULL, NULL),
	(2, 'Feni', NULL, NULL),
	(3, 'Brahmanbaria', NULL, NULL),
	(4, 'Rangamati', NULL, NULL),
	(5, 'Noakhali', NULL, NULL),
	(6, 'Chandpur', NULL, NULL),
	(7, 'Lakshmipur', NULL, NULL),
	(8, 'Chattogram', NULL, NULL),
	(9, 'Coxsbazar', NULL, NULL),
	(10, 'Khagrachhari', NULL, NULL),
	(11, 'Bandarban', NULL, NULL),
	(12, 'Sirajganj', NULL, NULL),
	(13, 'Pabna', NULL, NULL),
	(14, 'Bogura', NULL, NULL),
	(15, 'Rajshahi', NULL, NULL),
	(16, 'Natore', NULL, NULL),
	(17, 'Joypurhat', NULL, NULL),
	(18, 'Chapainawabganj', NULL, NULL),
	(19, 'Naogaon', NULL, NULL),
	(20, 'Jashore', NULL, NULL),
	(21, 'Satkhira', NULL, NULL),
	(22, 'Meherpur', NULL, NULL),
	(23, 'Narail', NULL, NULL),
	(24, 'Chuadanga', NULL, NULL),
	(25, 'Kushtia', NULL, NULL),
	(26, 'Magura', NULL, NULL),
	(27, 'Khulna', NULL, NULL),
	(28, 'Bagerhat', NULL, NULL),
	(29, 'Jhenaidah', NULL, NULL),
	(30, 'Jhalakathi', NULL, NULL),
	(31, 'Patuakhali', NULL, NULL),
	(32, 'Pirojpur', NULL, NULL),
	(33, 'Barisal', NULL, NULL),
	(34, 'Bhola', NULL, NULL),
	(35, 'Barguna', NULL, NULL),
	(36, 'Sylhet', NULL, NULL),
	(37, 'Moulvibazar', NULL, NULL),
	(38, 'Habiganj', NULL, NULL),
	(39, 'Sunamganj', NULL, NULL),
	(40, 'Narsingdi', NULL, NULL),
	(41, 'Gazipur', NULL, NULL),
	(42, 'Shariatpur', NULL, NULL),
	(43, 'Narayanganj', NULL, NULL),
	(44, 'Tangail', NULL, NULL),
	(45, 'Kishoreganj', NULL, NULL),
	(46, 'Manikganj', NULL, NULL),
	(47, 'Dhaka', NULL, NULL),
	(48, 'Munshiganj', NULL, NULL),
	(49, 'Rajbari', NULL, NULL),
	(50, 'Madaripur', NULL, NULL),
	(51, 'Gopalganj', NULL, NULL),
	(52, 'Faridpur', NULL, NULL),
	(53, 'Panchagarh', NULL, NULL),
	(54, 'Dinajpur', NULL, NULL),
	(55, 'Lalmonirhat', NULL, NULL),
	(56, 'Nilphamari', NULL, NULL),
	(57, 'Gaibandha', NULL, NULL),
	(58, 'Thakurgaon', NULL, NULL),
	(59, 'Rangpur', NULL, NULL),
	(60, 'Kurigram', NULL, NULL),
	(61, 'Sherpur', NULL, NULL),
	(62, 'Mymensingh', NULL, NULL),
	(63, 'Jamalpur', NULL, NULL),
	(64, 'Netrokona', NULL, NULL);
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;

-- Dumping structure for table neobazaar.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table neobazaar.favorites
CREATE TABLE IF NOT EXISTS `favorites` (
  `favorite_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_info_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`favorite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.favorites: ~4 rows (approximately)
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` (`favorite_id`, `product_info_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
	(2, 7, 1, 1, '2021-02-09 04:59:40', '2021-02-09 04:59:40'),
	(3, 5, 1, 1, '2021-02-09 06:59:49', '2021-02-09 06:59:49'),
	(4, 6, 1, 1, '2021-02-09 07:12:05', '2021-02-09 07:12:05'),
	(10, 3, 1, 1, '2021-02-10 05:17:47', '2021-02-10 05:17:47'),
	(11, 2, 1, 1, '2021-02-10 05:24:31', '2021-02-10 05:24:31');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;

-- Dumping structure for table neobazaar.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.migrations: ~16 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(7, '2014_10_12_000000_create_users_table', 1),
	(8, '2014_10_12_100000_create_password_resets_table', 1),
	(9, '2019_08_19_000000_create_failed_jobs_table', 1),
	(10, '2020_06_20_094008_create_roles_table', 1),
	(11, '2021_01_27_055735_create_product_categories_table', 1),
	(14, '2021_01_27_064448_create_product_sub_categories_table', 2),
	(15, '2021_01_27_110424_create_product_items_table', 3),
	(18, '2021_01_28_044332_create_product_weights_table', 4),
	(19, '2021_01_28_061336_create_product_infos_table', 5),
	(20, '2021_01_30_062445_create_blog_categories_table', 6),
	(21, '2021_01_30_094154_create_blogs_table', 7),
	(22, '2021_02_04_045622_create_product_reviews_table', 8),
	(23, '2021_02_08_042131_create_blog_reviews_table', 9),
	(25, '2021_02_08_093535_create_favorites_table', 10),
	(26, '2021_02_15_094833_create_districts_table', 11),
	(27, '2021_02_15_104824_create_addresses_table', 12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table neobazaar.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table neobazaar.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_category_name` varchar(230) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.product_categories: ~3 rows (approximately)
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`product_category_id`, `product_category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'groceries', 'groceries', 1, '2021-01-27 09:55:29', '2021-01-27 09:55:29'),
	(4, 'honey', 'honey', 1, '2021-01-27 10:49:38', '2021-01-27 10:49:38'),
	(5, 'Fruitsss', 'fruitssssdfsfsd', 1, '2021-01-28 04:06:04', '2021-01-30 09:24:39');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- Dumping structure for table neobazaar.product_infos
CREATE TABLE IF NOT EXISTS `product_infos` (
  `product_info_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` double(10,2) NOT NULL,
  `sales_price` double(10,2) DEFAULT NULL,
  `percent` double(10,2) DEFAULT NULL,
  `product_item_id` bigint(20) NOT NULL,
  `product_weight_id` bigint(20) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.product_infos: ~6 rows (approximately)
/*!40000 ALTER TABLE `product_infos` DISABLE KEYS */;
INSERT INTO `product_infos` (`product_info_id`, `price`, `sales_price`, `percent`, `product_item_id`, `product_weight_id`, `product_quantity`, `sku`, `status`, `created_at`, `updated_at`) VALUES
	(2, 200.22, NULL, 0.00, 4, 1, 0, 'sdfsd', 1, '2021-01-30 06:11:36', '2021-02-04 04:44:46'),
	(3, 200.00, 180.00, 10.00, 4, 3, 225, '22', 1, '2021-01-30 06:12:00', '2021-02-03 11:41:37'),
	(4, 80.00, 70.00, 13.00, 9, 8, 200, NULL, 1, '2021-02-03 05:45:43', '2021-02-03 05:52:26'),
	(5, 35.00, NULL, 0.00, 8, 7, 0, NULL, 1, '2021-02-03 06:29:38', '2021-02-03 09:50:42'),
	(6, 204.00, NULL, 0.00, 6, 5, 222, NULL, 1, '2021-02-03 07:24:51', '2021-02-03 07:24:51'),
	(7, 222.00, 203.00, 9.00, 7, 1, 222, NULL, 1, '2021-02-03 07:25:21', '2021-02-03 08:38:43'),
	(8, 81.00, NULL, 0.00, 9, 8, 20, NULL, 1, '2021-02-10 08:35:10', '2021-02-10 08:55:08');
/*!40000 ALTER TABLE `product_infos` ENABLE KEYS */;

-- Dumping structure for table neobazaar.product_items
CREATE TABLE IF NOT EXISTS `product_items` (
  `product_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_sub_category_id` bigint(20) unsigned NOT NULL,
  `product_item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_item_description` longtext COLLATE utf8mb4_unicode_ci,
  `new_arrival` tinyint(1) DEFAULT '0',
  `popular` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.product_items: ~6 rows (approximately)
/*!40000 ALTER TABLE `product_items` DISABLE KEYS */;
INSERT INTO `product_items` (`product_item_id`, `product_sub_category_id`, `product_item_name`, `image`, `slug`, `product_item_description`, `new_arrival`, `popular`, `status`, `created_at`, `updated_at`) VALUES
	(4, 5, 'Walnuts', 'images/product_items/4/apro13-1-270x350.jpg', 'walnuts', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.<br></p>', 1, 0, 1, '2021-01-30 06:02:03', '2021-02-02 09:14:40'),
	(5, 3, 'Green beans', 'images/product_items/5/2222apro302-270x350.jpg', 'green-beans', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.<br></p>', 0, 1, 1, '2021-02-02 09:14:09', '2021-02-02 09:14:09'),
	(6, 3, 'Blood Plums', 'images/product_items/6/apro31-1-270x350.jpg', 'blood-plums', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.<br></p>', 0, 1, 1, '2021-02-02 09:16:23', '2021-02-02 09:16:23'),
	(7, 3, 'Garlic', 'images/product_items/7/apro41-1-270x350.jpg', 'garlic', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.<br></p>', 1, 1, 1, '2021-02-02 09:18:22', '2021-02-02 09:18:31'),
	(8, 3, 'Onion', 'images/product_items/8/apro161-1-270x350.jpg', 'onion', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.<br></p>', 1, 1, 1, '2021-02-02 09:19:26', '2021-02-02 09:19:26'),
	(9, 3, 'Banana', 'images/product_items/9/apro151-1-270x350.jpg', 'banana', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.<br></p>', 1, 0, 1, '2021-02-02 09:20:07', '2021-02-02 09:20:07');
/*!40000 ALTER TABLE `product_items` ENABLE KEYS */;

-- Dumping structure for table neobazaar.product_reviews
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `product_review_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_item_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `reply_id` bigint(20) DEFAULT '0',
  `review` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_review_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.product_reviews: ~11 rows (approximately)
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
INSERT INTO `product_reviews` (`product_review_id`, `product_item_id`, `user_id`, `reply_id`, `review`, `reply`, `status`, `created_at`, `updated_at`) VALUES
	(1, 8, 1, 0, 'dsafsdf', NULL, 0, '2021-02-04 06:28:07', '2021-02-04 06:28:07'),
	(2, 8, 1, 0, 'fgdfgdf', NULL, 0, '2021-02-04 06:29:27', '2021-02-04 06:29:27'),
	(3, 8, 1, 0, 'dfsdaf', NULL, 0, '2021-02-04 06:29:47', '2021-02-04 06:29:47'),
	(4, 8, 1, 0, 'dfsdfsd', NULL, 0, '2021-02-04 06:31:08', '2021-02-04 06:31:08'),
	(5, 8, 1, 0, 'dfdfsdf', NULL, 0, '2021-02-04 06:34:13', '2021-02-04 06:34:13'),
	(6, 8, 1, 0, 'afasdf', NULL, 0, '2021-02-04 06:41:27', '2021-02-04 06:41:27'),
	(7, 8, 1, 0, 'asfdasf', NULL, 0, '2021-02-04 06:42:15', '2021-02-04 06:42:15'),
	(8, 8, 1, 0, 'sadfasd', NULL, 0, '2021-02-04 06:42:43', '2021-02-04 06:42:43'),
	(9, 8, 1, 0, 'dasfasd', 'sdfsdf', 1, '2021-02-04 06:42:56', '2021-02-04 08:48:11'),
	(10, 4, 1, 0, 'sdfsd', 'asdfasdf', 1, '2021-02-04 09:20:48', '2021-02-04 09:21:09'),
	(11, 4, 1, 0, 'sdfaasdf', 'sdfads', 1, '2021-02-04 09:21:52', '2021-02-04 09:22:02');
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;

-- Dumping structure for table neobazaar.product_sub_categories
CREATE TABLE IF NOT EXISTS `product_sub_categories` (
  `product_sub_category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_sub_category_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_id` bigint(20) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.product_sub_categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `product_sub_categories` DISABLE KEYS */;
INSERT INTO `product_sub_categories` (`product_sub_category_id`, `product_sub_category_name`, `product_category_id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Group 4', 3, 'group-4', 1, '2021-01-27 10:49:24', '2021-02-02 09:06:18'),
	(4, 'Group 3', 4, 'group-3', 1, '2021-01-27 10:50:01', '2021-02-02 09:05:59'),
	(5, 'Group 2', 4, 'group-2', 1, '2021-01-28 03:58:20', '2021-02-02 09:05:38'),
	(6, 'Group 1', 5, 'group-1', 1, '2021-01-28 04:06:20', '2021-02-02 09:05:20');
/*!40000 ALTER TABLE `product_sub_categories` ENABLE KEYS */;

-- Dumping structure for table neobazaar.product_weights
CREATE TABLE IF NOT EXISTS `product_weights` (
  `product_weight_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `weight` double(8,2) NOT NULL,
  `weight_unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_weight_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.product_weights: ~6 rows (approximately)
/*!40000 ALTER TABLE `product_weights` DISABLE KEYS */;
INSERT INTO `product_weights` (`product_weight_id`, `weight`, `weight_unit`, `status`, `created_at`, `updated_at`) VALUES
	(1, 200.00, 'gm', 1, '2021-01-28 05:31:28', '2021-02-01 10:47:24'),
	(3, 100.00, 'gm', 1, '2021-01-28 05:53:12', '2021-02-01 10:47:12'),
	(4, 300.00, 'gm', 1, '2021-02-02 09:06:39', '2021-02-02 09:06:39'),
	(5, 400.00, 'gm', 1, '2021-02-02 09:06:46', '2021-02-02 09:06:46'),
	(6, 500.00, 'gm', 1, '2021-02-02 09:06:53', '2021-02-02 09:06:53'),
	(7, 1.00, 'kg', 1, '2021-02-02 09:07:02', '2021-02-02 09:07:02'),
	(8, 4.00, 'dozen', 1, '2021-02-03 05:52:09', '2021-02-03 05:52:09');
/*!40000 ALTER TABLE `product_weights` ENABLE KEYS */;

-- Dumping structure for table neobazaar.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `roles_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`roles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table neobazaar.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) DEFAULT '2',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table neobazaar.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `name`, `email`, `mobile_no`, `photo`, `role_id`, `email_verified_at`, `google_id`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Neo Bazaar Admin', 'admin@admin.com', NULL, NULL, 1, NULL, NULL, '$2y$10$q5JpatwCc3qnbMSfQsJJs.wUhBW1Hdy6.3kVcMsmFMKgcd/orZmqu', NULL, 1, '2021-01-27 08:27:56', '2021-01-27 08:27:56'),
	(2, 'dewanmdjurat', 'dewanjuratshadow@gmail.com', '01935323685', NULL, 2, NULL, NULL, '$2y$10$XXQHNvSyg1Nlc942dMbksuj8LhtFzCSjUTpjSmncDj84JTzBYiSAW', NULL, 1, '2021-02-15 05:07:36', '2021-02-15 10:44:28'),
	(3, 'Antopolis', 'superadmin@gmail.com', NULL, NULL, 2, NULL, NULL, '$2y$10$8EagPoIuNZ/ueSFskkgq7.Co858encWas8ywBPHOmvtIxWB9nZ1Pu', NULL, 1, '2021-02-15 06:00:39', '2021-02-15 06:00:39'),
	(4, 'Antopolis', 'superadmin1@gmail.com', NULL, NULL, 2, NULL, NULL, '$2y$10$wrCAjvMV7EniZMfQHgv8T.IoIzExvNq79iPOJjGvZhY/XqVdoGtIi', NULL, 1, '2021-02-15 06:01:12', '2021-02-15 06:01:12'),
	(5, 'Antopolis', 'superadmin2@gmail.com', '01790538712', NULL, 2, NULL, NULL, '$2y$10$v6zZ6pO7C3KwTyzbOS.oaOUXpbVFlPPmh/hU5bB8JlecCBpEhb472', NULL, 1, '2021-02-15 06:05:30', '2021-02-15 06:05:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
