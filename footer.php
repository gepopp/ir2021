<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Freeshifter
 */

namespace immobilien_redaktion_2020;

?>
</main>
<footer class="footer bg-gray-900 text-white mt-32 pt-8 pb-16 lg:mx-0 md:px-5
<?php if(is_page_template('pagetemplate-passwort-vergessen.php')
    || is_page_template('pagetemplate-login-register.php')
    || is_page_template('pagetemplate-passwort-reset.php')
    || is_404()
): ?>
mt-auto
<?php endif; ?>">
    <div class="relative z-10">
        <div class="container mx-auto">
            <div class="lg:flex lg:justify-between">

                <div class="lg:w-1/4 text-center lg:text-left">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo_white.svg">
                </div>


                <div class="lg:w-1/4 text-center lg:text-left pr-5 lg:pr-0">
                    <div class="text-xl text-right">
                        <h3 class="font-serif text-xl text-white">Impressum</h3>
                        <p class="text-sm">
                            Die unabhängige Immobilien-Redaktion<br>
                            Mag. Walter Senk<br>
                            Lindengasse 11/2/17<br>
                            <a href="mailto:office@immobilien-redaktion.at" class="underline">office@immobilien-redaktion.at</a><br>
                            1070 Wien<br>
                            UID 589 44 806<br>
                            <a href="/datenschutz" class="underline">Datenschutzerklärung</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
