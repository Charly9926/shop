<?php
include '/laragon/www/shop/php/restapi/conexion.php';
	
$pdo = new Conexion();

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
    
    } else {
    
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
  $sql = "INSERT INTO usuario (usuario, psw, fecha, rol) VALUES(:usuario, :psw, :fecha, :rol)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':usuario', $_POST['nombre']);
  $stmt->bindValue(':psw', $_POST['password']);
  $stmt->bindValue(':fecha', $date = date('Y-m-d H:i:s'));
  $stmt->bindValue(':rol', $_POST['rol']);
  $stmt->execute();
  $idPost = $pdo->lastInsertId(); 
  if($idPost)
  {
    header("HTTP/1.1 200 Ok");
    echo json_encode($idPost);
    header('Location: /alerts/ale_crearCuenta.html');
    exit;
  }
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