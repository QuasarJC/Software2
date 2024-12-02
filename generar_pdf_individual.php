<?php
$pdfFilePath = 'C:\xampp\htdocs\Software2\TCPDF\TCPDF\examples\Reporte de servicio27011.pdf';
session_start();
include("conexion.php"); 
if (file_exists($pdfFilePath)) {
    
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($pdfFilePath) . '"');
    header('Content-Length: ' . filesize($pdfFilePath));
    

    readfile($pdfFilePath);
    exit;
} else {
    echo "El archivo PDF no se encontró.";
}
?>
// Obtener el ID del reporte desde la URL
$id = intval($_GET['id']);

// Consultar el reporte específico en la base de datos
$sql = "SELECT * FROM reportes WHERE id = $id";
$result = $conexion->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Crear un nuevo PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    // Agregar contenido al PDF
    $pdf->Write(0, 'Número de Reporte: ' . htmlspecialchars($row['numero_reporte']));
    $pdf->Ln(); // Nueva línea
    $pdf->Write(0, 'Cliente: ' . htmlspecialchars($row['cliente']));
    $pdf->Ln();
    $pdf->Write(0, 'Usuario: ' . htmlspecialchars($row['usuario']));
    $pdf->Ln();
    $pdf->Write(0, 'Equipo: ' . htmlspecialchars($row['equipo']));
    $pdf->Ln();
    $pdf->Write(0, 'Fecha: ' . htmlspecialchars($row['fecha']));
    // Agrega más contenido según lo necesites...

    // Mostrar el PDF en el navegador
    $pdf->Output('reporte_individual_' . $id . '.pdf', 'I'); // 'I' para mostrar en el navegador
} else {
    echo "No se encontró el reporte.";
}
?>