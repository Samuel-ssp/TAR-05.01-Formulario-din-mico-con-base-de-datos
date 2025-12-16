<?php 
require_once __DIR__ . "/../modelos/mUsuario.php";

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
        $metodo =  $_POST["metodo"];
        if($this->validar()){

            if($metodo === "query"){
                
                $resultado = $this->modelo->iniciarQuery();
            }else{
                $resultado = $this->modelo->iniciarPrepare();
            }

            if($resultado) {

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
    
    //////////////////////////////////////////////////MOSTRAR REGISTRAR
    public function mostrarRegistro(){
        $this->vista =  "formulario.php";        
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
                }

            } else {
                $this->vista = "formulario.php";
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