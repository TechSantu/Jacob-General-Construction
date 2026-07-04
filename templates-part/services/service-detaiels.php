<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
$current_service_id = $post_id ? $post_id : get_the_ID();
$service_title      = get_the_title( $current_service_id );
$service_slug       = get_post_field( 'post_name', $current_service_id );
$service_content    = get_post_field( 'post_content', $current_service_id );
?>
    <section class="service_details_section">
        <div class="section_inner">
            <div class="blog_layout_grid">
                
                <main class="blog_main_col">
                    <article class="service_scope_block" id="article_<?php echo esc_attr( $service_slug ); ?>">
                        <h2><?php echo esc_html( $service_title ); ?></h2>
                        <div class="title_divider"></div>
                        <?php if ( has_post_thumbnail( $current_service_id ) ) : ?>
                            <div class="post_featured_image">
                                <?php echo get_the_post_thumbnail( $current_service_id, 'large' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="post_content">
                            <?php echo apply_filters( 'the_content', $service_content ); ?>
                        </div>
                    </article>
                </main>

                <aside class="blog_sidebar">
                    
                    <div class="sidebar_widget services_list_widget">
                        <h3>Our Services</h3>
                        <div class="widget_divider"></div>
                        <ul class="sidebar_services_links">
                            <?php
                            $services_list_query = new WP_Query( array(
                                'post_type'      => 'service',
                                'posts_per_page' => -1,
                                'post_status'    => 'publish',
                            ) );
                            if ( $services_list_query->have_posts() ) :
                                while ( $services_list_query->have_posts() ) : $services_list_query->the_post();
                                    $item_slug = get_post_field( 'post_name', get_the_ID() );
                                    $is_active = ( $item_slug === $service_slug );
                                    $link_url = get_permalink();
                                    ?>
                                    <li id="sidemenu_<?php echo esc_attr( $item_slug ); ?>" <?php echo $is_active ? 'class="active_service_link"' : ''; ?>>
                                        <a href="<?php echo esc_url( $link_url ); ?>">
                                            <?php the_title(); ?> <i class="fa-solid fa-chevron-right"></i>
                                        </a>
                                    </li>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                    </div>

                    <?php
                    $video_cover   = get_field( 'service_video_cover', $current_service_id );
                    $video_url     = get_field( 'service_video_url', $current_service_id );
                    $video_caption = get_field( 'service_video_caption', $current_service_id );
                    if ( ! empty( $video_url ) ) :
                        $cover_image_url = ! empty( $video_cover ) ? $video_cover['url'] : get_theme_file_uri( '/assets/image/slider-image1.jpg' );
                    ?>
                        <div class="sidebar_widget media_widget">
                            <h3>Watch Us In Action</h3>
                            <div class="widget_divider"></div>
                            <div class="video_container">
                                <a href="<?php echo esc_url( $video_url ); ?>" data-lity class="video_wrapper" style="display: block; position: relative;">
                                    <img src="<?php echo esc_url( $cover_image_url ); ?>" alt="Video cover - <?php echo esc_attr( $service_title ); ?>">
                                    <div class="play_btn_overlay">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </a>
                            </div>
                            <?php if ( $video_caption ) : ?>
                                <p class="media_caption"><?php echo esc_html( $video_caption ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    $jobsite_photos = get_field( 'service_jobsite_photos', $current_service_id );
                    if ( ! empty( $jobsite_photos ) && is_array( $jobsite_photos ) ) :
                    ?>
                        <div class="sidebar_widget media_widget">
                            <h3>Jobsite Photos</h3>
                            <div class="widget_divider"></div>
                            <div class="media_grid">
                                <?php foreach ( $jobsite_photos as $photo ) : ?>
                                    <div class="media_photo">
                                        <a href="<?php echo esc_url( $photo['url'] ); ?>" data-lity>
                                            <img src="<?php echo esc_url( $photo['sizes']['medium'] ?? $photo['url'] ); ?>" alt="<?php echo esc_attr( $photo['alt'] ); ?>">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </aside>

            </div>
        </div>
    </section>