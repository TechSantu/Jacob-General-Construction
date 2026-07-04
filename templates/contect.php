<?php
/**
 * Template Name: Contact
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
$post_id = get_the_ID();
get_header();

$parts = array(
	'common/inner-banner',
	'contact/contact-form',
    'common/cta',
);

foreach ( $parts as $part ) {
	get_template_part( 'templates-part/' . $part );
}

get_footer();