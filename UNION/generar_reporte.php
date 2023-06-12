<?php
session_start();
require 'db.php';
require '../vendor/autoload.php';


use Dompdf\Dompdf;

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];  // Obtén el ID del usuario de la sesión

// Recupera todos los riesgos del usuario actual de la base de datos
$stmt = $pdo->prepare("SELECT * FROM riesgos WHERE user_id = ?");
$stmt->execute([$user_id]);
$riesgos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Genera el contenido del PDF en HTML
$html = '
<h1 style="text-align:center; color: #1e1e1e; font-family: Arial; ">Reporte de Riesgos</h1>
<table style="width:100%;border:1px solid black;border-collapse:collapse;">
<thead>
<tr>
<th style="font-family: Arial; background-color: #1e1e1e;color: white;border: 1px solid black;padding: 8px;text-align: left;">Nombre</th>
<th style="font-family: Arial; background-color: #1e1e1e;color: white;border: 1px solid black;padding: 8px;text-align: left;">Descripción</th>
<th style="font-family: Arial; background-color: #1e1e1e;color: white;border: 1px solid black;padding: 8px;text-align: left;">Impacto</th>
<th style="font-family: Arial; background-color: #1e1e1e;color: white;border: 1px solid black;padding: 8px;text-align: left;">Probabilidad</th>
<th style="font-family: Arial; background-color: #1e1e1e;color: white;border: 1px solid black;padding: 8px;text-align: left;">Riesgo Inherente</th>
</tr>
</thead>
<tbody>';


foreach ($riesgos as $riesgo) {
    $html .= "<tr>
        <td style='border: 1px solid black;padding: 8px;text-align: left;'>{$riesgo['nombre']}</td>
        <td style='border: 1px solid black;padding: 8px;text-align: left;'>{$riesgo['descripcion']}</td>
        <td style='border: 1px solid black;padding: 8px;text-align: left;'>{$riesgo['impacto']}</td>
        <td style='border: 1px solid black;padding: 8px;text-align: left;'>{$riesgo['frecuencia']}</td>
        <td style='border: 1px solid black;padding: 8px;text-align: left;'>{$riesgo['resultado']}</td>
    </tr>";
}


$html .= '</tbody></table>';

// Inicializa DOMPDF y carga el contenido HTML
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// Renderiza el documento y genera el PDF
$dompdf->render();
$output = $dompdf->output();

// Guarda el PDF en un archivo
file_put_contents('reporte.pdf', $output);

// Envía una respuesta JSON con la ubicación del PDF
echo json_encode(['ubicacion' => 'reporte.pdf']);
?>
