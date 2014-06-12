<?php
	require_once('RECONSTRUCCION/OBJETOS/Academia.php');
	$encabezado=file_get_contents('RECONSTRUCCION/VISTAS/COMUNES/header.html');
	$pie=file_get_contents('RECONSTRUCCION/VISTAS/COMUNES/footer.html');
	$academia1 = new Academia;
	$academia1->setId(1);
	$academia1->setNombre('Sistemas Digitales');
	
	$academia2 = new Academia;
	$academia2->setId(2);
	$academia2->setNombre('Programacion Basica');
	
	$academia3 = new Academia;
	$academia3->setId(3);
	$academia3->setNombre('Algoritmia');
	
	$academias[0]=$academia1;
	$academias[1]=$academia2;
	$academias[2]=$academia3;
	
	function procesarPlantillaCAcademias($academias) {
		require_once('RECONSTRUCCION/OBJETOS/Academia.php');
		$plantilla=	file_get_contents('VISTAS/PLANTILLAS/consultaAcademias');
		$tabla='';
		$academia = new Academia;

		foreach($academias as $academia){
			$tabla=$tabla.'<tr>
								<td>{$academia->getId()}</td>
								<td>{$academia->getNombre()}</td>
							</tr>';
		}
		
		str_replace('{{RETIPE_ACADEMIAS}}', $tabla,$plantilla);
		$pagina=$encabezado+$plantilla+$pie;
		echo $pagina;
		
	}
?>