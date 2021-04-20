<div class="container mx-auto mt-48">
    <div class="hidden lg:block"></div>
    <div class="col-span-5 lg:col-span-3">
        <?php get_template_part('banner-templates/banner', 'mega') ?>
    </div>
</div>

<?php $iframe = get_field('field_60734337a834d'); ?>

<div class="container mx-auto">
    <div class="hidden lg:block"></div>
    <div class="col-span-5 lg:col-span-3  py-5">
        <div class="grid grid-cols-4 gap-5">
            <div class="relative col-span-4 lg:col-span-3">
                <div id="video-holder">
                    <?php if (!empty($iframe)): ?>
                        <?php echo $iframe ?>
                    <?php else: ?>
                        <?php the_post_thumbnail('custom-thumbnail', ['class' => 'mt-5 w-full h-auto']); ?>
                        <?php if (get_field('field_5c6cfbd7106c1', get_post_thumbnail_id(get_the_ID()))): ?>
                            <p class="absolute bottom-0 right-0 transform rotate-90 text-white mr-2" style=" transform-origin: right;">&copy <?php echo get_field('field_5c6cfbd7106c1', get_post_thumbnail_id(get_the_ID())) ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-span-4 lg:col-span-1">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        </div>
    </div>
    <div class="hidden lg:block"></div>
</div>