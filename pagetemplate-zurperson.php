<?php
/**
 * Template Name: Zur Person einreichen
 *
 * */

global $FormSession;
get_header();
?>


    <div class="container mx-auto relative px-5 md:px-0 flex justify-center pt-64">
        <div class="h-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <div>
                    <h1 class="text-2xl font-serif mb-5"><?php the_title(); ?></h1>
                    <div class="content px-5 mb-10"><?php the_content(); ?></div>
                </div>
				<?php if ( array_key_exists( 'success', $FormSession->content ) ): ?>
					<?php $FormSession->flashSuccess( 'success' ); ?>
				<?php else: ?>
					<?php get_template_part( 'profile', 'persondata' ) ?>
				<?php endif; ?>
            </div>
        </div>
    </div>

<?php get_footer();

