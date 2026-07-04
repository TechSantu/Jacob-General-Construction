<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$title = '';
$breadcrumbs = array();

// Add Home link
$breadcrumbs[] = '<a href="' . esc_url( home_url( '/' ) ) . '">Home</a>';

if ( is_search() ) {
    $title = sprintf( __( 'Search Results for: %s', 'jacob' ), get_search_query() );
    $breadcrumbs[] = '<span>Search</span>';
} elseif ( is_404() ) {
    $title = __( 'Page Not Found', 'jacob' );
    $breadcrumbs[] = '<span>404</span>';
} elseif ( is_archive() ) {
    $title = get_the_archive_title();
    $breadcrumbs[] = '<span>' . $title . '</span>';
} elseif ( is_home() ) {
    $blog_page_id = get_option( 'page_for_posts' );
    $title = $blog_page_id ? get_the_title( $blog_page_id ) : __( 'Blog', 'jacob' );
    $breadcrumbs[] = '<span>' . esc_html( $title ) . '</span>';
} elseif ( is_singular() ) {
    $post_id = get_the_ID();
    $title = get_the_title( $post_id );
    $post_type = get_post_type( $post_id );
    
    if ( $post_type === 'service' ) {
        $services_url = home_url( '/services/' );
        $breadcrumbs[] = '<a href="' . esc_url( $services_url ) . '">Services</a>';
    } elseif ( $post_type === 'post' ) {
        $blog_page_id = get_option( 'page_for_posts' );
        $blog_url = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/blog/' );
        $breadcrumbs[] = '<a href="' . esc_url( $blog_url ) . '">Blog</a>';
    } elseif ( $post_type === 'page' ) {
        $ancestors = get_post_ancestors( $post_id );
        if ( ! empty( $ancestors ) ) {
            $ancestors = array_reverse( $ancestors );
            foreach ( $ancestors as $ancestor ) {
                $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a>';
            }
        }
    }
    
    $breadcrumbs[] = '<span id="breadcrumb_service">' . esc_html( $title ) . '</span>';
}

$highlighted_title = esc_html( $title );
if ( ! empty( $title ) ) {
    $words = explode( ' ', $title );
    if ( count( $words ) > 1 ) {
        $last_word = array_pop( $words );
        $remaining = implode( ' ', $words );
        $highlighted_title = esc_html( $remaining ) . ' <span class="highlight">' . esc_html( $last_word ) . '</span>';
    }
}
?>

    <!-- Inner Hero Page Header -->
    <section class="inner_hero" aria-label="Page Hero">
        <div class="inner_hero_content">
            <?php if ( ! empty( $title ) ) : ?>
                <h1><?php echo $highlighted_title; ?></h1>
            <?php endif; ?>
            <p>
                <?php echo implode( ' ➔ ', $breadcrumbs ); ?>
            </p>
        </div>
    </section>