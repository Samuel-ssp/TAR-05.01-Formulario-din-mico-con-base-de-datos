<?php
include 'configdb.php';
include 'conexion.php';

// Recoge los datos del formulario
$nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '';
$email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
$genero = isset($_POST["genero"]) ? $_POST["genero"] : '';
$pais = isset($_POST["pais"]) ? $_POST["pais"] : '';
$nacimiento = isset($_POST["nacimiento"]) ? $_POST["nacimiento"] : '';
$condiciones = isset($_POST["condiciones"]) ? $_POST["condiciones"] : '';
$intereses = isset($_POST["intereses"]) ? $_POST["intereses"] : [];

// Si falta algún campo obligatorio, vuelve al formulario
if ($nombre == '' || $email == '') {
    /* header("Location: formulario.php"); */
    echo '<h1><a href="formulario.php"> Falta nombre o email </a></h1>';
    exit();
}

// Inserta el usuario
$sqlUsuario = "INSERT INTO usuarios (nombre, email, genero, idpais, nacimiento) 
    VALUES ('$nombre', '$email', '$genero', '$pais', '$nacimiento')";


//Comprobar registro
if ($conexion->query($sqlUsuario)) {
    echo 'Usuario '. $nombre .' registrado <br>';
} else {
    echo "Error con el usuario: " . $conexion->error ;
};

// Guardar id ultimo usuario
$usuario_id = $conexion->insert_id;

empty($_POST["intereses"]) ? print_r("No tiene intereses") : print_r($_POST["intereses"]);

if(!empty($intereses)){
    
    foreach ($intereses as $idInteres) {
    $sqlInteres = "INSERT INTO usuario_intereses (usuario_id, interes_id) 
        VALUES ('$usuario_id', '$idInteres')";
        if($conexion->query($sqlInteres)){
            echo 'Interes '.$idinteres.' se registro correctamente';
        } else{
            echo "Error en intereses: ".$conexion->error;
        }
    }
}





// Cierra la conexión
$conexion->close();

// Mensaje de confirmación
?>
