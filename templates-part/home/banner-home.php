<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>

    <section class="banner_slider" aria-label="Featured services">
        <div class="banner_viewport">
            <div class="banner_track">
                <?php 
                $banner_slides = function_exists( 'get_field' ) ? get_field( 'banner_slides', $post_id ) : null;
                if ( ! empty( $banner_slides ) && is_array( $banner_slides ) ) : 
                    $words = array( 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten' );
                    foreach ( $banner_slides as $index => $slide ) : 
                        $image = $slide['image'] ?? '';
                        $label = $slide['label'] ?? '';
                        $title = $slide['title'] ?? '';
                        $description = $slide['description'] ?? '';
                        $button = $slide['button'] ?? '';
                        
                        $image_url = '';
                        $image_alt = '';
                        if ( is_array( $image ) ) {
                            $image_url = $image['url'] ?? '';
                            $image_alt = $image['alt'] ?? '';
                        }
                        if ( is_numeric( $image ) ) {
                            $image_url = wp_get_attachment_image_url( $image, 'full' );
                            $image_alt = get_post_meta( $image, '_wp_attachment_image_alt', true );
                        }
                        if ( is_string( $image ) && ! is_numeric( $image ) && ! empty( $image ) ) {
                            $image_url = $image;
                            $image_alt = $title;
                        }
                        
                        $heading_tag = ( $index === 0 ) ? 'h1' : 'h2';
                        $slide_word = isset( $words[$index] ) ? $words[$index] : 'one';
                        
                        $btn_url    = '';
                        $btn_title  = '';
                        $btn_target = '';
                        if ( is_array( $button ) ) {
                            $btn_url    = $button['url'] ?? '';
                            $btn_title  = $button['title'] ?? '';
                            $btn_target = $button['target'] ?? '';
                        }
                        if ( is_string( $button ) && ! empty( $button ) ) {
                            $btn_url    = $button;
                            $btn_title  = __( 'Book Now', 'jacob' );
                            $btn_target = '_self';
                        }
                        ?>
                        <article class="banner_slide banner_slide_<?php echo esc_attr( $slide_word ); ?>">
                            <?php if ( $image_url ) : ?>
                                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
                            <?php endif; ?>
                            <div class="banner_content">
                                <?php if ( $label ) : ?>
                                    <p class="banner_label"><?php echo esc_html( $label ); ?></p>
                                <?php endif; ?>
                                
                                <?php if ( $title ) : ?>
                                    <<?php echo $heading_tag; ?>><?php echo esc_html( $title ); ?></<?php echo $heading_tag; ?>>
                                <?php endif; ?>
                                
                                <?php if ( $description ) : ?>
                                    <p><?php echo esc_html( $description ); ?></p>
                                <?php endif; ?>
                                
                                <?php if ( $btn_url && $btn_title ) : ?>
                                    <a class="banner_btn" href="<?php echo esc_url( $btn_url ); ?>"<?php echo $btn_target ? ' target="' . esc_attr( $btn_target ) . '"' : ''; ?>>
                                        <?php echo esc_html( $btn_title ); ?> 
                                        <span class="fa fa-arrow-circle-right" aria-hidden="true"></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="banner_controls" aria-label="Banner controls">
            <button class="banner_arrow banner_prev" type="button" aria-label="Previous slide"></button>
            <button class="banner_arrow banner_next" type="button" aria-label="Next slide"></button>
        </div>
    </section>