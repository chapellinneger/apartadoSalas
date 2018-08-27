<?php
include('./../modelo/apartadoSala_model.php');
include('./reporte_controller.php');

$sala_evento = $_GET['sala_evento'];
$hora_inicio = $_GET['hora_inicio'];
$hora_fin = $_GET['hora_fin'];

$apartadoSala_model = new apartadoSala_model();

$resultado = $apartadoSala_model->reporte_existencia_curso($hora_inicio,$hora_fin,$sala_evento);
//echo $resultado[0]['nombre_apellido'];
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,6,'FECHA INCIO',1,0,'C',1);
$pdf->Cell(60,6,'FECHA FIN',1,0,'C',1);
$pdf->Cell(70,6,'RESPONSABLE',1,1,'C',1);

$pdf->SetFont('Arial','',10);

foreach ($resultado as $data) {
  $pdf->Cell(60,6,$data['hora_ini'],1,0,'C');
  $pdf->Cell(60,6,$data['hora_fin'],1,0,'C');
  $pdf->Cell(70,6,utf8_decode($data['nombre_apellido']),1,1,'C');
}

$pdf->Output();
?>
