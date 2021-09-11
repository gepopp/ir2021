<?php
/**
 * Template Name: Lesen
 */
get_header();
?>


    <div class="container mx-auto mt-20 relative">
        <h1 class="font-sans text-5xl uppercase font-semibold text-gray-800 text-center"><?php _e( 'lesen', 'ir21' ) ?></h1>
    </div>

<?php get_template_part( 'banner', 'mega' ) ?>

<?php $cats = get_categories( [ 'exclude' => [ 1, 17, 996 ], 'parent' => 0, 'hide_empty' => true ] ) ?>

<?php
$catrunner = 1;
foreach ( $cats as $cat ):
	?>
    <div class="container mx-auto mt-20 px-5 lg:px-0">
		<?php $color = get_field( 'field_5c63ff4b7a5fb', $cat ) ?>
        <a href="<?php echo get_category_link( $cat ) ?>" class="text-2xl font-bold hover:underline mb-3"
           style="background: linear-gradient(0deg, <?php echo $color ?> 0%, <?php echo $color ?> 50%, transparent 50%, transparent 100%);">
			<?php echo $cat->name ?>
        </a>
        <div class="grid grid-cols-4 lg:grid-cols-5 gap-4">
			<?php
			$query = new WP_Query( [
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 5,
				'category__in'   => [ $cat->term_id ],
			] );
			if ( $query->have_posts() ):
				$runner = 1;
				while ( $query->have_posts() ):
					$query->the_post();
					?>
                    <div class="<?php if ( $runner != 5 ): ?>col-span-2 <?php else: ?>col-span-4 <?php endif; ?>lg:col-span-1">

						<?php if ( $runner == 2 && get_field( 'field_60da235237ec4', $cat ) ): ?>
                            <div>
                                <a href="<?php echo get_field( 'field_5f9aeff4efa16', $cat ) ?>">
                                    <img src="<?php the_field( 'field_60da235237ec4', $cat ); ?>" class="w-full h-auto">
                                    <p class="mt-1 text-gray-300 font-semibold text-xs pb-5">Werbung</p>
                                </a>
                            </div>
						<?php else: ?>
                            <div class="relative">
                                <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full image-holder">
									<?php the_post_thumbnail( 'article', [ 'class' => 'w-full h-auto max-w-full' ] ); ?>
                                </a>
								<?php if ( $runner == 5 ): ?>
                                    <div class="absolute top-0 left-0 w-full h-full bg-white bg-opacity-75 flex justify-center items-center">
                                        <p class="font-bold text-xs">
                                            <a href="<?php echo get_category_link( $cat ) ?>" class="underline">
												<?php echo $cat->count - 4 ?><?php _e( 'weitere Artikel', 'ir21' ) ?>
                                        </p>
                                        </a>
                                    </div>
								<?php endif; ?>
                            </div>
							<?php if ( $runner != 5 && $runner != 2 ): ?>
                                <p class="mt-5 font-semibold text-xs pb-5">
                                    <a href="<?php the_permalink(); ?>">
										<?php the_title() ?>
                                    </a>
                                </p>
							<?php endif; ?>
						<?php endif; ?>
                    </div>
					<?php
					$runner ++;
				endwhile;
			endif;
			wp_reset_postdata();
			?>
        </div>
    </div>
	<?php
	$catrunner ++;
endforeach;
get_footer();
