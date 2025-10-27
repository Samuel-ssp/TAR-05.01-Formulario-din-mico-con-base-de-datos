<?php
class ConexionBD {
    private $servidor = "localhost";
    private $baseDatos = "formulario";

    private $tipoUsuario = [
        'usuario' => ['usuario' => 'usuario', 'clave' => 'contrasenia1'],
        'admin'   => ['usuario' => 'admin', 'clave' => 'contrasenia2']
    ];

    private $conexion;

    // Método interno para crear la conexión
    private function conectar($tipoUsuario) {
        
        $datos = $this->tipoUsuario[$tipoUsuario];
        $this->conexion = new mysqli($this->servidor, $datos['usuario'], $datos['clave'], $this->baseDatos);
        $this->conexion->set_charset("utf8");

        return $this->conexion;
    }

    // Métodos públicos para cada tipo de usuario
    public function usuario() {
        return $this->conectar('usuario');
    }

    public function admin() {
        return $this->conectar('admin');
    }

}

?>
