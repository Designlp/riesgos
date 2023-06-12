<?php
require 'db.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

// Recupera todos los riesgos de la base de datos
$stmt = $pdo->prepare("SELECT * FROM riesgos");
$stmt->execute();
$riesgos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Genera el contenido del PDF en HTML
$html = '<h1>Reporte de Riesgos</h1><table><thead><tr><th>Nombre</th><th>Descripción</th><th>Impacto</th><th>Frecuencia</th><th>Resultado</th></tr></thead><tbody>';

foreach ($riesgos as $riesgo) {
    $html .= "<tr>
        <td>{$riesgo['nombre']}</td>
        <td>{$riesgo['descripcion']}</td>
        <td>{$riesgo['impacto']}</td>
        <td>{$riesgo['frecuencia']}</td>
        <td>{$riesgo['resultado']}</td>
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
