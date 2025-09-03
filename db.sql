DROP TABLE IF EXISTS decuentos;
DROP TABLE IF EXISTS ventas;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS tipo_usuario;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS cliente;

CREATE DATABASE ComercioRed;
USE ComercioRed;
CREATE TABLE `sucursal` (
  `Id_Comercio` int AUTO_INCREMENT PRIMARY KEY,
  `Nombre_Sucursal` varchar(50),
  `Telefono` varchar(12),
  `Email` varchar(30),
  `Domicilio` varchar(50),
  `Logotipo` varchar(100),
  `color_background_principal` varchar(20),
  `color_background_secundario` varchar(20), 
  `color_radial` varchar(20), 
  `color_texto_principal` varchar(20),
  `color_texto_secundario` varchar(20), 
  `color_header_principal` varchar(20),
  `color_header_secundario` varchar(20),
  `color_footer_principal` varchar(20), 
  `color_footer_secundario` varchar(20),
  `color_texto_header_principal` varchar(20),
  `color_texto_header_secundario` varchar(20),
  `color_texto_footer_principal` varchar(20),
  `color_texto_footer_secundario` varchar(20),
  `color_boton_principal` varchar(20),
  `color_boton_secundario` varchar(20), 
  `color_boton_texto_principal` varchar(20),
  `color_boton_texto_secundario` varchar(20)
) ENGINE=InnoDB;

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
  `Estatus_u` int,
  `configuracion` int,
  FOREIGN KEY (configuracion) REFERENCES sucursal(Id_Comercio) ON DELETE CASCADE
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
  `Hora_Venta` TIME NOT NULL,
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
  `Iva` DOUBLE,
  FOREIGN KEY (Id_De_cliente) REFERENCES cliente(Id_cliente) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE `corte_caja` (
  `Id_Corte` int AUTO_INCREMENT PRIMARY KEY,
  `Id_Usuario` int NOT NULL,
  `Fecha_Corte` date DEFAULT NULL,
  `Monto_Inicial` DOUBLE NOT NULL,
  `Monto_Final` DOUBLE NOT NULL,
  `Hora_Inicial` time NOT NULL,
  `Hora_Final` time NOT NULL,
  `Subtotal` DOUBLE,
  `Total_Descuento` DOUBLE,
  `Total_Iva` DOUBLE,
  FOREIGN KEY (Id_Usuario) REFERENCES usuario(Id_usuario) ON DELETE CASCADE
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

INSERT INTO sucursal (Id_Comercio, Nombre_Sucursal, Telefono, Email, Domicilio, Logotipo, color_background_principal, color_background_secundario, color_radial, color_texto_principal, color_texto_secundario, color_header_principal, color_header_secundario, color_footer_principal, color_footer_secundario, color_texto_header_principal, color_texto_header_secundario, color_texto_footer_principal, color_texto_footer_secundario, color_boton_principal, color_boton_secundario, color_boton_texto_principal, color_boton_texto_secundario) VALUES
(2, 'Patria', '375 100 3330', 'lapiconeria@gmail.com', 'Av. Patria No. , Colonia Santuario, C.P. 46620. Am', '../img/logotipos/1756919785_Logotipo.png', '#fcf8f8', '#f7f7f7', '#69b894', '#000000', '#4e4b4b', '#2259f2', '#eddd53', '#ad8225', '#2259f2', '#000000', '#7d7d7d', '#fafafa', '#666060', '#4665e2', '#394660', '#fefbfb', '#fcfcfc');

/* inner join para obtener datos de ventas
SELECT 
    v.Id_Venta,
    v.No_venta,
    v.Fecha_Venta,
    -- Datos del vendedor
    u.Nombre AS Vendedor_Nombre,
    u.A_paterno AS Vendedor_ApellidoP,
    u.A_Materno AS Vendedor_ApellidoM,
    -- Datos del cliente
    c.Nombre AS Cliente_Nombre,
    c.A_paterno AS Cliente_ApellidoP,
    c.A_Materno AS Cliente_ApellidoM,
    -- Datos del producto
    p.Nombre AS Producto,
    p.Descripcion,
    v.Cantidad,
    v.Precio_al_dia,
    -- Descuento (si existe)
    IFNULL(d.Descuento, 0) AS Descuento,
    v.Tipo_Pago
FROM ventas v
INNER JOIN usuario u ON v.Id_Vendedor = u.Id_Usuario
INNER JOIN cliente c ON v.Cliente_Id = c.Id_cliente
INNER JOIN productos p ON v.Codigo_pro = p.Codigo
LEFT JOIN descuentos d ON v.No_venta = d.No_venta AND v.Cliente_Id = d.Id_De_cliente;

INSERT INTO productos (Codigo, Nombre, Descripcion, Stock, Fecha_Caducidad, Fecha_Registro, Costo, Precio, Estatus_p) VALUES
(1, 'Concha', 'Pan dulce, clásico y con azucar.', 50, '2025-12-15', '2025-09-03', 5.00, 8.00, 1),
(2, 'Bolillo', 'Pan salado, crujiente y alargado.', 120, '2025-10-20', '2025-09-03', 2.50, 4.00, 1),
(3, 'Mantecada', 'Bizcocho de mantequilla, suave y esponjoso.', 70, '2025-11-05', '2025-09-03', 4.00, 7.00, 1),
(4, 'Puerquito', 'Pan dulce con forma de cerdito.', 40, '2025-12-01', '2025-09-03', 3.50, 6.00, 1),
(5, 'Bigote', 'Pan dulce con forma de bigote.', 35, '2025-11-18', '2025-09-03', 3.80, 6.50, 1),
(6, 'Birote', 'Pan salado, similar al bolillo pero más pequeño.', 80, '2025-10-25', '2025-09-03', 2.00, 3.50, 1),
(7, 'Cuernito', 'Pan en forma de media luna.', 55, '2025-12-10', '2025-09-03', 4.50, 7.50, 1),
(8, 'Pan de centeno', 'Pan oscuro, con sabor fuerte y textura densa.', 30, '2025-12-30', '2025-09-03', 6.00, 10.00, 1),
(9, 'Pan integral', 'Hecho con harina integral, más nutritivo.', 45, '2025-11-22', '2025-09-03', 5.50, 9.00, 1),
(10, 'Baguette', 'Pan francés largo y delgado.', 25, '2025-12-05', '2025-09-03', 7.00, 12.00, 1),
(11, 'Chapata', 'Pan italiano rústico y con agujeros grandes.', 28, '2025-11-28', '2025-09-03', 6.50, 11.00, 1),
(12, 'Roles de canela', 'Bizcocho espiral con canela y azúcar.', 60, '2025-12-20', '2025-09-03', 5.00, 9.00, 1),
(13, 'Elote', 'Pan dulce que sabe a elote.', 40, '2025-10-30', '2025-09-03', 4.20, 7.50, 1),
(14, 'Ojo de buey', 'Bizcocho redondo con un hueco en el centro.', 32, '2025-11-15', '2025-09-03', 4.80, 8.50, 1),
(15, 'Picón', 'Pan dulce con una costra crujiente.', 50, '2025-12-12', '2025-09-03', 3.70, 6.50, 1),
(16, 'Garibaldi', 'Bizcocho cubierto de azúcar.', 42, '2025-11-07', '2025-09-03', 4.50, 8.00, 1),
(17, 'Chilindrina', 'Pan dulce con una cubierta crujiente de azúcar.', 55, '2025-12-08', '2025-09-03', 3.90, 7.00, 1),
(18, 'Nube', 'Pan dulce suave y esponjoso.', 37, '2025-10-18', '2025-09-03', 4.00, 7.20, 1),
(19, 'Tequila', 'Un nombre popular para el pan dulce en Jalisco, no de origen tequilero.', 26, '2025-11-25', '2025-09-03', 5.20, 9.00, 1),
(20, 'Corbatín', 'Pan dulce con forma de moño o corbata.', 34, '2025-12-02', '2025-09-03', 4.30, 7.50, 1),
(21, 'Beso', 'Pan dulce, suave, con forma de beso.', 29, '2025-10-28', '2025-09-03', 3.80, 6.80, 1),
(22, 'Rebanada', 'Una rebanada de pan dulce o pastel.', 47, '2025-11-30', '2025-09-03', 4.10, 7.50, 1),
(23, 'Pumpernickel', 'Pan alemán oscuro y denso.', 18, '2025-12-18', '2025-09-03', 6.80, 11.50, 1),
(24, 'Masa madre', 'Pan con sabor ácido y textura irregular.', 22, '2025-12-22', '2025-09-03', 6.00, 10.50, 1),
(25, 'Multicereales', 'Pan con varios tipos de granos y semillas.', 40, '2025-11-12', '2025-09-03', 5.90, 10.00, 1),
(26, 'Hojarasca', 'Galleta fina y crujiente.', 65, '2025-10-15', '2025-09-03', 3.20, 6.00, 1),
(27, 'Muffin', 'Bizcocho individual, esponjoso, usualmente con frutas.', 50, '2025-12-25', '2025-09-03', 5.50, 9.50, 1),
(28, 'Croissant', 'Pan en forma de media luna, hojaldrado y mantequilloso.', 38, '2025-12-28', '2025-09-03', 6.20, 11.00, 1),
(29, 'Galleta de mantequilla', 'Galleta suave y dulce, con sabor a mantequilla.', 70, '2025-11-10', '2025-09-03', 3.50, 6.50, 1),
(30, 'Pan de muerto', 'Pan dulce en noviembre, con forma de huesos.', 45, '2025-10-31', '2025-09-03', 6.00, 10.00, 1),
(31, 'Rosca de reyes', 'Pan dulce circular con frutas secas en enero.', 25, '2026-01-05', '2025-09-03', 8.00, 14.00, 1);

*/