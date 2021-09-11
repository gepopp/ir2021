<?php
$query = new \WP_Query( [
	'post_status'    => 'publish',
	'post_type' => 'aktuelle_presse',
	'posts_per_page' => 4,
] );

if ( $query->have_posts() ):
	?>
    <div class="container mx-auto border-2 border-aktuelles-100 p-5 mt-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

			<?php while ( $query->have_posts() ): ?>
				<?php $query->the_post(); ?>

                <div>
                    <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full image-holder">
						<?php the_post_thumbnail( 'article', [ 'class'   => 'w-full h-auto max-w-full',
						                                       'onerror' => "this.style.display='none'",
						] ); ?>
						<?php get_template_part('snippet', 'heading', ['size' => 'small']) ?>
                    </a>
                </div>


			<?php endwhile; ?>


        </div>
    </div>
<?php
endif;