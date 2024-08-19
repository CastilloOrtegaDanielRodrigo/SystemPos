<?php
require('../fpdf.php');

// Crear un nuevo objeto PDF con las dimensiones especificadas
$pdf = new FPDF($orientation='P', $unit='mm', array(58, 160));
$pdf->SetMargins(3, 3, 3); // Márgenes: 3mm en cada lado

// Añadir una nueva página
$pdf->AddPage();
// Cargar el logo y posicionarlo
$pdf->Image('../../vistas/img/plantilla/logo-biss.png', 19, 3, 20); // Ajustar la posición y tamaño del logo
$pdf->Ln(20); // Espacio después del logo

// Establecer el tipo de fuente y el tamaño
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, 'Biss-Comunicaciones', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 4, 'Insurgentes No.63, San Lucas Tunco, Metepec, Edo Mex', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(0, 4, 'Contratos: 7291320514', 0, 1, 'C');
$pdf->Cell(0, 4, 'Soporte: 7221087695', 0, 1, 'C');
$pdf->Ln(2);
$pdf->Cell(0, 4, '_____________________', 0, 1, 'C');
$pdf->Ln(4);

// Obtener datos de la URL
$idPago = isset($_GET['id']) ? $_GET['id'] : '';
$mes = isset($_GET['mes']) ? $_GET['mes'] : '';
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$nombreCliente = isset($_GET['nom']) ? $_GET['nom'] : '';
$total = isset($_GET['total']) ? $_GET['total'] : '';

// Convertir el texto a UTF-8
$nombreCliente = utf8_decode($nombreCliente);
$mes = utf8_decode($mes);
$fecha = utf8_decode($fecha);
$total = utf8_decode($total);

// Supongamos que tienes un array con los detalles del historial de pago
$detallePago = array(
    'mes' => $mes,
    'fecha' => $fecha,
    'total' => $total,
);

// Mostrar los detalles del historial de pago recibido como parámetro
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Recibi de:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 4, $nombreCliente, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Concepto:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 4, 'Renta de equipo de telecomunicaciones correspondiente al ' . $detallePago['mes'], 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Total: $' . $detallePago['total'], 0, 1, 'C');
$pdf->Ln(12);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 6, 'Gracias por su pago:', 0, 1, 'C');
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 6, $detallePago['fecha'], 0, 1, 'C');

// Salida del PDF
$pdf->Output();
?>
