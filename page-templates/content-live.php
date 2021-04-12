<?php
$user = wp_get_current_user();
$post = get_the_ID();
?>

<div class="px-5 lg:px-5"
     x-data="readingLog(<?php echo $user->ID ?? false ?>, <?php echo $post ?>)"
     x-init="getmeasurements();"
     @scroll.window.debounce.1s="amountscrolled()"
     @resize.window="getmeasurements()"
     ref="watched"
>
    <?php get_template_part('page-templates/article', 'liveheader') ?>

    <div class="container mx-auto mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="content hidden lg:block" id="article-content">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900">
                    <?php the_title() ?>
                </h1>
                <?php get_template_part('page-templates/video', 'meta', ['mode' => 'light']) ?>
                <?php the_content(); ?>
            </div>
            <div>
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
            <div class="content block lg:hidden" id="article-content">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900">
                    <?php the_title() ?>
                </h1>
                <?php get_template_part('page-templates/video', 'meta', ['mode' => 'light']) ?>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
