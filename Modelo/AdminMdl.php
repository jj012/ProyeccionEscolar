<?php
    /**
	 * @author J. Rizo Orozco & Jesus Alberto Ley Ayón
	 *  @since 
	 * 
	 */
	 require("MdlEstandar.php");
    class AdminMdl extends MdlEstandar{
    	public $conexion;
	
	public function nuevoCiclo($ciclo){
		return true;
	}
	
	}
	
?>