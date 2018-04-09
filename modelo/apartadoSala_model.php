<?php
include_once './../conf/clase_generica.php';

class apartadoSala_model  extends clase_generica{
	function __construct() {
	}
	
	function insertar_datos($nombre_tabla, $array, $where) {
		$datos_generico = new clase_generica();
		$datos_generico->setRow($array);
		$sql = $datos_generico->insert($nombre_tabla);
		$sql = $sql.$where;
		return $sql;
		$result = $datos_generico->ConsultaG($sql);
		//echo $result;
		if($result){
			return true;
	                //echo 'paso bien';
		}else {
			return false;
			//echo 'paso mal';
		}
	}
	
	function update_datos($nombre_tabla,$array,$where){
		$datos_generico = new clase_generica();
		$datos_generico->setRow($array);
		$sql = $datos_generico->update($nombre_tabla);
		$sql = $sql.$where;
		//echo $sql;
		$result = $datos_generico->ConsultaG($sql);
		//echo $result;
		if($result){
			return true;
	                //echo 'paso bien';
		}else {
			return false;
			//echo 'paso mal';
		}		
			
	}
	
	function consulta_apartados(){
		$datos_generico = new clase_generica();
		$sql = "SELECT * FROM salas_apartadas";
		$result = $datos_generico->ConsultaG($sql);
		return $result;
	}

}
