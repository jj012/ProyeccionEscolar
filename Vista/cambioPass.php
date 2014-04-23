<?php

function exitoCambio(){
	echo "Contraseña cambiada";
}

function ingreseNuevo(){
	echo "Ingrese la contraseña y una nueva contraseña </br>";
}

function sinCambio(){
	echo "No pudo cambiarse las contraseñas, intente de nuevo o hable con el admin </br>";
}

function noIguales(){
	echo "Las contraseñas no son iguales </br>";
}

function noValidas(){
	echo "La contraseña no es valida";
}

function sinContraseña(){
	echo "La contraseña no se ha enviado";
}

function erroresCambioAdmin($datos){
	if($datos['codigo'] === -1)
		echo "El codigo es incorrecto </br>";
	else if($datos['codigo'] === false)
		echo "No se ha enviado el codigo del usuario </br>";
		
	if($datos['tipo'] === false)
		echo "Tipo de usuario no enviado </br>";
	else if($datos['tipo'] === -1)
		echo "Tipo de usuario incorrecto </br>";
		
	if($datos['contraseña'] === false)
		echo "No se ha enviado la contraseña </br>";
	else if($datos['contraseña'] === -1)
		echo "La contraseña es incorrecta </br>";
}


?>
