<?php
$date = date('Y-m-d H:i:s');
$query = new WP_Query([
    'post_type'      => 'immolive',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'meta_query'     => [
        'relation' => 'AND',
        [
            'key'     => 'il_datum',
            'value'   => $date,
            'compare' => '>=',
            'type'    => 'DATETIME',
        ],
    ],
    'order'          => 'ASC',
    'meta_key'       => 'il_datum',
    'orderby'        => 'meta_value_num',
]);
if ($query->have_posts()):
    while ($query->have_posts()):
        $query->the_post();
        ?>

        <div class="px-5 xl:px-0">
            <div class="container mx-auto mt-20 border-15 flex flex-col justify-end relative bg-no-repeat bg-top bg-white xl:bg-center bg-contain lg:bg-cover pt-25p lg:pt-20p xl:pt-15p"
                 style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>); min-height: 450px;">
                <div class="flex flex-col lg:flex-row justify-between w-full bg-white p-5">
                    <div>
                        <a href="<?php echo home_url('diskutieren') ?>">
                            <p class="bg-white text-xl  lg:text-2xl px-5 font-semibold"><?php the_title() ?></p>
                            <p class="bg-white text-sm lg:text-xl px-5 font-semibold">
                                <?php _e('Ein <span class="font-serif uppercase">Immo</span><span class="font-serif text-primary-100 uppercase">Live</span> am', 'ir21') ?>
                                <?php echo \Carbon\Carbon::parse(get_field('field_5ed527e9c2279'))->format('d.m.Y H:i') ?> <?php _e('Uhr', 'ir21') ?>
                            </p>
                        </a>
                    </div>

                    <?php if (!empty(get_field('field_5ed52801c227a'))): ?>
                        <div class="flex items-center mt-10 lg:mt-0 pl-5 lg:pl-0">
                            <a href="<?php the_field('field_5ed52801c227a') ?>" class="bg-primary-100 px-5 lg:text-center text-white text-lg lg:text-2xl py-2 whitespace-no-wrap">
                                <?php _e('Jetzt Anmelden', 'ir21') ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    endwhile;
else:
    $query = new \WP_Query([
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => 2,
        'offset'              => 2,
        'category__not_in'    => [17, 696, 159],
        'tag__not_in'         => 989,
    ]);
    ?>


    <div class="container mx-auto mt-20 relative px-5 lg:px-0">

    <div class="grid grid-cols-2 gap-10">
        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): ?>
                <?php $query->the_post(); ?>
                <div class="col-span-2 md:col-span-1 relative">
                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full image-holder">
                            <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full', 'onerror' => "this.style.display='none'"]); ?>
                            <h1 class="absolute bottom-0 left-0 text-white font-serif p-5 text-3xl"><?php the_title() ?></h1>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php
endif;
wp_reset_postdata();