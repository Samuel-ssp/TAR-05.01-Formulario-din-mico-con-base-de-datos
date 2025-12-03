<?php 
require_once __DIR__ . "/../modelos/mUsuario.php";
require_once __DIR__."/../modelos/mPaises.php";

class CUsuario{
    
    private $modelo;
    public $vista;

    public function __construct()
    {
        $this->modelo = new MUsuario();
    }

    //////////////////////////////////////////MOSTRAR LOGIN
    public function login(){
        $this->vista = "iniciar.php";
    }
    //INICIAR SESION
    public function iniciarSesion(){

        if($this->validar()){

            $resultado = $this->modelo->iniciar();
            
            if($resultado) {

                //GUARDAR ERROR
                $this->vista = "mostrar.php";
                return $this->modelo->obtenerUsuarios();
            } else {
                //GUARDAR ERROR
                $this->vista = "iniciar.php";
            }  
        
        } else {

            $this->vista = "iniciar.php";
        }
    }

    ////////////////////////////////////////////////MOSTRAR LISTAR
    public function mostrarUsuarios(){
        $this->vista = "mostrar.php";
        return  $this->modelo->obtenerUsuarios();  
    }

    public function obtenerUsuarios(){
        //Devuelvo el array de usuarios
        return  $this->modelo->obtenerUsuarios();  
    }
    
    ////////////////////////////////////////////////MOSTRAR BORRAR
    public function mostrarBorrar(){
        $this->vista = "borrar_usuario.php";
        return $this->modelo->buscarId();
    }

    public function borrar(){
        $borrado = $this->modelo->borrar();
        if($borrado){
            $this->vista = "mostrar.php";
            return  $this->modelo->obtenerUsuarios();  
        }else{
            $this->vista = "borrar_usuario.php";
            return $this->modelo->buscarId();
        }
    }

    ////////////////////////////////////////////////MOSTRAR EDITAR
    public function mostrarEditar(){
        $this->vista = "editar_usuario.php";
        return $this->modelo->buscarId();
    }

    public function actualizar(){ 
        $this->vista = "editar_usuario.php";
        return $this->modelo->actualizar();
    }

    //////////////////////////////////////////////////MOSTRAR REGISTRAR
    public function mostrarRegistro(){
        $this->vista =  "formulario.php";
        return  $paises = MPaises::selectPaises();
        
    }
    
    //REGISTRAR USUARIO
    public function registrar(){

        if($this->validar()){

            if($this->modelo->registrar()) {
                    $this->vista = "mostrar.php";
                    return  $this->modelo->obtenerUsuarios();   
                }else{
                    //GUARDAR ERROR
                    $this->vista = "formulario.php";
                    return  $paises = MPaises::selectPaises(); 
                }

            } else {
                $this->vista = "formulario.php";
                return  $paises = MPaises::selectPaises();
            }
        }
    ////////////////////////////////////////////VALIDACIONES
    
    private function validar(){

        
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '';
        $pw = isset($_POST["pw"]) ? trim($_POST["pw"]) : '';

        //Guardar el error
        if ($nombre == '') {
             //GUARDAR ERROR
            return false;
        }
        if ($pw == '') {
             //GUARDAR ERROR 
            return false;
        }

        return true;
    }


    
}