<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;

    $story_subheading = '';
    $story_heading    = '';
    $story_content    = '';
    $story_image      = '';
    $values_subheading  = '';
    $values_heading     = '';
    $values_description = '';
    $values_list = array();

    if ( function_exists( 'get_field' ) ) {
        $story_subheading   = get_field('about_story_subheading', $post_id);
        $story_heading      = get_field('about_story_heading', $post_id);
        $story_content      = get_field('about_story_content', $post_id);
        $story_image        = get_field('about_story_image', $post_id);
        
        $values_subheading  = get_field('about_values_subheading', $post_id);
        $values_heading     = get_field('about_values_heading', $post_id);
        $values_description = get_field('about_values_description', $post_id);
        $values_list        = get_field('about_values_list', $post_id);
    }
?>

    <!-- About Main Content -->
    <section class="about_content_section">
        <div class="section_inner">
            <div class="about_story_grid">
                <div class="about_story_text">
                    <div class="section_heading about_heading">
                        <?php if ( $story_subheading ) : ?>
                            <p><?php echo esc_html( $story_subheading ); ?></p>
                        <?php endif; ?>
                        <?php if ( $story_heading ) : ?>
                            <h2><?php echo wp_kses_post( $story_heading ); ?></h2>
                        <?php endif; ?>
                    </div>
                    <?php echo wp_kses_post( $story_content ); ?>
                </div>
                <div class="about_story_image">
                    <?php if ( $story_image ) : ?>
                        <img src="<?php echo esc_url( $story_image ); ?>" alt="<?php echo esc_attr( strip_tags( $story_heading ) ); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values / Why Choose Us Style -->
    <section class="core_values_section">
        <div class="section_inner">
            <div class="section_heading">
                <?php if ( $values_subheading ) : ?>
                    <p><?php echo esc_html( $values_subheading ); ?></p>
                <?php endif; ?>
                <?php if ( $values_heading ) : ?>
                    <h2><?php echo wp_kses_post( $values_heading ); ?></h2>
                <?php endif; ?>
                <?php if ( $values_description ) : ?>
                    <p><?php echo esc_html( $values_description ); ?></p>
                <?php endif; ?>
            </div>
            
            <?php if ( ! empty( $values_list ) ) : ?>
                <div class="why_choose_cards">
                    <?php foreach ( $values_list as $val ) : 
                        $icon  = $val['icon'] ?? '';
                        $title = $val['title'] ?? '';
                        $desc  = $val['description'] ?? '';
                    ?>
                        <div class="why_card">
                            <?php if ( $icon ) : ?>
                                <div class="why_icon">
                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                </div>
                            <?php endif; ?>
                            <div class="why_card_content">
                                <?php if ( $title ) : ?>
                                    <h3><?php echo esc_html( $title ); ?></h3>
                                <?php endif; ?>
                                <?php if ( $desc ) : ?>
                                    <p><?php echo esc_html( $desc ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>