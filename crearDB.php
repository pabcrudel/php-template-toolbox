<?php
// Archivo php para el "administrador" para crear la base de datos necesaria
// y las tablas, con los campos requeridos.

// Datos generales para la aplicacion web:
$servidor="127.0.0.1"; // "localhost"
$usuario_bd="root"; // Usuario Administrador de MySQL
$clave_bd=""; // Clave del Usuario Administrador de MySQL
$basedatos="ejemploDeCreacionBBDD"; // Nombre de la Base de Datos
$tabla1="usuarios"; // Nombre de la tabla 1

$sql_crearbasedatos = "CREATE DATABASE $basedatos";

$sql_creartabla1 = "CREATE TABLE $tabla1(";
$sql_creartabla1.= "usuario CHAR(15) PRIMARY KEY NOT NULL, clave CHAR(15) NOT NULL, tipo CHAR(15) NOT NULL);";

$sql_insertarregistros1 = "INSERT INTO $tabla1 VALUES ";

$sql_insertarregistros1.= "('felipe','feli','usuario'),";
$sql_insertarregistros1.= "('ana','anita','usuario'),";
$sql_insertarregistros1.= "('joan','admin','administrador');";
$sql_insertarregistros1.= "('ejemplo','ejemplo','ejemplo');";

// Inicialmente intentaremos conectar con el servidor MySQL instalado en el servidor web.
$conexion=mysqli_connect($servidor,$usuario_bd,$clave_bd);
if (! $conexion){
	echo "ERROR: Imposible establecer conexion con el servidor (puede que est� desactivado o que no se encuentre en el servidor $servidor).<br>\n";
}
else{
 	// Como pudo conectarse con el servidor, intentaremos crear la base de datos, y despu�s la seleccionaremos para poder trabajar sobre ella.
 	echo "Conexion realizada con el servidor.<br>\n";
	
	// CREAR LA BASE DE DATOS:
	$resultado=mysqli_query($conexion, $sql_crearbasedatos);
	if (! $resultado) {
		echo "ERROR: Imposible crear base de datos $basedatos (puede que ya exista o que no se tenga permiso para crearla).<br>\n";
	}
	else{ 
	 	echo "Base de datos $basedatos creada.<br>\n"; 
	}
	
	// SELECCIONAR LA BASE DE DATOS:
	$resultado=mysqli_select_db($conexion, $basedatos); 
	if (! $resultado){
		echo "ERROR: Imposible seleccionar la base de datos $basedatos (puede que no exista o que no se tenga permiso para usarla).<br>\n";
	}
	else{
	 	// Como pudo seleccionarse la base de datos, entonces intentaremos crear las tablas dentro, junto con registros iniciales para pruebas.
	 	echo "Base de datos $basedatos seleccionada.<br>\n";
		// CREAR TABLA 1:
		$resultado=mysqli_query($conexion, $sql_creartabla1);
		if (! $resultado) {
			echo "ERROR: Imposible crear la tabla $tabla1 (puede que ya exista o que no se tenga permiso para crearla).<br>\n";
		}
		else
		{
			echo "Tabla $tabla1 creada.<br>\n";
		}
		// INSERTAR REGISTROS EN TABLA 1:
		$resultado=mysqli_query($conexion, $sql_insertarregistros1);
		if (! $resultado) {
			echo "ERROR: Imposible insertar registros iniciales en tabla $tabla1 (puede que ya existan esos registros o que no se tengan los permisos).<br>\n";
		}
		else
		{
			echo "Registros iniciales insertados satisfactoriamente en la Tabla $tabla1.<br>\n";
		}
		
					
	}
	// Antes de terminar, debe cerrarse la conexi�n con el servidor (pues sigue abierta)).
	echo "Cerrando la conexion con el servidor...<br>\n";
	mysqli_close($conexion);
}

echo "Fin del programa.<br>\n";
?>
