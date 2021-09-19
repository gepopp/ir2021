<?php
/**
 * @var $categories
 */
extract( $args );
?>


<div class="container mx-auto p-5">

    <div class="my-5 w-full text-center">
        <h1 class="inline font-serif text-3xl font-semibold text-center"
            style="background: linear-gradient(0deg, #5C97D0 0%, #5C97D0 50%, transparent 50%, transparent 100%);">
            Kommende Livestreams
        </h1>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 border-y border-primary-100">
		<?php
		$runner = 1;
		foreach ( $categories as $category ): ?>
            <div class="flex flex-col">

                <div class="my-5 w-full text-center">
                    <h3 class="inline font-serif text-xl font-semibold text-center"
                        style="background: linear-gradient(0deg, <?php the_field( 'field_5c63ff4b7a5fb', $category ) ?> 0%, <?php the_field( 'field_5c63ff4b7a5fb', $category ) ?> 50%, transparent 50%, transparent 100%);">
						<?php echo $category->name ?>
                    </h3>
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
				if ( $query->have_posts() ): ?>
                    <div class="<?php echo count( $categories ) != $runner ? 'lg:border-r border-primary-100' : '' ?> lg:pr-5 flex-grow">
						<?php while ( $query->have_posts() ):
							$query->the_post();
							$starts = new \Carbon\Carbon( get_field( 'field_5ed527e9c2279' ) );
							$starts->setTimezone( 'UTC' );
							\Carbon\Carbon::setLocale( 'de' );

							$terms = wp_get_post_terms( get_the_ID(), 'immolive_category' );
							$term  = array_shift( $terms );

							$ics = get_field( 'field_6143982f5f5f2' );

							?>
                            <div class="card mb-20 last:mb-0">
                                <div class="relative">
                                    <a href="<?php the_permalink(); ?>" class="block bg-primary-100 h-full image-holder">
										<?php the_post_thumbnail( 'article', [
											'class' => 'w-full h-auto max-w-full',
										] ); ?>
										<?php get_template_part( 'snippet', 'heading', [ 'size' => 'small' ] ) ?>
                                    </a>
                                </div>
                                <div class="w-full p-3 bg-white border border-primary-100">
                                    <div class="flex justify-between border-b font-semibold text-primary-100 border-primary-100 mb-3">
                                        <span><?php echo 'Live ' . $starts->diffForHumans() ?></span>
                                        <span><?php echo $term->name; ?></span>
                                    </div>
                                    <div class="text-gray-900 py-5">
                                        <p class="text-gray-900 line-clamp-3">
											<?php echo get_the_excerpt(); ?>
                                        </p>
                                    </div>
                                    <div class="pt-5 border-t border-primary-100">
                                        <h3 class="font-semibold text-primary-100">Termin speichern</h3>

	                                    <?php
                                        global $FormSession;
                                        $FormSession->flashErrorBag('newsletter');
                                        $FormSession->flashSuccess('newsletter');
                                        ?>


                                        <form action="<?php echo admin_url( 'admin-post.php' ) ?>" method="post">
											<?php wp_nonce_field( 'newsletter', 'newsletter' ) ?>
                                            <input type="hidden" name="action" value="get_immolive_ics">
                                            <input type="hidden" name="post_id" value="<?php echo get_the_ID() ?>">
                                            <div class="flex flex-col">
                                                <label>E-Mail Adresse<span class="text-red-500">*</span></label>
                                                <input
                                                        type="email"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        name="email"
                                                        required
                                                >

                                            </div>
                                            <div class="flex flex-col mb-3">
                                                <div>
                                                    <input type="checkbox" name="agb" value="1" required id="agb">
                                                    <label for="agb">Ich bin mit den
                                                        <a href="<?php echo home_url('agb') ?>" class="text-primary-100 underline">AGB</a> der Immobilien Redaktion einverstanden<span class="text-red-500">*</span></label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="nlcheck" value="1" id="nlcheck">
                                                    <label for="nlcheck">Newsletter abonieren</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="bg-primary-100 text-white flex-none p-3 w-full text-center">ical senden</button>
                                            <span class="text-red-500 text-xs">Mit * gekenntzeichnte Felder sind Pflichtfelder</span>
                                        </form>
                                    </div>
                                </div>

                            </div>
						<?php endwhile; ?>
                    </div>
				<?php else: ?>
                    <div class="h-full <?php if ( count( $categories ) != $runner ): ?>lg:border-r border-primary-100  <?php endif; ?> lg:pr-5">
                        <div class="w-full bg-white text-primary h-full">
                            <div class="w-full h-full top-0 left-0 flex justify-center items-center">
                                <div class="max-w-3/4 mx-10 text-center">
                                    <h3 class="text-primary-100 my-10 font-serif text-xl font-semibold">Derzeit sind keine Livestreams geplant.</h3>
									<?php if ( ! is_user_logged_in() ): ?>
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
                    </div>
				<?php endif; ?>
            </div>
			<?php $runner ++;
		endforeach; ?>
    </div>
</div>