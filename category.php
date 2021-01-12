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


    <div class="container mx-auto mt-20 px-5 lg:px-0 relative">

        <?php get_template_part('banner-templates/banner', 'mega') ?>

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

    <div class="container mx-auto mt-20 px-5 md:px-5">
        <?php if (have_posts()): ?>
            <div class="grid grid-cols-2 gap-10">
                <?php while (have_posts()): ?>
                    <?php the_post(); ?>
                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary-100 h-full" style="padding-top: 56%">
                            <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full', 'onerror' => "this.style.display='none'", 'style' => "margin-top:-56%"]); ?>
                            <h1 class="md:absolute bottom-0 left-0 text-white font-serif p-5 text-xl  md:text-2xl leading-tight"><?php the_title() ?></h1>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>


    <div class="container mx-auto mt-10 px-5 md:px-5" x-data="loadMore(<?php echo $term->term_id ?>)">
        <div class="grid grid-cols-2 gap-10">
            <template x-for="post in loaded">

                <div class="col-span-2 md:col-span-1 relative">
                    <a :href="post.permalink" class="relative block bg-primary-100 h-full" style="padding-top: 56%">
                        <img :src="post.img_url" class="w-full h-auto max-w-full" onerror="this.style.display='none';" style="margin-top: -56%;">
                        <h1 class="md:absolute bottom-0 left-0 text-white font-serif p-5 text-xl  md:text-2xl leading-tight" x-text="post.title"></h1>
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
