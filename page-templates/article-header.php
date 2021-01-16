<?php get_template_part('page-templates/article', 'author') ?>


<div class="container mx-auto mt-20">
    <div class="grid grid-cols-5 gap-4">
        <div class="hidden lg:block"></div>
        <div class="col-span-5 lg:col-span-3  py-5">
            <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900">
                <?php the_title() ?>
                <?php if (current_user_can('administrator') && is_single()): ?>
                    <p class="text-xs"> ( <?php echo edit_post_link() ?> ) </p>
                <?php endif; ?>
            </h1>
            <p class="my-5 font-semibold"><?php echo get_the_excerpt(); ?></p>
        </div>
    </div>
</div>


<div class="container mx-auto">
    <div class="grid grid-cols-5 gap-4">
        <div class="hidden lg:block"></div>
        <div class="col-span-5 lg:col-span-3">
<?php get_template_part('banner-templates/banner', 'mega') ?>
        </div>
    </div>
</div>


<div class="container mx-auto">
    <div class="grid grid-cols-5 gap-4">
        <div class="hidden lg:block"></div>
        <div class="col-span-5 lg:col-span-3  py-5">
            <div class="relative">
                <?php the_post_thumbnail('custom-thumbnail', ['class' => 'mt-5 w-full h-auto']); ?>
                <?php if (get_field('field_5c6cfbd7106c1', get_post_thumbnail_id(get_the_ID()))): ?>
                    <p class="absolute bottom-0 right-0 transform rotate-90 text-white mr-2" style=" transform-origin: right;">&copy <?php echo get_field('field_5c6cfbd7106c1', get_post_thumbnail_id(get_the_ID())) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="hidden lg:block"></div>
    </div>
</div>