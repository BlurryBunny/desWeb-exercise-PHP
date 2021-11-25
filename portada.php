<?php
session_start();
include("funciones.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Portada WebPage</title>
	<link rel="stylesheet" type="text/css" href="css/styless-registro.css">
</head>
<body>


<?php
	encabezado("Portada");
	if(isset($_SESSION['idU'])){
		echo "<h2 class = 'bienvenida'> Bienvenido ".$_SESSION['nombre'] . " [<a href = \"logout.php\">Salir</a> del sistema]</h2>";
		echo "<div class=\"opciones-menu\">[<a href=\"cambiarPwd.php\">cambiar contraseña</a> | <a href=\"logout.php\">salir</a>del sistema] | <a href='cargarArchivo.php'>cargar archivo</a></div>";
		//listamos los archivos cargados por el usuario
		//recuperar las columnas de la tabla de usuarios
		//recuperar nombre usuario y rol de la tabla de usuarios
		//respetando la llave foranea idUsuario
			//si el rol es geneal
				//solo mostrar documentos de usuario autentificado
			//si el rol es administrador 
				//mostrar todos los documentos
		//solo se muestren los documentos del usuario autenticado
		$rolUsuario = RolUsuario($_SESSION["idU"]);
		if($rolUsuario == "Administrador"){
			$qry = "Select d. *, u.Usuario from usuarios as u inner join documentos as d on u.idUsuario = d.idUsuario";
		}else{
			$qry = "Select d. *, u.Usuario from usuarios as u inner join documentos as d on u.idUsuario = d.idUsuario Where d.idUsuario=".$_SESSION["idU"];
		}

		$c = conectarBD();
		$rs = mysqli_query($c,$qry);

		// si hay documentos guardados
		if(mysqli_num_rows($rs)>0){
			echo "<table>";
				echo "<tr>";
				echo "<td>Usuarios</td>";
				echo "<td>Titulo de archivo</td>";
				echo "<td>Fecha de cargado</td>";
				echo "<td>Nombre de archivo</td>";
				echo "<td>Opciones</td>";
				echo "</tr>";
			while($datos = mysqli_fetch_array($rs)){
				echo "<tr>";
				echo "<td>" .$datos["Usuario"]."</td>";
				echo "<td>".$datos["Titulo"]."</td>";
				echo "<td>".$datos["FechaCargado"]."</td>";
				// echo "<td>".$datos["NombreOriginal"]."</td>";
				//$pos = strpos($archivo['Tipo'],"image/");
				// if($pos === false){
				// 	echo "<td><a href=\"descarga.php\">".$datos["NombreOriginal"]."</a></td>";
				// }else{
				// 	echo "<td><img src=\"imagen.php?idA=\">".$datos["idDocumento"]."</a></td>";
				// }
				echo "<td><a href=\"eliminaArchivo.php?idA=".$datos["idDocumento"]."\">Eliminar</td>";
				echo "</tr>";
			}
			echo "</table>";
		}else{ //no hay documentos guardados
			echo "Actualmente no hay documentos guardados";
		}

	}else{
		echo "<h3>tienes que registrarte</h3>";
?>

	<form method="post" action="login.php">
		usuario: <input type="text" id="txtUsuario" name="txtUsuario"> <br>
		contraseña: <input type="text" id="txtPwd" name="txtPwd"> <br>
		<input type="submit" value= "Autenticame" >
		<input type="reset" value="Cancelar"> <br>
		si no estas registrado, da click <a href="registro.php">aqui</a>
	</form>

<?php
	}
?>
</body>
</html>