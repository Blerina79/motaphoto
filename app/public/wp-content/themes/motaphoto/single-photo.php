<?php
/**
 * The template for displaying all single posts of type 'photo'
 * @package HelloElementor
 */
get_header(); // Inclut le fichier header.php

// Récupération des informations de la photo actuelle
// Variables pour les champs personnalisés ACF (Advanced Custom Fields)
$reference = get_field('reference');
$type = get_field('type');
$annee = get_field('annee');

$terms = get_queried_object(); // Récupère l'objet de requête actuel
$categories = wp_get_post_terms(get_the_ID(), 'categorie');
$formats = wp_get_post_terms(get_the_ID(), 'format');

?>
<main id="content" <?php post_class('site-main'); ?>>
    <div class="left-side">
        <header class="page-header">
            <?php the_title('<h2 class="entry-title">', '</h2>'); ?> <!-- Affiche le titre de la photo -->
            <p class="reference-value" data-reference="<?php echo esc_html($reference); ?>" >Référence: <?php echo esc_html($reference); ?></p> <!-- Affiche la référence de la photo -->

            <p>Catégories:
            <?php foreach ($categories as $category) {
                echo esc_html($category->name) . ' ';
            } ?>
         </p>
         <p>Format:
            <?php foreach ($formats as $format) {
                echo esc_html($format->name) . ' ';
            } ?>
     </p>
            <p>Type: <?php echo esc_html($type); ?></p> <!-- Affiche le type de la photo -->
            <p>Année: <?php echo esc_html($annee); ?></p> <!-- Affiche l'année de la photo -->
        </header>

        <hr class="line"/> <!-- Ligne de séparation -->
        <div class="photo-single">
            <p>Cette photo vous intéresse-t-elle ?</p>

         <a href="#" class="button open-contact-modal" data-reference="<?php echo esc_attr($reference); ?>">Contact</a> <!-- Lien vers la page de contact avec la référence de la photo -->   
            
        </div>

    </div>
    
    <div class="right-side">
        <?php if (has_post_thumbnail()) : ?>
            <div class="photo-main">
                <?php the_post_thumbnail('large'); ?> <!-- Affiche la photo en grand format -->
            </div>
        <?php endif; ?>
        
        <div class="photo-navigation">
            <?php if (has_post_thumbnail()) : ?>
                <div class="photo-thumbnail">
                    <?php the_post_thumbnail('thumbnail'); ?> <!-- Affiche une vignette de la photo -->
                </div>
            <?php endif; ?>

            <?php
            // Navigation entre les photos précédente et suivante
            $prev_post = get_previous_post();
            $next_post = get_next_post();
           
            if (!empty($prev_post)) : ?>
                <button class="arrow-btn" onclick="location.href='<?php echo get_permalink($prev_post->ID); ?>'">&#x2190;</button> <!-- Bouton précédent -->
            <?php endif; 
            if (!empty($next_post)) : ?>
                <button class="arrow-btn" onclick="location.href='<?php echo get_permalink($next_post->ID); ?>'">&#x2192;</button> <!-- Bouton suivant -->
            <?php endif; ?>

        </div>
    </div>

<!-- Modale de Contact Form 7 -->
<div  id="contact-modal" class="contact-modal" style="display:none;">
    <div class="modal-content">
        <?php echo do_shortcode('[contact-form-7 id="0004608" title="Contact form 1]'); ?>
        
        <input type="hidden" id="photo-reference" name="photo-reference" value="">
        
        
    </div>
</div>

</main>

<hr class="line-down"/> <!-- Une autre ligne de séparation -->

<h3>VOUS AIMEREZ AUSSI</h3>
<div class="related-photos-container">
    <?php
    $photo_args = array(
        'post_type' => 'photo',
        'posts_per_page' => 2, // Adjust the number of photos as needed
        'orderby' => 'rand', // Randomize photos
        'post__not_in' => array(get_the_ID()) // Exclude current post
    );
    $photo_query = new WP_Query($photo_args);
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template_parts/photo_block', null, ['id' => get_the_ID()]);
        }
    } else {
        echo "<p>Aucune photo supplémentaire à afficher.</p>";
    }
    wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?> <!-- Inclut le fichier footer.php -->