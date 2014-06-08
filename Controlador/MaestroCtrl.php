<?php
    /**
	 * @author J. Rizo Orozco & Jesus Alberto Ley Ayón
	 *  @since 
	 *
	 * Documentation for MaestroCtrl.php in this class we put methods for any case that would involve Teachers,because the controller was passed here,
	 * so we will add just methods for teachers. there it is a switch that gets the actions and acts according to the action.
	 * 
	 * CASE CAPTURARCURSO
	 * In the 'capturarcurso' action we validate the incoming data for the new course and send to @see nuevoCurso() 
	 * @param nombrecurso its the name of the new course
	 * @param seccion it the code for the group of 'seccion'
	 * @param nrc its a number that the students use to get in the group
	 * @param academia its the name of the academy of the course
	 * @param dias represent the days of the week of the course
	 * @param horas it the time in hours of the class
	 * @param horario represent the schedule of the class
	 * 
	 * CASE CLONARCURSO
	 * in the 'clonarcurso' action we recieve  and validate the data of an existing course and then duplicate its characteristics without students
	 * @param clonarcurso its the name of the course 
	 *
	 * CASE EVALUACION
	 * here we receive and validate the data of the activity and the percentage they represent in the course also the teacher can add an extra page
	 * where he can add to a any activity wich represent a evaluation of a part of the activity representing percentage of the whole activity of
	 * evaluation
	 * OBLIGATORY
	 * @param actividad the name of the activity of the course
	 * @param porcentaje the value of the activity in the course 
	 * @param hojaextra if the teacher needs an extra page
	 * OPTIONAL 
	 * @param subactividad the name of the subactivity
	 * @param subporcentaje the value of the subactivity as part of an activity
	 * 
	 * 
	 * CASE ALTAALUMNOS
	 * here the teacher put the code of the student so he can be in the course imparted by his teacher and get evaluated
	 * @param codigo the code of the student that wants to get in the course
	 * 
	 * CASE CAPTURACALIFICACION
	 * here the teacher inputs the qualification to the students D= supossedly according to how they evaluate cruel reality u.u also the teacher can
	 * put the assistance to the students
	 * @param calificacion the obtained qualification of the student
	 * @param assistencia the assistance of the student
	 * 
	 * the validations through regular expresions are below in the code in think its better to agroup them in another file
	 * 
	 */
	 
	 require('CtrlEstandar.php');
    class MaestroCtrl extends CtrlEstandar{
    	public $model;
		
		public function __construct(){//Charge the model Alumno
			require('Modelo/MaestroMdl.php');
			$this->model = new MaestroMdl();
		}
		
		public function ejecutar(){
			if(isset($_POST['accion'])){
				if(preg_match("/[A-Za-z]+/", $_POST['accion'])){
					switch($_POST['accion']){
						case 'capturarcurso':
							$this->altaCurso();
						break;
						
						case 'clonarcurso':
							$this->clonarCurso();
						break;
						
						case 'evaluacion':
							if(isset($_POST['actividad'])){
								$actividad = $this->validaActividad($_POST['actividad']);
							} else{
								$actividad = false;
							}
							if(isset($_POST['porcentaje'])){
								$porcentaje = $this->validaPorcentaje($_POST['porcentaje']);
							} else{
								$porcentaje = false;
							}
							///para las hojas extras de evaluacion
							if(isset($_POST['actividad']['hojaextra'])){
								$hoja = $this->validaHoja($_POST['hoja']);
								if(isset($_POST['subactividad'])){
									$subactividad = $this->validaActividad($_POST['porcentaje']);
								} else{
									$subactividad = false;
								}
								if(isset($_POST['subporcentaje'])){
									$subporcentaje = $this->validaPorcentaje($subporcentaje);
								} else{
									$subporcentaje = false;
								}
								$datosevaluacion=array($actividad,$porcentaje,$subactividad,$subporcentaje);
								$status = $this -> insertaEvaluacionExtra($datosevaluacion);
								if ($status) {
									include('Vista/insertaEvaluacion.php');
								} else {
									include('Vista/errorEvaluacion.php');
								}
									
							} else{
								$hoja = false;
							}
							$datosevaluacion = array($actividad,$porcentaje);
							$status = $this -> insertaEvaluacion($datosevaluacion);
							if ($status) {
								include('Vista/insertaEvaluacion.php');
							} else {
								include('Vista/errorEvaluacion.php');
							}
								
						break;
						
						case 'consultalistas':
							$this->consultaListas();
						break;
						
						case 'alta':
						$this->alta();
						break;
						
						case 'baja':
						$this->baja();
						break;
						
						case 'modifica':
						$this->modifica();
						break;
						
						case 'consulta':
						$this->consulta();
						break;
						
						case 'capturarcalificacion':
							$this->capturaCalificacion();
						break;
						
						case 'consultaCalificacion':
							$this->consultaCalificacion();
						break;
					}	
				}
			}
    	}
		
		public function consultaCalificacion(){
			if($this->esAlumno()){
				$codigo = $_SESSION['user'];
				$status = $this->model->consultaCalificacion($codigo);
				if($status[0]){
					//Aqui cargamos calificaciones propias
				}else{
					//Aqui va la vista de error
				}
			}else if($this->esMaestro()){
				if(isset($_POST['codigo']))
					$codigo = $this->validaCodigo($_POST['codigo']);
				else
					$codigo = -1;
					
				if(isset($_POST['nrc']))
					$nrc = $this->validaNRC($_POST['nrc']);
				else
					$nrc = false;
					
				if(isset($_POST['ciclo']))
					$ciclo = $this->validaCiclo($_POST['ciclo']);
				else
					$ciclo = false;
					
					
				if($codigo && $nrc && $ciclo)
					$status = true;
				else
					$status = false;
					
				if($status){
					$arreglo = array('codigo' => $_POST['codigo'], 'nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']);
					$arreglo = $this->limpiaSQL($arreglo);
					
					$status = $this->model->consultaCalificacion($arreglo);
					
					if($status[0]){
					
						//CARGAMOS LAS CALIFICACIONES
					}else{
						//ERROR
					}
					
				}else{
					//Cargamos error
				}
			}
		
		}
		
		public function consultaListas(){
			if(isset($_POST['ciclo']))
				$ciclo = $this->validaCiclo($_POST['ciclo']);
			else
				$ciclo = false;
				
			if(isset($_POST['nrc']))
				$nrc = $this->validaNRC($_POST['nrc']);
			else
				$nrc = false;
				
			if($ciclo === true && $nrc === true)
				$statuts = true;
			else
				$status = false;
				
			if($status){
				$consultaListas = array('ciclo' => $_POST['ciclo'], 'nrc' => $_POST['nrc']);
				$consultaListas = $this->limpiaSQL($consultaListas);
				
				$status = $this->model->consultarAlumnos($consultaListas);
				if($status[0]){
					//Aqui cargamos la vista
					
				}
				else{
					//Aqui cargamos el error
				}
			}else{
				//Aqui cargamos un error
			}
		
		}
		
		public function clonarCurso(){
			if (isset($_POST['cicloNuevo'])){
				$ciclo = $this->validaCiclo($_POST['cicloNuevo']);
			}else {
				$ciclo = false;
			}
			
			if(isset($_POST['nrc'])){
				$curso = $this->validaCurso($_POST['nrc']);
			}
			else{
				$curso = false;
			}
			
			if(isset($_POST['cicloViejo'])){
				$cicloViejo = $this->validaCiclo($_POST['cicloViejo']);
			}else{
				$cicloViejo = false;
			}
			
			if($ciclo === true && $curso === true $cicloViejo === true)
				$status = true;
			else
				$status = false;
				
			if($status){
			
				$datosCopiar = array('nrc' => $_POST['nrc'], 'cicloViejo'=> $_POST['cicloViejo'], 'cicloNuevo' => $_POST['cicloNuevo'], 'idmaestro' => $_SESSION['user'] );
				$datosCopiar = $this->limpiaSQL($datosCopiar);
				$status = $this->model->clonarCurso($datosCopiar);
				if($status){
					include('Vista/clonarCurso.php');
				}else{
					include('Vista/errorClonar.php');
				}
			}else{
				include('Vista/errorClonar.php');
			}
							
		
		}
		
		public function capturaCalificacion(){//Method to update notes
				if(isset($_POST['calificacion'])){
			
					$calificaciones = $this -> validaCalificaciones($_POST['calificacion']);
				}
				else {
					$calificaciones = false;
				}
				if(isset($_POST['codigoestudiante'])){//Code from the student
					$codigo = $this ->validaCodigo($_POST['codigoestudiante']);
				}
				else {
					$codigo = false;
				}
				if(isset($_POST['nrc'])){
					$nrc = $this->validaNrc($_POST['nrc']);
				}
				else
					$nrc = false;
				if(isset($_POST['rubro'])){
					$rubro = $this->validaRubro($_POST['rubro']));
				}
				else
					$rubro = false;
					
			}
			if($calificaciones === true && $codigo === true && $nrc === true && $rubro === true)
				$status = true;
			else
				$status = false;
				
			if($status){
				$arreglo = array('calificacion' => $calificaciones, 'codigo' => $codigo, 'nrc'=> $nrc, 'rubro' => $rubro);
				$arreglo = $this->limpiaSQL($arreglo);
				
				$status = $this -> insertarCalificacion($arreglo);
				if ($status[0]) {
					include('Vista/insertaCalificacion.php');
				} else{
					include('Vista/errorCalificacion.php');
				}
			}else{
				include('Vista/errorCalificacion.php');
			}
			
		}
		
		
		public function altaCurso(){
			if($this->esMaestro() || $this->esAdmin()){
				if(isset($_POST['nombrecurso'])){
					$nombrecurso = $this->validaNombreCurso($_POST['nombrecurso']);
				}else{
					$nombrecurso = false;
				}
							
				if(isset($_POST['seccion'])){
					$seccion = $this->validaSeccion($_POST['seccion']);
				}else{
					seccion = false;
				}
				
				if(isset($_POST['nrc'])){
					$nrc = $this->validaNrc($_POST['nrc']);
				}else{
					$nrc = false;
				}
				if(isset($_POST['academia'])){
					$academia = $this->validaAcademia($_POST['academia']);
				}else{
					$academia = false;
				}
							
				if(isset($_POST['dias'])){
					$dias = $this->array_walk($_POST['dias'],'validaDias');
				}else{
					$dias = false;
				}
				
				if(isset($_POST['cantidadhoras'])){
					$horas = $this->validaHoras($_POST['cantidadhoras']);
				}else{
					$horas = false;
				}
					
				if(isset($_POST['horario'])){
					$horario = $this->validaHorario($_POST['horario']);
				}else{
					$horario = false;
				}
				
				if(isset($_POST['actividad'])){
					$actividad = $this->validaActividad($_POST['actividad']);
				}else{
					$actividad = false;
				}
				
				if(isset($_POST['porcentaje'])){
					$porcentaje = $this->validaPorcentaje($_POST['porcentaje']);
				}
				else{
					$porcentaje = false;
				}
				
				if($nombrecurso && $seccion && $nrc && $academia && $dias && $horas && $horario && $actividad && $porcentaje)
					$status = true;
				else
					$status = false;
				
				if($status){
					$datoscurso = array('nombrecurso' => $_POST['nombrecurso'], 'seccion' => $_POST['seccion'], 'nrc' => $_POST['nrc'],
										'academia' => $_POST['academia'], 'dias' => $_POST['dias'] , 'horas' => $_POST['horas'], 'horario' => $_POST['horario'],
										'actividad' => $_POST['actividac'], 'porcentaje' => $_POST['porcentaje']);
					$datoscurso = $this->limpiaSQL($datoscurso);
					$status = $this->model->nuevoCurso($datoscurso);
					if($status[0]){
						include('Vista/nuevoCurso.php');
					}else{
						include('Vista/errorCurso.php');
						errorAlta($status[1]);
					}
				}else{
					include('Vista/errorCurso.php');
					errorDatosAlta(array('nombrecurso' => $nombrecurso, 'seccion' => $seccion, 'nrc' => $nrc, 'academia' => $academia, 'dias' => $dias, 
										 'horas' => $horas, 'horario' => $horario, 'actividad' => $actividad, 'porcentaje' => $porcentaje));
				}
			}else{
				include('Vista/erroresLogueo.php');
				faltaPermisos();
			}
		}
		
		public function alta(){
			if($this->esMaestro() || $this->esAdmin()){
				if(isset($_POST['nombre']))
					$nombre = $this->validaNombre($_POST['nombre']);
				else
					$nombre = false;
				if(isset($_POST['correo']))
					$correo = $this->validaCorreo($_POST['correo']);
				else
					$correo = false;
				if(isset($_POST['codigo']))
					$codigo = $this->validaCodigo($_POST['codigo']);
				else
					$codigo = false;						
				if(isset($_POST['contraseña']))
					$contraseña = $this->validaPass($_POST['contraseña']);
				else
					$contraseña = false;
			
				if($nombre === true && $correo === true && $codigo === true && $contraseña === true)
					$status = true;
				else
					$status = false;
					
				if($status){
					$datosMaestro = array('nombre' => $_POST['nombre'], 'correo' => $_POST['correo'], 'codigo' => $_POST['codigo'], 'contraseña' => $_POST['contraseña']);
					$datosMaestro = $this->limpiaSQL($datosMaestro);
					$insercion = $this->model->inserta($datosMaestro);
					if($insercion[0]){
						include('Vista/insercionMaestro.php');
						
						//Send email of up on the website
						enviaCorreo($datosMaestro['correo'],$datosMaestro['nombre']); //enviaCorreo(email,name);
					}
					else{
						include('Vista/erroresMaestro.php');
						errorInsercion($insercion[1]);
					}
				}else{
					include('Vista/erroresMaestro.php');
					errorAlta(array('nombre' => $nombre, 'correo' => $correo, 'codigo' => $codigo, 'contraseña' => $contraseña));
				
				}
			
			}
			else{//Wrong rights to give updown a teacher
				include('Vista/erroresLogueo.php');
				faltaPermisos();
			}
		}
		public function baja(){
			if($this->esAdmin()){
				if(isset($_POST['codigo']))
					$codigo = $this->validaCodigo($_POST['codigo']);
				else
					$codigo = false;
					
				if($codigo){
					$arreglo = $this->limpiaSQL(array('codigo' => $_POST['codigo']));
					$baja = $this->model->baja($arreglo);
					
					if($baja[0]){
						include('Vista/bajaMaestro.php');
						
					}else{
						include('Vista/erroresMaestro.php');
						falloBaja($baja[1]);
					}
				
				}else{
					include('Vista/erroresMaestro.php');
					errorBaja($codigo);
				}
			
			}else{//Wrong rights to give updown to a teacher
				include('Vista/erroresLogueo.php');
				faltaPermisos();
			}
		
		
		}
		public function modifica(){
			if($this->esMaestro() || $this->esAdmin()){
				if($this->esMaestro()){
					$codigo = true; //He is logged, and he has an id for his session
				}else if(isset($_POST['codigo']))
					$codigo = $this->validaCodigo($_POST['codigo']);
				else
					$codigo = false;
					
				if(isset($_POST['nombre']))
					$nombre = $this->validaNombre($_POST['nombre']);
				else
					$nombre = false;
					
				if(isset($_POST['correo']))
					$correo = $this->validaCorreo($_POST['correo']);
				else
					$correo = false;
				
				if(isset($_POST['contraseña']))
					$contraseña = $this->validaPass($_POST['contraseña']);
				else
					$contraseña = false;
					
					
				if($codigo !== -1 && $codigo !== false && $nombre !== -1 && $correo !== -1 && $contraseña !== -1)
					$status = true;
				else
					$status = false;
				if($status){
					if($nombre === false && $correo === false && $contraseña === false)
						$status = false;
					else
						$status = true;
					if($status){
						$nuevaInfo = array();
						if($this->esMaestro())
							$nuevaInfo['codigo'] = $_SESSION['user'];
						else
							$nuevaInfo['codigo'] = $_POST['codigo'];
							
						if($nombre !== false)
							$nuevaInfo['nombre'] = $_POST['nombre'];
						if($correo !== false)
							$nuevaInfo['correo'] = $_POST['correo'];
						if($contraseña !== false)
							$nuevaInfo['contraseña'] = $_POST['contraseña'];
							
						$nuevaInfo = $this->limpiaSQL($nuevaInfo);
						
						$actualizado = $this->model->modifica($nuevaInfo);
						if($actualizado[0]){
							include('Vista/maestroModificado.php');
						}else{
							include('Vista/erroresModifica.php');
							falloModificacion($actualizado[1]);
						}
							
						
							
					}else{//Without info
						include('Vista/erroresModifica.php');
						sinModificar();
					}
				
				}else{
					include('Vista/erroresModificaMaestro.php');
					falloError(array('codigo' => $codigo, 'nombre' => $nombre, 'correo' => $correo, 'contraseña' => $contraseña));
				}
			}else{//Wrong rights
				include('Vista/erroresLogueo.php');
				faltaPermisos();
			}
		
		}
		public function consulta(){
			if($this->isLogged()){
				if($this->esMaestro()){
					$miStatus = $this->model->consulta(array('codigo' => $_SESSION['user']));
				if($miStatus[0]){
					include('Vista/statusPropioProfesor.php');
					datos($miStatus[1]);
				}else{
					include('Vista/errorConsulta.php');
					errorConsulta($miStatus[1]);
				}
				
			}else if($this->esAlumno || $this->esAdmin()){//Search by a code
				if(isset($_POST['codigo']))
					$codigo = $this->validaCodigo($_POST['codigo']);
				else
					$codigo = false;
				
				if($codigo){//Succes with code, now we're going to search his / her grades or info
					$arreglo = array('codigo' =>  $_POST['codigo']);
					$arreglo = $this->limpiaSQL($arreglo);
					$status = $this->model->consulta($arreglo);
					if($status[0]){
						include('Vista/statusProfesor.php');
						datos($status[1]);
					}
					else{
						include('Vista/errorConsulta.php');
						errorConsulta($status[1]);
					}
				}else if($codigo === -1){//Code is wrong
					include('Vista/erroresMaestro.php');
					fallos(2);
				}
				else if(!$codigo){//Code doesnt exists
					include('Vista/erroresMaestro.php');
					fallos(1);
				}
			}else{//Type of user unknowed
				include('Vista/erroresLogueo.php');
				faltaPermisos();
			}
		}else{//User not logged
			include('Vista/erroresLogueo.php');
			faltaPermisos();
		}
		
		}
		
				
		public function validaCalificaciones($calificaciones){

			foreach($calificaciones as $calificacion){
				if($this->validaCalificacion($calificacion) === -1)
					return -1;
			}
			return true;
		}
		
		
		
		public function validaNombreCurso($nombrecurso){ //here we validate the syntaxis of the name of the course 
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $nombrecurso))
				return true;
			else 
				return -1;
		}
		public function validaSeccion($seccion){//function to validate the name of the section
			if(preg_match("/[A-Za-z]+[0-9]+\-D[0-9]+/",$seccion))
				return true;
			else
				return -1;
		}
		public function validaNrc($nrc){//function to validate the nrc of the especific group
			if(preg_match("/0[0-9]{4}/",$nrc))
				return true;
			else 
				return -1;
		}
		public function validaAcademia($academia){//function to validate the syntaxis of the name of the academy
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $academia))
				return true;
			else 
				return -1;
		}
		public function validaDias($dias){//function to validate the days of the class
			if(preg_match("/[1-6]/",$dias))
				return true;
			else 
				return -1;
		}
		
		public function validaRubro($rubro){
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $rubro))
				return true;
			else 
				return -1;
		}
		public function validaHoras($horas){//function to validate the hours of the class from 1 to 4
			if(preg_match("/[1-4]/",$horas))
				return true;
			else
				return -1;
		}
		public function validaHorario($horario){//function to validate the schedule of the class
			if(preg_match("/[0-2][0-9]{3}/",$horario))
				return true;
			else
				return -1;
		}
		
		public function validaActividad($actividad){//function to validate the activity of evaluation
			if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]+/", $actividad))
				return true;
			else 
				return -1;
		}
		public function validaPorcentaje($porcentaje){//function to validate the percentage of the activity
			if (preg_match("/(100)|[0-9]{2}/", $porcentaje))
				return true;
			else 
				return -1;
		}
		public function validaCalificacion($calificacion){//function to validate the qualification 0-10 and 1 decimal also accepts SD and NP
			if(preg_match("/10|([0-9][.][0-9]{1})|SD|NP/",$calificacion))
				return true;
			else 
				return -1;
		}
	}
?>