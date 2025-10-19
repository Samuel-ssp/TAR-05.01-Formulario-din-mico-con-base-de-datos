<?php

//Conecta con la base de datos ($conexión)
include 'configdb.php';
include 'conexion.php';

//CONSULTA SQL	
$sqlpaises = "SELECT * FROM paises_select;"; 
$sqlintereses = "SELECT * FROM intereses_check;";
echo $sqlpaises;
echo $sqlintereses;
//Ejecuta las consultas
$resultado = $conexion->query($sqlpaises);
$resultado2 = $conexion->query($sqlintereses);

// Mostrar países
if($resultado->num_rows > 0){
    while($fila = $resultado->fetch_array()){
        echo "<br>$fila[0]";
        echo "<br>$fila[1]";
        echo "<br>$fila[2]";  
    };
} else {
    echo "Error en  paises";
}

echo "<br/>--------------------------";

// Mostrar intereses
if($resultado2->num_rows > 0){
    while($fila2 = $resultado2->fetch_array()){
        echo "<br>$fila2[0]";
        echo "<br>$fila2[1]";
        echo "<br>$fila2[2]";  
    };
} else {
    echo "Error en  intereses";
}

//Cierra la conexión
$conexion->close();
?>