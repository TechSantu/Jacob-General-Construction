<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>


    <!-- testimonials -->
    <?php
    $sub_title = function_exists( 'get_field' ) ? get_field( 'testimonials_section_subtitle', $post_id ) : '';
    $title     = function_exists( 'get_field' ) ? get_field( 'testimonials_section_title', $post_id ) : '';
    $desc      = function_exists( 'get_field' ) ? get_field( 'testimonials_section_description', $post_id ) : '';
    ?>
    <section class="testimonials_section">
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
            $testimonials_query = new WP_Query( array(
                'post_type'      => 'testimonial',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ) );

            if ( $testimonials_query->have_posts() ) :
                ?>
                <div class="testimonials_slider_container">
                    <div class="testimonials_track">
                        <?php 
                        while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
                            $client_role = function_exists( 'get_field' ) ? get_field( 'client_role' ) : '';
                            $rating      = intval( function_exists( 'get_field' ) ? get_field( 'testimonial_rating' ) : 5 );
                            ?>
                            <article class="testimonial_card">
                                <div class="quote_icon">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <p class="quote_text"><?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?></p>
                                <div class="client_divider"></div>
                                <div class="client_info">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <img class="client_avatar" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                    <div class="client_meta">
                                        <p class="client_name"><?php the_title(); ?></p>
                                        <?php if ( $client_role ) : ?>
                                            <p class="client_service"><?php echo esc_html( $client_role ); ?></p>
                                        <?php endif; ?>
                                        <div class="stars">
                                            <?php 
                                            for ( $i = 1; $i <= 5; $i++ ) {
                                                if ( $i <= $rating ) {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa-regular fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="testimonials_controls">
                    <button class="slider_arrow prev_arrow" type="button" aria-label="Previous testimonial"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <div class="slider_dots"></div>
                    <button class="slider_arrow next_arrow" type="button" aria-label="Next testimonial"><i
                            class="fa-solid fa-chevron-right"></i></button>
                </div>
            <?php endif; ?>
        </div>
    </section>
