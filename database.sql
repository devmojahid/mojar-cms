-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2025 at 07:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mojar_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `jw_attributes`
--

CREATE TABLE `jw_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_attribute_values`
--

CREATE TABLE `jw_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `value` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_comments`
--

CREATE TABLE `jw_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` bigint UNSIGNED NOT NULL COMMENT 'Post type ID',
  `object_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Post type',
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `json_metas` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_comments`
--

INSERT INTO `jw_comments` (`id`, `user_id`, `email`, `name`, `website`, `content`, `object_id`, `object_type`, `status`, `created_at`, `updated_at`, `json_metas`) VALUES
(1, 1, NULL, NULL, NULL, 'hello world', 3, 'posts', 'approved', '2025-02-01 07:42:05', '2025-03-21 05:52:06', NULL),
(2, 1, NULL, NULL, NULL, 'fdadffd', 3, 'posts', 'pending', '2025-02-01 07:42:34', '2025-02-01 07:42:34', NULL),
(3, 1, NULL, NULL, NULL, 'fdfdsfsdf', 3, 'posts', 'approved', '2025-02-01 07:44:22', '2025-03-01 23:39:01', NULL),
(5, 1, NULL, NULL, NULL, 'eqdsd', 82, 'courses', 'approved', '2025-03-21 05:20:16', '2025-03-21 07:19:47', '{\"rating\": \"3\"}'),
(6, 1, NULL, NULL, NULL, 'vzvzxcv', 79, 'posts', 'approved', '2025-03-21 05:51:13', '2025-03-21 05:52:21', NULL),
(7, 1, NULL, NULL, NULL, 'iyhjkm;l', 79, 'posts', 'approved', '2025-03-21 05:52:32', '2025-03-21 05:52:44', NULL),
(8, 1, NULL, NULL, NULL, 'Reviews', 82, 'courses', 'approved', '2025-03-21 07:19:07', '2025-03-21 07:19:47', '{\"rating\": \"5\"}'),
(9, 1, NULL, NULL, NULL, 'sadasd', 82, 'courses', 'pending', '2025-03-21 07:45:35', '2025-03-21 07:45:35', '{\"rating\": \"3\"}'),
(10, 1, NULL, NULL, NULL, 'sadsad', 79, 'posts', 'pending', '2025-03-22 09:33:31', '2025-03-22 09:33:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jw_configs`
--

CREATE TABLE `jw_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_configs`
--

INSERT INTO `jw_configs` (`id`, `code`, `value`) VALUES
(1, 'title', 'JuzaCMS - Laravel CMS for Your Project'),
(2, 'description', 'Juzacms is a Content Management System (CMS) and web platform whose sole purpose is to make your development workflow simple again.'),
(3, 'author_name', 'Mojar Team'),
(4, 'user_registration', '1'),
(5, 'user_verification', '1'),
(6, 'logo', '2025/01/15/logo.png'),
(7, 'icon', NULL),
(8, 'sitename', 'JuzaCMS'),
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
(23, 'jw_enable_sitemap', '0'),
(24, 'jw_enable_post_feed', '0'),
(25, 'jw_enable_taxonomy_feed', '1'),
(26, 'jw_auto_ping_google_sitemap', '1'),
(27, 'jw_auto_submit_url_google', '0'),
(28, 'jw_auto_submit_url_bing', '1'),
(29, 'jw_bing_api_key', NULL),
(30, 'jw_auto_add_tags_to_posts', '0'),
(31, 'bing_verify_key', NULL),
(32, 'google_verify_key', NULL),
(34, 'jw_backup_enable', '0'),
(35, 'jw_backup_time', 'daily'),
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
(99, 'lms_instructor_page', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jw_contact_form_contacts`
--

CREATE TABLE `jw_contact_form_contacts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `metas` json DEFAULT NULL,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_contact_form_contacts`
--

INSERT INTO `jw_contact_form_contacts` (`id`, `name`, `email`, `subject`, `message`, `metas`, `site_id`, `created_at`, `updated_at`) VALUES
('1a133c89-4a55-4e51-bb0b-6fd121650fc4', 'Zenia Holman', 'pudipohuze@mailinator.com', 'Sunt explicabo Aute', 'Quas nisi perferendi', NULL, 0, '2025-03-05 02:00:23', '2025-03-05 02:00:23'),
('51a3c78d-166e-45d0-aba3-29eb6ee63c16', 'dasdas', 'asdasd@gmd.com', 'dadas', 'dasdas', NULL, 0, '2025-03-04 09:57:46', '2025-03-04 09:57:46'),
('5f7bb18c-426d-462e-9109-c94aa047a13e', 'Lacy Cannon', 'fonyga@mailinator.com', 'Rerum dolorem evenie', 'Possimus qui repreh', NULL, 0, '2025-03-05 02:04:09', '2025-03-05 02:04:09'),
('cfee6cff-394b-4470-89a1-57e827a7f015', 'Cleo Dejesus', 'duhimyfux@mailinator.com', 'Dicta sit elit asp', 'In corporis qui sit', NULL, 0, '2025-03-05 02:01:05', '2025-03-05 02:01:05'),
('f8436772-c36b-491c-8781-f9ed42616a9a', 'Hammett Buckley', 'pudonev@mailinator.com', 'Excepteur officia qu', 'Dolore est ut disti', NULL, 0, '2025-03-05 01:55:32', '2025-03-05 01:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `jw_dev_tool_cms_versions`
--

CREATE TABLE `jw_dev_tool_cms_versions` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `changelog` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_dev_tool_cms_versions`
--

INSERT INTO `jw_dev_tool_cms_versions` (`id`, `version`, `description`, `file_path`, `download_url`, `is_active`, `changelog`, `created_at`, `updated_at`) VALUES
(5, '1.0.1', 'desc 1.0.1', 'public/cms/updates/1.0.1/cms-1.0.1.zip', NULL, 1, 'changelog', '2025-03-28 10:15:36', '2025-03-28 10:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `jw_dev_tool_marketplace_plugins`
--

CREATE TABLE `jw_dev_tool_marketplace_plugins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `price` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_dev_tool_marketplace_plugins`
--

INSERT INTO `jw_dev_tool_marketplace_plugins` (`id`, `name`, `title`, `description`, `thumbnail`, `thumbnail_path`, `banner`, `banner_path`, `url`, `file_path`, `is_paid`, `price`, `is_featured`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 'mojarsoft/demo-site', 'mojarsoft', 'desc', NULL, 'public/marketplace/plugins/thumbnails/mojarsoft/demo-site.png', NULL, 'public/marketplace/plugins/banners/mojarsoft/demo-site.jpg', NULL, 'public/marketplace/plugins/mojarsoft/demo-site.zip', 0, NULL, 0, 0, 1, '2025-03-28 10:47:40', '2025-03-28 10:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `jw_dev_tool_marketplace_themes`
--

CREATE TABLE `jw_dev_tool_marketplace_themes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `screenshot` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screenshot_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `price` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_dev_tool_package_versions`
--

CREATE TABLE `jw_dev_tool_package_versions` (
  `id` bigint UNSIGNED NOT NULL,
  `package_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_type` enum('plugin','theme') COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `changelog` text COLLATE utf8mb4_unicode_ci,
  `requires_cms_version` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_dev_tool_package_versions`
--

INSERT INTO `jw_dev_tool_package_versions` (`id`, `package_name`, `package_type`, `version`, `description`, `file_path`, `download_url`, `is_active`, `changelog`, `requires_cms_version`, `created_at`, `updated_at`) VALUES
(5, 'mojarsoft/demo-site', 'plugin', '1.0.1', 'desc', 'public/plugins/updates/mojarsoft_demo-site/1.0.1/mojarsoft_demo-site-1.0.1.zip', NULL, 1, 'dsfgd', '1.0.0', '2025-03-28 10:32:58', '2025-03-28 10:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `jw_discounts`
--

CREATE TABLE `jw_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tbl` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tbl_column` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_ecomm_addons`
--

CREATE TABLE `jw_ecomm_addons` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_url` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `is_premium` tinyint(1) NOT NULL DEFAULT '0',
  `license_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_ecomm_carts`
--

CREATE TABLE `jw_ecomm_carts` (
  `id` bigint UNSIGNED NOT NULL,
  `code` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` json DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_codes` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_target_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_ecomm_carts`
--

INSERT INTO `jw_ecomm_carts` (`id`, `code`, `items`, `user_id`, `discount`, `discount_codes`, `discount_target_type`, `site_id`, `created_at`, `updated_at`) VALUES
(1, '1915fce1-2458-4c04-95ae-694059c8ed5d', '\"{\\\"products_15\\\":{\\\"post_id\\\":15,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":400,\\\"title\\\":\\\"Product 1\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"df32312\\\",\\\"barcode\\\":\\\"3434314\\\",\\\"compare_price\\\":300}}\"', 1, '0.00', NULL, NULL, 0, '2025-02-13 23:59:17', '2025-02-13 23:59:17'),
(2, 'fce979fe-b25b-47d2-89ab-9cb16f9e9790', '\"{\\\"products_15\\\":{\\\"post_id\\\":15,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":400,\\\"title\\\":\\\"Product 1\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"df32312\\\",\\\"barcode\\\":\\\"3434314\\\",\\\"compare_price\\\":300}}\"', 1, '0.00', NULL, NULL, 0, '2025-02-14 00:01:03', '2025-02-14 00:01:03'),
(3, '57badcca-16de-443e-a571-9886e493ba0d', '\"{\\\"products_15\\\":{\\\"post_id\\\":15,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":400,\\\"title\\\":\\\"Product 1\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"df32312\\\",\\\"barcode\\\":\\\"3434314\\\",\\\"compare_price\\\":300}}\"', 1, '0.00', NULL, NULL, 0, '2025-02-14 00:01:18', '2025-02-14 00:01:18'),
(4, '0794eba8-b298-4196-a553-85c8f575a248', '\"{\\\"products_15\\\":{\\\"post_id\\\":15,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":400,\\\"title\\\":\\\"Product 1\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"df32312\\\",\\\"barcode\\\":\\\"3434314\\\",\\\"compare_price\\\":300}}\"', 1, '0.00', NULL, NULL, 0, '2025-02-14 00:02:15', '2025-02-14 00:02:15'),
(5, 'dcdff9e6-e21e-4c34-b5f1-edd06c47cf45', '\"{\\\"products_15\\\":{\\\"post_id\\\":15,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":400,\\\"title\\\":\\\"Product 1\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"df32312\\\",\\\"barcode\\\":\\\"3434314\\\",\\\"compare_price\\\":300}}\"', 1, '0.00', NULL, NULL, 0, '2025-02-14 00:03:40', '2025-02-14 00:03:40'),
(70, '323da9a8-be92-4e5f-877a-47037a9ba630', '\"{\\\"products_15\\\":{\\\"post_id\\\":15,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":1,\\\"price\\\":400,\\\"title\\\":\\\"Product 1\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"df32312\\\",\\\"barcode\\\":\\\"3434314\\\",\\\"compare_price\\\":300}}\"', 1, '0.00', NULL, NULL, 0, '2025-02-24 11:35:29', '2025-02-24 11:35:29'),
(85, '1f21eaea-3556-485e-8e08-947fbbd861e0', '\"{\\\"events_21\\\":{\\\"post_id\\\":21,\\\"type\\\":\\\"events\\\",\\\"quantity\\\":2,\\\"price\\\":900,\\\"title\\\":\\\"Event 2\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"\\\",\\\"barcode\\\":\\\"\\\",\\\"compare_price\\\":0}}\"', 1, '0.00', NULL, NULL, 0, '2025-03-01 22:57:08', '2025-03-01 23:13:08'),
(177, 'a2acaa75-fadc-4398-9f1f-1a5f2c24aa21', '\"{\\\"events_21\\\":{\\\"post_id\\\":21,\\\"type\\\":\\\"events\\\",\\\"quantity\\\":1,\\\"price\\\":400,\\\"title\\\":\\\"Event 2\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\\\",\\\"sku_code\\\":\\\"\\\",\\\"barcode\\\":\\\"\\\",\\\"compare_price\\\":0,\\\"line_price\\\":400},\\\"courses_80\\\":{\\\"post_id\\\":80,\\\"type\\\":\\\"courses\\\",\\\"quantity\\\":1,\\\"price\\\":35,\\\"title\\\":\\\"dfgdfgdf\\\",\\\"thumbnail\\\":\\\"\\\",\\\"sku_code\\\":\\\"\\\",\\\"barcode\\\":\\\"\\\",\\\"compare_price\\\":65,\\\"line_price\\\":35},\\\"courses_82\\\":{\\\"post_id\\\":82,\\\"type\\\":\\\"courses\\\",\\\"quantity\\\":1,\\\"price\\\":0,\\\"title\\\":\\\"fsdfdsfds\\\",\\\"thumbnail\\\":\\\"2025\\\\/03\\\\/06\\\\/features-product-shape01.png\\\",\\\"sku_code\\\":\\\"\\\",\\\"barcode\\\":\\\"\\\",\\\"compare_price\\\":0,\\\"line_price\\\":0},\\\"products_16\\\":{\\\"post_id\\\":16,\\\"type\\\":\\\"products\\\",\\\"quantity\\\":2,\\\"price\\\":500,\\\"title\\\":\\\"Product 2\\\",\\\"thumbnail\\\":\\\"2025\\\\/02\\\\/14\\\\/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg\\\",\\\"sku_code\\\":\\\"qwew32\\\",\\\"barcode\\\":\\\"dfdf\\\",\\\"compare_price\\\":300,\\\"line_price\\\":1000}}\"', 1, '0.00', NULL, NULL, 0, '2025-03-06 23:39:09', '2025-03-29 13:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `jw_ecomm_currencies`
--

CREATE TABLE `jw_ecomm_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` double(8,2) NOT NULL DEFAULT '1.00',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_position` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thousand_separator` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_separator` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_place` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_point` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_format` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_price_format` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_ecomm_currencies`
--

INSERT INTO `jw_ecomm_currencies` (`id`, `code`, `symbol`, `exchange_rate`, `is_default`, `is_enabled`, `name`, `symbol_position`, `thousand_separator`, `decimal_separator`, `decimal_place`, `decimal_point`, `currency_format`, `custom_price_format`, `created_at`, `updated_at`) VALUES
(1, 'BD', '৳', 120.00, 0, 1, 'Taka', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 22:38:01', '2025-04-02 11:50:14'),
(2, 'IN', '₹', 90.00, 0, 1, 'Rupy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-01 22:44:02', '2025-04-02 11:50:14'),
(3, 'PK', 'Rs', 140.00, 0, 1, 'Rupy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-02 09:24:12', '2025-04-02 11:50:14'),
(4, 'Dollar', '$', 1.00, 0, 1, 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 11:21:31', '2025-04-02 11:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `jw_ecom_download_links`
--

CREATE TABLE `jw_ecom_download_links` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_email_lists`
--

CREATE TABLE `jw_email_lists` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `params` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending => processing => (success || error)',
  `priority` int NOT NULL DEFAULT '1',
  `error` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `template_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_email_lists`
--

INSERT INTO `jw_email_lists` (`id`, `email`, `template_id`, `params`, `status`, `priority`, `error`, `data`, `created_at`, `updated_at`, `template_code`) VALUES
(1, 'raad@adsfda.com', NULL, '{\"name\":\"Admin\"}', 'success', 1, NULL, '{\"subject\":\"Send email for Admin\",\"body\":\"Hello Admin, If you receive this email, it means that your config email on Mojar is active.\"}', '2025-04-02 12:10:58', '2025-04-02 12:11:06', 'test_email'),
(2, 'student2@gmail.com', 3, '{\"name\":\"Student 2\",\"email\":\"student2@gmail.com\",\"verifyToken\":\"qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\",\"verifyUrl\":\"http:\\/\\/mojar-cms.test\\/verification\\/student2@gmail.com\\/qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\"}', 'success', 1, NULL, '{\"subject\":\"Verify your account\",\"body\":\"<p>Hello Student 2,<\\/p>\\n<p>Thank you for register. Please click the link below to Verify your account<\\/p>\\n<p><a href=\\\"http:\\/\\/mojar-cms.test\\/verification\\/student2@gmail.com\\/qayuenGjNcLQCmRviVvsxR8Qa6gjxrxc\\\" target=\\\"_blank\\\">Verify account<\\/a><\\/p>\"}', '2025-04-02 12:24:39', '2025-04-02 12:24:44', 'verification');

-- --------------------------------------------------------

--
-- Table structure for table `jw_email_templates`
--

CREATE TABLE `jw_email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `layout` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_hook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `to_sender` tinyint(1) NOT NULL DEFAULT '1',
  `to_emails` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_email_templates`
--

INSERT INTO `jw_email_templates` (`id`, `code`, `subject`, `body`, `params`, `layout`, `created_at`, `updated_at`, `email_hook`, `uuid`, `active`, `to_sender`, `to_emails`) VALUES
(1, 'forgot_password', 'Password Reset for you account', '<p>Someone has requested a password reset for the following account:</p>\r\n<p>Email: {{ email }}</p>\r\n<p>If this was a mistake, just ignore this email and nothing will happen.To reset your password, visit the following address:</p>\r\n<p><a href=\"{{ url }}\" target=\"_blank\">{{ url }}</a></p>', '{\"name\":\"Full Name\",\"email\":\"Email\",\"url\":\"Url reset password\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, '886836c2-c751-4448-9bf4-b7590babf14b', 1, 1, NULL),
(2, 'notification', '{{ subject }}', '{{ body }}', '{\"subject\":\"Subject notify\",\"body\":\"Body notify\",\"name\":\"User name\",\"email\":\"User Email address\",\"url\":\"Url notify\",\"image\":\"Image notify\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, 'fa2b1445-6726-4b94-aee7-17be8282131d', 1, 1, NULL),
(3, 'verification', 'Verify your account', '<p>Hello {{ name }},</p>\r\n<p>Thank you for register. Please click the link below to Verify your account</p>\r\n<p><a href=\"{{ verifyUrl }}\" target=\"_blank\">Verify account</a></p>', '{\"name\":\"Your Name\",\"verifyUrl\":\"Url verify account\"}', NULL, '2024-11-24 19:58:45', '2024-11-24 19:58:45', NULL, '395c245c-5353-475b-b7cb-6a24641a4599', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jw_email_template_users`
--

CREATE TABLE `jw_email_template_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `email_template_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_evman_event_bookings`
--

CREATE TABLE `jw_evman_event_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ticket_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `payment_status` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `quantity` int NOT NULL DEFAULT '1',
  `code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_date` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_evman_event_bookings`
--

INSERT INTO `jw_evman_event_bookings` (`id`, `event_id`, `user_id`, `ticket_id`, `name`, `email`, `phone`, `address`, `city`, `state`, `zip`, `country`, `status`, `payment_method_id`, `payment_status`, `total`, `quantity`, `code`, `booking_date`, `notes`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '1800.00', 2, 'EVT-67C4869D6B0E3', '2025-03-02 10:26:05', NULL, 99, '2025-03-02 10:26:05', '2025-03-02 10:26:05'),
(2, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C4869D6B722', '2025-03-02 10:26:05', NULL, 99, '2025-03-02 10:26:05', '2025-03-02 10:26:05'),
(3, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 2, NULL, '900.00', 1, 'EVT-67C4871788433', '2025-03-02 10:28:07', NULL, 100, '2025-03-02 10:28:07', '2025-03-02 10:28:07'),
(4, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 2, NULL, '900.00', 1, 'EVT-67C579380711B', '2025-03-03 03:41:12', NULL, 101, '2025-03-03 03:41:12', '2025-03-03 03:41:12'),
(5, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, 'adsdasd', NULL, NULL, NULL, NULL, 'pending', 2, NULL, '400.00', 1, 'EVT-67C5793807D8F', '2025-03-03 03:41:12', NULL, 101, '2025-03-03 03:41:12', '2025-03-03 03:41:12'),
(6, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C597D3BFEC0', '2025-03-03 05:51:47', NULL, 102, '2025-03-03 05:51:47', '2025-03-03 05:51:47'),
(7, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C59812C1F28', '2025-03-03 05:52:50', NULL, 103, '2025-03-03 05:52:50', '2025-03-03 05:52:50'),
(8, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5983609546', '2025-03-03 05:53:26', NULL, 104, '2025-03-03 05:53:26', '2025-03-03 05:53:26'),
(9, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5984943C69', '2025-03-03 05:53:45', NULL, 105, '2025-03-03 05:53:45', '2025-03-03 05:53:45'),
(10, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C598808987D', '2025-03-03 05:54:40', NULL, 106, '2025-03-03 05:54:40', '2025-03-03 05:54:40'),
(11, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5988F138AB', '2025-03-03 05:54:55', NULL, 107, '2025-03-03 05:54:55', '2025-03-03 05:54:55'),
(12, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5AB432389D', '2025-03-03 07:14:43', NULL, 108, '2025-03-03 07:14:43', '2025-03-03 07:14:43'),
(13, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5AB5758B8C', '2025-03-03 07:15:03', NULL, 109, '2025-03-03 07:15:03', '2025-03-03 07:15:03'),
(14, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5AB6851609', '2025-03-03 07:15:20', NULL, 110, '2025-03-03 07:15:20', '2025-03-03 07:15:20'),
(15, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5ABBD5833E', '2025-03-03 07:16:45', NULL, 111, '2025-03-03 07:16:45', '2025-03-03 07:16:45'),
(16, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5AC6E2D184', '2025-03-03 07:19:42', NULL, 112, '2025-03-03 07:19:42', '2025-03-03 07:19:42'),
(17, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5ACA5BCCD4', '2025-03-03 07:20:37', NULL, 113, '2025-03-03 07:20:37', '2025-03-03 07:20:37'),
(18, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5ACBBB122B', '2025-03-03 07:20:59', NULL, 114, '2025-03-03 07:20:59', '2025-03-03 07:20:59'),
(19, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5C963AB1E5', '2025-03-03 09:23:15', NULL, 115, '2025-03-03 09:23:15', '2025-03-03 09:23:15'),
(20, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5C9F959EBE', '2025-03-03 09:25:45', NULL, 116, '2025-03-03 09:25:45', '2025-03-03 09:25:45'),
(21, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5CA0B9A748', '2025-03-03 09:26:03', NULL, 117, '2025-03-03 09:26:03', '2025-03-03 09:26:03'),
(22, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5CA5234D0B', '2025-03-03 09:27:14', NULL, 118, '2025-03-03 09:27:14', '2025-03-03 09:27:14'),
(23, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5CA64B0DB0', '2025-03-03 09:27:32', NULL, 119, '2025-03-03 09:27:32', '2025-03-03 09:27:32'),
(24, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5CA9D8A079', '2025-03-03 09:28:29', NULL, 120, '2025-03-03 09:28:29', '2025-03-03 09:28:29'),
(25, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5CC07B104D', '2025-03-03 09:34:31', NULL, 121, '2025-03-03 09:34:31', '2025-03-03 09:34:31'),
(26, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5CC485E7C8', '2025-03-03 09:35:36', NULL, 122, '2025-03-03 09:35:36', '2025-03-03 09:35:36'),
(27, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5CC5935E04', '2025-03-03 09:35:53', NULL, 123, '2025-03-03 09:35:53', '2025-03-03 09:35:53'),
(28, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5CC86BE219', '2025-03-03 09:36:38', NULL, 124, '2025-03-03 09:36:38', '2025-03-03 09:36:38'),
(29, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5CC983519F', '2025-03-03 09:36:56', NULL, 125, '2025-03-03 09:36:56', '2025-03-03 09:36:56'),
(30, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '400.00', 1, 'EVT-67C5CCBED087C', '2025-03-03 09:37:34', NULL, 126, '2025-03-03 09:37:34', '2025-03-03 09:37:34'),
(31, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C5D149A2174', '2025-03-03 09:56:57', NULL, 127, '2025-03-03 09:56:57', '2025-03-03 09:56:57'),
(32, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C680F9C8366', '2025-03-03 22:26:33', NULL, 128, '2025-03-03 22:26:33', '2025-03-03 22:26:33'),
(33, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6820C19D97', '2025-03-03 22:31:08', NULL, 129, '2025-03-03 22:31:08', '2025-03-03 22:31:08'),
(34, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6834448C27', '2025-03-03 22:36:20', NULL, 130, '2025-03-03 22:36:20', '2025-03-03 22:36:20'),
(35, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C683C439376', '2025-03-03 22:38:28', NULL, 131, '2025-03-03 22:38:28', '2025-03-03 22:38:28'),
(36, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C684D6C7EBD', '2025-03-03 22:43:02', NULL, 132, '2025-03-03 22:43:02', '2025-03-03 22:43:02'),
(37, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C685BFF0EF6', '2025-03-03 22:46:55', NULL, 133, '2025-03-03 22:46:55', '2025-03-03 22:46:55'),
(38, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6862592841', '2025-03-03 22:48:37', NULL, 134, '2025-03-03 22:48:37', '2025-03-03 22:48:37'),
(39, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C6865A3DC69', '2025-03-03 22:49:30', NULL, 135, '2025-03-03 22:49:30', '2025-03-03 22:49:30'),
(40, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C68676EB8CA', '2025-03-03 22:49:58', NULL, 136, '2025-03-03 22:49:58', '2025-03-03 22:49:58'),
(41, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C686866DE9E', '2025-03-03 22:50:14', NULL, 137, '2025-03-03 22:50:14', '2025-03-03 22:50:14'),
(42, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6877E2DB7A', '2025-03-03 22:54:22', NULL, 138, '2025-03-03 22:54:22', '2025-03-03 22:54:22'),
(43, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C688DF811F2', '2025-03-03 23:00:15', NULL, 139, '2025-03-03 23:00:15', '2025-03-03 23:00:15'),
(44, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C689179F0E4', '2025-03-03 23:01:11', NULL, 140, '2025-03-03 23:01:11', '2025-03-03 23:01:11'),
(45, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C68A1451790', '2025-03-03 23:05:24', NULL, 141, '2025-03-03 23:05:24', '2025-03-03 23:05:24'),
(46, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C68A8AF3B41', '2025-03-03 23:07:22', NULL, 142, '2025-03-03 23:07:22', '2025-03-03 23:07:22'),
(47, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C68B764835A', '2025-03-03 23:11:18', NULL, 143, '2025-03-03 23:11:18', '2025-03-03 23:11:18'),
(48, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C68C99120C7', '2025-03-03 23:16:09', NULL, 144, '2025-03-03 23:16:09', '2025-03-03 23:16:09'),
(49, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C68D0A94F00', '2025-03-03 23:18:02', NULL, 145, '2025-03-03 23:18:02', '2025-03-03 23:18:02'),
(50, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C68EE6A9218', '2025-03-03 23:25:58', NULL, 146, '2025-03-03 23:25:58', '2025-03-03 23:25:58'),
(51, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C68F7DEDFCA', '2025-03-03 23:28:29', NULL, 147, '2025-03-03 23:28:29', '2025-03-03 23:28:29'),
(52, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C68F905B3D1', '2025-03-03 23:28:48', NULL, 148, '2025-03-03 23:28:48', '2025-03-03 23:28:48'),
(53, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C690E4EEDEE', '2025-03-03 23:34:28', NULL, 149, '2025-03-03 23:34:28', '2025-03-03 23:34:28'),
(54, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C693B25D3D4', '2025-03-03 23:46:26', NULL, 150, '2025-03-03 23:46:26', '2025-03-03 23:46:26'),
(55, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6942E5C600', '2025-03-03 23:48:30', NULL, 151, '2025-03-03 23:48:30', '2025-03-03 23:48:30'),
(56, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6958F7833C', '2025-03-03 23:54:23', NULL, 152, '2025-03-03 23:54:23', '2025-03-03 23:54:23'),
(57, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C69753D56B1', '2025-03-04 00:01:55', NULL, 153, '2025-03-04 00:01:55', '2025-03-04 00:01:55'),
(58, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C69DD23C5D0', '2025-03-04 00:29:38', NULL, 154, '2025-03-04 00:29:38', '2025-03-04 00:29:38'),
(59, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C69EDB00167', '2025-03-04 00:34:03', NULL, 155, '2025-03-04 00:34:03', '2025-03-04 00:34:03'),
(60, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C69F6BE48A8', '2025-03-04 00:36:27', NULL, 156, '2025-03-04 00:36:27', '2025-03-04 00:36:27'),
(61, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6A19E81450', '2025-03-04 00:45:50', NULL, 157, '2025-03-04 00:45:50', '2025-03-04 00:45:50'),
(62, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C6A4A9824B0', '2025-03-04 00:58:49', NULL, 158, '2025-03-04 00:58:49', '2025-03-04 00:58:49'),
(63, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, 'paid', '900.00', 1, 'EVT-67C6A4C5E5AC9', '2025-03-04 00:59:17', NULL, 159, '2025-03-04 00:59:17', '2025-03-04 01:00:48'),
(64, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C6A7A774954', '2025-03-04 01:11:35', NULL, 160, '2025-03-04 01:11:35', '2025-03-04 01:11:35'),
(65, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C6A7D55994A', '2025-03-04 01:12:21', NULL, 161, '2025-03-04 01:12:21', '2025-03-04 01:12:21'),
(66, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C6A87C47D50', '2025-03-04 01:15:08', NULL, 162, '2025-03-04 01:15:08', '2025-03-04 01:15:08'),
(67, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C6A922D8186', '2025-03-04 01:17:54', NULL, 163, '2025-03-04 01:17:54', '2025-03-04 01:17:54'),
(68, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C6A93794B2F', '2025-03-04 01:18:15', NULL, 164, '2025-03-04 01:18:15', '2025-03-04 01:18:15'),
(69, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C6AAB97E182', '2025-03-04 01:24:41', NULL, 165, '2025-03-04 01:24:41', '2025-03-04 01:24:41'),
(70, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C6AB52A8FE9', '2025-03-04 01:27:14', NULL, 166, '2025-03-04 01:27:14', '2025-03-04 01:27:14'),
(71, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, NULL, '900.00', 1, 'EVT-67C6B0582769B', '2025-03-04 01:48:40', NULL, 167, '2025-03-04 01:48:40', '2025-03-04 01:48:40'),
(72, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C6B8678CCA4', '2025-03-04 02:23:03', NULL, 168, '2025-03-04 02:23:03', '2025-03-04 02:23:03'),
(73, 20, 7, NULL, 'adssd', 'customer@botble.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C6B8D51D3E2', '2025-03-04 02:24:53', NULL, 169, '2025-03-04 02:24:53', '2025-03-04 02:24:53'),
(74, 21, 7, NULL, 'adssd', 'customer@botble.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, 'completed', '900.00', 1, 'EVT-67C6BBDA7A892', '2025-03-04 02:37:46', NULL, 170, '2025-03-04 02:37:46', '2025-03-04 02:38:37'),
(75, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, 'completed', '900.00', 1, 'EVT-67C6BE17CFB63', '2025-03-04 02:47:19', NULL, 171, '2025-03-04 02:47:19', '2025-03-04 02:47:56'),
(76, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6C164CB23E', '2025-03-04 03:01:24', NULL, 172, '2025-03-04 03:01:24', '2025-03-04 03:01:24'),
(77, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C6C2313DA41', '2025-03-04 03:04:49', NULL, 173, '2025-03-04 03:04:49', '2025-03-04 03:04:49'),
(78, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6C24D580CB', '2025-03-04 03:05:17', NULL, 174, '2025-03-04 03:05:17', '2025-03-04 03:05:17'),
(79, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6C2708B1B7', '2025-03-04 03:05:52', NULL, 175, '2025-03-04 03:05:52', '2025-03-04 03:05:52'),
(80, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, NULL, '900.00', 1, 'EVT-67C6C354248DA', '2025-03-04 03:09:40', NULL, 176, '2025-03-04 03:09:40', '2025-03-04 03:09:40'),
(81, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 4, 'completed', '900.00', 1, 'EVT-67C6C3FE962F1', '2025-03-04 03:12:30', NULL, 177, '2025-03-04 03:12:30', '2025-03-04 03:13:04'),
(82, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 5, 'completed', '900.00', 1, 'EVT-67C6C655EED13', '2025-03-04 03:22:29', NULL, 178, '2025-03-04 03:22:29', '2025-03-04 03:22:30'),
(83, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 5, 'completed', '900.00', 1, 'EVT-67C6D65E116AB', '2025-03-04 04:30:54', NULL, 179, '2025-03-04 04:30:54', '2025-03-04 04:30:54'),
(84, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '900.00', 1, 'EVT-67C6E05B9862C', '2025-03-04 05:13:31', NULL, 180, '2025-03-04 05:13:31', '2025-03-04 05:13:31'),
(85, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C6E05B98F84', '2025-03-04 05:13:31', NULL, 180, '2025-03-04 05:13:31', '2025-03-04 05:13:31'),
(86, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C6E117A8A74', '2025-03-04 05:16:39', NULL, 181, '2025-03-04 05:16:39', '2025-03-04 05:16:39'),
(87, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 5, 'completed', '400.00', 1, 'EVT-67C6E6EC4992E', '2025-03-04 05:41:32', NULL, 182, '2025-03-04 05:41:32', '2025-03-04 05:41:33'),
(88, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, 'completed', '400.00', 1, 'EVT-67C6E81849841', '2025-03-04 05:46:32', NULL, 183, '2025-03-04 05:46:32', '2025-03-04 05:47:02'),
(89, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C6E8A78D230', '2025-03-04 05:48:55', NULL, 184, '2025-03-04 05:48:55', '2025-03-04 05:48:55'),
(90, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, 'completed', '400.00', 1, 'EVT-67C6E8D07A0CA', '2025-03-04 05:49:36', NULL, 185, '2025-03-04 05:49:36', '2025-03-04 05:51:43'),
(91, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 1, NULL, '400.00', 1, 'EVT-67C6E972CC4EE', '2025-03-04 05:52:18', NULL, 186, '2025-03-04 05:52:18', '2025-03-04 05:52:18'),
(92, 21, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 5, 'completed', '1800.00', 2, 'EVT-67C7025109386', '2025-03-04 07:38:25', NULL, 187, '2025-03-04 07:38:25', '2025-03-04 07:38:25'),
(93, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 3, 'completed', '400.00', 1, 'EVT-67C7028F94AAA', '2025-03-04 07:39:27', NULL, 188, '2025-03-04 07:39:27', '2025-03-04 07:39:49'),
(94, 20, 1, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 5, 'completed', '0.00', 1, 'EVT-67CA8989E8235', '2025-03-06 23:52:09', NULL, 189, '2025-03-06 23:52:09', '2025-03-06 23:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `jw_evman_event_tickets`
--

CREATE TABLE `jw_evman_event_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(15,2) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `min_ticket_number` int DEFAULT NULL,
  `max_ticket_number` int DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_evman_event_tickets`
--

INSERT INTO `jw_evman_event_tickets` (`id`, `name`, `description`, `price`, `capacity`, `status`, `min_ticket_number`, `max_ticket_number`, `start_date`, `end_date`, `event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Ticket', 'Event 2', '400.00', 10, 'active', 1, 3, '2025-03-05 16:03:00', '2025-03-06 16:04:00', 21, NULL, '2025-03-05 10:04:05', '2025-03-05 10:04:05'),
(2, 'fafda', 'content', NULL, NULL, 'active', NULL, NULL, NULL, NULL, 20, NULL, '2025-03-05 10:07:56', '2025-03-05 10:07:56'),
(3, 'Eve Sherman', '', '596.00', 74, 'active', 310, 299, '1980-11-16 11:47:00', '2004-07-28 12:52:00', 28, NULL, '2025-03-19 04:44:12', '2025-03-19 04:44:12'),
(4, 'Ticket 1', '', '30.00', 20, 'active', 1, 3, '2025-04-03 19:19:00', '2025-04-04 19:19:00', 132, NULL, '2025-04-02 13:19:13', '2025-04-02 13:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `jw_failed_jobs`
--

CREATE TABLE `jw_failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_jobs`
--

CREATE TABLE `jw_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_jw_translations`
--

CREATE TABLE `jw_jw_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `locale` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `namespace` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `object_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `object_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `jw_languages`
--

CREATE TABLE `jw_languages` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_languages`
--

INSERT INTO `jw_languages` (`id`, `code`, `name`, `default`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 1, '2025-02-28 06:41:01', '2025-02-28 06:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `jw_language_lines`
--

CREATE TABLE `jw_language_lines` (
  `id` bigint UNSIGNED NOT NULL,
  `namespace` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `object_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_key` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_lms_course_lessons`
--

CREATE TABLE `jw_lms_course_lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `order` int NOT NULL DEFAULT '0',
  `type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'video',
  `duration` int NOT NULL DEFAULT '0',
  `metas` json DEFAULT NULL,
  `content_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_video_path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `course_topic_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_lms_course_lessons`
--

INSERT INTO `jw_lms_course_lessons` (`id`, `title`, `slug`, `thumbnail`, `description`, `status`, `order`, `type`, `duration`, `metas`, `content_url`, `local_video_path`, `post_id`, `course_topic_id`, `created_at`, `updated_at`) VALUES
(1, 'lesson title 1', 'lesson-title-1', '2025/03/07/paypal.png', 'asdasd', 'publish', 0, 'video', 400, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 1, '2025-03-22 04:31:11', '2025-03-22 05:53:37'),
(2, 'lesson title 2', 'lesson-title-2', '2025/03/06/features-product-shape01.png', 'desc', 'publish', 0, 'audio', 30, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 1, '2025-03-22 09:23:08', '2025-03-22 09:23:34'),
(3, 'lesson title 3', 'lesson-title-3', NULL, 'desc', 'publish', 0, 'audio', 30, NULL, 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, NULL, 1, '2025-03-22 10:25:40', '2025-03-22 10:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `jw_lms_course_topics`
--

CREATE TABLE `jw_lms_course_topics` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `order` int NOT NULL DEFAULT '0',
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_lms_course_topics`
--

INSERT INTO `jw_lms_course_topics` (`id`, `title`, `slug`, `thumbnail`, `description`, `status`, `order`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'Topic', 'topic', NULL, 'Desc', 'publish', 0, 82, '2025-03-22 04:30:48', '2025-03-22 04:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `jw_manual_notifications`
--

CREATE TABLE `jw_manual_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `method` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `error` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_manual_notifications`
--

INSERT INTO `jw_manual_notifications` (`id`, `method`, `users`, `data`, `status`, `error`, `created_at`, `updated_at`) VALUES
(1, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-02 07:18:27', '2025-03-02 07:18:28'),
(2, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-06 00:36:00', '2025-03-06 00:36:00'),
(3, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-06 00:41:25', '2025-03-06 00:41:25'),
(4, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-06 22:43:39', '2025-03-06 22:43:40'),
(5, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-07 09:46:17', '2025-03-07 09:46:17'),
(6, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-07 09:50:24', '2025-03-07 09:50:24'),
(7, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-07 09:50:54', '2025-03-07 09:50:54'),
(8, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-07 09:52:08', '2025-03-07 09:52:08'),
(9, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-08 01:18:34', '2025-03-08 01:18:34'),
(10, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-24 11:07:52', '2025-03-24 11:07:52'),
(11, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-24 11:08:35', '2025-03-24 11:08:35'),
(12, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-24 11:09:51', '2025-03-24 11:09:51'),
(13, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-24 11:27:23', '2025-03-24 11:27:23'),
(14, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-25 12:20:23', '2025-03-25 12:20:23'),
(15, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-29 02:05:36', '2025-03-29 02:05:40'),
(16, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-03-29 10:46:28', '2025-03-29 10:46:29'),
(17, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-04-03 10:54:56', '2025-04-03 10:54:56'),
(18, 'database', '1', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', 1, NULL, '2025-04-04 12:37:35', '2025-04-04 12:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `jw_media_files`
--

CREATE TABLE `jw_media_files` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `mime_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint NOT NULL DEFAULT '0',
  `folder_id` bigint DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `metadata` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_media_files`
--

INSERT INTO `jw_media_files` (`id`, `name`, `type`, `mime_type`, `path`, `extension`, `size`, `folder_id`, `user_id`, `created_at`, `updated_at`, `disk`, `metadata`) VALUES
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
(62, 'th.jpg', 'image', 'image/jpeg', '2025/04/03/th-1.jpg', 'jpg', 12890, NULL, 8, '2025-04-03 12:14:35', '2025-04-03 12:14:35', 'public', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jw_media_folders`
--

CREATE TABLE `jw_media_folders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `folder_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_media_folders`
--

INSERT INTO `jw_media_folders` (`id`, `name`, `type`, `folder_id`, `created_at`, `updated_at`, `disk`) VALUES
(1, 'new folder', 'file', NULL, '2025-01-26 11:36:26', '2025-01-26 11:36:26', 'public'),
(2, 'adsds', 'file', NULL, '2025-01-26 11:36:53', '2025-01-26 11:36:53', 'public'),
(3, 'BDT-taka', 'file', NULL, '2025-01-26 11:44:54', '2025-01-26 11:44:54', 'public'),
(4, 'dsds', 'file', NULL, '2025-01-26 11:48:52', '2025-01-26 11:48:52', 'public'),
(5, 'dasdas', 'file', NULL, '2025-01-26 11:50:32', '2025-01-26 11:50:32', 'public'),
(6, 'sssfdsfd', 'file', 2, '2025-01-26 11:52:31', '2025-01-26 11:52:31', 'public'),
(7, 'vcvxc', 'file', 2, '2025-01-26 12:07:19', '2025-01-26 12:07:19', 'public'),
(8, 'new-things', 'file', NULL, '2025-01-26 13:00:27', '2025-01-26 13:00:27', 'public'),
(9, 'new-things', 'file', NULL, '2025-01-26 13:00:27', '2025-01-26 13:00:27', 'public'),
(10, 'cxczx', 'image', NULL, '2025-03-06 04:40:55', '2025-03-06 04:40:55', 'public'),
(11, 'faadf', 'image', 10, '2025-03-06 04:41:17', '2025-03-06 04:41:17', 'public'),
(12, 'fadfd', 'image', NULL, '2025-03-06 05:06:42', '2025-03-06 05:06:42', 'public'),
(13, 'dasdsa', 'image', NULL, '2025-03-06 05:07:04', '2025-03-06 05:07:04', 'public'),
(14, 'gfg', 'image', NULL, '2025-03-06 05:07:48', '2025-03-06 05:07:48', 'public'),
(15, 'fdfd', 'image', NULL, '2025-03-06 05:09:16', '2025-03-06 05:09:16', 'public'),
(16, 'dasdsd', 'image', NULL, '2025-03-06 05:11:54', '2025-03-06 05:11:54', 'public'),
(17, 'bxbcv', 'image', 9, '2025-03-06 07:04:06', '2025-03-06 07:04:06', 'public'),
(18, 'dasdsad', 'image', 9, '2025-03-06 07:12:50', '2025-03-06 07:12:50', 'public'),
(19, 'asdasdas', 'image', 9, '2025-03-06 07:13:18', '2025-03-06 07:13:18', 'public'),
(20, 'asdasdsa', 'image', 9, '2025-03-06 07:13:45', '2025-03-06 07:13:45', 'public'),
(21, 'adsdasd', 'image', 9, '2025-03-06 07:14:22', '2025-03-06 07:14:22', 'public'),
(22, 'dasdsa', 'image', 9, '2025-03-06 07:15:12', '2025-03-06 07:15:12', 'public'),
(23, 'dsdsad', 'image', 9, '2025-03-06 07:18:33', '2025-03-06 07:18:33', 'public'),
(24, 'adsd', 'image', NULL, '2025-03-06 07:21:15', '2025-03-06 07:21:15', 'public'),
(25, 'dadasd', 'image', NULL, '2025-03-06 07:21:49', '2025-03-06 07:21:49', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `jw_menus`
--

CREATE TABLE `jw_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_menus`
--

INSERT INTO `jw_menus` (`id`, `name`, `description`, `created_at`, `updated_at`, `uuid`) VALUES
(11, 'Menu 1 test', NULL, '2025-01-28 12:18:15', '2025-01-28 12:18:15', '84ba77ce-7feb-44bb-94c1-02178ca41482'),
(12, 'fcgjvb', NULL, '2025-02-01 12:30:46', '2025-02-01 12:30:46', 'a6be2487-7db7-4d24-bc46-65113d84c726');

-- --------------------------------------------------------

--
-- Table structure for table `jw_menu_items`
--

CREATE TABLE `jw_menu_items` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `box_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_class` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint DEFAULT NULL,
  `link` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `num_order` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_menu_items`
--

INSERT INTO `jw_menu_items` (`id`, `menu_id`, `parent_id`, `box_key`, `label`, `model_class`, `model_id`, `link`, `icon`, `target`, `num_order`) VALUES
(1, 11, NULL, 'post_type_pages', 'Home2', 'Juzaweb\\Backend\\Models\\Post', 8, NULL, NULL, '_self', 1),
(2, 11, NULL, 'post_type_pages', 'dsdsds', 'Juzaweb\\Backend\\Models\\Post', 9, NULL, NULL, '_self', 2),
(3, 11, NULL, 'post_type_pages', 'home3', 'Juzaweb\\Backend\\Models\\Post', 10, NULL, NULL, '_self', 3),
(4, 11, NULL, 'post_type_pages', 'home', 'Juzaweb\\Backend\\Models\\Post', 11, NULL, NULL, '_self', 4),
(5, 11, NULL, 'post_type_pages', 'Somthing', 'Juzaweb\\Backend\\Models\\Post', 12, NULL, NULL, '_self', 5),
(6, 11, NULL, 'post_type_pages', 'Courses', 'Juzaweb\\Backend\\Models\\Post', 122, NULL, NULL, '_self', 6);

-- --------------------------------------------------------

--
-- Table structure for table `jw_migrations`
--

CREATE TABLE `jw_migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_migrations`
--

INSERT INTO `jw_migrations` (`id`, `migration`, `batch`) VALUES
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
-- Table structure for table `jw_model_has_permissions`
--

CREATE TABLE `jw_model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_model_has_roles`
--

CREATE TABLE `jw_model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_notifications`
--

CREATE TABLE `jw_notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `notifiable_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_notifications`
--

INSERT INTO `jw_notifications` (`id`, `type`, `data`, `read_at`, `notifiable_type`, `notifiable_id`, `created_at`, `updated_at`) VALUES
('0090267c-f2bb-44a9-98ca-311f4d5c7d70', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-29 02:05:40', '2025-03-29 02:05:40'),
('093824c2-de08-422e-beed-d0d8643f3911', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-03-06 22:43:40', '2025-03-06 22:43:40'),
('0d6a3832-a91f-4498-a2d1-99e642d13bfa', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-04-03 10:54:56', '2025-04-03 10:54:56'),
('4421492a-114f-42d8-ab1f-0c8020e8e18e', 'Juzaweb\\CMS\\Support\\Notifications\\DbNotify', '{\"subject\":\"New Version CMS Available !\",\"body\":\"CMS has a new version, update now!\",\"url\":\"http:\\/\\/mojar-cms.test\\/app\\/updates\",\"image\":null}', NULL, 'Juzaweb\\CMS\\Models\\User', 1, '2025-04-04 12:37:37', '2025-04-04 12:37:37'),
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
-- Table structure for table `jw_oauth_access_tokens`
--

CREATE TABLE `jw_oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_oauth_auth_codes`
--

CREATE TABLE `jw_oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_oauth_clients`
--

CREATE TABLE `jw_oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_oauth_personal_access_clients`
--

CREATE TABLE `jw_oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_oauth_refresh_tokens`
--

CREATE TABLE `jw_oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_orders`
--

CREATE TABLE `jw_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `token` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ecommerce',
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivery_status` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `country_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_codes` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `payment_method_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `site_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_orders`
--

INSERT INTO `jw_orders` (`id`, `token`, `code`, `title`, `type`, `status`, `payment_status`, `delivery_status`, `name`, `email`, `phone`, `address`, `country_code`, `quantity`, `total_price`, `total`, `discount`, `discount_codes`, `payment_method_id`, `payment_method_name`, `notes`, `user_id`, `site_id`, `created_at`, `updated_at`) VALUES
(8, 'fb9f6707-bc07-45ae-b508-3c1a4bebfb1a', '202502151550321', 'Order #202502151550321', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-15 09:50:32', '2025-02-15 09:50:32'),
(9, 'fcf1f3f0-aaa7-4e6f-b8e4-e74de0de8f8a', '202502151555321', 'Order #202502151555321', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-15 09:55:32', '2025-02-15 09:55:32'),
(10, 'a116d37d-9522-4b12-83f2-4e4388ba7127', '202502151608001', 'Order #202502151608001', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-15 10:08:00', '2025-02-15 10:08:00'),
(11, '77667b04-7381-4e92-b9da-cfc2c594e8e6', '202502161338351', 'Order #202502161338351', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-16 07:38:35', '2025-02-16 07:38:35'),
(12, 'f287cdaf-e910-493c-bea6-c78230437e2f', '202502191356451', 'Order #202502191356451', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-19 07:56:45', '2025-02-19 07:56:45'),
(13, '2b12563f-1556-4df0-8262-9a16ceb671e6', '202502210457151', 'Order #202502210457151', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-20 22:57:17', '2025-02-20 22:57:17'),
(14, '839636ce-5a7d-4d2d-8e09-e1964b287dfc', '202502210500371', 'Order #202502210500371', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-20 23:00:37', '2025-02-20 23:00:37'),
(15, 'a8cfd851-402c-4446-b61e-e333d7c9af1e', '202502210501491', 'Order #202502210501491', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-20 23:01:49', '2025-02-20 23:01:49'),
(16, 'd96284ee-7682-455a-9d27-6e0b3472f621', '202502211658121', 'Order #202502211658121', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-21 10:58:15', '2025-02-21 10:58:15'),
(17, 'e4b7adb4-5057-4189-936f-e9f585ddff10', '202502211659161', 'Order #202502211659161', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-21 10:59:16', '2025-02-21 10:59:16'),
(18, '0fb17925-b368-4443-a71f-0f82868fc53a', '202502211732501', 'Order #202502211732501', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-21 11:32:50', '2025-02-21 11:32:50'),
(19, 'd2d83528-6284-439a-9a50-f93d53f16aed', '202502211734061', 'Order #202502211734061', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-21 11:34:06', '2025-02-21 11:34:06'),
(20, '47384a55-e496-4039-9445-e5617f3e2f37', '202502211736341', 'Order #202502211736341', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-21 11:36:34', '2025-02-21 11:36:34'),
(21, '1884db9c-bee0-4194-9700-d69ace162bbf', '202502211737581', 'Order #202502211737581', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', 'gfgjhb', 1, NULL, '2025-02-21 11:37:58', '2025-02-21 11:37:58'),
(22, '0af25462-cfaa-4445-97ed-c0026a31c29b', '202502211740351', 'Order #202502211740351', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-21 11:40:35', '2025-02-21 11:40:35'),
(23, '9e92a26d-4fec-4be6-ac09-d087e3d25537', '202502221441021', 'Order #202502221441021', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-22 08:41:02', '2025-02-22 08:41:02'),
(24, '7eddb81e-470e-4555-9c39-adc75f14e2c6', '202502221443131', 'Order #202502221443131', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-22 08:43:13', '2025-02-22 08:43:13'),
(25, 'a3faa469-f0b8-4587-86a9-cf1e674c7b99', '202502221444271', 'Order #202502221444271', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-22 08:44:27', '2025-02-22 08:44:27'),
(26, '50a4b99a-5027-4e3c-a029-c7c7c0f5d4c3', '202502221446271', 'Order #202502221446271', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', 'dsds', 1, NULL, '2025-02-22 08:46:27', '2025-02-22 08:46:27'),
(27, '672317aa-0e4f-4960-b59b-1cf72bbc1bc3', '202502221456241', 'Order #202502221456241', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-22 08:56:24', '2025-02-22 08:56:24'),
(28, 'e2a7727a-009a-4516-8367-98ea7778872e', '202502221522281', 'Order #202502221522281', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-22 09:22:28', '2025-02-22 09:22:28'),
(29, '62d404c2-102b-46eb-8f2c-45c4be91b6dd', '202502221736541', 'Order #202502221736541', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-22 11:36:54', '2025-02-22 11:36:54'),
(30, '36a23b87-9b5c-49f2-862d-2e2cc6dbf27a', '202502231423011', 'Order #202502231423011', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-23 08:23:03', '2025-02-23 08:23:03'),
(31, 'b7f862ed-df93-4540-803d-6ca69270c089', '202502231658011', 'Order #202502231658011', 'ecommerce', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 5, NULL, '2025-02-23 10:58:01', '2025-02-23 10:58:01'),
(32, 'd594acd0-615e-4029-9f45-4216abc03b6a', '202502240211321', 'Order #202502240211321', 'ecommerce', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 5, NULL, '2025-02-23 20:11:36', '2025-02-23 20:11:36'),
(33, '5fd0ccbe-2ecc-44ac-ae85-68e57ac7891f', '202502240213481', 'Order #202502240213481', 'ecommerce', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 5, NULL, '2025-02-23 20:13:48', '2025-02-23 20:13:48'),
(34, '0ed56fc3-b641-43ef-b3a8-f8ef5d252d88', '202502240217441', 'Order #202502240217441', 'ecommerce', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 5, NULL, '2025-02-23 20:17:44', '2025-02-23 20:17:44'),
(35, 'a328723f-3a4f-4942-9394-254139566498', '202502240220181', 'Order #202502240220181', 'ecommerce', 'pending', 'pending', 'pending', 'dfdf', 'mojahidgenius48@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 6, NULL, '2025-02-23 20:20:18', '2025-02-23 20:20:18'),
(36, 'fd0eeccf-24b6-4a27-96cc-6bb39e7e16ab', '202502240223501', 'Order #202502240223501', 'ecommerce', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 5, NULL, '2025-02-23 20:23:50', '2025-02-23 20:23:50'),
(37, 'bfd91928-1033-42a0-82aa-f1e47b09c4ed', '202502241527311', 'Order #202502241527311', 'ecommerce', 'pending', 'pending', 'pending', 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 5, NULL, '2025-02-24 09:27:33', '2025-02-24 09:27:33'),
(38, 'a5b30ab8-b6e8-4955-8dc2-d5be2254b945', '202502241529131', 'Order #202502241529131', 'ecommerce', 'pending', 'pending', 'pending', 'dfdf', 'mojahidgenius48@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 6, NULL, '2025-02-24 09:29:13', '2025-02-24 09:29:13'),
(39, 'ba033625-de63-4de6-ac48-bae01693e6ce', '202502241540581', 'Order #202502241540581', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 09:40:58', '2025-02-24 09:40:58'),
(40, '64b90e79-3698-47e5-b8b7-17981d38b483', '202502241547261', 'Order #202502241547261', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 09:47:26', '2025-02-24 09:47:26'),
(41, '08c762c3-0848-4b80-8377-06364a7e453c', '202502241549031', 'Order #202502241549031', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 09:49:03', '2025-02-24 09:49:03'),
(42, '9cdea5ce-1a1e-48ea-bea1-2a9ad0e8bf8b', '202502241550071', 'Order #202502241550071', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 09:50:07', '2025-02-24 09:50:07'),
(43, '41ba87cc-5875-470b-9209-5146a14f69b5', '202502241624091', 'Order #202502241624091', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:24:09', '2025-02-24 10:24:09'),
(44, 'c15f23c6-0bc3-45d1-b82e-1b092fc21b8d', '202502241625371', 'Order #202502241625371', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 10:25:37', '2025-02-24 10:25:37'),
(45, '6ff12a7c-d2b9-4a9d-9aca-431379a46c0a', '202502241626411', 'Order #202502241626411', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:26:41', '2025-02-24 10:26:41'),
(46, '00fdd983-81a1-4b6e-a6a6-236b821ba695', '202502241627531', 'Order #202502241627531', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:27:53', '2025-02-24 10:27:53'),
(47, '073c987b-3b45-4ff3-ac71-5960b4d61159', '202502241630031', 'Order #202502241630031', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:30:03', '2025-02-24 10:30:03'),
(48, '2a4b0040-7a0c-43d7-9207-b990ef77b0c0', '202502241632271', 'Order #202502241632271', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:32:27', '2025-02-24 10:32:27'),
(49, 'f5aa01f1-243b-4e56-b8d1-c9c66e34ad64', '202502241634401', 'Order #202502241634401', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:34:40', '2025-02-24 10:34:40'),
(50, '5cd63ca4-4d9d-4376-818d-038c36bf688c', '202502241640291', 'Order #202502241640291', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:40:29', '2025-02-24 10:40:29'),
(51, '05e88f17-f426-4740-bd4e-bdacf891d6cc', '202502241647191', 'Order #202502241647191', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:47:19', '2025-02-24 10:47:19'),
(52, '514c25bf-f73c-49d7-ba88-ce474051fa81', '202502241649391', 'Order #202502241649391', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:49:39', '2025-02-24 10:49:39'),
(53, '016a7555-6a33-4ce8-9f74-86f611e18605', '202502241651241', 'Order #202502241651241', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:51:24', '2025-02-24 10:51:24'),
(54, '73270e13-53e4-4bb1-bab1-58aaa28aafab', '202502241654201', 'Order #202502241654201', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:54:20', '2025-02-24 10:54:20'),
(55, '74f01343-9e9a-4734-8a8b-824258d4534e', '202502241654541', 'Order #202502241654541', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 10:54:54', '2025-02-24 10:54:54'),
(56, 'aee97f67-1a46-4f28-9f4c-0b6738f1dcde', '202502241658101', 'Order #202502241658101', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 10:58:11', '2025-02-24 10:58:11'),
(57, 'f50636ff-5602-4cd3-8449-4436ce9f5ec0', '202502241705351', 'Order #202502241705351', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 11:05:35', '2025-02-24 11:05:35'),
(58, 'a2a34082-92c7-474e-be0a-764b5a650d0d', '202502241708131', 'Order #202502241708131', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 11:08:13', '2025-02-24 11:08:13'),
(59, '6d57f5ea-111e-4fea-b0f3-b5a12fd3e087', '202502241711101', 'Order #202502241711101', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 11:11:10', '2025-02-24 11:11:10'),
(60, '8654ccaf-24b4-4e44-8b8f-2cf05db16fac', '202502241712411', 'Order #202502241712411', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 11:12:41', '2025-02-24 11:12:41'),
(61, 'faf0163d-2a10-49c8-8352-7f12a5244172', '202502241713201', 'Order #202502241713201', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 11:13:20', '2025-02-24 11:13:20'),
(62, '2a14f4f5-8379-4930-b26d-f764eca21789', '202502241718031', 'Order #202502241718031', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:18:04', '2025-02-24 11:18:04'),
(63, '3c7f9258-6a99-44a7-b4bd-a7edfcd9c127', '202502241718471', 'Order #202502241718471', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:18:47', '2025-02-24 11:18:47'),
(64, '0b6c458f-eb65-47ad-95a0-07519d5ebd41', '202502241720321', 'Order #202502241720321', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 11:20:32', '2025-02-24 11:20:32'),
(65, '9baafe77-4f6c-4106-bbd3-fb355903e831', '202502241720581', 'Order #202502241720581', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:20:58', '2025-02-24 11:20:58'),
(66, '7f9f3726-2638-41a3-b569-411d516e00d3', '202502241722451', 'Order #202502241722451', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:22:45', '2025-02-24 11:22:45'),
(67, 'a687a7b6-915f-4910-ad4e-5550c5efb822', '202502241727411', 'Order #202502241727411', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:27:41', '2025-02-24 11:27:41'),
(68, '4dd1457a-ee47-44f7-8ebc-18186d5f189e', '202502241729291', 'Order #202502241729291', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:29:29', '2025-02-24 11:29:29'),
(69, 'f50a3cbd-8659-4f5d-9b36-63088fd9ed2f', '202502241734191', 'Order #202502241734191', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:34:19', '2025-02-24 11:34:19'),
(70, '0eb660bf-78ad-4f96-bd5e-a91f9e89addb', '202502241735181', 'Order #202502241735181', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-02-24 11:35:18', '2025-02-24 11:35:18'),
(71, 'd375319a-798e-4d24-a3f9-0463e64ece9b', '202502241735461', 'Order #202502241735461', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:35:46', '2025-02-24 11:35:46'),
(72, 'f4ecfeae-edd0-4da9-a942-d2de4f8dc458', '202502241749171', 'Order #202502241749171', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:49:17', '2025-02-24 11:49:17'),
(73, 'c78312c4-6c8f-43d4-90fd-11370b3d8199', '202502241750081', 'Order #202502241750081', 'ecommerce', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-02-24 11:50:08', '2025-02-24 11:50:08'),
(74, '432a395e-bb46-4df9-98b1-e1418e43f9a4', '202502270201341', 'Order #202502270201341', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-26 20:01:38', '2025-02-26 20:01:38'),
(76, 'fdd965a7-34d6-46f9-89cb-23fdabde5a5b', '202502270212301', 'Order #202502270212301', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-26 20:12:30', '2025-02-26 20:12:30'),
(78, '32db6f1d-fe34-43e9-963b-70bab2df4dbe', '202502270216211', 'Order #202502270216211', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-26 20:16:21', '2025-02-26 20:16:21'),
(79, '7ed6fdc9-16a0-40a5-acfc-c53de47a09d4', '202502270217441', 'Order #202502270217441', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-26 20:17:44', '2025-02-26 20:17:44'),
(82, '9cbbf6c3-73f1-4d45-a3be-5021d55ee682', '202502281242361', 'Order #202502281242361', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 3, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-28 06:42:38', '2025-02-28 06:42:38'),
(87, 'a8b1b465-b1f2-45c4-91f3-6a361ae8e7dc', '202503010340381', 'Order #202503010340381', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 3, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-28 21:40:38', '2025-02-28 21:40:38'),
(88, 'b867fc71-c59a-4077-b31b-2c3ffc78ee1f', '202503010342141', 'Order #202503010342141', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-02-28 21:42:14', '2025-02-28 21:42:14'),
(95, 'e8574641-3c6a-43cf-abd6-1941a857eb7f', '202503011142101', 'Order #202503011142101', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-01 05:42:10', '2025-03-01 05:42:10'),
(96, '33a78868-0503-4cbc-962a-d3fa24ea4c10', '202503011145081', 'Order #202503011145081', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-03-01 05:45:08', '2025-03-01 05:45:08'),
(97, '369a39ce-900d-487d-ba14-518b3f4108bc', '202503011323171', 'Order #202503011323171', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-01 07:23:17', '2025-03-01 07:23:17'),
(98, '82e61139-2739-48f5-9093-d0b963847aa2', '202503011325291', 'Order #202503011325291', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-01 07:25:29', '2025-03-01 07:25:29'),
(99, 'c00a62c1-ef8b-4054-a827-3ab2faa3390c', '202503021626051', 'Order #202503021626051', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 3, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-02 10:26:05', '2025-03-02 10:26:05'),
(100, '00c62ba2-7fc0-45b0-a460-8e7f5fd19fb4', '202503021628071', 'Order #202503021628071', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-03-02 10:28:07', '2025-03-02 10:28:07'),
(101, 'fdb2c545-2fbd-4846-babc-0b24634acc3f', '202503030941121', 'Order #202503030941121', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '0.00', '0.00', '0.00', NULL, 2, 'fgf', NULL, 1, NULL, '2025-03-03 03:41:12', '2025-03-03 03:41:12'),
(102, '9d2db447-b94e-46d2-9833-4d8f0a4f23a2', '202503031151471', 'Order #202503031151471', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 05:51:47', '2025-03-03 05:51:47'),
(103, '60c076ac-a86b-4156-aa56-65a50111f394', '202503031152501', 'Order #202503031152501', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 05:52:50', '2025-03-03 05:52:50'),
(104, 'f3737071-3649-40e3-a322-1f189506292f', '202503031153261', 'Order #202503031153261', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 05:53:26', '2025-03-03 05:53:26'),
(105, '7c947a3f-462a-481d-ab4a-ca413ae5d16e', '202503031153451', 'Order #202503031153451', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 05:53:45', '2025-03-03 05:53:45'),
(106, 'ffcf95c5-1bb1-4358-99b5-d0d97321bef1', '202503031154401', 'Order #202503031154401', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 05:54:40', '2025-03-03 05:54:40'),
(107, '6e90870d-022f-4229-b849-c4423221e4f8', '202503031154551', 'Order #202503031154551', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 05:54:55', '2025-03-03 05:54:55'),
(108, 'a9229f37-cc5b-4950-9c74-2ce8d4187a4e', '202503031314431', 'Order #202503031314431', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 07:14:43', '2025-03-03 07:14:43'),
(109, '9e8270ef-7f6a-4961-b311-ea9537e41fd7', '202503031315031', 'Order #202503031315031', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 07:15:03', '2025-03-03 07:15:03'),
(110, 'd4bee846-17af-4da7-b30e-e7aafcb73970', '202503031315201', 'Order #202503031315201', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 07:15:20', '2025-03-03 07:15:20'),
(111, '10bb837d-05fc-46a0-9d3d-da7e630ae638', '202503031316451', 'Order #202503031316451', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 07:16:45', '2025-03-03 07:16:45'),
(112, '44932046-aca6-4a6b-b648-19aa858ef4db', '202503031319421', 'Order #202503031319421', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 07:19:42', '2025-03-03 07:19:42'),
(113, '1fec8001-8aad-4afb-9af8-356d516bdf81', '202503031320371', 'Order #202503031320371', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 07:20:37', '2025-03-03 07:20:37'),
(114, '98d2191e-220e-42ab-8646-a90ee9fd34c3', '202503031320591', 'Order #202503031320591', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 07:20:59', '2025-03-03 07:20:59'),
(115, '2ee3f3fe-6d2c-4ae2-abe7-eb6909404d72', '202503031523151', 'Order #202503031523151', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:23:15', '2025-03-03 09:23:15'),
(116, 'c574c6a9-88f8-4cb3-8a92-f54d7f9ea7f6', '202503031525451', 'Order #202503031525451', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 09:25:45', '2025-03-03 09:25:45'),
(117, '1fcf8427-58e6-47c8-a770-52e5ea9e34b5', '202503031526031', 'Order #202503031526031', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:26:03', '2025-03-03 09:26:03'),
(118, '09607629-4b20-4337-b7ac-ff8e0d0b7f8c', '202503031527141', 'Order #202503031527141', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 09:27:14', '2025-03-03 09:27:14'),
(119, '30ed28a9-5256-4cab-8f27-475b1d17e621', '202503031527321', 'Order #202503031527321', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:27:32', '2025-03-03 09:27:32'),
(120, '939f2f83-247b-451e-b9ae-9501f4143710', '202503031528291', 'Order #202503031528291', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:28:29', '2025-03-03 09:28:29'),
(121, '8dd76de9-5e85-4a8b-a311-d1e2f218288e', '202503031534311', 'Order #202503031534311', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:34:31', '2025-03-03 09:34:31'),
(122, '517bcd02-af59-4ac9-b3be-947ffd4f6d31', '202503031535361', 'Order #202503031535361', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 09:35:36', '2025-03-03 09:35:36'),
(123, '2f899adf-b382-4b53-9e10-aa0e28020c71', '202503031535531', 'Order #202503031535531', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:35:53', '2025-03-03 09:35:53'),
(124, '219357b8-8740-47d9-9edc-13de82e87792', '202503031536381', 'Order #202503031536381', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 09:36:38', '2025-03-03 09:36:38'),
(125, '8605799f-f216-4010-9a70-fe041da2ac42', '202503031536561', 'Order #202503031536561', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:36:56', '2025-03-03 09:36:56'),
(126, '4fbfd24c-0a47-49d8-903c-09bef97a6967', '202503031537341', 'Order #202503031537341', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-03 09:37:34', '2025-03-03 09:37:34'),
(127, '9ce96d6f-e674-4b16-bd6d-412e01cbf184', '202503031556571', 'Order #202503031556571', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 09:56:57', '2025-03-03 09:56:57'),
(128, 'ccc05c4e-7c59-47d3-a0cf-3b6bf11b3a86', '202503040426331', 'Order #202503040426331', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:26:33', '2025-03-03 22:26:33'),
(129, 'd34f473e-11a4-4c1b-95dc-995f14b7a085', '202503040431081', 'Order #202503040431081', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:31:08', '2025-03-03 22:31:08'),
(130, 'e83a2616-97f5-47a4-ba11-b8a5a03c095b', '202503040436201', 'Order #202503040436201', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:36:20', '2025-03-03 22:36:20'),
(131, 'a1852f79-d52b-4f64-ba2f-0b14e0090cac', '202503040438281', 'Order #202503040438281', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:38:28', '2025-03-03 22:38:28'),
(132, '7c00194c-2947-4ad5-a63d-8b50bd01af01', '202503040443021', 'Order #202503040443021', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:43:02', '2025-03-03 22:43:02'),
(133, '862f4f17-4408-4370-873d-e0ab77c48649', '202503040446551', 'Order #202503040446551', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:46:55', '2025-03-03 22:46:55'),
(134, 'f1f56ebd-66f5-4b74-a35c-6b3e7ea399d0', '202503040448371', 'Order #202503040448371', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:48:37', '2025-03-03 22:48:37'),
(135, 'b810000f-be66-40ca-8df3-b5a8390574a1', '202503040449301', 'Order #202503040449301', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 22:49:30', '2025-03-03 22:49:30'),
(136, 'ae7666ef-e08d-4ee7-91df-12501034ef7e', '202503040449581', 'Order #202503040449581', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 22:49:58', '2025-03-03 22:49:58'),
(137, '63de4ea6-504f-4453-85ec-e44e91d6125a', '202503040450141', 'Order #202503040450141', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:50:14', '2025-03-03 22:50:14'),
(138, '9b532f35-2db4-4d8f-875f-820630254d26', '202503040454221', 'Order #202503040454221', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 22:54:22', '2025-03-03 22:54:22'),
(139, '52df1166-d806-43fd-8fbb-4c2dfe0dca8f', '202503040500151', 'Order #202503040500151', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:00:15', '2025-03-03 23:00:15'),
(140, '842e3831-b128-4641-9665-d0e3496da609', '202503040501111', 'Order #202503040501111', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:01:11', '2025-03-03 23:01:11'),
(141, '375f844d-2efa-4801-9ead-f008a36e53cc', '202503040505241', 'Order #202503040505241', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:05:24', '2025-03-03 23:05:24'),
(142, '346c099f-2348-49e7-89ff-bb79b5b1f46b', '202503040507221', 'Order #202503040507221', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:07:22', '2025-03-03 23:07:22'),
(143, '04a18abd-cd12-48fd-b6f7-ad602a7b2926', '202503040511181', 'Order #202503040511181', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:11:18', '2025-03-03 23:11:18'),
(144, '47f6825a-90e8-4d99-9fed-1d9d3063c949', '202503040516091', 'Order #202503040516091', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:16:09', '2025-03-03 23:16:09'),
(145, 'f7fe6b6b-2a23-4d3e-bf2c-da99e59299d0', '202503040518021', 'Order #202503040518021', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:18:02', '2025-03-03 23:18:02'),
(146, '7c68bc7d-88f0-45d7-8e3e-42a4b1ea347c', '202503040525581', 'Order #202503040525581', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:25:58', '2025-03-03 23:25:58'),
(147, '28ddcfe5-31c4-4123-a111-4230042ea223', '202503040528291', 'Order #202503040528291', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-03 23:28:29', '2025-03-03 23:28:29'),
(148, '490efa2d-4d93-42d1-b891-bc1227bad470', '202503040528481', 'Order #202503040528481', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:28:48', '2025-03-03 23:28:48'),
(149, 'fc67341b-f937-4bc0-8e1b-efc3c8ad88bd', '202503040534281', 'Order #202503040534281', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:34:28', '2025-03-03 23:34:28'),
(150, '959a623b-048e-44a2-b16d-0cb8518d9e36', '202503040546261', 'Order #202503040546261', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:46:26', '2025-03-03 23:46:26'),
(151, '7524596d-4746-44cc-94cc-8480e6a5827e', '202503040548301', 'Order #202503040548301', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:48:30', '2025-03-03 23:48:30'),
(152, '0ee2309d-84fa-41d1-a86d-bb363bdb5ac5', '202503040554231', 'Order #202503040554231', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-03 23:54:23', '2025-03-03 23:54:23'),
(153, '27e6c666-3fa0-48a6-a2e0-75e09bb7823d', '202503040601551', 'Order #202503040601551', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 00:01:55', '2025-03-04 00:01:55'),
(154, '66d3b685-e6e3-4306-a164-4909cbe2e14f', '202503040629381', 'Order #202503040629381', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 00:29:38', '2025-03-04 00:29:38'),
(155, 'b11c322e-48ea-4bc3-b5f8-7b3c12177508', '202503040634021', 'Order #202503040634021', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 00:34:02', '2025-03-04 00:34:02'),
(156, 'a6bf8316-e506-4406-9550-70e849356955', '202503040636271', 'Order #202503040636271', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 00:36:27', '2025-03-04 00:36:27'),
(157, 'e86e1b1f-f958-4e60-906e-fb0a2af55f26', '202503040645501', 'Order #202503040645501', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 00:45:50', '2025-03-04 00:45:50'),
(158, '9cd50145-5337-4bd0-9f0c-ed6a2b341888', '202503040658491', 'Order #202503040658491', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 00:58:49', '2025-03-04 00:58:49'),
(159, '150602b6-52da-403c-82b9-de6804514444', '202503040659171', 'Order #202503040659171', 'events', 'pending', 'paid', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 00:59:17', '2025-03-04 01:00:48'),
(160, '68a820a6-ce02-493e-9999-7f9a97fe04f6', '202503040711351', 'Order #202503040711351', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 01:11:35', '2025-03-04 01:11:35'),
(161, 'b07dcd42-6e5f-416d-b338-10091eae0c6f', '202503040712211', 'Order #202503040712211', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 01:12:21', '2025-03-04 01:12:21'),
(162, '23af8224-14d4-449a-b0e7-1e7f45a58d87', '202503040715081', 'Order #202503040715081', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 01:15:08', '2025-03-04 01:15:08'),
(163, '924b1449-4285-4a1a-be74-d9e8a1e2eecc', '202503040717541', 'Order #202503040717541', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 01:17:54', '2025-03-04 01:17:54'),
(164, '4507e315-5366-4b3c-85b9-ddf0ec052c23', '202503040718151', 'Order #202503040718151', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 01:18:15', '2025-03-04 01:18:15'),
(165, '3de7c3a5-8159-4ccc-8728-bbc722be1690', '202503040724411', 'Order #202503040724411', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 01:24:41', '2025-03-04 01:24:41'),
(166, 'c8b47d07-c267-4d11-a63b-846bbd6743c9', '202503040727141', 'Order #202503040727141', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 01:27:14', '2025-03-04 01:27:14'),
(167, '82b3d4ab-0bf2-4f51-a0b1-2df3000d68fe', '202503040748401', 'Order #202503040748401', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 01:48:40', '2025-03-04 01:48:40'),
(168, '28ccfbba-27da-4279-8c2a-b8e4480f2a62', '202503040823031', 'Order #202503040823031', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 02:23:03', '2025-03-04 02:23:03'),
(169, 'c935930b-e459-4141-8a2a-95b5111236dc', '202503040824531', 'Order #202503040824531', 'events', 'pending', 'pending', 'pending', 'adssd', 'customer@botble.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 7, NULL, '2025-03-04 02:24:53', '2025-03-04 02:24:53'),
(170, '28272a0d-ab84-4328-b4a7-e4383644710e', '202503040837461', 'Order #202503040837461', 'events', 'pending', 'completed', 'pending', 'adssd', 'customer@botble.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 7, NULL, '2025-03-04 02:37:46', '2025-03-04 02:38:37'),
(171, '6c4658e6-5b73-4e15-bca9-d699cf665d10', '202503040847191', 'Order #202503040847191', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 02:47:19', '2025-03-04 02:47:56'),
(172, 'c32c1abe-abcd-4988-b5f6-ebfdb5415afa', '202503040901241', 'Order #202503040901241', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 03:01:24', '2025-03-04 03:01:24'),
(173, 'cc2941ff-2219-4a1b-889e-08012255e460', '202503040904491', 'Order #202503040904491', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 03:04:49', '2025-03-04 03:04:49'),
(174, '1f741915-4c81-45a4-9daa-cbd918e46e24', '202503040905171', 'Order #202503040905171', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 03:05:17', '2025-03-04 03:05:17'),
(175, '8b749990-0b52-4ca8-a36a-be6dce56e49b', '202503040905521', 'Order #202503040905521', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 03:05:52', '2025-03-04 03:05:52'),
(176, '9625c8f6-e9e6-458c-9cf8-88e0b6e73f09', '202503040909401', 'Order #202503040909401', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 03:09:40', '2025-03-04 03:09:40'),
(177, '92cb3fc6-4089-417c-a906-bcb37fa822eb', '202503040912301', 'Order #202503040912301', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-04 03:12:30', '2025-03-04 03:13:04'),
(178, '757cbd68-7914-4dae-856c-9980fd140f10', '202503040922291', 'Order #202503040922291', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 5, 'Cash On Delivery', NULL, 1, NULL, '2025-03-04 03:22:29', '2025-03-04 03:22:30'),
(179, 'a1cbb098-8455-4252-8526-b7eb55c1cece', '202503041030541', 'Order #202503041030541', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 5, 'Cash On Delivery', NULL, 1, NULL, '2025-03-04 04:30:54', '2025-03-04 04:30:54'),
(180, '1d7039eb-cb90-476f-9862-f5a41c8d60c8', '202503041113291', 'Order #202503041113291', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 3, '1700.00', '1700.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 05:13:31', '2025-03-04 05:13:31'),
(181, '4650bee6-1299-4370-81ca-ff77336b7fe9', '202503041116391', 'Order #202503041116391', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '800.00', '800.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 05:16:39', '2025-03-04 05:16:39'),
(182, '1038b7f8-8985-4dbb-ba94-8eacfed704f7', '202503041141321', 'Order #202503041141321', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 3, '1300.00', '1300.00', '0.00', NULL, 5, 'Cash On Delivery', NULL, 1, NULL, '2025-03-04 05:41:32', '2025-03-04 05:41:33'),
(183, '2946440e-88f7-43f9-a1f9-872e76991bb6', '202503041146321', 'Order #202503041146321', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 05:46:32', '2025-03-04 05:47:02'),
(184, 'ec44c083-927c-4dec-9805-c29177f72fc7', '202503041148551', 'Order #202503041148551', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 05:48:55', '2025-03-04 05:48:55'),
(185, '2ef80f51-c274-4802-9160-c7c99e42c042', '202503041149361', 'Order #202503041149361', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 05:49:36', '2025-03-04 05:51:43'),
(186, 'dd85d26c-e2fb-42c9-aff4-04143392f800', '202503041152181', 'Order #202503041152181', 'events', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-04 05:52:18', '2025-03-04 05:52:18'),
(187, '2b72cabe-4a85-428e-9c87-ec3535f833a0', '202503041338251', 'Order #202503041338251', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '1800.00', '1800.00', '0.00', NULL, 5, 'Cash On Delivery', NULL, 1, NULL, '2025-03-04 07:38:25', '2025-03-04 07:38:25'),
(188, 'bdf555f0-3484-493e-a2e7-c317fa29860f', '202503041339271', 'Order #202503041339271', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '800.00', '800.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-04 07:39:27', '2025-03-04 07:39:49'),
(189, '167536cb-0c3c-4e22-b814-f61c336b3aba', '202503070552091', 'Order #202503070552091', 'events', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '400.00', '400.00', '0.00', NULL, 5, 'Cash On Delivery', NULL, 1, NULL, '2025-03-06 23:52:09', '2025-03-06 23:52:11'),
(190, 'ba6953cd-a302-4468-a662-4badd62d2491', '202503071006041', 'Order #202503071006041', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-07 04:06:04', '2025-03-07 04:06:04'),
(191, '1ebee572-941d-4324-85d1-b2f1872fbb42', '202503071605481', 'Order #202503071605481', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-07 10:05:48', '2025-03-07 10:05:48'),
(192, '0606a3fa-4ca7-4bc1-ac01-24c3f5aec04c', '202503071606291', 'Order #202503071606291', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-07 10:06:29', '2025-03-07 10:06:29'),
(193, '58bba84d-980d-4969-99cc-11e0a5fb516a', '202503071610321', 'Order #202503071610321', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-07 10:10:32', '2025-03-07 10:10:32');
INSERT INTO `jw_orders` (`id`, `token`, `code`, `title`, `type`, `status`, `payment_status`, `delivery_status`, `name`, `email`, `phone`, `address`, `country_code`, `quantity`, `total_price`, `total`, `discount`, `discount_codes`, `payment_method_id`, `payment_method_name`, `notes`, `user_id`, `site_id`, `created_at`, `updated_at`) VALUES
(194, '150864a3-4b5e-4023-8a06-2350d407c322', '202503071610471', 'Order #202503071610471', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 4, 'Mollie', NULL, 1, NULL, '2025-03-07 10:10:47', '2025-03-07 10:10:47'),
(195, 'f7461e5e-763d-4e0b-b544-dba07e2c38d0', '202503071612051', 'Order #202503071612051', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-07 10:12:05', '2025-03-07 10:12:05'),
(196, '5e4b4955-c735-471e-8d3d-fcc2114988e0', '202503080520091', 'Order #202503080520091', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-07 23:20:09', '2025-03-07 23:20:09'),
(197, '50cd1227-209f-421b-bed2-786a23d9e36e', '202503080614111', 'Order #202503080614111', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 2, '900.00', '900.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 00:14:11', '2025-03-08 00:14:11'),
(198, '032f309e-c63b-4c44-b492-5715509194c8', '202503080615101', 'Order #202503080615101', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-08 00:15:10', '2025-03-08 00:15:10'),
(199, 'ec3ecf94-ac7e-4544-9f87-598b4057eeec', '202503080629451', 'Order #202503080629451', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '500.00', '500.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 00:29:45', '2025-03-08 00:29:45'),
(200, '6629dc4b-f38d-498c-8e8f-4c8cff27d242', '202503080711141', 'Order #202503080711141', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '500.00', '500.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 01:11:14', '2025-03-08 01:11:14'),
(201, '3163c196-b97c-416c-b995-e646aed4943f', '202503080711561', 'Order #202503080711561', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-08 01:11:56', '2025-03-08 01:11:56'),
(202, '4f669cc4-1060-4fc4-a853-428346b7c9b2', '202503080718091', 'Order #202503080718091', 'products', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 5, 'Cash On Delivery', NULL, 1, NULL, '2025-03-08 01:18:09', '2025-03-08 01:18:09'),
(203, '1a28ebb9-f01b-4963-8a74-7c1189260391', '202503080729351', 'Order #202503080729351', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 01:29:35', '2025-03-08 01:29:35'),
(204, '0adb5911-df42-469a-abe9-0b67d3b2927c', '202503080733011', 'Order #202503080733011', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '500.00', '500.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 01:33:01', '2025-03-08 01:33:01'),
(205, '2ed85957-c5d7-4bee-b071-b90cc724d3aa', '202503080755371', 'Order #202503080755371', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '500.00', '500.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 01:55:37', '2025-03-08 01:55:37'),
(206, 'b6d9c890-df3d-48db-93ca-f92e39f5020d', '202503080757481', 'Order #202503080757481', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '500.00', '500.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-08 01:57:48', '2025-03-08 01:57:48'),
(207, 'bfc5a760-90a1-45cc-8f52-775ce69a9d60', '202503080813451', 'Order #202503080813451', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '500.00', '500.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 02:13:45', '2025-03-08 02:13:45'),
(208, '8c31139c-66bd-4352-a655-f25e789c67b4', '202503080814441', 'Order #202503080814441', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '400.00', '400.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-08 02:14:44', '2025-03-08 02:14:44'),
(209, 'bbc94eae-b855-4334-aa63-b1d4211af569', '202503080815081', 'Order #202503080815081', 'products', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '500.00', '500.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-08 02:15:08', '2025-03-08 02:15:08'),
(210, 'c571a128-53d6-4656-81c4-8f938ba81b56', '202503211631421', 'Order #202503211631421', 'courses', 'pending', 'pending', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '35.00', '35.00', '0.00', NULL, 1, 'Paypal', NULL, 1, NULL, '2025-03-21 10:31:42', '2025-03-21 10:31:42'),
(211, '6877b5f0-4474-4b65-a430-2d5055026099', '202503211644001', 'Order #202503211644001', 'courses', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '35.00', '35.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-21 10:44:00', '2025-03-21 10:44:47'),
(212, 'fa8b95a5-bf15-45e5-93a9-64f3293eda28', '202503211715411', 'Order #202503211715411', 'courses', 'pending', 'completed', 'pending', 'Admin', 'admin@gmail.com', NULL, NULL, NULL, 1, '0.00', '0.00', '0.00', NULL, 3, 'Stripe', NULL, 1, NULL, '2025-03-21 11:15:41', '2025-03-21 11:16:07'),
(213, 'd61d286e-8ec6-4e47-8d23-fcb375829a66', '202504021833461', 'Order #202504021833461', 'courses', 'pending', 'completed', 'pending', 'Student', 'student@gmail.com', NULL, NULL, NULL, 1, '40.00', '40.00', '0.00', NULL, 3, 'Stripe', NULL, 8, NULL, '2025-04-02 12:33:46', '2025-04-02 12:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `jw_order_items`
--

CREATE TABLE `jw_order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `thumbnail` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `line_price` decimal(15,2) NOT NULL,
  `quantity` int NOT NULL,
  `compare_price` decimal(15,2) DEFAULT NULL,
  `sku_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_order_items`
--

INSERT INTO `jw_order_items` (`id`, `title`, `type`, `thumbnail`, `price`, `line_price`, `quantity`, `compare_price`, `sku_code`, `barcode`, `post_id`, `order_id`, `created_at`, `updated_at`) VALUES
(3, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 8, '2025-02-15 09:50:32', '2025-02-15 09:50:32'),
(4, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 8, '2025-02-15 09:50:32', '2025-02-15 09:50:32'),
(5, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 9, '2025-02-15 09:55:32', '2025-02-15 09:55:32'),
(6, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 9, '2025-02-15 09:55:32', '2025-02-15 09:55:32'),
(7, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 10, '2025-02-15 10:08:00', '2025-02-15 10:08:00'),
(8, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 10, '2025-02-15 10:08:00', '2025-02-15 10:08:00'),
(9, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 11, '2025-02-16 07:38:35', '2025-02-16 07:38:35'),
(10, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 12, '2025-02-19 07:56:45', '2025-02-19 07:56:45'),
(11, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 12, '2025-02-19 07:56:45', '2025-02-19 07:56:45'),
(12, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 13, '2025-02-20 22:57:17', '2025-02-20 22:57:17'),
(13, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 14, '2025-02-20 23:00:37', '2025-02-20 23:00:37'),
(14, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 15, '2025-02-20 23:01:49', '2025-02-20 23:01:49'),
(15, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 16, '2025-02-21 10:58:15', '2025-02-21 10:58:15'),
(16, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 17, '2025-02-21 10:59:16', '2025-02-21 10:59:16'),
(17, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 18, '2025-02-21 11:32:50', '2025-02-21 11:32:50'),
(18, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 19, '2025-02-21 11:34:06', '2025-02-21 11:34:06'),
(19, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 20, '2025-02-21 11:36:34', '2025-02-21 11:36:34'),
(20, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 21, '2025-02-21 11:37:58', '2025-02-21 11:37:58'),
(21, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 22, '2025-02-21 11:40:35', '2025-02-21 11:40:35'),
(22, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 23, '2025-02-22 08:41:02', '2025-02-22 08:41:02'),
(23, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 24, '2025-02-22 08:43:13', '2025-02-22 08:43:13'),
(24, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 25, '2025-02-22 08:44:27', '2025-02-22 08:44:27'),
(25, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 25, '2025-02-22 08:44:27', '2025-02-22 08:44:27'),
(26, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 26, '2025-02-22 08:46:27', '2025-02-22 08:46:27'),
(27, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 27, '2025-02-22 08:56:24', '2025-02-22 08:56:24'),
(28, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 28, '2025-02-22 09:22:28', '2025-02-22 09:22:28'),
(29, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '800.00', 2, '300.00', 'df32312', '3434314', 15, 29, '2025-02-22 11:36:54', '2025-02-22 11:36:54'),
(30, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 30, '2025-02-23 08:23:03', '2025-02-23 08:23:03'),
(31, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 31, '2025-02-23 10:58:01', '2025-02-23 10:58:01'),
(32, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 32, '2025-02-23 20:11:36', '2025-02-23 20:11:36'),
(33, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 33, '2025-02-23 20:13:48', '2025-02-23 20:13:48'),
(34, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 34, '2025-02-23 20:17:44', '2025-02-23 20:17:44'),
(35, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 35, '2025-02-23 20:20:18', '2025-02-23 20:20:18'),
(36, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 36, '2025-02-23 20:23:50', '2025-02-23 20:23:50'),
(37, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 36, '2025-02-23 20:23:50', '2025-02-23 20:23:50'),
(38, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 37, '2025-02-24 09:27:33', '2025-02-24 09:27:33'),
(39, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 38, '2025-02-24 09:29:13', '2025-02-24 09:29:13'),
(40, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 39, '2025-02-24 09:40:58', '2025-02-24 09:40:58'),
(41, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 40, '2025-02-24 09:47:26', '2025-02-24 09:47:26'),
(42, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 41, '2025-02-24 09:49:03', '2025-02-24 09:49:03'),
(43, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 42, '2025-02-24 09:50:07', '2025-02-24 09:50:07'),
(44, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 43, '2025-02-24 10:24:09', '2025-02-24 10:24:09'),
(45, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 43, '2025-02-24 10:24:09', '2025-02-24 10:24:09'),
(46, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 44, '2025-02-24 10:25:37', '2025-02-24 10:25:37'),
(47, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 44, '2025-02-24 10:25:37', '2025-02-24 10:25:37'),
(48, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 45, '2025-02-24 10:26:41', '2025-02-24 10:26:41'),
(49, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 46, '2025-02-24 10:27:53', '2025-02-24 10:27:53'),
(50, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 47, '2025-02-24 10:30:03', '2025-02-24 10:30:03'),
(51, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 48, '2025-02-24 10:32:27', '2025-02-24 10:32:27'),
(52, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 49, '2025-02-24 10:34:40', '2025-02-24 10:34:40'),
(53, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 50, '2025-02-24 10:40:29', '2025-02-24 10:40:29'),
(54, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 51, '2025-02-24 10:47:19', '2025-02-24 10:47:19'),
(55, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 52, '2025-02-24 10:49:39', '2025-02-24 10:49:39'),
(56, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 53, '2025-02-24 10:51:24', '2025-02-24 10:51:24'),
(57, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 54, '2025-02-24 10:54:20', '2025-02-24 10:54:20'),
(58, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 55, '2025-02-24 10:54:54', '2025-02-24 10:54:54'),
(59, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 56, '2025-02-24 10:58:11', '2025-02-24 10:58:11'),
(60, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 57, '2025-02-24 11:05:35', '2025-02-24 11:05:35'),
(61, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 58, '2025-02-24 11:08:13', '2025-02-24 11:08:13'),
(62, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 59, '2025-02-24 11:11:10', '2025-02-24 11:11:10'),
(63, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 60, '2025-02-24 11:12:41', '2025-02-24 11:12:41'),
(64, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 61, '2025-02-24 11:13:20', '2025-02-24 11:13:20'),
(65, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 62, '2025-02-24 11:18:04', '2025-02-24 11:18:04'),
(66, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 63, '2025-02-24 11:18:47', '2025-02-24 11:18:47'),
(67, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 64, '2025-02-24 11:20:32', '2025-02-24 11:20:32'),
(68, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 65, '2025-02-24 11:20:58', '2025-02-24 11:20:58'),
(69, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 66, '2025-02-24 11:22:45', '2025-02-24 11:22:45'),
(70, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 67, '2025-02-24 11:27:41', '2025-02-24 11:27:41'),
(71, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 67, '2025-02-24 11:27:41', '2025-02-24 11:27:41'),
(72, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 68, '2025-02-24 11:29:29', '2025-02-24 11:29:29'),
(73, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 69, '2025-02-24 11:34:19', '2025-02-24 11:34:19'),
(74, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 70, '2025-02-24 11:35:18', '2025-02-24 11:35:18'),
(75, 'Product 2', 'product', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 71, '2025-02-24 11:35:46', '2025-02-24 11:35:46'),
(76, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 72, '2025-02-24 11:49:17', '2025-02-24 11:49:17'),
(77, 'Product 1', 'product', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 73, '2025-02-24 11:50:08', '2025-02-24 11:50:08'),
(78, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 74, '2025-02-26 20:01:38', '2025-02-26 20:01:38'),
(79, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 76, '2025-02-26 20:12:30', '2025-02-26 20:12:30'),
(80, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 78, '2025-02-26 20:16:21', '2025-02-26 20:16:21'),
(81, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 79, '2025-02-26 20:17:44', '2025-02-26 20:17:44'),
(82, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 82, '2025-02-28 06:42:38', '2025-02-28 06:42:38'),
(83, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 82, '2025-02-28 06:42:38', '2025-02-28 06:42:38'),
(84, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 82, '2025-02-28 06:42:38', '2025-02-28 06:42:38'),
(85, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 87, '2025-02-28 21:40:38', '2025-02-28 21:40:38'),
(86, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 87, '2025-02-28 21:40:38', '2025-02-28 21:40:38'),
(87, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 87, '2025-02-28 21:40:38', '2025-02-28 21:40:38'),
(88, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 88, '2025-02-28 21:42:14', '2025-02-28 21:42:14'),
(89, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 95, '2025-03-01 05:42:10', '2025-03-01 05:42:10'),
(90, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 95, '2025-03-01 05:42:10', '2025-03-01 05:42:10'),
(91, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 96, '2025-03-01 05:45:08', '2025-03-01 05:45:08'),
(92, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 96, '2025-03-01 05:45:08', '2025-03-01 05:45:08'),
(93, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 97, '2025-03-01 07:23:17', '2025-03-01 07:23:17'),
(94, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 97, '2025-03-01 07:23:17', '2025-03-01 07:23:17'),
(95, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 98, '2025-03-01 07:25:29', '2025-03-01 07:25:29'),
(96, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '1800.00', 2, '0.00', '', '', 21, 99, '2025-03-02 10:26:05', '2025-03-02 10:26:05'),
(97, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 99, '2025-03-02 10:26:05', '2025-03-02 10:26:05'),
(98, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 100, '2025-03-02 10:28:07', '2025-03-02 10:28:07'),
(99, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 101, '2025-03-03 03:41:12', '2025-03-03 03:41:12'),
(100, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 101, '2025-03-03 03:41:12', '2025-03-03 03:41:12'),
(101, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 102, '2025-03-03 05:51:47', '2025-03-03 05:51:47'),
(102, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 103, '2025-03-03 05:52:50', '2025-03-03 05:52:50'),
(103, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 104, '2025-03-03 05:53:26', '2025-03-03 05:53:26'),
(104, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 105, '2025-03-03 05:53:45', '2025-03-03 05:53:45'),
(105, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 106, '2025-03-03 05:54:40', '2025-03-03 05:54:40'),
(106, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 107, '2025-03-03 05:54:55', '2025-03-03 05:54:55'),
(107, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 108, '2025-03-03 07:14:43', '2025-03-03 07:14:43'),
(108, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 109, '2025-03-03 07:15:03', '2025-03-03 07:15:03'),
(109, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 110, '2025-03-03 07:15:20', '2025-03-03 07:15:20'),
(110, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 111, '2025-03-03 07:16:45', '2025-03-03 07:16:45'),
(111, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 112, '2025-03-03 07:19:42', '2025-03-03 07:19:42'),
(112, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 113, '2025-03-03 07:20:37', '2025-03-03 07:20:37'),
(113, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 114, '2025-03-03 07:20:59', '2025-03-03 07:20:59'),
(114, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 115, '2025-03-03 09:23:15', '2025-03-03 09:23:15'),
(115, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 116, '2025-03-03 09:25:45', '2025-03-03 09:25:45'),
(116, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 117, '2025-03-03 09:26:03', '2025-03-03 09:26:03'),
(117, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 118, '2025-03-03 09:27:14', '2025-03-03 09:27:14'),
(118, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 119, '2025-03-03 09:27:32', '2025-03-03 09:27:32'),
(119, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 120, '2025-03-03 09:28:29', '2025-03-03 09:28:29'),
(120, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 121, '2025-03-03 09:34:31', '2025-03-03 09:34:31'),
(121, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 122, '2025-03-03 09:35:36', '2025-03-03 09:35:36'),
(122, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 123, '2025-03-03 09:35:53', '2025-03-03 09:35:53'),
(123, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 124, '2025-03-03 09:36:38', '2025-03-03 09:36:38'),
(124, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 125, '2025-03-03 09:36:56', '2025-03-03 09:36:56'),
(125, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 126, '2025-03-03 09:37:34', '2025-03-03 09:37:34'),
(126, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 127, '2025-03-03 09:56:57', '2025-03-03 09:56:57'),
(127, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 128, '2025-03-03 22:26:33', '2025-03-03 22:26:33'),
(128, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 129, '2025-03-03 22:31:08', '2025-03-03 22:31:08'),
(129, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 130, '2025-03-03 22:36:20', '2025-03-03 22:36:20'),
(130, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 131, '2025-03-03 22:38:28', '2025-03-03 22:38:28'),
(131, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 132, '2025-03-03 22:43:02', '2025-03-03 22:43:02'),
(132, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 133, '2025-03-03 22:46:55', '2025-03-03 22:46:55'),
(133, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 134, '2025-03-03 22:48:37', '2025-03-03 22:48:37'),
(134, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 135, '2025-03-03 22:49:30', '2025-03-03 22:49:30'),
(135, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 136, '2025-03-03 22:49:58', '2025-03-03 22:49:58'),
(136, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 137, '2025-03-03 22:50:14', '2025-03-03 22:50:14'),
(137, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 138, '2025-03-03 22:54:22', '2025-03-03 22:54:22'),
(138, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 139, '2025-03-03 23:00:15', '2025-03-03 23:00:15'),
(139, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 140, '2025-03-03 23:01:11', '2025-03-03 23:01:11'),
(140, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 141, '2025-03-03 23:05:24', '2025-03-03 23:05:24'),
(141, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 142, '2025-03-03 23:07:23', '2025-03-03 23:07:23'),
(142, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 143, '2025-03-03 23:11:18', '2025-03-03 23:11:18'),
(143, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 144, '2025-03-03 23:16:09', '2025-03-03 23:16:09'),
(144, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 145, '2025-03-03 23:18:02', '2025-03-03 23:18:02'),
(145, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 146, '2025-03-03 23:25:58', '2025-03-03 23:25:58'),
(146, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 147, '2025-03-03 23:28:29', '2025-03-03 23:28:29'),
(147, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 148, '2025-03-03 23:28:48', '2025-03-03 23:28:48'),
(148, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 149, '2025-03-03 23:34:28', '2025-03-03 23:34:28'),
(149, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 150, '2025-03-03 23:46:26', '2025-03-03 23:46:26'),
(150, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 151, '2025-03-03 23:48:30', '2025-03-03 23:48:30'),
(151, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 152, '2025-03-03 23:54:23', '2025-03-03 23:54:23'),
(152, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 153, '2025-03-04 00:01:55', '2025-03-04 00:01:55'),
(153, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 154, '2025-03-04 00:29:38', '2025-03-04 00:29:38'),
(154, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 155, '2025-03-04 00:34:03', '2025-03-04 00:34:03'),
(155, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 156, '2025-03-04 00:36:27', '2025-03-04 00:36:27'),
(156, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 157, '2025-03-04 00:45:50', '2025-03-04 00:45:50'),
(157, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 158, '2025-03-04 00:58:49', '2025-03-04 00:58:49'),
(158, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 159, '2025-03-04 00:59:17', '2025-03-04 00:59:17'),
(159, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 160, '2025-03-04 01:11:35', '2025-03-04 01:11:35'),
(160, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 161, '2025-03-04 01:12:21', '2025-03-04 01:12:21'),
(161, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 162, '2025-03-04 01:15:08', '2025-03-04 01:15:08'),
(162, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 163, '2025-03-04 01:17:54', '2025-03-04 01:17:54'),
(163, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 164, '2025-03-04 01:18:15', '2025-03-04 01:18:15'),
(164, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 165, '2025-03-04 01:24:41', '2025-03-04 01:24:41'),
(165, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 166, '2025-03-04 01:27:14', '2025-03-04 01:27:14'),
(166, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 167, '2025-03-04 01:48:40', '2025-03-04 01:48:40'),
(167, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 168, '2025-03-04 02:23:03', '2025-03-04 02:23:03'),
(168, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 169, '2025-03-04 02:24:53', '2025-03-04 02:24:53'),
(169, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 170, '2025-03-04 02:37:46', '2025-03-04 02:37:46'),
(170, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 171, '2025-03-04 02:47:19', '2025-03-04 02:47:19'),
(171, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 172, '2025-03-04 03:01:24', '2025-03-04 03:01:24'),
(172, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 173, '2025-03-04 03:04:49', '2025-03-04 03:04:49'),
(173, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 174, '2025-03-04 03:05:17', '2025-03-04 03:05:17'),
(174, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 175, '2025-03-04 03:05:52', '2025-03-04 03:05:52'),
(175, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 176, '2025-03-04 03:09:40', '2025-03-04 03:09:40'),
(176, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 177, '2025-03-04 03:12:30', '2025-03-04 03:12:30'),
(177, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 178, '2025-03-04 03:22:29', '2025-03-04 03:22:29'),
(178, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 179, '2025-03-04 04:30:54', '2025-03-04 04:30:54'),
(179, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '900.00', 1, '0.00', '', '', 21, 180, '2025-03-04 05:13:31', '2025-03-04 05:13:31'),
(180, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 180, '2025-03-04 05:13:31', '2025-03-04 05:13:31'),
(181, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 180, '2025-03-04 05:13:31', '2025-03-04 05:13:31'),
(182, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 181, '2025-03-04 05:16:39', '2025-03-04 05:16:39'),
(183, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 181, '2025-03-04 05:16:39', '2025-03-04 05:16:39'),
(184, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 182, '2025-03-04 05:41:32', '2025-03-04 05:41:32'),
(185, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 182, '2025-03-04 05:41:32', '2025-03-04 05:41:32'),
(186, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 182, '2025-03-04 05:41:32', '2025-03-04 05:41:32'),
(187, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 183, '2025-03-04 05:46:32', '2025-03-04 05:46:32'),
(188, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 184, '2025-03-04 05:48:55', '2025-03-04 05:48:55'),
(189, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 185, '2025-03-04 05:49:36', '2025-03-04 05:49:36'),
(190, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 186, '2025-03-04 05:52:18', '2025-03-04 05:52:18'),
(191, 'Event 2', 'events', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '900.00', '1800.00', 2, '0.00', '', '', 21, 187, '2025-03-04 07:38:25', '2025-03-04 07:38:25'),
(192, 'event 1', 'events', '', '400.00', '400.00', 1, '0.00', '', '', 20, 188, '2025-03-04 07:39:27', '2025-03-04 07:39:27'),
(193, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 188, '2025-03-04 07:39:27', '2025-03-04 07:39:27'),
(194, 'event 1', 'events', '', '0.00', '0.00', 1, '0.00', '', '', 20, 189, '2025-03-06 23:52:09', '2025-03-06 23:52:09'),
(195, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 189, '2025-03-06 23:52:09', '2025-03-06 23:52:09'),
(196, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 190, '2025-03-07 04:06:04', '2025-03-07 04:06:04'),
(197, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 191, '2025-03-07 10:05:48', '2025-03-07 10:05:48'),
(198, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 192, '2025-03-07 10:06:29', '2025-03-07 10:06:29'),
(199, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 193, '2025-03-07 10:10:32', '2025-03-07 10:10:32'),
(200, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 194, '2025-03-07 10:10:47', '2025-03-07 10:10:47'),
(201, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 195, '2025-03-07 10:12:05', '2025-03-07 10:12:05'),
(202, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 196, '2025-03-07 23:20:09', '2025-03-07 23:20:09'),
(203, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 197, '2025-03-08 00:14:11', '2025-03-08 00:14:11'),
(204, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 197, '2025-03-08 00:14:11', '2025-03-08 00:14:11'),
(205, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 198, '2025-03-08 00:15:10', '2025-03-08 00:15:10'),
(206, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 199, '2025-03-08 00:29:45', '2025-03-08 00:29:45'),
(207, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 200, '2025-03-08 01:11:14', '2025-03-08 01:11:14'),
(208, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 201, '2025-03-08 01:11:56', '2025-03-08 01:11:56'),
(209, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 202, '2025-03-08 01:18:09', '2025-03-08 01:18:09'),
(210, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 203, '2025-03-08 01:29:35', '2025-03-08 01:29:35'),
(211, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 204, '2025-03-08 01:33:01', '2025-03-08 01:33:01'),
(212, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 205, '2025-03-08 01:55:37', '2025-03-08 01:55:37'),
(213, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 206, '2025-03-08 01:57:48', '2025-03-08 01:57:48'),
(214, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 207, '2025-03-08 02:13:45', '2025-03-08 02:13:45'),
(215, 'Product 1', 'products', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', '400.00', '400.00', 1, '300.00', 'df32312', '3434314', 15, 208, '2025-03-08 02:14:44', '2025-03-08 02:14:44'),
(216, 'Product 2', 'products', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', '500.00', '500.00', 1, '300.00', 'qwew32', 'dfdf', 16, 209, '2025-03-08 02:15:08', '2025-03-08 02:15:08'),
(217, 'dfgdfgdf', 'courses', '', '35.00', '35.00', 1, '65.00', '', '', 80, 210, '2025-03-21 10:31:42', '2025-03-21 10:31:42'),
(218, 'dfgdfgdf', 'courses', '', '35.00', '35.00', 1, '65.00', '', '', 80, 211, '2025-03-21 10:44:00', '2025-03-21 10:44:00'),
(219, 'fsdfdsfds', 'courses', '2025/03/06/features-product-shape01.png', '0.00', '0.00', 1, '0.00', '', '', 82, 212, '2025-03-21 11:15:41', '2025-03-21 11:15:41'),
(220, 'dwerqwedw', 'courses', '', '40.00', '40.00', 1, '50.00', '', '', 74, 213, '2025-04-02 12:33:46', '2025-04-02 12:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `jw_order_item_metas`
--

CREATE TABLE `jw_order_item_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_order_metas`
--

CREATE TABLE `jw_order_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_pages`
--

CREATE TABLE `jw_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `template_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_page_metas`
--

CREATE TABLE `jw_page_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `page_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_password_resets`
--

CREATE TABLE `jw_password_resets` (
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_payment_histories`
--

CREATE TABLE `jw_payment_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_reference` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agreement_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `metadata` json DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `payment_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_message` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_payment_methods`
--

CREATE TABLE `jw_payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `data` json DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_payment_methods`
--

INSERT INTO `jw_payment_methods` (`id`, `type`, `name`, `description`, `image`, `data`, `active`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'Paypal', 'adadsd', '2025/03/07/paypal.png', '{\"mode\": \"sandbox\", \"live_secret\": null, \"live_client_id\": null, \"sandbox_secret\": \"ECCkJXVtmmMgy_ai5i_1AuUJtbO7e6P_gQISQzwctaApGyJD2h1LPi2reSt5ac_FPGESoprR3i1eIaFC\", \"sandbox_client_id\": \"Ae_EqULnkWwIRsubEs8n6FTVc48VpD5X8a_6Npk23zIhn81Aw7W6QH7hyOqSE443aUoc0FRrxa8IZiGs\"}', 1, '2025-02-06 08:39:41', '2025-03-07 03:29:18'),
(2, 'custom', 'fgf', 'You will be redirected to Stripe to complete the payment. (Debit card/Credit card/Online banking)', NULL, '{\"description\": \"Payment description\"}', 1, '2025-02-20 23:58:59', '2025-02-23 10:53:07'),
(3, 'stripe', 'Stripe', 'Stripe', NULL, '{\"mode\": \"test\", \"webhook_secret\": null, \"live_secret_key\": null, \"test_secret_key\": \"sk_test_51N4eDoFNqndPjg2XrvImm40p6LoRjrJimWykVbpQnzVvUSDyEbA140iXLFsrPeh4wv0i5q3I3SM8aBuUX5ZBE7YD00AE1LVUKN\", \"live_publishable_key\": null, \"test_publishable_key\": \"pk_test_51N4eDoFNqndPjg2XgA6h2UbpIysYQmjOdVh8SaFxsYCPcwNxY5BnIWyuCSYKgxPqK3QhiCOZt6vCmf5rfmgsWPho00GyRSimvC\"}', 1, '2025-02-23 20:10:37', '2025-03-03 05:51:16'),
(4, 'mollie', 'Mollie', 'Description', NULL, '{\"mode\": \"sandbox\", \"live_api_key\": null, \"sandbox_api_key\": \"test_7UVc8MRSkupvtj9tBuySkt5g4vR3vJ\"}', 1, '2025-03-03 22:21:58', '2025-03-03 22:49:16'),
(5, 'cod', 'Cash On Delivery', NULL, NULL, NULL, 1, '2025-03-04 03:21:53', '2025-03-04 03:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `jw_permissions`
--

CREATE TABLE `jw_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_permissions`
--

INSERT INTO `jw_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
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
-- Table structure for table `jw_permission_groups`
--

CREATE TABLE `jw_permission_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plugin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_personal_access_tokens`
--

CREATE TABLE `jw_personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_posts`
--

CREATE TABLE `jw_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'posts',
  `json_metas` json DEFAULT NULL,
  `json_taxonomies` json DEFAULT NULL,
  `rating` double(8,2) NOT NULL DEFAULT '0.00',
  `total_rating` int NOT NULL DEFAULT '0',
  `total_comment` bigint NOT NULL DEFAULT '0',
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_posts`
--

INSERT INTO `jw_posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`, `total_comment`, `uuid`, `locale`) VALUES
(1, 'post test 1', NULL, 'post-test-1', 'post content', '<p>post content</p>', 'publish', 4, '2025-01-19 07:44:50', '2025-01-19 08:11:00', 1, 1, 'posts', NULL, '[{\"id\": 2, \"url\": \"http://mojar-cms.test/category/new-cat\", \"name\": \"new cat\", \"slug\": \"new-cat\", \"level\": 0, \"singular\": \"category\", \"taxonomy\": \"categories\", \"thumbnail\": \"http://mojar-cms.test/jw-styles/mojar/images/thumb-default.png\", \"total_post\": 1}]', 0.00, 0, 0, '79b4128b-1a6d-4b01-b50d-3a4a9d3f300b', 'vi'),
(2, 'fddf d', NULL, 'fddf-d', 'dasd', '<p>dasd</p>', 'publish', 4, '2025-01-19 07:54:27', '2025-01-19 07:54:27', 1, 1, 'posts', NULL, '[]', 0.00, 0, 0, '364d6e93-ac55-44cd-a335-97ca0545b72e', 'vi'),
(3, 'dasds', NULL, 'dasds', 'dasds', '<p>dasds</p>', 'publish', 8, '2025-01-19 08:00:00', '2025-03-21 05:52:06', 1, 1, 'posts', NULL, '[]', 0.00, 0, 2, 'b9e62429-f5a7-4cc1-b282-ba85f2676325', 'vi'),
(4, 'hgvj', NULL, 'hgvj', '', NULL, 'publish', 0, '2025-01-19 11:26:20', '2025-01-19 11:26:20', 1, 1, 'examples', '{\"select\": \"1\", \"example\": \"jkhj\"}', '[]', 0.00, 0, 0, 'b4649985-c678-403d-807f-366a9c67a739', 'vi'),
(7, 'asdasdasdsad', NULL, 'asdasdasdsad', '', NULL, 'publish', 1, '2025-01-30 10:21:50', '2025-01-30 10:21:50', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"test\"}]}}', '[]', 0.00, 0, 0, '509c6845-f7da-432e-9717-42f36fab2650', 'vi'),
(8, 'Home2', NULL, 'home2', '', NULL, 'publish', 1, '2025-01-30 10:23:14', '2025-01-30 10:24:08', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"test\"}, {\"block\": \"slider\"}]}}', '[]', 0.00, 0, 0, '46d1ec86-05e5-4cda-8f5b-40016e000ccf', 'vi'),
(9, 'dsdsds', NULL, 'dsdsds', '', NULL, 'publish', 4, '2025-01-30 10:24:48', '2025-01-30 10:24:48', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"test\"}]}}', '[]', 0.00, 0, 0, '2768851c-393a-476f-9906-e0279f3cf31c', 'vi'),
(10, 'home3', NULL, 'home3', '', NULL, 'publish', 1, '2025-01-30 10:25:34', '2025-01-30 10:25:34', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"test\"}]}}', '[]', 0.00, 0, 0, 'f7c1000f-20ec-4c41-8263-a7016e8f3bf9', 'vi'),
(11, 'home', NULL, 'home', '', NULL, 'publish', 1, '2025-01-30 10:26:12', '2025-01-31 04:27:25', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"test\", \"title\": null}, {\"block\": \"test\", \"title\": \"mn\"}, {\"block\": \"test\", \"title\": \"this is new\"}, {\"block\": \"test\", \"title\": \"dsad\"}, {\"block\": \"test\", \"title\": \"dsds\"}]}}', '[]', 0.00, 0, 0, '78b4cf21-0b53-498e-a812-0b87267308c5', 'vi'),
(12, 'Somthing', NULL, 'somthing', '', NULL, 'publish', 1, '2025-01-30 10:26:50', '2025-01-31 04:35:55', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"test\", \"title\": null}, {\"col1\": {\"limit\": \"3\", \"title\": null}, \"col2\": {\"title\": null}, \"col3\": {\"limit\": \"3\", \"title\": null}, \"block\": \"featured_games\"}, {\"block\": \"test\", \"title\": \"dad\"}]}}', '[]', 0.00, 0, 0, 'e1504347-f06e-4edf-90b4-b2a4d72b7d40', 'vi'),
(13, 'Events', NULL, 'events', '', NULL, 'publish', 25, '2025-02-09 09:33:09', '2025-02-09 09:33:09', 1, 1, 'pages', '{\"template\": \"event\"}', '[]', 0.00, 0, 0, 'd88261bf-3ece-4338-afff-ae2462537fe7', 'vi'),
(14, 'Products', NULL, 'products', '', NULL, 'publish', 28, '2025-02-13 23:27:20', '2025-02-13 23:27:20', 1, 1, 'pages', '{\"template\": \"products\"}', '[]', 0.00, 0, 0, 'bcf463ec-e0c0-48aa-8dc7-9cd2a490ac47', 'vi'),
(15, 'Product 1', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', 'product-1', 'Product Desc', '<p>Product Desc</p>', 'publish', 1, '2025-02-13 23:32:06', '2025-02-13 23:32:06', 1, 1, 'products', '{\"price\": 400, \"images\": [\"2025/02/01/footer-bg.png\", \"2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\"], \"barcode\": \"3434314\", \"quantity\": 50, \"sku_code\": \"df32312\", \"downloadable\": 0, \"compare_price\": 300, \"disable_out_of_stock\": 0, \"inventory_management\": 0}', '[]', 0.00, 0, 0, 'c7fb39fa-7d1b-4bd4-bf0c-e9fb2b0d8b75', 'vi'),
(16, 'Product 2', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg', 'product-2', 'This Is product desc', '<p>This Is product desc</p>', 'publish', 1, '2025-02-14 03:50:15', '2025-02-14 03:50:15', 1, 1, 'products', '{\"price\": 500, \"barcode\": \"dfdf\", \"quantity\": 30, \"sku_code\": \"qwew32\", \"downloadable\": 0, \"compare_price\": 300, \"disable_out_of_stock\": 0, \"inventory_management\": \"1\"}', '[]', 0.00, 0, 0, '086c25f8-c1ac-42d0-95ec-1afe2bfd6025', 'vi'),
(17, 'Checkout', NULL, 'checkout', '', NULL, 'publish', 97, '2025-02-14 04:41:49', '2025-02-14 04:41:50', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, 'b551bb7a-2db0-4586-b05f-6640cfa93aa1', 'vi'),
(18, 'Thank You', NULL, 'thank-you', '', NULL, 'publish', 51, '2025-02-23 20:16:52', '2025-02-23 20:16:53', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, '1abe8021-b6ad-4008-b95c-a8d5218f52b9', 'vi'),
(20, 'event 1', NULL, 'event-1', 'content', '<p>content</p>', 'publish', 16, '2025-02-24 11:57:29', '2025-03-05 10:07:56', 1, 1, 'events', '{\"name\": \"fafda\", \"price\": null, \"venue\": \"Dhaka\", \"map_url\": \"#\", \"capacity\": null, \"end_date\": null, \"latitude\": \"57\", \"longitude\": \"87\", \"event_logo\": \"2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg\", \"start_date\": null, \"description\": null, \"event_banner\": \"2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\", \"social_links\": [{\"url\": \"#\", \"icon\": \"fab fa-facebook-f\"}], \"venue_address\": \"mirpur\", \"map_embed_code\": \"gvhj\", \"max_ticket_number\": null, \"min_ticket_number\": null}', '[{\"id\": 5, \"url\": \"http://mojar-cms.test/category/mango\", \"name\": \"Mango\", \"slug\": \"mango\", \"level\": 0, \"singular\": \"category\", \"taxonomy\": \"categories\", \"thumbnail\": \"http://mojar-cms.test/jw-styles/mojar/images/thumb-default.png\", \"total_post\": 2}]', 0.00, 0, 0, '5f717572-20eb-4b76-8ef7-fe9030b9c46a', 'vi'),
(21, 'Event 2', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg', 'event-2', 'Event 2', '<p>Event 2</p>', 'publish', 13, '2025-02-26 20:09:49', '2025-03-05 10:04:05', 1, 1, 'events', '{\"name\": \"Ticket\", \"price\": 400, \"venue\": \"Dhaka\", \"map_url\": \"#\", \"capacity\": 10, \"end_date\": \"2025-03-06T22:04\", \"latitude\": \"30\", \"longitude\": \"40\", \"event_logo\": \"2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\", \"start_date\": \"2025-03-05T22:03\", \"description\": \"Desc\", \"event_banner\": null, \"social_links\": [{\"url\": \"#\", \"icon\": \"fab fa-facebook-f\"}], \"venue_address\": \"Mirpur\", \"map_embed_code\": \"#\", \"max_ticket_number\": 3, \"min_ticket_number\": 1}', '[{\"id\": 5, \"url\": \"http://mojar-cms.test/category/mango\", \"name\": \"Mango\", \"slug\": \"mango\", \"level\": 0, \"singular\": \"category\", \"taxonomy\": \"categories\", \"thumbnail\": \"http://mojar-cms.test/jw-styles/mojar/images/thumb-default.png\", \"total_post\": 1}]', 0.00, 0, 0, '319d3cc9-0afe-4a81-bc1d-c2fbcadfb2d5', 'vi'),
(22, 'Contact', NULL, 'contact', '', NULL, 'publish', 3, '2025-03-05 01:18:38', '2025-03-05 01:48:07', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"contact_form\", \"title\": \"Get In Touch With Us\", \"map_url\": \"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58404.90712306111!2d90.33188860263257!3d23.807690708042205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1685520321950!5m2!1sen!2sbd\", \"show_map\": \"1\", \"info_boxes\": [{\"icon\": null, \"title\": null, \"content\": null, \"subtitle\": null}], \"name_label\": null, \"show_title\": \"1\", \"email_label\": null, \"submit_text\": \"Submit\", \"message_label\": null, \"subject_label\": null, \"show_info_boxes\": \"1\", \"name_placeholder\": null, \"email_placeholder\": null, \"message_placeholder\": null, \"subject_placeholder\": null}]}}', '[]', 0.00, 0, 0, 'b4e3c4af-e1d9-4a5a-bf38-375f02cba23d', 'vi'),
(23, 'Faq', NULL, 'faq', '', NULL, 'publish', 6, '2025-03-05 02:24:24', '2025-03-18 07:36:46', 1, 1, 'pages', '{\"template\": \"about\", \"block_content\": {\"content\": [{\"block\": \"about_video\", \"play_icon\": null, \"video_url\": null, \"margin_top\": null, \"video_type\": \"video\", \"enable_overlay\": \"0\", \"enable_autoplay\": \"0\", \"background_image\": null, \"enable_animation\": \"0\", \"mobile_margin_top\": null}, {\"block\": \"student_choose\", \"image_1\": null, \"image_2\": null, \"button_url\": null, \"button_text\": null, \"description\": null, \"padding_top\": null, \"section_title\": null, \"padding_bottom\": null, \"background_image\": null, \"enable_animation\": \"0\", \"mobile_padding_top\": null, \"mobile_padding_bottom\": null}, {\"block\": \"about_area\", \"title\": \"About Section title\", \"image_1\": \"2025/03/06/home-shop-thumb06.png\", \"image_2\": null, \"description\": \"About Section desc\", \"background_image\": \"2025/03/07/paypal.png\"}]}}', '[]', 0.00, 0, 0, 'e743e505-1998-4ea3-9133-3b962918d2e2', 'vi'),
(24, 'Privacy policy', NULL, 'privacy-policy', '\r Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit ation ullamco laboris...', '<div class=\"tf__trems_condition_text\">\r\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercit ation ullamco laboris nisi ut aliquip ex ea commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt atem quia voluptas sit aspernatur aut odit aut fugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n<p>Adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea in commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proidentktl sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusani um doloremque laudantium totamrem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam volupt</p>\r\n<h3>The Type of Personal Information We Collect</h3>\r\n<p>Vulputate dignissim viverra pretium enim penatibus amet velit. Bibendum tincidunt pretium est sit cursus orci morbi cursus consectetur. Dolor nec a a sollicitudin. Nec elementum arcu arcu in volutpat tristique nunc. Quis ut egestas nec fringilla enim leo. Duis leo morbi mi felis varius et. Suspendisse at est pellentesque sagittis nulla. Magna placerat laoreet quis vulputate. Ornare turpis ut amet arcu vitae. Enim suspendisse sit nec venenatis lobortis.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<h3>How We Use Cookies?</h3>\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n</ul>\r\n<h3>The Collection, Process, And Use Of Personal Data</h3>\r\n<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>\r\n<h3>Accounts, Passwords And Security</h3>\r\n<p>In certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>\r\n</div>', 'publish', 3, '2025-03-05 03:29:45', '2025-03-05 03:29:45', 1, 1, 'pages', '{\"template\": null}', '[]', 0.00, 0, 0, 'e20af4ec-4c2a-4fe1-ae1f-a8b0d180f250', 'vi'),
(25, 'Accusantium quod atq', NULL, 'accusantium-quod-atq', '', NULL, 'publish', 0, '2025-03-08 05:43:17', '2025-03-08 05:43:17', 1, 1, 'theme', '{\"theme_name\": \"Sandra Nolan\", \"theme_author\": \"Distinctio Sint qua\", \"theme_version\": \"Adipisci consectetur\"}', '[]', 0.00, 0, 0, 'b4ad5fc0-a3dc-4d9f-8b8c-a235670fe319', 'vi'),
(26, 'Recusandae Ex tempo', '2025/03/06/features-product-shape01.png', 'recusandae-ex-tempo', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that does not yet have content', '<p>Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that does not yet have content</p>', 'publish', 2, '2025-03-08 05:53:48', '2025-03-08 07:14:45', 1, 1, 'dev_tool_plugin', '{\"plugin_name\": \"Silas Butler\", \"plugin_author\": \"Eiusmod autem quo te\", \"plugin_version\": \"Culpa officia non al\"}', '[]', 0.00, 0, 0, 'e9a5dfd8-4c9c-4c47-a138-1c7f2d9ea0d5', 'vi'),
(28, 'Amet ipsum quam no', NULL, 'amet-ipsum-quam-no', '', NULL, 'private', 0, '2025-03-19 04:44:12', '2025-03-19 04:44:12', 1, 1, 'events', '{\"name\": \"Eve Sherman\", \"price\": 596, \"venue\": \"In molestiae quia do\", \"map_url\": \"Voluptates reiciendi\", \"capacity\": 74, \"end_date\": \"2004-07-28T18:52\", \"latitude\": \"Eos sed omnis quia i\", \"longitude\": \"Nisi harum impedit\", \"event_logo\": null, \"start_date\": \"1980-11-16T17:47\", \"description\": \"Magna tempore ipsum\", \"event_banner\": null, \"social_links\": [{\"url\": \"#\", \"icon\": \"fab fa-facebook-f\"}], \"venue_address\": \"Eum et est sit aperi\", \"map_embed_code\": \"Amet ut iure aut qu\", \"max_ticket_number\": 299, \"min_ticket_number\": 310}', '[]', 0.00, 0, 0, 'a8216d07-2ad1-4b01-b8c6-83f82e5e5cfa', 'vi'),
(29, 'course 1', '2025/03/06/features-product-shape01.png', 'course-1', '', NULL, 'publish', 0, '2025-03-19 05:47:19', '2025-03-19 07:12:41', 1, 1, 'courses', '{\"price\": 300, \"language\": \"vi\", \"max_students\": \"20\", \"compare_price\": 400, \"difficulty_level\": \"intermediate\", \"preview_video_url\": \"#\"}', '[]', 0.00, 0, 0, '1adb6213-6fad-474b-bffa-72d39847709c', 'vi'),
(30, 'course 2.0', '2025/03/06/home-shop-thumb06.png', 'course-20', 'desc', '<p>desc</p>', 'publish', 0, '2025-03-19 07:23:03', '2025-03-19 07:23:03', 1, 1, 'courses', '{\"price\": null, \"language\": \"en\", \"max_students\": 0, \"compare_price\": null, \"difficulty_level\": \"beginner\", \"preview_video_url\": \"\"}', '[]', 0.00, 0, 0, 'df0683fd-f6e2-4b54-80af-7226deec137e', 'vi'),
(31, 'New Course', NULL, 'new-course', '', NULL, 'draft', 0, '2025-03-19 07:56:57', '2025-03-19 07:56:57', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'a7309ff3-64d0-44e0-9e48-e27f488a5889', 'vi'),
(32, 'New Course', NULL, 'new-course-1', '', NULL, 'draft', 0, '2025-03-19 08:52:10', '2025-03-19 08:52:10', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '0b41a67e-1d36-48f2-9259-645a89d9dd4a', 'vi'),
(33, 'New Course', NULL, 'new-course-2', '', NULL, 'draft', 0, '2025-03-19 08:52:15', '2025-03-19 08:52:15', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '28eb81df-0e63-44c5-9ab8-002d849e301e', 'vi'),
(34, 'New Course', NULL, 'new-course-3', '', NULL, 'draft', 0, '2025-03-19 08:52:21', '2025-03-19 08:52:21', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'fe2a483b-64f1-461e-8def-a4e8fc2f3a01', 'vi'),
(35, 'New Course', NULL, 'new-course-4', '', NULL, 'draft', 0, '2025-03-19 08:52:53', '2025-03-19 08:52:53', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'b9f2e8bb-58fd-449f-a45c-388615ad1ed3', 'vi'),
(36, 'New Course', NULL, 'new-course-5', '', NULL, 'draft', 0, '2025-03-19 08:53:37', '2025-03-19 08:53:37', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'e3b19dc5-da66-435e-b5e3-0d3dd887cbfc', 'vi'),
(37, 'New Course', NULL, 'new-course-6', '', NULL, 'draft', 0, '2025-03-19 08:53:41', '2025-03-19 08:53:41', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'e1e52ae4-2001-41a0-b90b-565a55609f48', 'vi'),
(38, 'New Course', NULL, 'new-course-7', '', NULL, 'draft', 0, '2025-03-19 08:53:45', '2025-03-19 08:53:45', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'f0b7c12e-2bf0-4d1c-8565-51b92baf0bce', 'vi'),
(39, 'New Course', NULL, 'new-course-8', '', NULL, 'draft', 0, '2025-03-19 08:53:53', '2025-03-19 08:53:53', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'e5999d23-cd55-4c31-97a6-5195053db1d2', 'vi'),
(40, 'New Course', NULL, 'new-course-9', '', NULL, 'draft', 0, '2025-03-19 08:53:58', '2025-03-19 08:53:58', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '0d8f8fc5-6978-4bd8-99ca-b48f46e9c91c', 'vi'),
(41, 'New Course', NULL, 'new-course-10', '', NULL, 'draft', 0, '2025-03-19 08:54:15', '2025-03-19 08:54:15', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '9786111f-5b8c-47ce-b091-eaf749c92967', 'vi'),
(42, 'New Course', NULL, 'new-course-11', '', NULL, 'draft', 0, '2025-03-19 08:54:37', '2025-03-19 08:54:37', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'f139bf02-3c14-4f67-9a34-9a5ea7882dd5', 'vi'),
(43, 'New Course', NULL, 'new-course-12', '', NULL, 'draft', 0, '2025-03-19 08:55:02', '2025-03-19 08:55:02', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '0d19de53-c5be-4052-bb6a-ba9f7ace9387', 'vi'),
(44, 'New Course', NULL, 'new-course-13', '', NULL, 'draft', 0, '2025-03-19 08:55:54', '2025-03-19 08:55:54', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'bcb51fbe-53b8-4529-9777-bb8f26770be5', 'vi'),
(45, 'New Course', NULL, 'new-course-14', '', NULL, 'draft', 0, '2025-03-19 08:56:10', '2025-03-19 08:56:10', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'a3b16f5c-3367-4bd5-90a5-1c926a6a0653', 'vi'),
(46, 'New Course', NULL, 'new-course-15', '', NULL, 'draft', 0, '2025-03-19 08:56:11', '2025-03-19 08:56:11', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '95ee7178-b239-4c1d-a23f-214c8b128766', 'vi'),
(47, 'New Course', NULL, 'new-course-16', '', NULL, 'draft', 0, '2025-03-19 08:56:26', '2025-03-19 08:56:26', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '497e09ce-bd4d-4ce1-9855-21d62342fb2d', 'vi'),
(48, 'New Course', NULL, 'new-course-17', '', NULL, 'draft', 0, '2025-03-19 08:56:29', '2025-03-19 08:56:29', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'fca3b2ce-ca56-44c1-9f12-58281380b3b0', 'vi'),
(49, 'New Course', NULL, 'new-course-18', '', NULL, 'draft', 0, '2025-03-19 08:56:59', '2025-03-19 08:56:59', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '2923a196-e03a-4af3-9b62-89a32030367f', 'vi'),
(50, 'New Course', NULL, 'new-course-19', '', NULL, 'draft', 0, '2025-03-19 08:57:07', '2025-03-19 08:57:07', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'fc0fd932-e31c-46c5-bf4e-cb29bd931c14', 'vi'),
(51, 'New Course', NULL, 'new-course-20', '', NULL, 'draft', 0, '2025-03-19 08:58:37', '2025-03-19 08:58:37', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '5e2996a8-b863-4ee8-b6d7-6e4e14bd1f0e', 'vi'),
(52, 'New Course', NULL, 'new-course-21', '', NULL, 'draft', 0, '2025-03-19 08:58:44', '2025-03-19 08:58:44', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '66b82ee5-b678-4629-995f-f5703db3ccf0', 'vi'),
(53, 'New Course', NULL, 'new-course-22', '', NULL, 'draft', 0, '2025-03-19 08:58:47', '2025-03-19 08:58:47', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'a9c2897f-516f-4ef4-b852-824f554824ad', 'vi'),
(54, 'New Course', NULL, 'new-course-23', '', NULL, 'draft', 0, '2025-03-19 08:58:52', '2025-03-19 08:58:52', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '088bc29c-8739-4492-814f-9d6eaa1910b9', 'vi'),
(55, 'New Course', NULL, 'new-course-24', '', NULL, 'draft', 0, '2025-03-19 08:59:36', '2025-03-19 08:59:36', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'bc727e8e-91fe-46d0-88ae-18f4095e7700', 'vi'),
(56, 'New Course', NULL, 'new-course-25', '', NULL, 'draft', 0, '2025-03-19 08:59:41', '2025-03-19 08:59:41', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, 'dbfe0c56-e409-4f47-b44e-b518fea2f945', 'vi'),
(57, 'New Course', NULL, 'new-course-26', '', NULL, 'draft', 0, '2025-03-19 09:00:06', '2025-03-19 09:00:06', 1, 1, 'course', NULL, NULL, 0.00, 0, 0, '5a54c73a-dca9-4aaf-a772-4582328c822f', 'vi'),
(58, 'New Course', NULL, 'new-course-27', '', NULL, 'draft', 0, '2025-03-19 09:01:38', '2025-03-19 09:01:38', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'd3978fc2-6d08-449f-9c3e-26a358b8cea4', 'vi'),
(59, 'New Course', NULL, 'new-course-28', '', NULL, 'draft', 0, '2025-03-19 09:03:59', '2025-03-19 09:03:59', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'c6539a3f-af16-4d12-94db-3519e96766cc', 'vi'),
(60, 'New Course', NULL, 'new-course-29', '', NULL, 'draft', 0, '2025-03-19 09:04:04', '2025-03-19 09:04:04', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'dd289ee3-9085-4612-806f-6a7f3836cd49', 'vi'),
(61, 'New Course', NULL, 'new-course-30', '', NULL, 'draft', 0, '2025-03-19 09:04:10', '2025-03-19 09:04:10', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '21f5877a-b433-4d7c-a9cd-a542b380b3dd', 'vi'),
(62, 'New Course', NULL, 'new-course-31', '', NULL, 'draft', 0, '2025-03-19 09:05:11', '2025-03-19 09:05:11', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'bd5b7adb-dcaf-4af3-9ce2-f801a0f2aa0e', 'vi'),
(63, 'New Course', NULL, 'new-course-32', '', NULL, 'draft', 0, '2025-03-19 09:05:14', '2025-03-19 09:05:14', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'c1c944b1-ced1-437e-8af1-bf58e16ef69f', 'vi'),
(64, 'New Course', NULL, 'new-course-33', '', NULL, 'draft', 0, '2025-03-19 09:05:21', '2025-03-19 09:05:21', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'a2280949-2152-4868-9220-223faa4d93fa', 'vi'),
(65, 'New Course', NULL, 'new-course-34', '', NULL, 'draft', 0, '2025-03-19 09:05:42', '2025-03-19 09:05:42', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'ccc015b7-480c-4655-bf5f-73af9dbdd009', 'vi'),
(66, 'New Course', NULL, 'new-course-35', '', NULL, 'draft', 0, '2025-03-19 09:06:14', '2025-03-19 09:06:14', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '554f9f23-d949-4c7d-a868-76adf1bb6e58', 'vi'),
(67, 'New Course', NULL, 'new-course-36', '', NULL, 'draft', 0, '2025-03-19 09:07:15', '2025-03-19 09:07:15', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'c1b398da-6bb9-4ebb-bb3c-e10df57d36a1', 'vi'),
(68, 'New Course', NULL, 'new-course-37', '', NULL, 'draft', 0, '2025-03-19 09:16:29', '2025-03-19 09:16:29', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'bf43f2f8-5647-4e0f-ab1e-fb92e294dbe4', 'vi'),
(69, 'New Course', NULL, 'new-course-38', '', NULL, 'draft', 0, '2025-03-19 09:16:33', '2025-03-19 09:16:33', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '1d3078ba-d54e-4757-9b3b-ee60fc926394', 'vi'),
(70, 'New Course', NULL, 'new-course-39', '', NULL, 'draft', 0, '2025-03-19 09:20:47', '2025-03-19 09:20:47', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '551c718b-1f57-41ef-9da5-cb9faeb8be17', 'vi'),
(71, 'New Course', NULL, 'new-course-40', '', NULL, 'draft', 0, '2025-03-19 09:21:06', '2025-03-19 09:21:06', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'cd2091b5-810f-4bc0-9c06-d0df168a3036', 'vi'),
(72, 'New Course', NULL, 'new-course-41', '', NULL, 'draft', 0, '2025-03-19 09:21:11', '2025-03-19 09:21:11', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '51eb5533-67d3-468a-8275-a242cb1b92f2', 'vi'),
(73, 'New Course', NULL, 'new-course-42', '', NULL, 'draft', 0, '2025-03-19 09:22:09', '2025-03-19 09:22:09', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, 'a3cb93d3-a23a-4a95-98e0-d187ab006aa2', 'vi'),
(74, 'dwerqwedw', NULL, 'dwerqwedw', '', NULL, 'publish', 1, '2025-03-19 09:23:13', '2025-03-19 09:23:13', 1, 1, 'courses', '{\"price\": 40, \"language\": \"en\", \"max_students\": 0, \"compare_price\": 50, \"difficulty_level\": \"beginner\", \"preview_video_url\": \"\"}', '[]', 0.00, 0, 0, '11ff0655-8c39-4f65-9f6d-01185226e5c3', 'vi'),
(75, 'New Course', NULL, 'new-course-43', '', NULL, 'draft', 0, '2025-03-19 09:24:00', '2025-03-19 09:24:00', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '946472fe-e32f-4cef-8533-2b8011d7a050', 'vi'),
(76, 'New Course', NULL, 'new-course-44', '', NULL, 'draft', 0, '2025-03-19 09:26:18', '2025-03-19 09:26:18', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '5dc10f3d-65b7-4fc4-834c-70e5cb5b5569', 'vi'),
(77, 'New Course', NULL, 'new-course-45', '', NULL, 'draft', 0, '2025-03-19 09:35:10', '2025-03-19 09:35:10', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '072776df-673c-4949-b67b-1b778b32ba99', 'vi'),
(79, 'asdasd', NULL, 'asdasd', '', NULL, 'publish', 2, '2025-03-19 09:38:56', '2025-03-22 09:33:31', 1, 1, 'posts', NULL, '[]', 0.00, 0, 2, 'f57d9ad8-fad7-4200-a2c1-c5058f87411c', 'vi'),
(80, 'dfgdfgdf', '2025/03/06/features-product-shape02.png', 'dfgdfgdf', '\r Study Plan\r Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna...', '<div class=\"tf__course_overview\">\r\n<h3>Study Plan</h3>\r\n<p>Lorem ipsum dolor sit amet consectetur. Condimentum et eget faucibus tempor. Amet odio diam mattis volutpat sed platea sed pulvinar. Arcu ut urna sagittis sit eu ante ut urna facilisis. In viverra dui malesuada adipiscing velit erat eu. Commodo justo id amet scelerisque gravida id neque. Euismod nisi venenatis arcu nibh pellentesque nam bibendum proin consequat. Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<h3>What will you learn from this course?</h3>\r\n<p>Lectus congue congue vitae enim dignissim justo. Sagittis eu et tellus morbi maecenas egestas ullamcorper euismod vulputate. Nulla in elit in amet vitae aliquam.</p>\r\n<ul>\r\n<li>Basic knowledge and detailed understanding of CSS3 to create attract websites</li>\r\n<li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>\r\n<li>Web Page Layout Design and Slider Creation</li>\r\n<li>Image Insert method af web site</li>\r\n<li>Creating Styling Web Pages Using CSS3</li>\r\n<li>How to Convert Ul/UX to HTM</li>\r\n<li>Detailed ideas about structured project creation</li>\r\n<li>Steps to start freelancing by Learning Web design</li>\r\n</ul>\r\n<h3>Details about the course</h3>\r\n<p>Being able to speak Engltst\' fluently iS an important skill in this age. Having spoken English skills can help you advance in every stage ot lite. Acquiring English speaking SkillS or correct pronunciation ot English is very important.</p>\r\n<p>There are many people who know English well, but teel reluctant to speak English due to lack Ot confidence. Ten Minute School brings you the spoken English.</p>\r\n</div>', 'publish', 4, '2025-03-19 09:41:52', '2025-03-21 12:40:50', 1, 1, 'courses', '{\"price\": 35, \"duration\": \"\", \"language\": \"en\", \"certificate\": \"0\", \"max_students\": \"0\", \"compare_price\": 65, \"difficulty_level\": \"beginner\", \"preview_video_url\": \"\", \"preview_video_thumbnail\": \"\"}', '[{\"id\": 6, \"url\": \"http://mojar-cms.test/category/cat-course-1\", \"name\": \"Cat Course 1\", \"slug\": \"cat-course-1\", \"level\": 0, \"singular\": \"category\", \"taxonomy\": \"categories\", \"thumbnail\": \"http://mojar-cms.test/jw-styles/mojar/images/thumb-default.png\", \"total_post\": 2}]', 0.00, 0, 0, '1f9d9db0-087f-4dae-b623-fc6eba739e81', 'vi'),
(82, 'fsdfdsfds', '2025/03/06/features-product-shape01.png', 'fsdfdsfds', '', NULL, 'publish', 6, '2025-03-19 09:53:10', '2025-03-22 10:25:47', 1, 1, 'courses', '{\"price\": 0, \"duration\": \"\", \"language\": \"en\", \"certificate\": \"0\", \"max_students\": \"0\", \"compare_price\": 0, \"difficulty_level\": \"beginner\", \"preview_video_url\": \"\", \"preview_video_thumbnail\": \"\"}', '[{\"id\": 6, \"url\": \"http://mojar-cms.test/category/cat-course-1\", \"name\": \"Cat Course 1\", \"slug\": \"cat-course-1\", \"level\": 0, \"singular\": \"category\", \"taxonomy\": \"categories\", \"thumbnail\": \"http://mojar-cms.test/jw-styles/mojar/images/thumb-default.png\", \"total_post\": 2}]', 0.00, 0, 2, '50d86591-5871-4169-b412-f0322391b533', 'vi'),
(122, 'Courses', NULL, 'courses', '', NULL, 'publish', 15, '2025-03-21 00:11:06', '2025-03-21 00:11:06', 1, 1, 'pages', '{\"template\": \"courses\"}', '[]', 0.00, 0, 0, '61167aaa-9b06-47e3-8541-73fbf3b1be1f', 'vi'),
(124, 'k[ok', NULL, 'kok', '', NULL, 'publish', 0, '2025-03-29 13:23:28', '2025-03-29 13:23:28', 1, 1, 'products', '{\"price\": null, \"barcode\": null, \"quantity\": null, \"sku_code\": null, \"downloadable\": \"0\", \"compare_price\": null, \"disable_out_of_stock\": \"0\", \"inventory_management\": \"0\"}', '[]', 0.00, 0, 0, '2b528146-ed84-4f5a-837c-13214eb0fe04', 'vi'),
(125, 'Basic Course', NULL, 'basic-course', '', NULL, 'publish', 0, '2025-04-02 08:29:28', '2025-04-02 08:29:28', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '148f7c3c-4d23-43c6-864c-f584358256a6', 'vi'),
(126, 'Basic Course', NULL, 'basic-course-1', '', NULL, 'publish', 0, '2025-04-02 08:29:53', '2025-04-02 08:29:53', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '42990ef4-1223-464f-a059-553b203f1361', 'vi'),
(127, 'kh', NULL, 'kh', '', NULL, 'publish', 0, '2025-04-02 12:41:34', '2025-04-02 12:41:34', 1, 1, 'pages', '{\"template\": \"home\", \"block_content\": {\"content\": [{\"block\": \"student_choose\", \"image_1\": null, \"image_2\": null, \"button_url\": null, \"button_text\": null, \"description\": null, \"padding_top\": null, \"section_title\": null, \"padding_bottom\": null, \"background_image\": null, \"enable_animation\": \"0\", \"mobile_padding_top\": null, \"mobile_padding_bottom\": null}]}}', '[]', 0.00, 0, 0, 'c69fbd19-89a9-4bcd-ad2f-ef001608391f', 'vi'),
(128, 'Basic Course', NULL, 'basic-course-2', '', NULL, 'publish', 0, '2025-04-02 13:04:34', '2025-04-02 13:04:34', 1, 1, 'courses', NULL, NULL, 0.00, 0, 0, '56bac643-1ca5-4c9c-9e03-51c5bf298ad7', 'vi'),
(129, 'fasdasd', NULL, 'f', '', NULL, 'publish', 0, '2025-04-02 13:15:04', '2025-04-02 13:15:04', 1, 1, 'pages', '{\"template\": \"courses\", \"block_content\": {\"content\": [{\"block\": \"contact_form\", \"title\": \"sdasd\", \"map_url\": null, \"show_map\": \"0\", \"name_label\": null, \"show_title\": \"0\", \"email_label\": null, \"submit_text\": null, \"message_label\": null, \"subject_label\": null, \"show_info_boxes\": \"0\", \"name_placeholder\": null, \"email_placeholder\": null, \"message_placeholder\": null, \"subject_placeholder\": null}]}}', '[]', 0.00, 0, 0, '0b0ff5bc-7e50-4067-937d-2948ff02e2af', 'vi'),
(132, 'Labore est irure cum', NULL, 'labore-est-irure-cum', '', NULL, 'publish', 0, '2025-04-02 13:19:13', '2025-04-02 13:19:13', 1, 1, 'events', '{\"name\": \"Ticket 1\", \"price\": 30, \"venue\": \"asdfasd\", \"map_url\": \"#\", \"capacity\": 20, \"end_date\": \"2025-04-05T01:19\", \"latitude\": \"32432\", \"longitude\": \"32432\", \"event_logo\": null, \"start_date\": \"2025-04-04T01:19\", \"description\": \"Desc\", \"event_banner\": null, \"social_links\": [{\"url\": \"Est distinctio Sit\", \"icon\": \"Nihil provident quo\"}, {\"url\": \"Amet autem id incid\", \"icon\": \"Sit enim dolor labor\"}], \"venue_address\": \"asdasd\", \"map_embed_code\": \"#\", \"max_ticket_number\": 3, \"min_ticket_number\": 1}', '[{\"id\": 5, \"url\": \"http://mojar-cms.test/category/mango\", \"name\": \"Mango\", \"slug\": \"mango\", \"level\": 0, \"singular\": \"category\", \"taxonomy\": \"categories\", \"thumbnail\": \"http://mojar-cms.test/jw-styles/mojar/images/thumb-default.png\", \"total_post\": 3}]', 0.00, 0, 0, '6c019afd-df25-4644-bc6b-cd69c4967368', 'vi');

-- --------------------------------------------------------

--
-- Table structure for table `jw_post_likes`
--

CREATE TABLE `jw_post_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_post_metas`
--

CREATE TABLE `jw_post_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_post_metas`
--

INSERT INTO `jw_post_metas` (`id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 4, 'example', 'jkhj'),
(2, 4, 'select', '1'),
(7, 7, 'template', 'home'),
(8, 7, 'block_content', '{\"content\":[{\"block\":\"test\"}]}'),
(9, 8, 'template', 'home'),
(10, 8, 'block_content', '{\"content\":[{\"block\":\"test\"},{\"block\":\"slider\"}]}'),
(11, 9, 'template', 'home'),
(12, 9, 'block_content', '{\"content\":[{\"block\":\"test\"}]}'),
(13, 10, 'template', 'home'),
(14, 10, 'block_content', '{\"content\":[{\"block\":\"test\"}]}'),
(15, 11, 'template', 'home'),
(16, 11, 'block_content', '{\"content\":[{\"title\":null,\"block\":\"test\"},{\"title\":\"mn\",\"block\":\"test\"},{\"title\":\"this is new\",\"block\":\"test\"},{\"title\":\"dsad\",\"block\":\"test\"},{\"title\":\"dsds\",\"block\":\"test\"}]}'),
(17, 12, 'template', 'home'),
(18, 12, 'block_content', '{\"content\":[{\"title\":null,\"block\":\"test\"},{\"col1\":{\"title\":null,\"limit\":\"3\"},\"col2\":{\"title\":null},\"col3\":{\"title\":null,\"limit\":\"3\"},\"block\":\"featured_games\"},{\"title\":\"dad\",\"block\":\"test\"}]}'),
(19, 13, 'template', 'event'),
(20, 14, 'template', 'products'),
(21, 15, 'price', '400'),
(22, 15, 'compare_price', '300'),
(23, 15, 'sku_code', 'df32312'),
(24, 15, 'barcode', '3434314'),
(25, 15, 'quantity', '50'),
(26, 15, 'images', '[\"2025\\/02\\/01\\/footer-bg.png\",\"2025\\/02\\/14\\/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg\"]'),
(27, 15, 'inventory_management', '0'),
(28, 15, 'disable_out_of_stock', '0'),
(29, 15, 'downloadable', '0'),
(30, 16, 'price', '500'),
(31, 16, 'compare_price', '300'),
(32, 16, 'sku_code', 'qwew32'),
(33, 16, 'barcode', 'dfdf'),
(34, 16, 'inventory_management', '1'),
(35, 16, 'quantity', '30'),
(36, 16, 'disable_out_of_stock', '0'),
(37, 16, 'downloadable', '0'),
(38, 17, 'template', NULL),
(39, 18, 'template', NULL),
(57, 20, 'start_date', NULL),
(58, 20, 'end_date', NULL),
(59, 20, 'venue', 'Dhaka'),
(60, 20, 'venue_address', 'mirpur'),
(61, 20, 'latitude', '57'),
(62, 20, 'longitude', '87'),
(63, 20, 'map_url', '#'),
(64, 20, 'map_embed_code', 'gvhj'),
(65, 20, 'event_logo', '2025/02/14/freepicdownloadercom-diners-customers-chef-waiters-restaurant-with-various-dishes-peruvian-seafoo.jpg'),
(66, 20, 'event_banner', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg'),
(67, 20, 'name', 'fafda'),
(68, 20, 'description', NULL),
(69, 20, 'price', NULL),
(70, 20, 'capacity', NULL),
(71, 20, 'min_ticket_number', NULL),
(72, 20, 'max_ticket_number', NULL),
(73, 20, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(74, 21, 'start_date', '2025-03-05T22:03'),
(75, 21, 'end_date', '2025-03-06T22:04'),
(76, 21, 'venue', 'Dhaka'),
(77, 21, 'venue_address', 'Mirpur'),
(78, 21, 'latitude', '30'),
(79, 21, 'longitude', '40'),
(80, 21, 'map_url', '#'),
(81, 21, 'map_embed_code', '#'),
(82, 21, 'event_logo', '2025/02/14/freepicdownloadercom-attentive-bearded-man-sitting-semi-position-looking-colorful-vegetables-plat.jpg'),
(83, 21, 'event_banner', NULL),
(84, 21, 'name', 'Ticket'),
(85, 21, 'description', 'Desc'),
(86, 21, 'price', '400'),
(87, 21, 'capacity', '10'),
(88, 21, 'min_ticket_number', '1'),
(89, 21, 'max_ticket_number', '3'),
(90, 21, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(91, 22, 'template', 'home'),
(92, 22, 'block_content', '{\"content\":[{\"show_title\":\"1\",\"title\":\"Get In Touch With Us\",\"show_info_boxes\":\"1\",\"info_boxes\":[{\"icon\":null,\"title\":null,\"subtitle\":null,\"content\":null}],\"name_label\":null,\"name_placeholder\":null,\"email_label\":null,\"email_placeholder\":null,\"subject_label\":null,\"subject_placeholder\":null,\"message_label\":null,\"message_placeholder\":null,\"submit_text\":\"Submit\",\"show_map\":\"1\",\"map_url\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d58404.90712306111!2d90.33188860263257!3d23.807690708042205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1685520321950!5m2!1sen!2sbd\",\"block\":\"contact_form\"}]}'),
(93, 23, 'template', 'about'),
(94, 23, 'block_content', '{\"content\":[{\"background_image\":null,\"video_url\":null,\"enable_autoplay\":\"0\",\"video_type\":\"video\",\"margin_top\":null,\"mobile_margin_top\":null,\"enable_animation\":\"0\",\"play_icon\":null,\"enable_overlay\":\"0\",\"block\":\"about_video\"},{\"background_image\":null,\"section_title\":null,\"description\":null,\"button_text\":null,\"button_url\":null,\"image_1\":null,\"image_2\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"0\",\"block\":\"student_choose\"},{\"title\":\"About Section title\",\"description\":\"About Section desc\",\"background_image\":\"2025\\/03\\/07\\/paypal.png\",\"image_1\":\"2025\\/03\\/06\\/home-shop-thumb06.png\",\"image_2\":null,\"block\":\"about_area\"}]}'),
(95, 24, 'template', NULL),
(96, 25, 'theme_name', 'Sandra Nolan'),
(97, 25, 'theme_version', 'Adipisci consectetur'),
(98, 25, 'theme_author', 'Distinctio Sint qua'),
(99, 26, 'plugin_name', 'Silas Butler'),
(100, 26, 'plugin_version', 'Culpa officia non al'),
(101, 26, 'plugin_author', 'Eiusmod autem quo te'),
(119, 28, 'start_date', '1980-11-16T17:47'),
(120, 28, 'end_date', '2004-07-28T18:52'),
(121, 28, 'venue', 'In molestiae quia do'),
(122, 28, 'venue_address', 'Eum et est sit aperi'),
(123, 28, 'latitude', 'Eos sed omnis quia i'),
(124, 28, 'longitude', 'Nisi harum impedit'),
(125, 28, 'map_url', 'Voluptates reiciendi'),
(126, 28, 'map_embed_code', 'Amet ut iure aut qu'),
(127, 28, 'event_logo', NULL),
(128, 28, 'event_banner', NULL),
(129, 28, 'name', 'Eve Sherman'),
(130, 28, 'description', 'Magna tempore ipsum'),
(131, 28, 'price', '596'),
(132, 28, 'capacity', '74'),
(133, 28, 'min_ticket_number', '310'),
(134, 28, 'max_ticket_number', '299'),
(135, 28, 'social_links', '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"#\"}]'),
(136, 29, 'price', '300'),
(137, 29, 'compare_price', '400'),
(138, 29, 'max_students', '20'),
(139, 29, 'language', 'vi'),
(140, 29, 'difficulty_level', 'intermediate'),
(141, 29, 'preview_video_url', '#'),
(142, 30, 'price', NULL),
(143, 30, 'compare_price', NULL),
(144, 30, 'max_students', '0'),
(145, 30, 'language', 'en'),
(146, 30, 'difficulty_level', 'beginner'),
(147, 30, 'preview_video_url', ''),
(148, 74, 'price', '40'),
(149, 74, 'compare_price', '50'),
(150, 74, 'max_students', '0'),
(151, 74, 'language', 'en'),
(152, 74, 'difficulty_level', 'beginner'),
(153, 74, 'preview_video_url', ''),
(171, 80, 'price', '35'),
(172, 80, 'compare_price', '65'),
(173, 80, 'max_students', '0'),
(174, 80, 'language', 'en'),
(175, 80, 'difficulty_level', 'beginner'),
(176, 80, 'preview_video_url', ''),
(177, 82, 'price', '0'),
(178, 82, 'compare_price', '0'),
(179, 82, 'max_students', '0'),
(180, 82, 'language', 'en'),
(181, 82, 'difficulty_level', 'beginner'),
(182, 82, 'preview_video_url', ''),
(207, 122, 'template', 'courses'),
(208, 82, 'preview_video_thumbnail', ''),
(209, 82, 'duration', ''),
(210, 82, 'certificate', '0'),
(211, 80, 'preview_video_thumbnail', ''),
(212, 80, 'duration', ''),
(213, 80, 'certificate', '0'),
(231, 124, 'price', NULL),
(232, 124, 'compare_price', NULL),
(233, 124, 'sku_code', NULL),
(234, 124, 'barcode', NULL),
(235, 124, 'inventory_management', '0'),
(236, 124, 'quantity', NULL),
(237, 124, 'disable_out_of_stock', '0'),
(238, 124, 'downloadable', '0'),
(239, 127, 'template', 'home'),
(240, 127, 'block_content', '{\"content\":[{\"background_image\":null,\"section_title\":null,\"description\":null,\"button_text\":null,\"button_url\":null,\"image_1\":null,\"image_2\":null,\"padding_top\":null,\"padding_bottom\":null,\"mobile_padding_top\":null,\"mobile_padding_bottom\":null,\"enable_animation\":\"0\",\"block\":\"student_choose\"}]}'),
(241, 129, 'template', 'courses'),
(242, 129, 'block_content', '{\"content\":[{\"show_title\":\"0\",\"title\":\"sdasd\",\"show_info_boxes\":\"0\",\"name_label\":null,\"name_placeholder\":null,\"email_label\":null,\"email_placeholder\":null,\"subject_label\":null,\"subject_placeholder\":null,\"message_label\":null,\"message_placeholder\":null,\"submit_text\":null,\"show_map\":\"0\",\"map_url\":null,\"block\":\"contact_form\"}]}'),
(277, 132, 'start_date', '2025-04-04T01:19'),
(278, 132, 'end_date', '2025-04-05T01:19'),
(279, 132, 'venue', 'asdfasd'),
(280, 132, 'venue_address', 'asdasd'),
(281, 132, 'latitude', '32432'),
(282, 132, 'longitude', '32432'),
(283, 132, 'map_url', '#'),
(284, 132, 'map_embed_code', '#'),
(285, 132, 'event_logo', NULL),
(286, 132, 'event_banner', NULL),
(287, 132, 'name', 'Ticket 1'),
(288, 132, 'description', 'Desc'),
(289, 132, 'price', '30'),
(290, 132, 'capacity', '20'),
(291, 132, 'min_ticket_number', '1'),
(292, 132, 'max_ticket_number', '3'),
(293, 132, 'social_links', '[{\"icon\":\"Nihil provident quo\",\"url\":\"Est distinctio Sit\"},{\"icon\":\"Sit enim dolor labor\",\"url\":\"Amet autem id incid\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `jw_post_ratings`
--

CREATE TABLE `jw_post_ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `client_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_post_views`
--

CREATE TABLE `jw_post_views` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `views` bigint NOT NULL DEFAULT '0',
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_post_views`
--

INSERT INTO `jw_post_views` (`id`, `post_id`, `views`, `day`) VALUES
(3, 7, 1, '2025-01-30'),
(4, 8, 1, '2025-01-30'),
(5, 9, 1, '2025-01-30'),
(6, 10, 1, '2025-01-30'),
(7, 11, 1, '2025-01-30'),
(8, 12, 1, '2025-01-30'),
(9, 3, 4, '2025-02-01'),
(10, 2, 1, '2025-02-01'),
(11, 13, 3, '2025-02-09'),
(12, 13, 1, '2025-02-09'),
(13, 14, 3, '2025-02-14'),
(14, 17, 2, '2025-02-14'),
(15, 17, 3, '2025-02-15'),
(16, 14, 1, '2025-02-15'),
(17, 14, 1, '2025-02-16'),
(18, 17, 1, '2025-02-16'),
(19, 16, 1, '2025-02-18'),
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
(32, 20, 1, '2025-02-24'),
(33, 17, 3, '2025-02-27'),
(34, 20, 2, '2025-02-27'),
(35, 13, 2, '2025-02-27'),
(36, 18, 1, '2025-02-27'),
(37, 21, 1, '2025-02-27'),
(38, 14, 1, '2025-02-27'),
(39, 17, 1, '2025-02-28'),
(40, 18, 1, '2025-02-28'),
(41, 13, 1, '2025-02-28'),
(42, 21, 1, '2025-02-28'),
(43, 13, 3, '2025-03-01'),
(44, 20, 3, '2025-03-01'),
(45, 14, 2, '2025-03-01'),
(46, 17, 4, '2025-03-01'),
(47, 18, 2, '2025-03-01'),
(48, 21, 2, '2025-03-01'),
(49, 13, 4, '2025-03-02'),
(50, 21, 2, '2025-03-02'),
(51, 17, 2, '2025-03-02'),
(52, 9, 1, '2025-03-02'),
(53, 2, 3, '2025-03-02'),
(54, 1, 1, '2025-03-02'),
(55, 1, 1, '2025-03-02'),
(56, 1, 1, '2025-03-02'),
(57, 1, 1, '2025-03-02'),
(58, 3, 2, '2025-03-02'),
(59, 20, 1, '2025-03-02'),
(60, 18, 1, '2025-03-02'),
(61, 17, 5, '2025-03-03'),
(62, 17, 1, '2025-03-03'),
(63, 20, 5, '2025-03-03'),
(64, 13, 3, '2025-03-03'),
(65, 18, 8, '2025-03-03'),
(66, 21, 1, '2025-03-03'),
(67, 17, 8, '2025-03-04'),
(68, 13, 2, '2025-03-04'),
(69, 21, 3, '2025-03-04'),
(70, 18, 12, '2025-03-04'),
(71, 20, 2, '2025-03-04'),
(72, 14, 2, '2025-03-04'),
(73, 17, 1, '2025-03-05'),
(74, 22, 2, '2025-03-05'),
(75, 23, 2, '2025-03-05'),
(76, 24, 2, '2025-03-05'),
(77, 13, 1, '2025-03-05'),
(78, 20, 1, '2025-03-05'),
(79, 21, 1, '2025-03-05'),
(80, 17, 2, '2025-03-06'),
(81, 17, 6, '2025-03-07'),
(82, 13, 2, '2025-03-07'),
(83, 20, 1, '2025-03-07'),
(84, 14, 3, '2025-03-07'),
(85, 21, 1, '2025-03-07'),
(86, 18, 20, '2025-03-07'),
(87, 15, 1, '2025-03-07'),
(88, 17, 1, '2025-03-08'),
(89, 14, 1, '2025-03-08'),
(90, 18, 1, '2025-03-08'),
(91, 3, 2, '2025-03-08'),
(92, 26, 2, '2025-03-08'),
(93, 13, 1, '2025-03-08'),
(94, 21, 1, '2025-03-08'),
(95, 9, 1, '2025-03-08'),
(96, 17, 2, '2025-03-09'),
(97, 23, 4, '2025-03-18'),
(98, 24, 1, '2025-03-18'),
(99, 17, 1, '2025-03-19'),
(100, 14, 1, '2025-03-21'),
(101, 122, 3, '2025-03-21'),
(102, 80, 3, '2025-03-21'),
(103, 82, 6, '2025-03-21'),
(104, 79, 1, '2025-03-21'),
(105, 17, 4, '2025-03-21'),
(106, 18, 3, '2025-03-21'),
(107, 122, 6, '2025-03-22'),
(108, 79, 1, '2025-03-22'),
(109, 13, 1, '2025-03-22'),
(110, 14, 1, '2025-03-22'),
(111, 122, 1, '2025-03-23'),
(112, 122, 2, '2025-03-24'),
(113, 9, 1, '2025-03-24'),
(114, 80, 1, '2025-03-24'),
(115, 14, 1, '2025-03-29'),
(116, 22, 1, '2025-04-02'),
(117, 122, 1, '2025-04-02'),
(118, 74, 1, '2025-04-02'),
(119, 17, 1, '2025-04-02'),
(120, 18, 1, '2025-04-02'),
(121, 17, 2, '2025-04-03'),
(122, 122, 1, '2025-04-03'),
(123, 122, 1, '2025-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `jw_product_variants`
--

CREATE TABLE `jw_product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `sku_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `names` json DEFAULT NULL,
  `images` json DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `compare_price` decimal(15,2) DEFAULT NULL,
  `type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_product_variants`
--

INSERT INTO `jw_product_variants` (`id`, `sku_code`, `barcode`, `title`, `thumbnail`, `description`, `names`, `images`, `price`, `compare_price`, `type`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'qwew32', 'dfdf', 'Default', '2025/02/14/freepicdownloadercom-seafoo.jpg', 'This Is product desc', '[\"Default\"]', NULL, '500.00', '300.00', 'default', 16, '2025-02-14 03:50:15', '2025-02-14 03:50:15'),
(2, NULL, NULL, 'Default', NULL, '', '[\"Default\"]', NULL, NULL, NULL, 'default', 124, '2025-03-29 13:23:28', '2025-03-29 13:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `jw_product_variants_attribute_values`
--

CREATE TABLE `jw_product_variants_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `attribute_value_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_resources`
--

CREATE TABLE `jw_resources` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json_metas` json DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT '1',
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_resources`
--

INSERT INTO `jw_resources` (`id`, `name`, `type`, `thumbnail`, `description`, `json_metas`, `status`, `post_id`, `parent_id`, `created_at`, `updated_at`, `display_order`, `slug`, `uuid`) VALUES
(1, 'name', 'contact-forms', NULL, NULL, NULL, 'publish', NULL, NULL, '2025-03-05 00:46:42', '2025-03-05 00:46:42', 1, 'name', 'bf93479b-78db-442b-9629-4093d546e441');

-- --------------------------------------------------------

--
-- Table structure for table `jw_resource_metas`
--

CREATE TABLE `jw_resource_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `resource_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_roles`
--

CREATE TABLE `jw_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_roles`
--

INSERT INTO `jw_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) VALUES
(1, 'customer', 'web', '2025-02-22 08:00:37', '2025-02-22 08:00:37', 'Ecommerce customer role'),
(2, 'shop_manager', 'web', '2025-02-22 08:00:38', '2025-02-22 08:00:38', 'Can manage products and orders'),
(3, 'New Role', 'web', '2025-03-08 00:18:04', '2025-03-08 00:18:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jw_role_has_permissions`
--

CREATE TABLE `jw_role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_role_has_permissions`
--

INSERT INTO `jw_role_has_permissions` (`permission_id`, `role_id`) VALUES
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
-- Table structure for table `jw_search`
--

CREATE TABLE `jw_search` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `post_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_seo_metas`
--

CREATE TABLE `jw_seo_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `object_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` bigint UNSIGNED NOT NULL,
  `meta_title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_seo_metas`
--

INSERT INTO `jw_seo_metas` (`id`, `object_type`, `object_id`, `meta_title`, `meta_description`) VALUES
(1, 'posts', 12, 'sdsad', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jw_shipping_address`
--

CREATE TABLE `jw_shipping_address` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `province` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_id` bigint DEFAULT NULL,
  `order_id` bigint NOT NULL,
  `shop_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_shipping_methods`
--

CREATE TABLE `jw_shipping_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `province_id` bigint NOT NULL,
  `country_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `shop_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_single_taxonomies`
--

CREATE TABLE `jw_single_taxonomies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `taxonomy` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_post` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_single_taxonomy_metas`
--

CREATE TABLE `jw_single_taxonomy_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `taxonomy_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_social_tokens`
--

CREATE TABLE `jw_social_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `social_provider` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_refresh_token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_table_groups`
--

CREATE TABLE `jw_table_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_rows` bigint NOT NULL DEFAULT '0',
  `migrations` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_table_group_datas`
--

CREATE TABLE `jw_table_group_datas` (
  `id` bigint UNSIGNED NOT NULL,
  `table_group_id` bigint UNSIGNED NOT NULL,
  `table_group_table_id` bigint UNSIGNED NOT NULL,
  `table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_table_group_tables`
--

CREATE TABLE `jw_table_group_tables` (
  `id` bigint UNSIGNED NOT NULL,
  `table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_group_id` bigint UNSIGNED NOT NULL,
  `total_rows` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_taxonomies`
--

CREATE TABLE `jw_taxonomies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxonomy` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `total_post` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` int NOT NULL DEFAULT '0',
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_taxonomies`
--

INSERT INTO `jw_taxonomies` (`id`, `name`, `thumbnail`, `description`, `slug`, `post_type`, `taxonomy`, `parent_id`, `total_post`, `created_at`, `updated_at`, `level`, `uuid`) VALUES
(2, 'new cat', NULL, NULL, 'new-cat', 'posts', 'categories', NULL, 1, '2025-01-17 04:24:19', '2025-01-19 07:44:51', 0, 'fe958ba3-b0ea-4a29-add3-643125aeb23e'),
(5, 'Mango', NULL, NULL, 'mango', 'events', 'categories', NULL, 3, '2025-03-05 10:03:08', '2025-04-02 13:19:13', 0, '562fdb4e-85f8-48fa-853c-8d8498b5322f'),
(6, 'Cat Course 1', NULL, NULL, 'cat-course-1', 'courses', 'categories', NULL, 2, '2025-03-20 11:49:07', '2025-03-21 09:36:20', 0, '3988138d-8765-4a3e-acbe-b9527b14d192');

-- --------------------------------------------------------

--
-- Table structure for table `jw_taxonomy_metas`
--

CREATE TABLE `jw_taxonomy_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `taxonomy_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_telescope_entries`
--

CREATE TABLE `jw_telescope_entries` (
  `sequence` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_telescope_entries_tags`
--

CREATE TABLE `jw_telescope_entries_tags` (
  `entry_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_telescope_monitoring`
--

CREATE TABLE `jw_telescope_monitoring` (
  `tag` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_term_taxonomies`
--

CREATE TABLE `jw_term_taxonomies` (
  `term_id` bigint NOT NULL,
  `taxonomy_id` bigint NOT NULL,
  `term_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_term_taxonomies`
--

INSERT INTO `jw_term_taxonomies` (`term_id`, `taxonomy_id`, `term_type`) VALUES
(1, 2, 'posts'),
(20, 5, 'events'),
(21, 5, 'events'),
(80, 6, 'courses'),
(82, 6, 'courses'),
(132, 5, 'events');

-- --------------------------------------------------------

--
-- Table structure for table `jw_test_eomm_plugin`
--

CREATE TABLE `jw_test_eomm_plugin` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jw_theme_configs`
--

CREATE TABLE `jw_theme_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_theme_configs`
--

INSERT INTO `jw_theme_configs` (`id`, `code`, `theme`, `value`, `created_at`, `updated_at`) VALUES
(1, 'sidebar_sidebar', 'gamxo', '{\"uYdEqfrntd\":{\"title\":null,\"widget\":\"categories\",\"key\":\"uYdEqfrntd\"}}', '2025-01-28 10:57:41', '2025-01-28 10:57:41'),
(2, 'footer_bg_image', 'edufax', '2025/03/02/footer-bg.png', '2025-02-01 10:33:45', '2025-03-02 07:19:36'),
(3, 'sidebar_sidebar', 'edufax', '{\"IAyBP33RoN\":{\"title\":\"Search Here\",\"widget\":\"search_area\",\"key\":\"IAyBP33RoN\"},\"fuWc2TaLeM\":{\"title\":\"title of menu\",\"custom_menu\":\"11\",\"widget\":\"categories_list\",\"key\":\"fuWc2TaLeM\"}}', '2025-02-01 10:47:56', '2025-02-01 12:36:33'),
(4, 'nav_location', 'edufax', '{\"primary\":11}', '2025-02-01 12:47:07', '2025-02-21 12:39:00'),
(5, 'thumbnail_sizes', 'edufax', '{\"pages\":{\"width\":\"241\",\"height\":\"241\"},\"posts\":{\"width\":\"241\",\"height\":\"241\"},\"theme\":{\"width\":\"241\",\"height\":\"241\"},\"plugin\":{\"width\":\"241\",\"height\":\"241\"},\"products\":{\"width\":\"241\",\"height\":\"241\"},\"events\":{\"width\":\"241\",\"height\":\"241\"}}', '2025-03-07 09:51:39', '2025-03-07 09:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `jw_users`
--

CREATE TABLE `jw_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'unconfimred, banned, active',
  `language` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `verification_token` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `json_metas` json DEFAULT NULL,
  `is_fake` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_users`
--

INSERT INTO `jw_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data`, `json_metas`, `is_fake`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$Ii4Uty/j2kbrmb5skyVFMOpMx1qBqP/LWrScoOHoV9xQUM2WdbsdC', '49CZm5hQ75Zv3GuwXFGtVXCw10xxJHHiMJyBhF7b0rjmDvuJmeJrrXPZKHAy', '2024-11-24 19:59:45', '2025-03-21 05:56:36', '2025/03/05/testimonial-img-1.jpg', 1, 'active', 'en', NULL, NULL, '{\"country\": \"AQ\", \"birthday\": \"2025-02-11\"}', 0),
(2, 'hellow world', 'hello@gmail.com', NULL, '$2y$10$yTPeBnir5d..4skcuatmPek/1oppWd5ZGTgl4UAXPx0.nYxalNogO', 'Q69nAW0le3XYyMpZrudEUOQiqIJ7nUjwAUObOpjg4XwXHGDjFV7NsfqmMNGg', '2025-02-01 09:43:44', '2025-02-01 09:43:44', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0),
(3, 'fsfd daac', 'user@gmail.com', NULL, '$2y$10$8AwhsfcdeTiYW8Bxg4E38./E41Of0r1xpCWybLMMV4GkS4CKUTqK6', 's854p71SFIGcSzGGFUMAPYhz4AqsSykFl0dCTxlbnDFN2nxKkAXnhrViOf5Q', '2025-02-21 02:39:24', '2025-02-21 02:39:24', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0),
(5, 'mojahid islam', 'raofahmedmojahid@gmail.com', NULL, '$2y$10$TprMQpHITHKiS0S0ophNGeUOwl1pdVYjJ06CWIdNllSToUeCCfL1O', NULL, '2025-02-23 10:58:01', '2025-02-23 10:58:01', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0),
(6, 'dfdf', 'mojahidgenius48@gmail.com', NULL, '$2y$10$7K.V0Q7JosA6aweW1559MOoRweH3rCtd2IxRreOQI2.O1H3oZAwb2', NULL, '2025-02-23 20:20:18', '2025-02-23 20:20:18', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0),
(7, 'adssd', 'customer@botble.com', NULL, '$2y$10$UBygl7LA.Acy3bX1rHWsM.cjHRcEZKP7tTH/feaORSXvMIXopQSvO', NULL, '2025-03-04 02:24:53', '2025-03-04 02:24:53', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0),
(8, 'Student afdaf', 'student@gmail.com', NULL, '$2y$10$ol5gh5LAP.mz9oMlyD2KpuuRZXgdJBfODBDDauWrfO12hnaoE64ye', '9pcQrT9zT6DRcl7IYIjkRg0NLIqhREnfTIcvzdXXqbpMC9O23ZcdnhhIzVKr', '2025-04-02 12:21:50', '2025-04-03 12:14:35', '2025/04/03/th-1.jpg', 0, 'active', 'en', NULL, NULL, '{\"phone\": \"017733626939\", \"address\": \"Baisherkot\\r\\nMohanpur 3\"}', 0),
(9, 'Student 2', 'student2@gmail.com', NULL, '$2y$10$POtYXa4fM0hqmPhF0ZN6gO7qBGqTBByPc4VunF3kxzZ9M/cd2JqUe', NULL, '2025-04-02 12:24:39', '2025-04-02 12:25:31', NULL, 0, 'active', 'en', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jw_user_metas`
--

CREATE TABLE `jw_user_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `meta_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jw_user_metas`
--

INSERT INTO `jw_user_metas` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'birthday', '2025-02-11'),
(2, 1, 'country', 'AQ'),
(3, 8, 'address', 'Baisherkot\r\nMohanpur 3'),
(4, 8, 'phone', '017733626939');

-- --------------------------------------------------------

--
-- Table structure for table `jw_variants_attributes`
--

CREATE TABLE `jw_variants_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jw_attributes`
--
ALTER TABLE `jw_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_attribute_values`
--
ALTER TABLE `jw_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `jw_comments`
--
ALTER TABLE `jw_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_comments_user_id_index` (`user_id`),
  ADD KEY `jw_comments_email_index` (`email`),
  ADD KEY `jw_comments_object_id_index` (`object_id`),
  ADD KEY `jw_comments_object_type_index` (`object_type`);

--
-- Indexes for table `jw_configs`
--
ALTER TABLE `jw_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_configs_code_unique` (`code`),
  ADD KEY `jw_configs_code_index` (`code`);

--
-- Indexes for table `jw_contact_form_contacts`
--
ALTER TABLE `jw_contact_form_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_contact_form_contacts_created_at_index` (`created_at`),
  ADD KEY `jw_contact_form_contacts_email_index` (`email`),
  ADD KEY `jw_contact_form_contacts_site_id_index` (`site_id`);

--
-- Indexes for table `jw_dev_tool_cms_versions`
--
ALTER TABLE `jw_dev_tool_cms_versions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_dev_tool_cms_versions_version_unique` (`version`);

--
-- Indexes for table `jw_dev_tool_marketplace_plugins`
--
ALTER TABLE `jw_dev_tool_marketplace_plugins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_dev_tool_marketplace_plugins_name_unique` (`name`);

--
-- Indexes for table `jw_dev_tool_marketplace_themes`
--
ALTER TABLE `jw_dev_tool_marketplace_themes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_dev_tool_marketplace_themes_name_unique` (`name`);

--
-- Indexes for table `jw_dev_tool_package_versions`
--
ALTER TABLE `jw_dev_tool_package_versions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pkg_type_version_unique` (`package_name`,`package_type`,`version`);

--
-- Indexes for table `jw_discounts`
--
ALTER TABLE `jw_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_discounts_post_id_foreign` (`post_id`),
  ADD KEY `jw_discounts_code_index` (`code`);

--
-- Indexes for table `jw_ecomm_addons`
--
ALTER TABLE `jw_ecomm_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_ecomm_carts`
--
ALTER TABLE `jw_ecomm_carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_ecomm_carts_code_site_id_unique` (`code`,`site_id`),
  ADD KEY `jw_ecomm_carts_user_id_foreign` (`user_id`),
  ADD KEY `jw_ecomm_carts_site_id_index` (`site_id`);

--
-- Indexes for table `jw_ecomm_currencies`
--
ALTER TABLE `jw_ecomm_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_ecom_download_links`
--
ALTER TABLE `jw_ecom_download_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_ecom_download_links_uuid_unique` (`uuid`),
  ADD KEY `jw_ecom_download_links_product_id_foreign` (`product_id`),
  ADD KEY `jw_ecom_download_links_variant_id_foreign` (`variant_id`),
  ADD KEY `jw_ecom_download_links_site_id_index` (`site_id`);

--
-- Indexes for table `jw_email_lists`
--
ALTER TABLE `jw_email_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_email_lists_email_index` (`email`),
  ADD KEY `jw_email_lists_template_id_index` (`template_id`),
  ADD KEY `jw_email_lists_status_index` (`status`),
  ADD KEY `jw_email_lists_template_code_index` (`template_code`);

--
-- Indexes for table `jw_email_templates`
--
ALTER TABLE `jw_email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_email_templates_code_unique` (`code`),
  ADD UNIQUE KEY `email_templates_uuid_unique` (`uuid`),
  ADD KEY `jw_email_templates_active_index` (`active`);

--
-- Indexes for table `jw_email_template_users`
--
ALTER TABLE `jw_email_template_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_email_template_users_user_id_foreign` (`user_id`),
  ADD KEY `jw_email_template_users_email_template_id_foreign` (`email_template_id`);

--
-- Indexes for table `jw_evman_event_bookings`
--
ALTER TABLE `jw_evman_event_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_evman_event_bookings_code_unique` (`code`),
  ADD KEY `jw_evman_event_bookings_event_id_foreign` (`event_id`),
  ADD KEY `jw_evman_event_bookings_user_id_foreign` (`user_id`),
  ADD KEY `jw_evman_event_bookings_ticket_id_foreign` (`ticket_id`),
  ADD KEY `jw_evman_event_bookings_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `jw_evman_event_bookings_order_id_foreign` (`order_id`);

--
-- Indexes for table `jw_evman_event_tickets`
--
ALTER TABLE `jw_evman_event_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_evman_event_tickets_event_id_foreign` (`event_id`),
  ADD KEY `jw_evman_event_tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `jw_failed_jobs`
--
ALTER TABLE `jw_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jw_jobs`
--
ALTER TABLE `jw_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_jobs_queue_index` (`queue`);

--
-- Indexes for table `jw_jw_translations`
--
ALTER TABLE `jw_jw_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_jw_translations_status_index` (`status`),
  ADD KEY `jw_jw_translations_locale_index` (`locale`),
  ADD KEY `jw_jw_translations_group_index` (`group`),
  ADD KEY `jw_jw_translations_namespace_index` (`namespace`),
  ADD KEY `jw_jw_translations_object_type_index` (`object_type`),
  ADD KEY `jw_jw_translations_object_key_index` (`object_key`);

--
-- Indexes for table `jw_languages`
--
ALTER TABLE `jw_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_languages_code_unique` (`code`),
  ADD KEY `jw_languages_code_index` (`code`);

--
-- Indexes for table `jw_language_lines`
--
ALTER TABLE `jw_language_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_language_lines_namespace_index` (`namespace`),
  ADD KEY `jw_language_lines_group_index` (`group`),
  ADD KEY `jw_language_lines_key_index` (`key`),
  ADD KEY `jw_language_lines_object_type_index` (`object_type`),
  ADD KEY `jw_language_lines_object_key_index` (`object_key`);

--
-- Indexes for table `jw_lms_course_lessons`
--
ALTER TABLE `jw_lms_course_lessons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_lms_course_lessons_slug_unique` (`slug`),
  ADD KEY `jw_lms_course_lessons_post_id_foreign` (`post_id`),
  ADD KEY `jw_lms_course_lessons_course_topic_id_index` (`course_topic_id`);

--
-- Indexes for table `jw_lms_course_topics`
--
ALTER TABLE `jw_lms_course_topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_lms_course_topics_slug_unique` (`slug`),
  ADD KEY `jw_lms_course_topics_post_id_index` (`post_id`);

--
-- Indexes for table `jw_manual_notifications`
--
ALTER TABLE `jw_manual_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_manual_notifications_method_index` (`method`);

--
-- Indexes for table `jw_media_files`
--
ALTER TABLE `jw_media_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_media_files_folder_id_index` (`folder_id`),
  ADD KEY `jw_media_files_user_id_index` (`user_id`),
  ADD KEY `jw_media_files_type_index` (`type`),
  ADD KEY `jw_media_files_mime_type_index` (`mime_type`),
  ADD KEY `jw_media_files_path_index` (`path`),
  ADD KEY `jw_media_files_extension_index` (`extension`),
  ADD KEY `jw_media_files_size_index` (`size`),
  ADD KEY `jw_media_files_disk_index` (`disk`);

--
-- Indexes for table `jw_media_folders`
--
ALTER TABLE `jw_media_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_media_folders_folder_id_index` (`folder_id`),
  ADD KEY `jw_media_folders_type_index` (`type`),
  ADD KEY `jw_media_folders_disk_index` (`disk`);

--
-- Indexes for table `jw_menus`
--
ALTER TABLE `jw_menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_uuid_unique` (`uuid`);

--
-- Indexes for table `jw_menu_items`
--
ALTER TABLE `jw_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `jw_menu_items_parent_id_foreign` (`parent_id`),
  ADD KEY `jw_menu_items_model_class_index` (`model_class`),
  ADD KEY `jw_menu_items_model_id_index` (`model_id`),
  ADD KEY `jw_menu_items_num_order_index` (`num_order`);

--
-- Indexes for table `jw_migrations`
--
ALTER TABLE `jw_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_model_has_permissions`
--
ALTER TABLE `jw_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `jw_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `jw_model_has_roles`
--
ALTER TABLE `jw_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `jw_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `jw_notifications`
--
ALTER TABLE `jw_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `jw_oauth_access_tokens`
--
ALTER TABLE `jw_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `jw_oauth_auth_codes`
--
ALTER TABLE `jw_oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `jw_oauth_clients`
--
ALTER TABLE `jw_oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `jw_oauth_personal_access_clients`
--
ALTER TABLE `jw_oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_oauth_refresh_tokens`
--
ALTER TABLE `jw_oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `jw_orders`
--
ALTER TABLE `jw_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_orders_token_unique` (`token`),
  ADD KEY `jw_orders_type_index` (`type`),
  ADD KEY `jw_orders_status_index` (`status`),
  ADD KEY `jw_orders_payment_method_id_index` (`payment_method_id`),
  ADD KEY `jw_orders_user_id_index` (`user_id`),
  ADD KEY `jw_orders_site_id_index` (`site_id`);

--
-- Indexes for table `jw_order_items`
--
ALTER TABLE `jw_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_order_items_type_index` (`type`),
  ADD KEY `jw_order_items_sku_code_index` (`sku_code`),
  ADD KEY `jw_order_items_barcode_index` (`barcode`),
  ADD KEY `jw_order_items_post_id_index` (`post_id`),
  ADD KEY `jw_order_items_order_id_index` (`order_id`);

--
-- Indexes for table `jw_order_item_metas`
--
ALTER TABLE `jw_order_item_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_order_item_metas_order_item_id_meta_key_unique` (`order_item_id`,`meta_key`),
  ADD KEY `jw_order_item_metas_order_item_id_index` (`order_item_id`),
  ADD KEY `jw_order_item_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_order_metas`
--
ALTER TABLE `jw_order_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_order_metas_order_id_meta_key_unique` (`order_id`,`meta_key`),
  ADD KEY `jw_order_metas_order_id_index` (`order_id`),
  ADD KEY `jw_order_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_pages`
--
ALTER TABLE `jw_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_pages_slug_unique` (`slug`),
  ADD KEY `jw_pages_template_index` (`template`),
  ADD KEY `jw_pages_status_index` (`status`);

--
-- Indexes for table `jw_page_metas`
--
ALTER TABLE `jw_page_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_page_metas_page_id_meta_key_unique` (`page_id`,`meta_key`),
  ADD KEY `jw_page_metas_page_id_index` (`page_id`),
  ADD KEY `jw_page_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_password_resets`
--
ALTER TABLE `jw_password_resets`
  ADD KEY `jw_password_resets_email_index` (`email`);

--
-- Indexes for table `jw_payment_histories`
--
ALTER TABLE `jw_payment_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_payment_histories_transaction_id_unique` (`transaction_id`),
  ADD KEY `jw_payment_histories_payment_method_id_index` (`payment_method_id`);

--
-- Indexes for table `jw_payment_methods`
--
ALTER TABLE `jw_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_payment_methods_type_index` (`type`);

--
-- Indexes for table `jw_permissions`
--
ALTER TABLE `jw_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_permissions_name_guard_unique` (`name`,`guard_name`);

--
-- Indexes for table `jw_permission_groups`
--
ALTER TABLE `jw_permission_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_permission_groups_plugin_index` (`plugin`);

--
-- Indexes for table `jw_personal_access_tokens`
--
ALTER TABLE `jw_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_personal_access_tokens_token_unique` (`token`),
  ADD KEY `jw_personal_access_tokens_tokenable_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `jw_posts`
--
ALTER TABLE `jw_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_posts_slug_unique` (`slug`),
  ADD UNIQUE KEY `posts_uuid_unique` (`uuid`),
  ADD KEY `jw_posts_status_index` (`status`),
  ADD KEY `jw_posts_created_by_index` (`created_by`),
  ADD KEY `jw_posts_updated_by_index` (`updated_by`),
  ADD KEY `jw_posts_type_index` (`type`),
  ADD KEY `jw_posts_locale_index` (`locale`);

--
-- Indexes for table `jw_post_likes`
--
ALTER TABLE `jw_post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_post_likes_post_id_foreign` (`post_id`),
  ADD KEY `jw_post_likes_user_id_index` (`user_id`),
  ADD KEY `jw_post_likes_client_ip_index` (`client_ip`);

--
-- Indexes for table `jw_post_metas`
--
ALTER TABLE `jw_post_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_post_metas_post_id_meta_key_unique` (`post_id`,`meta_key`),
  ADD KEY `jw_post_metas_post_id_index` (`post_id`),
  ADD KEY `jw_post_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_post_ratings`
--
ALTER TABLE `jw_post_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_post_ratings_post_id_index` (`post_id`),
  ADD KEY `jw_post_ratings_client_ip_index` (`client_ip`);

--
-- Indexes for table `jw_post_views`
--
ALTER TABLE `jw_post_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_post_views_post_id_index` (`post_id`),
  ADD KEY `jw_post_views_day_index` (`day`);

--
-- Indexes for table `jw_product_variants`
--
ALTER TABLE `jw_product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_product_variants_sku_code_index` (`sku_code`),
  ADD KEY `jw_product_variants_barcode_index` (`barcode`),
  ADD KEY `jw_product_variants_post_id_index` (`post_id`);

--
-- Indexes for table `jw_product_variants_attribute_values`
--
ALTER TABLE `jw_product_variants_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_id_pivot_foreign` (`product_variant_id`),
  ADD KEY `attribute_id_pivot_foreign` (`attribute_id`),
  ADD KEY `attribute_value_id_pivot_foreign` (`attribute_value_id`);

--
-- Indexes for table `jw_resources`
--
ALTER TABLE `jw_resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_resources_slug_unique` (`slug`),
  ADD UNIQUE KEY `resources_uuid_unique` (`uuid`),
  ADD KEY `jw_resources_post_id_foreign` (`post_id`),
  ADD KEY `jw_resources_parent_id_foreign` (`parent_id`),
  ADD KEY `jw_resources_type_index` (`type`),
  ADD KEY `jw_resources_status_index` (`status`);

--
-- Indexes for table `jw_resource_metas`
--
ALTER TABLE `jw_resource_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_resource_metas_resource_id_meta_key_unique` (`resource_id`,`meta_key`),
  ADD KEY `jw_resource_metas_resource_id_index` (`resource_id`),
  ADD KEY `jw_resource_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_roles`
--
ALTER TABLE `jw_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_roles_name_guard_unique` (`name`,`guard_name`);

--
-- Indexes for table `jw_role_has_permissions`
--
ALTER TABLE `jw_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `jw_role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `jw_search`
--
ALTER TABLE `jw_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_search_post_id_post_type_unique` (`post_id`,`post_type`),
  ADD KEY `jw_search_title_index` (`title`),
  ADD KEY `jw_search_slug_index` (`slug`),
  ADD KEY `jw_search_post_id_index` (`post_id`),
  ADD KEY `jw_search_post_type_index` (`post_type`),
  ADD KEY `jw_search_status_index` (`status`);

--
-- Indexes for table `jw_seo_metas`
--
ALTER TABLE `jw_seo_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_seo_metas_object_type_index` (`object_type`),
  ADD KEY `jw_seo_metas_object_id_index` (`object_id`);

--
-- Indexes for table `jw_shipping_address`
--
ALTER TABLE `jw_shipping_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_shipping_address_order_id_index` (`order_id`),
  ADD KEY `jw_shipping_address_shop_id_index` (`shop_id`);

--
-- Indexes for table `jw_shipping_methods`
--
ALTER TABLE `jw_shipping_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jw_shipping_methods_province_id_index` (`province_id`),
  ADD KEY `jw_shipping_methods_shop_id_index` (`shop_id`);

--
-- Indexes for table `jw_single_taxonomies`
--
ALTER TABLE `jw_single_taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_single_taxonomies_post_type_post_id_unique` (`post_type`,`post_id`),
  ADD UNIQUE KEY `jw_single_taxonomies_slug_unique` (`slug`),
  ADD KEY `jw_single_taxonomies_post_type_index` (`post_type`),
  ADD KEY `jw_single_taxonomies_post_id_index` (`post_id`),
  ADD KEY `jw_single_taxonomies_taxonomy_index` (`taxonomy`);

--
-- Indexes for table `jw_single_taxonomy_metas`
--
ALTER TABLE `jw_single_taxonomy_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_single_taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  ADD KEY `jw_single_taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `jw_single_taxonomy_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_social_tokens`
--
ALTER TABLE `jw_social_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_social_tokens_user_id_social_provider_unique` (`user_id`,`social_provider`),
  ADD KEY `jw_social_tokens_user_id_index` (`user_id`),
  ADD KEY `jw_social_tokens_social_provider_index` (`social_provider`),
  ADD KEY `jw_social_tokens_social_id_index` (`social_id`);

--
-- Indexes for table `jw_table_groups`
--
ALTER TABLE `jw_table_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_table_groups_table_unique` (`table`),
  ADD KEY `jw_table_groups_total_rows_index` (`total_rows`);

--
-- Indexes for table `jw_table_group_datas`
--
ALTER TABLE `jw_table_group_datas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_table_group_datas_real_table_table_key_unique` (`real_table`,`table_key`),
  ADD KEY `jw_table_group_datas_table_group_id_foreign` (`table_group_id`),
  ADD KEY `jw_table_group_datas_table_group_table_id_foreign` (`table_group_table_id`),
  ADD KEY `jw_table_group_datas_table_index` (`table`),
  ADD KEY `jw_table_group_datas_real_table_index` (`real_table`),
  ADD KEY `jw_table_group_datas_table_key_index` (`table_key`);

--
-- Indexes for table `jw_table_group_tables`
--
ALTER TABLE `jw_table_group_tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_table_group_tables_real_table_unique` (`real_table`),
  ADD KEY `jw_table_group_tables_table_group_id_foreign` (`table_group_id`),
  ADD KEY `jw_table_group_tables_table_index` (`table`),
  ADD KEY `jw_table_group_tables_total_rows_index` (`total_rows`);

--
-- Indexes for table `jw_taxonomies`
--
ALTER TABLE `jw_taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_taxonomies_slug_unique` (`slug`),
  ADD UNIQUE KEY `taxonomies_uuid_unique` (`uuid`),
  ADD KEY `jw_taxonomies_post_type_index` (`post_type`),
  ADD KEY `jw_taxonomies_taxonomy_index` (`taxonomy`),
  ADD KEY `jw_taxonomies_parent_id_index` (`parent_id`);

--
-- Indexes for table `jw_taxonomy_metas`
--
ALTER TABLE `jw_taxonomy_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  ADD KEY `jw_taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `jw_taxonomy_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_telescope_entries`
--
ALTER TABLE `jw_telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `jw_telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `jw_telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `jw_telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `jw_telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_should_display_on_index` (`type`,`should_display_on_index`);

--
-- Indexes for table `jw_telescope_entries_tags`
--
ALTER TABLE `jw_telescope_entries_tags`
  ADD KEY `jw_telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `jw_telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `jw_term_taxonomies`
--
ALTER TABLE `jw_term_taxonomies`
  ADD PRIMARY KEY (`term_id`,`term_type`,`taxonomy_id`),
  ADD KEY `jw_term_taxonomies_term_id_index` (`term_id`),
  ADD KEY `jw_term_taxonomies_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `jw_term_taxonomies_term_type_index` (`term_type`);

--
-- Indexes for table `jw_test_eomm_plugin`
--
ALTER TABLE `jw_test_eomm_plugin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_theme_configs`
--
ALTER TABLE `jw_theme_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_theme_configs_code_theme_unique` (`code`,`theme`),
  ADD KEY `jw_theme_configs_code_index` (`code`),
  ADD KEY `jw_theme_configs_theme_index` (`theme`);

--
-- Indexes for table `jw_users`
--
ALTER TABLE `jw_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_users_email_unique` (`email`);

--
-- Indexes for table `jw_user_metas`
--
ALTER TABLE `jw_user_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jw_user_metas_user_id_meta_key_unique` (`user_id`,`meta_key`),
  ADD KEY `jw_user_metas_meta_key_index` (`meta_key`);

--
-- Indexes for table `jw_variants_attributes`
--
ALTER TABLE `jw_variants_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `attribute_id_foreign` (`attribute_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jw_attributes`
--
ALTER TABLE `jw_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_attribute_values`
--
ALTER TABLE `jw_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_comments`
--
ALTER TABLE `jw_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jw_configs`
--
ALTER TABLE `jw_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `jw_dev_tool_cms_versions`
--
ALTER TABLE `jw_dev_tool_cms_versions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jw_dev_tool_marketplace_plugins`
--
ALTER TABLE `jw_dev_tool_marketplace_plugins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jw_dev_tool_marketplace_themes`
--
ALTER TABLE `jw_dev_tool_marketplace_themes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jw_dev_tool_package_versions`
--
ALTER TABLE `jw_dev_tool_package_versions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jw_discounts`
--
ALTER TABLE `jw_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_ecomm_addons`
--
ALTER TABLE `jw_ecomm_addons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_ecomm_carts`
--
ALTER TABLE `jw_ecomm_carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `jw_ecomm_currencies`
--
ALTER TABLE `jw_ecomm_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jw_ecom_download_links`
--
ALTER TABLE `jw_ecom_download_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_email_lists`
--
ALTER TABLE `jw_email_lists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jw_email_templates`
--
ALTER TABLE `jw_email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jw_email_template_users`
--
ALTER TABLE `jw_email_template_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_evman_event_bookings`
--
ALTER TABLE `jw_evman_event_bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `jw_evman_event_tickets`
--
ALTER TABLE `jw_evman_event_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jw_failed_jobs`
--
ALTER TABLE `jw_failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_jobs`
--
ALTER TABLE `jw_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_jw_translations`
--
ALTER TABLE `jw_jw_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_languages`
--
ALTER TABLE `jw_languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jw_language_lines`
--
ALTER TABLE `jw_language_lines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_lms_course_lessons`
--
ALTER TABLE `jw_lms_course_lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jw_lms_course_topics`
--
ALTER TABLE `jw_lms_course_topics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jw_manual_notifications`
--
ALTER TABLE `jw_manual_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jw_media_files`
--
ALTER TABLE `jw_media_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `jw_media_folders`
--
ALTER TABLE `jw_media_folders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `jw_menus`
--
ALTER TABLE `jw_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jw_menu_items`
--
ALTER TABLE `jw_menu_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jw_migrations`
--
ALTER TABLE `jw_migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `jw_oauth_clients`
--
ALTER TABLE `jw_oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_oauth_personal_access_clients`
--
ALTER TABLE `jw_oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_orders`
--
ALTER TABLE `jw_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `jw_order_items`
--
ALTER TABLE `jw_order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `jw_order_item_metas`
--
ALTER TABLE `jw_order_item_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_order_metas`
--
ALTER TABLE `jw_order_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_pages`
--
ALTER TABLE `jw_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_page_metas`
--
ALTER TABLE `jw_page_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_payment_histories`
--
ALTER TABLE `jw_payment_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_payment_methods`
--
ALTER TABLE `jw_payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jw_permissions`
--
ALTER TABLE `jw_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jw_permission_groups`
--
ALTER TABLE `jw_permission_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_personal_access_tokens`
--
ALTER TABLE `jw_personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_posts`
--
ALTER TABLE `jw_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `jw_post_likes`
--
ALTER TABLE `jw_post_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_post_metas`
--
ALTER TABLE `jw_post_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `jw_post_ratings`
--
ALTER TABLE `jw_post_ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_post_views`
--
ALTER TABLE `jw_post_views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `jw_product_variants`
--
ALTER TABLE `jw_product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jw_product_variants_attribute_values`
--
ALTER TABLE `jw_product_variants_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_resources`
--
ALTER TABLE `jw_resources`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jw_resource_metas`
--
ALTER TABLE `jw_resource_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_roles`
--
ALTER TABLE `jw_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jw_search`
--
ALTER TABLE `jw_search`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_seo_metas`
--
ALTER TABLE `jw_seo_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jw_shipping_address`
--
ALTER TABLE `jw_shipping_address`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_shipping_methods`
--
ALTER TABLE `jw_shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_single_taxonomies`
--
ALTER TABLE `jw_single_taxonomies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_single_taxonomy_metas`
--
ALTER TABLE `jw_single_taxonomy_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_social_tokens`
--
ALTER TABLE `jw_social_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_table_groups`
--
ALTER TABLE `jw_table_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_table_group_datas`
--
ALTER TABLE `jw_table_group_datas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_table_group_tables`
--
ALTER TABLE `jw_table_group_tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_taxonomies`
--
ALTER TABLE `jw_taxonomies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jw_taxonomy_metas`
--
ALTER TABLE `jw_taxonomy_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_telescope_entries`
--
ALTER TABLE `jw_telescope_entries`
  MODIFY `sequence` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_test_eomm_plugin`
--
ALTER TABLE `jw_test_eomm_plugin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_theme_configs`
--
ALTER TABLE `jw_theme_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jw_users`
--
ALTER TABLE `jw_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jw_user_metas`
--
ALTER TABLE `jw_user_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jw_variants_attributes`
--
ALTER TABLE `jw_variants_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jw_attribute_values`
--
ALTER TABLE `jw_attribute_values`
  ADD CONSTRAINT `jw_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `jw_attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_comments`
--
ALTER TABLE `jw_comments`
  ADD CONSTRAINT `jw_comments_object_id_foreign` FOREIGN KEY (`object_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_discounts`
--
ALTER TABLE `jw_discounts`
  ADD CONSTRAINT `jw_discounts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jw_ecomm_carts`
--
ALTER TABLE `jw_ecomm_carts`
  ADD CONSTRAINT `jw_ecomm_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jw_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jw_ecom_download_links`
--
ALTER TABLE `jw_ecom_download_links`
  ADD CONSTRAINT `jw_ecom_download_links_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_ecom_download_links_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `jw_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_email_template_users`
--
ALTER TABLE `jw_email_template_users`
  ADD CONSTRAINT `jw_email_template_users_email_template_id_foreign` FOREIGN KEY (`email_template_id`) REFERENCES `jw_email_templates` (`id`),
  ADD CONSTRAINT `jw_email_template_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jw_users` (`id`);

--
-- Constraints for table `jw_evman_event_bookings`
--
ALTER TABLE `jw_evman_event_bookings`
  ADD CONSTRAINT `jw_evman_event_bookings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_evman_event_bookings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `jw_orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jw_evman_event_bookings_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `jw_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jw_evman_event_bookings_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `jw_evman_event_tickets` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jw_evman_event_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jw_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jw_evman_event_tickets`
--
ALTER TABLE `jw_evman_event_tickets`
  ADD CONSTRAINT `jw_evman_event_tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_evman_event_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jw_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jw_lms_course_lessons`
--
ALTER TABLE `jw_lms_course_lessons`
  ADD CONSTRAINT `jw_lms_course_lessons_course_topic_id_foreign` FOREIGN KEY (`course_topic_id`) REFERENCES `jw_lms_course_topics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_lms_course_lessons_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_lms_course_topics`
--
ALTER TABLE `jw_lms_course_topics`
  ADD CONSTRAINT `jw_lms_course_topics_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_menu_items`
--
ALTER TABLE `jw_menu_items`
  ADD CONSTRAINT `jw_menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `jw_menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `jw_menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_model_has_permissions`
--
ALTER TABLE `jw_model_has_permissions`
  ADD CONSTRAINT `jw_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `jw_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_model_has_roles`
--
ALTER TABLE `jw_model_has_roles`
  ADD CONSTRAINT `jw_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `jw_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_orders`
--
ALTER TABLE `jw_orders`
  ADD CONSTRAINT `jw_orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `jw_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jw_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jw_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jw_order_items`
--
ALTER TABLE `jw_order_items`
  ADD CONSTRAINT `jw_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `jw_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_order_items_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jw_order_item_metas`
--
ALTER TABLE `jw_order_item_metas`
  ADD CONSTRAINT `jw_order_item_metas_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `jw_order_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_order_metas`
--
ALTER TABLE `jw_order_metas`
  ADD CONSTRAINT `jw_order_metas_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `jw_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_page_metas`
--
ALTER TABLE `jw_page_metas`
  ADD CONSTRAINT `jw_page_metas_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `jw_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_payment_histories`
--
ALTER TABLE `jw_payment_histories`
  ADD CONSTRAINT `jw_payment_histories_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `jw_payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_post_likes`
--
ALTER TABLE `jw_post_likes`
  ADD CONSTRAINT `jw_post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_post_metas`
--
ALTER TABLE `jw_post_metas`
  ADD CONSTRAINT `jw_post_metas_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_post_ratings`
--
ALTER TABLE `jw_post_ratings`
  ADD CONSTRAINT `jw_post_ratings_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_post_views`
--
ALTER TABLE `jw_post_views`
  ADD CONSTRAINT `jw_post_views_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_product_variants`
--
ALTER TABLE `jw_product_variants`
  ADD CONSTRAINT `jw_product_variants_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_product_variants_attribute_values`
--
ALTER TABLE `jw_product_variants_attribute_values`
  ADD CONSTRAINT `attribute_id_pivot_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `jw_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_value_id_pivot_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `jw_attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_id_pivot_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `jw_product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_resources`
--
ALTER TABLE `jw_resources`
  ADD CONSTRAINT `jw_resources_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `jw_resources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_resources_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_resource_metas`
--
ALTER TABLE `jw_resource_metas`
  ADD CONSTRAINT `jw_resource_metas_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `jw_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_role_has_permissions`
--
ALTER TABLE `jw_role_has_permissions`
  ADD CONSTRAINT `jw_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `jw_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `jw_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_single_taxonomies`
--
ALTER TABLE `jw_single_taxonomies`
  ADD CONSTRAINT `jw_single_taxonomies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `jw_posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_single_taxonomy_metas`
--
ALTER TABLE `jw_single_taxonomy_metas`
  ADD CONSTRAINT `jw_single_taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `jw_single_taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_social_tokens`
--
ALTER TABLE `jw_social_tokens`
  ADD CONSTRAINT `jw_social_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jw_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_table_group_datas`
--
ALTER TABLE `jw_table_group_datas`
  ADD CONSTRAINT `jw_table_group_datas_table_group_id_foreign` FOREIGN KEY (`table_group_id`) REFERENCES `jw_table_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jw_table_group_datas_table_group_table_id_foreign` FOREIGN KEY (`table_group_table_id`) REFERENCES `jw_table_group_tables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_table_group_tables`
--
ALTER TABLE `jw_table_group_tables`
  ADD CONSTRAINT `jw_table_group_tables_table_group_id_foreign` FOREIGN KEY (`table_group_id`) REFERENCES `jw_table_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_taxonomy_metas`
--
ALTER TABLE `jw_taxonomy_metas`
  ADD CONSTRAINT `jw_taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `jw_taxonomies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_telescope_entries_tags`
--
ALTER TABLE `jw_telescope_entries_tags`
  ADD CONSTRAINT `jw_telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `jw_telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `jw_user_metas`
--
ALTER TABLE `jw_user_metas`
  ADD CONSTRAINT `jw_user_metas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `jw_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jw_variants_attributes`
--
ALTER TABLE `jw_variants_attributes`
  ADD CONSTRAINT `attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `jw_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `jw_product_variants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
