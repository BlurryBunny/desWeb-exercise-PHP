<?php
    session_start();
    include("funciones.php");

    $msg='';

    //validar usuario autentificado
    if(!isset($_SESSION["idU"])){
        //no autentificado
        header("location:".$ruta."portada.php?err=0");
    }
    
    //verificar que los datos existan
    if( isset($_GET["idA"]) || $_GET["idA"]!=""){
        
        //recuperar el rol
        $rolUsr = RolUsuario($_SESSION["idU"]);

        //responder con la imagen
        $c =conectarBD();

        //archivos que puede ver el usuario comun y general
        if($rolUsr=="General"){
            //es usuario general
            $qry= "Select NombreOriginal, Tipo, Contenido from documentos where idDocumento=". $_GET["idA"] ." and idUsuario=".$_SESSION["idU"];
        }else {
            //es administrador
            $qry= "Select NombreOriginal, Tipo, Contenido from documentos where idDocumento=". $_GET["idA"];
        }

        $rs= mysqli_query($c,$qry);
        $imagen = mysqli_fetch_array($rs);
        header("Content-type:".$imagen["Tipo"]);
        echo $imagen["Contenido"];
        mysqli_close($c);
    }

?>