<?php
include('./../modelo/apartadoSala_model.php');
header('Content-type: text/html; charset=utf-8');

$accion = $_POST['accion'];

$apartadoSala_model = new apartadoSala_model();

if($accion==0){
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$sala_evento = $_POST['sala_evento'];
	$tipo_envento = $_POST['tipo_evento'];
	$hora_inicio = $_POST['hora_inicio'];
	$hora_fin = $_POST['hora_fin'];
	$id_curso = $_POST['id_curso'];
	$cod = false;
	
	if($id_curso == 0){
		$array_insert = [
			'titulo_curso' => $titulo,
			'descrip_curso' => $descripcion,
			'id_sala' => $sala_evento,
			'id_tipo_curso' => $tipo_envento,
			'hora_ini' => $hora_inicio,
			'hora_fin' => $hora_fin
		];
	
		$resultado = $apartadoSala_model->insertar_datos(
										'reserva_salas_nueva.curso',
										$array_insert,
										';'
									   );
	}else{
		$array_update = [
			'titulo_curso' => $titulo,
			'descrip_curso' => $descripcion,
			'id_sala' => $sala_evento,
			'id_tipo_curso' => $tipo_envento,
			'hora_ini' => $hora_inicio,
			'hora_fin' => $hora_fin
		];
		
		$resultado = $apartadoSala_model->update_datos(
										'reserva_salas_nueva.curso',
										$array_update,
										' id_curso = '.$id_curso
									   );
	
	}
	
	if ($resultado){
		$cod = true;
		$mensaje = 'Dato Cargado Corectamente !!!';
	}else{
		$mensaje = 'Error al insetar la Sala !!!';
	}
	
	$response = array(
		"cod" => $cod,
		"mensaje" => $mensaje,
		"res" => $array_insert,
		);
	echo json_encode($response);//retorna el areglo $response
	die();
}

if($accion == 1){
	$resultado = $apartadoSala_model->consulta_salas();
	$resultado2 = $apartadoSala_model->consulta_tipo_curso();
	$response = array(
		"res" => $resultado,
		"res2" => $resultado2
	);
	echo json_encode($response);//retorna el areglo $response
	die();
}

if($accion == 2){
	$resultado = $apartadoSala_model->consulta_curso();
	//print_r($resultado);
	$response = array(
		"res" => $resultado
	);
	echo json_encode($response);//retorna el areglo $response
	die();
}

if($accion == 3){
	
	$id = $_POST['id'];
	$resultado = $apartadoSala_model->consulta_curso_id($id);
	$response = array(
		"res" => $resultado
	);
	echo json_encode($response);//retorna el areglo $response
	die();
}

if($accion == 4){
	
	$id = $_POST['id'];
	$resultado = $apartadoSala_model->eliminar_curso($id);
	if($resultado){
		$response = array(
		"mensaje" => "Datos eliminado correctamente!!!"
		);
	}else{
		$response = array(
		"mensaje" => "Datos no fueron eliminados!!!"
		);
	}

	echo json_encode($response);//retorna el areglo $response
	die();
}
