$(document).ready(() => {
    if (document.title === 'Categorías - Olimpo' || document.title === 'Artículos - Olimpo') {
        $('.pagination').closest('nav').addClass('d-flex');
        $('.pagination').closest('nav').addClass('justify-content-center');
    }
});