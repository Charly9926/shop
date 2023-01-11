<?php
    require_once '/laragon/www/shop/php/restapi/conexion.php';

    class listar extends conexion{
        private $miconexion;

        public function __construct(){
            $this->miconexion = new conexion();
            $this->miconexion = $this->miconexion->AbrirConexion();
        }

        public function listartodos(){
            $sql = "SELECT * FROM producto";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->execute();
            $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($registro);
        }

        public function listaID(int $id){
            $sql = "SELECT * FROM producto WHERE idProducto=:id";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->BindValue(":id", $id);
            $consulta->execute();
            $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($registro);
        }
    }
?>