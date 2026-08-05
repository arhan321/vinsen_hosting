-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: md_farma
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
-- Table structure for table `admin_consultation_reads`
--

DROP TABLE IF EXISTS `admin_consultation_reads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_consultation_reads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) unsigned NOT NULL,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `last_read_message_id` bigint(20) unsigned DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_consultation_reads_admin_id_consultation_id_unique` (`admin_id`,`consultation_id`),
  KEY `admin_consultation_reads_consultation_id_foreign` (`consultation_id`),
  KEY `admin_consultation_reads_last_read_message_id_foreign` (`last_read_message_id`),
  KEY `admin_consultation_reads_read_at_index` (`read_at`),
  CONSTRAINT `admin_consultation_reads_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admin_consultation_reads_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admin_consultation_reads_last_read_message_id_foreign` FOREIGN KEY (`last_read_message_id`) REFERENCES `messages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_consultation_reads`
--

LOCK TABLES `admin_consultation_reads` WRITE;
/*!40000 ALTER TABLE `admin_consultation_reads` DISABLE KEYS */;
INSERT INTO `admin_consultation_reads` VALUES (1,1,1,1,'2026-08-02 22:40:52','2026-08-02 22:40:44','2026-08-02 22:40:52');
/*!40000 ALTER TABLE `admin_consultation_reads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'apotekmdfarma','$2y$12$uKFibw4oICNI3ySfQdAHrueFUX470qlJn2cW.P7l.zbLcwoWnb8dy','2026-08-02 22:24:07','2026-08-02 22:24:07');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `analytics_events`
--

DROP TABLE IF EXISTS `analytics_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `analytics_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_key` char(64) NOT NULL,
  `session_hash` char(64) NOT NULL,
  `event_type` varchar(60) NOT NULL,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `occurred_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `analytics_events_event_key_unique` (`event_key`),
  KEY `analytics_events_consultation_id_foreign` (`consultation_id`),
  KEY `analytics_events_event_type_occurred_at_index` (`event_type`,`occurred_at`),
  KEY `analytics_events_session_hash_index` (`session_hash`),
  KEY `analytics_events_event_type_index` (`event_type`),
  KEY `analytics_events_occurred_at_index` (`occurred_at`),
  CONSTRAINT `analytics_events_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `analytics_events`
--

LOCK TABLES `analytics_events` WRITE;
/*!40000 ALTER TABLE `analytics_events` DISABLE KEYS */;
INSERT INTO `analytics_events` VALUES (1,'b3cdf4448f76e33d5b212251d1dfd6211c129277bea6dbe04d036f663df89971','2a0734ee2737561951d39a6a3c36aaac033b4ff2cddc6009501edb0418048471','consultation_form_viewed',NULL,'{\"source\":\"consultation_form\"}','2026-08-02 22:39:17','2026-08-02 22:39:17','2026-08-02 22:39:17'),(2,'3cab4902818ba5a42f3179ffa42cf4c17b516edb3a6dbd8508c695947ba4b52d','2a0734ee2737561951d39a6a3c36aaac033b4ff2cddc6009501edb0418048471','consultation_created',1,'{\"type\":\"non_resep\",\"patient_relationship\":\"saya\"}','2026-08-02 22:40:09','2026-08-02 22:40:09','2026-08-02 22:40:09'),(3,'91e8b516680c755ebbc203780c820154b910270ee5199dfbdf222793280d0139','ef32574067f62aa66e31f4f77cf6cf44a7f4fec8d0961d88c3d4d928245bd7f9','chat_opened',1,'{\"actor\":\"patient\"}','2026-08-02 22:40:13','2026-08-02 22:40:13','2026-08-02 22:40:13'),(4,'6c7371b83889f9921a1e67cd06372cc2f45d0fbd723567c8b12ea58384aea7a0','ef32574067f62aa66e31f4f77cf6cf44a7f4fec8d0961d88c3d4d928245bd7f9','patient_message_sent',1,'{\"message_id\":1,\"has_attachment\":false,\"attachment_type\":null}','2026-08-02 22:40:33','2026-08-02 22:40:33','2026-08-02 22:40:33'),(5,'7dfba8bd441012a6bde82b3021fbd644a00ac856e8e76c7edf92ee689f3f594c','c4a040dd9503ea8d794012567634bda163a4faf1f78e5cc27af29f43e42621a3','admin_replied',1,'{\"message_id\":2,\"has_attachment\":false,\"attachment_type\":null}','2026-08-02 22:41:00','2026-08-02 22:41:00','2026-08-02 22:41:00');
/*!40000 ALTER TABLE `analytics_events` ENABLE KEYS */;
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
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `consultation_access_logs`
--

