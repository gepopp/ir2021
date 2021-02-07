<?php

use function immobilien_redaktion_2020\load_vimeo_image;
use Overtrue\Socialite\SocialiteManager;

/**
 * Template Name: Landing Live
 */
get_header();
the_post();

$date = date('Ymd');
$query = new WP_Query([
    'post_type'      => 'immolive',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'meta_query'     => [
        'relation' => 'AND',
        [
            'key'     => 'il_datum',
            'value'   => $date,
            'compare' => '>',
        ],
    ],
    'order'          => 'ASC',
    'meta_key'       => 'il_datum',
    'orderby'        => 'meta_value_num',
]);
$count = $query->post_count;


if ($query->have_posts()):
    while ($query->have_posts()):
        $query->the_post();

        get_template_part('page-templates/snippet', 'event');

        $speakers = get_field('field_6007f8b5a20f0');
        ?>
        <div class="container mx-auto border-15 border-white bg-primary-100 px-5 lg:px-12 py-10">
            <div class="flex justify-end md:justify-between w-full py-5 text-xl lg:text-3xl text-white font-light leading-none">
                <p class="w-full lg:w-1/3 hidden md:block"><?php _e('Das größte Online-Event der österreichischen Immobilienwirtschaft', 'ir21') ?></p>
                <div class="font-normal text-right flex-shrink-0">
                    <p><?php the_field('field_5ed527e9c2279'); ?></p>
                    <p><?php _e('Zoom Webinar', 'ir21') ?></p>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <h1 class="text-3xl lg:text-5xl text-white text-center font-extrabold max-w-full overflow-hidden leading-normal break-words"><?php the_title() ?></h1>
                <div class="text-lg text-white mb-10 lg:w-2/3 text-center"><?php the_content(); ?></div>
            </div>

            <div>
                <div class="" x-data="counter('<?php the_field('field_5ed527e9c2279') ?>')" x-init="count()">
                    <?php get_template_part('page-templates/immolive', 'counter-v2') ?>
                    <div class="flex justify-center my-20">
                        <a class="py-2 px-10 text-primary-100 bg-white shadow-xl hover:shadow-none text-xl lg:text-3xl font-medium cursor-pointer"
                           @click="$dispatch('register-immolive', { id: <?php the_ID(); ?>, user: <?php echo is_user_logged_in() ?> })">
                            <?php _e('Jetzt anmelden', 'ir21') ?>
                        </a>
                    </div>
                </div>
            </div>


            <?php if ($speakers): ?>
                <?php if (count($speakers) == 1): ?>
                    <?php speakerHorizontal(array_shift($speakers)); ?>
                <?php endif; ?>

                <?php if (count($speakers) == 2): ?>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-10">
                        <div>
                            <?php speakerHorizontal(array_shift($speakers)); ?>
                        </div>
                        <div>
                            <?php speakerHorizontal(array_shift($speakers)); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (count($speakers) > 2): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-<?php echo min(4, count($speakers)) ?> gap-10">
                        <?php
                        while ($speaker = array_shift($speakers)) {
                            speakerVertical($speaker);
                        }
                        ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php
    endwhile;
endif;
?>

<?php
$query = new \WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 10,
    'tag__in'             => 989,
]);
?>

