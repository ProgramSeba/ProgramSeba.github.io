<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--conexion con el archivo "cssalarma.css"-->
    <link rel="stylesheet" type="text/css" href="CSS/cssalarma.css">
    <title>Alarma Codigo Azul</title>
</head>
<body>
    <!-- Título de la página -->
    <div class="titulo">
        <h1>Alarma Codigo Azul</h1>
        <br>
    </div>
    <!-- Reproductor de audio con opciones -->
    <div class="audio">
        <audio controls autoplay loop>
            <!-- Fuentes de audio en diferentes formatos -->
            <source src="https://drive.google.com/uc?export=download&id=1QSSjqZA3578VEERW-txVbtzXRBlnHnq_" type="audio/mpeg">
            <source src="https://drive.google.com/uc?export=download&id=17GVK_xn6YpmBwClAgI4SjLyTdhPlHsGa" type="audio/ogg">
            <source src="https://drive.google.com/uc?export=download&id=1BtKdQiz67KRy8QlaIHnAFF-TfX8j_NUH" type="audio/wav">
            <!-- Mensaje de aviso por si el navegador no admite audio -->
            Tu navegador no soporta el elemento de audio.
        </audio>
    </div>
    <!-- Sección de consulta PHP -->
    <div class="consulta">
        <?php
        // Inclusión del archivo "online.php"
        include "online.php";

        // Consulta SQL para recuperar datos de la base de datos
        $consulta = "SELECT informe.id_info, zona.nombre_zona, zona.piso_zona, piso.numero_piso
                     FROM informe
                     JOIN habitacion ON  informe.hab_info = habitacion.id_hab
                     JOIN zona ON  habitacion.zona_hab = zona.id_zona
                     JOIN piso ON  zona.piso_zona = piso.id_piso
                     ORDER BY id_info DESC LIMIT 1 ";
        $resultado = mysqli_query($online, $consulta);
        
        // Iteración a través de los resultados
        while ($fila = mysqli_fetch_assoc($resultado)) {

          //Muestra de los datos en los campos "nombre_zona" y "numero_piso"
            echo "Zona de la Habitacion: " . $fila["nombre_zona"]."<br>";
            
            echo "Piso: " . $fila["numero_piso"]."<br>";
        }

        ?>

        
    </div>
    <div >
        <a class="boton" href="publicidad.php">Volver</a>
    </div>
</body>
</html>