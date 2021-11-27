<?php
session_start();
include("funciones.php");

//autentificacion y autorizacion
$rolUsuario = RolUsuario($_SESSION["idU"]);
if(!isset($_SESSION["idU"])){
    //no autentificado
    header("location:".$ruta."portada.php?err=0");
}

if($rolUsuario != "Administrador"){
    //no autorizado
    header("location:".$ruta."portada.php?err=1");
}

$msg = '';
if(isset($_GET['err']) && $_GET['err']!=""){
	if($_GET['err'] == "0") $msg = "No existe el usuario a modificar, intente nuevamente";
    if($_GET['err'] == "1") $msg = "No hay informacion registrada del usuario";
    if($_GET['err'] == "2") $msg = "Se ha actualizado la informacion";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuarios</title>
	<link rel="stylesheet" type="text/css" href="css/styless-registro.css">
</head>
<body>


<?php
	encabezado("Lista de usuarios");
	if(isset($_SESSION['idU'])){
        //menu de interaccion
		echo "<h2 class = 'bienvenida'> Bienvenido ".$_SESSION['nombre'] . " [<a href = \"logout.php\">Salir</a> del sistema]</h2>";
		echo "<div class=\"opciones-menu\">[<a href=\"cambiarPwd.php\">cambiar contraseña</a> | <a href=\"logout.php\">salir</a>del sistema | <a href=\"cargarArchivo.php\">cargar archivo</a> |<a href=\"verUsuarios.php\">lista de usuarios</a>]</div>";
        echo "<h3>lista de usuarios registrados en el sistema</h3>";

        if($msg!=''){
			echo "<div id=\"txtMsg\" class=\"err\">.$msg.</div>";
		}
        //conexion base de datos
        $qry="Select idUsuario, Usuario, Rol, Email from usuarios";
        $c = conectarBD();
		$rs = mysqli_query($c,$qry);

		// si hay documentos guardados
		if(mysqli_num_rows($rs)>0){
			echo "<table>";
				echo "<tr>";
				echo "<td>Usuario</td>";
				echo "<td>Rol</td>";
				echo "<td>Correo electronico</td>";
                echo "<td>Opciones</td>";
				echo "</tr>";
			while($datos = mysqli_fetch_array($rs)){
				echo "<tr>";
				echo "<td>" .$datos["Usuario"]."</td>";
				echo "<td>";
                    ?>
                        <form method="get" action="actualizaRol.php">
                            <select name="txtRol" id="txtRol">
                                <?php
                                    if($datos["Rol"] == "Administrador"){
                                        echo "<option selected value=\"Administrador\">Administrador</option>";
                                        echo "<option value=\"General\">General</option>";
                                    }else{
                                        echo "<option value=\"Administrador\">Administrador</option>";
                                        echo "<option selected value=\"General\">General</option>";
                                    } 
                                ?>
                            </select>
                            <input type="hidden" value="<?php echo $datos["idUsuario"] ?>" name="txtIdUsuario">
                            <input type="submit" value="Actualizar">
                        </form>
                    <?php
				echo "<td>".$datos["Email"]."</td>";
				echo "<td><a href=\"eliminaArchivo.php?idA=".$datos["idUsuario"]."\">Eliminar</td>";
				echo "</tr>";
			}
			echo "</table>";
		}else{ //no hay documentos guardados
			echo "No hay usuarios registrados";
		}

	}else{
        header("location:".$ruta."portada.php");
	}
?>

Regresar a <a href="portada.php">Portada</a>
</body>
</html>