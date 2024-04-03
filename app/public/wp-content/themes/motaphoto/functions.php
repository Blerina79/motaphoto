<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    // Ajoute le style CSS du thème parent au thème enfant
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
   // Ajoute la feuille de style "theme.css" au thème
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(),
    filemtime(get_stylesheet_directory() . '/css/theme.css'));
}