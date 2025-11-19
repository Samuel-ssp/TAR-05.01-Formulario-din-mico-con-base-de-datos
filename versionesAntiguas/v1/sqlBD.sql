-- Crear base de datos
CREATE DATABASE formulario;
USE formulario;

-- Tabla paises: Creo primero paises para no generar conflicto con la fk en usuarios
CREATE TABLE paises_select (
    idpais TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    abreviatura CHAR(5) NOT NULL UNIQUE,                       -- Valor de paises (ej: 'ES', 'FR') para poder tener la primera opcion en blanco
    contenido VARCHAR(100) NOT NULL UNIQUE                    -- Texto de paises
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
    contenido VARCHAR(150) NOT NULL UNIQUE                     -- Texto de intereses
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
INSERT INTO intereses_check (contenido) VALUES
('Suscribirse al boletín'),
('Recibir información de eventos'),
('Recibir ofertas especiales'),
('Recibir novedades');

/*
    SELECT PARA FORMULARIO
*/
-- Países (para el select)
SELECT * FROM paises_select;

-- Intereses (para checkbox)
SELECT * FROM intereses_check;


--CREACION DE USUARIO
CREATE USER 'nombre'@'localhost' IDENTIFIED BY 'contrasenia1'; -- Crea usuario que solo puede conectarse desde el servidor local
CREATE USER 'pablo'@'%' IDENTIFIED BY 'contrasenia2'; -- Desde cualquier ubicación
CREATE USER 'kiko'@'192.168.1.100' IDENTIFIED BY 'contrasenia3'; -- Desde la IP 192.168.1.100

--BORRAR USUARIO
DROP USER 'nombre'@'host'; -- Elimina un usuario y todos sus privilegios automáticamente
DROP USER 'nombre1'@'host','nombre2'@'host'; -- Elimina múltiples usuarios 

--DAR PRIVILEGIOS
GRANT ALL PRIVILEGES ON *.* TO 'nombre'@'host'; -- Da todos los privilegios sobre todas las bases de datos del servidor
GRANT ALL PRIVILEGES ON baseDatos.* TO 'nombre'@'host'; -- Sobre una base de datos específica
GRANT SELECT, INSERT ON baseDatos.* TO 'nombre'@'host'; -- Insertar en todas las tablas de la base de datos
GRANT SELECT, INSERT, UPDATE, DELETE ON baseDatos.* TO 'nombre'@'host'; -- Da permisos completos de manipulación los datos
GRANT SELECT, UPDATE ON baseDatos.tabla TO 'nombre'@'host'; -- Da permisos solo sobre una tabla específica
GRANT CREATE, DROP ON baseDatos.* TO 'nombre'@'host'; -- Da permisos para crear y eliminar tablas
GRANT ALTER, INDEX ON baseDatos.* TO 'nombre'@'host'; -- Da permisos para modificar estructura de tablas y crear índices
GRANT EXECUTE ON baseDatos.* TO 'nombre'@'host'; -- Da permisos para ejecutar procedimientos almacenados y funciones
GRANT CREATE USER ON *.* TO 'nombre'@'host'; -- Da permisos para crear y gestionar otros usuarios 

--APLICAR CAMBIOS DE PRIVILEGIOS
FLUSH PRIVILEGES; -- Recarga las tablas de privilegios para que los cambios tengan efecto inmediato

--VER PRIVILEGIOS
SHOW GRANTS FOR 'nombre'@'host'; -- Muestra todos los privilegios de un usuario específico
SELECT user, host FROM mysql.user; -- Lista todos los usuarios del sistema en el hosts permitidos

--QUITAR PRIVILEGIOS
REVOKE SELECT, INSERT ON baseDatos.* FROM 'nombre'@'host'; -- Quita privilegios específicos de consulta e inserción
REVOKE ALL PRIVILEGES ON baseDatos.* FROM 'nombre'@'host'; -- Quita todos los privilegios sobre una base de datos específica
REVOKE ALL PRIVILEGES ON *.* FROM 'nombre'@'host'; -- Quita todos los privilegios globales del usuario
FLUSH PRIVILEGES; 

--MODIFICAR USUARIO
ALTER USER 'nombre'@'host' IDENTIFIED BY 'nueva_contrasenia'; -- Cambia la contraseña del usuario
SET PASSWORD FOR 'nombre'@'host' = PASSWORD('nueva_contrasenia'); -- Cambia la contraseña del usuario
RENAME USER 'viejo_nombre'@'host' TO 'nuevo_nombre'@'host'; -- Cambia el nombre del usuario 

------------------------------------EJEMPLOS PRACTICOS

--Usuario solo lectura
CREATE USER 'lector'@'%' IDENTIFIED BY 'Pass123!'; 
GRANT SELECT ON empresa.* TO 'lector'@'%'; -- Permite solo leer datos, no modificar nada
FLUSH PRIVILEGES; -- Aplica los cambios inmediatamente

--Usuario lectura y escritura
CREATE USER 'editor'@'localhost' IDENTIFIED BY 'Pass456!'; 
GRANT SELECT, INSERT, UPDATE, DELETE ON ventas.* TO 'editor'@'localhost'; 
FLUSH PRIVILEGES;

--Usuario administrador de una base de datos
CREATE USER 'admin_db'@'localhost' IDENTIFIED BY 'Pass789!'; 
GRANT ALL PRIVILEGES ON mi_base_datos.* TO 'admin_db'@'localhost';
FLUSH PRIVILEGES; 