<?php get_template_part('banner-templates/banner', 'mega') ?>

    <div class="container mx-auto mt-20 px-5 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): ?>
                    <?php $query->the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary bg-gray-900">
                            <?php if (get_field('field_5f96fa1673bac')): ?>
                                <img src="https://img.youtube.com/vi/<?php the_field('field_5f96fa1673bac') ?>/mqdefault.jpg" class="w-full h-auto max-w-full">
                            <?php elseif (get_field('field_5fe2884da38a5')): ?>
                                <img src="<?php echo load_vimeo_image(get_the_ID()) ?>" class="w-full h-auto">
                            <?php endif; ?>
                            <div class="absolute top-0 left-0 w-full h-full"></div>
                            <div class="absolute bottom-0 left-0 hidden lg:block w-full">
                                <?php get_template_part('page-templates/snippet', 'heading') ?>
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                <div class="rounded-full bg-white w-24 h-24 m-5 flex items-center justify-center">
                                    <div class="w-12 h-12 animate-ping bg-white rounded-full">
                                        <svg class="w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="block lg:hidden mt-5">
                            <h1 class="text-gray-800 text-lg font-semibold"><?php the_title() ?></h1>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="container mx-auto mt-10" x-data="loadMoreImmolive()">
            <div class="grid grid-cols-2 gap-10">
                <template x-for="post in loaded">
                    <div class="col-span-2 md:col-span-1 relative">
                        <a :href="post.permalink" class="relative block bg-primary bg-gray-900">
                            <div class="bg-primary-100" style="padding-top: 56%">
                                <img :src="post.img_url" class="w-full h-auto" style="margin-top: -56%">
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25"></div>
                            <div class="absolute bottom-0 left-0 m-5 hidden lg:block">
                                <h1 class="font-serif text-white text-2xl" x-text="post.title"></h1>
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                <div class="rounded-full bg-white w-24 h-24 m-5 flex items-center justify-center">
                                    <div class="w-12 h-12 animate-ping bg-white rounded-full">
                                        <svg class="w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a :href="post.permalink" class="block lg:hidden mt-5">
                            <h1 class="text-gray-800 text-sm lg:text-2xl" x-text="post.title"></h1>
                        </a>
                    </div>
                </template>

                <div class="flex items-center justify-center w-full my-32 col-span-2">
                    <div class="inline">
                        <div class="py-2 px-3 bg-primary-100 text-white text-xl font-bold cursor-pointer" @click="load()">
                            <?php _e('weitere laden', 'ir21') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div x-data="{ show: false, user : false, id : false }"
         x-init="
            window.addEventListener('register-immolive', (e) => {
                show = true;
                user = e.detail.user;
                id = e.detail.id;
            })
        ">

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="fixed z-10 inset-0 overflow-y-auto"
             x-show="show"
             x-cloak>
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                  Background overlay, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <!--
                  Modal panel, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="inline-block align-bottom bg-white border-15 border-primary-100 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                     role="dialog" aria-modal="true"
                     aria-labelledby="modal-headline"
                     @click.away="show = false">



                    <div x-show="!user">
                        <h2 class="font-serif font-semibold text-xl mb-4"><?php _e('Um sich zu unseren ImmoLive Webinaren anmelden zu können müssen Sie sich einloggen.', 'ir21') ?></h2>
                        <p class="mb-4"><?php _e('Sie haben noch keinen Account bei der Immobilien Redaktion? Kein Problen, einfach, schnell und', 'ir21') ?>
                            <a class="text-primary-100 underline"
                               href="<?php echo add_query_arg(['redirect' => urlencode(get_permalink())], get_field('field_6013cf36d4689', 'option')) ?>">
                                <?php _e('kostenlos registrieren', 'ir21') ?>
                            </a>

                            .</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2 xl:col-span-1">

                                <?php
                                $ref = $_GET['ref'] ?? 'none';
                                $redirect = urlencode( add_query_arg( ['ref' => $ref ], get_field('field_601e5f56775db', 'option')))
                                ?>
                                <a href="<?php echo add_query_arg(['redirect' => $redirect], get_field('field_601bbffe28967', 'option')) ?>"
                                   class="block bg-primary-100 text-white font-semibold text-center shadow-xl py-3 my-5 text-lg focus:outline-none focus:shadow-outline w-full text-center cursor-pointer">
                                    <?php _e('E-Mail login', 'ir21') ?>
                                </a>
                            </div>
                            <div class="col-span-2 xl:col-span-1">
                                <?php
                                $config = [
                                    'facebook' => [
                                        'client_id'     => '831950683917414',
                                        'client_secret' => 'd6d52d59ce1f1efdbf997b980dffe229',
                                        'redirect'      => home_url('fb-login'),
                                    ],
                                ];

                                $socialite = new SocialiteManager($config);
                                ?>

                                <a href="<?php echo $socialite->create('facebook')->withState($redirect)->redirect(); ?>"
                                   class="block bg-white text-primary-100 border border-primary-100 font-semibold text-center shadow-xl py-3 my-5 text-lg focus:outline-none focus:shadow-outline w-full text-center cursor-pointer"
                                >
                                    <?php _e('Facebook login', 'ir21') ?>
                                </a>
                            </div>
                        </div>
                    </div>




                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="w-full inline-flex justify-center border border-primary-100 shadow-sm px-4 py-2 text-base font-medium text-primary-100 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                        @click="show = false">
                            <?php _e('abbrechen', 'ir21') ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php wp_reset_postdata();

get_footer();






