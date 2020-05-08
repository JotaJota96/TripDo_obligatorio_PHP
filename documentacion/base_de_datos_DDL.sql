--
-- WARNING: The 'tripdo' database must be created before running this script
--

-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2020 a las 03:58:57
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tripdo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `idUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idViaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE `destino` (
  `id` int(11) NOT NULL,
  `pais` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `idViaje` int(11) NOT NULL,
  `agregadoPor` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaAgregado` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinovotado`
--

CREATE TABLE `destinovotado` (
  `idUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idViaje` int(11) NOT NULL,
  `idDestino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `latitud` float(10,6) NOT NULL,
  `longitud` float(10,6) NOT NULL,
  `link` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idDestino` int(11) NOT NULL,
  `agregadoPor` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaAgregado` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planvotado`
--

CREATE TABLE `planvotado` (
  `idUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idViaje` int(11) NOT NULL,
  `idPlan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `texto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idDestino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nickname` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasenia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `biografia` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `publico` tinyint(1) NOT NULL,
  `realizado` tinyint(1) NOT NULL DEFAULT 0,
  `idUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajero`
--

CREATE TABLE `viajero` (
  `idUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idViaje` int(11) NOT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `texto` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`idUsuario`,`idViaje`),
  ADD KEY `fk_colaborador_idviaje` (`idViaje`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_destino_idviaje` (`idViaje`),
  ADD KEY `fk_destino_agregadoPor` (`agregadoPor`);

--
-- Indices de la tabla `destinovotado`
--
ALTER TABLE `destinovotado`
  ADD PRIMARY KEY (`idUsuario`,`idViaje`,`idDestino`),
  ADD KEY `fk_destinovotado_idDestino` (`idDestino`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_plan_idDestino` (`idDestino`),
  ADD KEY `fk_plan_agregadorPor` (`agregadoPor`);

--
-- Indices de la tabla `planvotado`
--
ALTER TABLE `planvotado`
  ADD PRIMARY KEY (`idUsuario`,`idViaje`,`idPlan`),
  ADD KEY `fk_planvotado_idPlan` (`idPlan`);

--
-- Indices de la tabla `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tag_idDestino` (`idDestino`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nickname`),
  ADD UNIQUE KEY `index_email` (`email`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_viaje_idusuario` (`idUsuario`);

--
-- Indices de la tabla `viajero`
--
ALTER TABLE `viajero`
  ADD PRIMARY KEY (`idUsuario`,`idViaje`),
  ADD KEY `fk_viajero_idviaje` (`idViaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `destino`
--
ALTER TABLE `destino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `fk_colaborador_idusuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_colaborador_idviaje` FOREIGN KEY (`idViaje`) REFERENCES `viaje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `destino`
--
ALTER TABLE `destino`
  ADD CONSTRAINT `fk_destino_agregadoPor` FOREIGN KEY (`agregadoPor`) REFERENCES `usuario` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_destino_idviaje` FOREIGN KEY (`idViaje`) REFERENCES `viaje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `destinovotado`
--
ALTER TABLE `destinovotado`
  ADD CONSTRAINT `fk_destinovotado_idDestino` FOREIGN KEY (`idDestino`) REFERENCES `destino` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_destinovotado_idUsiario_idViaje` FOREIGN KEY (`idUsuario`,`idViaje`) REFERENCES `viajero` (`idUsuario`, `idViaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `fk_plan_agregadorPor` FOREIGN KEY (`agregadoPor`) REFERENCES `usuario` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_plan_idDestino` FOREIGN KEY (`idDestino`) REFERENCES `destino` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `planvotado`
--
ALTER TABLE `planvotado`
  ADD CONSTRAINT `fk_planvotado_idPlan` FOREIGN KEY (`idPlan`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_planvotado_idUsiario_idViaje` FOREIGN KEY (`idUsuario`,`idViaje`) REFERENCES `viajero` (`idUsuario`, `idViaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `fk_tag_idDestino` FOREIGN KEY (`idDestino`) REFERENCES `destino` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `fk_viaje_idusuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `viajero`
--
ALTER TABLE `viajero`
  ADD CONSTRAINT `fk_viajero_idusuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_viajero_idviaje` FOREIGN KEY (`idViaje`) REFERENCES `viaje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- ********************************************************

CREATE TRIGGER `tg_viaje_viajero` 
  AFTER INSERT ON `viaje` FOR EACH ROW
  INSERT INTO `viajero` (`idUsuario`, `idViaje`) VALUES (NEW.idUsuario, NEW.id);





