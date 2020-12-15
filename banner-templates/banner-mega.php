<?php
$today = date('Ymd');
$banner_args = [
    'post_type'      => 'ir_ad',
    'posts_per_page' => 1,
    'tax_query'      => [
        'relation' => 'and',
        [
            'taxonomy'         => 'position',
            'terms'            => 'mega-banner',
            'field'            => 'slug',
            'include_children' => false,
            'operator'         => 'IN',
        ],

    ],
    'meta_query'     => [
        'relation' => 'AND',
        [
            'key'     => 'start',
            'compare' => '<=',
            'value'   => $today,
        ],
        [
            'key'     => 'ende',
            'compare' => '>=',
            'value'   => $today,
        ],
        [
            'key'   => 'banner_status', // name of custom field
            'value' => [3, 5],
        ],
    ],
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
];
$query = new WP_Query($banner_args);
?>
<div class="container mx-auto mt-20 lg:hidden mb-12">
    <p class="text-xs text-gray-300">Werbung</p>
    <div class="flex flex-col lg:flex-row p-5 border">
        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): ?>
                <?php $query->the_post(); ?>
                <?php $thumb =  get_the_post_thumbnail_url(); $link = get_field('field_5c6325e38e0aa') ?>
                <div class="w-full">
                    <a href="<?php the_field('field_5c6325e38e0aa') ?>">
                        <img src="<?php echo the_field('field_5f0d5b0270f63'); ?>" class="w-full h-auto">
                    </a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>

<div class="absolute top-0 right-0" style="margin-right: -400px; margin-top: -18px;">
    <p class="text-xs text-gray-300">Werbung</p>
    <div class="flex flex-col lg:flex-row p-5 border">
        <div class="w-full">
            <a href="<?php echo $link ?>">
                <img src="<?php echo $thumb ?>" class="w-full h-auto">
            </a>
        </div>
    </div>
</div>


