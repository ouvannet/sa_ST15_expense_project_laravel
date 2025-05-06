-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_12_08_032949_create_tbl_user_table',1),(6,'2024_12_08_033021_create_tbl_role_table',1),(7,'2024_12_08_033039_create_tbl_recurring_expense_table',1),(8,'2024_12_08_033100_create_tbl_expense_payment_table',1),(9,'2024_12_08_033159_create_tbl_expense_table',1),(10,'2024_12_08_033215_create_tbl_department_table',1),(11,'2024_12_08_033231_create_tbl_categories_table',1),(12,'2024_12_08_045701_create_tbl_permissions_table',1),(13,'2024_12_08_045843_create_tbl_permission_role_table',1),(14,'2024_12_25_131423_create_tbl_reference_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categories`
--

LOCK TABLES `tbl_categories` WRITE;
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
INSERT INTO `tbl_categories` VALUES (21,'Food','money for foods'),(42,'Seak Seyha','ddd'),(37,'Salary','money for employee'),(20,'Electric','money for nothing'),(45,'heigt','flsdf;'),(38,'Gas','fdsfkj;ls'),(41,'testing','fdsf;');
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_department` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` VALUES (1,'Finance','testing'),(3,'IT','ddd'),(6,'Programming','teesting'),(10,'Marketing','fdsfd'),(11,'testing','dd');
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_expense`
--

DROP TABLE IF EXISTS `tbl_expense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_expense` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recurring_expense_id` bigint DEFAULT NULL,
  `categories_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `budget` int NOT NULL,
  `budget_balance` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign` bigint unsigned DEFAULT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `reference_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference_number` (`reference_number`),
  KEY `fk_assign_user` (`assign`),
  KEY `fk_tbl_expense_recurring_expense_id` (`recurring_expense_id`)
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_expense`
--

