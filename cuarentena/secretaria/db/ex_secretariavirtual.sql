-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2020 a las 19:02:06
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ex_secretariavirtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sevi_clavefirma`
--

CREATE TABLE `sevi_clavefirma` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fila` enum('a','b','c','d','e','f','g','h') COLLATE utf8_spanish_ci NOT NULL,
  `columna` enum('1','2','3','4','5','6','7','8') COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sevi_documentos`
--

CREATE TABLE `sevi_documentos` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fichero` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` enum('Pendiente','Firmado') COLLATE utf8_spanish_ci NOT NULL,
  `fechaFirma` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sevi_usuarios`
--

CREATE TABLE `sevi_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nick` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `directorio` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` enum('pendiente','activo','bloqueado') COLLATE utf8_spanish_ci NOT NULL,
  `perfil` enum('admin','user') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sevi_clavefirma`
--
ALTER TABLE `sevi_clavefirma`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sevi_documentos`
--
ALTER TABLE `sevi_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sevi_usuarios`
--
ALTER TABLE `sevi_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sevi_clavefirma`
--
ALTER TABLE `sevi_clavefirma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1281;

--
-- AUTO_INCREMENT de la tabla `sevi_documentos`
--
ALTER TABLE `sevi_documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sevi_usuarios`
--
ALTER TABLE `sevi_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
