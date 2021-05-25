<?php

use Overtrue\Socialite\SocialiteManager;

global $FormSession;
?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    var register_data = <?php echo json_encode( $FormSession->getFormData() ) ?>;
</script>
<script>
    function onSubmit(token) {
        document.getElementById("register-form").submit();
    }
</script>
<div class="bg-white shadow-md px-8 pt-6 pb-8 mb-4">

    <form
            method="post" action="<?php echo admin_url( 'admin-post.php' ) ?>"
            id="register-form"
            x-data="registerForm( register_data )"
            x-init="init()"
            @submit.prevent="validate()"
            x-ref="form">
        <h3 class="text-xl font-medium mb-4 text-gray-700"><?php _e( 'Registrieren', 'ir21' ) ?></h3>
		<?php wp_nonce_field( 'frontend_register', 'frontend_register' ) ?>
        <input type="hidden" name="action" value="frontend_register">
        <input type="hidden" name="redirect" value="<?php echo $_GET['redirect'] ?? '' ?>">

		<?php $FormSession->flashErrorBag( 'register_error' ); ?>
		<?php $FormSession->flashSuccess( 'register_sent_success' ); ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="register_gender">
					<?php _e( 'Anrede', 'ir21' ) ?> <span class="text-warning">*</span>
                </label>
                <select name="register_gender"
                        id="register_gender"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required="required"
                        x-model="data.gender"
                        name="register_gender">
                    <option value=""><?php _e( 'Bitte w&auml;hlen', 'ir21' ) ?></option>
                    <option value="f"><?php _e( 'Frau', 'ir21' ) ?></option>
                    <option value="m"><?php _e( 'Herr', 'ir21' ) ?></option>
                </select>
                <p x-show="regsiter_errors.gender" x-text="regsiter_errors.gender" class="text-warning text-xs"></p>
            </div>


            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name"><?php _e( 'Vorname', 'ir21' ) ?></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="first_name"
                       type="text"
                       x-model="data.firstname"
                       name="first_name"
                       placeholder="Vorname"/>
                <p x-show="regsiter_errors.first_name" x-text="regsiter_errors.first_name" class="text-warning text-xs"></p>
            </div>


            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name"><?php _e( 'Nachname', 'ir21' ) ?>
                    <span class="text-warning">*</span></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="last_name"
                       type="text"
                       name="last_name"
                       x-model="data.lastname"
                       placeholder="Nachname"/>
                <p x-show="regsiter_errors.lastname" x-text="regsiter_errors.lastname" class="text-warning text-xs"></p>
            </div>


        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="register_email"><?php _e( 'E-Mail Adresse', 'ir21' ) ?>
                <span class="text-warning">*</span></label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="register_email"
                   type="email"
                   name="register_email"
                   x-model="data.email"
                   placeholder="E-Mail Adresse"
                   autocomplete="email"/>
            <p x-show="regsiter_errors.email" x-text="regsiter_errors.email" class="text-warning text-xs"></p>
        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="register_password">
				<?php _e( 'Passwort', 'ir21' ) ?> <span class="text-warning">*</span>
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                   id="register_password"
                   type="password"
                   name="password"
                   x-model="data.password"
                   placeholder="******************"
                   autocomplete="new-password"/>
            <p class="text-xs text-gray-600" x-show="!regsiter_errors.password"><?php _e( 'Mindestens 8 Zeichen.', 'ir21' ) ?></p>
            <p x-show="regsiter_errors.password" x-text="regsiter_errors.password" class="text-warning text-xs"></p>
        </div>


        <div class="md:flex md:items-center mb-4">
            <label class="block text-gray-500 font-bold">
                <input class="mr-2 leading-tight bg-primary-100" type="checkbox" name="agb" required>
                <span class="text-sm">
                <?php sprintf( _e( 'Ich bin der <a href="%s" target="_blank" class="text-primary-100 underline">Datenschutzerklärung</a> der unabhängigen Immobilien Redaktion einverstanden.', 'ir21' ), get_field( 'field_601ec7cd84c47', 'option' ) ) ?>
                <span class="text-warning">*</span>
            </span>
            </label>
        </div>


		<?php
		$config = [
			'facebook' => [
				'client_id'     => '831950683917414',
				'client_secret' => 'd6d52d59ce1f1efdbf997b980dffe229',
				'redirect'      => home_url( 'fb-login' ),
			],
		];

		$socialite = new SocialiteManager( $config );
		?>
        <div class="flex items-center justify-between">
            <button
                    data-sitekey="6Ldhsu4aAAAAAGj0UZRfizcHjtqKqPrPrxF_hsE0"
                    data-callback='onSubmit'
                    data-action='submit'
                    class="g-recaptcha bg-primary-100 text-white font-medium py-2 px-4 w-full text-center focus:outline-none focus:shadow-outline"
                    type="submit">
				<?php _e( 'registrieren', 'ir21' ) ?>
            </button>
        </div>
        <p class="text-xs mt-2"><?php _e( 'Mit <span class="text-warning">*</span> gekennzeichneten Felder sind Pflichtfelder.', 'ir21' ) ?></p>
    </form>
	<?php
	$config = [
		'facebook' => [
			'client_id'     => '831950683917414',
			'client_secret' => 'd6d52d59ce1f1efdbf997b980dffe229',
			'redirect'      => home_url( 'fb-login' ),
		],
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
            <a href="<?php echo $socialite->create( 'facebook' )->redirect(); ?>"
               class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
            >
                <svg version="1.1" id="digital_x5F_marketing" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 128 128" fill="currentColor" class="text-white w-4 mr-3" xml:space="preserve">
                    <path id="icon:4" class="st1" d="M74,35.3v12.5h21.6v23.6H74c0,26.4,0,56.6,0,56.6H50.3c0,0,0-27.5,0-56.6H30.4V47.8h19.9V30.6
		c0-36.2,47.3-30.3,47.3-30.3v22C97.6,22.4,74,19.5,74,35.3z"/>
</svg>
                <span><?php _e( 'Via Facebook registrieren', 'ir21' ) ?></span>
            </a>
        </div>
        <div class="my-5 w-full">
            <a href="<?php echo $socialite->create( 'google' )->redirect(); ?>"
               class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
            >
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     fill="currentColor" class="text-white h-4  w-4 mr-3" viewBox="0 0 128 128" xml:space="preserve">
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
                <span><?php _e( 'Via Google registrieren', 'ir21' ) ?></span>
            </a>
        </div>
        <div class="my-5 w-full">
            <a href="<?php echo $socialite->create( 'linkedin' )->redirect(); ?>"
               class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
            >
                <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 500 500" fill="currentColor" class="w-4 h-4 text-white mr-3" xml:space="preserve">
                                    <path class="st0" d="M123.3,481.6H27.7V172.8h95.6V481.6L123.3,481.6z M75,132.4L75,132.4c-31.2,0-56.5-25.5-56.5-57
	c0-31.5,25.3-57,56.5-57s56.5,25.5,56.5,57C131.6,106.8,106.2,132.4,75,132.4L75,132.4z M481.5,481.6L481.5,481.6h-95.1
	c0,0,0-117.6,0-162.1c0-44.4-16.9-69.3-52-69.3c-38.3,0-58.2,25.8-58.2,69.3c0,47.6,0,162.1,0,162.1h-91.7V172.8h91.7v41.6
	c0,0,27.6-51,93.1-51c65.5,0,112.4,40,112.4,122.7C481.5,368.8,481.5,481.6,481.5,481.6z"/>
</svg>
                <span><?php _e( 'Via LinkedIn registrieren', 'ir21' ) ?></span>
            </a>
        </div>
    </div>
</div>