<?php
/**
 * Template Name: Diskutieren
 */
get_header();
the_post();

$date = date('Y-m-d H:i:s');
$query = new WP_Query([
    'post_type'      => 'immolive',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'meta_query'     => [
        'relation' => 'AND',
        [
            'key'     => 'termin',
            'value'   => $date,
            'compare' => '>=',
            'type'    => 'DATETIME',
        ],
    ],
    'order'          => 'DESC',
    'meta_key'       => 'termin',
    'meta_type'      => 'DATETIME',
    'orderby'        => 'meta_value_date',
]);
$count = $query->post_count;


if ($query->have_posts()):
    $runner = 1;
    while ($query->have_posts()):
        $query->the_post();
        if ($runner == 1):
            ?>
            <div class="lg:h-screen-75 flex lg:-mx-5" x-data="counter('<?php the_field('field_5ed527e9c2279') ?>')" x-init="count()">
                <div class="lg:w-1/2 bg-white h-full relative flex justify-center items-center">
                    <div class="lg:w-1/2">

                        <div class="mt-20 mb-10 lg:hidden">
                            <p class="text-3xl font-semibold text-center mb-5">Immo<span class="text-primary-100">Live</span> in</p>
                            <div class="flex justify-center space-x-4">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-12 h-12 p-3 shadow-lg">
                                        <p x-text="days" class="text-2xl font-semibold text-white"></p>
                                    </div>
                                    <span class="font-semibold">Tage</span>
                                </div>
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-12 h-12 p-3 shadow-lg">
                                        <p x-text="hours" class="text-2xl font-semibold text-white"></p>
                                    </div>
                                    <span class="font-semibold">Stunden</span>
                                </div>
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-12 h-12 p-3 shadow-lg">
                                        <p x-text="minutes" class="text-2xl font-semibold text-white"></p>
                                    </div>
                                    <span class="font-semibold">Minuten</span>
                                </div>
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-12 h-12 p-3 shadow-lg">
                                        <p x-text="seconds" class="text-2xl font-semibold text-white"></p>
                                    </div>
                                    <span class="font-semibold">Sekunden</span>
                                </div>
                            </div>
                        </div>




                        <p class="font-semibold hidden lg:block px-5 lg:px-0">Diese Livestream startet am <?php echo \Carbon\Carbon::parse(get_field('field_5ed527e9c2279'))->format('d.m.Y \u\m H:m') ?> Uhr.</p>
                        <h1 class="text-3xl font-semibold font-serif leading-tight px-5 lg:px-0 py-5"><?php the_title() ?></h1>
                        <div class="px-5 lg:px-0"><?php the_content(); ?></div>
                        <div class="grid grid-cols-1 md:grid-cols-1 px-5 lg:px-0">
                            <?php if (!empty(get_field('field_5ed52801c227a'))): ?>
                                <div class="my-10 p-5 hover:shadow-none shadow-lg bg-primary-100 text-white text-center font-semibold cursor-pointer">
                                    <a href="<?php the_field('field_5ed52801c227a') ?>">Jetzt anmelden</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="w-full h-auto lg:hidden">
                            <img src="<?php the_field('field_5fec51051a3f8'); ?>" class="w-full h-auto z-10">
                        </div>
                    </div>
                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2 z-40" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <polygon points="50,0 100,0 50,100 0,100"/>
                    </svg>
                </div>
                <div class="w-1/2 bg-primary-100 h-full hidden lg:block">
                    <div class="relative w-full h-full flex justify-center items-center">
                        <div class="bg-white px-5 py-10 shadow-lg z-20">
                            <p class="text-5xl font-semibold text-center">Immo<span class="text-primary-100">Live</span> in
                            </p>
                            <div class="flex justify-center space-x-4">
                                <div class="text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-24 h-24 p-3 shadow-lg">
                                        <p x-text="days" class="text-5xl font-semibold text-white -mt-2"></p>
                                    </div>
                                    <span class="text-xl font-bold">Tage</span>
                                </div>
                                <div class="text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-24 h-24 p-3 shadow-lg">
                                        <p x-text="hours" class="text-5xl font-semibold text-white -mt-2"></p>
                                    </div>
                                    <span class="text-xl font-bold">Stunden</span>
                                </div>
                                <div class="text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-24 h-24 p-3 shadow-lg">
                                        <p x-text="minutes" class="text-5xl font-semibold text-white -mt-2"></p>
                                    </div>
                                    <span class="text-xl font-bold">Minuten</span>
                                </div>
                                <div class="text-center">
                                    <div class="flex items-center justify-center rounded-full bg-primary-100 w-24 h-24 p-3 shadow-lg">
                                        <p x-text="seconds" class="text-5xl font-semibold text-white -mt-2"></p>
                                    </div>
                                    <span class="text-xl font-bold">Sekunden</span>
                                </div>
                            </div>
                            <p class="py-10 text-center font-semibold">Diese Livestream startet am
                                <br><?php echo \Carbon\Carbon::parse(get_field('field_5ed527e9c2279'))->format('d.m.Y \u\m H:m') ?> Uhr.
                            </p>
                        </div>
                        <div class="absolute bottom-0 right-0 w-full h-auto z-30">
                            <img src="<?php the_field('field_5fec51051a3f8'); ?>" class="w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white border-t-8 border-primary-100 lg:-mx-5 shadow-xl">
            <div class="container mx-auto lg:flex ">
        <?php else: ?>
            <div class="w-full lg:w-1/2 py-10 px-5 flex flex-col flex-grow">
                <h1 class="text-3xl font-semibold font-serif leading-tight"><?php the_title() ?></h1>
                <p class="mb-5">
                    <span class="font-serif text-primary-100 uppercase">Live</span> am <?php echo \Carbon\Carbon::parse(get_field('field_5ed527e9c2279'))->format('d.m.Y H:i') ?> Uhr
                </p>
                <p><?php echo the_content() ?></p>
                <div class="relative mt-auto">
                    <img src="<?php the_field('field_5fec51051a3f8'); ?>" class="w-full h-auto">
                    <?php if (!empty(get_field('field_5ed52801c227a'))): ?>
                        <div class="absolute bottom-0 right-0 m-5">
                            <a href="<?php the_field('field_5ed52801c227a') ?>" class="bg-primary-100 px-5 lg:text-center text-white text-2xl py-2">
                                Jetzt Anmelden
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($runner == 3): ?>
        </div>
        </div>
    <?php endif; ?>
        <?php
        $runner++;
    endwhile;
