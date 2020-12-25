<?php

$cat = wp_get_post_categories(get_the_ID(), ['child_of' => 17]);

if(empty($cat)){
    $cat = get_categories(['ID' => 17]);
}

$cat = array_shift($cat);
$cat = get_category($cat);

$user = wp_get_current_user();
$post = get_the_ID();


$lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
$response = $lib->request('/videos/' . get_field('field_5fe2884da38a5'), [], 'GET');
$body = $response['body'];
?>


<?php if (!empty(get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs']) && checkRemoteFile(get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['xs'])): ?>
    <div class="conatainer mx-auto mt-32 flex justify-center items-center">
        <div class="flex justify-center items-center">
            <?php if (checkRemoteFile(get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['author_small'])): ?>
                <img src="<?php echo get_field('field_5ded37c474589', 'user_' . get_the_author_meta('ID'))['sizes']['author_small'] ?>" class="rounded-full w-12 h-12">
            <?php endif; ?>
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

<div class="absolute bg-white bottom-0 right-0 mr-24 mb-24 p-10 z-50" x-cloak
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
        <script src="https://cdn.jwplayer.com/libraries/OC0ZpwGp.js" async></script>
        <script>
            window.addEventListener('load', function () {
                var player = jwplayer('headvideo');
                player.setup({
                    playlist: "https://cdn.jwplayer.com/v2/media/" + '<?php echo get_field("field_5c65130772844") ?>',
                });
                player.on('complete', function () {
                    var event = new Event('jwcomplete');
                    window.dispatchEvent(event);
                });
            });
        </script>
    <?php elseif (get_field('field_5f96fa1673bac')): ?>
        <div class="video-container" style="position: relative;width: 100%;padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/<?php echo get_field('field_5f96fa1673bac') ?>?autoplay=1&mute=1"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"></iframe>
        </div>

    <?php elseif (get_field('field_5fe2884da38a5')): ?>
        <div class="container mx-auto">
            <div x-data="prerolled('<?php echo get_field('field_5fe2884da38a5') ?>', '494384871', '<?php echo $body['pictures']['sizes'][6]['link_with_play_button'] ?>')">
                <img :src="image" x-show="!played" @click="play()" class="cursor-pointer">
                <div id="preroll" class="w-full h-auto relative" x-show.transition.in.fade="prerolls">
                    <div @click="playMain()" x-show="countdown <= 0" class="absolute bottom-0 right-0 px-3 py-2 mb-5 bg-gray-900 text-white cursor-pointer">Überspringen</div>
                    <div x-show="countdown > 0" class="absolute bottom-0 right-0 px-3 py-2 mb-5 bg-gray-900 text-white">Überspringen in <span x-text="countdown"></span> Sekunden</div>
                </div>
                <div id="clip" class="w-full h-auto relative" x-show.transition.in.fade="main"></div>
            </div>
        </div>


    <?php endif; ?>
</div>


<div class="container mx-auto mt-32 ">
    <div class="grid grid-cols-5 gap-4 px-5 lg:px-0">
        <div class="col-span-5 lg:col-span-3 mb-5 lg:hidden">
            <h1 class="text-2xl lg:text-5xl font-serif leading-none text-white"><?php the_title() ?></h1>
            <div class="text-white flex justify-end w-full mt-5">
                <div class="flex" x-data="readTime('<?php echo preg_replace("/[^ A-Za-z0-9?!]/", '', str_replace('"', '', wp_strip_all_tags(get_the_content()))); ?>')">
                    <svg class="mr-3 w-6 h-6 text-white inline ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    <p x-text="minutes"></p>
                </div>

                <div class="flex text-white mx-5">
                    <svg class="w-6 h-6 text-white inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <p><?php the_time('d.m.Y') ?></p>
                </div>

                <div class="flex text-white" x-data="articleViews(<?php the_ID(); ?>)" x-init="viewsXHR()">
                    <svg class="w-6 h-6 text-white mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                    </svg>
                    <p>
                        <svg x-show="!views" class="w-6 h-6 text-gray-300 animate-pulse" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                    <p x-show="views" x-text="views"></p>
                    </p>
                </div>
            </div>
            <hr class="my-5">
        </div>
        <div class="col-span-5 lg:col-span-3">
            <div class="content text-white"
                 x-data="readingLog(<?php echo $user->ID ?? false ?>, <?php echo $post ?>)"
                 x-init="getmeasurements();"
                 @scroll.window.debounce.1s="amountscrolled()"
                 @resize.window="getmeasurements()"
                 ref="watched"
            >
                <div class="h-64 block lg:hidden float-right w-1/2 ml-5 pl-5 mb-5 pb-5 relative">
                    <div class="h-full" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat) ?? '#5C97D0'; ?>">
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
                <div class="hidden lg:block">
                    <h1 class="text-2xl lg:text-5xl font-serif leading-none text-white"><?php the_title() ?></h1>
                    <div class="text-white flex justify-end w-full mt-5">
                        <div class="flex" x-data="readTime('<?php echo preg_replace("/[^ A-Za-z0-9?!]/", '', str_replace('"', '', wp_strip_all_tags(get_the_content()))); ?>')">
                            <svg class="mr-3 w-6 h-6 text-white inline ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <p x-text="minutes"></p>
                        </div>

                        <div class="flex text-white mx-5">
                            <svg class="w-6 h-6 text-white inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <p><?php the_time('d.m.Y') ?></p>
                        </div>

                        <div class="flex text-white" x-data="articleViews(<?php the_ID(); ?>)" x-init="viewsXHR()">
                            <svg class="w-6 h-6 text-white mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                            <p>
                                <svg x-show="!views" class="w-6 h-6 text-gray-300 animate-pulse" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                </svg>
                            <p x-show="views" x-text="views"></p>
                            </p>
                        </div>
                    </div>
                    <hr class="my-5">
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
                                <?php elseif (get_field('field_5fe2884da38a5', $next_id)): ?>
                                    <?php
                                    $lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
                                    $response = $lib->request('/videos/' . get_field('field_5fe2884da38a5', $next_id), [], 'GET');
                                    $body = $response['body'];
                                    ?>
                                    <img src="<?php echo $body['pictures']['sizes'][3]['link'] ?>">
                                <?php endif; ?>
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
