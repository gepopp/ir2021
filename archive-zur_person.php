<?php
get_header();

function break_title($title){
	$exp = explode(' ', $title);
    $broken = array_shift($exp);
    $broken .= '<br>';
    $broken .= implode(' ', $exp);

    return $broken;
}


?>
<!--
    UPDATE wp_posts p
    LEFT JOIN wp_term_relationships rel ON rel.object_id = p.ID
    LEFT JOIN wp_term_taxonomy tax ON tax.term_taxonomy_id = rel.term_taxonomy_id
    LEFT JOIN wp_terms t ON t.term_id = tax.term_id
    SET p.post_type = "aktuelles"
    WHERE p.post_type = "post"
    AND t.name = 'Aktuelles'
    AND tax.taxonomy = 'category'
-->
    <div class="container mx-auto mt-20">
        <h1 class="font-sans text-5xl uppercase font-semibold text-gray-800 text-center">
            <a href="/lesen-2" class="underline">
				<?php _e( 'lesen', 'ir21' ) ?>
            </a>
        </h1>
    </div>

<?php get_template_part( 'banner', 'mega' ) ?>


    <div class="container mx-auto mt-20 px-5 lg:px-0 relative" x-data="{show:0}" x-init="window.onload = () => show = 1; inter = setInterval( () => { if(show < 3) { show++; } else { clearInterval(inter); } }, 500 ) ">
        <div class="flex flex-col lg:flex-row items-end">
            <div class="w-full lg:w-1/2 relative" style="background-color: <?php the_field('field_613b878f77b81', 'option'); ?>"
                 x-show.transition.fade.in="show > 0"
                 x-cloak>
                <p class="text-white font-serif text-5xl py-24 px-5 text-center">Menschen</p>

				<?php if ( get_field( 'field_613b878f77bd6', 'option' ) ): ?>
                    <div class="flex flex-col lg:absolute lg:top-100 lg:-mt-20 right-0 z-50 lg:max-w-xs shadow-2xl" x-show.transition.fade="show >= 3" x-cloak>
                        <p class="text-white">powered by</p>
                        <div class="bg-white flex justify-center w-full">
                            <a href="<?php echo get_field('field_613b878f77bfd', 'option') ?>">
                                <img src="<?php the_field( 'field_613b878f77bd6', 'option') ?>" class="w-auto h-auto">
                            </a>
                        </div>
                    </div>
				<?php endif; ?>

            </div>
            <div class="w-full lg:w-1/2 bg-gray-900 text-white -ml-5 -mb-5 p-5 relative" x-show.transition.fade="show >= 2" x-cloak>
				<?php the_field('field_613b878f77bae', 'option'); ?>
            </div>
        </div>

    </div>

    <div class="container mx-auto mt-20 px-5 md:px-5">
		<?php if ( have_posts() ): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
				<?php while ( have_posts() ): ?>
					<?php the_post(); ?>
                    <div class="col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block h-full" style="padding-top: 56%">
                            <div class="w-48 mx-auto">
							<?php the_post_thumbnail( 'thumbnail', [
								'class'   => 'w-full h-auto rounded-full p-5 border-2 border-primary-100',
								'onerror' => "this.style.display='none'",
							] ); ?>
                            </div>
                            <div class="flex flex-col text-center mt-10">
                                <?php $name = !empty(get_field( 'field_613b8ca49b06b' )) ? get_field( 'field_613c53f33d6b8' ) . '<br>' . get_field( 'field_613b8ca49b06b' ) : break_title(get_the_title()) ?>
                                <?php $position = !empty(get_field( 'field_613c54063d6b9' )) ? get_field( 'field_613c54063d6b9' ) . ' - ' . get_field( 'field_613b8caa9b06c' ) : '&nbsp;'  ?>
                                <h3 class="text-primary-100 text-3xl mb-0 font-serif font-semibold"><?php echo $name ?></h3>
                                <p class="text-primary-100 text-sm italic mb-5"><?php echo $position ?></p>
                                <p class="line-clamp-3 flex-1 text-gray-900"><?php echo get_the_excerpt(); ?></p>
                            </div>
                        </a>

                    </div>
				<?php endwhile; ?>
            </div>
		<?php endif; ?>
    </div>

<div class="mt-48">
	<?php \immobilien_redaktion_2020\pagination(); ?>
</div>



<?php



get_footer();