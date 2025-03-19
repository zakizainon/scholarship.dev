-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: YTIScholarshipApp
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `age` int(11) NOT NULL,
  `race` varchar(255) DEFAULT NULL,
  `other_race` varchar(50) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `birthState` varchar(255) DEFAULT NULL,
  `other_birthState` varchar(100) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `maritalStatus` varchar(255) DEFAULT NULL,
  `housePhone` varchar(255) DEFAULT NULL,
  `mobilePhone` varchar(255) DEFAULT NULL,
  `permanentAddress` varchar(255) DEFAULT NULL,
  `permanentPostcode` varchar(255) DEFAULT NULL,
  `permanentCity` varchar(255) DEFAULT NULL,
  `permanentState` varchar(255) DEFAULT NULL,
  `emergencyPhone` varchar(255) DEFAULT NULL,
  `emergencyName` varchar(255) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `emergencyAddress` varchar(255) DEFAULT NULL,
  `emergencyPostcode` varchar(255) DEFAULT NULL,
  `emergencyCity` varchar(255) DEFAULT NULL,
  `emergencyState` varchar(255) DEFAULT NULL,
  `courseName` varchar(255) DEFAULT NULL,
  `universityName` varchar(255) DEFAULT NULL,
  `universityCountry` varchar(255) DEFAULT NULL,
  `commencementYear` int(11) DEFAULT NULL,
  `completionYear` int(11) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `personalStatement` text DEFAULT NULL,
  `skillsAndExtracurricular` text DEFAULT NULL,
  `employmentStatus` varchar(255) DEFAULT NULL,
  `employerType` varchar(255) DEFAULT NULL,
  `employerName` varchar(255) DEFAULT NULL,
  `employerAddress` varchar(255) DEFAULT NULL,
  `officePhone` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `appliedCourseTitle` varchar(255) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `studyMode` varchar(255) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `studyPeriod` varchar(255) DEFAULT NULL,
  `researchProposalSummary` text DEFAULT NULL,
  `declaration01` int(11) DEFAULT NULL,
  `declaration02` int(11) DEFAULT NULL,
  `declaration03` int(11) DEFAULT NULL,
  `declaration04` int(11) DEFAULT NULL,
  `declaration05` int(11) DEFAULT NULL,
  `declaration06` int(11) DEFAULT NULL,
  `declaration07` int(11) DEFAULT NULL,
  `declaration08` int(11) DEFAULT NULL,
  `consent01` int(11) DEFAULT NULL,
  `consent02` int(11) DEFAULT NULL,
  `consent03` int(11) DEFAULT NULL,
  `tab01` int(11) NOT NULL DEFAULT 0,
  `tab02` int(11) NOT NULL DEFAULT 0,
  `tab03` int(11) NOT NULL DEFAULT 0,
  `tab04` int(11) NOT NULL DEFAULT 0,
  `tab05` int(11) NOT NULL DEFAULT 0,
  `tab06` int(11) NOT NULL DEFAULT 0,
  `tab07` int(11) NOT NULL DEFAULT 0,
  `tab08` int(11) NOT NULL DEFAULT 0,
  `status` enum('draft','complete') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'b03b26a1-5dc2-4de0-961c-24694d7ec2fb',1,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,'complete','2024-11-04 03:12:52','2024-11-12 19:21:34','2024-11-04 11:33:46'),(2,'de0a4101-b583-4100-a456-1dbe7cb1be0f',1,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,'draft','2024-11-04 04:10:48','2024-11-04 17:40:16','2024-11-04 17:40:08'),(3,'947b179b-3f3b-4632-b13d-82c725b9345f',2,28,'B01',NULL,'01','MYS04',NULL,'M','MS01','0389467680','01312338990','No. 10 Jalan Tiara Setiawangsa 2, \r\nTaman Tiara Setiawangsa,','53320','Setiawangsa','MYS15','0198890990','Abu Bakar Bin Jumaat','R03','No. 10 Jalan Tiara Setiawangsa 2, \r\nTaman Tiara Setiawangsa,','53300','Setiawangsa','MYS15','Bachelor of Information Technology','University of Canberra','Australia',2000,2014,'3.69','Personal statement of the applicant','Skill and extra-curricular activities for the applicant','E','ET01','Kementerian Tenaga MOSTI','Putrajaya','0388509000','Ketua Pegawai Teknologi Maklumat',8900.65,'Masters in Artificial Intelligence','U06','MS01','2024-07-02','2027-10-29','3 years, 3 months, 29 days','AI',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'complete','2024-11-04 10:24:26','2024-11-12 14:07:38',NULL),(5,'689fc847-40d8-4a66-bb86-fb652bc9d5f0',7,25,'B01',NULL,'01','MYS03',NULL,'F','MS01','0389449797','0123456789','No. 25 Jalan Jalan Cari Pasal 5,\r\nTaman Pemakanan Utama','43300','Seri Kembangan','MYS12','012333445567','Hashim Ketot','R03','No. 25 Jalan Jalan Cari Makan 5,\r\nTaman Pemakanan Mewah','43300','Seri Kembangan','MYS12','Degree in Culinary Art','UiTM Shah Alam','Malaysia',2015,2018,'3.77','Saya seorang yang lawa. Tokey kedai tomyam famous di Pulau Pinang','Masak tomyam dan mencipta resepi masakan baru','E','ET02','Timah Lawa Seafood','Medan Selera Taman Kinrara,\r\nBandar Kinrara 5,\r\n43100 Puchong,\r\nSelangor Darul Ehsan','0389449900','Executive Chef',9000.00,'Master of Fusion Abstract Culinary','U03','MS01','2024-02-05','2027-12-20','3 years, 10 months, 19 days','Im learning to invent new recipe that will infuse Asian and Western cuisine to become a one of a kind fusion dish. The dish will be served in International Space Station for mission to Planet Navigator',0,0,1,1,1,1,0,0,NULL,NULL,NULL,1,1,1,1,1,1,1,1,'draft','2024-11-10 01:25:58','2024-11-11 14:46:04',NULL),(6,'5c38feb5-af7d-4624-b340-fd58a0563e47',8,35,'B01',NULL,'01','others',NULL,'M','MS02','0867890998','08678887789','Lot 55 Jalan Jalan Cari Makan','43200','Serdang','MYS12','086668889','Milah Mati Dulu','R01','Lot 55 Jalan Jalan Cari Makan','43200','Serdang','MYS12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,1,0,0,0,0,0,0,1,'draft','2024-11-10 09:38:40','2024-11-13 06:16:39',NULL);
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('aliapuding@gmail.com|127.0.0.1','i:1;',1730946399),('aliapuding@gmail.com|127.0.0.1:timer','i:1730946399;',1730946399),('mail@gmail.com|127.0.0.1','i:1;',1731507365),('mail@gmail.com|127.0.0.1:timer','i:1731507365;',1731507365),('timahlawa@gmai.com|127.0.0.1','i:1;',1731347175),('timahlawa@gmai.com|127.0.0.1:timer','i:1731347175;',1731347175);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `fileType` enum('D01','D02','D03','D04','D05','D06') NOT NULL DEFAULT 'D01',
  `fileName` varchar(255) DEFAULT NULL,
  `filePath` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (7,'4ccfd4eb-229e-4faa-8b04-fdd3fe524d85',2,'D02','D02_990107075205_465860488_536548769086972_5327045122313241317_n.jpg','uploads/990107075205','2024-11-12 00:00:59','2024-11-12 00:00:59'),(10,'c79e1821-195c-4e00-9d79-3f5bdd007be0',2,'D03','D03_990107075205_Jabra PanaCast Datasheet A4 0819 WEB.pdf','uploads/990107075205','2024-11-12 08:46:14','2024-11-12 08:46:14'),(15,'cc396ac4-9f5c-4389-ab66-bbd8bef4a9a7',2,'D04','D04_990107075205_Jabra PanaCast Datasheet A4 0819 WEB.pdf','uploads/990107075205','2024-11-12 09:03:38','2024-11-12 09:03:38'),(16,'e0804b8e-9352-4b19-9c40-42a65a90bedf',2,'D05','D05_990107075205_Jabra PanaCast Datasheet A4 0819 WEB.pdf','uploads/990107075205','2024-11-12 09:04:24','2024-11-12 09:04:24'),(21,'ebd98f00-bef0-428d-ba54-de5a448a180a',2,'D06','D06_990107075205_Proposal_ Takaful Bundling System (TBS) Architecture.pdf','uploads/990107075205','2024-11-12 09:09:50','2024-11-12 09:09:50'),(24,'ee0db530-358c-40df-a029-bd0ad5571464',2,'D01','D01_990107075205_microsoft-azure-administrator.png','uploads/990107075205','2024-11-12 10:28:52','2024-11-12 10:28:52');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(5,'2024_11_04_181742_create_applications_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('f9SUWZg49JHnWMSPThbxLJx7A1OLNF0f2s7l0Kq8',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlppeEl0VnI1YU16WkhGaVJVaUt1RHI2QVR4Nmg0bEhOQmZvREZJQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1731509632),('HVIOyp8oxDc1xNIz0rDxufVg41XMMSKWXcY2sLCt',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1hMaTl1YklMTEl2a2owTVVQRlJ4OU1yTHpKeGhYNm9mSWJwbVlTOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=',1731506185),('RlH3O5icrdybKonaIHwVwvG8NYsM6cKbqV29XJIy',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoia00wRjhGRHgyT0d4a0xMRVdvTDBnZzNDbFV6UGdMSzNSTW1GUTNPdiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1731504925),('xJJYjrWV5d4UnVtXn4NcJq0B1NT2dTlrqEVeNwbT',8,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTVg5eVJFWGdUQ3Q3YkhYYXhhaWFFclBlS1lVc3dCU1BaSXM5MXdzbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcHBseS9jb25zZW50Ijt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==',1731507400);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mykad` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superuser','admin','applicant') NOT NULL DEFAULT 'applicant',
  `secret_question` varchar(255) DEFAULT NULL,
  `secret_answer` varchar(50) DEFAULT NULL,
  `pdpa_check` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_mykad_unique` (`mykad`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'135b1b45-ac30-4d43-afa0-6d2e207d227f','Zaki Zamani Zainon','790107075205','zaki.zainon@gmail.com',NULL,'$2y$12$cjAxVANJDCxgOnqtHn5qmu0JiOG3iCxorog5jTT7AbvYFAJA/qU8y','admin',NULL,NULL,NULL,NULL,'2024-11-04 09:07:52','2024-11-05 02:06:24',NULL),(2,'064b17b2-26cc-48e8-a453-80ef6f207e58','[TEST] Muhammad Ali Bin Abu Bakar','990107075205','ali@gmail.com',NULL,'$2y$12$t4g8VuOScyypknCvQTENseSr0/pP1jTMVOUSdSesCXdRzvbz/WVYe','applicant',NULL,NULL,NULL,NULL,'2024-11-04 17:41:23','2024-11-11 17:33:22',NULL),(6,'e7d9fd0f-7d7f-45b0-9891-9515cba77fd7','Zaki Zainon','690107075205','mzakizainon@pnb.com.my',NULL,'$2y$12$bH/SPmceZoBovYvZQDbgMeEsRrvSpFk8zgCU6lwjrke2M8AuNfuPO','applicant',NULL,NULL,NULL,NULL,'2024-11-04 18:04:35','2024-11-04 18:04:35',NULL),(7,'500255f3-16cd-4385-a703-3a165cc6b58c','[TEST] Timah Lawa','990107075206','timahlawa@gmail.com',NULL,'$2y$12$GujIB3kKa3ufzkstgxzgQ.VAp/S4pNiXT04Ogrs901QsEtNSxPJCW','applicant',NULL,NULL,NULL,NULL,'2024-11-10 09:24:42','2024-11-11 17:33:22',NULL),(8,'c6d7df96-57f9-439e-8abe-6d890309f008','[TEST] Mail Lambung','890107075205','ismail@gmail.com',NULL,'$2y$12$szt.CBWmzlj35Ar0oLeVlOKXxAuvReBvJJUoAusO8.l8KM8jmgDSa','applicant','What was the name of your first pet?',NULL,NULL,NULL,'2024-11-10 17:33:04','2024-11-11 17:33:22',NULL),(9,'044344ed-9625-495c-bf12-f868e2611436','Ahmad Naim bin Aminnudin','810118145403','ahmadnaim@pnb.com.my',NULL,'$2y$12$AxwwroGo1kJezDLF5K5Efu8R2j44VWDCHhmY4ybw5ufNavavClieS','admin','What was the name of your first pet?',NULL,NULL,NULL,'2024-11-11 09:41:06','2024-11-12 05:10:54',NULL),(10,'aabee55a-8c09-4fba-a9d1-714dfe281293','Suhaila bin Ibrahim','751208115294','suhaila@pnb.com.my',NULL,'$2y$12$ik1BANAKoggf0gf7ECr2t.G4olkuOHKYkDXr6biL6iEcbn/cHFUSC','admin','What was the name of your first pet?',NULL,NULL,NULL,'2024-11-11 09:42:58','2024-11-12 05:10:54',NULL),(11,'a9808d15-e742-4716-92fa-35ea0c604b83','Arif bin Rahimi','910630145339','arifrahimi@pnb.com.my',NULL,'$2y$12$dCNybHFP/fZE/pdOzbfZguPIsuw9YgFVr4vfelJvux8xZbigEmf/i','admin','What was the name of your first pet?',NULL,NULL,NULL,'2024-11-11 09:43:34','2024-11-12 05:10:54',NULL),(12,'d9e43261-2fd2-4e1f-9084-ae61de68e9ab','Saiyid Zainul Asri bin Syd Jamaluddin','700503086457','saiyid@pnb.com.my',NULL,'$2y$12$kJwtV2S3swLVUgsuW4Zsoe4.Hs8OLEO4Nb3FGqvL/Od7Xcos.23.i','admin','What was the name of your first pet?',NULL,NULL,NULL,'2024-11-11 09:44:07','2024-11-12 05:10:54',NULL),(13,'dd0bbc4e-4c90-4edc-8ba4-04f410a014af','Syahrom bin Jumali','801024125083','syahrom@pnb.com.my',NULL,'$2y$12$cyQi5STRETGqTtrMn1WEwuRroIcE/NI2MuKAr3GZnU9Jo1MYZPkT6','admin','What was the name of your first pet?',NULL,NULL,NULL,'2024-11-11 09:44:42','2024-11-12 05:10:54',NULL);
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

-- Dump completed on 2024-11-13 22:59:08
