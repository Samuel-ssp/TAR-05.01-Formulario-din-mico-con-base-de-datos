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
        $resultado = $controlador->iniciar();
        if ($resultado === "usuarios") {
            $usuarios = $controlador->obtenerUsuarios();
            $vista = $controlador->mostrarUsuarios();
        } else {
            $vista = $resultado;
        }
        break;
    
    case 'registro':
        $intereses= $controlador->obtenerIntereses();
        $paises= $controlador->obtenerPaises();
        $vista = $controlador->mostrarRegistro();
        break;  
    case 'registrar':
        $vista = $controlador->registrar();
        break;
    /// MOSTRAR USUSARIOS
    case 'usuarios':
        $usuarios = $controlador->obtenerUsuarios();
        $vista = $controlador->mostrarUsuarios();
        break;
    /// EDITAR 
    case 'editar':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $usuario = $controlador->obtenerUsuario($id);
        $vista = $controlador->mostrarEditar($id);
        break;
    
    case 'actualizar':
        //Guardar los datos del formulario modificado
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $datos=[
            "id" => $_GET["nombre"],
            "nombre" =>  trim($_GET["nombre"]),
            "email" =>  trim($_GET["email"])
        ];
        //Comprobar que relleno todo los datos
        if($datos["nombre"] == "" || $datos["email"] == ""){
            $error = "Campos sin rellenar";
            $usuario = $controlador->obtenerUsuario($id);
            $vista = $controlador->mostrarEditar($id);
        }else{
            //Actualizar el usuario
            $vista = $controlador->actualizar($datos);
            //Comprobar que se actualizo
            if($vista){
                $mensaje = "Usuario actualizado";
                $usuario = $controlador->obtenerUsuario($id);
                $vista = $controlador->mostrarEditar($id);
            }else{
                $error = "No se pudo modificar";
                $usuario = $controlador->obtenerUsuario($id);
                $vista = $controlador->mostrarEditar($id);
            }
        }
        
        break;
    /// BORRAR
    case 'borrar':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $usuario = $controlador->obtenerUsuario($id);
        $vista = $controlador->mostrarBorrar();
        break; 
    case 'borrado':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $vista = $controlador->borrar($id);
        if($vista === "borrado"){
            $mensaje= "Usuario borrado correctamente";
            $vista = $controlador->mostrarBorrar();
        }
        $mensaje="";
        break; 
    
    default:
        $vista = $controlador->mostrarLogin();
}

// Llamar a la vista
if (isset($vista)) {
    include('vistas/'.$vista);
}
?>