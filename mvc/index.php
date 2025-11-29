<?php
// Crear una sesion
session_start();


// Si no existe peticion redirigin a login
$peticion = isset($_GET['accion']) ? $_GET['accion'] : 'login';


// Instanciar controlador
require_once('controladores/cUsuario.php');
$controlador = new CUsuario();


// Opciones usuario
switch($peticion) {
    
    case 'login':
        $vista = $controlador->mostrarLogin();
        break;
    case 'iniciar':
        $vista = $controlador->iniciar();
        break;
    
     case 'registro':
        $intereses= $controlador->obtenerIntereses();
        $paises= $controlador->obtenerPaises();
        $vista = $controlador->mostrarRegistro();
        break;  
    case 'registrar':
        $vista = $controlador->registrar();
        break;
    
    case 'usuarios':
        $vista = $controlador->listar();
        break;
    
    case 'editar':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $vista = $controlador->mostrarEditar($id);
        break;
    
    case 'actualizar':
        $vista = $controlador->actualizar();
        break;
    
    case 'borrar':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $vista = $controlador->mostrarBorrar($id);
        break; 
    
    default:
        $vista = $controlador->mostrarLogin();
}

// Llamar a la vista
if (isset($vista)) {
    include('vistas/'.$vista);
}
?>