<?php

use Overtrue\Socialite\SocialiteManager;

global $FormSession;
?>

<form class="mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
    <?php $FormSession->flashSuccess('token_success') ?>
    <?php $FormSession->flashErrorBag('token_expired') ?>

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
    <div class="mb-2">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Passwort
            <a class="inline align-baseline text-xs underline text-blue-500 hover:text-blue-800" href="<?php the_field('field_601e59c9336d7', 'option') ?>">
                ( vergessen? )
            </a>
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
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
        <button class="w-full bg-primary-100 text-center text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                :class="{' cursor-not-allowed ': !completed }"
                type="submit"
                :disabled="!completed">
            einloggen
        </button>
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
<div class="py-2">
    <p class="font-medium">Noch keinen Account?</p>
    <p><a href="<?php echo get_field('field_601bc00528968', 'option') ?>" class="text-primary-100 underline">Hier registrieren</a></p>
</div>