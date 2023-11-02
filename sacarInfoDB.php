<?php
session_start(); // Usaremos sesiones.
		
        $servidor="127.0.0.1"; 
        $usuario_bd="root";
        $clave_bd="";

        $basedatos="ejemploDeCreacionBBDD";


		$tabla="usuarios"; //cambiar al de la que se quiere extraer datos
		
        //selecttion
        //aqui va la seleccion que se haga en mysql de los datos de la tabla
        //esta predeterminado en que se saquen todos los datos de la tabla
		$sql = "SELECT * FROM $tabla;"; //cambiar el nombre a la tabla que se quiera
		
		$conexion=mysqli_connect($servidor,$usuario_bd,$clave_bd);
		if (! $conexion){
			echo "ERROR: Imposible establecer conexi�n con el servidor $servidor.<br>\n";
		}
		else{
			$resultado=mysqli_select_db($conexion, $basedatos);
			if (! $resultado){
				echo "ERROR: Imposible seleccionar la base de datos $basedatos.<br>\n";
			}
			else{
				
				$resultado = mysqli_query($conexion, $sql);
				if(!$resultado){
					echo "ERROR: Imposible consultar los mensajes.<br>\n";
				}
				else{
				 	$numeroregistros=mysqli_num_rows($resultado);
                    //mensaje para saber cuantas filas se imprimen
					echo "SE ENCONTRARON $numeroregistros DATOS EN LA TABLA ".$tabla.":<br>";

					
					while($fila=mysqli_fetch_array($resultado)){
					 	
                        //SI LA QUERY CAMBIA (LINEA 16), ESTO DE AQUI HAY QUE 
                        //REVISARLO Y PONER LOS DATOS QUE VAYAN EN LA QUERY

						echo "<hr>";
						echo "<b>Usuario:</b> " . $fila['usuario'] . 
							" <b>Contraseña:</b> " . $fila['clave'] .
							" <b>Tipo:</b> " . $fila['tipo'] ;
							
						
						echo "<hr>";
					}
				}
			}
			mysqli_close($conexion);
		}		

        //esto va asi para que los strings dentro de los echo funcionen
        //LO DE BODY Y HTML CERRANDO SOLO
?>
</body></html> 
