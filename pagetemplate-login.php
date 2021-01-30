<?php
/**
 * Template Name: Loginpage
 */
get_header();

if (isset($_GET['token'])) {
    \immobilien_redaktion_2020\activate_user(sanitize_text_field($_GET['token']));;
}

global $FormSession;

?>
    <script>
        var login_data = <?php echo json_encode($FormSession->getFormData()) ?>;
        var errorbag = <?php echo json_encode($FormSession->get('errorBag')) ?>;
        var successMessage = <?php echo  "'" . $FormSession->get('token_success') . "'" ?>;
    </script>
    <div class="container mx-auto relative px-5 md:px-0 flex justify-center pt-32">
        <div class=" w-full lg:w-1/3 h-auto" x-data="loginForm(login_data, errorbag, successMessage)">
            <h1 class="text-2xl text-center font-serif mb-5">Willkommen zurück!</h1>
            <p class="px-5 mb-10">Bitte loggen Sie sich hier ihrer der E-Mail Adresse und ihrem Passwort ein.</p>
            <div class="bg-white p-5 shadow-xl">
                <?php get_template_part('page-templates/login', 'form') ?>
            </div>
        </div>
    </div>
<?php
get_footer();
