-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-06-2016 a las 00:28:35
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `condominiosdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamentos`
--

CREATE TABLE `apartamentos` (
  `id_apartamento` int(10) UNSIGNED NOT NULL,
  `usuarios_id_usuario_in` int(10) UNSIGNED DEFAULT NULL,
  `ubicacion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `apartamentos`
--

INSERT INTO `apartamentos` (`id_apartamento`, `usuarios_id_usuario_in`, `ubicacion`, `observaciones`) VALUES
(3, NULL, 'arriba segundo piso', 'esta sucio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrador', '1', NULL),
('usuario', '4', 1466469480);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrador', 1, 'Administrador del Sistema', NULL, NULL, NULL, NULL),
('usuario', 1, 'Usuario del Sistema', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicionUsuarios`
--

CREATE TABLE `condicionUsuarios` (
  `id_condicionUsuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `condicionUsuarios`
--

INSERT INTO `condicionUsuarios` (`id_condicionUsuario`, `nombre`, `descricion`) VALUES
(1, 'Propietario Principal', 'Propietario Principal del Apartamento'),
(2, 'Propietario Secundario', 'Propietario Secundario del Apartamento'),
(3, 'Inquilino', 'Inquilino del Apartamento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_gastos`
--

CREATE TABLE `factura_gastos` (
  `id_factura_gastos` int(10) UNSIGNED NOT NULL,
  `apartamentos_id_apartamento` int(10) UNSIGNED NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `estado` int(10) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `factura_gastos`
--

INSERT INTO `factura_gastos` (`id_factura_gastos`, `apartamentos_id_apartamento`, `fecha_registro`, `iva`, `total`, `estado`, `descripcion`) VALUES
(6, 3, '2016-06-21', 5160, 43000, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_gastos_items`
--

CREATE TABLE `factura_gastos_items` (
  `id_factura_gastos_items` int(10) UNSIGNED NOT NULL,
  `items_id_item` int(10) UNSIGNED NOT NULL,
  `factura_gastos_id_factura_gastos` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `factura_gastos_items`
--

INSERT INTO `factura_gastos_items` (`id_factura_gastos_items`, `items_id_item`, `factura_gastos_id_factura_gastos`, `cantidad`) VALUES
(9, 1, 6, 2),
(10, 2, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_servicios`
--

CREATE TABLE `factura_servicios` (
  `id_factura_servicios` int(10) UNSIGNED NOT NULL,
  `apartamentos_id_apartamento` int(10) UNSIGNED NOT NULL,
  `fecha_factura` date DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `estado` int(10) UNSIGNED DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `factura_servicios`
--

INSERT INTO `factura_servicios` (`id_factura_servicios`, `apartamentos_id_apartamento`, `fecha_factura`, `iva`, `total`, `estado`, `observaciones`) VALUES
(1, 3, '2016-06-21', 1440, 12000, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_servicios_servicios`
--

CREATE TABLE `factura_servicios_servicios` (
  `id_factura_servicios_servicios` int(10) UNSIGNED NOT NULL,
  `factura_servicios_id_factura_servicios` int(10) UNSIGNED NOT NULL,
  `servicios_id_servicio` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `factura_servicios_servicios`
--

INSERT INTO `factura_servicios_servicios` (`id_factura_servicios_servicios`, `factura_servicios_id_factura_servicios`, `servicios_id_servicio`, `cantidad`) VALUES
(1, 1, 1, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id_item` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id_item`, `nombre`, `descripcion`, `precio`, `fecha_registro`) VALUES
(1, 'cerveza', 'caja de cerveza', 2000, '2016-06-21'),
(2, 'carro', 'carro', 13000, '2016-06-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1466388001),
('m140506_102106_rbac_init', 1466388006);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre`, `descripcion`, `precio`, `fecha_registro`) VALUES
(1, 'podar el cesped', 'podar el cesped', 1000, '2016-06-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoUsuarios`
--

CREATE TABLE `tipoUsuarios` (
  `id_tipoUsuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipoUsuarios`
--

INSERT INTO `tipoUsuarios` (`id_tipoUsuario`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Administrador del Sistema'),
(2, 'Usuario', 'Usuario del Sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `condicionUsuarios_id_condicionUsuario` int(10) UNSIGNED DEFAULT NULL,
  `tipoUsuarios_id_tipoUsuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cedula` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `condicionUsuarios_id_condicionUsuario`, `tipoUsuarios_id_tipoUsuario`, `nombre`, `apellido`, `cedula`, `rif`, `correo`, `telefono`, `usuario`, `clave`) VALUES
(1, NULL, 1, 'Administrador', NULL, '', '', NULL, NULL, 'admin', 'MTIzNDU2'),
(4, 1, 2, 'Alexis Javier', 'Moreno Urbina', '18393355', 'J-18393355-4', 'javomoreno@gmail.com', '04247082428', 'javiomoreno', 'RWxjaHV0YTE5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_apartamentos`
--

CREATE TABLE `usuario_apartamentos` (
  `idusuario_apartamentos` int(10) UNSIGNED NOT NULL,
  `apartamentos_id_apartamento` int(10) UNSIGNED NOT NULL,
  `usuarios_id_usuario_ps` int(10) UNSIGNED DEFAULT NULL,
  `usuarios_id_usuario_pp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_apartamentos`
--

INSERT INTO `usuario_apartamentos` (`idusuario_apartamentos`, `apartamentos_id_apartamento`, `usuarios_id_usuario_ps`, `usuarios_id_usuario_pp`) VALUES
(2, 3, NULL, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  ADD PRIMARY KEY (`id_apartamento`),
  ADD KEY `usuarios_id_usuario_in` (`usuarios_id_usuario_in`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `condicionUsuarios`
--
ALTER TABLE `condicionUsuarios`
  ADD PRIMARY KEY (`id_condicionUsuario`);

--
-- Indices de la tabla `factura_gastos`
--
ALTER TABLE `factura_gastos`
  ADD PRIMARY KEY (`id_factura_gastos`),
  ADD KEY `factura_gastos_FKIndex1` (`apartamentos_id_apartamento`);

--
-- Indices de la tabla `factura_gastos_items`
--
ALTER TABLE `factura_gastos_items`
  ADD PRIMARY KEY (`id_factura_gastos_items`),
  ADD KEY `factura_gastos_items_FKIndex1` (`factura_gastos_id_factura_gastos`),
  ADD KEY `factura_gastos_items_FKIndex2` (`items_id_item`);

--
-- Indices de la tabla `factura_servicios`
--
ALTER TABLE `factura_servicios`
  ADD PRIMARY KEY (`id_factura_servicios`),
  ADD KEY `factura_servicios_FKIndex1` (`apartamentos_id_apartamento`);

--
-- Indices de la tabla `factura_servicios_servicios`
--
ALTER TABLE `factura_servicios_servicios`
  ADD PRIMARY KEY (`id_factura_servicios_servicios`),
  ADD KEY `factura_servicios_servicios_FKIndex1` (`servicios_id_servicio`),
  ADD KEY `factura_servicios_servicios_FKIndex2` (`factura_servicios_id_factura_servicios`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `tipoUsuarios`
--
ALTER TABLE `tipoUsuarios`
  ADD PRIMARY KEY (`id_tipoUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `usuarios_FKIndex1` (`tipoUsuarios_id_tipoUsuario`),
  ADD KEY `usuarios_FKIndex2` (`condicionUsuarios_id_condicionUsuario`);

--
-- Indices de la tabla `usuario_apartamentos`
--
ALTER TABLE `usuario_apartamentos`
  ADD PRIMARY KEY (`idusuario_apartamentos`),
  ADD KEY `usuario_apartamentos_FKIndex1` (`usuarios_id_usuario_pp`),
  ADD KEY `usuario_apartamentos_FKIndex2` (`usuarios_id_usuario_ps`),
  ADD KEY `usuario_apartamentos_FKIndex3` (`apartamentos_id_apartamento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  MODIFY `id_apartamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `condicionUsuarios`
--
ALTER TABLE `condicionUsuarios`
  MODIFY `id_condicionUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `factura_gastos`
--
ALTER TABLE `factura_gastos`
  MODIFY `id_factura_gastos` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `factura_gastos_items`
--
ALTER TABLE `factura_gastos_items`
  MODIFY `id_factura_gastos_items` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `factura_servicios`
--
ALTER TABLE `factura_servicios`
  MODIFY `id_factura_servicios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `factura_servicios_servicios`
--
ALTER TABLE `factura_servicios_servicios`
  MODIFY `id_factura_servicios_servicios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipoUsuarios`
--
ALTER TABLE `tipoUsuarios`
  MODIFY `id_tipoUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario_apartamentos`
--
ALTER TABLE `usuario_apartamentos`
  MODIFY `idusuario_apartamentos` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  ADD CONSTRAINT `apartamentos_ibfk_2` FOREIGN KEY (`usuarios_id_usuario_in`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_gastos`
--
ALTER TABLE `factura_gastos`
  ADD CONSTRAINT `factura_gastos_ibfk_1` FOREIGN KEY (`apartamentos_id_apartamento`) REFERENCES `apartamentos` (`id_apartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura_gastos_items`
--
ALTER TABLE `factura_gastos_items`
  ADD CONSTRAINT `factura_gastos_items_ibfk_1` FOREIGN KEY (`factura_gastos_id_factura_gastos`) REFERENCES `factura_gastos` (`id_factura_gastos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `factura_gastos_items_ibfk_2` FOREIGN KEY (`items_id_item`) REFERENCES `items` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura_servicios`
--
ALTER TABLE `factura_servicios`
  ADD CONSTRAINT `factura_servicios_ibfk_1` FOREIGN KEY (`apartamentos_id_apartamento`) REFERENCES `apartamentos` (`id_apartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura_servicios_servicios`
--
ALTER TABLE `factura_servicios_servicios`
  ADD CONSTRAINT `factura_servicios_servicios_ibfk_1` FOREIGN KEY (`servicios_id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `factura_servicios_servicios_ibfk_2` FOREIGN KEY (`factura_servicios_id_factura_servicios`) REFERENCES `factura_servicios` (`id_factura_servicios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipoUsuarios_id_tipoUsuario`) REFERENCES `tipoUsuarios` (`id_tipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`condicionUsuarios_id_condicionUsuario`) REFERENCES `condicionUsuarios` (`id_condicionUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_apartamentos`
--
ALTER TABLE `usuario_apartamentos`
  ADD CONSTRAINT `usuario_apartamentos_ibfk_1` FOREIGN KEY (`apartamentos_id_apartamento`) REFERENCES `apartamentos` (`id_apartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_apartamentos_ibfk_2` FOREIGN KEY (`usuarios_id_usuario_ps`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_apartamentos_ibfk_3` FOREIGN KEY (`usuarios_id_usuario_pp`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
