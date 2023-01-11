<?php
    require_once('autoload.php');

    class listar extends conexion{
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

        public function listaID(int $id){
            $sql = "SELECT * FROM datos where id = :id";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->BindValue(":id", $id);
            $consulta->execute();
            $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($registro);
        }
    }
?>