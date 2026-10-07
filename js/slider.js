(() => {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.vyojin-hero-slider');
    if (!slider) return;

    const slides = [...slider.querySelectorAll('.vyojin-hero-slide')];
    const dots = [...slider.querySelectorAll('.vyojin-hero-dots button')];
    const previous = slider.querySelector('.vyojin-hero-prev');
    const next = slider.querySelector('.vyojin-hero-next');
    let current = 0;
    let timer;

    const showSlide = (index) => {
      current = (index + slides.length) % slides.length;
      slides.forEach((slide, i) => slide.classList.toggle('is-active', i === current));
      dots.forEach((dot, i) => {
        dot.classList.toggle('is-active', i === current);
        dot.setAttribute('aria-selected', i === current ? 'true' : 'false');
      });
    };

    const restartAutoplay = () => {
      window.clearInterval(timer);
      timer = window.setInterval(() => showSlide(current + 1), 5500);
    };

    previous?.addEventListener('click', () => {
      showSlide(current - 1);
      restartAutoplay();
    });

    next?.addEventListener('click', () => {
      showSlide(current + 1);
      restartAutoplay();
    });

    dots.forEach((dot) => {
      dot.addEventListener('click', () => {
        showSlide(Number(dot.dataset.slide));
        restartAutoplay();
      });
    });

    slider.addEventListener('mouseenter', () => window.clearInterval(timer));
    slider.addEventListener('mouseleave', restartAutoplay);

    showSlide(0);
    restartAutoplay();
  });
})();
