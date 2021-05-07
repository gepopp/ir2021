<?php

use Overtrue\Socialite\SocialiteManager;
global $FormSession;
?>

<form class="mb-4" method="post" action="<?php echo admin_url( 'admin-post.php' ) ?>">
	<?php $FormSession->flashSuccess( 'token_success' ) ?>
	<?php $FormSession->flashErrorBag( 'login_errror' ) ?>
	<?php wp_nonce_field( 'frontend_login', 'frontend_login' ) ?>
    <input type="hidden" name="action" value="frontend_login">
    <input type="hidden" name="redirect" value="<?php echo sanitize_text_field( $_GET['redirect'] ?? '' ) ?>">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
			<?php _e( 'E-Mail Adresse', 'ir21' ) ?>
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
			<?php _e( 'Passwort', 'ir21' ) ?>
            <a class="inline align-baseline text-xs underline text-blue-500 hover:text-blue-800" href="<?php the_field( 'field_601e59c9336d7', 'option' ) ?>">
				<?php _e( '( vergessen? )', 'ir21' ) ?>
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
            <span class="text-sm"><?php _e( 'Login merken', 'ir21' ) ?></span>
        </label>
    </div>
    <div class="flex items-center justify-between">
        <button class="w-full bg-primary-100 text-center text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                :class="{' cursor-not-allowed ': !completed }"
                type="submit"
                :disabled="!completed">
			<?php _e( 'einloggen', 'ir21' ) ?>
        </button>
    </div>
</form>
<?php
$config = [
	'google'   => [
		'client_id'     => '194317471061-jdtvke2dpcensj3p9ckfq20cbsre23dl.apps.googleusercontent.com',
		'client_secret' => 'O_JXIOXqatwxOMYq45ggJ1tj',
		'redirect'      => home_url( 'g-oauth' ),
	],
	'linkedin' => [
		'client_id'     => '78q1kul4q95hsh',
		'client_secret' => 'mO7jlH6rG9bahUrX',
		'redirect'      => home_url( 'l-oauth' ),
	],
];
// 194317471061-jdtvke2dpcensj3p9ckfq20cbsre23dl.apps.googleusercontent.com
// O_JXIOXqatwxOMYq45ggJ1tj

$socialite = new SocialiteManager( $config );
?>
<div class="bg-white">
    <hr class="my-4">
    <div class="my-5 w-full">
        <?php get_template_part('page-templates/loginbutton', 'facebook') ?>
    </div>
    <div class="my-5 w-full">
	    <?php get_template_part('page-templates/loginbutton', 'google') ?>
    </div>
<!--    <div class="my-5 w-full">-->
<!--        <a href="--><?php //echo $socialite->create( 'linkedin' )->withState( urlencode( $_GET['redirect'] ?? '' ) )->redirect(); ?><!--"-->
<!--           class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"-->
<!--        >-->
<!--            <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"-->
<!--                 viewBox="0 0 500 500" fill="currentColor" class="w-4 h-4 text-white mr-3" xml:space="preserve">-->
<!--                                    <path class="st0" d="M123.3,481.6H27.7V172.8h95.6V481.6L123.3,481.6z M75,132.4L75,132.4c-31.2,0-56.5-25.5-56.5-57-->
<!--	c0-31.5,25.3-57,56.5-57s56.5,25.5,56.5,57C131.6,106.8,106.2,132.4,75,132.4L75,132.4z M481.5,481.6L481.5,481.6h-95.1-->
<!--	c0,0,0-117.6,0-162.1c0-44.4-16.9-69.3-52-69.3c-38.3,0-58.2,25.8-58.2,69.3c0,47.6,0,162.1,0,162.1h-91.7V172.8h91.7v41.6-->
<!--	c0,0,27.6-51,93.1-51c65.5,0,112.4,40,112.4,122.7C481.5,368.8,481.5,481.6,481.5,481.6z"/>-->
<!--</svg>-->
<!--            <span>--><?php //_e( 'Via LinkedIn einloggen', 'ir21' ) ?><!--</span>-->
<!--        </a>-->
<!--    </div>-->
</div>
<div class="py-2">
    <p class="font-medium"><?php _e( 'Noch keinen Account?', 'ir21' ) ?></p>
    <p>
        <a href="<?php echo get_field( 'field_601bc00528968', 'option' ) ?>" class="text-primary-100 underline"><?php _e( 'Hier registrieren', 'ir21' ) ?></a>
    </p>
</div>
