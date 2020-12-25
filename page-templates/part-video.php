<?php
$query = new \WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 2,
    'category__in'        => [17],
    'tag__not_in'         => 989,
]);
?>
    <div class="container mx-auto mt-20">
    <div class="grid grid-cols-2 gap-10">
        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): ?>
                <?php $query->the_post(); ?>
                <div class="col-span-2 md:col-span-1 relative">
                    <a href="<?php the_permalink(); ?>" class="relative block bg-primary bg-gray-900">
                        <?php if (get_field('field_5c65130772844')): ?>
                            <img src="https://cdn.jwplayer.com/v2/media/<?php the_field('field_5c65130772844') ?>/poster.jpg" class="w-full h-auto max-w-full">
                        <?php elseif (get_field('field_5f96fa1673bac')): ?>
                            <img src="https://img.youtube.com/vi/<?php the_field('field_5f96fa1673bac') ?>/mqdefault.jpg" class="w-full h-auto max-w-full">
                        <?php  elseif(get_field('field_5fe2884da38a5')): ?>
                            <iframe src="https://player.vimeo.com/video/<?php the_field('field_5fe2884da38a5') ?>" width="100%" height="455" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <script src="https://player.vimeo.com/api/player.js"></script>
                        <?php endif; ?>
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25"></div>
                        <div class="absolute bottom-0 left-0 m-5 hidden lg:block">
                            <h1 class="font-serif text-white text-2xl"><?php the_title() ?></h1>
                        </div>
                        <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                            <div class="rounded-full bg-white w-24 h-24 m-5 flex items-center justify-center">
                                <div class="w-12 h-12 animate-ping bg-white rounded-full">
                                    <svg class="w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
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
<?php wp_reset_postdata(); ?>