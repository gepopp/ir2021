<?php

/**
 * Template Name: Sehen
 *
 */
get_header();
?>


    <div class="bg-gray-900">


        <div class="container mx-auto mt-32 relative">
            <h1 class="font-sans text-5xl uppercase font-semibold text-white text-center">sehen</h1>
        </div>


    </div>


<?php
$headvideo = get_posts([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 1,
    'category__in'        => [17],
]);
?>
    <div class="container mx-auto mt-32 px-5 lg:px-0 relative">

        <?php if (get_field('field_5c65130772844', $headvideo[0]->ID)): ?>
            <div id="headvideo"></div>
            <script>
                var player = jwplayer('headvideo');
                player.setup({
                    playlist: "https://cdn.jwplayer.com/v2/media/" + '<?php echo get_field("field_5c65130772844", $headvideo[0]->ID) ?>'
                });
            </script>
        <?php elseif (get_field('field_5f96fa1673bac', $headvideo[0]->ID)): ?>
            <iframe class="has-ratio" width="100%" height="455" src="https://www.youtube.com/embed/<?php echo get_field('field_5f96fa1673bac')  ?>"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        <?php endif; ?>








        <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 p-10 flex flex-col justify-between" style="box-shadow: inset 0 0 5em 1em #1a202c;">
            <h1 class="text-3xl text-white"><?php echo get_the_title($headvideo[0]->ID) ?></h1>
            <div class="inline flex justify-between">
                <a href="<?php echo get_the_permalink($headvideo[0]->ID) ?>" class="bg-white text-gray-900 text-2xl px-3 py-2 rounded shadow-lg flex items-center ">
                    <div class="rounded-full bg-white w-24 h-24 m-5 flex items-center justify-center">
                        <div class="w-12 h-12 animate-ping bg-white rounded-full">
                            <svg class="w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    Jetzt ansehen
                </a>
                <p class="text-2xl text-white flex items-center"><?php echo get_field('field_5a3ce915590ae', $headvideo[0]->ID) ?> | <?php echo get_the_time('d.m.Y', $headvideo[0]->ID) ?></p>
            </div>

        </div>
    </div>



<?php
$query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 6,
    'category__in'        => [17],
]);
?>

    <div class="container mx-auto mt-32 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold mb-10 text-white">Meist gesehen</a>
        <div class="grid grid-cols-6 gap-4">
            <?php
            if ($query->have_posts()):
                $runner = 1;
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="col-span-2 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (get_field('field_5c65130772844')): ?>
                                    <img src="https://cdn.jwplayer.com/v2/media/<?php echo get_field('field_5c65130772844') ?>/poster.jpg"/>
                                <?php elseif (get_field('field_5f96fa1673bac')): ?>
                                    <img src="https://img.youtube.com/vi/<?php echo get_field('field_5f96fa1673bac') ?>/mqdefault.jpg"/>
                                <?php endif; ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <div class="w-4 h-4  bg-white rounded-full">
                                        <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5 text-white">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </p>

                    </div>
                    <?php
                    $runner++;
                endwhile;
            endif;
            ?>
        </div>
    </div>
<?php wp_reset_postdata(); ?>

<?php
$query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 6,
    'category__in'        => [17],
]);
?>


    <div class="container mx-auto mt-32 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold mb-10 text-white">Neueste Videos</a>
        <div class="grid grid-cols-6 gap-4">
            <?php
            if ($query->have_posts()):
                $runner = 1;
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="col-span-2 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (get_field('field_5c65130772844')): ?>
                                    <img src="https://cdn.jwplayer.com/v2/media/<?php echo get_field('field_5c65130772844') ?>/poster.jpg"/>
                                <?php elseif (get_field('field_5f96fa1673bac')): ?>
                                    <img src="https://img.youtube.com/vi/<?php echo get_field('field_5f96fa1673bac') ?>/mqdefault.jpg"/>
                                <?php endif; ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <div class="w-4 h-4 bg-white rounded-full">
                                        <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5 text-white">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </p>

                    </div>
                    <?php
                    $runner++;
                endwhile;
            endif;
            ?>
        </div>
    </div>

<?php wp_reset_postdata(); ?>

<?php
$query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 6,
    'category__in'        => [17],
]);
?>


    <div class="container mx-auto mt-32 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold mb-10 text-white">Walter's Mails</a>
        <div class="grid grid-cols-6 gap-4">
            <?php
            if ($query->have_posts()):
                $runner = 1;
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="col-span-2 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (get_field('field_5c65130772844')): ?>
                                    <img src="https://cdn.jwplayer.com/v2/media/<?php echo get_field('field_5c65130772844') ?>/poster.jpg"/>
                                <?php elseif (get_field('field_5f96fa1673bac')): ?>
                                    <img src="https://img.youtube.com/vi/<?php echo get_field('field_5f96fa1673bac') ?>/mqdefault.jpg"/>
                                <?php endif; ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <div class="w-4 h-4 bg-white rounded-full">
                                        <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5 text-white">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </p>

                    </div>
                    <?php
                    $runner++;
                endwhile;
            endif;
            ?>
        </div>
    </div>

<?php wp_reset_postdata(); ?>

<?php
$query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 6,
    'category__in'        => [17],
]);
?>

    <div class="container mx-auto mt-32 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold mb-10 text-white">Walter's Interviews</a>
        <div class="grid grid-cols-6 gap-4">
            <?php
            if ($query->have_posts()):
                $runner = 1;
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="col-span-2 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (get_field('field_5c65130772844')): ?>
                                    <img src="https://cdn.jwplayer.com/v2/media/<?php echo get_field('field_5c65130772844') ?>/poster.jpg"/>
                                <?php elseif (get_field('field_5f96fa1673bac')): ?>
                                    <img src="https://img.youtube.com/vi/<?php echo get_field('field_5f96fa1673bac') ?>/mqdefault.jpg"/>
                                <?php endif; ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <div class="w-4 h-4 bg-white rounded-full">
                                        <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5 text-white">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </p>

                    </div>
                    <?php
                    $runner++;
                endwhile;
            endif;
            ?>
        </div>
    </div>

<?php wp_reset_postdata(); ?>

<?php
$query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 6,
    'category__in'        => [17],
]);
?>

    <div class="container mx-auto mt-32 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold mb-10 text-white">Walter's Reality</a>
        <div class="grid grid-cols-6 gap-4">
            <?php
            if ($query->have_posts()):
                $runner = 1;
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="col-span-2 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (get_field('field_5c65130772844')): ?>
                                    <img src="https://cdn.jwplayer.com/v2/media/<?php echo get_field('field_5c65130772844') ?>/poster.jpg"/>
                                <?php elseif (get_field('field_5f96fa1673bac')): ?>
                                    <img src="https://img.youtube.com/vi/<?php echo get_field('field_5f96fa1673bac') ?>/mqdefault.jpg"/>
                                <?php endif; ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                    <div class="w-4 h-4 bg-white rounded-full">
                                        <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="mt-5 font-semibold text-xs pb-5 text-white">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title() ?>
                            </a>
                        </p>

                    </div>
                    <?php
                    $runner++;
                endwhile;
            endif;
            ?>
        </div>
    </div>


<?php
get_footer();