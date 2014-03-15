<?php
    /**
	 * @author Jesus Alberto Ley Ayon
	 *  @since 
	 * 
	 */
    class MaestroCtrl{
    	public $model;
		
		public function __construct(){//Charge the model Alumno
			require('Modelo/MaestroMdl.php');
			$this->model = new MaestroModel();
		}
		
		public function ejecutar(){
			if(isset($_POST['accion'])){
				if(preg_match("/[A-Za-z]+/", $_POST['accion'])){
					switch($_POST['accion']){
						case 'capturarcurso':
							if(isset($_POST['nombrecurso'])){
								$nombrecurso = $this->validaNombreCurso($_POST['nombrecurso']);
							} else{
								$nombrecurso = false;
							}
							if (isset($_POST['seccion'])) {
								$seccion = $this->validaSeccion($_POST['seccion']);
							} else {
								$seccion = false;
							}
							if (isset($_POST['nrc'])) {
								$nrc = $this->validaNrc($_POST['nrc']);
							} else {
								$nrc = false;
							}
							if (isset($_POST['academia'])) {
								$academia = $this->validaAcademia($_POST['academia']);
							} else {
								$academia = false;
							}
							if (isset($_POST['dias'])) {
								$dias = $this->array_walk($_POST['dias'],'validaDias');
							} else {
								$dias = false;
							}
							if (isset($_POST['cantidadhoras'])) {
								$horas = $this->validaHoras($_POST['cantidadhoras']);
							} else {
								$horas = false;
							}
							if (isset($_POST['horario'])) {
								$horario = $this->validaHorario($_POST['horario']);
							} else {
								$horario = false;
							}
							$datoscurso = array($nombrecurso,$seccion,$nrc,$academia,$dias,$horas,$horario);
							$status = $this->nuevoCurso($datoscurso);
							if($status){
								include('Vista/nuevoCurso.php');
							} else{
								include('Vista/errorCurso.php');
							}
							
							
						break;
						case 'clonarcurso':
							if (isset($_POST['clonarcurso'])) {
								$clonarcurso = $this->validaNombreCurso($_POST['clonarcurso']);
							} else {
								$clonarcurso = false;
							}
							$status = $this->clonarCurso($clonarcurso);
							if($status){
								include('Vista/clonarCurso.php');
							} else{
								include('Vista/errorClonar.php');
							}
							
						break;
						case 'evaluacion':
							if(isset($_POST['actividad'])){
								$evaluacion = $this->validaActividad($_POST['actividad']);
							} else{
								$evaluacion = false;
							}
							if(isset($_POST['porcentaje'])){
								$porcentaje = $this->validaPorcentaje($_POST['porcentaje']);
							} else{
								$porcentaje = false;
							}
							$status = $this -> insertaEvaluacion($evaluacion,$porcentaje);
							if ($status) {
								include('Vista/insertaEvaluacion.php');
							} else {
								include('Vista/errorEvaluacion.php');
							}
							
						break;
							
						case 'altaalumnos':
							 if(isset($_POST['codigo'])){
							 	$codigo = $this->validaCodigo($_POST['codigo']);							 		
							 }
							 $status = $this -> consultarAlumno($codigo);
							 if($status){
							 	include('Vista/altaAlumno.php');
							 } else{
							 	include('Vista/errorAlta.php');
							 }
							 
						break;
						
						case 'capturarcalificacion':
							if(isset($_POST['calificacion'])){
								$calificacion = $this -> validaCalificacion($_POST['calificacion']);
							}
							$status = $this -> insertarCalificacion($calificacion);
							if ($status) {
								include('Vista/insertaCalificacion.php');
							} else{
								include('Vista/errorCalificacion.php');
							}
						break;
					}	
				}
			}
    	}
		public function validaNombreCurso($nombrecurso){
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $nombrecurso))
				return true;
			else 
				return false;
		}
		public function validaSeccion($seccion){
			if(preg_match("/[A-Za-z]+[0-9]+\-D[0-9]+/",$seccion))
				return true;
			else
				return false;
		}
		public function validaNrc($nrc){
			if(preg_match("/0[0-9]{4}/",$nrc))
				return true;
			else 
				return false;
		}
		public function validaAcademia($academia){
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $academia))
				return true;
			else 
				return false;
		}
		public function validaDias($dias){
			if(preg_match("/[1-6]/",$dias))
				return true;
			else 
				return false;
			
		}
		public function validaHoras($horas){
			if(preg_match("/[1-4]/",$horas))
				return true;
			else
				return false;
		}
		public function validaHorario($horario){
			if(preg_match("/[0-2][0-9]{3}/",$horario))
				return true;
			else
				return false;
		}
		
		public function validaActividad($actividad){
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $actividad))
				return true;
			else 
				return false;
		}
		public function validaPorcentaje($porcentaje){
			if (preg_match("/[0-100]/", $porcentaje))
				return true;
			else 
				return false;
		}
	}
?>