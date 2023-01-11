<?php
require_once '/laragon/www/shop/php/restapi/inserta.php';	
require_once '/laragon/www/shop/php/login/validarUser.php';
require_once '/laragon/www/shop/php/restapi/listar.php';

//Listar registros y consultar registro
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  if(isset($_GET['id']))
  {
    $id = $_GET["id"];

      $consultaid = new listar();
      echo $consultaid->listaID($id);				
  }
  else {
    
      $consultartodos = new listar();
      echo $consultartodos->listartodos();	
  }
  header("HTTP/1.1 200 0k");
  exit;
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