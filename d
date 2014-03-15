[1mdiff --cc Controlador/AlumnoCtrl.php[m
[1mindex cecc3a1,f55e73f..0000000[m
[1m--- a/Controlador/AlumnoCtrl.php[m
[1m+++ b/Controlador/AlumnoCtrl.php[m
[36m@@@ -120,8 -112,27 +125,31 @@@[m
  				echo "No se que quieres que haga :/ </br>";[m
  	}[m
  	[m
[32m+ 	public function limpiaSQL($variables){//Posibility to use with the other controllers because is more standard this function[m
[32m+ 		foreach($variables as $llave => $valor){[m
[32m+ 			if(is_string($valor)){[m
[32m+ 				$valor = ltrim($valor);[m
[32m+ 				$valor = rtrim($valor);[m
[32m+ 				$variables[$llave] = $valor;[m
[32m+ 			}[m
[32m+ 		}//Look this wonderful code :D we are gonna to use to another controllers to clean the values.[m
[32m+ 		[m
[32m+ 		return $variables;[m
[32m+ 	}[m
[32m+ 	[m
  	public function validaNombre($cadena){ //Function to validate the syntax of name[m
[32m++<<<<<<< HEAD[m
[32m +		return preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $cadena);[m
[32m++=======[m
[32m+ 		$cadena = ltrim($cadena);[m
[32m+ 		$cadena = rtrim($cadena);//We clean the name first[m
[32m+ 		if(preg_match("/^[A-Za-z\s\ \'\x{00e1}\x{00e}\x{00ed}\x{00f3}\x{00fa}\x{00c1}\x{00c9}\x{00cd}\x{00d3}\x{00da}\x{00f1}\x{00d1}\x{00FC}\x{00DC}]+/", $cadena)){[m
[32m+ 			return true;[m
[32m+ 		}[m
[32m+ 		else[m
[32m+ 			return -1;[m
[32m+ 		[m
[32m++>>>>>>> c045baebcbe57e6781ab94c0a3006d5486e3ea55[m
  	}[m
  	[m
  	public function validaCorreo($correo){//Function to validate the syntax of email[m
[36m@@@ -184,22 -218,6 +235,26 @@@[m
  		else[m
  			return false;[m
  	}[m
[32m++<<<<<<< HEAD[m
[32m +	///Modificacion Jesus[m
[32m +	public function validaPassword($password){ // this function validates any character as a password with a lenght between 8 and 50 characters[m
[32m +		if(preg_match("/.{8,50}/"))[m
[32m +		return true;[m
[32m +		else [m
[32m +			return false;[m
[32m +	}[m
[32m +	///[m
[32m +	public function limpiaSQL($datos){//We are gonna clear the string of commands like INSERT, TABLES, DELETE, ETC before we give to the database[m
[32m +		$inserta = '/([I|i][N|n][S|s][E|e][R|r][T|t])/';[m
[32m +		$tablas = '/([T|t][A|a][B|b][L|l][E|e][S|s]/';[m
[32m +			[m
[32m +		[m
[32m +		[m
[32m +		[m
[32m +		[m
[32m +	}[m
[32m++=======[m
[32m+ [m
[32m++>>>>>>> c045baebcbe57e6781ab94c0a3006d5486e3ea55[m
  }[m
[31m- ?>[m
[32m+ ?>[m
[1mdiff --git a/README.md b/README.md[m
[1mdeleted file mode 100644[m
[1mindex 328c2af..0000000[m
[1m--- a/README.md[m
[1m+++ /dev/null[m
[36m@@ -1,4 +0,0 @@[m
[31m-ProyeccionEscolar[m
[31m-=================[m
[31m-[m
[31m-Proyecto de prog web para mostrar una pagina escolar tipo CRUD[m
