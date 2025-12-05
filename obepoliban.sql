-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: obepoliban
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bahan_kajians`
--

DROP TABLE IF EXISTS `bahan_kajians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahan_kajians` (
  `id_bk` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_bk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_bk` text COLLATE utf8mb4_unicode_ci,
  `referensi_bk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_bk` enum('core','elective') COLLATE utf8mb4_unicode_ci NOT NULL,
  `knowledge_area` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bk`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahan_kajians`
--

LOCK TABLES `bahan_kajians` WRITE;
/*!40000 ALTER TABLE `bahan_kajians` DISABLE KEYS */;
INSERT INTO `bahan_kajians` VALUES (1,'BK01','Artificial Intelligence (AI)',NULL,'CSC 2023','core',NULL,'2025-06-25 23:31:29','2025-06-25 23:31:29'),(2,'BK02','Algorithmic Foundations (AL)',NULL,'CSC 2023','core',NULL,'2025-06-26 04:49:41','2025-06-26 04:49:41'),(3,'BK03','Architecture and Organization (AR)',NULL,'CSC 2023','core',NULL,'2025-06-26 04:50:16','2025-06-26 04:50:16'),(4,'BK04','Data Management (DM)',NULL,'CSC 2023','core',NULL,'2025-06-26 04:51:01','2025-06-26 04:51:01'),(5,'BK05','Foundations of Programming Languages (FPL)',NULL,'CSC 2023','core',NULL,'2025-06-26 04:51:41','2025-06-26 04:51:41'),(6,'BK06','Human-Computer Interaction (HCI)',NULL,'CSC 2023','core',NULL,'2025-06-26 04:52:10','2025-06-26 04:52:10'),(7,'BK07','Mathematical and Statistical Foundations (MSF)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:14:33','2025-06-26 06:14:33'),(8,'BK08','Networking and Communication (NC)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:14:52','2025-06-26 06:14:52'),(9,'BK09','Operating Systems (OS)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:15:32','2025-06-26 06:15:32'),(10,'BK10','Software Development Fundamentals (SDF)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:25:26','2025-06-27 11:14:32'),(11,'BK11','Software Engineering (SE)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:25:53','2025-06-27 11:14:39'),(12,'BK12','Security (SEC)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:27:19','2025-06-27 11:14:46'),(13,'BK13','Society, Ethics, and the Profession (SEP)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:27:36','2025-06-27 11:15:00'),(14,'BK14','Systems Fundamentals (SF)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:27:56','2025-06-27 11:29:34'),(15,'BK15','Specialized Platform Development (SPD)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:28:23','2025-06-27 11:29:41'),(16,'BK16','Parallel and Distributed Computing (PDC)',NULL,'CSC 2023','core',NULL,'2025-06-26 06:28:48','2025-06-27 11:29:47'),(17,'BK17','General Knowledge',NULL,'CSC 2023','core',NULL,'2025-06-26 06:29:14','2025-06-27 11:29:55'),(19,'BK01','BK01',NULL,'BK01','elective',NULL,'2025-07-03 16:39:58','2025-07-03 16:40:11'),(20,'BK02','BK02','BK02','BK02','core',NULL,'2025-07-03 16:41:01','2025-07-03 16:41:01');
/*!40000 ALTER TABLE `bahan_kajians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bk_mk`
--

DROP TABLE IF EXISTS `bk_mk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bk_mk` (
  `kode_mk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bk` bigint unsigned NOT NULL,
  KEY `bk_mk_kode_mk_foreign` (`kode_mk`),
  KEY `bk_mk_id_bk_foreign` (`id_bk`),
  CONSTRAINT `bk_mk_id_bk_foreign` FOREIGN KEY (`id_bk`) REFERENCES `bahan_kajians` (`id_bk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bk_mk_kode_mk_foreign` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliahs` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bk_mk`
--

LOCK TABLES `bk_mk` WRITE;
/*!40000 ALTER TABLE `bk_mk` DISABLE KEYS */;
INSERT INTO `bk_mk` VALUES ('C0320101',7),('C0320202',7),('C0320102',7),('C0320303',7),('C0320301',7),('C0320208',3),('C0320106',14),('C0320106',3),('C0320103',9),('C0320308',11),('C0320104',2),('C0320104',10),('C0320203',10),('C0320203',15),('C0320302',10),('C0320302',15),('C0320304',15),('C0320205',5),('C0320601',16),('C0320406',1),('C0320406',2),('C0320105',4),('C0320206',4),('C0320305',4),('C0320204',8),('C0320306',8),('C0320405',8),('C0320405',12),('C0320405',13),('C0320307',6),('C0320307',13),('C0320404',1),('C0320107',13),('C0320107',17),('C0320401',17),('C0320402',13),('C0320402',17),('MKWU2001',17),('MKWU2004',13),('MKWU2004',17),('MKWI2001',17),('MKWI2002',13),('MKWI2002',17),('MKWI2003',13),('MKWI2004',13),('MKWI2004',17),('MKWU2003',13),('MKWU2003',17),('MKWU2002',17),('C0320403',13),('C0320403',15),('C0320403',17),('C0320501',13),('C0320602',13),('C0320407',13),('C0320407',17),('C0320207',2),('C0320207',10),('C0320201',7),('MK01',19);
/*!40000 ALTER TABLE `bk_mk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bobots`
--

DROP TABLE IF EXISTS `bobots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bobots` (
  `id_bobot` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_cpl` bigint unsigned NOT NULL,
  `kode_mk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int NOT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `bobots_id_cpl_foreign` (`id_cpl`),
  KEY `bobots_kode_mk_foreign` (`kode_mk`),
  CONSTRAINT `bobots_id_cpl_foreign` FOREIGN KEY (`id_cpl`) REFERENCES `capaian_profil_lulusans` (`id_cpl`) ON DELETE CASCADE,
  CONSTRAINT `bobots_kode_mk_foreign` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliahs` (`kode_mk`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bobots`
--

LOCK TABLES `bobots` WRITE;
/*!40000 ALTER TABLE `bobots` DISABLE KEYS */;
INSERT INTO `bobots` VALUES (14,2,'C0320101',13),(15,2,'C0320102',13),(16,2,'C0320106',13),(17,2,'C0320201',11),(18,2,'C0320202',12),(19,2,'C0320208',12),(20,2,'C0320301',12),(21,2,'C0320303',12),(22,2,'C0320103',0),(23,2,'C0320406',0),(24,2,'C0320405',0),(25,2,'C0320404',2),(26,1,'C0320104',10),(27,1,'C0320203',30),(28,1,'C0320207',20),(29,1,'C0320302',20),(30,1,'C0320406',20),(41,15,'MK01',100),(42,4,'C0320105',10),(43,4,'C0320203',10),(44,4,'C0320205',10),(45,4,'C0320206',10),(46,4,'C0320302',10),(47,4,'C0320304',10),(48,4,'C0320305',10),(49,4,'C0320308',10),(50,4,'C0320403',10),(51,4,'C0320601',10);
/*!40000 ALTER TABLE `bobots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
-- Table structure for table `capaian_pembelajaran_mata_kuliahs`
--

DROP TABLE IF EXISTS `capaian_pembelajaran_mata_kuliahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `capaian_pembelajaran_mata_kuliahs` (
  `id_cpmk` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_cpmk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_cpmk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cpmk`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capaian_pembelajaran_mata_kuliahs`
--

LOCK TABLES `capaian_pembelajaran_mata_kuliahs` WRITE;
/*!40000 ALTER TABLE `capaian_pembelajaran_mata_kuliahs` DISABLE KEYS */;
INSERT INTO `capaian_pembelajaran_mata_kuliahs` VALUES (3,'CPMK011','Mampu memahami cara kerja sistem berbasis komputer untuk memecahkan masalah pada pada bidang energi dan industri pengolahan.','2025-06-28 00:13:56','2025-06-28 00:13:56'),(4,'CPMK012','Mampu menerapkan berbagai algoritma/metode untuk memecahkan masalah pada pada bidang energi dan industri pengolahan.','2025-06-28 00:14:37','2025-06-28 00:14:37'),(5,'CPMK022','Mampu menerapkan solusi pengelolaan proyek teknologi bidang informatika/ilmu komputer dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi','2025-06-28 00:15:12','2025-06-28 00:15:12'),(6,'CPMK021','Mampu memahami persoalan computing dalam pengelolaan proyek teknologi bidang informatika/ilmu komputer dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi','2025-06-28 03:26:59','2025-06-28 03:26:59'),(8,'CPMK031','Mampu memahami konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam merancang aplikasi teknologi multi-platform yang relevan dengan kebutuhan pada bidang energi dan industri pengolahan dan masyarakat.','2025-06-30 19:20:46','2025-06-30 19:20:46'),(9,'CPMK032','Mampu memahami konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam mengimplementasikan aplikasi teknologi multi-platform yang relevan dengan kebutuhan pada bidang energi dan industri pengolahandan masyarakat.','2025-06-30 19:21:25','2025-06-30 19:21:25'),(10,'CPMK041','Mampu merancang kebutuhan computing dengan menggunakan berbagai metode/algoritma yang sesuai dalam permasalahan pada bidang industri pengolahan','2025-06-30 19:21:49','2025-06-30 19:21:49'),(11,'CPMK042','Mampu mengimplementasikan kebutuhan computing dengan menggunakan berbagai metode/algoritma yang sesuai dalam permasalahan pada bidang energi dan industri pengolahan.','2025-06-30 19:22:27','2025-06-30 19:22:27'),(12,'CPMK051','Mampu merancang user interface dan aplikasi interaktif dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi digital.','2025-06-30 19:23:05','2025-06-30 19:23:05'),(13,'CPMK052','Mampu membangun user interface dan aplikasi interaktif dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi.','2025-06-30 19:23:22','2025-06-30 19:23:22'),(14,'CPMK053','Mampu mengimplementasikan user interface dan aplikasi interaktif dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi digital.','2025-06-30 19:23:38','2025-06-30 19:23:38'),(15,'CPMK061','Mampu merancang solusi berbasis computing multi-platform yang memenuhi kebutuhan computing pada dalam permasalahan pada bidang energi dan industri pengolahan.','2025-06-30 19:23:59','2025-06-30 19:23:59'),(16,'CPMK062','Mampu membangun solusi berbasis computing multi-platform yang memenuhi kebutuhan computing pada dalam permasalahan pada bidang energi dan industri pengolahan.','2025-06-30 19:25:07','2025-06-30 19:25:07'),(17,'CPMK063','Mampu mengimplementasikan solusi berbasis computing multi-platform yang memenuhi kebutuhan computing pada dalam permasalahan pada bidang energi dan industri pengolahan','2025-06-30 19:25:38','2025-06-30 19:25:38'),(18,'CPMK071','Mampu menginstalasi jaringan komputer yang aman dan optimal.','2025-06-30 19:28:02','2025-06-30 19:28:02'),(19,'CPMK072','Mampu mengkonfigurasi jaringan komputer yang aman dan optimal.','2025-06-30 19:28:22','2025-06-30 19:28:22'),(20,'CPMK073','Mampu merawat jaringan komputer yang aman dan optimal.','2025-06-30 19:28:38','2025-06-30 19:28:38'),(21,'CPMK081','Mampu menunjukkan sikap profesional dalam aktualisasi bidang informatika secara mandiri yang dilandasi semangat dan jiwa kewirausahaan','2025-06-30 19:38:54','2025-06-30 19:38:54'),(22,'CPMK082','Mampu menunjukkan sikap profesional dalam aktualisasi bidang informatika secara kelompok yang dilandasi semangat dan jiwa kewirausahaan','2025-06-30 19:40:28','2025-06-30 19:40:28'),(23,'CPMK091','Mampu mengkomunikasikan ide, konsep dan hasil kerja secara efektif secara lisan kepada pemangku kepentingan','2025-06-30 19:42:36','2025-06-30 19:42:36'),(24,'CPMK092','Mampu mengkomunikasikan ide, konsep dan hasil kerja secara efektif secara tulisan kepada pemangku kepentingan','2025-06-30 19:43:03','2025-06-30 19:43:03'),(28,'CPMK01','CPMK01','2025-07-03 16:46:42','2025-07-03 16:46:42');
/*!40000 ALTER TABLE `capaian_pembelajaran_mata_kuliahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capaian_profil_lulusans`
--

DROP TABLE IF EXISTS `capaian_profil_lulusans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `capaian_profil_lulusans` (
  `id_cpl` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_cpl` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_cpl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_cpl` enum('Kompetensi Utama Bidang','Kompetensi Tambahan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cpl`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capaian_profil_lulusans`
--

LOCK TABLES `capaian_profil_lulusans` WRITE;
/*!40000 ALTER TABLE `capaian_profil_lulusans` DISABLE KEYS */;
INSERT INTO `capaian_profil_lulusans` VALUES (1,'CPL01','Mampu memahami cara kerja sistem berbasis komputer dan menerapkan berbagai algoritma/metode dalam  pengembangan perangkat lunak (software engineering) untuk memecahkan masalah pada bidang energi dan industri pengolahan.','Kompetensi Utama Bidang','2025-06-25 23:16:43','2025-06-25 23:16:43'),(2,'CPL02','Mampu memahami konsep teoritis dalam penyelesaian  persoalan computing sebagai solusi pengelolaan proyek teknologi(ket : memecah yg kompleks menjadi simple dan berfungsi)  bidang informatika/ilmu komputer dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi.','Kompetensi Utama Bidang','2025-06-25 23:18:01','2025-06-25 23:18:01'),(4,'CPL03','Mampu memahami konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam merancang dan mengimplementasikan aplikasi teknologi multi-platform yang relevan dengan kebutuhan pada bidang energi dan industri pengolahan dan masyarakat.','Kompetensi Utama Bidang','2025-06-25 23:18:53','2025-06-25 23:18:53'),(6,'CPL04','Mampu merancang dan mengimplementasikan kebutuhan computing dengan menggunakan berbagai metode/algoritma yang sesuai dalam permasalahan pada bidang energi dan industri pengolahan.','Kompetensi Utama Bidang','2025-06-25 23:19:14','2025-06-25 23:19:14'),(7,'CPL05','Mampu merancang, membangun dan mengimplementasikan user interface dan aplikasi interaktif dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi digital.','Kompetensi Utama Bidang','2025-06-25 23:19:33','2025-06-25 23:19:33'),(9,'CPL06','Mampu merancang, membangun dan mengimplementasikan solusi berbasis computing multi-platform yang memenuhi kebutuhan computing pada bidang energi dan industri pengolahan.','Kompetensi Utama Bidang','2025-06-25 23:24:31','2025-06-25 23:24:31'),(10,'CPL07','Mampu melakukan instalasi, konfigurasi, serta perawatan jaringan komputer yang aman dan optimal.','Kompetensi Utama Bidang','2025-06-25 23:25:01','2025-06-25 23:25:18'),(11,'CPL08','Mampu menunjukkan sikap professional dalam aktualisasi bidang informatika baik secara mandiri maupun kelompok yang dilandasi semangat dan jiwa kewirausahaan.','Kompetensi Tambahan','2025-06-25 23:25:58','2025-06-25 23:25:58'),(12,'CPL09','Mampu mengkomunikasikan ide, konsep, dan hasil kerja secara efektif baik secara lisan maupun tulisan kepada pemangku kepentingan.','Kompetensi Tambahan','2025-06-25 23:26:17','2025-06-25 23:26:17'),(15,'CPL01','CPL01','Kompetensi Utama Bidang','2025-07-03 16:29:54','2025-07-03 16:29:54');
/*!40000 ALTER TABLE `capaian_profil_lulusans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpl_bk`
--

DROP TABLE IF EXISTS `cpl_bk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpl_bk` (
  `id_cpl` bigint unsigned NOT NULL,
  `id_bk` bigint unsigned NOT NULL,
  KEY `cpl_bk_id_cpl_foreign` (`id_cpl`),
  KEY `cpl_bk_id_bk_foreign` (`id_bk`),
  CONSTRAINT `cpl_bk_id_bk_foreign` FOREIGN KEY (`id_bk`) REFERENCES `bahan_kajians` (`id_bk`) ON DELETE CASCADE,
  CONSTRAINT `cpl_bk_id_cpl_foreign` FOREIGN KEY (`id_cpl`) REFERENCES `capaian_profil_lulusans` (`id_cpl`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpl_bk`
--

LOCK TABLES `cpl_bk` WRITE;
/*!40000 ALTER TABLE `cpl_bk` DISABLE KEYS */;
INSERT INTO `cpl_bk` VALUES (2,1),(6,1),(11,1),(1,2),(6,2),(11,2),(12,2),(2,3),(11,3),(12,3),(4,4),(9,4),(11,4),(12,4),(4,5),(9,5),(11,5),(7,6),(11,6),(12,6),(2,7),(10,8),(2,9),(11,9),(1,10),(6,10),(11,10),(12,10),(4,11),(2,12),(10,12),(11,12),(11,13),(12,13),(2,14),(4,15),(9,15),(11,15),(12,15),(4,16),(10,16),(11,16),(12,16),(11,17),(12,17),(15,19),(15,20);
/*!40000 ALTER TABLE `cpl_bk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpl_cpmk`
--

DROP TABLE IF EXISTS `cpl_cpmk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpl_cpmk` (
  `id_cpl` bigint unsigned NOT NULL,
  `id_cpmk` bigint unsigned NOT NULL,
  KEY `cpl_cpmk_id_cpl_foreign` (`id_cpl`),
  KEY `cpl_cpmk_id_cpmk_foreign` (`id_cpmk`),
  CONSTRAINT `cpl_cpmk_id_cpl_foreign` FOREIGN KEY (`id_cpl`) REFERENCES `capaian_profil_lulusans` (`id_cpl`) ON DELETE CASCADE,
  CONSTRAINT `cpl_cpmk_id_cpmk_foreign` FOREIGN KEY (`id_cpmk`) REFERENCES `capaian_pembelajaran_mata_kuliahs` (`id_cpmk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpl_cpmk`
--

LOCK TABLES `cpl_cpmk` WRITE;
/*!40000 ALTER TABLE `cpl_cpmk` DISABLE KEYS */;
INSERT INTO `cpl_cpmk` VALUES (1,4),(2,5),(2,6),(4,8),(4,9),(6,10),(6,11),(7,12),(7,13),(7,14),(9,15),(9,16),(9,17),(10,18),(10,19),(10,20),(11,21),(11,22),(12,23),(12,24),(1,3),(15,28);
/*!40000 ALTER TABLE `cpl_cpmk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpl_mk`
--

DROP TABLE IF EXISTS `cpl_mk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpl_mk` (
  `id_cpl` bigint unsigned NOT NULL,
  `kode_mk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `cpl_mk_id_cpl_foreign` (`id_cpl`),
  KEY `cpl_mk_kode_mk_foreign` (`kode_mk`),
  CONSTRAINT `cpl_mk_id_cpl_foreign` FOREIGN KEY (`id_cpl`) REFERENCES `capaian_profil_lulusans` (`id_cpl`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cpl_mk_kode_mk_foreign` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliahs` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpl_mk`
--

LOCK TABLES `cpl_mk` WRITE;
/*!40000 ALTER TABLE `cpl_mk` DISABLE KEYS */;
INSERT INTO `cpl_mk` VALUES (2,'C0320101'),(2,'C0320202'),(2,'C0320102'),(2,'C0320303'),(2,'C0320301'),(2,'C0320208'),(11,'C0320208'),(12,'C0320208'),(2,'C0320106'),(11,'C0320106'),(12,'C0320106'),(2,'C0320103'),(11,'C0320103'),(4,'C0320308'),(1,'C0320104'),(6,'C0320104'),(11,'C0320104'),(12,'C0320104'),(1,'C0320203'),(6,'C0320203'),(11,'C0320203'),(12,'C0320203'),(4,'C0320203'),(9,'C0320203'),(1,'C0320302'),(6,'C0320302'),(11,'C0320302'),(12,'C0320302'),(4,'C0320302'),(9,'C0320302'),(4,'C0320304'),(9,'C0320304'),(11,'C0320304'),(12,'C0320304'),(4,'C0320205'),(9,'C0320205'),(11,'C0320205'),(4,'C0320601'),(10,'C0320601'),(11,'C0320601'),(12,'C0320601'),(2,'C0320406'),(6,'C0320406'),(11,'C0320406'),(1,'C0320406'),(12,'C0320406'),(4,'C0320105'),(9,'C0320105'),(11,'C0320105'),(12,'C0320105'),(4,'C0320206'),(9,'C0320206'),(11,'C0320206'),(12,'C0320206'),(4,'C0320305'),(9,'C0320305'),(11,'C0320305'),(12,'C0320305'),(10,'C0320204'),(10,'C0320306'),(10,'C0320405'),(2,'C0320405'),(11,'C0320405'),(12,'C0320405'),(7,'C0320307'),(11,'C0320307'),(12,'C0320307'),(2,'C0320404'),(6,'C0320404'),(11,'C0320404'),(11,'C0320107'),(12,'C0320107'),(11,'C0320401'),(12,'C0320401'),(11,'C0320402'),(12,'C0320402'),(11,'MKWU2001'),(12,'MKWU2001'),(11,'MKWU2004'),(12,'MKWU2004'),(11,'MKWI2001'),(12,'MKWI2001'),(11,'MKWI2002'),(12,'MKWI2002'),(11,'MKWI2003'),(12,'MKWI2003'),(11,'MKWI2004'),(12,'MKWI2004'),(11,'MKWU2003'),(12,'MKWU2003'),(11,'MKWU2002'),(12,'MKWU2002'),(11,'C0320403'),(12,'C0320403'),(4,'C0320403'),(9,'C0320403'),(11,'C0320501'),(12,'C0320501'),(11,'C0320602'),(12,'C0320602'),(11,'C0320407'),(12,'C0320407'),(1,'C0320207'),(6,'C0320207'),(11,'C0320207'),(12,'C0320207'),(2,'C0320201'),(15,'MK01');
/*!40000 ALTER TABLE `cpl_mk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpl_pl`
--

DROP TABLE IF EXISTS `cpl_pl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpl_pl` (
  `id_pl` bigint unsigned NOT NULL,
  `id_cpl` bigint unsigned NOT NULL,
  KEY `cpl_pl_id_pl_foreign` (`id_pl`),
  KEY `cpl_pl_id_cpl_foreign` (`id_cpl`),
  CONSTRAINT `cpl_pl_id_cpl_foreign` FOREIGN KEY (`id_cpl`) REFERENCES `capaian_profil_lulusans` (`id_cpl`) ON DELETE CASCADE,
  CONSTRAINT `cpl_pl_id_pl_foreign` FOREIGN KEY (`id_pl`) REFERENCES `profil_lulusans` (`id_pl`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpl_pl`
--

LOCK TABLES `cpl_pl` WRITE;
/*!40000 ALTER TABLE `cpl_pl` DISABLE KEYS */;
INSERT INTO `cpl_pl` VALUES (1,2),(1,4),(2,6),(2,7),(2,9),(3,10),(4,11),(4,12),(1,1),(8,15);
/*!40000 ALTER TABLE `cpl_pl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpmk_mk`
--

DROP TABLE IF EXISTS `cpmk_mk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpmk_mk` (
  `id_cpmk` bigint unsigned NOT NULL,
  `kode_mk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `cpmk_mk_id_cpmk_foreign` (`id_cpmk`),
  KEY `cpmk_mk_kode_mk_foreign` (`kode_mk`),
  CONSTRAINT `cpmk_mk_id_cpmk_foreign` FOREIGN KEY (`id_cpmk`) REFERENCES `capaian_pembelajaran_mata_kuliahs` (`id_cpmk`) ON DELETE CASCADE,
  CONSTRAINT `cpmk_mk_kode_mk_foreign` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliahs` (`kode_mk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpmk_mk`
--

LOCK TABLES `cpmk_mk` WRITE;
/*!40000 ALTER TABLE `cpmk_mk` DISABLE KEYS */;
INSERT INTO `cpmk_mk` VALUES (4,'C0320203'),(4,'C0320302'),(4,'C0320406'),(5,'C0320103'),(6,'C0320101'),(6,'C0320102'),(6,'C0320103'),(6,'C0320106'),(6,'C0320201'),(6,'C0320202'),(6,'C0320208'),(6,'C0320301'),(6,'C0320303'),(6,'C0320404'),(8,'C0320105'),(8,'C0320206'),(8,'C0320308'),(8,'C0320601'),(9,'C0320205'),(9,'C0320304'),(9,'C0320305'),(9,'C0320403'),(10,'C0320104'),(10,'C0320207'),(11,'C0320203'),(11,'C0320302'),(11,'C0320404'),(11,'C0320406'),(12,'C0320307'),(13,'C0320307'),(14,'C0320307'),(15,'C0320105'),(15,'C0320206'),(15,'C0320403'),(16,'C0320203'),(16,'C0320205'),(16,'C0320302'),(16,'C0320304'),(16,'C0320305'),(16,'C0320403'),(17,'C0320203'),(17,'C0320302'),(17,'C0320304'),(17,'C0320403'),(18,'C0320204'),(18,'C0320306'),(19,'C0320204'),(19,'C0320601'),(20,'C0320306'),(20,'C0320405'),(21,'C0320103'),(21,'C0320104'),(21,'C0320105'),(21,'C0320106'),(21,'C0320107'),(21,'C0320203'),(21,'C0320205'),(21,'C0320206'),(21,'C0320207'),(21,'C0320208'),(21,'C0320302'),(21,'C0320304'),(21,'C0320307'),(21,'C0320401'),(21,'C0320402'),(21,'C0320404'),(21,'C0320405'),(21,'C0320406'),(21,'C0320501'),(21,'C0320602'),(21,'MKWI2001'),(21,'MKWI2002'),(21,'MKWI2003'),(21,'MKWI2004'),(21,'MKWU2001'),(21,'MKWU2002'),(21,'MKWU2003'),(21,'MKWU2004'),(22,'C0320103'),(22,'C0320203'),(22,'C0320205'),(22,'C0320302'),(22,'C0320304'),(22,'C0320305'),(22,'C0320402'),(22,'C0320403'),(22,'C0320601'),(22,'C0320602'),(22,'MKWI2002'),(22,'MKWI2003'),(22,'MKWI2004'),(22,'MKWU2003'),(23,'C0320104'),(23,'C0320207'),(23,'C0320407'),(24,'C0320104'),(24,'C0320207'),(24,'C0320407'),(3,'C0320104'),(3,'C0320406'),(28,'MK01');
/*!40000 ALTER TABLE `cpmk_mk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
-- Table structure for table `jurusans`
--

DROP TABLE IF EXISTS `jurusans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jurusans` (
  `id_jurusan` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kajur` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurusans`
--

LOCK TABLES `jurusans` WRITE;
/*!40000 ALTER TABLE `jurusans` DISABLE KEYS */;
INSERT INTO `jurusans` VALUES (1,'Teknik Elektro','Lorem ipsum','2025-06-25 22:49:09','2025-07-15 18:40:16'),(2,'Teknik Mesin','Lorem ipsum','2025-06-30 08:25:25','2025-07-15 18:40:10'),(3,'Teknik Sipil Dan Kebumian','Lorem ipsum','2025-07-02 05:12:14','2025-07-15 18:40:20'),(4,'Akuntansi','Lorem ipsum','2025-07-02 05:12:46','2025-07-15 18:40:28'),(5,'Administrasi Bisnis','Lorem ipsum','2025-07-02 05:18:33','2025-07-15 18:40:33');
/*!40000 ALTER TABLE `jurusans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mata_kuliahs`
--

DROP TABLE IF EXISTS `mata_kuliahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mata_kuliahs` (
  `kode_mk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mk` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_mk` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sks_mk` int NOT NULL,
  `semester_mk` enum('1','2','3','4','5','6','7','8') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kompetensi_mk` enum('pendukung','utama') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mata_kuliahs`
--

LOCK TABLES `mata_kuliahs` WRITE;
/*!40000 ALTER TABLE `mata_kuliahs` DISABLE KEYS */;
INSERT INTO `mata_kuliahs` VALUES ('C0320101','Aljabar Linier','Matematika',2,'1','utama','2025-06-26 07:53:27','2025-06-26 08:04:56'),('C0320102','Logika Matematika','Matematika',2,'1','utama','2025-06-26 08:46:07','2025-06-26 08:46:07'),('C0320103','Sistem Operasi','Dasar TI',3,'1','utama','2025-06-27 19:51:41','2025-06-27 19:51:41'),('C0320104','Algoritma Pemrograman','Pemrograman',3,'1','utama','2025-06-27 20:38:41','2025-06-27 20:38:41'),('C0320105','Basis Data','Database',2,'1','utama','2025-06-27 20:58:16','2025-06-27 20:58:16'),('C0320106','Organisasi Komputer','Dasar TI',2,'1','utama','2025-06-26 09:48:06','2025-06-26 09:48:06'),('C0320107','Keterampilan Komputer','Softskill Tambahan',2,'1','pendukung','2025-06-27 21:45:17','2025-06-27 21:45:17'),('C0320201','Kalkulus','Matematika',2,'2','utama','2025-06-26 07:54:40','2025-06-26 07:54:40'),('C0320202','Matematika Diskrit','Matematika',2,'2','utama','2025-06-26 08:06:04','2025-06-26 08:06:04'),('C0320203','Pemrograman Web','Pemrograman',3,'2','utama','2025-06-27 20:42:12','2025-06-27 20:42:12'),('C0320204','Dasar-Dasar Jaringan','Jaringan',3,'2','utama','2025-06-27 21:40:12','2025-06-27 21:40:12'),('C0320205','Pemrograman Berorientasi Objek','Pemrograman',3,'2','utama','2025-06-27 20:51:49','2025-06-27 20:51:49'),('C0320206','Basis Data Lanjut','Database',2,'2','utama','2025-06-27 21:01:56','2025-06-27 21:01:56'),('C0320207','Struktur Data','Pemrograman',3,'2','utama','2025-06-28 03:21:48','2025-06-28 03:21:48'),('C0320208','Arsitektur Komputer','Dasar TI',2,'2','utama','2025-06-26 09:43:44','2025-06-26 09:43:44'),('C0320301','Probabilitas dan Statistik','Matematika',2,'3','utama','2025-06-26 08:47:24','2025-06-26 09:34:32'),('C0320302','Pemrograman Mobile','Pemrograman',3,'2','utama','2025-06-27 20:46:17','2025-06-27 20:46:17'),('C0320303','Metode Numerik','Matematika',2,'3','utama','2025-06-26 09:32:42','2025-06-26 09:32:42'),('C0320304','Pemrograman dengan Internet of Things','Pemrograman',2,'3','pendukung','2025-06-27 20:47:43','2025-06-27 20:47:43'),('C0320305','Administrasi Basis Data','Database',2,'3','utama','2025-06-27 21:02:28','2025-06-27 21:02:28'),('C0320306','Jaringan Lanjut','Jaringan',3,'3','utama','2025-06-27 21:40:48','2025-06-27 21:40:48'),('C0320307','Interaksi Manusia dan Komputer','Visual',3,'3','utama','2025-06-27 21:42:58','2025-06-27 21:42:58'),('C0320308','Rekayasa Perangkat Lunak','Dasar TI',2,'3','utama','2025-06-27 19:52:45','2025-06-27 20:21:57'),('C0320401','Tata Tulis Ilmiah (Metodologi Penelitian)','Softskill Tambahan',2,'4','pendukung','2025-06-27 23:00:28','2025-06-27 23:00:28'),('C0320402','K3 dan Ketenagakerjaan','Softskill Tambahan',2,'4','pendukung','2025-06-27 23:01:41','2025-06-27 23:01:41'),('C0320403','Proyek Pengembangan Aplikasi','Capstone Project',3,'4','utama','2025-06-27 23:56:17','2025-06-27 23:56:17'),('C0320404','Pengolahan Citra Digital','Visual',2,'4','pendukung','2025-06-27 21:44:16','2025-06-27 21:44:16'),('C0320405','Keamanan Jaringan, Data, dan Informasi','Jaringan',3,'4','pendukung','2025-06-27 21:41:51','2025-06-27 21:41:51'),('C0320406','Kecerdasan Buatan','Pemrograman',3,'4','utama','2025-06-27 20:56:44','2025-06-27 20:56:44'),('C0320407','Teknologi Informasi Pada Bidang Energi dan Insdustri Pengolahan','Dasar TI',2,'4','pendukung','2025-06-27 20:21:18','2025-06-28 00:02:30'),('C0320501','Kerja Praktek / Magang','PKL',20,'5','utama','2025-06-27 23:56:50','2025-06-27 23:56:50'),('C0320601','Komputasi Paralel dan Terdistribusi','Pemrograman',2,'6','pendukung','2025-06-27 20:55:46','2025-06-27 20:55:46'),('C0320602','Tugas Akhir','TA',6,'6','utama','2025-06-27 23:57:29','2025-06-27 23:57:29'),('MK01','MK01','MK01',4,'1','utama','2025-07-03 16:45:24','2025-07-03 16:45:24'),('MKWI2001','Bahasa inggris 1','MKWI/ MKWU',2,'1','utama','2025-06-27 23:45:37','2025-06-27 23:45:37'),('MKWI2002','Bahasa inggris 2','MKWI/ MKWU',2,'6','utama','2025-06-27 23:46:13','2025-06-27 23:46:13'),('MKWI2003','Etika profesi','MKWI/ MKWU',2,'4','utama','2025-06-27 23:47:51','2025-06-27 23:47:51'),('MKWI2004','Kewirausahaan','MKWI/ MKWU',2,'4','utama','2025-06-27 23:50:55','2025-06-27 23:50:55'),('MKWU2001','Agama','MKWI/ MKWU',2,'1','utama','2025-06-27 23:02:36','2025-06-27 23:02:36'),('MKWU2002','Pancasila','MKWI/ MKWU',2,'3','utama','2025-06-27 23:55:33','2025-06-27 23:55:33'),('MKWU2003','Kewarganegaraan','MKWI/ MKWU',2,'6','utama','2025-06-27 23:52:03','2025-06-27 23:52:03'),('MKWU2004','Bahasa Indonesia','MKWI/ MKWU',2,'6','utama','2025-06-27 23:03:27','2025-06-27 23:03:27');
/*!40000 ALTER TABLE `mata_kuliahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0000_03_20_011730_create_jurusans_table',1),(2,'0000_03_20_011936_create_prodis_table',1),(3,'0001_01_01_000000_create_users_table',1),(4,'0001_01_01_000001_create_cache_table',1),(5,'0001_01_01_000002_create_jobs_table',1),(6,'2025_03_25_105342_create_tahun_table',1),(7,'2025_03_26_133134_create_profil_lulusans_table',1),(8,'2025_04_01_014246_create_capaian_profil_lulusans_table',1),(9,'2025_04_01_014346_cpl-pl',1),(10,'2025_04_02_023228_create_bahan_kajians_table',1),(11,'2025_04_02_024210_cpl_bk',1),(12,'2025_04_04_065212_create_mata_kuliah_table',1),(13,'2025_04_05_132132_pemetaan_cpl-mk',1),(14,'2025_04_05_141534_pemetaan_bk_mk',1),(15,'2025_04_21_062547_create_capaian_pembelajaran_mata_kuliah_table',1),(16,'2025_04_21_063205_cpl_cpmk',1),(17,'2025_04_21_063349_cpmk_mk',1),(18,'2025_05_01_134852_create_sub_cpmks_table',1),(19,'2025_05_10_050001_create_bobot_table',1),(20,'2025_06_14_113100_catatan_table',1),(21,'2025_07_10_151832_create_visi_misi_table',2),(22,'2025_07_14_162113_create_visis_table',2),(23,'2025_07_14_162138_create_misis_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `misis`
--

DROP TABLE IF EXISTS `misis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `misis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `visi_id` bigint unsigned NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `misis_visi_id_foreign` (`visi_id`),
  CONSTRAINT `misis_visi_id_foreign` FOREIGN KEY (`visi_id`) REFERENCES `visis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `misis`
--

LOCK TABLES `misis` WRITE;
/*!40000 ALTER TABLE `misis` DISABLE KEYS */;
INSERT INTO `misis` VALUES (1,1,'lorem ipsum','2025-07-15 18:44:42','2025-07-15 18:44:42');
/*!40000 ALTER TABLE `misis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id_note` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `kode_prodi` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_note`),
  KEY `notes_user_id_foreign` (`user_id`),
  KEY `notes_kode_prodi_foreign` (`kode_prodi`),
  CONSTRAINT `notes_kode_prodi_foreign` FOREIGN KEY (`kode_prodi`) REFERENCES `prodis` (`kode_prodi`) ON DELETE CASCADE,
  CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,4,'C0303','lll','ll','2025-07-03 10:50:06','2025-07-03 10:50:06'),(2,3,'C0303','test','hei','2025-07-03 16:58:40','2025-07-03 16:58:40'),(3,4,'C0303','Catatan hari ini','sidang','2025-07-03 23:16:35','2025-07-03 23:16:35');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('fikri772277@gmail.com','DTkhFWzsp5GEGSvSTAt1hQeSHlj6WhknczcJhpwzAnUG7jsbFKYzg5LWCJHS','2025-07-03 19:28:55'),('nugrah2919@gmail.com','ettrIPnpQOLBGJrV9unRxSIFAndnlb4VjBMMSJehhAUxAd7cC61wCjvMylMz','2025-07-02 10:43:15');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodis`
--

DROP TABLE IF EXISTS `prodis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prodis` (
  `kode_prodi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jurusan` bigint unsigned NOT NULL,
  `nama_prodi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi_prodi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kaprodi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_berdiri_prodi` date NOT NULL,
  `penyelenggaraan_prodi` date NOT NULL,
  `nomor_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sk` date NOT NULL,
  `peringkat_akreditasi` enum('A','B','C') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_sk_banpt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang_pendidikan` enum('D3','D4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gelar_lulusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faksimili_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_prodi`),
  KEY `prodis_id_jurusan_foreign` (`id_jurusan`),
  CONSTRAINT `prodis_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusans` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodis`
--

LOCK TABLES `prodis` WRITE;
/*!40000 ALTER TABLE `prodis` DISABLE KEYS */;
INSERT INTO `prodis` VALUES ('36304',1,'Teknologi Rekayasa Otomasi','lorem ipsum','lorem ipsum','2023-02-02','2023-05-16','0245','2022-06-07','B','S2036','D4','ST, M.T.','05113305052',NULL,'https://poliban.ac.id/elektro/d4-teknologi-rekayasa-otomasi/','0tomasi@gmail.com','2025-07-02 04:49:42','2025-07-15 18:41:53'),('57403',5,'Sistem Informasi','lorem ipsum','lorem ipsum','2025-07-13','2025-07-08','5885','2025-07-02','B','S2099','D3','ST.,MT','05113305052',NULL,'https://poliban.ac.id/','siinfo@gmail.com','2025-07-03 23:09:01','2025-07-15 18:42:02'),('C0303',1,'Teknik Informatika','lorem ipsum','lorem ipsum','2025-06-26','2025-06-26','21','2025-06-26','B','172817','D3','A.md.Kom','0812 3456 7890',NULL,'https://poliban.ac.id/elektro/d3-teknik-informatika/','tipoliban@gmail.com','2025-06-25 22:50:53','2025-07-15 18:42:10'),('C03034',1,'Teknologi Rekayasa Pembangkit Energi','lorem ipsum','lorem ipsum','2017-02-06','2017-02-08','2036','2023-02-08','B','S2036','D4','ST.,MT','05113305052',NULL,'https://poliban.ac.id/elektro/d4-teknologi-rekayasa-pembangkit-energi/','pembangkitenergi@gmail.com','2025-07-02 04:36:25','2025-07-15 18:42:17'),('C0305',1,'Elektronika','lorem ipsum','lorem ipsum','2023-02-02','2023-05-16','5881','2022-06-07','B','S2036','D3','ST, M.T.','05113305052',NULL,'https://poliban.ac.id/elektro/d3-elektronika/','elektronika@gmail.com','2025-07-02 04:45:30','2025-07-15 18:42:25'),('C5511',1,'Teknik listrik','lorem ipsum','lorem ipsum','2025-07-02','2025-07-02','12','2025-07-02','B','8271921','D3','Amd','05113305052',NULL,'https://poliban.ac.id/elektro/d3-teknik-listrik/','tl@gmail.com','2025-07-01 21:20:11','2025-07-15 18:42:34'),('C5555',1,'Sistem Informasi Kota Cerdas','lorem ipsum','lorem ipsum','2025-06-28','2025-07-12','2192','2025-07-05','B','172','D4','S.T.Kom','1234',NULL,'https://poliban.ac.id/elektro/d4-sistem-informasi-kota-cerdas/','sikc@gmail.com','2025-06-28 08:28:56','2025-07-15 18:42:42');
/*!40000 ALTER TABLE `prodis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profil_lulusans`
--

DROP TABLE IF EXISTS `profil_lulusans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profil_lulusans` (
  `id_pl` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_pl` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_prodi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tahun` bigint unsigned NOT NULL,
  `deskripsi_pl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesi_pl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unsur_pl` enum('Pengetahuan','Keterampilan Khusus','Sikap dan Keterampilan Umum') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_pl` enum('Kompetensi Utama Bidang','Kompetensi Tambahan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_pl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pl`),
  KEY `profil_lulusans_kode_prodi_foreign` (`kode_prodi`),
  KEY `profil_lulusans_id_tahun_foreign` (`id_tahun`),
  CONSTRAINT `profil_lulusans_id_tahun_foreign` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profil_lulusans_kode_prodi_foreign` FOREIGN KEY (`kode_prodi`) REFERENCES `prodis` (`kode_prodi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil_lulusans`
--

LOCK TABLES `profil_lulusans` WRITE;
/*!40000 ALTER TABLE `profil_lulusans` DISABLE KEYS */;
INSERT INTO `profil_lulusans` VALUES (1,'PL01','C0303',1,'(IABEE) Lulusan menguasai konsep dasar persoalan computing serta menerapkan prinsip-prinsip computing dan disiplin ilmu relevan lainnya untuk mengidentifikasi solusi bagi organisasi. (Pengetahuan)','- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) \r\n- Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) \r\n- INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)\r\n- IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)\r\n- dll','Pengetahuan','Kompetensi Utama Bidang','19 Jan 2023 V 1.1 - PANDUAN KURIKULUM BERBASIS OBE INFORMATIKA Hal.65','2025-06-25 23:11:04','2025-06-25 23:13:38'),(2,'PL02','C0303',1,'(IABEE) Lulusan memiliki kemampuan untuk mendesain dan mengimplementasikan solusi menggunakan perangkat lunak yang memenuhi kebutuhan pengguna dengan pendekatan yang sesuai di bidang industri pengolahan. (Keterampilan Khusus)','- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) \r\n- Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) \r\n- INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)\r\n- IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)\r\n- dll','Keterampilan Khusus','Kompetensi Utama Bidang','19 Jan 2023 V 1.1 - PANDUAN KURIKULUM BERBASIS OBE INFORMATIKA Hal.66','2025-06-25 23:14:33','2025-06-26 09:08:59'),(3,'PL03','C0303',1,'(IABEE) Lulusan memiliki kemampuan untuk mendesain dan mengimplementasikan solusi permasalahan pada sistem jaringan di bidang industri pengolahan. (Keterampilan Khusus)','- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) \r\n- Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) \r\n- INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)\r\n- IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)\r\n- dll','Keterampilan Khusus','Kompetensi Tambahan','Permen No. 53 Tahun 2023 dan PENGEMBANGAN KURIKULUM KKNI BERDASARKAN OBE - BIDANG ILMU INFORMATIKA DAN KOMPUTER 2019 Hal. 26','2025-06-25 23:15:14','2025-06-26 09:09:08'),(4,'PL04','C0303',1,'(KKNI) Lulusan mampu bekerjasama, berkomunikasi, dan berinovasi dalam perkerjaannya.','- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) \r\n- Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) \r\n- INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)\r\n- IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)\r\n- dll','Sikap dan Keterampilan Umum','Kompetensi Tambahan','PENGEMBANGAN KURIKULUM KKNI BERDASARKAN OBE - BIDANG ILMU INFORMATIKA DAN KOMPUTER 2019 Hal. 26','2025-06-25 23:15:44','2025-06-26 09:15:34'),(8,'PL01','C0303',6,'(IABEE) Lulusan menguasai konsep dasar persoalan computing serta menerapkan prinsip-prinsip computing dan disiplin ilmu relevan lainnya untuk mengidentifikasi solusi bagi organisasi. (Pengetahuan)','- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll)\r\n- Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR)\r\n- INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)\r\n- IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)\r\n- dll','Pengetahuan','Kompetensi Utama Bidang','a','2025-07-03 16:24:29','2025-07-03 16:28:09'),(10,'PL01','C0303',7,'PL01','PL01','Pengetahuan','Kompetensi Utama Bidang','PL01','2025-07-03 23:14:33','2025-07-03 23:14:33');
/*!40000 ALTER TABLE `profil_lulusans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('bTsLwlQQvjNQAiSZNEDBGdnhZlFDXg6FV9aUrNPR',1,'36.91.27.147','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemRBdG9nVFBmTU5zOVVCbW9qa0Y4em1tbVM0TmlGU3I2TXZFOXlQdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9vYmVwb2xpYmFuLnZwcy1wb2xpYmFuLm15LmlkL2FkbWluL3Zpc2kiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1752631893);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_cpmks`
--

DROP TABLE IF EXISTS `sub_cpmks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_cpmks` (
  `id_sub_cpmk` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_cpmk` bigint unsigned NOT NULL,
  `kode_mk` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_cpmk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_cpmk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_sub_cpmk`),
  KEY `sub_cpmks_id_cpmk_foreign` (`id_cpmk`),
  CONSTRAINT `sub_cpmks_id_cpmk_foreign` FOREIGN KEY (`id_cpmk`) REFERENCES `capaian_pembelajaran_mata_kuliahs` (`id_cpmk`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_cpmks`
--

LOCK TABLES `sub_cpmks` WRITE;
/*!40000 ALTER TABLE `sub_cpmks` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_cpmks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun`
--

DROP TABLE IF EXISTS `tahun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tahun` (
  `id_tahun` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kurikulum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun`
--

LOCK TABLES `tahun` WRITE;
/*!40000 ALTER TABLE `tahun` DISABLE KEYS */;
INSERT INTO `tahun` VALUES (1,'Kurikulum OBE','2025','2025-06-25 23:09:19','2025-06-27 20:54:51'),(6,'2024','2024','2025-07-03 16:23:45','2025-07-03 16:23:45'),(7,'Kurikulum OBE 2026','2026','2025-07-03 23:10:14','2025-07-03 23:10:14');
/*!40000 ALTER TABLE `tahun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','wadir1','kaprodi','tim') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_kode_prodi_foreign` (`kode_prodi`),
  KEY `nip` (`nip`),
  KEY `nohp` (`nohp`),
  CONSTRAINT `users_kode_prodi_foreign` FOREIGN KEY (`kode_prodi`) REFERENCES `prodis` (`kode_prodi`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@gmail.com',NULL,'$2y$12$yJj5a0dvyMU7IcQzyaJNJucNSAdBl2pY0ahQB6GlC6gReS5NWqzzm','admin',NULL,'approved',NULL,NULL,'2025-07-15 18:37:28','9018290','29018902'),(2,'TIM TI','timti@gmail.com',NULL,'$2y$12$kmA9ig8sl0jggURQqOA8fOoVar/.6.RKqTo1eRJpR3wi9AdT3h/Ie','tim','C0303','approved',NULL,'2025-06-25 22:51:18','2025-07-15 18:36:53','12345678','12345678'),(3,'wadir','wadir@gmail.com',NULL,'$2y$12$xcefxV0afYkjinBzRzCS4eV.qmoaW8lLkm9io6veH/PoWywc046dO','wadir1',NULL,'approved',NULL,'2025-06-25 22:52:51','2025-07-15 18:37:37','291890281','128971'),(4,'kaprodi','kaproditi@gmail.com',NULL,'$2y$12$OcMdygUdMe8PMTIfO5iAqeIopvuCCmTHBwAdKSx8wv7yrHBKTvyTu','kaprodi','C0303','approved',NULL,'2025-06-25 22:53:44','2025-07-15 18:37:13','129018290','9281902091');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visi_misi`
--

DROP TABLE IF EXISTS `visi_misi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visi_misi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visi_misi`
--

LOCK TABLES `visi_misi` WRITE;
/*!40000 ALTER TABLE `visi_misi` DISABLE KEYS */;
/*!40000 ALTER TABLE `visi_misi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visis`
--

DROP TABLE IF EXISTS `visis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visis`
--

LOCK TABLES `visis` WRITE;
/*!40000 ALTER TABLE `visis` DISABLE KEYS */;
INSERT INTO `visis` VALUES (1,'lorem ipsum','2025-07-15 18:44:32','2025-07-15 18:44:32');
/*!40000 ALTER TABLE `visis` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-16  9:18:51
