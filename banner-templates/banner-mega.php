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
<div class="container mx-auto mt-20 lg:hidden mb-12">
    <p class="text-xs text-gray-300">Werbung</p>
    <div class="flex flex-col lg:flex-row p-5 border">
        <?php if ($query_banner->have_posts()): ?>
            <?php while ($query_banner->have_posts()): ?>
                <?php
                    $query_banner->the_post();
                    $thumb  =   get_the_post_thumbnail_url();
                    $link   =   get_field('field_5c6325e38e0aa');
                ?>
                <?php if(get_field('field_5c6325e38e0aa') != ''): ?>
                <div class="w-full">
                    <a href="<?php the_field('field_5c6325e38e0aa') ?>">
                        <img src="<?php echo the_field('field_5f0d5b0270f63'); ?>" class="w-full h-auto">
                    </a>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php if( isset( $link )): ?>
<div class="absolute top-0 right-0 hidden lg:block" style="margin-top: -18px; left: 100%; margin-left:15px;width: 120px">
    <p class="text-xs text-gray-300">Werbung</p>
    <div class="flex flex-col lg:flex-row p-5 border">
        <div class="w-full">
            <a href="<?php echo $link ?>">
                <img src="<?php echo $thumb ?>" class="w-full h-auto">
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>