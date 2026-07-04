<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>

<!-- Project Gallary -->
    <?php
    $sub_title = function_exists( 'get_field' ) ? get_field( 'gallery_section_subtitle', $post_id ) : '';
    $title     = function_exists( 'get_field' ) ? get_field( 'gallery_section_title', $post_id ) : '';
    $desc      = function_exists( 'get_field' ) ? get_field( 'gallery_section_description', $post_id ) : '';
    ?>
    <section class="gallery_section">
        <div class="section_inner">
            <div class="section_heading">
                <?php if ( $sub_title ) : ?>
                    <p><?php echo esc_html( $sub_title ); ?></p>
                <?php endif; ?>
                <?php if ( $title ) : ?>
                    <h2><?php echo wp_kses_post( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( $desc ) : ?>
                    <p><?php echo esc_html( $desc ); ?></p>
                <?php endif; ?>
            </div>
            
            <?php
            $projects_query_args = array(
                'post_type'      => 'project',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            );

            if ( is_singular( 'service' ) ) {
                $projects_query_args['meta_query'] = array(
                    array(
                        'key'     => 'project_service',
                        'value'   => $post_id,
                        'compare' => '=',
                    ),
                );
            }

            $projects_query = new WP_Query( $projects_query_args );

            if ( $projects_query->have_posts() ) :
                ?>
                <div class="gallery_slider_container">
                    <div class="gallery_track">
                        <?php 
                        while ( $projects_query->have_posts() ) : $projects_query->the_post(); 
                            ?>
                            <div class="gallery_item">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                                <?php endif; ?>
                                <div class="gallery_overlay">
                                    <h4><?php the_title(); ?></h4>
                                    <?php if ( has_excerpt() ) : ?>
                                        <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="gallery_controls">
                    <button class="slider_arrow gallery_prev" type="button" aria-label="Previous project"><i class="fa-solid fa-chevron-left"></i></button>
                    <div class="gallery_dots"></div>
                    <button class="slider_arrow gallery_next" type="button" aria-label="Next project"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            <?php endif; ?>
        </div>
    </section>