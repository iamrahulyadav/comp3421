-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.0.100    Database: comp3421
-- ------------------------------------------------------
-- Server version	5.7.9-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comp3421_announcement`
--

DROP TABLE IF EXISTS `comp3421_announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_announcement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_exhibition`
--

DROP TABLE IF EXISTS `comp3421_exhibition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_exhibition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `info` text,
  `venue` varchar(255) DEFAULT NULL,
  `venue_lat` double NOT NULL,
  `venue_lng` double NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_forum`
--

DROP TABLE IF EXISTS `comp3421_forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_forum` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `topic` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_forum_article`
--

DROP TABLE IF EXISTS `comp3421_forum_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_forum_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` int(10) unsigned NOT NULL,
  `title` text,
  `content` text NOT NULL,
  `writer_id` varchar(255) NOT NULL,
  `reply_to` int(11) unsigned DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`forum_id`),
  KEY `fk_forum_article_idx` (`forum_id`),
  KEY `fk_forum_writer_idx` (`writer_id`),
  KEY `fk_forum_reply_idx` (`reply_to`),
  CONSTRAINT `fk_forum_article` FOREIGN KEY (`forum_id`) REFERENCES `comp3421_forum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_forum_reply` FOREIGN KEY (`reply_to`) REFERENCES `comp3421_forum_article` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_forum_writer` FOREIGN KEY (`writer_id`) REFERENCES `comp3421_member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_member`
--

DROP TABLE IF EXISTS `comp3421_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_member` (
  `id` varchar(255) NOT NULL,
  `title` varchar(10) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `attendee_type` varchar(50) NOT NULL,
  `department` varchar(200) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `fax_number` varchar(50) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `payment_status` varchar(45) DEFAULT NULL,
  `remarks` text,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_message`
--

DROP TABLE IF EXISTS `comp3421_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(255) NOT NULL,
  `receiver_id` varchar(255) NOT NULL,
  `title` text,
  `content` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_reward`
--

DROP TABLE IF EXISTS `comp3421_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_reward` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `receiver_id` int(11) DEFAULT NULL,
  `content` text,
  `title` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_session`
--

DROP TABLE IF EXISTS `comp3421_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_session` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL,
  `info` text,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `speaker` varchar(255) NOT NULL,
  `venue_lat` double NOT NULL,
  `venue_lng` double NOT NULL,
  `venue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_session_speaker_idx` (`speaker`),
  CONSTRAINT `fk_session_speaker` FOREIGN KEY (`speaker`) REFERENCES `comp3421_member` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_session_attendee`
--

DROP TABLE IF EXISTS `comp3421_session_attendee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_session_attendee` (
  `attendee_id` varchar(255) NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`attendee_id`,`session_id`),
  KEY `fk_session_idx` (`session_id`),
  CONSTRAINT `fk_session` FOREIGN KEY (`session_id`) REFERENCES `comp3421_session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_session_attendee` FOREIGN KEY (`attendee_id`) REFERENCES `comp3421_member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_speaker`
--

DROP TABLE IF EXISTS `comp3421_speaker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_speaker` (
  `id` varchar(255) NOT NULL,
  `info` text,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_speaker_member` FOREIGN KEY (`id`) REFERENCES `comp3421_member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_survey`
--

DROP TABLE IF EXISTS `comp3421_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_survey` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_survey_field`
--

DROP TABLE IF EXISTS `comp3421_survey_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_survey_field` (
  `survey_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `id` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `options` text,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`survey_id`,`id`),
  CONSTRAINT `fk_survey` FOREIGN KEY (`survey_id`) REFERENCES `comp3421_survey` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comp3421_survey_response`
--

DROP TABLE IF EXISTS `comp3421_survey_response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp3421_survey_response` (
  `survey_id` int(11) unsigned NOT NULL,
  `writer_id` varchar(255) NOT NULL,
  `response_json` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`survey_id`,`writer_id`),
  KEY `fk_servey_writer_idx` (`writer_id`),
  CONSTRAINT `fk_servey` FOREIGN KEY (`survey_id`) REFERENCES `comp3421_survey` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_servey_writer` FOREIGN KEY (`writer_id`) REFERENCES `comp3421_member` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-20 11:34:03
