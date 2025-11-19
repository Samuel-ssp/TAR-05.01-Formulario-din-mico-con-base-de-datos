<?php 
require_once("usuario.php");

$usuario = new Usuario();

//Comprobar datos

if($usuario->comprobar()){

    $id = $usuario->registrar();
    header('Location:mostrar.php');
    
} 