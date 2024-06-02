SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS pediatra_sis;

USE pediatra_sis;

DROP TABLE IF EXISTS analitica_paciente;

CREATE TABLE `analitica_paciente` (
  `id_analitica` int NOT NULL AUTO_INCREMENT,
  `id_consulta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_centro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_paciente` int NOT NULL,
  `id_medico` int NOT NULL,
  `fecha_hora` datetime NOT NULL,
  PRIMARY KEY (`id_analitica`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO analitica_paciente VALUES("12","na","2","2","4","2024-05-18 20:04:36");
INSERT INTO analitica_paciente VALUES("13","na","4","1","4","2024-05-18 20:05:36");
INSERT INTO analitica_paciente VALUES("14","na","1","1","1","2024-05-18 21:20:15");



DROP TABLE IF EXISTS antecedentes;

CREATE TABLE `antecedentes` (
  `id_antecedentes` int NOT NULL,
  `Identificador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  PRIMARY KEY (`id_antecedentes`),
  KEY `Identificador` (`Identificador`(250)),
  KEY `FK_Antecedentes_Datos_Padres_de_Pacientes` (`Identificador`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




DROP TABLE IF EXISTS certificado_medico;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO certificado_medico VALUES("1","1","10","1","presenta un cuadro de gripe con síntomas como fiebre, dolor de garganta y congestión nasal. Tras la evaluación clínica y los exámenes pertinentes, se ha determinado que se trata de una infección viral de las vías respiratorias superiores.","Se ha indicado el siguiente tratamiento:\n- Acetaminofén 500mg cada 6 horas, por 5 días.\n- Descongestionante nasal (Pseudoefedrina) 60mg cada 8 horas, por 3 días.\n- Reposo relativo y abundante hidratación.\n\nRecomendaciones:\nSe recomienda a la paciente María Gómez mantener reposo relativo en casa, evitar el contacto con otras personas y continuar con el tratamiento indicado. Deberá regresar a consulta de control en 7 días o ante empeoramiento de los síntomas.");
INSERT INTO certificado_medico VALUES("2","1","2","3","Que goza de perfecta Salud, y no tiene ninguna condición médica actualmente que pueda afectar con su desempeño.","Y está acta para laborar.");
INSERT INTO certificado_medico VALUES("3","5","3","1","Goza de perfecta salud","Y pude desarrollarse en sin ningún inconveniente.");
INSERT INTO certificado_medico VALUES("4","2","1","1","hidornefrosis ","referido a urologia pediatrica ");



DROP TABLE IF EXISTS citas;

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

INSERT INTO citas VALUES("1","2024-04-22","13:04:00","19","5","","Vigente");
INSERT INTO citas VALUES("3","2024-04-12","09:00:00","1","12","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("4","2024-04-12","10:00:00","2","12","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("5","2024-04-12","11:00:00","3","12","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("6","2024-04-12","12:00:00","4","12","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("7","2024-04-12","13:00:00","5","12","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("8","2024-04-12","09:00:00","6","13","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("9","2024-04-12","10:00:00","7","13","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("10","2024-04-12","11:00:00","8","13","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("11","2024-04-12","12:00:00","9","13","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("12","2024-04-12","13:00:00","10","13","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("13","2024-04-12","09:00:00","11","14","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("14","2024-04-12","10:00:00","12","14","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("15","2024-04-12","11:00:00","13","14","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("16","2024-04-12","12:00:00","14","14","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("17","2024-04-12","13:00:00","15","14","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("18","2024-04-12","09:00:00","16","15","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("19","2024-04-12","10:00:00","17","15","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("20","2024-04-12","11:00:00","18","15","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("21","2024-04-12","12:00:00","19","15","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("22","2024-04-12","13:00:00","20","15","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("23","2024-04-12","09:00:00","1","16","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("24","2024-04-12","10:00:00","2","16","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("25","2024-04-12","11:00:00","3","16","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("26","2024-04-12","12:00:00","4","16","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("27","2024-04-12","13:00:00","5","16","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("28","2024-04-12","09:00:00","6","17","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("29","2024-04-12","10:00:00","7","17","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("30","2024-04-12","11:00:00","8","17","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("31","2024-04-12","12:00:00","9","17","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("32","2024-04-12","13:00:00","10","17","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("33","2024-04-12","09:00:00","11","18","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("34","2024-04-12","10:00:00","12","18","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("35","2024-04-12","11:00:00","13","18","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("36","2024-04-12","12:00:00","14","18","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("37","2024-04-12","13:00:00","15","18","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("38","2024-04-12","09:00:00","16","19","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("39","2024-04-12","10:00:00","17","19","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("40","2024-04-12","11:00:00","18","19","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("41","2024-04-12","12:00:00","19","19","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("42","2024-04-12","13:00:00","20","19","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("43","2024-04-12","09:00:00","1","20","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("44","2024-04-12","10:00:00","2","20","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("45","2024-04-12","11:00:00","3","20","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("46","2024-04-12","12:00:00","4","20","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("47","2024-04-12","13:00:00","5","20","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("48","2024-04-13","09:00:00","1","12","Observaciones cita 1","Cancelada");
INSERT INTO citas VALUES("49","2024-04-13","10:00:00","2","12","Observaciones cita 2","Cancelada");
INSERT INTO citas VALUES("50","2024-04-13","11:00:00","3","12","Observaciones cita 3","Cancelada");
INSERT INTO citas VALUES("51","2024-04-13","12:00:00","4","12","Observaciones cita 4","Cancelada");
INSERT INTO citas VALUES("52","2024-04-13","13:00:00","5","12","Observaciones cita 5","Cancelada");
INSERT INTO citas VALUES("53","2024-04-13","09:00:00","6","13","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("54","2024-04-13","10:00:00","7","13","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("55","2024-04-13","11:00:00","8","13","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("56","2024-04-13","12:00:00","9","13","Observaciones cita 4","Vigente");
INSERT INTO citas VALUES("57","2024-04-13","13:00:00","10","13","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("58","2024-04-13","09:00:00","11","14","Observaciones cita 1","Atendida");
INSERT INTO citas VALUES("59","2024-04-13","10:00:00","12","14","Observaciones cita 2","Vigente");
INSERT INTO citas VALUES("60","2024-04-13","11:00:00","13","14","Observaciones cita 3","Vigente");
INSERT INTO citas VALUES("61","2024-04-13","12:00:00","14","14","Observaciones cita 4","Cancelada");
INSERT INTO citas VALUES("62","2024-04-13","13:00:00","15","14","Observaciones cita 5","Vigente");
INSERT INTO citas VALUES("63","2024-04-13","09:00:00","16","15","Observaciones cita 1","Atendida");
INSERT INTO citas VALUES("64","2024-04-13","10:00:00","17","15","Observaciones cita 2","Atendida");
INSERT INTO citas VALUES("65","2024-04-13","11:00:00","18","15","Observaciones cita 3","Atendida");
INSERT INTO citas VALUES("66","2024-04-13","12:00:00","19","15","Observaciones cita 4","Cancelada");
INSERT INTO citas VALUES("67","2024-04-13","13:00:00","20","15","Observaciones cita 5","Cancelada");
INSERT INTO citas VALUES("68","2024-04-13","09:00:00","1","16","Observaciones cita 1","Atendida");
INSERT INTO citas VALUES("69","2024-04-13","10:00:00","2","16","Observaciones cita 2","Atendida");
INSERT INTO citas VALUES("70","2024-04-13","11:00:00","3","16","Observaciones cita 3","Atendida");
INSERT INTO citas VALUES("71","2024-04-13","12:00:00","4","16","Observaciones cita 4","Atendida");
INSERT INTO citas VALUES("72","2024-04-13","13:00:00","5","16","Observaciones cita 5","Atendida");
INSERT INTO citas VALUES("73","2024-04-13","09:00:00","6","17","Observaciones cita 1","Atendida");
INSERT INTO citas VALUES("74","2024-04-13","10:00:00","7","17","Observaciones cita 2","Atendida");
INSERT INTO citas VALUES("75","2024-04-13","11:00:00","8","17","Observaciones cita 3","Atendida");
INSERT INTO citas VALUES("76","2024-04-13","12:00:00","9","17","Observaciones cita 4","Atendida");
INSERT INTO citas VALUES("77","2024-04-13","13:00:00","10","17","Observaciones cita 5","Atendida");
INSERT INTO citas VALUES("78","2024-04-13","09:00:00","11","18","Observaciones cita 1","Vigente");
INSERT INTO citas VALUES("79","2024-04-13","10:00:00","12","18","Observaciones cita 2","Cancelada");
INSERT INTO citas VALUES("80","2024-04-13","11:00:00","13","18","Observaciones cita 3","Atendida");
INSERT INTO citas VALUES("81","2024-04-13","12:00:00","14","18","Observaciones cita 4","Atendida");
INSERT INTO citas VALUES("82","2024-04-13","13:00:00","15","18","Observaciones cita 5","Atendida");
INSERT INTO citas VALUES("83","2024-04-13","09:00:00","16","19","Observaciones cita 1","Atendida");
INSERT INTO citas VALUES("84","2024-04-13","10:00:00","17","19","Observaciones cita 2","Atendida");
INSERT INTO citas VALUES("85","2024-04-13","11:00:00","18","19","Observaciones cita 3","Cancelada");
INSERT INTO citas VALUES("86","2024-04-13","12:00:00","19","19","Observaciones cita 4","Atendida");
INSERT INTO citas VALUES("87","2024-04-13","13:00:00","20","19","Observaciones cita 5","Atendida");
INSERT INTO citas VALUES("88","2024-04-13","09:00:00","1","20","Observaciones cita 1","Atendida");
INSERT INTO citas VALUES("89","2024-04-13","10:00:00","2","20","Observaciones cita 2","Cancelada");
INSERT INTO citas VALUES("90","2024-04-13","11:00:00","3","20","Observaciones cita 3","Atendida");
INSERT INTO citas VALUES("91","2024-04-13","12:00:00","4","20","Observaciones cita 4","Atendida");
INSERT INTO citas VALUES("92","2024-04-13","13:00:00","5","20","Observaciones cita 5","Atendida");
INSERT INTO citas VALUES("93","2024-04-23","13:05:00","10","2","","Vigente");
INSERT INTO citas VALUES("94","2024-04-15","13:04:00","1","1","","Atendida");
INSERT INTO citas VALUES("95","2024-04-15","13:04:00","2","1","","Atendida");
INSERT INTO citas VALUES("96","2024-04-15","13:04:00","10","1","","Atendida");
INSERT INTO citas VALUES("97","2024-04-15","13:04:00","3","1","","Vigente");
INSERT INTO citas VALUES("98","2024-04-15","14:05:00","12","1","","Atendida");
INSERT INTO citas VALUES("99","2024-04-17","10:02:00","2","1","","En consulta");
INSERT INTO citas VALUES("100","2024-05-31","14:00:00","1","1","vino a chequepos natal","En consulta");
INSERT INTO citas VALUES("101","2024-06-03","14:00:00","4","1","","Vigente");



DROP TABLE IF EXISTS consultas;

CREATE TABLE `consultas` (
  `id_consulta` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `diagnostico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `tratamiento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_consulta`),
  KEY `FK_Consultas_Paciente` (`id_paciente`),
  KEY `FK_Consultas_Medicos` (`id_medico`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO consultas VALUES("1","1","1","2024-03-28","12:49:02","Diagnóstico 1","Tratamiento 1");
INSERT INTO consultas VALUES("2","10","5","2023-05-27","03:08:00","Diagnóstico 34","Tratamiento 26");
INSERT INTO consultas VALUES("3","12","3","2023-09-25","12:00:00","Diagnóstico 55","Tratamiento 73");
INSERT INTO consultas VALUES("4","8","4","2024-02-17","01:02:00","Diagnóstico 1","Tratamiento 91");
INSERT INTO consultas VALUES("5","1","1","2023-10-26","01:03:00","Diagnóstico 8","Tratamiento 26");
INSERT INTO consultas VALUES("6","9","6","2023-07-01","22:24:00","Diagnóstico 24","Tratamiento 1");
INSERT INTO consultas VALUES("7","13","7","2024-03-08","10:04:00","Diagnóstico 5","Tratamiento 1");
INSERT INTO consultas VALUES("8","2","8","2024-03-08","14:45:00","Diagnóstico 6","Tratamiento 1");
INSERT INTO consultas VALUES("9","88","19","2024-01-26","18:21:00","Diagnóstico 45","Tratamiento 19");
INSERT INTO consultas VALUES("10","63","26","2023-07-04","02:21:00","Diagnóstico 49","Tratamiento 35");
INSERT INTO consultas VALUES("11","29","19","2023-04-05","19:05:00","Diagnóstico 3","Tratamiento 88");
INSERT INTO consultas VALUES("12","35","3","2023-12-26","02:45:00","Diagnóstico 48","Tratamiento 13");
INSERT INTO consultas VALUES("13","25","41","2023-11-28","05:05:00","Diagnóstico 80","Tratamiento 75");
INSERT INTO consultas VALUES("14","37","29","2023-06-27","01:00:00","Diagnóstico 86","Tratamiento 30");
INSERT INTO consultas VALUES("15","92","34","2023-08-29","21:49:00","Diagnóstico 36","Tratamiento 38");
INSERT INTO consultas VALUES("16","80","42","2023-06-09","12:08:00","Diagnóstico 14","Tratamiento 31");
INSERT INTO consultas VALUES("17","13","36","2024-01-23","18:13:00","Diagnóstico 87","Tratamiento 67");
INSERT INTO consultas VALUES("18","79","44","2024-03-27","09:03:00","Diagnóstico 5","Tratamiento 7");
INSERT INTO consultas VALUES("19","22","44","2023-07-13","22:32:00","Diagnóstico 89","Tratamiento 86");
INSERT INTO consultas VALUES("20","63","27","2023-06-10","09:36:00","Diagnóstico 80","Tratamiento 21");
INSERT INTO consultas VALUES("21","65","30","2024-03-08","11:15:00","Diagnóstico 83","Tratamiento 38");
INSERT INTO consultas VALUES("22","1","5","2024-03-28","20:47:00","gergergsdfvf","regergerger");
INSERT INTO consultas VALUES("23","1","1","2024-03-29","11:08:00","asdasdasd","asdasdasdasddasdasdasdasdasdasdasdasdasdasdsadsadasdasdasdas");
INSERT INTO consultas VALUES("24","9","1","2024-04-01","19:54:00","aasdasdd","qwedqweqw");



DROP TABLE IF EXISTS datos_padres_de_pacientes;

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

INSERT INTO datos_padres_de_pacientes VALUES("91-3156392-3","cédula","Juan","Pérez","Padre","República Dominicana","Masculino","Calle 123","Ingeniero");
INSERT INTO datos_padres_de_pacientes VALUES("H99BV0A7R","pasaporte","María","González","Madre","República Dominicana","Femenino","Avenida 456","Doctora");
INSERT INTO datos_padres_de_pacientes VALUES("9876543210"," cédula","Pedro","Sánchez","Padre","Paquistán ","Maculino","Carrera 789","Abogado");
INSERT INTO datos_padres_de_pacientes VALUES("YPZYE19VT","pasaporte","Ana","López","Madre","República Dominicana","Femenino","Calle Principal","Arquitecta");
INSERT INTO datos_padres_de_pacientes VALUES("573-9534381-0","cédula","Carlos","Rodríguez","Padre","República Dominicana","Masculino","Avenida Central","Empresario");
INSERT INTO datos_padres_de_pacientes VALUES("DU7SF0F6U","pasaporte","Laura","Fernández","Madre","República Dominicana","Femenino","Calle Secundaria","Enfermera");
INSERT INTO datos_padres_de_pacientes VALUES("379-7527899-6","cédula","Alejandro","Hernández","Padre","República Dominicana","Masculino","Avenida 123","Profesor");
INSERT INTO datos_padres_de_pacientes VALUES("1132YT6PP","pasaporte","Sofía","Torres","Madre","República Dominicana","Femenino","Carrera Principal","Psicóloga");
INSERT INTO datos_padres_de_pacientes VALUES("871-4803680-7","cédula","Luis","Gómez","Padre","República Dominicana","Masculino","Calle 456","Contador");
INSERT INTO datos_padres_de_pacientes VALUES("ZMS1MVKF2","pasaporte","Marta","Vargas","Madre","República Dominicana","Femenino","Avenida Secundaria","Diseñadora");
INSERT INTO datos_padres_de_pacientes VALUES("492-1041105-0","cédula","Roberto","Ramírez","Padre","República Dominicana","Masculino","Calle 789","Médico");
INSERT INTO datos_padres_de_pacientes VALUES("V2MZBT6D4","pasaporte","Lucía","Morales","Madre","República Dominicana","Femenino","Avenida Principal","Ingeniera");
INSERT INTO datos_padres_de_pacientes VALUES("896-3589067-1","cédula","Javier","Castro","Padre","República Dominicana","Masculino","Carrera 123","Abogado");
INSERT INTO datos_padres_de_pacientes VALUES("CGURSA2ZH","pasaporte","Fernanda","Ortega","Madre","República Dominicana","Femenino","Calle Central","Empresaria");
INSERT INTO datos_padres_de_pacientes VALUES("442-9015540-2","cédula","Ricardo","Cruz","Padre","República Dominicana","Masculino","Avenida Secundaria","Ingeniero");
INSERT INTO datos_padres_de_pacientes VALUES("54CWZTS91","pasaporte","Isabel","Navarro","Madre","República Dominicana","Femenino","Carrera Secundaria","Arquitecta");
INSERT INTO datos_padres_de_pacientes VALUES("194-4338446-5","cédula","Gabriel","Pacheco","Padre","República Dominicana","Masculino","Calle Principal","Empresario");
INSERT INTO datos_padres_de_pacientes VALUES("I66666666"," pasaporte","Valentina","Rojas","Madre","Países Bajos ","Femenino","Avenida 123","Médica");
INSERT INTO datos_padres_de_pacientes VALUES("598-2194253-3"," Cédula","Andrés Alberto","Mendoza","Padre","República República Dominicana ","Masculino","Carrera 456","Ingeniero");
INSERT INTO datos_padres_de_pacientes VALUES("O789O5KPQ","pasaporte","Paula Maria","Peña","Madre","España","Femenino","Calle 789","Arquitecta");
INSERT INTO datos_padres_de_pacientes VALUES("624-3656118-9","Cédula","Ranciel","Melendez ","Padre","República República Dominicana","Maculino","Residencial F, Calle almendra, Casa 20","Ing civil");
INSERT INTO datos_padres_de_pacientes VALUES("680-5351401-6","Cédula","Roan","Richez","Padre","República República Dominicana","Maculino","El dorsal, Calle 5, casa 3, La Vega","Vendedor");
INSERT INTO datos_padres_de_pacientes VALUES("568-9396909-9","Cédula","Roldan","Guzman ","Padre","República República Dominicana","Maculino","Avenida F, Calle 4","Panadero");
INSERT INTO datos_padres_de_pacientes VALUES("0470202064","Cédula","Silvana ","vargas ","Madre","República Dominicana","Femenino","Santiago ","tencnico rayos x");
INSERT INTO datos_padres_de_pacientes VALUES("047-0202207-2","Cédula","pedro","martinez","Padre","República Dominicana","Maculino","las carmelirtas","f");



DROP TABLE IF EXISTS detalle_analitica;

CREATE TABLE `detalle_analitica` (
  `ID_det_analitica` int NOT NULL AUTO_INCREMENT,
  `id_analitica` int DEFAULT NULL,
  `id_analisis` int DEFAULT NULL,
  PRIMARY KEY (`ID_det_analitica`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO detalle_analitica VALUES("8","12","1");
INSERT INTO detalle_analitica VALUES("9","13","1");
INSERT INTO detalle_analitica VALUES("10","13","3");
INSERT INTO detalle_analitica VALUES("11","14","1");



DROP TABLE IF EXISTS detalle_antecedentes;

CREATE TABLE `detalle_antecedentes` (
  `IDdetalle_ant` int NOT NULL AUTO_INCREMENT,
  `ID_antecedentes` int DEFAULT NULL,
  `id_padecimiento` int DEFAULT NULL,
  PRIMARY KEY (`IDdetalle_ant`),
  KEY `FK_Detalle_Antecedentes_Antecedentes` (`ID_antecedentes`),
  KEY `FK_Detalle_Antecedentes_Padecimientos_Comunes` (`id_padecimiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




DROP TABLE IF EXISTS detalle_consulta;

CREATE TABLE `detalle_consulta` (
  `id_detalle_consulta` int NOT NULL AUTO_INCREMENT,
  `ID_Consulta` int DEFAULT NULL,
  `id_trabajo_medico` int DEFAULT NULL,
  `Observacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_detalle_consulta`),
  KEY `FK_Detalle_Consulta_Consultas` (`ID_Consulta`),
  KEY `FK_Detalle_Consulta_Trabajos_Medicos` (`id_trabajo_medico`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO detalle_consulta VALUES("1","23","4","Tratamiento de infección respiratoria");
INSERT INTO detalle_consulta VALUES("2","24","2","Control de vacunas");



DROP TABLE IF EXISTS detalle_historia_clinica;

CREATE TABLE `detalle_historia_clinica` (
  `IDdetalle_HC` int NOT NULL AUTO_INCREMENT,
  `ID_Hist_Clic` int DEFAULT NULL,
  `id_padecimiento` int DEFAULT NULL,
  `notas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `desde_cuando` date NOT NULL,
  PRIMARY KEY (`IDdetalle_HC`),
  KEY `FK_Detalle_Historia_Clinica_Historia_Clinica` (`ID_Hist_Clic`),
  KEY `FK_Detalle_Historia_Clinica_Padecimientos_Comunes` (`id_padecimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO detalle_historia_clinica VALUES("1","1","3","Tos persistente y dificultad para respirar.","2023-07-13");
INSERT INTO detalle_historia_clinica VALUES("2","2","6","Niveles altos de azúcar en la sangre.","2023-07-11");
INSERT INTO detalle_historia_clinica VALUES("3","2","9","Inflamación del revestimiento del estómago.","2023-07-09");
INSERT INTO detalle_historia_clinica VALUES("4","3","3","Tos persistente y dificultad para respirar.","2023-07-11");
INSERT INTO detalle_historia_clinica VALUES("5","3","11","Reacción alérgica a antibióticos comunes.","2023-06-29");
INSERT INTO detalle_historia_clinica VALUES("6","4","4","Sibilancias y dificultad respiratoria recurrente.","2023-07-12");
INSERT INTO detalle_historia_clinica VALUES("7","5","5","Presión sanguínea elevada, riesgo cardíaco.","2023-07-05");
INSERT INTO detalle_historia_clinica VALUES("8","6","3","Tos persistente y dificultad para respirar.","2023-07-18");
INSERT INTO detalle_historia_clinica VALUES("9","7","4","Sibilancias y dificultad respiratoria recurrente.","2023-07-13");
INSERT INTO detalle_historia_clinica VALUES("10","8","3","Tos persistente y dificultad para respirar.","2023-07-20");
INSERT INTO detalle_historia_clinica VALUES("11","9","3","Tos persistente y dificultad para respirar.","2023-07-19");
INSERT INTO detalle_historia_clinica VALUES("12","10","3","Tos persistente y dificultad para respirar.","2024-03-22");
INSERT INTO detalle_historia_clinica VALUES("13","11","5","Presión sanguínea elevada, riesgo cardíaco.","2024-01-06");
INSERT INTO detalle_historia_clinica VALUES("14","12","4","Sibilancias y dificultad respiratoria recurrente.","2024-01-30");
INSERT INTO detalle_historia_clinica VALUES("15","13","3","Tos persistente y dificultad para respirar.","2024-01-10");
INSERT INTO detalle_historia_clinica VALUES("16","14","4","Sibilancias y dificultad respiratoria recurrente.","2024-03-23");
INSERT INTO detalle_historia_clinica VALUES("17","15","11","Reacción alérgica a antibióticos comunes.","2024-01-18");
INSERT INTO detalle_historia_clinica VALUES("18","16","1","2023-12-22","2024-03-27");
INSERT INTO detalle_historia_clinica VALUES("19","17","11","Reacción alérgica a antibióticos comunes.","2024-01-16");
INSERT INTO detalle_historia_clinica VALUES("20","18","3","Tos persistente y dificultad para respirar.","2023-12-15");
INSERT INTO detalle_historia_clinica VALUES("21","18","6","Niveles altos de azúcar en la sangre.","2024-03-01");
INSERT INTO detalle_historia_clinica VALUES("22","20","7","Dolor leve a moderado en la cabeza.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("23","21","7","Dolor leve a moderado en la cabeza.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("24","22","9","Inflamación del revestimiento del estómago.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("25","18","2","Sibilancias y dificultad respiratoria recurrente.","2024-04-09");
INSERT INTO detalle_historia_clinica VALUES("26","18","2","Sibilancias y dificultad respiratoria recurrente.","2024-04-13");
INSERT INTO detalle_historia_clinica VALUES("27","25","5","Presión sanguínea elevada, riesgo cardíaco.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("28","26","7","Dolor leve a moderado en la cabeza.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("29","27","5","Presión sanguínea elevada, riesgo cardíaco.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("30","28","4","Sibilancias y dificultad respiratoria recurrente.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("31","29","3","Tos persistente y dificultad para respirar.","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("32","30","5","Presión sanguínea elevada, riesgo cardíaco.","2024-04-09");
INSERT INTO detalle_historia_clinica VALUES("33","31","4","Sibilancias y dificultad respiratoria recurrente.","2024-04-03");
INSERT INTO detalle_historia_clinica VALUES("34","32","4","Sibilancias y dificultad respiratoria recurrente.","2007-02-14");
INSERT INTO detalle_historia_clinica VALUES("35","33","13","Dolor y ardor al orinar.","2023-05-23");
INSERT INTO detalle_historia_clinica VALUES("36","33","14","Sensación de ardor en el pecho.","2024-05-16");
INSERT INTO detalle_historia_clinica VALUES("37","34","3","Tos persistente y dificultad para respirar.","2024-05-29");
INSERT INTO detalle_historia_clinica VALUES("38","35","3","ha ce 3 semanas","2024-05-16");
INSERT INTO detalle_historia_clinica VALUES("39","35","5","ninguna nota/descripción","2024-05-22");
INSERT INTO detalle_historia_clinica VALUES("40","36","5","ddd","2024-05-31");



DROP TABLE IF EXISTS detalle_prescripcion;

CREATE TABLE `detalle_prescripcion` (
  `ID_det_receta` int NOT NULL AUTO_INCREMENT,
  `id_receta` int DEFAULT NULL,
  `id_medicamento` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `unidad_de_medida` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `frecuencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Tiempo_de_uso` int DEFAULT NULL,
  PRIMARY KEY (`ID_det_receta`),
  KEY `FK_Detalle_Prescripcion_Prescripcion_Medica` (`id_receta`),
  KEY `FK_Detalle_Prescripcion_Medicamento` (`id_medicamento`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO detalle_prescripcion VALUES("1","1","12","2","una pastilla","cada 8 horas","5");
INSERT INTO detalle_prescripcion VALUES("2","2","12","2","una cucharada","antes de dormir/ diario","14");
INSERT INTO detalle_prescripcion VALUES("3","3","12","2","Un pastilla","cada 8 horas ","7");
INSERT INTO detalle_prescripcion VALUES("4","4","12","1","Una Pastilla","Una diario","3");
INSERT INTO detalle_prescripcion VALUES("5","9","6","2","1 pastilla","cada 10 horas","10");
INSERT INTO detalle_prescripcion VALUES("6","10","2","1","UNA PASTILLA","CADA 8 HORA","6");
INSERT INTO detalle_prescripcion VALUES("7","11","2","1","una pastilla de 350mg ","despeues de la comida diario","6");



DROP TABLE IF EXISTS especialidad;

CREATE TABLE `especialidad` (
  `id_especialidad` int NOT NULL,
  `especialidad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO especialidad VALUES("1","Cardiología");
INSERT INTO especialidad VALUES("2","Dermatología");
INSERT INTO especialidad VALUES("3","Endocrinología");
INSERT INTO especialidad VALUES("4","Gastroenterología");
INSERT INTO especialidad VALUES("5","Hematología");
INSERT INTO especialidad VALUES("6","Infectología");
INSERT INTO especialidad VALUES("7","Nefrología");
INSERT INTO especialidad VALUES("8","Neumología");
INSERT INTO especialidad VALUES("9","Oftalmología");
INSERT INTO especialidad VALUES("10","Oncología");
INSERT INTO especialidad VALUES("11","Ortopedia");
INSERT INTO especialidad VALUES("12","Otorrinolaringología");
INSERT INTO especialidad VALUES("13","Pediatría");
INSERT INTO especialidad VALUES("14","Psiquiatría");
INSERT INTO especialidad VALUES("15","Reumatología");
INSERT INTO especialidad VALUES("16","Traumatología");
INSERT INTO especialidad VALUES("17","Urología");
INSERT INTO especialidad VALUES("18","Ginecología");
INSERT INTO especialidad VALUES("19","Neurología");
INSERT INTO especialidad VALUES("20","Cirugía");



DROP TABLE IF EXISTS estado_nutricional;

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




DROP TABLE IF EXISTS historia_clinica;

CREATE TABLE `historia_clinica` (
  `ID_Hist_Clic` int NOT NULL AUTO_INCREMENT,
  `ID_Paciente` int DEFAULT NULL,
  PRIMARY KEY (`ID_Hist_Clic`),
  KEY `ID_Paciente` (`ID_Paciente`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO historia_clinica VALUES("1","5");
INSERT INTO historia_clinica VALUES("2","6");
INSERT INTO historia_clinica VALUES("3","7");
INSERT INTO historia_clinica VALUES("4","8");
INSERT INTO historia_clinica VALUES("5","9");
INSERT INTO historia_clinica VALUES("6","11");
INSERT INTO historia_clinica VALUES("7","14");
INSERT INTO historia_clinica VALUES("8","16");
INSERT INTO historia_clinica VALUES("9","19");
INSERT INTO historia_clinica VALUES("10","10");
INSERT INTO historia_clinica VALUES("11","10");
INSERT INTO historia_clinica VALUES("12","10");
INSERT INTO historia_clinica VALUES("13","10");
INSERT INTO historia_clinica VALUES("14","10");
INSERT INTO historia_clinica VALUES("15","10");
INSERT INTO historia_clinica VALUES("16","10");
INSERT INTO historia_clinica VALUES("17","10");
INSERT INTO historia_clinica VALUES("18","10");
INSERT INTO historia_clinica VALUES("19","10");
INSERT INTO historia_clinica VALUES("20","11");
INSERT INTO historia_clinica VALUES("21","11");
INSERT INTO historia_clinica VALUES("22","11");
INSERT INTO historia_clinica VALUES("23","10");
INSERT INTO historia_clinica VALUES("24","10");
INSERT INTO historia_clinica VALUES("25","19");
INSERT INTO historia_clinica VALUES("26","5");
INSERT INTO historia_clinica VALUES("27","3");
INSERT INTO historia_clinica VALUES("28","5");
INSERT INTO historia_clinica VALUES("29","2");
INSERT INTO historia_clinica VALUES("30","1");
INSERT INTO historia_clinica VALUES("31","31");
INSERT INTO historia_clinica VALUES("32","1");
INSERT INTO historia_clinica VALUES("33","35");
INSERT INTO historia_clinica VALUES("34","1");
INSERT INTO historia_clinica VALUES("35","36");
INSERT INTO historia_clinica VALUES("36","1");



DROP TABLE IF EXISTS horario;

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

INSERT INTO horario VALUES("3","10","Lunes, Miércoles, Viernes","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("4","21","Lunes, Martes, Miércoles","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("6","5","Lunes","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("7","12","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("8","13","Lunes, Miércoles, Jueves","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("9","14","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("10","15","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("11","16","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("12","17","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("13","18","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("14","19","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("15","20","Lunes, Martes, Miércoles, Jueves, Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("16","1","Lunes","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("17","1","Martes, Miércoles, Jueves, Viernes","Regular","08:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("18","9","Lunes, Miércoles","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("19","9","Martes","Regular","14:00:00","20:00:00","Activo");
INSERT INTO horario VALUES("20","3","Lunes, Martes, Jueves","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("21","3","Miércoles, Viernes","Regular","14:00:00","16:00:00","Activo");
INSERT INTO horario VALUES("22","3","Viernes, Sábado","Regular","09:00:00","18:00:00","Activo");
INSERT INTO horario VALUES("23","2","Lunes, Martes, Miércoles","Regular","09:00:00","18:00:00","Activo");



DROP TABLE IF EXISTS institucion_de_salud;

CREATE TABLE `institucion_de_salud` (
  `id_centro` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `telefono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_centro`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO institucion_de_salud VALUES("1","Hospital A","Dirección A","123-456-7890");
INSERT INTO institucion_de_salud VALUES("2","Clínica B","Dirección B","234-567-8901");
INSERT INTO institucion_de_salud VALUES("3","Centro Médico C","Dirección C","345-678-9012");
INSERT INTO institucion_de_salud VALUES("4","Hospital D","Dirección D","456-789-0123");
INSERT INTO institucion_de_salud VALUES("5","Clínica E","Dirección E","567-890-1234");
INSERT INTO institucion_de_salud VALUES("6","Centro Médico F","Dirección F","678-901-2345");
INSERT INTO institucion_de_salud VALUES("7","Hospital G","Dirección G","789-012-3456");
INSERT INTO institucion_de_salud VALUES("8","Clínica H","Dirección H","890-123-4567");
INSERT INTO institucion_de_salud VALUES("9","Centro Médico I","Dirección I","901-234-5678");
INSERT INTO institucion_de_salud VALUES("10","Hospital J","Dirección J","012-345-6789");



DROP TABLE IF EXISTS laboratorio;

CREATE TABLE `laboratorio` (
  `id_laboratorio` int NOT NULL,
  `nombre_laboratorio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Telefono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO laboratorio VALUES("1","Laboratorio Aeiu ","Calle 123","1234567890","laboratorioa@example.com");
INSERT INTO laboratorio VALUES("2","Laboratorio B","Avenida 456","0987654321","laboratoriob@example.com");
INSERT INTO laboratorio VALUES("3","Laboratorio C","Carrera 789","1111111111","laboratorioc@example.com");
INSERT INTO laboratorio VALUES("4","Laboratorio D","Calle Principal","2222222222","laboratoriod@example.com");
INSERT INTO laboratorio VALUES("5","Laboratorio E","Avenida Central","3333333333","laboratorioe@example.com");
INSERT INTO laboratorio VALUES("6","Laboratorio F","Calle Secundaria","4444444444","laboratoriof@example.com");
INSERT INTO laboratorio VALUES("7","Laboratorio G","Avenida 123","5555555555","laboratoriog@example.com");
INSERT INTO laboratorio VALUES("8","Laboratorio H","Carrera Principal","6666666666","laboratorioh@example.com");
INSERT INTO laboratorio VALUES("9","Laboratorio I","Calle 456","7777777777","laboratorioi@example.com");
INSERT INTO laboratorio VALUES("10","Laboratorio J","Avenida Secundaria","8888888888","laboratorioj@example.com");
INSERT INTO laboratorio VALUES("11","Laboratorio K","Calle 789","9999999999","laboratoriok@example.com");
INSERT INTO laboratorio VALUES("12","Laboratorio L","Avenida Principal","0000000000","laboratoriol@example.com");
INSERT INTO laboratorio VALUES("13","Laboratorio M","Carrera 123","1212121212","laboratoriom@example.com");
INSERT INTO laboratorio VALUES("14","Laboratorio N","Calle Central","2323232323","laboratorion@example.com");
INSERT INTO laboratorio VALUES("15","Laboratorio O","Avenida Secundaria","3434343434","laboratorioo@example.com");
INSERT INTO laboratorio VALUES("16","Laboratorio P","Carrera Secundaria","4545454545","laboratoriop@example.com");
INSERT INTO laboratorio VALUES("17","Laboratorio Q","Calle Principal","5656565656","laboratorioq@example.com");
INSERT INTO laboratorio VALUES("18","Laboratorio R","Avenida 123","6767676767","laboratorior@example.com");
INSERT INTO laboratorio VALUES("19","Laboratorio S","Carrera 456","7878787878","laboratorios@example.com");
INSERT INTO laboratorio VALUES("20","Laboratorio T","Calle 789","8989898989","laboratoriot@example.com");
INSERT INTO laboratorio VALUES("21","Guaco Plus","Guaco, La Vega, Rep. Dominicana","+18095736545","joelenrosario@gmail.com");
INSERT INTO laboratorio VALUES("22","Lab Unidos","Pueblo Viejo","8096976797","labunidos3268@gmail.com");



DROP TABLE IF EXISTS localizador_medico;

CREATE TABLE `localizador_medico` (
  `ID_Localizador_M` int NOT NULL,
  `id_medico` int DEFAULT NULL,
  `Valor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Etiqueta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`ID_Localizador_M`),
  KEY `FK_Localizador_Medico_Medicos` (`id_medico`)
) ENGINE=MyISAM AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO localizador_medico VALUES("0","0","","");
INSERT INTO localizador_medico VALUES("1","1","(123) 456-7890","Telefono Principal");
INSERT INTO localizador_medico VALUES("2","1","(234) 567-8901","Telefono Alterno");
INSERT INTO localizador_medico VALUES("3","1","(345) 678-9012","Email Personal");
INSERT INTO localizador_medico VALUES("4","2","(456) 789-0123","Telefono Casa");
INSERT INTO localizador_medico VALUES("5","2","(567) 890-1234","Movil Principal");
INSERT INTO localizador_medico VALUES("6","2","email1@personal.com","Email Trabajo");
INSERT INTO localizador_medico VALUES("7","3","(678) 901-2345","Movil Alterno");
INSERT INTO localizador_medico VALUES("8","3","(789) 012-3456","Movil Corporativo");
INSERT INTO localizador_medico VALUES("9","3","email2@work.com","Email Alternativo");
INSERT INTO localizador_medico VALUES("10","4","(890) 123-4567","Telefono Principal");
INSERT INTO localizador_medico VALUES("11","4","email4@personal.com","Email Trabajo");
INSERT INTO localizador_medico VALUES("12","5","(901) 234-5678","Telefono Alterno");
INSERT INTO localizador_medico VALUES("13","5","email5@work.com","Email Personal");
INSERT INTO localizador_medico VALUES("14","6","(012) 345-6789","Telefono Casa");
INSERT INTO localizador_medico VALUES("15","6","email6@alternativo.com","Email Alternativo");
INSERT INTO localizador_medico VALUES("16","7","(123) 456-7890","Movil Principal");
INSERT INTO localizador_medico VALUES("17","7","email7@personal.com","Email Trabajo");
INSERT INTO localizador_medico VALUES("18","8","(234) 567-8901","Movil Alterno");
INSERT INTO localizador_medico VALUES("19","8","email8@work.com","Email Personal");
INSERT INTO localizador_medico VALUES("20","9","(345) 678-9012","Movil Corporativo");
INSERT INTO localizador_medico VALUES("21","9","email9@alternativo.com","Email Alternativo");
INSERT INTO localizador_medico VALUES("22","10","(456) 789-0123","Telefono Principal");
INSERT INTO localizador_medico VALUES("23","10","email10@personal.com","Email Trabajo");
INSERT INTO localizador_medico VALUES("24","11","(567) 890-1234","Telefono Alterno");
INSERT INTO localizador_medico VALUES("25","11","email11@work.com","Email Personal");
INSERT INTO localizador_medico VALUES("26","12","(678) 901-2345","Telefono Casa");
INSERT INTO localizador_medico VALUES("27","12","email12@alternativo.com","Email Alternativo");
INSERT INTO localizador_medico VALUES("28","13","(789) 012-3456","Movil Principal");
INSERT INTO localizador_medico VALUES("29","13","email13@personal.com","Email Trabajo");
INSERT INTO localizador_medico VALUES("30","14","(890) 123-4567","Movil Alterno");
INSERT INTO localizador_medico VALUES("31","14","email14@work.com","Email Personal");
INSERT INTO localizador_medico VALUES("32","15","(901) 234-5678","Movil Corporativo");
INSERT INTO localizador_medico VALUES("33","15","email15@alternativo.com","Email Alternativo");
INSERT INTO localizador_medico VALUES("34","16","(012) 345-6789","Telefono Principal");
INSERT INTO localizador_medico VALUES("35","16","email16@personal.com","Email Trabajo");
INSERT INTO localizador_medico VALUES("36","17","(123) 456-7890","Telefono Alterno");
INSERT INTO localizador_medico VALUES("37","17","email17@work.com","Email Personal");
INSERT INTO localizador_medico VALUES("38","18","(234) 567-8901","Telefono Casa");
INSERT INTO localizador_medico VALUES("39","18","email18@alternativo.com","Email Alternativo");
INSERT INTO localizador_medico VALUES("40","19","(345) 678-9012","Movil Principal");
INSERT INTO localizador_medico VALUES("41","19","email19@personal.com","Email Trabajo");



DROP TABLE IF EXISTS localizador_padres_de_pacientes;

CREATE TABLE `localizador_padres_de_pacientes` (
  `ID_Localizador` int NOT NULL,
  `Identificador` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Valor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Etiqueta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Localizador`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO localizador_padres_de_pacientes VALUES("2","132YT6PP","8098031903","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("3","132YT6PP","8095908240","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("4","132YT6PP","8495445489","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("5","132YT6PP","correo_132YT6PP@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("6","194-4338446-5","8099502727","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("7","194-4338446-5","8091177168","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("8","194-4338446-5","8497377661","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("9","194-4338446-5","correo_194-4338446-5@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("10","379-7527899-6","8093356799","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("11","379-7527899-6","8094651017","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("12","379-7527899-6","8493184685","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("13","379-7527899-6","correo_379-7527899-6@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("14","442-9015540-2","8091970377","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("15","442-9015540-2","8090297830","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("16","442-9015540-2","8495578019","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("17","442-9015540-2","correo_442-9015540-2@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("18","492-1041105-0","8096996607","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("19","492-1041105-0","8098248978","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("20","492-1041105-0","8490255071","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("21","492-1041105-0","correo_492-1041105-0@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("22","54CWZTS91","8096528419","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("23","54CWZTS91","8091876885","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("24","54CWZTS91","8499799168","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("25","54CWZTS91","correo_54CWZTS91@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("26","568-9396909-9","8093365185","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("27","568-9396909-9","8097428424","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("28","568-9396909-9","8497046565","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("29","568-9396909-9","correo_568-9396909-9@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("30","573-9534381-0","8092947552","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("31","573-9534381-0","8093598068","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("32","573-9534381-0","8499147682","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("33","573-9534381-0","correo_573-9534381-0@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("34","598-2194253-3","8094944210","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("35","598-2194253-3","8097278005","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("36","598-2194253-3","8491557395","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("37","598-2194253-3","correo_598-2194253-3@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("38","624-3656118-9","8095952960","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("39","624-3656118-9","8095092617","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("40","624-3656118-9","8497604207","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("41","624-3656118-9","correo_624-3656118-9@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("42","680-5351401-6","8092743182","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("43","680-5351401-6","8090903290","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("44","680-5351401-6","8496286905","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("45","680-5351401-6","correo_680-5351401-6@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("46","871-4803680-7","8098724654","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("47","871-4803680-7","8094762558","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("48","871-4803680-7","8497638829","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("49","871-4803680-7","correo_871-4803680-7@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("50","896-3589067-1","8093906471","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("51","896-3589067-1","8096615869","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("52","896-3589067-1","8491359934","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("53","896-3589067-1","correo_896-3589067-1@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("54","91-3156392-3","8096952062","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("55","91-3156392-3","8090680508","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("56","91-3156392-3","8492546356","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("57","91-3156392-3","correo_91-3156392-3@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("58","9876543210","8090690255","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("59","9876543210","8095812208","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("60","9876543210","8496990276","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("61","9876543210","correo_9876543210@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("62","CGURSA2ZH","8097514757","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("63","CGURSA2ZH","8096602958","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("64","CGURSA2ZH","8490470521","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("65","CGURSA2ZH","correo_CGURSA2ZH@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("66","DU7SF0F6U","8092543729","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("67","DU7SF0F6U","8091307086","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("68","DU7SF0F6U","8498904242","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("69","DU7SF0F6U","correo_DU7SF0F6U@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("70","H99BV0A7R","8090599953","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("71","H99BV0A7R","8096287041","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("72","H99BV0A7R","8499635344","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("73","H99BV0A7R","correo_H99BV0A7R@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("74","I66666666","8099315600","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("75","I66666666","8097671970","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("76","I66666666","8490413051","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("77","I66666666","correo_I66666666@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("78","O789O5KPQ","8099049346","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("79","O789O5KPQ","8094007577","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("80","O789O5KPQ","8492889849","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("81","O789O5KPQ","correo_O789O5KPQ@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("82","V2MZBT6D4","8092426515","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("83","V2MZBT6D4","8093463027","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("84","V2MZBT6D4","8490035594","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("85","V2MZBT6D4","correo_V2MZBT6D4@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("86","YPZYE19VT","8099788886","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("87","YPZYE19VT","8098837651","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("88","YPZYE19VT","8494821599","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("89","YPZYE19VT","correo_YPZYE19VT@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("90","ZMS1MVKF2","8097595041","Teléfono Principal");
INSERT INTO localizador_padres_de_pacientes VALUES("91","ZMS1MVKF2","8093510411","Teléfono Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("92","ZMS1MVKF2","8494766931","Movil Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("93","ZMS1MVKF2","correo_ZMS1MVKF2@example.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("94","379-7527899-6","(849) 858-5474","Movil Alterno");
INSERT INTO localizador_padres_de_pacientes VALUES("95","0470202064","(829) 277-6671","Telefono");
INSERT INTO localizador_padres_de_pacientes VALUES("96","0470202064","silvanavargas939@gmail.com","Email Personal");
INSERT INTO localizador_padres_de_pacientes VALUES("97","047-0202207-2","(809) 657-3541","Telefono");
INSERT INTO localizador_padres_de_pacientes VALUES("98","047-0202207-2","pedro15@gmail.com","Email Trabajo");



DROP TABLE IF EXISTS medicamento;

CREATE TABLE `medicamento` (
  `Id_medicamento` int NOT NULL,
  `nombre_medicamento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `formato` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Cantidad_total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`Id_medicamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO medicamento VALUES("0","Paracetamol","Analgésico y antifebril","Tableta","100");
INSERT INTO medicamento VALUES("1","Paracetamol","Analgésico y antifebril","Tableta","100");
INSERT INTO medicamento VALUES("2","Ibuprofeno","Antiinflamatorio no esteroideo","Cápsulas","75");
INSERT INTO medicamento VALUES("3","Amoxicilina","Antibiótico","Suspensión Oral","50");
INSERT INTO medicamento VALUES("4","Omeprazol","Inhibidor de la bomba de protones","Tabletas","60");
INSERT INTO medicamento VALUES("5","Loratadina","Antihistamínico","Tabletas","80");
INSERT INTO medicamento VALUES("6","Aspirina","Antiinflamatorio y analgésico","Tabletas","120");
INSERT INTO medicamento VALUES("7","Diazepam","Ansiolítico y relajante muscular","Tabletas","30");
INSERT INTO medicamento VALUES("8","Cetirizina","Antihistamínico","Tabletas","70");
INSERT INTO medicamento VALUES("9","Metformina","Antidiabético oral","Tabletas","90");
INSERT INTO medicamento VALUES("10","Atorvastatina","Estatina para reducir el colesterol","Tabletas","40");
INSERT INTO medicamento VALUES("11","Amlodipino","Bloqueador de canales de calcio","Tabletas","55");
INSERT INTO medicamento VALUES("12","Warfarina","Anticoagulante","Tabletas","25");
INSERT INTO medicamento VALUES("13","Furosemida","Diurético de asa","Tabletas","65");
INSERT INTO medicamento VALUES("14","Losartán","Bloqueador del receptor de angiotensina II","Tabletas","85");
INSERT INTO medicamento VALUES("15","Simvastatina","Estatina para reducir el colesterol","Tabletas","110");
INSERT INTO medicamento VALUES("16","Ciprofloxacino","Antibiótico","Tabletas","45");
INSERT INTO medicamento VALUES("17","Doxiciclina","Antibiótico","Cápsulas","30");
INSERT INTO medicamento VALUES("18","Tramadol","Analgésico opioide","Tabletas","40");
INSERT INTO medicamento VALUES("19","Morfina","Analgésico opioide","Solución inyectable","15");
INSERT INTO medicamento VALUES("20","Insulina","Hormona para controlar la glucosa","Frasco","25");
INSERT INTO medicamento VALUES("21","Uniplus","Desparasitante/Nisotadina","Suspensión Oral","100");
INSERT INTO medicamento VALUES("24","Givotan","Desparasitante/Nisotadina","Comprimido","100 ml");
INSERT INTO medicamento VALUES("25","Minamino Sport","Multivitamínico","Jarabe","350 ml");
INSERT INTO medicamento VALUES("26","Paracetamol","Multivitamínico","Comprimido","100 gr");
INSERT INTO medicamento VALUES("27","Paracetamolssss","Multivitamínico","Comprimido","350 ml");



DROP TABLE IF EXISTS medicos;

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

INSERT INTO medicos VALUES("1","459-1315087-3","343","Juan","Pérez","1");
INSERT INTO medicos VALUES("2","995-1440298-7","159","María","González","2");
INSERT INTO medicos VALUES("3","234-9716496-1","930","Pedro","Sánchez","3");
INSERT INTO medicos VALUES("4","861-8431641-6","253","Ana","López","4");
INSERT INTO medicos VALUES("5","621-2185886-2","442","Carlos","Rodríguez","5");
INSERT INTO medicos VALUES("6","480-7216596-1","129","Laura","Fernández","6");
INSERT INTO medicos VALUES("7","665-8308762-1","465","Alejandro","Hernández","7");
INSERT INTO medicos VALUES("8","291-9852881-0","673","Sofía","Torres","8");
INSERT INTO medicos VALUES("9","309-3893918-0","621","Luis","Gómez","9");
INSERT INTO medicos VALUES("10","919-5485667-9","735","Marta","Vargas","10");
INSERT INTO medicos VALUES("11","263-3717615-1","391","Roberto","Ramírez","11");
INSERT INTO medicos VALUES("12","227-9296180-9","816","Lucía","Morales","12");
INSERT INTO medicos VALUES("13","47-3318809-5","997","Javier","Castro","13");
INSERT INTO medicos VALUES("14","601-4507839-4","601","Fernanda","Ortega","14");
INSERT INTO medicos VALUES("15","889-1019313-8","443","Ricardo","Cruz","15");
INSERT INTO medicos VALUES("16","901-9833380-2","13","Isabel","Navarro","16");
INSERT INTO medicos VALUES("17","110-9148979-2","254","Gabriel","Pacheco","17");
INSERT INTO medicos VALUES("18","474-6417065-7","723","Valentina","Rojas","18");
INSERT INTO medicos VALUES("19","997-6342763-2","462","Andrés","Mendoza","19");
INSERT INTO medicos VALUES("20","989-4160293-1","265","Paula","Peña","20");
INSERT INTO medicos VALUES("21","296-1568835-8","883","Luis Manuel ","Sánchez ","1");
INSERT INTO medicos VALUES("22","0-3178921-5","412","Arlyn","Rosario","2");
INSERT INTO medicos VALUES("23","407-1212121-3","125","juan","gonzalez","14");



DROP TABLE IF EXISTS nino_padre;

CREATE TABLE `nino_padre` (
  `ID_Relacion` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `ID_Padre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Tipo_Padre` enum('Padre','Madre','Tutor Legal') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`ID_Relacion`),
  KEY `id_paciente` (`id_paciente`),
  KEY `ID_Padre` (`ID_Padre`)
) ENGINE=MyISAM AUTO_INCREMENT=292 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO nino_padre VALUES("1","1","91-3156392-3","Padre");
INSERT INTO nino_padre VALUES("2","1","H99BV0A7R","Madre");
INSERT INTO nino_padre VALUES("3","2","9876543210","Padre");
INSERT INTO nino_padre VALUES("4","2","YPZYE19VT","Madre");
INSERT INTO nino_padre VALUES("5","3","573-9534381-0","Padre");
INSERT INTO nino_padre VALUES("6","3","DU7SF0F6U","Madre");
INSERT INTO nino_padre VALUES("7","4","379-7527899-6","Padre");
INSERT INTO nino_padre VALUES("8","4","1132YT6PP","Madre");
INSERT INTO nino_padre VALUES("9","5","871-4803680-7","Padre");
INSERT INTO nino_padre VALUES("10","5","ZMS1MVKF2","Madre");
INSERT INTO nino_padre VALUES("11","6","492-1041105-0","Padre");
INSERT INTO nino_padre VALUES("12","6","V2MZBT6D4","Madre");
INSERT INTO nino_padre VALUES("13","7","896-3589067-1","Padre");
INSERT INTO nino_padre VALUES("14","7","CGURSA2ZH","Madre");
INSERT INTO nino_padre VALUES("15","8","442-9015540-2","Padre");
INSERT INTO nino_padre VALUES("16","8","54CWZTS91","Madre");
INSERT INTO nino_padre VALUES("17","9","194-4338446-5","Padre");
INSERT INTO nino_padre VALUES("18","9","I66666666","Madre");
INSERT INTO nino_padre VALUES("19","10","598-2194253-3","Padre");
INSERT INTO nino_padre VALUES("20","10","O789O5KPQ","Madre");
INSERT INTO nino_padre VALUES("21","11","624-3656118-9","Padre");
INSERT INTO nino_padre VALUES("22","11","H99BV0A7R","Madre");
INSERT INTO nino_padre VALUES("23","12","680-5351401-6","Padre");
INSERT INTO nino_padre VALUES("24","12","YPZYE19VT","Madre");
INSERT INTO nino_padre VALUES("25","13","568-9396909-9","Padre");
INSERT INTO nino_padre VALUES("26","13","DU7SF0F6U","Madre");
INSERT INTO nino_padre VALUES("27","14","91-3156392-3","Padre");
INSERT INTO nino_padre VALUES("28","14","1132YT6PP","Madre");
INSERT INTO nino_padre VALUES("29","15","9876543210","Padre");
INSERT INTO nino_padre VALUES("30","15","ZMS1MVKF2","Madre");
INSERT INTO nino_padre VALUES("31","16","573-9534381-0","Padre");
INSERT INTO nino_padre VALUES("32","16","V2MZBT6D4","Madre");
INSERT INTO nino_padre VALUES("33","17","379-7527899-6","Padre");
INSERT INTO nino_padre VALUES("34","17","CGURSA2ZH","Madre");
INSERT INTO nino_padre VALUES("35","18","871-4803680-7","Padre");
INSERT INTO nino_padre VALUES("36","18","54CWZTS91","Madre");
INSERT INTO nino_padre VALUES("37","19","492-1041105-0","Padre");
INSERT INTO nino_padre VALUES("38","19","I66666666","Madre");
INSERT INTO nino_padre VALUES("39","20","896-3589067-1","Padre");
INSERT INTO nino_padre VALUES("40","20","O789O5KPQ","Madre");
INSERT INTO nino_padre VALUES("41","21","442-9015540-2","Padre");
INSERT INTO nino_padre VALUES("42","21","H99BV0A7R","Madre");
INSERT INTO nino_padre VALUES("43","22","194-4338446-5","Padre");
INSERT INTO nino_padre VALUES("44","22","YPZYE19VT","Madre");
INSERT INTO nino_padre VALUES("45","23","598-2194253-3","Padre");
INSERT INTO nino_padre VALUES("46","23","DU7SF0F6U","Madre");
INSERT INTO nino_padre VALUES("47","24","624-3656118-9","Padre");
INSERT INTO nino_padre VALUES("48","24","1132YT6PP","Madre");
INSERT INTO nino_padre VALUES("49","25","680-5351401-6","Padre");
INSERT INTO nino_padre VALUES("50","25","ZMS1MVKF2","Madre");
INSERT INTO nino_padre VALUES("51","26","568-9396909-9","Padre");
INSERT INTO nino_padre VALUES("52","26","V2MZBT6D4","Madre");
INSERT INTO nino_padre VALUES("53","27","91-3156392-3","Padre");
INSERT INTO nino_padre VALUES("54","27","CGURSA2ZH","Madre");
INSERT INTO nino_padre VALUES("55","28","9876543210","Padre");
INSERT INTO nino_padre VALUES("56","28","54CWZTS91","Madre");
INSERT INTO nino_padre VALUES("57","29","573-9534381-0","Padre");
INSERT INTO nino_padre VALUES("58","29","I66666666","Madre");
INSERT INTO nino_padre VALUES("59","30","379-7527899-6","Padre");
INSERT INTO nino_padre VALUES("60","30","O789O5KPQ","Madre");
INSERT INTO nino_padre VALUES("290","4","0470202064","Madre");
INSERT INTO nino_padre VALUES("291","36","047-0202207-2","Padre");



DROP TABLE IF EXISTS paciente;

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

INSERT INTO paciente VALUES("11","Fernando","Ferrer","masculino","2016-03-19","República Dominicana","padre","Calle Duarte, Puerto Plata");
INSERT INTO paciente VALUES("10","Isabel","Pérez","femenino","2022-08-25","República Dominicana","madre","Calle Salomé Ureña, Moca");
INSERT INTO paciente VALUES("9","Manuel","Rodríguez","masculino","2019-05-18","República Dominicana","padre_madre","Calle El Sol, La Vega");
INSERT INTO paciente VALUES("8","Laura","García","femenino","2014-12-05","República Dominicana","madre","Avenida Duarte, Santo Domingo");
INSERT INTO paciente VALUES("7","Ramón","Sánchez","masculino","2023-05-02","República Dominicana","padre","Calle 27 de Febrero, Santiago");
INSERT INTO paciente VALUES("6","Luisa","Martínez","femenino","2016-03-28","República Dominicana","padre_madre","Calle Las Mercedes, San Pedro de Macorís");
INSERT INTO paciente VALUES("5","Pedro","Díaz","masculino","2018-01-07","República Dominicana","madre","Avenida John F. Kennedy, Santo Domingo");
INSERT INTO paciente VALUES("4","María","López","femenino","2016-12-17","República Dominicana","padre","Calle Independencia, Puerto Plata");
INSERT INTO paciente VALUES("3","Carlos","Fernández","masculino","2016-10-02","República Dominicana","madre","Calle Duarte, La Romana");
INSERT INTO paciente VALUES("2","Ana Karina","Santana","femenino","2018-11-17","República Dominicana","madre","Avenida 27 de Febrero, Santiago");
INSERT INTO paciente VALUES("1","Juan Manuel","Gómez Masara","masculino","2019-09-21","Venezuela","padre_madre","Calle Principal, Santo Domingo");
INSERT INTO paciente VALUES("12","Carmen","Guzmán","femenino","2017-07-24","República Dominicana","madre","Calle Padre Billini, Santo Domingo");
INSERT INTO paciente VALUES("13","Roberto","Alvarez","masculino","2014-08-25","República Dominicana","padre_madre","Avenida Independencia, Higüey");
INSERT INTO paciente VALUES("14","Sofía","Jiménez","femenino","2016-12-17","República Dominicana","padre","Calle El Sol, La Romana");
INSERT INTO paciente VALUES("15","Diego","Martínez","masculino","2016-06-17","República Dominicana","madre","Calle 30 de Marzo, San Francisco de Macorís");
INSERT INTO paciente VALUES("16","Elena","Morales","femenino","2017-05-29","República Dominicana","padre_madre","Calle Principal, Santo Domingo Este");
INSERT INTO paciente VALUES("17","Juan Pablo","Ortiz","masculino","2023-08-29","República Dominicana","madre","Calle 27 de Febrero, Santiago");
INSERT INTO paciente VALUES("18","Marisol","Cruz","femenino","2020-11-04","República Dominicana","padre","Calle El Sol, La Romana");
INSERT INTO paciente VALUES("19","Héctor","Hernández","masculino","2019-03-28","República Dominicana","madre","Calle Duarte, Santo Domingo");
INSERT INTO paciente VALUES("20","Luis","Santana","masculino","2019-08-28","República Dominicana","padre_madre","Avenida John F. Kennedy, Santo Domingo");
INSERT INTO paciente VALUES("21","Juana","Gómez","femenino","2016-02-28","República Dominicana","padre","Calle Principal, Santiago de los Caballeros");
INSERT INTO paciente VALUES("22","Alberto","Reyes","masculino","2018-03-29","República Dominicana","madre","Calle Duarte, La Vega");
INSERT INTO paciente VALUES("23","Adriana","Luna","femenino","2018-04-25","República Dominicana","padre_madre","Calle El Sol, Moca");
INSERT INTO paciente VALUES("24","Antonio","Martínez","masculino","2022-11-06","República Dominicana","madre","Avenida Independencia, Santo Domingo");
INSERT INTO paciente VALUES("25","Catalina","García","femenino","2014-01-26","República Dominicana","padre_madre","Calle Las Mercedes, San Pedro de Macorís");
INSERT INTO paciente VALUES("26","Francisco","Ramírez","masculino","2019-01-12","República Dominicana","padre","Calle 27 de Febrero, Santiago");
INSERT INTO paciente VALUES("27","Margarita","Méndez","femenino","2018-02-14","República Dominicana","madre","Avenida Duarte, Santo Domingo Este");
INSERT INTO paciente VALUES("28","Emilio","Santos","masculino","2019-07-11","República Dominicana","padre_madre","Calle El Sol, La Vega");
INSERT INTO paciente VALUES("29","Rosa","Hernández","femenino","2018-11-05","República Dominicana","padre","Calle Salomé Ureña, Moca");
INSERT INTO paciente VALUES("30","Manuel","Gómez","masculino","2021-08-24","República Dominicana","madre","Calle Duarte, Puerto Plata");
INSERT INTO paciente VALUES("31","Jose Anulfo","Castillo Rivera","masculino","2019-04-27","República Dominicana","padre_madre","Guaco, La Vega, Rep. Dominicana");
INSERT INTO paciente VALUES("32","Jose","Rosado","masculino","2020-03-26","República Dominicana","padre_madre","Guaco, La Vega, Rep. Dominicana");
INSERT INTO paciente VALUES("33","Americo","Valdez","masculino","2018-10-18","República Dominicana","padre_madre","El pueblo, Calle P, Calle 1, Casa1");
INSERT INTO paciente VALUES("34","Alex","Abreu","masculino","2019-04-12","República Dominicana","padre_madre","Cuidad e, Calle b, Apartemento 1b, 3er nivel");
INSERT INTO paciente VALUES("35","Randy roniel","Rojas Rivas","masculino","2015-08-06","República Dominicana","padre_madre","villa francisca ");
INSERT INTO paciente VALUES("36","jose ","Capellan","masculino","2024-05-17","DO","padre_madre","La cigua ");



DROP TABLE IF EXISTS paciente_analitica;

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




DROP TABLE IF EXISTS pacientes_vacunas;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO pacientes_vacunas VALUES("1","6","0","1era","NA","");
INSERT INTO pacientes_vacunas VALUES("2","6","0","2da","NA","");
INSERT INTO pacientes_vacunas VALUES("3","7","0","3ra","NA","");
INSERT INTO pacientes_vacunas VALUES("4","7","0","1era","NA","");
INSERT INTO pacientes_vacunas VALUES("5","8","7","8va","1er","2023-07-12");
INSERT INTO pacientes_vacunas VALUES("6","9","3","2da","NA","fecha_no_provista");
INSERT INTO pacientes_vacunas VALUES("7","11","7","1era","1er","fecha_no_provista");
INSERT INTO pacientes_vacunas VALUES("8","16","1","1era","1er","2023-07-20");
INSERT INTO pacientes_vacunas VALUES("9","19","3","1era","1er","2023-07-07");
INSERT INTO pacientes_vacunas VALUES("10","8","5","4ta","1er","2023-12-14");
INSERT INTO pacientes_vacunas VALUES("11","31","1","4ta","6to","2024-04-11");
INSERT INTO pacientes_vacunas VALUES("12","2","1","2da","NA","2024-04-04");
INSERT INTO pacientes_vacunas VALUES("13","35","2","1era","1er","2024-04-30");
INSERT INTO pacientes_vacunas VALUES("14","35","2","1era","1er","2024-05-23");
INSERT INTO pacientes_vacunas VALUES("15","36","2","1era","2do","fecha_no_provista");



DROP TABLE IF EXISTS padecimientos_comunes;

CREATE TABLE `padecimientos_comunes` (
  `id_padecimiento` int NOT NULL AUTO_INCREMENT,
  `nombre_padecimiento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_padecimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO padecimientos_comunes VALUES("3","Bronquitis aguda","Inflamación de los bronquios, generalmente causada por una infección viral o bacteriana.");
INSERT INTO padecimientos_comunes VALUES("4","Asma","Enfermedad crónica de las vías respiratorias que causa dificultad para respirar y sibilancias.");
INSERT INTO padecimientos_comunes VALUES("5","Hipertensión arterial","Aumento persistente de la presión arterial en las arterias.");
INSERT INTO padecimientos_comunes VALUES("6","Diabetes tipo 2","Trastorno crónico que afecta la forma en que el cuerpo regula el azúcar en la sangre.");
INSERT INTO padecimientos_comunes VALUES("7","Dolor de cabeza tensional","Cefalea caracterizada por una sensación de tensión o presión en la cabeza.");
INSERT INTO padecimientos_comunes VALUES("8","Dolor de espalda","Malestar o dolor en la región de la espalda.");
INSERT INTO padecimientos_comunes VALUES("9","Gastritis","Inflamación del revestimiento del estómago, generalmente causada por infección o irritación.");
INSERT INTO padecimientos_comunes VALUES("10","Úlcera péptica","Lesión abierta en la mucosa del estómago o del duodeno.");
INSERT INTO padecimientos_comunes VALUES("11","Alergia a la penicilina","Respuesta exagerada del sistema inmunológico a una sustancia extraña o alérgeno.");
INSERT INTO padecimientos_comunes VALUES("12","Sinusitis","Inflamación de los senos paranasales, generalmente causada por una infección bacteriana o viral.");
INSERT INTO padecimientos_comunes VALUES("13","Infección urinaria","Infección en cualquier parte del sistema urinario, como la vejiga o los riñones.");
INSERT INTO padecimientos_comunes VALUES("14","Acidez estomacal","Sensación de ardor en la parte inferior del pecho, causada por el reflujo del ácido del estómago.");
INSERT INTO padecimientos_comunes VALUES("16","Enfermedad de Huntington","Trastorno neurológico hereditario que afecta el movimiento y las funciones cognitivas.");
INSERT INTO padecimientos_comunes VALUES("17","Distrofia muscular de Duchenne","Enfermedad genética que causa debilidad muscular progresiva y afecta principalmente a los niños.");
INSERT INTO padecimientos_comunes VALUES("18","Fibrosis quística","Enfermedad genética que afecta principalmente los pulmones y el sistema digestivo.");
INSERT INTO padecimientos_comunes VALUES("19","Hemofilia","Trastorno de la coagulación de la sangre causado por un defecto genético en los genes de la coagulación.");
INSERT INTO padecimientos_comunes VALUES("20","Síndrome de Marfan","Trastorno genético del tejido conectivo que afecta el corazón, los ojos y los vasos sanguíneos.");
INSERT INTO padecimientos_comunes VALUES("21","Enfermedad de Gaucher","Trastorno genético que afecta la función del sistema linfático y puede causar agrandamiento del hígado y el bazo.");
INSERT INTO padecimientos_comunes VALUES("22","Enfermedad de Wilson","Trastorno genético del metabolismo del cobre que causa acumulación de cobre en varios órganos.");
INSERT INTO padecimientos_comunes VALUES("23","Síndrome de Lynch","Trastorno hereditario que aumenta el riesgo de desarrollar cáncer de colon y otros cánceres relacionados.");
INSERT INTO padecimientos_comunes VALUES("24","Síndrome de Turner","Trastorno genético que afecta el desarrollo sexual en las mujeres y está asociado con características físicas distintivas.");
INSERT INTO padecimientos_comunes VALUES("25","Síndrome de Down","Trisomía del cromosoma 21 que causa discapacidad intelectual y características físicas características.");
INSERT INTO padecimientos_comunes VALUES("26","Colesterol alto","Condición en la cual los niveles de colesterol en la sangre están elevados, aumentando el riesgo de enfermedad cardiovascular.");
INSERT INTO padecimientos_comunes VALUES("27","Hipertensión arterial","Aumento persistente de la presión arterial en las arterias.");
INSERT INTO padecimientos_comunes VALUES("28","Problemas de tiroides","Trastornos que afectan la glándula tiroides y pueden causar problemas de funcionamiento en el cuerpo.");
INSERT INTO padecimientos_comunes VALUES("29","Epilepsia","Trastorno neurológico crónico caracterizado por convulsiones recurrentes debido a la actividad anormal del cerebro.");



DROP TABLE IF EXISTS perinatal;

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




DROP TABLE IF EXISTS prescripcion_medica;

CREATE TABLE `prescripcion_medica` (
  `id_receta` int NOT NULL AUTO_INCREMENT,
  `id_consulta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_centro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_paciente` int NOT NULL,
  `id_medico` int NOT NULL,
  `fecha_hora` datetime NOT NULL,
  PRIMARY KEY (`id_receta`),
  KEY `FK_Prescripcion_Medica_Consultas` (`id_consulta`(250)),
  KEY `FK_Prescripcion_Medica_Institucion_de_Salud` (`id_centro`(250))
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO prescripcion_medica VALUES("2","1","3","1","1","0000-00-00 00:00:00");
INSERT INTO prescripcion_medica VALUES("3","1","3","1","2","2024-04-03 00:01:47");
INSERT INTO prescripcion_medica VALUES("4","1","3","1","1","2024-04-02 20:14:24");
INSERT INTO prescripcion_medica VALUES("10","na","2","1","2","2024-04-08 11:18:55");
INSERT INTO prescripcion_medica VALUES("9","24","1","9","1","2024-04-05 11:19:52");
INSERT INTO prescripcion_medica VALUES("11","na","1","2","9","2024-04-13 20:18:42");



DROP TABLE IF EXISTS referimientos;

CREATE TABLE `referimientos` (
  `ID_Referimiento` int NOT NULL,
  `medico_referido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Fecha_Referimiento` date DEFAULT NULL,
  `Motivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `id_centro` int DEFAULT NULL,
  `id_medico` int NOT NULL,
  `id_paciente` int NOT NULL,
  PRIMARY KEY (`ID_Referimiento`),
  KEY `FK_Referimientos_Institucion_de_Salud` (`id_centro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO referimientos VALUES("1","Dr. Carlos Fernández Especialidad: Cardiología Hospital General de la Ciudad","2024-04-16","El paciente refiere haber presentado en los últimos 3 días episodios de dolor torácico opresivo, acompañado de mareos y palpitaciones. Al examen físico se encuentra taquicárdico, con presión arterial elevada y signos de insuficiencia cardíaca congestiva i","Los exámenes de laboratorio realizados muestran alteraciones en los niveles de troponina y BNP, lo que sugiere probable descompensación de su cardiopatía isquémica.","1","10","10");
INSERT INTO referimientos VALUES("2","Dr. Carlos Fernández Especialidad: Cardiología Hospital General de la Ciudad","2024-04-16","El paciente refiere haber presentado en los últimos 3 días episodios de dolor torácico opresivo, acompañado de mareos y palpitaciones. Al examen físico se encuentra taquicárdico, con presión arterial elevada y signos de insuficiencia cardíaca congestiva i","Los exámenes de laboratorio realizados muestran alteraciones en los niveles de troponina y BNP, lo que sugiere probable descompensación de su cardiopatía isquémica.","1","10","10");
INSERT INTO referimientos VALUES("3","Dr. Carlos Fernández Especialidad: Cardiología Hospital General de la Ciudad","2024-04-16","El paciente refiere haber presentado en los últimos 3 días episodios de dolor torácico opresivo, acompañado de mareos y palpitaciones. Al examen físico se encuentra taquicárdico, con presión arterial elevada y signos de insuficiencia cardíaca congestiva i","Los exámenes de laboratorio realizados muestran alteraciones en los niveles de troponina y BNP, lo que sugiere probable descompensación de su cardiopatía isquémica.","1","10","10");
INSERT INTO referimientos VALUES("4","Dr. Carlos Fernández Especialidad: Cardiología Hospital General de la Ciudad","2024-04-16","El paciente refiere haber presentado en los últimos 3 días episodios de dolor torácico opresivo, acompañado de mareos y palpitaciones. Al examen físico se encuentra taquicárdico, con presión arterial elevada y signos de insuficiencia cardíaca congestiva i","Los exámenes de laboratorio realizados muestran alteraciones en los niveles de troponina y BNP, lo que sugiere probable descompensación de su cardiopatía isquémica.","1","10","10");
INSERT INTO referimientos VALUES("5","Dr. Carlos Fernández Especialidad: Cardiología Hospital General de la Ciudad","2024-04-17","El paciente refiere haber presentado en los últimos 3 días episodios de dolor torácico opresivo, acompañado de mareos y palpitaciones. Al examen físico se encuentra taquicárdico, con presión arterial elevada y signos de insuficiencia cardíaca congestiva i","Dado el cuadro clínico del paciente y los hallazgos encontrados, me permito referirlo a su servicio de Cardiología para evaluación, ajuste de tratamiento y seguimiento especializado.\nAgradezco de antemano su atención y quedó a la espera de sus comentarios.","1","2","1");
INSERT INTO referimientos VALUES("6","Dr. Carlos Fernández Especialidad: Cardiología","2024-04-17","El paciente Juan Rodríguez es hipertenso y diabético, en tratamiento con metformina y enalapril. Hace 2 años sufrió un infarto agudo de miocardio, por el cual fue intervenido quirúrgicamente.","El paciente refiere haber presentado en los últimos 3 días episodios de dolor torácico opresivo, acompañado de mareos y palpitaciones. Al examen físico se encuentra taquicárdico, con presión arterial elevada y signos de insuficiencia cardíaca congestiva incipiente.\n\nLos exámenes de laboratorio realizados muestran alteraciones en los niveles de troponina y BNP, lo que sugiere probable descompensación de su cardiopatía isquémica.","1","2","1");
INSERT INTO referimientos VALUES("7","Dr. Rafael Veloz en Clinica Concepción, La Vega","2024-04-17","Para tratar una Afección de la vista que solo él puede ver como especialista, bla bla","Se le hicieron todos los análisis de lugar ","1","3","10");
INSERT INTO referimientos VALUES("8","pedro gomez","2024-05-31","por salud ","s","1","1","1");



DROP TABLE IF EXISTS seguro;

CREATE TABLE `seguro` (
  `Id_seguro_salud` int NOT NULL,
  `Nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`Id_seguro_salud`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO seguro VALUES("1","ARS Universal");
INSERT INTO seguro VALUES("2","ARS Palic");
INSERT INTO seguro VALUES("3","ARS Humano");
INSERT INTO seguro VALUES("4","ARS Senasa");
INSERT INTO seguro VALUES("5","ARS Mapfre Salud");
INSERT INTO seguro VALUES("6","ARS Monumental");
INSERT INTO seguro VALUES("7","ARS Renacer");
INSERT INTO seguro VALUES("8","ARS Meta Salud");
INSERT INTO seguro VALUES("9","ARS Futuro");
INSERT INTO seguro VALUES("10","ARS Semma");
INSERT INTO seguro VALUES("11","Ars Banreservas");
INSERT INTO seguro VALUES("12","Ars Prueba Prueba");



DROP TABLE IF EXISTS seguro_paciente;

CREATE TABLE `seguro_paciente` (
  `NSS` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `id_paciente` int DEFAULT NULL,
  `Id_seguro_salud` int DEFAULT NULL,
  KEY `FK_Seguro_Paciente_Paciente` (`id_paciente`),
  KEY `FK_Seguro_Paciente_Seguro` (`Id_seguro_salud`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO seguro_paciente VALUES("","3","0");
INSERT INTO seguro_paciente VALUES("","2","0");
INSERT INTO seguro_paciente VALUES("649898498","1","1");
INSERT INTO seguro_paciente VALUES("","4","0");
INSERT INTO seguro_paciente VALUES("g988987989","5","10");
INSERT INTO seguro_paciente VALUES("889895269","6","4");
INSERT INTO seguro_paciente VALUES("872698855","7","2");
INSERT INTO seguro_paciente VALUES("54556888","8","3");
INSERT INTO seguro_paciente VALUES("5555888","9","10");
INSERT INTO seguro_paciente VALUES("Array","10","0");
INSERT INTO seguro_paciente VALUES("Array","11","0");
INSERT INTO seguro_paciente VALUES("5689898","12","3");
INSERT INTO seguro_paciente VALUES("155569486849","13","10");
INSERT INTO seguro_paciente VALUES("5689898","14","2");
INSERT INTO seguro_paciente VALUES("5689898","15","2");
INSERT INTO seguro_paciente VALUES("5689898","16","2");
INSERT INTO seguro_paciente VALUES("5689898","17","10");
INSERT INTO seguro_paciente VALUES("5689898","18","4");
INSERT INTO seguro_paciente VALUES("5689898","19","4");
INSERT INTO seguro_paciente VALUES("5689898","20","2");
INSERT INTO seguro_paciente VALUES("","21","0");
INSERT INTO seguro_paciente VALUES("","22","0");
INSERT INTO seguro_paciente VALUES("","23","0");
INSERT INTO seguro_paciente VALUES("","24","0");
INSERT INTO seguro_paciente VALUES("53669885","31","2");
INSERT INTO seguro_paciente VALUES("125789","32","10");
INSERT INTO seguro_paciente VALUES("125789","32","10");
INSERT INTO seguro_paciente VALUES("7458312","33","6");
INSERT INTO seguro_paciente VALUES("1452368","35","3");
INSERT INTO seguro_paciente VALUES("1874589","36","3");
INSERT INTO seguro_paciente VALUES("","25","4");



DROP TABLE IF EXISTS tipo_vacunas;

CREATE TABLE `tipo_vacunas` (
  `id_vacuna` int NOT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `total_dosis` int DEFAULT NULL,
  PRIMARY KEY (`id_vacuna`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO tipo_vacunas VALUES("1","BCG","La vacuna BCG* protege contra la tuberculosis y se administra en una sola dosis.","1");
INSERT INTO tipo_vacunas VALUES("2","Hepatitis B","La vacuna contra la hepatitis B previene la infección por el virus de la hepatitis B. Se administra en múltiples dosis según el esquema recomendado.","3");
INSERT INTO tipo_vacunas VALUES("3","DTP","La vacuna DTP protege contra la difteria, el tétanos y la tos ferina. Se administra en múltiples dosis según el esquema recomendado.","5");
INSERT INTO tipo_vacunas VALUES("4","Polio","La vacuna contra la poliomielitis protege contra la polio. Se administra en múltiples dosis según el esquema recomendado.","4");
INSERT INTO tipo_vacunas VALUES("5","Hib","La vacuna Hib protege contra Haemophilus influenzae tipo b, una bacteria que puede causar enfermedades graves en los niños. Se administra en múltiples dosis según el esquema recomendado.","3");
INSERT INTO tipo_vacunas VALUES("6","Neumococo","La vacuna contra el neumococo protege contra Streptococcus pneumoniae, una bacteria que puede causar enfermedades como la neumonía y la meningitis. Se administra en múltiples dosis según el esquema recomendado.","4");
INSERT INTO tipo_vacunas VALUES("7","Rotavirus","La vacuna contra el rotavirus protege contra una infección viral que puede causar diarrea grave en los niños. Se administra en múltiples dosis según el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("8","Sarampión, Paperas, Rubéola (MMR)","La vacuna MMR protege contra el sarampión, las paperas y la rubéola. Se administra en múltiples dosis según el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("9","Varicela","La vacuna contra la varicela protege contra el virus de la varicela-zóster, que causa la varicela. Se administra en múltiples dosis según el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("10","Hepatitis A","La vacuna contra la hepatitis A previene la infección por el virus de la hepatitis A. Se administra en múltiples dosis según el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("11","Influenza","vacuna del 2023","1");



DROP TABLE IF EXISTS tipos_analisis;

CREATE TABLE `tipos_analisis` (
  `id_analisis` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_analisis`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO tipos_analisis VALUES("1","Análisis de Sangre","Examen completo de sangre para evaluar la salud ge");
INSERT INTO tipos_analisis VALUES("2","Análisis de Orina","Prueba para detectar enfermedades y evaluar la sal");
INSERT INTO tipos_analisis VALUES("3","Análisis de Heces","Prueba para detectar infecciones y enfermedades di");
INSERT INTO tipos_analisis VALUES("4","Electrocardiograma","Prueba para medir la actividad eléctrica del coraz");
INSERT INTO tipos_analisis VALUES("5","Radiografía de Tórax","Imagen del tórax para evaluar los pulmones y el co");
INSERT INTO tipos_analisis VALUES("6","Tomografía Computarizada","Escaneo detallado del cuerpo para detectar anomalí");
INSERT INTO tipos_analisis VALUES("7","Resonancia Magnética","Imagen detallada de los órganos y tejidos internos");
INSERT INTO tipos_analisis VALUES("8","Ultrasonido","Imagen del interior del cuerpo mediante ondas sono");
INSERT INTO tipos_analisis VALUES("9","Biopsia","Extracción de una muestra de tejido para su anális");
INSERT INTO tipos_analisis VALUES("10","Análisis de Colesterol","Prueba para medir los niveles de colesterol en la ");
INSERT INTO tipos_analisis VALUES("11","Prueba de Glucosa","Medición del nivel de azúcar en la sangre.");
INSERT INTO tipos_analisis VALUES("12","Prueba de Función Hepática","Evaluación de la función del hígado.");
INSERT INTO tipos_analisis VALUES("13","Prueba de Función Renal","Evaluación de la función de los riñones.");
INSERT INTO tipos_analisis VALUES("14","Análisis de Hormonas","Medición de los niveles hormonales en el cuerpo.");
INSERT INTO tipos_analisis VALUES("15","Prueba de Embarazo","Detección de embarazo mediante análisis de sangre ");
INSERT INTO tipos_analisis VALUES("16","Análisis de Tiroides","Evaluación de la función de la glándula tiroides.");
INSERT INTO tipos_analisis VALUES("17","Hemocultivo","Detección de infecciones en la sangre.");
INSERT INTO tipos_analisis VALUES("18","Prueba de Tolerancia a la Glucosa","Evaluación de cómo el cuerpo procesa el azúcar.");
INSERT INTO tipos_analisis VALUES("19","Análisis de Electrolicitos","Medición de los niveles de electrolitos en la sang");
INSERT INTO tipos_analisis VALUES("20","Prueba de Función Pulmonar","Evaluación de la función respiratoria y capacidad ");
INSERT INTO tipos_analisis VALUES("21","Perfil lipídico 1","Mide parámetros como el colesterol total, el HDL (colesterol bueno), LDL y  VLDL (colesteroles malos), Apolipoproteína B, y triglicéridos.");



DROP TABLE IF EXISTS trabajos_medicos;

CREATE TABLE `trabajos_medicos` (
  `id_trabajo_medico` int NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `descripcion_trabajo_medico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_trabajo_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO trabajos_medicos VALUES("1","2023-12-26","Consulta de rutina");
INSERT INTO trabajos_medicos VALUES("2","2023-12-25","Control de vacunas");
INSERT INTO trabajos_medicos VALUES("3","2023-12-24","Evaluación del desarrollo infantil");
INSERT INTO trabajos_medicos VALUES("4","2023-12-23","Tratamiento de infección respiratoria");
INSERT INTO trabajos_medicos VALUES("5","2023-12-22","Atención de fiebre");
INSERT INTO trabajos_medicos VALUES("6","2023-12-21","Seguimiento de enfermedad crónica");
INSERT INTO trabajos_medicos VALUES("7","2023-12-20","Diagnóstico y tratamiento de enfermedades gastrointestinales");
INSERT INTO trabajos_medicos VALUES("8","2023-12-19","Valoración de alergias");
INSERT INTO trabajos_medicos VALUES("9","2023-12-18","Atención de dolor abdominal");
INSERT INTO trabajos_medicos VALUES("10","2023-12-17","Evaluación de erupciones cutáneas");
INSERT INTO trabajos_medicos VALUES("11","2023-12-16","Control de asma");
INSERT INTO trabajos_medicos VALUES("12","2023-12-15","Atención de problemas de sueño");
INSERT INTO trabajos_medicos VALUES("13","2023-12-14","Diagnóstico y tratamiento de infecciones urinarias");
INSERT INTO trabajos_medicos VALUES("14","2023-12-13","Consulta por problemas de crecimiento");
INSERT INTO trabajos_medicos VALUES("15","2023-12-12","Seguimiento de enfermedades crónicas");
INSERT INTO trabajos_medicos VALUES("16","2023-12-11","Atención de dolor de oído");
INSERT INTO trabajos_medicos VALUES("17","2023-12-10","Evaluación de problemas de alimentación");
INSERT INTO trabajos_medicos VALUES("18","2023-12-09","Control de enfermedades respiratorias");
INSERT INTO trabajos_medicos VALUES("19","2023-12-08","Diagnóstico y tratamiento de enfermedades infecciosas");
INSERT INTO trabajos_medicos VALUES("20","2023-12-07","Atención de problemas de comportamiento");
INSERT INTO trabajos_medicos VALUES("21","2024-04-14","cirugia a corazon Abierto ");



DROP TABLE IF EXISTS usuario;

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `Pass1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Confirm_pass` varchar(50) CHARACTER SET utf32 COLLATE utf32_spanish2_ci NOT NULL,
  `estado` varchar(9) NOT NULL,
  `nombre_completo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO usuario VALUES("1","Admin","123","123","Activo","José Anulfo Castillo Rivera","Administrador");
INSERT INTO usuario VALUES("8","usuario3","123","123","Activo","Juan Pérez","Secretaría");
INSERT INTO usuario VALUES("9","usuario4","123","123","Activo","María Rodríguez","Doctor");
INSERT INTO usuario VALUES("10","usuario5","123","123","Activo","Luis Martínez","Administrador");
INSERT INTO usuario VALUES("11","usuario6","123","123","Activo","Ana García","Secretaría");
INSERT INTO usuario VALUES("12","usuario7","123","123","Activo","Pedro Gómez","Doctor");
INSERT INTO usuario VALUES("13","usuario8","123","123","Activo","Laura Díaz","Administrador");
INSERT INTO usuario VALUES("14","usuario9","123","123","Activo","Carlos Hernández","Secretaría");
INSERT INTO usuario VALUES("15","usuario10","123","123","Activo","Sofía Sánchez","Doctor");
INSERT INTO usuario VALUES("16","usuario11","123","123","Activo","Javier López","Administrador");
INSERT INTO usuario VALUES("17","usuario12","123","123","Activo","Patricia Reyes","Secretaría");



SET FOREIGN_KEY_CHECKS=1;