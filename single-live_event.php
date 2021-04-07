<?php
get_header();
the_post();

$event_id = get_field('field_6069e92463992');

?>

    <div class="container mx-auto my-20">
        <?php get_template_part('page-templates/video', 'head') ?>
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://vimeo.com/event/<?php echo $event_id ?>/embed" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
        </div>
    </div>

    <div class="container mx-auto my-10">
        <div class="grid grid-cols-2 gap-10">
            <div>
                <h1 class="text-white text-xl lg:text-3xl font-serif"><?php the_title() ?></h1>
                <div class="text-white">
                    <?php the_content(); ?>
                </div>
            </div>
            <div>

                <?php

                $user = wp_get_current_user();
                $image = get_field('field_5ded37c474589', 'user_' . $user->ID);

                ?>
                <div class="flex space-x-3 items-end">
                    <img src="<?php echo $image['sizes']['author_small'] ?>" class="rounded-full w-16 h-16 p-1 border border-white">
                    <textarea
                            type="text"
                            class="bg-gray-100 text-gray-800 border-b border-white block w-full py-2 px-2 leading-tight appearance-none focus:outline-none placeholder-gray-500"
                            placeholder="Schreiben Sie einen Kommentar ..."></textarea>
                    <div class="">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

            </div>
        </div>

    </div>
<?php
get_footer();

