const slider = document.querySelector(".slider");
const slides = document.querySelectorAll(".slide");

let index = 0;

function updateSlider() {
    slider.style.transform = `translateX(-${index * 100}%)`;
}

function nextSlide() {
    if (index < slides.length - 1) {
        index++;
    } else {
        index = 0;
    }
    updateSlider();
}

function prevSlide() {
    if (index > 0) {
        index--;
    } else {
        index = slides.length - 1;
    }
    updateSlider();
}

setInterval(nextSlide, 3000); // Cambia de diapositiva cada 3 segundos (ajusta según lo necesites)
