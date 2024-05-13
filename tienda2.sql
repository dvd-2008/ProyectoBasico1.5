-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tienda2;
USE tienda2;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(255),
    contrasena VARCHAR(255),
    correo_electronico VARCHAR(255)
);

-- Tabla de clientes
CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(255),
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255)
);

-- Tabla de categorías
CREATE TABLE categorias (
    id_cat INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(255),
    descripcion TEXT
);

-- Tabla de productos
CREATE TABLE productos (
    id_pro INT AUTO_INCREMENT PRIMARY KEY,
    id_cat INT,
    nombre_producto VARCHAR(255),
    descripcion TEXT,
    precio_compra DECIMAL(10,2),
    precio_venta DECIMAL(10,2),
    stock INT,
    imagen LONGBLOB,
    FOREIGN KEY (id_cat) REFERENCES categorias(id_cat)
);

-- Tabla de proveedores
CREATE TABLE proveedores (
    id_prov INT AUTO_INCREMENT PRIMARY KEY,
    nombre_prov VARCHAR(255),
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255)
);

-- Tabla de descuentos
CREATE TABLE descuentos (
    id_descuento INT AUTO_INCREMENT PRIMARY KEY,
    nombre_descuento VARCHAR(255),
    porcentaje_descuento DECIMAL(5,2)
);

-- Tabla de impuestos
CREATE TABLE impuestos (
    id_impuesto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_impuesto VARCHAR(255),
    porcentaje_impuesto DECIMAL(5,2)
);

-- Tabla de compras
CREATE TABLE compras (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_prov INT,
    fecha_compra DATE,
    total DECIMAL(10,2),    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_prov) REFERENCES proveedores(id_prov)
);

-- Tabla de detalles de compras
CREATE TABLE detalles_de_compra (
    id_detalle_compra INT AUTO_INCREMENT PRIMARY KEY,
    id_compra INT,
    id_pro INT,
    cantidad INT,
    precio_uni DECIMAL(10,2),
    FOREIGN KEY (id_compra) REFERENCES compras(id_compra),
    FOREIGN KEY (id_pro) REFERENCES productos(id_pro)
);

-- Tabla de ventas
CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_cliente INT,
    fecha_venta DATE,
    total DECIMAL(10,2),
    id_descuento INT,
    id_impuesto INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_descuento) REFERENCES descuentos(id_descuento),
    FOREIGN KEY (id_impuesto) REFERENCES impuestos(id_impuesto)
);

-- Tabla de detalles de ventas
CREATE TABLE detalles_de_venta (
    id_detalle_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT,
    id_pro INT,
    cantidad INT,
    precio_uni DECIMAL(10,2),
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta),
    FOREIGN KEY (id_pro) REFERENCES productos(id_pro)
);

-- Tabla de ganancias
CREATE TABLE ganancias (
    id_ganancia INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT,
    monto_ganancia DECIMAL(10,2),
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta)
);
ALTER TABLE productos MODIFY imagen MEDIUMBLOB;
