<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function jacob_theme_setup() {
    // Add custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for featured images
    add_theme_support( 'post-thumbnails' );

    register_nav_menus(
		array(
			'primary'      => __( 'Primary Menu', 'jacob-theme' ),
			'quick-links'  => __( 'Quick Links', 'jacob' ),
			'our-services' => __( 'Our Services', 'jacob' ),
		)
	);
}
add_action( 'after_setup_theme', 'jacob_theme_setup' );

/**
 * Adjust main queries for blog and search
 */
function jacob_blog_query_adjustments( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        
        // Show 4 posts per page on blog index and search results
        if ( $query->is_home() || $query->is_search() || $query->is_archive() ) {
            $query->set( 'posts_per_page', 4 );
        }
        
        // Restrict search results to only blog posts
        if ( $query->is_search() ) {
            $query->set( 'post_type', 'post' );
        }
    }
}
add_action( 'pre_get_posts', 'jacob_blog_query_adjustments' );

// Add 'has-submenu' class to list items with children
function jacob_nav_menu_css_class( $classes, $item, $args ) {
    if ( in_array( 'menu-item-has-children', $classes ) ) {
        $classes[] = 'has-submenu';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'jacob_nav_menu_css_class', 10, 3 );

// Add 'submenu' class to the submenu <ul> element
function jacob_nav_menu_submenu_css_class( $classes, $args, $depth ) {
    $classes[] = 'submenu';
    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'jacob_nav_menu_submenu_css_class', 10, 3 );
