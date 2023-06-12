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
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>riesgos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" href="estilo.css" />
    <link rel="stylesheet" href="tabla.css" />
    <link rel="stylesheet" href="popup.css" />
</head>
<body>
<h1>Reporte de Riesgos</h1>
<table class="table-fill">
<thead>
<tr>
<th>Nombre</th>
<th>Descripción</th>
<th>Impacto</th>
<th>Frecuencia</th>
<th>Resultado Inherente</th>
</tr>
</thead><tbody>
</body>
';

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
