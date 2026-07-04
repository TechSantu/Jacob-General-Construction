<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function jacob_customize_register( $wp_customize ) {
    // Add Header Settings Section
    $wp_customize->add_section( 'jacob_header_section', array(
        'title'    => __( 'Header Settings', 'jacob-theme' ),
        'priority' => 30,
    ) );

    // Phone Number Setting
    $wp_customize->add_setting( 'jacob_phone', array(
        'default'           => '678-823-9501',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_phone', array(
        'label'    => __( 'Phone Number', 'jacob-theme' ),
        'section'  => 'jacob_header_section',
        'type'     => 'text',
    ) );

    // Phone Number Label Setting
    $wp_customize->add_setting( 'jacob_phone_label', array(
        'default'           => 'Call Us Now',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_phone_label', array(
        'label'    => __( 'Phone Label', 'jacob-theme' ),
        'section'  => 'jacob_header_section',
        'type'     => 'text',
    ) );

    // Quote Recipient Email Setting
    $wp_customize->add_setting( 'jacob_quote_recipient_email', array(
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_quote_recipient_email', array(
        'label'       => __( 'Quote Form Recipient Email', 'jacob-theme' ),
        'description' => __( 'Email address where quote request submissions will be sent.', 'jacob-theme' ),
        'section'     => 'jacob_header_section',
        'type'        => 'email',
    ) );

    // Add Footer Settings Section
    $wp_customize->add_section( 'jacob_footer_section', array(
        'title'    => __( 'Footer Settings', 'jacob-theme' ),
        'priority' => 31,
    ) );

    // Footer Logo Setting
    $wp_customize->add_setting( 'jacob_footer_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'jacob_footer_logo', array(
        'label'    => __( 'Footer Logo (White)', 'jacob-theme' ),
        'section'  => 'jacob_footer_section',
        'settings' => 'jacob_footer_logo',
    ) ) );

    // Footer About Text Setting
    $wp_customize->add_setting( 'jacob_footer_about', array(
        'default'           => 'Jacob General Construction provides professional site work, grading, septic systems design/install, and concrete paving for residential and commercial spaces.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_footer_about', array(
        'label'    => __( 'Footer Description', 'jacob-theme' ),
        'section'  => 'jacob_footer_section',
        'type'     => 'textarea',
    ) );

    // Social Links Section
    $wp_customize->add_section( 'jacob_socials_section', array(
        'title'    => __( 'Social Media Links', 'jacob-theme' ),
        'priority' => 32,
    ) );

    // Facebook Setting
    $wp_customize->add_setting( 'jacob_facebook_url', array(
        'default'           => 'https://facebook.com',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_facebook_url', array(
        'label'    => __( 'Facebook URL', 'jacob-theme' ),
        'section'  => 'jacob_socials_section',
        'type'     => 'text',
    ) );

    // Instagram Setting
    $wp_customize->add_setting( 'jacob_instagram_url', array(
        'default'           => 'https://instagram.com',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_instagram_url', array(
        'label'    => __( 'Instagram URL', 'jacob-theme' ),
        'section'  => 'jacob_socials_section',
        'type'     => 'text',
    ) );

    // LinkedIn Setting
    $wp_customize->add_setting( 'jacob_linkedin_url', array(
        'default'           => 'https://linkedin.com',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_linkedin_url', array(
        'label'    => __( 'LinkedIn URL', 'jacob-theme' ),
        'section'  => 'jacob_socials_section',
        'type'     => 'text',
    ) );

    // YouTube Setting
    $wp_customize->add_setting( 'jacob_youtube_url', array(
        'default'           => 'https://youtube.com',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_youtube_url', array(
        'label'    => __( 'YouTube URL', 'jacob-theme' ),
        'section'  => 'jacob_socials_section',
        'type'     => 'text',
    ) );

    // Contact Email Setting
    $wp_customize->add_setting( 'jacob_email', array(
        'default'           => 'info@jacobgc.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_email', array(
        'label'    => __( 'Contact Email', 'jacob-theme' ),
        'section'  => 'jacob_footer_section',
        'type'     => 'text',
    ) );

    // Location Setting
    $wp_customize->add_setting( 'jacob_location', array(
        'default'           => 'Metro Atlanta, Georgia',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_location', array(
        'label'    => __( 'Location Text', 'jacob-theme' ),
        'section'  => 'jacob_footer_section',
        'type'     => 'text',
    ) );

    // Business Hours Setting
    $wp_customize->add_setting( 'jacob_business_hours', array(
        'default'           => 'Monday - Saturday: 7:00 AM - 6:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_business_hours', array(
        'label'    => __( 'Business Hours', 'jacob-theme' ),
        'section'  => 'jacob_footer_section',
        'type'     => 'text',
    ) );

    // Map URL Setting
    $wp_customize->add_setting( 'jacob_map_url', array(
        'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d424396.31767789124!2d-84.50587785!3d33.7676338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f5045d6993098d%3A0x66fede2f990b630f!2sAtlanta%2C%20GA!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_map_url', array(
        'label'    => __( 'Google Maps Embed URL', 'jacob-theme' ),
        'section'  => 'jacob_footer_section',
        'type'     => 'textarea',
    ) );

    // Copyright Text Setting
    $wp_customize->add_setting( 'jacob_copyright_text', array(
        'default'           => '© 2026 Jacob General Construction. All rights reserved. | Site Grading, Septic & Concrete Experts.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jacob_copyright_text', array(
        'label'    => __( 'Copyright Text', 'jacob-theme' ),
        'section'  => 'jacob_footer_section',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'jacob_customize_register' );
