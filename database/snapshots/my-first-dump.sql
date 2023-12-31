
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
DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `old` enum('days','months','years') DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `patient_id` bigint(20) unsigned DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appointments_appointment_date_appointment_time_profile_id_unique` (`appointment_date`,`appointment_time`,`profile_id`),
  KEY `appointments_user_id_foreign` (`user_id`),
  CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (6,47,5,'Vijoy Sasidharan','male','2023-12-01',40,'years','1234567890','Trivandrum','2023-12-01','10:15:00',NULL,47,5,'2023-11-01 06:10:36','2023-12-07 10:26:49',NULL),(12,47,5,'Sherly Wilson',NULL,'2023-12-01',40,'years','1234567890','Trivandrum','2023-12-01','10:30:00',NULL,47,5,'2023-12-01 06:10:36','2023-12-01 06:38:05',NULL),(13,47,5,'Sunitha Vikram',NULL,'2023-12-01',40,'years','1234567890','Trivandrum','2023-12-01','10:45:00',NULL,47,5,'2023-12-01 06:10:36','2023-12-01 06:38:05',NULL),(14,47,5,'Shiva',NULL,'2023-12-06',5,'years','0123456789','Tvm','2023-12-06','14:30:00',4,5,5,'2023-12-06 02:18:29','2023-12-06 09:50:28',NULL);
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `callbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callbacks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(15) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `status` enum('pending','hold','completed') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `callbacks` WRITE;
/*!40000 ALTER TABLE `callbacks` DISABLE KEYS */;
INSERT INTO `callbacks` VALUES (1,'9188848860',NULL,'pending','2023-12-30 07:48:07','2023-12-30 07:48:07'),(2,'9995376774',NULL,'pending','2023-12-30 07:49:10','2023-12-30 07:49:10');
/*!40000 ALTER TABLE `callbacks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `patient_id` bigint(20) unsigned NOT NULL,
  `medical_record_number` varchar(255) NOT NULL,
  `medical_history` text DEFAULT NULL,
  `examination` text DEFAULT NULL,
  `investigation` text DEFAULT NULL,
  `advice` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `allergic_drugs` text DEFAULT NULL,
  `surgery_advised` enum('yes','no') NOT NULL,
  `review_date` datetime DEFAULT NULL,
  `fee` decimal(7,2) DEFAULT NULL,
  `review` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-Yes, 0-No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultations_medical_record_number_unique` (`medical_record_number`),
  KEY `consultations_user_id_foreign` (`user_id`),
  KEY `consultations_patient_id_foreign` (`patient_id`),
  CONSTRAINT `consultations_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  CONSTRAINT `consultations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `consultations` WRITE;
/*!40000 ALTER TABLE `consultations` DISABLE KEYS */;
INSERT INTO `consultations` VALUES (2,47,5,6,'MPP-MRN-1','sdfds',NULL,NULL,NULL,NULL,NULL,'no','2023-12-30 00:00:00',0.00,0,'2023-12-10 14:11:18','2023-12-10 16:12:00',NULL),(5,47,5,7,'MPP-MRN-2','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,','Investigation','Advice / Referrals',NULL,'Allergic to drugs','no','2023-12-20 00:00:00',0.00,0,'2023-12-11 11:41:20','2023-12-11 14:14:46',NULL),(6,47,5,8,'MPP-MRN-3','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',NULL,NULL,'no',NULL,0.00,0,'2023-12-12 12:04:24','2023-12-12 12:04:24',NULL),(7,47,5,9,'MPP-MRN-4',NULL,NULL,NULL,NULL,NULL,NULL,'no',NULL,0.00,0,'2023-12-15 11:57:21','2023-12-15 11:57:21',NULL),(8,47,5,4,'MPP-MRN-5',NULL,NULL,NULL,NULL,NULL,NULL,'no',NULL,0.00,0,'2023-12-15 12:51:01','2023-12-15 12:51:01',NULL),(9,47,5,4,'MPP-MRN-6',NULL,NULL,NULL,NULL,NULL,NULL,'no',NULL,250.00,1,'2023-12-16 14:57:01','2023-12-16 14:57:01',NULL),(10,47,5,10,'MPP-MRN-7',NULL,NULL,NULL,NULL,NULL,NULL,'no',NULL,250.00,0,'2023-12-16 14:58:08','2023-12-16 14:58:08',NULL),(11,47,5,11,'MPP-MRN-8',NULL,NULL,NULL,NULL,NULL,NULL,'no',NULL,250.00,0,'2023-12-31 03:33:47','2023-12-31 03:33:47',NULL);
/*!40000 ALTER TABLE `consultations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `diagnoses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnoses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `diagnoses` WRITE;
/*!40000 ALTER TABLE `diagnoses` DISABLE KEYS */;
INSERT INTO `diagnoses` VALUES (1,47,5,NULL,'Diagnosis 1'),(2,47,5,1,'Diagnosis 1');
/*!40000 ALTER TABLE `diagnoses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `patient_id` bigint(20) unsigned DEFAULT NULL,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `mrn` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_user_id_foreign` (`user_id`),
  CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,47,5,6,2,NULL,'/storage/uploads/document//1702532677_wt.docx','mpp-mrn-1','2023-12-14 05:44:37','2023-12-14 06:23:42',NULL),(2,47,5,7,5,NULL,'/storage/uploads/document/5/1702533359_wt.docx','fg','2023-12-14 05:55:59','2023-12-14 05:55:59',NULL),(3,47,5,8,6,'mpp-mrn-3','/storage/uploads/document/6/1702535237_wt.docx','mpp-mrn-3','2023-12-14 06:27:17','2023-12-14 06:27:17',NULL),(4,47,5,8,6,'mpp-mrn-3','/storage/uploads/document/6/1702540946_1702535237_wt.docx','dsdf','2023-12-14 08:02:26','2023-12-14 08:17:43','2023-12-14 08:17:43'),(5,47,5,11,11,'MPP-MRN-8','https://medprepro.s3.ap-south-1.amazonaws.com/documents/11/201GRfXyvS21jEDTrjIBjg4uVVoaOPEwLvv5MYxB.png','sad','2023-12-31 03:34:58','2023-12-31 03:34:58',NULL),(6,47,5,11,11,'MPP-MRN-8','https://medprepro.s3.ap-south-1.amazonaws.com/documents/47/5/l5ANeiYRcFQQethYIbo6lMLg9NHT4ypUMrvhZiBK.pdf','sdf','2023-12-31 03:40:21','2023-12-31 03:40:21',NULL);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `feedback` longtext DEFAULT NULL,
  `recommend` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-yes, 0-no',
  `publish` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-yes, 0-no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feedback_user_id_foreign` (`user_id`),
  KEY `feedback_profile_id_foreign` (`profile_id`),
  CONSTRAINT `feedback_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,47,5,'mail@cybernetics.me','This is a test feedback',1,0,'2023-12-30 04:48:21','2023-12-30 04:48:21');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `medicines` WRITE;
/*!40000 ALTER TABLE `medicines` DISABLE KEYS */;
INSERT INTO `medicines` VALUES (1,'medicine 1',47,5),(2,'gdfgdfg',47,5),(3,'kkk',47,5),(4,'ghjghhhh',47,5),(5,'there are no',47,5),(6,'ghjghjg',47,5),(7,'Paracetamol',47,5),(8,'sdfsd',47,5),(9,'dfgdfgdf',47,5),(10,'kkkkk',47,5),(11,'tyyy',47,5),(12,'hjkhj',47,5),(13,'gdfgdfgd',47,5),(14,'hkhj',47,5),(15,'dfgdfg',47,5),(16,'dfgdfg',47,5);
/*!40000 ALTER TABLE `medicines` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` enum('pending','fixed') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`),
  KEY `messages_profile_id_foreign` (`profile_id`),
  CONSTRAINT `messages_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,47,5,'mail@cybernetics.me','This is test message','pending','2023-12-30 04:25:49','2023-12-30 04:25:49');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_11_24_140500_create_profiles_table',2),(6,'2023_11_24_140629_create_otps_table',2),(7,'2023_11_26_174658_create_appointments_table',3),(9,'2023_12_06_080020_create_patients_table',5),(10,'2023_12_06_084320_create_consultations_table',5),(11,'2023_12_06_084611_create_documents_table',5),(12,'2023_12_07_133418_create_symptoms_table',6),(13,'2023_12_07_134733_create_diagnoses_table',6),(14,'2023_12_07_183915_create_medicines_table',7),(15,'2023_12_07_210928_create_tests_table',8),(17,'2023_12_08_210125_create_quotes_table',9),(18,'2023_12_10_182108_create_patient_medicines_table',9),(19,'2023_12_10_205848_create_patient_symptoms_table',10),(20,'2023_12_10_205906_create_patient_diagnoses_table',10),(21,'2023_12_10_210133_create_patient_tests_table',10),(22,'2023_11_30_202446_create_settings_table',11),(23,'2023_12_16_171026_create_months_table',12),(24,'2023_12_30_094335_create_messages_table',13),(25,'2023_12_30_100813_create_feedback_table',14),(26,'2023_12_30_104450_create_referrals_table',15),(27,'2023_12_30_131405_create_callbacks_table',16);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `months`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `months` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `short_name` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `months` WRITE;
/*!40000 ALTER TABLE `months` DISABLE KEYS */;
INSERT INTO `months` VALUES (1,'January','Jan'),(2,'February','Feb'),(3,'March','Mar'),(4,'April','Apr'),(5,'May','May'),(6,'June','Jun'),(7,'July','Jul'),(8,'August','Aug'),(9,'September','Sep'),(10,'October','Oct'),(11,'November','Nov'),(12,'December','Dec');
/*!40000 ALTER TABLE `months` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `otps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `description` enum('verification','login') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `otps` WRITE;
/*!40000 ALTER TABLE `otps` DISABLE KEYS */;
INSERT INTO `otps` VALUES (4,46,'9188848860','770345','verification','2023-11-25 06:49:28','2023-11-25 06:49:28'),(5,46,'9188848860','105560','verification','2023-11-25 06:50:54','2023-11-25 06:50:54'),(6,46,'9188848860','361713','verification','2023-11-25 06:51:16','2023-11-25 06:51:16'),(7,46,'9188848860','814219','verification','2023-11-25 06:51:16','2023-11-25 06:51:16'),(8,46,'9188848860','175607','verification','2023-11-25 06:54:43','2023-11-25 06:54:43'),(9,46,'9188848860','133048','verification','2023-11-25 08:44:37','2023-11-25 08:44:37'),(10,46,'9188848860','884214','verification','2023-11-25 08:47:41','2023-11-25 08:47:41'),(11,46,'9188848860','535854','verification','2023-11-25 08:47:54','2023-11-25 08:47:54'),(12,46,'9188848860','273399','verification','2023-11-25 08:49:15','2023-11-25 08:49:15'),(13,46,'9188848860','230450','verification','2023-11-25 08:51:03','2023-11-25 08:51:03'),(14,46,'9188848860','405526','verification','2023-11-25 08:51:15','2023-11-25 08:51:15'),(15,46,'9188848860','145901','verification','2023-11-25 08:51:33','2023-11-25 08:51:33'),(16,46,'9188848860','107078','verification','2023-11-25 08:51:44','2023-11-25 08:51:44'),(17,46,'9188848860','105247','verification','2023-11-25 08:52:08','2023-11-25 08:52:08'),(18,46,'9188848860','586657','verification','2023-11-25 08:52:42','2023-11-25 08:52:42'),(19,46,'9188848860','927665','verification','2023-11-25 08:54:08','2023-11-25 08:54:08'),(20,46,'9188848860','487776','verification','2023-11-25 08:54:35','2023-11-25 08:54:35'),(21,46,'9188848860','466021','verification','2023-11-25 08:55:14','2023-11-25 08:55:14'),(22,46,'9188848860','484625','verification','2023-11-25 08:56:21','2023-11-25 08:56:21'),(23,46,'9188848860','616413','verification','2023-11-25 08:56:55','2023-11-25 08:56:55'),(24,46,'9188848860','528699','verification','2023-11-25 11:52:26','2023-11-25 11:52:26'),(25,47,'9188848860','220555','verification','2023-11-26 11:31:04','2023-11-26 11:31:04'),(26,47,'9188848860','650914','verification','2023-11-30 12:07:27','2023-11-30 12:07:27'),(27,48,'9188828860','613314','verification','2023-12-11 08:13:59','2023-12-11 08:13:59'),(28,47,'9188848860','828547','verification','2023-12-30 03:03:10','2023-12-30 03:03:10');
/*!40000 ALTER TABLE `otps` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `patient_diagnoses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_diagnoses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `patient_diagnoses` WRITE;
/*!40000 ALTER TABLE `patient_diagnoses` DISABLE KEYS */;
INSERT INTO `patient_diagnoses` VALUES (1,2,'Diagnosis 1'),(3,5,'Diagnosis 1'),(4,6,'Diagnosis 1');
/*!40000 ALTER TABLE `patient_diagnoses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `patient_medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_medicines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned NOT NULL,
  `medicine_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) DEFAULT 0,
  `dosage` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_medicines_consultation_id_foreign` (`consultation_id`),
  KEY `patient_medicines_medicine_id_foreign` (`medicine_id`),
  CONSTRAINT `patient_medicines_consultation_id_foreign` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `patient_medicines_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `patient_medicines` WRITE;
/*!40000 ALTER TABLE `patient_medicines` DISABLE KEYS */;
INSERT INTO `patient_medicines` VALUES (7,2,15,1,'1-1-1','2 dyas','nothing'),(8,2,7,NULL,NULL,NULL,NULL),(10,5,7,15,'1-1-1','5 Days',NULL),(11,6,7,15,'1-1-1','5 days',NULL);
/*!40000 ALTER TABLE `patient_medicines` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `patient_symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_symptoms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `patient_symptoms` WRITE;
/*!40000 ALTER TABLE `patient_symptoms` DISABLE KEYS */;
INSERT INTO `patient_symptoms` VALUES (6,2,'Symptom1'),(9,5,'Symptom 2'),(10,5,'Symptom 3'),(11,6,'Symptom 3');
/*!40000 ALTER TABLE `patient_symptoms` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `patient_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_tests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `patient_tests` WRITE;
/*!40000 ALTER TABLE `patient_tests` DISABLE KEYS */;
INSERT INTO `patient_tests` VALUES (1,2,'covid'),(2,2,'urine'),(4,5,'covid'),(5,6,'urine');
/*!40000 ALTER TABLE `patient_tests` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `patient_id` varchar(25) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `old` enum('days','months','years') DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patients_patient_id_unique` (`patient_id`),
  KEY `patients_user_id_foreign` (`user_id`),
  CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,0,47,5,'MPP-P-1','Anupama Jayan',NULL,'2023-12-06',23,'years','9188848860',NULL,'Trivandrum',5,5,'2023-12-06 09:14:05','2023-12-06 09:22:33',NULL),(4,14,47,5,'MPP-P-2','Shiva','male','2023-12-06',5,'years','0123456789',NULL,'Tvm',5,5,'2023-12-06 09:50:28','2023-12-15 12:57:59',NULL),(5,0,47,5,'MPP-P-3','Mathu',NULL,'2023-12-07',NULL,NULL,'0254455454','sdfsdf@sdcom.com','Tvm',5,5,'2023-12-07 03:21:42','2023-12-07 03:22:52',NULL),(6,0,47,5,'MPP-P-4','Aromal Krishna','male',NULL,10,'years','2883758347',NULL,'Trivandrum',5,5,'2023-12-10 12:31:34','2023-12-10 12:31:34',NULL),(7,0,47,5,'MPP-P-5','Raveendran Nair','male',NULL,50,'years','1234567900',NULL,'Neyyattinkara',5,5,'2023-12-11 11:39:53','2023-12-11 11:39:53',NULL),(8,0,47,5,'MPP-P-6','Aromal','male',NULL,10,'years','4545545454',NULL,'Tvm',5,5,'2023-12-12 12:02:49','2023-12-12 12:02:49',NULL),(9,0,47,5,'MPP-P-7','Ramesh Nair','male',NULL,50,'years','1466867745',NULL,'Attingal',5,5,'2023-12-15 11:57:09','2023-12-15 11:57:09',NULL),(10,0,47,5,'MPP-P-8','dfdsfsd','male',NULL,12,NULL,'5334534534',NULL,'34534',5,5,'2023-12-16 14:57:57','2023-12-16 14:57:57',NULL),(11,0,47,5,'MPP-P-9','df','male','2023-12-31',NULL,NULL,'2342223423',NULL,'sfsdf',5,5,'2023-12-31 03:33:35','2023-12-31 03:33:35',NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `consultation_fee` decimal(7,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (5,47,'Administrator','MD','32154',250.00,'2023-11-26 11:30:59','2023-12-14 04:19:40',NULL),(6,48,'sujatah',NULL,NULL,NULL,'2023-12-11 08:13:55','2023-12-11 08:13:55',NULL),(7,47,'Vijoy Sasidharan','MBBS, MD','12345',350.00,'2023-12-14 04:15:32','2023-12-14 04:17:43',NULL);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quote` text DEFAULT NULL,
  `author` text DEFAULT NULL,
  `category` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `referrals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referrals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `referral_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `referrals_user_id_referral_code_unique` (`user_id`,`referral_code`),
  CONSTRAINT `referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `referrals` WRITE;
/*!40000 ALTER TABLE `referrals` DISABLE KEYS */;
INSERT INTO `referrals` VALUES (3,47,'00987654321','2023-12-30 07:00:37','2023-12-30 07:00:37');
/*!40000 ALTER TABLE `referrals` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `appointment_start` time DEFAULT NULL,
  `appointment_end` time DEFAULT NULL,
  `appointment_duration` int(11) NOT NULL DEFAULT 0,
  `watermark_text` varchar(255) DEFAULT NULL,
  `watermark_image` varchar(255) DEFAULT NULL,
  `watermark_preference` enum('image','text','no') DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `next_visit_followup_sms` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-yes, 0-no',
  `appointment_scheduled_sms` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-yes, 0-no',
  `appointment_updated_sms` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-yes, 0-no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `settings_user_id_foreign` (`user_id`),
  CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,47,'Anupama Jayan','9188848860','Varkala\r\nTrivandrum\r\nEmail: mail@cybernetics.me','09:00:00','19:00:00',15,'Medical Prescription Pro','/storage/uploads/47/watermark/1702281050_logo-mpp-dark.png','image','/storage/uploads/47/logo/1702281050_logo-mpp-dark.png',0,0,0,'2023-12-11 07:41:59','2023-12-11 07:50:50'),(2,48,NULL,NULL,NULL,'09:00:00','19:00:00',15,NULL,NULL,NULL,NULL,0,0,0,'2023-12-11 08:13:55','2023-12-11 08:13:55');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `symptoms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `symptoms` WRITE;
/*!40000 ALTER TABLE `symptoms` DISABLE KEYS */;
INSERT INTO `symptoms` VALUES (1,47,5,NULL,'Symptom1'),(2,47,5,NULL,'Symptom 2'),(3,47,5,NULL,'Symptom 3'),(4,47,5,1,'Symptom1'),(5,47,5,1,'Symptom 2'),(6,47,5,1,'Symptom 3');
/*!40000 ALTER TABLE `symptoms` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `consultation_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,47,5,NULL,'urine'),(2,47,5,NULL,'covid'),(3,47,5,1,'urine'),(4,47,5,1,'covid');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `mobile_verified_at` datetime DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `referral_code` varchar(100) DEFAULT NULL,
  `plan` enum('free','basic','premium') NOT NULL,
  `subscription` enum('monthly','yearly') NOT NULL DEFAULT 'monthly',
  `plan_expired_at` datetime DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (47,'Anupama Jayan','admin','mail@cybernetics.me',NULL,'9188848860','2023-12-30 08:33:24',NULL,'$2y$12$NWAyfVktsGCuMtBbDwTxGeGHnH4nONhCDXJx92VZD1IxajPG5FYlS','1234567890','premium','monthly','2023-12-26 17:00:58',NULL,NULL,'This is my bio','2023-11-26 11:30:59','2023-12-30 05:10:51',NULL),(48,'Dr Sujatha','sujatah','test@test.com',NULL,'9188828860','2023-12-11 13:44:19',NULL,'$2y$12$k9U1p4v7Q4wRn4cV4tgXYOvbAAETxdS02mKT0SiqP4H2ILQfTCCJa','00987654321','free','monthly','2024-01-10 13:43:55',NULL,NULL,NULL,'2023-12-11 08:13:55','2023-12-11 08:14:19',NULL);
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

