<?php
include 'conexion.php'; // Incluimos la clase ConexionBD

// Elegimos el tipo de usuario
$bd = new ConexionBD();
$conexion = $bd->usuario(); //->usuario() ->admin() 

/* Pruebas de base de datos para usuario */

// 1️ Crear tabla de prueba
$sqlCrear = "CREATE TABLE IF NOT EXISTS prueba (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
)";
if ($conexion->query($sqlCrear)) {
    echo " Tabla 'prueba' creada correctamente<br>";
} else {
    echo " Error creando tabla: " . $conexion->error ."<br>";
}

// 2️ Insertar una fila
$sqlInsert = "INSERT INTO prueba (nombre) VALUES ('kiko')";
if ($conexion->query($sqlInsert)) {
    $ultimo_id = $conexion->insert_id;
    echo " Fila insertada con ID $ultimo_id<br>";
} else {
    echo " Error insertando fila: " .$conexion->error."<br>";
}

// 3️ Borrar la fila insertada
$sqlBorrarFila = "DELETE FROM prueba WHERE id = $ultimo_id";
if ($conexion->query($sqlBorrarFila)) {
    echo " Fila con ID $ultimo_id borrada correctamente<br>";
} else {
    echo " Error borrando fila: " .$conexion->error."<br>";
}

// 4️ Borrar la tabla de prueba
$sqlBorrarTabla = "DROP TABLE prueba";
if ($conexion->query($sqlBorrarTabla)) {
    echo " Tabla 'prueba' borrada correctamente<br>";
} else {
    echo " Error borrando tabla: " .$conexion->error."<br>";
}
// 5 Modificar tabla

// Cerrar conexión
$conexion->close();
?>
