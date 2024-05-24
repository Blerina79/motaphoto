<?php
// front-page.php
get_header();
// Hero section - Récupération d'une image aléatoire pour l'affichage du fond
$random_images = get_posts(array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand',
    'no_found_rows' => true // Optimise la requête pour ne pas compter les résultats, plus rapide
));
$hero_image_url = get_stylesheet_directory_uri() . '/assets/images/nathalie-0.jpeg'; // Chemin par défaut
// Si on a récupéré une image, on prend son URL
if (!empty($random_images)) {
    $hero_image_url = get_the_post_thumbnail_url($random_images[0]->ID, 'full');
}
// Section hero avec image de fond
?>
<div class="hero" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');">
    <!-- Contenu du hero ici, par exemple un titre ou un CTA -->
                  <h1>PHOTOGRAPHE  EVENT</h1>
</div>

<div id="filtre-photo">
    <select id="categorie-img" >
        <option value="">Catégories</option>
        <?php
        $categories = get_terms(['taxonomy' => 'categorie', 'hide_empty' => false]);
        foreach ($categories as $category) {
            echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
        }
        ?>
    </select>

    <select id="format">
        <option value="">Formats</option>
        
        <?php
        $formats = get_terms(['taxonomy' => 'format', 'hide_empty' => false]);
        foreach ($formats as $format) {
            echo '<option value="' . esc_attr($format->term_id) . '">' . esc_html($format->name) . '</option>';
        }
        ?>
    </select>
    <select id="filtre-tri">
        <option value="trier">Trier par</option>
        <option value="ASC">A partir des plus récentes</option>
        <option value="DESC">A partir des plus anciennes </option>

    </select>
</div>

<div id="photo-gallery">
<?php
// Section de liste de photos
// Initialisation de WP_Query pour récupérer et afficher les photos
$photo_args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8, // Pour la pagination initiale ou le nombre de photos à afficher
    'order' => 'ASC'
);

$photo_query = new WP_Query($photo_args);
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template_parts/photo_block', null, ['id' => get_the_ID()]);
        }
    } else {
        echo "<p>Aucune photo à afficher.</p>";
    }
    wp_reset_postdata();
    ?>
</div>
<button id="load-more-photos" >Charger plus</button>
<?php get_footer(); ?>

