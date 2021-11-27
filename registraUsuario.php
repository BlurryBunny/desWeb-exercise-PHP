<?php
    include("funciones.php");
    //si el usuario tiene permiso para acceder a la página
    //autenticación
    //autorización

    //que se hayan pasado los datos del usuario
    //que te tengan la información

    //que tengan información

    //abrir la conexión a la base de datos

    //especificar cual es la base de datos a la que se quiere utilizar

    //generar la consulta de la inserción de la tabla

    //ejecución de la consulta en la base de datos

    //recuperar la respuesta de la ejecución de la consula
    //si hay un error

    //si no hay un error
    //////////////////////////////////////////////////////////////////////////////////

    //los datos hayan sido pasados
    if(!isset($_GET['txtUsuario']) || 
        !isset($_GET['txtPwd']) ||
        !isset($_GET['txtRePwd']) ||
        !isset($_GET['txtEmail'])){
        header("location: ".$ruta."registro.php?err=1");
    }
    if($_GET['txtUsuario'] == "" ||  $_GET['txtPwd'] == "" || $_GET['txtRePwd'] == "" || $_GET['txtEmail'] == ""){
        header("location: ".$ruta."registro.php?err=2");
    }
    if($_GET['txtPwd'] != $_GET['txtRePwd']){
        header("location: ".$ruta."registro.php?err=3");
    }

    // $usuario = $_GET['txtUsuario'];
    // $pwd = $_GET['txtPwd'];
    // $email = $_GET['txtEmail'];

    extract($_GET);

    //establecer la conexión a la DB
    $conn = mysqli_connect("localhost","root","","bdd_ex_usercontrol");

    //crear la consulta a la SQL a la DB
    $consulta = "insert into usuarios (Usuario, Pwd, Rol, Email) value('$txtUsuario','$txtPwd','General','$txtEmail')";

    // ejecuta una consulta en la DB
    $rs = mysqli_query($conn, $consulta);

    mysqli_close($conn);

    //el usuario se ha registrado correctamente
    header("location: ".$ruta."registro.php?err=4");
?>