<?php

/**
 * Template Name: Sehen
 *
 */

use function immobilien_redaktion_2020\load_vimeo_image;

get_header();
?>


    <div class="bg-gray-900">
        <div class="container mx-auto mt-20 relative">
            <h1 class="font-sans text-5xl uppercase font-semibold text-white text-center"><?php _e( 'sehen', 'ir21' ) ?></h1>
        </div>
    </div>


<?php get_template_part( 'banner', 'mega' ) ?>


<?php
$headvideo = get_posts( [
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'posts_per_page'      => 1,
	'category__in'        => [ 17 ],
] );
?>
    <div class="container mx-auto mt-20 px-5 lg:px-0 relative">
        <div class="relative">
			<?php if ( get_field( 'field_5f96fa1673bac', $headvideo[0]->ID ) ): ?>
                <div class="video-container" style="
                            position: relative;
                            width: 100%;
                            padding-bottom: 56.25%;
                            ">
                    <iframe src="https://www.youtube.com/embed/<?php echo get_field( 'field_5f96fa1673bac', $headvideo[0]->ID ) ?>?autoplay=1&mute=1"
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen style="
position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
"></iframe>
                </div>
			<?php elseif ( get_field( 'field_5fe2884da38a5', $headvideo[0]->ID ) ): ?>
				<?php echo get_the_post_thumbnail( $headvideo[0]->ID, 'full', [ 'class' => 'w-full h-auto' ] ) ?>
			<?php endif; ?>


            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center lg:hidden">
                <a href="<?php echo get_the_permalink( $headvideo[0]->ID ) ?>">
                    <div class="rounded-full bg-white w-24 h-24 m-5 flex items-center justify-center">
                        <div class="w-12 h-12 animate-ping bg-white rounded-full">
                            <svg class="w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 p-10 hidden lg:block bg-gray-900 bg-opacity-50">
            <a href="<?php echo get_the_permalink( $headvideo[0]->ID ) ?>">
                <h1 class="text-3xl text-white"><?php echo get_the_title( $headvideo[0]->ID ) ?></h1>
                <p class="text-2xl text-white flex items-center"><?php echo get_field( 'field_5a3ce915590ae', $headvideo[0]->ID ) ?> | <?php echo get_the_time( 'd.m.Y', $headvideo[0]->ID ) ?></p>
            </a>
        </div>

        <div class="absolute top-0 left-0 hidden lg:block w-full h-full" style="box-shadow: inset 0 0 5em 1em #000000;">
            <a href="<?php echo get_the_permalink( $headvideo[0]->ID ) ?>" class="w-full h-full flex justify-center items-center">
                <div class="inline flex justify-between">
                    <div class="bg-white text-gray-900 text-2xl px-3 py-2 rounded shadow-lg flex items-center pr-10">
                        <div class="rounded-full bg-white w-24 h-24 m-5 flex items-center justify-center">
                            <div class="w-12 h-12 animate-ping bg-white rounded-full">
                                <svg class="w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <span class="underline"><?php _e( 'Jetzt ansehen', 'ir21' ) ?></span>
                    </div>
                </div>
            </a>
        </div>

    </div>
    <div class="container mx-auto px-5 lg:px-0 relative">
        <h1 class="text-xl text-white lg:hidden"><?php echo get_the_title( $headvideo[0]->ID ) ?></h1>
    </div>

<?php
$query = new WP_Query( [
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'posts_per_page'      => 6,
	'category__in'        => [ 17 ],
	'meta_key'            => 'analytics_views',
	'orderby'             => 'meta_value_num',
	'order'               => 'DESC',
] );
?>

    <div class="container mx-auto mt-20 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold mb-10 text-white"><?php _e( 'Meist gesehen', 'ir21' ) ?></a>
        <div class="grid grid-cols-6 gap-4">
			<?php
			if ( $query->have_posts() ):
				$runner = 1;
				while ( $query->have_posts() ):
					$query->the_post();
					?>
                    <div class="col-span-3 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <div class="bg-primary-100" style="padding-top: 56%">
									<?php the_post_thumbnail( 'featured_small', [ 'class' => 'absolute top-0 left-0' ] ); ?>
                                </div>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <div class="w-4 h-4 bg-white rounded-full">
                                        <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5 text-white">
                            <a href="<?php the_permalink(); ?>">
								<?php the_title() ?>
                            </a>
                        </p>
                    </div>
					<?php
					$runner ++;
				endwhile;
			endif;
			?>
        </div>
    </div>
<?php wp_reset_postdata(); ?>

<?php
$query = new WP_Query( [
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'posts_per_page'      => 6,
	'category__in'        => [ 17 ],
] );
?>


    <div class="container mx-auto mt-20 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold mb-10 text-white"><?php _e( 'Neueste Videos', 'ir21' ) ?></a>
        <div class="grid grid-cols-6 gap-4">
			<?php
			if ( $query->have_posts() ):
				$runner = 1;
				while ( $query->have_posts() ):
					$query->the_post();
					?>
                    <div class="col-span-3 lg:col-span-1">

                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <div class="bg-primary-100" style="padding-top: 56%">
									<?php the_post_thumbnail( 'featured_small', [ 'class' => 'absolute top-0 left-0' ] ); ?>
                                </div>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="w-4 h-4 bg-white rounded-full">
                                            <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5 text-white">
                            <a href="<?php the_permalink(); ?>">
								<?php the_title() ?>
                            </a>
                        </p>

                    </div>
					<?php
					$runner ++;
				endwhile;
			endif;
			?>
        </div>
    </div>

