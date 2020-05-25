-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2020 a las 11:52:03
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bi_libros`
--

CREATE TABLE `bi_libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `editorial` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `isbn` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `anno_publicacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1,
  `img` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bi_libros`
--

INSERT INTO `bi_libros` (`id`, `titulo`, `autor`, `editorial`, `isbn`, `anno_publicacion`, `disponible`, `img`) VALUES
(1, 'Viaje al centro de la Tierra', 'Julio Verne', 'RBA', '978-84-473-5575-4', '', 1, 'viaje_al_centro_de_la_tierra.webp'),
(2, 'La vuelta al mundo en ochenta días', 'Julio Verne', 'RBA', '978-84-473-5574-7', '', 0, 'la_vuelta_al_mund_en_ochenta_dias.png'),
(3, 'Veinte mil leguas de viaje submarino', 'Julio Verne', NULL, '978-84-473-5572-3', NULL, 1, 'veinte_mil_leguas_de_viaje_submarino.png'),
(4, 'Miguel Strogoff', 'Julio Verne', NULL, '978-84-473-5577-8', NULL, 1, 'miguel_strogoff.png'),
(5, 'De la Tierra a la Luna', 'Julio Verne', NULL, '978-84-473-5576-1', NULL, 0, 'de_la_tierra_a_la_luna.jpg'),
(6, 'Viaje alrededor de la Luna', 'Julio Verne', NULL, '978-84-473-5578-5', NULL, 1, NULL),
(7, 'Cinco semanas en globo', 'Julio Verne', '', '978-84-473-5571-6', '', 1, 'cinco_semanas_en_globo.png'),
(8, 'El Señor de los Anillos: La Comunidad del Anillo', 'J.R.R. Tolkien', 'Minotauro', '978-84-450-7372-8', NULL, 1, 'la_comunidad_del_anillo.webp'),
(9, 'El Señor de los Anillos: Las Dos Torres', 'J.R.R. Tolkien', 'Minotauro', '978-84-450-7373-5', NULL, 0, 'las_dos_torres.webp'),
(10, 'El Señor de los Anillos: El Retorno del Rey', 'J.R.R. Tolkien', 'Minotauro', '978-84-450-7374-2', NULL, 1, 'el_retorno_del_rey.webp'),
(11, 'El Silmarillion', 'J.R.R. Tolkien', 'Minotauro', '84-450-7139-4', '', 0, 'el_silmarillion.webp'),
(12, 'El Hobbit', 'J.R.R. Tolkien', 'Minotauro', '84-450-7141-6', NULL, 1, 'el_hobbit.png'),
(22, 'Juego de tronos', 'George R.R. Martin', 'Gigamesh', '978-84-96208-96-4', '2011-06-01', 1, 'juego_de_tronos.png'),
(23, 'Choque de reyes', 'George R.R. Martin', 'Gigamesh', '978-84-96208-97-1', '2011-09-01', 1, 'choque_de_reyes.png'),
(79, 'Metro 2033', 'Dmitry Glukhovsky', 'Timunmas', '978-84-480-3980-6', '2011-02-01', 1, 'metro_2033.webp'),
(80, 'Fundación', 'Isaac Asimov', 'Debolsillo', '84-9759-924-1', '2004-12-01', 1, 'fundacion.png'),
(81, 'Fundación e Imperio', 'Isaac Asimov', 'Debolsillo', '84-9759-501-7', '', 1, 'fundacion_e_imperio.png'),
(82, 'Segunda Fundación', 'Isaac Asimov', 'Debolsillo', '84-9759-676-5', '', 1, 'segunda_fundacion.png'),
(83, 'Drácula', 'Bram Stoker', 'Debolsillo', '978-84-9793-946-1', '2009-01-01', 0, 'dracula.png'),
(84, 'El resplandor', 'Stephen king', 'Debolsillo', '84-9759-380-4', '2003-01-01', 1, 'el_resplandor.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bi_prestamos`
--

CREATE TABLE `bi_prestamos` (
  `id_pres` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `prestado` date NOT NULL,
  `devuelto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bi_prestamos`
--

INSERT INTO `bi_prestamos` (`id_pres`, `id_user`, `id_libro`, `prestado`, `devuelto`) VALUES
(1, 1, 1, '2020-05-12', '2020-05-20'),
(2, 3, 8, '2020-05-15', '2020-05-19'),
(3, 4, 5, '2020-05-15', '2020-05-19'),
(4, 2, 5, '2020-05-19', NULL),
(5, 1, 2, '2020-05-21', NULL),
(6, 3, 9, '2020-05-21', NULL),
(7, 4, 12, '2020-05-22', '2020-05-22'),
(8, 5, 11, '2020-05-22', NULL),
(9, 1, 83, '2020-05-24', NULL);

--
-- Disparadores `bi_prestamos`
--
DELIMITER $$
CREATE TRIGGER `libroDisponible` AFTER UPDATE ON `bi_prestamos` FOR EACH ROW UPDATE bi_libros SET disponible = 1 WHERE id = OLD.id_libro
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `libroPrestado` AFTER INSERT ON `bi_prestamos` FOR EACH ROW UPDATE bi_libros SET disponible = 0 WHERE id = NEW.id_libro
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bi_users`
--

CREATE TABLE `bi_users` (
  `id_user` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `img` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bi_users`
--

INSERT INTO `bi_users` (`id_user`, `user`, `pass`, `perfil`, `estado`, `nombre`, `apellidos`, `dni`, `telefono`, `email`, `img`) VALUES
(1, 'user1', 'user1', 'lector', 'activo', 'María', 'Fernández de Vera', '12345678L', '123456789', 'prueba@hotmail.com', NULL),
(2, 'user2', 'user2', 'lector', 'activo', 'Jorge', 'Gómez Serrano', '61973264X', '987654321', 'prueba2@hotmail.com', NULL),
(3, 'user3', 'user3', 'lector', 'activo', 'Eufemio', 'Sánchez Martínez', '97203665J', '667943360', 'prueba3@hotmail.com', NULL),
(4, 'user4', 'user4', 'lector', 'activo', 'Sara', 'González de la Fuente', '12947855M', '957992244', 'prueba4@hotmail.com', NULL),
(5, 'user5', 'user5', 'lector', 'activo', 'María del Carmen', 'Olmedo Aljarilla', '91554320T', '772978039', 'user5@hotmail.com', NULL),
(6, 'admin', 'admin', 'administrador', 'activo', 'Francisco Javier', 'Fernández Robledo', '99999999D', '666235711', 'elmasca@gmail.com', NULL),
(7, 'user6', 'user6', 'lector', 'bloqueado', 'Miguel', 'Martínez García', '64826572B', '957126597', 'user6@hotmail.com', NULL),
(8, 'user7', 'user7', 'lector', 'pendiente', 'Vasco', 'da Gama', '48620015B', '667882169', 'user7@hotmail.com', NULL),
(10, 'user8', 'user8', 'lector', 'pendiente', 'Cristiano', 'Ronaldo', '12947855L', '666555444', 'user1@hotmail.com', NULL),
(11, 'user9', 'user9', 'lector', 'activo', 'Miguel', 'de Cervantes Saavedra', '12947855J', '666222777', 'don_quijote_1605@hotmail.com', NULL),
(12, 'user10', 'user10', 'lector', 'pendiente', 'ejemplo', 'ejemplo', '48620015H', '777111333', 'user10@hotmail.com', NULL),
(13, 'user11', 'user11', 'lector', 'pendiente', 'user11', 'user11', '12345678H', '999999999', 'user11@hotmail.com', NULL),
(14, 'user12', 'user12', 'lector', 'activo', 'Gerald', 'de Rivia', '19664269V', '666555666', 'gerardo_elgrande@gmail.com', NULL),
(15, 'user13', 'user13', 'lector', 'activo', 'Sonic', 'the Hedgehog', '55555555C', '662361991', 'bola_de_pinxos@hotmail.com', NULL),
(16, 'user14', 'user14', 'lector', 'activo', 'Juana', 'de Arco', '71649033H', '999999999', 'putos_ingleses@gmail.com', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bi_libros`
--
ALTER TABLE `bi_libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bi_prestamos`
--
ALTER TABLE `bi_prestamos`
  ADD PRIMARY KEY (`id_pres`);

--
-- Indices de la tabla `bi_users`
--
ALTER TABLE `bi_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bi_libros`
--
ALTER TABLE `bi_libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `bi_prestamos`
--
ALTER TABLE `bi_prestamos`
  MODIFY `id_pres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `bi_users`
--
ALTER TABLE `bi_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
