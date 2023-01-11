<?php
    require_once('autoload.php');

    class actualizar extends conexion{
        private $miconexion;

        public function __construct(){
            $this->miconexion = new conexion();
            $this->miconexion = $this->miconexion->AbrirConexion();
        }

        public function actualiza(int $id, String $nombre, int $edad, String $correo){
            
            $sql = "UPDATE datos SET nombre= :nombre, edad= :edad, correo= :correo WHERE id = :id";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->BindValue(":id",$id);
            $consulta->BindValue(":nombre",$nombre);
            $consulta->BindValue(":edad",$edad);
            $consulta->BindValue(":correo",$correo);
            $resultado = $consulta->execute();
            return json_encode($resultado);
        }
    }
?>