-- MySQL dump 10.15  Distrib 10.0.38-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: lstms_sport_desk
-- ------------------------------------------------------
-- Server version	10.0.37-MariaDB

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
-- Table structure for table `event_awards`
--

DROP TABLE IF EXISTS `event_awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_awards` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `award_title` varchar(255) DEFAULT NULL,
  `award_description` text,
  `award_status` tinyint(4) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`award_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_awards`
--

LOCK TABLES `event_awards` WRITE;
/*!40000 ALTER TABLE `event_awards` DISABLE KEYS */;
INSERT INTO `event_awards` (`award_id`, `event_id`, `award_title`, `award_description`, `award_status`, `created_by`, `created_at`, `updated_at`) VALUES (1,1,'The Fastest Western Province Student - Male','100 meters champion of provincial schools',1,3,'2019-03-26 17:00:56','2019-05-02 05:45:15'),(2,1,'The Fastest Western Province Student - Female','100 meters champion of provincial schools',0,3,'2019-03-26 17:01:11','2019-04-22 08:50:17'),(3,1,'The Sportstar','Highest Medal winner of the sportmeet',0,3,'2019-03-26 17:02:55','2019-04-22 08:50:17'),(4,3,'The Best House - Decoration','Highest point taker for the decoration of the house',1,3,'2019-03-26 17:04:30','2019-03-29 08:10:37'),(5,1,'The Captain Of the Year','The best team leader of all group games in 2019',0,3,'2019-03-29 10:21:10','2019-04-22 08:50:17'),(6,1,'Something','Something Different',0,3,'2019-03-29 10:25:09','2019-04-22 08:50:17'),(7,2,'sineth','hddjd',-1,3,'2019-03-29 18:37:42','2019-04-30 05:46:36'),(8,2,'tesst','test',-1,3,'2019-04-11 09:15:43','2019-04-30 05:46:36'),(9,2,'first','first',-1,3,'2019-04-11 09:15:56','2019-04-30 05:46:36'),(10,2,'first','first',-1,3,'2019-04-11 09:16:07','2019-04-30 05:46:36'),(11,2,'first','first',-1,3,'2019-04-11 09:16:07','2019-04-30 05:46:36'),(12,2,'first','first',-1,3,'2019-04-11 09:16:18','2019-04-30 05:46:36'),(13,2,'first','first',-1,3,'2019-04-11 09:16:38','2019-04-30 05:46:36'),(14,2,'first','first',-1,3,'2019-04-11 09:16:46','2019-04-30 05:46:36'),(15,5,'First ','First ',1,3,'2019-04-11 09:18:43','2019-04-11 09:21:32'),(16,5,'First ','First ',0,3,'2019-04-11 09:20:48','2019-04-11 09:21:27'),(17,5,'First ','First ',1,3,'2019-04-11 09:20:48','2019-04-11 09:20:48'),(18,5,'First ','First ',1,3,'2019-04-11 09:21:28','2019-04-11 09:21:28'),(19,5,'First ','First ',1,3,'2019-04-11 09:21:34','2019-04-11 09:21:34'),(20,4,'test','test',-1,3,'2019-04-11 09:22:05','2019-05-01 15:08:59'),(21,4,'test','test',-1,3,'2019-04-11 09:22:25','2019-05-01 15:08:59'),(22,4,'test','test',-1,3,'2019-04-11 09:23:34','2019-05-01 15:08:59'),(23,4,'test','test',-1,3,'2019-04-11 09:23:43','2019-05-01 15:08:59'),(24,4,'test','test',-1,3,'2019-04-11 09:23:49','2019-05-01 15:08:59'),(25,4,'test','test',-1,3,'2019-04-11 09:23:59','2019-05-01 15:08:59'),(26,4,'test','test',-1,3,'2019-04-11 09:26:36','2019-05-01 15:08:59'),(27,4,'test','test',-1,3,'2019-04-11 09:26:49','2019-05-01 15:08:59'),(28,4,'test','test',-1,3,'2019-04-11 09:29:14','2019-05-01 15:08:59'),(29,4,'test','test',-1,3,'2019-04-11 09:29:27','2019-05-01 15:08:59'),(30,2,'wow','my description',-1,3,'2019-04-17 13:10:59','2019-04-30 05:46:36'),(31,2,'wow','my description',-1,3,'2019-04-17 13:11:19','2019-04-30 05:46:36'),(32,2,'Champion','Champion',-1,3,'2019-04-22 08:24:53','2019-04-30 05:46:36'),(33,2,'Champion','Champion',-1,3,'2019-04-30 05:46:49','2019-05-01 15:06:26'),(34,2,'Champion','champion',1,3,'2019-05-01 15:07:05','2019-05-01 15:07:05'),(35,2,'test','test',1,3,'2019-05-01 15:07:22','2019-05-01 15:07:37');
/*!40000 ALTER TABLE `event_awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_name` varchar(50) NOT NULL,
  `instructor_age` varchar(50) DEFAULT NULL,
  `instructor_phone` varchar(50) DEFAULT NULL,
  `instructor_field` varchar(255) DEFAULT NULL,
  `instructor_email` varchar(255) DEFAULT NULL,
  `instructor_pic` varchar(255) DEFAULT 'profile.png',
  `instructor_status` smallint(6) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`instructor_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
INSERT INTO `instructors` (`instructor_id`, `instructor_name`, `instructor_age`, `instructor_phone`, `instructor_field`, `instructor_email`, `instructor_pic`, `instructor_status`, `created_by`, `created_at`, `updated_at`) VALUES (1,'Thomas Edison','35','+98754213252','Badminton, Tennis','thomas@kdmv.com','profile.png',-1,3,'2019-02-25 22:06:37','2019-04-30 05:57:32'),(2,'Garry Pitchell','28','+9865421545','Cycling, Baseball, Long Jump','instrctor2@kdmv.com','ins_instructor_j.jpg',-1,3,'2019-02-25 23:32:10','2019-04-30 05:57:40'),(3,'Brohemian Rhapsody','54','+9865421658','American Football, Baseball','instrctor3@kdmv.com','ins_ii.jpg',-1,3,'2019-02-26 00:13:58','2019-04-30 05:57:40'),(4,'Dav Whatmore','59','+9465488588','Cricket','instrctor4@kdmv.com','4_whatmore.jpg',1,3,'2019-02-26 00:21:16','2019-03-11 12:16:45'),(5,'Keira Knightley','32','68532455666','Sword','keira@kdmv.com','ins_images.jpg',-1,3,'2019-03-11 12:21:28','2019-04-11 05:29:27'),(6,'Tilaka Jinadasa','42','+9458621325','Netball','tilaka@kdmv.com','ins_Tilaka.PNG',1,3,'2019-03-13 10:06:32','2019-03-13 10:06:32'),(7,'Marion Jones','30','+9465488548','Track and Field','instrctor8@kdmv.com','ins_manion.PNG',1,3,'2019-03-17 22:32:14','2019-03-17 22:32:14'),(8,'Sumith Jayalal','38','+9865421789','Volleyball ','instrctor6@kdmv.com','ins_sumith.PNG',1,3,'2019-03-17 22:40:19','2019-03-17 22:40:19'),(9,'Susila Dias','23','1234567912','Netball','susila@mailinator.com','profile.png',1,3,'2019-04-30 14:28:15','2019-04-30 14:28:15'),(10,'test','test','','test','et','profile.png',1,3,'2019-05-01 14:59:43','2019-05-01 14:59:43'),(11,'Susila Dias','12','1234567912','Vollleyball','Susila@mailinator.com','profile.png',1,3,'2019-05-02 05:18:42','2019-05-02 05:18:42'),(12,'TEST','34','','TS','TS@mailinator.com','profile.png',1,3,'2019-05-02 05:20:55','2019-05-02 05:20:55');
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors_to_events_map`
--

DROP TABLE IF EXISTS `instructors_to_events_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructors_to_events_map` (
  `instructorevents_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `map_status` tinyint(4) NOT NULL DEFAULT '1',
  `mapped_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `map_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`instructorevents_map_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors_to_events_map`
--

LOCK TABLES `instructors_to_events_map` WRITE;
/*!40000 ALTER TABLE `instructors_to_events_map` DISABLE KEYS */;
INSERT INTO `instructors_to_events_map` (`instructorevents_map_id`, `instructor_id`, `event_id`, `map_status`, `mapped_time`, `map_updated_at`, `created_by`) VALUES (6,1,1,0,'2019-03-26 16:45:03','2019-04-22 08:52:09',3),(7,2,2,0,'2019-03-26 16:45:19','2019-04-30 05:46:06',3),(8,3,1,0,'2019-03-26 16:45:30','2019-05-02 05:44:47',3),(9,6,1,0,'2019-03-26 16:46:19','2019-05-02 05:44:48',3),(10,8,1,0,'2019-03-26 16:46:28','2019-05-02 05:44:49',3),(11,2,1,1,'2019-03-27 22:44:51','2019-04-22 08:51:44',3),(12,7,1,1,'2019-03-27 22:45:25','2019-03-27 22:45:25',3),(13,5,1,1,'2019-03-27 22:45:26','2019-04-22 08:51:44',3),(14,1,2,1,'2019-04-11 06:03:16','2019-05-01 04:03:10',3),(15,1,4,1,'2019-04-11 09:29:21','2019-04-11 09:29:21',3),(16,2,4,1,'2019-04-11 09:29:22','2019-04-11 09:29:22',3),(17,2,4,1,'2019-04-11 09:29:22','2019-04-11 09:29:22',3),(18,2,4,1,'2019-04-11 09:29:22','2019-04-11 09:29:22',3),(19,3,2,1,'2019-04-22 08:29:00','2019-04-30 05:46:00',3),(20,4,2,1,'2019-04-22 08:29:01','2019-04-30 05:46:00',3),(21,5,2,1,'2019-04-22 08:29:02','2019-04-30 05:46:00',3),(22,4,1,1,'2019-04-22 08:52:26','2019-04-22 08:52:26',3),(23,6,2,1,'2019-04-30 05:28:30','2019-04-30 05:46:00',3),(24,7,2,1,'2019-04-30 05:28:30','2019-04-30 05:46:00',3),(25,8,2,1,'2019-04-30 05:28:30','2019-04-30 05:46:00',3);
/*!40000 ALTER TABLE `instructors_to_events_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_records`
--

DROP TABLE IF EXISTS `login_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_records` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `record_user` int(11) NOT NULL,
  `record_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`record_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_records`
--

LOCK TABLES `login_records` WRITE;
/*!40000 ALTER TABLE `login_records` DISABLE KEYS */;
INSERT INTO `login_records` (`record_id`, `record_user`, `record_date_time`) VALUES (1,2,'2019-02-20 17:28:21'),(2,2,'2019-02-20 17:28:47'),(3,2,'2019-02-20 17:29:39'),(4,2,'2019-02-20 18:18:12'),(5,1,'2019-02-20 18:46:47'),(6,1,'2019-02-20 18:53:06'),(7,1,'2019-02-20 18:53:54'),(8,2,'2019-02-20 19:20:36'),(9,2,'2019-02-20 19:21:56'),(10,1,'2019-02-20 19:22:29'),(11,1,'2019-02-20 19:23:35'),(12,1,'2019-02-20 19:24:00'),(13,2,'2019-02-20 19:25:36'),(14,2,'2019-02-20 19:26:16'),(15,1,'2019-02-20 19:27:08'),(16,1,'2019-02-20 19:27:10'),(17,1,'2019-02-20 19:27:12'),(18,1,'2019-02-20 19:27:36'),(19,1,'2019-02-20 19:27:40'),(20,2,'2019-02-20 19:27:44'),(21,2,'2019-02-20 19:28:20'),(22,2,'2019-02-20 19:29:01'),(23,2,'2019-02-20 19:29:42'),(24,1,'2019-02-20 19:30:05'),(25,2,'2019-02-20 19:30:19'),(26,2,'2019-02-20 19:35:25'),(27,2,'2019-02-20 19:36:40'),(28,2,'2019-02-20 19:37:48'),(29,2,'2019-02-20 19:39:47'),(30,2,'2019-02-20 19:41:00'),(31,2,'2019-02-20 19:41:26'),(32,2,'2019-02-20 19:42:44'),(33,1,'2019-02-21 12:35:35'),(34,1,'2019-02-21 12:36:53'),(35,2,'2019-02-21 12:37:02'),(36,2,'2019-02-21 12:38:44'),(37,3,'2019-02-21 12:39:00'),(38,3,'2019-02-21 15:18:03'),(39,2,'2019-02-21 23:28:13'),(40,1,'2019-02-21 23:28:21'),(41,3,'2019-02-21 23:28:27'),(42,3,'2019-02-22 12:14:19'),(43,3,'2019-02-22 12:33:14'),(44,1,'2019-02-22 14:02:12'),(45,1,'2019-02-22 14:02:16'),(46,3,'2019-02-22 14:02:20'),(47,3,'2019-02-24 11:06:53'),(48,3,'2019-02-25 12:45:39'),(49,3,'2019-02-25 19:47:24'),(50,3,'2019-03-11 10:27:47'),(51,3,'2019-03-11 13:38:03'),(52,3,'2019-03-11 14:14:05'),(53,3,'2019-03-11 17:49:23'),(54,3,'2019-03-11 19:02:41'),(55,3,'2019-03-12 08:31:31'),(56,3,'2019-03-12 08:56:27'),(57,3,'2019-03-13 09:56:14'),(58,3,'2019-03-13 13:00:02'),(59,3,'2019-03-14 09:45:11'),(60,3,'2019-03-14 18:05:59'),(61,3,'2019-03-17 21:16:20'),(62,3,'2019-03-17 22:46:50'),(63,3,'2019-03-18 08:37:36'),(64,3,'2019-03-18 09:37:32'),(65,3,'2019-03-18 18:47:03'),(66,3,'2019-03-21 00:03:14'),(67,3,'2019-03-21 15:44:30'),(68,3,'2019-03-22 09:37:22'),(69,3,'2019-03-22 10:14:31'),(70,3,'2019-03-22 17:50:58'),(71,3,'2019-03-25 22:48:16'),(72,3,'2019-03-27 22:03:19'),(73,3,'2019-03-29 05:58:27'),(74,3,'2019-03-29 18:37:11'),(75,3,'2019-04-02 17:53:18'),(76,3,'2019-04-03 10:33:22'),(77,3,'2019-04-03 14:16:52'),(78,3,'2019-04-03 14:26:09'),(79,3,'2019-04-05 22:06:06'),(80,3,'2019-04-08 22:30:20'),(81,3,'2019-04-09 22:38:08'),(82,3,'2019-04-10 08:18:20'),(83,3,'2019-04-10 11:13:36'),(84,3,'2019-04-10 11:15:01'),(85,3,'2019-04-10 11:15:40'),(86,3,'2019-04-10 09:04:20'),(87,3,'2019-04-10 09:12:30'),(88,3,'2019-04-10 12:03:00'),(89,3,'2019-04-10 12:03:00'),(90,3,'2019-04-11 05:04:01'),(91,3,'2019-04-11 05:08:22'),(92,3,'2019-04-11 05:12:44'),(93,3,'2019-04-11 06:04:26'),(94,3,'2019-04-11 06:14:23'),(95,3,'2019-04-11 09:11:48'),(96,3,'2019-04-11 09:13:21'),(97,3,'2019-04-17 12:55:50'),(98,3,'2019-04-17 13:55:38'),(99,3,'2019-04-18 11:29:06'),(100,3,'2019-04-22 08:14:18'),(101,3,'2019-04-22 08:16:06'),(102,3,'2019-04-22 08:42:21'),(103,3,'2019-04-22 09:06:24'),(104,3,'2019-04-22 09:08:21'),(105,3,'2019-04-22 09:10:20'),(106,3,'2019-04-22 09:12:30'),(107,3,'2019-04-22 09:14:25'),(108,3,'2019-04-22 09:14:36'),(109,3,'2019-04-22 09:18:13'),(110,3,'2019-04-23 16:20:59'),(111,3,'2019-04-23 18:41:38'),(112,3,'2019-04-23 19:21:25'),(113,3,'2019-04-24 09:40:59'),(114,3,'2019-04-30 05:26:13'),(115,3,'2019-04-30 05:39:01'),(116,3,'2019-04-30 05:54:46'),(117,3,'2019-04-30 05:56:08'),(118,3,'2019-04-30 05:59:48'),(119,35,'2019-04-30 11:52:05'),(120,3,'2019-04-30 11:54:16'),(121,3,'2019-04-30 11:56:53'),(122,2,'2019-04-30 12:03:00'),(123,46,'2019-04-30 12:08:46'),(124,46,'2019-04-30 12:18:29'),(125,3,'2019-04-30 12:18:47'),(126,3,'2019-04-30 13:55:01'),(127,3,'2019-04-30 14:22:08'),(128,3,'2019-04-30 14:25:56'),(129,46,'2019-04-30 14:29:53'),(130,35,'2019-04-30 14:30:41'),(131,35,'2019-04-30 14:43:18'),(132,3,'2019-04-30 17:44:47'),(133,3,'2019-05-01 03:53:52'),(134,3,'2019-05-01 04:00:23'),(135,9,'2019-05-01 14:31:30'),(136,9,'2019-05-01 14:49:35'),(137,3,'2019-05-01 14:51:09'),(138,46,'2019-05-01 14:51:47'),(139,3,'2019-05-01 14:55:30'),(140,3,'2019-05-01 14:56:09'),(141,3,'2019-05-01 15:14:54'),(142,3,'2019-05-01 16:53:50'),(143,3,'2019-05-01 18:48:36'),(144,46,'2019-05-01 18:50:36'),(145,9,'2019-05-01 18:51:55'),(146,3,'2019-05-01 18:53:00'),(147,46,'2019-05-02 05:16:40'),(148,9,'2019-05-02 05:17:25'),(149,3,'2019-05-02 05:17:54'),(150,9,'2019-05-02 05:23:33'),(151,3,'2019-05-02 05:23:59'),(152,3,'2019-05-02 05:28:42'),(153,3,'2019-05-02 09:23:06');
/*!40000 ALTER TABLE `login_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practice_sessions`
--

DROP TABLE IF EXISTS `practice_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `practice_sessions` (
  `practice_id` int(11) NOT NULL AUTO_INCREMENT,
  `practice_title` varchar(200) DEFAULT NULL,
  `practice_description` mediumtext,
  `practice_location` varchar(255) DEFAULT NULL,
  `practice_date` date DEFAULT NULL,
  `practice_start_time` datetime DEFAULT NULL,
  `practice_end_time` datetime DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `practice_status` tinyint(4) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`practice_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practice_sessions`
--

LOCK TABLES `practice_sessions` WRITE;
/*!40000 ALTER TABLE `practice_sessions` DISABLE KEYS */;
INSERT INTO `practice_sessions` (`practice_id`, `practice_title`, `practice_description`, `practice_location`, `practice_date`, `practice_start_time`, `practice_end_time`, `sport_id`, `instructor_id`, `practice_status`, `created_by`, `created_at`, `updated_at`) VALUES (1,'Last Session','last session before 2019 tournament','School Playground','2019-03-05','2019-03-05 14:30:00','2019-03-05 17:30:00',1,4,-1,3,'2019-03-14 11:06:20','2019-04-11 05:35:10'),(2,'Big Match practice Session 1','Team practices before the big match season','School Play ground','2019-04-30','2019-04-30 00:00:00','2019-04-30 02:00:00',4,4,1,3,'2019-03-14 20:30:54','2019-05-02 05:25:28'),(4,'Sport meet Practices','Sportmeet practices','Court 2','2019-02-01','2019-02-01 09:00:00','2019-02-01 17:00:00',4,6,1,3,'2019-03-14 22:08:30','2019-03-14 23:29:19'),(5,'Inter House Practices','all students who gave names should attend','Court 01','2019-03-14','0000-00-00 00:00:00','0000-00-00 00:00:00',2,1,1,3,'2019-03-14 22:21:31','2019-03-17 21:27:25'),(6,'Provincial Tournament Pracitices','Practice sessions targeting provincial trophy ','Gym Court','2019-03-20','2019-03-20 14:00:00','2019-03-20 17:00:00',6,8,-1,3,'2019-03-17 22:43:56','2019-05-01 19:00:52'),(7,'John Tarbet athletic meet','john tarbet athletic meet 2019 ','School Play Ground','2019-04-25','0000-00-00 00:00:00','0000-00-00 00:00:00',9,7,1,3,'2019-03-17 22:46:16','2019-04-30 06:01:18'),(8,'Tests','ss','dfs','2019-04-10','2019-04-10 14:00:00','2019-04-10 17:00:00',6,8,-1,3,'2019-04-09 08:21:23','2019-04-09 08:27:23'),(9,'sds','sfsf','fsfsfs','2019-04-11','2019-04-11 14:00:00','2019-04-11 17:00:00',6,6,-1,3,'2019-04-09 08:27:43','2019-04-09 08:43:04'),(10,'School Tournament Practice','Team selection Practices','School Grund','2019-04-25','2008-00-00 00:00:00','0000-00-00 00:00:00',0,0,1,3,'2019-04-09 08:44:45','2019-05-01 15:42:38'),(11,'ffsfs','sfsf','sfsf','2019-04-01','2019-04-01 14:00:00','2019-04-01 17:00:00',5,7,-1,3,'2019-04-09 08:47:39','2019-04-09 08:48:29'),(12,'test','','test','2019-04-17','2019-04-17 14:00:00','2019-04-17 17:00:00',4,2,-1,3,'2019-04-10 12:04:11','2019-04-11 05:35:10'),(13,'Badmintion','Weekly','Play Ground','2019-04-18','0000-00-00 00:00:00','2017-00-00 00:00:00',5,0,1,3,'2019-04-11 05:28:36','2019-05-01 15:45:54'),(14,'Carrom','Carorm under 15','Main Hall','2019-04-18','2019-04-18 14:00:00','2019-04-18 17:00:00',7,3,-1,3,'2019-04-11 05:33:02','2019-04-11 05:35:00'),(15,'Carrom','','Main Hall','2019-04-18','2019-04-18 09:00:00','2019-04-18 12:00:00',5,6,1,3,'2019-04-11 05:38:19','2019-05-01 19:05:38'),(16,'Cricket','','Playground','2019-04-09','2019-04-09 14:00:00','2019-04-09 17:00:00',5,4,1,3,'2019-04-22 08:20:00','2019-04-22 08:20:00'),(17,'test','test','test','2019-05-08','2019-05-08 14:00:00','2019-05-08 17:00:00',1,4,-1,3,'2019-05-01 15:37:46','2019-05-01 15:38:05'),(18,'test','test','test','2019-05-14','0000-00-00 00:00:00','0000-00-00 00:00:00',4,8,-1,3,'2019-05-01 15:43:07','2019-05-01 18:57:22'),(19,'test2','test2','test2','2019-06-22','0000-00-00 00:00:00','0000-00-00 00:00:00',1,4,-1,3,'2019-05-01 15:44:26','2019-05-01 15:46:42'),(20,'Something','ddd','Ground','2019-05-02','2019-05-02 14:00:00','2019-05-02 19:00:00',6,8,1,3,'2019-05-01 16:55:37','2019-05-02 05:25:20');
/*!40000 ALTER TABLE `practice_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sports` (
  `sport_id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_name` varchar(200) DEFAULT NULL,
  `sport_description` mediumtext,
  `sport_category` varchar(100) DEFAULT NULL,
  `age_category` varchar(255) DEFAULT NULL,
  `sport_year` varchar(100) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `sport_picture` varchar(255) DEFAULT 'sports.png',
  `sports_status` tinyint(4) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sport_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports`
--

LOCK TABLES `sports` WRITE;
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` (`sport_id`, `sport_name`, `sport_description`, `sport_category`, `age_category`, `sport_year`, `instructor_id`, `sport_picture`, `sports_status`, `created_by`, `created_at`, `updated_at`) VALUES (1,'Cricket U17 Team A','A team of the school cricket team','Cricket','Under 17','2014',4,'cricket_u15.jpg',1,3,'2019-03-11 12:58:25','2019-05-01 15:47:31'),(2,'Badminton U13 Girls','Under 13girls Badminton','Badminton','Under 13','2019/2018',1,'badminton13.jpg',-1,3,'2019-03-11 12:59:38','2019-04-23 19:21:42'),(4,'Under 19 Netball Girls','School Under 17 Netball team','Netball - Girls','Under 17','2010',6,'sports_netball.jpg',1,3,'2019-03-11 14:19:40','2019-05-01 15:05:35'),(5,'Sprint 100m, 200m, 400m','Athletics for runners','Athletics','Under 17','2018/2019',7,'sports_100m.PNG',1,3,'2019-03-17 22:25:07','2019-03-17 22:32:43'),(6,'Volleyball Under 15 Boys','Under 15 boys team','Volleyball','Under 15','2018/2019',0,'sports_vollyball.PNG',1,3,'2019-03-17 22:36:20','2019-03-17 22:41:16'),(7,'Carrom','Carrom under 15','Carrom - All','Under 15','2019/2020asdf',2,'sports.png',-1,3,'2019-04-11 05:30:16','2019-04-11 05:57:30'),(8,'Under 19 Cricket','Under 19 Cricket','Cricket - Boys','Under 19 ','2012',4,'sports.png',-1,3,'2019-04-22 08:30:52','2019-04-22 08:42:46'),(9,'Under 19 Volleyball','Volleyabll','Girls','under 19','2019',6,'sports.png',1,3,'2019-04-30 06:00:30','2019-04-30 06:00:30'),(10,'test','test','test','dd','2019',0,'sports.png',-1,3,'2019-05-01 15:01:52','2019-05-01 15:05:45'),(11,'Under 15 Baseball','Under 15 Baseball','Baseball','15','2017',10,'sports.png',1,3,'2019-05-02 05:21:51','2019-05-02 05:21:51');
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports_events`
--

DROP TABLE IF EXISTS `sports_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sports_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(200) DEFAULT NULL,
  `event_description` mediumtext,
  `event_location` varchar(255) DEFAULT NULL,
  `event_start_datetime` datetime DEFAULT NULL,
  `event_end_datetime` datetime DEFAULT NULL,
  `event_status` tinyint(4) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports_events`
--

LOCK TABLES `sports_events` WRITE;
/*!40000 ALTER TABLE `sports_events` DISABLE KEYS */;
INSERT INTO `sports_events` (`event_id`, `event_title`, `event_description`, `event_location`, `event_start_datetime`, `event_end_datetime`, `event_status`, `created_by`, `created_at`, `updated_at`) VALUES (1,'Inter Provincial School Sportsmeet 2019','Anual Inter Provincial Sportmeet. We represent Western Province.','Sugathadasa Stadium, Colombo 02','2019-04-01 08:00:00','2019-05-12 18:00:00',1,3,'2019-03-18 09:50:34','2019-05-01 15:46:55'),(2,'Sir John Tarbet Junior School Athletic Championship 2019','Annual Athletic Sportmeet for all Island','Sugathadasa Stadium, Colombo','2019-05-20 09:00:00','2020-05-31 17:00:00',-1,3,'2019-03-18 12:59:33','2019-05-01 15:36:06'),(3,'Inter House Sports Meet 2019','2019 School sports meet will be conducted from 1 Feb to 15th Feb.','School Ground','2019-02-01 09:00:00','2019-02-15 17:00:00',1,3,'2019-03-22 17:53:25','2019-03-22 17:53:25'),(4,'Test','','CR & FC','2019-04-10 12:04:00','2019-04-10 12:04:00',1,3,'2019-04-10 12:05:04','2019-04-10 12:05:04'),(5,'Carrom Milo Tournement','Under 15 Carrom','CR & FC','2019-04-18 05:35:00','2019-04-11 05:35:00',1,3,'2019-04-11 05:36:00','2019-04-11 05:36:00');
/*!40000 ALTER TABLE `sports_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports_to_events_map`
--

DROP TABLE IF EXISTS `sports_to_events_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sports_to_events_map` (
  `sportsevents_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `sports_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `map_status` tinyint(4) NOT NULL DEFAULT '1',
  `mapped_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `map_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`sportsevents_map_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports_to_events_map`
--

LOCK TABLES `sports_to_events_map` WRITE;
/*!40000 ALTER TABLE `sports_to_events_map` DISABLE KEYS */;
INSERT INTO `sports_to_events_map` (`sportsevents_map_id`, `sports_id`, `event_id`, `map_status`, `mapped_time`, `map_updated_at`, `created_by`) VALUES (1,5,1,1,'2019-03-18 09:51:28','2019-03-18 09:51:28',3),(2,4,1,1,'2019-03-18 09:51:38','2019-04-22 08:52:39',3),(3,1,1,1,'2019-03-18 09:51:46','2019-04-22 08:52:39',3),(4,6,1,1,'2019-03-18 09:51:54','2019-04-22 08:52:39',3),(5,5,2,0,'2019-03-18 13:00:14','2019-04-30 05:46:25',3),(6,1,4,0,'2019-04-11 09:26:46','2019-04-11 09:26:56',3),(7,1,4,0,'2019-04-11 09:26:46','2019-04-11 09:26:56',3),(8,2,4,1,'2019-04-11 09:26:47','2019-04-11 09:26:47',3),(9,1,2,1,'2019-04-11 09:34:23','2019-05-01 04:03:30',3),(10,2,2,1,'2019-04-22 08:28:45','2019-04-22 08:58:46',3),(11,4,2,1,'2019-04-22 08:28:46','2019-04-30 05:46:20',3),(12,6,2,1,'2019-04-22 08:28:48','2019-04-30 05:46:20',3),(13,7,2,1,'2019-04-22 08:28:49','2019-04-22 08:28:49',3),(14,8,1,1,'2019-04-22 08:32:42','2019-04-22 08:32:42',3),(15,2,1,1,'2019-04-22 08:52:52','2019-04-22 08:52:52',3),(16,8,2,1,'2019-04-30 05:28:54','2019-04-30 05:28:54',3),(17,7,1,1,'2019-05-02 05:44:56','2019-05-02 05:44:56',3),(18,9,1,1,'2019-05-02 05:45:09','2019-05-02 05:45:09',3);
/*!40000 ALTER TABLE `sports_to_events_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_achievements`
--

DROP TABLE IF EXISTS `student_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_achievements` (
  `achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `achievement_title` varchar(200) DEFAULT NULL,
  `achievement_description` mediumtext,
  `achievement_date` date DEFAULT NULL,
  `achievement_status` tinyint(4) DEFAULT '1',
  `achievement_type` tinyint(4) DEFAULT NULL,
  `award_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`achievement_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_achievements`
--

LOCK TABLES `student_achievements` WRITE;
/*!40000 ALTER TABLE `student_achievements` DISABLE KEYS */;
INSERT INTO `student_achievements` (`achievement_id`, `student_id`, `achievement_title`, `achievement_description`, `achievement_date`, `achievement_status`, `achievement_type`, `award_id`, `created_by`, `created_at`, `updated_at`) VALUES (1,19,'Fastest school boy of the year','He won this for the consecutive 3 times','2019-04-01',1,2,0,3,'2019-04-02 19:16:43','2019-04-03 16:01:19'),(2,2,'fdfsf','sfsdf','2019-03-12',-1,2,NULL,3,'2019-04-02 19:17:52','2019-04-11 05:57:52'),(3,10,'Something Award','He has won this for the third time','2019-06-01',1,1,0,3,'2019-04-03 11:14:28','2019-05-02 05:19:01'),(4,5,'Best bowler u 13','The best bowler of under 13  year group for the 2018','2018-12-28',1,2,NULL,3,'2019-04-03 11:20:35','2019-04-03 11:53:19'),(5,15,'Highest scorer 2018','2018 highest score gainer from the inter-school Netball matches','2019-01-07',1,2,0,3,'2019-04-03 16:04:20','2019-04-03 16:05:20'),(6,8,'Badminton Star of 2018','Highest badminton scorer of the year within inter-school games','2019-01-14',1,2,2,3,'2019-04-03 23:29:12','2019-04-11 06:01:10'),(7,1,'Carrom Champion','Carrom Champion','2019-04-25',1,2,NULL,3,'2019-04-11 05:58:40','2019-04-11 05:58:40');
/*!40000 ALTER TABLE `student_achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `student_grade` varchar(50) DEFAULT NULL,
  `student_phone` varchar(50) DEFAULT NULL,
  `student_address` varchar(255) DEFAULT NULL,
  `guardian_email` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`student_id`, `user_id`, `student_grade`, `student_phone`, `student_address`, `guardian_email`, `created_by`, `created_at`, `updated_at`) VALUES (1,2,'8 -B','8965212145','89 Chiaroscuro Rd, Portland, USA','someone@somewhere.com',3,'2019-02-21 14:47:29','2019-04-09 08:40:04'),(2,4,'8 -C','85452154','25, rue Lauriston, Paris, France','normal_parents@somewhere.com',3,'2019-02-21 15:15:18','2019-04-09 08:40:50'),(3,5,'10 - C','+445865254','Via Monte Bianco 34, Turin, Italy',NULL,3,'2019-02-21 15:18:16','2019-02-25 20:08:47'),(4,8,'6 - B','+4458652135','London Junction, London',NULL,3,'2019-02-22 14:35:23','2019-02-22 14:35:23'),(5,9,'8 -C','+445865254','21,B , Play ground road, Wattala',NULL,3,'2019-02-25 19:41:41','2019-02-25 19:41:41'),(6,10,'8 -A','+44586521587','Somewhere on the ground, Earth',NULL,3,'2019-02-25 19:42:40','2019-02-25 19:42:40'),(7,11,'6 - B','+445865254','Good address, address',NULL,3,'2019-02-25 19:43:13','2019-02-25 19:43:13'),(8,12,'7 -A','+44586521354','8B, Morris road, Italy',NULL,3,'2019-02-25 19:44:51','2019-02-25 19:44:51'),(9,13,'7 -D','+44586525433','25, rue Lauriston, Paris, France',NULL,3,'2019-02-25 19:45:26','2019-02-25 19:45:26'),(10,14,'10 - A','(257) 563-7401','711-2880 Nulla St.\r\nMankato Mississippi 96522',NULL,3,'2019-03-12 13:20:13','2019-03-18 09:09:19'),(11,15,'10 - A','(372) 587-2335','P.O. Box 283 8562 Fusce Rd.\r\nFrederick Nebraska 20620',NULL,3,'2019-03-12 13:20:42','2019-03-12 13:20:42'),(12,16,'10 - B','(786) 713-8616','606-3727 Ullamcorper. Street\r\nRoseville NH 11523',NULL,3,'2019-03-12 13:21:22','2019-03-12 13:21:22'),(13,17,'10 - D','(492) 709-6392','7292 Dictum Av.\r\nSan Antonio MI 47096',NULL,3,'2019-03-12 13:21:52','2019-03-12 13:21:52'),(14,18,'10 - B','(404) 960-3807','191-103 Integer Rd.\r\nCorona New Mexico 08219',NULL,3,'2019-03-12 13:22:35','2019-03-12 13:22:35'),(15,19,'11 - A','+9458754112','P.O. Box 147 2546 Sociosqu Rd.\r\nBethlehem Utah 02913',NULL,3,'2019-03-12 13:44:39','2019-03-12 13:44:39'),(16,20,'11 - A','+9458562458','5543 Aliquet St.\r\nFort Dodge GA 20783',NULL,3,'2019-03-12 13:45:17','2019-03-12 13:45:17'),(18,22,'11 - A','+44586521354','3476 Aliquet. Ave, Minot AZ 95302',NULL,3,'2019-03-12 13:46:09','2019-03-12 13:46:09'),(19,23,'10 - B','+94586525435','Western province, Sri Lanka',NULL,3,'2019-03-17 22:50:54','2019-03-17 22:50:54'),(20,24,'7-A','+94712968350','Baudhaloka Mawatha, Colombo 4','parents@studenthouse.com',3,'2019-04-09 08:42:26','2019-04-09 08:42:26'),(21,28,'10-B','0778123445','2/131, Park Street, US','',3,'2019-04-11 05:14:02','2019-04-11 05:14:02'),(22,29,'10-B','01121312345','123/3, San Fransicsco, US','test1@mailinantor.com',3,'2019-04-11 05:15:52','2019-04-11 05:15:52'),(23,29,'10-B','01121312345','123/3, San Fransicsco, US','test1@mailinantor.com',3,'2019-04-11 05:16:09','2019-04-11 05:16:09'),(24,29,'10-B','01121312345','123/3, San Fransicsco, US','test1@mailinantor.com',3,'2019-04-11 05:16:38','2019-04-11 05:16:38'),(25,32,'12-B','1234567891','1/123, Park Street,US','test@mailinator.com',3,'2019-04-11 05:19:13','2019-04-11 05:19:13'),(26,33,'10-D','123456789','2/133, Chicago, US','test1@mailinator.com',3,'2019-04-11 09:12:40','2019-04-11 09:12:40'),(27,34,'10-B','1234567893','Test Student','testparent@mailinator.com',3,'2019-04-22 09:05:25','2019-04-22 09:05:25'),(28,34,'10-B','1234567893','Test Student','testparent@mailinator.com',3,'2019-04-22 09:05:25','2019-04-22 09:05:25'),(29,36,'12-B','123455ujg','test','dilen@mailinator.com',3,'2019-04-22 09:07:06','2019-04-22 09:07:06'),(30,37,'12-B','1234567891','Test Student','teststudent@mailinator.com',3,'2019-04-22 09:09:34','2019-04-22 09:09:34'),(31,38,'10-B','123445678','Test 02','dilen@mailinator.com',3,'2019-04-22 09:11:25','2019-04-22 09:11:25'),(32,40,'12-B','123456789','test 02','test2@mailinator.com',3,'2019-04-22 09:17:32','2019-04-22 09:17:32'),(33,41,'Student 1234','1234567890','1/123, Test','test1234@mailinator.com',3,'2019-04-30 05:34:00','2019-04-30 05:34:00'),(34,41,'Student 1234','1234567890','1/123, Test','test1234@mailinator.com',3,'2019-04-30 05:34:42','2019-04-30 05:34:42'),(35,41,'Student 1234','1234567890','1/123, Test','test1234@mailinator.com',3,'2019-04-30 05:35:59','2019-04-30 05:35:59'),(36,44,'Student 12345','1234567891','12345','student12345@mailinator.com',3,'2019-04-30 05:37:28','2019-04-30 05:37:28'),(37,44,'Student 12345','1234567891','Student 12345','student12345@mailinator.com',3,'2019-04-30 14:23:45','2019-04-30 14:23:45'),(38,48,'11-B','1234567890','Test','test@mailinator.com',3,'2019-04-30 14:26:53','2019-04-30 14:26:53'),(39,48,'12-B','1234567891','Test','test@mailinator.com',3,'2019-05-01 03:54:43','2019-05-01 03:54:43'),(40,44,'11-B','1234567891','TEST','test@mailinator.com',3,'2019-05-01 03:55:44','2019-05-01 03:55:44'),(41,51,'12-B','1111111111','TEST1','test1@mailinator.com',3,'2019-05-01 03:56:17','2019-05-01 03:56:17'),(42,44,'12-B','1234567896','TEST','test2@mailinator.com',3,'2019-05-01 03:56:54','2019-05-01 03:56:54'),(43,38,'11-B','1111111111','TEST1','test11@mailinator.com',3,'2019-05-01 03:59:04','2019-05-01 03:59:04'),(44,54,'2-B','3333333333','Test3','test3@mailinator.com',3,'2019-05-01 04:01:31','2019-05-01 04:01:31'),(45,55,'4-B','4444444444','Test4','test4@mailinator.com',3,'2019-05-01 04:02:07','2019-05-01 04:02:07'),(46,56,'1234t','1234567891','2wert','',3,'2019-05-01 14:57:54','2019-05-01 14:57:54'),(47,41,'12-4','','test','',3,'2019-05-01 15:01:02','2019-05-01 15:01:02'),(48,44,'rrest','','test','',3,'2019-05-01 15:21:31','2019-05-01 15:21:31'),(49,59,'5-D','1234123456','TEST','test55@mailinator.com',3,'2019-05-02 05:19:57','2019-05-02 05:19:57'),(50,60,'12-B','66666666','6666','student6@mailinator.com',3,'2019-05-02 05:27:30','2019-05-02 05:27:30');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_to_events_map`
--

DROP TABLE IF EXISTS `students_to_events_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_to_events_map` (
  `studentsevents_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `students_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `request_status` tinyint(4) NOT NULL DEFAULT '1',
  `mapped_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `map_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `requested_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`studentsevents_map_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_to_events_map`
--

LOCK TABLES `students_to_events_map` WRITE;
/*!40000 ALTER TABLE `students_to_events_map` DISABLE KEYS */;
INSERT INTO `students_to_events_map` (`studentsevents_map_id`, `students_id`, `event_id`, `request_status`, `mapped_time`, `map_updated_at`, `requested_by`, `approved_by`) VALUES (1,8,1,2,'2019-03-26 17:19:47','2019-03-27 22:05:05',4,3),(2,16,1,2,'2019-03-26 17:20:06','2019-04-05 23:25:51',5,3),(3,15,1,2,'2019-03-26 17:20:55','2019-03-26 22:53:37',6,3),(4,14,2,2,'2019-03-26 17:22:19','2019-05-01 15:33:15',2,3),(5,7,1,2,'2019-03-26 23:05:18','2019-03-26 23:05:39',7,3),(6,11,1,0,'2019-03-29 11:10:10','2019-05-01 18:53:57',3,NULL),(7,5,2,0,'2019-05-01 14:50:58','2019-05-01 15:34:57',9,NULL),(8,5,1,0,'2019-05-02 05:23:40','2019-05-02 05:44:39',9,NULL);
/*!40000 ALTER TABLE `students_to_events_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_to_sports_map`
--

DROP TABLE IF EXISTS `students_to_sports_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_to_sports_map` (
  `studentstosports_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `sports_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `map_status` tinyint(4) NOT NULL DEFAULT '1',
  `mapped_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `map_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`studentstosports_map_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_to_sports_map`
--

LOCK TABLES `students_to_sports_map` WRITE;
/*!40000 ALTER TABLE `students_to_sports_map` DISABLE KEYS */;
INSERT INTO `students_to_sports_map` (`studentstosports_map_id`, `sports_id`, `student_id`, `map_status`, `mapped_time`, `map_updated_at`, `created_by`) VALUES (1,1,1,-1,'2019-03-12 13:01:53','2019-03-12 13:08:44',NULL),(2,1,3,-1,'2019-03-12 13:08:24','2019-03-12 13:08:44',3),(3,1,5,-1,'2019-03-12 13:08:24','2019-03-12 13:08:44',3),(4,1,6,-1,'2019-03-12 13:08:24','2019-03-12 13:08:44',3),(5,1,1,-1,'2019-03-12 13:32:51','2019-04-11 09:33:26',3),(6,1,3,-1,'2019-03-12 13:32:51','2019-04-22 08:56:49',3),(7,1,4,-1,'2019-03-12 13:32:51','2019-04-22 08:56:49',3),(8,1,5,-1,'2019-03-12 13:32:51','2019-04-09 10:25:27',3),(9,1,6,-1,'2019-03-12 13:32:51','2019-04-09 10:20:06',3),(10,2,2,1,'2019-03-12 13:33:42','2019-03-12 13:33:42',3),(11,2,7,1,'2019-03-12 13:33:43','2019-03-12 13:33:43',3),(12,2,8,1,'2019-03-12 13:33:43','2019-03-12 13:33:43',3),(13,2,9,1,'2019-03-12 13:33:43','2019-03-12 13:33:43',3),(14,4,2,1,'2019-03-12 13:39:17','2019-03-12 13:39:17',3),(15,4,7,1,'2019-03-12 13:39:17','2019-03-12 13:39:17',3),(16,4,8,1,'2019-03-12 13:39:17','2019-03-12 13:39:17',3),(17,4,9,-1,'2019-03-12 13:39:17','2019-03-12 13:48:27',3),(18,4,15,1,'2019-03-12 13:48:44','2019-03-12 13:48:44',3),(19,4,16,1,'2019-03-12 13:48:44','2019-03-12 13:48:44',3),(21,4,18,1,'2019-03-12 13:48:44','2019-03-12 13:48:44',3),(22,5,19,1,'2019-03-17 22:53:10','2019-03-17 22:53:10',3),(23,1,6,-1,'2019-04-09 10:54:59','2019-04-22 08:21:39',3),(24,7,1,-1,'2019-04-11 05:31:20','2019-04-11 05:31:25',3),(25,7,2,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(26,7,3,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(27,7,4,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(28,7,5,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(29,7,6,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(30,7,7,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(31,7,8,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(32,7,9,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(33,7,10,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(34,7,11,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(35,7,12,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(36,7,13,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(37,7,14,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(38,7,15,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(39,7,16,-1,'2019-04-11 05:31:20','2019-04-11 05:31:32',3),(40,1,1,-1,'2019-04-11 09:33:33','2019-04-22 08:56:49',3),(41,1,2,-1,'2019-04-11 09:33:33','2019-04-22 08:56:49',3),(42,1,5,-1,'2019-04-22 08:21:28','2019-04-22 08:56:49',3),(43,1,7,-1,'2019-04-22 08:21:28','2019-04-22 08:56:49',3),(44,1,6,-1,'2019-04-22 08:21:52','2019-04-22 08:56:49',3),(45,1,9,-1,'2019-04-22 08:21:52','2019-04-22 08:56:49',3),(46,8,1,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(47,8,2,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(48,8,3,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(49,8,4,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(50,8,5,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(51,8,6,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(52,8,7,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(53,8,8,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(54,8,9,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(55,8,10,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(56,8,11,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(57,8,12,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(58,8,13,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(59,8,14,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(60,8,15,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(61,8,16,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(62,8,26,1,'2019-04-22 08:31:13','2019-04-22 08:31:13',3),(63,1,8,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(64,1,10,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(65,1,11,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(66,1,12,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(67,1,13,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(68,1,14,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(69,1,15,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(70,1,16,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(71,1,26,-1,'2019-04-22 08:56:33','2019-04-22 08:56:49',3),(72,1,1,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(73,1,2,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(74,1,3,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(75,1,4,-1,'2019-04-22 08:56:56','2019-05-01 15:34:35',3),(76,1,5,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(77,1,6,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(78,1,7,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(79,1,8,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(80,1,9,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(81,1,10,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(82,1,11,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(83,1,12,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(84,1,13,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(85,1,14,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(86,1,15,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(87,1,16,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(88,1,26,1,'2019-04-22 08:56:56','2019-04-22 08:56:56',3),(89,1,28,1,'2019-04-23 16:22:40','2019-04-23 16:22:40',3),(90,1,29,1,'2019-04-23 16:22:40','2019-04-23 16:22:40',3),(91,1,27,1,'2019-04-30 05:27:08','2019-04-30 05:27:08',3),(92,9,3,-1,'2019-04-30 06:01:31','2019-04-30 06:01:40',3),(93,9,4,-1,'2019-04-30 06:01:32','2019-04-30 06:01:40',3),(94,9,5,-1,'2019-04-30 06:01:32','2019-04-30 06:01:45',3),(95,9,6,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(96,9,7,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(97,9,8,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(98,9,9,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(99,9,10,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(100,9,11,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(101,9,12,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(102,9,13,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(103,9,14,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(104,9,15,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(105,9,16,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(106,9,26,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(107,9,27,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(108,9,28,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(109,9,29,1,'2019-04-30 06:01:32','2019-04-30 06:01:32',3),(110,5,3,-1,'2019-04-30 06:02:16','2019-04-30 06:02:22',3),(111,5,4,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(112,5,5,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(113,5,6,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(114,5,7,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(115,5,8,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(116,5,9,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(117,5,10,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(118,5,11,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(119,5,12,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(120,5,13,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(121,5,14,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(122,5,15,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(123,5,16,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(124,5,26,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(125,5,27,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(126,5,28,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(127,5,29,1,'2019-04-30 06:02:16','2019-04-30 06:02:16',3),(128,6,13,-1,'2019-04-30 12:19:37','2019-04-30 13:55:26',3),(129,6,13,1,'2019-04-30 17:59:38','2019-04-30 17:59:38',3),(130,1,45,1,'2019-05-01 15:32:40','2019-05-01 15:32:40',3);
/*!40000 ALTER TABLE `students_to_sports_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_info` (
  `sysinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_version` varchar(255) DEFAULT NULL,
  `info_description` text,
  `info_client` varchar(255) DEFAULT NULL,
  `info_releasedate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sysinfo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_info`
--

LOCK TABLES `system_info` WRITE;
/*!40000 ALTER TABLE `system_info` DISABLE KEYS */;
INSERT INTO `system_info` (`sysinfo_id`, `info_version`, `info_description`, `info_client`, `info_releasedate`) VALUES (1,'1.0.0','Beeta release','Dharmapala College Kottawa','2019-02-20 18:18:44');
/*!40000 ALTER TABLE `system_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(60) NOT NULL,
  PRIMARY KEY (`level_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level`
--

LOCK TABLES `user_level` WRITE;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`level_id`, `level`) VALUES (1,'Visitor'),(2,'Student'),(3,'Administrator');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(70) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_number` varchar(255) DEFAULT NULL,
  `full_name` varchar(30) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `user_level` int(10) NOT NULL DEFAULT '1',
  `profile_pic` varchar(255) DEFAULT 'profile.png',
  `joined_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `password`, `user_number`, `full_name`, `status`, `user_level`, `profile_pic`, `joined_date`) VALUES (1,'ij@kdmv.com','a3562e42b4ed3c3d236abb77bd377f33f7a44a1c$418d5ff92aba0ab47f1df93c389350b873c6445b','null','Irantha Jayasekara',1,1,'profile.png','2019-02-20 17:16:44'),(2,'std11@kdmv.com','d4c3ac3c648ef07b888b1e53c5ad2ab11be1d880$385de27c6dd8dfd871200132a7961ac2248dce2c','12345678d91','Jason Stain',-1,2,'c.jpg','2019-02-20 17:25:50'),(3,'jay@kdmv.com','2b27b0d1c24db735146b64c0895f5c6201ec5e8a$562dfd381eb0b9a3d3c6a8a03b91f89788b2da94','null','Executive Jay',1,3,'profile.png','2019-02-21 12:37:52'),(4,'std2@kdmv.com','9cf53080831e0e4c1bcfe05c5b1f53383f83f09f$9ffda27075709ea58a7721b8f2e3f4d6d8983164','std009922','Normal Student',-1,2,'ccccc (2).jpg','2019-02-21 15:17:01'),(5,'std3@kdmv.com','13ede5a4058bc7c880adde01c13703ea19c9855f$15dd7cb0c7a4bb4d25eb7e958561f0fd8e47ef82','std0100','Third Student',-1,2,'cc.jpg','2019-02-21 15:17:34'),(6,'std4@kdmv.com','9b9af83d4934b876c51413c551fa70e7ba1b1cf4$b0f004c42dfdc4d411ed5a638e9d9fd79450714f','std0101','Student Fourth',1,2,'profile.png','2019-02-22 12:33:07'),(8,'albert@kdmv.com','854f392f4e24606258d1f1b61474719d946fb4bc$2b77580ccc6b86e4157ad4b07fe1edfb4e4dd6e7','B2017-22112','Albert Einstine',1,2,'albert.jpg','2019-02-22 14:35:23'),(9,'std1@kdmv.com','b97d32489e010dcdee1aaac768e2a00dc631a2be$a982aaea5b9b28e35add1ddbaad1727e66790e9b','B2017-22113','Grahm Smith',1,2,'ccccc.jpg','2019-02-25 19:41:41'),(10,'std2@kdmv.com','7e1e46c7f4686dfdd39530ca9db523a9dcde5731$aeceac3288fcf72a95ce7a99693c94861a9771a0','B2017-22116','Nathan Paul',1,2,'cccc.jpg','2019-02-25 19:42:40'),(11,'std3@kdmv.com','7b89c6cef67265ef60fe9b1262bdbf6cec652008$0e3497e85a767fe21f634ecc92992297fdc70c66','B2017-22192','Alicia Vikandar',1,2,'C_Athletics-b.jpg','2019-02-25 19:43:13'),(12,'std5@kdmv.com',NULL,'B2017-22178','Alex Morgan',1,2,'maria.jpg','2019-02-25 19:44:51'),(13,'std6@kdmv.com',NULL,'B2017-22524','Maria Sharapova',1,2,'maria-sharapova.jpg','2019-02-25 19:45:26'),(14,'std7@kdmv.com',NULL,'B2017-22144','Michael Phelps',1,2,'phelps.jpg','2019-03-12 13:20:13'),(15,'std8@kdmv.com',NULL,'B2017-22145','David Beckham',1,2,'becham.jpg','2019-03-12 13:20:42'),(16,'std9@kdmv.com',NULL,'B2017-22146','Roger Federer',1,2,'federer.jpg','2019-03-12 13:21:22'),(17,'irantha.86@gmail.com',NULL,'B2017-22147','Michel Jordan',1,2,'jordan.jpg','2019-03-12 13:21:52'),(18,'std12@kdmv.com',NULL,'B2017-22148','Christiano Ronaldo',1,2,'ronaldo.jpg','2019-03-12 13:22:35'),(19,'std11@kdmv.com',NULL,'B2017-22501','Gayanjalai amarawansa',1,2,'Gayanjalai amarawansa.PNG','2019-03-12 13:44:39'),(20,'std13@kdmv.com',NULL,'B2017-22502','Dharshika Abeywickrama',1,2,'dharshika abeywickrama.PNG','2019-03-12 13:45:17'),(22,'std14@kdmv.com',NULL,'B2017-22503','Sachini Rodrigru',-1,2,'Sachini Rodrigru.PNG','2019-03-12 13:46:09'),(23,'std15@kdmv.com',NULL,'B2017-22555','Sugath Thlakaratne',-1,2,'sugath.PNG','2019-03-17 22:50:53'),(24,'rakitha@mailinator.com','02d5f4b601db5bb032edf8af64249adac46e599f$415db9c58cdef2a9120ced250aeb14b2d7493e19','B2017-2288','Rakitha Perera',-1,2,'profile.png','2019-04-09 09:42:26'),(25,'test@mailinator.com','4d4ed3e60a558d6451f48ad12f53a28f1ebe826b$9ee8fe601e559f99ac696bddad017bbf124a8c26','null','Test Visitor',1,1,'profile.png','2019-04-11 06:09:20'),(26,'testadmin@mailinator.com','cd865cb956a01eaae8411b222121680e7012afaf$f42bc648f08c2c71f8c90392a12853d1fa70ab4f','null','Test Admin',1,3,'profile.png','2019-04-11 06:10:18'),(27,'testadmin1@mailinator.com','5d0f483044250a26bdf2f905eb7e909aba4134f6$e8556f80b69849e9daf20a64e3f7fbed3a823e39','null','test Admin',1,3,'profile.png','2019-04-11 06:10:53'),(28,NULL,NULL,'Sam Smith',NULL,-1,2,'profile.png','2019-04-11 06:14:02'),(29,NULL,NULL,'Sam Samith',NULL,-1,2,'profile.png','2019-04-11 06:15:52'),(30,NULL,NULL,'Sam Samith',NULL,0,2,'profile.png','2019-04-11 06:16:09'),(31,NULL,NULL,'Sam Samith',NULL,0,2,'profile.png','2019-04-11 06:16:38'),(32,NULL,NULL,'12312345',NULL,-1,2,'profile.png','2019-04-11 06:19:13'),(33,'test@mailinator.com','ba12110891f7594b876c23c82cfb71d55303b2c8$c85f58d1ca68a6ef61a9dd1e6cad619c3e31df8a','STD-00011','Yasith Hewage',1,2,'profile.png','2019-04-11 10:12:40'),(34,'dileka@mailinator.com','147dd72325696752a81324a4d157ff554445baef$031fdfbbfffbfcc040e72ed60c65f3398c5b717c','Dileka','Dileka Supipi',1,2,'profile.png','2019-04-22 10:05:25'),(36,'test@mailinator.com','603ea481a26a0d9effe52f4f2010b714525a8cf5$0f5b8ac38170b0fb3916fb8f0cf37afcd7624d97','Dilen','Dilen Chamika',-1,2,'profile.png','2019-04-22 10:07:06'),(37,'test@mailinator.com','02d00cc5ea142733bfe696d6fba9a5b539669932$c0701494870ad84ede00588d649297550ca2a462','Test Student','Test Student',-1,2,'profile.png','2019-04-22 10:09:34'),(38,'dilen@mailinator.com','ec7f6dbc39cd3c6ada4aecbf152a50c8366ef35c$c28ce50f6a029665d62f5b36fb3c56f78b69c365','111111','Test Student 02',-1,2,'profile.png','2019-04-22 10:11:25'),(39,'visitor01@mailinator.com','3d27a06777c6f8f6c2e89718c3a41f53a5169c5e$63616d6e6ba6094542268514eed5d236b8d05da7','null','visitor01',0,1,'profile.png','2019-04-22 10:14:01'),(40,'test2@mailinator.com','f14add8ef2bd62fb875539930fd59854eefd2afb$e3c5f736cade607e9c9d1d23a4459ac8adffaf5f','222222','Test Student 03',-1,2,'profile.png','2019-04-22 10:17:32'),(41,NULL,NULL,'1234',NULL,-1,2,'profile.png','2019-04-30 06:34:00'),(42,NULL,NULL,'1234',NULL,0,2,'profile.png','2019-04-30 06:34:42'),(43,NULL,NULL,'1234',NULL,0,2,'profile.png','2019-04-30 06:35:59'),(44,'student1234@mailinator.com','7e6244973a44c36d1225eb342d27452e3d85af96$9a965456a0be7e8c20c22b1e54314d89fdcaff39','12345','Student 12345',-1,2,'profile.png','2019-04-30 06:37:28'),(45,'testvisitior@mailinator.com','8b032bf5b4ec84472e715cd4855c0ca529a7b83e$6b828be75610e72d0b68b51c0092a09fbdefe91d','null','test visitior',0,1,'profile.png','2019-04-30 06:55:21'),(46,'visitor@kdmv.com','a2739e657dec90417a926839f2977ef607f308c3$a845be546d867e3603e5eb6fff8a24d5ac462874','null','Visit Visitor',1,1,'profile.png','2019-04-30 13:06:49'),(47,NULL,NULL,'12345',NULL,0,2,'profile.png','2019-04-30 15:23:45'),(48,NULL,NULL,'123456',NULL,-1,2,'profile.png','2019-04-30 15:26:53'),(49,NULL,NULL,'123456',NULL,0,2,'profile.png','2019-05-01 04:54:43'),(50,NULL,NULL,'12345',NULL,0,2,'profile.png','2019-05-01 04:55:44'),(51,NULL,NULL,'11111',NULL,-1,2,'profile.png','2019-05-01 04:56:17'),(52,NULL,NULL,'12345',NULL,0,2,'profile.png','2019-05-01 04:56:54'),(53,NULL,NULL,'111111',NULL,0,2,'profile.png','2019-05-01 04:59:04'),(54,NULL,NULL,'333333',NULL,-1,2,'profile.png','2019-05-01 05:01:31'),(55,'444@mailinator.com','e15837e05775288428653a081d4705663bd1fa14$0d83a6bc8ad1701da8b73360ab7cdedf657d4f97','444444','Test student 04',1,2,'profile.png','2019-05-01 05:02:07'),(56,NULL,NULL,'23456',NULL,-1,2,'profile.png','2019-05-01 15:57:54'),(57,NULL,NULL,'1234',NULL,0,2,'profile.png','2019-05-01 16:01:02'),(58,NULL,NULL,'12345',NULL,0,2,'profile.png','2019-05-01 16:21:31'),(59,NULL,NULL,'55555',NULL,0,2,'profile.png','2019-05-02 06:19:57'),(60,'student67@mailinator.com','8d8e7f79b1eff42947e897c891f9d7cdb18bb33d$587352564a4a65a3494dd624188de6ca39c2bf7a','666666','student 67',-1,2,'profile.png','2019-05-02 06:27:30'),(61,'bill@vdsina.ru','15cdde93212f33d3cab7d43dc402030ae2259af9$d2be55b125d4d64babc664d418dafc126399aba5','null','Annotationsdji',0,3,'profile.png','2019-05-03 09:47:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'lstms_sport_desk'
--

--
-- Dumping routines for database 'lstms_sport_desk'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-03 10:36:38
