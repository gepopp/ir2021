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
            <div class="content col-span-5 lg:col-span-3" id="article-content">
                <?php echo preg_replace('#\[[^\]]+\]#', '', get_the_content()); ?>
            </div>
            <div>
                <?php get_template_part('page-templates/article', 'right') ?>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('page-templates/article', 'readmore') ?>

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
        <?php get_template_part('page-templates/article', 'iconbar') ?>
    </div>
</div>