-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2015 a las 03:50:26
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `presupuestooaf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('r2robsr@gmail.com', 'b15d2bee292ef387bfd45be30847f0c54bedb2fe2e47b6c4fc37889e9504425c', '2015-12-11 23:26:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tconfiguracion`
--

CREATE TABLE IF NOT EXISTS `tconfiguracion` (
  `idConfiguracion` int(10) unsigned NOT NULL,
  `vConfiguracion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iValor` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tconfiguracion`
--

INSERT INTO `tconfiguracion` (`idConfiguracion`, `vConfiguracion`, `iValor`) VALUES
(1, 'Periodo', 2015);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcoordinacion`
--

CREATE TABLE IF NOT EXISTS `tcoordinacion` (
  `idCoordinacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vNombreCoordinacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tcoordinacion`
--

INSERT INTO `tcoordinacion` (`idCoordinacion`, `vNombreCoordinacion`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1050', 'DOCENCIA', '2015-12-05 23:48:31', '2015-12-05 23:48:31', NULL),
('1054', 'JEFATURA ADMINISTRATIVA', '2015-12-05 23:17:13', '2015-12-05 23:17:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfactura`
--

CREATE TABLE IF NOT EXISTS `tfactura` (
  `idFactura` int(10) NOT NULL,
  `tPartida_idPartida` int(255) NOT NULL,
  `vTipoFactura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dFechaFactura` date NOT NULL,
  `vDocumento` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vDescripcionFactura` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iMontoFactura` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tfactura`
--

INSERT INTO `tfactura` (`idFactura`, `tPartida_idPartida`, `vTipoFactura`, `dFechaFactura`, `vDocumento`, `vDescripcionFactura`, `iMontoFactura`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 3, 'Factura pendiente', '2015-12-11', 'No Aplica', '', 738, '2015-12-12 00:48:39', '2015-12-12 00:48:39', NULL),
(16, 3, 'Factura pendiente', '2015-12-11', 'No Aplica', '', 3321, '2015-12-12 00:49:46', '2015-12-12 00:49:46', NULL),
(17, 3, 'Factura pendiente', '2015-12-11', 'No Aplica', '', 3321, '2015-12-12 00:49:46', '2015-12-12 00:49:46', NULL),
(18, 3, 'Factura pendiente', '2015-12-11', 'No Aplica', '', 6408, '2015-12-12 00:51:01', '2015-12-12 00:51:01', NULL),
(19, 1, 'Factura pendiente', '2015-12-11', 'No Aplica', '', 736, '2015-12-12 00:51:38', '2015-12-12 00:51:38', NULL),
(20, 1, 'Factura pendiente', '2015-12-11', 'No Aplica', '', 41547, '2015-12-12 00:52:03', '2015-12-12 00:52:03', NULL),
(21, 1, 'Factura pendiente', '2015-12-11', 'No Aplica', '234', 1028, '2015-12-12 00:52:59', '2015-12-12 00:52:59', NULL),
(22, 1, 'Factura pendiente', '2015-12-11', 'No Aplica', '', 181, '2015-12-12 00:54:00', '2015-12-12 00:54:00', NULL),
(23, 1, 'Pases Anulacion', '2015-12-11', 'No Aplica', '', 43392, '2015-12-12 00:57:15', '2015-12-12 00:57:15', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfacturadetalle`
--

CREATE TABLE IF NOT EXISTS `tfacturadetalle` (
  `idDetalle` int(11) NOT NULL,
  `tFactura_idFactura` int(11) NOT NULL,
  `iLinea` int(11) NOT NULL,
  `vDetalle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iPrecio` int(11) NOT NULL,
  `iCantidad` int(11) NOT NULL,
  `iTotalLinea` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tfacturadetalle`
--

INSERT INTO `tfacturadetalle` (`idDetalle`, `tFactura_idFactura`, `iLinea`, `vDetalle`, `iPrecio`, `iCantidad`, `iTotalLinea`) VALUES
(142, 15, 1, '2', 246, 0, 123),
(143, 16, 1, '23', 2829, 0, 123),
(144, 17, 1, '23', 2829, 0, 123),
(145, 18, 1, '3', 342, 1026, 234),
(146, 19, 1, '1234', 23, 32, 736),
(147, 20, 1, 'SDF', 234, 123, 28782),
(148, 21, 1, 'SDF', 23, 4, 92),
(149, 21, 2, 'SDF', 234, 4, 936),
(150, 22, 1, 'SADF3', 15, 2, 30),
(151, 22, 2, 'ASF234', 15, 3, 45),
(152, 22, 3, 'ASDF', 15, 4, 60),
(153, 22, 4, 'DFDGF', 23, 2, 46),
(154, 23, 1, 'anulacion', 43392, 1, 43392);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpartida`
--

CREATE TABLE IF NOT EXISTS `tpartida` (
  `idPartida` int(11) NOT NULL,
  `codPartida` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `vNombrePartida` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vDescripcion` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tpartida`
--

INSERT INTO `tpartida` (`idPartida`, `codPartida`, `vNombrePartida`, `vDescripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0-01-01-01', 'Salario Base', 'Corresponde al sueldo para remunerar al personal administrativo y al\r\npersonal docente, de acuerdo a la escala salarial vigente', '0000-00-00 00:00:00', '2015-12-11 22:20:05', NULL),
(2, '1-01-01-00', 'Alquiler de edificios, locales y terrenos\r\n', 'Corresponde al arrendamiento por periodos fijos y ocasionales, para uso\nde oficinas, bodegas, estacionamientos, centros de salud y locales\ndiversos. Se excluye el alquiler de locales para impartir cursos,\nseminarios, charlas y otros similares que se deben clasificar en la\nsubpartida 1-07-01 " Actividades de capacitación"de oficinas, bodegas, estacionamientos, centros de salud y locales\ndiversos. Se excluye el alquiler de locales para impartir cursos,\nseminarios, charlas y otros similares que se de', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(13, '2-04-02-00', 'Repuesto y Accesorios', 'Abarca los gastos por concepto de compra de partes y accesorios que se\r\nusan en el mantenimiento y reparaciones de maquinaria y equipo,\r\nsiempre y cuando los repuestos y accesorios no incrementen la vida útil\r\ndel bien, en cuyo caso se clasificará en el grupo 5-01 "MAQUINARIA,\r\nEQUIPO Y MOBILIARIO" en las partidas correspondientes.\r\nSe excluyen los repuestos y accesorios destinados al mantenimiento y\r\nreparación de los sistemas eléctricos, telefónicos y de cómputo que\r\nforman parte integral de las obras, los cuales se clasifican en la\r\nsubpartida 2-03-04 "Materiales y productos eléctricos, telefónicos y de\r\ncómputo".', '2015-12-11 06:09:37', '2015-12-11 06:09:37', NULL),
(14, '3-02-06-00', 'Intereses sobre préstamos de Instituciones Públicas Financieras', 'Incluye los gastos destinados al pago de intereses de las deudas\r\ncontraídas por concepto de préstamos directos y avales asumidos,\r\nconcedidos por las Instituciones Públicas Financieras, bancarias y no\r\nbancarias.', '2015-12-11 06:11:18', '2015-12-11 06:11:18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpermiso`
--

CREATE TABLE IF NOT EXISTS `tpermiso` (
  `idPermiso` int(11) NOT NULL,
  `nombrePermiso` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tpermiso`
--

INSERT INTO `tpermiso` (`idPermiso`, `nombrePermiso`) VALUES
(1, 'Ver Menu'),
(2, 'Ver Partida'),
(3, 'Agregar Partida'),
(4, 'Editar Partida'),
(5, 'Borrar Partida'),
(6, 'Administrar Usuarios'),
(7, 'Ver Coordinacion'),
(9, 'Agregar Coordinacion'),
(10, 'Editar Coordinacion'),
(11, 'Borrar Coordinacion'),
(12, 'Configurar Sistema'),
(13, 'Ver Presupuesto'),
(14, 'Agregar Presupuesto'),
(15, 'Editar Presupuesto'),
(16, 'Borrar Presupuesto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpresupuesto`
--

CREATE TABLE IF NOT EXISTS `tpresupuesto` (
  `idPresupuesto` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `tCoordinacion_idCoordinacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vNombrePresupuesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iPresupuestoInicial` int(11) NOT NULL,
  `iPresupuestoModificado` int(11) NOT NULL,
  `iGasto` int(11) NOT NULL DEFAULT '0',
  `iSaldo` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tpresupuesto`
--

INSERT INTO `tpresupuesto` (`idPresupuesto`, `anno`, `tCoordinacion_idCoordinacion`, `vNombrePresupuesto`, `iPresupuestoInicial`, `iPresupuestoModificado`, `iGasto`, `iSaldo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2015, '1050', 'Presupuesto de Prueba', 3000000, 3000000, 100, 2999900, '0000-00-00 00:00:00', '2015-12-12 02:39:11', NULL),
(2, 2015, '1054', 'PRESUPUESTO ORDINARIO', 80000, 80000, 13788, 66212, '2015-12-11 06:35:13', '2015-12-12 02:44:16', NULL),
(3, 2015, '1054', 'Presupuesto Extraordinario', 15000000, 15000000, 0, 15000000, '2015-12-11 07:11:57', '2015-12-12 02:44:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpresupuesto_tpartida`
--

CREATE TABLE IF NOT EXISTS `tpresupuesto_tpartida` (
  `id` int(11) NOT NULL,
  `tPresupuesto_idPresupuesto` int(11) NOT NULL,
  `tPartida_idPartida` int(11) NOT NULL,
  `iPresupuestoInicial` int(11) NOT NULL DEFAULT '0',
  `iPresupuestoModificado` int(11) NOT NULL DEFAULT '0',
  `iGasto` int(11) NOT NULL DEFAULT '0',
  `iSaldo` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tpresupuesto_tpartida`
--

INSERT INTO `tpresupuesto_tpartida` (`id`, `tPresupuesto_idPresupuesto`, `tPartida_idPartida`, `iPresupuestoInicial`, `iPresupuestoModificado`, `iGasto`, `iSaldo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1000000, 1000000, 100, 999900, '0000-00-00 00:00:00', '2015-12-12 00:57:18', NULL),
(2, 1, 2, 500000, 500000, 0, 500000, '0000-00-00 00:00:00', '2015-12-11 03:54:39', NULL),
(3, 2, 1, 80000, 80000, 13788, 66212, '0000-00-00 00:00:00', '2015-12-12 02:15:31', NULL),
(4, 1, 13, 1500000, 1500000, 0, 1500000, '2015-12-12 02:03:33', '2015-12-12 02:15:12', NULL),
(6, 3, 14, 15000000, 15000000, 0, 15000000, '2015-12-12 02:06:06', '2015-12-12 02:09:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trol`
--

CREATE TABLE IF NOT EXISTS `trol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(45) DEFAULT NULL,
  `descripcionRol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trol`
--

INSERT INTO `trol` (`idRol`, `nombreRol`, `descripcionRol`) VALUES
(1, 'default', 'Rol por defecto'),
(2, 'Administrador', 'Acceso total'),
(6, 'Usuario Financiero', 'Funcionario de la oficina de financiero'),
(7, 'prueba', 'asd'),
(19, 'holasadafasd', 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trol_tiene_tpermiso`
--

CREATE TABLE IF NOT EXISTS `trol_tiene_tpermiso` (
  `tRol_idRol` int(11) NOT NULL,
  `tPermiso_idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trol_tiene_tpermiso`
--

INSERT INTO `trol_tiene_tpermiso` (`tRol_idRol`, `tPermiso_idPermiso`) VALUES
(1, 1),
(2, 1),
(6, 1),
(19, 1),
(6, 2),
(19, 2),
(6, 3),
(19, 3),
(6, 4),
(19, 4),
(6, 5),
(19, 5),
(2, 6),
(6, 6),
(19, 6),
(6, 7),
(19, 7),
(6, 9),
(19, 9),
(6, 10),
(19, 10),
(6, 11),
(19, 11),
(6, 12),
(19, 12),
(6, 13),
(19, 13),
(6, 14),
(19, 14),
(6, 15),
(19, 15),
(6, 16),
(19, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario`
--

CREATE TABLE IF NOT EXISTS `tusuario` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tRol_idRol` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tusuario`
--

INSERT INTO `tusuario` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `tRol_idRol`) VALUES
(1, 'Arturo Madrigal Villalobos', 'arturo.madrigal@ucr.ac.cr', '$2y$10$rxK74VhHOsbFtG.QgPB/6OEU5fPmcyW2SRopkI0v7W7ZKRL1G06NO', 'QH5HTNy74Pi3sFSpi87Bur2mEYMZvvQxJLPDMcz0tjblC3ATXqwrJC2kaMke', '2015-10-22 02:45:21', '2015-12-12 00:59:06', 6),
(2, 'Angelito Madrigal Villalobos', 'angelito@gmail.com', '$2y$10$wbV38HhRPRnIsqrxKyKX8uSIiftQmJImZGGIewPHC9A0BK8.qO.uG', '7BK9mtS2cP3rmXd1TIVBsQYnNvgwWH9ejsxd4tsFPhPekddUm5lZqqqb34Wy', '2015-10-22 02:48:37', '2015-12-06 04:23:05', 2),
(3, 'Manuel Mora', 'manuel@gmail.com', '$2y$10$hKwr8ZwynHhWrFfCQyav.uNVquMlSjTEqZwYQtAemXRwaqcMl3F4u', 'xkd3FAA4EhCzlovcPmAXunOHc5LqnKHjiYcZRrprU1moUoUtfBXjhqDBl8Rp', '2015-11-09 22:54:43', '2015-11-13 04:07:10', 1),
(4, 'Miguel Castro', 'miguel@gmail.com', '$2y$10$USJSvcIYl.yF8rWFjD//AOCQGrmQ8/rm0JizGxo2l/25ZgAGGAFxG', 'bVJj2TtMhhh0xuyksvcLImFyaJUBgzhnbDGg0AmLPmkMaIoWxdD6UjnlWPWt', '2015-12-08 23:04:23', '2015-12-08 23:33:25', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario_tcoordinacion`
--

CREATE TABLE IF NOT EXISTS `tusuario_tcoordinacion` (
  `tusuario_id` int(11) NOT NULL,
  `tcoordinacion_idCoordinacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `tconfiguracion`
--
ALTER TABLE `tconfiguracion`
  ADD PRIMARY KEY (`idConfiguracion`);

--
-- Indices de la tabla `tcoordinacion`
--
ALTER TABLE `tcoordinacion`
  ADD PRIMARY KEY (`idCoordinacion`),
  ADD UNIQUE KEY `tcoordinacion_idcoordinacion_unique` (`idCoordinacion`);

--
-- Indices de la tabla `tfactura`
--
ALTER TABLE `tfactura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `tfactura_tpartida_idpartida_foreign` (`tPartida_idPartida`);

--
-- Indices de la tabla `tfacturadetalle`
--
ALTER TABLE `tfacturadetalle`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `tFactura_idFactura` (`tFactura_idFactura`);

--
-- Indices de la tabla `tpartida`
--
ALTER TABLE `tpartida`
  ADD PRIMARY KEY (`idPartida`),
  ADD UNIQUE KEY `codPartida` (`codPartida`);

--
-- Indices de la tabla `tpermiso`
--
ALTER TABLE `tpermiso`
  ADD PRIMARY KEY (`idPermiso`);

--
-- Indices de la tabla `tpresupuesto`
--
ALTER TABLE `tpresupuesto`
  ADD PRIMARY KEY (`idPresupuesto`),
  ADD UNIQUE KEY `tpresupuesto_idpresupuesto_unique` (`idPresupuesto`),
  ADD KEY `tpresupuesto_tcoordinacion_idcoordinacion_foreign` (`tCoordinacion_idCoordinacion`);

--
-- Indices de la tabla `tpresupuesto_tpartida`
--
ALTER TABLE `tpresupuesto_tpartida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tPresupuesto_idPresupuesto` (`tPresupuesto_idPresupuesto`),
  ADD KEY `tPartida_idPartida` (`tPartida_idPartida`);

--
-- Indices de la tabla `trol`
--
ALTER TABLE `trol`
  ADD PRIMARY KEY (`idRol`),
  ADD UNIQUE KEY `nombreRol` (`nombreRol`);

--
-- Indices de la tabla `trol_tiene_tpermiso`
--
ALTER TABLE `trol_tiene_tpermiso`
  ADD PRIMARY KEY (`tRol_idRol`,`tPermiso_idPermiso`),
  ADD KEY `fk_tRol_has_tPermiso_tPermiso1_idx` (`tPermiso_idPermiso`),
  ADD KEY `fk_tRol_has_tPermiso_tRol_idx` (`tRol_idRol`);

--
-- Indices de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_tUsuario_tRol1_idx` (`tRol_idRol`);

--
-- Indices de la tabla `tusuario_tcoordinacion`
--
ALTER TABLE `tusuario_tcoordinacion`
  ADD PRIMARY KEY (`tusuario_id`,`tcoordinacion_idCoordinacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tconfiguracion`
--
ALTER TABLE `tconfiguracion`
  MODIFY `idConfiguracion` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tfactura`
--
ALTER TABLE `tfactura`
  MODIFY `idFactura` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `tfacturadetalle`
--
ALTER TABLE `tfacturadetalle`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT de la tabla `tpartida`
--
ALTER TABLE `tpartida`
  MODIFY `idPartida` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `tpermiso`
--
ALTER TABLE `tpermiso`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tpresupuesto`
--
ALTER TABLE `tpresupuesto`
  MODIFY `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tpresupuesto_tpartida`
--
ALTER TABLE `tpresupuesto_tpartida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `trol`
--
ALTER TABLE `trol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tfactura`
--
ALTER TABLE `tfactura`
  ADD CONSTRAINT `tfactura_ibfk_1` FOREIGN KEY (`tPartida_idPartida`) REFERENCES `tpresupuesto_tpartida` (`id`);

--
-- Filtros para la tabla `tfacturadetalle`
--
ALTER TABLE `tfacturadetalle`
  ADD CONSTRAINT `tfacturadetalle_ibfk_1` FOREIGN KEY (`tFactura_idFactura`) REFERENCES `tfactura` (`idFactura`);

--
-- Filtros para la tabla `tpresupuesto`
--
ALTER TABLE `tpresupuesto`
  ADD CONSTRAINT `tpresupuesto_tcoordinacion_idcoordinacion_foreign` FOREIGN KEY (`tCoordinacion_idCoordinacion`) REFERENCES `tcoordinacion` (`idCoordinacion`);

--
-- Filtros para la tabla `tpresupuesto_tpartida`
--
ALTER TABLE `tpresupuesto_tpartida`
  ADD CONSTRAINT `tpresupuesto_tpartida_ibfk_1` FOREIGN KEY (`tPresupuesto_idPresupuesto`) REFERENCES `tpresupuesto` (`idPresupuesto`),
  ADD CONSTRAINT `tpresupuesto_tpartida_ibfk_2` FOREIGN KEY (`tPartida_idPartida`) REFERENCES `tpartida` (`idPartida`);

--
-- Filtros para la tabla `trol_tiene_tpermiso`
--
ALTER TABLE `trol_tiene_tpermiso`
  ADD CONSTRAINT `fk_tRol_has_tPermiso_tPermiso1` FOREIGN KEY (`tPermiso_idPermiso`) REFERENCES `tpermiso` (`idPermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tRol_has_tPermiso_tRol` FOREIGN KEY (`tRol_idRol`) REFERENCES `trol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tusuario`
--
ALTER TABLE `tusuario`
  ADD CONSTRAINT `fk_tUsuario_tRol1` FOREIGN KEY (`tRol_idRol`) REFERENCES `trol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
