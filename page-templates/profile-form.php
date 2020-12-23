<?php

global $FormSession;

$user = wp_get_current_user();

$gender = get_field('field_5fb6bc5f82e62', 'user_' . get_current_user_id());

?>


<div class="col-span-3 lg:col-span-1">
    <h1 class="text-2xl font-serif font-semibold">Userdaten</h1>
    <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4 h-full" method="post" action="<?php echo admin_url('admin-post.php') ?>">

        <?php $FormSession->flashErrorBag('profile_error'); ?>
        <?php $FormSession->flashSuccess('profile_updated'); ?>


        <?php wp_nonce_field('frontend_register', 'frontend_register') ?>
        <input type="hidden" name="action" value="update_profile">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="register_gender">Anrede
                <span class="text-warning">*</span></label>
            <select name="register_gender" id="register_gender"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required="required"
                    name="profile_gender">
                <option value="">Bitte wählen</option>
                <option value="f" <?php echo $gender == 'f' ? 'selected="selected"' : '' ?>>Frau</option>
                <option value="m" <?php echo $gender != 'f' ? 'selected="selected"' : '' ?>>Herr</option>
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
                       value="<?php echo $user->first_name ?>"
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
                       value="<?php echo $user->last_name ?>"
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
