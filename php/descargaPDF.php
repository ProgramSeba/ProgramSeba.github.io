<?php
include("online.php");
require_once('../TCPDF-main/tcpdf.php');

// Verificar si el parámetro 'id_info' está definido en la URL
if (isset($_GET['id_info'])) {
    $id_informe = $_GET['id_info']; // Obtener 'id_info' de la URL

    // Consulta SQL para obtener los informes del paciente específico
    $sql = "SELECT 
        paciente.nombre_pac, paciente.dni_pac, paciente.tel_pac,
        usuario.nombre_us,
        informe.llegada_info, informe.salida_info, informe.desc_info,
        habitacion.numero_hab,
        zona.nombre_zona
    FROM informe
    INNER JOIN paciente ON informe.paciente_info = paciente.id_pac
    INNER JOIN usuario_informe ON informe.id_info = usuario_informe.info_infous
    INNER JOIN usuario ON usuario_informe.us_infous = usuario.id_us
    INNER JOIN habitacion ON informe.hab_info = habitacion.id_hab
    INNER JOIN zona ON habitacion.zona_hab = zona.id_zona
    WHERE informe.id_info = '$id_informe'";

    // Ejecutar la consulta SQL
    $query = mysqli_query($online, $sql);

    if (!$query) {
        die("Error en la consulta SQL: " . mysqli_error($online));
    }

    // Verificar si se encontraron resultados en la consulta
    if (mysqli_num_rows($query) > 0) {
        // Crear un objeto TCPDF
        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        // Estilos CSS para la tabla
        $css = '
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #ccc;
                font-weight: bold;
            }
            .gray-bg {
                background-color: #f2f2f2;
            }
        ';

        // Agregar los estilos CSS al PDF
        $pdf->writeHTML('<style>' . $css . '</style>', true, false, true, false, '');

        // Crear una tabla para el informe
        $html = '<table>';
        while ($row = mysqli_fetch_array($query)) {
            $html .= '<tr>';
            $html .= '<th>Nombre del paciente</th>';
            $html .= '<td>' . $row['nombre_pac'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr class="gray-bg">';
            $html .= '<th>DNI</th>';
            $html .= '<td>' . $row['dni_pac'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th>Telefono</th>';
            $html .= '<td>' . $row['tel_pac'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr class="gray-bg">';
            $html .= '<th>Nombre del medico</th>';
            $html .= '<td>' . $row['nombre_us'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th>Hora de llegada</th>';
            $html .= '<td>' . $row['llegada_info'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr class="gray-bg">';
            $html .= '<th>Hora de salida</th>';
            $html .= '<td>' . $row['salida_info'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th>Descripción</th>';
            $html .= '<td>' . $row['desc_info'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr class="gray-bg">';
            $html .= '<th>Num habitación</th>';
            $html .= '<td>' . $row['numero_hab'] . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th>Zona</th>';
            $html .= '<td>' . $row['nombre_zona'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        // Agregar la tabla al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar el PDF y enviarlo al navegador para descargar
        $pdf->Output('informe_' . $id_informe . '.pdf', 'D');

        exit;
    } else {
        // No se encontraron resultados para el ID proporcionado
        echo "No se encontró ningún informe con el ID proporcionado.";
    }
} else {
    // El parámetro 'id_info' no está definido en la URL
    echo "El parámetro 'id_info' no está definido en la URL.";
}
?>
