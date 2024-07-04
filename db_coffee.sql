-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2024 at 06:31 AM
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
-- Database: `db_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `transport_fee` double NOT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `transaction_id`, `product_id`, `total_item`, `total_price`, `transport_fee`, `discount_id`, `created_at`, `updated_at`) VALUES
(18, 5, 11, 1, 32000, 15000, 2, '2024-07-02 00:22:42', '2024-07-02 00:22:42'),
(19, 5, 10, 1, 350000, 15000, 2, '2024-07-02 00:22:42', '2024-07-02 00:22:42'),
(20, 5, 2, 2, 50000, 15000, 2, '2024-07-02 00:22:42', '2024-07-02 00:22:42'),
(21, 5, 1, 1, 20000, 15000, 2, '2024-07-02 00:22:42', '2024-07-02 00:22:42'),
(22, 5, 13, 1, 40000, 15000, 2, '2024-07-02 00:22:42', '2024-07-02 00:22:42'),
(23, 6, 11, 1, 32000, 15000, 2, '2024-07-02 00:26:38', '2024-07-02 00:26:38'),
(24, 6, 10, 1, 350000, 15000, 2, '2024-07-02 00:26:38', '2024-07-02 00:26:38'),
(25, 6, 2, 2, 50000, 15000, 2, '2024-07-02 00:26:38', '2024-07-02 00:26:38'),
(26, 6, 1, 1, 20000, 15000, 2, '2024-07-02 00:26:38', '2024-07-02 00:26:38'),
(27, 6, 13, 1, 40000, 15000, 2, '2024-07-02 00:26:38', '2024-07-02 00:26:38'),
(28, 7, 13, 2, 80000, 15000, 2, '2024-07-02 01:03:28', '2024-07-02 01:03:28'),
(29, 7, 10, 2, 700000, 15000, 2, '2024-07-02 01:03:28', '2024-07-02 01:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `condition` int(11) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `date_start`, `date_end`, `code`, `amount`, `number`, `condition`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mã gỉam giá 1', '2024-06-28', '2027-06-20', 'code', 12, 5000, 1, 'active', '2024-06-28 06:53:40', '2024-06-28 06:53:40'),
(2, 'Mã gỉam giá 2', '2024-06-28', '2027-06-20', 'code_1', 11, 50, 2, 'active', '2024-06-28 06:53:40', '2024-07-02 01:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2024_06_23_103418_create_personal_access_tokens_table', 1),
(6, '2024_06_23_103118_create_products_table', 2),
(7, '2024_06_23_104436_create_product_categories_table', 2),
(8, '2024_06_23_105137_add_new_columns_to_products_table', 2),
(9, '2024_06_23_115526_add_button_fields_to_products_table', 3),
(10, '2024_06_23_121047_add_thummail_to_products_table', 4),
(11, '2024_06_25_074511_create_reviews_table', 5),
(12, '2024_06_25_082048_add_review_id_to_products_table', 6),
(13, '2024_06_25_083021_drop_review_id_column_from_products_table', 7),
(14, '2024_06_25_085037_create_images_table', 8),
(15, '2024_06_25_092138_create_product_sizes_table', 9),
(16, '2024_06_28_063922_create_coupons_table', 10),
(17, '2024_06_30_074214_add_phone_address_status_to_users_table', 11),
(18, '2024_06_30_074624_add_status_to_user', 12),
(19, '2024_07_01_034957_create_personal_access_tokens_table', 13),
(20, '2024_07_02_020324_create_carts_table', 14),
(21, '2024_07_02_020324_create_transactions_table', 14),
(22, '2024_07_02_070612_add_transaction_id_to_carts_table', 15),
(23, '2024_07_02_102255_create_tags_table', 16),
(24, '2024_07_02_102350_create_categories_table', 16),
(25, '2024_07_02_103300_create_posts_table', 16),
(26, '2024_07_02_103355_create_comments_table', 16),
(27, '2024_07_02_105026_create_post_tags_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 7, 'auth', 'f1536bb887bfa1fce56fcd55a84a5b6961786fbf737ed12371c77596bc83e7a2', '[\"*\"]', NULL, NULL, '2024-07-01 17:50:18', '2024-07-01 17:50:18'),
(2, 'App\\Models\\User', 8, 'auth', 'd1bbad8227370197e2725ef78bbf1b2f63e2bcf68b26e60bbd09ca244f50441d', '[\"*\"]', NULL, NULL, '2024-07-01 17:52:15', '2024-07-01 17:52:15'),
(3, 'App\\Models\\User', 8, 'authToken', 'ee1222f813def01a4b66c87b17f4ab0c38b10252e8fb948e283add446b82c65d', '[\"*\"]', '2024-07-01 18:11:43', NULL, '2024-07-01 17:59:05', '2024-07-01 18:11:43'),
(4, 'App\\Models\\User', 8, 'authToken', '2f4377ccfb4933e8d9e245787ed776152f1d38bc534cf7670a449908b8939fe9', '[\"*\"]', '2024-07-01 18:13:18', NULL, '2024-07-01 18:12:28', '2024-07-01 18:13:18'),
(5, 'App\\Models\\User', 8, 'authToken', 'dd2d63cae478298fc2cdba19a298ec096d049b1783564b71004952f7af1f2b90', '[\"*\"]', '2024-07-03 05:21:22', NULL, '2024-07-01 18:32:09', '2024-07-03 05:21:22'),
(6, 'App\\Models\\User', 8, 'authToken', '0bf699f1d0b9c1293d952010885b7008a79088edc53f347ef618509c5ee6df49', '[\"*\"]', '2024-07-03 21:25:16', NULL, '2024-07-03 05:22:25', '2024-07-03 21:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokenss`
--

