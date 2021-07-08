<?php get_header(); ?>

<?php
$term = get_queried_object();


?>


    <div class="container mx-auto mt-20">
        <h1 class="font-sans text-5xl uppercase font-semibold text-gray-800 text-center">
            <a href="/lesen" class="underline">
				<?php _e( 'lesen', 'ir21' ) ?>
            </a>
        </h1>
    </div>

<?php get_template_part( 'banner-templates/banner', 'mega' ) ?>


    <div class="container mx-auto mt-20 px-5 lg:px-0 relative" x-data="{show:0}" x-init="window.onload = () => show = 1; inter = setInterval( () => { if(show < 3) { show++; } else { clearInterval(inter); } }, 500 ) ">
        <div class="flex flex-col lg:flex-row items-end">
            <div class="w-full lg:w-1/2 relative" style="background-color: <?php the_field( 'field_5c63ff4b7a5fb', $term ); ?>"
                 x-show.transition.fade.in="show > 0"
                 x-cloak>
                <p class="text-white font-serif text-5xl py-24 px-5 text-center"><?php echo $term->name ?></p>

				<?php if ( get_field( 'field_60da235237ec4', $term ) ): ?>
                    <div class="flex flex-col lg:absolute lg:top-100 lg:-mt-20 right-0 z-50 lg:max-w-xs shadow-2xl" x-show.transition.fade="show >= 3" x-cloak>
                        <p class="text-white">powered by</p>
                        <div class="bg-white flex justify-center w-full">
                            <img src="<?php the_field( 'field_60da235237ec4', $term ) ?>" class="w-auto h-auto">
                        </div>
                    </div>
				<?php endif; ?>

            </div>
            <div class="w-full lg:w-1/2 bg-gray-900 text-white -ml-5 -mb-5 p-5 relative" x-show.transition.fade="show >= 2" x-cloak>
				<?php echo $term->description ?>
            </div>
        </div>

    </div>

    <div class="container mx-auto mt-20 px-5 md:px-5">
		<?php if ( have_posts() ): ?>
            <div class="grid grid-cols-2 gap-10">
				<?php while ( have_posts() ): ?>
					<?php the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full" style="padding-top: 56%">
							<?php the_post_thumbnail( 'article', [
								'class'   => 'w-full h-auto max-w-full',
								'onerror' => "this.style.display='none'",
								'style'   => "margin-top:-56%",
							] ); ?>
							<?php get_template_part( 'page-templates/snippet', 'heading' ) ?>
                        </a>
                    </div>
				<?php endwhile; ?>
            </div>
		<?php endif; ?>
    </div>


    <div class="container mx-auto mt-10 px-5 md:px-5" x-data="loadMore(<?php echo $term->term_id ?>)">
        <div class="grid grid-cols-2 gap-10">
            <template x-for="post in loaded">

                <div class="col-span-2 md:col-span-1 relative">
                    <a :href="post.permalink" class="relative block bg-primary-100 h-full" style="padding-top: 56%">
                        <img :src="post.img_url" class="w-full h-auto max-w-full" onerror="this.style.display='none';" style="margin-top: -56%;">
                        <h1 class="md:absolute bottom-0 left-0 text-white font-serif p-5 text-xl w-full md:text-2xl leading-tight  bg-gray-800 bg-opacity-50" x-text="post.title"></h1>
                    </a>
                </div>
            </template>

            <div class="flex items-center justify-center w-full my-32 col-span-2">
                <div class="inline">
                    <div class="py-2 px-3 bg-primary-100 text-white text-xl font-bold cursor-pointer" @click="load(<?php echo $term->term_id ?>)">
						<?php _e( 'weitere laden', 'ir21' ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php get_footer();