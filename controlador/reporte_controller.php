<?php
	require './../static/fpdf181/fpdf.php';

	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('./../static/images/Imagen_report.png', 175, 9, 25 );
			$this->SetFont('Arial','B',8);
			$this->Cell(15);
			$this->Cell(32,3,'REPUBLICA BOLIVARIANA DE VENEZUELA',0,0,'C');
			$this->Ln();
			$this->Cell(23,3,'MINISTERIO DEL PODER POPULAR DE ECONOMIA Y FINANZAS',0,0,'L');
			$this->Ln();
			$this->Cell(23,3,'OFICINA NACIONAL DE CONTABILIDAD PUBLICA',0,0,'L');
			$this->Ln(30);
			$this->SetFont('Arial','B',15);
			$this->Cell(70);
			$this->Cell(50,10, 'REPORTE DE RESERVA DE SALAS',0,0,'C');
			$this->Ln(20);
		}

		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}
?>
