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

        <div class="container mx-auto mt-32 border-15 flex flex-col items-center relative"
             style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>);
                     background-size: cover;
                     background-position: center">
            <div class="absolute w-full h-full top-0 left-0 bg-black bg-opacity-25 z-10"></div>
            <div class="my-16 z-20">
                <h1 class="bg-white text-2xl px-5 text-center inline font-semibold"><?php the_title() ?></h1>
            </div>
            <div class="my-16 z-20">
                <h1 class="bg-white text-2xl px-5 text-center inline font-semibold">Ein
                    <span class="font-serif uppercase">Immo</span>
                    <span class="font-serif text-primary-100 uppercase">Live</span> am
                    <?php echo \Carbon\Carbon::parse(get_field('field_5ed527e9c2279'))->format('d.m.Y H:i') ?> Uhr </h1>
            </div>
            <div class="mb-32 z-20">
                <a href="<?php the_permalink(); ?>" class="bg-primary-100 px-5 lg:text-center text-white text-2xl py-2">
                    Jetzt Anmelden
                </a>
            </div>
            <div class="absolute bottom-0 right-0 m-6">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/poweredbygoreeo.png" class="w-24 h-24">
            </div>
        </div>
    <?php
    endwhile;
endif;
wp_reset_postdata();