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
    /*$('.open-contact-modal').click(function(e) {*/
    $(document).on('click', '.open-contact-modal, .open-contact-modal a', function(e) {
        e.preventDefault();
        let reference = $(this).data('reference'); // Récupère la référence de la photo

        if (reference) {

        $('#photo-reference').val(reference); // Définit la référence de la photo dans le champ caché                              
    }
        $('#contact-modal').fadeIn().css('display', 'flex');
    });


    $(document).on('click', '.close-modal', function() {

   // $('.close-modal').click(function() {
        $('.contact-modal').fadeOut();
    });



    $(document).mouseup(function(e) {
        var modal = $("#contact-modal .modal-content");
        if (!modal.is(e.target) && modal.has(e.target).length === 0) {
            $('#contact-modal').fadeOut();
        }
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


jQuery(document).ready(function($) {
    let currentIndex = 0;
    let photos = [];

    // Fonction pour initialiser les blocs de photos et ajouter des écouteurs d'événements
    function initializePhotoBlocks() {
        photos = Array.from(document.querySelectorAll('.photo-block'));
        photos.forEach((block, index) => {
            block.querySelector('.photo-fullscreen').addEventListener('click', function(e) {
                e.preventDefault();
                currentIndex = index;
                openLightbox();
            });
        });
    }

    // Ouvre la lightbox avec l'image actuelle
    function openLightbox() {
        let block = photos[currentIndex];
        let container = document.querySelector('.containerLightbox');
        let lightboxImg = document.querySelector('.lightboxImage');
        let title = block.querySelector('.photo-title').textContent;
        let category = block.querySelector('.photo-category').textContent;
        let imgSrc = block.querySelector('img').src;

        container.style.display = 'flex';
        lightboxImg.src = imgSrc;
        document.querySelector('.lightboxTitle').textContent = title + ' - ' + category;
    }

    // Ferme la lightbox
    document.querySelector('.lightbox__close').addEventListener('click', function() {
        document.querySelector('.containerLightbox').style.display = 'none';
    });

    // Affiche l'image précédente
    document.querySelector('.lightbox__prev').addEventListener('click', function() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : photos.length - 1;
        openLightbox();
    });

    // Affiche l'image suivante
    document.querySelector('.lightbox__next').addEventListener('click', function() {
        currentIndex = (currentIndex < photos.length - 1) ? currentIndex + 1 : 0;
        openLightbox();
    });

    // Initialiser les blocs de photos au chargement de la page
    initializePhotoBlocks();
});

