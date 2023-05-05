<?php

$raiz= $_SERVER['DOCUMENT_ROOT'];

date_default_timezone_set('America/Bogota');

require_once($raiz.'/fpdf/fpdf.php');

$pdf=new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(180,10,$nombre_empresa,0,0,'C');



$pdf->SetY(25);

$pdf->SetFont('Arial','',12);

$pdf->Cell(180,10,'ORDEN DE SERVICIO NO '.'274',1,1,'C');

$pdf->Cell(40,10,'Propietario ',1,0,'L');

$pdf->Cell(50,10,$cliente['datos'][0]['nombre'],1,0,'L');

$pdf->Cell(40,10,'',1,0,'L');

$pdf->Cell(50,10,'',1,1,'L');

$pdf->Cell(40,10,'Marca ',1,0,'L');

$pdf->Cell(50,10,$carro['datos'][0]['marca'],1,0,'L');

$pdf->Cell(40,10,'Modelo',1,0,'L');

$pdf->Cell(50,10,$carro['datos'][0]['modelo'],1,1,'L');

$pdf->Cell(40,10,'Color ',1,0,'L');

$pdf->Cell(50,10,$carro['datos'][0]['color'],1,0,'L');

$pdf->Cell(40,10,'Placa',1,0,'L');

$pdf->Cell(50,10,$carro['datos'][0]['placa'],1,1,'L');

$pdf->Cell(40,10,'VenciSoat ',1,0,'L');

$pdf->Cell(50,10,$carro['datos'][0]['vencisoat'],1,0,'L');

$pdf->Cell(40,10,'Ref',1,0,'L');

$pdf->Cell(50,10,'',1,1,'L');

$pdf->Cell(40,10,'Amortiguadores ',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['amortiguadores'],1,0,'L');

$pdf->Cell(40,10,'Kilometraje',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['klm'],1,1,'L');



$pdf->Cell(40,10,'Exosto',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['exosto'],1,0,'L');

$pdf->Cell(40,10,'Frenos',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['frenos'],1,1,'L');



$pdf->Cell(40,10,'Kit de arrastre ',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['arrastre'],1,0,'L');

$pdf->Cell(40,10,'Luces',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['luces'],1,1,'L');



$pdf->Cell(40,10,'Llantas ',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['llantas'],1,0,'L');

$pdf->Cell(40,10,'Motor',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['motor'],1,1,'L');



$pdf->Cell(40,10,'Sillin ',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['sillin'],1,0,'L');

$pdf->Cell(40,10,'Tacometro',1,0,'L');

$pdf->Cell(50,10,$peritaje[0]['tacometro'],1,1,'L');

$pdf->Cell(180,10,'OBSERVACIONES',1,1,'C');

$pdf->Cell(180,50,$peritaje[0]['observ'],1,1,'C');

$pdf->Cell(90,10,'ELABORO',1,0,'L');

$pdf->Cell(90,10,'APROBO',1,1,'L');

$pdf->Output();

?>

?>