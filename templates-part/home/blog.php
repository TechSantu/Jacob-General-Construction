<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>


    <!-- blog -->
    <?php
    $sub_title = function_exists( 'get_field' ) ? get_field( 'blog_section_subtitle', $post_id ) : '';
    $title     = function_exists( 'get_field' ) ? get_field( 'blog_section_title', $post_id ) : '';
    $desc      = function_exists( 'get_field' ) ? get_field( 'blog_section_description', $post_id ) : '';
    ?>
    <section class="blog_section">
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
            $blog_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
            ) );

            if ( $blog_query->have_posts() ) :
                ?>
                <div class="blog_grid">
                    <?php 
                    while ( $blog_query->have_posts() ) : $blog_query->the_post();
                        $categories = get_the_category();
                        $category_name = ! empty( $categories ) ? $categories[0]->name : '';
                        ?>
                        <article class="blog_card">
                            <div class="blog_image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                                <?php endif; ?>
                            </div>
                            <div class="blog_content">
                                <div class="blog_meta">
                                    <?php if ( $category_name ) : ?>
                                        <span class="blog_tag"><?php echo esc_html( $category_name ); ?></span>
                                    <?php endif; ?>
                                    <span class="blog_date"><?php echo esc_html( get_the_date() ); ?></span>
                                </div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php if ( has_excerpt() ) : ?>
                                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                                <?php endif; ?>
                                <a class="blog_read_more" href="<?php the_permalink(); ?>">Read Article <span>➔</span></a>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>