<?php 
require_once __DIR__ . "/../modelos/mUsuario.php";
require_once __DIR__."/../modelos/inputs.php";

class CUsuario{
    
    public $datos=[];
    private $modelo;
    private $inputs;

    public function __construct()
    {
        $this->modelo = new MUsuario();
        $this->inputs = new Input();
    }

    //////////////////////////////////////////MOSTRAR LOGIN
    public function mostrarLogin(){
        return "iniciar.php";
    }
    //INICIAR SESION
    public function iniciar(){

        if($this->validarInicio()){

            $resultado = $this->modelo->iniciar($this->datos);
            
            if($resultado) {

                $_SESSION['usuario_id'] = $resultado['id']; 
                return "usuarios";
            } else {
                $_SESSION['error'] = "Email o contraseña incorrectos";
                return "iniciar.php";
            }  
        
        } else {

            return "iniciar.php";
        }
    }

    ////////////////////////////////////////////////MOSTRAR LISTAR
    public function mostrarUsuarios(){
        return "mostrar.php";
    }

    public function obtenerUsuarios(){
        //Devuelvo el array de usuarios
        return  $this->modelo->obtenerUsuarios();  
    }
    
    ////////////////////////////////////////////////MOSTRAR BORRAR
    public function mostrarBorrar(){
        return "borrar_usuario.php";
    }

    public function borrar($id){
        $borrado = $this->modelo->borrar($id);
        if($borrado){
            return "borrado";
        }else{
            return "borrar_usuario.php";
        }
    }

    //////////////////OBTENER USUSARIOS
    public function obtenerUsuario($id){
        return $this->modelo->buscarId($id);
    }
    ////////////////////////////////////////////////MOSTRAR EDITAR
    public function mostrarEditar(){
        return "editar_usuario.php";
    }

    public function actualizar(){
        
    }

    //////////////////////////////////////////////////MOSTRAR REGISTRAR
    public function mostrarRegistro(){  
        return  "formulario.php";
          
    }
    //MONSTRAR PAISES
    public function obtenerPaises(){
        return $this->inputs->selectPaises();
        

    }
    //MOSTRAR INTERESES
    public function obtenerIntereses(){
        return  $this->inputs->checkIntereses();
    }
    //REGISTRAR USUARIO
    public function registrar(){

        if($this->validarRegistro()){

            if($this->modelo->registrar($this->datos)) {
                    return "mostrar.php";  
                }else{
                    $_SESSION['error'] = "Fallo en el registro";
                    return "formulario.php?accion=registro"; 
                }

            } else {
                return "formulario.php";
            }
        }
    ////////////////////////////////////////////VALIDACIONES
    private function validarRegistro(){
        
        // Asignar valores a las propiedades
        $this->datos = [
            'nombre' => isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '',
            'email' => isset($_POST["email"]) ? trim($_POST["email"]) : '',
            'genero' => isset($_POST["genero"]) ? $_POST["genero"] : '',
            'pais' => isset($_POST["pais"]) ? $_POST["pais"] : '',
            'nacimiento' => isset($_POST["nacimiento"]) ? $_POST["nacimiento"] : '',
            'intereses' => isset($_POST["intereses"]) ? $_POST["intereses"] : []
        ];
        
        //Guardar el error
        if ($this->datos["nombre"] == '') {
             $_SESSION['error'] = "Nombre no rellenado"; 
            return false;
        }
        if ($this->datos["email"] == '') {
             $_SESSION['error'] = "Email no rellenado"; 
            return false;
        }
        if (empty($this->datos["intereses"])) {
             $_SESSION['error'] = "No has rellenado ningun campo en intereses";  
            return false;
        }
        if ($this->datos["pais"] == '') {
             $_SESSION['error'] = "Ningun pais seleccionado";  
            return false;
        }

        return true;
    }

    private function validarInicio(){

        $this->datos = [
            'nombre' => isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '',
            'email' => isset($_POST["email"]) ? trim($_POST["email"]) : '',
        ];

        //Guardar el error
        if ($this->datos["nombre"] == '') {
             $_SESSION['error'] = "Nombre no rellenado"; 
            return false;
        }
        if ($this->datos["email"] == '') {
             $_SESSION['error'] = "Email no rellenado"; 
            return false;
        }

        return true;
    }


    
}