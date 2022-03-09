var navButton = document.querySelector('.nav-media-button');
var navbar = document.querySelector('navbar');

navButton.addEventListener('click', () => {
    navbar.classList.add('active');
})