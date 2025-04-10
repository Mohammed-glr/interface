const hamburgerIcon = document.getElementById('hamburger-icon');
const navbar = document.querySelector('.naVcontainer nav ul');

hamburgerIcon.addEventListener('click', () => {
    navbar.classList.toggle('active'); 
});