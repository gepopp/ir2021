<?php

use Overtrue\Socialite\SocialiteManager;


global $FormSession;
?>

<form class="mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
    <?php $FormSession->flashSuccess('token_success') ?>
    <?php $FormSession->flashErrorBag('login_errror') ?>
    <?php wp_nonce_field('frontend_login', 'frontend_login') ?>
    <input type="hidden" name="action" value="frontend_login">
    <input type="hidden" name="redirect" value="<?php echo sanitize_text_field($_GET['redirect'] ?? '') ?>">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            <?php _e('E-Mail Adresse', 'ir21') ?>
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
            <?php _e('Passwort', 'ir21') ?>
            <a class="inline align-baseline text-xs underline text-blue-500 hover:text-blue-800" href="<?php the_field('field_601e59c9336d7', 'option') ?>">
                <?php _e('( vergessen? )', 'ir21') ?>
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
            <span class="text-sm"><?php _e('Login merken', 'ir21') ?></span>
        </label>
    </div>
    <div class="flex items-center justify-between">
        <button class="w-full bg-primary-100 text-center text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                :class="{' cursor-not-allowed ': !completed }"
                type="submit"
                :disabled="!completed">
            <?php _e('einloggen', 'ir21') ?>
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
    'google'   => [
        'client_id'     => '194317471061-jdtvke2dpcensj3p9ckfq20cbsre23dl.apps.googleusercontent.com',
        'client_secret' => 'O_JXIOXqatwxOMYq45ggJ1tj',
        'redirect'      => trailingslashit(home_url('g-oauth')) . '?h=something',
    ],
    'linkedin'   => [
        'client_id'     => '78q1kul4q95hsh',
        'client_secret' => 'mO7jlH6rG9bahUrX',
        'redirect'      => home_url('l-oauth'),
    ],
];
// 194317471061-jdtvke2dpcensj3p9ckfq20cbsre23dl.apps.googleusercontent.com
// O_JXIOXqatwxOMYq45ggJ1tj

$socialite = new SocialiteManager($config);
?>
<div class="bg-white">
    <hr class="my-4">
    <div class="my-5 w-full">
        <a href="<?php echo $socialite->create('facebook')->withState(urlencode($_GET['redirect'] ?? ''))->redirect(); ?>"
           class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
        >
            <svg version="1.1" id="digital_x5F_marketing" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 128 128" fill="currentColor" class="text-white w-4 mr-3" xml:space="preserve">
                    <path id="icon:4" class="st1" d="M74,35.3v12.5h21.6v23.6H74c0,26.4,0,56.6,0,56.6H50.3c0,0,0-27.5,0-56.6H30.4V47.8h19.9V30.6
		c0-36.2,47.3-30.3,47.3-30.3v22C97.6,22.4,74,19.5,74,35.3z"/>
</svg>
            <span><?php _e('Via Facebook einloggen', 'ir21') ?></span>
        </a>
    </div>
    <div class="my-5 w-full">
        <a href="<?php echo $socialite->create('google')->redirect(); ?>"
           class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
        >
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
              fill="currentColor" class="text-white h-4  w-4 mr-3"   viewBox="0 0 128 128" xml:space="preserve">
    <path id="icon_5_" d="M30.418,49.137
		c-9.242-7.272-16.109-12.661-21.237-16.601C20.161,13.095,40.993,0,64.895,0c16.572,0,31.696,6.316,43.053,16.659
		C94.563,29.32,94.997,30.044,89.724,35.317c-6.577-5.447-13.733-9.329-24.829-9.329C49.163,25.988,36.009,35.52,30.418,49.137z
		 M27.491,64c0-1.97,0.145-3.882,0.435-5.765C20.48,52.382,12.107,45.892,5.299,40.677C2.459,47.891,0.895,55.772,0.895,64
		c0,9.271,1.97,18.079,5.505,26.017c6.577-5.592,14.399-12.284,21.787-18.6C27.723,69.012,27.491,66.549,27.491,64z M64.895,102.012
		c-15.124,0-27.871-8.837-33.811-21.613c-8.924,7.62-15.529,13.269-20.484,17.47C21.9,115.976,41.978,128,64.895,128
		c15.326,0,27.321-3.882,36.476-10.169c-6.055-5.244-13.791-11.879-21.15-18.108C76.02,101.23,70.979,102.012,64.895,102.012z
		 M126.345,51.339c-12.516,0-61.45,0-61.45,0v25.322c0,0,24.569-0.029,34.593-0.029c-2.665,7.996-5.997,14.255-11.183,18.513
		c8.894,7.533,15.326,13.009,19.962,17.065C124.926,96.072,129.04,70.664,126.345,51.339z"/>
</svg>
            <span><?php _e('Via Google einloggen', 'ir21') ?></span>
        </a>
    </div>
    <div class="my-5 w-full">
        <a href="<?php echo $socialite->create('linkedin')->withState(urlencode($_GET['redirect'] ?? ''))->redirect(); ?>"
           class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
        >
            <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 500 500" fill="currentColor" class="w-4 h-4 text-white mr-3" xml:space="preserve">
                                    <path class="st0" d="M123.3,481.6H27.7V172.8h95.6V481.6L123.3,481.6z M75,132.4L75,132.4c-31.2,0-56.5-25.5-56.5-57
	c0-31.5,25.3-57,56.5-57s56.5,25.5,56.5,57C131.6,106.8,106.2,132.4,75,132.4L75,132.4z M481.5,481.6L481.5,481.6h-95.1
	c0,0,0-117.6,0-162.1c0-44.4-16.9-69.3-52-69.3c-38.3,0-58.2,25.8-58.2,69.3c0,47.6,0,162.1,0,162.1h-91.7V172.8h91.7v41.6
	c0,0,27.6-51,93.1-51c65.5,0,112.4,40,112.4,122.7C481.5,368.8,481.5,481.6,481.5,481.6z"/>
</svg>
            <span><?php _e('Via LinkedIn einloggen', 'ir21') ?></span>
        </a>
    </div>
</div>
<div class="py-2">
    <p class="font-medium"><?php _e('Noch keinen Account?', 'ir21') ?></p>
    <p>
        <a href="<?php echo get_field('field_601bc00528968', 'option') ?>" class="text-primary-100 underline"><?php _e('Hier registrieren', 'ir21') ?></a>
    </p>
</div>
