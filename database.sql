-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2025 at 07:17 PM
-- Server version: 10.6.21-MariaDB
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mojarsof_edufax_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_app_translations`
--

CREATE TABLE `app_app_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `locale` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `namespace` varchar(50) NOT NULL,
  `key` text NOT NULL,
  `value` text DEFAULT NULL,
  `object_type` varchar(50) DEFAULT NULL,
  `object_key` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `app_attributes`
--

CREATE TABLE `app_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_attribute_values`
--

CREATE TABLE `app_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(150) DEFAULT NULL,
  `value_type` varchar(150) DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_comments`
--

CREATE TABLE `app_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `object_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Post type ID',
  `object_type` varchar(50) NOT NULL COMMENT 'Post type',
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_comments`
--

INSERT INTO `app_comments` (`id`, `user_id`, `email`, `name`, `website`, `content`, `object_id`, `object_type`, `status`, `created_at`, `updated_at`, `json_metas`) VALUES
(11, 1, NULL, NULL, NULL, 'Commodo iure eius la', 162, 'courses', 'approved', '2025-04-09 19:15:30', '2025-04-09 19:15:43', '{\"rating\":\"4\"}'),
(12, 1, NULL, NULL, NULL, 'Elit vitae eaque pl', 162, 'courses', 'approved', '2025-04-09 19:16:07', '2025-04-09 19:16:18', '{\"rating\":\"5\"}'),
(13, 1, NULL, NULL, NULL, 'Cillum veniam et la', 160, 'courses', 'approved', '2025-04-09 19:16:39', '2025-04-09 19:16:47', '{\"rating\":\"5\"}'),
(14, 1, NULL, NULL, NULL, 'Voluptatem libero en', 158, 'courses', 'pending', '2025-04-09 19:17:02', '2025-04-09 19:17:02', '{\"rating\":\"5\"}'),
(15, 1, NULL, NULL, NULL, 'Accusantium voluptat', 142, 'posts', 'approved', '2025-04-09 19:18:34', '2025-04-09 19:18:54', NULL),
(16, 1, NULL, NULL, NULL, 'Accusantium exercita', 142, 'posts', 'approved', '2025-04-09 19:18:42', '2025-04-09 19:18:54', NULL),
(17, 1, NULL, NULL, NULL, 'Qui itaque provident', 140, 'posts', 'approved', '2025-04-09 19:19:04', '2025-04-09 19:19:12', NULL),
(18, 1, NULL, NULL, NULL, 'Consequatur provide', 137, 'posts', 'approved', '2025-04-09 19:19:29', '2025-04-09 19:20:10', NULL),
(19, 1, NULL, NULL, NULL, 'Porro mollitia et ea', 134, 'posts', 'approved', '2025-04-09 19:19:49', '2025-04-09 19:20:10', NULL),
(20, 1, NULL, NULL, NULL, 'Eveniet illo anim m', 136, 'posts', 'approved', '2025-04-09 19:20:00', '2025-04-09 19:20:10', NULL),
(21, 1, NULL, NULL, NULL, 'Sapiente dolor recus', 136, 'posts', 'pending', '2025-04-09 19:20:22', '2025-04-09 19:20:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_configs`
--

CREATE TABLE `app_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_configs`
--

INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES
(1, 'title', 'Mojar - Laravel CMS for Your Project'),
(2, 'description', 'Mojar is a Content Management System (CMS) and web platform whose sole purpose is to make your development workflow simple again.'),
(3, 'author_name', 'Mojar Team'),
(4, 'user_registration', '1'),
(5, 'user_verification', '0'),
(6, 'logo', '2025/04/20/logo.png'),
(7, 'icon', '2025/04/20/favicon-1.png'),
(8, 'sitename', 'Mojar'),
(9, 'google_analytics', NULL),
(10, 'timezone', 'UTC'),
(11, 'date_format', 'F j, Y'),
(12, 'date_format_custom', 'F j, Y'),
(13, 'time_format', 'g:i a'),
(14, 'time_format_custom', 'g:i a'),
(15, 'fb_app_id', NULL),
(16, 'captcha', NULL),
(17, 'plugin_statuses', '{\"juzaweb\\/movie\":\"juzaweb\\/movie\",\"mojar\\/example\":\"mojar\\/example\",\"mojahid\\/event-management\":\"mojahid\\/event-management\",\"mojahid\\/contact-form\":\"mojahid\\/contact-form\",\"mojarsoft\\/dev-tool\":\"mojarsoft\\/dev-tool\",\"mojahid\\/ecommerce\":\"mojahid\\/ecommerce\",\"mojahid\\/edufax-helper\":\"mojahid\\/edufax-helper\",\"mojahid\\/lms\":\"mojahid\\/lms\"}'),
(18, 'ecom_store_address1', '{\"type\":\"text\",\"label\":\"Store Address 1\"}'),
(19, 'ecom_store_address2', '{\"type\":\"text\",\"label\":\"Store Address 2\"}'),
(20, 'ecom_city', '{\"type\":\"text\",\"label\":\"City\"}'),
(21, 'ecom_country', '{\"type\":\"text\",\"label\":\"Country\"}'),
(22, 'ecom_zipcode', '{\"type\":\"text\",\"label\":\"Zip Code\"}'),
(23, 'app_enable_sitemap', '0'),
(24, 'app_enable_post_feed', '0'),
(25, 'app_enable_taxonomy_feed', '1'),
(26, 'app_auto_ping_google_sitemap', '1'),
(27, 'app_auto_submit_url_google', '0'),
(28, 'app_auto_submit_url_bing', '1'),
(29, 'app_bing_api_key', NULL),
(30, 'app_auto_add_tags_to_posts', '0'),
(31, 'bing_verify_key', NULL),
(32, 'google_verify_key', NULL),
(34, 'app_backup_enable', '0'),
(35, 'app_backup_time', 'daily'),
(36, 'theme_statuses', '{\"name\":\"edufax\",\"namespace\":\"Theme\\\\\",\"path\":\"E:\\\\laragon\\\\www\\\\mojar-cms\\\\modules\\/..\\/themes\\/edufax\"}'),
(37, 'backend_messages', '[]'),
(38, 'email', '{\"host\":\"sandbox.smtp.mailtrap.io\",\"port\":\"2525\",\"encryption\":\"tls\",\"username\":\"8274485a2f435a\",\"password\":\"58e43f671f64c5\",\"from_address\":\"raofahmedmojahid@gmail.com\",\"from_name\":\"Raof\"}'),
(39, '_checkout_page', '17'),
(40, '_thanks_page', '18'),
(41, 'ecom_enable_multi_currency', '0'),
(42, 'ecom_allow_currency_switcher', '1'),
(43, 'ecom_force_checkout_currency', 'USD'),
(44, 'ecom_exchange_rate_api', NULL),
(45, 'ecom_exchange_rate_api_key', NULL),
(46, 'ecom_auto_update_exchange', '0'),
(47, 'ecomm_enable_multi_currency', '0'),
(48, 'ecomm_allow_currency_switcher', '1'),
(49, 'ecomm_force_checkout_currency', NULL),
(50, 'ecomm_exchange_rate_api', NULL),
(51, 'ecomm_exchange_rate_api_key', NULL),
(52, 'ecomm_auto_update_exchange', '0'),
(53, 'auth_layout', 'default'),
(54, 'socialites', '{\"facebook\":{\"enable\":\"1\",\"client_id\":\"adasd\",\"client_secret\":\"asdas\"},\"google\":{\"client_id\":null,\"client_secret\":null,\"enable\":\"1\"},\"twitter\":{\"client_id\":null,\"client_secret\":null,\"enable\":\"0\"},\"linkedin\":{\"client_id\":null,\"client_secret\":null,\"enable\":\"0\"},\"github\":{\"client_id\":null,\"client_secret\":null,\"enable\":\"0\"}}'),
(55, 'auto_resize_thumbnail', '{\"pages\":\"1\",\"posts\":\"0\",\"theme\":\"0\",\"plugin\":\"0\",\"products\":\"0\",\"events\":\"0\"}'),
(56, 'thumbnail_defaults', '{\"pages\":null,\"posts\":null,\"theme\":null,\"plugin\":null,\"products\":null,\"events\":null}'),
(57, 'evman_store_address1', NULL),
(58, 'evman_store_address2', NULL),
(59, 'evman_city', NULL),
(60, 'evman_country', NULL),
(61, 'evman_zipcode', NULL),
(62, 'evman_event_default_status', 'active'),
(63, 'evman_ticket_default_status', 'active'),
(64, 'evman_ticket_prefix', 'EVT-'),
(65, 'evman_email_notification', '1'),
(66, 'evman_booking_expiry_time', '30'),
(67, 'evman_date_format', 'Y-m-d'),
(68, 'evman_time_format', 'H:i'),
(69, 'evman_checkout_page', NULL),
(70, 'evman_thanks_page', NULL),
(71, '_store_address1', NULL),
(72, '_store_address2', NULL),
(73, '_city', NULL),
(74, '_country', NULL),
(75, '_zipcode', NULL),
(76, 'lms_default_course_status', 'draft'),
(77, 'lms_course_permalink_base', 'course'),
(78, 'lms_course_access_mode', 'open'),
(79, 'lms_course_display_mode', 'all'),
(80, 'lms_student_registration', '0'),
(81, 'lms_student_role', 'subscriber'),
(82, 'lms_progress_tracking', '0'),
(83, 'lms_auto_complete_lesson', '0'),
(84, 'lms_enable_reviews', '0'),
(85, 'lms_instructor_application', '0'),
(86, 'lms_instructor_commission', '70'),
(87, 'lms_auto_approve_instructor', '0'),
(88, 'lms_enable_certificates', '0'),
(89, 'lms_certificate_logo', NULL),
(90, 'lms_certificate_signature', NULL),
(91, 'lms_certificate_template', 'default'),
(92, 'lms_email_new_course', '0'),
(93, 'lms_email_course_completion', '0'),
(94, 'lms_email_enrollment', '0'),
(95, 'lms_courses_page', NULL),
(96, 'lms_my_courses_page', NULL),
(97, 'lms_checkout_page', NULL),
(98, 'lms_thank_you_page', NULL),
(99, 'lms_instructor_page', NULL),
(100, 'show_on_front', 'page'),
(101, 'home_page', '11'),
(102, 'posts_per_page', '12'),
(103, 'posts_per_rss', '10'),
(104, 'post_page', '133');

-- --------------------------------------------------------

--
-- Table structure for table `app_contact_form_contacts`
--

CREATE TABLE `app_contact_form_contacts` (
  `id` char(36) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text DEFAULT NULL,
  `metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metas`)),
  `site_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_contact_form_contacts`
--

