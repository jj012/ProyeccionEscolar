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
    	private $model;
		
		public function __construct(){//Charge the model Alumno
			$verificador = new Verificador;
			require_once('Modelo/MaestroMdl.php');
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
							$this->agregaEvaluacion();
							break;
							
						case 'evaluacionextra':
							$this->evaluacionExtra();								
						break;
						
						case 'consultalistas':
							$this->consultaListas();
						break;
						
						case 'matricularcurso':
							$this->matricularse();
						break;
						
						case 'darsebaja':
							$this->darseBaja();
							break;
						
						case 'consultaCurso':
							$this->consultaCurso();
							break;
							
						case 'modificaCurso':
							$this->modificaCurso();
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
						
						case 'capturaAsistencia':
							$this->capturaAsistencia();
							break;
					}	
				}
			}
    	}
		
		private function consultaAsistencia(){
			if($this->esAlumno()){
				if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
				else $nrc = false;
						
				if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
				else $ciclo = false;
				
				$codigo = $_SESSION['user'];
				
				if($nrc && $ciclo){
					$status = true;
				}else{
					$status = false;
				}
				
				if($status){
					$arreglo = $verificador->limpiaSQL(array('nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']));
					$arreglo['codigo'] = $codigo;
					
					$consultaAlumno = $this->model->misAsistencias($arreglo);
					
					if($consultaAlumno[0]){
						//Assistances on $consultaAlumno[1]
					}else{
						//Error on $consultaAlumno[0]
					}
					
					
				}else{
					//CHARGE AN ERROR
				}
			}else{
				if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
				else $nrc = false;
						
				if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
				else $ciclo = false;
				
				
				if($nrc && $ciclo){
					$status = true;
				}else{
					$status = false;
				}
				
				if($status){
					$arreglo = $verificador->limpiaSQL(array('nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']));
					
					$consulta = $this->model->asistenciasClase($arreglo);
					
					if($consultaAlumno[0]){
						//Assistances on $consulta[1]
					}else{
						//Error on $consulta[0]
					}
					
					
				}else{
					//CHARGE AN ERROR
				}
			
			}
		
		}
		
		private function capturaAsistencia(){
			if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
			else $nrc = false;
					
			if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
			else $ciclo = false;
			
			if(isset($_POST['codigo'])) $codigo = $verificador->validaCodigo($_POST['codigo']);
			else $codigo = false;
					
			if(isset($_POST['fecha'])) $fecha = $verificador->validaFecha($_POST['fecha']);
			else $fecha = false;
			
			if(isset($_POST['valor'])){
				if($_POST['valor'] == 1 || $_POST['valor'] == 0)
					$valor = true;
				else
					$valor = -1;
			}else{
				$valor = false;
			}
			
			if($nrc && $ciclo && $codigo && $fecha && $valor){
				$status = true;
			}else
				$status = false;
				
			if($status){
				$arreglo = array('nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo'], 'codigo' => $_POST['codigo'], 'valor' =>$_POST['valor'], 'fecha' => $_POST['fecha']);
				$arreglo = $verificador->limpiaSQL($arreglo);
				
				$capturarA = $this->model->capturaAsistencia($arreglo);
				
				if($capturaA[0]){
					//View of succesful
				}else{
					//ERROR
				}
			}else{
				//ERROR
			}
		}
		//ADD A table from evaluacion
		private function evaluacionExtra(){
			
			//mipagina.com/?ctrl=curso & act=evaluacionextra
			/*
				post................
				columnas: n
				curso:
				rubro:
			*/
			
			if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
			else $nrc = false;
					
			if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
			else $ciclo = false;
			
			if(isset($_POST['columnas'])) $columnas = $verificador->validaColumnas($_POST['columnas']);
			else 	$columnas = false;
			
			if(isset($_POST['actividad'])) 	$actividad = $verificador->validaActividad($_POST['actividad']);
			else	$actividad = false;
			
			if(isset($_POST['numExtra'])) $extra = $verificador->validaColumnas($_POST['numExtra']); //I KNOW, ITS THE SAME BUT THE VAL A NUMBER OF TWO DIGITS
				$extra = false;
			
			if($nrc && $ciclo && $columnas && $actividad && $extra !== -1)
				$status = true;
			else
				$status = false;
				
			if($status){
				$arreglo = array('ciclo' => $_POST['ciclo'], 'nrc' => $_POST['nrc'], 'columnas' => $_POST['columnas'], 'actividad' => $_POST['actividad']);
				$arreglo = $verificador->limpiaSQL($arreglo);
				if($extra)
					$arreglo['numExtra'] = $_POST['numExtra'];
				else
					$arreglo['numExtra'] = '1';
				
				$creaExtra = $this->model->insertaEvaluacionExtra($arreglo);
				
				if($creaExtra[0]){
					//Charge a succesful view
				}else{
					//CHARGE THE ERROR WITH $creaExtra[1]
				}
			
			}else{
				//ERROR
			}
		}
		
		//DELETE A STUDENT FROM THE CLASS
		private function darseBaja(){
			if(isset($_POST['codigo']))
				$codigo = $verificador->validaNrc($_POST['nrc']);
			else
				$codigo = false;
				
			if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
			else $nrc = false;
					
			if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
			else $ciclo = false;
			
			if($codigo && $nrc && $ciclo)
				$status = true;
			else
				$status = false;
				
			if($status){
				$arreglo = array('codigo' => $_POST['codigo'], 'nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']);
				$arreglo = $verificador->limpiaSQL($arreglo);
				
				$baja = $this->model->bajaCurso($arreglo);
				
				if($baja[0]){
					//CHARGE A SUCCESS VIEW
				}else{
					//CHARGE THE ERROR WITH $baja[1] 
				}
			}else{
				//CHARGE AN ERROR
			}
		
		}
		//UPDATE A STUDENT ON THIS CLASS
		private function matricularse(){
			if(isset($_POST['codigo']))
				$codigo = $verificador->validaNrc($_POST['nrc']);
			else
				$codigo = false;
				
			if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
			else $nrc = false;
					
			if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
			else $ciclo = false;
			
			if($codigo && $nrc && $ciclo)
				$status = true;
			else
				$status = false;
				
			if($status){
				$arreglo = array('codigo' => $_POST['codigo'], 'nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']);
				$arreglo = $verificador->limpiaSQL($arreglo);
				
				$matricula = $this->model->matricular($arreglo);
				
				if($matricula[0]){
					//CHARGE A SUCCESS VIEW
				}else{
					//CHARGE THE ERROR WITH $matricula[1] 
				}
			}else{
				//CHARGE AN ERROR
			}
		
		}
		
		private function modificaCurso(){
			if($this->esMaestro(){
				if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
				else $nrc = false;
					
				if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
				else $ciclo = false;
				
				if($nrc && $ciclo){
					if(isset($_POST['nombrecurso'])) $nombrecurso = $verificador->validaNombreCurso($_POST['nombrecurso']);
					else $nombrecurso = false;
							
					if(isset($_POST['seccion'])) $seccion = $verificador->validaSeccion($_POST['seccion']);
					else $seccion = false; 
					
					if(isset($_POST['academia'])) $academia = $verificador->validaAcademia($_POST['academia']);
					else $academia = false;
				
					if($nombrecurso && $seccion && $academia){
						$status = true;
					}
					else $status = false;
					
					if($status){
						$arreglo = array('nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']);
						if($nombrecurso)
							$arreglo['nombrecurso'] = $_POST['nombrecurso'];
						if($seccion)
							$arreglo['seccion']  = $_POST['seccion'];
						if($academia)
							$arreglo['academia'] = $_POST['academia'];
						
						$arreglo = $verificador->limpiaSQL($arreglo);
						
						$modifica = $this->modeL->modificaCurso($arreglo);
						if($modifica[0]){
							//CHARGE A SUCCCESS MODIFY
						}else{
							//CHARGE THE ERROR WITH $MODIFICA[1]
						}
					}else{
							//NOTHING TO CHANGE
					
					}
				
				
				}else{
					//ERROR
				}
			}else{
				include('Vista/erroresLogueo.php');
				faltaPermisos();
			}
		
		}
		
		//CONSULT A COURSE
		private function consultaCurso(){
			if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
			else $nrc = false;
				
			if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
			else $ciclo = false;
			
			if($nrc && $ciclo)
				$status = true;
			else
				$status = false;
				
			if($status){
				$arreglo = $verificador->limpiaSQL(array('nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']));
				
				$consultaCurso = $this->model->consultaCurso($arreglo);
				if($consultaCurso[0]){
					//Charge the data with $consultaCurso[1]
				}else{
					//Charge an error, the error is on $consultaCurso[1]
				}
				
			}else{
				//Charge an error
			}
		}
		
		private function agregaEvaluacion(){
			if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
			else $nrc = false;
				
			if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
			else $ciclo = false;
				
			if(isset($_POST['actividad'])) $actividad = $verificador->validaActividad($_POST['actividad']);
			else $actividad = false;
			
			if(isset($_POST['porcentaje'])) $porcentaje = $verificador->validaPorcentaje($_POST['porcentaje']); 
			else $porcentaje = false;
				
				
			if($nrc && $ciclo && $actividad && $porcentaje) $status = true;
			else $status = false;
				
			if($status){
				$arreglo = array('nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo'], 'actividad' => $_POST['actividad'], 'porcentaje' => $_POST['porcentaje']);
				$arreglo = $verificador->limpiaSQL($arreglo);
				$insertaEvaluacion = $this->model->insertaEvaluacion($arreglo);
				if($insertaEvaluacion[0]){
					include('Vista/insertaEvaluacion.php');
				}else{
					include('Vista/errorEvaluacion.php');
				}
			}else{
				include('Vista/errorEvaluacion.php');						
			}
		
		}
		
		private function consultaCalificacion(){
			if($this->esAlumno()){
				$codigo = $_SESSION['user'];
				$status = $this->model->consultaCalificacion($codigo);
				if($status[0]){
					//Aqui cargamos calificaciones propias
				}else{
					//Aqui va la vista de error
				}
			}else if($this->esMaestro()){
				if(isset($_POST['codigo'])) $codigo = $verificador->validaCodigo($_POST['codigo']);
				else $codigo = -1;
					
				if(isset($_POST['nrc'])) $nrc = $verificador->validaNRC($_POST['nrc']);
				else $nrc = false;
					
				if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
				else $ciclo = false;
					
					
				if($codigo && $nrc && $ciclo) $status = true;
				else $status = false;
					
				if($status){
					$arreglo = array('codigo' => $_POST['codigo'], 'nrc' => $_POST['nrc'], 'ciclo' => $_POST['ciclo']);
					$arreglo = $verificador->limpiaSQL($arreglo);
					
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
		
		private function consultaListas(){
			if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
			else $ciclo = false;
				
			if(isset($_POST['nrc'])) $nrc = $verificador->validaNRC($_POST['nrc']);
			else $nrc = false;
				
			if($ciclo === true && $nrc === true) $statuts = true;
			else $status = false;
				
			if($status){
				$consultaListas = array('ciclo' => $_POST['ciclo'], 'nrc' => $_POST['nrc']);
				$consultaListas = $verificador->limpiaSQL($consultaListas);
				
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
		
		private function clonarCurso(){
			if (isset($_POST['cicloNuevo'])) $ciclo = $verificador->validaCiclo($_POST['cicloNuevo']);
			else $ciclo = false;
			
			if(isset($_POST['nrc'])) $curso = $verificador->validaCurso($_POST['nrc']);
			 else $curso = false; 
			
			if(isset($_POST['cicloViejo'])) $cicloViejo = $verificador->validaCiclo($_POST['cicloViejo']);
			else $cicloViejo = false;
			
			if($ciclo === true && $curso === true && $cicloViejo === true) $status = true;
			else $status = false;
				
			if($status){
			
				$datosCopiar = array('nrc' => $_POST['nrc'], 'cicloViejo'=> $_POST['cicloViejo'], 'cicloNuevo' => $_POST['cicloNuevo'], 'idmaestro' => $_SESSION['user'] );
				$datosCopiar = $verificador->limpiaSQL($datosCopiar);
				$dias = $this->model->dameDias(array('ciclo'=>$_POST['cicloViejo'], 'nrc' =>$_POST['nrc']));
				$datosCopiar['fechas'] = $this->generaClases($_POST['cicloNuevo'], $_POST['dias']);
				$status = $this->model->clonarCurso($datosCopiar);
				if($status[0]){
					include('Vista/clonarCurso.php');
				}else{
					include('Vista/errorClonar.php');
				}
			}else{
				include('Vista/errorClonar.php');
			}				
		}
		
		private function capturaCalificacion(){//Method to update notes
				if(isset($_POST['calificacion']))$calificaciones = $verificador -> validaCalificaciones($_POST['calificacion']);
				else  $calificaciones = false; 

				if(isset($_POST['codigoestudiante'])) $codigo = $verificador ->validaCodigo($_POST['codigoestudiante']);
				else $codigo = false;
			
				if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
				else $nrc = false;

				if(isset($_POST['rubro'])) $rubro = $verificador->validaRubro($_POST['rubro']);
				else $rubro = false;
					
			
			if($calificaciones === true && $codigo === true && $nrc === true && $rubro === true) $status = true;
			else $status = false;
				
			if($status){
				$arreglo = array('calificacion' => $calificaciones, 'codigo' => $codigo, 'nrc'=> $nrc, 'rubro' => $rubro);
				$arreglo = $verificador->limpiaSQL($arreglo);
				
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
		
		
		private function altaCurso(){
			require_once("Curso.php");
			$curso = new Curso();

			if($this->esMaestro() || $this->esAdmin()){
				if(isset($_POST['nombrecurso'])) $nombrecurso = $verificador->validaNombreCurso($_POST['nombrecurso']);
				else $nombrecurso = false;
							
				if(isset($_POST['seccion'])) $seccion = $verificador->validaSeccion($_POST['seccion']);
				else $seccion = false; 
				
				if(isset($_POST['nrc'])) $nrc = $verificador->validaNrc($_POST['nrc']);
				else $nrc = false; 

				if(isset($_POST['academia'])) $academia = $verificador->validaAcademia($_POST['academia']);
				else $academia = false;
							
				if(isset($_POST['dias'])) $dias = $this->array_walk($_POST['dias'],array($verificador,'validaDias'));
				else $dias = false;
				
				if(isset($_POST['cantidadhoras'])) $horas = $this->validaHoras($_POST['cantidadhoras']);
				else $horas = false;
					
				if(isset($_POST['horario'])) $horario = $verificador->validaHorario($_POST['horario']);
				else $horario = false;
				
				if(isset($_POST['actividades'])) $actividad = $this->array_walk($_POST['actividades'],array($verificador,'validaActividad'));
				else $actividad = false;
				
				if(isset($_POST['porcentajes'])) $porcentaje = $this->array_walk($_POST['porcentajes'], array($verificador,'validaPorcentaje'));
				 else $porcentaje = false;
			
				if(isset($_POST['ciclo'])) $ciclo = $verificador->validaCiclo($_POST['ciclo']);
				else $ciclo = false;
				
				if($nombrecurso && $seccion && $nrc && $academia && $dias && $horas && $horario && $actividad && $porcentaje && $ciclo) $status = true;
				else $status = false;
				
				if($status){
					$datoscurso = array('nombrecurso' => $_POST['nombrecurso'], 'seccion' => $_POST['seccion'], 'nrc' => $_POST['nrc'],
										'academia' => $_POST['academia'],  'horas' => $_POST['horas'], 'horario' => $_POST['horario'],
										 'ciclo' => $_POST['ciclo']);
					$datoscurso = $verificador->limpiaSQL($datoscurso);

					$curso->setNombreCurso($datoscurso['nrc']);
					$curso->setSeccion($datoscurso['nrc']);
					$curso->setNRC($datoscurso['nrc']);
					$curso->setAcademia($datoscurso['academia']);
					$curso->setHoras($datoscurso['horas']);
					$curso->setHorario($datoscurso['horario']);
					$curso->setCiclo($datoscurso['ciclo']);
					
					$datoscurso['horario'] = date('H',strtotime($datoscurso['horario']));
					$datoscurso['dias'] = $_POST['dias'];
					
					//Generate the dates of class, add to $datoscurso
					$ciclo = ltrim($_POST['ciclo']);
					$ciclo = rtrim($ciclo);
					$datoscurso['fechas'] = $this->generaClases($ciclo, $_POST['dias']);
					$status = $this->model->nuevoCurso($datoscurso);
					if($status[0]){
					
						//NOW INSERT THE ACTIVITIES FOR THE CLASS
						$status = $this->model->insertaEvaluacionA(array('actividades' => $_POST['actividades'], 'porcentajes' => $_POST['porcentajes'],
																		'idcurso' => $status[2]));
						if($status){
							include('Vista/nuevoCurso.php');
						}
						else{
							include('Vista/errorCurso.php');
							errorAlta($status[1]);
						}
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
		
		private function alta(){
			if($this->esMaestro() || $this->esAdmin()){
				if(isset($_POST['nombre'])) $nombre = $verificador->validaNombre($_POST['nombre']);
				else $nombre = false;

				if(isset($_POST['correo'])) $correo = $verificador->validaCorreo($_POST['correo']);
				else $correo = false;

				if(isset($_POST['codigo'])) $codigo = $verificador->validaCodigo($_POST['codigo']);
				else $codigo = false;	

				if(isset($_POST['contraseña'])) $contraseña = $verificador->validaPass($_POST['contraseña']);
				else $contraseña = false;
			
				if($nombre === true && $correo === true && $codigo === true && $contraseña === true) $status = true;
				else $status = false;
					
				if($status){
					$datosMaestro = array('nombre' => $_POST['nombre'], 'correo' => $_POST['correo'], 'codigo' => $_POST['codigo'], 'contraseña' => $_POST['contraseña']);
					$datosMaestro = $verificador->limpiaSQL($datosMaestro);
					$insercion = $this->model->inserta($datosMaestro);
					if($insercion[0]){
						include('Vista/insercionMaestro.php');
						
						//Send email of up on the website
						//enviaCorreo($datosMaestro['correo'],$datosMaestro['nombre']); //enviaCorreo(email,name);
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
	
	private function generaClases($ciclo, $dias){
	
		$dameFechas = $this->model->fechasCI($ciclo);
		
		$clases = $this->dameDiasCurso($dameFechas['fechaInicial'], $dameFechas['fechaFinal'], $dias);
		
		return $clases;
	}
	
	private function dameDiasCurso($fechaInicial, $fechaFinal, $dias){
		$fechasClase = array();
		$encuentroPrimerClase = false;
		$clases = array();

		$fechaInicial = str_replace('/', '-', $fechaInicial); //Change the format to adapt the string
		$fechaFinal = str_replace('/','-',$fechaFinal);//Change the format too
		$fechaFinal = date("d-m-Y",strtotime($fechaFinal));//We use to compare with the dates

			for($i = 0; $i < count($dias); $i++){
				$fechaInicial1 = date("d-m-Y",strtotime($fechaInicial));
				while(!$encuentroPrimerClase){
					if(date("N", strtotime($fechaInicial1)) == $dias[$i]){
						$encuentroPrimerClase = true;
						break;
					}
					else
						$fechaInicial1 = date("d-m-Y",strtotime($fechaInicial1." +1 days"));
				}
				if($encuentroPrimerClase){
					$fechasClase[] = $fechaInicial1;
					$encuentroPrimerClase = false;
				}
			}
			
		for($i = 0; $i < count($fechasClase); $i++){
			if(strtotime($fechasClase[$i]) <= strtotime($fechaFinal))
				$clases[] = $fechasClase[$i];
		}
		
		if(count($clases) == 0){//The date of beginning is not enough to create dates of class until the end
			include('erroresCurso.php');
			errorFecha(4);
			return false;
		}
		else{//We begin to give the rest of classes
			for($i = 0, $j = count($clases); $i < $j; $i++){//We use j instead of count to be a little more faster and not count each time
				$nuevo = $clases[$i];
				$nuevo = date("d-m-Y",strtotime($nuevo." +1 week"));
				if(strtotime($nuevo) <= strtotime($fechaFinal)){
					$clases[] = $nuevo;
					$j++;//We add to j to follow the array
				}
				else
					break;
			}
			
			//Prepare the format Y-M-D
			for($i = 0, $j = count($clases); $i < $j;$i++){
				$clases[$i] = DateTime::createFromFormat('d-m-Y', $clases[$i]);
				$clases[$i] = $clases[$i]->format('Y-m-d');
			}
			return $clases;
		}
	}
		private function baja(){
			if($this->esAdmin()){
				if(isset($_POST['codigo'])) $codigo = $verificador->validaCodigo($_POST['codigo']);
				else  $codigo = false;
					
				if($codigo){
					$arreglo = $verificador->limpiaSQL(array('codigo' => $_POST['codigo']));
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
		private function modifica(){
			if($this->esMaestro() || $this->esAdmin()){
				if($this->esMaestro()){
					$codigo = true; //He is logged, and he has an id for his session
				}else if(isset($_POST['codigo'])) $codigo = $verificador->validaCodigo($_POST['codigo']);
				else $codigo = false;
					
				if(isset($_POST['nombre'])) $nombre = $verificador->validaNombre($_POST['nombre']);
				else $nombre = false;
					
				if(isset($_POST['correo'])) $correo = $verificador->validaCorreo($_POST['correo']);
				else $correo = false;
				
				if(isset($_POST['contraseña'])) $contraseña = $verificador->validaPass($_POST['contraseña']);
				else $contraseña = false;
					
					
				if($codigo !== -1 && $codigo !== false && $nombre !== -1 && $correo !== -1 && $contraseña !== -1) $status = true;
				else $status = false;

				if($status){
					if($nombre === false && $correo === false && $contraseña === false) $status = false;
					else $status = true;

					if($status){
						$nuevaInfo = array();

						if($this->esMaestro()) $nuevaInfo['codigo'] = $_SESSION['user'];
						else $nuevaInfo['codigo'] = $_POST['codigo'];
							
						if($nombre !== false) $nuevaInfo['nombre'] = $_POST['nombre'];
						if($correo !== false) $nuevaInfo['correo'] = $_POST['correo'];
						if($contraseña !== false) $nuevaInfo['contraseña'] = $_POST['contraseña'];
							
						$nuevaInfo = $verificador->limpiaSQL($nuevaInfo);
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
		
		private function consulta(){
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
				if(isset($_POST['codigo']))$codigo = $verificador->validaCodigo($_POST['codigo']);
				else $codigo = false;
				
				if($codigo){//Succes with code, now we're going to search his / her grades or info
					$arreglo = array('codigo' =>  $_POST['codigo']);
					$arreglo = $verificador->limpiaSQL($arreglo);
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
		
	}
?>