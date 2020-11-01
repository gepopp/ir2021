<?php
get_header();
the_post();


$cat = wp_get_post_categories(get_the_ID(), ['child_of' => 17]);
$cat = array_shift($cat);
$cat = get_category($cat)

?>


<?php if (!empty(get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs']) && checkRemoteFile(get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs'])): ?>
    <div class="conatainer mx-auto mt-32 flex justify-center items-center">
        <div class="flex justify-center items-center">
            <img src="<?php echo get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs'] ?>" class="rounded-full w-12 h-12">
            <p class="ml-5 text-xl text-white underline"><?php echo get_the_author_posts_link(get_the_ID()) ?></p>
        </div>
    </div>
<?php endif;

$next = get_posts([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 1,
    'category__in'        => [17],
    'date_query'          => [
        [
            'before' => get_the_time('d-m-Y H:i:s'),
        ],
    ],
]);
?>
    <script>
        function jwhandler(next) {
            return {
                countdown: 10,
                interval: false,
                show: false,
                rest() {

                    this.show = true;
                    this.interval = window.setInterval(() => {
                        if (this.countdown > 0) {
                            this.countdown = this.countdown - 1;
                        } else {
                            window.location.href = next
                        }
                    }, 1000)
                },
                cancel() {
                    clearInterval(this.interval);
                    this.countdown = 10;
                    this.show = false;
                }

            }
        }
    </script>

    <div class="absolute bg-white bottom-0 right-0 mr-24 mb-24 p-10 z-50"
         x-data="jwhandler('<?php echo get_permalink($next[0]->ID) ?>')"
         x-on:jwcomplete.window="rest()"
         x-show="show"
    >
        <div class="flex">
            <div class="rounded-full">
                <svg class="w-12 h-12 text-warning" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="text-3xl">Nächster Clip in <span x-text="countdown"></span></p>
                <p x-on:click="cancel()" class="text-warning text-center underline cursor-pointer">Abbrechen</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-32 relative">

        <?php if (get_field('field_5c65130772844')): ?>
            <div id="headvideo"></div>
            <script src="https://cdn.jwplayer.com/libraries/OC0ZpwGp.js"></script>
            <script>
                var player = jwplayer('headvideo');
                player.setup({
                    playlist: "https://cdn.jwplayer.com/v2/media/" + '<?php echo get_field("field_5c65130772844") ?>',
                });
                player.on('complete', function () {
                    var event = new Event('jwcomplete');
                    window.dispatchEvent(event);
                });

            </script>
        <?php elseif (get_field('field_5f96fa1673bac')): ?>
            <div class="video-container" style="position: relative;width: 100%;padding-bottom: 56.25%;">
                <iframe src="https://www.youtube.com/embed/<?php echo get_field('field_5f96fa1673bac') ?>?autoplay=1&mute=1"
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"></iframe>
            </div>
        <?php endif; ?>
    </div>


    <div class="container mx-auto mt-32">
        <div class="grid grid-cols-5 gap-4 px-5 lg:px-0">
            <div class="col-span-5 lg:col-span-3 mb-5">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none text-white"><?php the_title() ?></h1>
            </div>
            <div class="col-span-5 lg:col-span-3">
                <div class="content text-white">
                    <div class="h-64 block lg:hidden float-right w-1/2 ml-5 pl-5 mb-5 pb-5">
                        <div class="h-full" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                            <div class="flex flex-col justify-between h-full">
                                <p class="p-5 font-serif text-2xl text-white"><?php echo $cat->name ?></p>
                            </div>
                            <?php if (get_field('field_5f9aeff4efa16', $cat)): ?>
                                <div class="z-10 absolute bottom-0 right-0 -mb-5 -mr-5 bg-white rounded-full w-24 h-24 flex flex-col items-center justify-center shadow-lg">
                                    <a href="<?php echo get_field('field_5f9aeff4efa16', $cat) ?>" class="text-center">
                                        <p class="text-xs text-gray-900">powered by</p>
                                        <img src="<?php echo get_field('field_5f9aefd116e2e', $cat) ?>" class="w-24 h-auto px-5">
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <p class="mb-5 text-white"><?php echo get_the_excerpt(); ?></p>
                    <?php echo preg_replace('#\[[^\]]+\]#', '', get_the_content()); ?>
                </div>
            </div>


            <div class="hidden lg:block col-span-2">
                <script>
                    function data() {
                        return {
                            scrolled: 0,
                        }
                    }
                </script>
                <div class="relative h-64 hidden lg:block" id="powered"
                     x-data="data()"
                     @scroll.window="scrolled = document.getElementById('powered').offsetTop - window.pageYOffset">
                    <div class="absolute w-full h-full" :style="`top: ${ scrolled < 0 ? (scrolled * -1) + 100 : 0 }px;`">
                        <div class="h-full" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                            <div id="scrollspy" class="flex flex-col justify-between h-full">
                                <p class="p-5 font-serif text-2xl text-white"><?php echo $cat->name ?></p>
                            </div>
                            <?php if (get_field('field_5f9aeff4efa16', $cat)): ?>
                                <div class="z-10 absolute bottom-0 right-0 -mb-5 -mr-5 bg-white rounded-full w-24 h-24 flex flex-col items-center justify-center shadow-lg">
                                    <a href="<?php echo get_field('field_5f9aeff4efa16', $cat) ?>" class="text-center">
                                        <p class="text-xs text-gray-900">powered by</p>
                                        <img src="<?php echo get_field('field_5f9aefd116e2e', $cat) ?>" class="w-24 h-auto px-5">
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php
                            $next = get_posts([
                                'post_type'           => 'post',
                                'post_status'         => 'publish',
                                'ignore_sticky_posts' => true,
                                'posts_per_page'      => 1,
                                'category__in'        => [17],
                                'date_query'          => [
                                    [
                                        'before' => get_the_time('d-m-Y H:i:s'),
                                    ],
                                ],
                            ]);
                            $next_id = $next[0]->ID;
                            ?>
                            <div class="relative">
                                <a href="<?php echo get_the_permalink($next_id); ?>">
                                    <?php if (get_field('field_5c65130772844', $next_id)): ?>
                                        <img class="w-full h-auto" src="https://cdn.jwplayer.com/v2/media/<?php echo get_field('field_5c65130772844', $next_id) ?>/poster.jpg"/>
                                    <?php elseif (get_field('field_5f96fa1673bac', $next_id)): ?>
                                        <img class="w-full h-auto" src="https://img.youtube.com/vi/<?php echo get_field('field_5f96fa1673bac', $next_id) ?>/mqdefault.jpg"/>
                                    <?php endif;
                                    ?>
                                    <div class="absolute w-full h-full flex flex-col justify-end top-0 left-0 p-5">
                                        <div class="inline ">
                                                <span class="bg-white text-gray-900 text-sm py-2 px-3 font-bold">
                                                    Nächster Clip
                                                </span>
                                        </div>
                                        <h1 class="font-serif text-white text-xl mt-5"><?php echo get_the_title($next_id) ?></h1>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php get_footer();

