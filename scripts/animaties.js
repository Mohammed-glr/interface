// Maak een nieuwe IntersectionObserver aan
const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target); 
        }
    });
}, {
    threshold: 0.3 
});

const heroText = document.querySelector('.hero-text');
const productCards = document.querySelectorAll('.product-card');

observer.observe(heroText);
productCards.forEach(card => observer.observe(card));
