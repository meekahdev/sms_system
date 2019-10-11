-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.15 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sms.category_master
CREATE TABLE IF NOT EXISTS `category_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `description` text,
  `comment` text,
  `updated_by` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table sms.category_master: ~9 rows (approximately)
/*!40000 ALTER TABLE `category_master` DISABLE KEYS */;
INSERT INTO `category_master` (`id`, `name`, `description`, `comment`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Food', 'Foodie', 'asd', 1, '2019-06-30 13:07:44', '2019-07-04 19:05:22'),
	(3, 'Mobile', 'ad', 'dsa', 1, '2019-06-30 13:08:03', '2019-06-30 13:08:05'),
	(4, 'Vehicle', 'qqeqw', 'asd', 1, '2019-06-30 13:08:27', NULL),
	(5, 'Perosonal Expense', '123', 'asd', NULL, '2019-06-30 13:32:09', NULL),
	(6, 'Grooming', '123', '21', NULL, '2019-06-30 13:32:21', NULL),
	(7, 'Clothing Expense', '12', '32', NULL, '2019-06-30 13:32:38', NULL),
	(13, 'test', 'asd', 'dsa', NULL, '2019-07-04 19:15:45', '2019-07-04 19:15:45'),
	(16, 'E Verify', 'Voluptate non. Sem incididunt eaque sed nam adipisci? Velit id.', 'Voluptate non. Sem incididunt eaque sed nam adipisci? Velit id.', NULL, '2019-07-05 16:49:45', '2019-07-05 16:49:45'),
	(17, 'Category Temp', 'test', 'Reprehenderit quia occaecat aliqua hac deleniti saepe at turpis, ullamco.', NULL, '2019-07-06 05:32:04', '2019-07-06 05:32:04');
/*!40000 ALTER TABLE `category_master` ENABLE KEYS */;

-- Dumping structure for table sms.expenses_master
CREATE TABLE IF NOT EXISTS `expenses_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text,
  `comment` text,
  `amount` decimal(10,2) DEFAULT NULL,
  `generated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table sms.expenses_master: ~2 rows (approximately)
/*!40000 ALTER TABLE `expenses_master` DISABLE KEYS */;
INSERT INTO `expenses_master` (`id`, `user_id`, `category_id`, `description`, `comment`, `amount`, `generated_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'asdasdasd', 'wqewasdas', 100.54, '2019-09-05 13:27:37', '2019-09-05 13:27:38', '2019-09-05 13:27:39'),
	(3, 1, 4, 'asd', 'asdaw', 99.99, '2019-09-26 00:00:00', '2019-09-05 17:28:27', '2019-09-05 17:28:27');
/*!40000 ALTER TABLE `expenses_master` ENABLE KEYS */;

-- Dumping structure for table sms.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table sms.migrations: ~2 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table sms.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table sms.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table sms.report_master
CREATE TABLE IF NOT EXISTS `report_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sms.report_master: ~0 rows (approximately)
/*!40000 ALTER TABLE `report_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_master` ENABLE KEYS */;

-- Dumping structure for table sms.roles_master
CREATE TABLE IF NOT EXISTS `roles_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `permission` text,
  `is_editable` tinyint(4) DEFAULT NULL,
  `rank` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table sms.roles_master: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles_master` DISABLE KEYS */;
INSERT INTO `roles_master` (`id`, `name`, `slug`, `permission`, `is_editable`, `rank`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin', 'all', 1, 99, '2019-07-28 12:32:22', '2019-07-28 12:32:23'),
	(2, 'User', 'user', 'restricted', 1, 89, '2019-07-28 12:32:41', '2019-07-28 12:32:41');
/*!40000 ALTER TABLE `roles_master` ENABLE KEYS */;

-- Dumping structure for table sms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table sms.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `user_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Abdul Hakeem', 'admin@gmail.com', '1', '$2y$10$kqYBRwITFgXx/BamYq1uBew1iZccm4Th5w49BL6Usy/n7UMyYrjDy', 'QiuJ6J2RM5Ozoh6AK8oB06dqJMluDPiT9L0qo9qVjrXIb8Vs43jERGtvNmEU', '2019-06-25 12:42:45', '2019-07-06 13:21:32'),
	(2, 'Temp', 'a.hkm96@gmail.com', '2', '$2y$10$ge.SJFiUSs7RZCF0xof97.VKebkX2KtmsJWek0rD7zIZJZJfE8yUK', 'xaynBjD5T5MpCqRQ9GkpKSXOr9Iv7Kt2aAw8Xf7t786gcGQTUhqLDU828Npy', '2019-06-29 08:55:18', '2019-06-29 08:56:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table sms.user_details
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` text,
  `city` text,
  `zipcode` varchar(50) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table sms.user_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` (`id`, `user_id`, `first_name`, `last_name`, `address`, `city`, `zipcode`, `phone_no`, `dob`, `salary`, `created_at`, `updated_at`) VALUES
	(2, 1, 'Abdul', 'Hakeem', '1831  Derek Drive', 'Akron', '44307', '0771545465', '1996-10-24', 800000.00, '2019-07-28 08:14:52', '2019-09-07 09:23:13');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
