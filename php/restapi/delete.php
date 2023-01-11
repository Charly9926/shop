<?php
    require_once('autoload.php');

    class eliminar extends conexion{
        private $miconexion;

        public function __construct(){
            $this->miconexion = new conexion();
            $this->miconexion = $this->miconexion->AbrirConexion();
        }

        public function delete(int $id){
            
            $sql = "DELETE FROM datos WHERE id = :id";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->BindValue(":id",$id);
            $resultado = $consulta->execute();
            return json_encode($resultado);
        }
    }
?>