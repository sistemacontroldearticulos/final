-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2018 a las 22:36:56
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
-- Base de datos: 'proyectofinal'
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'acta_responsabilidad'
--

CREATE TABLE 'acta_responsabilidad' (
  'IdActa' int(50) NOT NULL,
  'NumDocumentoAprendiz' int(50) NOT NULL,
  'IdEquipo' int(50) NOT NULL,
  'FechaActa' datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'ambiente'
--

CREATE TABLE 'ambiente' (
  'IdAmbiente' int(50) NOT NULL,
  'IdPrograma' int(50) DEFAULT NULL,
  'NombreAmbiente' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'UbicacionAmbiente' varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'ambiente'
--

INSERT INTO 'ambiente' ('IdAmbiente', 'IdPrograma', 'NombreAmbiente', 'UbicacionAmbiente') VALUES
(3, NULL, 'ADSI 3', 'L'),
(4, 39, 'CASA SOLAR', 'ASDASD'),
(6, NULL, 'L', 'FRENTE A TBT'),
(7, 39, 'AMBIENTE 302', 'PASILLO PRICIPAL'),
(8, 39, 'AMBIENTE 05A', NULL),
(11, 43, 'ZXCZX', 'ZXCZC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'aprendiz'
--

CREATE TABLE 'aprendiz' (
  'NumDocumentoAprendiz' int(50) NOT NULL,
  'NumeroFicha' int(50) NOT NULL,
  'NombreAprendiz' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'TelefonoAprendiz' int(10) NOT NULL,
  'EmailAprendiz' varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'aprendiz'
--

INSERT INTO 'aprendiz' ('NumDocumentoAprendiz', 'NumeroFicha', 'NombreAprendiz', 'TelefonoAprendiz', 'EmailAprendiz') VALUES
(1232132, 11111, 'Melany Alejandra Rojas Troyano ', 2147483647, 'sakdjhaskdjs@gmail.com'),
(11234352, 11111, 'Daniel Yordanier Valencia Troyano ', 2147483647, 'sakdjhaskdjs@gmail.com'),
(54665757, 11111, ' Danny Peña ', 2147483647, 'sakdjhaskdjs@gmail.com'),
(145645642, 11111, ' Alejandra Rojas Troyano Lopez', 2147483647, 'sakdjhaskdjs@gmail.com'),
(345345243, 11111, 'Mariana Bolaños', 2147483647, 'sakdjhaskdjs@gmail.com'),
(354646242, 11111, 'Nare Alejandro Manquillo Cobo', 2147483647, 'sakdjhaskdjs@gmail.com'),
(789789792, 11111, 'Karen Molina Cobo ', 2147483647, 'sakdjhaskdjs@gmail.com'),
(1279878762, 11111, 'Tatiana Riascos', 2147483647, 'sakdjhaskdjs@gmail.com'),
(2147483647, 11111, 'Melany Alejandra Rojas Troyano ', 2147483647, 'sakdjhaskdjs@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'articulo'
--

CREATE TABLE 'articulo' (
  'IdArticulo' int(50) NOT NULL,
  'IdAmbiente' int(50) NOT NULL,
  'IdEquipo' int(50) DEFAULT NULL,
  'IdCategoria' int(50) NOT NULL,
  'TipoArticulo' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'ModeloArticulo' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'MarcaArticulo' varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  'CaracteristicaArticulo' text COLLATE utf8_spanish_ci,
  'EstadoArticulo' varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  'NumInventarioSena' varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  'SerialArticulo' varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'articulo'
--

INSERT INTO 'articulo' ('IdArticulo', 'IdAmbiente', 'IdEquipo', 'IdCategoria', 'TipoArticulo', 'ModeloArticulo', 'MarcaArticulo', 'CaracteristicaArticulo', 'EstadoArticulo', 'NumInventarioSena', 'SerialArticulo') VALUES
(9, 3, 1, 2, 'MOUSE', 'FGDFG', 'SDFSF', '234324SDFSDF', 'ACTIVO', '343', '232'),
(12, 4, 1, 3, 'TECLADO', 'SDFS', 'HP', 'LAKSDJAKSDM ASDASD ASDK534 XCV', 'DAÑADO', '', 'hm6f'),
(17, 3, 3, 3, 'ADASD', 'ASDASD', 'ASDASD', 'ASDASD', 'ACTIVO', 'asdasd', 'asda'),
(18, 4, 3, 2, 'JJJJ', 'JJJJ', 'JJJJ', 'HKHJK', 'ACTIVO', '123123', 'hkjhjk'),
(20, 3, 3, 2, 'ASDASD', 'ADASD', 'ASDASD', 'SGDFG', 'ACTIVO', '', '232'),
(21, 7, 5, 4, 'MONITOR', '9Q8W', 'ACER', 'ERWEDSFSDFDFD', 'PERDIDO', '654', '3214'),
(22, 8, 1, 3, 'CPU', '445Y', 'HP', '', 'PERDIDO', '333', '132213');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'articulonovedad'
--

CREATE TABLE 'articulonovedad' (
  'IdArticulo' int(50) NOT NULL,
  'IdNovedad' int(50) NOT NULL,
  'TipoNovedad' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'ObservacionNovedad' text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'articulonovedad'
--

INSERT INTO 'articulonovedad' ('IdArticulo', 'IdNovedad', 'TipoNovedad', 'ObservacionNovedad') VALUES
(9, 52, 'DAÑADO', ''),
(17, 53, 'DAÑADO', 'asdasda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'categoria'
--

CREATE TABLE 'categoria' (
  'IdCategoria' int(50) NOT NULL,
  'NombreCategoria' varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'categoria'
--

INSERT INTO 'categoria' ('IdCategoria', 'NombreCategoria') VALUES
(2, 'IMPLEMENTOS DE DASDASDA'),
(3, 'TECNOLOGíAS'),
(4, 'EQUIPOS DE CONSTRUCCION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'equipo'
--

CREATE TABLE 'equipo' (
  'IdEquipo' int(50) NOT NULL,
  'NombreEquipo' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'EstadoEquipo' text COLLATE utf8_spanish_ci NOT NULL,
  'NumArticulosEquipo' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'ObservacionEquipo' varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  'NumArticulosAgregados' varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'equipo'
--

INSERT INTO 'equipo' ('IdEquipo', 'NombreEquipo', 'EstadoEquipo', 'NumArticulosEquipo', 'ObservacionEquipo', 'NumArticulosAgregados') VALUES
(1, 'PC DE MESA', 'DESACTIVADO', '4', 'ME LA PELA EL HIJUEPUTA PHP', '1'),
(3, 'ASDASD', 'ACTIVADO', '3', 'WEGEGWEGWE', '3'),
(5, 'ASDA', 'ACTIVADO', '4', 'FSDFSDF', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'ficha'
--

CREATE TABLE 'ficha' (
  'NumeroFicha' int(50) NOT NULL,
  'IdPrograma' int(50) DEFAULT NULL,
  'IdAmbiente' int(50) NOT NULL,
  'FechaInicio' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'FechaFin' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'JornadaFicha' varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'ficha'
--

INSERT INTO 'ficha' ('NumeroFicha', 'IdPrograma', 'IdAmbiente', 'FechaInicio', 'FechaFin', 'JornadaFicha') VALUES
(11111, 39, 4, '11/11/2011', '11/11/2011', 'TARDE'),
(123123123, NULL, 3, '11/11/2011', '22/02/2022', 'MAñANA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'novedad'
--

CREATE TABLE 'novedad' (
  'IdNovedad' int(50) NOT NULL,
  'NumDocumentoUsuario' int(50) NOT NULL,
  'UsuarioNovedad' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'NumeroFicha' int(50) NOT NULL,
  'FechaNovedad' text COLLATE utf8_spanish_ci NOT NULL,
  'Articulo' varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'novedad'
--

INSERT INTO 'novedad' ('IdNovedad', 'NumDocumentoUsuario', 'UsuarioNovedad', 'NumeroFicha', 'FechaNovedad', 'Articulo') VALUES
(52, 123, 'ADMINISTRADOR', 123123123, '2018-10-11 18:17:47', '9'),
(53, 123, 'ADMINISTRADOR', 123123123, '2018-10-11 18:18:12', '17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'programa'
--

CREATE TABLE 'programa' (
  'IdPrograma' int(50) NOT NULL,
  'NombrePrograma' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'DuracionPrograma' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'TipoPrograma' varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'programa'
--

INSERT INTO 'programa' ('IdPrograma', 'NombrePrograma', 'DuracionPrograma', 'TipoPrograma') VALUES
(39, 'ANIMACIóN 3D', '24 MESES', 'TECNOLOGO'),
(43, 'ADSI', '24 MESES', 'TECNOLOGO'),
(44, 'ADMINISTRACION', '12 MESES', 'TECNICO'),
(45, 'INGLES', '80 HORAS', 'COMPLEMENTARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla 'usuario'
--

CREATE TABLE 'usuario' (
  'NumDocumentoUsuario' int(50) NOT NULL,
  'IdPrograma' int(50) DEFAULT NULL,
  'NombreUsuario' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'ContraseniaUsuario' varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  'RolUsuario' varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  'FotoUsuario' text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla 'usuario'
--

INSERT INTO 'usuario' ('NumDocumentoUsuario', 'IdPrograma', 'NombreUsuario', 'ContraseniaUsuario', 'RolUsuario', 'FotoUsuario') VALUES
(123, NULL, 'ADMINISTRADOR', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'ADMINISTRADOR', ''),
(321, 45, 'PEPO', '44607f62869d34f038c48474ba6311e9787aaf37b8117b4c45e882352602d0c24f9b16c0691a9af5a587895675310ee859b6242a91056d4acb59b2ed5b8875e1', 'INSTRUCTOR', 'vistas/img/usuarios/321/488.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla 'acta_responsabilidad'
--
ALTER TABLE 'acta_responsabilidad'
  ADD PRIMARY KEY ('IdActa'),
  ADD KEY 'NumDocumentoAprendiz' ('NumDocumentoAprendiz'),
  ADD KEY 'IdEquipo' ('IdEquipo');

--
-- Indices de la tabla 'ambiente'
--
ALTER TABLE 'ambiente'
  ADD PRIMARY KEY ('IdAmbiente'),
  ADD KEY 'IdPrograma' ('IdPrograma');

--
-- Indices de la tabla 'aprendiz'
--
ALTER TABLE 'aprendiz'
  ADD PRIMARY KEY ('NumDocumentoAprendiz'),
  ADD KEY 'NumeroFicha' ('NumeroFicha');

--
-- Indices de la tabla 'articulo'
--
ALTER TABLE 'articulo'
  ADD PRIMARY KEY ('IdArticulo'),
  ADD KEY 'IdAmbiente' ('IdAmbiente'),
  ADD KEY 'IdEquipo' ('IdEquipo'),
  ADD KEY 'IdCategoria' ('IdCategoria');

--
-- Indices de la tabla 'articulonovedad'
--
ALTER TABLE 'articulonovedad'
  ADD PRIMARY KEY ('IdArticulo','IdNovedad'),
  ADD KEY 'IdNovedad' ('IdNovedad');

--
-- Indices de la tabla 'categoria'
--
ALTER TABLE 'categoria'
  ADD PRIMARY KEY ('IdCategoria');

--
-- Indices de la tabla 'equipo'
--
ALTER TABLE 'equipo'
  ADD PRIMARY KEY ('IdEquipo');

--
-- Indices de la tabla 'ficha'
--
ALTER TABLE 'ficha'
  ADD PRIMARY KEY ('NumeroFicha'),
  ADD KEY 'IdPrograma' ('IdPrograma'),
  ADD KEY 'IdAmbiente' ('IdAmbiente');

--
-- Indices de la tabla 'novedad'
--
ALTER TABLE 'novedad'
  ADD PRIMARY KEY ('IdNovedad'),
  ADD KEY 'NumDocumentoUsuario' ('NumDocumentoUsuario'),
  ADD KEY 'NumeroFicha' ('NumeroFicha');

--
-- Indices de la tabla 'programa'
--
ALTER TABLE 'programa'
  ADD PRIMARY KEY ('IdPrograma');

--
-- Indices de la tabla 'usuario'
--
ALTER TABLE 'usuario'
  ADD PRIMARY KEY ('NumDocumentoUsuario'),
  ADD KEY 'IdPrograma' ('IdPrograma');

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla 'acta_responsabilidad'
--
ALTER TABLE 'acta_responsabilidad'
  MODIFY 'IdActa' int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla 'ambiente'
--
ALTER TABLE 'ambiente'
  MODIFY 'IdAmbiente' int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla 'articulo'
--
ALTER TABLE 'articulo'
  MODIFY 'IdArticulo' int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla 'categoria'
--
ALTER TABLE 'categoria'
  MODIFY 'IdCategoria' int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla 'equipo'
--
ALTER TABLE 'equipo'
  MODIFY 'IdEquipo' int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla 'novedad'
--
ALTER TABLE 'novedad'
  MODIFY 'IdNovedad' int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla 'programa'
--
ALTER TABLE 'programa'
  MODIFY 'IdPrograma' int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla 'acta_responsabilidad'
--
ALTER TABLE 'acta_responsabilidad'
  ADD CONSTRAINT 'acta_responsabilidad_ibfk_1' FOREIGN KEY ('NumDocumentoAprendiz') REFERENCES 'aprendiz' ('NumDocumentoAprendiz'),
  ADD CONSTRAINT 'acta_responsabilidad_ibfk_2' FOREIGN KEY ('IdEquipo') REFERENCES 'equipo' ('IdEquipo');

--
-- Filtros para la tabla 'ambiente'
--
ALTER TABLE 'ambiente'
  ADD CONSTRAINT 'ambiente_ibfk_1' FOREIGN KEY ('IdPrograma') REFERENCES 'programa' ('IdPrograma');

--
-- Filtros para la tabla 'aprendiz'
--
ALTER TABLE 'aprendiz'
  ADD CONSTRAINT 'aprendiz_ibfk_1' FOREIGN KEY ('NumeroFicha') REFERENCES 'ficha' ('NumeroFicha');

--
-- Filtros para la tabla 'articulo'
--
ALTER TABLE 'articulo'
  ADD CONSTRAINT 'articulo_ibfk_1' FOREIGN KEY ('IdAmbiente') REFERENCES 'ambiente' ('IdAmbiente'),
  ADD CONSTRAINT 'articulo_ibfk_2' FOREIGN KEY ('IdEquipo') REFERENCES 'equipo' ('IdEquipo'),
  ADD CONSTRAINT 'articulo_ibfk_3' FOREIGN KEY ('IdCategoria') REFERENCES 'categoria' ('IdCategoria');

--
-- Filtros para la tabla 'articulonovedad'
--
ALTER TABLE 'articulonovedad'
  ADD CONSTRAINT 'articulonovedad_ibfk_1' FOREIGN KEY ('IdArticulo') REFERENCES 'articulo' ('IdArticulo'),
  ADD CONSTRAINT 'articulonovedad_ibfk_2' FOREIGN KEY ('IdNovedad') REFERENCES 'novedad' ('IdNovedad');

--
-- Filtros para la tabla 'ficha'
--
ALTER TABLE 'ficha'
  ADD CONSTRAINT 'ficha_ibfk_1' FOREIGN KEY ('IdPrograma') REFERENCES 'programa' ('IdPrograma'),
  ADD CONSTRAINT 'ficha_ibfk_2' FOREIGN KEY ('IdAmbiente') REFERENCES 'ambiente' ('IdAmbiente');

--
-- Filtros para la tabla 'usuario'
--
ALTER TABLE 'usuario'
  ADD CONSTRAINT 'usuario_ibfk_1' FOREIGN KEY ('IdPrograma') REFERENCES 'programa' ('IdPrograma');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
