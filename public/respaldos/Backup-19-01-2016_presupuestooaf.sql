-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: presupuestooaf
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('r2robsr@gmail.com','b15d2bee292ef387bfd45be30847f0c54bedb2fe2e47b6c4fc37889e9504425c','2015-12-11 23:26:10'),('arturo.madrigal@ucr.ac.cr','84a9b661b064b3fe0edf9dcd2b3ff84770e45c5355ee48639622ebac1023be6f','2016-01-04 21:32:47');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tconfiguracion`
--

DROP TABLE IF EXISTS `tconfiguracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tconfiguracion` (
  `idConfiguracion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vConfiguracion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iValor` int(11) NOT NULL DEFAULT '2016',
  `tUsuario_idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idConfiguracion`),
  KEY `tUsuario_idUsuario` (`tUsuario_idUsuario`),
  CONSTRAINT `tconfiguracion_ibfk_1` FOREIGN KEY (`tUsuario_idUsuario`) REFERENCES `tusuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tconfiguracion`
--

LOCK TABLES `tconfiguracion` WRITE;
/*!40000 ALTER TABLE `tconfiguracion` DISABLE KEYS */;
INSERT INTO `tconfiguracion` VALUES (2,'Periodo',2016,1),(5,'Periodo',2016,5),(6,'Periodo',2016,6);
/*!40000 ALTER TABLE `tconfiguracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tcoordinacion`
--

DROP TABLE IF EXISTS `tcoordinacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tcoordinacion` (
  `idCoordinacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vNombreCoordinacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idCoordinacion`),
  UNIQUE KEY `tcoordinacion_idcoordinacion_unique` (`idCoordinacion`),
  UNIQUE KEY `vNombreCoordinacion` (`vNombreCoordinacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tcoordinacion`
--

LOCK TABLES `tcoordinacion` WRITE;
/*!40000 ALTER TABLE `tcoordinacion` DISABLE KEYS */;
INSERT INTO `tcoordinacion` VALUES ('1050','DOCENCIA','2015-12-05 23:48:31','2015-12-28 17:31:32',NULL),('1054','JEFATURA ADMINISTRATIVA','2015-12-05 23:17:13','2016-01-04 20:02:28',NULL),('1055','INVESTIGACION','2015-12-28 17:00:02','2016-01-04 20:01:26',NULL);
/*!40000 ALTER TABLE `tcoordinacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tfactura`
--

DROP TABLE IF EXISTS `tfactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tfactura` (
  `idFactura` int(10) NOT NULL AUTO_INCREMENT,
  `tPartida_idPartida` int(255) NOT NULL,
  `vTipoFactura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dFechaFactura` date NOT NULL,
  `vDocumento` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vDescripcionFactura` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vDetalleFactura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iMontoFactura` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `tReserva_vReserva` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `tfactura_tpartida_idpartida_foreign` (`tPartida_idPartida`),
  CONSTRAINT `tfactura_ibfk_1` FOREIGN KEY (`tPartida_idPartida`) REFERENCES `tpresupuesto_tpartida` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tfactura`
--

