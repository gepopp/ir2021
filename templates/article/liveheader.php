<div class="container mx-auto mt-48">
    <div class="hidden lg:block"></div>
    <div class="col-span-5 lg:col-span-3 -mx-5">
        <?php get_template_part('banner', 'mega') ?>
    </div>
</div>

<?php $iframe = get_field('field_60734337a834d'); ?>

<div class="container mx-auto">
    <div class="hidden lg:block"></div>
    <div class="col-span-5 lg:col-span-3  py-5">
        <div class="grid grid-cols-4 gap-5" x-data="{ maxHeight: '' }" x-init="
             maxHeight = document.getElementById('videoContainer').offsetHeight + 'px';
             new ResizeObserver(() => {
                maxHeight = document.getElementById('videoContainer').offsetHeight + 'px';
             }).observe(document.getElementById('videoContainer')); ">
            <div class="relative col-span-4 lg:col-span-3" id="videoContainer">
                <?php get_template_part('video', 'player') ?>
            </div>
            <div class="col-span-4 lg:col-span-1 overflow-scroll scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100"
                 :style="`max-height: ${maxHeight};`">
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