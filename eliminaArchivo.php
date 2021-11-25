<?php
session_start();
include("funciones.php");

//verificar que el usuario este autentificado
if(!isset($_SESSION["idU"])){
    header("location" . $ruta . "portada.php"); 
}

//recuperar el rol del usuario
$Rol = RolUsuario($_SESSION["idU"]);

//verificar que se haya enviado el id del documento que requiero eliminar
if(isset($_GET["idA"]) && $_GET["idA"]!=""){
    if($Rol == "Administrador"){
        $qry = "delete from documentos where idDocumento=" .$_GET["idA"];
    }else{
        $qry = "delete from documentos where idDocumentos=" .$_GET["ida"] . "and idUsuario=" . $_SESSION["idU"];
    }
    $c = conectarBD();
    mysqli_query($c,$qry);
    mysqli_close($c);
}

header("location" . $ruta . "portada.php"); 

?>