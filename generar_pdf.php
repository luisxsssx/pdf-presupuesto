<?php
require('fpdf/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(20, 20, 20);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Cotización', 0, 1, 'C');

$pdf->SetDisplayMode('fullpage', 'single');

// Recibir los datos del formulario
$fecha = $_POST['fecha'];
$cliente = $_POST['cliente'];
$contacto = $_POST['contacto'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

$items = $_POST['item'];
$descriptions = $_POST['description'];
$prices = $_POST['price'];

$cantidad = $_POST['cantidad'];
$cantidadLetras = $_POST['cantidadLetras'];
$nota = $_POST['nota'];

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Márgenes y fuente inicial
$pdf->SetMargins(10, 10, 10);
$pdf->SetFont('Arial', '', 12);

// Estilos del título
$pdf->SetFillColor(52, 58, 64); // Color de fondo 
$pdf->Rect(10, $pdf->GetY(), 190, 20, 'F');

$pdf->SetFont('Arial', 'B', 28);
$pdf->SetTextColor(248, 249, 250); // Color del texto
$pdf->Cell(0, 20, mb_convert_encoding('Cotización', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', false); // Título centrado
$pdf->Ln(10); // Espacio debajo del título


// Información del cliente
$pdf->SetTextColor(14, 13, 13); // Color negro #0e0d0d
$pdf->SetFont('Arial', '', 16);
$pdf->MultiCell(0, 10, mb_convert_encoding("Fecha: $fecha\nCliente: $cliente\nContacto: $contacto\nTeléfono: $telefono\nEmail: $email", 'ISO-8859-1', 'UTF-8'));
$pdf->Ln(10); // Espacio debajo de la información

// Crear tabla de ítems
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(173, 181, 189);
$pdf->SetTextColor(0); // Color del texto negro
$pdf->Cell(60, 10, mb_convert_encoding('Item', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', true);
$pdf->Cell(80, 10, mb_convert_encoding('Description', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', true);
$pdf->Cell(40, 10, mb_convert_encoding('Price', 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', true);

// Datos de la tabla (alternar color de filas)
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(242, 242, 242);
$pdf->SetTextColor(0);

for ($i = 0; $i < count($items); $i++) {
    $fill = ($i % 2 == 0) ? true : false;
    $pdf->Cell(60, 10, mb_convert_encoding($items[$i], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill);
    $pdf->Cell(80, 10, mb_convert_encoding($descriptions[$i], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill);
    $pdf->Cell(40, 10, '$' . number_format($prices[$i], 2), 1, 1, 'L', $fill);
}

$pdf->Ln(20); // Espacio debajo de la tabla

$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(0, 10, mb_convert_encoding("Cantidad: $cantidad\n(Cantidad en letras: $cantidadLetras)\nNota: $nota", 'ISO-8859-1', 'UTF-8'));
$pdf->Ln(10); // Espacio

$pdf->SetLineWidth(0.5); // Borde más grueso
$pdf->SetDrawColor(0, 0, 0); // Color del borde negro
$pdf->Rect(80, $pdf->GetY(), 50, 30); // Dibujar el borde del bloque de la nota
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, mb_convert_encoding("Nota: $nota", 'ISO-8859-1', 'UTF-8'), 0, 'C'); // Centrado
$pdf->Ln(10);

// Mostrar PDF
$pdf->Output();

