<?php
	function procesarPlantillaCAcademias($academias) {
		$tabla='';
		pintar_comienzo_tabla();
		for ($i = 0; $i < count($vector); $i++)
			$tabla=$tabla."<tr><td>$i</td><td>$vector[$i]->getNombre()</td></tr>";
		pintar_fin_tabla();
	}
?>