<?php
session_start();
include("funciones.php");

$msg = "";

    //verificar que txt usuario y txt pwd esten en el formulario
    if(isset($_POST['txtUsuario']) && isset($_POST['txtPwd'])){
        //Verificar que no sean cadenas vacias
        if($_POST['txtUsuario']!= "" && $_POST['txtPwd']!=""){
            //conectar a la BD para verificar User y Psw son correctos
            $c = conectarBD();
            //consulta de user y pass
            $qry = "select * from usuarios where Usuario='" . $_POST['txtUsuario'] . "' and Pwd = '" . $_POST['txtPwd']. "'";
            $rs = mysqli_query($c,$qry);
            
            //verificar si existe un dato
            if(mysqli_num_rows($rs)>0){
                $datosUsuario = mysqli_fetch_array($rs);
                //hacer el redericcionamiento por GET
                //header("location".$ruta."portada.php?idU=".$datosUsuario["idUsuario"])
                
                //establecer el session en el servidor
                //$_SESSION['']
                $_SESSION['idU'] = $datosUsuario["idUsuario"];
                $_SESSION['nombre'] = $datosUsuario["Usuario"];
                mysqli_close($c);

                echo $_SESSION['idU'];
                header("location: ".$ruta."portada.php");
            }else{
                mysqli_close($c);
                $msg = "El usuario / contraseña no son correctas";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
		encabezado("Log in");
		if($msg!=""){
			echo "<div id=\"txtMsg\" class=\"err\">".$msg."</div>";
            echo "<div class=\"opciones-menu\">[Regresar a <a href='portada.php'>portada</a>]</div>";
		}else{
			echo "<div id=\"txtMsg\">ya estas registrado</div>";
            echo $_SESSION['idU'];
		}
	?>
</body>
</html>