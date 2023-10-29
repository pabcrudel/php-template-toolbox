<?php
$servidor="127.0.0.1"; // "localhost"
$usuario_bd="root"; // Usuario Administrador de MySQL
$clave_bd=""; // Clave del Usuario Administrador de MySQL
$basedatos="ejemploDeCreacionBBDD"; // Nombre de la Base de Datos

$sql_borrar="DROP DATABASE $basedatos";

$conexion=mysqli_connect($servidor,$usuario_bd,$clave_bd);
if (!$conexion){
  echo "ERROR: Imposible establecer conexion con el servidor (puede que este desactivado o que no se encuentre en el servidor $servidor).<br>\n";
}
else{
  // Como pudo conectarse con el servidor, intentaremos borrar la base de datos, y despu�s la seleccionaremos para poder trabajar sobre ella.
  echo "Conexion realizada con el servidor.<br>\n";
  
  // BORRAR LA BASE DE DATOS:
  $resultado=mysqli_query($conexion, $sql_borrar);
  if (!$resultado) {
    echo "ERROR: Imposible borrar base de datos $basedatos (puede que no exista o que no se tengas permiso para borrarla).<br>\n";
  }
  else{
    echo "Base de datos $basedatos borrada.<br>\n";
  }
	echo "Cerrando la conexion con el servidor...<br>\n";
	mysqli_close($conexion);
}

echo "Fin del programa.<br>\n";
?>