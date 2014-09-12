-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: testapp
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_country` varchar(255) NOT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `customer_name` (`customer_name`),
  KEY `customer_country` (`customer_country`),
  KEY `customer_email` (`customer_email`)
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (552,'Carter Anderson1','Carter_Anderson@aol.com','SG'),(553,'King Clark','King_Clark@bing.com','TK'),(554,'Robinson Wright','Robinson_Wright@aol.com','SA'),(555,'Dave Weckl','dave@yahoo.com','US'),(556,'Edwards Johnson','Edwards_Johnson@altavista.com','MN'),(557,'Nelson Thomas','Nelson_Thomas@yahoo.com','NP'),(558,'Hernandez Rodriguez','Hernandez_Rodriguez@hotmail.com','BF'),(559,'Martinez Lopez','Martinez_Lopez@yahoo.com','ST'),(560,'Moore Perez','Moore_Perez@yahoo.com','NR'),(561,'Evans Williams','Evans_Williams@bing.com','ES'),(562,'Gonzalez Jackson','Gonzalez_Jackson@aol.com','CK'),(563,'Young Lewis','Young_Lewis@yahoo.com','US'),(564,'Garcia Hill','Garcia_Hill@hotmail.com','BV'),(565,'Wilson Roberts','Wilson_Roberts@yahoo.com','US'),(566,'Parker Jones','Parker_Jones@altavista.com','EC'),(567,'Baker White','Baker_White@aol.com','HN'),(568,'Allen Lee','Allen_Lee@altavista.com','SE'),(569,'Thompson Scott','Thompson_Scott@altavista.com','MS'),(570,'Miller Turner','Miller_Turner@hotmail.com','CM'),(571,'Campbell Brown','Campbell_Brown@bing.com','LC'),(572,'Adams Harris','Adams_Harris@bing.com','JP'),(573,'Hall Walker','Hall_Walker@aol.com','LR'),(574,'Martin Green','Martin_Green@bing.com','ET'),(575,'Davis Phillips','Davis_Phillips@google.com','GE'),(577,'Green Martin','Green_Martin@google.com','HT'),(578,'Walker Hall','Walker_Hall@bing.com','KM'),(579,'Harris Adams','Harris_Adams@altavista.com','PW'),(580,'Brown Campbell','Brown_Campbell@google.com','SB'),(581,'Turner Miller','Turner_Miller@hotmail.com','EE'),(582,'Scott Thompson','Scott_Thompson@yahoo.com','NF'),(583,'Lee Allen','Lee_Allen@yahoo.com','GB'),(584,'White Baker','White_Baker@yahoo.com','PA'),(585,'Jones Parker','Jones_Parker@yahoo.com','NL'),(586,'Roberts Wilson','Roberts_Wilson@yahoo.com','TG'),(587,'Hill Garcia','Hill_Garcia@hotmail.com','VG'),(588,'Lewis Young','Lewis_Young@hotmail.com','GD'),(589,'Jackson Gonzalez','Jackson_Gonzalez@yahoo.com','MS'),(590,'Williams Evans','Williams_Evans@hotmail.com','LA'),(591,'Perez Moore','Perez_Moore@aol.com','JP'),(592,'Lopez Martinez','Lopez_Martinez@aol.com','SB'),(593,'Rodriguez Hernandez','Rodriguez_Hernandez@bing.com','CI'),(594,'Thomas Nelson','Thomas_Nelson@bing.com','SH'),(595,'Johnson Edwards','Johnson_Edwards@altavista.com','LI'),(596,'Mitchell Taylor','Mitchell_Taylor@aol.com','CH'),(597,'Wright Robinson','Wright_Robinson@aol.com','GG'),(598,'Clark King','Clark_King@yahoo.com','GD'),(599,'Anderson Carter','Anderson_Carter@hotmail.com','RO'),(600,'Smith Collins','Smith_Collins@altavista.com','GI');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `transactions_id` int(20) NOT NULL AUTO_INCREMENT,
  `transactions_customer_id` int(20) NOT NULL,
  `transactions_item` varchar(255) NOT NULL,
  `transactions_amount` decimal(15,2) NOT NULL,
  `transactions_date` datetime NOT NULL,
  PRIMARY KEY (`transactions_id`),
  KEY `customerid` (`transactions_customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,551,'iphone 5',500.00,'2014-09-09 13:04:53'),(2,552,'Desktop PC',1000.00,'2014-09-09 13:04:53'),(3,553,'Desktop PC',1000.00,'2014-09-09 13:04:53'),(4,554,'HTC mobile Phone',200.00,'2014-09-09 13:04:53'),(5,555,'Laptop',300.00,'2014-09-09 13:04:53'),(6,556,'Laptop',300.00,'2014-09-09 13:04:53'),(7,557,'Laptop',300.00,'2014-09-09 13:04:53'),(8,558,'HTC mobile Phone',200.00,'2014-09-09 13:04:53'),(9,559,'HTC mobile Phone',200.00,'2014-09-09 13:04:53'),(10,560,'iphone 5',500.00,'2014-09-09 13:04:53'),(11,561,'iphone 5',500.00,'2014-09-09 13:04:53'),(12,562,'HTC mobile Phone',200.00,'2014-09-09 13:04:53'),(13,563,'Desktop PC',1000.00,'2014-09-09 13:04:53'),(14,564,'iphone 5',500.00,'2014-09-09 13:04:53'),(15,565,'Desktop PC',1000.00,'2014-09-09 13:04:53'),(16,566,'iphone 5',500.00,'2014-09-09 13:04:53'),(17,567,'Desktop PC',1000.00,'2014-09-09 13:04:53'),(18,568,'Desktop PC',1000.00,'2014-09-09 13:04:53'),(19,569,'Laptop',300.00,'2014-09-09 13:04:53'),(20,570,'Laptop',300.00,'2014-09-09 13:04:53'),(21,571,'Desktop PC',1000.00,'2014-09-09 13:04:53'),(22,572,'iphone 5',500.00,'2014-09-09 13:04:53'),(23,573,'Laptop',300.00,'2014-09-09 13:04:53'),(24,574,'iphone 5',500.00,'2014-09-09 13:04:53'),(25,575,'Laptop',300.00,'2014-09-09 13:04:53'),(26,576,'iphone 5',500.00,'2014-09-09 13:04:53'),(27,577,'iphone 5',500.00,'2014-09-09 13:04:53'),(28,578,'Laptop',300.00,'2014-09-09 13:04:54'),(29,579,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(30,580,'iphone 5',500.00,'2014-09-09 13:04:54'),(31,581,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(32,582,'Laptop',300.00,'2014-09-09 13:04:54'),(33,583,'iphone 5',500.00,'2014-09-09 13:04:54'),(34,584,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(35,585,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(36,586,'Laptop',300.00,'2014-09-09 13:04:54'),(37,587,'iphone 5',500.00,'2014-09-09 13:04:54'),(38,588,'Laptop',300.00,'2014-09-09 13:04:54'),(39,589,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(40,590,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(41,591,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(42,592,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(43,593,'iphone 5',500.00,'2014-09-09 13:04:54'),(44,594,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(45,595,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(46,596,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(47,597,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(48,598,'iphone 5',500.00,'2014-09-09 13:04:54'),(49,599,'iphone 5',500.00,'2014-09-09 13:04:54'),(50,600,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(51,551,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(52,552,'iphone 5',500.00,'2014-09-09 13:04:54'),(53,553,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(54,554,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(55,555,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(56,556,'iphone 5',500.00,'2014-09-09 13:04:54'),(57,557,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(58,558,'Desktop PC',1000.00,'2014-09-09 13:04:54'),(59,559,'iphone 5',500.00,'2014-09-09 13:04:54'),(60,560,'Laptop',300.00,'2014-09-09 13:04:54'),(61,561,'HTC mobile Phone',200.00,'2014-09-09 13:04:54'),(62,562,'iphone 5',500.00,'2014-09-09 13:04:54'),(63,563,'iphone 5',500.00,'2014-09-09 13:04:54'),(64,564,'Laptop',300.00,'2014-09-09 13:04:54'),(65,565,'Laptop',300.00,'2014-09-09 13:04:54'),(66,566,'Laptop',300.00,'2014-09-09 13:04:54'),(67,567,'iphone 5',500.00,'2014-09-09 13:04:54'),(68,568,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(69,569,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(70,570,'iphone 5',500.00,'2014-09-09 13:04:55'),(71,571,'Laptop',300.00,'2014-09-09 13:04:55'),(72,572,'Laptop',300.00,'2014-09-09 13:04:55'),(73,573,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(74,574,'iphone 5',500.00,'2014-09-09 13:04:55'),(75,575,'HTC mobile Phone',200.00,'2014-09-09 13:04:55'),(76,576,'HTC mobile Phone',200.00,'2014-09-09 13:04:55'),(77,577,'Laptop',300.00,'2014-09-09 13:04:55'),(78,578,'iphone 5',500.00,'2014-09-09 13:04:55'),(79,579,'iphone 5',500.00,'2014-09-09 13:04:55'),(80,580,'iphone 5',500.00,'2014-09-09 13:04:55'),(81,581,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(82,582,'HTC mobile Phone',200.00,'2014-09-09 13:04:55'),(83,583,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(84,584,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(85,585,'Laptop',300.00,'2014-09-09 13:04:55'),(86,586,'HTC mobile Phone',200.00,'2014-09-09 13:04:55'),(87,587,'iphone 5',500.00,'2014-09-09 13:04:55'),(88,588,'iphone 5',500.00,'2014-09-09 13:04:55'),(89,589,'HTC mobile Phone',200.00,'2014-09-09 13:04:55'),(90,590,'iphone 5',500.00,'2014-09-09 13:04:55'),(91,591,'iphone 5',500.00,'2014-09-09 13:04:55'),(92,592,'Laptop',300.00,'2014-09-09 13:04:55'),(93,593,'HTC mobile Phone',200.00,'2014-09-09 13:04:55'),(94,594,'Laptop',300.00,'2014-09-09 13:04:55'),(95,595,'HTC mobile Phone',200.00,'2014-09-09 13:04:55'),(96,596,'iphone 5',500.00,'2014-09-09 13:04:55'),(97,597,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(98,598,'Laptop',300.00,'2014-09-09 13:04:55'),(99,599,'Desktop PC',1000.00,'2014-09-09 13:04:55'),(100,600,'HTC mobile Phone',200.00,'2014-09-09 13:04:55');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-12 14:42:46
