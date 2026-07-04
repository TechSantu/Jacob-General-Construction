<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>
    <!-- Our Services -->
    <section class="services_section">
        <div class="section_inner">
            <?php
            $sub_title = function_exists( 'get_field' ) ? get_field( 'services_section_subtitle', $post_id ) : '';
            $title     = function_exists( 'get_field' ) ? get_field( 'services_section_title', $post_id ) : '';
            $desc      = function_exists( 'get_field' ) ? get_field( 'services_section_description', $post_id ) : '';
            ?>
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

            <div class="services_grid">
                <?php
                $services_query = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ) );

                if ( $services_query->have_posts() ) :
                    while ( $services_query->have_posts() ) : $services_query->the_post();
                        $icon_class = function_exists( 'get_field' ) ? get_field( 'service_icon', get_the_ID() ) : '';
                        ?>
                        <article class="service_card">
                            <div class="service_image_wrapper">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a class="service_image" href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ( $icon_class ) : ?>
                                    <div class="service_icon_badge">
                                        <i class="<?php echo esc_attr( $icon_class ); ?>"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="service_content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="title_divider"></div>
                                <?php if ( has_excerpt() ) : ?>
                                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                                <?php endif; ?>
                                <a class="read_more_btn" href="<?php the_permalink(); ?>">
                                    <span>Read More</span>
                                    <span class="arrow_circle"><i class="fa-solid fa-chevron-right"></i></span>
                                </a>
                            </div>
                        </article>
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                endif; 
                ?>
            </div>
        </div>
    </section>