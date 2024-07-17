/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `queue` int DEFAULT NULL,
  `time_id` int DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int DEFAULT NULL,
  `admin_read` int DEFAULT NULL,
  `user_read` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `auto_sms_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appointment_id` int DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cancel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_read` int DEFAULT '1',
  `admin_read` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valid_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `feedbacks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sms_token_identity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mobile_identity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `time_slots` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `schedule` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `button` int DEFAULT NULL,
  `buttonDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `appointments` (`id`, `client_id`, `queue`, `time_id`, `time`, `start_time`, `purpose`, `date`, `status`, `admin_read`, `user_read`, `created_at`, `updated_at`) VALUES
(98, 29, 1, NULL, NULL, NULL, 'Sample', '2024-01-08', 2, 1, 1, '2024-01-08 21:54:00', '2024-01-08 22:10:15');
INSERT INTO `appointments` (`id`, `client_id`, `queue`, `time_id`, `time`, `start_time`, `purpose`, `date`, `status`, `admin_read`, `user_read`, `created_at`, `updated_at`) VALUES
(99, 31, 2, NULL, NULL, NULL, 'dental', '2024-01-08', 2, 1, 1, '2024-01-08 21:55:58', '2024-01-08 22:14:26');
INSERT INTO `appointments` (`id`, `client_id`, `queue`, `time_id`, `time`, `start_time`, `purpose`, `date`, `status`, `admin_read`, `user_read`, `created_at`, `updated_at`) VALUES
(100, 30, 3, NULL, NULL, NULL, 'Medical', '2024-01-08', 2, 1, 1, '2024-01-08 21:56:47', '2024-01-08 22:16:15');
INSERT INTO `appointments` (`id`, `client_id`, `queue`, `time_id`, `time`, `start_time`, `purpose`, `date`, `status`, `admin_read`, `user_read`, `created_at`, `updated_at`) VALUES
(101, 28, 4, NULL, NULL, NULL, 'Test', '2024-01-08', 2, 1, 1, '2024-01-08 21:58:29', '2024-01-08 22:16:32'),
(102, 33, 5, NULL, NULL, NULL, 'x-ray', '2024-01-08', 2, 1, 1, '2024-01-08 21:59:47', '2024-01-08 22:16:38'),
(103, 34, 6, NULL, NULL, NULL, 'sample test', '2024-01-08', 2, 1, 1, '2024-01-08 22:00:44', '2024-01-08 22:17:03'),
(106, 32, 7, NULL, NULL, NULL, 'Check-up', '2024-01-08', 2, 1, 1, '2024-01-08 22:31:04', '2024-01-08 22:34:09'),
(107, 36, 1, NULL, NULL, NULL, 'kim1', '2024-01-09', 2, 1, 1, '2024-01-09 09:23:35', '2024-01-09 10:27:55'),
(108, 37, 2, NULL, NULL, NULL, 'sample', '2024-01-09', 3, 1, 1, '2024-01-09 09:24:06', '2024-01-11 13:47:18'),
(109, 30, 3, NULL, NULL, NULL, 'Medical', '2024-01-09', 3, 1, 1, '2024-01-09 09:42:03', '2024-01-11 13:47:18'),
(110, 29, 4, NULL, NULL, NULL, 'Test', '2024-01-09', 3, 1, 1, '2024-01-09 09:42:44', '2024-01-11 13:47:18'),
(111, 33, 5, NULL, NULL, NULL, 'Sample Test', '2024-01-09', 3, 1, 1, '2024-01-09 09:43:48', '2024-01-11 13:47:18'),
(112, 31, 6, NULL, NULL, NULL, 'Dental', '2024-01-09', 3, 1, 1, '2024-01-09 10:09:13', '2024-01-11 13:47:18'),
(113, 38, 7, NULL, NULL, NULL, 'test', '2024-01-09', 3, 1, 1, '2024-01-09 10:12:15', '2024-01-11 13:47:18');

INSERT INTO `auto_sms_history` (`id`, `appointment_id`, `time`, `date`, `created_at`, `updated_at`) VALUES
(69, 98, NULL, '2024-01-08', '2024-01-08 22:04:51', '2024-01-08 22:04:51');
INSERT INTO `auto_sms_history` (`id`, `appointment_id`, `time`, `date`, `created_at`, `updated_at`) VALUES
(70, 99, NULL, '2024-01-08', '2024-01-08 22:05:32', '2024-01-08 22:05:32');
INSERT INTO `auto_sms_history` (`id`, `appointment_id`, `time`, `date`, `created_at`, `updated_at`) VALUES
(71, 100, NULL, '2024-01-08', '2024-01-08 22:05:42', '2024-01-08 22:05:42');
INSERT INTO `auto_sms_history` (`id`, `appointment_id`, `time`, `date`, `created_at`, `updated_at`) VALUES
(72, 101, NULL, '2024-01-08', '2024-01-08 22:05:51', '2024-01-08 22:05:51'),
(73, 102, NULL, '2024-01-08', '2024-01-08 22:06:01', '2024-01-08 22:06:01'),
(74, 103, NULL, '2024-01-08', '2024-01-08 22:06:10', '2024-01-08 22:06:10'),
(75, 104, NULL, '2024-01-08', '2024-01-08 22:21:38', '2024-01-08 22:21:38'),
(76, 106, NULL, '2024-01-08', '2024-01-08 22:32:51', '2024-01-08 22:32:51'),
(77, 108, NULL, '2024-01-09', '2024-01-09 09:24:51', '2024-01-09 09:24:51'),
(78, 107, NULL, '2024-01-09', '2024-01-09 09:24:51', '2024-01-09 09:24:51'),
(79, 110, NULL, '2024-01-09', '2024-01-09 09:44:46', '2024-01-09 09:44:46'),
(80, 109, NULL, '2024-01-09', '2024-01-09 09:44:46', '2024-01-09 09:44:46'),
(81, 111, NULL, '2024-01-09', '2024-01-09 09:44:56', '2024-01-09 09:44:56'),
(82, 112, NULL, '2024-01-09', '2024-01-09 10:10:51', '2024-01-09 10:10:51'),
(83, 113, NULL, '2024-01-09', '2024-01-09 10:12:35', '2024-01-09 10:12:35');

INSERT INTO `cancel` (`id`, `userid`, `reason`, `created_at`, `updated_at`, `user_read`, `admin_read`) VALUES
(23, 29, 'Busy', '2024-01-08 22:24:47', '2024-01-09 06:30:31', 0, 0);
INSERT INTO `cancel` (`id`, `userid`, `reason`, `created_at`, `updated_at`, `user_read`, `admin_read`) VALUES
(24, 29, 'Busy', '2024-01-08 22:25:31', '2024-01-09 06:30:31', 0, 0);


INSERT INTO `client` (`id`, `lastname`, `firstname`, `middlename`, `address`, `birthdate`, `contact_number`, `gender`, `valid_id`, `photo`, `created_at`, `updated_at`) VALUES
(28, 'Lanticse', 'Lester', 'Sandigan', 'Plaridel Bato, Leyte', '2002-06-18', '09101644116', 'M', NULL, 'lanticse-20240108-202016.jpg', '2024-01-08 20:20:16', '2024-01-08 21:53:13');
INSERT INTO `client` (`id`, `lastname`, `firstname`, `middlename`, `address`, `birthdate`, `contact_number`, `gender`, `valid_id`, `photo`, `created_at`, `updated_at`) VALUES
(29, 'Encipido', 'Victor', 'Sandigan', 'Plaridel Bato, Leyte', '2000-12-29', '09459887908', 'M', NULL, 'encipido-20240108-202500.jpg', '2024-01-08 20:25:00', '2024-01-08 21:52:32');
INSERT INTO `client` (`id`, `lastname`, `firstname`, `middlename`, `address`, `birthdate`, `contact_number`, `gender`, `valid_id`, `photo`, `created_at`, `updated_at`) VALUES
(30, 'Toco', 'John Kevin', 'M.', 'Candatag, Malitbog, Southern Leyte', '2001-11-27', '09677983406', 'M', NULL, 'toco-20240108-203213.jpg', '2024-01-08 20:32:14', '2024-01-08 21:53:31');
INSERT INTO `client` (`id`, `lastname`, `firstname`, `middlename`, `address`, `birthdate`, `contact_number`, `gender`, `valid_id`, `photo`, `created_at`, `updated_at`) VALUES
(31, 'Eway', 'Jusaline', 'Alico', 'Waterloo Matalom', '2000-05-08', '09757587235', 'F', NULL, 'eway-20240108-204943.jpg', '2024-01-08 20:49:43', '2024-01-08 21:52:44'),
(32, 'Gato', 'Roberto', 'Alinsub', 'Mahaplag leyte', '2001-07-08', '09062058514', NULL, NULL, 'gato-20240108-221518.jpg', '2024-01-08 21:33:19', '2024-01-08 22:15:18'),
(33, 'Sandigan', 'Aldrin', 'Tutor', 'Plaridel Bato, Leyte', '2005-09-27', '09155022950', 'M', NULL, 'sandigan-20240108-214535.jpg', '2024-01-08 21:45:35', '2024-01-08 21:53:22'),
(34, 'Falcunit', 'Joepat', 'Majoha', 'Limasawa', '2003-11-11', '09307022136', 'M', NULL, 'falcunit-20240108-215147.jpg', '2024-01-08 21:51:47', '2024-01-08 21:52:54'),
(36, 'Cajate', 'Kim Ardeson', 'O', 'Molopolo, Liloan Southern Leyte', '2001-05-14', '09264463467', 'M', NULL, 'cajate-20240109-091824.jpg', '2024-01-09 09:18:24', '2024-01-09 09:21:58'),
(37, 'Cajate', 'Zimmy', 'N', 'Liloan', '20001-05-15', '09971461602', 'M', NULL, 'cajate-20240109-092035.jpg', '2024-01-09 09:20:35', '2024-01-09 09:22:11'),
(38, 'Eway', 'Jusaline', 'N', 'Sogod', '2000-01-01', '09679164522', 'F', NULL, 'eway-20240109-101012.jpg', '2024-01-09 10:10:12', '2024-01-09 10:11:01');





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);





INSERT INTO `sms_token_identity` (`id`, `url`, `access_token`, `mobile_identity`, `created_at`, `updated_at`) VALUES
(1, 'https://api.pushbullet.com/v2/texts', 'o.sPE5bImY9iUESe5Zug9FS4mJrIyKrNJM', 'ujB3m2fpbIOsjyMuuKxIom', '2023-08-15 01:50:31', '2024-01-09 06:37:02');




INSERT INTO `users` (`id`, `client_id`, `username`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `address`, `birthdate`, `gender`, `contact_number`, `middlename`, `photo`, `remember_token`, `status`, `type`, `button`, `buttonDate`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'Admin', 'CTH', 'cth@admin.com', NULL, '$2y$10$ommdPkzU0ephaT/F5Jz.6Ow9pxIAAtuaBIuAhiScpIawxanlur4L2', 'Sogod Southern Leyte', '2023-10-12', 'M', '090000000', 'CTH-AS', 'clinic-20231116-184221.jpg', NULL, 0, 1, 0, '2024-01-17', NULL, '2024-01-17 16:57:22');
INSERT INTO `users` (`id`, `client_id`, `username`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `address`, `birthdate`, `gender`, `contact_number`, `middlename`, `photo`, `remember_token`, `status`, `type`, `button`, `buttonDate`, `created_at`, `updated_at`) VALUES
(50, 28, NULL, NULL, NULL, '09101644116', NULL, '$2y$10$v5BptMjDQhjtkmQAG2Huw.9kgwvSL7tv2hVfoay2ffsdrRSPUH4bK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-08 20:20:16', '2024-01-08 21:53:13');
INSERT INTO `users` (`id`, `client_id`, `username`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `address`, `birthdate`, `gender`, `contact_number`, `middlename`, `photo`, `remember_token`, `status`, `type`, `button`, `buttonDate`, `created_at`, `updated_at`) VALUES
(51, 29, NULL, NULL, NULL, '09459887908', NULL, '$2y$10$kcdOFGEcQSKS50BuTm35veic2vbaaGzfERZ9rIa2gIrlSIt/CmA.u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-08 20:25:01', '2024-01-08 21:52:32');
INSERT INTO `users` (`id`, `client_id`, `username`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `address`, `birthdate`, `gender`, `contact_number`, `middlename`, `photo`, `remember_token`, `status`, `type`, `button`, `buttonDate`, `created_at`, `updated_at`) VALUES
(52, 30, NULL, NULL, NULL, '09677983406', NULL, '$2y$10$eYgE8OVIou7Q8ngq5c1IXuJgVYUcamnPW5PpRIdAuYWy7mF06xv2W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-08 20:32:14', '2024-01-08 21:53:31'),
(53, 31, NULL, NULL, NULL, '09757587235', NULL, '$2y$10$.CdV3jOW1R1xNJrQyafgSuvSwBPMWjAhxuumr3r0gu07hzBUCTtf6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-08 20:49:43', '2024-01-08 21:52:44'),
(54, 32, NULL, NULL, NULL, '09062058514', NULL, '$2y$10$eAODoyxr6b8mqdo2Lew/juOH78v1AmdIvdyDpLblqoq3b.zUBCALG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-08 21:33:19', '2024-01-08 22:15:18'),
(55, 33, NULL, NULL, NULL, '09155022950', NULL, '$2y$10$gwQCqvunlcWQ43JnH4tmyOeMUrjf.tRty5bU5I.WHUdQsXIunjW5q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-08 21:45:35', '2024-01-08 21:53:22'),
(56, 34, NULL, NULL, NULL, '09307022136', NULL, '$2y$10$t.wW.eyJsH6MxNzO.00DEOAUww5OFUt/HJ4ohVyDmxak//NnKMepO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-08 21:51:47', '2024-01-08 21:52:54'),
(58, 36, NULL, NULL, NULL, '09264463467', NULL, '$2y$10$SwlMXtiXpJicqYs7B7FsKOu1HResGyYDJyCJloW5NlAsQPWzBiP4S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-09 09:18:24', '2024-01-09 09:21:58'),
(59, 37, NULL, NULL, NULL, '09971461602', NULL, '$2y$10$NyIieAEp0O5h.J0ZdJB3PO7MkXgxWpusOsdVaqMv8ZBSgDlnQAS0a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-09 09:20:35', '2024-01-09 09:22:11'),
(60, 38, NULL, NULL, NULL, '09679164522', NULL, '$2y$10$Zr6Nb4RmUdnSIV46DMPn2urhVVTEvov4H/IdhnhwWRgspHHLfN0bu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL, '2024-01-09 10:10:12', '2024-01-09 10:11:01');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;