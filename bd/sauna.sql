-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 01:15:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sauna`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id`, `nombre`, `telefono`, `direccion`, `mensaje`) VALUES
(2, 'Sauna Eden ', '7455478', 'Oruro-2024', 'Gracias por su preferencia!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preciototal`
--

CREATE TABLE `preciototal` (
  `id_preciototal` int(11) NOT NULL,
  `total_pre` double NOT NULL,
  `id_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preciototal`
--

INSERT INTO `preciototal` (`id_preciototal`, `total_pre`, `id_reserva`) VALUES
(1, 20, 32),
(2, 15, 33),
(3, 50, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sauna` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `fecha`, `hora_inicio`, `hora_fin`, `id_usuario`, `id_sauna`, `estado`) VALUES
(32, '2024-11-11', '19:57:00', '20:57:00', 1, 1, 1),
(33, '2024-11-11', '20:00:00', '21:30:00', 1, 2, 1),
(34, '2024-11-11', '20:00:00', '22:00:00', 1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sauna`
--

CREATE TABLE `sauna` (
  `id_sauna` int(11) NOT NULL,
  `numero_sauna` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sauna`
--

INSERT INTO `sauna` (`id_sauna`, `numero_sauna`, `tipo`, `precio`, `estado`) VALUES
(1, 1, 'Familiar', 20, 1),
(2, 2, 'Individual', 10, 1),
(3, 3, 'Pequeña', 5, 1),
(5, 4, 'Familiar1', 25, 1),
(6, 6, 'Dobles', 30, 1),
(7, 7, 'Familiar2', 40, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `ci`, `nombres`, `apellidos`, `email`, `telefono`, `usuario`, `clave`, `fecha`, `estado`) VALUES
(1, 8581330, 'Eliseo', 'Canaviri Jachacata ', 'eliseocanaviri09@gmail.com', 72737903, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2024-10-13 11:37:12', 1),
(28, 5444, 'Aná', 'Lopez', 'ana@mailinator.com', 8885665, 'ana', '24d4b96f58da6d4a8512313bbd02a28ebf0ca95dec6e4c86ef78ce7f01e788ac', '2024-10-13 22:40:50', 1),
(29, 778787, 'Dayver', 'Vale', 'dayver@gmail.com', 78787878, 'dayver', 'e9f42ad79dc1ba2a3c3c372a9e47d3cb48c7e76acaafafa42ec0c8b2e6e38197', '2024-10-27 19:00:05', 1),
(30, 787878, 'Taniá', 'Montaño', 'tania@gmail.con', 787878, 'tania', '37755b1afe16a4973d4d2208c4a7dea45e2e5772015dc3d34e04eeed77f58591', '2024-10-27 19:46:26', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preciototal`
--
ALTER TABLE `preciototal`
  ADD PRIMARY KEY (`id_preciototal`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_sauna` (`id_sauna`) USING BTREE;

--
-- Indices de la tabla `sauna`
--
ALTER TABLE `sauna`
  ADD PRIMARY KEY (`id_sauna`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preciototal`
--
ALTER TABLE `preciototal`
  MODIFY `id_preciototal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `sauna`
--
ALTER TABLE `sauna`
  MODIFY `id_sauna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_sauna`) REFERENCES `sauna` (`id_sauna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
