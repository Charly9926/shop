// obtiene la cadena de caracteres con los datos en formato JSON
var datos = '<?php $datos; ?>';

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