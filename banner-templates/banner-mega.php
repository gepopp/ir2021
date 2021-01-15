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
$query_banner = new WP_Query($banner_args);
?>
<?php if (!is_single() || (is_single() && get_post_format() == 'video' )): ?>
    <div class="container mx-auto mt-12 mb-12 px-5 lg:px-0">
        <p class="text-xs text-gray-300">Werbung</p>
        <div class="flex flex-col lg:flex-row p-5 border">
            <?php if ($query_banner->have_posts()): ?>
                <?php while ($query_banner->have_posts()): ?>
                    <?php $query_banner->the_post(); ?>
                    <div class="w-full">
                        <a href="<?php the_field('field_5c6325e38e0aa') ?>" class="hidden xl:block">
                            <img src="<?php echo the_post_thumbnail_url('full') ?>" class="w-full h-auto">
                        </a>
                        <a href="<?php the_field('field_5c6325e38e0aa') ?>" class="hidden lg:block xl:hidden">
                            <img src="<?php echo the_field('field_60011a6a053b7') ?>" class="w-full h-auto">
                        </a>
                        <a href="<?php the_field('field_5c6325e38e0aa') ?>" class="hidden sm:block lg:hidden">
                            <img src="<?php echo the_field('field_60011a7d053b8') ?>" class="w-full h-auto">
                        </a>
                        <a href="<?php the_field('field_5c6325e38e0aa') ?>" class="block sm:hidden">
                            <img src="<?php echo the_field('field_5f0d5b0270f63') ?>" class="w-full h-auto">
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="container mx-auto">
        <p class="text-xs text-gray-300">Werbung</p>
        <div class="flex flex-col lg:flex-row p-5 border">
            <?php if ($query_banner->have_posts()): ?>
                <?php while ($query_banner->have_posts()): ?>
                    <?php $query_banner->the_post(); ?>
                    <div class="w-full">
                        <a href="<?php the_field('field_5c6325e38e0aa') ?>" class="hidden lg:block">
                            <img src="<?php echo the_field('field_60011a6a053b7') ?>" class="w-full h-auto">
                        </a>
                        <a href="<?php the_field('field_5c6325e38e0aa') ?>" class="hidden sm:block lg:hidden">
                            <img src="<?php echo the_field('field_60011a7d053b8') ?>" class="w-full h-auto">
                        </a>
                        <a href="<?php the_field('field_5c6325e38e0aa') ?>" class="block sm:hidden">
                            <img src="<?php echo the_field('field_5f0d5b0270f63') ?>" class="w-full h-auto">
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>