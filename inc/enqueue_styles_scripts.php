<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function theme_enqueue_assets() {
    // FontAwesome 6 CDN for icons
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Root style.css
    wp_enqueue_style( 'jacob-style', get_stylesheet_uri() );

    // Theme main stylesheet
    wp_enqueue_style( 'jacob-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0' );

    // Theme responsive stylesheet
    wp_enqueue_style( 'jacob-responsive-style', get_template_directory_uri() . '/assets/css/responsive.css', array( 'jacob-main-style' ), '1.0.0' );

    wp_enqueue_script( 'jacob-main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );
    // Lity Lightbox for galleries
    wp_enqueue_style( 'lity', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css', array(), '2.4.1' );
    wp_enqueue_script( 'lity', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js', array('jquery'), '2.4.1', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );