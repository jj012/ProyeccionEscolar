<?php
    /**
	 * @author Javier Rizo Orozco & Jesus Alberto Ley Ayon
	 * Model for the user
	 * 
	 * In AlumnoMdl.php we made all the conections to the database define the rules and relations
	 * the methods here are invoked through @see AlumnoCtrl.php
	 * 
	 */
	 class AlumnoModel{
	 	public $conexion;
		
		function __construct(){
			//Create the conection to the database
		}
		
		function listar($grupo){ //Consult the group, return the array with the group and status with true, if dont then only return the array with status false
			if($grupo == "CC403-D05")
				$lista =  array('status'=>true, "Juanito", "Fulanito", "Pepito", "Marianita", "Carlos");
			else if($grupo == "i4214-D04")
				$lista = array('status'=>true, "Mariano", "Lalo", "Zara", "Karlita", "Liz");
			else
				$lista = array('status'=>false);
				return $lista;
		}
		
		function insertaAlumno($datosAlumno){//Function to call a query and INSERT into the database
		
		
			return true; //For the first advance we suppose to think that the data is correct and can been inserted
						 //The next advance we return a false and we call a sql_command to verify if the data can be inserted or not.
		}
		
		function consulta($codigo,$password){
			return true;//For the first advance we suppose that the data is correct and can access to the database
						
		}
		
	 }
	 
?>