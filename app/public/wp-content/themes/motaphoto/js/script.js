jQuery(document).ready(function($) {

    // Fonction pour mettre à jour la galerie de photos
    function updatePhotoGallery() {
        var category = $('#categorie-img').val();
        var format = $('#format').val();
        var sort = $('#filtre-tri').val();
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'filtre-tri',
                category: category,
                format: format,
                sort: sort
            },
            success: function(response) {
                $('#photo-gallery').html(response.content);
            }
        });
    }
    // Gestion du chargement de plus de photos avec pagination infinie.
    $('#load-more-photos').on('click', function() {
        var button = $(this);
        var page = button.data('page') || 2;
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                page: page
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.content) {
                    $('#photo-gallery').append(response.content);
                    button.data('page', response.page);
                }
            }
        });
    });


    // Gestion de l'ouverture et de la fermeture de la modale de contact.
    $('.open-contact-modal a').click(function(e) {
        e.preventDefault();
        $('#contact-form').fadeIn().css('display', 'flex');
    });
    $('.close-modal').click(function() {
        $('#contact-form').fadeOut();
    });


});


// Gestion des interactions de la lightbox une fois que le DOM est entièrement chargé.
document.addEventListener('DOMContentLoaded', function() {
    // Ouverture de la lightbox au clic sur les images de la galerie.
    document.querySelectorAll('.photo-block img').forEach(function(image) {
        image.addEventListener('click', function() {
            var container = document.querySelector('.containerLightbox');
            var lightboxImg = document.querySelector('.lightboxImage');
            container.style.display = 'flex';
            lightboxImg.src = this.src;
            document.querySelector('.lightboxTitle').textContent = this.alt;
        });
    });
    // Fermeture de la lightbox.
    document.querySelector('.lightbox__close').addEventListener('click', function() {
        document.querySelector('.lightbox').style.display = 'none';
    });


    
});


  //gestion du menu burger//

  document.addEventListener('DOMContentLoaded', function() {
    const navToggler = document.querySelector('.nav-toggler');
    const menuContent = document.querySelector('.burger-menu-content');

    navToggler.addEventListener('click', function() {
        this.classList.toggle('active');
        menuContent.classList.toggle('active'); // Utilisez 'active' au lieu de 'display'
    });

    // Cliquer à l'extérieur pour fermer le menu
    document.addEventListener('click', function(event) {
        if (!navToggler.contains(event.target) && !menuContent.contains(event.target)) {
            navToggler.classList.remove('active');
            menuContent.classList.remove('active');
        }
    });
});