CREATE TABLE `personal_access_tokenss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `content`, `image`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'title 1', 'mo ta', 'title 1title 1title 1title 1title 1title 1', 'https://mona.media/wp-content/uploads/2023/06/giao-dien-nguoi-dung.png', 4, 5, '2024-07-02 16:04:13', NULL),
(2, 'title 2', 'mo ta 2', 'title 1title 1title 1sdsaáfdfadfsa', 'https://mona.media/wp-content/uploads/2023/06/ui-khong-hieu-qua.png', 2, 8, '2024-07-02 16:04:21', NULL),
(3, 'title 3', 'mo ta 3', 'title 1title 1title 1title 1title 1title 1', 'https://mona.media/wp-content/uploads/2023/06/giao-dien-nguoi-dung.png', 1, 5, '2024-07-04 16:04:24', NULL),
(4, 'title 4', 'mo ta 4', 'title 1title 1title 1sdsaáfdfadfsa', 'https://mona.media/wp-content/uploads/2023/06/ui-khong-hieu-qua.png', 2, 8, '2024-07-17 16:04:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'category 1', NULL, NULL),
(2, 'category 2', NULL, NULL),
(3, 'category 4', NULL, NULL),
(4, 'category 3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `content`, `post_id`, `user_id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'hello ', 1, 5, 'tom', 'tom@gmail.com', '2024-07-03 12:31:38', '2024-07-03 12:31:38'),
(2, 'chaof cau', 1, 8, 'turng', 'email@gmail.com', '2024-07-05 03:18:05', '2024-07-20 03:18:05'),
(3, 'hehe', 1, 8, 'Đào Nhật Trung', 'trungdao1@gmail.com', '2024-07-03 20:38:38', '2024-07-03 20:38:38'),
(4, 'hello 4', 1, 8, 'Đào Nhật Trung', 'trungdao@gmail.com', '2024-07-03 20:45:18', '2024-07-03 20:45:18'),
(5, 'hêhheeheeheheh', 1, 8, 'Đào Nhật Trung', 'trungdao@gmail.com', '2024-07-03 20:56:58', '2024-07-03 20:56:58'),
(6, 'dsadas', 1, 8, 'Đào Nhật Trung', 'trungdao@gmail.com', '2024-07-03 20:57:35', '2024-07-03 20:57:35'),
(7, 'sdasdas', 1, 8, 'Đào Nhật Trung', 'trungdao@gmail.com', '2024-07-03 21:08:40', '2024-07-03 21:08:40'),
(8, 'xin chào admin nhe', 2, 8, 'Đào Nhật Trung', 'trungdao@gmail.com', '2024-07-03 21:19:48', '2024-07-03 21:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tag 1', NULL, NULL),
(2, 'tag 2', NULL, NULL),
(3, 'tag 3', NULL, NULL),
(4, 'tag ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` longtext NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sale` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `total_number` int(11) NOT NULL,
  `total_rating` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `button_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `content`, `category_id`, `price`, `price_sale`, `active`, `image`, `total_number`, `total_rating`, `thumbnail`, `button_link`, `button_name`, `created_at`, `updated_at`) VALUES
(1, 'Cà phê đen', 'Một ly cà phê đen đậm đà và mạnh mẽ', 'Chi tiết về cà phê đen', 1, 20000, 18000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-den-da_11.jpg', 30, 8, 'https://png.pngtree.com/thumb_back/fh260/background/20190124/pngtree-brown-simple-texture-coffee-background-image_1555.jpg', '/products/1', 'Xem chi tiết', '2024-06-23 04:07:51', '2024-06-23 04:07:51'),
(2, 'Cà phê sữa', 'Một ly cà phê sữa ngọt ngào và thơm ngon', 'Chi tiết về cà phê sữa', 3, 25000, 22000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-sua-da_3.jpg', 100, 15, 'https://www.shutterstock.com/image-photo/iced-vietnamese-salt-coffee-condensed-600nw-2320994535.jpg', '/products/2', 'Chi tiết', '2024-06-23 04:07:51', '2024-06-23 04:07:51'),
(10, 'Cappuccino', 'Cappuccino thơm ngon', 'Cà phê, sữa tươi', 1, 350000, 16000, 1, 'https://product.hstatic.net/1000075078/product/capu-da_487470_e06d3835cbc84e51bd635b04d541494e.jpg', 50, 11, 'path_to_thumbnail', NULL, NULL, NULL, NULL),
(11, 'Latte', 'Latte mượt mà', 'Cà phê, sữa nóng', 5, 32000, 29000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-sua-da_3.jpg', 30, 10, 'path_to_thumbnail', NULL, NULL, NULL, NULL),
(12, 'Matcha Latte', 'Matcha Latte béo ngậy', 'Matcha, sữa nóng', 1, 38000, 32000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-den-da_11.jpg', 25, 8, 'path_to_thumbnail', NULL, NULL, NULL, NULL),
(13, 'Trà đào cam sả', 'Trà đào cam sả lạnh', 'Trà đào, cam, sả', 2, 40000, 35000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-sua-da_3.jpg', 28, 30, 'path_to_thumbnail', NULL, NULL, NULL, NULL),
(14, 'Soda chanh', 'Soda chanh tươi mát', 'Soda, chanh, đá', 2, 28000, 25000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-den-da_11.jpg', 40, 11, 'path_to_thumbnail', NULL, NULL, NULL, NULL),
(15, 'Nước ép dưa hấu', 'Nước ép dưa hấu tươi', 'Dưa hấu tươi', 1, 45000, 30000, 1, 'https://product.hstatic.net/1000075078/product/1696220139_tra-xanh-espresso-marble_26a0eb92bfd649508d0e93173e9b3083.jpg', 20, 9, 'path_to_thumbnail', NULL, NULL, NULL, NULL),
(16, 'Smoothie dâu tây', 'Smoothie dâu tây bổ dưỡng', 'Dâu tây, sữa chua', 4, 50000, 50000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-sua-da_3.jpg', 18, 6, 'path_to_thumbnail', NULL, NULL, NULL, NULL),
(17, 'Smoothie dâu tây', 'Smoothie dâu tây bổ dưỡng', 'Dâu tây, sữa chua', 4, 50000, 50000, 1, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-sua-da_3.jpg', 18, 6, 'path_to_thumbnail', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Đồ uống cà phê', 1, '2024-06-23 04:06:39', '2024-06-23 04:06:39'),
(2, 'Trà và nước giải khát', 1, '2024-06-23 04:06:39', '2024-06-23 04:06:39'),
(3, 'Đồ ăn nhẹ và bánh ngọt kèm đồ uống', 1, '2024-06-24 09:51:53', '2024-06-24 09:51:53'),
(4, 'Đồ uống có cồn', 1, '2024-06-24 09:51:53', '2024-06-24 09:51:53'),
(5, 'Đồ uống đặc biệt', 1, '2024-06-24 09:51:53', '2024-06-24 09:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `url`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-den-da_11.jpg', 'anh thuytinhocean', NULL, NULL),
(2, 2, 'https://thuytinhocean.net/wp-content/uploads/2023/07/hinh-anh-ly-cafe-sua-da_3.jpg', 'anh thuytinhocean 2', NULL, NULL),
(3, 2, 'https://product.hstatic.net/1000075078/product/capu-da_487470_e06d3835cbc84e51bd635b04d541494e.jpg', 'anh thuytinhocean 3', NULL, NULL),
(4, 2, 'https://product.hstatic.net/1000075078/product/1696220139_tra-xanh-espresso-marble_26a0eb92bfd649508d0e93173e9b3083.jpg', 'anh thuytinhocean 4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 4, 'hi', 1, NULL, NULL),
(2, 2, 3, 3, 'chào cậu!', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `increases` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `name`, `increases`, `created_at`, `updated_at`) VALUES
(1, 2, 'nhỏ', 0, NULL, NULL),
(2, 2, 'vừa', 10000, NULL, NULL),
(3, 2, 'lớn', 15000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hFjVjoSvB4mYbpbvwz8mufWxBfwxsKVsw7rh3cCi', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1EzNFphV0VqVnhiTFg0Skl2UEJBTzhtMm9MZVc4b1JicUxLSFM4SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ibG9nL2ltZy9mYXZpY29uLmljbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1720054247),
('KL7p1ZVyfEaG2LuOWkfNdvCg2x789Bgx3vtAtYmN', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid24yYXpQU05IUld3NG9KWlZIalNhRzlTSTlvaWp2V3d0c1loRGNlTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ibG9nL3Bvc3RzL2ltZy9hdmF0YXIxLmpwZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1720067116);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `email`, `phone`, `address`, `user_id`, `note`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Đào Nhật Trung423', 'trungda432o@gmail.com', '037530732432', '44324', 8, 'chao ban', 'pending', '2024-07-02 00:22:42', '2024-07-02 00:22:42'),
(6, 'Đào Nhật Trungdas', 'trungdaoda@gmail.com', '037530732321', '4da das', 8, 'das dsa dsa das dsa', 'pending', '2024-07-02 00:26:38', '2024-07-02 00:26:38'),
(7, 'Đào Nhật Trung dsa', 'trungdaodsa@gmail.com', '037530732321', '4 dsa d', 8, 'hi em', 'pending', '2024-07-02 01:03:28', '2024-07-02 01:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `address`, `status`) VALUES
(3, 'Test User', 'test@example.com', '2024-06-23 04:03:43', '$2y$12$8LYLvL9dYCs01vE3m3BFRObFAZ24cBEtOjjQjDHwmDWLpnyKX4BCi', '4OtPdKtlU3', '2024-06-23 04:03:44', '2024-06-23 04:03:44', NULL, NULL, 'active'),
(5, 'Đào Nhật Trung', 'trungdao10a1@gmail.com', NULL, '$2y$12$QzVPN6KeGMQivxtJPWdfMe.my9uFOL255YBgUqUeSENqY8po7lhPC', NULL, '2024-06-30 02:06:17', '2024-06-30 02:06:17', '0375307021', 'Tịnh Minh, Sơn Tịnh, Quảng Ngãi - Việt Nam', 'active'),
(6, 'Đào Nhật Trung', 'trungdao10a2@gmail.com', NULL, '$2y$12$haiHRwY4gxr287BU4Rk1LeTMPidIpGh8AclYSKp4JjLa.l1PvmOA6', NULL, '2024-06-30 02:13:29', '2024-06-30 02:13:29', '0375307022', 'Tịnh Minh, Sơn Tịnh, Quảng Ngãi - Việt Nam', 'inactive'),
(7, 'Đào Nhật Trung32', 'dsdao9a1@gmail.com', NULL, '$2y$12$Tu/XkJ6/q1aoWcNH9ZUstOH6yx1ugMwrReo3b/lQKbwiIfxPYJ03.', NULL, '2024-07-01 17:50:18', '2024-07-01 17:50:18', '037533237021', '4', 'inactive'),
(8, 'Đào Nhật Trung', 'trungdao@gmail.com', NULL, '$2y$12$ZzJiqcDqGbtY/n9JWQaJ.eZfxk5KE.1DRLKLOptRuQNmaWwxopBU.', NULL, '2024-07-01 17:52:15', '2024-07-01 17:52:15', '037530732', '4', 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_discount_id_foreign` (`discount_id`),
  ADD KEY `carts_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `personal_access_tokenss`
--
ALTER TABLE `personal_access_tokenss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokenss`
--
ALTER TABLE `personal_access_tokenss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
