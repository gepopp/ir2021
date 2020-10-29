<?php
get_header();
the_post();

$cat = wp_get_post_categories(get_the_ID());
$cat = array_shift($cat);
$cat = get_category($cat)

?>

<div class="conatainer mx-auto mt-32 flex justify-center items-center">
        <div class="flex justify-center items-center">
            <img src="<?php echo get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs'] ?>" class="rounded-full w-12 h-12">
            <p class="ml-5 text-xl underline"><?php echo get_the_author_posts_link(get_the_ID()) ?></p>
        </div>
</div>
    <div class="container mx-auto mt-32">
        <div class="grid grid-cols-5 gap-4">
            <div></div>
            <div class="col-span-3 py-5">
                <h1 class="text-5xl font-serif leading-snug text-gray-900"><?php the_title() ?></h1>
                <?php the_post_thumbnail('custom-thumbnail', ['class' => 'my-5']); ?>
            </div>
            <div></div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="grid grid-cols-5 gap-4">
            <div>

            </div>
            <div class="col-span-3 py-5">
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>

            <div>
                <div class="relative h-64" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                    <p class="p-5 font-serif text-2xl text-white"><?php echo $cat->name ?></p>
                    <?php if (get_field('field_5f9aeff4efa16', $cat)): ?>
                        <div class="absolute bottom-0 right-0 -ml-5 -mr-5 bg-white rounded-full w-24 h-24 flex flex-col items-center justify-center shadow-lg">
                            <a href="<?php echo get_field('field_5f9aeff4efa16', $cat) ?>" class="text-center">
                                <p class="text-xs text-gray-900">powered by</p>
                                <img src="<?php echo get_field('field_5f9aefd116e2e', $cat) ?>" class="w-24 h-auto px-5">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


<?php get_footer();
