<?php
// Incluye el archivo de consulta para obtener el estado_info
include "consulta_activa.php";
include "online.php";

// Función para verificar el estado cada 10 segundos
function verificarEstado() {
    global $estado;
    if ($estado == "0") { // Si estado_info es igual a 0 (apagado)
        // Mostrar contenido normal
    } else if ($estado == "1") {
        // Redirige a alarmaazul.php
        header("Location: ../php/alarmaazul.php");
        exit(); // Asegura que no se siga ejecutando el resto de la página
    }
}

// Llama a verificarEstado por primera vez
verificarEstado();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluye jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Pantalla tele</title>
    <style>
        body {
            padding: 0;
            margin: 0;
        }
        /* Estilos para el contenedor del slider */
        .slider-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Estilos para las diapositivas */
        .slider-slide {
            width: 100%;
            height: 100%;
            display: none;
        }

        /* Estilo para la imagen en cada diapositiva */
        .slider-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="slider-container">
        <div class="slider-slide">
            <img src="../img/imagen1.jpg" alt="Imagen 1">
        </div>
        <div class="slider-slide">
            <img src="../img/imagen2.jpg" alt="Imagen 2">
        </div>
        <div class="slider-slide">
            <img src="../img/imagen3.jpg" alt="Imagen 3">
        </div>
    </div>

    <script>
        // Función para cambiar las diapositivas
        let slideIndex = 0;
        mostrarSlide();

        function mostrarSlide() {
            const slides = document.querySelectorAll(".slider-slide");
            
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }

            slides[slideIndex - 1].style.display = "block";
            setTimeout(mostrarSlide, 7000); // Cambia de diapositiva cada 3 segundos (ajusta el valor según lo desees)
        }

        // Función para verificar el estado cada 10 segundos
        function verificarEstado() {
            $.ajax({
                url: 'consulta_activa.php', // Archivo PHP para obtener el estado
                success: function(data) {
                    console.log('Estado actual:', data); // Depuración: muestra el estado actual en la consola
                    if (data == "1") {
                        console.log('Redirigiendo a alarmaazul.php'); // Depuración: muestra un mensaje si se redirige
                        window.location.href = '../php/alarmaazul.php';
                    }
                },
                complete: function() {
                    // Llama a verificarEstado nuevamente después de 10 segundos
                    setTimeout(verificarEstado, 10000); // 10 segundos
                }
            });
        }

        // Llama a verificarEstado por primera vez
        verificarEstado();
    </script>
</body>
</html>
