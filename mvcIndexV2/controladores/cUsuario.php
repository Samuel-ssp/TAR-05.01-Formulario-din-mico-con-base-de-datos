<?php 
require_once __DIR__ . "/../modelos/mUsuario.php";
require_once __DIR__."/../modelos/mPaises.php";

class CUsuario{
    
    public $datos=[];
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

            $resultado = $this->modelo->iniciar($this->datos);
            
            if($resultado) {

                $_SESSION['usuario_id'] = $resultado['id']; 
                $this->vista = "usuarios";
            } else {
                $_SESSION['error'] = "Email o contraseña incorrectos";
                $this->vista = "iniciar.php";
            }  
        
        } else {

            $this->vista = "iniciar.php";
        }
    }

    ////////////////////////////////////////////////MOSTRAR LISTAR
    public function mostrarUsuarios(){
        $this->vista = "mostrar.php";
    }

    public function obtenerUsuarios(){
        //Devuelvo el array de usuarios
        return  $this->modelo->obtenerUsuarios();  
    }
    
    ////////////////////////////////////////////////MOSTRAR BORRAR
    public function mostrarBorrar(){
        $this->vista = "borrar_usuario.php";
    }

    public function borrar($id){
        $borrado = $this->modelo->borrar($id);
        if($borrado){
            return "borrado";
        }else{
            $this->vista = "borrar_usuario.php";
        }
    }

    //////////////////OBTENER USUSARIOS
    public function obtenerUsuario($id){
        return $this->modelo->buscarId($id);
    }
    ////////////////////////////////////////////////MOSTRAR EDITAR
    public function mostrarEditar(){
        $this->vista = "editar_usuario.php";
    }

    public function actualizar($datos){
        return $this->modelo->actualizar($datos);
    }

    //////////////////////////////////////////////////MOSTRAR REGISTRAR
    public function mostrarRegistro(){
        $this->vista =  "formulario.php";
        return  $paises = MPaises::selectPaises();
        
    }
    
    //REGISTRAR USUARIO
    public function registrar(){

        if($this->validar()){

            if($this->modelo->registrar($this->datos)) {
                    $this->vista = "mostrar.php";  
                }else{
                    $_SESSION['error'] = "Fallo en el registro";
                    $this->vista = "formulario.php"; 
                }

            } else {
                $this->vista = "formulario.php";
            }
        }
    ////////////////////////////////////////////VALIDACIONES
    
    private function validar(){

        $this->datos = [
            'nombre' => isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '',
            'email' => isset($_POST["pw"]) ? trim($_POST["email"]) : '',
        ];

        //Guardar el error
        if ($this->datos["nombre"] == '') {
             $_SESSION['error'] = "Nombre no rellenado"; 
            return false;
        }
        if ($this->datos["pw"] == '') {
             $_SESSION['error'] = "Contraseña sin rellenar"; 
            return false;
        }

        return true;
    }


    
}