DROP TABLE IF EXISTS `consultation_access_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_access_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `message_id` bigint(20) unsigned DEFAULT NULL,
  `archive_copy_request_id` bigint(20) unsigned DEFAULT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consultation_access_logs_message_id_foreign` (`message_id`),
  KEY `consultation_access_logs_archive_copy_request_id_foreign` (`archive_copy_request_id`),
  KEY `consultation_access_logs_action_time_index` (`consultation_id`,`action`,`created_at`),
  KEY `consultation_access_logs_admin_time_index` (`admin_id`,`created_at`),
  CONSTRAINT `consultation_access_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_access_logs_archive_copy_request_id_foreign` FOREIGN KEY (`archive_copy_request_id`) REFERENCES `consultation_archive_copy_requests` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_access_logs_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_access_logs_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_access_logs`
--

LOCK TABLES `consultation_access_logs` WRITE;
/*!40000 ALTER TABLE `consultation_access_logs` DISABLE KEYS */;
INSERT INTO `consultation_access_logs` VALUES (1,1,NULL,NULL,1,'chat_viewed','{\"ip_hash\":\"7215e3caba19f21b6aff27e33b930543038290d8637ef319b54a3f836647f9bf\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/151.0.0.0 Safari\\/537.36\"}','2026-08-02 22:40:44');
/*!40000 ALTER TABLE `consultation_access_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_archive_copy_request_logs`
--

DROP TABLE IF EXISTS `consultation_archive_copy_request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_archive_copy_request_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `archive_copy_request_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `actor_type` varchar(20) NOT NULL,
  `previous_status` varchar(30) DEFAULT NULL,
  `new_status` varchar(30) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consultation_archive_copy_request_logs_admin_id_foreign` (`admin_id`),
  KEY `archive_request_logs_request_time_index` (`archive_copy_request_id`,`created_at`),
  CONSTRAINT `archive_request_logs_request_fk` FOREIGN KEY (`archive_copy_request_id`) REFERENCES `consultation_archive_copy_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_archive_copy_request_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_archive_copy_request_logs`
--

