<?php
include '/laragon/www/shop/php/restapi/conexion.php';
	
$pdo = new Conexion();

$id = $_GET["id"];
$cantidad = $_GET["cantidad"];

if($_SERVER['REQUEST_METHOD'] == 'GET' && basename($_SERVER['PHP_SELF']) == 'mostrar.php'){
$sql = $pdo->prepare("SELECT * FROM producto WHERE idProducto=:id");
    $sql->bindValue(':id', $_GET['id']);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 hay datos");
    $datos = json_encode($sql->fetchAll());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Press Start 2P' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Mostrar Compra</title>
</head>
<body>
<table id="mi-tabla" class="table">

</table>

<div class="container pt-5">
          <div class="mb-5 is-vcentered columns is-multiline">
            <div class="column is-12 is-5-desktop mb-5 mr-auto">
              <h2 class="mb-6 is-size-1 is-size-3-mobile has-text-weight-bold" data-config-id="header">Finaliza tu compra.</h2>
              <p class="subtitle has-text-grey mb-6" data-config-id="desc">AYN ODIN</p>
              <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a >Cantidad: <?php echo $cantidad ?></a></li>
                    <li id="nombreProducto">  </li>
                    <li id="existencia">  </li>
                    <li class="is-active"><a href="#" aria-current="page">Breadcrumb</a></li>
                </ul>
                </nav>
              <div class="buttons"><a class="button is-primary" href="#" data-config-id="hero-primary-action">Finalizar compra</a>
            </div>
            </div>
            <div class="column is-12 is-6-desktop">
              <img class="image is-fullwidth" src="/img/aynodin.png" alt="" data-config-id="image">
            </div>
          </div>
          <div class="is-block-desktop is-hidden-touch has-text-centered">

          </div>
        </div>

</body>
<script>
        // obtiene la cadena de caracteres con los datos en formato JSON
        let datos = '<?php echo $datos; ?>';
        console.log(datos)
        // convierte la cadena a un objeto JavaScript
        datos = JSON.parse(datos);

        // obtener la tabla
        var tabla = document.getElementById('mi-tabla');

        // iterar sobre los datos
        datos.forEach(function(dato) {
        // crear una fila
        var fila = document.createElement('tr');
        
        // iterar sobre las propiedades del objeto
        for (var propiedad in dato) {
            // crear una celda
            var celda = document.createElement('td');
            
            // establecer el contenido de la celda
            celda.textContent = dato[propiedad];
            
            // agregar la celda a la fila
            fila.appendChild(celda);
        }
        
        // agregar la fila a la tabla
        tabla.appendChild(fila);
        });
        
        let nombrePro = datos[0]['nombreProducto'];
        let existencia = datos[0]['existenciasxCaja'];
        document.getElementById('nombreProducto').innerHTML = "Nombre del Producto: "+nombrePro;
        document.getElementById('existencia').innerHTML = "Disponibles: "+existencia;
    </script>
</html>