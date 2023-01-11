<?php
include '/laragon/www/shop/php/restapi/conexion.php';
require_once '/laragon/www/shop/php/restapi/inserta.php';	
require_once '/laragon/www/shop/php/login/validarUser.php';

//Listar registros y consultar registro
if($_SERVER['REQUEST_METHOD'] == 'GET' && basename($_SERVER['PHP_SELF']) == 'validaApi.php'){

    $verificaUser = new verifica();
    $usuario= $_GET['user'];
    $contrasena= $_GET['psw'];

    $verificaUser->verificar($usuario,$contrasena);

    header("HTTP/1.1 200 hay datos");
    exit;				
}
    header("HTTP/1.1 400 Bad Request");
?>