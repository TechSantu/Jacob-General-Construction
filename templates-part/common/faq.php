<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>


    <!-- FAQ Section -->
    <?php
    $sub_title = function_exists( 'get_field' ) ? get_field( 'faq_section_subtitle', $post_id ) : '';
    $title     = function_exists( 'get_field' ) ? get_field( 'faq_section_title', $post_id ) : '';
    $desc      = function_exists( 'get_field' ) ? get_field( 'faq_section_description', $post_id ) : '';
    $faq_items = function_exists( 'get_field' ) ? get_field( 'faq_items', $post_id ) : null;
    ?>
    <section class="faq_section">
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
            
            <?php if ( ! empty( $faq_items ) && is_array( $faq_items ) ) : ?>
                <div class="faq_accordion">
                    <?php 
                    foreach ( $faq_items as $index => $item ) : 
                        $question = $item['question'] ?? '';
                        $answer   = $item['answer'] ?? '';
                        $num      = sprintf( '%02d', $index + 1 );
                        
                        if ( $question && $answer ) :
                            ?>
                            <div class="faq_item">
                                <button class="faq_trigger" type="button">
                                    <span class="faq_num"><?php echo esc_html( $num ); ?></span>
                                    <span class="faq_question"><?php echo esc_html( $question ); ?></span>
                                    <span class="faq_icon_holder">
                                        <i class="fa-solid fa-plus toggle_icon"></i>
                                    </span>
                                </button>
                                <div class="faq_panel">
                                    <?php echo wp_kses_post( $answer ); ?>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach; 
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>