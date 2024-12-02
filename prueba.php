<?php
require_once('tcpdf/tcpdf.php'); // Ajusta la ruta según donde hayas colocado TCPDF

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0, 'Hola, TCPDF está instalado correctamente.');
$pdf->Output('prueba.pdf', 'I'); // Muestra el PDF en el navegador
?>