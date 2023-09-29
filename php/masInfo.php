<?php

include("online.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id_pac']) && isset($_GET['id_info'])) {
    $id_paciente = $_GET['id_pac'];
    $id_informe = $_GET['id_info'];

    // Consulta SQL para obtener los detalles del informe seleccionado
    $sql_informe = "SELECT 
        paciente.nombre_pac, paciente.dni_pac, paciente.tel_pac,
        sexo.nombre_sexo,
        usuario.nombre_us, usuario.correo_us,
        zona.nombre_zona,
        habitacion.numero_hab,
        informe.llegada_info, informe.salida_info, informe.desc_info
    FROM usuario_informe AS ui
    JOIN informe ON ui.info_infous = informe.id_info
    JOIN habitacion ON informe.hab_info = habitacion.id_hab
    JOIN zona ON habitacion.zona_hab = zona.id_zona
    JOIN paciente ON informe.paciente_info = paciente.id_pac
    JOIN sexo ON paciente.sexo_pac = sexo.id_sexo
    JOIN usuario ON ui.us_infous = usuario.id_us
    WHERE paciente.id_pac = $id_paciente AND informe.id_info = $id_informe";

    $query_informe = mysqli_query($online, $sql_informe);

    if (!$query_informe) {
        die("Error en la consulta de informes: " . mysqli_error($online));
    }

    // Obtener los resultados de la consulta
    $row = mysqli_fetch_array($query_informe);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../php/CSS/masInfo.css">
    <title>Mas informacion</title>
</head>
<body>

    <section  class="barra">
        <a class="logo" href="dashboard.html"></a>
        <a class="foto" href="perfil.php"></a>
    </section>
  
    <div class="separador"></div>

    <!-- Primera tabla -->

    <table>
        <thead>
            <tr>
                <th data-title="Nombre">Nombre</th>
                <th data-title="Sexo">Sexo</th>
                <th data-title="DNI">DNI</th>
                <th data-title="Telefono">Telefono</th>
            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td data-title="Nombre"><?= $row['nombre_pac'] ?></td>
                    <td data-title="Sexo"><?= $row['nombre_sexo'] ?></td>
                    <td data-title="DNI"><?= $row['dni_pac'] ?></td>
                    <td data-title="Telefono"><?= $row['tel_pac'] ?></td>
                </tr>
            
        </tbody>
    </table>

    <!-- Segunda tabla -->

    <table>
        <thead>
            <tr>
                <th data-title="Medico">Medico</th>
                <th data-title="Correo">Correo del hospital</th>
            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td data-title="Medico"><?= $row['nombre_us'] ?></td>
                    <td data-title="Correo"><?= $row['correo_us'] ?></td>
                </tr>
            
        </tbody>
    </table>
    
    <!-- Tercera tabla -->

    <table>
        <thead>
            <tr>
                <th data-title="Zona">Zona</th>
                <th data-title="Habitacion">Habitacion</th>
            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td data-title="Zona"><?= $row['nombre_zona'] ?></td>
                    <td data-title="Habitacion"><?= $row['numero_hab'] ?></td>
                </tr>
            
        </tbody>
    </table>

    <!-- Cuarta tabla -->

    <table>
        <thead>
            <tr>
                <th data-title="Llegada">Hora de llegada</th>
                <th data-title="Salida">Hora de salida</th>
            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td data-title="Llegada"><?= $row['llegada_info'] ?></td>
                    <td data-title="Salida"><?= $row['salida_info'] ?></td>
                </tr>
            
        </tbody>
    </table>

    <!-- Quinta tabla -->

    <table>
        <thead>
            <tr>
                <th data-title="Descripcion">Descripcion</th>
            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td data-title="Descripción"><?= $row['desc_info'] ?></td>
                </tr>
            
        </tbody>
    </table>

    <a class="descargar" href="../php/descargaPDF.php?id_info=<?= $id_informe ?>">Descargar informe en PDF</a>




</body>
</html>
