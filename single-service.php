<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
$post_id = get_the_ID();
get_header();

$parts = array(
	'common/inner-banner',
	'services/service-detaiels',
	'services/ourprocess',
	'common/faq',
    'home/testimonials',
    'home/gallary',
);

foreach ( $parts as $part ) {
	get_template_part( 'templates-part/' . $part );
}

get_footer();