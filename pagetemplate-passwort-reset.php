<?php
/**
 * Template Name: Passwort reset
 */
get_header();
the_post();

$user = false;

if (isset($_GET['token'])) {
    global $wpdb;
    $user = get_user_by('email', $wpdb->get_var('SELECT email FROM wp_user_activation_token WHERE token = "' . sanitize_text_field($_GET['token']) . '"'));
}
?>

    <div class="container mx-auto mt-20 relative">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6">
                <h1 class="text-2xl font-serif font-semibold mb-5">Neues Passwort setzten</h1>
                <?php if (!$user): ?>
                    <div class="text-warning p-5 text-white flex space-x-3 items-center">
                        <div>
                            <div class="rounded-full bg-warning bg-opacity-25 w-10 h-10 flex items-center justify-center">
                                <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-warning text-sm">
                            Der Link den Sie verwendet haben ist nicht mehr gültig! Hier können Sie einen neuen
                            <a class="font-semibold underline" href="<?php echo home_url('passwort-vergessen') ?>">Link anfordern</a>!
                        </p>
                    </div>
                <?php else: ?>
                    <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
                        <?php if (isset($_SESSION['password_error'])): ?>
                            <div class="text-warning p-5 text-white flex space-x-3 items-center">
                                <div>
                                    <div class="rounded-full bg-warning bg-opacity-25 w-10 h-10 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-warning text-sm">
                                    <?php echo $_SESSION['password_error'];
                                    unset($_SESSION['password_error']); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php wp_nonce_field('set_password', 'set_password') ?>
                        <input type="hidden" name="action" value="new_password">
                        <input type="hidden" name="redirect" value="<?php echo $_GET['redirect'] ?? '' ?>">
                        <input type="hidden" name="token" value="<?php echo $_GET['token'] ?? '' ?>">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="pw">
                                Neues Passwort
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   id="pw"
                                   type="password"
                                   name="pw"
                                   minlength="8"
                                   required="required"
                                   placeholder="*************************">
                        </div>
                        <p class="text-sm">Bitte geben Sie Ihr neues Passwort ein, es muss mindestens 8 Zeichen lang sein.</p>
                        <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-5"
                                type="submit">
                            Passwort setzten
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php get_footer();
