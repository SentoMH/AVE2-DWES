
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `barjuan` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `barjuan`;


CREATE TABLE `comandas` (
`idComanda` int(11) NOT NULL,
`fecha` datetime NOT NULL,
`idMesa` int(11) NOT NULL,
`comensales` int(11) NOT NULL,
`detalles` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
`estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'TRUE en espera, FALSE finalizada '
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- RELACIONES PARA LA TABLA `comandas`:
--   `idMesa`
--       `mesa` -> `idMesa`

CREATE TABLE `lineascomandas` (
`idlinea` int(11) NOT NULL,
`idComanda` int(11) NOT NULL,
`idProducto` int(11) NOT NULL,
`cantidad` decimal(8,2) NOT NULL,
`entregado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'false sin entregar, true entregado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- RELACIONES PARA LA TABLA `lineascomandas`:
--   `idComanda`
--       `comandas` -> `idComanda`
--   `idProducto`
--       `productos` -> `idProducto`

CREATE TABLE `lineaspedidos` (
`idlinea` int(11) NOT NULL,
`idPedido` int(11) NOT NULL,
`idProducto` int(11) NOT NULL,
`cantidad` decimal(8,2) NOT NULL,
`entregado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- RELACIONES PARA LA TABLA `lineaspedidos`:
--   `idPedido`
--       `pedidos` -> `idPedidos`
--   `idProducto`
--       `productos` -> `idProducto`

CREATE TABLE `mesa` (
`idMesa` int(11) NOT NULL,
`nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
`comensales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


CREATE TABLE `pedidos` (
`idPedidos` int(11) NOT NULL,
`idProveedor` int(11) NOT NULL,
`fecha` datetime NOT NULL,
`detalles` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
`estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- RELACIONES PARA LA TABLA `pedidos`:
--   `idProveedor`
--       `proveedores` -> `idProveedor`

CREATE TABLE `productos` (
`idProducto` int(11) NOT NULL,
`nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
`descripcion` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
`precio` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- RELACIONES PARA LA TABLA `productos`:

CREATE TABLE `proveedores` (
`idProveedor` int(11) NOT NULL,
`nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
`cif` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
`direccion` text COLLATE latin1_spanish_ci NOT NULL,
`telefono` int(11) DEFAULT NULL,
`email` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
`contacto` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- RELACIONES PARA LA TABLA `proveedores`:

CREATE TABLE `stock` (
`idStock` int(11) NOT NULL,
`fecha` datetime NOT NULL,
`id_producto` int(11) NOT NULL,
`cantidad` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- RELACIONES PARA LA TABLA `stock`:
--   `id_producto`
--       `productos` -> `idProducto`

CREATE TABLE `tickets` (
`idTicket` int(11) NOT NULL,
`fecha` datetime NOT NULL,
`idComanda` int(11) NOT NULL,
`importe` decimal(10,2) NOT NULL,
`pagado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- RELACIONES PARA LA TABLA `tickets`:
--   `idComanda`
--       `comandas` -> `idComanda`
ALTER TABLE `comandas`
ADD PRIMARY KEY (`idComanda`),
ADD KEY `comandas_mesa_idMesa_fk` (`idMesa`);

ALTER TABLE `lineascomandas`
ADD PRIMARY KEY (`idlinea`),
ADD KEY `lineascomanda_comandas_idComanda_fk` (`idComanda`),
ADD KEY `lineascomanda_productos_idProducto_fk` (`idProducto`);

ALTER TABLE `lineaspedidos`
ADD PRIMARY KEY (`idlinea`),
ADD KEY `lineasPedidos_pedidos_idPedidos_fk` (`idPedido`),
ADD KEY `lineasPedidos_productos_idProducto_fk` (`idProducto`);

ALTER TABLE `mesa`
ADD PRIMARY KEY (`idMesa`),
ADD UNIQUE KEY `mesa_pk2` (`nombre`);

ALTER TABLE `pedidos`
ADD PRIMARY KEY (`idPedidos`),
ADD KEY `pedidos_proveedores_idProveedor_fk` (`idProveedor`);

ALTER TABLE `productos`
ADD PRIMARY KEY (`idProducto`),
ADD UNIQUE KEY `nombre_unique` (`nombre`);

ALTER TABLE `proveedores`
ADD PRIMARY KEY (`idProveedor`),
ADD UNIQUE KEY `proveedores_pk2` (`nombre`),
ADD UNIQUE KEY `proveedores_pk3` (`cif`);

ALTER TABLE `stock`
ADD PRIMARY KEY (`idStock`),
ADD KEY `stock_producto__fk` (`id_producto`);

ALTER TABLE `tickets`
ADD PRIMARY KEY (`idTicket`),
ADD KEY `tickets_comandas_idComanda_fk` (`idComanda`);

ALTER TABLE `comandas`
MODIFY `idComanda` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lineascomandas`
MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lineaspedidos`
MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `mesa`
MODIFY `idMesa` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pedidos`
MODIFY `idPedidos` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `productos`
MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `proveedores`
MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `stock`
MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tickets`
MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `comandas`
ADD CONSTRAINT `comandas_mesa_idMesa_fk` FOREIGN KEY (`idMesa`) REFERENCES `mesa` (`idMesa`);

ALTER TABLE `lineascomandas`
ADD CONSTRAINT `lineascomanda_comandas_idComanda_fk` FOREIGN KEY (`idComanda`) REFERENCES `comandas` (`idComanda`),
ADD CONSTRAINT `lineascomanda_productos_idProducto_fk` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

ALTER TABLE `lineaspedidos`
ADD CONSTRAINT `lineasPedidos_pedidos_idPedidos_fk` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedidos`),
ADD CONSTRAINT `lineasPedidos_productos_idProducto_fk` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

ALTER TABLE `pedidos`
ADD CONSTRAINT `pedidos_proveedores_idProveedor_fk` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`);

ALTER TABLE `stock`
ADD CONSTRAINT `stock_producto__fk` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`idProducto`);

ALTER TABLE `tickets`
ADD CONSTRAINT `tickets_comandas_idComanda_fk` FOREIGN KEY (`idComanda`) REFERENCES `comandas` (`idComanda`);
COMMIT;
