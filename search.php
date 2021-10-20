<?php
/**
 * The template for displaying search results pages.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Freeshifter
 */

get_header(); ?>

    <div class="container mx-auto mt-20">
        <h1 class="font-sans text-5xl uppercase font-semibold text-gray-800 text-center">
            <a href="/lesen-2" class="underline">
				<?php _e( 'lesen', 'ir21' ) ?>
            </a>
        </h1>
    </div>


<?php get_template_part( 'banner', 'mega' ) ?>

<?php if ( isset( $_GET['post_type'] ) ): ?>
	<?php if ( $_GET['post_type'] == 'zur_person' ): ?>
		<?php get_template_part( 'snippet', 'header_zur_person' ) ?>

        <div class="container mx-auto mt-20 flex justify-between">
			<h3 class="text-xl text-primary-100 font-serif font-semibold">Suchergebnisse für: &bdquo;<?php echo ucfirst($_GET['s']) ?>&rdquo;</h3>
            <a href="<?php echo get_post_type_archive_link('zur_person') ?>" class="text-xl text-primary-100 font-serif font-semibold underline">Alle Zur Person</a>
        </div>

	<?php endif; ?>
<?php endif; ?>
    <main class="py-8 lg:py-24" style="min-height: 100vh;">
        <section class="container mx-auto relative z-10">
            <div class="container mx-auto mt-20 px-5 md:px-5">
				<?php if ( have_posts() ): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
						<?php while ( have_posts() ): ?>
							<?php the_post(); ?>
                            <div class="col-span-1 relative">
                                <a href="<?php the_permalink(); ?>" class="relative block h-full">
                                    <div class="w-48 mx-auto">
										<?php
										the_post_thumbnail( 'thumbnail', [
											'class'   => 'w-full h-auto rounded-full p-5 border-2 border-primary-100',
											'onerror' => "this.style.display='none'",
										] );

										if ( ! has_post_thumbnail() ):?>
                                            <div class="w-48 h-48 rounded-full p-5 border-2 border-primary-100"></div>
										<?php endif; ?>
                                    </div>
                                    <div class="flex flex-col text-center mt-10">
										<?php $name = ! empty( get_field( 'field_613b8ca49b06b' ) ) ? get_field( 'field_613c53f33d6b8' ) . '<br>' . get_field( 'field_613b8ca49b06b' ) : break_title( get_the_title() ) ?>
										<?php $position = ! empty( get_field( 'field_613c54063d6b9' ) ) ? get_field( 'field_613c54063d6b9' ) . ' - ' . get_field( 'field_613b8caa9b06c' ) : '&nbsp;' ?>
                                        <h3 class="text-primary-100 text-3xl mb-0 font-serif font-semibold"><?php echo $name ?></h3>
                                        <p class="text-primary-100 text-sm italic mb-5"><?php echo $position ?></p>
                                        <p class="three-lines flex-1 text-gray-900"><?php echo get_the_excerpt(); ?></p>
                                    </div>
                                </a>

                            </div>
						<?php endwhile; ?>
                    </div>
				<?php endif; ?>
            </div>

            <div class="mt-48 line-clamp-3">
				<?php \irclasses\Pagination::paginate(); ?>
            </div>
        </section>
    </main>

<?php
get_footer();
