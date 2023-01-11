<?php
    require_once('/laragon/www/shop/php/restapi/conexion.php');

    class insertar extends conexion{
        private $miconexion;

        public function __construct(){
            $this->miconexion = new conexion();
            $this->miconexion = $this->miconexion->AbrirConexion();
        }

        public function inserta(String $user, String $psw, String $date, String $rol){
            
            
            $sql = "INSERT INTO usuario (usuario, psw, fecha, rol) VALUES(:usuario, :psw, :fecha, :rol)";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->bindValue(':usuario', $user);
            $consulta->bindValue(':psw', $psw);
            $consulta->bindValue(':fecha', $date);
            $consulta->bindValue(':rol', $rol);
            $resultado = $consulta->execute();
            
            echo "muestra resultado $resultado";
            if($resultado == 1)
            {
               
                header('Location: /alerts/ale_crearCuenta.html');
                exit;
            }
            return json_encode($resultado);
        }
    }
?>