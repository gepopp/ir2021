<?php use Overtrue\Socialite\SocialiteManager; ?>

<h1 class="text-2xl font-serif font-semibold mb-5">Registrieren</h1>
<div class="w-full">
    <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
        <?php wp_nonce_field('frontend_register', 'frontend_register') ?>
        <input type="hidden" name="action" value="frontend_register">
        <input type="hidden" name="redirect" value="<?php echo $_GET['redirect'] ?? '' ?>">
        <input type="hidden" name="function" value="<?php echo $_GET['function'] ?? '' ?>">


        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                    Anrede <span class="text-warning">*</span>
                </label>
                <select name="gender" id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="null">Bitte wählen</option>
                    <option value="f">Frau</option>
                    <option value="m">Herr</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                    Vorname
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="first_name"
                       type="text"
                       name="first_name"
                       value="<?php echo isset($_SESSION['register_fristname']) ? $_SESSION['register_fristname'] : ''; unset($_SESSION['register_firstname']) ?>"
                       placeholder="Vorname"
                       >
                <p x-show="error.first_name" x-text="error.first_name" class="text-warning text-xs"></p>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                    Nachname <span class="text-warning">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="last_name"
                       type="text"
                       name="last_name"
                       value="<?php echo isset($_SESSION['register_lastname']) ? $_SESSION['register_lastname'] : ''; unset($_SESSION['register_lastname']) ?>"
                       placeholder="Nachname">
                <p x-show="error.last_name" x-text="error.last_name" class="text-warning text-xs"></p>

            </div>
        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                E-Mail Adresse <span class="text-warning">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="email"
                   type="email"
                   name="email"
                   placeholder="E-Mail Adresse"
                   value="<?php echo isset($_SESSION['register_email']) ? $_SESSION['register_email'] : ''; unset($_SESSION['register_email']) ?>">
            <p x-show="error.email" x-text="error.email" class="text-warning text-xs"></p>

        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Passwort <span class="text-warning">*</span>
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
                <input class="mr-2 leading-tight bg-primary-100" type="checkbox" name="agb" required>
                <span class="text-sm">Ich bin mit den AGB und der Datenschutzerklärung der unabhängigen Immobilien Redaktion einverstanden. <span class="text-warning">*</span></span>
            </label>
        </div>

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

<a href="<?php echo $socialite->create('facebook')->redirect(); ?>">Via Facebook Registrieren</a>

        <div class="flex items-center justify-between">
            <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    :class="{' cursor-not-allowed ': !completed }"
                    type="submit"
                    :disabled="!completed">
                registrieren
            </button>
        </div>
        <p class="text-xs mt-2">die mit <span class="text-warning">*</span> gekennzeichneten Felder sind Pflichtfelder.
        </p>
    </form>

</div>
