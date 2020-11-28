-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2020 a las 16:34:38
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `granjaavicolalastunas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `NombreCategoria`) VALUES
(1, 'Grandes'),
(2, 'Medianos'),
(3, 'Pequeños'),
(4, 'Picados'),
(5, 'Debil'),
(6, 'Derramados'),
(7, 'Rusticos'),
(8, 'Pool');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galpones`
--

CREATE TABLE `galpones` (
  `idGalpon` int(11) NOT NULL,
  `nombreGalpon` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `galpones`
--

INSERT INTO `galpones` (`idGalpon`, `nombreGalpon`) VALUES
(4, '1'),
(5, '2'),
(11, '3'),
(1, '4'),
(10, '5'),
(12, '6'),
(13, '7'),
(14, '8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galponesenlote`
--

CREATE TABLE `galponesenlote` (
  `idGalpon` int(11) NOT NULL,
  `idLote` int(11) NOT NULL,
  `terminado` tinyint(1) NOT NULL DEFAULT '0',
  `gallinas` int(11) NOT NULL,
  `inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `galponesenlote`
--

INSERT INTO `galponesenlote` (`idGalpon`, `idLote`, `terminado`, `gallinas`, `inicio`) VALUES
(1, 2, 0, 10, '2020-09-18'),
(4, 1, 1, 10, '2020-09-18'),
(11, 1, 0, 100, '2020-09-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `idLote` int(11) NOT NULL,
  `numeroLote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`idLote`, `numeroLote`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mortalidad`
--

CREATE TABLE `mortalidad` (
  `idGalpon` int(11) NOT NULL,
  `idLote` int(11) NOT NULL,
  `numeroMuertes` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mortalidad`
--

INSERT INTO `mortalidad` (`idGalpon`, `idLote`, `numeroMuertes`, `fecha`) VALUES
(1, 2, 3, '2020-09-30'),
(4, 1, 2, '2020-09-30'),
(11, 1, 2, '2020-09-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recogidas`
--

CREATE TABLE `recogidas` (
  `idRecogida` int(11) NOT NULL,
  `idRegistro` int(11) NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `idRegistro` int(11) NOT NULL,
  `idSector` int(11) NOT NULL,
  `semana` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsables`
--

CREATE TABLE `responsables` (
  `nombreResponsable` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoResponsable` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `activo`               tinyint(1) not null DEFAULT 1,
  `ci`               varchar(10) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `responsables`
--

INSERT INTO `responsables` (`ci`, `nombreResponsable`, `apellidoResponsable`) VALUES
("29587834", 'Jose Alexander', 'Suarez Gervazzi'),
("27554995", 'Antonella', 'Mujica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsablesderegistro`
--

CREATE TABLE `responsablesderegistro` (
  `idRegistro` int(11) NOT NULL,
  `ci` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `idSector` int(11) NOT NULL,
  `idGalpon` int(11) NOT NULL,
  `nombreSector` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`idSector`, `idGalpon`, `nombreSector`) VALUES
(1, 4, 'M-1'),
(3, 4, 'M-2'),
(2, 5, 'M-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `nombreUsuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `claveUsuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fechaCreacion` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `pregunta`         varchar(30) NOT NULL,
  `respuesta`        varchar(30) NOT NULL,
  `ci`               varchar(10) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `usuarios` (`idUsuarios`, `nombreUsuario`, `claveUsuario`, `fechaCreacion`, `activo`, `pregunta`, `respuesta`, `ci`) 
VALUES (1, 'Admin', '123456', '2020-11-26', '1', '¿Sakura o Hinata?', 'Sakura', '27554995');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `idRecogida` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `galpones`
--
ALTER TABLE `galpones`
  ADD PRIMARY KEY (`idGalpon`),
  ADD UNIQUE KEY `nombreGalpon` (`nombreGalpon`);

--
-- Indices de la tabla `galponesenlote`
--
ALTER TABLE `galponesenlote`
  ADD PRIMARY KEY (`idGalpon`,`idLote`),
  ADD KEY `fk_Galpones_has_Lotes_Lotes1_idx` (`idLote`),
  ADD KEY `fk_Galpones_has_Lotes_Galpones_idx` (`idGalpon`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`idLote`);

--
-- Indices de la tabla `mortalidad`
--
ALTER TABLE `mortalidad`
  ADD PRIMARY KEY (`fecha`,`idGalpon`,`idLote`),
  ADD KEY `fk_Mortalidad_Galpones_has_Lotes1_idx` (`idGalpon`,`idLote`);

--
-- Indices de la tabla `recogidas`
--
ALTER TABLE `recogidas`
  ADD PRIMARY KEY (`idRecogida`),
  ADD KEY `fk_Recogidas_Registro1_idx` (`idRegistro`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`idRegistro`),
  ADD KEY `fk_Registro_Sectores1_idx` (`idSector`);

--
-- Indices de la tabla `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`ci`);


--
-- Indices de la tabla `responsablesderegistro`
--
ALTER TABLE `responsablesderegistro`
  ADD PRIMARY KEY (`idRegistro`,`ci`),
  ADD KEY `fk_Registro_has_Responsables_Responsables1_idx` (`ci`),
  ADD KEY `fk_Registro_has_Responsables_Registro1_idx` (`idRegistro`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`idSector`),
  ADD UNIQUE KEY `SectorDeGalpon` (`idGalpon`,`nombreSector`),
  ADD KEY `fk_Sectores_Galpones1_idx` (`idGalpon`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD KEY `fk_Usuarios_has_Responsables_Responsables1_idx` (`ci`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`idRecogida`,`idCategoria`),
  ADD KEY `fk_Recogidas_has_Categorias_Categorias1_idx` (`idCategoria`),
  ADD KEY `fk_Recogidas_has_Categorias_Recogidas1_idx` (`idRecogida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `galpones`
--
ALTER TABLE `galpones`
  MODIFY `idGalpon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `idLote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recogidas`
--
ALTER TABLE `recogidas`
  MODIFY `idRecogida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `idSector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `galponesenlote`
--
ALTER TABLE `galponesenlote`
  ADD CONSTRAINT `fk_Galpones_has_Lotes_Galpones` FOREIGN KEY (`idGalpon`) REFERENCES `galpones` (`idGalpon`) ON DELETE cascade ON UPDATE cascade,
  ADD CONSTRAINT `fk_Galpones_has_Lotes_Lotes1` FOREIGN KEY (`idLote`) REFERENCES `lotes` (`idLote`) ON DELETE cascade ON UPDATE cascade;

--
-- Filtros para la tabla `mortalidad`
--
ALTER TABLE `mortalidad`
  ADD CONSTRAINT `fk_Mortalidad_Galpones_has_Lotes1` FOREIGN KEY (`idGalpon`,`idLote`) REFERENCES `galponesenlote` (`idGalpon`, `idLote`) ON DELETE cascade ON UPDATE cascade;

--
-- Filtros para la tabla `recogidas`
--
ALTER TABLE `recogidas`
  ADD CONSTRAINT `fk_Recogidas_Registro1` FOREIGN KEY (`idRegistro`) REFERENCES `registros` (`idRegistro`) ON DELETE cascade ON UPDATE cascade;

--
-- Filtros para la tabla `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `fk_Registro_Sectores1` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`idSector`) ON DELETE cascade ON UPDATE cascade;

--
-- Filtros para la tabla `responsablesderegistro`
--
ALTER TABLE `responsablesderegistro`
  ADD CONSTRAINT `fk_Registro_has_Responsables_Registro1` FOREIGN KEY (`idRegistro`) REFERENCES `registros` (`idRegistro`) ON DELETE cascade ON UPDATE cascade,
  ADD CONSTRAINT `fk_Registro_has_Responsables_Responsables1` FOREIGN KEY (`ci`) REFERENCES `responsables` (`ci`) ON DELETE cascade ON UPDATE cascade;

--
-- Filtros para la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD CONSTRAINT `fk_Sectores_Galpones1` FOREIGN KEY (`idGalpon`) REFERENCES `galpones` (`idGalpon`) ON DELETE cascade ON UPDATE cascade;

--
-- Filtros para la tabla `valores`
--
ALTER TABLE `valores`
  ADD CONSTRAINT `fk_Recogidas_has_Categorias_Categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE cascade ON UPDATE cascade,
  ADD CONSTRAINT `fk_Recogidas_has_Categorias_Recogidas1` FOREIGN KEY (`idRecogida`) REFERENCES `recogidas` (`idRecogida`) ON DELETE cascade ON UPDATE cascade;
COMMIT;

ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Usuarios_has_Responsables_Usuarios1` FOREIGN KEY (`ci`) REFERENCES `responsables` (`ci`) ON DELETE cascade ON UPDATE cascade;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
