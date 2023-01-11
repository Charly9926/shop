<?php
require_once('autoload.php');

        class Mostrar extends conexion{
        private $miconexion;

        public function __construct(){
            $this->miconexion = new conexion();
            $this->miconexion = $this->miconexion->AbrirConexion();
        }

        public function listartodos(){
            $sql = "SELECT * FROM datos";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->execute();
            $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($registro);
        }
    }


    $consultartodos = new Mostrar();
    $datos1 = json_decode($consultartodos->listartodos());
    echo "<br><br>";
    ?>
