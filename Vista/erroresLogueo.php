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

	function incorrecto(){
		echo "Contraseña incorrecta </br>";
	}

?>
