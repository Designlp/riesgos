<?php
session_start();
require 'db.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

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

$htmlContent = file_get_contents('reporte.html');

// Creamos una nueva instancia de Dompdf
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);

// Cargamos el contenido HTML
$dompdf->loadHtml($htmlContent);

// Renderizamos el documento
$dompdf->render();

// Guardamos el PDF generado
$pdfOutput = $dompdf->output();
file_put_contents('reporte.pdf', $pdfOutput);

// Enviamos una respuesta JSON con la ubicación del PDF generado
echo json_encode(['ubicacion' => 'reporte.pdf']);
?>