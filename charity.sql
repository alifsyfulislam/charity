-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 11, 2021 at 10:22 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

DROP TABLE IF EXISTS `abouts`;
CREATE TABLE IF NOT EXISTS `abouts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abouts_name_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `name`, `slug`, `details`, `status`, `created_at`, `updated_at`) VALUES
('16285322703079', 'Wellcome to our Charity', 'wellcome-to-our-charity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus velit ullamcorper id. Quisque at erat eu libero consequat tempus. Quisque molestie convallis tempus. Ut semper purus metus, a euismod sapien sodales ac. Duis viverra eleifend fermentum', 1, '2021-08-09 12:04:30', '2021-08-09 12:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

DROP TABLE IF EXISTS `causes`;
CREATE TABLE IF NOT EXISTS `causes` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `target_fund` bigint NOT NULL,
  `raised_fund` bigint NOT NULL,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `causes_name_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `event_id`, `name`, `slug`, `details`, `target_fund`, `raised_fund`, `status`, `created_at`, `updated_at`) VALUES
('16284396044333', '16284395424238', 'Hunger City XX', 'hunger-city-xx', NULL, 100000, 0, 1, '2021-08-08 10:20:04', '2021-08-08 10:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `subject`, `email`, `body`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Update faq', 'alifsyfulislam@gmail.com', 'Please update as soon as possible.', 1, '2021-08-09 11:21:07', '2021-08-09 11:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_name_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `slug`, `location`, `details`, `status`, `created_at`, `updated_at`) VALUES
('16284395424238', 'Toys for Children Campaign', 'toys-for-children-campaign', 'Cox\'s bazar, Bangladesh', NULL, 1, '2021-08-08 10:19:02', '2021-08-08 10:19:02'),
('16284388558474', 'Water for Children AID', 'water-for-children-aid', 'Cox\'s bazar, Bangladesh', NULL, 1, '2021-08-08 10:07:35', '2021-08-08 10:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faqs_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `name`, `slug`, `details`, `status`, `created_at`, `updated_at`) VALUES
('16285272566282', 'Why my mobile is not working?', 'why-my-mobile-is-not-working-', 'lack of charge!', 0, '2021-08-09 10:40:56', '2021-08-09 10:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_name_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `event_id`, `name`, `slug`, `details`, `status`, `created_at`, `updated_at`) VALUES
('16284395826924', '16284395424238', 'Toys for Children Campaign', 'toys-for-children-campaign', NULL, 1, '2021-08-08 10:19:42', '2021-08-08 10:19:42'),
('16284392853235', '16284388558474', 'Toys for Children Campaign', 'toys-for-children-campaign', NULL, 1, '2021-08-08 10:14:45', '2021-08-08 10:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8mb4_unicode_ci,
  `mediable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediable_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_mediable_type_mediable_id_index` (`mediable_type`,`mediable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `url`, `mediable_type`, `mediable_id`, `created_at`, `updated_at`) VALUES
(2, 'http://localhost/charity/public/uploads/service/20210803042802-france.jpg', 'App\\Models\\Service', 16279645552256, '2021-08-02 22:23:05', '2021-08-02 22:28:02'),
(19, 'http://localhost/charity/public/uploads/avatar/20210808052532-c.jpg', 'App\\Models\\User', 16284435326152, '2021-08-08 11:25:32', '2021-08-08 11:25:32'),
(16, 'http://localhost/charity/public/uploads/event/20210808041902-c.jpg', 'App\\Models\\Event', 16284395424238, '2021-08-08 10:19:02', '2021-08-08 10:19:02'),
(17, 'http://localhost/charity/public/uploads/gallery/20210808041942-xa.jpg.pagespeed.ic.aqyj5othgv.jpg', 'App\\Models\\Gallery', 16284395826924, '2021-08-08 10:19:42', '2021-08-08 10:19:42'),
(18, 'http://localhost/charity/public/uploads/cause/20210808042004-cbc-report.jpg', 'App\\Models\\Cause', 16284396044333, '2021-08-08 10:20:05', '2021-08-08 10:20:05'),
(14, 'http://localhost/charity/public/uploads/event/20210808040735-c.jpg', 'App\\Models\\Event', 16284388558474, '2021-08-08 10:07:35', '2021-08-08 10:07:35'),
(15, 'http://localhost/charity/public/uploads/gallery/20210808041445-xa.jpg.pagespeed.ic.aqyj5othgv.jpg', 'App\\Models\\Gallery', 16284392853235, '2021-08-08 10:14:45', '2021-08-08 10:14:45'),
(20, 'http://localhost/charity/public/uploads/avatar/20210808053136-c.jpg', 'App\\Models\\User', 16284438962710, '2021-08-08 11:31:36', '2021-08-08 11:31:36'),
(21, 'http://localhost/charity/public/uploads/avatar/20210808054538-france.jpg', 'App\\Models\\User', 16284440238159, '2021-08-08 11:33:43', '2021-08-08 11:45:38'),
(22, 'http://localhost/charity/public/uploads/avatar/20210808055538-euro-fixtures.jpg', 'App\\Models\\User', 16284453382607, '2021-08-08 11:55:38', '2021-08-08 11:55:38'),
(23, 'http://localhost/charity/public/uploads/service/20210808060442-modern-footer.jpg', 'App\\Models\\Service', 16284458827522, '2021-08-08 12:04:42', '2021-08-08 12:04:42'),
(28, 'http://localhost/charity/public/uploads/about/20210809060249-c.jpg', 'App\\Models\\About', 16285321694152, '2021-08-09 12:02:49', '2021-08-09 12:02:49'),
(25, 'http://localhost/charity/public/uploads/avatar/20210809041922-france.jpg', 'App\\Models\\User', 16284460887488, '2021-08-08 12:08:08', '2021-08-09 10:19:22'),
(27, 'http://localhost/charity/public/uploads/avatar/20210809015737-euro-fixtures.jpg', 'App\\Models\\User', 16285174575638, '2021-08-09 07:57:37', '2021-08-09 07:57:37'),
(29, 'http://localhost/charity/public/uploads/about/20210809061322-france.jpg', 'App\\Models\\About', 16285322703079, '2021-08-09 12:04:30', '2021-08-09 12:13:22'),
(31, 'http://localhost/charity/public/uploads/avatar/20210810113201-euro-fixtures.jpg', 'App\\Models\\User', 16285951215454, '2021-08-10 05:32:01', '2021-08-10 05:32:01'),
(32, 'http://localhost/charity/public/uploads/avatar/20210810113257-euro-fixtures.jpg', 'App\\Models\\User', 16285951772499, '2021-08-10 05:32:57', '2021-08-10 05:32:57'),
(33, 'http://localhost/charity/public/uploads/avatar/20210810113422-euro-fixtures.jpg', 'App\\Models\\User', 16285952628815, '2021-08-10 05:34:23', '2021-08-10 05:34:23'),
(34, 'http://localhost/charity/public/uploads/avatar/20210810114947-france.jpg', 'App\\Models\\User', 16285955525905, '2021-08-10 05:39:13', '2021-08-10 05:49:47'),
(35, 'http://localhost/charity/public/uploads/avatar/20210810121551-euro-fixtures.jpg', 'App\\Models\\User', 16285977518738, '2021-08-10 06:15:51', '2021-08-10 06:15:51'),
(36, 'http://localhost/charity/public/uploads/avatar/20210810123215-euro-fixtures.jpg', 'App\\Models\\User', 16285987353614, '2021-08-10 06:32:15', '2021-08-10 06:32:15'),
(37, 'http://localhost/charity/public/uploads/avatar/20210810124949-euro-fixtures.jpg', 'App\\Models\\User', 16285997898872, '2021-08-10 06:49:49', '2021-08-10 06:49:49'),
(38, 'http://localhost/charity/public/uploads/avatar/20210810125454-france.jpg', 'App\\Models\\User', 16285998442868, '2021-08-10 06:50:44', '2021-08-10 06:54:54'),
(40, 'http://localhost/charity/public/uploads/avatar/20210810011844-france.jpg', 'App\\Models\\User', 16286007633927, '2021-08-10 07:06:03', '2021-08-10 07:18:44'),
(41, 'http://localhost/charity/public/uploads/avatar/20210810013142-euro-fixtures.jpg', 'App\\Models\\User', 16286023026497, '2021-08-10 07:31:43', '2021-08-10 07:31:43'),
(42, 'http://localhost/charity/public/uploads/avatar/20210810023219-france.jpg', 'App\\Models\\User', 16286024811741, '2021-08-10 07:34:41', '2021-08-10 08:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(67, '2014_10_12_000000_create_users_table', 4),
(53, '2014_10_12_100000_create_password_resets_table', 1),
(54, '2019_08_19_000000_create_failed_jobs_table', 1),
(55, '2021_07_30_042141_create_services_table', 1),
(56, '2021_07_30_043406_create_events_table', 1),
(57, '2021_08_02_152037_create_media_table', 1),
(58, '2021_08_08_105540_create_causes_table', 2),
(59, '2021_08_08_152230_create_galleries_table', 3),
(74, '2021_08_09_083649_create_roles_table', 5),
(75, '2021_08_09_131647_create_users_roles_table', 6),
(76, '2021_08_09_162609_create_faqs_table', 7),
(77, '2021_08_09_170240_create_contacts_table', 8),
(80, '2021_08_09_174539_create_abouts_table', 9),
(81, '2021_08_10_101659_create_permissions_table', 10),
(82, '2021_08_10_105706_create_roles_permissions_table', 11),
(83, '2021_08_10_112546_create_users_permissions_table', 12),
(84, '2016_06_01_000001_create_oauth_auth_codes_table', 13),
(85, '2016_06_01_000002_create_oauth_access_tokens_table', 13),
(86, '2016_06_01_000003_create_oauth_refresh_tokens_table', 13),
(87, '2016_06_01_000004_create_oauth_clients_table', 13),
(88, '2016_06_01_000005_create_oauth_personal_access_clients_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('3563fff3fc78331d628d8da50477fc7aa7dd3085a55915d9e7e7e7331331217c9d96a7cf75b2561c', 16286024811741, 1, 'Knowledge Base', '[]', 0, '2021-08-10 09:15:59', '2021-08-10 09:15:59', '2022-08-10 15:15:59'),
('b958a09cf4cd755e54cc60f57c8358972ccbba00bff0ff58bb89a8f84e0f1263ed8f26297a4d86cb', 16286024811741, 1, 'Charity', '[]', 0, '2021-08-10 09:17:24', '2021-08-10 09:17:24', '2022-08-10 15:17:24'),
('fd9515a14c86bfc59ed422747e9beac8b8dd2cd719130e9ab6777355afaee019481c11c0b51f8a21', 16286024811741, 1, 'Charity', '[]', 0, '2021-08-10 09:48:00', '2021-08-10 09:48:00', '2022-08-10 15:48:00'),
('7a7f854bd8aee6df8fbc65bdc08a0b484bc915d4021d67e4ee8e0baafb719ce2e79554c5353c5c8e', 16286024811741, 1, 'Charity', '[]', 0, '2021-08-10 10:01:57', '2021-08-10 10:01:57', '2022-08-10 16:01:57'),
('a5bc89962b754ff163f4b8a5e7fbb0e74a4adf3a6e9fda9810dd267a31b47040a204ea230ce9b4d7', 16286024811741, 1, 'Charity', '[]', 0, '2021-08-10 10:03:27', '2021-08-10 10:03:27', '2022-08-10 16:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'YP7BNfr8FdPQ3HAD30ffTslLtL7DoYRowU7UBEwY', NULL, 'http://localhost', 1, 0, 0, '2021-08-10 08:49:23', '2021-08-10 08:49:23'),
(2, NULL, 'Laravel Password Grant Client', 'qCT7Qrj0a16Vx1qFVX1ZJRiN4RKHRq9wiEnGY5SF', 'users', 'http://localhost', 0, 1, 0, '2021-08-10 08:49:23', '2021-08-10 08:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-08-10 08:49:23', '2021-08-10 08:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_name_index` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Admin Panel', 'admin-panel', 'Only they can act in dashboard', '2021-08-10 04:32:45', '2021-08-10 04:34:17'),
(2, 'User Panel', 'user-panel', NULL, '2021-08-10 04:33:06', '2021-08-10 04:33:06'),
(4, 'User Action', 'user-action', NULL, '2021-08-10 05:23:06', '2021-08-10 05:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_name_index` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', NULL, 1, '2021-08-09 05:55:29', '2021-08-09 05:56:03'),
(3, 'Data Analyst', 'data-analyst', NULL, 0, '2021-08-09 05:55:45', '2021-08-09 05:55:45'),
(11, 'test1011', 'test1011', NULL, 1, '2021-08-10 07:09:47', '2021-08-10 07:09:47'),
(10, 'test101', 'test101', NULL, 1, '2021-08-10 07:08:29', '2021-08-10 07:08:29'),
(8, 'Operator', 'operator', NULL, 1, '2021-08-10 05:11:13', '2021-08-10 05:11:13'),
(9, 'Test', 'test', NULL, 1, '2021-08-10 07:06:25', '2021-08-10 07:06:25'),
(12, 'Super Admin XX', 'super-admin-xx', NULL, 1, '2021-08-10 07:10:21', '2021-08-10 08:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

DROP TABLE IF EXISTS `roles_permissions`;
CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `roles_permissions_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(12, 1),
(12, 2),
(12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `details`, `status`, `created_at`, `updated_at`) VALUES
('16279645552256', 'France', 'france', 'ok', 1, '2021-08-02 22:22:35', '2021-08-02 22:28:02'),
('16284458827522', 'test', 'test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam', 0, '2021-08-08 12:04:42', '2021-08-09 06:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `slug`, `username`, `email`, `mobile`, `address`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
('16286024811741', 'Mrs.', 'Sa', 'Sa', 'mrs-sa-sa', 'sari', 'alifsyfulislam@gmail.cum', 'sanjidasultanaq2288@gmail.com', NULL, NULL, '$2y$10$eTg0nA8RZ0pOX0imdcKQAuenN5O782qvI0REoH/Ff6ztWIM/7UF9q', NULL, 1, '2021-08-10 07:34:41', '2021-08-10 08:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

DROP TABLE IF EXISTS `users_permissions`;
CREATE TABLE IF NOT EXISTS `users_permissions` (
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `users_permissions_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`user_id`, `permission_id`) VALUES
('16286024811741', 1),
('16286024811741', 2),
('16286024811741', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `users_roles_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
('16286024811741', 12);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
