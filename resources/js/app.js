import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '../css/app.css';

console.log("MiniProyecto1 frontend loaded");

// Animación suave para tarjetas al cargar la página
document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.card-app, .problem-card');
  cards.forEach((card, index) => {
    card.style.opacity = 0;
    card.style.transform = 'translateY(20px)';
    setTimeout(() => {
      card.style.transition = 'all 0.5s ease';
      card.style.opacity = 1;
      card.style.transform = 'translateY(0)';
    }, 100 * index);
  });
});
