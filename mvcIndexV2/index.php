<?php
require_once __DIR__ .'/confi/rutas.php';

    //CONTROLADOR POR DEFECTO
    if (!isset($_GET['c'])) {
        $_GET['c'] = DEFC;
    }
    //METODO POR DEFECTO 
    if (!isset($_GET['m'])) {
        $_GET['m'] = DEFM;
    }

    //CREO LA RUTA DLE CONTROLADOR 
    $controladorRuta = __DIR__.'/'. RC .'c'.$_GET['c'] . '.php';

    require_once ($controladorRuta);

    //INTANCIO EL CONTROLADOR CON LA RUTA CREADA Y EL NOMBRE CREADO
    $nombreControlador = 'C'.$_GET['c'];
    $Controlador = new $nombreControlador();

    $metodo = $_GET['m'];
    $datos = [];

    //SI EXISTE EL CONTROLADOR GUARDO LOS DATOS QUE DEVUELVE
    if (method_exists($Controlador, $metodo)) {

        $datos = $Controlador->$metodo();
        
    }
    //LLAMADO A LA VISTA GUARDADA EN EL CONTROLADOR CON LA RUTA GUARDADA
    include( __DIR__.'/'.RV . $Controlador->vista);
    
?>