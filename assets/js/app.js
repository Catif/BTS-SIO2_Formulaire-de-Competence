var navButton = document.querySelector('.nav-media-button')
var navbar = document.querySelector('navbar')
var navShadow = document.querySelector('.nav-shadow')

navButton.addEventListener('click', () => {
    if(navbar.classList.contains('active')){
        navButton.classList.remove('disabled')
        navbar.classList.remove('active')
        navShadow.classList.remove('active')
    } else {
        navButton.classList.add('disabled')
        navbar.classList.add('active')
        navShadow.classList.add('active')
    }
})

navShadow.addEventListener('click', () =>{
    if(navbar.classList.contains('active')){
        navButton.classList.remove('disabled')
        navbar.classList.remove('active')
        navShadow.classList.remove('active')
    } else {
        navButton.classList.add('disabled')
        navbar.classList.add('active')
        navShadow.classList.add('active')
    }
})