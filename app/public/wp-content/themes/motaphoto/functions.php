<?php
function theme_enqueue_styles()
{
    // Ajoute le style CSS du thème parent au thème enfant
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // Ajoute la feuille de style "theme.css" au thème
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_directory_uri() . '/css/theme.css',
        array('parent-style')
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function register_my_menus()
{
    register_nav_menus(
        array(
            'menu-header' => __('Menu principal'),
            'menu-footer' => __('Menu footer')
        )
    );
}
add_action('init', 'register_my_menus');

wp_enqueue_script('custom-popup', get_stylesheet_directory_uri() . '/js/custom-popup.js', array('jquery'), null, true);
function theme_enqueue_assets()
{
    // Styles
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_directory_uri() . '/css/theme.css',
        array('parent-style')
    );

    // Scripts
    wp_enqueue_script(
        'custom-popup',
        get_stylesheet_directory_uri() . '/js/custom-popup.js',
        array('jquery'),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');