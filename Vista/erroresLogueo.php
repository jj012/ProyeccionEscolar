<?php
  //View to show the errors of login

	function erroresLogueo($p, $codigo){//Function to review the errors of login
		if($p === false){
			echo "Falta la contraseña </br>";
		}
		else if($p === -1){
		
			echo "Contraseña incorrecta, recuerde que es alfanumerica y se permite guion bajo y medio </br>";
		}
		
		if($codigo === false){
			echo "Falta el codigo </br>";
		}
		else{
			echo "Formato de codigo incorrecto </br>";
		}
	}

	function incorrecto(){//Function with the message "Contraseña incorrecta" if doesn't match with the password of the database
		echo "Contraseña incorrecta </br>";
	}
	
	function faltaAccion(){//Function to show the message of the lack of the action
		echo "Falto la accion por realizar </br>";
	}
	
	function noLogueado(){//Function to show the message where the user is not logged
		echo "Usted no esta logueado y no puede entrar a esta parte </br>";
	}

?>
