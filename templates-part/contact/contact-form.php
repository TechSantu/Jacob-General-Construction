<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>


    <!-- Contact Layout Grid Section -->
    <section class="contact_layout_section">
        <div class="section_inner">
            <div class="blog_layout_grid">
                
                <!-- Contact Quote Form Column (Left) -->
                <?php get_template_part('templates-part/common/form'); ?> 

                <!-- Contact Info Sidebar (Right) -->
                <aside class="blog_sidebar">
                    
                    <!-- Details Widget -->
                    <div class="sidebar_widget contact_info_widget" style="background: var(--bg-alt); border-radius: 12px; padding: 32px; border: 1px solid var(--border-color);">
                        <h3>Contact Information</h3>
                        <div class="widget_divider"></div>
                        
                        <div class="contact_cards_list" style="display: flex; flex-direction: column; gap: 24px; margin-top: 10px;">
                            
                            <?php
                            $phone = get_theme_mod( 'jacob_phone', '678-823-9501' );
                            if ( ! empty( $phone ) ) : 
                                $phone_url = preg_replace('/[^0-9+]/', '', $phone); 
                            ?>
                            <div class="contact_detail_card" style="display: flex; gap: 16px; align-items: flex-start;">
                                <div class="why_icon" style="background: rgba(202, 138, 4, 0.08); border-radius: 8px; color: var(--primary-color); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0 0 4px; font-size: 14px; font-weight: 800; color: var(--text-color);">Call Us Today</h4>
                                    <p style="margin: 0; font-size: 15px; font-weight: 700;"><a href="tel:<?php echo esc_attr( $phone_url ); ?>" style="text-decoration: none; color: inherit;"><?php echo esc_html( $phone ); ?></a></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php
                            $email = get_theme_mod( 'jacob_email', 'info@jacobgc.com' );
                            if ( ! empty( $email ) ) : 
                            ?>
                            <div class="contact_detail_card" style="display: flex; gap: 16px; align-items: flex-start;">
                                <div class="why_icon" style="background: rgba(202, 138, 4, 0.08); border-radius: 8px; color: var(--primary-color); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0 0 4px; font-size: 14px; font-weight: 800; color: var(--text-color);">Email Address</h4>
                                    <p style="margin: 0; font-size: 14px; font-weight: 600; color: var(--text-muted);"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="text-decoration: none; color: inherit;"><?php echo esc_html( $email ); ?></a></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php
                            $location = get_theme_mod( 'jacob_location', 'Metro Atlanta, Georgia' );
                            if ( ! empty( $location ) ) : 
                            ?>
                            <div class="contact_detail_card" style="display: flex; gap: 16px; align-items: flex-start;">
                                <div class="why_icon" style="background: rgba(202, 138, 4, 0.08); border-radius: 8px; color: var(--primary-color); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0 0 4px; font-size: 14px; font-weight: 800; color: var(--text-color);">Service Location</h4>
                                    <p style="margin: 0; font-size: 14px; line-height: 1.4; color: var(--text-muted);"><?php echo esc_html( $location ); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php
                            $hours = get_theme_mod( 'jacob_business_hours', 'Monday - Saturday: 7:00 AM - 6:00 PM' );
                            if ( ! empty( $hours ) ) : 
                            ?>
                            <div class="contact_detail_card" style="display: flex; gap: 16px; align-items: flex-start;">
                                <div class="why_icon" style="background: rgba(202, 138, 4, 0.08); border-radius: 8px; color: var(--primary-color); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0 0 4px; font-size: 14px; font-weight: 800; color: var(--text-color);">Business Hours</h4>
                                    <p style="margin: 0; font-size: 14px; line-height: 1.4; color: var(--text-muted);"><?php echo esc_html( $hours ); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php
                    $map_url = get_theme_mod( 'jacob_map_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d424396.31767789124!2d-84.50587785!3d33.7676338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f5045d6993098d%3A0x66fede2f990b630f!2sAtlanta%2C%20GA!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus' );
                    if ( ! empty( $map_url ) ) :
                    ?>
                    <!-- Service Map Block -->
                    <div class="sidebar_widget service_map_widget" style="background: var(--bg-alt); border-radius: 12px; padding: 32px; border: 1px solid var(--border-color); overflow: hidden;">
                        <h3>Our Service Area</h3>
                        <div class="widget_divider"></div>
                        <p style="font-size: 13px; color: var(--text-muted); line-height: 1.5; margin: 0 0 16px;">We proudly cover Cobb, Gwinnett, Fulton, DeKalb, and Cherokee counties in North Georgia.</p>
                        
                        <!-- Embedded Google Map -->
                        <iframe src="<?php echo esc_url( $map_url ); ?>" width="100%" height="220" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <?php endif; ?>

                </aside>

            </div>
        </div>
    </section>