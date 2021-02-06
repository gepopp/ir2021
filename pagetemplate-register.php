<?php
/**
 * Template Name: resgistration page
 */
get_header();

if (isset($_GET['token'])) {
    \immobilien_redaktion_2020\activate_user(sanitize_text_field($_GET['token']));;
}

global $FormSession;

?>
    <div class="container mx-auto relative px-5 md:px-0 flex justify-center pt-64">
        <div class="h-auto" x-data="loginForm(login_data, errorbag, successMessage)">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <?php get_template_part('page-templates/register', 'form') ?>
                <div>
                    <h1 class="text-2xl font-serif mb-5"><?php the_title(); ?></h1>
                    <p class="px-5 mb-10"><?php the_content(); ?></p>

                </div>
            </div>
        </div>
    </div>

<?php
get_footer();