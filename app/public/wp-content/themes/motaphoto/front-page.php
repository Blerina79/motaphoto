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
    <select id="categorie-img" onchange="updatePhotoGallery();">
        <option value="">Catégories</option>
        <option value="">Concert</option>
        <option value="">Mariage</option>
        <option value="">Réception</option>
        <option value="">Télévision</option>
        <?php
        $categories = get_terms(['taxonomy' => 'categories', 'hide_empty' => true]);
        foreach ($categories as $category) {
            echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
        }
        ?>
    </select>
    <select id="format" onchange="updatePhotoGallery();">
        <option value="">Formats</option>
        <option value="">Paysage</option>
        <option value="">Portrait</option>
        <?php
        $formats = get_terms(['taxonomy' => 'format', 'hide_empty' => true]);
        foreach ($formats as $format) {
            echo '<option value="' . $format->term_id . '">' . $format->name . '</option>';
        }
        ?>
    </select>
    <select id="filtre-tri" onchange="updatePhotoGallery();">
        <option value="trier">Trier par</option>
        <option value="date">Date</option>
        <option value="title">Titre</option>
    </select>
</div>


<?php
// Section de liste de photos
// Initialisation de WP_Query pour récupérer et afficher les photos
$photo_args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8 // Pour la pagination initiale ou le nombre de photos à afficher
);
$photo_query = new WP_Query($photo_args);
// Boucle sur les photos et affichage avec get_template_part
if ($photo_query->have_posts()) :
    echo '<div class="photos-list">'; // Container pour les photos
    while ($photo_query->have_posts()) : $photo_query->the_post();
        // On utilise get_template_part pour inclure le template de bloc de photo
        // Assurez-vous que vous avez un fichier nommé photo_block.php dans le répertoire de votre thème : /template-parts/photo_block.php
        get_template_part('template_parts\photo_block', null, array('id' => get_the_ID()));
    endwhile;
    echo '</div>'; // Fin du container photos-list
else :
    echo "<p>Aucune photo à afficher.</p>"; // Message si aucun post trouvé
endif;
wp_reset_postdata(); // Important pour réinitialiser la requête et les données globales
// Container pour la pagination ou un bouton de chargement plus (AJAX par exemple)
echo '<div id="pagination-container">';
// Ici, vous ajouterez votre pagination ou le bouton de chargement plus

echo '</div>';
?>

<button id="plus-photos" onclick="loadMorePhotos();">Charger plus</button>
<?php
get_footer();
?>