<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );
?>

<!-- Services Main Listing Section (Staggered Layout) -->
<section class="services_list_section">
    <div class="section_inner">
        <div class="services_staggered_list">
            
            <?php 
            if ( $services_query->have_posts() ) :
                $count = 0;
                while ( $services_query->have_posts() ) : $services_query->the_post(); 
                    $count++;
                    $is_reverse = ( $count % 2 === 0 ) ? ' reverse' : '';
                    $highlights = function_exists('get_field') ? get_field('service_highlights', get_the_ID()) : false;
            ?>
                <div class="service_staggered_item<?php echo esc_attr($is_reverse); ?>">
                    <div class="service_staggered_image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="service_staggered_content">
                        <h2><?php the_title(); ?></h2>
                        <?php 
                        $service_text = get_the_content();
                        ?>
                        <p><?php echo esc_html( wp_trim_words( $service_text, 220, '...' ) ); ?></p>
                        
                        <?php if ( $highlights && is_array( $highlights ) ) : ?>
                            <ul>
                                <?php foreach ( $highlights as $highlight ) : ?>
                                    <?php if ( ! empty( $highlight['text'] ) ) : ?>
                                        <li><?php echo esc_html( $highlight['text'] ); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        
                        <a href="<?php the_permalink(); ?>" class="cta_quote_btn">
                            <span>Service Scope Details</span>
                            <span class="arrow_circle"><i class="fa-solid fa-chevron-right"></i></span>
                        </a>
                    </div>
                </div>
            <?php 
                endwhile;
                wp_reset_postdata();
            endif; 
            ?>

        </div>
    </div>
</section>