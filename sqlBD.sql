-- Crear base de datos
CREATE DATABASE formulario;
USE formulario;

-- Tabla paises: Creo primero paises para no generar conflicto con la fk en usuarios
CREATE TABLE paises_select (
    idpais TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    abreviatura CHAR(5) NOT NULL,                       -- Valor de paises (ej: 'ES', 'FR')
    contenido VARCHAR(100) NOT NULL                     -- Texto de paises
);

-- Tabla usuarios
CREATE TABLE usuarios (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,     -- ID de usuario 
    nombre VARCHAR(50) NOT NULL,                   
    email VARCHAR(50) NOT NULL UNIQUE,                  -- Email único 
    genero CHAR(1) NOT NULL CHECK (genero IN ('M', 'F', 'O')),-- Género: M=Masculino, F=Femenino, O=Otro 
    idpais TINYINT UNSIGNED NOT NULL,                   -- FK pais 
    nacimiento DATE,                               
    /* condiciones BOOLEAN DEFAULT 0,                      -- Acepta condiciones? 0=No, 1=Sí */
    FOREIGN KEY (idpais) REFERENCES paises_select(idpais)
);  

-- Tabla intereses
CREATE TABLE intereses_check (
    idinteres TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- ID interno del interés
    abreviatura VARCHAR(50) NOT NULL,                   -- Valor de intereses
    contenido VARCHAR(150) NOT NULL                     -- Texto de intereses
);

-- Tabla intermedia: relaciona usuarios con intereses 
CREATE TABLE usuario_intereses (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    usuario_id TINYINT UNSIGNED NOT NULL,               -- FK a usuario
    interes_id TINYINT UNSIGNED NOT NULL,               -- FK a interés
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id), 
    FOREIGN KEY (interes_id) REFERENCES intereses_check(idinteres)
);


---------------------------------------------------- VERSION 2
-- Países (para el select)
INSERT INTO paises_select (abreviatura, contenido) VALUES
('', 'Selecciona tu pais'),                             -- Abreviatura / Contenido
('es', 'España'),
('fr', 'Francia'),
('pt', 'Portugal');

-- Intereses (para checkbox)
INSERT INTO intereses_check (abreviatura, contenido) VALUES
('boletin', 'Suscribirse al boletín'),                  -- Abreviatura / Contenido
('eventos', 'Recibir información de eventos'),
('ofertas', 'Recibir ofertas especiales'),
('novedades', 'Recibir novedades');

/*
    SELECT PARA FORMULARIO
*/
-- Países (para el select)
SELECT * FROM paises_select;

-- Intereses (para checkbox)
SELECT * FROM intereses_check;
