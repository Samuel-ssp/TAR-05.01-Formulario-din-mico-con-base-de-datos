<?php
//Conecta con la base de datos ($conexión)     
//incia sesion en la base de datos con el otro archivo de inicio de sesion
include 'configdb.php'; //include del archivo con los datos de conexión
include 'conexion.php'; //Crea el objeto $conexion con la base de datos

// SQL para crear base de datos y tablas con la la inserccion en las mismas
$sql = "

CREATE TABLE paises_select (
    idpais TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    abreviatura CHAR(5) NOT NULL,
    contenido VARCHAR(100) NOT NULL
);

CREATE TABLE usuarios (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    genero CHAR(1) NOT NULL CHECK (genero IN ('M', 'F', 'O')),
    idpais TINYINT UNSIGNED NOT NULL,
    nacimiento DATE,
    FOREIGN KEY (idpais) REFERENCES paises_select(idpais)
);

CREATE TABLE intereses_check (
    idinteres TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    abreviatura VARCHAR(50) NOT NULL,
    contenido VARCHAR(150) NOT NULL
);

CREATE TABLE usuario_intereses (
    usuario_id TINYINT UNSIGNED NOT NULL,
    interes_id TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (usuario_id, interes_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (interes_id) REFERENCES intereses_check(idinteres)
);

INSERT INTO paises_select (abreviatura, contenido) VALUES
('', 'Selecciona tu pais'),
('es', 'España'),
('fr', 'Francia'),
('pt', 'Portugal');

INSERT INTO intereses_check (abreviatura, contenido) VALUES
('boletin', 'Suscribirse al boletín'),
('eventos', 'Recibir información de eventos'),
('ofertas', 'Recibir ofertas especiales'),
('novedades', 'Recibir novedades');
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
