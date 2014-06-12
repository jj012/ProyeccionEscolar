<?php
	require_once ('RECONSTRUCCION/OBJETOS/Academia.php');
	echo 'GENERANDO ACADEMIAS DE PRUEBA';
	$encabezado = file_get_contents('RECONSTRUCCION/VISTAS/COMUNES/header.html');
	$pie = file_get_contents('RECONSTRUCCION/VISTAS/COMUNES/footer.html');
	$academia1 = new Academia;
	$academia1 -> setId(1);
	$academia1 -> setNombre('Sistemas Digitales');
	
	$academia2 = new Academia;
	$academia2 -> setId(2);
	$academia2 -> setNombre('Programacion Basica');
	
	$academia3 = new Academia;
	$academia3 -> setId(3);
	$academia3 -> setNombre('Algoritmia');
	
	$academias[0] = $academia1;
	$academias[1] = $academia2;
	$academias[2] = $academia3;
	
	var_dump($academias);
	procesarPlantillaCAcademias($academias);
	
	function procesarPlantillaCAcademias($academias) {
		require_once ('RECONSTRUCCION/OBJETOS/Academia.php');
		$filename = 'RECONSTRUCCION/VISTAS/PLANTILLAS/consultaAcademias.html';
		$tabla = '';
		$academia = new Academia;
		
		if (file_exists($filename)) {
			$plantilla = file_get_contents($filename);
			foreach ($academias as $academia) {
				$id=$academia->getId();
				$nombre=$academia->getNombre();
				$tabla = $tabla . "<tr>
									<td>$id</td>"."
								<td>$nombre</td>
								</tr>";
				//echo $tabla;
			}
	
			$plantilla=str_replace('{{REPITE_ACADEMIAS}}', $tabla, "$plantilla");
			$pagina = "$encabezado" + "$plantilla" + "$pie";
			echo "$plantilla";
		} else {
			echo "ERROR NO SE ENCONTRO EL ARCHIVO";
		}
	
	}
	
	function procesaPlantillaCMaterias($materias){
		require_once ('RECONSTRUCCION/OBJETOS/Materia.php');
		$filename = 'RECONSTRUCCION/VISTAS/PLANTILLAS/consultaAcademias.html';
		$tabla = '';
		$materia = new Materia;
		if (file_exists($filename)) {
			$plantilla = file_get_contents($filename);
			foreach ($materias as $materia) {
				$clave=$materia->getClave();
				$nombre=$materia->getNombre();
				$academia=$materia->getAcademia();
				$tabla = $tabla ."<tr><td>$clave</td>"
								."<td>$nombre</td>"
								."<td>$academia</td></tr>";
				//echo $tabla;
			}
	
			$plantilla=str_replace('{{REPITE_MATERIAS}}', $tabla, "$plantilla");
			$pagina = "$encabezado" + "$plantilla" + "$pie";
			echo "$plantilla";
		} else {
			echo "ERROR NO SE ENCONTRO EL ARCHIVO";
		}
?>