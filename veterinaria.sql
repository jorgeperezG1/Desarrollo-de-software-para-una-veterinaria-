-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql113.infinityfree.com
-- Tiempo de generación: 12-09-2024 a las 18:29:12
-- Versión del servidor: 10.6.19-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `codigo_cliente` varchar(255) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `numero_cuenta_bancaria` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `rfc` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `codigo_cliente`, `nombre_completo`, `numero_cuenta_bancaria`, `direccion`, `telefono`, `correo`, `codigo_postal`, `rfc`) VALUES
(2, 'ismael001', 'ismael cordova barrios', '3500049004172418', 'av central poniente #540 colonia Francisco I. Madero', '9615325647', 'ismael.cordova13@unach.mx', '29090', 'SMB239897');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `numero_cuenta_bancaria` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `rfc` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `cliente_id`, `nombre_completo`, `numero_cuenta_bancaria`, `direccion`, `telefono`, `correo`, `codigo_postal`, `rfc`) VALUES
(1, 2, 'Jorge Luis Pérez Gutiérrez', '3781251730207614', 'x', '961 282 2797', 'jorge@gmail.com', '29012', 'IUO909661'),
(2, 2, 'JosÃ© de JesÃºs Mayorga Osorio', '32942384382483284', 'Parque 5 de mayo', '9161327952', 'jo37561@gmail.com', '29960', 'SJAFCJSAFJS213'),
(3, 2, 'Araceli GÃ³mez Gordillo', '3929432949234923939', 'Chiapas Solidario', '9612341839', 'ara@gmail.com', '29000', 'GOGCXVDIID21'),
(4, 2, 'luis', '34444444444444444', 'ffff', '44444', 'rigoberto@unach.mx', '29000', 'ddddddd'),
(5, 2, 'mario', '1234567891234', 'fff', '961484252', 'rigoberto@unach.mx', '29000', 'ddddddd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int(11) NOT NULL,
  `mascota_id` int(11) DEFAULT NULL,
  `enfermedad` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medical_history`
--

INSERT INTO `medical_history` (`id`, `mascota_id`, `enfermedad`, `fecha`) VALUES
(5, 2, 'tenia moquillo', '2024-08-29'),
(6, 4, 'Parvovirus', '2024-09-30'),
(7, 5, 'Moquillo', '2024-09-23'),
(8, 6, 'rabia', '2024-09-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `especie` varchar(50) DEFAULT NULL,
  `raza` varchar(50) DEFAULT NULL,
  `color_pelo` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `peso_actual` decimal(5,2) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pets`
--

INSERT INTO `pets` (`id`, `codigo`, `alias`, `especie`, `raza`, `color_pelo`, `fecha_nacimiento`, `peso_actual`, `cliente_id`) VALUES
(2, 'lucas-001', 'lucas', 'perro', 'chihuahua', 'negro', '2024-08-29', '2.00', 2),
(3, 'bonbon-001', 'bonbon', 'perro', 'chihuahuas', 'blanco con negro', '2024-01-10', '2.00', 2),
(4, 'SolÃ­n-001', 'SolÃ­n', 'Canino', 'Mestizo', 'CafÃ© claro', '2024-08-13', '12.00', 2),
(5, 'Ghory-001', 'Ghory', 'Canino', 'Pitbull', 'Negro', '2024-06-04', '15.00', 2),
(6, 'cucho-001', 'cucho', 'perro', 'chihuahua', 'negro', '2024-09-13', '12.00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(17, 'Ismael', '$2y$10$IZ3SEAF0oqKWuPcEUALenOiLmBNl82Tec/us.VOpwZapFb3UHSotS'),
(18, 'Luisperez08022002@hotmail.com', '$2y$10$s/j/XKph22wZyF/4vB7XeuXRsaR111MDWRseEujrfEqQ80FvzHTpy'),
(19, 'Jo37561@gmail.com', '$2y$10$5EhUcJIOYizMKrWK6xHf7.guIfO9xoTfhn9CJhuc4Rl8XX1HBB36y'),
(20, 'Rigoberto.perez@unach.mx', '$2y$10$HO1uSalBfoqWnrUteADDNOwyDF.2uIEaoEPm60H.RXru6UsUDyCvO'),
(21, 'Luis', '$2y$10$EI5c/q0NhU3naB9pqliq/uu9BbbZmStjZ8saz6XGFC7pEbmz6OD1C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vaccinations`
--

CREATE TABLE `vaccinations` (
  `id` int(11) NOT NULL,
  `mascota_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `enfermedad_vacunada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_cliente` (`codigo_cliente`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mascota_id` (`mascota_id`);

--
-- Indices de la tabla `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mascota_id` (`mascota_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clients` (`id`);

--
-- Filtros para la tabla `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`mascota_id`) REFERENCES `pets` (`id`);

--
-- Filtros para la tabla `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clients` (`id`);

--
-- Filtros para la tabla `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD CONSTRAINT `vaccinations_ibfk_1` FOREIGN KEY (`mascota_id`) REFERENCES `pets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
