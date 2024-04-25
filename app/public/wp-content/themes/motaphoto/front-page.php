<?php
// front-page.php
get_header();
// Hero section
$random_images = get_posts(array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand'
));
if (!empty($random_images)) {
    $hero_image_url = get_the_post_thumbnail_url($random_images[0]->ID, 'full');
}
?>
<div class="hero" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');">
    <!-- Hero Content -->
</div>
<!-- Photos List -->
<div class="photos-list">
    <?php
    $photo_args = array(
        'post_type' => 'photo',
        'posts_per_page' => 6 // Pour la pagination initiale
    );
    $photo_query = new WP_Query($photo_args);
    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('template-parts/photo_block', null, array('id' => get_the_ID()));
        endwhile;
    endif;
    ?>
</div>
<div id="pagination-container">
    <!-- Pagination or Load More button -->
</div>
<?php
get_footer();
?>