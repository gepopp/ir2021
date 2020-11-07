<?php get_header(); ?>

<?php
$term = get_queried_object();


?>


    <div class="container mx-auto mt-20">
        <h1 class="font-sans text-5xl uppercase font-semibold text-gray-800 text-center">
            <a href="/lesen" class="underline">
                lesen
            </a>
        </h1>
    </div>


    <div class="container mx-auto mt-20 px-5 lg:px-0">
        <div class="flex flex-col lg:flex-row items-end">
            <div class="w-full lg:w-1/2" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $term); ?>">
                <p class="text-white font-serif text-5xl py-24 px-5 text-center"><?php echo $term->name ?></p>
            </div>
            <div class="w-full lg:w-1/2 bg-gray-900 text-white -ml-5 -mb-5 pt-12 lg:pt-5 p-5 pr-16 relative">
                <?php echo $term->description ?>
                <?php if (get_field('field_5f9aeff4efa16', $term)): ?>
                    <div class="absolute top-0 right-0 -mr-5 -mt-5 bg-white rounded-full w-24 h-24 flex flex-col items-center justify-center shadow-lg">
                        <a href="<?php echo get_field('field_5f9aeff4efa16', $term) ?>" class="text-center">
                            <p class="text-xs text-gray-900">powered by</p>
                            <img src="<?php echo get_field('field_5f9aefd116e2e', $term) ?>" class="w-24 h-auto px-5">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php //get_template_part('banner-templates/banner', 'thirds') ?>

    <div class="container mx-auto mt-20">
        <?php if (have_posts()): ?>
            <div class="grid grid-cols-2 gap-10">
                <?php while (have_posts()): ?>
                    <?php the_post(); ?>


                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary bg-gray-900 h-full">

                            <?php if (!has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article'))): ?>
                                <div class="bg-primary-100 w-full h-full pt-75p flex items-center justify-center">

                                </div>
                            <?php else: ?>
                                <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full']); ?>
                            <?php endif; ?>
                            <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                                <?php if (!has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article'))): ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/icon.svg" class="w-1/3 h-auto">
                                <?php endif; ?>
                            </div>
                            <div class="absolute bottom-0 left-0 m-5">
                                <h1 class="font-serif text-white text-2xl"><?php the_title() ?></h1>
                                <p class="text-white text-sm">Geschrieben von <?php echo get_the_author_link() ?> am <?php the_time('d.m.Y'); ?></p>
                            </div>
                        </a>
                    </div>


                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>




    <div class="container mx-auto mt-10" x-data="loadMore(<?php echo $term->term_id ?>)">
        <div class="grid grid-cols-2 gap-10">
            <template x-for="post in loaded">
                <div class="col-span-2 md:col-span-1 relative">
                    <a :href="post.permalink" class="relative block bg-primary bg-gray-900 h-full">

                        <div class="bg-primary-100 w-full h-full pt-75p flex items-center justify-center" x-show="!post.img_url"></div>
                        <img :src="post.img_url" class="w-full h-auto">

                        <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25 flex justify-center items-center">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/icon.svg" class="w-1/3 h-auto" x-show="!post.img_url">
                        </div>
                        <div class="absolute bottom-0 left-0 m-5">
                            <h1 class="font-serif text-white text-2xl" x-text="post.title"></h1>
                            <p class="text-white text-sm">Geschrieben von <span x-text="post.author"></span> am <span x-text="post.date"></span></p>
                        </div>
                    </a>
                </div>
            </template>



            <div class="flex items-center justify-center w-full my-32 col-span-2">
                <div class="inline">
                    <div class="py-2 px-3 bg-primary-100 text-white text-xl font-bold cursor-pointer" @click="load(<?php echo $term->term_id ?>)">
                        weitere laden
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php get_footer();
