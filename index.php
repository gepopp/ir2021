<?php
/**
 * The default single page template.
 *
 * @author Freeshifter LLC
 * @since  1.0.0
 */

namespace immobilien_redaktion_2020;

get_header();
?>
    <div id="quick-survey">
		<?php
		$query1 = new \WP_Query( [
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => 1,
		] );
		$query2 = new \WP_Query( [
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => 3,
			'offset'              => 1,
		] );


		get_template_part( 'part', 'threearticle', [ 'query1' => $query1, 'query2' => $query2 ] );

		get_template_part( 'banner', 'fourbanner' );

		get_template_part( 'part', 'liverow', [ 'when' => 'past' ] );

		get_template_part( 'part', 'aktuellesrow' );

		get_template_part( 'banner', 'thirds2' );

		get_template_part( 'part', 'projekterow' );

		?>
    </div>
    </div>

	<?php
get_footer();
