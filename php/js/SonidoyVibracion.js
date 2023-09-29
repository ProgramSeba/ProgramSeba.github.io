// Verificar si el navegador soporta la reproducción de audio y la vibración
if ("vibrate" in navigator && "Audio" in window) {
    // Solicitar permiso para reproducir audio y activar la vibración
    document.addEventListener("DOMContentLoaded", function() {
        const cambiarContenidoBtn = document.getElementById("cambiarContenido");
        const alarmaSound = document.getElementById("alarmaSound");

        cambiarContenidoBtn.addEventListener("click", function() {
            if (confirm("¿Deseas permitir la reproducción de audio y la vibración?")) {
                // Reproducir el sonido de la alarma
                alarmaSound.play();

                navigator.vibrate(1000); // Vibrar durante 1 segundo (valor en milisegundos)

                // Cambiar el contenido para mostrar la alarma activada
                document.getElementById("contenido1").style.display = "none";
                document.getElementById("contenido2").style.display = "block";
            }
        });
    });
}

// Solicitar permiso para la reproducción de audio
navigator.permissions.query({ name: 'autoplay' }).then(result => {
    if (result.state === 'prompt') {
        // Aquí puedes mostrar un botón u otro elemento que permita al usuario otorgar el permiso
        const button = document.getElementById('audioPermissionButton');
        button.addEventListener('click', () => {
            result
                .userChoice
                .then(choiceResult => {
                    if (choiceResult.outcome === 'accepted') {
                        // El usuario ha otorgado el permiso para la reproducción automática de audio
                    }
                });
        });
    }
});

// Solicitar permiso para la vibración
navigator.permissions.query({ name: 'vibrate' }).then(result => {
    if (result.state === 'prompt') {
        // Aquí puedes mostrar un botón u otro elemento que permita al usuario otorgar el permiso
        const button = document.getElementById('vibrationPermissionButton');
        button.addEventListener('click', () => {
            result
                .userChoice
                .then(choiceResult => {
                    if (choiceResult.outcome === 'accepted') {
                        // El usuario ha otorgado el permiso para la vibración
                    }
                });
        });
    }
});
