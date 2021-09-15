<?php
/**
 * @var $categories
 */
extract( $args );
?>


<div class="container mx-auto p-5">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
		<?php foreach ( $categories as $category ): ?>
            <div>
                <div class="mb-10 mt-20">
                    <h1 class="inline font-serif text-xl font-semibold"
                        style="background: linear-gradient(0deg, <?php the_field( 'field_5c63ff4b7a5fb', 'immolive_category_' . $category->term_id ); ?> 0%,
					    <?php the_field( 'field_5c63ff4b7a5fb', 'immolive_category_' . $category->term_id ); ?> 50%, transparent 50%, transparent 100%);"><?php echo $category->name ?></h1>
                </div>


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
							'compare' => '>=',
							'value'   => $date_now,
							'type'    => 'DATETIME',
						],
					],
				] );
				if ( $query->have_posts() ):?>
					<?php while ( $query->have_posts() ): ?>
						<?php $query->the_post(); ?>
                        <div class="relative mb-20">
                            <div class="absolute top-0 left-0 w-full p-3 text-white flex justify-between text-primary-100 font-semibold bg-white">
								<?php
								$starts = new \Carbon\Carbon(get_field('field_5ed527e9c2279'));
								\Carbon\Carbon::setLocale('de'); ?>
                                <span>
                        <?php echo 'Live ' . $starts->diffForHumans() ?>
                        </span>
                                <span>
                            <?php
                            $terms = wp_get_post_terms(get_the_ID(), 'immolive_category');
                            $term = array_shift($terms);
                            echo $term->name;
                            ?>
                        </span>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="block bg-primary-100 h-full image-holder">
								<?php the_post_thumbnail( 'article', [
									'class' => 'w-full h-auto max-w-full',
								] ); ?>
								<?php get_template_part( 'snippet', 'heading', [ 'size' => 'small' ] ) ?>
                            </a>
                        </div>
					<?php endwhile; ?>
				<?php else: ?>

                    <div class="w-full bg-white text-primary">
                        <div class="w-full h-full top-0 left-0 flex justify-center items-center">
                            <div class="max-w-3/4 mx-10 text-center">
                                <h3 class="text-primary-100 my-10 font-serif text-xl font-semibold">Derzeit sind keine Livestreams geplant.</h3>
                                <?php if(!is_user_logged_in()): ?>
                                <p class="text-primary-100">Registrieren Sie sich zu jetzt, wir informieren Sie sobald ein neuer Livestream gelpant ist.</p>
                                <div class="text-left">
									<?php get_template_part( 'register', 'form' ) ?>
                                </div>
                                <?php else: ?>
                                    <p class="text-primary-100 mb-10">Sobald ein neuer Livestream gelpant ist, senden wir Ihnen einen Newsletter.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


				<?php endif; ?>
            </div>

		<?php endforeach; ?>
    </div>
</div>