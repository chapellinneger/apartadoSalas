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

	function update_datos($nombre_tabla,$array,$where){
		$datos_generico = new clase_generica();
		$datos_generico->setRow($array);
		$sql = $datos_generico->update($nombre_tabla);
		$sql = $sql.$where;
		echo $sql;
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

	function consulta_salas(){
		$datos_generico = new clase_generica();
		$sql = "SELECT * FROM reserva_salas_nueva.salas";
		$result = $datos_generico->ConsultaG($sql);
		return $result;
	}

	function consulta_tipo_curso(){
		$datos_generico = new clase_generica();
		$sql = "SELECT * FROM reserva_salas_nueva.tipo_curso";
		$result = $datos_generico->ConsultaG($sql);
		return $result;
	}

	function consulta_curso($id_sala){
		if ($id_sala == null){
			$id_sala = 1;
		}
		$datos_generico = new clase_generica();
		$sql = "SELECT * FROM reserva_salas_nueva.curso where id_sala = $id_sala";
		$result = $datos_generico->ConsultaG($sql);
		return $result;
	}

	function consulta_curso_id($id){
		$datos_generico = new clase_generica();
		$sql = "SELECT * FROM reserva_salas_nueva.curso WHERE id_curso = $id";
		//echo $sql;
		$result = $datos_generico->ConsultaG($sql);
		return $result;
	}

	function eliminar_curso($id){
		$datos_generico = new clase_generica();
		$sql = "DELETE FROM reserva_salas_nueva.curso WHERE id_curso = $id;";
		//echo $sql;
		$result = $datos_generico->ConsultaG($sql);
		if($result){
			return true;
	                //echo 'paso bien';
		}else {
			return false;
			//echo 'paso mal';
		}
	}

	function verifica_existencia_curso($hora_ini,$hora_fin, $id_sala,$id_curso=''){
		$datos_generico = new clase_generica();
		$where_2 = '';
		if($id_curso!=''){
			$where_2 = 'AND id_curso <> '.$id_curso;
		}
		$sql = "SELECT a.* FROM reserva_salas_nueva.curso
						as a WHERE
						a.id_sala = $id_sala AND
						a.hora_ini BETWEEN '$hora_ini' AND '$hora_fin' $where_2
						or
						a.id_sala = $id_sala AND
						a.hora_fin BETWEEN '$hora_ini' AND '$hora_fin' $where_2;";
		//echo $sql;
		$result = $datos_generico->ConsultaG($sql);
		if($result){
			return true;
	                //echo 'paso bien';
		}else {
			return false;
			//echo 'paso mal';
		}
	}

}
