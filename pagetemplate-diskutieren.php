<?php
/**
 * Template Name: Diskutieren
 */
get_header();
the_post();
?>

<?php
$date = date('Y-m-d H:i:s');
$query = new WP_Query([
    'post_type'      => 'immolive',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
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
if ($query->have_posts()):
    while ($query->have_posts()):
        $query->the_post();
        ?>
        <div class="h-screen-75 flex">
            <div class="w-1/2 bg-white h-full relative flex justify-center items-center">
                <div class="w-1/2">

                    <h1 class="text-5xl font-semibold font-serif"><?php the_title() ?></h1>
                    <p><?php the_content(); ?></p>
                    <div class="grid grid-cols-1 md:grid-cols-1">
                        <div class="my-10 p-5 hover:shadow-none shadow-lg bg-primary-100 text-white text-center font-semibold cursor-pointer">
                            Jetzt anmelden
                        </div>
                    </div>
                </div>


                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2 z-30" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100"/>
                </svg>

            </div>
            <div class="w-1/2 bg-primary-100 h-full">
                <div class="relative w-full h-full flex justify-center items-center">
                    <div class="bg-white p-5 shadow-lg" x-data="counter('<?php the_field('field_5ed527e9c2279') ?>')" x-init="count()">
                        <p class="text-5xl font-semibold text-center">Immo<span class="text-primary-100">Live</span> in</p>
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
                        <p class="py-10 text-center font-semibold">Diese Veranstaltung startet am <br><?php echo \Carbon\Carbon::parse(get_field('field_5ed527e9c2279'))->format('d.m.Y \u\m H:m') ?> Uhr.</p>
                    </div>
                    <div class="absolute bottom-0 right-0 w-full h-auto">
                        <img src="<?php the_field('field_5fec51051a3f8'); ?>" class="w-full h-auto z-10">
                    </div>
                </div>
            </div>
        </div>

    <?php
    endwhile;
endif;
get_footer();






