<?php
//Conecta con la base de datos ($conexión)     
//incia sesion en la base de datos con el otro archivo de inicio de sesion
include 'configdb.php'; //include del archivo con los datos de conexión
include 'conexion.php'; //Crea el objeto $conexion con la base de datos

// SQL para crear base de datos y tablas con la la inserccion en las mismas
$sql = "

CREATE DATABASE IF NOT EXISTS formulario CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE formulario;

CREATE TABLE IF NOT EXISTS paises_select (
    idpais TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    abreviatura CHAR(5) NOT NULL UNIQUE,
    contenido VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS usuarios (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    genero CHAR(1) NOT NULL CHECK (genero IN ('M', 'F', 'O')),
    idpais TINYINT UNSIGNED NOT NULL,
    nacimiento DATE,
    FOREIGN KEY (idpais) REFERENCES paises_select(idpais)
);

CREATE TABLE IF NOT EXISTS intereses_check (
    idinteres TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    contenido VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS usuario_intereses (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id TINYINT UNSIGNED NOT NULL,
    interes_id TINYINT UNSIGNED NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (interes_id) REFERENCES intereses_check(idinteres)
);

INSERT INTO paises_select (abreviatura, contenido) VALUES
('', 'Selecciona tu pais'),
('es', 'España'),
('fr', 'Francia'),
('pt', 'Portugal');

INSERT INTO intereses_check (contenido) VALUES
('Suscribirse al boletín'),
('Recibir información de eventos'),
('Recibir ofertas especiales'),
('Recibir novedades');
";

// Multi query nos permite el envio de varias consultas sin parar en los ;
if ($conexion->multi_query($sql)) {
    
    echo 'Base de datos, tablas y datos iniciales creados correctamente';
    
} else {
    echo 'Error en la ejecución:'.$conexion->error;
};

// Cerrar conexión
$conexion->close();
?>
