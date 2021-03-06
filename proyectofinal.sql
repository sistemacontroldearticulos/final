-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2018 a las 00:05:12
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actacompromiso`
--

CREATE TABLE `actacompromiso` (
  `idacta_compromiso` int(11) NOT NULL,
  `idacta_responsabilidad` int(11) NOT NULL,
  `fechacreacion` text COLLATE utf8_bin NOT NULL,
  `fechalimite` text COLLATE utf8_bin NOT NULL,
  `idarticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `actacompromiso`
--

INSERT INTO `actacompromiso` (`idacta_compromiso`, `idacta_responsabilidad`, `fechacreacion`, `fechalimite`, `idarticulo`) VALUES
(1, 1, '2018-12-02 20:27:18', '11/11/2011', 6),
(2, 1, '2018-12-03 00:31:03', '12/09/2018', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_responsabilidad`
--

CREATE TABLE `acta_responsabilidad` (
  `idacta` int(11) NOT NULL,
  `numdocumentoaprendiz` double NOT NULL,
  `idequipo` int(11) NOT NULL,
  `fechaacta` text COLLATE utf8_bin NOT NULL,
  `numdocumentoinstructor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `acta_responsabilidad`
--

INSERT INTO `acta_responsabilidad` (`idacta`, `numdocumentoaprendiz`, `idequipo`, `fechaacta`, `numdocumentoinstructor`) VALUES
(1, 13, 1, '2018-12-01 09:33:37', 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

CREATE TABLE `ambiente` (
  `idambiente` int(11) NOT NULL,
  `idprograma` int(11) DEFAULT NULL,
  `nombreambiente` varchar(50) COLLATE utf8_bin NOT NULL,
  `ubicacionambiente` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ambiente`
--

INSERT INTO `ambiente` (`idambiente`, `idprograma`, `nombreambiente`, `ubicacionambiente`) VALUES
(6, 5, 'AMBIENTE L', ''),
(7, 6, 'AMBIENTE I1', 'CUALQUIER COSA'),
(8, 4, 'AMBIENTE MULTIMEDIA', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `numdocumentoaprendiz` double NOT NULL,
  `numeroficha` int(11) NOT NULL,
  `nombreaprendiz` varchar(50) COLLATE utf8_bin NOT NULL,
  `telefonoaprendiz` double NOT NULL,
  `emailaprendiz` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `aprendiz`
--

INSERT INTO `aprendiz` (`numdocumentoaprendiz`, `numeroficha`, `nombreaprendiz`, `telefonoaprendiz`, `emailaprendiz`) VALUES
(11, 1493990, ' Alejandra Rojas Troyano Lopez', 3265974232, 'sakdjhaskdjs@gmail.com'),
(13, 1493990, 'Daniel Yordanier Valencia Troyano ', 3265974234, 'sakdjhaskdjs@gmail.com'),
(15, 1493990, ' Danny Peña ', 3265974236, 'sakdjhaskdjs@gmail.com'),
(16, 1493990, 'Mariana Bolaños', 3265974237, 'sakdjhaskdjs@gmail.com'),
(17, 1493990, 'Tatiana Riascos', 3265974238, 'sakdjhaskdjs@gmail.com'),
(141, 1493990, 'Nare Alejandro Manquillo Cobo', 3265974235, 'sakdjhaskdjs@gmail.com'),
(145645642, 1493994, ' Alejandra Rojas Troyano Lopez', 3265974232, 'sakdjhaskdjs@gmail.com'),
(345345243, 1493994, 'Mariana Bolaños', 3265974237, 'sakdjhaskdjs@gmail.com'),
(789789792, 1493994, 'Karen Molina Cobo ', 3265974233, 'sakdjhaskdjs@gmail.com'),
(1279878762, 1493994, 'Tatiana Riascos', 3265974238, 'sakdjhaskdjs@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int(11) NOT NULL,
  `idambiente` int(11) DEFAULT NULL,
  `idequipo` int(11) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `tipoarticulo` varchar(50) COLLATE utf8_bin NOT NULL,
  `modeloarticulo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `marcaarticulo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `caracteristicaarticulo` text COLLATE utf8_bin,
  `estadoarticulo` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `numinventariosena` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `serialarticulo` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idarticulo`, `idambiente`, `idequipo`, `idcategoria`, `tipoarticulo`, `modeloarticulo`, `marcaarticulo`, `caracteristicaarticulo`, `estadoarticulo`, `numinventariosena`, `serialarticulo`) VALUES
(4, 6, 4, 1, 'MOUSE', 'SSSSSS', 'ACER', '', 'DAÑADO', '123Z', '7898x'),
(5, 6, 1, 1, 'CPU', NULL, NULL, NULL, 'PERDIDO', '', ''),
(6, 6, 1, 1, 'TECLADO', '54132', NULL, NULL, 'DAÑADO', '31212', ''),
(7, 6, 1, 1, 'MONITOR', 'SDSDAS', 'HP', NULL, 'DAÑADO', '', 'asdsa'),
(8, 7, 3, 1, 'MOUSE ', '32132', 'HP', NULL, 'ACTIVO', 'zxcz', 'zxcz'),
(9, 7, 3, 1, 'CPU', 'ASDA', 'LENOVO', '...', 'DAÑADO', '1232', 'asd12'),
(10, 7, 3, 1, 'TECLADO', 'ZXCZCS', 'XCXC', NULL, 'PERDIDO', '', '321w'),
(11, 8, 2, 1, 'MONITOR', '2321', 'LG', NULL, 'DAÑADO', '', 'dasd2'),
(12, 8, 2, 1, 'TECLADO', 'ASDSAD', 'ASDASD', NULL, 'PERDIDO', 'assad', 'asdas'),
(13, 8, 2, 1, 'CPU', 'ADASDAS', NULL, NULL, 'PERDIDO', '324234', 'asdas'),
(14, 7, 3, 1, 'MONITOR', 'ADSADA', 'SASA', '', 'ACTIVO', '', ''),
(15, 6, 1, 1, '123', '123', '123', '1321', 'ACTIVO', '123', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulonovedad`
--

CREATE TABLE `articulonovedad` (
  `idarticulo` int(11) NOT NULL,
  `idnovedad` int(11) NOT NULL,
  `tiponovedad` varchar(50) COLLATE utf8_bin NOT NULL,
  `observacionnovedad` text COLLATE utf8_bin,
  `fotonovedad` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulonovedad`
--

INSERT INTO `articulonovedad` (`idarticulo`, `idnovedad`, `tiponovedad`, `observacionnovedad`, `fotonovedad`) VALUES
(4, 60, 'DAÑADO', 'dfsfsf', 'vistas/img/usuarios/default/articulo.png'),
(5, 60, 'PERDIDO', '', 'vistas/img/usuarios/default/articulo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombrecategoria` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombrecategoria`) VALUES
(1, 'TECNOLOGíA ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` int(11) NOT NULL,
  `nombreequipo` varchar(50) COLLATE utf8_bin NOT NULL,
  `estadoequipo` text COLLATE utf8_bin NOT NULL,
  `numarticulosequipo` varchar(50) COLLATE utf8_bin NOT NULL,
  `observacionequipo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `numarticulosagregados` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `idambiente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `nombreequipo`, `estadoequipo`, `numarticulosequipo`, `observacionequipo`, `numarticulosagregados`, `idambiente`) VALUES
(1, 'A20', 'ACTIVADO', '4', '', '4', NULL),
(2, 'D01', 'ACTIVADO', '3', '', '3', NULL),
(3, 'I33', 'DESACTIVADO', '6', 'EL EQUIPO PRESENTA UN GOLPE EN LA ESQUINA SUPERIOR DERECHA DE LA PANTALLA', '4', NULL),
(4, 'A21', 'ACTIVADO', '7', '', '1', NULL),
(5, 'C30', 'ACTIVADO', '8', 'KDSHFKDSJFK', '0', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `numeroficha` int(11) NOT NULL,
  `idprograma` int(11) DEFAULT NULL,
  `idambiente` int(11) DEFAULT NULL,
  `fechainicio` varchar(50) COLLATE utf8_bin NOT NULL,
  `fechafin` varchar(50) COLLATE utf8_bin NOT NULL,
  `jornadaficha` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`numeroficha`, `idprograma`, `idambiente`, `fechainicio`, `fechafin`, `jornadaficha`) VALUES
(1493990, 5, 6, '11/11/2011', '11/11/2013', 'TARDE'),
(1493994, 4, 8, '11/11/2011', '11/11/2012', 'MAÑANA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificacion` int(11) NOT NULL,
  `numdocumentousuario` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_bin NOT NULL,
  `fecha` varchar(50) COLLATE utf8_bin NOT NULL,
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificacion`, `numdocumentousuario`, `tipo`, `fecha`, `leido`) VALUES
(22, 777, 'CREADO UNA NUEVA NOVEDAD', '2018-12-02 12:03:27', 1),
(23, 888, 'CREADO UNA NUEVA NOVEDAD', '2018-12-02 14:04:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad`
--

CREATE TABLE `novedad` (
  `idnovedad` int(11) NOT NULL,
  `numdocumentousuario` int(11) NOT NULL,
  `numeroficha` int(11) NOT NULL,
  `fechanovedad` text COLLATE utf8_bin NOT NULL,
  `articulo` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `novedad`
--

INSERT INTO `novedad` (`idnovedad`, `numdocumentousuario`, `numeroficha`, `fechanovedad`, `articulo`, `estado`) VALUES
(60, 123, 1493990, '2018-12-03 00:19:34', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `idprograma` int(11) NOT NULL,
  `nombreprograma` varchar(50) COLLATE utf8_bin NOT NULL,
  `duracionprograma` varchar(50) COLLATE utf8_bin NOT NULL,
  `tipoprograma` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`idprograma`, `nombreprograma`, `duracionprograma`, `tipoprograma`) VALUES
(4, 'DESARROLLO WEB', '', 'TÉCNICO'),
(5, 'ADSI', '', 'TECNÓLOGO'),
(6, 'INGLES', '', 'COMPLEMENTARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `numdocumentousuario` int(11) NOT NULL,
  `idprograma` int(11) DEFAULT NULL,
  `nombreusuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `contraseniausuario` varchar(200) COLLATE utf8_bin NOT NULL,
  `rolusuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `fotousuario` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`numdocumentousuario`, `idprograma`, `nombreusuario`, `contraseniausuario`, `rolusuario`, `fotousuario`) VALUES
(123, NULL, 'ADMINISTRADOR', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'ADMINISTRADOR', ''),
(777, 5, 'INSTRUCTOR ', '093763d6b1457e9fb44eeb346737783ad13bb739370d4a7d42d9cade8da9040b8c64e525aa0f2afde2dd5a98e763fbde69a679098603083c6a76fa2f66aa1188', 'INSTRUCTOR', 'vistas/img/usuarios/777/899.png'),
(888, 6, 'ESPECIAL', 'bb602aa6ebb8decd4a7293b1c428cf4889df083d0984378ceefc600a371ac96de20ed1fbc8adf3baa8e63a28d20b750b1dd2512c51cf78490b602b5bc50e47c1', 'ESPECIAL', 'vistas/img/usuarios/888/852.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actacompromiso`
--
ALTER TABLE `actacompromiso`
  ADD PRIMARY KEY (`idacta_compromiso`),
  ADD KEY `idacta_responsabilidad` (`idacta_responsabilidad`);

--
-- Indices de la tabla `acta_responsabilidad`
--
ALTER TABLE `acta_responsabilidad`
  ADD PRIMARY KEY (`idacta`),
  ADD KEY `numdocumentoinstructor` (`numdocumentoinstructor`),
  ADD KEY `numdocumentoaprendiz` (`numdocumentoaprendiz`,`idequipo`),
  ADD KEY `idequipo` (`idequipo`);

--
-- Indices de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`idambiente`),
  ADD KEY `idprograma` (`idprograma`);

--
-- Indices de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD PRIMARY KEY (`numdocumentoaprendiz`),
  ADD KEY `numeroficha` (`numeroficha`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`),
  ADD KEY `idambiente` (`idambiente`,`idequipo`,`idcategoria`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idequipo` (`idequipo`);

--
-- Indices de la tabla `articulonovedad`
--
ALTER TABLE `articulonovedad`
  ADD PRIMARY KEY (`idarticulo`,`idnovedad`),
  ADD KEY `idarticulo` (`idarticulo`,`idnovedad`),
  ADD KEY `idnovedad` (`idnovedad`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequipo`),
  ADD KEY `idambiente` (`idambiente`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`numeroficha`),
  ADD KEY `idprograma` (`idprograma`,`idambiente`),
  ADD KEY `idambiente` (`idambiente`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificacion`),
  ADD KEY `numdocumentousuario` (`numdocumentousuario`);

--
-- Indices de la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD PRIMARY KEY (`idnovedad`),
  ADD KEY `numdocumentousuario` (`numdocumentousuario`,`numeroficha`),
  ADD KEY `numeroficha` (`numeroficha`),
  ADD KEY `articulo` (`articulo`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`idprograma`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`numdocumentousuario`),
  ADD KEY `idprograma` (`idprograma`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actacompromiso`
--
ALTER TABLE `actacompromiso`
  MODIFY `idacta_compromiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `acta_responsabilidad`
--
ALTER TABLE `acta_responsabilidad`
  MODIFY `idacta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `idambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `novedad`
--
ALTER TABLE `novedad`
  MODIFY `idnovedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `idprograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actacompromiso`
--
ALTER TABLE `actacompromiso`
  ADD CONSTRAINT `actacompromiso_ibfk_1` FOREIGN KEY (`idacta_responsabilidad`) REFERENCES `acta_responsabilidad` (`idacta`);

--
-- Filtros para la tabla `acta_responsabilidad`
--
ALTER TABLE `acta_responsabilidad`
  ADD CONSTRAINT `acta_responsabilidad_ibfk_1` FOREIGN KEY (`numdocumentoaprendiz`) REFERENCES `aprendiz` (`numdocumentoaprendiz`),
  ADD CONSTRAINT `acta_responsabilidad_ibfk_2` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`),
  ADD CONSTRAINT `acta_responsabilidad_ibfk_3` FOREIGN KEY (`numdocumentoinstructor`) REFERENCES `usuario` (`numdocumentousuario`);

--
-- Filtros para la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD CONSTRAINT `ambiente_ibfk_1` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`);

--
-- Filtros para la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD CONSTRAINT `aprendiz_ibfk_1` FOREIGN KEY (`numeroficha`) REFERENCES `ficha` (`numeroficha`);

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`idambiente`) REFERENCES `ambiente` (`idambiente`),
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`),
  ADD CONSTRAINT `articulo_ibfk_3` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`);

--
-- Filtros para la tabla `articulonovedad`
--
ALTER TABLE `articulonovedad`
  ADD CONSTRAINT `articulonovedad_ibfk_1` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`),
  ADD CONSTRAINT `articulonovedad_ibfk_2` FOREIGN KEY (`idnovedad`) REFERENCES `novedad` (`idnovedad`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`idambiente`) REFERENCES `ambiente` (`idambiente`);

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`),
  ADD CONSTRAINT `ficha_ibfk_2` FOREIGN KEY (`idambiente`) REFERENCES `ambiente` (`idambiente`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`numdocumentousuario`) REFERENCES `usuario` (`numdocumentousuario`);

--
-- Filtros para la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD CONSTRAINT `articulo` FOREIGN KEY (`articulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `novedad_ibfk_1` FOREIGN KEY (`numdocumentousuario`) REFERENCES `usuario` (`numdocumentousuario`),
  ADD CONSTRAINT `novedad_ibfk_2` FOREIGN KEY (`numeroficha`) REFERENCES `ficha` (`numeroficha`),
  ADD CONSTRAINT `novedad_ibfk_3` FOREIGN KEY (`articulo`) REFERENCES `articulo` (`idarticulo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
