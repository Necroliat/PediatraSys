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
  `Identificador` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Tipo_Identificador` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `ID_Paciente` int DEFAULT NULL,
  `Nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Apellido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Parentesco` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Nacionalidad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Sexo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Dirección` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Ocupación` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  KEY `ID_Paciente` (`ID_Paciente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_padres_de_pacientes`
--

LOCK TABLES `datos_padres_de_pacientes` WRITE;
/*!40000 ALTER TABLE `datos_padres_de_pacientes` DISABLE KEYS */;
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
  `notas` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `desde_cuando` date NOT NULL,
  PRIMARY KEY (`IDdetalle_HC`),
  KEY `FK_Detalle_Historia_Clinica_Historia_Clinica` (`ID_Hist_Clic`),
  KEY `FK_Detalle_Historia_Clinica_Padecimientos_Comunes` (`id_padecimiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_historia_clinica`
--

LOCK TABLES `detalle_historia_clinica` WRITE;
/*!40000 ALTER TABLE `detalle_historia_clinica` DISABLE KEYS */;
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
  `ID_Hist_Clic` int NOT NULL,
  `ID_Paciente` int DEFAULT NULL,
  PRIMARY KEY (`ID_Hist_Clic`),
  KEY `ID_Paciente` (`ID_Paciente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia_clinica`
--

LOCK TABLES `historia_clinica` WRITE;
/*!40000 ALTER TABLE `historia_clinica` DISABLE KEYS */;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institucion_de_salud`
--

LOCK TABLES `institucion_de_salud` WRITE;
/*!40000 ALTER TABLE `institucion_de_salud` DISABLE KEYS */;
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
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio`
--

LOCK TABLES `laboratorio` WRITE;
/*!40000 ALTER TABLE `laboratorio` DISABLE KEYS */;
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
  `Identificador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Valor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Etiqueta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Localizador`)
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
  `Cantidad_total` int DEFAULT NULL,
  PRIMARY KEY (`Id_medicamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamento`
--

LOCK TABLES `medicamento` WRITE;
/*!40000 ALTER TABLE `medicamento` DISABLE KEYS */;
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
  `cédula` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `exequátur` int DEFAULT NULL,
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
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
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
  `Nacionalidad` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Con_quien_vive` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Direccion_reside` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_paciente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
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
  `id_vacuna_p` int NOT NULL,
  `id_paciente` int DEFAULT NULL,
  `id_vacuna` int DEFAULT NULL,
  `dosis` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `refuerzo` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `FECHA_APLICACION` varchar(40) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id_vacuna_p`),
  KEY `FK_Pacientes_Vacunas_Paciente` (`id_paciente`),
  KEY `FK_Pacientes_Vacunas_Tipo_Vacunas` (`id_vacuna`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes_vacunas`
--

LOCK TABLES `pacientes_vacunas` WRITE;
/*!40000 ALTER TABLE `pacientes_vacunas` DISABLE KEYS */;
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
  `descripción` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_padecimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguro`
--

LOCK TABLES `seguro` WRITE;
/*!40000 ALTER TABLE `seguro` DISABLE KEYS */;
INSERT INTO `seguro` VALUES (1,'ARS Universal'),(2,'ARS Palic'),(3,'ARS Humano'),(4,'ARS Senasa'),(5,'ARS Mapfre Salud'),(6,'ARS Monumental'),(7,'ARS Renacer'),(8,'ARS Meta Salud'),(9,'ARS Futuro'),(10,'ARS Semma');
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
INSERT INTO `tipo_vacunas` VALUES (1,'BCG','La vacuna BCG protege contra la tuberculosis y se administra en una sola dosis.',1),(2,'Hepatitis B','La vacuna contra la hepatitis B previene la infección por el virus de la hepatitis B. Se administra en múltiples dosis según el esquema recomendado.',3),(3,'DTP','La vacuna DTP protege contra la difteria, el tétanos y la tos ferina. Se administra en múltiples dosis según el esquema recomendado.',5),(4,'Polio','La vacuna contra la poliomielitis protege contra la polio. Se administra en múltiples dosis según el esquema recomendado.',4),(5,'Hib','La vacuna Hib protege contra Haemophilus influenzae tipo b, una bacteria que puede causar enfermedades graves en los niños. Se administra en múltiples dosis según el esquema recomendado.',3),(6,'Neumococo','La vacuna contra el neumococo protege contra Streptococcus pneumoniae, una bacteria que puede causar enfermedades como la neumonía y la meningitis. Se administra en múltiples dosis según el esquema recomendado.',4),(7,'Rotavirus','La vacuna contra el rotavirus protege contra una infección viral que puede causar diarrea grave en los niños. Se administra en múltiples dosis según el esquema recomendado.',2),(8,'Sarampión, Paperas, Rubéola (MMR)','La vacuna MMR protege contra el sarampión, las paperas y la rubéola. Se administra en múltiples dosis según el esquema recomendado.',2),(9,'Varicela','La vacuna contra la varicela protege contra el virus de la varicela-zóster, que causa la varicela. Se administra en múltiples dosis según el esquema recomendado.',2),(10,'Hepatitis A','La vacuna contra la hepatitis A previene la infección por el virus de la hepatitis A. Se administra en múltiples dosis según el esquema recomendado.',2);
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
  `id_medico` int DEFAULT NULL,
  `descripcion_trabajo_medico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_trabajo_medico`),
  KEY `FK_Trabajos_Medicos_Medicos` (`id_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajos_medicos`
--

LOCK TABLES `trabajos_medicos` WRITE;
/*!40000 ALTER TABLE `trabajos_medicos` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Admin','123','123','activo','Joel Rosario','Administrador'),(2,'Admin2','1234','1234','activo','Luis Sanchez','Administrador'),(3,'usuario1','123','123','activo','Nombre Usuario 1','Secretaría'),(4,'usuario2','12345','12345','activo','Nombre Usuario 2','Doctor');
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

-- Dump completed on 2023-07-24 23:42:36