<?php wp_reset_postdata(); ?>

<?php
$cats = get_categories( [ 'child_of' => 17 ] );

foreach ( $cats as $cat ): ?>

	<?php
	$query = new WP_Query( [
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'posts_per_page'      => 6,
		'category__in'        => [ $cat->term_id ],
	] );
	?>
	<?php

	$pages = (int) $query->max_num_pages;


	$posts = [];

	if ( $query->have_posts() ):
		$runner = 1;
		while ( $query->have_posts() ):
			$query->the_post();
			$url = get_the_post_thumbnail_url( get_the_ID(), 'featured_small' );

			$posts[] = [
				'ID'        => get_the_ID(),
				'permalink' => get_the_permalink(),
				'title'     => get_the_title(),
				'img'       => $url,
			];
			$runner ++;
		endwhile;
	endif;
	?>
	<?php wp_reset_postdata(); ?>


    <div class="container mx-auto mt-20 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold text-white"><?php echo $cat->name ?></a>


        <div x-data="slider(<?php echo str_replace( '"', "'", json_encode( $posts ) ) ?>, <?php echo $cat->term_id ?>, <?php echo $query->max_num_pages ?> )"
             x-init="
                load();
                $watch('active', (value) => {
                    if(value + 1 == rows.length) load();
                })
                "
             class="relative">

            <div class="snap overflow-auto relative flex-no-wrap flex transition-all"
                 x-ref="slider"
                 x-on:scroll.debounce="active = Math.round($event.target.scrollLeft / ($event.target.scrollWidth / rows.length))">
                <template x-for="row in rows">
                    <div class="w-full flex-shrink-0 text-white flex items-center justify-center">
                        <div class="grid grid-cols-6 gap-4">
                            <template x-for="post in row">
                                <div class="col-span-3 lg:col-span-1">
                                    <div class="relative">

                                        <div class="w-full bg-primary-100" style="padding-top: 56%">
                                            <img :src="post.img" class="w-full h-auto" style="margin-top: -56%"/>
                                        </div>

                                        <a :href="post.permalink" class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                            <div class="w-4 h-4 bg-white rounded-full">
                                                <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </a>

                                    </div>
                                    <p class="mt-5 font-semibold text-xs text-white h-24">
                                        <a :href="post.permalink" x-text="post.title"></a>
                                    </p>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
            <div class="flex items-center justify-between flex-1 absolute top-0 w-full h-full" style="pointer-events: none">
                <button class="outline-none focus:outline-none rounded-full mx-4 text-white w-8"
                        :class="{'cursor-not-allowed' : loading || active <= 0  }"
                        style="pointer-events: auto"
                        x-on:click="prev($refs);">
                    <div class="relative w-10 h-10 flex items-center justify-center">
                        <div class="absolute animate-ping w-6 h-6 rounded-full bg-gray-600 bg-opacity-50 center"></div>
                        <div class="w-10 h-10 p-2 rounded-full bg-gray-900 flex items-center justify-center z-20">
                            <svg x-show="active > 0 && !loading" class="z-50 w-6 h-6 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <svg x-show="active <= 0 && !loading" class="z-50 w-6 h-6 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <svg x-show="loading" class="z-50 w-6 h-6 text-warning inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>

                </button>

				<?php if ( get_field( 'field_5f9aefd116e2e', $cat ) ): ?>
                    <div class="bg-gray-900 bg-opacity-75 rounded-full w-24 h-24 p-5 flex flex-col items-center justify-center shadow-lg">
                        <a href="<?php echo get_field( 'field_5f9aeff4efa16', $cat ) ?>" class="text-center" style="pointer-events: auto">
                            <p class="text-white" style="font-size: .5rem"><?php _e( 'powered by', 'ir21' ) ?></p>
                            <img src="<?php echo get_field( 'field_5f9aefd116e2e', $cat ) ?>" class="w-20 h-auto">
                        </a>
                    </div>
				<?php endif; ?>

                <button class="outline-none focus:outline-none rounded-full mx-4 text-white w-8"
                        :class="{'cursor-not-allowed' : loading || active >= pages }"
                        style="pointer-events: auto"
                        x-on:click="next($refs);">
                    <div class="relative w-10 h-10 flex items-center justify-center">
                        <div class="absolute animate-ping w-6 h-6 rounded-full bg-gray-600 bg-opacity-50 center"></div>
                        <div class="w-10 h-10 p-2 rounded-full bg-gray-900 flex items-center justify-center z-20">
                            <svg x-show="active < pages && !loading" class="w-8 h-8 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <svg x-show="active >= pages && !loading" class="w-8 h-8 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <svg x-show="loading" class="w-8 h-8 text-warning inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
<?php endforeach;
get_footer();