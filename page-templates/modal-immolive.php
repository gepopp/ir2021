<?php

use Overtrue\Socialite\SocialiteManager;

?>

<div x-data="{ show: false, user : false, id : false }"
     x-init="
            window.addEventListener('register-immolive', (e) => {
                show = true;
                user = e.detail.user;
                id = e.detail.id;
            })
        ">

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="fixed z-10 inset-0 overflow-y-auto"
         x-show="show"
         x-cloak>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div class="inline-block align-bottom bg-white border-15 border-primary-100 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                 role="dialog" aria-modal="true"
                 aria-labelledby="modal-headline"
                 @click.away="show = false">


                <div x-show="!user" class="p-5">
                    <div class="flex space-x-4 items-center">
                        <svg class="w-12 h-12 text-primary-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <h2 class="font-semibold text-xl mb-4 font-sans text-primary-100"><?php _e('Um sich zu unseren ImmoLive Webinaren anmelden zu können müssen Sie sich einloggen.', 'ir21') ?></h2>
                    </div>
                    <p class="mb-4"><?php _e('Sie haben noch keinen Account bei der Immobilien Redaktion? Kein Problen, einfach, schnell und', 'ir21') ?>
                        <a class="text-primary-100 underline"
                           href="<?php echo add_query_arg(['redirect' => urlencode(get_permalink())], get_field('field_6013cf36d4689', 'option')) ?>">
                            <?php _e('kostenlos registrieren', 'ir21') ?>
                        </a>

                        .</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">

                            <?php
                            $ref = $_GET['ref'] ?? 'none';
                            $redirect = urlencode(add_query_arg(['ref' => $ref], get_field('field_601e5f56775db', 'option')))
                            ?>
                            <a href="<?php echo add_query_arg(['redirect' => $redirect], get_field('field_601bbffe28967', 'option')) ?>"
                               class="block bg-primary-100 text-white font-semibold text-center shadow-xl py-3 my-5 text-lg focus:outline-none focus:shadow-outline w-full text-center cursor-pointer">
                                <?php _e('E-Mail login', 'ir21') ?>
                            </a>
                        </div>
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
                                'redirect'      => home_url('g-oauth'),
                            ],
                            'linkedin'   => [
                                'client_id'     => '78q1kul4q95hsh',
                                'client_secret' => 'mO7jlH6rG9bahUrX',
                                'redirect'      => home_url('l-oauth'),
                            ],
                        ];

                        $socialite = new SocialiteManager($config);
                        ?>
<div class="col-span-2">
    <h3 class="w-full text-lg text-center text-gray-700 font-medium"><?php _e('Mit einem Klick einloggen', 'ir21') ?></h3>
</div>
                        <div>
                            <a href="<?php echo $socialite->create('facebook')->withState($redirect)->redirect(); ?>"
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
                        <div>
                            <a href="<?php echo $socialite->create('google')->withState($redirect)->redirect(); ?>"
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
                                <span><?php _e('Via Google einloggen', 'ir21') ?></span>
                            </a>
                        </div>
                        <div class="col-span-2">
                            <a href="<?php echo $socialite->create('linkedin')->withState($redirect)->redirect(); ?>"
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
                </div>


                <div class="bg-primary-100 bg-opacity-5 p-5">
                    <div x-show="user">
                        <?php $user = wp_get_current_user(); ?>
                        <h2 class="font-sans text-primary-100 font-semibold text-xl mb-4"><?php echo $user->first_name ?><?php echo $user->last_name ?><?php _e(', wir freuen uns auf Ihre Teilnahme!', 'ir21') ?></h2>
                        <form action="<?php echo admin_url('admin-post.php') ?>" method="post">
                            <?php wp_nonce_field('subscribe_immolive', 'subscribe_immolive') ?>
                            <input type="hidden" name="action" value="subscribe_immolive">
                            <input type="hidden" name="immolive_id" x-model="id">
                            <input type="hidden" name="referer" value="<?php echo isset($_GET['ref']) ? substr(sanitize_text_field($_GET['ref']), 0, 8) : '' ?>">

                            <label class="block text-gray-700 text-sm font-bold mb-2" for="question"><?php _e('Ihre Frage an unser Poduim', 'ir21') ?></label>
                            <textarea rows="5" id="question" name="question" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4"></textarea>

                            <label class="mb-4 block flex space-x-2" for="confirm">
                                <input class="mt-1" type="checkbox" name="confirm" id="confirm" required>
                                <span class="inline text-gray-700 text-sm font-bold mb-2">
                                           <?php _e(' Ja, ich nehme an diesem Live Webinar über Zoom teil und bin mit den', 'ir21') ?>
                                                <a href="<?php echo get_field('field_601ec7cd84c47', 'option') ?>" target="_blank" class="text-primary-100 underline">
                                                <?php _e('Datenschutzbestimmungen', 'ir21') ?>
                                                </a>
                                                <?php _e('der Immobilienredaktion sowie meiner Registrierung auf Zoom (', 'ir21') ?>
                                                <a href="https://us02web.zoom.us/privacy" target="_blank" class="text-primary-100 underline">
                                                    <?php _e('Datenschutzrichtlinien', 'ir21') ?>
                                                </a>
                                                <?php _e('und', 'ir21') ?>
                                                <a href="https://us02web.zoom.us/terms" target="_blank" class="text-primary-100 underline">
                                                <?php _e('Nutzungsbedingungen', 'ir21') ?>
                                                </a>
                                                <?php _e(') einverstanden.', 'ir21') ?>
                                            </span>
                            </label>
                            <button type="submit" class="block w-full bg-primary-100 text-white font-semibold py-3 px-3 focus:outline-none"><?php _e('jetzt anmelden', 'ir21') ?></button>
                        </form>
                    </div>


                    <div class="bg-gray-50 pt-5 flex">
                        <button type="button"
                                class="w-full inline-flex justify-center border border-primary-100 shadow-sm px-4 py-2 text-base font-medium text-primary-100 hover:bg-red-700 focus:outline-none focus:ring-2"
                                @click="show = false">
                            <?php _e('abbrechen', 'ir21') ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