LOCK TABLES `tfactura` WRITE;
/*!40000 ALTER TABLE `tfactura` DISABLE KEYS */;
INSERT INTO `tfactura` VALUES (3,1,'Solicitud GECO','2016-01-18','No Aplica','','asd',5000000,'2016-01-18 22:02:47','2016-01-18 22:02:47',NULL,NULL,3),(4,1,'Pases Adicionales','2016-01-18','No Aplica','','Aumento en la reserva No Aplica asd',3000000,'2016-01-18 22:03:17','2016-01-18 22:04:28','2016-01-18 22:04:28',NULL,3),(5,1,'Pases Adicionales','2016-01-18','No Aplica','','Aumento en la reserva No Aplica asd',3000000,'2016-01-18 22:05:13','2016-01-18 23:02:56',NULL,NULL,3),(6,1,'Pases Anulacion','2016-01-18','No Aplica','','Reduccion en la reserva No Aplica asd',4000000,'2016-01-18 22:22:26','2016-01-18 22:22:26',NULL,NULL,3),(7,1,'Cancelacion GECO','2016-01-18','No Aplica','','3',400000,'2016-01-18 22:25:52','2016-01-18 22:27:09','2016-01-06 06:00:00',NULL,3),(13,1,'Pases Adicionales','2016-01-18','No Aplica','','Aumento en la reserva No Aplica asd',100000,'2016-01-18 22:50:59','2016-01-18 22:51:42',NULL,NULL,3),(14,1,'Pases Adicionales','2016-01-18','No Aplica','','Aumento en la reserva No Aplica asd',100000,'2016-01-18 22:53:14','2016-01-18 22:53:15',NULL,NULL,3);
/*!40000 ALTER TABLE `tfactura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpartida`
--

DROP TABLE IF EXISTS `tpartida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpartida` (
  `idPartida` int(11) NOT NULL AUTO_INCREMENT,
  `codPartida` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `vNombrePartida` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vDescripcion` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idPartida`),
  UNIQUE KEY `codPartida` (`codPartida`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpartida`
--

LOCK TABLES `tpartida` WRITE;
/*!40000 ALTER TABLE `tpartida` DISABLE KEYS */;
INSERT INTO `tpartida` VALUES (1,'1-01-01-01','Salario Base','Corresponde al sueldo para remunerar al personal administrativo y al\r\npersonal docente, de acuerdo a la escala salarial vigente','0000-00-00 00:00:00','2016-01-11 21:04:51',NULL),(2,'1-01-01-00','Alquiler de edificios, locales y terrenos','Corresponde al arrendamiento por periodos fijos y ocasionales, para uso\r\nde oficinas, bodegas, estacionamientos, centros de salud y locales\r\ndiversos. Se excluye el alquiler de locales para impartir cursos,\r\nseminarios, charlas y otros similares que se deben clasificar en la\r\nsubpartida 1-07-01 \" Actividades de capacitación\"de oficinas, bodegas, estacionamientos, centros de salud y locales\r\ndiversos. Se excluye el alquiler de locales para impartir cursos,\r\nseminarios, charlas y otros similares que se de','0000-00-00 00:00:00','2016-01-18 21:53:41',NULL),(13,'2-02-02-04','Repuesto y Accesorios','Abarca los gastos por concepto de compra de partes y accesorios que ses\r\nusan en el mantenimiento y reparaciones de maquinaria y equipo,\r\nsiempre y cuando los repuestos y accesorios no incrementen la vida útil\r\ndel bien, en cuyo caso se clasificará en el grupo 5-01 \"MAQUINARIA,\r\nEQUIPO Y MOBILIARIO\" en las partidas correspondientes.\r\nSe excluyen los repuestos y accesorios destinados al mantenimiento y\r\nreparación de los sistemas eléctricos, telefónicos y de cómputo que\r\nforman parte integral de las obras, los cuales se clasifican en la\r\nsubpartida 2-03-04 \"Materiales y productos eléctricos, telefónicos y de\r\ncómputo\".','2015-12-11 06:09:37','2016-01-19 00:15:32',NULL),(14,'3-02-06-00','Intereses sobre préstamos de Instituciones Públicas Financieras','Incluye los gastos destinados al pago de intereses de las deudas\r\ncontraídas por concepto de préstamos directos y avales asumidos,\r\nconcedidos por las Instituciones Públicas Financieras, bancarias y no\r\nbancarias. prueba','2015-12-11 06:11:18','2016-01-04 20:07:22',NULL),(15,'7-77-77-77','Prueba','Este es una Partida de prueba','2016-01-04 20:09:33','2016-01-04 20:09:33',NULL),(16,'12341234','ssfsfs','234f','2016-01-09 20:54:26','2016-01-09 20:54:26',NULL),(17,'123412342','1','1','2016-01-09 20:54:56','2016-01-09 20:54:56',NULL);
/*!40000 ALTER TABLE `tpartida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpermiso`
--

DROP TABLE IF EXISTS `tpermiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpermiso` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePermiso` varchar(45) NOT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpermiso`
--

LOCK TABLES `tpermiso` WRITE;
/*!40000 ALTER TABLE `tpermiso` DISABLE KEYS */;
INSERT INTO `tpermiso` VALUES (1,'Ver Menu'),(2,'Ver Partida'),(3,'Agregar Partida'),(4,'Editar Partida'),(5,'Borrar Partida'),(6,'Administrar Usuarios'),(7,'Ver Coordinacion'),(9,'Agregar Coordinacion'),(10,'Editar Coordinacion'),(11,'Borrar Coordinacion'),(12,'Configurar Sistema'),(13,'Ver Presupuesto'),(14,'Agregar Presupuesto'),(15,'Editar Presupuesto'),(16,'Borrar Presupuesto'),(17,'Ver Transaccion'),(18,'Agregar Transaccion'),(19,'Ver Transferencia'),(20,'Agregar Transferencia'),(21,'Respaldar Sistema');
/*!40000 ALTER TABLE `tpermiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpresupuesto`
--

DROP TABLE IF EXISTS `tpresupuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpresupuesto` (
  `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `anno` int(11) NOT NULL,
  `tCoordinacion_idCoordinacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vNombrePresupuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iPresupuestoInicial` int(11) NOT NULL,
  `iPresupuestoModificado` int(11) NOT NULL,
  `iReserva` int(11) NOT NULL DEFAULT '0',
  `iGasto` int(11) NOT NULL DEFAULT '0',
  `iSaldo` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idPresupuesto`),
  UNIQUE KEY `tpresupuesto_idpresupuesto_unique` (`idPresupuesto`),
  KEY `tpresupuesto_tcoordinacion_idcoordinacion_foreign` (`tCoordinacion_idCoordinacion`),
  CONSTRAINT `tpresupuesto_tcoordinacion_idcoordinacion_foreign` FOREIGN KEY (`tCoordinacion_idCoordinacion`) REFERENCES `tcoordinacion` (`idCoordinacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpresupuesto`
--

LOCK TABLES `tpresupuesto` WRITE;
/*!40000 ALTER TABLE `tpresupuesto` DISABLE KEYS */;
INSERT INTO `tpresupuesto` VALUES (1,2015,'1050','Presupuesto de Prueba',13565000,13565000,4200000,0,9365000,'0000-00-00 00:00:00','2016-01-18 23:57:01',NULL),(2,2015,'1054','PRESUPUESTO ORDINARIO',885000,1085000,0,285000,800000,'2015-12-11 06:35:13','2016-01-04 20:58:38',NULL),(3,2015,'1054','Presupuesto Extraordinario',15000000,13000000,2000000,6000002,4999998,'2015-12-11 07:11:57','2016-01-05 17:50:12',NULL),(4,2016,'1050','PRESUPUESTO ORDINARIO',5000000,5000000,0,0,5000000,'2015-12-15 21:27:44','2015-12-15 21:29:52',NULL),(6,2015,'1055','asdf',123123,123123,0,0,123123,'2016-01-05 17:52:13','2016-01-05 17:53:02',NULL);
/*!40000 ALTER TABLE `tpresupuesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tpresupuesto_tpartida`
--

DROP TABLE IF EXISTS `tpresupuesto_tpartida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tpresupuesto_tpartida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tPresupuesto_idPresupuesto` int(11) NOT NULL,
  `tPartida_idPartida` int(11) NOT NULL,
  `iPresupuestoInicial` int(11) NOT NULL DEFAULT '0',
  `iPresupuestoModificado` int(11) NOT NULL DEFAULT '0',
  `iReserva` int(11) NOT NULL DEFAULT '0',
  `iGasto` int(11) NOT NULL DEFAULT '0',
  `iSaldo` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tPresupuesto_idPresupuesto` (`tPresupuesto_idPresupuesto`),
  KEY `tPartida_idPartida` (`tPartida_idPartida`),
  CONSTRAINT `tpresupuesto_tpartida_ibfk_1` FOREIGN KEY (`tPresupuesto_idPresupuesto`) REFERENCES `tpresupuesto` (`idPresupuesto`),
  CONSTRAINT `tpresupuesto_tpartida_ibfk_2` FOREIGN KEY (`tPartida_idPartida`) REFERENCES `tpartida` (`idPartida`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tpresupuesto_tpartida`
--

LOCK TABLES `tpresupuesto_tpartida` WRITE;
/*!40000 ALTER TABLE `tpresupuesto_tpartida` DISABLE KEYS */;
INSERT INTO `tpresupuesto_tpartida` VALUES (1,1,1,10000000,10000000,4200000,0,5800000,'0000-00-00 00:00:00','2016-01-18 23:04:34',NULL),(2,1,2,500000,500000,0,0,500000,'0000-00-00 00:00:00','2016-01-18 21:52:51',NULL),(3,2,1,85000,285000,0,0,285000,'0000-00-00 00:00:00','2016-01-09 21:51:43',NULL),(4,1,13,1500000,1500000,0,0,1500000,'2015-12-12 02:03:33','2016-01-18 21:52:58',NULL),(6,3,14,15000000,13000000,0,0,13000000,'2015-12-12 02:06:06','2016-01-09 21:51:44',NULL),(7,1,14,815000,815000,0,0,815000,'2015-12-15 17:10:12','2016-01-18 23:48:48',NULL),(8,4,13,5000000,5000000,0,0,5000000,'2015-12-15 21:28:18','2015-12-15 21:28:19',NULL),(9,1,14,750000,750000,0,0,750000,'2016-01-04 20:08:47','2016-01-04 20:08:47',NULL);
/*!40000 ALTER TABLE `tpresupuesto_tpartida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treserva`
--

DROP TABLE IF EXISTS `treserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treserva` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `vReserva` int(11) NOT NULL,
  `vDocumento` varchar(50) NOT NULL,
  `vDetalle` varchar(50) NOT NULL,
  `iMontoFactura` int(11) NOT NULL,
  `tPartida_idPartida` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idReserva`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treserva`
--

LOCK TABLES `treserva` WRITE;
/*!40000 ALTER TABLE `treserva` DISABLE KEYS */;
INSERT INTO `treserva` VALUES (7,3,'No Aplica','asd',4200000,1,NULL);
/*!40000 ALTER TABLE `treserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trol`
--

DROP TABLE IF EXISTS `trol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(45) DEFAULT NULL,
  `descripcionRol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRol`),
  UNIQUE KEY `nombreRol` (`nombreRol`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trol`
--

LOCK TABLES `trol` WRITE;
/*!40000 ALTER TABLE `trol` DISABLE KEYS */;
INSERT INTO `trol` VALUES (1,'default','Rol por defecto'),(2,'Administrador','Acceso total'),(6,'Usuario Financiero','Funcionario de la oficina de financiero'),(7,'prueba','asd'),(19,'holasadafasd','hola');
/*!40000 ALTER TABLE `trol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trol_tiene_tpermiso`
--

DROP TABLE IF EXISTS `trol_tiene_tpermiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trol_tiene_tpermiso` (
  `tRol_idRol` int(11) NOT NULL,
  `tPermiso_idPermiso` int(11) NOT NULL,
  PRIMARY KEY (`tRol_idRol`,`tPermiso_idPermiso`),
  KEY `fk_tRol_has_tPermiso_tPermiso1_idx` (`tPermiso_idPermiso`),
  KEY `fk_tRol_has_tPermiso_tRol_idx` (`tRol_idRol`),
  CONSTRAINT `fk_tRol_has_tPermiso_tPermiso1` FOREIGN KEY (`tPermiso_idPermiso`) REFERENCES `tpermiso` (`idPermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tRol_has_tPermiso_tRol` FOREIGN KEY (`tRol_idRol`) REFERENCES `trol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trol_tiene_tpermiso`
--

LOCK TABLES `trol_tiene_tpermiso` WRITE;
/*!40000 ALTER TABLE `trol_tiene_tpermiso` DISABLE KEYS */;
INSERT INTO `trol_tiene_tpermiso` VALUES (1,1),(2,1),(6,1),(7,1),(19,1),(2,2),(6,2),(7,2),(19,2),(2,3),(19,3),(2,4),(19,4),(2,5),(19,5),(2,6),(19,6),(2,7),(6,7),(7,7),(19,7),(2,9),(19,9),(2,10),(19,10),(2,11),(19,11),(2,12),(19,12),(2,13),(6,13),(7,13),(19,13),(2,14),(19,14),(2,15),(19,15),(2,16),(19,16),(2,17),(6,17),(7,17),(2,18),(6,18),(2,19),(6,19),(2,20),(6,20),(2,21);
/*!40000 ALTER TABLE `trol_tiene_tpermiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ttranferencia_partida`
--

DROP TABLE IF EXISTS `ttranferencia_partida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ttranferencia_partida` (
  `idTransferencia` int(11) NOT NULL AUTO_INCREMENT,
  `tPresupuestoPartidaDe` int(11) NOT NULL,
  `tPresupuestoPartidaA` int(11) NOT NULL,
  `vDocumento` varchar(50) NOT NULL,
  `iMontoTransferencia` int(11) NOT NULL,
  `tUsuario_idUsuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idTransferencia`),
  KEY `tPresupuestoPartidaDe` (`tPresupuestoPartidaDe`),
  KEY `tPresupuestoPartidaA` (`tPresupuestoPartidaA`),
  CONSTRAINT `ttranferencia_partida_ibfk_1` FOREIGN KEY (`tPresupuestoPartidaDe`) REFERENCES `tpresupuesto_tpartida` (`id`),
  CONSTRAINT `ttranferencia_partida_ibfk_2` FOREIGN KEY (`tPresupuestoPartidaA`) REFERENCES `tpresupuesto_tpartida` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ttranferencia_partida`
--

LOCK TABLES `ttranferencia_partida` WRITE;
/*!40000 ALTER TABLE `ttranferencia_partida` DISABLE KEYS */;
/*!40000 ALTER TABLE `ttranferencia_partida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tusuario`
--

DROP TABLE IF EXISTS `tusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tRol_idRol` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_tUsuario_tRol1_idx` (`tRol_idRol`),
  CONSTRAINT `fk_tUsuario_tRol1` FOREIGN KEY (`tRol_idRol`) REFERENCES `trol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tusuario`
--

LOCK TABLES `tusuario` WRITE;
/*!40000 ALTER TABLE `tusuario` DISABLE KEYS */;
INSERT INTO `tusuario` VALUES (1,'Arturo Madrigal Villalobos','arturo.madrigal@ucr.ac.cr','$2y$10$rxK74VhHOsbFtG.QgPB/6OEU5fPmcyW2SRopkI0v7W7ZKRL1G06NO','6V1AGBFiMcpUvSuO8vKsaE63VUV1Zbku1RsopzOPCSP1IAZoTOu6XZkZlVNn','2015-10-22 02:45:21','2016-01-02 19:01:18',2),(5,'madrigal Aruturo','madrigal.arturo@ucr.ac.cr','$2y$10$TaCj1xB4jKT6dwYmC6nR4eMC.irpfzKIxDc1TxK2ZN/L0pUlhCz0K','WiEPsA25844nAsjXU4zBab9OUHIRX8CN0kRjkG2PRBcz16N3Gq2OP2hhDId6','2015-12-15 15:40:37','2016-01-04 21:28:07',2),(6,'Miguel Castro','miguel.castro@ucr.ac.cr','$2y$10$U6uwThE9rISFNCJhhwFU/.14cJeNyhFEd3ryobLwbzQYxiCLChFji','dqcD5Lmrzq8ADnbYSkT03XNJGd3jm2TJ4VEWKrjpUn3cCQZMzZpsq4Z31EQN','2015-12-15 16:50:36','2016-01-04 16:37:25',2),(7,'Castro Miguel','castro.miguel@ucr.ac.cr','$2y$10$GnS7V.f7mnGLQgWsC7sOg.eFOdoBBWpPX03/.V5b.oIJsubTeX2Ay','sTebkZG8L4ZQmxP9lzOvpQeqRFe9ezxNIZKAM21QpapbzOH3SYq0VDteLzhM','2015-12-15 16:51:54','2015-12-15 16:51:58',1);
/*!40000 ALTER TABLE `tusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tusuario_tcoordinacion`
--

DROP TABLE IF EXISTS `tusuario_tcoordinacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tusuario_tcoordinacion` (
  `idUsuarioCoordinacion` int(11) NOT NULL AUTO_INCREMENT,
  `tUsuario_idUsuario` int(11) NOT NULL,
  `tCoordi_idCoordinacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idUsuarioCoordinacion`),
  KEY `tUsuario_idUsuario` (`tUsuario_idUsuario`),
  KEY `tCoordinacion_idCoordinacion` (`tCoordi_idCoordinacion`),
  CONSTRAINT `tusuario_tcoordinacion_ibfk_1` FOREIGN KEY (`tCoordi_idCoordinacion`) REFERENCES `tcoordinacion` (`idCoordinacion`),
  CONSTRAINT `tusuario_tcoordinacion_ibfk_2` FOREIGN KEY (`tUsuario_idUsuario`) REFERENCES `tusuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tusuario_tcoordinacion`
--

LOCK TABLES `tusuario_tcoordinacion` WRITE;
/*!40000 ALTER TABLE `tusuario_tcoordinacion` DISABLE KEYS */;
INSERT INTO `tusuario_tcoordinacion` VALUES (51,5,'1050'),(52,5,'1054'),(54,6,'1050'),(55,6,'1054'),(109,1,'1050'),(110,1,'1054'),(111,1,'1055');
/*!40000 ALTER TABLE `tusuario_tcoordinacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'presupuestooaf'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-19 10:08:14
