<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
$current_service_id = $post_id ? $post_id : get_the_ID();
$service_slug       = get_post_field( 'post_name', $current_service_id );
$process_subtitle   = get_field( 'service_process_subtitle', $current_service_id );
$process_steps      = get_field( 'service_process_steps', $current_service_id );

if ( ! empty( $process_steps ) && is_array( $process_steps ) ) :
?>
    <!-- Our Process Section — Full Width -->
    <section class="full_process_section">
        <div class="section_inner">
            <div class="service_process_wrapper" id="process_<?php echo esc_attr( $service_slug ); ?>">
                <h3>Our Process</h3>
                <?php if ( $process_subtitle ) : ?>
                    <p class="service_process_subtitle"><?php echo esc_html( $process_subtitle ); ?></p>
                <?php endif; ?>
                <div class="process_cards_grid">
                    <?php foreach ( $process_steps as $index => $step ) : ?>
                        <div class="process_card">
                            <div class="process_card_badge"><?php echo intval( $index + 1 ); ?></div>
                            <div class="process_card_content">
                                <h4><?php echo esc_html( $step['title'] ); ?></h4>
                                <p><?php echo esc_html( $step['description'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>