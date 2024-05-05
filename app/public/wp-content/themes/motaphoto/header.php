<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"> <!-- Définit l'encodage des caractères pour le site -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Rend le site responsive -->
    <?php wp_head(); ?> <!-- WordPress hook pour charger des scripts ou des styles -->
</head>
<body <?php body_class(); ?>> <!-- Ajoute des classes spécifiques pour le corps du site pour aider à la personnalisation CSS -->
    <header id="site-header" class="site-header">
        <div class="site-branding">
            <?php
            // Affiche le logo personnalisé ou le nom du site si aucun logo n'est défini
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a>';
            }
            ?>
        </div>
        <nav class="site-navigation">
            <?php
            // Affiche le menu assigné à l'emplacement 'menu-header' dans WordPress
            wp_nav_menu(array(
                'theme_location' => 'menu-header',
                'menu_id'        => 'primary-menu',
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
    </header>
    <?php wp_body_open(); ?> <!-- Hook WordPress pour ajouter du contenu spécifique juste après la balise body -->
</body>
</html>