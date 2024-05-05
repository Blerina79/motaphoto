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
$categorie = get_field('categorie', $terms)->name; // Nom de la catégorie associée à la photo
$format = get_field('format', $terms)->name; // Format de la photo

?>
<main id="content" <?php post_class('site-main'); ?>>
    <div class="left-side">
        <header class="page-header">
            <?php the_title('<h2 class="entry-title">', '</h2>'); ?> <!-- Affiche le titre de la photo -->
            <p>Référence: <?php echo esc_html($reference); ?></p> <!-- Affiche la référence de la photo -->
            <p>Catégorie: <?php echo esc_html($categorie); ?></p> <!-- Affiche la catégorie de la photo -->
            <p>Format: <?php echo esc_html($format); ?></p> <!-- Affiche le format de la photo -->
            <p>Type: <?php echo esc_html($type); ?></p> <!-- Affiche le type de la photo -->
            <p>Année: <?php echo esc_html($annee); ?></p> <!-- Affiche l'année de la photo -->
        </header>

        <hr class="line"/> <!-- Ligne de séparation -->
        <div class="photo-single">
            <p>Cette photo vous intéresse-t-elle ?</p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="button">Contact</a> <!-- Lien vers la page de contact -->
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
            <?php endif; ?>
                <button class="arrow-btn" onclick="location.href='<?php echo get_permalink($next_post->ID); ?>'">&#x2192;</button> <!-- Bouton suivant -->

        </div>
    </div>
</main>

<hr class="line-down"/> <!-- Une autre ligne de séparation -->
<?php get_footer(); ?> <!-- Inclut le fichier footer.php -->