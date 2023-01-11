<?php
include '/laragon/www/shop/php/restapi/conexion.php';
require_once '/laragon/www/shop/php/restapi/inserta.php';	
require_once '/laragon/www/shop/php/login/validarUser.php';

//Listar registros y consultar registro
if($_SERVER['REQUEST_METHOD'] == 'GET' && basename($_SERVER['PHP_SELF']) == 'mostrar.php'){
  if(isset($_GET['id']))
  {
    $sql = $pdo->prepare("SELECT * FROM producto WHERE idProducto=:id");
    $sql->bindValue(':id', $_GET['id']);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 hay datos");
    $datos = json_encode($sql->fetchAll());
    exit;				
  }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && basename($_SERVER['PHP_SELF']) == 'validaApi.php') {
      $verificaUser = new verifica();
      $usuario= $_GET['user'];
      $contrasena= $_GET['psw'];

      $verificaUser->verificar($usuario,$contrasena);
      header("HTTP/1.1 200 hay datos");
      exit;	
    }
    else {
    
    $sql = $pdo->prepare("SELECT * FROM contactos");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 hay datos");
    echo json_encode($sql->fetchAll());
    exit;		
  }
}

//Insertar registro
if($_SERVER['REQUEST_METHOD'] == 'POST' && basename($_SERVER['PHP_SELF']) == 'crearCuenta.php')
{
  $insertamos = new insertar();
  $user=$_POST['nombre'];
  $psw=$_POST['password'];
  $date = date('Y-m-d H:i:s');
  $rol=$_POST['rol'];
  $insertamos->inserta($user,$psw,$date,$rol); 
  header("HTTP/1.1 200 Ok");
  
}

//Actualizar registro
if($_SERVER['REQUEST_METHOD'] == 'PUT' && basename($_SERVER['PHP_SELF']) == 'nombredearchivo')
{		
  $sql = "UPDATE contactos SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':nombre', $_GET['nombre']);
  $stmt->bindValue(':telefono', $_GET['telefono']);
  $stmt->bindValue(':email', $_GET['email']);
  $stmt->bindValue(':id', $_GET['id']);
  $stmt->execute();
  header("HTTP/1.1 200 Ok");
  exit;
}

//Eliminar registro
if($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
  $sql = "DELETE FROM contactos WHERE id=:id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $_GET['id']);
  $stmt->execute();
  header("HTTP/1.1 200 Ok");
  exit;
}

//Si no corresponde a ninguna opción anterior
header("HTTP/1.1 400 Bad Request");
 ?>