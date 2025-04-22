/* menu */ 

document.addEventListener("DOMContentLoaded", function () {

const menuOpener = document.querySelector('.menuLogado-opener');
const navLinks = document.querySelector('.navLogado-links');
const actions = document.querySelector('.actionsLogado');


if (menuOpener && navLinks && actions) {

    menuOpener.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        actions.classList.toggle('active');
    });
}


});

$(document).ready(function () {
    $('[data-toggle="dropdown"]').dropdown();
});


/* Fim menu */     
