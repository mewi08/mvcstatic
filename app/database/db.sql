DROP DATABASE IF EXISTS tiendaperu;
CREATE DATABASE tiendaperu;
 
USE tiendaperu;

CREATE TABLE productos(
  id INT AUTO_INCREMENT PRIMARY KEY,
  clasificacion   ENUM('Equipo', 'Accesorio', 'Consumible') NOT NULL,
  marca           VARCHAR(30)   NOT NULL,
  descripcion     VARCHAR(100)  NOT NULL,
  garantia        TINYINT       NOT NULL DEFAULT 12,
  ingreso         DATE          NOT NULL,
  cantidad        SMALLINT      NOT NULL,
  created         DATETIME      NOT NULL DEFAULT now() COMMENT 'Campo de fecha de creacion',
  updated         DATETIME      NULL COMMENT 'Se agrega al detectar un cambio'
) ENGINE=InnoDB; /*INNODB (relacional - join) MYISAM(veloz no relacional)*/
CREATE TABLE proveedores(
  idprov INT AUTO_INCREMENT PRIMARY KEY,
  razonsocial VARCHAR(150) NOT NULL,
  ruc CHAR(11) NULL,
  telefono CHAR(9)  NULL,
  origen ENUM('N', 'E') NOT NULL DEFAULT 'N',
  contacto VARCHAR(50) NOT NULL,
  confianza TINYINT NOT NULL DEFAULT 1,
  created         DATETIME      NOT NULL DEFAULT now() COMMENT 'Campo de fecha de creacion',
  updated         DATETIME      NULL COMMENT 'Se agrega al detectar un cambio'
) ENGINE = InnoDB;

INSERT INTO proveedores(razonsocial, ruc, telefono, origen, contacto, confianza) VALUES
('Tecnologia Global S.A.C.', '20000345678', '987654321', 'N', 'Juan Perez', 2),
('Importaciones XYZ E.I.R.L.', '', '', 'E', 'Maria Gomez', 3),
('Soluciones Informaticas S.A.', '20613323344', '998877665', 'N', 'Carlos Ruiz', 5);
SELECT * FROM proveedores;

INSERT INTO productos 
(clasificacion, marca, descripcion, garantia, ingreso, cantidad) VALUES
('Equipo', 'Epson', 'Impresora L200', 24, '2025-10-05', 10),
('Accesorio', 'Logitech', 'Teclado USB negro', 12, '2025-11-01', 20),
('Consumible', 'Canon', 'Pixma 190 Yellow', 6, '2025-09-10', 5);

SELECT * FROM productos;
SELECT 
id,clasificacion, marca, descripcion, garantia, ingreso, cantidad
FROM productos
ORDER BY id DESC;