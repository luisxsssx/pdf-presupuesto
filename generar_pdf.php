<?php
// Incluir la biblioteca FPDF
require('fpdf/fpdf.php');

// Inicializar el documento PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(20, 20, 20); // Establecer márgenes
$pdf->AddPage(); // Añadir una nueva página

$pdf->SetDisplayMode('fullpage', 'single'); // Establecer modo de visualización

// Recibir datos del formulario
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

// Márgenes y fuente inicial
$pdf->SetMargins(10, 10, 10);
$pdf->SetFont('Arial', '', 12);

// Estilo del título con fondo
$pdf->SetFillColor(52, 58, 64); // Color de fondo
$pdf->Rect(10, $pdf->GetY(), 190, 20, 'F'); // Dibujar un rectángulo de fondo

$pdf->SetFont('Arial', 'B', 28); // Cambiar fuente para el título
$pdf->SetTextColor(248, 249, 250); // Establecer color de texto
$pdf->Cell(0, 20, mb_convert_encoding('Cotización', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', false); // Título centrado
$pdf->Ln(10); // Espacio debajo del título

// Información del cliente
$pdf->SetTextColor(14, 13, 13); // Color del texto
$pdf->SetFont('Arial', '', 16); // Fuente para la información
$pdf->MultiCell(0, 10, mb_convert_encoding("Fecha: $fecha\nCliente: $cliente\nContacto: $contacto\nTeléfono: $telefono\nEmail: $email", 'ISO-8859-1', 'UTF-8')); // Mostrar información
$pdf->Ln(10); // Espacio debajo de la información

// Crear tabla de ítems
$pdf->SetFont('Arial', 'B', 12); // Fuente para encabezados de la tabla
$pdf->SetFillColor(173, 181, 189); // Color de fondo de los encabezados
$pdf->SetTextColor(0); // Color del texto negro
$pdf->Cell(60, 10, mb_convert_encoding('Item', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', true); // Encabezado de "Item"
$pdf->Cell(80, 10, mb_convert_encoding('Description', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', true); // Encabezado de "Descripción"
$pdf->Cell(40, 10, mb_convert_encoding('Price', 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', true); // Encabezado de "Precio"

// Datos de la tabla (alternar color de filas)
$pdf->SetFont('Arial', '', 12); // Cambiar a fuente normal
$pdf->SetFillColor(242, 242, 242); // Color de fondo alternativo
$pdf->SetTextColor(0); // Color del texto negro

// Llenar la tabla con los ítems
for ($i = 0; $i < count($items); $i++) {
    $fill = ($i % 2 == 0) ? true : false; // Alternar color de fondo
    $pdf->Cell(60, 10, mb_convert_encoding($items[$i], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill); // Item
    $pdf->Cell(80, 10, mb_convert_encoding($descriptions[$i], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill); // Descripción
    $pdf->Cell(40, 10, '$' . number_format($prices[$i], 2), 1, 1, 'L', $fill); // Precio
}

$pdf->Ln(20); // Espacio debajo de la tabla

// Obtener el ancho de la página
$anchoPagina = $pdf->GetPageWidth();

// Definir el ancho y la altura del cuadro
$anchoCuadro = 100;
$altoCuadro = 50;

// Calcular la posición X para centrar el cuadro
$posX = ($anchoPagina - $anchoCuadro) / 2;

// Bordes y formato para la nota
$pdf->SetLineWidth(0.5); // Borde más grueso
$pdf->SetDrawColor(0, 0, 0); // Color del borde negro
$pdf->Rect($posX, $pdf->GetY(), $anchoCuadro, $altoCuadro);

// Ajustar la posición para el texto dentro del cuadro
$pdf->SetXY($posX, $pdf->GetY()); // Establecer posición X, Y

$pdf->SetFont('Arial', 'B', 12);

// Mostrar la información de cantidad y nota en el cuadro
$pdf->MultiCell($anchoCuadro, 10, mb_convert_encoding("Cantidad: $cantidad\n(Cantidad en letras: $cantidadLetras)\nNota: $nota", 'ISO-8859-1', 'UTF-8'), 0, 'C'); // Centrado
$pdf->Ln(10);


$pdf->Output();