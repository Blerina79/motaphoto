<?php
/**
* The template for displaying all single posts and attachments
*
* @package HelloElementor
*/
get_header();
if (have_posts()) :
    while (have_posts()) : the_post();
?>
        <main id="content" <?php post_class('site-main'); ?>>
            <?php if (apply_filters('hello_elementor_page_title', true)) : ?>
                <header class="page-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>
            <?php endif; ?>
            <div class="page-content">
                <?php the_content(); ?>
                <!-- Affichage des champs personnalisés ACF pour le type et la référence -->
                <?php
                // Vérifie si le champ 'type' a une valeur
                if (get_field('type')) : ?>
                    <div class="custom-field">
                        <h3>Type :</h3>
                        <p><?php the_field('type'); ?></p>
                    </div>
                <?php endif; ?>
                <?php
                // Vérifie si le champ 'référence' a une valeur
                if (get_field('reference')) : ?>
                    <div class="custom-field">
                        <h3>Référence :</h3>
                        <p><?php the_field('reference'); ?></p>
                    </div>
                <?php endif; ?>
                <div class="post-tags">
                    <?php the_tags('<span class="tag-links">' . esc_html__('Tagged ', 'hello-elementor'), null, '</span>'); ?>
                </div>
                <?php wp_link_pages(); ?>
            </div>
            <?php comments_template(); ?>
        </main>
<?php
    endwhile;
endif;
get_footer();
?>