<?php
/**
 * Template Name: Login Register
 */

use Overtrue\Socialite\SocialiteManager;

get_header();

if (isset($_GET['token'])) {
    \immobilien_redaktion_2020\activate_user(sanitize_text_field($_GET['token']));;
}


?>
    <div class="container mx-auto mt-20 relative">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6 lg:col-span-3">
                <?php get_template_part('page-templates/login') ?>
            </div>
            <div class="col-span-6 lg:col-span-3">
                <?php get_template_part('page-templates/register') ?>
            </div>
        </div>
    </div>
<?php
get_footer();