LOCK TABLES `tbl_expense` WRITE;
/*!40000 ALTER TABLE `tbl_expense` DISABLE KEYS */;
INSERT INTO `tbl_expense` VALUES (156,NULL,21,16,100,60,NULL,NULL,'Approved',3,'2025-04-19 17:00:00.000000','EXP0111'),(157,NULL,21,16,100,100,NULL,NULL,'Pending',NULL,'2025-04-28 17:00:00.000000','EXP0112');
/*!40000 ALTER TABLE `tbl_expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_expense_payment`
--

DROP TABLE IF EXISTS `tbl_expense_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_expense_payment` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` bigint unsigned NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_expense_payment`
--

LOCK TABLES `tbl_expense_payment` WRITE;
/*!40000 ALTER TABLE `tbl_expense_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_expense_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_expense_usage`
--

DROP TABLE IF EXISTS `tbl_expense_usage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_expense_usage` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `used_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expense_reference_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_id` (`expense_id`),
  KEY `expense_reference_number` (`expense_reference_number`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_expense_usage`
--

LOCK TABLES `tbl_expense_usage` WRITE;
/*!40000 ALTER TABLE `tbl_expense_usage` DISABLE KEYS */;
INSERT INTO `tbl_expense_usage` VALUES (68,156,30.00,'2025-04-29 07:42:47',NULL,NULL,'EXP0111','PAY0016','ABA'),(67,156,10.00,'2025-04-29 07:42:38',NULL,NULL,'EXP0111','PAY0015','Cash'),(66,156,10.00,'2025-04-19 22:58:31',NULL,NULL,'EXP0111','PAY0014','ABA'),(65,156,5.00,'2025-04-19 22:58:23',NULL,NULL,'EXP0111','PAY0013','ABA');
/*!40000 ALTER TABLE `tbl_expense_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permission_role`
--

DROP TABLE IF EXISTS `tbl_permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_permission_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permission_role`
--

LOCK TABLES `tbl_permission_role` WRITE;
/*!40000 ALTER TABLE `tbl_permission_role` DISABLE KEYS */;
INSERT INTO `tbl_permission_role` VALUES (74,27,1,NULL,NULL),(73,26,1,NULL,NULL),(84,5,4,NULL,NULL),(88,5,5,NULL,NULL),(83,4,4,NULL,NULL),(72,25,1,NULL,NULL),(71,24,1,NULL,NULL),(70,23,1,NULL,NULL),(69,22,1,NULL,NULL),(68,21,1,NULL,NULL),(67,20,1,NULL,NULL),(66,19,1,NULL,NULL),(65,18,1,NULL,NULL),(64,17,1,NULL,NULL),(63,16,1,NULL,NULL),(62,15,1,NULL,NULL),(61,14,1,NULL,NULL),(60,13,1,NULL,NULL),(59,12,1,NULL,NULL),(58,11,1,NULL,NULL),(57,10,1,NULL,NULL),(56,8,1,NULL,NULL),(55,5,1,NULL,NULL),(54,4,1,NULL,NULL),(53,9,1,NULL,NULL),(75,28,1,NULL,NULL),(82,9,4,NULL,NULL),(87,4,5,NULL,NULL),(86,9,5,NULL,NULL),(85,8,4,NULL,NULL),(89,8,5,NULL,NULL);
/*!40000 ALTER TABLE `tbl_permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissions`
--

DROP TABLE IF EXISTS `tbl_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissions`
--

LOCK TABLES `tbl_permissions` WRITE;
/*!40000 ALTER TABLE `tbl_permissions` DISABLE KEYS */;
INSERT INTO `tbl_permissions` VALUES (9,'Add_Expense','2025-03-28 05:41:57','2025-03-28 05:41:57'),(4,'Approve_Expense','2025-02-03 07:19:15','2025-02-03 07:19:15'),(5,'Edit_Expense','2025-02-03 07:22:06','2025-02-03 07:22:06'),(8,'Delete_Expense','2025-02-03 08:13:23','2025-03-28 04:28:11'),(10,'Add_Category','2025-03-28 05:42:11','2025-03-28 05:42:11'),(11,'Edit_Category','2025-03-28 05:42:25','2025-03-28 05:42:25'),(12,'Delete_Category','2025-03-28 05:42:36','2025-03-28 05:42:36'),(13,'Add_Department','2025-03-28 06:00:18','2025-03-28 06:00:18'),(14,'Edit_Department','2025-03-28 06:00:30','2025-03-28 06:00:30'),(15,'Delete_Department','2025-03-28 06:00:40','2025-03-28 06:00:40'),(16,'Add_Recurring','2025-03-28 06:00:55','2025-03-28 06:00:55'),(17,'Edit_Recurring','2025-03-28 06:01:08','2025-03-28 06:01:08'),(18,'Delete_Recurring','2025-03-28 06:01:24','2025-03-28 06:01:24'),(19,'Add_User','2025-03-28 06:12:18','2025-03-28 06:12:18'),(20,'Edit_User','2025-03-28 06:12:31','2025-03-28 06:12:31'),(21,'Delete_User','2025-03-28 06:12:41','2025-03-28 06:12:41'),(22,'Add_Role','2025-03-28 06:13:59','2025-03-28 06:13:59'),(23,'Edit_Role','2025-03-28 06:14:20','2025-03-28 06:14:20'),(24,'Delete_Role','2025-03-28 06:14:33','2025-03-28 06:14:33'),(25,'Add_Permission','2025-03-28 06:15:02','2025-03-28 06:15:02'),(26,'Edit_Permission','2025-03-28 06:15:15','2025-03-28 06:15:15'),(27,'Delete_Permission','2025-03-28 06:15:26','2025-03-28 06:15:26'),(28,'Set_Permission','2025-04-08 05:24:31','2025-04-08 05:24:31'),(29,'View_Expense','2025-04-08 05:30:31','2025-04-08 05:30:31'),(30,'View_Dashboard','2025-04-08 05:31:03','2025-04-08 05:31:03'),(31,'View_Category','2025-04-08 05:31:14','2025-04-08 05:31:14'),(32,'View_People','2025-04-08 05:31:23','2025-04-08 05:31:23'),(33,'View_Department','2025-04-08 05:31:30','2025-04-08 05:31:30'),(34,'View_Recurring','2025-04-08 05:31:39','2025-04-08 05:31:39'),(35,'View_Report','2025-04-08 05:31:49','2025-04-08 05:31:49');
/*!40000 ALTER TABLE `tbl_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_recurring_expense`
--

DROP TABLE IF EXISTS `tbl_recurring_expense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_recurring_expense` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` bigint DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `frequency` enum('daily','weekly','monthly','yearly') NOT NULL,
  `next_run_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive','canceled') DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_recurring_expense`
--

LOCK TABLES `tbl_recurring_expense` WRITE;
/*!40000 ALTER TABLE `tbl_recurring_expense` DISABLE KEYS */;
INSERT INTO `tbl_recurring_expense` VALUES (31,21,16,100.00,'daily','2025-04-30','2025-04-29 04:40:00','2025-05-30 17:00:00','2025-04-29 04:40:07','active','2025-04-28 17:00:00'),(30,21,16,100.00,'daily','2025-04-20','2025-04-19 22:29:18','2025-04-21 17:00:00','2025-04-19 22:29:18','active','2025-04-19 17:00:00');
/*!40000 ALTER TABLE `tbl_recurring_expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reference`
--

DROP TABLE IF EXISTS `tbl_reference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_reference` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `value` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `expense_id` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reference`
--

LOCK TABLES `tbl_reference` WRITE;
/*!40000 ALTER TABLE `tbl_reference` DISABLE KEYS */;
INSERT INTO `tbl_reference` VALUES (3,'expense',113,'2024-12-26 12:17:05','2025-04-29 14:40:47'),(4,'payment',17,'2025-02-28 11:21:47','2025-04-29 14:42:47');
/*!40000 ALTER TABLE `tbl_reference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_role`
--

DROP TABLE IF EXISTS `tbl_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_role`
--

LOCK TABLES `tbl_role` WRITE;
/*!40000 ALTER TABLE `tbl_role` DISABLE KEYS */;
INSERT INTO `tbl_role` VALUES (1,'Admin',NULL,'2025-01-15 06:09:29'),(4,'Manager','2024-12-21 21:12:54','2024-12-21 21:12:54'),(5,'Account','2024-12-21 21:13:08','2024-12-21 21:13:08'),(6,'Staff','2024-12-21 21:13:14','2024-12-21 21:13:14');
/*!40000 ALTER TABLE `tbl_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint unsigned NOT NULL DEFAULT '1',
  `role_id` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (3,'seyha','male','2024-12-31','seyha@gmail.com','0123456789','$2y$10$1p3OipfvchfqhuzoRU2efeET814O/YebzUAbPWwOUsWvjVjieb7I.',1,1,NULL,NULL),(16,'test2','male','2025-03-27','test2@gmail.com','23232323','$2y$10$oxskvY.4Whonx5ALFQnbzerH5alBLG9mBT/HJ8JMe/CvmQd.b4pJm',1,6,'2025-03-27 05:27:46','2025-04-10 05:29:32'),(19,'test3','male','2025-04-10','test3@gmail.com','23232323','$2y$10$qtdyRf/juUpB97hJmETze.TYGdaDMFGRyff4Pw653ezDzy8SWhSCe',3,4,'2025-04-10 05:28:38','2025-04-10 05:28:38'),(20,'test4','male','2025-04-10','test4@gmail.com','23232323','$2y$10$4DONErcWuUq/1QN5oWmFXugPFWt42HAT7xYfsMny53Ns2okqe8bRi',1,5,'2025-04-10 05:29:02','2025-04-10 05:29:02');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-06 12:03:53
