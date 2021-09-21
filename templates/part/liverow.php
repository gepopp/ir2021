<?php

$when = 'future';
extract( $args );

$compare = $when == 'future' ? '>=' : '<=';


$date_now = date( 'Y-m-d H:i:s' );
$query    = new WP_Query( [
	'post_type'      => 'immolive',
	'posts_per_page' => 3,
	'meta_query'     => [
		[
			'key'     => 'termin',
			'compare' => $compare,
			'value'   => $date_now,
			'type'    => 'DATETIME',
		],
	],
	'meta_key'       => 'termin',
	'orderby'        => 'meta_value',
	'order'          => $when != 'future' ? 'DESC' : 'ASC',
] );

if ( $query->have_posts() ):
	?>
    <div class="container mx-auto mt-20">
		<?php if ( $when == 'future' ): ?>
            <div class="text-center mb-10">
                <h1 class="inline text-cent font-serif text-3xl font-semibold"
                    style="background: linear-gradient(0deg, #5C97D0 0%, #5C97D0 50%, transparent 50%, transparent 100%);">Kommende Livestreams</h1>
            </div>
		<?php endif; ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
			<?php while ( $query->have_posts() ): ?>
				<?php $query->the_post(); ?>

                <div class="relative">
					<?php if ( $when == 'future' ): ?>

                        <div class="absolute top-0 left-0 w-full p-3 text-white flex justify-between text-primary-100 font-semibold bg-white">
							<?php
							$starts = new \Carbon\Carbon( get_field( 'field_5ed527e9c2279' ) );
							\Carbon\Carbon::setLocale( 'de' ); ?>
                            <span>
                        <?php echo 'Live ' . $starts->diffForHumans() ?>
                        </span>
                            <span>
                            <?php
                            $terms = wp_get_post_terms( get_the_ID(), 'immolive_category' );
                            $term  = array_shift( $terms );
                            echo $term->name;
                            ?>
                        </span>
                        </div>
					<?php endif; ?>
                    <a href="<?php the_permalink(); ?>" class="block bg-primary-100 h-full image-holder">

						<?php

						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'article', [
								'class' => 'w-full h-auto max-w-full',
							] );
						} else {
							$attachment_id = get_field( 'field_614a3cf01f64c', 'immolive_category_' . $term->term_id );
							echo wp_get_attachment_image( $attachment_id, 'featured', false, [ 'class' => 'w-full h-auto' ] );
						}
						?>


						<?php get_template_part( 'snippet', 'heading', [ 'size' => 'small' ] ) ?>
                    </a>
                </div>
			<?php endwhile; ?>
        </div>
    </div>
<?php
endif;