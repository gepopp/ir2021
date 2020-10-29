<?php get_header(); ?>


    <div class="container mx-auto mt-32">
        <h1 class="font-sans text-5xl uppercase font-semibold text-gray-800 text-center">lesen</h1>
    </div>


    <div class="container mx-auto mt-32">
        <div class="flex items-end">
            <div class="w-full lg:w-1/2 bg-inland-100">
                <p class="text-white font-serif text-5xl py-24 px-5 text-center">Inland</p>
            </div>
            <div class="w-full lg:w-1/2 bg-gray-900 text-white -ml-5 -mb-5 p-5 pr-16 relative">
                <div class="flex">
                    Die Immobilienmarktentwicklung in Österreich ist durch eine deutliche Veränderung in den Ansprüchen an Immobilien gekennzeichnet. Das betrifft alle Formen von Immobilien, Gewerbeimmobilien wie Büros, Einkaufsflächen oder Logistikflächen, ebenso wie Hotels oder den Wohnbereich.
                </
                >
            </div>
            <div class="absolute top-0 right-0 -mr-5 -mt-5 bg-white rounded-full w-24 h-24 flex flex-col items-center justify-center">
                <p class="text-xs text-gray-900">powered by</p>
                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo_oerag_immobilien.svg" class="w-24 h-auto px-5">
            </div>
        </div>
    </div>
    </div>

<?php //get_template_part('banner-templates/banner', 'thirds') ?>

    <div class="container mx-auto mt-32">
        <?php if (have_posts()): ?>
            <div class="grid grid-cols-2 gap-10">
                <?php while (have_posts()): ?>
                    <?php the_post(); ?>


                    <div class="col-span-2 md:col-span-1 relative">
                        <a href="<?php the_permalink(); ?>" class="relative block bg-primary bg-gray-900 h-full">

                            <?php if (!has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article'))): ?>
                                <div class="bg-primary-100 w-full h-full pt-75p"></div>
                            <?php else: ?>
                                <?php the_post_thumbnail('article', ['class' => 'w-full h-auto max-w-full']); ?>
                            <?php endif; ?>
                            <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-25"></div>
                            <div class="absolute bottom-0 left-0 m-5">
                                <h1 class="font-serif text-white text-2xl"><?php the_title() ?></h1>
                                <p class="text-white text-sm">Geschireben von <?php the_author() ?> | Lesezeit 3 Minuten</p>
                            </div>
                        </a>
                    </div>


                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer();
