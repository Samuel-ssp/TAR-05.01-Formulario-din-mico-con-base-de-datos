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
echo "<br>Mostrar contenido paises<br>";
// Mostrar países
/* if($resultado->num_rows > 0){
    while($fila = $resultado->fetch_array()){
        echo "<br>$fila[0]";
        echo "<br>$fila[1]";
        echo "<br>$fila[2]";  
    };
} else {
    echo "Error en  paises";
} */

echo "<br/>--------------------------";
echo "Mostrar contenido intereses<br>";
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

echo "<br>MOSTRAR SOLO UNA FILA<br>";

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_array(); //Comprobacion que con fetch_array guarda tanto el indice numerico como el relacional
    foreach ($fila as $indice => $valor) {
        echo $indice . '<br>';
        echo "---<br>";
    }
}


//Cierra la conexión
$conexion->close();

?>