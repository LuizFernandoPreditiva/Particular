/* menu */ 

document.addEventListener("DOMContentLoaded", function () {

const menuOpener = document.querySelector('.menu-opener');
const navLinks = document.querySelector('.nav-links');
const actions = document.querySelector('.actions');


if (menuOpener && navLinks && actions) {

    menuOpener.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        actions.classList.toggle('active');
    });
}


});
/* Fim menu */     
