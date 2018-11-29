-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2018 a las 02:14:47
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
(1, NULL, NULL, NULL, 'SDFSDF', 'SDFASDF', 'SDFSDFSD', '', 'ACTIVO', 'sdfsdf', '123123'),
(3, NULL, NULL, NULL, 'TECLADO', '54A6S', 'ACER', 'ASDASDAKJDHKAJDHAKSJ', 'ACTIVO', '123', '654sd');

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
(123, NULL, 'ADMINISTRADOR', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'ADMINISTRADOR', '');

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
  MODIFY `idacta_compromiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `acta_responsabilidad`
--
ALTER TABLE `acta_responsabilidad`
  MODIFY `idacta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `idambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `novedad`
--
ALTER TABLE `novedad`
  MODIFY `idnovedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `idprograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
