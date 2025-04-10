document.addEventListener('DOMContentLoaded', () => {
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const navbar = document.querySelector('.naVcontainer nav ul');

    if (!hamburgerIcon || !navbar) {
        console.error('Hamburger icon or navbar not found.');
        return;
    }

    hamburgerIcon.addEventListener('click', () => {
        navbar.classList.toggle('active'); 
    });
});