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
            <div class="video-container" style="
                            position: relative;
                            width: 100%;
                            padding-bottom: 56.25%;
                            ">
                <iframe src="https://www.youtube.com/embed/<?php echo get_field('field_5f96fa1673bac', $headvideo[0]->ID) ?>?autoplay=1&mute=1"
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen style="
position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
"></iframe>
            </div>
        <?php endif; ?>


        <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 p-10 flex flex-col justify-between hidden lg:flex" style="box-shadow: inset 0 0 5em 1em #1a202c;">
            <h1 class="text-3xl text-white hidden lg:block"><?php echo get_the_title($headvideo[0]->ID) ?></h1>
            <div class="inline flex justify-between ">
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
        <h1 class="lg:hidden text-white text-xl"><?php echo get_the_title($headvideo[0]->ID) ?></h1>
    </div>


<?php
$query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page'      => 6,
    'category__in'        => [17],
    'meta_key'            => 'analytics_views',
    'orderby'             => 'meta_value_num',
    'order'               => 'DESC',
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
                    <div class="col-span-3 lg:col-span-1">
                        <div class="relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (get_field('field_5c65130772844')): ?>
                                    <img src="https://cdn.jwplayer.com/v2/media/<?php echo get_field('field_5c65130772844') ?>/poster.jpg"/>
                                <?php elseif (get_field('field_5f96fa1673bac')): ?>
                                    <img src="https://img.youtube.com/vi/<?php echo get_field('field_5f96fa1673bac') ?>/mqdefault.jpg"/>
                                <?php endif; ?>
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex flex-col justify-center items-center">
                                    <div class="w-4 h-4  bg-white rounded-full">
                                        <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-white"><?php the_field('field_5f9ff32f68d04') ?></p>
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
                    <div class="col-span-3 lg:col-span-1">
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
$cats = get_categories(['child_of' => 17]);

foreach ($cats as $cat): ?>

    <?php
    $query = new WP_Query([
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => 6,
        'category__in'        => [$cat->term_id],
    ]);
    ?>
    <?php

    $pages = (int)$query->max_num_pages;


    $posts = [];

    if ($query->have_posts()):
        $runner = 1;
        while ($query->have_posts()):
            $query->the_post();

            if (get_field('field_5c65130772844')):
                $url = "https://cdn.jwplayer.com/v2/media/" . get_field('field_5c65130772844') . "/poster.jpg";
            elseif (get_field('field_5f96fa1673bac')):
                $url = "https://img.youtube.com/vi/" . get_field('field_5f96fa1673bac') . "/mqdefault.jpg";
            else:
                $url = false;
            endif;


            $posts[] = [
                'ID'        => get_the_ID(),
                'permalink' => get_the_permalink(),
                'title'     => get_the_title(),
                'img'       => $url,
            ];


            $runner++;
        endwhile;
    endif;
    ?>
    <?php wp_reset_postdata(); ?>


    <div class="container mx-auto mt-32 px-5 lg:px-0">
        <a href="#" class="text-xl font-bold text-white"><?php echo $cat->name ?></a>


        <div x-data="slider(<?php echo str_replace('"', "'", json_encode($posts)) ?>, <?php echo $cat->term_id ?>, <?php echo $query->max_num_pages ?> )"
             x-init="
                load();

$watch('active', (value) => {

    if(value + 1 == rows.length) load();

  })

                "
             class="relative">
            <div class="snap overflow-auto relative flex-no-wrap flex transition-all"
                 x-ref="slider"
                 x-on:scroll.debounce="active = Math.round($event.target.scrollLeft / ($event.target.scrollWidth / rows.length))">
                <template x-for="row in rows">
                    <div class="w-full flex-shrink-0 text-white flex items-center justify-center">
                        <div class="grid grid-cols-6 gap-4">
                            <template x-for="post in row">
                                <div class="col-span-3 lg:col-span-1">
                                    <div class="relative">
                                        <a :href="post.permalink">
                                            <div class="w-full bg-cover" :style="'padding-top: 56.25%; background-image: url(' + post.img + ')'"></div>
                                            <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                                <div class="w-4 h-4 bg-white rounded-full">
                                                    <svg class="w-4 h-4 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <p class="mt-5 font-semibold text-xs text-white h-24">
                                        <a :href="post.permalink" x-text="post.title"></a>
                                    </p>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
            <div class="flex items-center justify-between flex-1 absolute top-0 w-full h-full" style="pointer-events: none">
                <button class="outline-none focus:outline-none rounded-full mx-4 text-white w-8"
                        :class="{'cursor-not-allowed' : loading || active <= 0  }"
                        style="pointer-events: auto"
                        x-on:click="prev($refs);">
                    <div class="w-8 h-8 p-2 rounded-full bg-gray-900 flex items-center justify-center">
                        <svg x-show="active > 0 && !loading" class="w-6 h-6 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                        <svg x-show="active <= 0 && !loading" class="w-6 h-6 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <svg x-show="loading" class="w-6 h-6 text-warning inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    </div>
                </button>

                <?php if (get_field('field_5f9aefd116e2e', $cat)): ?>
                    <div class="bg-gray-900 bg-opacity-75 rounded-full w-24 h-24 p-5 flex flex-col items-center justify-center shadow-lg">
                        <a href="<?php echo get_field('field_5f9aeff4efa16', $cat) ?>" class="text-center" style="pointer-events: auto">
                            <p class="text-white" style="font-size: .5rem">powered by</p>
                            <img src="<?php echo get_field('field_5f9aefd116e2e', $cat) ?>" class="w-20 h-auto">
                        </a>
                    </div>
                <?php endif; ?>

                <button class="outline-none focus:outline-none rounded-full mx-4 text-white w-8"
                        :class="{'cursor-not-allowed' : loading || active >= pages }"
                        style="pointer-events: auto"
                        x-on:click="next($refs);">
                    <div class="w-8 h-8 p-2 rounded-full bg-gray-900 flex items-center justify-center">
                        <svg x-show="active < pages && !loading" class="w-6 h-6 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <svg x-show="active >= pages && !loading" class="w-6 h-6 text-white inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <svg x-show="loading" class="w-6 h-6 text-warning inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    </div>
                </button>
            </div>
        </div>
    </div>


<?php endforeach; ?>


<?php
get_footer();