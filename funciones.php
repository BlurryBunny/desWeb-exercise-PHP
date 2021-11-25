<?php

$ruta = "http://localhost/Parcial_3/Ejercicio2_PHP/";

function encabezado($title){
	echo "<h1 class =\"tituloSistema\"> Estamos en ".$title."</h1>";
}


function conectarBD(){
	return mysqli_connect("localhost", "root","","bdd_ex_usercontrol");
}

function RolUsuario($idUsuario){
	$con = conectarBD();
	$rs = mysqli_query($con, "Select Rol from usuarios where idUsuario= ".$idUsuario);
	$datoUrs = mysqli_fetch_object($rs);
	mysqli_close($con);
	return $datoUrs->Rol;
}
?>