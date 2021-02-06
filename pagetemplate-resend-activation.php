<?php
/**
 * Template Name: Aktivierungslink senden
 */
get_header();
the_post();

global $FormSession;
?>

    <div class="container mx-auto mt-20 relative">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6">
                <h1 class="text-2xl font-serif font-semibold mb-5">E-Mail Adresse aktivieren</h1>
                <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
                    <?php $FormSession->flashErrorBag('resend_activation'); ?>
                    <?php $FormSession->flashSuccess('resend_activation'); ?>
                    <?php wp_nonce_field('resend_activation', 'resend_activation') ?>
                    <input type="hidden" name="action" value="resend_activation">
                    <input type="hidden" name="redirect" value="<?php echo $_GET['redirect'] ?? '' ?>">
                    <input type="hidden" name="function" value="<?php echo $_GET['function'] ?? '' ?>">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            E-Mail Adresse
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="email"
                               type="email"
                               name="email"
                               placeholder="E-Mail Adresse"
                               required="required">
                    </div>
                    <p class="text-sm">Bitte geben Sie die E-Mail Adresse ein mit der Sie sich registriert haben. Wir senden Ihnen einen neuen Link zum aktivieren Ihres Accounts.</p>
                    <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-5"
                            type="submit">
                        Link senden
                    </button>
                </form>
            </div>
        </div>
    </div>

<?php get_footer();
