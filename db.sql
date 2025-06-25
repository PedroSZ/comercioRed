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
   FOREIGN KEY (Id_Tipo) REFERENCES Tipo_Usuario(Usuario_id) ON DELETE CASCADE
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
  FOREIGN KEY (Codigo_pro) REFERENCES Productos(Codigo) ON DELETE CASCADE,
  FOREIGN KEY (Id_Vendedor) REFERENCES Usuario(Id_Usuario) ON DELETE CASCADE,
  FOREIGN KEY (Cliente_Id) REFERENCES Cliente(Id_Cliente) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO Tipo_Usuario (Usuario, Pasword, Puesto) VALUES('admin', MD5('123'), 'Administrador');
INSERT INTO Tipo_Usuario (Usuario, Pasword, Puesto) VALUES('Cajero', MD5('123'), 'Cajero');


INSERT INTO Usuario (Id_Tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio) 
VALUES('1','ZLPE770216000', 'Administrador', 'PruebaP', 'PruebaM', '2025-06-14', '1977-02-16', '0000000000', 'admin@company.dominio',
'Domicilio de prueba No. 50 Col. Prueba C.P. 46600');

INSERT INTO Usuario (Id_Tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio) 
VALUES('2','ASISN890518000', 'Usuario', 'PruebaP', 'PruebaM', '2025-06-14', '1989-05-18', '0000000000', 'cajero@company.dominio',
'Domicilio de prueba No. 49 Col. Prueba C.P. 46600');

INSERT INTO Cliente (Id_Cliente, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento,Telefono, Email, Domicilio, Limite_Credito, Credito_Usado) 
VALUES('1', 'NO APLICA', 'CLIENTE', 'GENERAL', 'NONE', '2025-06-14', '1989-05-18', '0000000000', 'cliente@company.dominio',
'Domicilio de prueba No. 49 Col. Prueba C.P. 46600', '0', '0');



INSERT INTO Tipo_Usuario (Usuario, Pasword, Puesto) VALUES
('user1', MD5('123'), 'Administrador'),
('user2', MD5('123'), 'Cajero'),
('user3', MD5('123'), 'Vendedor'),
('user4', MD5('123'), 'Supervisor'),
('user5', MD5('123'), 'Almacenista'),
('user6', MD5('123'), 'Vendedor'),
('user7', MD5('123'), 'Cajero'),
('user8', MD5('123'), 'Administrador'),
('user9', MD5('123'), 'Vendedor'),
('user10', MD5('123'), 'Cajero');

INSERT INTO Usuario (Id_Tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento, Telefono, Email, Domicilio) VALUES
(1, '000000000000001', 'Usuario1', 'ApellidoP1', 'ApellidoM1', '2025-06-14', '1990-01-01', '1111111111', 'user1@mail.com', 'Domicilio 1'),
(2, '000000000000002', 'Usuario2', 'ApellidoP2', 'ApellidoM2', '2025-06-14', '1991-02-02', '2222222222', 'user2@mail.com', 'Domicilio 2'),
(3, '000000000000003', 'Usuario3', 'ApellidoP3', 'ApellidoM3', '2025-06-14', '1992-03-03', '3333333333', 'user3@mail.com', 'Domicilio 3'),
(4, '000000000000004', 'Usuario4', 'ApellidoP4', 'ApellidoM4', '2025-06-14', '1993-04-04', '4444444444', 'user4@mail.com', 'Domicilio 4'),
(5, '000000000000005', 'Usuario5', 'ApellidoP5', 'ApellidoM5', '2025-06-14', '1994-05-05', '5555555555', 'user5@mail.com', 'Domicilio 5'),
(6, '000000000000006', 'Usuario6', 'ApellidoP6', 'ApellidoM6', '2025-06-14', '1995-06-06', '6666666666', 'user6@mail.com', 'Domicilio 6'),
(7, '000000000000007', 'Usuario7', 'ApellidoP7', 'ApellidoM7', '2025-06-14', '1996-07-07', '7777777777', 'user7@mail.com', 'Domicilio 7'),
(8, '000000000000008', 'Usuario8', 'ApellidoP8', 'ApellidoM8', '2025-06-14', '1997-08-08', '8888888888', 'user8@mail.com', 'Domicilio 8'),
(9, '000000000000009', 'Usuario9', 'ApellidoP9', 'ApellidoM9', '2025-06-14', '1998-09-09', '9999999999', 'user9@mail.com', 'Domicilio 9'),
(10, '000000000000010', 'Usuario10', 'ApellidoP10', 'ApellidoM10', '2025-06-14', '1999-10-10', '1010101010', 'user10@mail.com', 'Domicilio 10');

