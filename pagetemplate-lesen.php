<?php
/**
 * Template Name: Lesen
 */
get_header();
?>


    <div class="container mx-auto mt-20 relative">
        <h1 class="font-sans text-5xl uppercase font-semibold text-gray-800 text-center">lesen</h1>
    </div>

<?php get_template_part('banner-templates/banner', 'mega') ?>


<?php
$today = date('Ymd');
$banner_large = get_posts([
    'post_type'      => 'ir_ad',
    'posts_per_page' => 1,
    'tax_query'      => [
        'relation' => 'and',
        [
            'taxonomy'         => 'position',
            'terms'            => 'startseite-horizontal',
            'field'            => 'slug',
            'meta_query'       => [
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
            'include_children' => false,
            'operator'         => 'IN',
        ],
        'orderby'  => 'menu_order',
        'order'    => 'ASC',
    ],
]);
?>


    </div>


<?php
$query = new \WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 2,
    'category__not_in'    => [17, 696, 159, 996],
    'tag__not_in'         => 989,
]);
?>
    <div class="container mx-auto mt-20 px-5 lg:px-0 relative">


        <div class="grid grid-cols-2 gap-10">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): ?>
                    <?php $query->the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full image-holder">
                            <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full', 'onerror' => "this.style.display='none'"]); ?>
                            <?php get_template_part('page-templates/snippet', 'heading') ?>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    </div>




<?php $cats = get_categories(['exclude' => [1, 17, 996], 'parent' => 0]) ?>

<?php
$catrunner = 1;
foreach ($cats as $cat):
    ?>

    <?php if ($catrunner == 3): ?>
    <!--    --><?php //get_template_part('banner-templates/banner', 'thirds2') ?>
<?php endif; ?>

    <div class="container mx-auto mt-20 px-5 lg:px-0">
        <?php $color = get_field('field_5c63ff4b7a5fb', $cat) ?>
        <a href="<?php echo get_category_link($cat) ?>" class="text-2xl font-bold hover:underline mb-3"
           style="background: linear-gradient(0deg, <?php echo $color ?> 0%, <?php echo $color ?> 50%, transparent 50%, transparent 100%);">

            <?php echo $cat->name ?>
        </a>
        <div class="grid grid-cols-4 lg:grid-cols-5 gap-4">
            <?php
            $query = new WP_Query([
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 5,
                'category__in'   => [$cat->term_id],
            ]);
            if ($query->have_posts()):
                $runner = 1;
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="<?php if ($runner != 5): ?>col-span-2 <?php else: ?>col-span-4 <?php endif; ?>lg:col-span-1">
                        <div class="relative">

                            <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full image-holder">
                                <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full']); ?>
                            </a>
                            <?php if ($runner == 5): ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-white bg-opacity-75 flex justify-center items-center">
                                    <p class="font-bold text-xs">
                                        <a href="<?php echo get_category_link($cat) ?>" class="underline">
                                            <?php echo $cat->count - 4 ?> weitere Artikel</p>
                                    </a>
                                </div>
                                <?php if (get_field('field_5f9aeff4efa16', $cat)): ?>
                                    <div class="absolute top-0 right-0 -mr-5 -mt-5 bg-white rounded-full w-24 h-24 flex flex-col items-center justify-center shadow-lg">
                                        <a href="<?php echo get_field('field_5f9aeff4efa16', $cat) ?>" class="text-center">
                                            <p class="text-xs text-gray-900">powered by</p>
                                            <img src="<?php echo get_field('field_5f9aefd116e2e', $cat) ?>" class="w-24 h-auto px-5">
                                        </a>
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div>
                        <?php if ($runner != 5): ?>
                            <p class="mt-5 font-semibold text-xs pb-5">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title() ?>
                                </a>
                            </p>
                        <?php endif; ?>

                    </div>
                    <?php
                    $runner++;
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
    $catrunner++;
endforeach;
?>


<?php get_footer();
