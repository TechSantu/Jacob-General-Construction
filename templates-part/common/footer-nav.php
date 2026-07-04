<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
    <!-- footer -->
    <footer class="site_footer">
        <div class="section_inner">
            <div class="footer_grid">
                <div class="footer_col footer_about">
                    <?php 
                    $footer_logo = get_theme_mod( 'jacob_footer_logo' );
                    if ( empty( $footer_logo ) ) {
                        $footer_logo = get_template_directory_uri() . '/assets/image/white-logo.png';
                    }
                    ?>
                    <img class="footer_logo" src="<?php echo esc_url( $footer_logo ); ?>" alt="Jacob General Construction Logo">
                    <p><?php echo esc_html( get_theme_mod( 'jacob_footer_about', 'Jacob General Construction provides professional site work, grading, septic systems design/install, and concrete paving for residential and commercial spaces.' ) ); ?></p>
                    <form class="footer_newsletter_form" action="#" method="POST">
                        <input type="email" placeholder="Your Email Address" required aria-label="Email address for newsletter">
                        <button type="submit" aria-label="Subscribe"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                    <div class="footer_socials">
                        <?php 
                        $facebook  = get_theme_mod( 'jacob_facebook_url', 'https://facebook.com' );
                        $instagram = get_theme_mod( 'jacob_instagram_url', 'https://instagram.com' );
                        $linkedin  = get_theme_mod( 'jacob_linkedin_url', 'https://linkedin.com' );
                        $youtube   = get_theme_mod( 'jacob_youtube_url', 'https://youtube.com' );
                        
                        if ( $facebook ) : ?>
                            <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <?php endif;
                        if ( $instagram ) : ?>
                            <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <?php endif;
                        if ( $linkedin ) : ?>
                            <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <?php endif;
                        if ( $youtube ) : ?>
                            <a href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="footer_col footer_links">
                    <h3>Quick Links</h3>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'quick-links',
                            'container'      => false,
                            'fallback_cb'    => '__return_empty_string',
                        )
                    );
                    ?>
                </div>
                <div class="footer_col footer_links">
                    <h3>Our Services</h3>
                    <?php
                    $services_query = new WP_Query( array(
                        'post_type'      => 'service',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                    ) );

                    if ( $services_query->have_posts() ) :
                        echo '<ul>';
                        while ( $services_query->have_posts() ) : $services_query->the_post();
                            ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php
                        endwhile;
                        echo '</ul>';
                        wp_reset_postdata();
                    else :
                        wp_nav_menu(
                            array(
                                'theme_location' => 'our-services',
                                'container'      => false,
                                'fallback_cb'    => '__return_empty_string',
                            )
                        );
                    endif;
                    ?>
                </div>
                <div class="footer_col footer_contact">
                    <h3>Contact Information</h3>
                    <?php 
                    $phone = get_theme_mod( 'jacob_phone', '678-823-9501' );
                    $phone_link = preg_replace( '/[^0-9+]/', '', $phone );
                    $email = get_theme_mod( 'jacob_email', 'info@jacobgc.com' );
                    $location = get_theme_mod( 'jacob_location', 'Metro Atlanta, Georgia' );
                    $map_url = get_theme_mod( 'jacob_map_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d424396.31767789124!2d-84.50587785!3d33.7676338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f5045d6993098d%3A0x66fede2f990b630f!2sAtlanta%2C%20GA!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus' );
                    ?>
                    <?php if ( $phone ) : ?>
                        <p><span>Phone:</span> <a href="tel:<?php echo esc_attr( $phone_link ); ?>"><?php echo esc_html( $phone ); ?></a></p>
                    <?php endif; ?>
                    <?php if ( $email ) : ?>
                        <p><span>Email:</span> <a href="mailto:<?php echo esc_url( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
                    <?php endif; ?>
                    <?php if ( $location ) : ?>
                        <p><span>Location:</span> <?php echo esc_html( $location ); ?></p>
                    <?php endif; ?>
                    <?php 
                    $hours = get_theme_mod( 'jacob_business_hours', 'Monday - Saturday: 7:00 AM - 6:00 PM' );
                    if ( $hours ) : 
                    ?>
                        <p><span>Hours:</span> <?php echo esc_html( $hours ); ?></p>
                    <?php endif; ?>
                    <?php if ( $map_url ) : ?>
                        <div class="footer_map_container">
                            <iframe src="<?php echo esc_url( $map_url ); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer_bottom">
                <p><?php echo esc_html( get_theme_mod( 'jacob_copyright_text', '© 2026 Jacob General Construction. All rights reserved. | Site Grading, Septic & Concrete Experts.' ) ); ?></p>
            </div>
        </div>
    </footer>
