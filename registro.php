<?php
include("funciones.php");
//recuperar la bandera de registraUsuario.php

$msg = "";
if(isset($_GET['err']) && $_GET['err']!=""){
	if($_GET['err'] == "1") $msg = "Se debe utilizar el formulario de registro";
	if($_GET['err'] == "2") $msg = "Todos los datos son requeridos";
	if($_GET['err'] == "3") $msg = "Las contraseñas no coinciden";
	if($_GET['err'] == "4") $msg = "El usuario se registro exitosamente";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro de usuario</title>
	<link rel="stylesheet" type="text/css" href="css/styless-registro.css">
	<script type="text/javascript">
		function validaFRM(){
			if( document.getElementById('txtUsuario').value == "" 	||
				document.getElementById('txtPwd').value == "" 		||
				document.getElementById('txtRePwd').value == ""		||
				document.getElementById('txtEmail').value == ""	){

				alert('Todos los datos del formulario son requeridos');
				return false;
			} else if(document.getElementById('txtPwd').value != document.getElementById('txtRePwd').value){
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
		encabezado("registro de usuarios");
		if($msg!=""){
			echo "<div id=\"txtMsg\" class=\"err\">$msg</div>";
		}else{
			echo "<div id=\"txtMsg\">Holi</div>";

		}
	?>

	Ingresa tu usuario: <input type="text" id="txtUsuario" name="txtUsuario"> <br>
	Ingresa tu contraseña: <input type="password" id="txtPwd" name="txtPwd"> <br>
	Re escribe tu contraseña: <input type="password" id="txtRePwd" name="txtRePwd"> <br>
	Ingresa tu correo electronico: <input type="email" id="txtEmail" name="txtEmail"> <br>
	<input type="submit" value= "Registrame" >
	<input type="reset" value="Cancelar"> <br>
	Regresar a <a href="portada.php">Portada</a>
</form>
</body>
</html>