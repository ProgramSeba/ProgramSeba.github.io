<?php

// Inclusión del archivo "online.php"
include "online.php";

// sql para recuperar datos de la base de datos
$sql = "SELECT estado_info,id_info FROM informe ORDER BY id_info LIMIT 1";
//Ejecuta la consulta y almacena el resultado en $query
$query = mysqli_query($online, $sql);
//obtención de una fila de resultados de los registros de cierto columna
$fila = mysqli_fetch_assoc($query);
//Almacena el valor de la columna "estado_info" y la almacena en $estado"
$estado = $fila["estado_info"];

while($estado=="0"){

    header("Location: ../php/publicidad.php");
    sleep(60);//Tiempo de espera para la siguiente consulta.
}
?>