LOCK TABLES `consultation_archive_copy_request_logs` WRITE;
/*!40000 ALTER TABLE `consultation_archive_copy_request_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_archive_copy_request_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_archive_copy_requests`
--

DROP TABLE IF EXISTS `consultation_archive_copy_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_archive_copy_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `public_id` char(36) NOT NULL,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `history_owner_id` bigint(20) unsigned NOT NULL,
  `patient_profile_id` bigint(20) unsigned DEFAULT NULL,
  `requested_by_guest_id` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `reason` text NOT NULL,
  `contact_method` varchar(30) NOT NULL,
  `contact_value` varchar(120) NOT NULL,
  `patient_confirmed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_by_admin_id` bigint(20) unsigned DEFAULT NULL,
  `decision_notes` text DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultation_archive_copy_requests_public_id_unique` (`public_id`),
  KEY `consultation_archive_copy_requests_patient_profile_id_foreign` (`patient_profile_id`),
  KEY `consultation_archive_copy_requests_requested_by_guest_id_foreign` (`requested_by_guest_id`),
  KEY `consultation_archive_copy_requests_processed_by_admin_id_foreign` (`processed_by_admin_id`),
  KEY `archive_requests_owner_status_index` (`history_owner_id`,`status`,`submitted_at`),
  KEY `archive_requests_consultation_status_index` (`consultation_id`,`status`),
  CONSTRAINT `consultation_archive_copy_requests_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_archive_copy_requests_history_owner_id_foreign` FOREIGN KEY (`history_owner_id`) REFERENCES `consultation_history_owners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_archive_copy_requests_patient_profile_id_foreign` FOREIGN KEY (`patient_profile_id`) REFERENCES `consultation_patient_profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_archive_copy_requests_processed_by_admin_id_foreign` FOREIGN KEY (`processed_by_admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_archive_copy_requests_requested_by_guest_id_foreign` FOREIGN KEY (`requested_by_guest_id`) REFERENCES `consultation_guests` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_archive_copy_requests`
--

LOCK TABLES `consultation_archive_copy_requests` WRITE;
/*!40000 ALTER TABLE `consultation_archive_copy_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_archive_copy_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_classification_logs`
--

DROP TABLE IF EXISTS `consultation_classification_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_classification_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `previous_classification` varchar(40) DEFAULT NULL,
  `new_classification` varchar(40) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consultation_classification_logs_admin_id_foreign` (`admin_id`),
  KEY `class_logs_consultation_time_idx` (`consultation_id`,`created_at`),
  CONSTRAINT `consultation_classification_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_classification_logs_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_classification_logs`
--

LOCK TABLES `consultation_classification_logs` WRITE;
/*!40000 ALTER TABLE `consultation_classification_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_classification_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_classification_notices`
--

DROP TABLE IF EXISTS `consultation_classification_notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_classification_notices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `classification_log_id` bigint(20) unsigned DEFAULT NULL,
  `message_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `template_code` varchar(80) NOT NULL,
  `service_classification` varchar(40) NOT NULL,
  `content_snapshot` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultation_classification_notices_message_id_unique` (`message_id`),
  UNIQUE KEY `class_notices_class_log_unique` (`classification_log_id`),
  KEY `consultation_classification_notices_admin_id_foreign` (`admin_id`),
  KEY `class_notices_consultation_time_idx` (`consultation_id`,`sent_at`),
  CONSTRAINT `class_notices_class_log_fk` FOREIGN KEY (`classification_log_id`) REFERENCES `consultation_classification_logs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_classification_notices_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_classification_notices_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_classification_notices_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_classification_notices`
--

LOCK TABLES `consultation_classification_notices` WRITE;
/*!40000 ALTER TABLE `consultation_classification_notices` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_classification_notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_device_recoveries`
--

DROP TABLE IF EXISTS `consultation_device_recoveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_device_recoveries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `history_owner_id` bigint(20) unsigned NOT NULL,
  `source_consultation_id` bigint(20) unsigned DEFAULT NULL,
  `new_guest_id` bigint(20) unsigned DEFAULT NULL,
  `recovery_method` varchar(50) NOT NULL,
  `phone_hash` char(64) NOT NULL,
  `recovered_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultation_device_recoveries_source_consultation_id_foreign` (`source_consultation_id`),
  KEY `consultation_device_recoveries_new_guest_id_foreign` (`new_guest_id`),
  KEY `device_recovery_owner_time_index` (`history_owner_id`,`recovered_at`),
  CONSTRAINT `consultation_device_recoveries_history_owner_id_foreign` FOREIGN KEY (`history_owner_id`) REFERENCES `consultation_history_owners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_device_recoveries_new_guest_id_foreign` FOREIGN KEY (`new_guest_id`) REFERENCES `consultation_guests` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_device_recoveries_source_consultation_id_foreign` FOREIGN KEY (`source_consultation_id`) REFERENCES `consultations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_device_recoveries`
--

LOCK TABLES `consultation_device_recoveries` WRITE;
/*!40000 ALTER TABLE `consultation_device_recoveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_device_recoveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_device_revocations`
--

DROP TABLE IF EXISTS `consultation_device_revocations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_device_revocations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `history_owner_id` bigint(20) unsigned NOT NULL,
  `target_guest_id` bigint(20) unsigned DEFAULT NULL,
  `revoked_by_guest_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(32) NOT NULL,
  `revoked_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultation_device_revocations_target_guest_id_foreign` (`target_guest_id`),
  KEY `consultation_device_revocations_revoked_by_guest_id_foreign` (`revoked_by_guest_id`),
  KEY `device_revocation_owner_time_index` (`history_owner_id`,`revoked_at`),
  CONSTRAINT `consultation_device_revocations_history_owner_id_foreign` FOREIGN KEY (`history_owner_id`) REFERENCES `consultation_history_owners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_device_revocations_revoked_by_guest_id_foreign` FOREIGN KEY (`revoked_by_guest_id`) REFERENCES `consultation_guests` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_device_revocations_target_guest_id_foreign` FOREIGN KEY (`target_guest_id`) REFERENCES `consultation_guests` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_device_revocations`
--

LOCK TABLES `consultation_device_revocations` WRITE;
/*!40000 ALTER TABLE `consultation_device_revocations` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_device_revocations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_guests`
--

DROP TABLE IF EXISTS `consultation_guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_guests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `public_id` char(36) NOT NULL,
  `history_owner_id` bigint(20) unsigned DEFAULT NULL,
  `access_token_hash` char(64) DEFAULT NULL,
  `device_label` varchar(120) DEFAULT NULL,
  `first_seen_at` timestamp NULL DEFAULT NULL,
  `last_seen_at` timestamp NULL DEFAULT NULL,
  `revoked_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultation_guests_public_id_unique` (`public_id`),
  UNIQUE KEY `consultation_guests_access_token_hash_unique` (`access_token_hash`),
  KEY `consultation_guests_history_owner_id_foreign` (`history_owner_id`),
  CONSTRAINT `consultation_guests_history_owner_id_foreign` FOREIGN KEY (`history_owner_id`) REFERENCES `consultation_history_owners` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_guests`
--

LOCK TABLES `consultation_guests` WRITE;
/*!40000 ALTER TABLE `consultation_guests` DISABLE KEYS */;
INSERT INTO `consultation_guests` VALUES (1,'f7c7cc95-625e-498b-9a90-f08d464ee96b',1,'3f60997794122a7076134d1096a4445a5358f5f8a13f4035a35969c1b6e40a6d','Chrome di Windows','2026-08-02 22:40:08','2026-08-02 22:40:08',NULL,'2026-10-31 22:40:08','2026-08-02 22:40:08','2026-08-02 22:40:11');
/*!40000 ALTER TABLE `consultation_guests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_history_owners`
--

DROP TABLE IF EXISTS `consultation_history_owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_history_owners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `public_id` char(36) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_set_at` timestamp NULL DEFAULT NULL,
  `failed_attempts` smallint(5) unsigned NOT NULL DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultation_history_owners_public_id_unique` (`public_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_history_owners`
--

LOCK TABLES `consultation_history_owners` WRITE;
/*!40000 ALTER TABLE `consultation_history_owners` DISABLE KEYS */;
INSERT INTO `consultation_history_owners` VALUES (1,'12fd3c9b-d5bc-4971-b929-049ad729014f','$2y$12$FhLtMaQ.m6xo.QNgNTy28OdMUuJBtxQDwkmdVaNTjz.tzTgKxBihu','2026-08-02 22:40:09',0,NULL,'2026-08-02 22:40:09','2026-08-02 22:40:09');
/*!40000 ALTER TABLE `consultation_history_owners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_outcomes`
--

DROP TABLE IF EXISTS `consultation_outcomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_outcomes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `classification_log_id` bigint(20) unsigned DEFAULT NULL,
  `screening_id` bigint(20) unsigned DEFAULT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `service_classification` varchar(40) NOT NULL,
  `outcome_code` varchar(60) NOT NULL,
  `outcome_label` varchar(160) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consultation_outcomes_classification_log_id_foreign` (`classification_log_id`),
  KEY `consultation_outcomes_screening_id_foreign` (`screening_id`),
  KEY `consultation_outcomes_admin_id_foreign` (`admin_id`),
  KEY `outcomes_consultation_context_index` (`consultation_id`,`classification_log_id`,`screening_id`,`id`),
  KEY `outcomes_consultation_classification_index` (`consultation_id`,`service_classification`,`id`),
  CONSTRAINT `consultation_outcomes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_outcomes_classification_log_id_foreign` FOREIGN KEY (`classification_log_id`) REFERENCES `consultation_classification_logs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_outcomes_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultation_outcomes_screening_id_foreign` FOREIGN KEY (`screening_id`) REFERENCES `consultation_screenings` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_outcomes`
--

LOCK TABLES `consultation_outcomes` WRITE;
/*!40000 ALTER TABLE `consultation_outcomes` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_outcomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_patient_profiles`
--

DROP TABLE IF EXISTS `consultation_patient_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_patient_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `history_owner_id` bigint(20) unsigned NOT NULL,
  `public_id` char(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` smallint(5) unsigned NOT NULL,
  `phone` varchar(25) NOT NULL,
  `relationship` enum('saya','anak','pasangan','orang_tua','lainnya') NOT NULL DEFAULT 'lainnya',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultation_patient_profiles_public_id_unique` (`public_id`),
  KEY `patient_profile_owner_default_index` (`history_owner_id`,`is_default`),
  KEY `patient_profile_owner_last_used_index` (`history_owner_id`,`last_used_at`),
  CONSTRAINT `consultation_patient_profiles_history_owner_id_foreign` FOREIGN KEY (`history_owner_id`) REFERENCES `consultation_history_owners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_patient_profiles`
--

LOCK TABLES `consultation_patient_profiles` WRITE;
/*!40000 ALTER TABLE `consultation_patient_profiles` DISABLE KEYS */;
INSERT INTO `consultation_patient_profiles` VALUES (1,1,'042c8301-50f1-43ce-b8b2-3d5c04fab104','Vinsens Aji Pamungkas',32,'+6287842980020','saya',1,'2026-08-02 22:40:09','2026-08-02 22:40:09','2026-08-02 22:40:09');
/*!40000 ALTER TABLE `consultation_patient_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_screenings`
--

DROP TABLE IF EXISTS `consultation_screenings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_screenings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `classification_log_id` bigint(20) unsigned DEFAULT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `service_classification` varchar(40) NOT NULL,
  `answers` longtext NOT NULL,
  `notes` text DEFAULT NULL,
  `required_count` smallint(5) unsigned NOT NULL,
  `completed_count` smallint(5) unsigned NOT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consultation_screenings_classification_log_id_foreign` (`classification_log_id`),
  KEY `consultation_screenings_admin_id_foreign` (`admin_id`),
  KEY `screenings_consultation_log_id_index` (`consultation_id`,`classification_log_id`,`id`),
  KEY `screenings_consultation_classification_index` (`consultation_id`,`service_classification`,`id`),
  CONSTRAINT `consultation_screenings_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_screenings_classification_log_id_foreign` FOREIGN KEY (`classification_log_id`) REFERENCES `consultation_classification_logs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_screenings_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_screenings`
--

LOCK TABLES `consultation_screenings` WRITE;
/*!40000 ALTER TABLE `consultation_screenings` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_screenings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_status_logs`
--

DROP TABLE IF EXISTS `consultation_status_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultation_status_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `previous_status` varchar(20) NOT NULL,
  `new_status` varchar(20) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `consultation_status_logs_admin_id_foreign` (`admin_id`),
  KEY `consultation_status_logs_consultation_time_index` (`consultation_id`,`created_at`),
  CONSTRAINT `consultation_status_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_status_logs_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_status_logs`
--

LOCK TABLES `consultation_status_logs` WRITE;
/*!40000 ALTER TABLE `consultation_status_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultation_status_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultations`
--

DROP TABLE IF EXISTS `consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `public_id` char(36) DEFAULT NULL,
  `guest_id` bigint(20) unsigned DEFAULT NULL,
  `patient_profile_id` bigint(20) unsigned DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `jenis_konsultasi` enum('resep','non_resep') NOT NULL,
  `privacy_consent_at` timestamp NULL DEFAULT NULL,
  `privacy_policy_version` varchar(40) DEFAULT NULL,
  `privacy_consent_text` text DEFAULT NULL,
  `privacy_consent_ip_hash` char(64) DEFAULT NULL,
  `privacy_consent_user_agent_hash` char(64) DEFAULT NULL,
  `service_classification` varchar(40) DEFAULT NULL,
  `classified_by_admin_id` bigint(20) unsigned DEFAULT NULL,
  `classified_at` timestamp NULL DEFAULT NULL,
  `status` enum('aktif','selesai') NOT NULL DEFAULT 'aktif',
  `first_admin_reply_at` timestamp NULL DEFAULT NULL,
  `last_message_at` timestamp NULL DEFAULT NULL,
  `last_message_sender` varchar(20) DEFAULT NULL,
  `patient_last_read_message_id` bigint(20) unsigned DEFAULT NULL,
  `patient_read_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultations_public_id_unique` (`public_id`),
  KEY `consultations_guest_id_foreign` (`guest_id`),
  KEY `consultations_first_admin_reply_at_index` (`first_admin_reply_at`),
  KEY `consultations_last_message_at_index` (`last_message_at`),
  KEY `consultations_closed_at_index` (`closed_at`),
  KEY `consultations_last_message_sender_index` (`last_message_sender`),
  KEY `consultations_classified_by_admin_id_foreign` (`classified_by_admin_id`),
  KEY `consultations_patient_profile_id_foreign` (`patient_profile_id`),
  KEY `consultations_patient_last_read_message_id_index` (`patient_last_read_message_id`),
  CONSTRAINT `consultations_classified_by_admin_id_foreign` FOREIGN KEY (`classified_by_admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultations_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `consultation_guests` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultations_patient_profile_id_foreign` FOREIGN KEY (`patient_profile_id`) REFERENCES `consultation_patient_profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultations`
--

LOCK TABLES `consultations` WRITE;
/*!40000 ALTER TABLE `consultations` DISABLE KEYS */;
INSERT INTO `consultations` VALUES (1,'22415dfe-4ab4-4163-a0b6-838546326c16',1,1,'Vinsens Aji Pamungkas',32,'+6287842980020','non_resep','2026-08-02 22:40:09','2026-08-01','Saya menyetujui MD Farma memproses data identitas, isi percakapan, dan lampiran untuk pelayanan konsultasi kefarmasian, dokumentasi pelayanan, keamanan, audit, serta pemenuhan kewajiban yang berlaku. Saya memahami isi chat dapat diakses melalui dashboard pasien selama 60 hari setelah konsultasi selesai, kemudian tidak lagi ditampilkan kepada pasien tetapi tetap dikelola sebagai arsip internal sesuai kebijakan retensi MD Farma.','7215e3caba19f21b6aff27e33b930543038290d8637ef319b54a3f836647f9bf','072219918ce4c33a722874131d095f62d56c2240af96325f64cc053632cac311',NULL,NULL,NULL,'aktif','2026-08-02 22:41:00','2026-08-02 22:41:00','admin',2,'2026-08-02 22:41:04',NULL,'2026-08-02 22:40:09','2026-08-02 22:41:04');
/*!40000 ALTER TABLE `consultations` ENABLE KEYS */;
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
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
  `attempts` smallint(5) unsigned NOT NULL,
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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `sender` enum('user','admin') NOT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_consultation_id_foreign` (`consultation_id`),
  CONSTRAINT `messages_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,'user','halo pak,selamat siang',NULL,'2026-08-02 22:40:33','2026-08-02 22:40:33'),(2,1,'admin','siang pak',NULL,'2026-08-02 22:41:00','2026-08-02 22:41:00');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_07_25_160751_create_admins_table',1),(5,'2026_07_25_160813_create_consultations_table',1),(6,'2026_07_25_160827_create_messages_table',1),(7,'2026_07_26_230000_add_secure_guest_access_to_consultations',1),(8,'2026_07_27_010000_add_analytics_timestamps_to_consultations',1),(9,'2026_07_27_010100_create_analytics_events_table',1),(10,'2026_07_27_020000_add_inbox_state_to_consultations',1),(11,'2026_07_27_020100_create_admin_consultation_reads_table',1),(12,'2026_07_31_191500_add_service_classification_to_consultations_table',1),(13,'2026_07_31_200900_create_consultation_classification_logs_table',1),(14,'2026_07_31_205100_create_consultation_classification_notices_table',1),(15,'2026_07_31_213500_create_consultation_screenings_table',1),(16,'2026_07_31_224500_create_consultation_outcomes_table',1),(17,'2026_07_31_231500_create_consultation_history_owners_table',1),(18,'2026_07_31_234500_add_trusted_device_fields_to_consultation_guests',1),(19,'2026_08_01_093000_create_consultation_device_recoveries_table',1),(20,'2026_08_01_103000_add_device_management_to_consultation_guests',1),(21,'2026_08_01_111500_create_consultation_patient_profiles_table',1),(22,'2026_08_01_132500_create_consultation_archive_copy_requests_tables',1),(23,'2026_08_01_150000_harden_consultation_integrity',1),(24,'2026_08_01_160000_add_privacy_consent_to_consultations',1),(25,'2026_08_01_220000_add_patient_read_tracking_to_consultations',1);
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
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'md_farma'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-03 12:58:35
