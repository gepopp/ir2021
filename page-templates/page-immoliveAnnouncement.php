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

        get_template_part('page-templates/snippet', 'event');

        $query->the_post();
        $speakers = get_field('field_6007f8b5a20f0');
        ?>

        <div class="px-5 xl:px-0">
            <div class="container mx-auto mt-20 border-15 border-white bg-primary-100 px-12 py-10">
                <h1 class="text-3xl lg:text-5xl text-white font-extrabold max-w-full overflow-hidden leading-normal"><?php the_title() ?></h1>
                <div class="flex flex-col lg:flex-row justify-between w-full py-5 text-xl lg:text-3xl text-white font-light leading-none">
                    <p class="w-full lg:w-1/3"><?php _e('Das größte Online-Event der österreichischen Immobilienwirtschaft', 'ir21') ?></p>
                    <div class="font-normal mt-5 lg:mt-0">
                        <p><?php the_field('field_5ed527e9c2279'); ?></p>
                        <p><?php _e('Zoom Webinar', 'ir21') ?></p>
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
                            while ($speaker = array_shift($speakers)){
                                speakerVertical($speaker);
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>

                <div class="flex justify-end mt-20 mb-5">
                    <a href="<?php echo get_field('field_601e5f56775db', 'option') ?>" class="py-2 px-10 text-primary-100 bg-white shadow-xl hover:shadow-none text-xl lg:text-3xl font-medium"><?php _e('Alle ImmoLive', 'ir21') ?></a>
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
    </div>
    <?php wp_reset_postdata(); ?>
<?php
endif;
wp_reset_postdata();

