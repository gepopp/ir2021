<?php
/**
 * The default archive page template.
 *
 * @author Freeshifter LLC
 * @since 1.0.0
 */

namespace immobilien_redaktion_2020;

use irclasses\Pagination;

get_header(); ?>
	<div class="container mx-auto relative z-10 mb-16 lg:mb-32 flex items-start three-lines">
		<h1><?= get_the_archive_title(); ?></h1>
		<div class="lg:w-3/5 pr-10">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					echo get_template_part( 'article', 'jsonld' );

					echo get_template_part( 'content', 'article' );
				}
			} ?>
		</div>
	</div>
    <div class="mt-48">
		<?php Pagination::paginate(); ?>
    </div>
	<?php
get_footer();