<?php
$user = wp_get_current_user();
$post = get_the_ID();

$cat = get_the_category();
$cat = array_shift( $cat );
?>

<div class="px-5 lg:px-5"
     x-data="readingLog(<?php echo $user->ID ?? false ?>, <?php echo $post ?>)"
     x-init="getmeasurements();"
     @scroll.window.debounce.1s="amountscrolled()"
     @resize.window="getmeasurements()"
     ref="watched"
>
	<?php get_template_part( 'article', 'liveheader' ) ?>

    <div class="container mx-auto mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
            <div class="content col-span-5 lg:col-span-3" id="article-content">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900 mb-5">
					<?php the_title() ?>
                </h1>
                <div class="hidden sm:block">
					<?php get_template_part( 'video', 'meta', [ 'mode' => 'light' ] ) ?>
                </div>
                <div>
                    <div class="max-w-1/3 h-48 w-48 float-left mb-5 mr-5 flex items-end justify-end p-3 text-white font-serif text-xl" style="background-color: <?php the_field( 'field_5c63ff4b7a5fb', $cat ); ?>">
						<?php echo $cat->name ?>
                    </div>
					<?php the_content(); ?>
                </div>
            </div>
            <div class="col-span-5 lg:col-span-2 border-15 border-white bg-primary-100 px-5">

				<?php
				$query = new WP_Query( [
					'post_type'      => 'immolive',
					'post_status'    => 'publish',
					'posts_per_page' => 2,
					'meta_query'     => [
						'relation' => 'AND',
						[
							'key'     => 'il_datum',
							'value'   => date( 'Ymd' ),
							'compare' => '>=',
						],
					],
					'order'          => 'ASC',
					'meta_key'       => 'il_datum',
					'orderby'        => 'meta_value_num',
				] );
				$count = $query->post_count;

				$runner = 1;

				if ( $query->have_posts() ):
					while ( $query->have_posts() ):
						$query->the_post();
						if ( (int) date( 'Gi' ) > 1601 && date( 'Ymd' ) == get_field( 'field_5ed527e9c2279', get_the_ID(), false ) && $runner == 1 ) {
							$runner ++;
							continue;
						}
						get_template_part( 'snippet', 'event' );
						?>
                        <div class="flex justify-end md:justify-between w-full py-5 text-xl text-white font-light leading-none">
                            <p class="w-full lg:w-1/3 hidden md:block"><?php _e( 'Das größte Online-Event der österreichischen Immobilienwirtschaft', 'ir21' ) ?></p>
                            <div class="font-normal text-right flex-shrink-0">
                                <p><?php
									echo \Carbon\Carbon::parse( get_field( 'field_5ed527e9c2279' ), 'Europe/Vienna' )->format( 'd.m.Y H:i' );
									?></p>
                                <p><?php _e( 'Zoom Webinar', 'ir21' ) ?></p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <h1 class="text-3xl text-white text-center font-extrabold max-w-full overflow-hidden leading-normal break-words"><?php the_title() ?></h1>
                            <div class="text-white mb-10 text-center"><?php the_content(); ?></div>
                        </div>
                        <div class="flex justify-center">
                            <div>
                                <a class="py-2 px-10 text-primary-100 bg-white shadow-xl hover:shadow-none text-lg lg:text-xl font-medium cursor-pointer" href="<?php the_field( 'field_601e5f56775db', 'option' ); ?>">
									<?php _e( 'Zur Anmeldung', 'ir21' ) ?>
                                </a>
                            </div>
                        </div>
						<?php
						$speakers = get_field( 'field_6007f8b5a20f0' );

						if ( $speakers ): ?>
							<?php if ( count( $speakers ) == 1 ): ?>
								<?php get_template_part( 'snippet', 'horizontalspeaker', [ 'speaker' => array_shift( $speakers ) ] ); ?>
							<?php endif; ?>

							<?php if ( count( $speakers ) == 2 ): ?>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                    <div>
										<?php get_template_part( 'snippet', 'horizontalspeaker', [ 'speaker' => array_shift( $speakers ) ] ); ?>
                                    </div>
                                    <div>
										<?php get_template_part( 'snippet', 'horizontalspeaker', [ 'speaker' => array_shift( $speakers ) ] ); ?>
                                    </div>
                                </div>
							<?php endif; ?>

							<?php if ( count( $speakers ) > 2 ): ?>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
									<?php
									while ( $speaker = array_shift( $speakers ) ) {
										get_template_part( 'snippet', 'verticalspeaker', [ 'speaker' => $speaker ] );
									}
									?>
                                </div>
							<?php endif; ?>
						<?php endif; ?>
						<?php break; endwhile; ?>
				<?php endif; ?>
            </div>
        </div>
    </div>
