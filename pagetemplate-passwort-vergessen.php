<?php
/**
 * Template Name: Passwort vergessen
 */
get_header();
the_post();
?>

    <div class="container mx-auto mt-20 relative">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6">
                <h1 class="text-2xl font-serif font-semibold mb-5">Neues Passwort anfordern</h1>

                <?php if (isset($_SESSION['sent_success'])): ?>
                    <div class="tebg-success p-5 text-white flex space-x-3 items-center">
                        <div>
                            <div class="rounded-full bg-success bg-opacity-25 w-10 h-10 flex items-center justify-center">
                                <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-success text-sm">
                            <?php echo $_SESSION['sent_success'];
                            unset($_SESSION['sent_success']); ?>
                        </p>
                    </div>
                <?php else: ?>
                    <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4" method="post" action="<?php echo admin_url('admin-post.php') ?>">
                        <?php if (isset($_SESSION['email_error'])): ?>
                            <div class="text-warning p-5 text-white flex space-x-3 items-center">
                                <div>
                                    <div class="rounded-full bg-warning bg-opacity-25 w-10 h-10 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-warning text-sm">
                                    <?php echo $_SESSION['email_error'];
                                    unset($_SESSION['email_error']); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php wp_nonce_field('reset_password', 'reset_password') ?>
                        <input type="hidden" name="action" value="frontend_reset_password">
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
                                   required="required">
                        </div>
                        <p class="text-sm">Bitte geben Sie die E-Mail Adresse ein mit der Sie sich registriert haben. Wir senden Ihnen einen Link zum Zurücksetzen Ihres Passwortes.</p>
                        <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-5"
                                type="submit">
                            Link senden
                        </button>
                    </form>
                <?php endif; ?>


            </div>
        </div>
    </div>

<?php get_footer();
