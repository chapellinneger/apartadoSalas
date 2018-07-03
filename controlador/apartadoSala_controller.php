<?php
include('./../modelo/apartadoSala_model.php');
header('Content-type: text/html; charset=utf-8');
$cedula = '17247432';//$_SESSION['cedula'];
$nombre = 'jorge rengifo';//$_SESSION['primer_nombre']." ".$_SESSION['primer_apellido'];
$correo = 'jrengifo@mppef.gob.ve';//$_SESSION['correo'];

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

	$resultado_existencia = $apartadoSala_model->verifica_existencia_curso($hora_inicio,$hora_fin,$sala_evento,$id_curso);
	if($resultado_existencia){
		$response = array(
			"cod" => false,
			"mensaje" => 'Ya existe un evento cargado en esta hora',
			);
		echo json_encode($response);//retorna el areglo $response
		die();
	}

	if($id_curso == 0){
		$array_insert = [
			'titulo_curso' => $titulo,
			'descrip_curso' => $descripcion,
			'id_sala' => $sala_evento,
			'id_tipo_curso' => $tipo_envento,
			'hora_ini' => $hora_inicio,
			'hora_fin' => $hora_fin,
			'num_cedula' => $cedula,
			'nombre_apellido' => $nombre,
			'correo' => $correo
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
		$mensaje = 'Dato Cargado Correctamente !!!';
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
	//echo 'pase por aqui';
	$resultado = $apartadoSala_model->consulta_salas();
	$resultado2 = $apartadoSala_model->consulta_tipo_curso();
	$response = array(
		"res" => $resultado,
		"res2" => $resultado2,
		"nombre" => $nombre
	);
	echo json_encode($response);//retorna el areglo $response
	die();
}

if($accion == 2){
	$id_sala = $_POST['id_sala'];
	$resultado = $apartadoSala_model->consulta_curso($id_sala);
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
