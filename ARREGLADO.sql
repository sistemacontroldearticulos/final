-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2018 a las 19:43:43
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

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
  `observaciones` text COLLATE utf8_bin NOT NULL
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
(3, 1, 'DASDASD', 'ASDASD'),
(4, 1, '3123123123', 'DASDAS');

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
(1, 1, 'Melany Alejandra Rojas Troyano ', 3265974231, 'sakdjhaskdjs@gmail.com'),
(2, 1, ' Alejandra Rojas Troyano Lopez', 3265974232, 'sakdjhaskdjs@gmail.com'),
(3, 1, 'Karen Molina Cobo ', 3265974233, 'sakdjhaskdjs@gmail.com'),
(4, 1, 'Daniel Yordanier Valencia Troyano ', 3265974234, 'sakdjhaskdjs@gmail.com'),
(5, 1, 'Nare Alejandro Manquillo Cobo', 3265974235, 'sakdjhaskdjs@gmail.com'),
(6, 1, ' Danny Peña ', 3265974236, 'sakdjhaskdjs@gmail.com'),
(7, 1, 'Mariana Bolaños', 3265974237, 'sakdjhaskdjs@gmail.com'),
(8, 1, 'Tatiana Riascos', 3265974238, 'sakdjhaskdjs@gmail.com'),
(9, 1, 'Melany Alejandra Rojas Troyano ', 3265974239, 'sakdjhaskdjs@gmail.com');

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
(1, 3, NULL, 2, 'SDFSDF', 'SDFASDF', 'SDFSDFSD', NULL, 'ACTIVO', 'sdfsdf', '123123'),
(2, 3, NULL, 1, '123123', '123123', 'ASD', NULL, 'ACTIVO', 'asdad', 'adasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulonovedad`
--

CREATE TABLE `articulonovedad` (
  `idarticulo` int(11) NOT NULL,
  `idnovedad` int(11) NOT NULL,
  `tiponovedad` varchar(50) COLLATE utf8_bin NOT NULL,
  `observacionnovedad` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `articulonovedad`
--

INSERT INTO `articulonovedad` (`idarticulo`, `idnovedad`, `tiponovedad`, `observacionnovedad`) VALUES
(1, 8, 'PERDIDO', 'qweqwe');

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
(1, 'IMPLEMENTOS DE SEGURIDAD'),
(2, 'CONSTRUCCION');

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

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`numeroficha`, `idprograma`, `idambiente`, `fechainicio`, `fechafin`, `jornadaficha`) VALUES
(1, 1, 3, '11/11/2011', '11/11/2012', 'MAñANA');

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
(8, 123, 1, '2018-11-24 13:43:05', NULL, 1);

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
(1, 'ANIMACION 3D', '', 'TÉCNICO'),
(2, 'ADSI', '', 'TÉCNICO');

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
(123, NULL, 'ADMINISTRADOR', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'ADMINISTRADOR', NULL);

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
  MODIFY `idambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idprograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
