<?php
use Overtrue\Socialite\SocialiteManager;
?>

<form class="mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
    <div class="text-warning p-5 text-white flex space-x-3 items-center" x-show="error.global">
        <div>
            <div class="rounded-full bg-warning bg-opacity-25 w-20 h-20 flex items-center justify-center">
                <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <p x-html="Object.values(error.global)[0]" class="text-warning text-sm"></p>
    </div>
    <div class="tebg-success p-5 text-white flex space-x-3 items-center" x-show="successMessage">
        <div>
            <div class="rounded-full bg-success bg-opacity-25 w-20 h-20 flex items-center justify-center">
                <svg class="h-16 w-16 text-white animate-ping" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p x-html="successMessage" class="text-success text-sm"></p>
    </div>
    <?php wp_nonce_field('frontend_login', 'frontend_login') ?>
    <input type="hidden" name="action" value="frontend_login">
    <input type="hidden" name="redirect" value="<?php echo sanitize_text_field($_GET['redirect'] ?? '') ?>">
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
               @keyup.debounce.500ms="ValidateEmail()"
               autocomplete="email">
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
               placeholder="******************"
               autocomplete="current-password">
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
</form>
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
<div class="bg-white">
    <hr class="my-4">
    <div class="my-5 w-full">
        <a href="<?php echo $socialite->create('facebook')->redirect(); ?>"
           class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full text-center block"
        >
            Mit Facebook einloggen
        </a>
    </div>
</div>