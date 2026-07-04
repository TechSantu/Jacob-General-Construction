<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>


    <!-- CTA -->
    <?php
    $subtitle         = function_exists( 'get_field' ) ? get_field( 'cta_subtitle', $post_id ) : '';
    $title            = function_exists( 'get_field' ) ? get_field( 'cta_title', $post_id ) : '';
    $desc             = function_exists( 'get_field' ) ? get_field( 'cta_description', $post_id ) : '';
    $primary_button   = function_exists( 'get_field' ) ? get_field( 'cta_primary_button', $post_id ) : null;
    $secondary_button = function_exists( 'get_field' ) ? get_field( 'cta_secondary_button', $post_id ) : null;
    ?>
    <section class="cta_section">
        <div class="section_inner">
            <div class="cta_wrapper">
                <div class="cta_content">
                    <?php if ( $subtitle ) : ?>
                        <p class="cta_subtitle"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                    <?php if ( $title ) : ?>
                        <h2><?php echo wp_kses_post( $title ); ?></h2>
                    <?php endif; ?>
                    <?php if ( $desc ) : ?>
                        <p><?php echo esc_html( $desc ); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ( $primary_button || $secondary_button ) : ?>
                    <div class="cta_actions">
                        <?php if ( ! empty( $primary_button['url'] ) && ! empty( $primary_button['title'] ) ) : ?>
                            <a class="cta_btn cta_btn_primary" href="<?php echo esc_url( $primary_button['url'] ); ?>"<?php echo ! empty( $primary_button['target'] ) ? ' target="' . esc_attr( $primary_button['target'] ) . '"' : ''; ?>>
                                <?php echo esc_html( $primary_button['title'] ); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ( ! empty( $secondary_button['url'] ) && ! empty( $secondary_button['title'] ) ) : ?>
                            <a class="cta_btn cta_btn_secondary" href="<?php echo esc_url( $secondary_button['url'] ); ?>"<?php echo ! empty( $secondary_button['target'] ) ? ' target="' . esc_attr( $secondary_button['target'] ) . '"' : ''; ?>>
                                <?php echo esc_html( $secondary_button['title'] ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>