SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS pediatra_sis;

USE pediatra_sis;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




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




DROP TABLE IF EXISTS consultas;

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

INSERT INTO datos_padres_de_pacientes VALUES("1234567890","c├®dula","Juan","P├®rez","Padre","Dominicana","Masculino","Calle 123","Ingeniero");
INSERT INTO datos_padres_de_pacientes VALUES("A12345678","pasaporte","Mar├¡a","Gonz├ílez","Madre","Dominicana","Femenino","Avenida 456","Doctora");
INSERT INTO datos_padres_de_pacientes VALUES("9876543210"," c├®dula","Pedro","S├ínchez","Padre","Paquist├ín ","Maculino","Carrera 789","Abogado");
INSERT INTO datos_padres_de_pacientes VALUES("B87654321","pasaporte","Ana","L├│pez","Madre","Dominicana","Femenino","Calle Principal","Arquitecta");
INSERT INTO datos_padres_de_pacientes VALUES("5432109876","c├®dula","Carlos","Rodr├¡guez","Padre","Dominicana","Masculino","Avenida Central","Empresario");
INSERT INTO datos_padres_de_pacientes VALUES("C76543210","pasaporte","Laura","Fern├índez","Madre","Dominicana","Femenino","Calle Secundaria","Enfermera");
INSERT INTO datos_padres_de_pacientes VALUES("1111111111","c├®dula","Alejandro","Hern├índez","Padre","Dominicana","Masculino","Avenida 123","Profesor");
INSERT INTO datos_padres_de_pacientes VALUES("D11111111","pasaporte","Sof├¡a","Torres","Madre","Dominicana","Femenino","Carrera Principal","Psic├│loga");
INSERT INTO datos_padres_de_pacientes VALUES("2222222222","c├®dula","Luis","G├│mez","Padre","Dominicana","Masculino","Calle 456","Contador");
INSERT INTO datos_padres_de_pacientes VALUES("E22222222","pasaporte","Marta","Vargas","Madre","Dominicana","Femenino","Avenida Secundaria","Dise├▒adora");
INSERT INTO datos_padres_de_pacientes VALUES("3333333333","c├®dula","Roberto","Ram├¡rez","Padre","Dominicana","Masculino","Calle 789","M├®dico");
INSERT INTO datos_padres_de_pacientes VALUES("F33333333","pasaporte","Luc├¡a","Morales","Madre","Dominicana","Femenino","Avenida Principal","Ingeniera");
INSERT INTO datos_padres_de_pacientes VALUES("4444444444","c├®dula","Javier","Castro","Padre","Dominicana","Masculino","Carrera 123","Abogado");
INSERT INTO datos_padres_de_pacientes VALUES("G44444444","pasaporte","Fernanda","Ortega","Madre","Dominicana","Femenino","Calle Central","Empresaria");
INSERT INTO datos_padres_de_pacientes VALUES("5555555555","c├®dula","Ricardo","Cruz","Padre","Dominicana","Masculino","Avenida Secundaria","Ingeniero");
INSERT INTO datos_padres_de_pacientes VALUES("H55555555","pasaporte","Isabel","Navarro","Madre","Dominicana","Femenino","Carrera Secundaria","Arquitecta");
INSERT INTO datos_padres_de_pacientes VALUES("6666666666","c├®dula","Gabriel","Pacheco","Padre","Dominicana","Masculino","Calle Principal","Empresario");
INSERT INTO datos_padres_de_pacientes VALUES("I66666666"," pasaporte","Valentina","Rojas","Madre","Pa├¡ses Bajos ","Femenino","Avenida 123","M├®dica");
INSERT INTO datos_padres_de_pacientes VALUES("777-7777777-8"," C├®dula","Andr├®s Alberto","Mendoza","Padre","Rep├║blica Dominicana ","Masculino","Carrera 456","Ingeniero");
INSERT INTO datos_padres_de_pacientes VALUES("J77777777","pasaporte","Paula Maria","Pe├▒a","Madre","Espa├▒a","Femenino","Calle 789","Arquitecta");
INSERT INTO datos_padres_de_pacientes VALUES("111-1111111-1","C├®dula","Joel","Rosario","Padre","DO","Maculino","Guaco, La Vega, Rep. Dominicana","profesor");
INSERT INTO datos_padres_de_pacientes VALUES("047-0170172-5","C├®dula","Joel","Rosario","Padre","DO","Maculino","Guaco, La Vega, Rep. Dominicana","profesor");



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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO detalle_historia_clinica VALUES("1","1","3","SSDSDS","2023-07-13");
INSERT INTO detalle_historia_clinica VALUES("2","2","6","hola","2023-07-11");
INSERT INTO detalle_historia_clinica VALUES("3","2","9","SASD","2023-07-09");
INSERT INTO detalle_historia_clinica VALUES("4","3","3","AASAsas","2023-07-11");
INSERT INTO detalle_historia_clinica VALUES("5","3","11","MODF","2023-06-29");
INSERT INTO detalle_historia_clinica VALUES("6","4","3","AASAsas","2023-07-12");
INSERT INTO detalle_historia_clinica VALUES("7","5","7","ssss","2023-07-05");
INSERT INTO detalle_historia_clinica VALUES("8","6","3","SASD","2023-07-18");
INSERT INTO detalle_historia_clinica VALUES("9","7","4","AASAsas","2023-07-13");
INSERT INTO detalle_historia_clinica VALUES("10","8","3","AASAsas","2023-07-20");
INSERT INTO detalle_historia_clinica VALUES("11","9","3","MODIF","2023-07-19");
INSERT INTO detalle_historia_clinica VALUES("12","10","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("13","11","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("14","12","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("15","13","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("16","14","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("17","15","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("18","16","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("19","17","","2023-12-22","0000-00-00");
INSERT INTO detalle_historia_clinica VALUES("20","18","3","AASAsas","2023-12-15");
INSERT INTO detalle_historia_clinica VALUES("21","19","5","HOLA PRUEBA","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("22","20","7","MODIF","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("23","21","7","MODIF","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("24","22","9","MODIF","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("25","23","7","hola","2023-12-20");
INSERT INTO detalle_historia_clinica VALUES("26","24","9","MODIF","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("27","25","5","AASAsas","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("28","26","7","MODIF","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("29","27","5","hola","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("30","28","4","hola","2023-12-22");
INSERT INTO detalle_historia_clinica VALUES("31","29","3","AASAsas","2023-12-22");



DROP TABLE IF EXISTS detalle_prescripcion;

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




DROP TABLE IF EXISTS especialidad;

CREATE TABLE `especialidad` (
  `id_especialidad` int NOT NULL,
  `especialidad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO especialidad VALUES("1","Cardiolog├¡a");
INSERT INTO especialidad VALUES("2","Dermatolog├¡a");
INSERT INTO especialidad VALUES("3","Endocrinolog├¡a");
INSERT INTO especialidad VALUES("4","Gastroenterolog├¡a");
INSERT INTO especialidad VALUES("5","Hematolog├¡a");
INSERT INTO especialidad VALUES("6","Infectolog├¡a");
INSERT INTO especialidad VALUES("7","Nefrolog├¡a");
INSERT INTO especialidad VALUES("8","Neumolog├¡a");
INSERT INTO especialidad VALUES("9","Oftalmolog├¡a");
INSERT INTO especialidad VALUES("10","Oncolog├¡a");
INSERT INTO especialidad VALUES("11","Ortopedia");
INSERT INTO especialidad VALUES("12","Otorrinolaringolog├¡a");
INSERT INTO especialidad VALUES("13","Pediatr├¡a");
INSERT INTO especialidad VALUES("14","Psiquiatr├¡a");
INSERT INTO especialidad VALUES("15","Reumatolog├¡a");
INSERT INTO especialidad VALUES("16","Traumatolog├¡a");
INSERT INTO especialidad VALUES("17","Urolog├¡a");
INSERT INTO especialidad VALUES("18","Ginecolog├¡a");
INSERT INTO especialidad VALUES("19","Neurolog├¡a");
INSERT INTO especialidad VALUES("20","Cirug├¡a");



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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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




DROP TABLE IF EXISTS institucion_de_salud;

CREATE TABLE `institucion_de_salud` (
  `id_centro` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `telefono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_centro`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO institucion_de_salud VALUES("1","Hospital A","Direcci├│n A","123-456-7890");
INSERT INTO institucion_de_salud VALUES("2","Cl├¡nica B","Direcci├│n B","234-567-8901");
INSERT INTO institucion_de_salud VALUES("3","Centro M├®dico C","Direcci├│n C","345-678-9012");
INSERT INTO institucion_de_salud VALUES("4","Hospital D","Direcci├│n D","456-789-0123");
INSERT INTO institucion_de_salud VALUES("5","Cl├¡nica E","Direcci├│n E","567-890-1234");
INSERT INTO institucion_de_salud VALUES("6","Centro M├®dico F","Direcci├│n F","678-901-2345");
INSERT INTO institucion_de_salud VALUES("7","Hospital G","Direcci├│n G","789-012-3456");
INSERT INTO institucion_de_salud VALUES("8","Cl├¡nica H","Direcci├│n H","890-123-4567");
INSERT INTO institucion_de_salud VALUES("9","Centro M├®dico I","Direcci├│n I","901-234-5678");
INSERT INTO institucion_de_salud VALUES("10","Hospital J","Direcci├│n J","012-345-6789");



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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




DROP TABLE IF EXISTS localizador_padres_de_pacientes;

CREATE TABLE `localizador_padres_de_pacientes` (
  `ID_Localizador` int NOT NULL,
  `Identificador` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Valor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Etiqueta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Localizador`),
  UNIQUE KEY `UK_Numidentificador` (`Identificador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




DROP TABLE IF EXISTS medicamento;

CREATE TABLE `medicamento` (
  `Id_medicamento` int NOT NULL,
  `nombre_medicamento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `formato` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `Cantidad_total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`Id_medicamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO medicamento VALUES("0","Paracetamol","Analg├®sico y antifebril","Tableta","100");
INSERT INTO medicamento VALUES("1","Paracetamol","Analg├®sico y antifebril","Tableta","100");
INSERT INTO medicamento VALUES("2","Ibuprofeno","Antiinflamatorio no esteroideo","C├ípsulas","75");
INSERT INTO medicamento VALUES("3","Amoxicilina","Antibi├│tico","Suspensi├│n Oral","50");
INSERT INTO medicamento VALUES("4","Omeprazol","Inhibidor de la bomba de protones","Tabletas","60");
INSERT INTO medicamento VALUES("5","Loratadina","Antihistam├¡nico","Tabletas","80");
INSERT INTO medicamento VALUES("6","Aspirina","Antiinflamatorio y analg├®sico","Tabletas","120");
INSERT INTO medicamento VALUES("7","Diazepam","Ansiol├¡tico y relajante muscular","Tabletas","30");
INSERT INTO medicamento VALUES("8","Cetirizina","Antihistam├¡nico","Tabletas","70");
INSERT INTO medicamento VALUES("9","Metformina","Antidiab├®tico oral","Tabletas","90");
INSERT INTO medicamento VALUES("10","Atorvastatina","Estatina para reducir el colesterol","Tabletas","40");
INSERT INTO medicamento VALUES("11","Amlodipino","Bloqueador de canales de calcio","Tabletas","55");
INSERT INTO medicamento VALUES("12","Warfarina","Anticoagulante","Tabletas","25");
INSERT INTO medicamento VALUES("13","Furosemida","Diur├®tico de asa","Tabletas","65");
INSERT INTO medicamento VALUES("14","Losart├ín","Bloqueador del receptor de angiotensina II","Tabletas","85");
INSERT INTO medicamento VALUES("15","Simvastatina","Estatina para reducir el colesterol","Tabletas","110");
INSERT INTO medicamento VALUES("16","Ciprofloxacino","Antibi├│tico","Tabletas","45");
INSERT INTO medicamento VALUES("17","Doxiciclina","Antibi├│tico","C├ípsulas","30");
INSERT INTO medicamento VALUES("18","Tramadol","Analg├®sico opioide","Tabletas","40");
INSERT INTO medicamento VALUES("19","Morfina","Analg├®sico opioide","Soluci├│n inyectable","15");
INSERT INTO medicamento VALUES("20","Insulina","Hormona para controlar la glucosa","Frasco","25");
INSERT INTO medicamento VALUES("21","Uniplus","Desparasitante/Nisotadina","Suspensi├│n Oral","100");
INSERT INTO medicamento VALUES("24","Givotan","Desparasitante/Nisotadina","Comprimido","100 ml");
INSERT INTO medicamento VALUES("25","Minamino Sport","Multivitam├¡nico","Jarabe","350 ml");
INSERT INTO medicamento VALUES("26","Paracetamol","Multivitam├¡nico","Comprimido","100 gr");
INSERT INTO medicamento VALUES("27","Paracetamolssss","Multivitam├¡nico","Comprimido","350 ml");



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

INSERT INTO medicos VALUES("1","1234567890","12345","Juan","P├®rez","1");
INSERT INTO medicos VALUES("2","0987654321","54321","Mar├¡a","Gonz├ílez","2");
INSERT INTO medicos VALUES("3","1111111111","98765","Pedro","S├ínchez","3");
INSERT INTO medicos VALUES("4","2222222222","67890","Ana","L├│pez","4");
INSERT INTO medicos VALUES("5","3333333333","13579","Carlos","Rodr├¡guez","5");
INSERT INTO medicos VALUES("6","4444444444","24680","Laura","Fern├índez","6");
INSERT INTO medicos VALUES("7","5555555555","54321","Alejandro","Hern├índez","7");
INSERT INTO medicos VALUES("8","6666666666","98765","Sof├¡a","Torres","8");
INSERT INTO medicos VALUES("9","7777777777","67890","Luis","G├│mez","9");
INSERT INTO medicos VALUES("10","8888888888","13579","Marta","Vargas","10");
INSERT INTO medicos VALUES("11","9999999999","24680","Roberto","Ram├¡rez","11");
INSERT INTO medicos VALUES("12","0000000000","54321","Luc├¡a","Morales","12");
INSERT INTO medicos VALUES("13","1212121212","98765","Javier","Castro","13");
INSERT INTO medicos VALUES("14","2323232323","67890","Fernanda","Ortega","14");
INSERT INTO medicos VALUES("15","3434343434","13579","Ricardo","Cruz","15");
INSERT INTO medicos VALUES("16","4545454545","24680","Isabel","Navarro","16");
INSERT INTO medicos VALUES("17","5656565656","54321","Gabriel","Pacheco","17");
INSERT INTO medicos VALUES("18","6767676767","98765","Valentina","Rojas","18");
INSERT INTO medicos VALUES("19","7878787878","67890","Andr├®s","Mendoza","19");
INSERT INTO medicos VALUES("20","8989898989","13579","Paula","Pe├▒a","20");
INSERT INTO medicos VALUES("21","047-0174904-8","554659","Luis Manuel ","S├ínchez ","1");



DROP TABLE IF EXISTS nino_padre;

CREATE TABLE `nino_padre` (
  `ID_Relacion` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `ID_Padre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Tipo_Padre` enum('Padre','Madre','Tutor Legal') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`ID_Relacion`),
  KEY `id_paciente` (`id_paciente`),
  KEY `ID_Padre` (`ID_Padre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




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

INSERT INTO paciente VALUES("1","ADASDAS","SADASD","masculino","2023-07-13","DO","padre_madre","SAADADASDS");
INSERT INTO paciente VALUES("2","","","","0000-00-00","","","");
INSERT INTO paciente VALUES("3","","","","0000-00-00","","","");
INSERT INTO paciente VALUES("4","","","","0000-00-00","","","");
INSERT INTO paciente VALUES("5","amauris","Valdez","masculino","2023-07-12","DO","padre_madre","SDDS");
INSERT INTO paciente VALUES("6","Joel Enmanuel","Rosario","masculino","2023-07-11","DO","padre_madre","alla mismo");
INSERT INTO paciente VALUES("7","JoseR","Valdez Rodr├¡guez ","masculino","2023-06-28","DO","padre_madre","wweeee");
INSERT INTO paciente VALUES("8","Jose Rosa","Almanzar","masculino","2023-07-06","DO","padre_madre","rewwrwerr");
INSERT INTO paciente VALUES("9","amauris","Almanzar","masculino","2023-07-19","DO","padre","saadadadas");
INSERT INTO paciente VALUES("10","Array","Array","masculino","0000-00-00","Array","Array","Array");
INSERT INTO paciente VALUES("11","Array","Array","masculino","0000-00-00","Array","Array","Array");
INSERT INTO paciente VALUES("12","maria","Rosario","masculino","2023-07-11","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("13","amauris","Rosario","masculino","2023-07-11","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("14","JoseR","Valdez Rodr├¡guez ","masculino","2023-07-06","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("15","maria","Rosario","masculino","2023-07-11","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("16","Admin","Rosario","masculino","2023-07-12","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("17","sdsdsd","asdds","femenino","2023-07-13","DO","padre_madre","sasasdd");
INSERT INTO paciente VALUES("18","amauris","Rosario","femenino","2023-07-05","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("19","amauris","Rosario","femenino","2023-07-05","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("20","Aracelis","De Leon","femenino","2023-08-12","DO","padre_madre","fdsdfsfsf");
INSERT INTO paciente VALUES("21","","","","0000-00-00","","","");
INSERT INTO paciente VALUES("22","","","","0000-00-00","","","");
INSERT INTO paciente VALUES("23","","","","0000-00-00","","","");
INSERT INTO paciente VALUES("24","","","","0000-00-00","","","");



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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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



DROP TABLE IF EXISTS padecimientos_comunes;

CREATE TABLE `padecimientos_comunes` (
  `id_padecimiento` int NOT NULL AUTO_INCREMENT,
  `nombre_padecimiento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_padecimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO padecimientos_comunes VALUES("3","Bronquitis aguda","Inflamaci├│n de los bronquios, generalmente causada por una infecci├│n viral o bacteriana.");
INSERT INTO padecimientos_comunes VALUES("4","Asma","Enfermedad cr├│nica de las v├¡as respiratorias que causa dificultad para respirar y sibilancias.");
INSERT INTO padecimientos_comunes VALUES("5","Hipertensi├│n arterial","Aumento persistente de la presi├│n arterial en las arterias.");
INSERT INTO padecimientos_comunes VALUES("6","Diabetes tipo 2","Trastorno cr├│nico que afecta la forma en que el cuerpo regula el az├║car en la sangre.");
INSERT INTO padecimientos_comunes VALUES("7","Dolor de cabeza tensional","Cefalea caracterizada por una sensaci├│n de tensi├│n o presi├│n en la cabeza.");
INSERT INTO padecimientos_comunes VALUES("8","Dolor de espalda","Malestar o dolor en la regi├│n de la espalda.");
INSERT INTO padecimientos_comunes VALUES("9","Gastritis","Inflamaci├│n del revestimiento del est├│mago, generalmente causada por infecci├│n o irritaci├│n.");
INSERT INTO padecimientos_comunes VALUES("10","├Ülcera p├®ptica","Lesi├│n abierta en la mucosa del est├│mago o del duodeno.");
INSERT INTO padecimientos_comunes VALUES("11","Alergia a la penicilina","Respuesta exagerada del sistema inmunol├│gico a una sustancia extra├▒a o al├®rgeno.");
INSERT INTO padecimientos_comunes VALUES("12","Sinusitis","Inflamaci├│n de los senos paranasales, generalmente causada por una infecci├│n bacteriana o viral.");
INSERT INTO padecimientos_comunes VALUES("13","Infecci├│n urinaria","Infecci├│n en cualquier parte del sistema urinario, como la vejiga o los ri├▒ones.");
INSERT INTO padecimientos_comunes VALUES("14","Acidez estomacal","Sensaci├│n de ardor en la parte inferior del pecho, causada por el reflujo del ├ícido del est├│mago.");
INSERT INTO padecimientos_comunes VALUES("16","Enfermedad de Huntington","Trastorno neurol├│gico hereditario que afecta el movimiento y las funciones cognitivas.");
INSERT INTO padecimientos_comunes VALUES("17","Distrofia muscular de Duchenne","Enfermedad gen├®tica que causa debilidad muscular progresiva y afecta principalmente a los ni├▒os.");
INSERT INTO padecimientos_comunes VALUES("18","Fibrosis qu├¡stica","Enfermedad gen├®tica que afecta principalmente los pulmones y el sistema digestivo.");
INSERT INTO padecimientos_comunes VALUES("19","Hemofilia","Trastorno de la coagulaci├│n de la sangre causado por un defecto gen├®tico en los genes de la coagulaci├│n.");
INSERT INTO padecimientos_comunes VALUES("20","S├¡ndrome de Marfan","Trastorno gen├®tico del tejido conectivo que afecta el coraz├│n, los ojos y los vasos sangu├¡neos.");
INSERT INTO padecimientos_comunes VALUES("21","Enfermedad de Gaucher","Trastorno gen├®tico que afecta la funci├│n del sistema linf├ítico y puede causar agrandamiento del h├¡gado y el bazo.");
INSERT INTO padecimientos_comunes VALUES("22","Enfermedad de Wilson","Trastorno gen├®tico del metabolismo del cobre que causa acumulaci├│n de cobre en varios ├│rganos.");
INSERT INTO padecimientos_comunes VALUES("23","S├¡ndrome de Lynch","Trastorno hereditario que aumenta el riesgo de desarrollar c├íncer de colon y otros c├ínceres relacionados.");
INSERT INTO padecimientos_comunes VALUES("24","S├¡ndrome de Turner","Trastorno gen├®tico que afecta el desarrollo sexual en las mujeres y est├í asociado con caracter├¡sticas f├¡sicas distintivas.");
INSERT INTO padecimientos_comunes VALUES("25","S├¡ndrome de Down","Trisom├¡a del cromosoma 21 que causa discapacidad intelectual y caracter├¡sticas f├¡sicas caracter├¡sticas.");
INSERT INTO padecimientos_comunes VALUES("26","Colesterol alto","Condici├│n en la cual los niveles de colesterol en la sangre est├ín elevados, aumentando el riesgo de enfermedad cardiovascular.");
INSERT INTO padecimientos_comunes VALUES("27","Hipertensi├│n arterial","Aumento persistente de la presi├│n arterial en las arterias.");
INSERT INTO padecimientos_comunes VALUES("28","Problemas de tiroides","Trastornos que afectan la gl├índula tiroides y pueden causar problemas de funcionamiento en el cuerpo.");
INSERT INTO padecimientos_comunes VALUES("29","Epilepsia","Trastorno neurol├│gico cr├│nico caracterizado por convulsiones recurrentes debido a la actividad anormal del cerebro.");



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
  `id_consulta` int DEFAULT NULL,
  `id_centro` int DEFAULT NULL,
  PRIMARY KEY (`id_receta`),
  KEY `FK_Prescripcion_Medica_Consultas` (`id_consulta`),
  KEY `FK_Prescripcion_Medica_Institucion_de_Salud` (`id_centro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




DROP TABLE IF EXISTS referimientos;

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
INSERT INTO seguro_paciente VALUES("2587272728","1","2");
INSERT INTO seguro_paciente VALUES("","4","0");
INSERT INTO seguro_paciente VALUES("g988987989","5","10");
INSERT INTO seguro_paciente VALUES("889895269","6","4");
INSERT INTO seguro_paciente VALUES("872698855","7","2");
INSERT INTO seguro_paciente VALUES("54556888","8","3");
INSERT INTO seguro_paciente VALUES("5555888","9","10");
INSERT INTO seguro_paciente VALUES("Array","10","0");
INSERT INTO seguro_paciente VALUES("Array","11","0");
INSERT INTO seguro_paciente VALUES("5689898","12","3");
INSERT INTO seguro_paciente VALUES("1","13","10");
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



DROP TABLE IF EXISTS tipo_vacunas;

CREATE TABLE `tipo_vacunas` (
  `id_vacuna` int NOT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  `total_dosis` int DEFAULT NULL,
  PRIMARY KEY (`id_vacuna`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO tipo_vacunas VALUES("1","BCG","La vacuna BCG* protege contra la tuberculosis y se administra en una sola dosis.","1");
INSERT INTO tipo_vacunas VALUES("2","Hepatitis B","La vacuna contra la hepatitis B previene la infecci├│n por el virus de la hepatitis B. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","3");
INSERT INTO tipo_vacunas VALUES("3","DTP","La vacuna DTP protege contra la difteria, el t├®tanos y la tos ferina. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","5");
INSERT INTO tipo_vacunas VALUES("4","Polio","La vacuna contra la poliomielitis protege contra la polio. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","4");
INSERT INTO tipo_vacunas VALUES("5","Hib","La vacuna Hib protege contra Haemophilus influenzae tipo b, una bacteria que puede causar enfermedades graves en los ni├▒os. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","3");
INSERT INTO tipo_vacunas VALUES("6","Neumococo","La vacuna contra el neumococo protege contra Streptococcus pneumoniae, una bacteria que puede causar enfermedades como la neumon├¡a y la meningitis. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","4");
INSERT INTO tipo_vacunas VALUES("7","Rotavirus","La vacuna contra el rotavirus protege contra una infecci├│n viral que puede causar diarrea grave en los ni├▒os. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("8","Sarampi├│n, Paperas, Rub├®ola (MMR)","La vacuna MMR protege contra el sarampi├│n, las paperas y la rub├®ola. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("9","Varicela","La vacuna contra la varicela protege contra el virus de la varicela-z├│ster, que causa la varicela. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("10","Hepatitis A","La vacuna contra la hepatitis A previene la infecci├│n por el virus de la hepatitis A. Se administra en m├║ltiples dosis seg├║n el esquema recomendado.","2");
INSERT INTO tipo_vacunas VALUES("11","Influenza","vacuna del 2023","1");



DROP TABLE IF EXISTS trabajos_medicos;

CREATE TABLE `trabajos_medicos` (
  `id_trabajo_medico` int NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `descripcion_trabajo_medico` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
  PRIMARY KEY (`id_trabajo_medico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO trabajos_medicos VALUES("1","2023-12-26","Consulta de rutina");
INSERT INTO trabajos_medicos VALUES("2","2023-12-25","Control de vacunas");
INSERT INTO trabajos_medicos VALUES("3","2023-12-24","Evaluaci├│n del desarrollo infantil");
INSERT INTO trabajos_medicos VALUES("4","2023-12-23","Tratamiento de infecci├│n respiratoria");
INSERT INTO trabajos_medicos VALUES("5","2023-12-22","Atenci├│n de fiebre");
INSERT INTO trabajos_medicos VALUES("6","2023-12-21","Seguimiento de enfermedad cr├│nica");
INSERT INTO trabajos_medicos VALUES("7","2023-12-20","Diagn├│stico y tratamiento de enfermedades gastrointestinales");
INSERT INTO trabajos_medicos VALUES("8","2023-12-19","Valoraci├│n de alergias");
INSERT INTO trabajos_medicos VALUES("9","2023-12-18","Atenci├│n de dolor abdominal");
INSERT INTO trabajos_medicos VALUES("10","2023-12-17","Evaluaci├│n de erupciones cut├íneas");
INSERT INTO trabajos_medicos VALUES("11","2023-12-16","Control de asma");
INSERT INTO trabajos_medicos VALUES("12","2023-12-15","Atenci├│n de problemas de sue├▒o");
INSERT INTO trabajos_medicos VALUES("13","2023-12-14","Diagn├│stico y tratamiento de infecciones urinarias");
INSERT INTO trabajos_medicos VALUES("14","2023-12-13","Consulta por problemas de crecimiento");
INSERT INTO trabajos_medicos VALUES("15","2023-12-12","Seguimiento de enfermedades cr├│nicas");
INSERT INTO trabajos_medicos VALUES("16","2023-12-11","Atenci├│n de dolor de o├¡do");
INSERT INTO trabajos_medicos VALUES("17","2023-12-10","Evaluaci├│n de problemas de alimentaci├│n");
INSERT INTO trabajos_medicos VALUES("18","2023-12-09","Control de enfermedades respiratorias");
INSERT INTO trabajos_medicos VALUES("19","2023-12-08","Diagn├│stico y tratamiento de enfermedades infecciosas");
INSERT INTO trabajos_medicos VALUES("20","2023-12-07","Atenci├│n de problemas de comportamiento");



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO usuario VALUES("1","Admin","123","123","Activo","Joel Rosario","Administrador");
INSERT INTO usuario VALUES("2","Admin2","1234","1234","Activo","Luis Sanchez","Administrador");
INSERT INTO usuario VALUES("3","usuario1","123","123","Activo","Nombre Usuario 1","Secretar├¡a");
INSERT INTO usuario VALUES("4","usuario2","12345","12345","Activo","Nombre Usuario 2","Doctor");
INSERT INTO usuario VALUES("5","Prueba","12345","12345","Activo","Jose Rodr├¡guez ","Administrador");
INSERT INTO usuario VALUES("6","jrosario","123","123","Activo","Jose Rosario","Administrador");
INSERT INTO usuario VALUES("7","JaceRos","123","123","Activo","Jacelis Rosario","Secretar├¡a");



SET FOREIGN_KEY_CHECKS=1;