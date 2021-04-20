<?php
$user = wp_get_current_user();
$post = get_the_ID();

$cat = get_the_category();
$cat = array_shift($cat);
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
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
            <div class="content hidden lg:block col-span-3" id="article-content">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900">
                    <?php the_title() ?>
                </h1>
                <?php get_template_part('page-templates/video', 'meta', ['mode' => 'light']) ?>
                <div>
                    <div class="h-48 w-48 float-left mb-5 mr-5 flex items-end justify-end p-3 text-white font-serif text-xl" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                        <?php echo $cat->name ?>
                    </div>
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="lg:col-span-2">
                <div class="text-aktuelles-100">
                </div>
            </div>
            <div class="content block lg:hidden" id="article-content">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900">
                    <?php the_title() ?>
                </h1>
                <?php get_template_part('page-templates/video', 'meta', ['mode' => 'light']) ?>
                <div>
                    <div class="h-48 w-48 float-left mb-5 mr-5 flex items-end justify-end p-3 text-white font-serif text-xl" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                        <?php echo $cat->name ?>
                    </div>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
