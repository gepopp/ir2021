<?php
/**
 * Template Name: Profil
 */
get_header();
the_post();

$user = wp_get_current_user();
$gender = get_field('field_5fb6bc5f82e62', 'user_' . $user->ID);


//echo var_dump($user);
?>

<?php get_template_part('page-templates/reading', 'log') ?>


    <div class="container mx-auto mt-48 relative px-5 lg:px-0">
        <div class="grid grid-cols-3 gap-10">
            <div class="col-span-3 lg:col-span-1">
                <h1 class="text-2xl font-serif font-semibold">Userdaten</h1>
                <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4 h-full" method="post" action="<?php echo admin_url('admin-post.php') ?>">
                    <?php wp_nonce_field('frontend_register', 'frontend_register') ?>
                    <input type="hidden" name="action" value="update_profile">
                    <?php if (isset($_SESSION['profile_error'])): ?>
                        <div class="text-warning p-5 text-white flex space-x-3 items-center">
                            <div>
                                <div class="rounded-full bg-warning bg-opacity-25 w-20 h-20 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-warning text-sm">
                                <?php echo $_SESSION['profile_error'] ?>
                            </p>
                        </div>
                    <?php endif;
                    unset($_SESSION['profile_error']) ?>


                    <?php if (isset($_SESSION['profile_success'])): ?>
                        <div class="text-success p-5 text-white flex space-x-3 items-center">
                            <div>
                                <div class="rounded-full bg-success bg-opacity-25 w-20 h-20 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-success text-sm">
                                <?php echo $_SESSION['profile_success'];
                                unset($_SESSION['profile_success']) ?>
                            </p>
                        </div>
                    <?php endif; ?>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="register_gender">Anrede
                            <span class="text-warning">*</span></label>
                        <select name="register_gender" id="register_gender"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required="required"
                                name="profile_gender">
                            <option value="">Bitte wählen</option>
                            <option value="f" <?php echo $gender == 'Frau' ? 'selected="selected"' : '' ?>>Frau</option>
                            <option value="m" <?php echo $gender == 'Herr' ? 'selected="selected"' : '' ?>>Herr</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">Vorname</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   id="first_name"
                                   type="text"
                                   name="fist_name"
                                   placeholder="Vorname"
                                   value="<?php echo get_user_meta($user->ID, 'first_name', true) ?>"
                            >
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Nachname
                                <span class="text-warning">*</span></label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   id="last_name"
                                   type="text"
                                   name="last_name"
                                   placeholder="Nachname"
                                   value="<?php echo get_user_meta($user->ID, 'last_name', true) ?>"
                            >
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                            speichern
                        </button>
                    </div>
                    <p class="text-xs mt-2">die mit
                        <span class="text-warning">*</span> gekennzeichneten Felder sind Pflichtfelder.
                    </p>
                </form>
            </div>


            <div class="col-span-3 lg:col-span-1 lg:h-full mt-24 lg:mt-0">
                <h1 class="text-2xl font-serif font-semibold">E-Mail Adresse</h1>
                <div class="bg-white shadow-md px-8 pt-6 pb-8 mb-4 h-full"
                     x-data="alterEmail('<?php echo $user->user_email ?>')">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Aktuelle E-Mail Adresse:</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-300 leading-tight focus:outline-none focus:shadow-outline cursor-not-allowed"
                               type="email"
                               value="<?php echo $user->user_email ?>"
                               disabled
                        >
                    </div>

                    <?php if (isset($_SESSION['email_error'])): ?>
                        <div class="text-warning p-5 text-white flex space-x-3 items-center">
                            <div>
                                <div class="rounded-full bg-warning bg-opacity-25 w-20 h-20 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-warning text-sm">
                                <?php echo $_SESSION['profile_error'] ?>
                            </p>
                        </div>
                    <?php endif;
                    unset($_SESSION['email_error']) ?>


                    <?php if (isset($_SESSION['profile_success'])): ?>
                        <div class="text-success p-5 text-white flex space-x-3 items-center">
                            <div>
                                <div class="rounded-full bg-success bg-opacity-25 w-20 h-20 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-success text-sm">
                                <?php echo $_SESSION['email_success'];
                                unset($_SESSION['email_success']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <div x-show="!pinSent">
                        <label class="mt-4 block text-gray-700 text-sm font-bold mb-2" for="new_email">Neue E-Mail Adresse</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="new_email"
                               type="email"
                               x-model="email"
                        >
                        <p x-show="errors.email" x-text="errors.email" class="text-warning text-xs"></p>
                        <div class="mt-4 bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer text-center" @click="ValidateEmail()">
                            Pin senden
                        </div>
                    </div>

                    <div x-show="pinSent">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="new_email">Pin eingeben</label>
                        <div class="grid grid-cols-5 gap-2">
                            <div class="col-span-3">

                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       id="pin"
                                       type="number"
                                       x-model="pin"
                                >
                                <p x-show="errors.pin" x-text="errors.pin" class="text-warning text-xs"></p>
                            </div>
                            <div class="col-span-2">
                                <div class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer" @click="ValidatePin()">
                                    absenden
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();








