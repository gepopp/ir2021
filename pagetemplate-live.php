<?php
/**
 * Template Name: Landing Live
 */
get_header();
the_post();
get_template_part( 'banner', 'mega' );

$categories = get_terms( 'immolive_category' );
?>

    <div class="container mx-auto p-5 mt-20">
		<?php foreach ( $categories as $category ): ?>

            <div class="my-40">
                <div class="text-center mb-10 mt-40">
                    <h1 class="inline text-cent font-serif text-3xl font-semibold"
                        style="background: linear-gradient(0deg, <?php the_field( 'field_5c63ff4b7a5fb', 'immolive_category_' . $category->term_id ); ?> 0%,
					    <?php the_field( 'field_5c63ff4b7a5fb', 'immolive_category_' . $category->term_id ); ?> 50%, transparent 50%, transparent 100%);"><?php echo $category->name ?></h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

					<?php
					$date_now = date( 'Y-m-d H:i:s' );
					$query    = new WP_Query( [
						'post_type'      => 'immolive',
						'posts_per_page' => 8,
						'tax_query'      => [
							'relation' => 'AND',
							[
								'taxonomy' => 'immolive_category',
								'field'    => 'slug',
								'terms'    => $category->slug,
							],
						],
						'meta_query'     => [
							[
								'key'     => 'termin',
								'compare' => '<=',
								'value'   => $date_now,
								'type'    => 'DATETIME',
							],
						],
					] );

					while ( $query->have_posts() ): ?>
						<?php $query->the_post(); ?>

                        <div class="relative">
                            <a href="<?php the_permalink(); ?>" class="block bg-primary-100 h-full image-holder">
								<?php the_post_thumbnail( 'article', [
									'class' => 'w-full h-auto max-w-full',
								] ); ?>
								<?php get_template_part( 'snippet', 'heading', [ 'size' => 'small' ] ) ?>
                            </a>
                            <div class="absolute top-0 left-0 w-full p-5 flex justify-between text-white text-sm font-semibold w-full">
                                <span><?php the_time( 'd.m.Y' ); ?></span>
                                <span class="hidden lg:flex"><?php the_category( ', ' ); ?></span>
                            </div>
                        </div>
					<?php endwhile; ?>
                </div>
            </div>
		<?php endforeach; ?>
    </div>

<?php
get_footer();



