<?php 
require_once __DIR__ . "/../modelos/mUsuario.php";


class CUsuario{
    
    public $datos=[];
    private $modelo;

    public function __construct()
    {
        $this->modelo = new MUsuario();
    }

    public function iniciar(){

        if($this->validarInicio()){

            if($this->modelo->iniciar($this->datos)) {
                require_once __DIR__."/../vistas\mostrar.php";
            }else{
                require_once __DIR__."/../vistas/iniciar.html";
            }
            
            
        }else{
            require_once __DIR__."/../vistas/iniciar.html";
        }
        
        

    }

    public function borrar(){
        
    }

    public function editar($id){

        $usuario = $this->modelo->buscarid($id);

    }


    public function registrar(){

        if($this->validarRegistro()){

            if($this->modelo->registrar($this->datos)) {
                require_once __DIR__."/../vistas/mostrar.php";
            }else{
                require_once __DIR__."/../vistas/formulario.php";
            }

        }
        
        
    }

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
                

        // Validar campos obligatorios
        if ( $this->datos["nombre"] == '') {
            echo '<h1><a href="../vistas/formulario.php">Volver al formulario</a></h1>';
            exit("No se rellenó el campo nombre");
        }
        if ($this->datos["email"] == '') {
            echo '<h1><a href="../vistas/formulario.php">Volver al formulario</a></h1>';
            exit("No se rellenó el campo email");
        }
        if (empty($this->datos["intereses"])) {
            echo '<h1><a href="../vistas/formulario.php">Volver al formulario</a></h1>';
            exit("No tienes intereses seleccionados");
        }
        if ($this->datos["pais"] == '') {
            echo '<h1><a href="../vista/formulario.php">Volver al formulario</a></h1>';
            exit("No se seleccionó país");
        }

        return true;
    }

    private function validarInicio(){

        $this->datos = [
            'nombre' => isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '',
            'email' => isset($_POST["email"]) ? trim($_POST["email"]) : '',
        ];

        if ( $this->datos["nombre"] == '') {
            echo '<h1><a href="../vistas/formulario.php">Volver al formulario</a></h1>';
            exit("No se rellenó el campo nombre");
        }
        if ($this->datos["email"] == '') {
            echo '<h1><a href="../vistas/formulario.php">Volver al formulario</a></h1>';
            exit("No se rellenó el campo email");
        }

        return true;

    }


    
}

//Inicar el controlador

$controlador = new CUsuario();
$accion = $_GET["accion"] ?? '';

switch ($accion) {
    case 'iniciar':
        $controlador->iniciar();
        break;
    case 'borrar':
        $controlador->borrar();
        break;
    case 'editar':
        $controlador->editar($id);
        break;
    case 'registrar':
        $controlador->registrar();
        break;
    case 'mostrar':
        
    default:
        echo "Acción no válida";
        break;
}