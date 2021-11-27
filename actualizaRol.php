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

if(!isset($_GET["txtIdUsuario"]) || !isset($_GET["txtRol"])){
    header("location:".$ruta."verUsuarios.php?err=0");
}

if($_GET["txtIdUsuario"] == "" || $_GET["txtRol"] == ""){
    header("location:".$ruta."verUsuarios.php?err=1");
}

$qry =  "Update usuarios set Rol='". $_GET["txtRol"]."' where idUsuario=".$_GET["txtIdUsuario"];

$c = conectarBD();

mysqli_query($c,$qry);
mysqli_close($c);
header("location:".$ruta."verUsuarios.php?err=2");
?>