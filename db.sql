DROP TABLE ventas;
DROP TABLE usuario;
DROP TABLE tipo_usuario;
DROP TABLE productos;
DROP TABLE cliente;

CREATE DATABASE ComercioRed;
USE ComercioRed;

CREATE TABLE `Productos` (
  `Codigo` varchar(20) NOT NULL PRIMARY KEY,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(50),
  `Stock` int NOT NULL,
  `Fecha_Caducidad` date DEFAULT NULL,
  `Fecha_Registro` date DEFAULT NULL,
  `Costo` DOUBLE NOT NULL,
  `Precio` DOUBLE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `Tipo_Usuario` (
  `Usuario_id` int AUTO_INCREMENT NOT NULL PRIMARY KEY,
   `Usuario` varchar(20) NOT NULL,
  `Pasword` varchar(50) NOT NULL,
  `Puesto` varchar(20) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `Usuario` (
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
   FOREIGN KEY (Id_Tipo) REFERENCES Tipo_Usuario(Usuario_id)
) ENGINE=InnoDB;

CREATE TABLE `Cliente` (
  `Id_Cliente` int AUTO_INCREMENT PRIMARY KEY,
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
  `Credito_Usado` DOUBLE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `Ventas` (
  `id_venta` int AUTO_INCREMENT PRIMARY KEY,
  `Codigo_pro` varchar(20) NOT NULL,
  `Id_Vendedor` int NOT NULL,
  `Cliente_Id` int NOT NULL,
  `Fecha_Venta` date DEFAULT NULL,
  `No_venta` int NOT NULL,
  `Cantidad` int NOT NULL,
  `Precio_al_dia` DOUBLE NOT NULL,
  `Tipo_Pago` varchar(20) NOT NULL,
  FOREIGN KEY (Codigo_pro) REFERENCES Productos(Codigo),
  FOREIGN KEY (Id_Vendedor) REFERENCES Usuario(Id_Usuario),
  FOREIGN KEY (Cliente_Id) REFERENCES Cliente(Id_Cliente)
) ENGINE=InnoDB;

INSERT INTO tipo_usuario (Usuario, Pasword, Puesto) VALUES('admin', MD5('123'), 'Administrador');
INSERT INTO tipo_usuario (Usuario, Pasword, Puesto) VALUES('Cajero', MD5('123'), 'Cajero');


INSERT INTO usuario (Id_Tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio) 
VALUES('1','ZLPE770216000', 'Administrador', 'PruebaP', 'PruebaM', '2025-06-14', '1977-02-16', '0000000000', 'admin@company.dominio',
'Domicilio de prueba No. 50 Col. Prueba C.P. 46600');

INSERT INTO usuario (Id_Tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio) 
VALUES('2','ASISN890518000', 'Usuario', 'PruebaP', 'PruebaM', '2025-06-14', '1989-05-18', '0000000000', 'cajero@company.dominio',
'Domicilio de prueba No. 49 Col. Prueba C.P. 46600');

INSERT INTO cliente (Id_Cliente, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio, Limite_Credito, Credito_Usado) 
VALUES('1', 'NO APLICA', 'CLIENTE', 'GENERAL', 'NONE', '2025-06-14', '1989-05-18', '0000000000', 'cliente@company.dominio',
'Domicilio de prueba No. 49 Col. Prueba C.P. 46600', '0', '0');


