<?php
get_header();
the_post();

$cat = wp_get_post_categories(get_the_ID());
$cat = array_shift($cat);
$cat = get_category($cat);

$user = wp_get_current_user();
$post = get_the_ID();

global $wpdb;
$maxDepth = $wpdb->get_var(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND post_id = %d', $user->ID, get_the_ID()));


if($maxDepth == null && $user->ID != 0){
    $wpdb->insert('wp_reading_log', [
        'user_id' => $user->ID,
        'post_id' => get_the_ID(),
        'permalink' => get_the_permalink(),
        'scroll_depth' => 0,
        'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
    ]);
    $maxDepth = 0;
}

?>
    <div class="content"
         x-data="readingLog(<?php echo $user->ID ?? false ?>, <?php echo $post ?>, <?php echo $maxDepth ?>)"
         x-init="getmeasurements();"
         @scroll.window.debounce.1s="amountscrolled()"
         @resize.window="getmeasurements()"
         ref="watched"
    >
        <?php if (!empty(get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs'])
            && checkRemoteFile(get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs'])
            && !empty(get_the_author_meta('description'))
        ): ?>

            <div class="conatainer mx-auto mt-20 flex justify-center items-center">
                <div class="flex justify-center items-center">
                    <img src="<?php echo get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['author_small'] ?>" class="rounded-full w-12 h-12">
                    <p class="ml-5 text-xl underline"><?php echo get_the_author_posts_link(get_the_ID()) ?></p>
                </div>
            </div>

        <?php else: ?>

            <div class="conatainer mx-auto mt-20 flex justify-center items-center">
                <div class="flex justify-center items-center">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/icon.svg" class="rounded-full w-12 h-12">
                    <p class="ml-5 text-xl"><?php echo get_the_author_meta('display_name') ?></p>
                </div>
            </div>

        <?php endif; ?>

        <div class="container mx-auto mt-20">
            <div class="grid grid-cols-5 gap-4">
                <div class="hidden lg:block"></div>
                <div class="col-span-5 lg:col-span-3  py-5">
                    <h1 class="text-2xl lg:text-5xl font-serif leading-none text-gray-900"><?php the_title() ?></h1>
                    <p class="my-5"><?php the_excerpt(); ?></p>
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


        <div class="container mx-auto">
            <div class="grid grid-cols-5 gap-4">
                <div class="hidden lg:block">
                    <div class="bg-white flex flex-col items-center w-full p-5">
                        <div class="text-center pb-3 mb-3 border-b" x-data="readTime('<?php echo preg_replace("/[^ A-Za-z0-9?!]/", '', str_replace('"', '', wp_strip_all_tags(get_the_content()))); ?>')">
                            <svg class="w-6 h-6 text-gray-500 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <p x-text="minutes"></p>
                        </div>

                        <div class="text-center pb-3 mb-3 border-b">
                            <svg class="w-6 h-6 text-gray-500 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <p><?php the_time('d.m.Y') ?></p>
                        </div>

                        <div class="text-center pb-3 mb-3 border-b" x-data="articleViews(<?php the_ID(); ?>)" x-init="viewsXHR()">
                            <svg class="w-6 h-6 text-gray-500 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </svg>
                            <p>
                                <svg x-show="!views" class="w-6 h-6 text-gray-300 animate-ping" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                </svg>
                            <p x-show="views" x-text="views"></p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-5 lg:col-span-3 py-5 lg:hidden">
                    <div class="bg-white flex justify-between w-full p-5 mt-5 ">
                        <div class="text-center" x-data="readTime('<?php echo preg_replace("/[^ A-Za-z0-9?!]/", '', str_replace('"', '', wp_strip_all_tags(get_the_content()))); ?>')">
                            <svg class="w-6 h-6 text-gray-500 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <p x-text="minutes + ' Minuten'"></p>
                        </div>

                        <div class="text-center">
                            <svg class="w-6 h-6 text-gray-500 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <p><?php the_time('d.m.Y') ?></p>
                        </div>

                        <div class="text-center" x-data="articleViews(<?php the_ID(); ?>)" x-init="viewsXHR()">
                            <svg class="w-6 h-6 text-gray-500 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </svg>
                            <p>
                                <svg x-show="!views" class="w-6 h-6 text-gray-300 animate-ping" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                </svg>
                            <p x-show="views" x-text="views + ' Views'"></p>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-span-5 lg:col-span-3">
                    <div class="content">
                        <div class="relative h-64 block lg:hidden float-right w-1/3 ml-5 mb-5">
                            <div class="absolute w-full h-full">
                                <div class="h-full" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                                    <div id="scrollspy" class="flex flex-col justify-between">
                                        <p class="p-5 font-serif text-2xl text-white"><?php echo $cat->name ?></p>
                                        <p class="p-5 text-white text-sm">
                                            <a href="<?php echo get_category_link($cat) ?>">
                                                <span class="text-white underline"><?php echo $cat->count ?> Artikel</span>
                                            </a>
                                        </p>
                                    </div>
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

                        <?php echo preg_replace('#\[[^\]]+\]#', '', get_the_content()); ?>
                    </div>
                </div>

                <?php if ($cat): ?>
                    <div class="hidden lg:block">
                        <script>
                            function data() {
                                return {
                                    scrolled: 0,
                                }
                            }
                        </script>
                        <div class="relative h-64 hidden lg:block" id="powered"
                             x-data="data()"
                             @scroll.window="scrolled = document.getElementById('powered').offsetTop - window.pageYOffset"
                        >
                            <div class="absolute w-full h-full" :style="`top: ${ scrolled < 0 ? (scrolled * -1) + 100 : 0 }px;`">
                                <div class="h-full" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                                    <div id="scrollspy" class="flex flex-col justify-between h-full">
                                        <p class="p-5 font-serif text-2xl text-white"><?php echo $cat->name ?></p>
                                        <p class="p-5 text-white">
                                            <a href="<?php echo get_category_link($cat) ?>">
                                                <span class="text-white underline"><?php echo $cat->count ?> Artikel</span>
                                            </a>
                                        </p>
                                    </div>
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
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php

$search = in_category(159) ? get_the_title() : false;

if ($search && get_field('field_5fa63966c0b24')) {

    $search .= '+' . get_field('field_5fa63966c0b24');

} elseif (get_field('field_5fa63966c0b24')) {

    $search = get_field('field_5fa63966c0b24');

}


if ($search != '+'): ?>
    <?php

    $query = new WP_Query(
        [
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'posts_per_page'      => 3,
            's'                   => $search,
            'post__not_in'        => [get_the_ID()],
        ]
    );

    ?>


    <?php if ($query->have_posts()): ?>
        <div class="container mx-auto mt-20 flex justify-center items-center">
            <div class="grid grid-cols-5 gap-4">
                <div></div>
                <?php while ($query->have_posts()): ?>
                    <?php $query->the_post(); ?>
                    <div class="col-span-3 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (!has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article'))): ?>
                                    <div class="bg-primary-100 w-full h-full" style="padding-top: 56.25%;"></div>
                                <?php else: ?>
                                    <?php the_post_thumbnail('featured_small', ['class' => 'w-full h-auto max-w-full']); ?>
                                <?php endif; ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <?php if (!has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article'))): ?>
                                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/icon.svg" class="w-1/3 h-auto">
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

    </div>
<?php get_footer();
