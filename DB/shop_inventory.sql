-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: shop_inventory
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit`
--

DROP TABLE IF EXISTS `audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit` (
  `auditID` int NOT NULL AUTO_INCREMENT,
  `time` varchar(200) NOT NULL,
  `userID` int NOT NULL,
  `usertype` varchar(45) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `Action` varchar(1024) NOT NULL,
  PRIMARY KEY (`auditID`)
) ENGINE=InnoDB AUTO_INCREMENT=2022323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` VALUES (2022229,'2024-11-18 22:53:26',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Packaging Tape details'),(2022230,'2024-11-18 23:47:52',2020101,'Admin','John Felicisimo','Account: (2020101) Activated '),(2022231,'2024-11-18 23:48:33',2020101,'Admin','John Felicisimo','Account: (2020101) Activated '),(2022232,'2024-11-18 23:52:15',2020101,'Admin','John Felicisimo','Account: (2020101) Deactivate 2020149'),(2022233,'2024-11-18 23:53:49',2020101,'Admin','John Felicisimo','Account: (2020101) Activated 2020149'),(2022234,'2024-11-18 23:54:27',2020101,'Admin','John Felicisimo','Account: (2020101) Updated  details.'),(2022235,'2024-11-18 23:55:42',2020101,'Admin','John Felicisimo','Account: (2020101) Updated 2020101 details.'),(2022236,'2024-11-18 23:56:50',2020101,'Admin','John Felicisimo','Account: (2020101) Updated his/her account details.'),(2022237,'2024-11-18 23:57:36',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted 2020149'),(2022238,'2024-11-18 23:57:46',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted 2020149'),(2022239,'2024-11-19 10:41:08',2020101,'Admin','John Felicisimo','Account: (2020101) Restock  details'),(2022240,'2024-11-19 10:41:59',2020101,'Admin','John Felicisimo','Account: (2020101) Restock  details'),(2022241,'2024-11-19 10:58:57',2020101,'Admin','John Felicisimo','Account: (2020101) Restock PATAPE003'),(2022242,'2024-11-19 11:00:16',2020101,'Admin','John Felicisimo','Account: (2020101) Restock Packaging Tape'),(2022243,'2024-11-19 11:01:56',2020101,'Admin','John Felicisimo','Account: (2020101) Restock PATAPE004'),(2022244,'2024-11-19 11:59:04',2020101,'Admin','John Felicisimo','Account: (2020101) Updated vendor2027102'),(2022245,'2024-11-19 12:00:37',2020150,'Employee','Gregg Emplo','Gregg Emplo has registered under account name \"gregg\"'),(2022246,'2024-11-19 12:01:14',2020151,'Employee','John Resel','John Resel has registered under account name \"john\"'),(2022247,'2024-11-19 12:01:44',2020101,'Admin','John Felicisimo','Account: (2020101) Activated 2020150'),(2022248,'2024-11-19 12:01:57',2020101,'Admin','John Felicisimo','Account: (2020101) Updated 2020150 details.'),(2022249,'2024-11-19 12:02:14',2020101,'Admin','John Felicisimo','Account: (2020101) Activated 2020151'),(2022250,'2024-11-19 12:03:32',2020151,'Reseller','John Resel','Account: (2020151) made a sale'),(2022251,'2024-11-19 12:07:18',2020101,'Admin','John Felicisimo','Account: (2020101) Added Fragile Tape to items'),(2022252,'2024-11-19 12:08:03',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Fragile Tape details'),(2022253,'2024-11-19 12:09:27',2020101,'Admin','John Felicisimo','Account: (2020101) Added Fragile Tape to items'),(2022254,'2024-11-19 12:12:54',2020101,'Admin','John Felicisimo','Account: (2020101) Added Fragile Tape to items'),(2022255,'2024-11-19 12:13:20',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Fragile Tape details'),(2022256,'2024-11-20 01:02:21',2020101,'Admin','John Felicisimo','Account: (2020101) made a sale'),(2022257,'2024-11-20 01:10:50',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Packaging Tape details'),(2022258,'2024-11-20 01:22:52',2020101,'Admin','John Felicisimo','Account: (2020101) Add vendorGregg Felicisimo'),(2022259,'2024-11-20 01:24:11',2020101,'Admin','John Felicisimo','Account: (2020101) Updated vendor2027103 details.'),(2022260,'2024-11-20 01:24:38',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted vendor2027103'),(2022261,'2024-11-22 11:08:36',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Updated his/her account details.'),(2022262,'2024-11-22 11:10:09',2020101,'Admin','Gregg Smith','Account: (2020101) Updated his/her account details.'),(2022263,'2024-11-22 11:11:10',2020101,'Admin','JG Felicisimo','Account: (2020101) Updated his/her account details.'),(2022264,'2024-11-22 12:28:18',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 0'),(2022265,'2024-11-22 12:31:16',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 0'),(2022266,'2024-11-22 12:33:40',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024101'),(2022267,'2024-11-22 12:33:45',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024101'),(2022268,'2024-11-22 14:03:58',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 0'),(2022269,'2024-11-22 14:04:47',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 0'),(2022270,'2024-11-22 14:07:17',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024102'),(2022271,'2024-11-22 14:09:39',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024102'),(2022272,'2024-11-22 14:10:24',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024102'),(2022273,'2024-11-22 14:10:47',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024102'),(2022274,'2024-11-22 14:12:59',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024102'),(2022275,'2024-11-22 14:15:11',2020101,'Admin','JG Felicisimo','Account: (2020101) Deleted Item 2024102'),(2022276,'2024-11-22 15:52:57',2020101,'Admin','JG Felicisimo','Account: (2020101) Updated Item 2024102'),(2022277,'2024-11-22 19:07:06',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Updated his/her account details.'),(2022278,'2024-11-22 19:57:52',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Deleted Item 0'),(2022279,'2024-11-22 20:02:19',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Deleted Item 2023101'),(2022280,'2024-11-22 20:02:53',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Deleted Item 2023101'),(2022281,'2024-11-22 20:03:02',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Deleted Item 2023101'),(2022282,'2024-11-23 15:50:40',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Updated Item 2024102'),(2022283,'2024-11-23 15:50:49',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Updated Item 2024103'),(2022284,'2024-11-24 14:15:28',2020101,'Admin','Gregg Felicisimo','Account: (2020101) Updated 2020150 details.'),(2022285,'2024-11-24 14:15:54',2020101,'Admin','John Felicisimo','Account: (2020101) Updated his/her account details.'),(2022286,'2024-11-24 14:24:06',2020101,'Admin','John Felicisimo','Added Customer (Customer)'),(2022287,'2024-11-24 14:24:28',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Item 2023102'),(2022288,'2024-11-24 14:25:18',2020101,'Admin','John Felicisimo','Added Customer (Customer)'),(2022289,'2024-11-24 14:26:08',2020101,'Admin','John Felicisimo','Added Customer (Customer)'),(2022290,'2024-11-24 14:33:15',2020101,'Admin','John Felicisimo','Added Customer (Customer)'),(2022291,'2024-11-24 14:34:03',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Customer 2023105'),(2022292,'2024-11-24 14:36:08',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Customer 2023105'),(2022293,'2024-11-24 14:37:01',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Customer 2023105'),(2022294,'2024-11-24 14:40:06',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Customer 2023105'),(2022295,'2024-11-24 14:40:26',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Customer 2023105'),(2022296,'2024-11-24 14:43:50',2020101,'Admin','John Felicisimo','Account: (2020101) made a sale'),(2022297,'2024-11-24 14:44:41',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Item 2024107'),(2022298,'2024-11-24 14:44:51',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Item 2024109'),(2022299,'2024-11-24 14:45:24',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Item 2024113'),(2022300,'2024-11-24 14:45:49',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Item 2024104'),(2022301,'2024-11-24 14:46:03',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Item 2024111'),(2022302,'2024-11-24 23:22:22',2020101,'Admin','John Felicisimo','Account: (2020101) Updated Customer 0'),(2022303,'2024-11-24 23:26:21',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022304,'2024-11-24 23:27:38',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022305,'2024-11-24 23:28:13',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022306,'2024-11-24 23:28:25',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022307,'2024-11-24 23:28:32',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022308,'2024-11-24 23:29:08',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022309,'2024-11-24 23:29:22',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022310,'2024-11-24 23:32:57',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027102'),(2022311,'2024-11-25 09:37:30',2020101,'Admin','John Felicisimo','Account: (2020101) Add vendorJohn Gregg Supplies'),(2022312,'2024-11-25 09:38:07',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027114'),(2022313,'2024-11-25 09:38:19',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027114'),(2022314,'2024-11-25 09:38:27',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted Supplier 2027114'),(2022315,'2024-11-25 18:22:23',2020101,'Admin','John Felicisimo','Added Customer (Customer)'),(2022316,'2024-11-25 19:13:31',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted 2020101'),(2022317,'2024-11-25 19:13:48',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted 2020150'),(2022318,'2024-11-25 19:14:14',2020101,'Admin','John Felicisimo','Account: (2020101) Deleted 2020151'),(2022319,'2024-11-25 19:14:33',2020101,'Admin','John Felicisimo','Account: (2020101) made a sale'),(2022320,'2024-11-25 19:19:03',2020152,'Employee','John Felicisimo','John Felicisimo has registered under account name \"admin\"'),(2022321,'2024-11-25 19:20:27',2020152,'Admin','John Felicisimo','Account: (2020152) Deleted 2020152'),(2022322,'2024-11-25 19:41:28',2020153,'Employee','JGregg Felicisimo','JGregg Felicisimo has registered under account name \"admin\"');

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `customerID` int NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) NOT NULL,
  `phone2` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `district` varchar(30) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2023117 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` VALUES (2023106,'John Santos','john.santos@gmail.com','09171234567','09281234567','123 JP Rizal St.',NULL,'Makati','Guadalupe','active','2024-11-24 23:43:53'),(2023107,'Maria Dela Cruz','maria.delacruz@yahoo.com','09182233445','09392233445','45 Estrella St.',NULL,'Makati','Rockwell','active','2024-11-24 23:43:53'),(2023108,'Carlos Reyes','carlos.reyes@gmail.com','09183334456','09403334456','678 Kalayaan Ave.',NULL,'Taguig','Bonifacio Global City','active','2024-11-24 23:43:53'),(2023109,'Ana Ramirez','ana.ramirez@yahoo.com','09184455678','09514455678','12 N. Garcia St.',NULL,'Makati','Bel-Air','active','2024-11-24 23:43:53'),(2023110,'Victor Cruz','victor.cruz@gmail.com','09185566789','09625566789','456 Chino Roces Ave.',NULL,'Pasay','Malibay','active','2024-11-24 23:43:53'),(2023111,'Samantha Lopez','samantha.lopez@yahoo.com','09186677890','09736677890','90 Evangelista St.',NULL,'Makati','Bangkal','active','2024-11-24 23:43:53'),(2023112,'David Tan','david.tan@gmail.com','09187788901','09847788901','321 Amorsolo St.',NULL,'Makati','Legazpi Village','active','2024-11-24 23:43:53'),(2023113,'Lara Mendoza','lara.mendoza@yahoo.com','09188899012','09958899012','8 V.A. Rufino St.',NULL,'Pasig','Ortigas Center','active','2024-11-24 23:43:53'),(2023114,'Miguel Bautista','miguel.bautista@gmail.com','09189900123','09299900123','67 Pioneer St.',NULL,'Mandaluyong','Barangka','active','2024-11-24 23:43:53'),(2023115,'Isabel Gomez','isabel.gomez@yahoo.com','09190011234','09300011234','34 Malugay St.',NULL,'Makati','San Antonio','active','2024-11-24 23:43:53'),(2023116,'Jean Cuerbi','jean09@gmail.com','09385746271','09375847261','983 Mendoza St','763 Calmar St','Makati City','Metro Manila','','2024-11-25 18:22:23');

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item` (
  `productID` int NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  `itemNumber` varchar(255) DEFAULT NULL,
  `itemName` varchar(255) DEFAULT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `costing` float NOT NULL DEFAULT '0',
  `unitPrice` float NOT NULL DEFAULT '0',
  `imageURL` varchar(255) NOT NULL DEFAULT 'imageNotAvailable.jpg',
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `description` text NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=2024114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

INSERT INTO `item` VALUES (2024102,'Tape','PATAPE002','Packaging Tape',0,143,23.1,30,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx60M'),(2024103,'Tape','PATAPE003','Packaging Tape',0,144,24.9,32,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx65M'),(2024104,'Tape','PATAPE004','Packaging Tape',0,144,26.7,34,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx70M'),(2024105,'Tape','PATAPE005','Packaging Tape',0,144,28.5,36,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx75M'),(2024106,'Tape','PATAPE006','Packaging Tape',0,120,30.3,34.5,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx80M'),(2024107,'Tape','PATAPE007','Packaging Tape',0,100,35.7,42.5,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx95M'),(2024108,'Tape','PATAPE008','Packaging Tape',0,100,50.5,58.5,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx140M'),(2024109,'Tape','PATAPE009','Packaging Tape',0,20,84.9,107.5,'imageNotAvailable.jpg','Active','Clear/Tan | 48MMx240M'),(2024110,'Tape','FRATAPE001','Fragile Tape',0,140,0,32.5,'imageNotAvailable.jpg','Active','CLEAR | 48MMx50M'),(2024111,'Tape','FRATAPE002','Fragile Tape',0,120,0,46.5,'imageNotAvailable.jpg','Active',' RED KING | 48MMx100M'),(2024112,'Tape','FRATAPE003','Fragile Tape',0,120,0,46.5,'imageNotAvailable.jpg','Active','WHITE KING | 48MMx100M'),(2024113,'Tape','FRATAPE004','Fragile Tape',0,120,50,57.5,'imageNotAvailable.jpg','Active','RED SUNSHINE | 48MMX100M');

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `orderID` int NOT NULL AUTO_INCREMENT,
  `saleID` int NOT NULL,
  `itemNumber` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `unitPrice` float DEFAULT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--


--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase` (
  `purchaseID` int NOT NULL AUTO_INCREMENT,
  `itemNumber` varchar(255) NOT NULL,
  `purchaseDate` date NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `unitPrice` float NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `vendorName` varchar(255) NOT NULL DEFAULT 'Test Vendor',
  `vendorID` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`purchaseID`)
) ENGINE=InnoDB AUTO_INCREMENT=2025106 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` VALUES (2025101,'PATAPE001','2024-11-06','Packaging Tape',100,4,'John Gregg',2027102),(2025102,'PATAPE002','2024-11-06','Packaging Tape',100,5,'John Gregg',2027102),(2025103,'PATAPE003','2024-11-06','Packaging Tape',50,10,'John Gregg',2027102),(2025104,'PATAPE004','2024-11-06','Packaging Tape',50,4,'John Gregg',2027102),(2025105,'PATAPE004','2024-11-06','Packaging Tape',50,4,'John Gregg',2027102);

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale` (
  `saleID` int NOT NULL AUTO_INCREMENT,
  `customerID` int NOT NULL,
  `sellerID` int NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `itemNumber` varchar(255) DEFAULT NULL,
  `saleDate` date NOT NULL,
  `payment` varchar(255) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `itemName` varchar(255) DEFAULT NULL,
  `discount` float DEFAULT '0',
  `quantity` int DEFAULT '0',
  `unitPrice` float DEFAULT '0',
  PRIMARY KEY (`saleID`)
) ENGINE=InnoDB AUTO_INCREMENT=2026130 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale`
--


--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `usertype` varchar(45) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT 'No email',
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Disabled',
  `sales` bigint DEFAULT '0',
  `sold` bigint DEFAULT '0',
  `mobile` varchar(255) DEFAULT 'N/A',
  `location` varchar(255) DEFAULT 'N/A',
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2020154 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES (2020153,'Admin','JGregg Felicisimo','admin','felicisimojv@gmail.com','21232f297a57a5a743894a0e4a801fc3','Active',0,0,'09917822877','N/A',NULL,NULL);

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor` (
  `vendorID` int NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `district` varchar(30) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vendorID`)
) ENGINE=InnoDB AUTO_INCREMENT=2027115 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` VALUES (2027104,'Makati Office Supplies','contact@makatiofficesupplies.ph','09171234567','88231234','123 Ayala Ave.',NULL,'Makati','Legazpi Village','active','2024-11-24 23:39:11'),(2027105,'City Office Depot','info@cityofficedepot.ph','09182233445','88244567','45 Paseo de Roxas',NULL,'Makati','Salcedo Village','active','2024-11-24 23:39:11'),(2027106,'Executive Office Needs','support@executiveoffice.ph','09183334456','88455678','678 Gil Puyat Ave.',NULL,'Makati','Bel-Air','active','2024-11-24 23:39:11'),(2027107,'Paper Supplies Central','sales@papersupplies.ph','09184455678','88333456','12 Jupiter St.',NULL,'Makati','Bel-Air','active','2024-11-24 23:39:11'),(2027108,'Premier Office Solutions','hello@premieroffice.ph','09185566789','88777890','456 Arnaiz Ave.',NULL,'Makati','San Lorenzo','active','2024-11-24 23:39:11'),(2027109,'ABC Stationery','abc@stationery.ph','09186677890','88999000','90 Makati Ave.',NULL,'Makati','Poblacion','active','2024-11-24 23:39:11'),(2027110,'Makati Business Center','info@makatibusiness.ph','09187788901','88111222','321 Chino Roces Ave.',NULL,'Makati','Bangkal','active','2024-11-24 23:39:11'),(2027111,'Pro Office Supplies','contact@proofficesupplies.ph','09188899012','88222334','8 Kalayaan Ave.',NULL,'Makati','Poblacion','active','2024-11-24 23:39:11'),(2027112,'Metro Office Depot','metro@officedepot.ph','09189900123','88333445','67 Yakal St.',NULL,'Makati','San Antonio','active','2024-11-24 23:39:11'),(2027113,'Reliable Office Goods','support@reliableoffice.ph','09190011234','88444556','34 Malugay St.',NULL,'Makati','San Antonio','active','2024-11-24 23:39:11');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
