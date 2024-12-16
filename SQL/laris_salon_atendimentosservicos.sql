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
-- Table structure for table `atendimentosservicos`
--

DROP TABLE IF EXISTS `atendimentosservicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atendimentosservicos` (
  `idAtendimentoServico` int(11) NOT NULL AUTO_INCREMENT,
  `idAtendimento` int(11) NOT NULL,
  `precoServico` decimal(8,0) NOT NULL,
  `idServicoProfissionais` int(11) NOT NULL,
  `inicio` time DEFAULT NULL,
  `fim` time DEFAULT NULL,
  PRIMARY KEY (`idAtendimentoServico`),
  KEY `fk_atendimentosservicos_atendimetos_idx` (`idAtendimento`),
  KEY `fk_atendimentosservicos_servicoprofissionais` (`idServicoProfissionais`),
  CONSTRAINT `fk_atendimentosservicos_atendimetos` FOREIGN KEY (`idAtendimento`) REFERENCES `atendimentos` (`idAtendimento`),
  CONSTRAINT `fk_atendimentosservicos_servicoprofissionais` FOREIGN KEY (`idServicoProfissionais`) REFERENCES `servicoprofissionais` (`idservicoprofissionais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atendimentosservicos`
--

LOCK TABLES `atendimentosservicos` WRITE;
/*!40000 ALTER TABLE `atendimentosservicos` DISABLE KEYS */;
INSERT INTO `atendimentosservicos` VALUES (26,37,50,1,'18:56:00','20:26:00');
/*!40000 ALTER TABLE `atendimentosservicos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-09 16:58:25
