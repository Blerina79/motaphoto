<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package HelloElementor
 */
get_header(); // Inclut le fichier header.php du thème

if (have_posts()) : // Vérifie s'il y a des posts à afficher
    while (have_posts()) : the_post(); // Boucle sur chaque post
?>
        <main id="content" <?php post_class('site-main'); ?>> <!-- Section principale pour le contenu du post -->
            <?php if (apply_filters('hello_elementor_page_title', true)) : // Filtre pour décider si on affiche le titre ?>
                <header class="page-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?> <!-- Affiche le titre du post -->
                </header>
            <?php endif; ?>
            <div class="page-content">
                <?php the_content(); ?> <!-- Affiche le contenu du post -->
                <!-- Affichage des champs personnalisés ACF pour le type et la référence -->
                <?php
                // Vérifie si le champ 'type' a une valeur
                if (get_field('type')) : ?>
                    <div class="custom-field">
                        <h3>Type :</h3>
                        <p><?php the_field('type'); ?></p> <!-- Affiche la valeur du champ 'type' -->
                    </div>
                <?php endif; ?>
                <?php
                // Vérifie si le champ 'référence' a une valeur
                if (get_field('reference')) : ?>
                    <div class="custom-field">
                        <h3>Référence :</h3>
                        <p><?php the_field('reference'); ?></p> <!-- Affiche la valeur du champ 'référence' -->
                    </div>
                <?php endif; ?>
                <div class="post-tags">
                    <?php the_tags('<span class="tag-links">' . esc_html__('Tagged ', 'hello-elementor'), null, '</span>'); ?> <!-- Affiche les tags associés au post -->
                </div>
                <?php wp_link_pages(); ?> <!-- Gère la pagination des pages dans un post si applicable -->
            </div>
            <?php comments_template(); ?> <!-- Inclut le template pour les commentaires -->
        </main>
<?php
    endwhile; // Fin de la boucle
endif; // Fin de la condition
get_footer(); // Inclut le fichier footer.php
?>