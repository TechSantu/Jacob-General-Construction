<?php
/**
 * Template Name: Home
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
$post_id = get_the_ID();
get_header();

$parts = array(
	'home/banner-home',
	'home/our-service',
	'home/testimonials',
	'common/faq',
	'home/quote',
	'home/gallary',
	'home/blog',
	'common/cta',
);

foreach ( $parts as $part ) {
	get_template_part( 'templates-part/' . $part );
}

get_footer();