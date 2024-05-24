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
                action: 'filter_photos',
                category: category,
                format: format,
                sort: sort
            },
            success: function(response) {
                if (response.success) {
                    $('#photo-gallery').html(response.data.content);
                } else {
                    $('#photo-gallery').html('<p>Aucune photo trouvée.</p>');
                }
            }
        });
    }

    $('#categorie-img, #format, #filtre-tri').change(updatePhotoGallery);

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

    $(document).mouseup(function(e) {
        var modal = $("#contact-form .modal-content");
        if (!modal.is(e.target) && modal.has(e.target).length === 0) {
            $('#contact-form').fadeOut();
        }
    });

    // Gestion des interactions de la lightbox une fois que le DOM est entièrement chargé.
    document.querySelectorAll('.photo-fullscreen').forEach(function(block) {
        block.addEventListener('click', function(e) {
            e.preventDefault();

            let parent = block.parentElement;
            let container = document.querySelector('.containerLightbox');
            let lightboxImg = document.querySelector('.lightboxImage');
            let title = parent.querySelector('.photo-title').textContent;
            let category = parent.querySelector('.photo-category').textContent;
            let imgSrc = parent.querySelector('img').src;

            container.style.display = 'flex';
            lightboxImg.src = imgSrc;
            document.querySelector('.lightboxTitle').textContent = title + ' - ' + category;
        });
    });


    document.querySelector('.lightbox__close').addEventListener('click', function() {
        document.querySelector('.containerLightbox').style.display = 'none';
    });

    document.querySelector('.lightbox__prev').addEventListener('click', function() {
        // Gestion du précédent

    });

    document.querySelector('.lightbox__next').addEventListener('click', function() {
        // Gestion du suivant
    });


    // Gestion du menu burger
    const navToggler = document.querySelector('.nav-toggler');
    const menuContent = document.querySelector('.burger-menu-content');

    navToggler.addEventListener('click', function() {
        this.classList.toggle('active');
        const header = document.querySelector('header');
        header.classList.toggle('fixed');
        menuContent.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        if (!navToggler.contains(event.target) && !menuContent.contains(event.target)) {
            navToggler.classList.remove('active');
            menuContent.classList.remove('active');
        }
    });
});

