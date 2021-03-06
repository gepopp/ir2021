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
    'category__not_in'    => [696, 996, 159],
]);
?>


    <div class="container mx-auto mt-20 relative px-5 lg:px-0">
        <div class="grid grid-cols-2 gap-10">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): ?>
                    <?php $query->the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <div class="col-span-2 md:col-span-1 relative">
                            <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full image-holder">
                                <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full', 'onerror' => "this.style.display='none'"]); ?>
                                <?php get_template_part('page-templates/snippet', 'heading') ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    </div>


    <?php get_template_part('banner-templates/banner', 'mega') ?>

    <?php //get_template_part('page-templates/page', 'immoliveAnnouncement') ?>

    <?php get_template_part('banner-templates/banner', 'fourbanner') ?>

    <?php get_template_part('page-templates/part', 'aktuelles') ?>

    <?php get_template_part('banner-templates/banner', 'thirds2') ?>

    <?php

        $query = new \WP_Query([
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'posts_per_page'      => 2,
            'offset'              => 2,
            'category__not_in'    => [696, 996, 159],
        ]);
?>


    <div class="container mx-auto mt-20 relative px-5 lg:px-0">

        <div class="grid grid-cols-2 gap-10">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): ?>
                    <?php $query->the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <div class="col-span-2 md:col-span-1 relative">
                            <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full image-holder">
                                <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full', 'onerror' => "this.style.display='none'"]); ?>
                                <?php get_template_part('page-templates/snippet', 'heading') ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php wp_reset_postdata(); ?>


    </div>


    <?php
get_template_part('page-templates/modal', 'immolive');


get_footer();
