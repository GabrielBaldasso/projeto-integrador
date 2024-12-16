-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: laris_salon
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `servicoprofissionais`
--

DROP TABLE IF EXISTS `servicoprofissionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicoprofissionais` (
  `idServicoProfissionais` int(11) NOT NULL AUTO_INCREMENT,
  `idProfissional` int(11) NOT NULL,
  `idServico` int(11) NOT NULL,
  `precoProfissional` decimal(8,2) NOT NULL,
  PRIMARY KEY (`idServicoProfissionais`),
  KEY `fk_servicoprofissionais_servicos` (`idServico`),
  KEY `fk_servicoprofissionais_profissional` (`idProfissional`),
  CONSTRAINT `fk_servicoprofissionais_profissional` FOREIGN KEY (`idProfissional`) REFERENCES `profissionais` (`idProfissional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicoprofissionais_servicos` FOREIGN KEY (`idServico`) REFERENCES `servicos` (`idServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicoprofissionais`
--

LOCK TABLES `servicoprofissionais` WRITE;
/*!40000 ALTER TABLE `servicoprofissionais` DISABLE KEYS */;
INSERT INTO `servicoprofissionais` VALUES (1,2,2,50.00),(2,1,1,100.00),(5,24,1,10.00),(6,25,3,20.00),(7,25,2,10.00),(8,24,5,30.00),(9,3,1,100.00);
/*!40000 ALTER TABLE `servicoprofissionais` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-09 16:58:24
