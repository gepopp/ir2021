<?php
$user = wp_get_current_user();
$post_id = get_the_ID();
?>

<div class="text-white">
    <?php get_template_part('page-templates/article', 'author') ?>
</div>

<?php get_template_part('page-templates/video', 'head') ?>


<div class="container mx-auto mt-32 ">
    <div class="grid grid-cols-5 gap-4 px-5 lg:px-0">
        <div class="col-span-5 lg:col-span-3 mb-5">
            <h1 class="text-3xl lg:text-5xl font-serif leading-none text-white"><?php the_title() ?></h1>
            <?php get_template_part('page-templates/video', 'meta') ?>
        </div>
    </div>

    <div x-data="readingLog(<?php echo $user->ID ?? false ?>, <?php echo $post_id ?>)"
         x-init="getmeasurements();"
         @scroll.window.debounce.1s="amountscrolled()"
         @resize.window="getmeasurements()"
         ref="watched"
    >

        <div class="grid grid-cols-5 gap-4 px-5 lg:px-0" style="min-height: 800px">
            <div class="col-span-5 lg:col-span-3 content text-white" id="article-content">
                <p class="mb-5 text-white"><?php echo get_the_excerpt(); ?></p>
                <?php echo preg_replace('#\[[^\]]+\]#', '', get_the_content()); ?>
            </div>
            <?php get_template_part('page-templates/video', 'sidebar') ?>
        </div>
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
            max = contentContainer.offsetTop + contentContainer.offsetHeight - 400;
            scroll = this.scrollY;

        });

     ">
            <div x-show.transition.fade.500ms="scroll > 200 && scroll < max">
            <?php get_template_part('page-templates/article', 'iconbar') ?>
        </div>
        </div>
    </div>
</div>
