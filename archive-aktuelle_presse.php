<?php get_header();



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
<?php get_template_part( 'banner', 'mega' ) ?>


    <div class="container mx-auto mt-20 px-5 lg:px-0 relative" x-data="{show:0}" x-init="window.onload = () => show = 1; inter = setInterval( () => { if(show < 3) { show++; } else { clearInterval(inter); } }, 500 ) ">
        <div class="flex flex-col lg:flex-row items-end">
            <div class="w-full lg:w-1/2 relative" style="background-color: <?php the_field('field_613b5990f3543', 'option'); ?>"
                 x-show.transition.fade.in="show > 0"
                 x-cloak>
                <p class="text-white font-serif text-5xl py-24 px-5 text-center">Aktuelles</p>

				<?php if ( get_field( 'field_613b59adf3545', 'option' ) ): ?>
                    <div class="flex flex-col lg:absolute lg:top-100 lg:-mt-20 right-0 z-50 lg:max-w-xs shadow-2xl" x-show.transition.fade="show >= 3" x-cloak>
                        <p class="text-white">powered by</p>
                        <div class="bg-white flex justify-center w-full">
                            <a href="<?php echo get_field('field_613b5a844db76', 'option') ?>">
                                <img src="<?php the_field( 'field_613b59adf3545', 'option') ?>" class="w-auto h-auto">
                            </a>
                        </div>
                    </div>
				<?php endif; ?>

            </div>
            <div class="w-full lg:w-1/2 bg-gray-900 text-white -ml-5 -mb-5 p-5 relative" x-show.transition.fade="show >= 2" x-cloak>
				<?php the_field('field_613b59a0f3544', 'option'); ?>
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
							<?php get_template_part( 'snippet', 'heading' ) ?>
                        </a>
                    </div>
				<?php endwhile; ?>
            </div>
		<?php endif; ?>
    </div>

<div class="mt-48">
	<?php \irclasses\Pagination::paginate(); ?>
</div>



<?php get_footer();