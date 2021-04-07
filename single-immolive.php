<?php
get_header();

the_post();

$event_start = get_field('field_5ed527e9c2279', get_the_ID(), true);
$parsed = \Carbon\Carbon::parse($event_start);
echo $parsed->format('H:i');

echo '<div class=mt-48></div>';

echo var_dump($event_start);
?>

    <div class="container mx-auto mt-20">
        <div class="border-15 border-primary-100">
            <?php the_post_thumbnail('full'); ?>
        </div>
    </div>




    <div class="container mx-auto mt-32">
        <div class="grid grid-cols-1 lg:grid-cols-5 min-h-screen gap-10">
            <main class="lg:col-span-3 px-5 xl:px-0">
                <h1 class="text-3xl lg:text-5xl font-serif leading-none mb-10"><?php the_title() ?></h1>
                <div><?php the_content(); ?></div>
            </main>
            <aside class="lg:col-span-2 px-5 xl:px-0" x-data="counter('<?php the_field('field_5ed527e9c2279') ?>')" x-init="count()">
                <div class="bg-white p-5 xl:p-10 shadow-xl">
                    <div class="w-full">
                        <?php get_template_part('page-templates/immolive', 'counter') ?>
                    </div>

                    <?php
                    if (is_user_logged_in()):
                        $user = wp_get_current_user();
                        ?>

                        <h2 class="text-2xl font-serif text-center mt-10"><?php echo $user->user_firstname . ' ' . $user->last_name ?>, sind Sie dabei?</h2>


                        <div x-data="{ loading : false, showSubscribe : true }">

                            <form class="xl:p-10 relative" x-show.transition.fade="showSubscribe">
                                <div class="absolute top-0 left-0 w-full h-full bg-gray-300 bg-opacity-50 flex justify-center items-center" x-show="loading">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25 text-gray-800" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register_email">
                                        Ihre Frage an unser Podium
                                    </label>
                                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                              placeholder="Stellen Sie Ihre Frage an unsere Immobilien Experten"
                                              rows="10"
                                    ></textarea>
                                    <!--                                    <p x-show="false" x-text="regsiter_errors.email" class="text-warning text-xs"></p>-->
                                </div>
                                <div class="md:flex md:items-center mb-6">
                                    <label class="block text-gray-500 font-bold">
                                        <input class="mr-2 leading-tight bg-primary-100" type="checkbox" name="agb" required>
                                        <span class="text-sm">Ich bin mit der Datenschutzerklärung der unabhängigen Immobilien Redaktion einverstanden. <span class="text-warning">*</span></span>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full text-center"
                                            type="submit">
                                        jetzt anmelden
                                    </button>
                                </div>
                            </form>
                        </div>
                    <?php else: ?>
                        <h2 class="text-2xl font-serif text-center mt-10">Sind Sie dabei?</h2>
                        <p>Wir übertragen dieses Diskussion live via Zoom, damit Sie mit unserem Podium diskutieren können, melden Sie sich jetzt kostenlos an.</p>
                        <p class="text-center py-5 font-semibold">Zur Anemldung jetzt</p>
                        <a href="<?php echo add_query_arg(['redirect' => urlencode(get_permalink())], get_field('field_6013cf1ad4688', 'option')) ?>"
                           class="block bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full text-center cursor-pointer">
                            einloggen
                        </a>
                        <p class="text-center py-5 font-semibold">oder</p>
                        <a href="<?php echo add_query_arg(['redirect' => urlencode(get_permalink())], get_field('field_6013cf36d4689', 'option')) ?>"
                           class="block bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full text-center">
                            registrieren
                        </a>
                    <?php endif; ?>
        </div>
        </aside>
    </div>
    </div>

<?php
get_footer();