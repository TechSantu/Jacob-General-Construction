<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<header class="bd_header">
    <input class="nav-toggle" type="checkbox" id="nav-toggle" aria-label="Toggle menu">

    <div class="logo">
        <?php
        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
            the_custom_logo();
        else :
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/logo.png' ); ?>" alt="Logo">
            </a>
        <?php endif; ?>
    </div>

    <label class="hamburger" for="nav-toggle" aria-label="Open menu">
        <span></span>
        <span></span>
            <span></span>
        </label>

        <nav class="menu_full main-navigation" aria-label="Main navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'fallback_cb'    => '__return_empty_string',
                )
            );
            ?>
        </nav>

        <div class="headcall">
            <?php 
            $phone = get_theme_mod( 'jacob_phone', '678-823-9501' );
            $phone_label = get_theme_mod( 'jacob_phone_label', 'Call Us Now' );
            $phone_link = preg_replace( '/[^0-9+]/', '', $phone );
            ?>
            <a class="callheader" href="tel:<?php echo esc_attr( $phone_link ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/call-icon.png' ); ?>" alt="Call Icon">
                <div class="numtex">
                    <p><span><?php echo esc_html( $phone_label ); ?></span><?php echo esc_html( $phone ); ?></p>
                </div>
            </a>
        </div>
    </header>