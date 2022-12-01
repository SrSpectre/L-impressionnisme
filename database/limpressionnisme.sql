CREATE DATABASE  IF NOT EXISTS `limpressionnisme` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `limpressionnisme`;
-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: limpressionnisme
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `state` varchar(20) NOT NULL,
  `town` varchar(20) NOT NULL,
  `colony` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `zip_code` int NOT NULL,
  PRIMARY KEY (`id`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (2,6,'El estado de lluvia','Mi ciudad','Colonia de lluvia','Mi dirección #98765',97854);
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_cards`
--

DROP TABLE IF EXISTS `bank_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bank_cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `number` varchar(19) NOT NULL,
  `exp_date` varchar(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `cvv` int NOT NULL,
  PRIMARY KEY (`id`,`id_user`),
  UNIQUE KEY `number` (`number`),
  UNIQUE KEY `cvv` (`cvv`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_cards`
--

LOCK TABLES `bank_cards` WRITE;
/*!40000 ALTER TABLE `bank_cards` DISABLE KEYS */;
INSERT INTO `bank_cards` VALUES (1,6,'1234-5678-9101-1121','30/26','Lluvia Starry Night',123);
/*!40000 ALTER TABLE `bank_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS `histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `histories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_bank_card` int NOT NULL,
  `id_address` int NOT NULL,
  `total` int NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`id_user`,`id_bank_card`,`id_address`),
  KEY `id_user` (`id_user`),
  KEY `id_bank_card` (`id_bank_card`),
  KEY `id_address` (`id_address`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histories`
--

LOCK TABLES `histories` WRITE;
/*!40000 ALTER TABLE `histories` DISABLE KEYS */;
INSERT INTO `histories` VALUES (4,6,0,2,100,'2021-12-04 13:12:51'),(3,6,0,2,100,'2021-12-04 13:12:04');
/*!40000 ALTER TABLE `histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_items`
--

DROP TABLE IF EXISTS `history_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_history` int NOT NULL,
  `id_peinture` int NOT NULL,
  PRIMARY KEY (`id`,`id_history`,`id_peinture`),
  KEY `id_history` (`id_history`),
  KEY `id_peinture` (`id_peinture`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_items`
--

LOCK TABLES `history_items` WRITE;
/*!40000 ALTER TABLE `history_items` DISABLE KEYS */;
INSERT INTO `history_items` VALUES (7,3,8),(8,3,3),(9,3,5),(10,4,5),(11,4,7),(12,4,6),(13,4,1);
/*!40000 ALTER TABLE `history_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peintures`
--

DROP TABLE IF EXISTS `peintures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peintures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `painter` varchar(70) NOT NULL,
  `dimens` varchar(40) NOT NULL,
  `technique` varchar(40) NOT NULL,
  `year` int NOT NULL,
  `price` int NOT NULL,
  `details` varchar(200) NOT NULL,
  `stock` tinyint(1) NOT NULL DEFAULT '1',
  `img_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `details` (`details`),
  UNIQUE KEY `img_name` (`img_name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peintures`
--

LOCK TABLES `peintures` WRITE;
/*!40000 ALTER TABLE `peintures` DISABLE KEYS */;
INSERT INTO `peintures` VALUES (1,'The Pergola','Henri Martin','80 x 94.4 cm','Óleo sobre lienzo',1920,560000,'Compuesto minuciosamente con pequeños toques de color brillante, ilustra el dominio de la técnica neoimpresionista de Henri Martin, así como su predilección por los motivos clásicos.',1,'the_pergola.jpg'),(2,'Solei Levant','Claude Monet','63 x 48 cm','Óleo sobre lienzo',1872,960000,'Pintado aproximadamente en el año 1872, representa el puerto de Le Havre, ciudad en la que Monet pasó parte de la vida. La pintura fue robada del museo en 1985 y recuperada en 1990.',1,'solei_levant.jpg'),(3,'La Gare Saitn Lazare','Claude Monet','75 × 104 cm','Óleo sobre lienzo',1877,840000,'Es una serie de doce telas de la estación parisina de Saint-Lazare, realizadas por Claude Monet en 1877, cuando se interesó por vida moderna de su tiempo tras haberse dedicado a los paisajes rurales.',1,'la_gare_saint_lazare.jpg'),(4,'Boulevard Montmartre','Camille Pissarro','74 × 92.8 cm','Óleo sobre tela',1897,680000,'Pintado más de una vez, con las diferentes épocas del año. Esta escena pintada en primavera. Se trata de las vías más concurridas de París, sobre la que Pissarro demuestra una especial predilección.',1,'boulevard_montmartre.jpg'),(5,'The Seine at Giverny','Claude Monet','64.8 x 92.7 cm','Óleo sobre lienzo',1885,1200000,'Claude Monet pintó las 18 obras de su serie Mañanas en el Sena desde una barca de fondo plano anclada en la ribera donde el río Epte desemboca en el Sena.',1,'the_seine_at_giverny.jpg'),(6,'Banks of the Seine at Jenfosse','Claude Monet','59 x 81 cm','Óleo sobre lienzo',1884,1000000,'La enorme pila está transcrita con breves pinceladas de colores atardecer, al igual todo lo que se observa de cerca y lejos, hasta el sombrío horizonte de colinas violáceas visibles a través del Sena.',1,'banks_of_the_seine_at_jenfosse.jpg'),(7,'Femme à l`ombrelle','Claude Monet','100 x 81 cm','Óleo sobre tela',1875,850000,'Esta obra se da en el periodo en el que tanto él como su familia vivían en Argenteuil cerca del río Sena, algo muy propicio para un autor impresionista como Monet aficionado a retratar el agua.',1,'femme_a_lombrelle.jpg'),(8,'Sur La Terrasse','Pierre-Auguste Renoir','100.5 x 81 cm','Óleo sobre lienzo',1881,720000,'La obra retrata a Mlle Dartaud, actriz de la Comedie Française, acompañada de una niña sin identificar representando a su \"hermana\".',1,'sur_la_terrasse.jpg'),(9,'Paseo a Orillas del Mar','Joaquín Sorolla','205 x 200 cm','Óleo sobre lienzo',1909,2200000,'Este cuadro fue realizado en el verano de 1909 a la vuelta de la cuarta exposición internacional de Sorolla a comienzos de ese mismo año en varias ciudades de Estados Unidos.',1,'paseo_a_orillas_del_mar.jpg'),(10,'Starry Night','Vincent van Gogh','73.7 x 92.1 cm','Óleo sobre lienzo',1889,4500000,'Representa la vista desde la ventana orientada al este de su habitación de asilo en Saint-Rémy-de-Provence, justo antes del amanecer, con la adición de un pueblo imaginario.',1,'starry_night.jpg');
/*!40000 ALTER TABLE `peintures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pswd` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'ArtLover','Lluvia','Starry Night','art.night.11@gmail.com','1e16ae30fc23ad29a4efd7c15cb80219');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'limpressionnisme'
--

--
-- Dumping routines for database 'limpressionnisme'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-04  1:15:57
