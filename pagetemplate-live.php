<?php

use function immobilien_redaktion_2020\load_vimeo_image;

/**
 * Template Name: Landing Live
 */
get_header();
the_post();

$query = new \WP_Query( [
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'posts_per_page'      => 10,
	'tag__in'             => 989,
] );
?>

<?php get_template_part( 'banner', 'mega' ) ?>
<?php
wp_reset_postdata();
get_footer();
get_template_part( 'modal', 'immolive' );



