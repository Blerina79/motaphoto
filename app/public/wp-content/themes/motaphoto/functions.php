<?php
/**
 * Enregistre les styles et les scripts pour le thème.
 */
function theme_enqueue_styles_and_scripts() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/css/theme.css', ['parent-style']);
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/script.js', ['jquery'], null, true);

    // Ajoute l'URL AJAX pour le script

    wp_localize_script('theme-script', 'ajax_object', ['ajaxurl' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');

/**
 * Gère les requêtes AJAX pour filtrer les photos selon les catégories, formats et tri.
 */
function filter_photos_ajax()
{
    $category = isset($_POST['category']) ? $_POST['Category'] : '';
    $format = isset($_POST['format']) ? $_POST['Formats'] : '';
    $sort = isset($_POST['sort']) ? $_POST['sort'] : 'date';
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => -1,
        'orderby' => $sort ?: 'date',
        'order' => 'ASC'
    ];
    if ($category) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field' => 'term_id',
            'terms' => $category,
        ];
    }
    if ($format) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field' => 'term_id',
            'terms' => $format,
        ];
    }
    $query = new WP_Query($args);
    $content = '';
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template_parts/photo_block', null, ['id' => get_the_ID()]);
        }
        $content = ob_get_clean();
    } else {
        $content = '<p>Aucune photo trouvée.</p>';
    }
    wp_send_json_success(['content' => $content]);
}
add_action('wp_ajax_filter_photos', 'filter_photos_ajax');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_ajax');

/**
 * Insère une image de contact par shortcode.
 */
/*function insert_contact_image() {
    $image_path = get_stylesheet_directory_uri() . '/assets/images/contact_form.png';
    return '<img src="' . esc_url($image_path) . '" alt="Contact">';
}
add_shortcode('contact_image', 'insert_contact_image');*/

/**
 * Enregistre les taxonomies personnalisées pour les photos.
 */
/*function register_photo_taxonomies() {
    register_taxonomy('categorie', 'photo', ['label' => 'Catégories de Photos', 'rewrite' => ['slug' => 'categorie'], 'hierarchical' => false]);
    register_taxonomy('format', 'photo', ['label' => 'Formats de Photos', 'rewrite' => ['slug' => 'format'], 'hierarchical' => false]);
}
add_action('init', 'register_photo_taxonomies');*/


/**
 * Gère la pagination infinie AJAX pour les photos.
 */
function load_more_photos_ajax() {
    $page = $_POST['page'] ?? 1; // Utilisation de la coalescence NULL pour définir une valeur par défaut
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'order' => 'ASC'
    ];
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template_parts/photo_block', null, ['id' => get_the_ID()]);
        }
        $content = ob_get_clean();
        $max_page = $query->max_num_pages;
    } else {
        $content = '<p>Aucune photo supplémentaire à afficher.</p>';
        $max_page = $page;
    }
    echo json_encode(['page' => $page + 1, 'content' => $content, 'max_page' => $max_page]);
    wp_die();
}
add_action('wp_ajax_load_more_photos', 'load_more_photos_ajax');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos_ajax');

