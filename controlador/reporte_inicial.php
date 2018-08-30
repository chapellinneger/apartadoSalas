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

$pdf->SetFont('Arial','B',15);
$pdf->Cell(15,6,'Sala:',0,0,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,6,$resultado[0]['descrip_sala'],0,0,'L');
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
//$pdf->Cell(35,6,'SALA RESERVADA',1,0,'C',1);
$pdf->Cell(35,6,'TITULO',1,0,'C',1);
$pdf->Cell(30,6,'RESPONSABLE',1,0,'C',1);
$pdf->Cell(30,6,'FECHA INCIO',1,0,'C',1);
$pdf->Cell(30,6,'FECHA FIN',1,0,'C',1);
$pdf->Cell(60,6,'DESCRIPCION CURSO',1,0,'C',1);
$pdf->Ln();//Salto de línea para generar otra fila


$pdf->SetFont('Arial','',8);

foreach ($resultado as $data) {
  //$pdf->Cell(35,6,utf8_decode($data['descrip_sala']),1,0,'C');
  $pdf->Cell(35,6,utf8_decode($data['titulo_curso']),1,0,'C');
  $pdf->Cell(30,6,utf8_decode($data['nombre_apellido']),1,0,'C');
  $pdf->Cell(30,6,$data['hora_ini'],1,0,'C');
  $pdf->Cell(30,6,$data['hora_fin'],1,0,'C');
  $pdf->Cell(60,6,utf8_decode($data['descrip_curso']),1,1,'C');

}

$pdf->Output();
?>
