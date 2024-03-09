-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-07-2023 a las 07:38:06
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_med`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `id_citas` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` int NOT NULL,
  `id_paciente` int NOT NULL,
  `id_medico` int NOT NULL,
  `observaciones` text NOT NULL,
  `estado` text NOT NULL,
  PRIMARY KEY (`id_citas`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_medico` (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

DROP TABLE IF EXISTS `consulta`;
CREATE TABLE IF NOT EXISTS `consulta` (
  `id_consulta` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `id_medico` int NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text NOT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_medico` (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_consultas`
--

DROP TABLE IF EXISTS `detalle_consultas`;
CREATE TABLE IF NOT EXISTS `detalle_consultas` (
  `id_consulta` int NOT NULL,
  `id_detalle_consulta` int NOT NULL AUTO_INCREMENT,
  `id_trabajo_medico` int NOT NULL,
  `observacion` text NOT NULL,
  PRIMARY KEY (`id_detalle_consulta`),
  KEY `id_consulta` (`id_consulta`),
  KEY `id_trabajo_medico` (`id_trabajo_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_historia_clinica`
--

DROP TABLE IF EXISTS `detalle_historia_clinica`;
CREATE TABLE IF NOT EXISTS `detalle_historia_clinica` (
  `id_hist_clic` int NOT NULL,
  `iddetalle_hc` int NOT NULL AUTO_INCREMENT,
  `t_padecimiento` varchar(50) NOT NULL,
  `d_padecimiento` varchar(100) NOT NULL,
  PRIMARY KEY (`iddetalle_hc`),
  KEY `id_hist_clic` (`id_hist_clic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prescripcion_medica`
--

DROP TABLE IF EXISTS `detalle_prescripcion_medica`;
CREATE TABLE IF NOT EXISTS `detalle_prescripcion_medica` (
  `id_det_receta` int NOT NULL AUTO_INCREMENT,
  `id_receta` int NOT NULL,
  `id_medicamento` int NOT NULL,
  `cantidad` int NOT NULL,
  `unidad_de_medida` int NOT NULL,
  `frecuencia` text NOT NULL,
  `tiempo_de uso` int NOT NULL,
  PRIMARY KEY (`id_det_receta`),
  KEY `id_receta` (`id_receta`),
  KEY `id_medicamento` (`id_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE IF NOT EXISTS `especialidad` (
  `id_especialidad` int NOT NULL AUTO_INCREMENT,
  `Especialidad` varchar(20) NOT NULL,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

DROP TABLE IF EXISTS `historia_clinica`;
CREATE TABLE IF NOT EXISTS `historia_clinica` (
  `id_hist_clic` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  PRIMARY KEY (`id_hist_clic`),
  KEY `id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id_horario` int NOT NULL AUTO_INCREMENT,
  `id_medico` int NOT NULL,
  `dias` varchar(10) NOT NULL,
  `etiqueta` int NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `id_medico` (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion_de_salud`
--

DROP TABLE IF EXISTS `institucion_de_salud`;
CREATE TABLE IF NOT EXISTS `institucion_de_salud` (
  `id_centro` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` int NOT NULL,
  PRIMARY KEY (`id_centro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
CREATE TABLE IF NOT EXISTS `laboratorio` (
  `id_laboratorio` int NOT NULL AUTO_INCREMENT,
  `nombre_laboratorio` varchar(50) NOT NULL,
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizador_medico`
--

DROP TABLE IF EXISTS `localizador_medico`;
CREATE TABLE IF NOT EXISTS `localizador_medico` (
  `id_localizador_m` int NOT NULL AUTO_INCREMENT,
  `id_medico` int NOT NULL,
  `valor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `etiqueta` varchar(100) NOT NULL,
  PRIMARY KEY (`id_localizador_m`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizador_padres_de_pacientes`
--

DROP TABLE IF EXISTS `localizador_padres_de_pacientes`;
CREATE TABLE IF NOT EXISTS `localizador_padres_de_pacientes` (
  `id_localizador` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `valor` varchar(100) NOT NULL,
  `etiqueta` varchar(100) NOT NULL,
  PRIMARY KEY (`id_localizador`),
  KEY `id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
CREATE TABLE IF NOT EXISTS `medicamento` (
  `id_medicamento` int NOT NULL AUTO_INCREMENT,
  `nombre_medicamento` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `formato` varchar(20) NOT NULL,
  `cantidad_total` int NOT NULL,
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `id_medico` int NOT NULL AUTO_INCREMENT,
  `cedula` varchar(13) NOT NULL,
  `exequatur` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `id_especialidad` int NOT NULL,
  `id_localizador_m` int NOT NULL,
  PRIMARY KEY (`id_medico`),
  KEY `id_especialidad` (`id_especialidad`),
  KEY `id_localizador_m` (`id_localizador_m`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_analitica`
--

DROP TABLE IF EXISTS `paciente_analitica`;
CREATE TABLE IF NOT EXISTS `paciente_analitica` (
  `id_estudio_analitica` int NOT NULL AUTO_INCREMENT,
  `id_laboratorio` int NOT NULL,
  `nombre_estudio_analitica` varchar(50) NOT NULL,
  `id_consulta` int NOT NULL,
  `id_centro` int NOT NULL,
  PRIMARY KEY (`id_estudio_analitica`),
  KEY `id_consulta` (`id_consulta`),
  KEY `id_centro` (`id_centro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_menor_edad`
--

DROP TABLE IF EXISTS `paciente_menor_edad`;
CREATE TABLE IF NOT EXISTS `paciente_menor_edad` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_adicionales` int NOT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `id_adicionales` (`id_adicionales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_vacuna`
--

DROP TABLE IF EXISTS `paciente_vacuna`;
CREATE TABLE IF NOT EXISTS `paciente_vacuna` (
  `id_vp` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `id_vacuna` int NOT NULL,
  `dosis` int NOT NULL,
  `refuerzo` int NOT NULL,
  PRIMARY KEY (`id_vp`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_vacuna` (`id_vacuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres_de_pacientes`
--

DROP TABLE IF EXISTS `padres_de_pacientes`;
CREATE TABLE IF NOT EXISTS `padres_de_pacientes` (
  `identificador` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `parentesco` varchar(10) NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `ocupacion` varchar(50) NOT NULL,
  `id_localizador` int NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_localizador` (`id_localizador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prescripcion_medica`
--

DROP TABLE IF EXISTS `prescripcion_medica`;
CREATE TABLE IF NOT EXISTS `prescripcion_medica` (
  `id_receta` int NOT NULL AUTO_INCREMENT,
  `id_consulta` int NOT NULL,
  `id_centro` int NOT NULL,
  PRIMARY KEY (`id_receta`),
  KEY `id_consulta` (`id_consulta`),
  KEY `id_centro` (`id_centro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referimientos`
--

DROP TABLE IF EXISTS `referimientos`;
CREATE TABLE IF NOT EXISTS `referimientos` (
  `id_referimiento` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `id_consulta` int NOT NULL,
  `medico_referido` int NOT NULL,
  `fecha_referimiento` date NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `observaciones` text NOT NULL,
  `id_centro` int NOT NULL,
  PRIMARY KEY (`id_referimiento`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_consulta` (`id_consulta`),
  KEY `id_centro` (`id_centro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro`
--

DROP TABLE IF EXISTS `seguro`;
CREATE TABLE IF NOT EXISTS `seguro` (
  `id_seguro_salud` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_seguro_salud`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro_paciente`
--

DROP TABLE IF EXISTS `seguro_paciente`;
CREATE TABLE IF NOT EXISTS `seguro_paciente` (
  `nss` varchar(10) NOT NULL,
  `id_paciente` int NOT NULL,
  `id_seguro_salud` int NOT NULL,
  PRIMARY KEY (`nss`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_seguro_salud` (`id_seguro_salud`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vacuna`
--

DROP TABLE IF EXISTS `tipo_vacuna`;
CREATE TABLE IF NOT EXISTS `tipo_vacuna` (
  `id_vacuna` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `total_dosis` int NOT NULL,
  PRIMARY KEY (`id_vacuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos_medicos`
--

DROP TABLE IF EXISTS `trabajos_medicos`;
CREATE TABLE IF NOT EXISTS `trabajos_medicos` (
  `id_trabajo_medico` int NOT NULL AUTO_INCREMENT,
  `fecha_creacion` date NOT NULL,
  `id_medico` int NOT NULL,
  `descripcion_trabajo_medico` varchar(100) NOT NULL,
  PRIMARY KEY (`id_trabajo_medico`),
  KEY `id_medico` (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` varchar(9) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente_menor_edad` (`id_paciente`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `localizador_padres_de_pacientes`
--
ALTER TABLE `localizador_padres_de_pacientes`
  ADD CONSTRAINT `localizador_padres_de_pacientes_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente_menor_edad` (`id_paciente`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
