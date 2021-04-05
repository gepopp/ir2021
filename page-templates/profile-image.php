<?php

global $FormSession;

$user = wp_get_current_user();

$image = get_field('field_5ded37c474589', 'user_' . get_current_user_id());

?>


<div class="col-span-3 lg:col-span-1">

    <form enctype="multipart/form-data" class="bg-white shadow-md px-8 pt-6 pb-8 mb-4 h-full" method="post" action="<?php echo admin_url('admin-post.php') ?>" x-data="profileImage()">
        <h1 class="text-xl font-sans font-semibold text-gray-700 mb-4"><?php _e('Ihr Profilbild', 'ir21') ?></h1>
        <?php $FormSession->flashErrorBag('profile_error'); ?>
        <?php $FormSession->flashSuccess('profile_updated'); ?>
        <?php wp_nonce_field('profile_image', 'profile_image') ?>
        <input type="hidden" name="action" value="update_profile_image"/>
        <input class="hidden" type="file" accept="image/*" @change="fileChosen" name="profile_picture" x-ref="upload">
        <div class="flex flex-col items-center justify-center my-10">
            <?php if ($image): ?>
                <div>
                    <img src="<?php echo $image['sizes']['thumbnail'] ?>" class="rounded-full w-full h-auto">
                </div>
            <?php else: ?>

                <div class="w-48 h-48 border border-dashed rounded-full flex items-center justify-center">
                    <template x-if="imageUrl">
                        <img :src="imageUrl"
                             class="object-cover rounded-full"
                             style="width: 100%; height: 100%;"
                        >
                    </template>
                </div>
            <?php endif; ?>
        </div>
        <div class="flex justify-center">
            <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" x-show="!imageUrl"
                    @click="$refs.upload.click()"
                    type="button">
                <?php _e('Neues Bild wählen', 'ir21') ?>
            </button>
            <button class="bg-primary-100 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" x-show="imageUrl"
                    type="submit">
                <?php _e('speichern', 'ir21') ?>
            </button>
        </div>
        <p class="text-xs mt-2"><?php _e('die mit <span class="text-warning">*</span> gekennzeichneten Felder sind Pflichtfelder.', 'ir21') ?></p>
    </form>
</div>
