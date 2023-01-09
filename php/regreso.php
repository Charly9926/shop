<?php 
session_start();
$_SESSION["rol"];

if ($_SESSION["rol"] == "vendedor") {
    header("location: /php/vendedor.php");
}
else {
    header("location: /php/supervisor.php");
}

?>