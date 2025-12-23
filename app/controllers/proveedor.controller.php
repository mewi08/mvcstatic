<?php

require_once '../models/Proveedor.php';
$proveedor = new Proveedor();

if (isset($_POST['operacion'])) {

  //El usuario nos envío una tarea...
  switch ($_POST['operacion']) {
    case 'listar':
      $registros = $proveedor ->listar();
      echo json_encode($registros);
      break;

    case 'registrar':
      //Algoritmo
      break;
    case 'actualizar':
      //Algoritmo
      break;
    case 'eliminar':
      //Algoritmo  
      break;
  }

}
