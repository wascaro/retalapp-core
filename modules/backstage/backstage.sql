-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-10-2014 a las 20:23:35
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `retalapp_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `backstage_items`
--

CREATE TABLE IF NOT EXISTS `backstage_items` (
`id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img',
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `backstage_items`
--

INSERT INTO `backstage_items` (`id`, `image`, `orden_id`) VALUES
(1, '1414506200.png', 1),
(2, '1414506207.png', 2),
(3, '1414506218.png', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `backstage_items`
--
ALTER TABLE `backstage_items`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `backstage_items`
--
ALTER TABLE `backstage_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
