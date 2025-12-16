<?php
require_once __DIR__ .'/confi/rutas.php';

    //CONTROLADOR POR DEFECTO
    if (!isset($_GET['c'])) {
        $_GET['c'] = CONTROLADORXDEFCTO;
    }
    //METODO POR DEFECTO 
    if (!isset($_GET['m'])) {
        $_GET['m'] = METODOXDEFECTO;
    }

    //CREO LA RUTA DLE CONTROLADOR 
    $controladorRuta = __DIR__.'/'. RUTACONTROLADOR .'c'.$_GET['c'] . '.php';

    require_once ($controladorRuta);

    //INTANCIO EL CONTROLADOR CON LA RUTA CREADA Y EL NOMBRE CREADO
    $nombreControlador = 'C'.$_GET['c'];
    $Controlador = new $nombreControlador();

    $metodo = $_GET['m'];
    $datos = [];

    //SI EXISTE EL CONTROLADOR GUARDO LOS DATOS QUE DEVUELVE
    if (method_exists($Controlador, $metodo)) {

        $datos = $Controlador->{$metodo}();
        
    }
    //Se incluye la vista que se ha dado valor a la propiedad en el controlador

    var_dump($vista=__DIR__.'/'.RUTAVISTAS . $Controlador->vista);
    include( __DIR__.'/'.RUTAVISTAS . $Controlador->vista);
    
?>