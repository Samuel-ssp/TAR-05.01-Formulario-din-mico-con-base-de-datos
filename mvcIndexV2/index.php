
<?php
require_once __DIR__ .'/config/indexConfig.php';

    //CONTROLADOR POR DEFECTO
    if (!isset($_GET['c'])) {
        $_GET['c'] = DEFC;
    }
    //METODO POR DEFECTO 
    if (!isset($_GET['m'])) {
        $_GET['m'] = DEFM;
    }

    //CREO LA RUTA DLE CONTROLADOR 
    $controladorRuta = '/' . RC .'c'.$_GET['c'] . '.php';

    require_once $controladorRuta;

    //INTANCIO EL CONTROLADOR CON LA RUTA CREADA Y EL NOMBRE CREADO
    $nombreControlador = 'C'.$_GET['c'];
    $instanciarControlador = new $nombreControlador();

    $metodo = $_GET['m'];
    $datos = [];

    //SI EXISTE EL CONTROLADOR GUARDO LOS DATOS QUE DEVUELVE
    if (method_exists($instanciarControlador, $metodo)) {

        $datos = $instanciaControlador->$metodo();
        
    }
    //LLAMADO A LA VISTA GUARDADA EN EL CONTROLADOR CON LA RUTA GUARDADA
    include(RV . $instanciarControlador->vista . '.php');
    
?>