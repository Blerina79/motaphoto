<?php
$photo_id = $args['id'];
if (has_post_thumbnail($photo_id)) {
    $photo_url = get_permalink($photo_id);
    $photo_reference = get_field('reference', $photo_id);

    $photo_categories = get_the_terms($photo_id, 'categorie');
    $category_names = [];
    if ($photo_categories && !is_wp_error($photo_categories)) {
        foreach ($photo_categories as $category) {
            $category_names[] = $category->name;
        }
    }
    $category_names = implode(', ', $category_names);
    echo '<div class="photo-block">';
    echo '<span class="photo-fullscreen" data-reference="' . esc_attr($photo_reference) . '"></span>';
    echo '<a href="' . esc_url($photo_url) . '">';
    echo '<img src="' . esc_url(get_the_post_thumbnail_url($photo_id)) . '" alt="' . esc_attr($photo_reference) . '">';
    echo '<span class="photo-icon"></span>';
    echo '<span class="photo-title">' . esc_html($photo_reference) . '</span>'; // Utilisation de la référence
    echo '<span class="photo-category">' . esc_html($category_names) . '</span>';
    echo '</a>';
    echo '</div>';
} else {
    echo "<p>Image non disponible.</p>";
}
?>

