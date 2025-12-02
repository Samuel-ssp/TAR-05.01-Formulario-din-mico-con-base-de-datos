<?php
require_once __DIR__."/../modelos/mPaises.php";

class CPaises{

    private $paises;
    public function __construct()
    {
        $this->paises = new MPaises();
    }

    //MONSTRAR PAISES
    public function obtenerPaises(){
        return $this->paises->selectPaises();
    }
}
