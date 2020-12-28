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
    <?php get_template_part('page-templates/article', 'header') ?>

    <div class="container mx-auto">
        <div class="grid grid-cols-5 gap-4">
            <div>
                <?php get_template_part('page-templates/article', 'left') ?>
            </div>
            <div class="content col-span-5 lg:col-span-3">
                <?php echo preg_replace('#\[[^\]]+\]#', '', get_the_content()); ?>
            </div>
            <div>
                <?php get_template_part('page-templates/article', 'right') ?>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('page-templates/article', 'readmore') ?>

<div class="lg:hidden sticky bottom-0 -mx-5">
    <?php get_template_part('page-templates/article', 'iconbar') ?>
</div>