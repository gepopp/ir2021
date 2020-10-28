<?php
/**
 * The default single page template.
 *
 * @author Freeshifter LLC
 * @since  1.0.0
 */

namespace immobilien_redaktion_2020;

get_header();

$query = new \WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 2,
    'category__not_in'    => [17, 696],
    'tag__not_in'         => 989,
]);
?>

    <div class="container mx-auto mt-32">
        <div class="grid grid-cols-2 gap-10">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): ?>
                    <?php $query->the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary bg-gray-900 h-full">

                            <?php if (!has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article'))): ?>
                                    <div class="bg-primary-100 w-full h-full"></div>
                            <?php else: ?>
                                <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full']); ?>
                            <?php endif; ?>
                            <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25"></div>
                            <div class="absolute bottom-0 left-0 m-5">
                                <h1 class="font-serif text-white text-2xl"><?php the_title() ?></h1>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    </div>


    <!--	<div class="container mx-auto relative z-10 mb-16 lg:mb-32 flex flex-wrap items-start">-->
    <!--		<div class="w-full lg:w-4/6 lg:pr-10 mb-8">-->
    <!--			--><?php
//			if ( have_posts() ) {
//				while ( have_posts() ) {
//					the_post();
//					echo get_template_part( 'content-templates/content', 'article' );
//				}
//			}
?>
    <!--		</div>-->
    <!--		--><?php
//		if ( is_active_sidebar( 'sidebar' ) ) :
?>
    <!--			<aside class="w-full lg:w-2/6 bg-white border-gray-400 border-2 p-8">-->
    <!--				--><?php //dynamic_sidebar( 'sidebar' );
?>
    <!--			</aside>-->
    <!--		--><?php
//		endif;
?>
    <!--	</div>-->
    <?php
get_footer();
