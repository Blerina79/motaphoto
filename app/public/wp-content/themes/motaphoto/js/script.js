jQuery(document).ready(function($) {
    $('.contact-button').on('click', function() {
        var photoRef = $(this).data('reference');
        // Code pour ouvrir la popup
        $('#contact-form .photo-reference-field').val(photoRef);
    });
});
// infinite-pagination.js
jQuery(function($){
    $(window).on('scroll', function() {
        var scrollTrigger = $('#pagination-container').offset().top - window.innerHeight;
        if ($(window).scrollTop() >= scrollTrigger) {
            // Charge plus de photos
            // Fais une requête AJAX à l'API REST de WordPress
            // Insère les nouvelles photos dans le DOM
        }
    })
    });