INSERT INTO Cliente (Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento, Telefono, Email, Domicilio, Limite_Credito, Credito_Usado) VALUES
('000000000000011', 'Cliente1', 'ApellidoP1', 'ApellidoM1', '2025-06-14', '1990-01-01', '1111111111', 'cliente1@mail.com', 'Domicilio 1', 10000, 2000),
('000000000000012', 'Cliente2', 'ApellidoP2', 'ApellidoM2', '2025-06-14', '1991-02-02', '2222222222', 'cliente2@mail.com', 'Domicilio 2', 15000, 3000),
('000000000000013', 'Cliente3', 'ApellidoP3', 'ApellidoM3', '2025-06-14', '1992-03-03', '3333333333', 'cliente3@mail.com', 'Domicilio 3', 12000, 2500),
('000000000000014', 'Cliente4', 'ApellidoP4', 'ApellidoM4', '2025-06-14', '1993-04-04', '4444444444', 'cliente4@mail.com', 'Domicilio 4', 8000, 1000),
('000000000000015', 'Cliente5', 'ApellidoP5', 'ApellidoM5', '2025-06-14', '1994-05-05', '5555555555', 'cliente5@mail.com', 'Domicilio 5', 20000, 5000),
('000000000000016', 'Cliente6', 'ApellidoP6', 'ApellidoM6', '2025-06-14', '1995-06-06', '6666666666', 'cliente6@mail.com', 'Domicilio 6', 30000, 10000),
('000000000000017', 'Cliente7', 'ApellidoP7', 'ApellidoM7', '2025-06-14', '1996-07-07', '7777777777', 'cliente7@mail.com', 'Domicilio 7', 5000, 0),
('000000000000018', 'Cliente8', 'ApellidoP8', 'ApellidoM8', '2025-06-14', '1997-08-08', '8888888888', 'cliente8@mail.com', 'Domicilio 8', 18000, 7000),
('000000000000019', 'Cliente9', 'ApellidoP9', 'ApellidoM9', '2025-06-14', '1998-09-09', '9999999999', 'cliente9@mail.com', 'Domicilio 9', 25000, 12000),
('000000000000020', 'Cliente10', 'ApellidoP10', 'ApellidoM10', '2025-06-14', '1999-10-10', '1010101010', 'cliente10@mail.com', 'Domicilio 10', 10000, 5000);

INSERT INTO Productos (Codigo, Nombre, Descripcion, Stock, Fecha_Caducidad, Fecha_Registro, Costo, Precio) VALUES
('1001', 'Producto1', 'Descripcion 1', 50, '2026-12-31', '2025-06-14', 20, 30),
('1002', 'Producto2', 'Descripcion 2', 60, '2026-11-30', '2025-06-14', 15, 25),
('1003', 'Producto3', 'Descripcion 3', 70, '2026-10-31', '2025-06-14', 10, 20),
('1004', 'Producto4', 'Descripcion 4', 80, '2026-09-30', '2025-06-14', 12, 22),
('1005', 'Producto5', 'Descripcion 5', 90, '2026-08-31', '2025-06-14', 18, 28),
('1006', 'Producto6', 'Descripcion 6', 100, '2026-07-31', '2025-06-14', 25, 35),
('1007', 'Producto7', 'Descripcion 7', 110, '2026-06-30', '2025-06-14', 30, 40),
('1008', 'Producto8', 'Descripcion 8', 120, '2026-05-31', '2025-06-14', 22, 32),
('1009', 'Producto9', 'Descripcion 9', 130, '2026-04-30', '2025-06-14', 28, 38),
('1010', 'Producto10', 'Descripcion 10', 140, '2026-03-31', '2025-06-14', 35, 45);

INSERT INTO Ventas (Codigo_pro, Id_Vendedor, Cliente_Id, Fecha_Venta, No_venta, Cantidad, Precio_al_dia, Tipo_Pago) VALUES
('1001', 1, 1, '2025-06-25', 1, 5, 30, 'Contado'),
('1002', 2, 2, '2025-06-25', 2, 3, 25, 'Crédito'),
('1003', 3, 3, '2025-06-25', 3, 4, 20, 'Contado'),
('1004', 4, 4, '2025-06-25', 4, 2, 22, 'Crédito'),
('1005', 5, 5, '2025-06-25', 5, 6, 28, 'Contado'),
('1006', 6, 6, '2025-06-25', 6, 7, 35, 'Crédito'),
('1007', 7, 7, '2025-06-25', 7, 1, 40, 'Contado'),
('1008', 8, 8, '2025-06-25', 8, 8, 32, 'Crédito'),
('1009', 9, 9, '2025-06-25', 9, 9, 38, 'Contado'),
('1010', 10, 10, '2025-06-25', 10, 10, 45, 'Crédito');
