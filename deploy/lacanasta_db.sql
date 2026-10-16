
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
DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` VALUES (1,'Tigres del Sur','uploads/logos/equipo1.webp','2026-10-14 22:09:06'),(2,'Halcones Azules','uploads/logos/equipo2.webp','2026-10-14 22:09:06'),(3,'Aguilas Doradas','uploads/logos/equipo3.webp','2026-10-14 22:09:06'),(4,'Leones de la Cancha','uploads/logos/equipo4.webp','2026-10-14 22:09:06'),(5,'Los Angeles Lakers','uploads/logos/logo_6ad0414c5b202.jpg','2026-10-15 04:58:20'),(6,'Chicago Bulls','uploads/logos/logo_6ad05dde78806.webp','2026-10-15 07:00:14');
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jugador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jugador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fotografia` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_jugador_equipo_id` (`equipo_id`),
  CONSTRAINT `fk_jugador_equipo` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jugador` WRITE;
/*!40000 ALTER TABLE `jugador` DISABLE KEYS */;
INSERT INTO `jugador` VALUES (1,1,'Carlos','Gomez','1995-03-12','uploads/fotos/jugador1.jpg','2026-10-14 14:51:39'),(2,1,'Juan','Perez','1994-11-05','uploads/fotos/jugador3.jpg','2026-10-14 22:09:06'),(3,2,'Miguel','Ramirez','1997-01-18','uploads/fotos/jugador4.jpg','2026-10-14 22:09:06'),(4,2,'Jose','Hernandez','1995-09-30','uploads/fotos/jugador5.jpg','2026-10-14 22:09:06'),(5,2,'Pedro','Lopez','1996-04-14','uploads/fotos/jugador6.jpg','2026-10-14 22:09:06'),(6,3,'Andres','Sanchez','1998-02-25','uploads/fotos/jugador7.jpg','2026-10-14 22:09:06'),(7,3,'Fernando','Castillo','1994-08-09','uploads/fotos/jugador8.jpg','2026-10-14 22:09:06'),(8,3,'Ricardo','Vargas','1996-12-01','uploads/fotos/jugador9.jpg','2026-10-14 22:09:06'),(9,4,'Diego','Molina','1997-06-17','uploads/fotos/jugador10.jpg','2026-10-14 22:09:06'),(10,4,'Sergio','Ortega','1995-10-23','uploads/fotos/jugador11.jpg','2026-10-14 22:09:06'),(11,4,'Alberto','Flores','1996-05-08','uploads/fotos/jugador12.jpg','2026-10-14 22:09:06'),(12,5,'Pedro','Pascal','1994-09-10','uploads/fotos/foto_6ad045edd7b24.png','2026-10-15 05:18:05'),(13,6,'Nicolas ','Claxton','1996-09-05','uploads/fotos/foto_6ad05e1d6fc77.png','2026-10-15 07:01:17'),(14,6,'Rob','Dillingham','1995-04-02','uploads/fotos/foto_6ad05eb48269b.png','2026-10-15 07:03:48'),(15,6,'Patrick ','Williams','1996-03-16','uploads/fotos/foto_6ad05f0ddcc4a.png','2026-10-15 07:05:17'),(16,6,'Tre','Jones','1993-08-12','uploads/fotos/foto_6ad05fa455423.png','2026-10-15 07:07:48'),(17,6,'Norman','Powell','1996-06-17','uploads/fotos/foto_6ad060216e312.png','2026-10-15 07:09:53'),(18,5,'Luka','Doncic','1992-07-18','uploads/fotos/foto_6ad0623d16531.png','2026-10-15 07:18:53'),(19,5,'Sandro','Mamukelashvili','1990-10-04','uploads/fotos/foto_6ad0630c4a64e.png','2026-10-15 07:22:20'),(20,5,'Bronny','James','1987-11-11','uploads/fotos/foto_6ad06374765e8.png','2026-10-15 07:24:04'),(21,5,'Cameron','Carr','1993-08-25','uploads/fotos/foto_6ad063b336b80.png','2026-10-15 07:25:07'),(22,3,'Jason','Momoa','1985-11-21','uploads/fotos/foto_6ad06432e8702.jpg','2026-10-15 07:27:14'),(23,3,'Juan','Wgner','1994-05-30','uploads/fotos/foto_6ad064bf9c6cc.jpg','2026-10-15 07:29:35'),(24,2,'Mario','Dodorts','1993-11-10','uploads/fotos/foto_6ad0650d275ef.jpg','2026-10-15 07:30:53'),(25,2,'David','Jolls','1989-04-05','uploads/fotos/foto_6ad0655f42456.jpg','2026-10-15 07:32:15'),(26,4,'Dreick','Jhonson','1988-01-12','uploads/fotos/foto_6ad065ba4ca6e.jpg','2026-10-15 07:33:46'),(27,4,'Leo','Davidson','1996-09-18','uploads/fotos/foto_6ad066076dbf8.jpg','2026-10-15 07:35:03'),(28,1,'Walter','White','1974-03-08','uploads/fotos/foto_6ad066cbe28ed.jpg','2026-10-15 07:38:19'),(29,1,'Jessie','Pinkman','1992-02-05','uploads/fotos/foto_6ad067530f5af.jpg','2026-10-15 07:40:35'),(30,1,'Luis','Martinez','1996-07-22','uploads/fotos/jugador2.jpg','2026-10-14 14:51:56');
/*!40000 ALTER TABLE `jugador` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1792008546),('m240101_000000_create_equipo_table',1792008546),('m240101_000001_create_jugador_table',1792008546),('m240101_000002_create_tipo_tiro_table',1792008546),('m240101_000003_create_puntuacion_table',1792008546),('m240101_000004_seed_data',1792008546);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `puntuacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puntuacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jugador_id` int(11) NOT NULL,
  `jornada` int(11) NOT NULL,
  `tipo_tiro_id` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_puntuacion_jugador_id` (`jugador_id`),
  KEY `idx_puntuacion_tipo_tiro_id` (`tipo_tiro_id`),
  CONSTRAINT `fk_puntuacion_jugador` FOREIGN KEY (`jugador_id`) REFERENCES `jugador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_puntuacion_tipo_tiro` FOREIGN KEY (`tipo_tiro_id`) REFERENCES `tipo_tiro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `puntuacion` WRITE;
/*!40000 ALTER TABLE `puntuacion` DISABLE KEYS */;
INSERT INTO `puntuacion` VALUES (1,2,1,1,1,'2026-10-14 22:09:06'),(2,2,2,2,2,'2026-10-14 22:09:06'),(3,2,3,3,3,'2026-10-14 22:09:06'),(4,2,4,2,2,'2026-10-14 22:09:06'),(5,3,1,3,3,'2026-10-14 22:09:06'),(6,3,1,3,3,'2026-10-14 22:09:06'),(7,3,2,2,2,'2026-10-14 22:09:06'),(8,3,3,1,1,'2026-10-14 22:09:06'),(9,4,1,2,2,'2026-10-14 22:09:06'),(10,4,2,3,3,'2026-10-14 22:09:06'),(11,4,3,3,3,'2026-10-14 22:09:06'),(12,4,4,2,2,'2026-10-14 22:09:06'),(13,5,2,1,1,'2026-10-14 22:09:06'),(14,5,3,2,2,'2026-10-14 22:09:06'),(15,5,4,3,3,'2026-10-14 22:09:06'),(16,6,1,3,3,'2026-10-14 22:09:06'),(17,6,2,2,2,'2026-10-14 22:09:06'),(18,6,3,1,1,'2026-10-14 22:09:06'),(19,6,4,3,3,'2026-10-14 22:09:06'),(20,7,1,2,2,'2026-10-14 22:09:06'),(21,7,2,3,3,'2026-10-14 22:09:06'),(22,7,3,2,2,'2026-10-14 22:09:06'),(23,8,2,1,1,'2026-10-14 22:09:06'),(24,8,3,3,3,'2026-10-14 22:09:06'),(25,8,4,2,2,'2026-10-14 22:09:06'),(26,9,1,3,3,'2026-10-14 22:09:06'),(27,9,2,2,2,'2026-10-14 22:09:06'),(28,9,3,3,3,'2026-10-14 22:09:06'),(29,10,1,2,2,'2026-10-14 22:09:06'),(30,10,2,1,1,'2026-10-14 22:09:06'),(31,10,3,3,3,'2026-10-14 22:09:06'),(32,11,2,2,2,'2026-10-14 22:09:06'),(33,11,3,3,3,'2026-10-14 22:09:06'),(34,11,4,1,1,'2026-10-14 22:09:06'),(35,12,3,1,1,'2026-10-15 06:51:31'),(36,13,2,3,3,'2026-10-15 07:02:08'),(37,14,2,2,2,'2026-10-15 07:10:58'),(38,15,2,2,2,'2026-10-15 07:11:18'),(39,16,2,3,3,'2026-10-15 07:11:52'),(40,17,2,3,3,'2026-10-15 07:12:09'),(41,28,4,1,1,'2026-10-15 07:41:12'),(42,29,4,3,3,'2026-10-15 07:41:27'),(43,27,3,3,3,'2026-10-15 07:41:43'),(44,10,1,3,3,'2026-10-15 07:42:02'),(45,2,4,1,2,'2026-10-15 07:42:16'),(46,24,3,3,3,'2026-10-15 07:42:32'),(47,19,3,3,3,'2026-10-15 07:43:41'),(48,18,3,1,1,'2026-10-15 07:43:56'),(49,28,4,3,3,'2026-10-15 07:44:11'),(50,28,3,3,3,'2026-10-15 07:44:24'),(51,28,3,3,3,'2026-10-15 07:44:35'),(52,25,2,2,2,'2026-10-15 07:45:04'),(53,23,2,3,3,'2026-10-15 07:45:29'),(54,22,3,3,3,'2026-10-15 07:45:53'),(55,22,3,3,3,'2026-10-15 07:46:08'),(56,22,3,3,3,'2026-10-15 07:46:22'),(57,28,4,2,2,'2026-10-15 07:46:39'),(58,28,4,2,2,'2026-10-15 07:47:19'),(59,28,4,3,3,'2026-10-15 07:47:33'),(60,22,3,3,3,'2026-10-15 07:47:48'),(61,22,3,3,3,'2026-10-15 07:48:02'),(62,22,3,3,3,'2026-10-15 07:48:15'),(63,28,4,3,3,'2026-10-15 07:48:47'),(64,21,1,1,1,'2026-10-15 07:49:41'),(65,26,3,2,2,'2026-10-15 07:50:11'),(66,20,2,2,2,'2026-10-15 07:50:50'),(67,1,1,3,6,'2026-10-14 15:07:17'),(68,1,2,2,2,'2026-10-14 15:09:34'),(69,1,3,1,3,'2026-10-14 15:11:51'),(70,1,4,2,4,'2026-10-14 15:14:08'),(71,1,5,3,3,'2026-10-14 15:16:25'),(72,30,1,2,4,'2026-10-14 15:18:42'),(73,30,2,1,1,'2026-10-14 15:20:59'),(74,30,3,3,6,'2026-10-14 15:23:16'),(75,30,4,1,2,'2026-10-14 15:25:33'),(76,30,5,2,6,'2026-10-14 15:27:50'),(77,30,5,3,3,'2026-10-14 15:30:07');
/*!40000 ALTER TABLE `puntuacion` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tipo_tiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_tiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tipo_tiro` WRITE;
/*!40000 ALTER TABLE `tipo_tiro` DISABLE KEYS */;
INSERT INTO `tipo_tiro` VALUES (1,'Libre',1),(2,'Dos puntos',2),(3,'Tres puntos',3);
/*!40000 ALTER TABLE `tipo_tiro` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

