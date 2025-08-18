DROP TABLE IF EXISTS decuentos;
DROP TABLE IF EXISTS ventas;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS tipo_usuario;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS cliente;

CREATE DATABASE ComercioRed;
USE ComercioRed;

CREATE TABLE `productos` (
  `Codigo` varchar(20) NOT NULL PRIMARY KEY,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(50),
  `Stock` int NOT NULL,
  `Fecha_Caducidad` date DEFAULT NULL,
  `Fecha_Registro` date DEFAULT NULL,
  `Costo` DOUBLE NOT NULL,
  `Precio` DOUBLE NOT NULL,
  `Estatus_p` int
) ENGINE=InnoDB;

CREATE TABLE `tipo_usuario` (
  `Usuario_Id` int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `Usuario` varchar(20) NOT NULL,
  `Pasword` varchar(50) NOT NULL,
  `Puesto` varchar(20) NOT NULL,
  `Estatus_u` int
) ENGINE=InnoDB;

CREATE TABLE `usuario` (
  `Id_Usuario` int AUTO_INCREMENT PRIMARY KEY,
  `Id_Tipo` int,
  `Rfc` varchar(16),
  `Nombre` varchar(30) NOT NULL,
  `A_paterno` varchar(30),
  `A_Materno` varchar(30),
  `Fecha_Registro` date DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Domicilio` varchar(50),
   FOREIGN KEY (Id_Tipo) REFERENCES tipo_usuario(usuario_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `cliente` (
  `Id_cliente` int AUTO_INCREMENT PRIMARY KEY,
  `Rfc` varchar(16),
  `Nombre` varchar(30) NOT NULL,
  `A_paterno` varchar(30),
  `A_Materno` varchar(30),
  `Fecha_Registro` date DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Telefono` varchar(12),
  `Email` varchar(30),
  `Domicilio` varchar(50),
  `Limite_Credito` DOUBLE NOT NULL,
  `Credito_Usado` DOUBLE NOT NULL,
  `Estatus_c` int
) ENGINE=InnoDB;

CREATE TABLE `ventas` (
  `Id_Venta` int AUTO_INCREMENT PRIMARY KEY,
  `Codigo_pro` varchar(20) NOT NULL,
  `Id_Vendedor` int NOT NULL,
  `Cliente_Id` int NOT NULL,
  `Fecha_Venta` date DEFAULT NULL,
  `No_venta` int NOT NULL,
  `Cantidad` int NOT NULL,
  `Precio_al_dia` DOUBLE NOT NULL,
  `Tipo_Pago` varchar(20) NOT NULL,
  FOREIGN KEY (Codigo_pro) REFERENCES productos(Codigo) ON DELETE CASCADE,
  FOREIGN KEY (Id_Vendedor) REFERENCES usuario(Id_usuario) ON DELETE CASCADE,
  FOREIGN KEY (cliente_Id) REFERENCES cliente(Id_cliente) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `descuentos` (
  `Id_Descuento` int AUTO_INCREMENT PRIMARY KEY,
  `Id_De_cliente` int,
  `No_venta` int,
  `Descuento` DOUBLE,
  FOREIGN KEY (Id_De_cliente) REFERENCES cliente(Id_cliente) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO tipo_usuario (Usuario, Pasword, Puesto, Estatus_u) VALUES('admin', MD5('123'), 'Administrador',1);
INSERT INTO tipo_usuario (Usuario, Pasword, Puesto, Estatus_u) VALUES('Cajero', MD5('123'), 'Cajero',1);


INSERT INTO usuario (Id_Tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio) 
VALUES('1','ZLPE770216000', 'Administrador', 'PruebaP', 'PruebaM', '2025-06-14', '1977-02-16', '0000000000', 'admin@company.dominio',
'Domicilio de prueba No. 50 Col. Prueba C.P. 46600');

INSERT INTO usuario (Id_Tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio) 
VALUES('2','ASISN890518000', 'usuario', 'PruebaP', 'PruebaM', '2025-06-14', '1989-05-18', '0000000000', 'cajero@company.dominio',
'Domicilio de prueba No. 49 Col. Prueba C.P. 46600');

INSERT INTO cliente (Id_cliente, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio, Limite_Credito, Credito_Usado) 
VALUES('1', 'NO APLICA', 'cliente', 'GENERAL', 'NONE', '2025-06-14', '1989-05-18', '0000000000', 'cliente@company.dominio',
'Domicilio de prueba No. 49 Col. Prueba C.P. 46600', '0', '0');

