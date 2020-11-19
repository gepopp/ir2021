<?php use Overtrue\Socialite\SocialiteManager; ?>

<h1 class="text-2xl font-serif font-semibold mb-5">Registrieren</h1>
<div class="w-full">
    <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4"
          method="post" action="<?php echo admin_url('admin-post.php') ?>"
          x-data="registerForm()"
          @submit.prevent="validate()"
          x-ref="form"
    >
        <?php wp_nonce_field('frontend_register', 'frontend_register') ?>
        <input type="hidden" name="action" value="frontend_register">
        <input type="hidden" name="redirect" value="<?php echo $_GET['redirect'] ?? '' ?>">
        <input type="hidden" name="function" value="<?php echo $_GET['function'] ?? '' ?>">

        <?php if(isset($_SESSION['register_error'])): ?>
        <div class="text-warning p-5 text-white flex space-x-3 items-center">
            <div>
                <div class="rounded-full bg-warning bg-opacity-25 w-20 h-20 flex items-center justify-center">
                    <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <p class="text-warning text-sm">
                <?php echo $_SESSION['register_error'] ?>
            </p>
        </div>
        <?php endif; unset($_SESSION['register_error']) ?>


        <?php if(isset($_SESSION['register_sent_success'])): ?>
            <div class="text-success p-5 text-white flex space-x-3 items-center">
                <div>
                    <div class="rounded-full bg-success bg-opacity-25 w-20 h-20 flex items-center justify-center">
                        <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-success text-sm">
                    <?php echo $_SESSION['register_sent_success'] ?>
                </p>
            </div>
        <?php else: ?>


        <?php
        $config = [
            'facebook' => [
                'client_id'     => '831950683917414',
                'client_secret' => 'd6d52d59ce1f1efdbf997b980dffe229',
                'redirect'      => home_url('fb-oauth'),
            ],
        ];

        $socialite = new SocialiteManager($config);
        ?>

        <div class="my-5 w-full">
            <a href="<?php echo $socialite->create('facebook')->redirect(); ?>"
               class="bg-primary-100 py-2 px-3 text-white w-full text-center block"
            >Mit Facebook ausfüllen</a>
        </div>

        <hr class="my-4">

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="register_gender">
                    Anrede <span class="text-warning">*</span>
                </label>
                <select name="register_gender"
                        id="register_gender"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required="required"
                        x-model="data.gender"
                        name="register_gender"
                >
                    <option value="">Bitte wählen</option>
                    <option value="f">Frau</option>
                    <option value="m">Herr</option>
                </select>
                <p x-show="regsiter_errors.gender" x-text="regsiter_errors.gender" class="text-warning text-xs"></p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                    Vorname
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="first_name"
                       type="text"
                       x-model="data.firstname"
                       name="fist_name"
                       placeholder="Vorname"
                >
                <p x-show="regsiter_errors.first_name" x-text="regsiter_errors.first_name" class="text-warning text-xs"></p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                    Nachname <span class="text-warning">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="last_name"
                       type="text"
                       name="last_name"
                       x-model="data.lastname"
                       value="<?php echo isset($_SESSION['register_lastname']) ? $_SESSION['register_lastname'] : '';
                       unset($_SESSION['register_lastname']) ?>"
                       placeholder="Nachname">
                <p x-show="regsiter_errors.lastname" x-text="regsiter_errors.lastname" class="text-warning text-xs"></p>

            </div>
        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="register_email">
                E-Mail Adresse <span class="text-warning">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="register_email"
                   type="email"
                   name="register_email"
                   x-model="data.email"
                   placeholder="E-Mail Adresse"
                   value="<?php echo isset($_SESSION['register_email']) ? $_SESSION['register_email'] : '';
                   unset($_SESSION['register_email']) ?>">
            <p x-show="regsiter_errors.email" x-text="regsiter_errors.email" class="text-warning text-xs"></p>

        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="register_password">
                Passwort <span class="text-warning">*</span>
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                   id="register_password"
                   type="password"
                   name="password"
                   x-model="data.password"
                   placeholder="******************">
            <p x-show="regsiter_errors.password" x-text="regsiter_errors.password" class="text-warning text-xs"></p>
        </div>
        <div class="md:flex md:items-center mb-6">
            <label class="block text-gray-500 font-bold">
                <input class="mr-2 leading-tight bg-primary-100" type="checkbox" name="agb" required>
                <span class="text-sm">Ich bin mit den AGB und der Datenschutzerklärung der unabhängigen Immobilien Redaktion einverstanden. <span class="text-warning">*</span></span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                registrieren
            </button>
        </div>
        <p class="text-xs mt-2">die mit <span class="text-warning">*</span> gekennzeichneten Felder sind Pflichtfelder.
        </p>
    </form>

        <?php endif; unset($_SESSION['register_sent_success']) ?>




</div>
