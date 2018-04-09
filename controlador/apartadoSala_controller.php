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
	 
	$cod = false;
	
	$array_insert = [
		'titulo' => $titulo,
		'descripcion' => $descripcion,
		'sala_evento' => $sala_evento,
		'tipo_envento' => $tipo_envento,
		'hora_inicio' => $hora_inicio,
		'hora_fin' => $hora_fin
	];
	
	$resultado = $apartadoSala_model->insertar_datos(
										'salas_apartadas',
										$array_insert,
										';'
									   );
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
