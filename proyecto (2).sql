-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2018 a las 22:34:19
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
-- Base de datos: `proyecto`
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
(10, 1493990, 'Melany Alejandra Rojas Troyano ', 3265974231, 'sakdjhaskdjs@gmail.com'),
(11, 1493990, ' Alejandra Rojas Troyano Lopez', 3265974232, 'sakdjhaskdjs@gmail.com'),
(12, 1493990, 'Karen Molina Cobo ', 3265974233, 'sakdjhaskdjs@gmail.com'),
(13, 1493990, 'Daniel Yordanier Valencia Troyano ', 3265974234, 'sakdjhaskdjs@gmail.com'),
(15, 1493990, ' Danny Peña ', 3265974236, 'sakdjhaskdjs@gmail.com'),
(16, 1493990, 'Mariana Bolaños', 3265974237, 'sakdjhaskdjs@gmail.com'),
(17, 1493990, 'Tatiana Riascos', 3265974238, 'sakdjhaskdjs@gmail.com'),
(18, 1493990, 'Melany Alejandra Rojas Troyano ', 3265974239, 'sakdjhaskdjs@gmail.com'),
(141, 1493990, 'Nare Alejandro Manquillo Cobo', 3265974235, 'sakdjhaskdjs@gmail.com');

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
(4, 6, 1, 1, 'MOUSE', 'SFDS54', 'ACER', NULL, 'ACTIVO', '123Z', '7898x'),
(5, 6, 1, 1, 'CPU', NULL, NULL, NULL, 'ACTIVO', '', ''),
(6, 6, 1, 1, 'TECLADO', '54132', NULL, NULL, 'DAÑADO', '31212', ''),
(7, 6, 1, 1, 'MONITOR', 'SDSDAS', 'HP', NULL, 'ACTIVO', '', 'asdsa'),
(8, 7, 3, 1, 'MOUSE ', '32132', 'HP', NULL, 'ACTIVO', 'zxcz', 'zxcz'),
(9, 7, 3, 1, 'CPU', 'ASDA', 'LENOVO', '...', 'DAÑADO', '1232', 'asd12'),
(10, 7, 3, 1, 'TECLADO', 'ZXCZCS', 'XCXC', NULL, 'ACTIVO', '', '321w'),
(11, 8, 2, 1, 'MONITOR', '2321', 'LG', NULL, 'ACTIVO', '', 'dasd2'),
(12, 8, 2, 1, 'TECLADO', 'ASDSAD', 'ASDASD', NULL, 'ACTIVO', 'assad', 'asdas'),
(13, 8, 2, 1, 'CPU', 'ADASDAS', NULL, NULL, 'ACTIVO', '324234', 'asdas'),
(14, 7, 3, 1, 'MONITOR', 'ADSADA', 'SASA', '', 'ACTIVO', '', '');

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
  `numarticulosagregados` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `nombreequipo`, `estadoequipo`, `numarticulosequipo`, `observacionequipo`, `numarticulosagregados`) VALUES
(1, 'A20', 'ACTIVADO', '4', '', '4'),
(2, 'D01', 'ACTIVADO', '3', '', '3'),
(3, 'I33', 'DESACTIVADO', '6', 'EL EQUIPO PRESENTA UN GOLPE EN LA ESQUINA SUPERIOR DERECHA DE LA PANTALLA', '4');

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
(1493990, 5, 6, '11/11/2011', '11/11/2013', 'TARDE');

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
  `fotousuario` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`numdocumentousuario`, `idprograma`, `nombreusuario`, `contraseniausuario`, `rolusuario`, `fotousuario`) VALUES
(123, NULL, 'ADMINISTRADOR', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'ADMINISTRADOR', ''),
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
  ADD KEY `idcategoria` (`idcategoria`);

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
  ADD PRIMARY KEY (`idequipo`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`numeroficha`),
  ADD KEY `idprograma` (`idprograma`,`idambiente`),
  ADD KEY `idambiente` (`idambiente`);

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
  MODIFY `idacta_compromiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `acta_responsabilidad`
--
ALTER TABLE `acta_responsabilidad`
  MODIFY `idacta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `idambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `novedad`
--
ALTER TABLE `novedad`
  MODIFY `idnovedad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `idprograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD CONSTRAINT `articulo` FOREIGN KEY (`articulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
