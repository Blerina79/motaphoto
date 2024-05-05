<footer id="site-footer" class="site-footer">
    <hr class="footer-divider" /> <!-- Une ligne horizontale pour séparer le contenu du footer -->
    <nav class="footer-navigation">
        <?php
        // Charge un menu WordPress pour le pied de page
        wp_nav_menu(array(
            'theme_location' => 'menu-footer',
            'menu_id'        => 'footer-menu',
            'fallback_cb'    => false,
        ));
        ?>
    </nav>
    <!-- Inclusion de la modale de contact -->
    <?php get_template_part('template_parts/modale'); ?> <!-- Charge le fichier de la modale de contact -->
    <?php wp_footer(); ?> <!-- Hook WordPress pour charger des scripts ou des styles spécifiques au footer -->
</footer>

<div class="containerLightbox">
    <div class="lightbox">
        <div class="lightbox-content">
            <span class="lightbox__close">&times;</span>
            <img class="lightboxImage" src="" alt="Image agrandie">
            <div class="lightbox-controls">
                <button class="lightbox__prev">Précédente</button>
                <span class="lightboxTitle">Nom de la photo</span>
                <button class="ightbox__next">Suivante</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>