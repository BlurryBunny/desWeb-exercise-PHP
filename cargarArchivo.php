<?php
session_start();
include("funciones.php");

//existe un usuario registrado?
if(!isset($_SESSION["idU"])){
	header("location:".$ruta."portada.php");
}

	$c= conectarBD();
	// $qry = "select Rol from usuarios where idUsuarios=" .$_SESSION["idU"];
	// $rs = mysqli_query($c,$qry);
	// //	$rolusr = mysqli_object_array($rs); 
	// $rolusr = mysqli_fetch_array($rs); //lee el primer dato que encuentra en la tabulacion
	// //si necesito recuperar el siguiente necesito hacer de nuevo la consulta
	// if($rolusr["Rol"] != "Administrador"){
	// 	header("location" .$ruta. "portada.php"); //sacamos al usuario por que no esta autorizado
	// }


//ya esta verificado y es un usuario que puede modificar datos
if(isset($_POST["txtTitulo"])){

    //verificar cargado del archivo
    if(!empty($_FILES["myarchivo"]["tmp_name"])){
        //recuperar info del archivo
        $nombre = $_FILES["myarchivo"]["name"];
        $tipo = $_FILES["myarchivo"]["type"];
        $nombre_temporal = $_FILES["myarchivo"]["tmp_name"];
        $tamanio = $_FILES["myarchivo"]["size"];
        $tipo = $_FILES["myarchivo"]["size"];
        $titulo = $_POST["txtTitulo"];

        //recuperar el contenido del archivo
        $fp = fopen($nombre_temporal, "r");
        $contenido = fread($fp,$tamanio);
        fclose($fp);

        //transformar los caracteres especiales
        $contenido = addslashes($contenido);

		$qry = "insert into documentos(Titulo,fechaCargado,idUsuario,Tipo,NombreOriginal,Contenido) values('$titulo','2020/11/18',".$_SESSION["idU"].",'$tipo','$nombre','$contenido')";
		mysqli_query($c,$qry);

		mysqli_close($c);
        header("location:".$ruta."portada.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cargar archivos</title>
	<link rel="stylesheet" type="text/css" href="css/styless-registro.css">
	<script type="text/javascript">
		function validaFRM(){
			if( document.getElementById('txtTitulo').value == "" 	||
				document.getElementById('myarchivo').value == "" ){
				alert('Todos los datos del formulario son requeridos');
				return false;

			}else{
				return true;
			}
		}
	</script>
</head>
<body>
<form method="post" enctype="multipart/form-data" action="cargarArchivo.php" onsubmit="return validaFRM()">
	<?php
		encabezado("Formulario para cargar archivo");
	?>

	Titulo del archivo: <input type="text" id="txtTitulo" name="txtTitulo"> <br>
	Seleccionar archivo: <input type="file" id="myarchivo" name="myarchivo"> <br>
	<input type="submit" value= "Subir archivo" >
	<input type="reset" value="Cancelar"> <br>
	Regresar a <a href="portada.php">Portada</a>
</form>
</body>
</html>