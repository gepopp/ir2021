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
    <div class=" w-full lg:w-1/3 h-auto" x-data="loginForm(login_data, errorbag, successMessage)">
        <h1 class="text-2xl text-center font-serif mb-5">Willkommen!</h1>
        <p class="px-5 mb-10">Registrieren Sie sich hier und nutzen Sie alle Funktionen der Immobilien Redaktion für noch mehr Lesevergnügen.</p>
        <?php get_template_part('page-templates/register', 'form') ?>
    </div>
</div>

<?php
get_footer();