INSERT INTO `app_contact_form_contacts` (`id`, `name`, `email`, `subject`, `message`, `metas`, `site_id`, `created_at`, `updated_at`) VALUES
('1a133c89-4a55-4e51-bb0b-6fd121650fc4', 'Zenia Holman', 'pudipohuze@mailinator.com', 'Sunt explicabo Aute', 'Quas nisi perferendi', NULL, 0, '2025-03-05 02:00:23', '2025-03-05 02:00:23'),
('51a3c78d-166e-45d0-aba3-29eb6ee63c16', 'dasdas', 'asdasd@gmd.com', 'dadas', 'dasdas', NULL, 0, '2025-03-04 09:57:46', '2025-03-04 09:57:46'),
('5f7bb18c-426d-462e-9109-c94aa047a13e', 'Lacy Cannon', 'fonyga@mailinator.com', 'Rerum dolorem evenie', 'Possimus qui repreh', NULL, 0, '2025-03-05 02:04:09', '2025-03-05 02:04:09'),
('cfee6cff-394b-4470-89a1-57e827a7f015', 'Cleo Dejesus', 'duhimyfux@mailinator.com', 'Dicta sit elit asp', 'In corporis qui sit', NULL, 0, '2025-03-05 02:01:05', '2025-03-05 02:01:05'),
('f8436772-c36b-491c-8781-f9ed42616a9a', 'Hammett Buckley', 'pudonev@mailinator.com', 'Excepteur officia qu', 'Dolore est ut disti', NULL, 0, '2025-03-05 01:55:32', '2025-03-05 01:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `app_dev_tool_cms_versions`
--

CREATE TABLE `app_dev_tool_cms_versions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(150) DEFAULT NULL,
  `download_url` varchar(150) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `changelog` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_dev_tool_cms_versions`
--

INSERT INTO `app_dev_tool_cms_versions` (`id`, `version`, `description`, `file_path`, `download_url`, `is_active`, `changelog`, `created_at`, `updated_at`) VALUES
(5, '1.0.1', 'desc 1.0.1', 'public/cms/updates/1.0.1/cms-1.0.1.zip', NULL, 1, 'changelog', '2025-03-28 10:15:36', '2025-03-28 10:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `app_dev_tool_marketplace_plugins`
--

CREATE TABLE `app_dev_tool_marketplace_plugins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `thumbnail_path` varchar(150) DEFAULT NULL,
  `banner` varchar(150) DEFAULT NULL,
  `banner_path` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `file_path` varchar(150) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `price` varchar(150) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_dev_tool_marketplace_plugins`
--

INSERT INTO `app_dev_tool_marketplace_plugins` (`id`, `name`, `title`, `description`, `thumbnail`, `thumbnail_path`, `banner`, `banner_path`, `url`, `file_path`, `is_paid`, `price`, `is_featured`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 'mojarsoft/demo-site', 'mojarsoft', 'desc', NULL, 'public/marketplace/plugins/thumbnails/mojarsoft/demo-site.png', NULL, 'public/marketplace/plugins/banners/mojarsoft/demo-site.jpg', NULL, 'public/marketplace/plugins/mojarsoft/demo-site.zip', 0, NULL, 0, 0, 1, '2025-03-28 10:47:40', '2025-03-28 10:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `app_dev_tool_marketplace_themes`
--

CREATE TABLE `app_dev_tool_marketplace_themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `screenshot` varchar(150) DEFAULT NULL,
  `screenshot_path` varchar(150) DEFAULT NULL,
  `banner` varchar(150) DEFAULT NULL,
  `banner_path` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `file_path` varchar(150) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `price` varchar(150) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_dev_tool_package_versions`
--

CREATE TABLE `app_dev_tool_package_versions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(150) NOT NULL,
  `package_type` enum('plugin','theme') NOT NULL,
  `version` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(150) DEFAULT NULL,
  `download_url` varchar(150) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `changelog` text DEFAULT NULL,
  `requires_cms_version` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_dev_tool_package_versions`
--

INSERT INTO `app_dev_tool_package_versions` (`id`, `package_name`, `package_type`, `version`, `description`, `file_path`, `download_url`, `is_active`, `changelog`, `requires_cms_version`, `created_at`, `updated_at`) VALUES
(5, 'mojarsoft/demo-site', 'plugin', '1.0.1', 'desc', 'public/plugins/updates/mojarsoft_demo-site/1.0.1/mojarsoft_demo-site-1.0.1.zip', NULL, 1, 'dsfgd', '1.0.0', '2025-03-28 10:32:58', '2025-03-28 10:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `app_discounts`
--

CREATE TABLE `app_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(150) NOT NULL,
  `tbl` varchar(150) NOT NULL,
  `tbl_column` varchar(150) NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_addons`
--

CREATE TABLE `app_ecomm_addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `version` varchar(150) DEFAULT NULL,
  `author` varchar(150) DEFAULT NULL,
  `author_email` varchar(150) DEFAULT NULL,
  `author_url` varchar(150) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_premium` tinyint(1) NOT NULL DEFAULT 0,
  `license_key` varchar(150) DEFAULT NULL,
  `license_email` varchar(150) DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_carts`
--

CREATE TABLE `app_ecomm_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(36) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `discount_codes` varchar(150) DEFAULT NULL,
  `discount_target_type` varchar(50) DEFAULT NULL,
  `site_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_ecomm_carts`
--

INSERT INTO `app_ecomm_carts` (`id`, `code`, `items`, `user_id`, `discount`, `discount_codes`, `discount_target_type`, `site_id`, `created_at`, `updated_at`) VALUES
(204, 'beec58b1-e4e0-4dde-bda0-613a422f7482', '\"{\\\"courses_162\\\":{\\\"post_id\\\":162,\\\"type\\\":\\\"courses\\\",\\\"quantity\\\":1,\\\"price\\\":120,\\\"title\\\":\\\"Project Management Principles & Practices\\\",\\\"thumbnail\\\":\\\"2025\\\\\\/04\\\\\\/08\\\\\\/courses-img-6.jpg\\\",\\\"sku_code\\\":\\\"\\\",\\\"barcode\\\":\\\"\\\",\\\"compare_price\\\":230,\\\"line_price\\\":120}}\"', NULL, 0.00, NULL, NULL, 0, '2025-04-17 17:17:44', '2025-04-17 17:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `app_ecomm_currencies`
--

CREATE TABLE `app_ecomm_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(150) DEFAULT NULL,
  `symbol` varchar(150) DEFAULT NULL,
  `exchange_rate` double(8,2) NOT NULL DEFAULT 1.00,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(150) DEFAULT NULL,
  `symbol_position` varchar(150) DEFAULT NULL,
  `thousand_separator` varchar(150) DEFAULT NULL,
  `decimal_separator` varchar(150) DEFAULT NULL,
  `decimal_place` varchar(150) DEFAULT NULL,
  `decimal_point` varchar(150) DEFAULT NULL,
  `currency_format` varchar(150) DEFAULT NULL,
  `custom_price_format` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_ecomm_currencies`
--

INSERT INTO `app_ecomm_currencies` (`id`, `code`, `symbol`, `exchange_rate`, `is_default`, `is_enabled`, `name`, `symbol_position`, `thousand_separator`, `decimal_separator`, `decimal_place`, `decimal_point`, `currency_format`, `custom_price_format`, `created_at`, `updated_at`) VALUES
(1, 'BD', '৳', 120.00, 0, 1, 'Taka', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 22:38:01', '2025-04-09 19:17:49'),
(2, 'IN', '₹', 90.00, 0, 1, 'Rupy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 22:44:02', '2025-04-09 19:17:49'),
(3, 'PK', 'Rs', 140.00, 0, 1, 'Rupy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-02 09:24:12', '2025-04-09 19:17:49'),
(4, 'Dollar', '$', 1.00, 0, 1, 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 11:21:31', '2025-04-09 19:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `app_ecom_download_links`
--

CREATE TABLE `app_ecom_download_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `site_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_email_lists`
--

CREATE TABLE `app_email_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `params` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending' COMMENT 'pending => processing => (success || error)',
  `priority` int(11) NOT NULL DEFAULT 1,
  `error` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `template_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_email_lists`
--

INSERT INTO `app_email_lists` (`id`, `email`, `template_id`, `params`, `status`, `priority`, `error`, `data`, `created_at`, `updated_at`, `template_code`) VALUES
(1, 'raad@adsfda.com', NULL, '{\"name\":\"Admin\"}', 'success', 1, NULL, '{\"subject\":\"Send email for Admin\",\"body\":\"Hello Admin, If you receive this email, it means that your config email on Mojar is active.\"}', '2025-04-02 12:10:58', '2025-04-02 12:11:06', 'test_email'),
(2, 'student2@gmail.com', 3, '{\"name\":\"Student 2\",\"email\":\"student2@gmail.com\",\"verifyToken\":\"qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\",\"verifyUrl\":\"http:\\/\\/mojar-cms.test\\/verification\\/student2@gmail.com\\/qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Student 2,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/mojar-cms.test\\/verification\\/student2@gmail.com\\/qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-04-02 12:24:39', '2025-04-02 12:24:44', 'verification');

-- --------------------------------------------------------

--
-- Table structure for table `app_email_templates`
--

CREATE TABLE `app_email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `params` text DEFAULT NULL,
  `layout` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_hook` varchar(100) DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `to_sender` tinyint(1) NOT NULL DEFAULT 1,
  `to_emails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`to_emails`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_email_templates`
--

INSERT INTO `app_email_templates` (`id`, `code`, `subject`, `body`, `params`, `layout`, `created_at`, `updated_at`, `email_hook`, `uuid`, `active`, `to_sender`, `to_emails`) VALUES
(1, 'forgot_password', 'Password Reset for you account', '<p>Someone has requested a password reset for the following account:</p>\r\n<p>Email: {{ email }}</p>\r\n<p>If this was a mistake, just ignore this email and nothing will happen.To reset your password, visit the following address:</p>\r\n<p><a href=\"{{ url }}\" target=\"_blank\">{{ url }}</a></p>', '{\"name\":\"Full Name\",\"email\":\"Email\",\"url\":\"Url reset password\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, '886836c2-c751-4448-9bf4-b7590babf14b', 1, 1, NULL),
(2, 'notification', '{{ subject }}', '{{ body }}', '{\"subject\":\"Subject notify\",\"body\":\"Body notify\",\"name\":\"User name\",\"email\":\"User Email address\",\"url\":\"Url notify\",\"image\":\"Image notify\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, 'fa2b1445-6726-4b94-aee7-17be8282131d', 1, 1, NULL),
(3, 'verification', 'Verify your account', '<p>Hello {{ name }},</p>\r\n<p>Thank you for register. Please click the link below to Verify your account</p>\r\n<p><a href=\"{{ verifyUrl }}\" target=\"_blank\">Verify account</a></p>', '{\"name\":\"Your Name\",\"verifyUrl\":\"Url verify account\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, '395c245c-5353-475b-b7cb-6a24641a4599', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_email_template_users`
--

CREATE TABLE `app_email_template_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email_template_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_evman_event_bookings`
--

CREATE TABLE `app_evman_event_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `state` varchar(150) DEFAULT NULL,
  `zip` varchar(150) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_status` varchar(150) DEFAULT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `code` varchar(150) NOT NULL,
  `booking_date` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_evman_event_bookings`
--

INSERT INTO `app_evman_event_bookings` (`id`, `event_id`, `user_id`, `ticket_id`, `name`, `email`, `phone`, `address`, `city`, `state`, `zip`, `country`, `status`, `payment_method_id`, `payment_status`, `total`, `quantity`, `code`, `booking_date`, `notes`, `order_id`, `created_at`, `updated_at`) VALUES
(95, 150, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, 'completed', 220.00, 1, 'EVT-67F6C997BB6D7', '2025-04-09 19:25:11', NULL, 214, '2025-04-09 19:25:11', '2025-04-09 19:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `app_evman_event_tickets`
--

CREATE TABLE `app_evman_event_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'active',
  `min_ticket_number` int(11) DEFAULT NULL,
  `max_ticket_number` int(11) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_evman_event_tickets`
--

INSERT INTO `app_evman_event_tickets` (`id`, `name`, `description`, `price`, `capacity`, `status`, `min_ticket_number`, `max_ticket_number`, `start_date`, `end_date`, `event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'Greenwood Arena', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 180.00, 300, 'active', 1, 30, '2025-04-08 19:46:00', '2025-07-24 19:46:00', 143, NULL, '2025-04-08 13:47:18', '2025-04-08 13:47:18'),
(6, 'Greenwood Arena', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 220.00, 30, 'active', 1, 2, '2025-04-08 21:11:00', '2025-10-30 21:11:00', 144, NULL, '2025-04-08 15:11:23', '2025-04-08 15:11:23'),
(7, 'Ticket 1', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 140.00, 40, 'active', 1, 2, '2025-06-19 21:16:00', '2025-11-21 21:16:00', 145, NULL, '2025-04-08 15:19:18', '2025-04-08 15:19:18'),
(8, 'Ticket', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 310.00, 30, 'active', 1, 2, NULL, NULL, 146, NULL, '2025-04-08 16:43:33', '2025-04-08 16:43:33'),
(9, 'ticket', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 380.00, 200, 'active', 1, 2, '2025-04-17 22:46:00', '2025-08-15 22:46:00', 147, NULL, '2025-04-08 16:47:07', '2025-04-08 16:47:07'),
(10, 'ticket', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 170.00, 30, 'active', 1, 2, '2025-04-09 22:49:00', '2025-09-18 22:49:00', 148, NULL, '2025-04-08 16:49:27', '2025-04-08 16:49:27'),
(11, 'ticket', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 230.00, 90, 'active', 1, 2, '2025-04-09 22:51:00', '2025-09-25 22:51:00', 149, NULL, '2025-04-08 16:51:26', '2025-04-08 16:51:26'),
(12, 'ticket', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...', 220.00, 433, 'active', 1, 2, '2025-04-10 22:52:00', '2025-08-21 22:52:00', 150, NULL, '2025-04-08 16:53:08', '2025-04-08 16:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `app_failed_jobs`
--

CREATE TABLE `app_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(150) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_jobs`
--

CREATE TABLE `app_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(150) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_languages`
--

CREATE TABLE `app_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_languages`
--

INSERT INTO `app_languages` (`id`, `code`, `name`, `default`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 1, '2025-02-28 06:41:01', '2025-02-28 06:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `app_language_lines`
--

CREATE TABLE `app_language_lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namespace` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `key` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `object_type` varchar(20) DEFAULT NULL,
  `object_key` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_lms_course_lessons`
--

CREATE TABLE `app_lms_course_lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `thumbnail` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'publish',
  `order` int(11) NOT NULL DEFAULT 0,
  `type` varchar(150) NOT NULL DEFAULT 'video',
  `duration` int(11) NOT NULL DEFAULT 0,
  `metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metas`)),
  `content_url` varchar(150) DEFAULT NULL,
  `local_video_path` varchar(150) DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_topic_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_lms_course_lessons`
--

INSERT INTO `app_lms_course_lessons` (`id`, `title`, `slug`, `thumbnail`, `description`, `status`, `order`, `type`, `duration`, `metas`, `content_url`, `local_video_path`, `post_id`, `course_topic_id`, `created_at`, `updated_at`) VALUES
(4, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 30, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 2, '2025-04-09 16:53:46', '2025-04-09 16:53:46'),
(5, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-how-to-improve-your-communication', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 20, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 2, '2025-04-09 17:11:00', '2025-04-09 17:12:20'),
(6, 'Video: How NOT to talk to someone | Communi', 'video-how-to-improve-your-communication-1', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 38, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 3, '2025-04-09 17:12:51', '2025-04-09 17:14:49'),
(7, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 29, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 3, '2025-04-09 17:16:41', '2025-04-09 17:16:41'),
(8, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-2', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 2, '2025-04-09 17:17:25', '2025-04-09 17:17:25'),
(9, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important-1', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 30, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 4, '2025-04-09 18:10:35', '2025-04-09 18:10:35'),
(10, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-1', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 50, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 4, '2025-04-09 18:11:03', '2025-04-09 18:11:03'),
(11, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-3', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 90, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 4, '2025-04-09 18:11:29', '2025-04-09 18:11:29'),
(12, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 120, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 5, '2025-04-09 18:13:13', '2025-04-09 18:13:13'),
(13, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-2', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 110, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 5, '2025-04-09 18:13:42', '2025-04-09 18:13:42'),
(14, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important-2', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 6, '2025-04-09 18:19:50', '2025-04-09 18:19:50'),
(15, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-3', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 140, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 6, '2025-04-09 18:20:39', '2025-04-09 18:20:39'),
(16, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-4', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 6, '2025-04-09 18:21:08', '2025-04-09 18:21:08'),
(17, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi-1', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 7, '2025-04-09 18:21:42', '2025-04-09 18:21:42'),
(18, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-4', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 400, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 7, '2025-04-09 18:22:24', '2025-04-09 18:22:24'),
(19, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important-3', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 8, '2025-04-09 18:19:50', '2025-04-09 18:19:50'),
(21, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-5', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 140, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 8, '2025-04-09 18:20:39', '2025-04-09 18:20:39'),
(22, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-5', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 60, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 8, '2025-04-09 18:33:20', '2025-04-09 18:33:20'),
(23, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi-2', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 23, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 9, '2025-04-09 18:33:52', '2025-04-09 18:33:52'),
(24, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important-4', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 30, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 10, '2025-04-09 18:42:42', '2025-04-09 18:42:42'),
(25, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-6', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 10, '2025-04-09 18:43:36', '2025-04-09 18:43:36'),
(26, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-6', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 50, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 10, '2025-04-09 18:44:34', '2025-04-09 18:44:34'),
(27, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi-3', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 80, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 11, '2025-04-09 18:45:31', '2025-04-09 18:45:31'),
(28, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-7', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 120, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 11, '2025-04-09 18:46:08', '2025-04-09 18:46:08'),
(29, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important-5', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 20, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 12, '2025-04-09 18:49:40', '2025-04-09 18:49:40'),
(30, 'Video: WARNING! 8 Killer Phrases That We Use', 'video-warning-8-killer-phrases-that-we-use-8', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 12, '2025-04-09 18:50:05', '2025-04-09 18:50:05'),
(31, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi-4', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 50, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 13, '2025-04-09 18:50:30', '2025-04-09 18:50:30'),
(32, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important-6', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 40, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 14, '2025-04-09 18:52:51', '2025-04-09 18:52:51'),
(33, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-7', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 30, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 15, '2025-04-09 18:53:14', '2025-04-09 18:53:14'),
(34, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi-5', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 50, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 15, '2025-04-09 18:53:41', '2025-04-09 18:53:41'),
(35, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-8', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 90, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 16, '2025-04-09 18:55:34', '2025-04-09 18:55:34'),
(36, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi-6', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 90, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 17, '2025-04-09 18:56:17', '2025-04-09 18:56:17'),
(37, 'Video: Introduce Yourself | The Most Important', 'video-introduce-yourself-the-most-important-7', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 50, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 18, '2025-04-09 18:59:17', '2025-04-09 18:59:17'),
(38, 'Video: How to Improve Your Communication', 'video-how-to-improve-your-communication-9', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 70, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 18, '2025-04-09 18:59:40', '2025-04-09 18:59:40'),
(39, 'Video: How NOT to talk to someone | Communi', 'video-how-not-to-talk-to-someone-communi-7', '2025/04/09/course-video-img.jpg', 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 'video', 80, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 18, '2025-04-09 19:00:12', '2025-04-09 19:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `app_lms_course_topics`
--

CREATE TABLE `app_lms_course_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `thumbnail` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'publish',
  `order` int(11) NOT NULL DEFAULT 0,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_lms_course_topics`
--

INSERT INTO `app_lms_course_topics` (`id`, `title`, `slug`, `thumbnail`, `description`, `status`, `order`, `post_id`, `created_at`, `updated_at`) VALUES
(2, 'Introduce Yourself | The Most Important', 'introduce-yourself-the-most-important', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 153, '2025-04-09 16:50:52', '2025-04-09 16:50:52'),
(3, 'Topic 2', 'topic-2', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 153, '2025-04-09 17:13:14', '2025-04-09 17:13:14'),
(4, 'Topic', 'topic', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 155, '2025-04-09 18:09:54', '2025-04-09 18:09:54'),
(5, 'Topic 2', 'topic-2-1', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 155, '2025-04-09 18:11:57', '2025-04-09 18:11:57'),
(6, 'Topic 1', 'topic-1', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 156, '2025-04-09 18:17:54', '2025-04-09 18:17:54'),
(7, 'Topic 2', 'topic-2-2', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 156, '2025-04-09 18:18:38', '2025-04-09 18:18:38'),
(8, 'Topic 1', 'topic-1-1', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 157, '2025-04-09 18:17:54', '2025-04-09 18:17:54'),
(9, 'Topic 2', 'topic-2-3', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 157, '2025-04-09 18:18:38', '2025-04-09 18:18:38'),
(10, 'Topic', 'topic-3', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 158, '2025-04-09 18:41:20', '2025-04-09 18:41:20'),
(11, 'Topic 2', 'topic-2-4', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 158, '2025-04-09 18:41:44', '2025-04-09 18:41:44'),
(12, 'Topic 1', 'topic-1-2', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 159, '2025-04-09 18:48:53', '2025-04-09 18:48:53'),
(13, 'Topic 2', 'topic-2-5', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 159, '2025-04-09 18:49:03', '2025-04-09 18:49:03'),
(14, 'Topic 1', 'topic-1-3', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 160, '2025-04-09 18:52:10', '2025-04-09 18:52:10'),
(15, 'Topic 2', 'topic-2-6', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 160, '2025-04-09 18:52:27', '2025-04-09 18:52:27'),
(16, 'Topic 1', 'topic-1-4', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 161, '2025-04-09 18:54:58', '2025-04-09 18:54:58'),
(17, 'Topic 2', 'topic-2-7', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 161, '2025-04-09 18:55:45', '2025-04-09 18:55:45'),
(18, 'Topic', 'topic-4', NULL, 'Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat.', 'publish', 0, 162, '2025-04-09 18:58:42', '2025-04-09 18:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `app_manual_notifications`
--

CREATE TABLE `app_manual_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(150) DEFAULT NULL,
  `users` text NOT NULL,
  `data` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `error` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_media_files`
--

CREATE TABLE `app_media_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'image',
  `mime_type` varchar(150) NOT NULL,
  `path` varchar(150) NOT NULL,
  `extension` varchar(150) NOT NULL,
  `size` bigint(20) NOT NULL DEFAULT 0,
  `folder_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disk` varchar(50) NOT NULL DEFAULT 'public',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_media_files`
--

INSERT INTO `app_media_files` (`id`, `name`, `type`, `mime_type`, `path`, `extension`, `size`, `folder_id`, `user_id`, `created_at`, `updated_at`, `disk`, `metadata`) VALUES
(1, 'logo.png', 'image', 'image/png', '2025/01/15/logo.png', 'png', 6498, NULL, 1, '2025-01-15 07:47:59', '2025-01-15 07:47:59', 'public', NULL),
(2, 'white_logo_02.png', 'image', 'image/png', '2025/01/17/white-logo-02.png', 'png', 12796, NULL, 1, '2025-01-17 00:30:58', '2025-01-17 00:30:58', 'public', NULL),
(3, '[freepicdownloader.com]-3d-flat-icon-as-chef-with-iso22000-certificate-seal-concept-as-chef-holding-iso22000-certif-medium.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-3d-flat-icon-as-chef-with-iso22000-certificate-seal-concept-as-chef-holding.jpg', 'jpg', 70779, NULL, 1, '2025-01-26 09:11:32', '2025-01-26 09:11:32', 'public', NULL),
(4, '[freepicdownloader.com]-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plate-medium.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', 'jpg', 70897, NULL, 1, '2025-01-26 09:11:52', '2025-01-26 09:11:52', 'public', NULL),
(5, 'freepicdownloader.com-girl-enjoying-sunny-perfect-weather-summer-vacation-cheerful-attractive-br.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-girl-enjoying-sunny-perfect-weather-summer-vacation-cheerful-attractive-br.jpg', 'jpg', 36880, NULL, 1, '2025-01-26 09:15:40', '2025-01-26 09:15:40', 'public', NULL),
(6, 'freepicdownloader.com-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl.jpg', 'jpg', 70897, NULL, 1, '2025-01-26 09:16:07', '2025-01-26 09:16:07', 'public', NULL),
(7, 'freepicdownloader.com-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl-1.jpg', 'jpg', 70897, NULL, 1, '2025-01-26 09:22:49', '2025-01-26 09:22:49', 'public', NULL),
(8, 'freepicdownloader.com-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seaf.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seaf.jpg', 'jpg', 64175, NULL, 1, '2025-01-26 09:23:02', '2025-01-26 09:23:02', 'public', NULL),
(9, 'freepicdownloader.com-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl-2.jpg', 'jpg', 70897, NULL, 1, '2025-01-26 09:24:04', '2025-01-26 09:24:04', 'public', NULL),
(10, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8.png', 'png', 61826, NULL, 1, '2025-01-26 10:51:15', '2025-01-26 10:51:15', 'public', NULL),
(11, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-1.png', 'png', 61826, NULL, 1, '2025-01-26 10:51:31', '2025-01-26 10:51:31', 'public', NULL),
(12, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-2.png', 'png', 61826, NULL, 1, '2025-01-26 10:52:17', '2025-01-26 10:52:17', 'public', NULL),
(13, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-3.png', 'png', 61826, NULL, 1, '2025-01-26 10:52:32', '2025-01-26 10:52:32', 'public', NULL),
(14, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-4.png', 'png', 61826, NULL, 1, '2025-01-26 10:53:07', '2025-01-26 10:53:07', 'public', NULL),
(15, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-5.png', 'png', 61826, NULL, 1, '2025-01-26 10:54:13', '2025-01-26 10:54:13', 'public', NULL),
(16, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-6.png', 'png', 61826, NULL, 1, '2025-01-26 10:57:26', '2025-01-26 10:57:26', 'public', NULL),
(17, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-7.png', 'png', 61826, NULL, 1, '2025-01-26 10:58:04', '2025-01-26 10:58:04', 'public', NULL),
(18, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-8.png', 'png', 61826, NULL, 1, '2025-01-26 11:00:25', '2025-01-26 11:00:25', 'public', NULL),
(19, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-9.png', 'png', 61826, NULL, 1, '2025-01-26 11:02:05', '2025-01-26 11:02:05', 'public', NULL),
(20, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-10.png', 'png', 61826, NULL, 1, '2025-01-26 11:03:59', '2025-01-26 11:03:59', 'public', NULL),
(21, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-11.png', 'png', 61826, NULL, 1, '2025-01-26 11:05:14', '2025-01-26 11:05:14', 'public', NULL),
(22, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-12.png', 'png', 61826, NULL, 1, '2025-01-26 11:08:12', '2025-01-26 11:08:12', 'public', NULL),
(23, 'c6b7069df1a634e3db7ba5e9b923d3a8.png', 'file', 'image/png', '2025/01/26/c6b7069df1a634e3db7ba5e9b923d3a8-13.png', 'png', 61826, NULL, 1, '2025-01-26 11:24:10', '2025-01-26 11:24:10', 'public', NULL),
(24, '50382765fd5648c7876d91cc37b27394.png', 'file', 'image/png', '2025/01/26/50382765fd5648c7876d91cc37b27394.png', 'png', 69586, 2, 1, '2025-01-26 11:53:22', '2025-01-26 11:53:22', 'public', NULL),
(25, 'freepicdownloader.com-3d-flat-icon-as-chef-with-iso22000-certificate-seal-concept-as-chef-holdin.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-3d-flat-icon-as-chef-with-iso22000-certificate-seal-concept-as-chef-holdin.jpg', 'jpg', 70779, 2, 1, '2025-01-26 11:55:46', '2025-01-26 11:55:46', 'public', NULL),
(26, 'laravel-beyond-crud-chapter-2-1-.pdf', 'file', 'application/pdf', '2025/01/26/laravel-beyond-crud-chapter-2-1.pdf', 'pdf', 409432, 2, 1, '2025-01-26 11:57:40', '2025-01-26 11:57:40', 'public', NULL),
(27, 'freepicdownloader.com-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl-3.jpg', 'jpg', 70897, 2, 1, '2025-01-26 12:11:23', '2025-01-26 12:11:23', 'public', NULL),
(28, '50382765fd5648c7876d91cc37b27394.png', 'file', 'image/png', '2025/01/26/50382765fd5648c7876d91cc37b27394-1.png', 'png', 69586, 2, 1, '2025-01-26 12:11:42', '2025-01-26 12:11:42', 'public', NULL),
(29, 'freepicdownloader.com-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl.jpg', 'file', 'image/jpeg', '2025/01/26/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-pl-4.jpg', 'jpg', 70897, NULL, 1, '2025-01-26 13:00:09', '2025-01-26 13:00:09', 'public', NULL),
(30, 'footer_bg.png', 'image', 'image/jpeg', '2025/02/01/footer-bg.png', 'png', 383080, NULL, 1, '2025-02-01 10:33:35', '2025-02-01 10:33:35', 'public', NULL),
(31, '[freepicdownloader.com]-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plate-medium.jpg', 'image', 'image/jpeg', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', 'jpg', 70897, NULL, 1, '2025-02-13 23:30:50', '2025-02-13 23:30:50', 'public', NULL),
(32, '[freepicdownloader.com]-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafood-criolla-food-drinks-medium.jpg', 'image', 'image/jpeg', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', 'jpg', 64175, NULL, 1, '2025-02-14 03:49:47', '2025-02-14 03:49:47', 'public', NULL),
(33, 'footer_bg.png', 'image', 'image/jpeg', '2025/03/02/footer-bg.png', 'png', 383080, NULL, 1, '2025-03-02 07:19:29', '2025-03-02 07:19:29', 'public', NULL),
(34, 'instructor_bg.jpg', 'image', 'image/jpeg', '2025/03/05/instructor-bg.jpg', 'jpg', 435283, NULL, 1, '2025-03-05 03:22:39', '2025-03-05 03:22:39', 'public', NULL),
(35, 'instructor_img_3.png', 'image', 'image/png', '2025/03/05/instructor-img-3.png', 'png', 106497, NULL, 1, '2025-03-05 03:24:22', '2025-03-05 03:24:22', 'public', NULL),
(36, 'certificate_icon_1.png', 'image', 'image/png', '2025/03/05/certificate-icon-1.png', 'png', 3802, NULL, 1, '2025-03-05 03:56:22', '2025-03-05 03:56:22', 'public', NULL),
(37, 'certificate_bg.jpg', 'image', 'image/jpeg', '2025/03/05/certificate-bg.jpg', 'jpg', 602178, NULL, 1, '2025-03-05 03:57:10', '2025-03-05 03:57:10', 'public', NULL),
(38, 'testimonial_bg.jpg', 'image', 'image/jpeg', '2025/03/05/testimonial-bg.jpg', 'jpg', 105571, NULL, 1, '2025-03-05 04:13:04', '2025-03-05 04:13:04', 'public', NULL),
(39, 'testimonial_img_1.jpg', 'image', 'image/jpeg', '2025/03/05/testimonial-img-1.jpg', 'jpg', 6175, NULL, 1, '2025-03-05 04:14:12', '2025-03-05 04:14:12', 'public', NULL),
(40, 'testimonial_img_2.jpg', 'image', 'image/jpeg', '2025/03/05/testimonial-img-2.jpg', 'jpg', 5669, NULL, 1, '2025-03-05 04:16:44', '2025-03-05 04:16:44', 'public', NULL),
(42, 'cart_p01.jpg', 'image', 'image/jpeg', '2025/03/06/cart-p01.jpg', 'jpg', 30468, 1, 1, '2025-03-06 02:21:31', '2025-03-06 02:21:31', 'public', NULL),
(43, 'home_shop_thumb02.png', 'image', 'image/png', '2025/03/06/home-shop-thumb02.png', 'png', 31696, NULL, 1, '2025-03-06 05:13:51', '2025-03-06 05:13:51', 'public', NULL),
(44, 'home_shop_thumb05.png', 'file', 'image/png', '2025/03/06/home-shop-thumb05.png', 'png', 34372, NULL, 1, '2025-03-06 05:22:18', '2025-03-06 05:22:18', 'public', NULL),
(45, 'home_shop_thumb02.png', 'file', 'image/png', '2025/03/06/home-shop-thumb02-1.png', 'png', 31696, NULL, 1, '2025-03-06 05:44:22', '2025-03-06 05:44:22', 'public', NULL),
(46, 'features_product03.png', 'image', 'image/png', '2025/03/06/features-product03.png', 'png', 68180, NULL, 1, '2025-03-06 05:44:36', '2025-03-06 05:44:36', 'public', NULL),
(47, 'features_product02.png', 'image', 'image/png', '2025/03/06/features-product02.png', 'png', 45504, NULL, 1, '2025-03-06 05:46:27', '2025-03-06 05:46:27', 'public', NULL),
(48, 'features_product02.png', 'image', 'image/png', '2025/03/06/features-product02-1.png', 'png', 45504, NULL, 1, '2025-03-06 05:56:39', '2025-03-06 05:56:39', 'public', NULL),
(49, 'features_product03.png', 'image', 'image/png', '2025/03/06/features-product03-1.png', 'png', 68180, NULL, 1, '2025-03-06 06:45:01', '2025-03-06 06:45:01', 'public', NULL),
(50, 'cart_p01.jpg', 'image', 'image/jpeg', '2025/03/06/cart-p01-1.jpg', 'jpg', 30468, NULL, 1, '2025-03-06 06:46:13', '2025-03-06 06:46:13', 'public', NULL),
(51, 'home_shop_thumb03.png', 'image', 'image/png', '2025/03/06/home-shop-thumb03.png', 'png', 32255, NULL, 1, '2025-03-06 06:46:36', '2025-03-06 06:46:36', 'public', NULL),
(52, 'features_product_shape02.png', 'image', 'image/png', '2025/03/06/features-product-shape02.png', 'png', 21455, NULL, 1, '2025-03-06 06:46:51', '2025-03-06 06:46:51', 'public', NULL),
(53, 'home_shop_thumb04.png', 'image', 'image/png', '2025/03/06/home-shop-thumb04.png', 'png', 30973, NULL, 1, '2025-03-06 06:47:13', '2025-03-06 06:47:13', 'public', NULL),
(54, 'home_shop_thumb06.png', 'image', 'image/png', '2025/03/06/home-shop-thumb06.png', 'png', 29244, NULL, 1, '2025-03-06 06:48:02', '2025-03-06 06:48:02', 'public', NULL),
(55, 'shop-details-thumb08.png', 'image', 'image/png', '2025/03/06/shop-details-thumb08.png', 'png', 54669, NULL, 1, '2025-03-06 06:48:17', '2025-03-06 06:48:17', 'public', NULL),
(56, 'features_product_shape01.png', 'image', 'image/png', '2025/03/06/features-product-shape01.png', 'png', 28725, NULL, 1, '2025-03-06 07:01:50', '2025-03-06 07:01:50', 'public', NULL),
(57, 'features_product_shape03.png', 'image', 'image/png', '2025/03/06/features-product-shape03.png', 'png', 32604, 1, 1, '2025-03-06 07:03:30', '2025-03-06 07:03:30', 'public', NULL),
(58, 'paypal.png', 'image', 'image/png', '2025/03/07/paypal.png', 'png', 14569, NULL, 1, '2025-03-07 03:29:13', '2025-03-07 03:29:13', 'public', NULL),
(59, '854918-sd_960_540_30fps.mp4', 'file', 'video/mp4', '2025/03/22/854918-sd-960-540-30fps.mp4', 'mp4', 4186058, NULL, 1, '2025-03-22 09:20:27', '2025-03-22 09:20:27', 'public', NULL),
(60, 'th.jpg', 'image', 'image/jpeg', '2025/04/03/th.jpg', 'jpg', 12890, NULL, 8, '2025-04-03 12:07:44', '2025-04-03 12:07:44', 'public', NULL),
(61, 'paypal.png', 'image', 'image/png', '2025/04/03/paypal.png', 'png', 14569, NULL, 8, '2025-04-03 12:14:25', '2025-04-03 12:14:25', 'public', NULL),
(62, 'th.jpg', 'image', 'image/jpeg', '2025/04/03/th-1.jpg', 'jpg', 12890, NULL, 8, '2025-04-03 12:14:35', '2025-04-03 12:14:35', 'public', NULL),
(63, 'footer_bg.png', 'image', 'image/jpeg', '2025/04/08/footer-bg.png', 'png', 383080, NULL, 1, '2025-04-08 11:57:53', '2025-04-08 11:57:53', 'public', NULL),
(64, 'breadcrumb_bg.jpg', 'image', 'image/jpeg', '2025/04/08/breadcrumb-bg.jpg', 'jpg', 824728, NULL, 1, '2025-04-08 11:58:20', '2025-04-08 11:58:20', 'public', NULL),
(65, 'blog_img_1.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-1.jpg', 'jpg', 75178, NULL, 1, '2025-04-08 13:11:20', '2025-04-08 13:11:20', 'public', NULL),
(66, 'blog_details_video_img.jpg', 'file', 'image/jpeg', '2025/04/08/blog-details-video-img.jpg', 'jpg', 318345, NULL, 1, '2025-04-08 13:14:13', '2025-04-08 13:14:13', 'public', NULL),
(67, 'blog_img_2.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-2.jpg', 'jpg', 74791, NULL, 1, '2025-04-08 13:22:47', '2025-04-08 13:22:47', 'public', NULL),
(68, 'blog_img_3.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-3.jpg', 'jpg', 81869, NULL, 1, '2025-04-08 13:25:52', '2025-04-08 13:25:52', 'public', NULL),
(69, 'blog_img_9.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-9.jpg', 'jpg', 91692, NULL, 1, '2025-04-08 13:26:50', '2025-04-08 13:26:50', 'public', NULL),
(70, 'blog_img_4.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-4.jpg', 'jpg', 54992, NULL, 1, '2025-04-08 13:27:02', '2025-04-08 13:27:02', 'public', NULL),
(71, 'blog_img_5.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-5.jpg', 'jpg', 96594, NULL, 1, '2025-04-08 13:28:14', '2025-04-08 13:28:14', 'public', NULL),
(72, 'blog_img_6.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-6.jpg', 'jpg', 134483, NULL, 1, '2025-04-08 13:29:24', '2025-04-08 13:29:24', 'public', NULL),
(73, 'blog_img_7.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-7.jpg', 'jpg', 97643, NULL, 1, '2025-04-08 13:30:16', '2025-04-08 13:30:16', 'public', NULL),
(74, 'blog_img_8.jpg', 'image', 'image/jpeg', '2025/04/08/blog-img-8.jpg', 'jpg', 105649, NULL, 1, '2025-04-08 13:31:10', '2025-04-08 13:31:10', 'public', NULL),
(75, 'dashboard_user_img.jpg', 'image', 'image/jpeg', '2025/04/08/dashboard-user-img.jpg', 'jpg', 33320, NULL, 1, '2025-04-08 13:33:49', '2025-04-08 13:33:49', 'public', NULL),
(76, 'courses_img_1.jpg', 'image', 'image/jpeg', '2025/04/08/courses-img-1.jpg', 'jpg', 46687, NULL, 1, '2025-04-08 13:36:20', '2025-04-08 13:36:20', 'public', NULL),
(77, 'courses_img_2.jpg', 'image', 'image/jpeg', '2025/04/08/courses-img-2.jpg', 'jpg', 68859, NULL, 1, '2025-04-08 15:04:58', '2025-04-08 15:04:58', 'public', NULL),
(78, 'courses_img_3.jpg', 'image', 'image/jpeg', '2025/04/08/courses-img-3.jpg', 'jpg', 89378, NULL, 1, '2025-04-08 15:19:00', '2025-04-08 15:19:00', 'public', NULL),
(79, 'courses_img_4.jpg', 'image', 'image/jpeg', '2025/04/08/courses-img-4.jpg', 'jpg', 56917, NULL, 1, '2025-04-08 16:47:50', '2025-04-08 16:47:50', 'public', NULL),
(80, 'courses_img_5.jpg', 'image', 'image/jpeg', '2025/04/08/courses-img-5.jpg', 'jpg', 45517, NULL, 1, '2025-04-08 16:49:55', '2025-04-08 16:49:55', 'public', NULL),
(81, 'courses_img_6.jpg', 'image', 'image/jpeg', '2025/04/08/courses-img-6.jpg', 'jpg', 47018, NULL, 1, '2025-04-08 16:51:51', '2025-04-08 16:51:51', 'public', NULL),
(82, 'logo.png', 'image', 'image/png', '2025/04/08/logo.png', 'png', 5366, NULL, 1, '2025-04-08 17:25:39', '2025-04-08 17:25:39', 'public', NULL),
(83, 'footer_logo.png', 'image', 'image/png', '2025/04/08/footer-logo.png', 'png', 6188, NULL, 1, '2025-04-08 17:25:57', '2025-04-08 17:25:57', 'public', NULL),
(84, 'about_section_bg.jpg', 'image', 'image/jpeg', '2025/04/08/about-section-bg.jpg', 'jpg', 96836, NULL, 1, '2025-04-08 18:05:15', '2025-04-08 18:05:15', 'public', NULL),
(85, 'about-_img_1.jpg', 'image', 'image/jpeg', '2025/04/08/about-img-1.jpg', 'jpg', 126002, NULL, 1, '2025-04-08 18:05:49', '2025-04-08 18:05:49', 'public', NULL),
(86, 'about-_img_2.jpg', 'image', 'image/jpeg', '2025/04/08/about-img-2.jpg', 'jpg', 116399, NULL, 1, '2025-04-08 18:06:00', '2025-04-08 18:06:00', 'public', NULL),
(87, 'about_video_img.jpg', 'image', 'image/jpeg', '2025/04/08/about-video-img.jpg', 'jpg', 680016, NULL, 1, '2025-04-08 18:07:44', '2025-04-08 18:07:44', 'public', NULL),
(88, 'instructor_bg.jpg', 'image', 'image/jpeg', '2025/04/08/instructor-bg.jpg', 'jpg', 435283, NULL, 1, '2025-04-08 18:16:02', '2025-04-08 18:16:02', 'public', NULL),
(89, 'instructor_img_1.png', 'image', 'image/png', '2025/04/08/instructor-img-1.png', 'png', 111974, NULL, 1, '2025-04-08 18:17:21', '2025-04-08 18:17:21', 'public', NULL),
(90, 'instructor_img_2.png', 'image', 'image/png', '2025/04/08/instructor-img-2.png', 'png', 97189, NULL, 1, '2025-04-08 18:23:54', '2025-04-08 18:23:54', 'public', NULL),
(91, 'instructor_img_3.png', 'image', 'image/png', '2025/04/08/instructor-img-3.png', 'png', 106497, NULL, 1, '2025-04-08 18:30:17', '2025-04-08 18:30:17', 'public', NULL),
(92, 'instructor_img_4.png', 'image', 'image/png', '2025/04/08/instructor-img-4.png', 'png', 91703, NULL, 1, '2025-04-08 18:30:49', '2025-04-08 18:30:49', 'public', NULL),
(93, 'instructor_img_5.png', 'image', 'image/png', '2025/04/08/instructor-img-5.png', 'png', 100059, NULL, 1, '2025-04-08 18:31:13', '2025-04-08 18:31:13', 'public', NULL),
(94, 'instructor_img_6.png', 'image', 'image/png', '2025/04/08/instructor-img-6.png', 'png', 105127, NULL, 1, '2025-04-08 18:31:40', '2025-04-08 18:31:40', 'public', NULL),
(95, 'certificate_bg.jpg', 'image', 'image/jpeg', '2025/04/08/certificate-bg.jpg', 'jpg', 602178, NULL, 1, '2025-04-08 18:36:18', '2025-04-08 18:36:18', 'public', NULL),
(96, 'certificate_icon_1.png', 'image', 'image/png', '2025/04/08/certificate-icon-1.png', 'png', 3802, NULL, 1, '2025-04-08 18:37:39', '2025-04-08 18:37:39', 'public', NULL),
(97, 'certificate_icon_2.png', 'image', 'image/png', '2025/04/08/certificate-icon-2.png', 'png', 2952, NULL, 1, '2025-04-08 18:38:12', '2025-04-08 18:38:12', 'public', NULL),
(98, 'certificate_icon_3.png', 'image', 'image/png', '2025/04/08/certificate-icon-3.png', 'png', 3642, NULL, 1, '2025-04-08 18:38:44', '2025-04-08 18:38:44', 'public', NULL),
(99, 'certificate_icon_4.png', 'image', 'image/png', '2025/04/08/certificate-icon-4.png', 'png', 3538, NULL, 1, '2025-04-08 18:39:04', '2025-04-08 18:39:04', 'public', NULL),
(100, 'testimonial_bg.jpg', 'image', 'image/jpeg', '2025/04/08/testimonial-bg.jpg', 'jpg', 105571, NULL, 1, '2025-04-08 18:40:57', '2025-04-08 18:40:57', 'public', NULL),
(101, 'testimonial_img_1.jpg', 'image', 'image/jpeg', '2025/04/08/testimonial-img-1.jpg', 'jpg', 6175, NULL, 1, '2025-04-08 18:43:06', '2025-04-08 18:43:06', 'public', NULL),
(102, 'testimonial_img_2.jpg', 'image', 'image/jpeg', '2025/04/08/testimonial-img-2.jpg', 'jpg', 5669, NULL, 1, '2025-04-08 18:44:53', '2025-04-08 18:44:53', 'public', NULL),
(103, 'testimonial_img_3.jpg', 'image', 'image/jpeg', '2025/04/08/testimonial-img-3.jpg', 'jpg', 5978, NULL, 1, '2025-04-08 18:46:05', '2025-04-08 18:46:05', 'public', NULL),
(104, 'course_video_img.jpg', 'image', 'image/jpeg', '2025/04/09/course-video-img.jpg', 'jpg', 115620, NULL, 1, '2025-04-09 16:52:49', '2025-04-09 16:52:49', 'public', NULL),
(105, 'sidebar_video_img.jpg', 'image', 'image/jpeg', '2025/04/09/sidebar-video-img.jpg', 'jpg', 26629, NULL, 1, '2025-04-09 16:55:34', '2025-04-09 16:55:34', 'public', NULL),
(106, 'pngwing.com.png', 'image', 'image/png', '2025/04/09/pngwingcom.png', 'png', 23401, NULL, 1, '2025-04-09 19:30:31', '2025-04-09 19:30:31', 'public', NULL),
(107, 'banner_bg.jpg', 'image', 'image/jpeg', '2025/04/20/banner-bg.jpg', 'jpg', 538084, NULL, 1, '2025-04-20 07:04:22', '2025-04-20 07:04:22', 'public', NULL),
(108, 'banner_img.png', 'image', 'image/png', '2025/04/20/banner-img.png', 'png', 579553, NULL, 1, '2025-04-20 07:04:54', '2025-04-20 07:04:54', 'public', NULL),
(109, 'category_bg.jpg', 'image', 'image/jpeg', '2025/04/20/category-bg.jpg', 'jpg', 67182, NULL, 1, '2025-04-20 07:07:54', '2025-04-20 07:07:54', 'public', NULL),
(110, 'category_icon_1.png', 'image', 'image/png', '2025/04/20/category-icon-1.png', 'png', 2869, NULL, 1, '2025-04-20 07:09:07', '2025-04-20 07:09:07', 'public', NULL),
(111, 'logo.png', 'image', 'image/png', '2025/04/20/logo.png', 'png', 5366, NULL, 1, '2025-04-20 19:10:40', '2025-04-20 19:10:40', 'public', NULL),
(112, 'favicon.png', 'image', 'image/png', '2025/04/20/favicon.png', 'png', 1788, NULL, 1, '2025-04-20 19:13:14', '2025-04-20 19:13:14', 'public', NULL),
(113, 'favicon.png', 'image', 'image/png', '2025/04/20/favicon-1.png', 'png', 2219, NULL, 1, '2025-04-20 19:15:51', '2025-04-20 19:15:51', 'public', NULL),
(114, 'category_icon_2.png', 'image', 'image/png', '2025/04/21/category-icon-2.png', 'png', 2286, NULL, 1, '2025-04-21 10:56:23', '2025-04-21 10:56:23', 'public', NULL),
(115, 'category_icon_3.png', 'image', 'image/png', '2025/04/21/category-icon-3.png', 'png', 2176, NULL, 1, '2025-04-21 10:57:12', '2025-04-21 10:57:12', 'public', NULL),
(116, 'category_icon_4.png', 'image', 'image/png', '2025/04/21/category-icon-4.png', 'png', 2196, NULL, 1, '2025-04-21 10:57:37', '2025-04-21 10:57:37', 'public', NULL),
(117, 'category_icon_5.png', 'image', 'image/png', '2025/04/21/category-icon-5.png', 'png', 2615, NULL, 1, '2025-04-21 10:59:25', '2025-04-21 10:59:25', 'public', NULL),
(118, 'category_icon_6.png', 'image', 'image/png', '2025/04/21/category-icon-6.png', 'png', 1971, NULL, 1, '2025-04-21 10:59:46', '2025-04-21 10:59:46', 'public', NULL),
(119, 'category_icon_7.png', 'image', 'image/png', '2025/04/21/category-icon-7.png', 'png', 2087, NULL, 1, '2025-04-21 11:00:08', '2025-04-21 11:00:08', 'public', NULL),
(120, 'category_icon_8.png', 'image', 'image/png', '2025/04/21/category-icon-8.png', 'png', 1725, NULL, 1, '2025-04-21 11:00:28', '2025-04-21 11:00:28', 'public', NULL),
(121, 'about_section_bg.jpg', 'image', 'image/jpeg', '2025/04/21/about-section-bg.jpg', 'jpg', 96836, NULL, 1, '2025-04-21 11:01:36', '2025-04-21 11:01:36', 'public', NULL),
(122, 'about-_img_1.jpg', 'image', 'image/jpeg', '2025/04/21/about-img-1.jpg', 'jpg', 126002, NULL, 1, '2025-04-21 11:01:58', '2025-04-21 11:01:58', 'public', NULL),
(123, 'about-_img_2.jpg', 'image', 'image/jpeg', '2025/04/21/about-img-2.jpg', 'jpg', 116399, NULL, 1, '2025-04-21 11:02:10', '2025-04-21 11:02:10', 'public', NULL),
(124, 'courses_bg.jpg', 'image', 'image/jpeg', '2025/04/21/courses-bg.jpg', 'jpg', 648208, NULL, 1, '2025-04-21 11:04:43', '2025-04-21 11:04:43', 'public', NULL),
(125, 'student_choose_bg.jpg', 'image', 'image/jpeg', '2025/04/21/student-choose-bg.jpg', 'jpg', 101397, NULL, 1, '2025-04-21 11:06:36', '2025-04-21 11:06:36', 'public', NULL),
(126, 'student_choose_img_1.jpg', 'image', 'image/jpeg', '2025/04/21/student-choose-img-1.jpg', 'jpg', 65090, NULL, 1, '2025-04-21 11:07:46', '2025-04-21 11:07:46', 'public', NULL),
(127, 'student_choose_img_2.jpg', 'image', 'image/jpeg', '2025/04/21/student-choose-img-2.jpg', 'jpg', 17200, NULL, 1, '2025-04-21 11:07:56', '2025-04-21 11:07:56', 'public', NULL),
(128, 'event_bg.jpg', 'image', 'image/jpeg', '2025/04/21/event-bg.jpg', 'jpg', 118399, NULL, 1, '2025-04-21 11:08:51', '2025-04-21 11:08:51', 'public', NULL),
(129, 'testimonial_bg.jpg', 'image', 'image/jpeg', '2025/04/21/testimonial-bg.jpg', 'jpg', 105571, NULL, 1, '2025-04-21 11:10:40', '2025-04-21 11:10:40', 'public', NULL),
(130, 'testimonial_img_1.jpg', 'image', 'image/jpeg', '2025/04/21/testimonial-img-1.jpg', 'jpg', 6175, NULL, 1, '2025-04-21 11:11:11', '2025-04-21 11:11:11', 'public', NULL),
(131, 'testimonial_img_2.jpg', 'image', 'image/jpeg', '2025/04/21/testimonial-img-2.jpg', 'jpg', 5669, NULL, 1, '2025-04-21 11:14:15', '2025-04-21 11:14:15', 'public', NULL),
(132, 'testimonial_img_3.jpg', 'image', 'image/jpeg', '2025/04/21/testimonial-img-3.jpg', 'jpg', 5978, NULL, 1, '2025-04-21 11:15:51', '2025-04-21 11:15:51', 'public', NULL),
(133, 'certificate_bg.jpg', 'image', 'image/jpeg', '2025/04/21/certificate-bg.jpg', 'jpg', 602178, NULL, 1, '2025-04-21 11:17:07', '2025-04-21 11:17:07', 'public', NULL),
(134, 'certificate_icon_1.png', 'image', 'image/png', '2025/04/21/certificate-icon-1.png', 'png', 3802, NULL, 1, '2025-04-21 11:17:35', '2025-04-21 11:17:35', 'public', NULL),
(135, 'certificate_icon_2.png', 'image', 'image/png', '2025/04/21/certificate-icon-2.png', 'png', 2952, NULL, 1, '2025-04-21 11:18:07', '2025-04-21 11:18:07', 'public', NULL),
(136, 'certificate_icon_3.png', 'image', 'image/png', '2025/04/21/certificate-icon-3.png', 'png', 3642, NULL, 1, '2025-04-21 11:18:41', '2025-04-21 11:18:41', 'public', NULL),
(137, 'certificate_icon_4.png', 'image', 'image/png', '2025/04/21/certificate-icon-4.png', 'png', 3538, NULL, 1, '2025-04-21 11:19:11', '2025-04-21 11:19:11', 'public', NULL),
(138, 'instructor_bg.jpg', 'image', 'image/jpeg', '2025/04/21/instructor-bg.jpg', 'jpg', 435283, NULL, 1, '2025-04-21 11:20:34', '2025-04-21 11:20:34', 'public', NULL),
(139, 'instructor_details_img.png', 'image', 'image/png', '2025/04/21/instructor-details-img.png', 'png', 200684, NULL, 1, '2025-04-21 11:22:19', '2025-04-21 11:22:19', 'public', NULL),
(140, 'instructor_img_1.png', 'image', 'image/png', '2025/04/21/instructor-img-1.png', 'png', 111974, NULL, 1, '2025-04-21 11:22:29', '2025-04-21 11:22:29', 'public', NULL),
(141, 'instructor_img_2.png', 'image', 'image/png', '2025/04/21/instructor-img-2.png', 'png', 97189, NULL, 1, '2025-04-21 11:26:00', '2025-04-21 11:26:00', 'public', NULL),
(142, 'instructor_img_3.png', 'image', 'image/png', '2025/04/21/instructor-img-3.png', 'png', 106497, NULL, 1, '2025-04-21 11:27:57', '2025-04-21 11:27:57', 'public', NULL),
(143, 'instructor_img_4.png', 'image', 'image/png', '2025/04/21/instructor-img-4.png', 'png', 91703, NULL, 1, '2025-04-21 11:28:26', '2025-04-21 11:28:26', 'public', NULL),
(144, 'instructor_img_5.png', 'image', 'image/png', '2025/04/21/instructor-img-5.png', 'png', 100059, NULL, 1, '2025-04-21 11:28:39', '2025-04-21 11:28:39', 'public', NULL),
(145, 'instructor_img_6.png', 'image', 'image/png', '2025/04/21/instructor-img-6.png', 'png', 105127, NULL, 1, '2025-04-21 11:28:54', '2025-04-21 11:28:54', 'public', NULL),
(146, 'blog_bg.jpg', 'image', 'image/jpeg', '2025/04/21/blog-bg.jpg', 'jpg', 125393, NULL, 1, '2025-04-21 11:30:49', '2025-04-21 11:30:49', 'public', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_media_folders`
--

CREATE TABLE `app_media_folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'image',
  `folder_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disk` varchar(50) NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_menus`
--

CREATE TABLE `app_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_menus`
--

INSERT INTO `app_menus` (`id`, `name`, `description`, `created_at`, `updated_at`, `uuid`) VALUES
(11, 'Main Menu', NULL, '2025-01-28 12:18:15', '2025-04-08 17:41:01', '84ba77ce-7feb-44bb-94c1-02178ca41482'),
(12, 'fcgjvb', NULL, '2025-02-01 12:30:46', '2025-02-01 12:30:46', 'a6be2487-7db7-4d24-bc46-65113d84c726'),
(13, 'Footer 2 menu', NULL, '2025-04-08 17:41:34', '2025-04-08 17:41:51', '40e7a1f3-2907-4082-91dc-a2c964911bb7'),
(14, 'Footer Bottom Menu', NULL, '2025-04-21 11:42:18', '2025-04-21 11:42:18', 'b79853bc-81b9-43f2-a84c-93290aa5cada');

-- --------------------------------------------------------

--
-- Table structure for table `app_menu_items`
--

CREATE TABLE `app_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `box_key` varchar(50) NOT NULL,
  `label` varchar(100) NOT NULL,
  `model_class` varchar(100) DEFAULT NULL,
  `model_id` bigint(20) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `target` varchar(10) NOT NULL DEFAULT '_self',
  `num_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_menu_items`
--

INSERT INTO `app_menu_items` (`id`, `menu_id`, `parent_id`, `box_key`, `label`, `model_class`, `model_id`, `link`, `icon`, `target`, `num_order`) VALUES
(7, 11, NULL, 'post_type_pages', 'Home', 'Juzaweb\\Backend\\Models\\Post', 11, NULL, NULL, '_self', 1),
(8, 11, NULL, 'custom_url', 'Courses', NULL, NULL, '/courses', NULL, '_self', 3),
(9, 11, NULL, 'custom_url', 'Event', NULL, NULL, '/events', NULL, '_self', 4),
(10, 11, NULL, 'custom_url', 'Blog', NULL, NULL, '/blogs', NULL, '_self', 5),
(11, 11, NULL, 'custom_url', 'Pages', NULL, NULL, '#', NULL, '_self', 6),
(12, 11, NULL, 'post_type_pages', 'Contact', 'Juzaweb\\Backend\\Models\\Post', 22, NULL, NULL, '_self', 15),
(13, 11, NULL, 'post_type_pages', 'About Us', 'Juzaweb\\Backend\\Models\\Post', 151, NULL, NULL, '_self', 2),
(14, 11, 11, 'post_type_events', 'Event Details', 'Juzaweb\\Backend\\Models\\Post', 150, NULL, NULL, '_self', 7),
(15, 11, 11, 'post_type_posts', 'Blog Details', 'Juzaweb\\Backend\\Models\\Post', 142, NULL, NULL, '_self', 8),
(16, 11, 11, 'post_type_pages', 'Privacy policy', 'Juzaweb\\Backend\\Models\\Post', 24, NULL, NULL, '_self', 9),
(17, 11, 11, 'post_type_pages', 'Terms And Condition', 'Juzaweb\\Backend\\Models\\Post', 152, NULL, NULL, '_self', 10),
(18, 11, 11, 'post_type_pages', 'FAQs', 'Juzaweb\\Backend\\Models\\Post', 23, NULL, NULL, '_self', 11),
(19, 11, 11, 'custom_url', '404', NULL, NULL, '/404', NULL, '_self', 12),
(20, 11, 11, 'custom_url', 'Cart', NULL, NULL, '/cart', NULL, '_self', 13),
(21, 13, NULL, 'post_type_pages', 'Privacy policy', 'Juzaweb\\Backend\\Models\\Post', 24, NULL, NULL, '_self', 2),
(22, 13, NULL, 'post_type_pages', 'Courses', 'Juzaweb\\Backend\\Models\\Post', 122, NULL, NULL, '_self', 3),
(23, 13, NULL, 'post_type_pages', 'About Us', 'Juzaweb\\Backend\\Models\\Post', 151, NULL, NULL, '_self', 4),
(24, 13, NULL, 'post_type_pages', 'Terms And Condition', 'Juzaweb\\Backend\\Models\\Post', 152, NULL, NULL, '_self', 5),
(25, 13, NULL, 'post_type_pages', 'Home', 'Juzaweb\\Backend\\Models\\Post', 11, NULL, NULL, '_self', 1),
(26, 11, 11, 'custom_url', 'Checkout', NULL, NULL, '/checkout', NULL, '_self', 14),
(27, 14, NULL, 'post_type_pages', 'Courses', 'Juzaweb\\Backend\\Models\\Post', 122, NULL, NULL, '_self', 1),
(28, 14, NULL, 'post_type_pages', 'Blogs', 'Juzaweb\\Backend\\Models\\Post', 133, NULL, NULL, '_self', 2),
(29, 14, NULL, 'post_type_pages', 'About Us', 'Juzaweb\\Backend\\Models\\Post', 151, NULL, NULL, '_self', 3);

-- --------------------------------------------------------

--
-- Table structure for table `app_migrations`
--

CREATE TABLE `app_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(150) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_migrations`
--

INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_04_02_193005_create_translations_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2018_08_08_100000_create_telescope_entries_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2020_06_17_141252_create_pages_table', 1),
(13, '2020_06_17_141314_create_posts_table', 1),
(14, '2020_06_17_141546_create_configs_table', 1),
(15, '2020_07_13_101632_create_media_files_table', 1),
(16, '2020_07_13_101706_create_media_folders_table', 1),
(17, '2020_07_19_093715_create_theme_configs_table', 1),
(18, '2020_08_05_145156_create_comments_table', 1),
(19, '2021_01_08_103537_add_columns_to_users_table', 1),
(20, '2021_01_08_143358_create_taxonomies_table', 1),
(21, '2021_01_08_143537_create_user_metas_table', 1),
(22, '2021_01_09_154753_create_email_lists_table', 1),
(23, '2021_02_09_091923_create_email_templates_table', 1),
(24, '2021_03_10_031508_create_term_taxonomies_table', 1),
(25, '2021_04_18_072732_update_notifications_table', 1),
(26, '2021_04_18_093643_create_manual_notifications_table', 1),
(27, '2021_08_12_053735_create_menus_table', 1),
(28, '2021_09_12_142856_update_database_v106', 1),
(29, '2021_09_21_055918_add_level_column_to_taxonomies_table', 1),
(30, '2021_09_21_074810_create_search_table', 1),
(31, '2021_09_26_053902_add_description_column_to_pages_table', 1),
(32, '2021_10_19_153921_create_language_lines_table', 1),
(33, '2021_10_19_162424_create_resources_table', 1),
(34, '2021_10_19_163450_create_single_taxonomies_table', 1),
(35, '2021_10_24_061612_add_type_to_posts_table', 1),
(36, '2021_10_25_063534_add_data_to_users_table', 1),
(37, '2021_11_06_044329_create_jobs_table', 1),
(38, '2021_11_06_123423_add_metas_column_to_posts_table', 1),
(39, '2021_11_06_164602_create_languages_table', 1),
(40, '2021_11_13_112150_add_json_taxonomies_column_to_posts_table', 1),
(41, '2021_11_23_053012_add_display_order_column_to_resources_table', 1),
(42, '2021_11_26_100137_create_post_views_table', 1),
(43, '2021_11_26_150252_create_post_ratings_table', 1),
(44, '2021_11_26_172822_add_rating_column_to_posts_table', 1),
(45, '2021_11_27_074456_add_object_key_to_translations_table', 1),
(46, '2021_12_14_142948_create_permission_groups_table', 1),
(47, '2021_12_15_083034_create_social_tokens_table', 1),
(48, '2021_12_15_141831_create_permission_tables', 1),
(49, '2021_12_16_070521_add_columns_to_roles_table', 1),
(50, '2021_12_18_051140_create_seo_metas_table', 1),
(51, '2021_12_18_140504_add_foreign_to_comments_table', 1),
(52, '2022_02_12_105437_add_total_comment_column_to_posts_table', 1),
(53, '2022_03_12_080104_add_index_code_column_configs_table', 1),
(54, '2022_03_31_083337_add_description_column_to_permission_groups_table', 1),
(55, '2022_08_06_045723_update_version_v325', 1),
(56, '2022_09_04_191144_create_table_groups_table', 1),
(57, '2022_11_12_032456_create_post_likes_table', 1),
(58, '2022_11_26_070653_add_object_columns_to_language_lines_table', 1),
(59, '2022_12_03_044603_add_template_code_column_to_email_lists_table', 1),
(60, '2022_12_18_141652_add_slug_column_to_resources_table', 1),
(61, '2023_02_05_033908_add_index_to_media_table', 1),
(62, '2023_02_17_024906_add_uuid_column_to_exports_tables', 1),
(63, '2023_04_17_063702_add_is_fake_column_to_users_table', 1),
(64, '2023_05_02_200212_add_locale_column_to_posts_table', 1),
(65, '2023_06_29_232141_add_active_column_to_email_templates_table', 1),
(66, '2023_07_01_132207_create_email_templates_to_users_table', 1),
(67, '2023_08_20_080039_add_disk_column_to_media_files_table', 1),
(70, '2025_02_06_014758_create_payment_methods_table', 4),
(71, '2025_02_06_024758_create_payment_histories_table', 5),
(79, '2025_02_11_084836_create_currencies_table', 7),
(80, '2025_02_11_104949_create_orders_table', 7),
(81, '2025_02_11_105900_create_order_items_table', 7),
(82, '2025_02_11_111124_create_carts_table', 7),
(83, '2025_02_11_120001_create_product_variants_table', 8),
(84, '2025_02_11_120002_create_attributes_table', 8),
(85, '2025_02_11_120003_create_attribute_values_table', 8),
(86, '2025_02_11_120004_create_variants_attributes_table', 8),
(87, '2025_02_11_120005_create_product_variants_attribute_values_table', 8),
(88, '2025_02_11_120006_create_discounts_table', 8),
(89, '2025_02_11_120007_create_download_links_table', 8),
(90, '2025_02_11_120008_create_shipping_address_table', 8),
(91, '2025_02_11_120010_create_shipping_methods_table', 8),
(92, '2025_02_11_1393743_create_addons_table', 8),
(101, '2025_02_08_051102_create_event_tickets_table', 9),
(102, '2025_02_08_112400_create_event_bookings_table', 9),
(104, '2025_02_06_014758_create_contacts_table', 10),
(107, '2025_03_08_082922_test_eomm_plugin', 11),
(112, '2025_03_21_105437_add_json_metas_column_to_comments_table', 13),
(113, '2025_03_21_095307_add_json_metas_to_comments_table', 14),
(114, '2025_03_09_120001_create_course_topics_table', 15),
(115, '2025_03_09_120002_create_course_lessons_table', 15),
(119, '2025_08_07_000001_create_dev_tool_cms_versions_table', 16),
(120, '2025_08_07_000002_create_dev_tool_package_versions_table', 16),
(123, '2025_09_23_000001_create_marketplace_themes_table', 17),
(124, '2025_09_23_000002_create_marketplace_plugins_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `app_model_has_permissions`
--

CREATE TABLE `app_model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(150) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_model_has_roles`
--

CREATE TABLE `app_model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(150) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_notifications`
--

CREATE TABLE `app_notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(150) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `notifiable_type` varchar(150) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_notifications`
--

INSERT INTO `app_notifications` (`id`, `type`, `data`, `read_at`, `notifiable_type`, `notifiable_id`, `created_at`, `updated_at`) VALUES
('0090267c-f2bb-44a9-98ca-311f4d5c7d70', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-29 02:05:40', '2025-03-29 02:05:40'),
('093824c2-de08-422e-beed-d0d8643f3911', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-06 22:43:40', '2025-03-06 22:43:40'),
('0d6a3832-a91f-4498-a2d1-99e642d13bfa', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', '2025-04-08 16:56:35', 'Juzaweb\\CMS\\Models\\User', 1, '2025-04-03 10:54:56', '2025-04-08 16:56:35'),
('4421492a-114f-42d8-ab1f-0c8020e8e18e', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', '2025-04-08 16:55:18', 'Juzaweb\\CMS\\Models\\User', 1, '2025-04-04 12:37:37', '2025-04-08 16:55:18'),
('4a30ddfe-f0ca-4989-8157-9da9ccdb96e7', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-24 11:09:51', '2025-03-24 11:09:51'),
('521b9b46-2023-4942-a5e3-d65412b40b4e', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-06 00:41:25', '2025-03-06 00:41:25'),
('630d6fab-eb5e-4461-bc8c-e3bd62c1b6c8', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-06 00:36:00', '2025-03-06 00:36:00'),
('6ef3d3e8-be3a-40fa-a9b4-c99099ccd90b', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-24 11:07:52', '2025-03-24 11:07:52'),
('76ba6d41-7863-48e4-ab69-8be3460f6892', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-08 01:18:34', '2025-03-08 01:18:34'),
('7ca7f386-edcd-4347-9890-7091b8849ad4', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-24 11:27:23', '2025-03-24 11:27:23'),
('983418e1-4f0d-4a19-910e-e017cb74b5aa', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-07 09:46:17', '2025-03-07 09:46:17'),
('a1195630-9402-4ebe-9386-7f5a2cb49539', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-07 09:50:54', '2025-03-07 09:50:54'),
('b4014fda-4be4-4f0a-a360-5d90cb5640ef', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-29 10:46:29', '2025-03-29 10:46:29'),
('bef1ad88-b6f3-4b19-8771-8b4f24412035', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-25 12:20:23', '2025-03-25 12:20:23'),
('c8a0c348-81df-42ca-a0c6-69be5a3adccc', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-24 11:08:35', '2025-03-24 11:08:35'),
('d3b54e8d-248a-40ad-a577-8683621ab655', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-07 09:52:08', '2025-03-07 09:52:08'),
('e55a94f0-d9f4-4c77-884f-c3c00a9e8438', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', '2025-03-02 09:44:01', 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-02 07:18:28', '2025-03-02 09:44:01'),
('ff73bafc-415b-49cc-b21f-07e98ffa5f7b', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-07 09:50:24', '2025-03-07 09:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_access_tokens`
--

CREATE TABLE `app_oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_auth_codes`
--

CREATE TABLE `app_oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_clients`
--

CREATE TABLE `app_oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(150) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_personal_access_clients`
--

CREATE TABLE `app_oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_oauth_refresh_tokens`
--

CREATE TABLE `app_oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_orders`
--

CREATE TABLE `app_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` char(36) NOT NULL,
  `code` varchar(150) NOT NULL,
  `title` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'ecommerce',
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `payment_status` varchar(150) NOT NULL DEFAULT 'pending',
  `delivery_status` varchar(150) NOT NULL DEFAULT 'pending',
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country_code` varchar(15) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `discount_codes` varchar(150) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method_name` varchar(250) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `site_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_orders`
--

INSERT INTO `app_orders` (`id`, `token`, `code`, `title`, `type`, `status`, `payment_status`, `delivery_status`, `name`, `email`, `phone`, `address`, `country_code`, `quantity`, `total_price`, `total`, `discount`, `discount_codes`, `payment_method_id`, `payment_method_name`, `notes`, `user_id`, `site_id`, `created_at`, `updated_at`) VALUES
(214, 'b5e070ad-e071-494f-9045-a5bd3fbb4198', '202504091925111', 'Order #202504091925111', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, 220.00, 220.00, 0.00, NULL, 3, 'Stripe', NULL, 1, NULL, '2025-04-09 19:25:11', '2025-04-09 19:26:13'),
(215, 'cbaaea31-cb79-4e16-96d7-c749755f2d3f', '202504111535571', 'Order #202504111535571', 'courses', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, 120.00, 120.00, 0.00, NULL, 3, 'Stripe', NULL, 1, NULL, '2025-04-11 15:35:57', '2025-04-11 15:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `app_order_items`
--

CREATE TABLE `app_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'product',
  `thumbnail` varchar(150) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `line_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `compare_price` decimal(15,2) DEFAULT NULL,
  `sku_code` varchar(100) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_order_items`
--

INSERT INTO `app_order_items` (`id`, `title`, `type`, `thumbnail`, `price`, `line_price`, `quantity`, `compare_price`, `sku_code`, `barcode`, `post_id`, `order_id`, `created_at`, `updated_at`) VALUES
(221, 'The Importance Of Intrinsic Motivation.', 'events', '2025/04/08/courses-img-6.jpg', 220.00, 220.00, 1, 0.00, '', '', 150, 214, '2025-04-09 19:25:11', '2025-04-09 19:25:11'),
(222, 'Project Management Principles & Practices', 'courses', '2025/04/08/courses-img-6.jpg', 120.00, 120.00, 1, 230.00, '', '', 162, 215, '2025-04-11 15:35:57', '2025-04-11 15:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `app_order_item_metas`
--

CREATE TABLE `app_order_item_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_order_metas`
--

CREATE TABLE `app_order_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_pages`
--

CREATE TABLE `app_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `template` varchar(50) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `template_data` longtext DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_page_metas`
--

CREATE TABLE `app_page_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_password_resets`
--

CREATE TABLE `app_password_resets` (
  `email` varchar(150) NOT NULL,
  `token` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_payment_histories`
--

CREATE TABLE `app_payment_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(150) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_reference` varchar(150) DEFAULT NULL,
  `payer_email` varchar(150) DEFAULT NULL,
  `method` varchar(50) NOT NULL,
  `agreement_id` varchar(150) NOT NULL,
  `payer_id` varchar(150) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'pending',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `processed_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `payment_type` varchar(50) DEFAULT NULL,
  `error_message` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_payment_methods`
--

CREATE TABLE `app_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_payment_methods`
--

INSERT INTO `app_payment_methods` (`id`, `type`, `name`, `description`, `image`, `data`, `active`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'Paypal', 'adadsd', '2025/04/09/pngwingcom.png', '{\"mode\":\"sandbox\",\"sandbox_client_id\":\"Ae_EqULnkWwIRsubEs8n6FTVc48VpD5X8a_6Npk23zIhn81Aw7W6QH7hyOqSE443aUoc0FRrxa8IZiGs\",\"sandbox_secret\":\"ECCkJXVtmmMgy_ai5i_1AuUJtbO7e6P_gQISQzwctaApGyJD2h1LPi2reSt5ac_FPGESoprR3i1eIaFC\",\"live_client_id\":null,\"live_secret\":null}', 1, '2025-02-06 08:39:41', '2025-04-09 19:30:39'),
(2, 'custom', 'fgf', 'You will be redirected to Stripe to complete the payment. (Debit card/Credit card/Online banking)', NULL, '{\"description\": \"Payment description\"}', 1, '2025-02-20 23:58:59', '2025-02-23 10:53:07'),
(3, 'stripe', 'Stripe', 'Stripe', NULL, '{\"mode\": \"test\", \"webhook_secret\": null, \"live_secret_key\": null, \"test_secret_key\": \"sk_test_51N4eDoFNqndPjg2XrvImm40p6LoRjrJimWykVbpQnzVvUSDyEbA140iXLFsrPeh4wv0i5q3I3SM8aBuUX5ZBE7YD00AE1LVUKN\", \"live_publishable_key\": null, \"test_publishable_key\": \"pk_test_51N4eDoFNqndPjg2XgA6h2UbpIysYQmjOdVh8SaFxsYCPcwNxY5BnIWyuCSYKgxPqK3QhiCOZt6vCmf5rfmgsWPho00GyRSimvC\"}', 1, '2025-02-23 20:10:37', '2025-03-03 05:51:16'),
(4, 'mollie', 'Mollie', 'Description', NULL, '{\"mode\": \"sandbox\", \"live_api_key\": null, \"sandbox_api_key\": \"test_7UVc8MRSkupvtj9tBuySkt5g4vR3vJ\"}', 1, '2025-03-03 22:21:58', '2025-03-03 22:49:16'),
(5, 'cod', 'Cash On Delivery', NULL, NULL, NULL, 1, '2025-03-04 03:21:53', '2025-03-04 03:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `app_permissions`
--

CREATE TABLE `app_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `guard_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_permissions`
--

INSERT INTO `app_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'post-type.pages.index', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'View List Pages'),
(2, 'post-type.pages.create', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Create Pages'),
(3, 'post-type.pages.edit', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Edit Pages'),
(4, 'post-type.pages.delete', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Delete Pages'),
(5, 'post-type.posts.index', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'View List Posts'),
(6, 'post-type.posts.create', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Create Posts'),
(7, 'post-type.posts.edit', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Edit Posts'),
(8, 'post-type.posts.delete', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', 'Delete Posts');

-- --------------------------------------------------------

--
-- Table structure for table `app_permission_groups`
--

CREATE TABLE `app_permission_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `plugin` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_personal_access_tokens`
--

CREATE TABLE `app_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(150) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_posts`
--

CREATE TABLE `app_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'posts',
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`)),
  `json_taxonomies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_taxonomies`)),
  `rating` double(8,2) NOT NULL DEFAULT 0.00,
  `total_rating` int(11) NOT NULL DEFAULT 0,
  `total_comment` bigint(20) NOT NULL DEFAULT 0,
  `uuid` char(36) DEFAULT NULL,
  `locale` varchar(5) NOT NULL DEFAULT 'vi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_posts`
--

INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(4, 'hgvj', NULL, 'hgvj', '', NULL, 'publish', 0, '2025-01-19 11:26:20', '2025-01-19 11:26:20', 1, 1, 'examples', '{\"select\": \"1\", \"example\": \"jkhj\"}', '[]', 0.00, 0, 0, 'b4649985-c678-403d-807f-366a9c67a739', 'vi'),
(11, 'Home', NULL, 'home', '', NULL, 'publish', 18, '2025-01-30 10:26:12', '2025-04-21 11:30:57', 1, 1, 'pages', '{\"template\":\"home\",\"block_content\":{\"content\":[{\"background_image\":\"2025\\/04\\/20\\/banner-bg.jpg\",\"subtitle\":\"Discover your journey\",\"title\":\"The Best Free Online Courses of All Time\",\"highlight_text\":\"Courses\",\"description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people.\",\"button_text\":\"Courses\",\"button_url\":\"\\/courses\",\"show_arrow_icon\":\"1\",\"banner_image\":\"2025\\/04\\/20\\/banner-img.png\",\"enable_animation\":\"1\",\"block\":\"hero_section_home\"},{\"background_image\":\"2025\\/04\\/20\\/category-bg.jpg\",\"section_title\":\"Explore Our Categories\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"section_url\":null,\"categories\":[{\"category\":\"26\",\"icon\":\"2025\\/04\\/20\\/category-icon-1.png\",\"color_scheme\":\"category_1\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"23\",\"icon\":\"2025\\/04\\/21\\/category-icon-2.png\",\"color_scheme\":\"category_2\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"28\",\"icon\":\"2025\\/04\\/21\\/category-icon-3.png\",\"color_scheme\":\"category_3\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"32\",\"icon\":\"2025\\/04\\/21\\/category-icon-4.png\",\"color_scheme\":\"category_4\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"34\",\"icon\":\"2025\\/04\\/21\\/category-icon-5.png\",\"color_scheme\":\"category_4\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"35\",\"icon\":\"2025\\/04\\/21\\/category-icon-6.png\",\"color_scheme\":\"category_3\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"36\",\"icon\":\"2025\\/04\\/21\\/category-icon-7.png\",\"color_scheme\":\"category_2\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"37\",\"icon\":\"2025\\/04\\/21\\/category-icon-8.png\",\"color_scheme\":\"category_1\",\"custom_title\":null,\"custom_url\":null}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"course_category_home\"},{\"background_image\":\"2025\\/04\\/21\\/about-section-bg.jpg\",\"image_1\":\"2025\\/04\\/21\\/about-img-1.jpg\",\"image_2\":\"2025\\/04\\/21\\/about-img-2.jpg\",\"title\":\"We do great things together\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius.\",\"features\":[{\"icon\":\"fas fa-star\",\"title\":\"Build your career\",\"description\":\"Online course quickly from anywhere.\"},{\"icon\":\"fas fa-pencil-ruler\",\"title\":\"Grow your skill\",\"description\":\"Online course quickly from anywhere.\"}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"about_us_home\"},{\"background_image\":\"2025\\/04\\/21\\/courses-bg.jpg\",\"section_title\":\"Our Popular Courses\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"course_limit\":\"6\",\"order_by\":\"created_at\",\"order\":\"DESC\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"course_list_home\"},{\"background_image\":\"2025\\/04\\/21\\/student-choose-bg.jpg\",\"section_title\":\"Why Students Choose Us for Gain Their Knowledge\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Posuere vulputate at tortor aenean tortor tincidunt dui consequat enim. Vel iaculis euismod et scelerisque condimentum nulla cras. Praesent diam orci id et eu nulla id. Auctor fermentum.\",\"features\":[{\"text\":\"Free for physically handcraft.\"},{\"text\":\"Easy to enroll courses\"},{\"text\":\"Course certificate for particular course\"}],\"button_text\":\"More About Us\",\"button_url\":\"#\",\"image_1\":\"2025\\/04\\/21\\/student-choose-img-1.jpg\",\"image_2\":\"2025\\/04\\/21\\/student-choose-img-2.jpg\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"student_choose\"},{\"background_image\":\"2025\\/04\\/21\\/event-bg.jpg\",\"section_title\":\"Our Upcoming Events\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"event_limit\":\"4\",\"order_by\":\"start_date\",\"order\":\"ASC\",\"date_filter\":\"all\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"events_list_home\"},{\"show_section_title\":\"1\",\"section_title\":\"What Our Student Saying\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/21\\/testimonial-bg.jpg\",\"testimonials\":[{\"name\":\"Leslie Alexander\",\"designation\":\"Developer\",\"image\":\"2025\\/04\\/21\\/testimonial-img-1.jpg\",\"rating\":\"5\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Orabelle\",\"designation\":\"Math Teacher\",\"image\":\"2025\\/04\\/21\\/testimonial-img-2.jpg\",\"rating\":\"4\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Alejandro\",\"designation\":\"Founder & CEO\",\"image\":\"2025\\/04\\/21\\/testimonial-img-3.jpg\",\"rating\":\"5\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"}],\"enable_slider\":\"1\",\"slides_to_show\":\"2\",\"enable_autoplay\":\"0\",\"autoplay_speed\":null,\"block\":\"testimonial_area\"},{\"background_image\":\"2025\\/04\\/21\\/certificate-bg.jpg\",\"enable_overlay\":\"1\",\"certificates\":[{\"title\":\"Online Certification\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-1.png\"},{\"title\":\"Top Instructors\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-2.png\"},{\"title\":\"Unlimited Access\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-3.png\"},{\"title\":\"Experienced Members\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-4.png\"}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"certificate_area\"},{\"style\":\"style1\",\"show_section_title\":\"1\",\"section_title\":\"Our Expert Instructor\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/21\\/instructor-bg.jpg\",\"instructors\":[{\"name\":\"Johnna Smith\",\"designation\":\"Web Developer\",\"image\":\"2025\\/04\\/21\\/instructor-img-1.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Alice Johnson\",\"designation\":\"Graphic Designer\",\"image\":\"2025\\/04\\/21\\/instructor-img-2.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Maya Lee\",\"designation\":\"UX\\/UI Designer\",\"image\":\"2025\\/04\\/21\\/instructor-img-3.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Sarah Brown\",\"designation\":\"Software Engineer\",\"image\":\"2025\\/04\\/21\\/instructor-img-4.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Emily Clark\",\"designation\":\"Full Stack Developer\",\"image\":\"2025\\/04\\/21\\/instructor-img-5.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Emma Davis\",\"designation\":\"Frontend Developer\",\"image\":\"2025\\/04\\/21\\/instructor-img-6.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"}],\"enable_slider\":\"1\",\"block\":\"instructor_list\"},{\"background_image\":\"2025\\/04\\/21\\/blog-bg.jpg\",\"section_title\":\"Latest News Feed\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"blog_limit\":\"6\",\"order_by\":\"created_at\",\"order\":\"DESC\",\"enable_slider\":\"1\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"blogs_list_home\"}]}}', '[]', 0.00, 0, 0, '78b4cf21-0b53-498e-a812-0b87267308c5', 'vi'),
(13, 'Events', NULL, 'events', '', NULL, 'publish', 32, '2025-02-09 09:33:09', '2025-02-09 09:33:09', 1, 1, 'pages', '{\"template\": \"event\"}', '[]', 0.00, 0, 0, 'd88261bf-3ece-4338-afff-ae2462537fe7', 'vi'),
(14, 'Products', NULL, 'products', '', NULL, 'publish', 28, '2025-02-13 23:27:20', '2025-02-13 23:27:20', 1, 1, 'pages', '{\"template\": \"products\"}', '[]', 0.00, 0, 0, 'bcf463ec-e0c0-48aa-8dc7-9cd2a490ac47', 'vi'),
(17, 'Checkout', NULL, 'checkout', '', NULL, 'publish', 101, '2025-02-14 04:41:49', '2025-02-14 04:41:50', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, 'b551bb7a-2db0-4586-b05f-6640cfa93aa1', 'vi'),
(18, 'Thank You', NULL, 'thank-you', '', NULL, 'publish', 53, '2025-02-23 20:16:52', '2025-02-23 20:16:53', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, '1abe8021-b6ad-4008-b95c-a8d5218f52b9', 'vi'),
(22, 'Contact', NULL, 'contact', '', NULL, 'publish', 9, '2025-03-05 01:18:38', '2025-04-08 18:00:06', 1, 1, 'pages', '{\"template\":\"home\",\"block_content\":{\"content\":[{\"show_title\":\"1\",\"title\":\"Get In Touch With Us\",\"show_info_boxes\":\"1\",\"info_boxes\":[{\"icon\":\"fas fa-envelope\",\"title\":\"Email\",\"subtitle\":\"Our friendly team is here to help.\",\"content\":\"example@gmail.com\"},{\"icon\":\"fas fa-map-marker-alt\",\"title\":\"Office\",\"subtitle\":\"Come say hello at our office.\",\"content\":\"8502 Preston Rd. Maine 98380, USA\"},{\"icon\":\"fas fa-phone-alt\",\"title\":\"Phone\",\"subtitle\":\"Mon-Fri from 8am to 5pm.\",\"content\":\"+088 (246) 642-27\"},{\"icon\":\"fas fa-clock\",\"title\":\"Working Hours\",\"subtitle\":\"Satday to Friday:\",\"content\":\"09:00am - 10:00pm\"}],\"name_label\":null,\"name_placeholder\":\"Name\",\"email_label\":null,\"email_placeholder\":\"example@gmail.com\",\"subject_label\":null,\"subject_placeholder\":\"Phone\",\"message_label\":null,\"message_placeholder\":\"Type here..\",\"submit_text\":\"Send message\",\"show_map\":\"1\",\"map_url\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d58404.90712306111!2d90.33188860263257!3d23.807690708042205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1685520321950!5m2!1sen!2sbd\",\"block\":\"contact_form\"}]}}', '[]', 0.00, 0, 0, 'b4e3c4af-e1d9-4a5a-bf38-375f02cba23d', 'vi'),
(23, 'Faq', NULL, 'faq', '', NULL, 'publish', 8, '2025-03-05 02:24:24', '2025-03-18 07:36:46', 1, 1, 'pages', '{\"template\": \"about\", \"block_content\": {\"content\": [{\"block\": \"about_video\", \"play_icon\": null, \"video_url\": null, \"margin_top\": null, \"video_type\": \"video\", \"enable_overlay\": \"0\", \"enable_autoplay\": \"0\", \"background_image\": null, \"enable_animation\": \"0\", \"mobile_margin_top\": null}, {\"block\": \"student_choose\", \"image_1\": null, \"image_2\": null, \"button_url\": null, \"button_text\": null, \"description\": null, \"padding_top\": null, \"section_title\": null, \"padding_bottom\": null, \"background_image\": null, \"enable_animation\": \"0\", \"mobile_padding_top\": null, \"mobile_padding_bottom\": null}, {\"block\": \"about_area\", \"title\": \"About Section title\", \"image_1\": \"2025/03/06/home-shop-thumb06.png\", \"image_2\": null, \"description\": \"About Section desc\", \"background_image\": \"2025/03/07/paypal.png\"}]}}', '[]', 0.00, 0, 0, 'e743e505-1998-4ea3-9133-3b962918d2e2', 'vi'),
(24, 'Privacy policy', NULL, 'privacy-policy', '\r Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit ation ullamco laboris...', '<div class=\"tf__trems_condition_text\">\r\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit ation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt atem quia voluptas sit aspernatur aut odit aut fugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n<p>Adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea in commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proidentktl sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium totamrem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt</p>\r\n<h3>The Type of Personal Information We Collect</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<h3>How We Use Cookies?</h3>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<h3>The Collection, Process, And Use Of Personal Data</h3>\r\n<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>\r\n<h3>Accounts, Passwords And Security</h3>\r\n<p>In certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>\r\n</div>', 'publish', 6, '2025-03-05 03:29:45', '2025-03-05 03:29:45', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, 'e20af4ec-4c2a-4fe1-ae1f-a8b0d180f250', 'vi'),
(25, 'Accusantium quod atq', NULL, 'accusantium-quod-atq', '', NULL, 'publish', 0, '2025-03-08 05:43:17', '2025-03-08 05:43:17', 1, 1, 'theme', '{\"theme_name\": \"Sandra Nolan\", \"theme_author\": \"Distinctio Sint qua\", \"theme_version\": \"Adipisci consectetur\"}', '[]', 0.00, 0, 0, 'b4ad5fc0-a3dc-4d9f-8b8c-a235670fe319', 'vi'),
(26, 'Recusandae Ex tempo', '2025/03/06/features-product-shape01.png', 'recusandae-ex-tempo', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that does not yet have content', '<p>Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that does not yet have content</p>', 'publish', 2, '2025-03-08 05:53:48', '2025-03-08 07:14:45', 1, 1, 'dev_tool_plugin', '{\"plugin_name\": \"Silas Butler\", \"plugin_author\": \"Eiusmod autem quo te\", \"plugin_version\": \"Culpa officia non al\"}', '[]', 0.00, 0, 0, 'e9a5dfd8-4c9c-4c47-a138-1c7f2d9ea0d5', 'vi'),
(122, 'Courses', NULL, 'courses', '', NULL, 'publish', 39, '2025-03-21 00:11:06', '2025-03-21 00:11:06', 1, 1, 'pages', '{\"template\": \"courses\"}', '[]', 0.00, 0, 0, '61167aaa-9b06-47e3-8541-73fbf3b1be1f', 'vi'),
(133, 'Blogs', NULL, 'blogs', '', NULL, 'publish', 6, '2025-04-08 11:44:34', '2025-04-08 11:44:34', 1, 1, 'pages', '{\"template\":null}', '[]', 0.00, 0, 0, 'fe5b153c-9e1a-4caa-b6d3-9e29fe7b7728', 'vi'),
(134, 'How do I Sell Affiliate Products to My Customers', '2025/04/08/blog-img-1.jpg', 'how-do-i-sell-affiliate-products-to-my-customers', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 3, '2025-04-08 13:14:51', '2025-04-09 19:20:10', 1, 1, 'posts', NULL, '[{\"id\":7,\"name\":\"Education\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"education\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/education\"},{\"id\":8,\"name\":\"Learning\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"learning\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/learning\"},{\"id\":9,\"name\":\"College\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"college\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/college\"},{\"id\":10,\"name\":\"Education\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"education-1\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/education-1\"}]', 0.00, 0, 1, 'ca23eee0-1c7a-4a11-afcc-7431453d9714', 'vi'),
(135, 'Group Of Students Sharing Their Ideas', '2025/04/08/blog-img-2.jpg', 'group-of-students-sharing-their-ideas', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 4, '2025-04-08 13:23:45', '2025-04-08 13:23:45', 1, 1, 'posts', NULL, '[{\"id\":7,\"name\":\"Education\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"education\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/education\"},{\"id\":8,\"name\":\"Learning\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"learning\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/learning\"},{\"id\":9,\"name\":\"College\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"college\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/college\"},{\"id\":10,\"name\":\"Education\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"education-1\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/education-1\"}]', 0.00, 0, 0, '2eb65995-2b60-42a9-9d06-89c01c4314b9', 'vi'),
(136, 'Creative Class Library For Students', '2025/04/08/blog-img-3.jpg', 'creative-class-library-for-students', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 3, '2025-04-08 13:26:05', '2025-04-09 19:20:22', 1, 1, 'posts', NULL, '[{\"id\":7,\"name\":\"Education\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"education\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/education\"},{\"id\":9,\"name\":\"College\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"college\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/college\"},{\"id\":11,\"name\":\"Lms\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"lms\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/lms\"},{\"id\":12,\"name\":\"College\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"college-1\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/college-1\"}]', 0.00, 0, 1, '76d31bc7-784e-46ca-a63d-bb513546f6d5', 'vi'),
(137, '12th Batch Student’s Convocational Day', '2025/04/08/blog-img-4.jpg', '12th-batch-students-convocational-day', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 3, '2025-04-08 13:27:39', '2025-04-09 19:20:10', 1, 1, 'posts', NULL, '[{\"id\":9,\"name\":\"College\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"college\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/college\"},{\"id\":10,\"name\":\"Education\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"education-1\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/education-1\"},{\"id\":11,\"name\":\"Lms\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"lms\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/lms\"}]', 0.00, 0, 1, '42484013-ede3-49fb-96e1-63b7225b9d38', 'vi'),
(138, 'The Complete Digital Marketing Learning Path', '2025/04/08/blog-img-5.jpg', 'the-complete-digital-marketing-learning-path', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 0, '2025-04-08 13:28:38', '2025-04-08 13:28:38', 1, 1, 'posts', NULL, '[{\"id\":7,\"name\":\"Education\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"education\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/education\"},{\"id\":9,\"name\":\"College\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"college\",\"level\":0,\"total_post\":5,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/college\"},{\"id\":10,\"name\":\"Education\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"education-1\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/education-1\"},{\"id\":11,\"name\":\"Lms\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"lms\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/lms\"}]', 0.00, 0, 0, '47d450bb-5ed6-4535-af54-07620615f1d4', 'vi'),
(139, 'How to Make Your UX Design Portfolio Stand Out', '2025/04/08/blog-img-6.jpg', 'how-to-make-your-ux-design-portfolio-stand-out', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 1, '2025-04-08 13:29:50', '2025-04-08 13:29:50', 1, 1, 'posts', NULL, '[{\"id\":9,\"name\":\"College\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"college\",\"level\":0,\"total_post\":6,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/college\"},{\"id\":12,\"name\":\"College\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"college-1\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/college-1\"}]', 0.00, 0, 0, 'cea3cc68-5398-4d04-9546-a5f23cfbc507', 'vi');
INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(140, 'How To Start Learn Online Study From Your Home', '2025/04/08/blog-img-7.jpg', 'how-to-start-learn-online-study-from-your-home', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 2, '2025-04-08 13:30:39', '2025-04-09 19:19:12', 1, 1, 'posts', NULL, '[{\"id\":7,\"name\":\"Education\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"education\",\"level\":0,\"total_post\":5,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/education\"},{\"id\":9,\"name\":\"College\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"college\",\"level\":0,\"total_post\":7,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/college\"},{\"id\":12,\"name\":\"College\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"college-1\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/college-1\"}]', 0.00, 0, 1, '24acc493-d453-4146-8e6f-753168c69b60', 'vi'),
(141, 'How To Start Learn Online Study From Your Home', '2025/04/08/blog-img-8.jpg', 'how-to-start-learn-online-study-from-your-home-1', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 1, '2025-04-08 13:31:36', '2025-04-08 13:31:36', 1, 1, 'posts', NULL, '[{\"id\":8,\"name\":\"Learning\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"learning\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/learning\"},{\"id\":11,\"name\":\"Lms\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"lms\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/lms\"},{\"id\":12,\"name\":\"College\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"college-1\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/college-1\"}]', 0.00, 0, 0, 'd7f336b1-64bb-417b-b289-c00166119d9f', 'vi'),
(142, 'The Complete Digital Marketing Learning Path', '2025/04/08/blog-img-9.jpg', 'the-complete-digital-marketing-learning-path-1', 'Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum...', '<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<div class=\"tf__quote\">\r\n<p>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus.</p>\r\n<h5>Jerome Bell</h5>\r\n</div>\r\n<h3>Know More About Preschool</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<div class=\"tf__community_img\"><img class=\"img-fluid w-100\" src=\"2025/04/08/blog-details-video-img.jpg\" alt=\"community\" />\r\n<div class=\"tf__community_img_overlay\"><a class=\"venobox tf__play_btn\" href=\"https://youtu.be/CZkux700lqU\" data-autoplay=\"true\" data-vbtype=\"video\"> </a></div>\r\n</div>\r\n<h3>What&rsquo;s New Here</h3>\r\n<p>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean. Netus sed amet tortor viverra sit orci vitae. Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl. Lacus mi lorem sodales proin faucibus. Tempor dui in faucibus sed nunc maecenas nullam ut. Pharetra et ullamcorper in lacus amet posuere consequat vulputate. Erat vitae iaculis malesuada pharetra vestibulum aliquam elit ipsum cursus. Sed dictum dui venenatis.</p>\r\n<ul>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n<li>Nunc est purus nunc eleifend. Habitasse netus sollicitudin pharetra nisl.</li>\r\n<li>Pharetra et ullamcorper in lacus amet posuere consequat vulputate Erat vitae iaculis malesuada.</li>\r\n<li>Aliquet lectus nisi pharetra neque faucibus dapibus semper turpis. Dolor integer mauris eu praesent aenean.</li>\r\n</ul>', 'publish', 2, '2025-04-08 13:32:35', '2025-04-09 19:18:54', 1, 1, 'posts', NULL, '[{\"id\":7,\"name\":\"Education\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"education\",\"level\":0,\"total_post\":6,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/education\"},{\"id\":10,\"name\":\"Education\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"education-1\",\"level\":0,\"total_post\":5,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/education-1\"},{\"id\":11,\"name\":\"Lms\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"lms\",\"level\":0,\"total_post\":5,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/lms\"},{\"id\":12,\"name\":\"College\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"college-1\",\"level\":0,\"total_post\":5,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/college-1\"}]', 0.00, 0, 2, 'd9dafe98-209c-446a-9e9e-1cb3f34125a1', 'vi'),
(143, 'A Better Alternative To Grading Student Writing', '2025/04/08/courses-img-1.jpg', 'a-better-alternative-to-grading-student-writing', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 2, '2025-04-08 13:47:18', '2025-04-08 13:48:22', 1, 1, 'events', '{\"start_date\":\"2025-04-08T19:46\",\"end_date\":\"2025-07-24T19:46\",\"venue\":\"Greenwood Arena\",\"venue_address\":\"45 Sports Blvd, Greenfield, DEF 56789\",\"latitude\":\"34.052235\",\"longitude\":\"118.243683\",\"map_url\":null,\"map_embed_code\":\"<iframe src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3329.134746087092!2d-118.243683!3d34.052235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzQwMDAxJzI2LjgiTiA3Ni1mIzg0OTE!5e0!3m2!1sen!2sus!4v1674571812048\\\" width=\\\"600\\\" height=\\\"450\\\" frameborder=\\\"0\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" aria-hidden=\\\"false\\\" tabindex=\\\"0\\\"><\\/iframe>\",\"event_logo\":null,\"event_banner\":null,\"name\":\"Greenwood Arena\",\"description\":\"Description\\r\\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...\",\"price\":180,\"capacity\":300,\"min_ticket_number\":1,\"max_ticket_number\":30,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"},{\"icon\":\"fab fa-twitter\",\"url\":\"#\"}]}', '[{\"id\":13,\"name\":\"Music\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"music\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/music\"},{\"id\":14,\"name\":\"Concerts\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"concerts\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/concerts\"},{\"id\":15,\"name\":\"Festivals\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"festivals\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/festivals\"},{\"id\":16,\"name\":\"Live Bands\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"live-bands\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/live-bands\"}]', 0.00, 0, 0, 'bec556fc-dd2e-4c15-a34b-91cce4928974', 'vi'),
(144, '12 Things Successful Mompreneurs', '2025/04/08/courses-img-2.jpg', '12-things-successful-mompreneurs', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 1, '2025-04-08 15:11:23', '2025-04-08 15:11:23', 1, 1, 'events', '{\"start_date\":\"2025-04-08T21:11\",\"end_date\":\"2025-10-30T21:11\",\"venue\":\"Sunset Beach Resort\",\"venue_address\":\"789 Beachside Lane, Sunview Island, GHI 11223\",\"latitude\":\"36.778259\",\"longitude\":\"-119.417931\",\"map_url\":null,\"map_embed_code\":null,\"event_logo\":null,\"event_banner\":null,\"name\":\"Greenwood Arena\",\"description\":\"Description\\r\\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...\",\"price\":220,\"capacity\":30,\"min_ticket_number\":1,\"max_ticket_number\":2,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]}', '[{\"id\":13,\"name\":\"Music\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"music\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/music\"},{\"id\":14,\"name\":\"Concerts\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"concerts\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/concerts\"},{\"id\":15,\"name\":\"Festivals\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"festivals\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/festivals\"},{\"id\":16,\"name\":\"Live Bands\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"live-bands\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/live-bands\"}]', 0.00, 0, 0, '3ddc2a58-07c4-4feb-8b0b-e7b7c404c36f', 'vi'),
(145, 'Ethics in Al Live Event Machines Judging.', '2025/04/08/courses-img-3.jpg', 'ethics-in-al-live-event-machines-judging', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 0, '2025-04-08 15:19:18', '2025-04-08 15:19:18', 1, 1, 'events', '{\"start_date\":\"2025-06-19T21:16\",\"end_date\":\"2025-11-21T21:16\",\"venue\":\"Greenwood Arena\",\"venue_address\":\"101 Art St, Downtown City, JKL 24680\",\"latitude\":null,\"longitude\":null,\"map_url\":null,\"map_embed_code\":null,\"event_logo\":null,\"event_banner\":null,\"name\":\"Ticket 1\",\"description\":\"Description\\r\\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...\",\"price\":140,\"capacity\":40,\"min_ticket_number\":1,\"max_ticket_number\":2,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"},{\"icon\":\"fab fa-twitter\",\"url\":\"#\"}]}', '[{\"id\":17,\"name\":\"Conferences\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"conferences\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/conferences\"},{\"id\":18,\"name\":\"Technology Conferences\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"technology-conferences\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/technology-conferences\"},{\"id\":19,\"name\":\"Business Seminars\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"business-seminars\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/business-seminars\"}]', 0.00, 0, 0, '4858bfb2-d42f-4288-8b6a-d77bc9972ec4', 'vi'),
(146, 'The Importance Of Intrinsic Motivation.', '2025/04/08/courses-img-2.jpg', 'the-importance-of-intrinsic-motivation', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 0, '2025-04-08 16:43:33', '2025-04-09 19:22:47', 1, 1, 'events', '{\"start_date\":null,\"end_date\":null,\"venue\":\"Hilltop Conference\",\"venue_address\":\"250 Summit Ave, Hillview, MNO 33445\",\"latitude\":\"39.739236\",\"longitude\":null,\"map_url\":null,\"map_embed_code\":null,\"event_logo\":null,\"event_banner\":null,\"name\":\"Ticket\",\"description\":\"Description\\r\\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...\",\"price\":310,\"capacity\":30,\"min_ticket_number\":1,\"max_ticket_number\":2,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]}', '[{\"id\":14,\"name\":\"Concerts\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"concerts\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/concerts\"},{\"id\":17,\"name\":\"Conferences\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"conferences\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/conferences\"},{\"id\":18,\"name\":\"Technology Conferences\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"technology-conferences\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/technology-conferences\"}]', 0.00, 0, 0, 'd552a82d-812b-4a6f-894a-102b6c18b44b', 'vi'),
(147, 'A Better Alternative To Grading Student Writing', '2025/04/08/courses-img-1.jpg', 'a-better-alternative-to-grading-student-writing-1', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 1, '2025-04-08 16:47:07', '2025-04-08 16:47:07', 1, 1, 'events', '{\"start_date\":\"2025-04-17T22:46\",\"end_date\":\"2025-08-15T22:46\",\"venue\":\"The Downtown Gallery\",\"venue_address\":\"101 Art St, Downtown City, JKL 24680\",\"latitude\":null,\"longitude\":null,\"map_url\":null,\"map_embed_code\":null,\"event_logo\":null,\"event_banner\":null,\"name\":\"ticket\",\"description\":null,\"price\":380,\"capacity\":200,\"min_ticket_number\":1,\"max_ticket_number\":2,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]}', '[{\"id\":20,\"name\":\"Seasonal Themes\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"seasonal-themes\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/seasonal-themes\"},{\"id\":21,\"name\":\"Summer Vibes\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"summer-vibes\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/summer-vibes\"},{\"id\":22,\"name\":\"Holiday Cheer\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"holiday-cheer\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/holiday-cheer\"}]', 0.00, 0, 0, '4e76ec78-a6f1-4e04-8453-360974e5d61c', 'vi'),
(148, '12 Things Successful Mompreneurs', '2025/04/08/courses-img-4.jpg', '12-things-successful-mompreneurs-1', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 0, '2025-04-08 16:49:27', '2025-04-08 16:49:27', 1, 1, 'events', '{\"start_date\":\"2025-04-09T22:49\",\"end_date\":\"2025-09-18T22:49\",\"venue\":\"Greenwood Arena\",\"venue_address\":\"45 Sports Blvd, Greenfield, DEF 56789\",\"latitude\":null,\"longitude\":null,\"map_url\":null,\"map_embed_code\":null,\"event_logo\":null,\"event_banner\":null,\"name\":\"ticket\",\"description\":null,\"price\":170,\"capacity\":30,\"min_ticket_number\":1,\"max_ticket_number\":2,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]}', '[{\"id\":13,\"name\":\"Music\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"music\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/music\"},{\"id\":16,\"name\":\"Live Bands\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"live-bands\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/live-bands\"},{\"id\":22,\"name\":\"Holiday Cheer\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"holiday-cheer\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/holiday-cheer\"}]', 0.00, 0, 0, '83d58628-be44-4b9c-8b63-fc6326791a36', 'vi'),
(149, 'Ethics in Al Live Event Machines Judging.', '2025/04/08/courses-img-5.jpg', 'ethics-in-al-live-event-machines-judging-1', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 0, '2025-04-08 16:51:26', '2025-04-09 19:22:19', 1, 1, 'events', '{\"start_date\":\"2025-04-09T22:51\",\"end_date\":\"2025-09-25T22:51\",\"venue\":\"Hilltop Conference\",\"venue_address\":\"250 Summit Ave, Hillview, MNO 33445\",\"latitude\":null,\"longitude\":null,\"map_url\":null,\"map_embed_code\":null,\"event_logo\":null,\"event_banner\":null,\"name\":\"ticket\",\"description\":\"Description\\r\\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...\",\"price\":230,\"capacity\":90,\"min_ticket_number\":1,\"max_ticket_number\":2,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]}', '[{\"id\":15,\"name\":\"Festivals\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"festivals\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/festivals\"},{\"id\":17,\"name\":\"Conferences\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"conferences\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/conferences\"},{\"id\":21,\"name\":\"Summer Vibes\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"summer-vibes\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/summer-vibes\"}]', 0.00, 0, 0, 'f5dad7b9-6e1e-482e-8f1c-d7213daf30ec', 'vi'),
(150, 'The Importance Of Intrinsic Motivation.', '2025/04/08/courses-img-6.jpg', 'the-importance-of-intrinsic-motivation-1', '\r Description\r Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at...', '<div class=\"tf__event_details_text\">\r\n<h3>Description</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus libero non senectus est. Eu vulputate enim diam nunc et suscipit nunc. Blandit aliquet aliquam congue enim. Suspendisse risus id viverra scelerisque sagittis at.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n<h3>Event content</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<p>Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius. Sed vulputate fames.</p>\r\n</div>', 'publish', 5, '2025-04-08 16:53:08', '2025-04-09 19:21:51', 1, 1, 'events', '{\"start_date\":\"2025-04-10T22:52\",\"end_date\":\"2025-08-21T22:52\",\"venue\":\"The Grand\",\"venue_address\":\"Downtown City\",\"latitude\":null,\"longitude\":null,\"map_url\":null,\"map_embed_code\":null,\"event_logo\":null,\"event_banner\":null,\"name\":\"ticket\",\"description\":\"Description\\r\\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...\",\"price\":220,\"capacity\":433,\"min_ticket_number\":1,\"max_ticket_number\":2,\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]}', '[{\"id\":5,\"name\":\"Mango\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"mango\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/mango\"},{\"id\":14,\"name\":\"Concerts\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"concerts\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/concerts\"},{\"id\":16,\"name\":\"Live Bands\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"live-bands\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/live-bands\"}]', 0.00, 0, 0, '849d13c5-a911-4d6c-b7cc-d387702b5729', 'vi');
INSERT INTO `app_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(151, 'About Us', NULL, 'about-us', '', NULL, 'publish', 6, '2025-04-08 17:02:49', '2025-04-21 11:40:26', 1, 1, 'pages', '{\"template\":\"about\",\"block_content\":{\"content\":[{\"title\":\"We do great things together\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius.\",\"background_image\":\"2025\\/04\\/08\\/about-section-bg.jpg\",\"image_1\":\"2025\\/04\\/08\\/about-img-1.jpg\",\"image_2\":\"2025\\/04\\/08\\/about-img-2.jpg\",\"features\":[{\"icon\":\"fas fa-star\",\"title\":\"Build your career\",\"description\":\"Online course quickly from anywhere.\"},{\"icon\":\"fas fa-pencil-ruler\",\"title\":\"Grow your skill\",\"description\":\"Online course quickly from anywhere.\"}],\"block\":\"about_area\"},{\"background_image\":\"2025\\/04\\/08\\/about-video-img.jpg\",\"video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU\",\"enable_autoplay\":\"1\",\"video_type\":\"video\",\"margin_top\":null,\"mobile_margin_top\":null,\"enable_animation\":\"1\",\"play_icon\":\"fas fa-play\",\"enable_overlay\":\"1\",\"block\":\"about_video\"},{\"style\":\"style1\",\"show_section_title\":\"1\",\"section_title\":\"Our Expert Instructor\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/08\\/instructor-bg.jpg\",\"instructors\":[{\"name\":\"Floyd Miles\",\"designation\":\"Graphic Designer\",\"image\":\"2025\\/04\\/08\\/instructor-img-1.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Sales & Marketing\",\"image\":\"2025\\/04\\/08\\/instructor-img-2.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Sales & Marketing\",\"image\":\"2025\\/04\\/08\\/instructor-img-3.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Sales & Marketing\",\"image\":\"2025\\/04\\/08\\/instructor-img-4.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Web Development\",\"image\":\"2025\\/04\\/08\\/instructor-img-5.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Devon Lane\",\"designation\":\"Web Designer\",\"image\":\"2025\\/04\\/08\\/instructor-img-6.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"}],\"enable_slider\":\"1\",\"block\":\"instructor_list\"},{\"background_image\":\"2025\\/04\\/08\\/certificate-bg.jpg\",\"enable_overlay\":\"0\",\"certificates\":[{\"title\":\"Online Certification\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-1.png\"},{\"title\":\"Top Instructors\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-2.png\"},{\"title\":\"Unlimited Access\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-3.png\"},{\"title\":\"Experienced Members\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-4.png\"}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"0\",\"block\":\"certificate_area\"},{\"show_section_title\":\"1\",\"section_title\":\"What Our Student Saying\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/08\\/testimonial-bg.jpg\",\"testimonials\":[{\"name\":\"Leslie Alexander\",\"designation\":\"Dog Trainer\",\"image\":\"2025\\/04\\/08\\/testimonial-img-1.jpg\",\"rating\":\"4\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con veliteget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Leslie Alexander\",\"designation\":\"Dog Trainer\",\"image\":\"2025\\/04\\/08\\/testimonial-img-2.jpg\",\"rating\":\"5\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con veliteget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Leslie Alexander\",\"designation\":\"Dog Trainer\",\"image\":\"2025\\/04\\/08\\/testimonial-img-3.jpg\",\"rating\":\"3\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con veliteget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"}],\"enable_slider\":\"1\",\"slides_to_show\":\"2\",\"enable_autoplay\":\"1\",\"autoplay_speed\":null,\"block\":\"testimonial_area\"},{\"background_image\":\"2025\\/04\\/21\\/blog-bg.jpg\",\"section_title\":\"Latest News Feed\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"blog_limit\":\"6\",\"order_by\":\"created_at\",\"order\":\"DESC\",\"enable_slider\":\"1\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"blogs_list_home\"}]}}', '[]', 0.00, 0, 0, 'ebe58c32-8a11-449e-9d0a-99bdfbe3911e', 'vi'),
(152, 'Terms And Condition', NULL, 'terms-and-condition', '\r Legal Disclaimer\r Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit...', '<div class=\"tf__trems_condition_text\">\r\n<h3>Legal Disclaimer</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit ation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt atem quia voluptas sit aspernatur aut odit aut fugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n<p>Adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea in commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proidentktl sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium totamrem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt</p>\r\n<h3>Credit Reporting Terms Of Service</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<h3>Ownership Of Site Agreement To Terms Of Use</h3>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>\r\n<h3>Provision Of Services</h3>\r\n<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>\r\n<h3>Accounts, Passwords And Security</h3>\r\n<p>In certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>\r\n</div>', 'publish', 1, '2025-04-08 17:20:07', '2025-04-08 17:20:07', 1, 1, 'pages', '{\"template\":null}', '[]', 0.00, 0, 0, '9816fa33-e8c0-46af-b5c3-ed2ce56815fa', 'vi'),
(153, 'Programming for all (Started With Python)', '2025/04/08/courses-img-1.jpg', 'programming-for-all-started-with-python', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 2, '2025-04-09 15:34:16', '2025-04-09 16:56:32', 1, 1, 'courses', '{\"max_students\":\"90\",\"language\":\"en\",\"difficulty_level\":\"beginner\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU?si=o3BzouuR9aTyviUr\",\"duration\":\"300\",\"certificate\":\"1\",\"price\":300,\"compare_price\":300}', '[{\"id\":23,\"name\":\"Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"design\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/design\"},{\"id\":24,\"name\":\"Web Design\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"web-design\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/web-design\"}]', 0.00, 0, 0, 'a4793904-3e78-43df-9a43-0cedb9062222', 'vi'),
(155, 'Dave conservatoire is the Entirely free online', '2025/04/08/courses-img-2.jpg', 'dave-conservatoire-is-the-entirely-free-online', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 2, '2025-04-09 15:34:16', '2025-04-09 18:16:27', 1, 1, 'courses', '{\"max_students\":\"90\",\"language\":\"en\",\"difficulty_level\":\"beginner\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU?si=o3BzouuR9aTyviUr\",\"duration\":\"300\",\"certificate\":\"1\",\"price\":200,\"compare_price\":400}', '[{\"id\":24,\"name\":\"Web Design\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"web-design\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/web-design\"},{\"id\":26,\"name\":\"Business\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"business\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/business\"},{\"id\":27,\"name\":\"Buisness Web\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"buisness-web\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/buisness-web\"}]', 0.00, 0, 0, 'a4793904-3e78-43df-9a43-0cedb9062223', 'vi'),
(156, 'Project Management Principles & Practices', '2025/04/08/courses-img-3.jpg', 'project-management-principles-practices', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 1, '2025-04-09 18:13:57', '2025-04-09 18:17:33', 1, 1, 'courses', '{\"price\":300,\"compare_price\":400,\"max_students\":\"190\",\"language\":\"vi\",\"difficulty_level\":\"intermediate\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU?si=o3BzouuR9aTyviUr\",\"duration\":\"300\",\"certificate\":\"1\"}', '[{\"id\":25,\"name\":\"Web Developed\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"web-developed\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/web-developed\"},{\"id\":28,\"name\":\"Finance\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"finance\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/finance\"},{\"id\":29,\"name\":\"Finance\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"finance-1\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/finance-1\"}]', 0.00, 0, 0, 'b978b59a-7a70-4dc5-8cfd-984c5b557969', 'vi'),
(157, 'Project Management Principles & Practices', '2025/04/08/courses-img-4.jpg', 'project-management-principles-practices-1', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 1, '2025-04-09 18:23:07', '2025-04-09 18:24:55', 1, 1, 'courses', '{\"price\":140,\"compare_price\":220,\"max_students\":\"70\",\"language\":\"vi\",\"difficulty_level\":\"intermediate\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU?si=o3BzouuR9aTyviUr\",\"duration\":\"800\",\"certificate\":\"1\"}', '[{\"id\":25,\"name\":\"Web Developed\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"web-developed\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/web-developed\"},{\"id\":30,\"name\":\"Marketing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"marketing\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/marketing\"},{\"id\":31,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/marketing-1\"}]', 0.00, 0, 0, '44a26eed-e8cd-4368-96a0-9de8a94efb8a', 'vi'),
(158, 'Programming for all (Started With Python)', '2025/04/08/courses-img-2.jpg', 'programming-for-all-started-with-python-1', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 2, '2025-04-09 18:34:02', '2025-04-09 19:17:02', 1, 1, 'courses', '{\"price\":340,\"compare_price\":599,\"max_students\":\"99\",\"language\":\"en\",\"difficulty_level\":\"advanced\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU?si=o3BzouuR9aTyviUr\",\"duration\":\"80\",\"certificate\":\"1\"}', '[{\"id\":26,\"name\":\"Business\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"business\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/business\"},{\"id\":27,\"name\":\"Buisness Web\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"buisness-web\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/buisness-web\"},{\"id\":29,\"name\":\"Finance\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"finance-1\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/finance-1\"}]', 0.00, 0, 0, '6b91a27b-bcc7-46ea-ae99-91c8ba9a1b20', 'vi'),
(159, 'Dave conservatoire is the Entirely free online', '2025/04/08/courses-img-6.jpg', 'dave-conservatoire-is-the-entirely-free-online-1', 'Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>', 'publish', 1, '2025-04-09 18:46:55', '2025-04-09 18:48:40', 1, 1, 'courses', '{\"price\":90,\"compare_price\":130,\"max_students\":\"100\",\"language\":\"en\",\"difficulty_level\":\"intermediate\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU?si=o3BzouuR9aTyviUr\",\"duration\":\"800\",\"certificate\":\"1\"}', '[{\"id\":32,\"name\":\"UI\\/UX\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"uiux\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/uiux\"},{\"id\":33,\"name\":\"UI\\/UX\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"uiux-1\",\"level\":0,\"total_post\":1,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/uiux-1\"}]', 0.00, 0, 0, '5db55ab6-e599-410f-b6d6-bba0c5efe7e9', 'vi'),
(160, 'Programming for all (Started With Python)', '2025/04/08/courses-img-1.jpg', 'programming-for-all-started-with-python-2', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 2, '2025-04-09 18:50:52', '2025-04-09 19:16:47', 1, 1, 'courses', '{\"price\":310,\"compare_price\":440,\"max_students\":\"90\",\"language\":\"en\",\"difficulty_level\":\"intermediate\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/www.w3schools.com\\/html\\/mov_bbb.mp4\",\"duration\":\"400\",\"certificate\":\"1\"}', '[{\"id\":23,\"name\":\"Design\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"design\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/design\"},{\"id\":24,\"name\":\"Web Design\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"web-design\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/web-design\"},{\"id\":33,\"name\":\"UI\\/UX\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"uiux-1\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/uiux-1\"}]', 0.00, 0, 1, '88b98b4c-a6f5-4c44-a0d7-9b471e7c62d1', 'vi'),
(161, 'Project Management Principles & Practices', '2025/04/08/courses-img-1.jpg', 'project-management-principles-practices-3', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 3, '2025-04-09 18:53:52', '2025-04-09 19:01:33', 1, 1, 'courses', '{\"max_students\":0,\"language\":\"en\",\"difficulty_level\":\"beginner\",\"preview_video_thumbnail\":\"\",\"preview_video_url\":\"\",\"duration\":\"\",\"certificate\":\"0\",\"price\":0,\"compare_price\":0}', '[{\"id\":28,\"name\":\"Finance\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"finance\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/finance\"},{\"id\":29,\"name\":\"Finance\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"finance-1\",\"level\":0,\"total_post\":4,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/finance-1\"}]', 0.00, 0, 0, '3a9aa167-1f03-49b3-893c-c7cf888dce9a', 'vi'),
(162, 'Project Management Principles & Practices', '2025/04/08/courses-img-6.jpg', 'project-management-principles-practices-2', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 8, '2025-04-09 18:56:26', '2025-04-09 19:16:18', 1, 1, 'courses', '{\"price\":120,\"compare_price\":230,\"max_students\":\"220\",\"language\":\"en\",\"difficulty_level\":\"intermediate\",\"preview_video_thumbnail\":\"2025\\/04\\/09\\/sidebar-video-img.jpg\",\"preview_video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU?si=o3BzouuR9aTyviUr\",\"duration\":\"90\",\"certificate\":\"1\"}', '[{\"id\":29,\"name\":\"Finance\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"finance-1\",\"level\":0,\"total_post\":3,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/finance-1\"},{\"id\":30,\"name\":\"Marketing\",\"taxonomy\":\"categories\",\"singular\":\"category\",\"slug\":\"marketing\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/category\\/marketing\"},{\"id\":31,\"name\":\"Marketing\",\"taxonomy\":\"tags\",\"singular\":\"tag\",\"slug\":\"marketing-1\",\"level\":0,\"total_post\":2,\"thumbnail\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/jw-styles\\/mojar\\/images\\/thumb-default.png\",\"url\":\"https:\\/\\/laravel-edufax.mojarsoft.com\\/tag\\/marketing-1\"}]', 0.00, 0, 2, '6464abef-ca26-4f27-a7f8-27265cfd3683', 'vi');

-- --------------------------------------------------------

--
-- Table structure for table `app_post_likes`
--

CREATE TABLE `app_post_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_post_metas`
--

CREATE TABLE `app_post_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_post_metas`
--

INSERT INTO `app_post_metas` (`id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 4, 'example', 'jkhj'),
(2, 4, 'select', '1'),
(15, 11, 'template', 'home'),
(16, 11, 'block_content', '{\"content\":[{\"background_image\":\"2025\\/04\\/20\\/banner-bg.jpg\",\"subtitle\":\"Discover your journey\",\"title\":\"The Best Free Online Courses of All Time\",\"highlight_text\":\"Courses\",\"description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people.\",\"button_text\":\"Courses\",\"button_url\":\"\\/courses\",\"show_arrow_icon\":\"1\",\"banner_image\":\"2025\\/04\\/20\\/banner-img.png\",\"enable_animation\":\"1\",\"block\":\"hero_section_home\"},{\"background_image\":\"2025\\/04\\/20\\/category-bg.jpg\",\"section_title\":\"Explore Our Categories\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"section_url\":null,\"categories\":[{\"category\":\"26\",\"icon\":\"2025\\/04\\/20\\/category-icon-1.png\",\"color_scheme\":\"category_1\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"23\",\"icon\":\"2025\\/04\\/21\\/category-icon-2.png\",\"color_scheme\":\"category_2\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"28\",\"icon\":\"2025\\/04\\/21\\/category-icon-3.png\",\"color_scheme\":\"category_3\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"32\",\"icon\":\"2025\\/04\\/21\\/category-icon-4.png\",\"color_scheme\":\"category_4\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"34\",\"icon\":\"2025\\/04\\/21\\/category-icon-5.png\",\"color_scheme\":\"category_4\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"35\",\"icon\":\"2025\\/04\\/21\\/category-icon-6.png\",\"color_scheme\":\"category_3\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"36\",\"icon\":\"2025\\/04\\/21\\/category-icon-7.png\",\"color_scheme\":\"category_2\",\"custom_title\":null,\"custom_url\":null},{\"category\":\"37\",\"icon\":\"2025\\/04\\/21\\/category-icon-8.png\",\"color_scheme\":\"category_1\",\"custom_title\":null,\"custom_url\":null}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"course_category_home\"},{\"background_image\":\"2025\\/04\\/21\\/about-section-bg.jpg\",\"image_1\":\"2025\\/04\\/21\\/about-img-1.jpg\",\"image_2\":\"2025\\/04\\/21\\/about-img-2.jpg\",\"title\":\"We do great things together\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius.\",\"features\":[{\"icon\":\"fas fa-star\",\"title\":\"Build your career\",\"description\":\"Online course quickly from anywhere.\"},{\"icon\":\"fas fa-pencil-ruler\",\"title\":\"Grow your skill\",\"description\":\"Online course quickly from anywhere.\"}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"about_us_home\"},{\"background_image\":\"2025\\/04\\/21\\/courses-bg.jpg\",\"section_title\":\"Our Popular Courses\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"course_limit\":\"6\",\"order_by\":\"created_at\",\"order\":\"DESC\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"course_list_home\"},{\"background_image\":\"2025\\/04\\/21\\/student-choose-bg.jpg\",\"section_title\":\"Why Students Choose Us for Gain Their Knowledge\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Posuere vulputate at tortor aenean tortor tincidunt dui consequat enim. Vel iaculis euismod et scelerisque condimentum nulla cras. Praesent diam orci id et eu nulla id. Auctor fermentum.\",\"features\":[{\"text\":\"Free for physically handcraft.\"},{\"text\":\"Easy to enroll courses\"},{\"text\":\"Course certificate for particular course\"}],\"button_text\":\"More About Us\",\"button_url\":\"#\",\"image_1\":\"2025\\/04\\/21\\/student-choose-img-1.jpg\",\"image_2\":\"2025\\/04\\/21\\/student-choose-img-2.jpg\",\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"student_choose\"},{\"background_image\":\"2025\\/04\\/21\\/event-bg.jpg\",\"section_title\":\"Our Upcoming Events\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"event_limit\":\"4\",\"order_by\":\"start_date\",\"order\":\"ASC\",\"date_filter\":\"all\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"events_list_home\"},{\"show_section_title\":\"1\",\"section_title\":\"What Our Student Saying\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/21\\/testimonial-bg.jpg\",\"testimonials\":[{\"name\":\"Leslie Alexander\",\"designation\":\"Developer\",\"image\":\"2025\\/04\\/21\\/testimonial-img-1.jpg\",\"rating\":\"5\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Orabelle\",\"designation\":\"Math Teacher\",\"image\":\"2025\\/04\\/21\\/testimonial-img-2.jpg\",\"rating\":\"4\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Alejandro\",\"designation\":\"Founder & CEO\",\"image\":\"2025\\/04\\/21\\/testimonial-img-3.jpg\",\"rating\":\"5\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"}],\"enable_slider\":\"1\",\"slides_to_show\":\"2\",\"enable_autoplay\":\"0\",\"autoplay_speed\":null,\"block\":\"testimonial_area\"},{\"background_image\":\"2025\\/04\\/21\\/certificate-bg.jpg\",\"enable_overlay\":\"1\",\"certificates\":[{\"title\":\"Online Certification\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-1.png\"},{\"title\":\"Top Instructors\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-2.png\"},{\"title\":\"Unlimited Access\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-3.png\"},{\"title\":\"Experienced Members\",\"icon\":\"2025\\/04\\/21\\/certificate-icon-4.png\"}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"1\",\"block\":\"certificate_area\"},{\"style\":\"style1\",\"show_section_title\":\"1\",\"section_title\":\"Our Expert Instructor\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/21\\/instructor-bg.jpg\",\"instructors\":[{\"name\":\"Johnna Smith\",\"designation\":\"Web Developer\",\"image\":\"2025\\/04\\/21\\/instructor-img-1.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Alice Johnson\",\"designation\":\"Graphic Designer\",\"image\":\"2025\\/04\\/21\\/instructor-img-2.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Maya Lee\",\"designation\":\"UX\\/UI Designer\",\"image\":\"2025\\/04\\/21\\/instructor-img-3.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Sarah Brown\",\"designation\":\"Software Engineer\",\"image\":\"2025\\/04\\/21\\/instructor-img-4.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Emily Clark\",\"designation\":\"Full Stack Developer\",\"image\":\"2025\\/04\\/21\\/instructor-img-5.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Emma Davis\",\"designation\":\"Frontend Developer\",\"image\":\"2025\\/04\\/21\\/instructor-img-6.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"}],\"enable_slider\":\"1\",\"block\":\"instructor_list\"},{\"background_image\":\"2025\\/04\\/21\\/blog-bg.jpg\",\"section_title\":\"Latest News Feed\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"blog_limit\":\"6\",\"order_by\":\"created_at\",\"order\":\"DESC\",\"enable_slider\":\"1\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"blogs_list_home\"}]}'),
(19, 13, 'template', 'event'),
(20, 14, 'template', 'products'),
(38, 17, 'template', NULL),
(39, 18, 'template', NULL),
(91, 22, 'template', 'home'),
(92, 22, 'block_content', '{\"content\":[{\"show_title\":\"1\",\"title\":\"Get In Touch With Us\",\"show_info_boxes\":\"1\",\"info_boxes\":[{\"icon\":\"fas fa-envelope\",\"title\":\"Email\",\"subtitle\":\"Our friendly team is here to help.\",\"content\":\"example@gmail.com\"},{\"icon\":\"fas fa-map-marker-alt\",\"title\":\"Office\",\"subtitle\":\"Come say hello at our office.\",\"content\":\"8502 Preston Rd. Maine 98380, USA\"},{\"icon\":\"fas fa-phone-alt\",\"title\":\"Phone\",\"subtitle\":\"Mon-Fri from 8am to 5pm.\",\"content\":\"+088 (246) 642-27\"},{\"icon\":\"fas fa-clock\",\"title\":\"Working Hours\",\"subtitle\":\"Satday to Friday:\",\"content\":\"09:00am - 10:00pm\"}],\"name_label\":null,\"name_placeholder\":\"Name\",\"email_label\":null,\"email_placeholder\":\"example@gmail.com\",\"subject_label\":null,\"subject_placeholder\":\"Phone\",\"message_label\":null,\"message_placeholder\":\"Type here..\",\"submit_text\":\"Send message\",\"show_map\":\"1\",\"map_url\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d58404.90712306111!2d90.33188860263257!3d23.807690708042205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1685520321950!5m2!1sen!2sbd\",\"block\":\"contact_form\"}]}'),
(93, 23, 'template', 'about'),
(94, 23, 'block_content', '{\"content\":[{\"background_image\":null,\"video_url\":null,\"enable_autoplay\":\"0\",\"video_type\":\"video\",\"margin_top\":null,\"mobile_margin_top\":null,\"enable_animation\":\"0\",\"play_icon\":null,\"enable_overlay\":\"0\",\"block\":\"about_video\"},{\"background_image\":null,\"section_title\":null,\"description\":null,\"button_text\":null,\"button_url\":null,\"image_1\":null,\"image_2\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"0\",\"block\":\"student_choose\"},{\"title\":\"About Section title\",\"description\":\"About Section desc\",\"background_image\":\"2025\\/03\\/07\\/paypal.png\",\"image_1\":\"2025\\/03\\/06\\/home-shop-thumb06.png\",\"image_2\":null,\"block\":\"about_area\"}]}'),
(95, 24, 'template', NULL),
(96, 25, 'theme_name', 'Sandra Nolan'),
(97, 25, 'theme_version', 'Adipisci consectetur'),
(98, 25, 'theme_author', 'Distinctio Sint qua'),
(99, 26, 'plugin_name', 'Silas Butler'),
(100, 26, 'plugin_version', 'Culpa officia non al'),
(101, 26, 'plugin_author', 'Eiusmod autem quo te'),
(207, 122, 'template', 'courses'),
(294, 133, 'template', NULL),
(295, 143, 'start_date', '2025-04-08T19:46'),
(296, 143, 'end_date', '2025-07-24T19:46'),
(297, 143, 'venue', 'Greenwood Arena'),
(298, 143, 'venue_address', '45 Sports Blvd, Greenfield, DEF 56789'),
(299, 143, 'latitude', '34.052235'),
(300, 143, 'longitude', '118.243683'),
(301, 143, 'map_url', NULL),
(302, 143, 'map_embed_code', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.134746087092!2d-118.243683!3d34.052235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzQwMDAxJzI2LjgiTiA3Ni1mIzg0OTE!5e0!3m2!1sen!2sus!4v1674571812048\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(303, 143, 'event_logo', NULL),
(304, 143, 'event_banner', NULL),
(305, 143, 'name', 'Greenwood Arena'),
(306, 143, 'description', 'Description\r\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...'),
(307, 143, 'price', '180'),
(308, 143, 'capacity', '300'),
(309, 143, 'min_ticket_number', '1'),
(310, 143, 'max_ticket_number', '30'),
(311, 143, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"},{\"icon\":\"fab fa-twitter\",\"url\":\"#\"}]'),
(312, 144, 'start_date', '2025-04-08T21:11'),
(313, 144, 'end_date', '2025-10-30T21:11'),
(314, 144, 'venue', 'Sunset Beach Resort'),
(315, 144, 'venue_address', '789 Beachside Lane, Sunview Island, GHI 11223'),
(316, 144, 'latitude', '36.778259'),
(317, 144, 'longitude', '-119.417931'),
(318, 144, 'map_url', NULL),
(319, 144, 'map_embed_code', NULL),
(320, 144, 'event_logo', NULL),
(321, 144, 'event_banner', NULL),
(322, 144, 'name', 'Greenwood Arena'),
(323, 144, 'description', 'Description\r\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...'),
(324, 144, 'price', '220'),
(325, 144, 'capacity', '30'),
(326, 144, 'min_ticket_number', '1'),
(327, 144, 'max_ticket_number', '2'),
(328, 144, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(329, 145, 'start_date', '2025-06-19T21:16'),
(330, 145, 'end_date', '2025-11-21T21:16'),
(331, 145, 'venue', 'Greenwood Arena'),
(332, 145, 'venue_address', '101 Art St, Downtown City, JKL 24680'),
(333, 145, 'latitude', NULL),
(334, 145, 'longitude', NULL),
(335, 145, 'map_url', NULL),
(336, 145, 'map_embed_code', NULL),
(337, 145, 'event_logo', NULL),
(338, 145, 'event_banner', NULL),
(339, 145, 'name', 'Ticket 1'),
(340, 145, 'description', 'Description\r\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...'),
(341, 145, 'price', '140'),
(342, 145, 'capacity', '40'),
(343, 145, 'min_ticket_number', '1'),
(344, 145, 'max_ticket_number', '2'),
(345, 145, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"},{\"icon\":\"fab fa-twitter\",\"url\":\"#\"}]'),
(346, 146, 'start_date', NULL),
(347, 146, 'end_date', NULL),
(348, 146, 'venue', 'Hilltop Conference'),
(349, 146, 'venue_address', '250 Summit Ave, Hillview, MNO 33445'),
(350, 146, 'latitude', '39.739236'),
(351, 146, 'longitude', NULL),
(352, 146, 'map_url', NULL),
(353, 146, 'map_embed_code', NULL),
(354, 146, 'event_logo', NULL),
(355, 146, 'event_banner', NULL),
(356, 146, 'name', 'Ticket'),
(357, 146, 'description', 'Description\r\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...'),
(358, 146, 'price', '310'),
(359, 146, 'capacity', '30'),
(360, 146, 'min_ticket_number', '1'),
(361, 146, 'max_ticket_number', '2'),
(362, 146, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(363, 147, 'start_date', '2025-04-17T22:46'),
(364, 147, 'end_date', '2025-08-15T22:46'),
(365, 147, 'venue', 'The Downtown Gallery'),
(366, 147, 'venue_address', '101 Art St, Downtown City, JKL 24680'),
(367, 147, 'latitude', NULL),
(368, 147, 'longitude', NULL),
(369, 147, 'map_url', NULL),
(370, 147, 'map_embed_code', NULL),
(371, 147, 'event_logo', NULL),
(372, 147, 'event_banner', NULL),
(373, 147, 'name', 'ticket'),
(374, 147, 'description', NULL),
(375, 147, 'price', '380'),
(376, 147, 'capacity', '200'),
(377, 147, 'min_ticket_number', '1'),
(378, 147, 'max_ticket_number', '2'),
(379, 147, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(380, 148, 'start_date', '2025-04-09T22:49'),
(381, 148, 'end_date', '2025-09-18T22:49'),
(382, 148, 'venue', 'Greenwood Arena'),
(383, 148, 'venue_address', '45 Sports Blvd, Greenfield, DEF 56789'),
(384, 148, 'latitude', NULL),
(385, 148, 'longitude', NULL),
(386, 148, 'map_url', NULL),
(387, 148, 'map_embed_code', NULL),
(388, 148, 'event_logo', NULL),
(389, 148, 'event_banner', NULL),
(390, 148, 'name', 'ticket'),
(391, 148, 'description', NULL),
(392, 148, 'price', '170'),
(393, 148, 'capacity', '30'),
(394, 148, 'min_ticket_number', '1'),
(395, 148, 'max_ticket_number', '2'),
(396, 148, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(397, 149, 'start_date', '2025-04-09T22:51'),
(398, 149, 'end_date', '2025-09-25T22:51'),
(399, 149, 'venue', 'Hilltop Conference'),
(400, 149, 'venue_address', '250 Summit Ave, Hillview, MNO 33445'),
(401, 149, 'latitude', NULL),
(402, 149, 'longitude', NULL),
(403, 149, 'map_url', NULL),
(404, 149, 'map_embed_code', NULL),
(405, 149, 'event_logo', NULL),
(406, 149, 'event_banner', NULL),
(407, 149, 'name', 'ticket'),
(408, 149, 'description', 'Description\r\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...'),
(409, 149, 'price', '230'),
(410, 149, 'capacity', '90'),
(411, 149, 'min_ticket_number', '1'),
(412, 149, 'max_ticket_number', '2'),
(413, 149, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(414, 150, 'start_date', '2025-04-10T22:52'),
(415, 150, 'end_date', '2025-08-21T22:52'),
(416, 150, 'venue', 'The Grand'),
(417, 150, 'venue_address', 'Downtown City'),
(418, 150, 'latitude', NULL),
(419, 150, 'longitude', NULL),
(420, 150, 'map_url', NULL),
(421, 150, 'map_embed_code', NULL),
(422, 150, 'event_logo', NULL),
(423, 150, 'event_banner', NULL),
(424, 150, 'name', 'ticket'),
(425, 150, 'description', 'Description\r\n Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit malesuada faucibus...'),
(426, 150, 'price', '220'),
(427, 150, 'capacity', '433'),
(428, 150, 'min_ticket_number', '1'),
(429, 150, 'max_ticket_number', '2'),
(430, 150, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(431, 151, 'template', 'about'),
(432, 151, 'block_content', '{\"content\":[{\"title\":\"We do great things together\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius.\",\"background_image\":\"2025\\/04\\/08\\/about-section-bg.jpg\",\"image_1\":\"2025\\/04\\/08\\/about-img-1.jpg\",\"image_2\":\"2025\\/04\\/08\\/about-img-2.jpg\",\"features\":[{\"icon\":\"fas fa-star\",\"title\":\"Build your career\",\"description\":\"Online course quickly from anywhere.\"},{\"icon\":\"fas fa-pencil-ruler\",\"title\":\"Grow your skill\",\"description\":\"Online course quickly from anywhere.\"}],\"block\":\"about_area\"},{\"background_image\":\"2025\\/04\\/08\\/about-video-img.jpg\",\"video_url\":\"https:\\/\\/youtu.be\\/CZkux700lqU\",\"enable_autoplay\":\"1\",\"video_type\":\"video\",\"margin_top\":null,\"mobile_margin_top\":null,\"enable_animation\":\"1\",\"play_icon\":\"fas fa-play\",\"enable_overlay\":\"1\",\"block\":\"about_video\"},{\"style\":\"style1\",\"show_section_title\":\"1\",\"section_title\":\"Our Expert Instructor\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/08\\/instructor-bg.jpg\",\"instructors\":[{\"name\":\"Floyd Miles\",\"designation\":\"Graphic Designer\",\"image\":\"2025\\/04\\/08\\/instructor-img-1.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Sales & Marketing\",\"image\":\"2025\\/04\\/08\\/instructor-img-2.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Sales & Marketing\",\"image\":\"2025\\/04\\/08\\/instructor-img-3.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Sales & Marketing\",\"image\":\"2025\\/04\\/08\\/instructor-img-4.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Darrell Steward\",\"designation\":\"Web Development\",\"image\":\"2025\\/04\\/08\\/instructor-img-5.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"},{\"name\":\"Devon Lane\",\"designation\":\"Web Designer\",\"image\":\"2025\\/04\\/08\\/instructor-img-6.png\",\"detail_url\":\"#\",\"facebook_url\":\"#\",\"linkedin_url\":\"#\",\"twitter_url\":\"#\"}],\"enable_slider\":\"1\",\"block\":\"instructor_list\"},{\"background_image\":\"2025\\/04\\/08\\/certificate-bg.jpg\",\"enable_overlay\":\"0\",\"certificates\":[{\"title\":\"Online Certification\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-1.png\"},{\"title\":\"Top Instructors\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-2.png\"},{\"title\":\"Unlimited Access\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-3.png\"},{\"title\":\"Experienced Members\",\"icon\":\"2025\\/04\\/08\\/certificate-icon-4.png\"}],\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"0\",\"block\":\"certificate_area\"},{\"show_section_title\":\"1\",\"section_title\":\"What Our Student Saying\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"background_image\":\"2025\\/04\\/08\\/testimonial-bg.jpg\",\"testimonials\":[{\"name\":\"Leslie Alexander\",\"designation\":\"Dog Trainer\",\"image\":\"2025\\/04\\/08\\/testimonial-img-1.jpg\",\"rating\":\"4\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con veliteget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Leslie Alexander\",\"designation\":\"Dog Trainer\",\"image\":\"2025\\/04\\/08\\/testimonial-img-2.jpg\",\"rating\":\"5\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con veliteget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"},{\"name\":\"Leslie Alexander\",\"designation\":\"Dog Trainer\",\"image\":\"2025\\/04\\/08\\/testimonial-img-3.jpg\",\"rating\":\"3\",\"description\":\"Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con veliteget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.\"}],\"enable_slider\":\"1\",\"slides_to_show\":\"2\",\"enable_autoplay\":\"1\",\"autoplay_speed\":null,\"block\":\"testimonial_area\"},{\"background_image\":\"2025\\/04\\/21\\/blog-bg.jpg\",\"section_title\":\"Latest News Feed\",\"section_description\":\"Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.\",\"blog_limit\":\"6\",\"order_by\":\"created_at\",\"order\":\"DESC\",\"enable_slider\":\"1\",\"show_all_button\":\"0\",\"view_all_text\":null,\"view_all_url\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"block\":\"blogs_list_home\"}]}'),
(433, 152, 'template', NULL),
(434, 153, 'max_students', '90'),
(435, 153, 'language', 'en'),
(436, 153, 'difficulty_level', 'beginner'),
(437, 153, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(438, 153, 'preview_video_url', 'https://youtu.be/CZkux700lqU?si=o3BzouuR9aTyviUr'),
(439, 153, 'duration', '300'),
(440, 153, 'certificate', '1'),
(441, 153, 'price', '300'),
(442, 153, 'compare_price', '300'),
(443, 155, 'price', '200'),
(444, 155, 'compare_price', '400'),
(445, 155, 'max_students', '90'),
(446, 155, 'language', 'en'),
(447, 155, 'difficulty_level', 'beginner'),
(448, 155, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(449, 155, 'preview_video_url', 'https://youtu.be/CZkux700lqU?si=o3BzouuR9aTyviUr'),
(450, 155, 'duration', '300'),
(451, 155, 'certificate', '1'),
(452, 156, 'price', '300'),
(453, 156, 'compare_price', '400'),
(454, 156, 'max_students', '190'),
(455, 156, 'language', 'vi'),
(456, 156, 'difficulty_level', 'intermediate'),
(457, 156, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(458, 156, 'preview_video_url', 'https://youtu.be/CZkux700lqU?si=o3BzouuR9aTyviUr'),
(459, 156, 'duration', '300'),
(460, 156, 'certificate', '1'),
(461, 157, 'price', '140'),
(462, 157, 'compare_price', '220'),
(463, 157, 'max_students', '70'),
(464, 157, 'language', 'vi'),
(465, 157, 'difficulty_level', 'intermediate'),
(466, 157, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(467, 157, 'preview_video_url', 'https://youtu.be/CZkux700lqU?si=o3BzouuR9aTyviUr'),
(468, 157, 'duration', '800'),
(469, 157, 'certificate', '1'),
(470, 158, 'price', '340'),
(471, 158, 'compare_price', '599'),
(472, 158, 'max_students', '99'),
(473, 158, 'language', 'en'),
(474, 158, 'difficulty_level', 'advanced'),
(475, 158, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(476, 158, 'preview_video_url', 'https://youtu.be/CZkux700lqU?si=o3BzouuR9aTyviUr'),
(477, 158, 'duration', '80'),
(478, 158, 'certificate', '1'),
(479, 159, 'price', '90'),
(480, 159, 'compare_price', '130'),
(481, 159, 'max_students', '100'),
(482, 159, 'language', 'en'),
(483, 159, 'difficulty_level', 'intermediate'),
(484, 159, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(485, 159, 'preview_video_url', 'https://youtu.be/CZkux700lqU?si=o3BzouuR9aTyviUr'),
(486, 159, 'duration', '800'),
(487, 159, 'certificate', '1'),
(488, 160, 'price', '310'),
(489, 160, 'compare_price', '440'),
(490, 160, 'max_students', '90'),
(491, 160, 'language', 'en'),
(492, 160, 'difficulty_level', 'intermediate'),
(493, 160, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(494, 160, 'preview_video_url', 'https://www.w3schools.com/html/mov_bbb.mp4'),
(495, 160, 'duration', '400'),
(496, 160, 'certificate', '1'),
(497, 162, 'price', '120'),
(498, 162, 'compare_price', '230'),
(499, 162, 'max_students', '220'),
(500, 162, 'language', 'en'),
(501, 162, 'difficulty_level', 'intermediate'),
(502, 162, 'preview_video_thumbnail', '2025/04/09/sidebar-video-img.jpg'),
(503, 162, 'preview_video_url', 'https://youtu.be/CZkux700lqU?si=o3BzouuR9aTyviUr'),
(504, 162, 'duration', '90'),
(505, 162, 'certificate', '1'),
(506, 161, 'max_students', '0'),
(507, 161, 'language', 'en'),
(508, 161, 'difficulty_level', 'beginner'),
(509, 161, 'preview_video_thumbnail', ''),
(510, 161, 'preview_video_url', ''),
(511, 161, 'duration', ''),
(512, 161, 'certificate', '0'),
(513, 161, 'price', '0'),
(514, 161, 'compare_price', '0');

-- --------------------------------------------------------

--
-- Table structure for table `app_post_ratings`
--

CREATE TABLE `app_post_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `star` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_post_views`
--

CREATE TABLE `app_post_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_post_views`
--

INSERT INTO `app_post_views` (`id`, `post_id`, `views`, `day`) VALUES
(7, 11, 1, '2025-01-30'),
(11, 13, 3, '2025-02-09'),
(12, 13, 1, '2025-02-09'),
(13, 14, 3, '2025-02-14'),
(14, 17, 2, '2025-02-14'),
(15, 17, 3, '2025-02-15'),
(16, 14, 1, '2025-02-15'),
(17, 14, 1, '2025-02-16'),
(18, 17, 1, '2025-02-16'),
(20, 14, 1, '2025-02-19'),
(21, 17, 1, '2025-02-19'),
(22, 17, 34, '2025-02-21'),
(23, 14, 2, '2025-02-21'),
(24, 17, 2, '2025-02-22'),
(25, 14, 1, '2025-02-22'),
(26, 17, 4, '2025-02-23'),
(27, 14, 4, '2025-02-23'),
(28, 14, 3, '2025-02-24'),
(29, 17, 6, '2025-02-24'),
(30, 18, 1, '2025-02-24'),
(31, 13, 1, '2025-02-24'),
(33, 17, 3, '2025-02-27'),
(35, 13, 2, '2025-02-27'),
(36, 18, 1, '2025-02-27'),
(38, 14, 1, '2025-02-27'),
(39, 17, 1, '2025-02-28'),
(40, 18, 1, '2025-02-28'),
(41, 13, 1, '2025-02-28'),
(43, 13, 3, '2025-03-01'),
(45, 14, 2, '2025-03-01'),
(46, 17, 4, '2025-03-01'),
(47, 18, 2, '2025-03-01'),
(49, 13, 4, '2025-03-02'),
(51, 17, 2, '2025-03-02'),
(60, 18, 1, '2025-03-02'),
(61, 17, 5, '2025-03-03'),
(62, 17, 1, '2025-03-03'),
(64, 13, 3, '2025-03-03'),
(65, 18, 8, '2025-03-03'),
(67, 17, 8, '2025-03-04'),
(68, 13, 2, '2025-03-04'),
(70, 18, 12, '2025-03-04'),
(72, 14, 2, '2025-03-04'),
(73, 17, 1, '2025-03-05'),
(74, 22, 2, '2025-03-05'),
(75, 23, 2, '2025-03-05'),
(76, 24, 2, '2025-03-05'),
(77, 13, 1, '2025-03-05'),
(80, 17, 2, '2025-03-06'),
(81, 17, 6, '2025-03-07'),
(82, 13, 2, '2025-03-07'),
(84, 14, 3, '2025-03-07'),
(86, 18, 20, '2025-03-07'),
(88, 17, 1, '2025-03-08'),
(89, 14, 1, '2025-03-08'),
(90, 18, 1, '2025-03-08'),
(92, 26, 2, '2025-03-08'),
(93, 13, 1, '2025-03-08'),
(96, 17, 2, '2025-03-09'),
(97, 23, 4, '2025-03-18'),
(98, 24, 1, '2025-03-18'),
(99, 17, 1, '2025-03-19'),
(100, 14, 1, '2025-03-21'),
(101, 122, 3, '2025-03-21'),
(105, 17, 4, '2025-03-21'),
(106, 18, 3, '2025-03-21'),
(107, 122, 6, '2025-03-22'),
(109, 13, 1, '2025-03-22'),
(110, 14, 1, '2025-03-22'),
(111, 122, 1, '2025-03-23'),
(112, 122, 2, '2025-03-24'),
(115, 14, 1, '2025-03-29'),
(116, 22, 1, '2025-04-02'),
(117, 122, 1, '2025-04-02'),
(119, 17, 1, '2025-04-02'),
(120, 18, 1, '2025-04-02'),
(121, 17, 2, '2025-04-03'),
(122, 122, 1, '2025-04-03'),
(123, 122, 1, '2025-04-04'),
(124, 11, 1, '2025-04-08'),
(128, 122, 1, '2025-04-08'),
(129, 133, 1, '2025-04-08'),
(130, 134, 1, '2025-04-08'),
(131, 135, 1, '2025-04-08'),
(132, 140, 1, '2025-04-08'),
(133, 143, 1, '2025-04-08'),
(134, 13, 1, '2025-04-08'),
(135, 144, 1, '2025-04-08'),
(136, 22, 1, '2025-04-08'),
(137, 151, 1, '2025-04-08'),
(138, 24, 1, '2025-04-08'),
(139, 23, 2, '2025-04-08'),
(140, 17, 1, '2025-04-08'),
(141, 13, 2, '2025-04-09'),
(142, 122, 1, '2025-04-09'),
(143, 153, 1, '2025-04-09'),
(144, 150, 1, '2025-04-09'),
(145, 141, 1, '2025-04-09'),
(146, 161, 1, '2025-04-09'),
(147, 151, 1, '2025-04-09'),
(148, 139, 1, '2025-04-09'),
(149, 162, 1, '2025-04-09'),
(150, 160, 1, '2025-04-09'),
(151, 158, 1, '2025-04-09'),
(152, 133, 1, '2025-04-09'),
(153, 142, 1, '2025-04-09'),
(154, 140, 1, '2025-04-09'),
(155, 137, 1, '2025-04-09'),
(156, 134, 1, '2025-04-09'),
(157, 136, 1, '2025-04-09'),
(158, 17, 1, '2025-04-09'),
(159, 18, 1, '2025-04-09'),
(160, 151, 1, '2025-04-11'),
(161, 122, 3, '2025-04-11'),
(162, 133, 1, '2025-04-11'),
(163, 162, 2, '2025-04-11'),
(164, 17, 1, '2025-04-11'),
(165, 18, 1, '2025-04-11'),
(166, 22, 1, '2025-04-11'),
(167, 150, 1, '2025-04-11'),
(168, 13, 1, '2025-04-11'),
(169, 137, 2, '2025-04-12'),
(170, 152, 1, '2025-04-12'),
(171, 150, 2, '2025-04-12'),
(172, 136, 1, '2025-04-12'),
(173, 133, 1, '2025-04-12'),
(174, 22, 1, '2025-04-12'),
(175, 133, 1, '2025-04-13'),
(176, 22, 1, '2025-04-13'),
(177, 136, 1, '2025-04-13'),
(178, 135, 1, '2025-04-17'),
(179, 153, 1, '2025-04-17'),
(180, 11, 2, '2025-04-17'),
(181, 17, 1, '2025-04-17'),
(182, 122, 13, '2025-04-17'),
(183, 133, 1, '2025-04-17'),
(184, 151, 1, '2025-04-17'),
(185, 22, 1, '2025-04-17'),
(186, 13, 2, '2025-04-17'),
(187, 162, 4, '2025-04-17'),
(188, 161, 2, '2025-04-17'),
(189, 143, 1, '2025-04-17'),
(190, 157, 1, '2025-04-17'),
(191, 158, 1, '2025-04-17'),
(192, 160, 1, '2025-04-17'),
(193, 159, 1, '2025-04-17'),
(194, 147, 1, '2025-04-18'),
(195, 155, 1, '2025-04-18'),
(196, 156, 1, '2025-04-18'),
(197, 122, 1, '2025-04-18'),
(198, 122, 1, '2025-04-18'),
(199, 151, 1, '2025-04-19'),
(200, 11, 4, '2025-04-20'),
(201, 24, 1, '2025-04-20'),
(202, 122, 1, '2025-04-20'),
(203, 11, 3, '2025-04-21'),
(204, 151, 1, '2025-04-21'),
(205, 122, 1, '2025-04-21'),
(206, 13, 1, '2025-04-21'),
(207, 22, 1, '2025-04-21'),
(208, 162, 1, '2025-04-21'),
(209, 134, 1, '2025-04-21'),
(210, 150, 1, '2025-04-21'),
(211, 142, 1, '2025-04-21'),
(212, 24, 1, '2025-04-21'),
(213, 135, 1, '2025-04-21'),
(214, 11, 7, '2025-04-22'),
(215, 122, 2, '2025-04-22'),
(216, 135, 1, '2025-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `app_product_variants`
--

CREATE TABLE `app_product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku_code` varchar(100) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `thumbnail` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `names` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`names`)),
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `price` decimal(15,2) DEFAULT NULL,
  `compare_price` decimal(15,2) DEFAULT NULL,
  `type` varchar(150) NOT NULL DEFAULT 'default',
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_product_variants_attribute_values`
--

CREATE TABLE `app_product_variants_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_resources`
--

CREATE TABLE `app_resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`)),
  `status` varchar(50) NOT NULL DEFAULT 'publish',
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `slug` varchar(150) DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_resources`
--

INSERT INTO `app_resources` (`id`, `name`, `type`, `thumbnail`, `description`, `json_metas`, `status`, `post_id`, `parent_id`, `created_at`, `updated_at`, `display_order`, `slug`, `uuid`) VALUES
(1, 'name', 'contact-forms', NULL, NULL, NULL, 'publish', NULL, NULL, '2025-03-05 00:46:42', '2025-03-05 00:46:42', 1, 'name', 'bf93479b-78db-442b-9629-4093d546e441');

-- --------------------------------------------------------

--
-- Table structure for table `app_resource_metas`
--

CREATE TABLE `app_resource_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resource_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_roles`
--

CREATE TABLE `app_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `guard_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_roles`
--

INSERT INTO `app_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'customer', 'web', '2025-02-22 08:00:37', '2025-02-22 08:00:37', 'Ecommerce customer role'),
(2, 'shop_manager', 'web', '2025-02-22 08:00:38', '2025-02-22 08:00:38', 'Can manage products and orders'),
(3, 'New Role', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_role_has_permissions`
--

CREATE TABLE `app_role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_role_has_permissions`
--

INSERT INTO `app_role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `app_search`
--

CREATE TABLE `app_search` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(190) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `keyword` varchar(190) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `post_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_seo_metas`
--

CREATE TABLE `app_seo_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `object_type` varchar(10) NOT NULL,
  `object_id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_description` varchar(320) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_seo_metas`
--

INSERT INTO `app_seo_metas` (`id`, `object_type`, `object_id`, `meta_title`, `meta_description`) VALUES
(1, 'posts', 12, 'sdsad', NULL),
(2, 'posts', 148, '12 Things Successful Mompreneurs', 'Description Lorem ipsum dolor sit amet consectetur. Sed quis mauris dictumst adipiscing. A feugiat pellentesque mi diam ullamcorper condimentum risus quam aliquet. Sem urna cursus at cursus vestibulum vel varius tellus nunc. Nunc ipsum ac non cras parturient tristique adipiscing tortor. Sit...');

-- --------------------------------------------------------

--
-- Table structure for table `app_shipping_address`
--

CREATE TABLE `app_shipping_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `province` varchar(150) DEFAULT NULL,
  `country_code` varchar(15) DEFAULT NULL,
  `address_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_shipping_methods`
--

CREATE TABLE `app_shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) NOT NULL,
  `country_code` varchar(5) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `shop_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_single_taxonomies`
--

CREATE TABLE `app_single_taxonomies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `post_type` varchar(50) NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy` varchar(50) NOT NULL,
  `total_post` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_single_taxonomy_metas`
--

CREATE TABLE `app_single_taxonomy_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_social_tokens`
--

CREATE TABLE `app_social_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `social_provider` varchar(10) NOT NULL,
  `social_id` varchar(100) NOT NULL,
  `social_token` varchar(500) NOT NULL,
  `social_refresh_token` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_table_groups`
--

CREATE TABLE `app_table_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table` varchar(50) NOT NULL,
  `total_rows` bigint(20) NOT NULL DEFAULT 0,
  `migrations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`migrations`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_table_group_datas`
--

CREATE TABLE `app_table_group_datas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_group_id` bigint(20) UNSIGNED NOT NULL,
  `table_group_table_id` bigint(20) UNSIGNED NOT NULL,
  `table` varchar(50) NOT NULL,
  `real_table` varchar(50) NOT NULL,
  `table_key` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_table_group_tables`
--

CREATE TABLE `app_table_group_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table` varchar(50) NOT NULL,
  `real_table` varchar(50) NOT NULL,
  `table_group_id` bigint(20) UNSIGNED NOT NULL,
  `total_rows` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_taxonomies`
--

CREATE TABLE `app_taxonomies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `post_type` varchar(50) NOT NULL,
  `taxonomy` varchar(50) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `total_post` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `uuid` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_taxonomies`
--

INSERT INTO `app_taxonomies` (`id`, `name`, `thumbnail`, `description`, `slug`, `post_type`, `taxonomy`, `parent_id`, `total_post`, `created_at`, `updated_at`, `level`, `uuid`) VALUES
(2, 'new cat', NULL, NULL, 'new-cat', 'posts', 'categories', NULL, 0, '2025-01-17 04:24:19', '2025-04-08 12:59:00', 0, 'fe958ba3-b0ea-4a29-add3-643125aeb23e'),
(5, 'Mango', NULL, NULL, 'mango', 'events', 'categories', NULL, 1, '2025-03-05 10:03:08', '2025-04-08 16:53:08', 0, '562fdb4e-85f8-48fa-853c-8d8498b5322f'),
(7, 'Education', NULL, NULL, 'education', 'posts', 'tags', NULL, 6, '2025-04-08 13:08:32', '2025-04-08 13:32:35', 0, 'db3a65ba-5331-4079-84ed-2328a37d9aa9'),
(8, 'Learning', NULL, NULL, 'learning', 'posts', 'tags', NULL, 3, '2025-04-08 13:08:39', '2025-04-08 13:31:36', 0, '1ed4195f-addb-4c37-bc59-1c9f0df6ddbc'),
(9, 'College', NULL, NULL, 'college', 'posts', 'tags', NULL, 7, '2025-04-08 13:08:54', '2025-04-08 13:30:39', 0, 'b9e0c9e5-1619-42a1-ab4a-1b4bae6328e3'),
(10, 'Education', NULL, NULL, 'education-1', 'posts', 'categories', NULL, 5, '2025-04-08 13:09:15', '2025-04-08 13:32:35', 0, '6291f7b2-111f-4f05-a6b6-a29a1752b24d'),
(11, 'Lms', NULL, NULL, 'lms', 'posts', 'tags', NULL, 5, '2025-04-08 13:25:26', '2025-04-08 13:32:35', 0, '7691ffc3-da5d-4954-871e-60e4b3c5c59d'),
(12, 'College', NULL, NULL, 'college-1', 'posts', 'categories', NULL, 5, '2025-04-08 13:25:36', '2025-04-08 13:32:35', 0, '7b841f43-392a-401d-b397-61c8757ea704'),
(13, 'Music', NULL, NULL, 'music', 'events', 'categories', NULL, 3, '2025-04-08 13:36:56', '2025-04-08 16:49:27', 0, '1d42cfa0-73d4-45c6-8b9c-2cb83fd0c616'),
(14, 'Concerts', NULL, NULL, 'concerts', 'events', 'tags', NULL, 4, '2025-04-08 13:39:35', '2025-04-08 16:53:08', 0, 'f1132dca-346a-4623-8ebf-4e4e94c6d0e8'),
(15, 'Festivals', NULL, NULL, 'festivals', 'events', 'tags', NULL, 3, '2025-04-08 13:39:41', '2025-04-08 16:51:26', 0, '3cf91a7e-da86-4668-9561-3a019e274af7'),
(16, 'Live Bands', NULL, NULL, 'live-bands', 'events', 'tags', NULL, 4, '2025-04-08 13:39:50', '2025-04-08 16:53:08', 0, 'f99b4134-2d0c-4ca2-8557-f165578d4f1e'),
(17, 'Conferences', NULL, NULL, 'conferences', 'events', 'categories', NULL, 3, '2025-04-08 15:17:33', '2025-04-08 16:51:26', 0, 'cfeac787-6062-4ba9-a895-52fd6ab2b8cc'),
(18, 'Technology Conferences', NULL, NULL, 'technology-conferences', 'events', 'tags', NULL, 2, '2025-04-08 15:17:46', '2025-04-08 16:43:51', 0, '3438755e-fa5c-4d86-977e-35bbc18a4e67'),
(19, 'Business Seminars', NULL, NULL, 'business-seminars', 'events', 'tags', NULL, 1, '2025-04-08 15:17:55', '2025-04-08 15:19:18', 0, 'ffa56d89-b132-4622-a39c-d2628e8f6eb2'),
(20, 'Seasonal Themes', NULL, NULL, 'seasonal-themes', 'events', 'categories', NULL, 1, '2025-04-08 16:46:33', '2025-04-08 16:47:07', 0, 'beebc46b-f82a-4e56-bd64-305e8afb14d5'),
(21, 'Summer Vibes', NULL, NULL, 'summer-vibes', 'events', 'tags', NULL, 2, '2025-04-08 16:46:43', '2025-04-08 16:51:26', 0, '10afa2dc-f189-4827-9b4d-b89957bf4ba9'),
(22, 'Holiday Cheer', NULL, NULL, 'holiday-cheer', 'events', 'tags', NULL, 2, '2025-04-08 16:46:53', '2025-04-08 16:49:27', 0, 'f022fa61-a58d-401a-8078-70086f75b341'),
(23, 'Design', NULL, NULL, 'design', 'courses', 'categories', NULL, 2, '2025-04-09 15:37:12', '2025-04-09 18:51:53', 0, 'fe19f9bd-43a1-4688-9a08-d4af23646c85'),
(24, 'Web Design', NULL, NULL, 'web-design', 'courses', 'tags', NULL, 3, '2025-04-09 15:37:20', '2025-04-09 18:51:53', 0, 'b6a709c4-b004-44aa-b894-0fcbead49663'),
(25, 'Web Developed', NULL, NULL, 'web-developed', 'courses', 'tags', NULL, 2, '2025-04-09 15:37:40', '2025-04-09 18:24:55', 0, 'b31b0a32-ed18-47a8-ac35-65882da0cd64'),
(26, 'Business', NULL, NULL, 'business', 'courses', 'categories', NULL, 2, '2025-04-09 17:23:57', '2025-04-09 18:35:59', 0, '38282ddb-b85d-4be8-afff-f6855d40e2bc'),
(27, 'Buisness Web', NULL, NULL, 'buisness-web', 'courses', 'tags', NULL, 2, '2025-04-09 17:24:22', '2025-04-09 18:35:59', 0, '4ba5925e-47ad-41fe-9d60-fc799364a119'),
(28, 'Finance', NULL, NULL, 'finance', 'courses', 'categories', NULL, 2, '2025-04-09 18:08:13', '2025-04-09 19:01:33', 0, 'd97eac3e-ba67-4cd7-aa2b-f9aac3916bb6'),
(29, 'Finance', NULL, NULL, 'finance-1', 'courses', 'tags', NULL, 4, '2025-04-09 18:08:26', '2025-04-09 19:01:33', 0, 'fdc91432-3806-47ce-9994-6ed3f6a4b184'),
(30, 'Marketing', NULL, NULL, 'marketing', 'courses', 'categories', NULL, 2, '2025-04-09 18:23:53', '2025-04-09 19:00:25', 0, '7bc07bd9-e534-49a2-a213-c18391ce8b96'),
(31, 'Marketing', NULL, NULL, 'marketing-1', 'courses', 'tags', NULL, 2, '2025-04-09 18:24:00', '2025-04-09 19:00:25', 0, '7f089879-2aaf-4ebd-975c-ff4a599fa25c'),
(32, 'UI/UX', NULL, NULL, 'uiux', 'courses', 'categories', NULL, 1, '2025-04-09 18:47:45', '2025-04-09 18:48:40', 0, 'ca8645a4-58f8-4219-88c8-d35a2e928363'),
(33, 'UI/UX', NULL, NULL, 'uiux-1', 'courses', 'tags', NULL, 2, '2025-04-09 18:47:49', '2025-04-09 18:51:53', 0, 'bf301483-296b-4d70-a1ee-ade9fc7dc538'),
(34, 'Development', NULL, NULL, 'development', 'courses', 'categories', NULL, 0, '2025-04-21 10:58:22', '2025-04-21 10:58:22', 0, '7c667034-d89b-481d-b919-144a1093b0e1'),
(35, 'Email Marketing', NULL, NULL, 'email-marketing', 'courses', 'categories', NULL, 0, '2025-04-21 10:58:34', '2025-04-21 10:58:34', 0, '5dfe9ac5-3d35-4f17-952e-b780c81a6b9e'),
(36, 'Chemistry', NULL, NULL, 'chemistry', 'courses', 'categories', NULL, 0, '2025-04-21 10:58:41', '2025-04-21 10:58:41', 0, 'b2fd50c3-4155-4a2e-85b2-eb79f9baa62e'),
(37, 'IT / Technology', NULL, NULL, 'it-technology', 'courses', 'categories', NULL, 0, '2025-04-21 10:58:50', '2025-04-21 10:58:50', 0, 'd47c4c8c-c356-4bee-8f61-007c8445c894');

-- --------------------------------------------------------

--
-- Table structure for table `app_taxonomy_metas`
--

CREATE TABLE `app_taxonomy_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_telescope_entries`
--

CREATE TABLE `app_telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `batch_id` char(36) NOT NULL,
  `family_hash` varchar(150) DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_telescope_entries_tags`
--

CREATE TABLE `app_telescope_entries_tags` (
  `entry_uuid` char(36) NOT NULL,
  `tag` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_telescope_monitoring`
--

CREATE TABLE `app_telescope_monitoring` (
  `tag` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_term_taxonomies`
--

CREATE TABLE `app_term_taxonomies` (
  `term_id` bigint(20) NOT NULL,
  `taxonomy_id` bigint(20) NOT NULL,
  `term_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_term_taxonomies`
--

INSERT INTO `app_term_taxonomies` (`term_id`, `taxonomy_id`, `term_type`) VALUES
(1, 2, 'posts'),
(20, 5, 'events'),
(21, 5, 'events'),
(80, 6, 'courses'),
(82, 6, 'courses'),
(132, 5, 'events'),
(134, 7, 'posts'),
(134, 8, 'posts'),
(134, 9, 'posts'),
(134, 10, 'posts'),
(135, 7, 'posts'),
(135, 8, 'posts'),
(135, 9, 'posts'),
(135, 10, 'posts'),
(136, 7, 'posts'),
(136, 9, 'posts'),
(136, 11, 'posts'),
(136, 12, 'posts'),
(137, 9, 'posts'),
(137, 10, 'posts'),
(137, 11, 'posts'),
(138, 7, 'posts'),
(138, 9, 'posts'),
(138, 10, 'posts'),
(138, 11, 'posts'),
(139, 9, 'posts'),
(139, 12, 'posts'),
(140, 7, 'posts'),
(140, 9, 'posts'),
(140, 12, 'posts'),
(141, 8, 'posts'),
(141, 11, 'posts'),
(141, 12, 'posts'),
(142, 7, 'posts'),
(142, 10, 'posts'),
(142, 11, 'posts'),
(142, 12, 'posts'),
(143, 13, 'events'),
(143, 14, 'events'),
(143, 15, 'events'),
(143, 16, 'events'),
(144, 13, 'events'),
(144, 14, 'events'),
(144, 15, 'events'),
(144, 16, 'events'),
(145, 17, 'events'),
(145, 18, 'events'),
(145, 19, 'events'),
(146, 14, 'events'),
(146, 17, 'events'),
(146, 18, 'events'),
(147, 20, 'events'),
(147, 21, 'events'),
(147, 22, 'events'),
(148, 13, 'events'),
(148, 16, 'events'),
(148, 22, 'events'),
(149, 15, 'events'),
(149, 17, 'events'),
(149, 21, 'events'),
(150, 5, 'events'),
(150, 14, 'events'),
(150, 16, 'events'),
(153, 23, 'courses'),
(153, 24, 'courses'),
(155, 24, 'courses'),
(155, 26, 'courses'),
(155, 27, 'courses'),
(156, 25, 'courses'),
(156, 28, 'courses'),
(156, 29, 'courses'),
(157, 25, 'courses'),
(157, 30, 'courses'),
(157, 31, 'courses'),
(158, 26, 'courses'),
(158, 27, 'courses'),
(158, 29, 'courses'),
(159, 32, 'courses'),
(159, 33, 'courses'),
(160, 23, 'courses'),
(160, 24, 'courses'),
(160, 33, 'courses'),
(161, 28, 'courses'),
(161, 29, 'courses'),
(162, 29, 'courses'),
(162, 30, 'courses'),
(162, 31, 'courses');

-- --------------------------------------------------------

--
-- Table structure for table `app_test_eomm_plugin`
--

CREATE TABLE `app_test_eomm_plugin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_theme_configs`
--

CREATE TABLE `app_theme_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `theme` varchar(150) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_theme_configs`
--

INSERT INTO `app_theme_configs` (`id`, `code`, `theme`, `value`, `created_at`, `updated_at`) VALUES
(1, 'sidebar_sidebar', 'gamxo', '{\"uYdEqfrntd\":{\"title\":null,\"widget\":\"categories\",\"key\":\"uYdEqfrntd\"}}', '2025-01-28 10:57:41', '2025-01-28 10:57:41'),
(2, 'footer_bg_image', 'edufax', '2025/04/08/footer-bg.png', '2025-02-01 10:33:45', '2025-04-08 11:58:33'),
(3, 'sidebar_sidebar', 'edufax', '{\"IAyBP33RoN\":{\"title\":\"Search Here\",\"widget\":\"search_area\",\"key\":\"IAyBP33RoN\"},\"fuWc2TaLeM\":{\"title\":\"Categories\",\"custom_menu\":\"11\",\"widget\":\"categories_list\",\"key\":\"fuWc2TaLeM\"},\"JWqfyRRH5w\":{\"title\":\"Popular Posts\",\"post_type\":\"posts\",\"sort_by\":\"views\",\"widget\":\"popular_posts\",\"key\":\"JWqfyRRH5w\"}}', '2025-02-01 10:47:56', '2025-04-21 11:44:42'),
(4, 'nav_location', 'edufax', '{\"primary\":11,\"footer_2\":13,\"footer_bottom\":14}', '2025-02-01 12:47:07', '2025-04-21 11:42:40'),
(5, 'thumbnail_sizes', 'edufax', '{\"pages\":{\"width\":\"241\",\"height\":\"241\"},\"posts\":{\"width\":\"241\",\"height\":\"241\"},\"theme\":{\"width\":\"241\",\"height\":\"241\"},\"plugin\":{\"width\":\"241\",\"height\":\"241\"},\"products\":{\"width\":\"241\",\"height\":\"241\"},\"events\":{\"width\":\"241\",\"height\":\"241\"}}', '2025-03-07 09:51:39', '2025-03-07 09:51:39'),
(6, 'breadcrumb_bg_image', 'edufax', '2025/04/08/breadcrumb-bg.jpg', '2025-04-08 11:58:33', '2025-04-08 11:58:33'),
(7, 'sidebar_footer_1', 'edufax', '{\"lMxRisfdhg\":{\"logo\":\"2025\\/04\\/08\\/footer-logo.png\",\"logo_alt\":\"Logo\",\"description\":\"You made it so simple. My new site is so much faster and easier to work with than my old site. I just choose the page, make the change.\",\"social_links\":[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"},{\"icon\":\"fab fa-linkedin-in\",\"url\":\"#\"},{\"icon\":\"fab fa-twitter\",\"url\":\"#\"},{\"icon\":\"fab fa-pinterest-p\",\"url\":\"#\"}],\"widget\":\"footer_1\",\"key\":\"lMxRisfdhg\"}}', '2025-04-08 17:26:22', '2025-04-08 17:27:30'),
(8, 'sidebar_footer_3', 'edufax', '{\"BprSfRLv27\":{\"title\":\"Get in touch\",\"address\":\"4543 Washington. Manchester,mukly 545322 USA\",\"phones\":[{\"number\":\"+088 (246) 642-27\"},{\"number\":\"+088 (246) 342-28\"}],\"email\":\"mail@example.com\",\"widget\":\"footer_3\",\"key\":\"BprSfRLv27\"}}', '2025-04-08 17:28:26', '2025-04-08 17:28:59'),
(9, 'sidebar_footer_4', 'edufax', '{\"gY1mb1R9oq\":{\"title\":\"Subscribe\",\"description\":\"You made it so simple. My new site is so much faster and easier to work with than my old site. I just choose the page, make the change.\",\"placeholder\":\"Subscribe\",\"button_text\":\"Subscribe\",\"widget\":\"footer_4\",\"key\":\"gY1mb1R9oq\"}}', '2025-04-08 17:30:15', '2025-04-08 17:30:15'),
(10, 'copy_right_text', 'edufax', 'EduFax © 2025, All Rights Reserved', '2025-04-20 19:16:55', '2025-04-20 19:16:55'),
(11, 'enable_top_bar', 'edufax', '1', '2025-04-20 19:16:55', '2025-04-20 19:16:55'),
(12, 'top_bar_text', 'edufax', 'Enroll now and get 40% off any course. Courses from $5.99.', '2025-04-20 19:16:55', '2025-04-20 19:16:55'),
(13, 'enable_logout_button', 'edufax', '1', '2025-04-20 19:16:55', '2025-04-20 19:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(150) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'active' COMMENT 'unconfimred, banned, active',
  `language` varchar(5) NOT NULL DEFAULT 'en',
  `verification_token` varchar(150) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`)),
  `is_fake` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data`, `json_metas`, `is_fake`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$Ii4Uty/j2kbrmb5skyVFMOpMx1qBqP/LWrScoOHoV9xQUM2WdbsdC', '3ZWCEwFiKbhsXmnEluUXPv2dRQYgZ8IEnEbxeEteRpoPAor37U2q9r9vMH7G', '2024-11-24 19:59:45', '2025-04-08 13:33:53', '2025/04/08/dashboard-user-img.jpg', 1, 'active', 'en', NULL, NULL, '{\"country\": \"AQ\", \"birthday\": \"2025-02-11\"}', 0),
(10, 'admin1', 'admin1@gmail.com', NULL, '$2y$10$BSA9fxk04St5wko4EPQoT.SFOUlPiGYKp5cd4OKFd6tYU6ww4Kfwa', NULL, '2025-04-08 11:42:03', '2025-04-08 11:42:03', NULL, 1, 'active', 'en', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_user_metas`
--

CREATE TABLE `app_user_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_user_metas`
--

INSERT INTO `app_user_metas` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'birthday', '2025-02-11'),
(2, 1, 'country', 'AQ');

-- --------------------------------------------------------

--
-- Table structure for table `app_variants_attributes`
--

CREATE TABLE `app_variants_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_app_translations`
--
ALTER TABLE `app_app_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_app_translations_status_index` (`status`),
  ADD KEY `app_app_translations_locale_index` (`locale`),
  ADD KEY `app_app_translations_group_index` (`group`),
  ADD KEY `app_app_translations_namespace_index` (`namespace`),
  ADD KEY `app_app_translations_object_type_index` (`object_type`),
  ADD KEY `app_app_translations_object_key_index` (`object_key`);

--
-- Indexes for table `app_attributes`
--
ALTER TABLE `app_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_attribute_values`
--
ALTER TABLE `app_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `app_comments`
--
ALTER TABLE `app_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_comments_user_id_index` (`user_id`),
  ADD KEY `app_comments_email_index` (`email`),
  ADD KEY `app_comments_object_id_index` (`object_id`),
  ADD KEY `app_comments_object_type_index` (`object_type`);

--
-- Indexes for table `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_configs_code_unique` (`code`),
  ADD KEY `app_configs_code_index` (`code`);

--
-- Indexes for table `app_contact_form_contacts`
--
ALTER TABLE `app_contact_form_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_contact_form_contacts_created_at_index` (`created_at`),
  ADD KEY `app_contact_form_contacts_email_index` (`email`),
  ADD KEY `app_contact_form_contacts_site_id_index` (`site_id`);

--
-- Indexes for table `app_dev_tool_cms_versions`
--
ALTER TABLE `app_dev_tool_cms_versions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_dev_tool_cms_versions_version_unique` (`version`);

--
-- Indexes for table `app_dev_tool_marketplace_plugins`
--
ALTER TABLE `app_dev_tool_marketplace_plugins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_dev_tool_marketplace_plugins_name_unique` (`name`);

--
-- Indexes for table `app_dev_tool_marketplace_themes`
--
ALTER TABLE `app_dev_tool_marketplace_themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_dev_tool_marketplace_themes_name_unique` (`name`);

--
-- Indexes for table `app_dev_tool_package_versions`
--
ALTER TABLE `app_dev_tool_package_versions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pkg_type_version_unique` (`package_name`,`package_type`,`version`);

--
-- Indexes for table `app_discounts`
--
ALTER TABLE `app_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_discounts_post_id_foreign` (`post_id`),
  ADD KEY `app_discounts_code_index` (`code`);

--
-- Indexes for table `app_ecomm_addons`
--
ALTER TABLE `app_ecomm_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_ecomm_carts`
--
ALTER TABLE `app_ecomm_carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_ecomm_carts_code_site_id_unique` (`code`,`site_id`),
  ADD KEY `app_ecomm_carts_user_id_foreign` (`user_id`),
  ADD KEY `app_ecomm_carts_site_id_index` (`site_id`);

--
-- Indexes for table `app_ecomm_currencies`
--
ALTER TABLE `app_ecomm_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_ecom_download_links`
--
ALTER TABLE `app_ecom_download_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_ecom_download_links_uuid_unique` (`uuid`),
  ADD KEY `app_ecom_download_links_product_id_foreign` (`product_id`),
  ADD KEY `app_ecom_download_links_variant_id_foreign` (`variant_id`),
  ADD KEY `app_ecom_download_links_site_id_index` (`site_id`);

--
-- Indexes for table `app_email_lists`
--
ALTER TABLE `app_email_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_email_lists_email_index` (`email`),
  ADD KEY `app_email_lists_template_id_index` (`template_id`),
  ADD KEY `app_email_lists_status_index` (`status`),
  ADD KEY `app_email_lists_template_code_index` (`template_code`);

--
-- Indexes for table `app_email_templates`
--
ALTER TABLE `app_email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_email_templates_code_unique` (`code`),
  ADD UNIQUE KEY `email_templates_uuid_unique` (`uuid`),
  ADD KEY `app_email_templates_active_index` (`active`);

--
-- Indexes for table `app_email_template_users`
--
ALTER TABLE `app_email_template_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_email_template_users_user_id_foreign` (`user_id`),
  ADD KEY `app_email_template_users_email_template_id_foreign` (`email_template_id`);

--
-- Indexes for table `app_evman_event_bookings`
--
ALTER TABLE `app_evman_event_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_evman_event_bookings_code_unique` (`code`),
  ADD KEY `app_evman_event_bookings_event_id_foreign` (`event_id`),
  ADD KEY `app_evman_event_bookings_user_id_foreign` (`user_id`),
  ADD KEY `app_evman_event_bookings_ticket_id_foreign` (`ticket_id`),
  ADD KEY `app_evman_event_bookings_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `app_evman_event_bookings_order_id_foreign` (`order_id`);

--
-- Indexes for table `app_evman_event_tickets`
--
ALTER TABLE `app_evman_event_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_evman_event_tickets_event_id_foreign` (`event_id`),
  ADD KEY `app_evman_event_tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `app_failed_jobs`
--
ALTER TABLE `app_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `app_jobs`
--
ALTER TABLE `app_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_jobs_queue_index` (`queue`);

--
-- Indexes for table `app_languages`
--
ALTER TABLE `app_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_languages_code_unique` (`code`),
  ADD KEY `app_languages_code_index` (`code`);

--
-- Indexes for table `app_language_lines`
--
ALTER TABLE `app_language_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_language_lines_namespace_index` (`namespace`),
  ADD KEY `app_language_lines_group_index` (`group`),
  ADD KEY `app_language_lines_key_index` (`key`),
  ADD KEY `app_language_lines_object_type_index` (`object_type`),
  ADD KEY `app_language_lines_object_key_index` (`object_key`);

--
-- Indexes for table `app_lms_course_lessons`
--
ALTER TABLE `app_lms_course_lessons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_lms_course_lessons_slug_unique` (`slug`),
  ADD KEY `app_lms_course_lessons_post_id_foreign` (`post_id`),
  ADD KEY `app_lms_course_lessons_course_topic_id_index` (`course_topic_id`);

--
-- Indexes for table `app_lms_course_topics`
--
ALTER TABLE `app_lms_course_topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_lms_course_topics_slug_unique` (`slug`),
  ADD KEY `app_lms_course_topics_post_id_index` (`post_id`);

--
-- Indexes for table `app_manual_notifications`
--
ALTER TABLE `app_manual_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_manual_notifications_method_index` (`method`);

--
-- Indexes for table `app_media_files`
--
ALTER TABLE `app_media_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_media_files_folder_id_index` (`folder_id`),
  ADD KEY `app_media_files_user_id_index` (`user_id`),
  ADD KEY `app_media_files_type_index` (`type`),
  ADD KEY `app_media_files_mime_type_index` (`mime_type`),
  ADD KEY `app_media_files_path_index` (`path`),
  ADD KEY `app_media_files_extension_index` (`extension`),
  ADD KEY `app_media_files_size_index` (`size`),
  ADD KEY `app_media_files_disk_index` (`disk`);

--
-- Indexes for table `app_media_folders`
--
ALTER TABLE `app_media_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_media_folders_folder_id_index` (`folder_id`),
  ADD KEY `app_media_folders_type_index` (`type`),
  ADD KEY `app_media_folders_disk_index` (`disk`);

--
-- Indexes for table `app_menus`
--
ALTER TABLE `app_menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_uuid_unique` (`uuid`);

--
-- Indexes for table `app_menu_items`
--
ALTER TABLE `app_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `app_menu_items_parent_id_foreign` (`parent_id`),
  ADD KEY `app_menu_items_model_class_index` (`model_class`),
  ADD KEY `app_menu_items_model_id_index` (`model_id`),
  ADD KEY `app_menu_items_num_order_index` (`num_order`);

--
-- Indexes for table `app_migrations`
--
ALTER TABLE `app_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_model_has_permissions`
--
ALTER TABLE `app_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `app_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `app_model_has_roles`
--
ALTER TABLE `app_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `app_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `app_notifications`
--
ALTER TABLE `app_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `app_oauth_access_tokens`
--
ALTER TABLE `app_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `app_oauth_auth_codes`
--
ALTER TABLE `app_oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `app_oauth_clients`
--
ALTER TABLE `app_oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `app_oauth_personal_access_clients`
--
ALTER TABLE `app_oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_oauth_refresh_tokens`
--
ALTER TABLE `app_oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `app_orders`
--
ALTER TABLE `app_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_orders_token_unique` (`token`),
  ADD KEY `app_orders_type_index` (`type`),
  ADD KEY `app_orders_status_index` (`status`),
  ADD KEY `app_orders_payment_method_id_index` (`payment_method_id`),
  ADD KEY `app_orders_user_id_index` (`user_id`),
  ADD KEY `app_orders_site_id_index` (`site_id`);

--
-- Indexes for table `app_order_items`
--
ALTER TABLE `app_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_order_items_type_index` (`type`),
  ADD KEY `app_order_items_sku_code_index` (`sku_code`),
  ADD KEY `app_order_items_barcode_index` (`barcode`),
  ADD KEY `app_order_items_post_id_index` (`post_id`),
  ADD KEY `app_order_items_order_id_index` (`order_id`);

--
-- Indexes for table `app_order_item_metas`
--
ALTER TABLE `app_order_item_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_order_item_metas_order_item_id_meta_key_unique` (`order_item_id`,`meta_key`),
  ADD KEY `app_order_item_metas_order_item_id_index` (`order_item_id`),
  ADD KEY `app_order_item_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_order_metas`
--
ALTER TABLE `app_order_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_order_metas_order_id_meta_key_unique` (`order_id`,`meta_key`),
  ADD KEY `app_order_metas_order_id_index` (`order_id`),
  ADD KEY `app_order_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_pages`
--
ALTER TABLE `app_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_pages_slug_unique` (`slug`),
  ADD KEY `app_pages_template_index` (`template`),
  ADD KEY `app_pages_status_index` (`status`);

--
-- Indexes for table `app_page_metas`
--
ALTER TABLE `app_page_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_page_metas_page_id_meta_key_unique` (`page_id`,`meta_key`),
  ADD KEY `app_page_metas_page_id_index` (`page_id`),
  ADD KEY `app_page_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_password_resets`
--
ALTER TABLE `app_password_resets`
  ADD KEY `app_password_resets_email_index` (`email`);

--
-- Indexes for table `app_payment_histories`
--
ALTER TABLE `app_payment_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_payment_histories_transaction_id_unique` (`transaction_id`),
  ADD KEY `app_payment_histories_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `app_payment_methods`
--
ALTER TABLE `app_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_payment_methods_type_index` (`type`);

--
-- Indexes for table `app_permissions`
--
ALTER TABLE `app_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_permissions_name_guard_unique` (`name`,`guard_name`);

--
-- Indexes for table `app_permission_groups`
--
ALTER TABLE `app_permission_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_permission_groups_plugin_index` (`plugin`);

--
-- Indexes for table `app_personal_access_tokens`
--
ALTER TABLE `app_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_personal_access_tokens_token_unique` (`token`),
  ADD KEY `app_personal_access_tokens_tokenable_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `app_posts`
--
ALTER TABLE `app_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_posts_slug_unique` (`slug`),
  ADD UNIQUE KEY `posts_uuid_unique` (`uuid`),
  ADD KEY `app_posts_status_index` (`status`),
  ADD KEY `app_posts_created_by_index` (`created_by`),
  ADD KEY `app_posts_updated_by_index` (`updated_by`),
  ADD KEY `app_posts_type_index` (`type`),
  ADD KEY `app_posts_locale_index` (`locale`);

--
-- Indexes for table `app_post_likes`
--
ALTER TABLE `app_post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_post_likes_post_id_foreign` (`post_id`),
  ADD KEY `app_post_likes_user_id_index` (`user_id`),
  ADD KEY `app_post_likes_client_ip_index` (`client_ip`);

--
-- Indexes for table `app_post_metas`
--
ALTER TABLE `app_post_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_post_metas_post_id_meta_key_unique` (`post_id`,`meta_key`),
  ADD KEY `app_post_metas_post_id_index` (`post_id`),
  ADD KEY `app_post_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_post_ratings`
--
ALTER TABLE `app_post_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_post_ratings_post_id_index` (`post_id`),
  ADD KEY `app_post_ratings_client_ip_index` (`client_ip`);

--
-- Indexes for table `app_post_views`
--
ALTER TABLE `app_post_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_post_views_post_id_index` (`post_id`),
  ADD KEY `app_post_views_day_index` (`day`);

--
-- Indexes for table `app_product_variants`
--
ALTER TABLE `app_product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_product_variants_sku_code_index` (`sku_code`),
  ADD KEY `app_product_variants_barcode_index` (`barcode`),
  ADD KEY `app_product_variants_post_id_index` (`post_id`);

--
-- Indexes for table `app_product_variants_attribute_values`
--
ALTER TABLE `app_product_variants_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_id_pivot_foreign` (`product_variant_id`),
  ADD KEY `attribute_id_pivot_foreign` (`attribute_id`),
  ADD KEY `attribute_value_id_pivot_foreign` (`attribute_value_id`);

--
-- Indexes for table `app_resources`
--
ALTER TABLE `app_resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_resources_slug_unique` (`slug`),
  ADD UNIQUE KEY `resources_uuid_unique` (`uuid`),
  ADD KEY `app_resources_post_id_foreign` (`post_id`),
  ADD KEY `app_resources_parent_id_foreign` (`parent_id`),
  ADD KEY `app_resources_type_index` (`type`),
  ADD KEY `app_resources_status_index` (`status`);

--
-- Indexes for table `app_resource_metas`
--
ALTER TABLE `app_resource_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_resource_metas_resource_id_meta_key_unique` (`resource_id`,`meta_key`),
  ADD KEY `app_resource_metas_resource_id_index` (`resource_id`),
  ADD KEY `app_resource_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_roles`
--
ALTER TABLE `app_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_roles_name_guard_unique` (`name`,`guard_name`);

--
-- Indexes for table `app_role_has_permissions`
--
ALTER TABLE `app_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `app_role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `app_search`
--
ALTER TABLE `app_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_search_post_id_post_type_unique` (`post_id`,`post_type`),
  ADD KEY `app_search_title_index` (`title`),
  ADD KEY `app_search_slug_index` (`slug`),
  ADD KEY `app_search_post_id_index` (`post_id`),
  ADD KEY `app_search_post_type_index` (`post_type`),
  ADD KEY `app_search_status_index` (`status`);

--
-- Indexes for table `app_seo_metas`
--
ALTER TABLE `app_seo_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_seo_metas_object_type_index` (`object_type`),
  ADD KEY `app_seo_metas_object_id_index` (`object_id`);

--
-- Indexes for table `app_shipping_address`
--
ALTER TABLE `app_shipping_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_shipping_address_order_id_index` (`order_id`),
  ADD KEY `app_shipping_address_shop_id_index` (`shop_id`);

--
-- Indexes for table `app_shipping_methods`
--
ALTER TABLE `app_shipping_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_shipping_methods_province_id_index` (`province_id`),
  ADD KEY `app_shipping_methods_shop_id_index` (`shop_id`);

--
-- Indexes for table `app_single_taxonomies`
--
ALTER TABLE `app_single_taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_single_taxonomies_post_type_post_id_unique` (`post_type`,`post_id`),
  ADD UNIQUE KEY `app_single_taxonomies_slug_unique` (`slug`),
  ADD KEY `app_single_taxonomies_post_type_index` (`post_type`),
  ADD KEY `app_single_taxonomies_post_id_index` (`post_id`),
  ADD KEY `app_single_taxonomies_taxonomy_index` (`taxonomy`);

--
-- Indexes for table `app_single_taxonomy_metas`
--
ALTER TABLE `app_single_taxonomy_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_single_taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  ADD KEY `app_single_taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `app_single_taxonomy_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_social_tokens`
--
ALTER TABLE `app_social_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_social_tokens_user_id_social_provider_unique` (`user_id`,`social_provider`),
  ADD KEY `app_social_tokens_user_id_index` (`user_id`),
  ADD KEY `app_social_tokens_social_provider_index` (`social_provider`),
  ADD KEY `app_social_tokens_social_id_index` (`social_id`);

--
-- Indexes for table `app_table_groups`
--
ALTER TABLE `app_table_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_table_groups_table_unique` (`table`),
  ADD KEY `app_table_groups_total_rows_index` (`total_rows`);

--
-- Indexes for table `app_table_group_datas`
--
ALTER TABLE `app_table_group_datas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_table_group_datas_real_table_table_key_unique` (`real_table`,`table_key`),
  ADD KEY `app_table_group_datas_table_group_id_foreign` (`table_group_id`),
  ADD KEY `app_table_group_datas_table_group_table_id_foreign` (`table_group_table_id`),
  ADD KEY `app_table_group_datas_table_index` (`table`),
  ADD KEY `app_table_group_datas_real_table_index` (`real_table`),
  ADD KEY `app_table_group_datas_table_key_index` (`table_key`);

--
-- Indexes for table `app_table_group_tables`
--
ALTER TABLE `app_table_group_tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_table_group_tables_real_table_unique` (`real_table`),
  ADD KEY `app_table_group_tables_table_group_id_foreign` (`table_group_id`),
  ADD KEY `app_table_group_tables_table_index` (`table`),
  ADD KEY `app_table_group_tables_total_rows_index` (`total_rows`);

--
-- Indexes for table `app_taxonomies`
--
ALTER TABLE `app_taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_taxonomies_slug_unique` (`slug`),
  ADD UNIQUE KEY `taxonomies_uuid_unique` (`uuid`),
  ADD KEY `app_taxonomies_post_type_index` (`post_type`),
  ADD KEY `app_taxonomies_taxonomy_index` (`taxonomy`),
  ADD KEY `app_taxonomies_parent_id_index` (`parent_id`);

--
-- Indexes for table `app_taxonomy_metas`
--
ALTER TABLE `app_taxonomy_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  ADD KEY `app_taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `app_taxonomy_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_telescope_entries`
--
ALTER TABLE `app_telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `app_telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `app_telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `app_telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `app_telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_should_display_on_index` (`type`,`should_display_on_index`);

--
-- Indexes for table `app_telescope_entries_tags`
--
ALTER TABLE `app_telescope_entries_tags`
  ADD KEY `app_telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `app_telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `app_term_taxonomies`
--
ALTER TABLE `app_term_taxonomies`
  ADD PRIMARY KEY (`term_id`,`term_type`,`taxonomy_id`),
  ADD KEY `app_term_taxonomies_term_id_index` (`term_id`),
  ADD KEY `app_term_taxonomies_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `app_term_taxonomies_term_type_index` (`term_type`);

--
-- Indexes for table `app_test_eomm_plugin`
--
ALTER TABLE `app_test_eomm_plugin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_theme_configs`
--
ALTER TABLE `app_theme_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_theme_configs_code_theme_unique` (`code`,`theme`),
  ADD KEY `app_theme_configs_code_index` (`code`),
  ADD KEY `app_theme_configs_theme_index` (`theme`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_users_email_unique` (`email`);

--
-- Indexes for table `app_user_metas`
--
ALTER TABLE `app_user_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_user_metas_user_id_meta_key_unique` (`user_id`,`meta_key`),
  ADD KEY `app_user_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `app_variants_attributes`
--
ALTER TABLE `app_variants_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `attribute_id_foreign` (`attribute_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_app_translations`
--
ALTER TABLE `app_app_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_attributes`
--
ALTER TABLE `app_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_attribute_values`
--
ALTER TABLE `app_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_comments`
--
ALTER TABLE `app_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `app_configs`
--
ALTER TABLE `app_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `app_dev_tool_cms_versions`
--
ALTER TABLE `app_dev_tool_cms_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_dev_tool_marketplace_plugins`
--
ALTER TABLE `app_dev_tool_marketplace_plugins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_dev_tool_marketplace_themes`
--
ALTER TABLE `app_dev_tool_marketplace_themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_dev_tool_package_versions`
--
ALTER TABLE `app_dev_tool_package_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_discounts`
--
ALTER TABLE `app_discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_ecomm_addons`
--
ALTER TABLE `app_ecomm_addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_ecomm_carts`
--
ALTER TABLE `app_ecomm_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `app_ecomm_currencies`
--
ALTER TABLE `app_ecomm_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `app_ecom_download_links`
--
ALTER TABLE `app_ecom_download_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_email_lists`
--
ALTER TABLE `app_email_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_email_templates`
--
ALTER TABLE `app_email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_email_template_users`
--
ALTER TABLE `app_email_template_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_evman_event_bookings`
--
ALTER TABLE `app_evman_event_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `app_evman_event_tickets`
--
ALTER TABLE `app_evman_event_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `app_failed_jobs`
--
ALTER TABLE `app_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_jobs`
--
ALTER TABLE `app_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_languages`
--
ALTER TABLE `app_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_language_lines`
--
ALTER TABLE `app_language_lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_lms_course_lessons`
--
ALTER TABLE `app_lms_course_lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `app_lms_course_topics`
--
ALTER TABLE `app_lms_course_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `app_manual_notifications`
--
ALTER TABLE `app_manual_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `app_media_files`
--
ALTER TABLE `app_media_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `app_media_folders`
--
ALTER TABLE `app_media_folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `app_menus`
--
ALTER TABLE `app_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `app_menu_items`
--
ALTER TABLE `app_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `app_migrations`
--
ALTER TABLE `app_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `app_oauth_clients`
--
ALTER TABLE `app_oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_oauth_personal_access_clients`
--
ALTER TABLE `app_oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_orders`
--
ALTER TABLE `app_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `app_order_items`
--
ALTER TABLE `app_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `app_order_item_metas`
--
ALTER TABLE `app_order_item_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_order_metas`
--
ALTER TABLE `app_order_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_pages`
--
ALTER TABLE `app_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_page_metas`
--
ALTER TABLE `app_page_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_payment_histories`
--
ALTER TABLE `app_payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_payment_methods`
--
ALTER TABLE `app_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_permissions`
--
ALTER TABLE `app_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `app_permission_groups`
--
ALTER TABLE `app_permission_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_personal_access_tokens`
--
ALTER TABLE `app_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_posts`
--
ALTER TABLE `app_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `app_post_likes`
--
ALTER TABLE `app_post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_post_metas`
--
ALTER TABLE `app_post_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=515;

--
-- AUTO_INCREMENT for table `app_post_ratings`
--
ALTER TABLE `app_post_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_post_views`
--
ALTER TABLE `app_post_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `app_product_variants`
--
ALTER TABLE `app_product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_product_variants_attribute_values`
--
ALTER TABLE `app_product_variants_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_resources`
--
ALTER TABLE `app_resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_resource_metas`
--
ALTER TABLE `app_resource_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_roles`
--
ALTER TABLE `app_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_search`
--
ALTER TABLE `app_search`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_seo_metas`
--
ALTER TABLE `app_seo_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_shipping_address`
--
ALTER TABLE `app_shipping_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_shipping_methods`
--
ALTER TABLE `app_shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_single_taxonomies`
--
ALTER TABLE `app_single_taxonomies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_single_taxonomy_metas`
--
ALTER TABLE `app_single_taxonomy_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_social_tokens`
--
ALTER TABLE `app_social_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_table_groups`
--
ALTER TABLE `app_table_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_table_group_datas`
--
ALTER TABLE `app_table_group_datas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_table_group_tables`
--
ALTER TABLE `app_table_group_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_taxonomies`
--
ALTER TABLE `app_taxonomies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `app_taxonomy_metas`
--
ALTER TABLE `app_taxonomy_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_telescope_entries`
--
ALTER TABLE `app_telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_test_eomm_plugin`
--
ALTER TABLE `app_test_eomm_plugin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_theme_configs`
--
ALTER TABLE `app_theme_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `app_user_metas`
--
ALTER TABLE `app_user_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `app_variants_attributes`
--
ALTER TABLE `app_variants_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_attribute_values`
--
ALTER TABLE `app_attribute_values`
  ADD CONSTRAINT `app_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `app_attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_comments`
--
ALTER TABLE `app_comments`
  ADD CONSTRAINT `app_comments_object_id_foreign` FOREIGN KEY (`object_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_discounts`
--
ALTER TABLE `app_discounts`
  ADD CONSTRAINT `app_discounts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_ecomm_carts`
--
ALTER TABLE `app_ecomm_carts`
  ADD CONSTRAINT `app_ecomm_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_ecom_download_links`
--
ALTER TABLE `app_ecom_download_links`
  ADD CONSTRAINT `app_ecom_download_links_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_ecom_download_links_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `app_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_email_template_users`
--
ALTER TABLE `app_email_template_users`
  ADD CONSTRAINT `app_email_template_users_email_template_id_foreign` FOREIGN KEY (`email_template_id`) REFERENCES `app_email_templates` (`id`),
  ADD CONSTRAINT `app_email_template_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`);

--
-- Constraints for table `app_evman_event_bookings`
--
ALTER TABLE `app_evman_event_bookings`
  ADD CONSTRAINT `app_evman_event_bookings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_evman_event_bookings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `app_orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_evman_event_bookings_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `app_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_evman_event_bookings_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `app_evman_event_tickets` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_evman_event_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_evman_event_tickets`
--
ALTER TABLE `app_evman_event_tickets`
  ADD CONSTRAINT `app_evman_event_tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_evman_event_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_lms_course_lessons`
--
ALTER TABLE `app_lms_course_lessons`
  ADD CONSTRAINT `app_lms_course_lessons_course_topic_id_foreign` FOREIGN KEY (`course_topic_id`) REFERENCES `app_lms_course_topics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_lms_course_lessons_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_lms_course_topics`
--
ALTER TABLE `app_lms_course_topics`
  ADD CONSTRAINT `app_lms_course_topics_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_menu_items`
--
ALTER TABLE `app_menu_items`
  ADD CONSTRAINT `app_menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `app_menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `app_menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_model_has_permissions`
--
ALTER TABLE `app_model_has_permissions`
  ADD CONSTRAINT `app_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `app_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_model_has_roles`
--
ALTER TABLE `app_model_has_roles`
  ADD CONSTRAINT `app_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_orders`
--
ALTER TABLE `app_orders`
  ADD CONSTRAINT `app_orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `app_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `app_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_order_items`
--
ALTER TABLE `app_order_items`
  ADD CONSTRAINT `app_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `app_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_order_items_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `app_order_item_metas`
--
ALTER TABLE `app_order_item_metas`
  ADD CONSTRAINT `app_order_item_metas_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `app_order_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_order_metas`
--
ALTER TABLE `app_order_metas`
  ADD CONSTRAINT `app_order_metas_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `app_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_page_metas`
--
ALTER TABLE `app_page_metas`
  ADD CONSTRAINT `app_page_metas_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `app_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_payment_histories`
--
ALTER TABLE `app_payment_histories`
  ADD CONSTRAINT `app_payment_histories_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `app_payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_likes`
--
ALTER TABLE `app_post_likes`
  ADD CONSTRAINT `app_post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_metas`
--
ALTER TABLE `app_post_metas`
  ADD CONSTRAINT `app_post_metas_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_ratings`
--
ALTER TABLE `app_post_ratings`
  ADD CONSTRAINT `app_post_ratings_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_post_views`
--
ALTER TABLE `app_post_views`
  ADD CONSTRAINT `app_post_views_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_product_variants`
--
ALTER TABLE `app_product_variants`
  ADD CONSTRAINT `app_product_variants_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_product_variants_attribute_values`
--
ALTER TABLE `app_product_variants_attribute_values`
  ADD CONSTRAINT `attribute_id_pivot_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `app_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_value_id_pivot_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `app_attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_id_pivot_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `app_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_resources`
--
ALTER TABLE `app_resources`
  ADD CONSTRAINT `app_resources_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `app_resources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_resources_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_resource_metas`
--
ALTER TABLE `app_resource_metas`
  ADD CONSTRAINT `app_resource_metas_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `app_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_role_has_permissions`
--
ALTER TABLE `app_role_has_permissions`
  ADD CONSTRAINT `app_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `app_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_single_taxonomies`
--
ALTER TABLE `app_single_taxonomies`
  ADD CONSTRAINT `app_single_taxonomies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_single_taxonomy_metas`
--
ALTER TABLE `app_single_taxonomy_metas`
  ADD CONSTRAINT `app_single_taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `app_single_taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_social_tokens`
--
ALTER TABLE `app_social_tokens`
  ADD CONSTRAINT `app_social_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_table_group_datas`
--
ALTER TABLE `app_table_group_datas`
  ADD CONSTRAINT `app_table_group_datas_table_group_id_foreign` FOREIGN KEY (`table_group_id`) REFERENCES `app_table_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_table_group_datas_table_group_table_id_foreign` FOREIGN KEY (`table_group_table_id`) REFERENCES `app_table_group_tables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_table_group_tables`
--
ALTER TABLE `app_table_group_tables`
  ADD CONSTRAINT `app_table_group_tables_table_group_id_foreign` FOREIGN KEY (`table_group_id`) REFERENCES `app_table_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_taxonomy_metas`
--
ALTER TABLE `app_taxonomy_metas`
  ADD CONSTRAINT `app_taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `app_taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_telescope_entries_tags`
--
ALTER TABLE `app_telescope_entries_tags`
  ADD CONSTRAINT `app_telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `app_telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `app_user_metas`
--
ALTER TABLE `app_user_metas`
  ADD CONSTRAINT `app_user_metas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_variants_attributes`
--
ALTER TABLE `app_variants_attributes`
  ADD CONSTRAINT `attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `app_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `app_product_variants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
