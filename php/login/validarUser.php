<?php 
require_once '/laragon/www/shop/php/restapi/conexion.php';
session_start();

$_SESSION["rol"] = "";

class verifica extends Conexion{
    private $miconexion;

    public function __construct(){
        $this->miconexion = new Conexion();
        $this->miconexion = $this->miconexion->AbrirConexion();
    }

    public function verificar(String $usuario, String $contrasena){

        $sql = "SELECT*FROM usuario WHERE usuario= :usuario AND psw = :contrasena AND rol = 'vendedor'";
        $sql2 = "SELECT*FROM usuario WHERE usuario= :usuario AND psw = :contrasena AND rol = 'supervisor'";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->bindValue(':usuario', $usuario);
        $consulta->bindValue(':contrasena', $contrasena);
        $consulta->execute();

        $consulta2 = $this->miconexion->prepare($sql2);
        $consulta2->bindValue(':usuario', $usuario);
        $consulta2->bindValue(':contrasena', $contrasena);
        $consulta2->execute();

        //echo "Es vendedor ",$consulta->rowCount();
        //echo "Es supervisor ",$consulta2->rowCount();

        if ($consulta->rowCount() > 0) {
            $_SESSION["rol"]="vendedor";  
            header("location:../vendedor.php");
            exit;
        }
        elseif ($consulta2->rowCount()) {
            $_SESSION["rol"]="supervisor";
            header("location:../supervisor.php");
            exit;
        }
        else{
            session_unset();
            session_destroy();
            header("location: /alerts/ale_errorlogin.html");
            exit;
        }

        return 0;
    }


}
?>