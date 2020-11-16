<?php
/**
 * Template Name: Login Register
 */

use Overtrue\Socialite\SocialiteManager;

get_header();

$token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : false;
$active = false;

if ($token) {

    global $wpdb;
    $email = $wpdb->get_var('SELECT email FROM wp_user_activation_token WHERE token = "' . $token . '"');
    $token_user = get_user_by('email', $email);

    if (!empty($token_user)) {
        if (!in_array('subscriber', $token_user->roles)) {
            $token_user->add_role('subscriber');
            $token_user->remove_role('registered');
        }
        $active = true;
    }
}

?>
    <script>
        var error_global = '<?php echo isset($_SESSION['login_error']) ? addslashes(($_SESSION['login_error'])) : ''; unset($_SESSION['login_error']) ?>';
    </script>
    <div class="container mx-auto mt-20 relative">
        <?php if ($token && !empty($token_user)): ?>
            <?php if (!$token_user): ?>
                <div class="text-warning p-5 text-white flex space-x-3 items-center">
                    <div>
                        <div class="rounded-full bg-warning bg-opacity-25 w-20 h-20 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-warning text-sm">
                        Wir konnten diesen Link nicht validieren, bitte versuchen Sie es noch einmal.
                    </p>
                </div>
            <?php elseif ($active): ?>
                <div class="text-warning p-5 text-white flex space-x-3 items-center">
                    <div>
                        <div class="rounded-full bg-success bg-opacity-25 w-20 h-20 flex items-center justify-center">
                            <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-success text-sm">
                        Vielen Dank, Ihre E-Mail Adresse ist bestätigt. Sie können sich jetzt einloggen!
                    </p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['new_password'])): ?>
            <div class="text-success p-5 text-white flex space-x-3 items-center">
                <div>
                    <div class="rounded-full bg-success bg-opacity-25 w-20 h-20 flex items-center justify-center">
                        <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-success text-sm">
                    Ihr neues Passwort wurde gesetzt. Sie können sich jetzt einloggen!
                </p>
            </div>
        <?php endif;
        unset($_SESSION['new_password']) ?>

        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6 lg:col-span-3" x-data="loginForm('<?php echo $_SESSION['email'] ?? '';
            unset($_SESSION['email']) ?>', error_global )">
                <h1 class="text-2xl font-serif font-semibold mb-5">Login</h1>
                <div class="w-full">
                    <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
                        <div class="text-warning p-5 text-white flex space-x-3 items-center" x-show="error.global">
                            <div>
                                <div class="rounded-full bg-warning bg-opacity-25 w-20 h-20 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <p x-html="error.global" class="text-warning text-sm"></p>
                        </div>
                        <?php wp_nonce_field('frontend_login', 'frontend_login') ?>
                        <input type="hidden" name="action" value="frontend_login">
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
                                   x-model="email"
                                   @keyup.debounce.500ms="ValidateEmail()">
                            <p x-show="error.email" x-text="error.email" class="text-warning text-xs"></p>

                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                Passwort
                            </label>
                            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                   id="password"
                                   type="password"
                                   name="password"
                                   x-model="password"
                                   @keyup.debounce.500ms="checkCompleted()"
                                   placeholder="******************">
                            <p x-show="error.password" x-text="error.password" class="text-warning text-xs"></p>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <label class="block text-gray-500 font-bold">
                                <input class="mr-2 leading-tight bg-primary-100" type="checkbox" name="remember">
                                <span class="text-sm">Login merken</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    :class="{' cursor-not-allowed ': !completed }"
                                    type="submit"
                                    :disabled="!completed">
                                einloggen
                            </button>
                            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="<?php echo home_url('passwort-vergessen') ?>">
                                Passwort vergessen?
                            </a>
                        </div>
                        <?php
                        $config = [
                            'facebook' => [
                                'client_id'     => '831950683917414',
                                'client_secret' => 'd6d52d59ce1f1efdbf997b980dffe229',
                                'redirect'      => home_url('fb-login'),
                            ],
                        ];

                        $socialite = new SocialiteManager($config);
                        ?>

                        <hr class="my-4">
                        <div class="my-5 w-full">
                            <a href="<?php echo $socialite->create('facebook')->redirect(); ?>"
                               class="bg-primary-100 py-2 px-3 text-white w-full text-center block"
                            >
                                Mit Facebook einloggen
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3">
                <?php get_template_part('page-templates/register') ?>
            </div>
        </div>
    </div>
<?php
get_footer();

