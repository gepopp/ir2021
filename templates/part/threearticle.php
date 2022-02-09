<?php
/**
 * @var $query1
 * @var $query2
 */
extract( $args );
?>
<div class="container spaced mx-auto">
	<?php if ( $query1->have_posts() ): ?>
		<?php while ( $query1->have_posts() ): ?>
			<?php $query1->the_post(); ?>
            <section class="mb-5 pb-5 border-b border-primary-100">
                <div class="container flex flex-col px-6 mx-auto space-y-6 xl:flex-row xl:items-center">
                    <div class="w-full xl:w-1/2">
                        <div class="xl:max-w-lg">
                            <h1 class="text-3xl font-bold tracking-wide text-gray-800 lg:text-5xl mt-5">
                                <a href="<?php the_permalink(); ?>">
									<?php echo the_title() ?>
                                </a>
                            </h1>
                            <p class="border-t border-b border-primary-100 my-3 py-3 text-lg font-semibold text-center flex justify-between">
								<?php
								$cats = wp_get_post_categories( get_the_ID() );
								$cat  = array_shift( $cats );
								$cat  = get_category( $cat );
								?>
                                <a href="<?php echo get_category_link( $cat->term_id ) ?>"><?php echo $cat->name ?></a>
								<?php echo get_the_time( 'd.m.Y' ) ?>
                            </p>
                            <div class="mt-8 space-y-5">
                                <p class="flex items-center text-gray-700 line-clamp-5">
									<?php the_excerpt(); ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" class="w-full bg-primary-100 shadow-2xl text-white text-center py-3 hover:shadow-2xl hover:font-semibold block">Jetzt lesen</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center w-full xl:w-1/2 order-first xl:order-last">
                        <a href="<?php the_permalink(); ?>" class="">
							<?php the_post_thumbnail( 'custom-thumbnail' ); ?>
                        </a>
                    </div>
                </div>
            </section>
		<?php endwhile; ?>
	<?php endif; ?>

	<?php get_template_part( 'banner', 'mega' ); ?>

	<?php if ( $query2->have_posts() ): ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 my-5">
			<?php while ( $query2->have_posts() ): ?>
				<?php $query2->the_post(); ?>
                <div class="bg-white shadow-lg">
                    <a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'article' ); ?>
                    </a>
                    <div class="p-3">
                        <h2 class="text-xl font-bold tracking-wide text-gray-800 lg:text-2xl mt-5 line-clamp-2 h-16"><?php the_title() ?></h2>
                        <p class="border-t border-b border-primary-100 my-3 py-3 text-lg font-semibold text-center flex justify-between">
							<?php
							$cats = wp_get_post_categories( get_the_ID() );
							$cat  = array_shift( $cats );
							$cat  = get_category( $cat );
							?>
                            <a href="<?php echo get_category_link( $cat->term_id ) ?>"><?php echo $cat->name ?></a>
							<?php echo get_the_time( 'd.m.Y' ) ?>
                        </p>
                        <p class="line-clamp-3 mb-4"><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="w-full bg-primary-100 shadow-2xl text-white text-center py-3 hover:shadow-2xl hover:font-semibold block">Jetzt lesen</a>
                    </div>
                </div>
			<?php endwhile; ?>
        </div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>
