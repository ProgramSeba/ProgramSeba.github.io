<?php
include "online.php";

// sql para recuperar datos de la base de datos
$sql = "SELECT estado_info, id_info FROM informe WHERE estado_info = 1 LIMIT 1";

// Ejecuta la consulta y almacena el resultado en $query
$query = mysqli_query($online, $sql);

if (!$query) {
    // Error en la consulta
    die("Error en la consulta SQL: " . mysqli_error($online));
}

// Verifica si se obtuvieron resultados
if (mysqli_num_rows($query) > 0) {
    // Obtiene una fila de resultados de los registros de cierta columna
    $fila = mysqli_fetch_assoc($query);
    // Almacena el valor de la columna "estado_info" y lo almacena en $estado_info
    $estado = $fila["estado_info"];
    echo $estado;

    if ($estado == 1) {
        header("Location: ../php/alarmaazul.php");
        exit(); // Asegura que no se siga ejecutando el resto del código
    }
} else {
    
    
}

// El resto de tu código si $estado_info no es igual a "1"
sleep(15); // Tiempo de espera para la siguiente consulta.
?>