endif;


$query = new \WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 10,
    'tag__in'             => 989,
]);
?>
    <div class="container mx-auto mt-20 px-5">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): ?>
                    <?php $query->the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary bg-gray-900">
                            <?php if (get_field('field_5c65130772844')): ?>
                                <img src="https://cdn.jwplayer.com/v2/media/<?php the_field('field_5c65130772844') ?>/poster.jpg" class="w-full h-auto max-w-full">
                            <?php elseif (get_field('field_5f96fa1673bac')): ?>
                                <img src="https://img.youtube.com/vi/<?php the_field('field_5f96fa1673bac') ?>/mqdefault.jpg" class="w-full h-auto max-w-full">
                            <?php elseif (get_field('field_5fe2884da38a5')):
                                $lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
                                $response = $lib->request('/videos/' . get_field('field_5fe2884da38a5'), [], 'GET');
                                $body = $response['body']; ?>

                                <img src="<?php echo $body['pictures']['sizes'][3]['link'] ?>" class="w-full h-auto">
                            <?php endif; ?>
                            <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25"></div>
                            <div class="absolute bottom-0 left-0 m-5 hidden lg:block">
                                <h1 class="font-serif text-white text-2xl"><?php the_title() ?></h1>
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
                            <h1 class="text-gray-800 text-sm lg:text-2xl"><?php the_title() ?></h1>
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
                            weitere laden
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php wp_reset_postdata();

get_footer();






