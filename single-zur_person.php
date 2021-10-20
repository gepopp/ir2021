<?php
get_header();

global $FormSession;



$user = wp_get_current_user();
$post = get_the_ID();

$cat = wp_get_post_categories( get_the_ID() );
$cat = array_shift( $cat );
$cat = get_category( $cat );


?>

    <div class="px-5 lg:px-5"
         x-data="readingLog(<?php echo $user->ID ?? false ?>, <?php echo $post ?>)"
         x-init="getmeasurements();"
         @scroll.window.debounce.1s="amountscrolled()"
         @resize.window="getmeasurements()"
         ref="watched"
    >
		<?php get_template_part( 'article', 'header' ) ?>

        <div class="container mx-auto">
            <div class="grid grid-cols-5 gap-4">
                <div>
					<?php get_template_part( 'article', 'left' ) ?>
                </div>
                <div class="content col-span-5 lg:col-span-3" id="article-content">

                    <div class="mb-5">
                        <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900">
							<?php the_field( 'field_613c53f33d6b8' ); ?>&nbsp;<?php the_field( 'field_613b8ca49b06b' ); ?>
                        </h1>
                        <h3><?php the_field( 'field_613c54063d6b9' ); ?> bei
							<?php $link = get_field( 'field_617040c6f50bc' ); ?>

							<?php if ( ! empty( $link ) ): ?>
                            <a href="<?php echo $link ?>">
								<?php endif; ?>
								<?php the_field( 'field_613b8caa9b06c' ); ?>
								<?php if ( ! empty( $link ) ): ?>
                            </a>
						<?php endif; ?>
                        </h3>
                    </div>


                    <div class="block lg:hidden grid xs:grid-cols-1 md:grid-cols-2 mb-10">
                        <div class="flex flex-col justify-between" style="background-color: <?php the_field( 'field_613b878f77b81', 'option' ); ?>">
                            <div>
                                <p class="px-5 pt-5 font-serif text-2xl text-white">Menschen</p>
                                <p class="px-5 pb-5 text-white text-sm -mt-3">powered by</p>
                            </div>
                            <div class="p-5 text-white hidden md:block">
                                <a href="<?php echo get_field( 'field_613b5a844db76', 'option' ) ?>">
                                    <span class="text-white underline"><?php echo wp_count_posts( 'zur_person' )->publish ?> Artikel</span>
                                </a>
                            </div>
                        </div>
                        <div class="bg-white">
                            <a href="<?php the_field( 'field_613b5a844db76', 'option' ) ?>" class="text-center">
                                <img src="<?php the_field( 'field_613b59adf3545', 'option' ) ?>" class="w-full h-auto p-5">
                            </a>
                        </div>
                    </div>


					<?php if ( get_field( 'field_60da235237ec4', $cat ) ): ?>
                        <div class="block lg:hidden grid xs:grid-cols-1 md:grid-cols-2 mb-10">
                            <div class="flex flex-col justify-between" style="background-color: <?php the_field( 'field_5c63ff4b7a5fb', $cat ); ?>">
                                <div>
                                    <p class="px-5 pt-5 font-serif text-2xl text-white"><?php echo $cat->name ?? '' ?></p>
                                    <p class="px-5 pb-5 text-white text-sm -mt-3">powered by</p>
                                </div>
                                <div class="p-5 text-white hidden md:block">
                                    <a href="<?php echo get_category_link( $cat ) ?>">
                                        <span class="text-white underline"><?php echo $cat->count ?? '' ?><?php _e( 'Artikel', 'ir21' ) ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="bg-white">
                                <a href="<?php echo get_field( 'field_5f9aeff4efa16', $cat ) ?>" class="text-center">
                                    <img src="<?php the_field( 'field_60da235237ec4', $cat ); ?>" class="w-full h-auto p-5">
                                </a>
                            </div>
                        </div>
					<?php endif; ?>
                    <h3 class="font-semibold mb-3 underline">Über <?php the_field( 'field_613c53f33d6b8' ); ?>&nbsp;<?php the_field( 'field_613b8ca49b06b' ); ?></h3>
					<?php the_content(); ?>

                    <h3 class="font-semibold mb-3 underline">Karriere von <?php the_field( 'field_613c53f33d6b8' ); ?>&nbsp;<?php the_field( 'field_613b8ca49b06b' ); ?></h3>

                    <div class="p-3 bg-primary-100 bg-opacity-25 w-full">

						<?php $stationen = get_field( 'field_61704289c8bb8' ); ?>
						<?php if ( empty( $stationen ) ): ?>
                            <div class="h-48 flex flex-col items-center justify-center">
                                <p>Noch keine Karrierestationen vorhanden.</p>
                                <p class="text-sm">Nutzen Sie den Button weiter unten wenn Sie uns Vorschläge zum Eintrag von <?php the_field( 'field_613c53f33d6b8' ); ?>&nbsp;<?php the_field( 'field_613b8ca49b06b' ); ?> senden wollen.</p>
                            </div>
						<?php else: ?>

                            <table class="w-full">
                                <thead>
                                <tr class="border border-primary-100">
                                    <th class="text-left p-3">Von:</th>
                                    <th class="text-left p-3">Bis:</th>
                                    <th class="text-left p-3">Karriereschritt:</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach ( $stationen as $station ): ?>
                                    <tr class="border border-primary-100">
                                        <td class="p-3"><?php echo $station['karrierestation_von:'] ?></td>
                                        <td class="p-3"><?php echo $station['karrierestation_bis:'] ?></td>
                                        <td class="p-3"><?php echo $station['karrierestation_position'] ?><br>
                                            <span class="text-xs"><?php echo $station['karrierestation_unternehmen'] ?></span>
                                        </td>
                                    </tr>
								<?php endforeach; ?>
                                </tbody>
                            </table>

						<?php endif; ?>
                    </div>
                    <script>
                        var show = <?php echo empty($FormSession->content['errorBag']) ? 'false' : 'true' ?>;
                    </script>
                    <div class="my-10">
                        <div x-data="{ showForm : show }">
                            <div class="bg-primary-100 bg-opacity-5 p-10 flex flex-col justify-center items-center min-h-64 text-primary-100">
                                <h3 class="text-xl font-serif text-primary"><?php the_field( 'field_617044825dbf3', 'option' ) ?></h3>
                                <div class="text-primary mt-5 text-center"><?php the_field( 'field_6170448e5dbf4', 'option' ); ?></div>
								<?php if ( array_key_exists( 'success', $FormSession->content ) ): ?>
									<?php $FormSession->flashSuccess( 'success' ); ?>
								<?php else: ?>
                                    <button class="bg-white text-primary-100 text-center p-3 px-10"
                                            @click="showForm = !showForm"
                                            x-show.transition="!showForm">Vorschlag einreichen
                                    </button>
								<?php endif; ?>
                            </div>
                            <div class="bg-primary-100 bg-opacity-5 flex flex-col justify-center items-center min-h-64" x-show.transition="showForm" x-cloak>
                                <div class="p-5 w-full">
									<?php get_template_part( 'profile', 'persondata' ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
					<?php get_template_part( 'article', 'right' ) ?>
                </div>
            </div>
        </div>
    </div>

<?php get_template_part( 'article', 'readmore' ) ?>

    <div class="lg:hidden sticky bottom-0"
         x-data="{ scroll: 0, max : 0 }"
         x-init="
        contentContainer = document.getElementById('article-content');
        max = contentContainer.offsetTop + contentContainer.offsetHeight - 200;
        maxScrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        window.addEventListener('resize', () => {
            maxScrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        });
        window.addEventListener('scroll', function (event) {

            contentContainer = document.getElementById('article-content');
            max = contentContainer.offsetTop + contentContainer.offsetHeight - 200;
            scroll = this.scrollY;

        });

     ">
        <div x-show.transition.fade.500ms="scroll > 200 && scroll < max">
			<?php get_template_part( 'article', 'iconbar' ) ?>
        </div>
    </div>

<?php get_footer();