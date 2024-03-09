mysqldump: [Warning] Using a password on the command line interface can be insecure.
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: pediatra_sis
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `antecedentes`
--

DROP TABLE IF EXISTS `antecedentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `antecedentes` (
  `id_antecedentes` int NOT NULL,
  `Identificador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  PRIMARY KEY (`id_antecedentes`),
  KEY `Identificador` (`Identificador`(250)),
  KEY `FK_Antecedentes_Datos_Padres_de_Pacientes` (`Identificador`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antecedentes`
--

LOCK TABLES `antecedentes` WRITE;
/*!40000 ALTER TABLE `antecedentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `antecedentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificado_medico`
--

DROP TABLE IF EXISTS `certificado_medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificado_medico` (
  `id_certificado_M` int NOT NULL AUTO_INCREMENT,
  `id_medico` int DEFAULT NULL,
  `id_paciente` int DEFAULT NULL,
  `id_centro` int DEFAULT NULL,
  `diagnostico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Recomendacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_certificado_M`),
  KEY `FK_Certificado_Medico_Paciente` (`id_paciente`),
  KEY `FK_Certificado_Medico_Medicos` (`id_medico`),
  KEY `FK_Certificado_Medico_Institucion_de_Salud` (`id_centro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificado_medico`
--

LOCK TABLES `certificado_medico` WRITE;
/*!40000 ALTER TABLE `certificado_medico` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificado_medico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id_cita` int NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_cita`),
  KEY `FK_Citas_Paciente` (`id_paciente`),
  KEY `FK_Citas_Medicos` (`id_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultas` (
  `id_consulta` int NOT NULL,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `diagnostico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `tratamiento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_consulta`),
  KEY `FK_Consultas_Paciente` (`id_paciente`),
  KEY `FK_Consultas_Medicos` (`id_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_padres_de_pacientes`
--

DROP TABLE IF EXISTS `datos_padres_de_pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datos_padres_de_pacientes` (
  `Numidentificador` varchar(25) CHARACTER SET utf32 COLLATE utf32_spanish2_ci NOT NULL,
  `Tipo_Identificador` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Apellido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Parentesco` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Nacionalidad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Sexo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Ocupacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`Numidentificador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_padres_de_pacientes`
--

LOCK TABLES `datos_padres_de_pacientes` WRITE;
/*!40000 ALTER TABLE `datos_padres_de_pacientes` DISABLE KEYS */;
INSERT INTO `datos_padres_de_pacientes` VALUES ('1234567890','cédula','Juan','Pérez','Padre','Dominicana','Masculino','Calle 123','Ingeniero'),('A12345678','pasaporte','María','González','Madre','Dominicana','Femenino','Avenida 456','Doctora'),('9876543210',' cédula','Pedro','Sánchez','Padre','Paquistán ','Maculino','Carrera 789','Abogado'),('B87654321','pasaporte','Ana','López','Madre','Dominicana','Femenino','Calle Principal','Arquitecta'),('5432109876','cédula','Carlos','Rodríguez','Padre','Dominicana','Masculino','Avenida Central','Empresario'),('C76543210','pasaporte','Laura','Fernández','Madre','Dominicana','Femenino','Calle Secundaria','Enfermera'),('1111111111','cédula','Alejandro','Hernández','Padre','Dominicana','Masculino','Avenida 123','Profesor'),('D11111111','pasaporte','Sofía','Torres','Madre','Dominicana','Femenino','Carrera Principal','Psicóloga'),('2222222222','cédula','Luis','Gómez','Padre','Dominicana','Masculino','Calle 456','Contador'),('E22222222','pasaporte','Marta','Vargas','Madre','Dominicana','Femenino','Avenida Secundaria','Diseñadora'),('3333333333','cédula','Roberto','Ramírez','Padre','Dominicana','Masculino','Calle 789','Médico'),('F33333333','pasaporte','Lucía','Morales','Madre','Dominicana','Femenino','Avenida Principal','Ingeniera'),('4444444444','cédula','Javier','Castro','Padre','Dominicana','Masculino','Carrera 123','Abogado'),('G44444444','pasaporte','Fernanda','Ortega','Madre','Dominicana','Femenino','Calle Central','Empresaria'),('5555555555','cédula','Ricardo','Cruz','Padre','Dominicana','Masculino','Avenida Secundaria','Ingeniero'),('H55555555','pasaporte','Isabel','Navarro','Madre','Dominicana','Femenino','Carrera Secundaria','Arquitecta'),('6666666666','cédula','Gabriel','Pacheco','Padre','Dominicana','Masculino','Calle Principal','Empresario'),('I66666666',' pasaporte','Valentina','Rojas','Madre','Países Bajos ','Femenino','Avenida 123','Médica'),('777-7777777-8',' Cédula','Andrés Alberto','Mendoza','Padre','República Dominicana ','Masculino','Carrera 456','Ingeniero'),('J77777777','pasaporte','Paula Maria','Peña','Madre','España','Femenino','Calle 789','Arquitecta'),('111-1111111-1','Cédula','Joel','Rosario','Padre','DO','Maculino','Guaco, La Vega, Rep. Dominicana','profesor'),('047-0170172-5','Cédula','Joel','Rosario','Padre','DO','Maculino','Guaco, La Vega, Rep. Dominicana','profesor');
/*!40000 ALTER TABLE `datos_padres_de_pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_antecedentes`
--

DROP TABLE IF EXISTS `detalle_antecedentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_antecedentes` (
  `IDdetalle_ant` int NOT NULL AUTO_INCREMENT,
  `ID_antecedentes` int DEFAULT NULL,
  `id_padecimiento` int DEFAULT NULL,
  PRIMARY KEY (`IDdetalle_ant`),
  KEY `FK_Detalle_Antecedentes_Antecedentes` (`ID_antecedentes`),
  KEY `FK_Detalle_Antecedentes_Padecimientos_Comunes` (`id_padecimiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_antecedentes`
--

LOCK TABLES `detalle_antecedentes` WRITE;
/*!40000 ALTER TABLE `detalle_antecedentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_antecedentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_consulta`
--

DROP TABLE IF EXISTS `detalle_consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_consulta` (
  `id_detalle_consulta` int NOT NULL AUTO_INCREMENT,
  `ID_Consulta` int DEFAULT NULL,
  `id_trabajo_medico` int DEFAULT NULL,
  `Observacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_detalle_consulta`),
  KEY `FK_Detalle_Consulta_Consultas` (`ID_Consulta`),
  KEY `FK_Detalle_Consulta_Trabajos_Medicos` (`id_trabajo_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_consulta`
--

LOCK TABLES `detalle_consulta` WRITE;
/*!40000 ALTER TABLE `detalle_consulta` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_consulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_historia_clinica`
--

DROP TABLE IF EXISTS `detalle_historia_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_historia_clinica` (
  `IDdetalle_HC` int NOT NULL AUTO_INCREMENT,
  `ID_Hist_Clic` int DEFAULT NULL,
  `id_padecimiento` int DEFAULT NULL,
  `notas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `desde_cuando` date NOT NULL,
  PRIMARY KEY (`IDdetalle_HC`),
  KEY `FK_Detalle_Historia_Clinica_Historia_Clinica` (`ID_Hist_Clic`),
  KEY `FK_Detalle_Historia_Clinica_Padecimientos_Comunes` (`id_padecimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_historia_clinica`
--

LOCK TABLES `detalle_historia_clinica` WRITE;
/*!40000 ALTER TABLE `detalle_historia_clinica` DISABLE KEYS */;
INSERT INTO `detalle_historia_clinica` VALUES (1,1,3,'SSDSDS','2023-07-13'),(2,2,6,'hola','2023-07-11'),(3,2,9,'SASD','2023-07-09'),(4,3,3,'AASAsas','2023-07-11'),(5,3,11,'MODF','2023-06-29'),(6,4,3,'AASAsas','2023-07-12'),(7,5,7,'ssss','2023-07-05'),(8,6,3,'SASD','2023-07-18'),(9,7,4,'AASAsas','2023-07-13'),(10,8,3,'AASAsas','2023-07-20'),(11,9,3,'MODIF','2023-07-19'),(12,10,NULL,'2023-12-22','0000-00-00'),(13,11,NULL,'2023-12-22','0000-00-00'),(14,12,NULL,'2023-12-22','0000-00-00'),(15,13,NULL,'2023-12-22','0000-00-00'),(16,14,NULL,'2023-12-22','0000-00-00'),(17,15,NULL,'2023-12-22','0000-00-00'),(18,16,NULL,'2023-12-22','0000-00-00'),(19,17,NULL,'2023-12-22','0000-00-00'),(20,18,3,'AASAsas','2023-12-15'),(21,19,5,'HOLA PRUEBA','2023-12-22'),(22,20,7,'MODIF','2023-12-22'),(23,21,7,'MODIF','2023-12-22'),(24,22,9,'MODIF','2023-12-22'),(25,23,7,'hola','2023-12-20'),(26,24,9,'MODIF','2023-12-22'),(27,25,5,'AASAsas','2023-12-22'),(28,26,7,'MODIF','2023-12-22'),(29,27,5,'hola','2023-12-22'),(30,28,4,'hola','2023-12-22'),(31,29,3,'AASAsas','2023-12-22');
/*!40000 ALTER TABLE `detalle_historia_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_prescripcion`
--

DROP TABLE IF EXISTS `detalle_prescripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_prescripcion` (
  `ID_det_receta` int NOT NULL,
  `id_receta` int DEFAULT NULL,
  `id_medicamento` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `unidad_de_medida` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `frecuencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Tiempo_de_uso` int DEFAULT NULL,
  PRIMARY KEY (`ID_det_receta`),
  KEY `FK_Detalle_Prescripcion_Prescripcion_Medica` (`id_receta`),
  KEY `FK_Detalle_Prescripcion_Medicamento` (`id_medicamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_prescripcion`
--

LOCK TABLES `detalle_prescripcion` WRITE;
/*!40000 ALTER TABLE `detalle_prescripcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_prescripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `especialidad` (
  `id_especialidad` int NOT NULL,
  `especialidad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad`
--

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT INTO `especialidad` VALUES (1,'Cardiología'),(2,'Dermatología'),(3,'Endocrinología'),(4,'Gastroenterología'),(5,'Hematología'),(6,'Infectología'),(7,'Nefrología'),(8,'Neumología'),(9,'Oftalmología'),(10,'Oncología'),(11,'Ortopedia'),(12,'Otorrinolaringología'),(13,'Pediatría'),(14,'Psiquiatría'),(15,'Reumatología'),(16,'Traumatología'),(17,'Urología'),(18,'Ginecología'),(19,'Neurología'),(20,'Cirugía');
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_nutricional`
--

DROP TABLE IF EXISTS `estado_nutricional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_nutricional` (
  `id_EN` int NOT NULL,
  `id_consulta` int DEFAULT NULL,
  `Estatura` int DEFAULT NULL,
  `Edad` int DEFAULT NULL,
  `peso` int DEFAULT NULL,
  `Estado_nutricional` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_EN`),
  KEY `FK_Estado_nutricional_Consultas` (`id_consulta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_nutricional`
--

LOCK TABLES `estado_nutricional` WRITE;
/*!40000 ALTER TABLE `estado_nutricional` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado_nutricional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia_clinica`
--

DROP TABLE IF EXISTS `historia_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historia_clinica` (
  `ID_Hist_Clic` int NOT NULL AUTO_INCREMENT,
  `ID_Paciente` int DEFAULT NULL,
  PRIMARY KEY (`ID_Hist_Clic`),
  KEY `ID_Paciente` (`ID_Paciente`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia_clinica`
--

LOCK TABLES `historia_clinica` WRITE;
/*!40000 ALTER TABLE `historia_clinica` DISABLE KEYS */;
INSERT INTO `historia_clinica` VALUES (1,5),(2,6),(3,7),(4,8),(5,9),(6,11),(7,14),(8,16),(9,19),(10,10),(11,10),(12,10),(13,10),(14,10),(15,10),(16,10),(17,10),(18,10),(19,10),(20,11),(21,11),(22,11),(23,10),(24,10),(25,19),(26,5),(27,3),(28,5),(29,2);
/*!40000 ALTER TABLE `historia_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario` (
  `id_horario` int NOT NULL,
  `id_medico` int DEFAULT NULL,
  `dias` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `etiqueta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `Estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_horario`),
  KEY `FK_Horario_Medicos` (`id_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institucion_de_salud`
--

DROP TABLE IF EXISTS `institucion_de_salud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `institucion_de_salud` (
  `id_centro` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `telefono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_centro`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institucion_de_salud`
--

LOCK TABLES `institucion_de_salud` WRITE;
/*!40000 ALTER TABLE `institucion_de_salud` DISABLE KEYS */;
INSERT INTO `institucion_de_salud` VALUES (1,'Hospital A','Dirección A','123-456-7890'),(2,'Clínica B','Dirección B','234-567-8901'),(3,'Centro Médico C','Dirección C','345-678-9012'),(4,'Hospital D','Dirección D','456-789-0123'),(5,'Clínica E','Dirección E','567-890-1234'),(6,'Centro Médico F','Dirección F','678-901-2345'),(7,'Hospital G','Dirección G','789-012-3456'),(8,'Clínica H','Dirección H','890-123-4567'),(9,'Centro Médico I','Dirección I','901-234-5678'),(10,'Hospital J','Dirección J','012-345-6789');
/*!40000 ALTER TABLE `institucion_de_salud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laboratorio` (
  `id_laboratorio` int NOT NULL,
  `nombre_laboratorio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Telefono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio`
--

LOCK TABLES `laboratorio` WRITE;
/*!40000 ALTER TABLE `laboratorio` DISABLE KEYS */;
INSERT INTO `laboratorio` VALUES (1,'Laboratorio Aeiu ','Calle 123','1234567890','laboratorioa@example.com'),(2,'Laboratorio B','Avenida 456','0987654321','laboratoriob@example.com'),(3,'Laboratorio C','Carrera 789','1111111111','laboratorioc@example.com'),(4,'Laboratorio D','Calle Principal','2222222222','laboratoriod@example.com'),(5,'Laboratorio E','Avenida Central','3333333333','laboratorioe@example.com'),(6,'Laboratorio F','Calle Secundaria','4444444444','laboratoriof@example.com'),(7,'Laboratorio G','Avenida 123','5555555555','laboratoriog@example.com'),(8,'Laboratorio H','Carrera Principal','6666666666','laboratorioh@example.com'),(9,'Laboratorio I','Calle 456','7777777777','laboratorioi@example.com'),(10,'Laboratorio J','Avenida Secundaria','8888888888','laboratorioj@example.com'),(11,'Laboratorio K','Calle 789','9999999999','laboratoriok@example.com'),(12,'Laboratorio L','Avenida Principal','0000000000','laboratoriol@example.com'),(13,'Laboratorio M','Carrera 123','1212121212','laboratoriom@example.com'),(14,'Laboratorio N','Calle Central','2323232323','laboratorion@example.com'),(15,'Laboratorio O','Avenida Secundaria','3434343434','laboratorioo@example.com'),(16,'Laboratorio P','Carrera Secundaria','4545454545','laboratoriop@example.com'),(17,'Laboratorio Q','Calle Principal','5656565656','laboratorioq@example.com'),(18,'Laboratorio R','Avenida 123','6767676767','laboratorior@example.com'),(19,'Laboratorio S','Carrera 456','7878787878','laboratorios@example.com'),(20,'Laboratorio T','Calle 789','8989898989','laboratoriot@example.com'),(21,'Guaco Plus','Guaco, La Vega, Rep. Dominicana','+18095736545','joelenrosario@gmail.com'),(22,'Lab Unidos','Pueblo Viejo','8096976797','labunidos3268@gmail.com');
/*!40000 ALTER TABLE `laboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localizador_medico`
--

DROP TABLE IF EXISTS `localizador_medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `localizador_medico` (
  `ID_Localizador_M` int NOT NULL,
  `id_medico` int DEFAULT NULL,
  `Valor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Etiqueta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`ID_Localizador_M`),
  KEY `FK_Localizador_Medico_Medicos` (`id_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localizador_medico`
--

LOCK TABLES `localizador_medico` WRITE;
/*!40000 ALTER TABLE `localizador_medico` DISABLE KEYS */;
/*!40000 ALTER TABLE `localizador_medico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localizador_padres_de_pacientes`
--

DROP TABLE IF EXISTS `localizador_padres_de_pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `localizador_padres_de_pacientes` (
  `ID_Localizador` int NOT NULL,
  `Identificador` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Valor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Etiqueta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Localizador`),
  UNIQUE KEY `UK_Numidentificador` (`Identificador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localizador_padres_de_pacientes`
--

LOCK TABLES `localizador_padres_de_pacientes` WRITE;
/*!40000 ALTER TABLE `localizador_padres_de_pacientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `localizador_padres_de_pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamento` (
  `Id_medicamento` int NOT NULL,
  `nombre_medicamento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `formato` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Cantidad_total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`Id_medicamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamento`
--

LOCK TABLES `medicamento` WRITE;
/*!40000 ALTER TABLE `medicamento` DISABLE KEYS */;
INSERT INTO `medicamento` VALUES (0,'Paracetamol','Analgésico y antifebril','Tableta','100'),(1,'Paracetamol','Analgésico y antifebril','Tableta','100'),(2,'Ibuprofeno','Antiinflamatorio no esteroideo','Cápsulas','75'),(3,'Amoxicilina','Antibiótico','Suspensión Oral','50'),(4,'Omeprazol','Inhibidor de la bomba de protones','Tabletas','60'),(5,'Loratadina','Antihistamínico','Tabletas','80'),(6,'Aspirina','Antiinflamatorio y analgésico','Tabletas','120'),(7,'Diazepam','Ansiolítico y relajante muscular','Tabletas','30'),(8,'Cetirizina','Antihistamínico','Tabletas','70'),(9,'Metformina','Antidiabético oral','Tabletas','90'),(10,'Atorvastatina','Estatina para reducir el colesterol','Tabletas','40'),(11,'Amlodipino','Bloqueador de canales de calcio','Tabletas','55'),(12,'Warfarina','Anticoagulante','Tabletas','25'),(13,'Furosemida','Diurético de asa','Tabletas','65'),(14,'Losartán','Bloqueador del receptor de angiotensina II','Tabletas','85'),(15,'Simvastatina','Estatina para reducir el colesterol','Tabletas','110'),(16,'Ciprofloxacino','Antibiótico','Tabletas','45'),(17,'Doxiciclina','Antibiótico','Cápsulas','30'),(18,'Tramadol','Analgésico opioide','Tabletas','40'),(19,'Morfina','Analgésico opioide','Solución inyectable','15'),(20,'Insulina','Hormona para controlar la glucosa','Frasco','25'),(21,'Uniplus','Desparasitante/Nisotadina','Suspensión Oral','100'),(24,'Givotan','Desparasitante/Nisotadina','Comprimido','100 ml'),(25,'Minamino Sport','Multivitamínico','Jarabe','350 ml'),(26,'Paracetamol','Multivitamínico','Comprimido','100 gr'),(27,'Paracetamolssss','Multivitamínico','Comprimido','350 ml');
/*!40000 ALTER TABLE `medicamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicos` (
  `id_medico` int NOT NULL,
  `cedula` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `exequatur` int DEFAULT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `apellido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `id_especialidad` int DEFAULT NULL,
  PRIMARY KEY (`id_medico`),
  KEY `FK_Medicos_Especialidad` (`id_especialidad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES (1,'1234567890',12345,'Juan','Pérez',1),(2,'0987654321',54321,'María','González',2),(3,'1111111111',98765,'Pedro','Sánchez',3),(4,'2222222222',67890,'Ana','López',4),(5,'3333333333',13579,'Carlos','Rodríguez',5),(6,'4444444444',24680,'Laura','Fernández',6),(7,'5555555555',54321,'Alejandro','Hernández',7),(8,'6666666666',98765,'Sofía','Torres',8),(9,'7777777777',67890,'Luis','Gómez',9),(10,'8888888888',13579,'Marta','Vargas',10),(11,'9999999999',24680,'Roberto','Ramírez',11),(12,'0000000000',54321,'Lucía','Morales',12),(13,'1212121212',98765,'Javier','Castro',13),(14,'2323232323',67890,'Fernanda','Ortega',14),(15,'3434343434',13579,'Ricardo','Cruz',15),(16,'4545454545',24680,'Isabel','Navarro',16),(17,'5656565656',54321,'Gabriel','Pacheco',17),(18,'6767676767',98765,'Valentina','Rojas',18),(19,'7878787878',67890,'Andrés','Mendoza',19),(20,'8989898989',13579,'Paula','Peña',20),(21,'047-0174904-8',554659,'Luis Manuel ','Sánchez ',1);
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nino_padre`
--

DROP TABLE IF EXISTS `nino_padre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nino_padre` (
  `ID_Relacion` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `ID_Padre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Tipo_Padre` enum('Padre','Madre','Tutor Legal') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`ID_Relacion`),
  KEY `id_paciente` (`id_paciente`),
  KEY `ID_Padre` (`ID_Padre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nino_padre`
--

LOCK TABLES `nino_padre` WRITE;
/*!40000 ALTER TABLE `nino_padre` DISABLE KEYS */;
/*!40000 ALTER TABLE `nino_padre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `id_paciente` int NOT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `apellido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `sexo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `fecha_nacimiento` date DEFAULT NULL,
  `Nacionalidad` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Con_quien_vive` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Direccion_reside` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_paciente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (1,'ADASDAS','SADASD','masculino','2023-07-13','DO','padre_madre','SAADADASDS'),(2,'','','','0000-00-00','','',''),(3,'','','','0000-00-00','','',''),(4,'','','','0000-00-00','','',''),(5,'amauris','Valdez','masculino','2023-07-12','DO','padre_madre','SDDS'),(6,'Joel Enmanuel','Rosario','masculino','2023-07-11','DO','padre_madre','alla mismo'),(7,'JoseR','Valdez Rodríguez ','masculino','2023-06-28','DO','padre_madre','wweeee'),(8,'Jose Rosa','Almanzar','masculino','2023-07-06','DO','padre_madre','rewwrwerr'),(9,'amauris','Almanzar','masculino','2023-07-19','DO','padre','saadadadas'),(10,'Array','Array','masculino','0000-00-00','Array','Array','Array'),(11,'Array','Array','masculino','0000-00-00','Array','Array','Array'),(12,'maria','Rosario','masculino','2023-07-11','DO','padre_madre','fdsdfsfsf'),(13,'amauris','Rosario','masculino','2023-07-11','DO','padre_madre','fdsdfsfsf'),(14,'JoseR','Valdez Rodríguez ','masculino','2023-07-06','DO','padre_madre','fdsdfsfsf'),(15,'maria','Rosario','masculino','2023-07-11','DO','padre_madre','fdsdfsfsf'),(16,'Admin','Rosario','masculino','2023-07-12','DO','padre_madre','fdsdfsfsf'),(17,'sdsdsd','asdds','femenino','2023-07-13','DO','padre_madre','sasasdd'),(18,'amauris','Rosario','femenino','2023-07-05','DO','padre_madre','fdsdfsfsf'),(19,'amauris','Rosario','femenino','2023-07-05','DO','padre_madre','fdsdfsfsf'),(20,'Aracelis','De Leon','femenino','2023-08-12','DO','padre_madre','fdsdfsfsf'),(21,'','','','0000-00-00','','',''),(22,'','','','0000-00-00','','',''),(23,'','','','0000-00-00','','',''),(24,'','','','0000-00-00','','','');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente_analitica`
--

DROP TABLE IF EXISTS `paciente_analitica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente_analitica` (
  `id_estudio_analitica` int NOT NULL,
  `id_laboratorio` int DEFAULT NULL,
  `nombre_estudio_analitica` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_consulta` int DEFAULT NULL,
  `id_centro` int DEFAULT NULL,
  PRIMARY KEY (`id_estudio_analitica`),
  KEY `FK_Paciente_Analitica_Laboratorio` (`id_laboratorio`),
  KEY `FK_Paciente_Analitica_Consultas` (`id_consulta`),
  KEY `FK_Paciente_Analitica_Institucion_de_Salud` (`id_centro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente_analitica`
--

LOCK TABLES `paciente_analitica` WRITE;
/*!40000 ALTER TABLE `paciente_analitica` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_analitica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes_vacunas`
--

DROP TABLE IF EXISTS `pacientes_vacunas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes_vacunas` (
  `id_vacuna_p` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `id_vacuna` int DEFAULT NULL,
  `dosis` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `refuerzo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `FECHA_APLICACION` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id_vacuna_p`),
  KEY `FK_Pacientes_Vacunas_Paciente` (`id_paciente`),
  KEY `FK_Pacientes_Vacunas_Tipo_Vacunas` (`id_vacuna`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes_vacunas`
--

LOCK TABLES `pacientes_vacunas` WRITE;
/*!40000 ALTER TABLE `pacientes_vacunas` DISABLE KEYS */;
INSERT INTO `pacientes_vacunas` VALUES (1,6,0,'1era','NA',''),(2,6,0,'2da','NA',''),(3,7,0,'3ra','NA',''),(4,7,0,'1era','NA',''),(5,8,7,'8va','1er','2023-07-12'),(6,9,3,'2da','NA','fecha_no_provista'),(7,11,7,'1era','1er','fecha_no_provista'),(8,16,1,'1era','1er','2023-07-20'),(9,19,3,'1era','1er','2023-07-07'),(10,8,5,'4ta','1er','2023-12-14');
/*!40000 ALTER TABLE `pacientes_vacunas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `padecimientos_comunes`
--

DROP TABLE IF EXISTS `padecimientos_comunes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `padecimientos_comunes` (
  `id_padecimiento` int NOT NULL AUTO_INCREMENT,
  `nombre_padecimiento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_padecimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `padecimientos_comunes`
--

LOCK TABLES `padecimientos_comunes` WRITE;
/*!40000 ALTER TABLE `padecimientos_comunes` DISABLE KEYS */;
INSERT INTO `padecimientos_comunes` VALUES (3,'Bronquitis aguda','Inflamación de los bronquios, generalmente causada por una infección viral o bacteriana.'),(4,'Asma','Enfermedad crónica de las vías respiratorias que causa dificultad para respirar y sibilancias.'),(5,'Hipertensión arterial','Aumento persistente de la presión arterial en las arterias.'),(6,'Diabetes tipo 2','Trastorno crónico que afecta la forma en que el cuerpo regula el azúcar en la sangre.'),(7,'Dolor de cabeza tensional','Cefalea caracterizada por una sensación de tensión o presión en la cabeza.'),(8,'Dolor de espalda','Malestar o dolor en la región de la espalda.'),(9,'Gastritis','Inflamación del revestimiento del estómago, generalmente causada por infección o irritación.'),(10,'Úlcera péptica','Lesión abierta en la mucosa del estómago o del duodeno.'),(11,'Alergia a la penicilina','Respuesta exagerada del sistema inmunológico a una sustancia extraña o alérgeno.'),(12,'Sinusitis','Inflamación de los senos paranasales, generalmente causada por una infección bacteriana o viral.'),(13,'Infección urinaria','Infección en cualquier parte del sistema urinario, como la vejiga o los riñones.'),(14,'Acidez estomacal','Sensación de ardor en la parte inferior del pecho, causada por el reflujo del ácido del estómago.'),(16,'Enfermedad de Huntington','Trastorno neurológico hereditario que afecta el movimiento y las funciones cognitivas.'),(17,'Distrofia muscular de Duchenne','Enfermedad genética que causa debilidad muscular progresiva y afecta principalmente a los niños.'),(18,'Fibrosis quística','Enfermedad genética que afecta principalmente los pulmones y el sistema digestivo.'),(19,'Hemofilia','Trastorno de la coagulación de la sangre causado por un defecto genético en los genes de la coagulación.'),(20,'Síndrome de Marfan','Trastorno genético del tejido conectivo que afecta el corazón, los ojos y los vasos sanguíneos.'),(21,'Enfermedad de Gaucher','Trastorno genético que afecta la función del sistema linfático y puede causar agrandamiento del hígado y el bazo.'),(22,'Enfermedad de Wilson','Trastorno genético del metabolismo del cobre que causa acumulación de cobre en varios órganos.'),(23,'Síndrome de Lynch','Trastorno hereditario que aumenta el riesgo de desarrollar cáncer de colon y otros cánceres relacionados.'),(24,'Síndrome de Turner','Trastorno genético que afecta el desarrollo sexual en las mujeres y está asociado con características físicas distintivas.'),(25,'Síndrome de Down','Trisomía del cromosoma 21 que causa discapacidad intelectual y características físicas características.'),(26,'Colesterol alto','Condición en la cual los niveles de colesterol en la sangre están elevados, aumentando el riesgo de enfermedad cardiovascular.'),(27,'Hipertensión arterial','Aumento persistente de la presión arterial en las arterias.'),(28,'Problemas de tiroides','Trastornos que afectan la glándula tiroides y pueden causar problemas de funcionamiento en el cuerpo.'),(29,'Epilepsia','Trastorno neurológico crónico caracterizado por convulsiones recurrentes debido a la actividad anormal del cerebro.');
/*!40000 ALTER TABLE `padecimientos_comunes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perinatal`
--

DROP TABLE IF EXISTS `perinatal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perinatal` (
  `id_perinatal` int NOT NULL,
  `Identificador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Lugar_parto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `peso_nacer` int DEFAULT NULL,
  `id_padecimiento` int DEFAULT NULL,
  PRIMARY KEY (`id_perinatal`),
  KEY `FK_Perinatal_Datos_Padres_de_Pacientes` (`Identificador`(250)),
  KEY `FK_Perinatal_Padecimientos_Comunes` (`id_padecimiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perinatal`
--

LOCK TABLES `perinatal` WRITE;
/*!40000 ALTER TABLE `perinatal` DISABLE KEYS */;
/*!40000 ALTER TABLE `perinatal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescripcion_medica`
--

DROP TABLE IF EXISTS `prescripcion_medica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prescripcion_medica` (
  `id_receta` int NOT NULL AUTO_INCREMENT,
  `id_consulta` int DEFAULT NULL,
  `id_centro` int DEFAULT NULL,
  PRIMARY KEY (`id_receta`),
  KEY `FK_Prescripcion_Medica_Consultas` (`id_consulta`),
  KEY `FK_Prescripcion_Medica_Institucion_de_Salud` (`id_centro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescripcion_medica`
--

LOCK TABLES `prescripcion_medica` WRITE;
/*!40000 ALTER TABLE `prescripcion_medica` DISABLE KEYS */;
/*!40000 ALTER TABLE `prescripcion_medica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referimientos`
--

DROP TABLE IF EXISTS `referimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referimientos` (
  `ID_Referimiento` int NOT NULL,
  `id_consulta` int DEFAULT NULL,
  `medico_referido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Fecha_Referimiento` date DEFAULT NULL,
  `Motivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `id_centro` int DEFAULT NULL,
  PRIMARY KEY (`ID_Referimiento`),
  KEY `FK_Referimientos_Consultas` (`id_consulta`),
  KEY `FK_Referimientos_Institucion_de_Salud` (`id_centro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referimientos`
--

LOCK TABLES `referimientos` WRITE;
/*!40000 ALTER TABLE `referimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `referimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguro`
--

DROP TABLE IF EXISTS `seguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguro` (
  `Id_seguro_salud` int NOT NULL,
  `Nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`Id_seguro_salud`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguro`
--

LOCK TABLES `seguro` WRITE;
/*!40000 ALTER TABLE `seguro` DISABLE KEYS */;
INSERT INTO `seguro` VALUES (1,'ARS Universal'),(2,'ARS Palic'),(3,'ARS Humano'),(4,'ARS Senasa'),(5,'ARS Mapfre Salud'),(6,'ARS Monumental'),(7,'ARS Renacer'),(8,'ARS Meta Salud'),(9,'ARS Futuro'),(10,'ARS Semma'),(11,'Ars Banreservas'),(12,'Ars Prueba Prueba');
/*!40000 ALTER TABLE `seguro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguro_paciente`
--

DROP TABLE IF EXISTS `seguro_paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguro_paciente` (
  `NSS` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `id_paciente` int DEFAULT NULL,
  `Id_seguro_salud` int DEFAULT NULL,
  KEY `FK_Seguro_Paciente_Paciente` (`id_paciente`),
  KEY `FK_Seguro_Paciente_Seguro` (`Id_seguro_salud`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguro_paciente`
--

LOCK TABLES `seguro_paciente` WRITE;
/*!40000 ALTER TABLE `seguro_paciente` DISABLE KEYS */;
INSERT INTO `seguro_paciente` VALUES ('',3,0),('',2,0),('2587272728',1,2),('',4,0),('g988987989',5,10),('889895269',6,4),('872698855',7,2),('54556888',8,3),('5555888',9,10),('Array',10,0),('Array',11,0),('5689898',12,3),('1',13,10),('5689898',14,2),('5689898',15,2),('5689898',16,2),('5689898',17,10),('5689898',18,4),('5689898',19,4),('5689898',20,2),('',21,0),('',22,0),('',23,0),('',24,0);
/*!40000 ALTER TABLE `seguro_paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_vacunas`
--

DROP TABLE IF EXISTS `tipo_vacunas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_vacunas` (
  `id_vacuna` int NOT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `total_dosis` int DEFAULT NULL,
  PRIMARY KEY (`id_vacuna`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_vacunas`
--

LOCK TABLES `tipo_vacunas` WRITE;
/*!40000 ALTER TABLE `tipo_vacunas` DISABLE KEYS */;
INSERT INTO `tipo_vacunas` VALUES (1,'BCG','La vacuna BCG* protege contra la tuberculosis y se administra en una sola dosis.',1),(2,'Hepatitis B','La vacuna contra la hepatitis B previene la infección por el virus de la hepatitis B. Se administra en múltiples dosis según el esquema recomendado.',3),(3,'DTP','La vacuna DTP protege contra la difteria, el tétanos y la tos ferina. Se administra en múltiples dosis según el esquema recomendado.',5),(4,'Polio','La vacuna contra la poliomielitis protege contra la polio. Se administra en múltiples dosis según el esquema recomendado.',4),(5,'Hib','La vacuna Hib protege contra Haemophilus influenzae tipo b, una bacteria que puede causar enfermedades graves en los niños. Se administra en múltiples dosis según el esquema recomendado.',3),(6,'Neumococo','La vacuna contra el neumococo protege contra Streptococcus pneumoniae, una bacteria que puede causar enfermedades como la neumonía y la meningitis. Se administra en múltiples dosis según el esquema recomendado.',4),(7,'Rotavirus','La vacuna contra el rotavirus protege contra una infección viral que puede causar diarrea grave en los niños. Se administra en múltiples dosis según el esquema recomendado.',2),(8,'Sarampión, Paperas, Rubéola (MMR)','La vacuna MMR protege contra el sarampión, las paperas y la rubéola. Se administra en múltiples dosis según el esquema recomendado.',2),(9,'Varicela','La vacuna contra la varicela protege contra el virus de la varicela-zóster, que causa la varicela. Se administra en múltiples dosis según el esquema recomendado.',2),(10,'Hepatitis A','La vacuna contra la hepatitis A previene la infección por el virus de la hepatitis A. Se administra en múltiples dosis según el esquema recomendado.',2),(11,'Influenza','vacuna del 2023',1);
/*!40000 ALTER TABLE `tipo_vacunas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabajos_medicos`
--

DROP TABLE IF EXISTS `trabajos_medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabajos_medicos` (
  `id_trabajo_medico` int NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `descripcion_trabajo_medico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_trabajo_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajos_medicos`
--

LOCK TABLES `trabajos_medicos` WRITE;
/*!40000 ALTER TABLE `trabajos_medicos` DISABLE KEYS */;
INSERT INTO `trabajos_medicos` VALUES (1,'2023-12-26','Consulta de rutina'),(2,'2023-12-25','Control de vacunas'),(3,'2023-12-24','Evaluación del desarrollo infantil'),(4,'2023-12-23','Tratamiento de infección respiratoria'),(5,'2023-12-22','Atención de fiebre'),(6,'2023-12-21','Seguimiento de enfermedad crónica'),(7,'2023-12-20','Diagnóstico y tratamiento de enfermedades gastrointestinales'),(8,'2023-12-19','Valoración de alergias'),(9,'2023-12-18','Atención de dolor abdominal'),(10,'2023-12-17','Evaluación de erupciones cutáneas'),(11,'2023-12-16','Control de asma'),(12,'2023-12-15','Atención de problemas de sueño'),(13,'2023-12-14','Diagnóstico y tratamiento de infecciones urinarias'),(14,'2023-12-13','Consulta por problemas de crecimiento'),(15,'2023-12-12','Seguimiento de enfermedades crónicas'),(16,'2023-12-11','Atención de dolor de oído'),(17,'2023-12-10','Evaluación de problemas de alimentación'),(18,'2023-12-09','Control de enfermedades respiratorias'),(19,'2023-12-08','Diagnóstico y tratamiento de enfermedades infecciosas'),(20,'2023-12-07','Atención de problemas de comportamiento');
/*!40000 ALTER TABLE `trabajos_medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `Pass1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Confirm_pass` varchar(50) CHARACTER SET utf32 COLLATE utf32_spanish2_ci NOT NULL,
  `estado` varchar(9) NOT NULL,
  `nombre_completo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Admin','123','123','Activo','Joel Rosario','Administrador'),(2,'Admin2','1234','1234','Activo','Luis Sanchez','Administrador'),(3,'usuario1','123','123','Activo','Nombre Usuario 1','Secretaría'),(4,'usuario2','12345','12345','Activo','Nombre Usuario 2','Doctor'),(5,'Prueba','12345','12345','Activo','Jose Rodríguez ','Administrador'),(6,'jrosario','123','123','Activo','Jose Rosario','Administrador'),(7,'JaceRos','123','123','Activo','Jacelis Rosario','Secretaría');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-20 22:37:25
