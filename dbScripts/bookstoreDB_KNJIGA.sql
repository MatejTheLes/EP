-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: bookstoreDB
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `KNJIGA`
--

DROP TABLE IF EXISTS `KNJIGA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KNJIGA` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDAVTORJA` int(11) DEFAULT NULL,
  `OPISKNJIGE` varchar(3096) NOT NULL,
  `CENA` float(8,2) NOT NULL,
  `NASLOV` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `RELATIONSHIP_1_FK` (`IDAVTORJA`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KNJIGA`
--

LOCK TABLES `KNJIGA` WRITE;
/*!40000 ALTER TABLE `KNJIGA` DISABLE KEYS */;
INSERT INTO `KNJIGA` VALUES (1,1,'In this book the author provides insightful information on how to achieve longer yeets',69.42,'How to yeet further'),(2,2,'The Hitchhikers Guide to the Galaxy is a fictional electronic guide book in the multimedia scifi/comedy series of the same name by Douglas Adams. The Guide serves as the standard repository for all knowledge and wisdom for many members of the series galaxy-spanning civilization.',15.50,'The Hitchikers Guide to the Galaxy'),(3,3,'This books provides many reasons as to why one should acquire a pet rock for themselves in order to improve his or her everyday life.',55.50,'The many advantages of owning a pet rock'),(4,1,'Neka testna knjiga tu za podatke lmao',14.95,'Testing our EP project vol. 3'),(5,1,'Wait what is this shit',16.95,'Getting familiar with git');
/*!40000 ALTER TABLE `KNJIGA` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-16 11:31:29
