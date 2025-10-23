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

// Comprobacion de nombre o email relleno
if ($nombre == '' || $email == '' || empty($_POST["intereses"])) {
    /* NOMBRE y EMAIL VACIO */
    if ($nombre == '' && $email == ''){
        echo '<h1><a href="formulario.php"> Volver al formulario </a></h1>';
        exit("No se relleno el campo nombre ni email");
    };
    /* NOMBRE VACIO */
    if ($nombre == '') {
    echo '<h1><a href="formulario.php"> Volver al formulario </a></h1>';
    exit("No se relleno el campo nombre");
    };
    /* EMAIL VACIO */
    if ($email == '') {
        echo '<h1><a href="formulario.php"> Volver al formulario </a></h1>';
        exit("No se relleno  el campo email");
    };
    /* 
    //Comprobacion si tiene intereses seleccionados
    if(empty($_POST["intereses"])){
        echo '<h1><a href="formulario.php"> Volver al formulario </a></h1>';
            exit("<h1>No tienes intereses seleccionados</h1>");
    }; 
*/
};

//Comprobacion de CLAVE SECUNDARIA UNICA email


// Inserta el usuario
$sqlUsuario = "INSERT INTO usuarios (nombre, email, genero, idpais, nacimiento) 
    VALUES ('$nombre', '$email', '$genero', '$pais', '$nacimiento')";


//Comprobar registro
if ($conexion->query($sqlUsuario)) {
    echo 'Usuario '. $nombre .' registrado <br>';
    // Guardar id ultimo usuario
    $usuario_id = $conexion->insert_id;

    //Comprobar si existen intereses
    empty($_POST["intereses"]) ? print_r("No tiene intereses") : print_r($_POST["intereses"]);

    if(!empty($intereses)){
        
        foreach ($intereses as $idInteres) {
        $sqlInteres = "INSERT INTO usuario_intereses (usuario_id, interes_id) 
            VALUES ('$usuario_id', '$idInteres')";
            //Comprobacion si se guardo correctamente
            if($conexion->query($sqlInteres)){
                echo 'Interes '.$idInteres.' se registro correctamente'.'<br>';
            } else{
                echo "Error en intereses: ".$conexion->error;
            }
        }
    }
} else {
    echo "Error con el usuario: " . $conexion->error ;
};

// Cierra la conexión
$conexion->close();