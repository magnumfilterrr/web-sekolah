import "./bootstrap";

// Import Alpine.js
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// Import Flowbite
import "flowbite";

// Import Swiper
import Swiper from "swiper/bundle";
import "swiper/css/bundle";
window.Swiper = Swiper;

// Import AOS
import AOS from "aos";
import "aos/dist/aos.css";
AOS.init({
    duration: 800,
    once: true,
});

// Import GLightbox
import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.min.css";
window.GLightbox = GLightbox;

document.addEventListener("DOMContentLoaded", () => {
    // Inisialisasi GLightbox
    if (typeof GLightbox !== "undefined") {
        GLightbox({
            selector: ".glightbox",
        });
    }

    // Inisialisasi Swiper
    if (typeof Swiper !== "undefined") {
        new Swiper(".swiper-container", {
            loop: true,
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: { delay: 4000 },
        });
    }
});
