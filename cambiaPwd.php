<?php
session_start();
include("funciones.php");
//recuperar la bandera de registraUsuario.php

$msg = "";

//validar si el usuario esta autentificado
if(!$_SESSION["idU"]){
	header("location:". $ruta . "login.php");
}

//identificar si se pasaron los datos por formulario
if(isset($_POST["txtPwdActual"]) && isset($_POST["txtPwdNueva"]) && isset($_POST['txtRePwdNueva'])){
	if($_POST["txtPwdActual"]!="" && $_POST["txtPwdNueva"]!="" && $_POST["txtRePwdNueva"]!=""){
		//podemos proceder a actualizar la info
		//abrimos la conexion a la BD

		$c = conectarBD();
		$qry = "update usuarios set Pwd='". $_POST['txtNewPwd']."' where idUsuario='" .$_SERVER['idU'] "' and Pwd='" . $_POST['txtPwdNueva'] "'";
		mysqli_query($c, $qry); 
		$msg = "La contraseña se actualizo correctamente";
		mysqli_close($c);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro de usuario</title>
	<script type="text/javascript">
		function validaFRM(){
			if( document.getElementById('txtPwdActual').value == "" 	||
				document.getElementById('txtPwdNueva').value == "" 		||
				document.getElementById('txtRePwdNueva').value == ""	){

				alert('Todos los datos del formulario son requeridos');
				return false;
			} else if(document.getElementById('txtPwdNueva').value != document.getElementById('txtRePwdNueva').value){
				document.getElementById("txtMsg").innerHTML = "Las contraseñas deben de ser iguales";
				document.getElementById('txtPwd').value = "";
				document.getElementById('txtRePwd').value = "";
				return false;
			}else{
				return true;
			}
		}
	</script>
</head>
<body>
<form method="get" action="registraUsuario.php" onsubmit="return validaFRM()">

	<?php
		encabezado("cambiar contraseña");
		
		if($msg!=""){
			echo "<div id=\"txtMsg\" class=\"err\">$msg</div>";
		}else{
			echo "<div id=\"txtMsg\">$</div>";

		}
	?>

	Ingresa contraña actual: <input type="password" id="txtPwdActual" name="txtPwdActual"> <br>
	Ingresa tu nueva contraseña: <input type="password" id="txtPwdNueva" name="txtPwdNueva"> <br>
	Re escribe tu nueva contraseña: <input type="password" id="txtRePwdNueva" name="txtRePwdNueva"> <br>
	<input type="submit" value= "Actualizar" >
	<input type="reset" value="Cancelar"> <br>
	Regresar a <a href="portada.php">Portada</a>
</form>
</body>
</html>