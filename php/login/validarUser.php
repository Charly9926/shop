<?php 
include '../restapi/conexion.php';
$pdo = new Conexion();
session_start();
$usuario= $_POST['user'];
$contrasena= $_POST['psw'];
$_SESSION["rol"];

$sql_vendedor = $pdo->prepare("SELECT*FROM usuario WHERE usuario='$usuario' AND psw='$contrasena' AND rol='vendedor'");
$sql_supervisor = $pdo->prepare("SELECT*FROM usuario WHERE usuario='$usuario' AND psw='$contrasena' AND rol='supervisor'");
$sql_vendedor->execute();
$sql_supervisor->execute();
    if ($sql_vendedor->rowCount() > 0) {
        header("location:../vendedor.php");
        $_SESSION["rol"]="vendedor"; 
    }
    elseif ($sql_supervisor->rowCount()){
        header("location:../supervisor.php");
        $_SESSION["rol"]="supervisor";
    }
    else{
        session_unset();
        session_destroy();
        header("location: /alerts/ale_errorlogin.html");
       
    }
?>