<?php
session_start();

if (isset($_POST['usuario']) && isset($_POST['clave'])) { 
	
    //es $_POST es porque el formulario de inicioSesion.html es metodo POST. Deben ser iguales
	$_SESSION['usuario']=$_POST['usuario']; 
	$_SESSION['clave']=$_POST['clave'];
	$_SESSION['tipo']='invitado';
	

    //Datos para la conexion con la BBDD
    $servidor="127.0.0.1"; // "localhost"
    $usuario_bd="root"; // Usuario Administrador de MySQL
    $clave_bd=""; // Clave del Usuario Administrador de MySQL
    $basedatos="ejemploDeCreacionBBDD";

    //Nombre de la tabla
    $tabla="usuarios";
	
    //selección del usuario que se llame como el que ha hecho input en inicioSesion.html
	$sql = "SELECT * FROM $tabla WHERE (usuario='".$_SESSION['usuario']."'";
    //lo mismo con la clave y se concatena a variable $sql con .
	$sql.= " and clave='".$_SESSION['clave']."');";

    //se realiza la conexion a la BBDD con los datos de las lineas 13-16
	$conexion=mysqli_connect($servidor,$usuario_bd,$clave_bd);
	if (! $conexion){
		echo "ERROR: Imposible establecer conexi�n con el servidor.<br>\n";
	}else{
		$resultado=mysqli_select_db($conexion, $basedatos);
		if (! $resultado){
			echo "ERROR: Imposible seleccionar la base de datos.<br>\n";
		}else{
			
			$resultado = mysqli_query($conexion, $sql);
			if(!$resultado){ // Si no pudo realizarse la consulta
				echo "ERROR: Imposible ejecutar la consulta.<br>\n";
			}
			else{
				$numeroregistros=mysqli_num_rows($resultado);
				if($numeroregistros<1){ // Si no se encontr� un usuario con esa clave.
					echo "ERROR: Usuario no registrado o clave incorrecta.<br>\n";
					echo "<a href='index.php'>Volver a intentarlo</a><br>\n";
				}
				else{ // Usuario encontrado con clave correcta...
					echo "Bienvenido: <b>" . $_SESSION['usuario'] . "</b>.<br>\n";
					echo "<a href='foro.php'>Entrar en el foro</a><br>\n";
					$fila=mysqli_fetch_array($resultado);
					if (!$fila){
						echo "ERROR: Imposible obtener su tipo.<br>\n";
					}else{
						$_SESSION['tipo']=$fila['tipo'];
					}
					echo "Tipo de usuario: <b>".$_SESSION['tipo']."</b><br>\n";
				}
			}
		}
		mysqli_close($conexion);
	}
}else{
	echo "<a href='index.php'>Inicie una sesion primero.</a><br>\n";
} 
?>
</body></html>
