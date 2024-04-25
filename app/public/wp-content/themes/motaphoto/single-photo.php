<?php
/**
* The template for displaying all single posts of type 'photo'
* @package HelloElementor
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post();
        // Variables pour les champs personnalisés ACF
        $reference = get_field('reference');
        $categorie = get_field('categorie');
        $format = get_field('format');
        $type = get_field('type');
        $annee = get_field('annee');
?>
        <main id="content" <?php post_class('site-main'); ?> style="display: flex; justify-content: space-between;">
            <div class="left-side" style="width: 48%;">
                <header class="page-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    <p>Référence: <?php echo esc_html($reference); ?></p>
                    <p>Catégorie: <?php echo esc_html($categorie); ?></p>
                    <p>Format: <?php echo esc_html($format); ?></p>
                    <p>Type: <?php echo esc_html($type); ?></p>
                    <p>Année: <?php echo esc_html($annee); ?></p>
                </header>
            </div>
            <div class="right-side" style="width: 48%;">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="photo-main">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                <div style="text-align: center; margin-top: 20px;">
                    <p>Cette photo vous intéresse-t-elle ?</p>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="button" style="background-color: #C4C4C4; padding: 10px 20px; color: #fff; text-decoration: none; display: inline-block;">Contact</a>
                </div>
                <div class="photo-navigation" style="text-align: center; margin-top: 20px;">
                    <button onclick="location.href='<?php echo get_previous_post_link(); ?>'">&#9664;</button>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="photo-thumbnail">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                    <?php endif; ?>
                    <button onclick="location.href='<?php echo get_next_post_link(); ?>'">&#9654;</button>
                </div>
            </div>
        </main>
<?php endwhile;
endif; ?>
<?php get_footer(); ?>