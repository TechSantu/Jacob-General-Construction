<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>

   <!-- Get A Free Quote -->
    <?php
    $sidebar_title     = '';
    $sidebar_hours     = '';
    $sidebar_checklist = null;
    if ( function_exists( 'get_field' ) ) {
        $sidebar_title     = get_field( 'quote_sidebar_title', $post_id );
        $sidebar_hours     = get_theme_mod( 'jacob_business_hours', 'Monday - Saturday: 7:00 AM - 6:00 PM' );
        $sidebar_checklist = get_field( 'quote_sidebar_checklist', $post_id );
    }

    $phone = get_theme_mod( 'jacob_phone', '678-823-9501' );
    ?>
    <section class="quote_section">
        <div class="section_inner">
            <div class="quote_grid">
                <?php get_template_part('templates-part/common/form'); ?>                

                <div class="quote_info_sidebar">
                    <div class="quote_info_content">
                        <?php if ( $sidebar_title ) : ?>
                            <h3><?php echo esc_html( $sidebar_title ); ?></h3>
                            <div class="info_title_divider"></div>
                        <?php endif; ?>

                        <?php if ( ! empty( $sidebar_checklist ) && is_array( $sidebar_checklist ) ) : ?>
                            <ul class="why_checklist">
                                <?php 
                                foreach ( $sidebar_checklist as $item ) : 
                                    $icon  = $item['icon'] ?? '';
                                    $title = $item['title'] ?? '';
                                    $desc  = $item['description'] ?? '';
                                    
                                    if ( $title || $desc ) :
                                        ?>
                                        <li>
                                            <?php if ( $icon ) : ?>
                                                <span class="chk_icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
                                            <?php endif; ?>
                                            <div class="chk_text">
                                                <?php if ( $title ) : ?>
                                                    <strong><?php echo esc_html( $title ); ?></strong>
                                                <?php endif; ?>
                                                <?php if ( $desc ) : ?>
                                                    <p><?php echo esc_html( $desc ); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                        <?php
                                    endif;
                                endforeach; 
                                ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if ( $phone || $sidebar_hours ) : ?>
                        <div class="quote_info_footer">
                            <?php if ( $phone ) : ?>
                                <div class="footer_call_direct">
                                    <span class="call_icon_circle"><i class="fa-solid fa-phone"></i></span>
                                    <div class="call_text">
                                        <span>Prefer to talk?</span>
                                        <strong>Call us directly</strong>
                                    </div>
                                </div>
                                <div class="vertical_divider"></div>
                                <div class="footer_phone_details">
                                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" style="color: inherit; text-decoration: none;">
                                        <strong><?php echo esc_html( $phone ); ?></strong>
                                    </a>
                                    <?php if ( $sidebar_hours ) : ?>
                                        <span><?php echo esc_html( $sidebar_hours ); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>