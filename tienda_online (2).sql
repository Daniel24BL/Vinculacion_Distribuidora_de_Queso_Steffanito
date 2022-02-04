-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2022 a las 09:07:56
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(1, 'id_transaccion', '2022-01-02 08:27:11', 'COMPLETED', 'sb-lyvhs10902678@business.example.com', 'WHLJDP5P9P44Y', '465'),
(2, 'id_transaccion', '2022-01-02 08:27:33', 'COMPLETED', 'sb-lyvhs10902678@business.example.com', 'WHLJDP5P9P44Y', '465');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `NOMBRE` text NOT NULL,
  `CORREO` text NOT NULL,
  `CELULAR` text NOT NULL,
  `MENSAJE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`NOMBRE`, `CORREO`, `CELULAR`, `MENSAJE`) VALUES
('Emiliano', 'emi@outlook.com', '', 'Excelente Pagina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE `informacion` (
  `NOMBRES` text NOT NULL,
  `CEDULA` text NOT NULL,
  `TELEFONO` text NOT NULL,
  `EMAIL` text NOT NULL,
  `PASSWORD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `informacion`
--

INSERT INTO `informacion` (`NOMBRES`, `CEDULA`, `TELEFONO`, `EMAIL`, `PASSWORD`) VALUES
('Jesus Toala', '1315881273', '095893283', 'jesustoalad@gmail.com', 'jesus123'),
(' Nathaly Quijije', '1319848392', '0968942094', 'nquijije@gmail.com', 'jesu923kf'),
('Luis Navarrete', '1304928948', '0987849382', 'navarrete@outlook.com', 'jiwefew92343'),
('Mirella Baque', '1310948390', '0990984903', 'mireba@outlook.com', 'kfekjo422');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'Arroz Oso Envejecido', 'Quintal de Arroz Oso (100 lb)', '28.00', 0, 1, 1),
(2, 'Arroz Grano Largo', 'Quintal Arroz Grano Largo (100 lb)', '45.00', 0, 1, 1),
(3, 'Azúcar Blanca \"La Troncal\" 1kg', 'Quintal Azúcar Blanca \"La Troncal\" 1kg x50 fundas', '40.00', 0, 1, 1),
(4, 'Azúcar Morena \"La Troncal\" 1kg', 'Quintal Azúcar Morena \"La Troncal\" 1kg x50 fundas', '40.00', 0, 1, 1),
(5, 'Azúcar Blanca \"La Troncal\" 1/2 kg', 'Quintal Azúcar Blanca \"La Troncal\" 1/2 kg x 50 fundas', '39.00', 0, 1, 1),
(6, 'Rey Leche', 'Caja x12 de Rey Lecha de 1 lt', '10.50', 0, 1, 1),
(7, 'Aceite Alesol ', 'Caja x15 Aceite Alesos 900 ml', '27.50', 0, 1, 1),
(8, 'Atún Isabel 160 GR', 'Caja x48 Atún Isabel 160 GR', '31.60', 0, 1, 1),
(9, 'Huevo', 'Cubeta de Huevo (30 Huevos)', '2.90', 0, 1, 1),
(10, 'Papel Higiénico Flor', 'Bulto de Papel Flor x6 Paquetes', '4.70', 0, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
