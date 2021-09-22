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
	<?php
	$termin = get_field( 'field_5ed527e9c2279' );
	$carbon = new \Carbon\Carbon( $termin );

	if ( get_post_format() == 'video' ) {
		get_template_part( 'video', 'head' );
	} else {
		get_template_part( 'article', 'liveheader' );
	}
	?>


    <div class="container mx-auto mt-10 text-white">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
            <div class="content col-span-5 lg:col-span-3" id="article-content">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none mb-5 text-white">
					<?php echo get_the_title() ?>
                </h1>
                <div class="hidden sm:block">
					<?php get_template_part( 'video', 'meta', [ 'mode' => 'dark' ] ) ?>
                </div>
                <div>
					<?php the_excerpt(); ?>
					<?php the_content(); ?>
                </div>

				<?php
				$teilnehmer = get_field( 'field_614ad5e239622' );
				if ( ! empty( $teilnehmer ) ):
					?>
                    <div class="border-t boder-white mt-10 pt-10">
                        <h3 class="text-white text-3xl font-serif text-center mb-10">Die Expert*innen im Livestream</h3>
                        <div class="flex space-x-5 flex-wrap w-full text-center">

							<?php foreach ( $teilnehmer as $item ): ?>
                                <div class="w-48">
                                    <a href="<?php echo get_the_permalink( $item ) ?>" class="no-underline" style="text-decoration: none !important;">
										<?php
										echo get_the_post_thumbnail( $item, 'thumbnail', [
											'class'   => 'w-full h-auto rounded-full p-5 border-2 border-white',
											'onerror' => "this.style.display='none'",
										] );

										if ( ! has_post_thumbnail( $item ) ):?>
                                            <div class="w-48 h-48 rounded-full p-5 border-2 border-primary-100"></div>
										<?php endif; ?>
                                        <div class="flex flex-col text-center mt-10">
											<?php $name = get_field( 'field_613b8ca49b06b', $item ) . ' ' . get_field( 'field_613c53f33d6b8', $item ) ?>
											<?php $position = ! empty( get_field( 'field_613c54063d6b9', $item ) ) ? get_field( 'field_613c54063d6b9', $item ) . ' - ' . get_field( 'field_613b8caa9b06c', $item ) : '&nbsp;' ?>
                                            <h3 class="text-white text-3xl mb-0 font-serif font-semibold no-underline"><?php echo $name ?></h3>
                                            <p class="text-white text-sm italic mb-5 no-underline"><?php echo $position ?></p>
                                        </div>
                                    </a>
                                </div>
							<?php endforeach; ?>
                        </div>
                    </div>

				<?php endif; ?>


            </div>
        </div>
    </div>
