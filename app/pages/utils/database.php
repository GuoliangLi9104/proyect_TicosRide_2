<?php

function get_pdo_connection(){
  $server = "localhost";
  $user = "root";
  $pass = "";
  $db = "proyect_ticos_rides";
  $mysqli = new mysqli($server, $user, $pass, $db);
  return $mysqli;
}


//Se verifica que esté conectado
/*$conexion = get_mysql_connection();

if ($conexion->connect_errno) {
  die("Conexion fallida: " . $conexion->connect_errno);
} else {
  echo "Conectado";
}*/

?>