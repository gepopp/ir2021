<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;


function activate_user($token){

    global $FormSession;

    if ($token != '') {

        global $wpdb;
        $email = $wpdb->get_var('SELECT email FROM wp_user_activation_token WHERE token = "' . $token . '"');
        $wpdb->delete('wp_user_activation_token', ['token' => $token ]);
        $token_user = get_user_by('email', $email);


        if (!empty($token_user)) {
            if (!in_array('subscriber', $token_user->roles)) {

                $token_user->add_role('subscriber');
                $token_user->remove_role('registered');

             $sent =  (new CampaignMonitor())->transactional('registration_activated', $token_user);
             $updated =   (new CampaignMonitor())->updateUser($token_user);

            }
        }else{
            $FormSession->addToErrorBag('login_error', 'token_expired');
        }
        $FormSession->set('token_success', 'account_acitvated');
    }
}

add_action('wp_ajax_set_user_reading_reminder', function () {

    $post = sanitize_text_field($_POST['id']);
    $user = wp_get_current_user();

    global $wpdb;

    $wpdb->show_errors = false;

    $insert = $wpdb->insert('wp_user_read_later', [
        'user_id'   => $user->ID,
        'post_id'   => $post,
        'permalink' => get_the_permalink($post),
        'remind_at' => Carbon::now()->addDays(3)->format('Y-m-d H:i:s'),
    ], ['%d', '%d', '%s', '%s']);

    if (!$insert) {
        wp_die('', 401);
    } else {
        wp_die('');

    }

});

add_action('wp_ajax_set_user_bookmark', function () {

    $post = sanitize_text_field($_POST['id']);
    $user = wp_get_current_user();

    global $wpdb;

    $wpdb->show_errors = false;

    $insert = $wpdb->insert('wp_user_bookmarks', [
        'user_id'   => $user->ID,
        'post_id'   => $post,
        'permalink' => get_the_permalink($post),
    ], ['%d', '%d', '%s']);

    if (!$insert) {
        wp_die('', 401);
    } else {
        wp_die('');

    }

});

add_action('wp_ajax_remove_user_bookmark', function () {

    $bookmark_id = sanitize_text_field($_POST['id']);
    $user = wp_get_current_user();

    global $wpdb;
    $bookmark_user_id = $wpdb->get_var(sprintf('SELECT user_id FROM wp_user_bookmarks WHERE id = %d', $bookmark_id));
    if ($user->ID == $bookmark_user_id) {
        $del = $wpdb->delete('wp_user_bookmarks', ['id' => $bookmark_id]);
    }

    if (!is_wp_error($del)) {
        wp_die('');
    } else {
        wp_die('', 400);
    }

});

add_action('admin_post_nopriv_frontend_login', function () {

    global $FormSession;

    if (!wp_verify_nonce(sanitize_text_field($_POST['frontend_login']), 'frontend_login')) {
        $FormSession->addToErrorBag('login_error', 'nonce')->redirect();
    }

    $user = get_user_by('email', sanitize_email($_POST['email']));
    $roles = $user->roles;

    if (in_array('registered', $roles)) {
        $FormSession->addToErrorBag('login_error', 'not_activated')->redirect();
    }

    $user = wp_signon([
        'user_login'    => sanitize_email($_POST['email']),
        'user_password' => sanitize_text_field($_POST['password']),
        'remember'      => isset($_POST['remember']) ? (bool)$_POST['remember'] : false,
    ], false);


    if (is_wp_error($user)) {
        $FormSession->addToErrorBag('login_errror', 'login_credentials')->redirect();
    }

    wp_safe_redirect(home_url('profil'));

});

add_action('admin_post_nopriv_frontend_register', function () {

    global $FormSession;

    if (!wp_verify_nonce($_POST['frontend_register'], 'frontend_register')) {
        $FormSession->addToErrorBag('register_error', 'nonce')->redirect();
    }

    if (sanitize_text_field($_POST['agb']) != 'on') {
        $FormSession->addToErrorBag('register_error', 'agb')->redirect();
    }

    $gender = sanitize_text_field($_POST['register_gender']);
    $firstname = sanitize_text_field($_POST['first_name']);
    $lastname = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['register_email']);
    $password = sanitize_text_field($_POST['password']);

    if (get_user_by('email', $email)) {
        $FormSession->addToErrorBag('register_error', 'user_exists')->redirect();
    }

    if (strlen($password) < 8) {
        $FormSession->addToErrorBag('register_error', 'password_length')->redirect();
    }

    $user = wp_create_user(trim($firstname . ' ' . $lastname . ' ' . uniqid()), $password, $email);

    if (is_wp_error($user)) {
        $FormSession->addToErrorBag('register_error', 'register_error')->redirect();
    }

    wp_update_user([
        'ID'           => $user,
        'display_name' => trim($firstname . ' ' . $lastname),
        'first_name'   => $firstname,
        'last_name'    => $lastname,
    ]);
    update_field('field_5fb6bc5f82e62', $gender, 'user_' . $user);

    $user = get_user_by('ID', $user);

    $user->add_role('registered');
    $user->remove_role('subscriber');

    global $wpdb;
    $table = 'wp_user_activation_token';

    $wpdb->delete($table, ['email' => $user->data->user_email]);
    $token = wp_generate_uuid4();

    $wpdb->insert($table, [
        'user_id'    => $user->ID,
        'email'      => $user->data->user_email,
        'token'      => $token,
        'created_at' => \Carbon\Carbon::now()->format('d.m.Y H:i:s'),
    ],
        ['%d', '%s', '%s', '%s']);

    $sent = (new CampaignMonitor())->transactional('confirm_email_address', $user, ['link' => add_query_arg(['token' => $token], home_url('login'))]);
    if ($sent) {
        $FormSession->set('register_sent_success', 'register_sent_success')->redirect();
    } else {
        $FormSession->addToErrorBag('register_error', 'not_sent')->redirect();
    }

});

add_action('admin_post_update_profile', function () {

    global $FormSession;

    if (!wp_verify_nonce($_POST['frontend_register'], 'frontend_register')) {
        $FormSession->addToErrorBag('profile_error', 'nonce')->redirect();
    }

    $user = wp_get_current_user();
    $gender = sanitize_text_field($_POST['register_gender']);
    $firstname = sanitize_text_field($_POST['fist_name']);
    $lastname = sanitize_text_field($_POST['last_name']);

    update_user_meta($user->ID, 'first_name', $firstname);
    update_user_meta($user->ID, 'last_name', $lastname);
    wp_update_user(['ID' => $user->ID, 'display_name' => trim($firstname . ' ' . $lastname)]);

    update_field('field_5fb6bc5f82e62', $gender, 'user_' . $user->ID);

    $FormSession->set('profile_updated', 'profile_updated');
});

add_action('admin_post_nopriv_new_password', function () {

    global $FormSession;

    if (!wp_verify_nonce(sanitize_text_field($_POST['new_password']), 'new_password')) {
        $FormSession->addToErrorBag('frontend_reset_password', 'nonce')->redirect();
    }

    global $wpdb;
    $user = get_user_by('email', sanitize_email($_POST['email']));

    if (!$user) {
        $FormSession->addToErrorBag('frontend_reset_password', 'register_error')->redirect();
    }

    if (!in_array('subscriber', $user->roles)) {
        $user->add_role('subscriber');
        $user->remove_role('registered');
    }

    wp_set_password(sanitize_text_field($_POST['pw']), $user->ID);

    $FormSession->set('token_success', 'password_changed')->redirect('login');

});

add_action('admin_post_nopriv_frontend_reset_password', function () {

    global $FormSession;

    if (!wp_verify_nonce(sanitize_text_field($_POST['reset_password']), 'reset_password')) {
        $FormSession->addToErrorBag('passwort_reset_error', 'nonce')->redirect();
    }

    $user = get_user_by('email', sanitize_email($_POST['email']));

    if (!$user) {
        $FormSession->addToErrorBag('passwort_reset_error', 'email_not_found')->redirect();
    }

    global $wpdb;
    $table = 'wp_user_activation_token';

    $wpdb->delete($table, ['email' => $user->data->user_email]);

    $token = wp_generate_uuid4();

    $wpdb->insert($table, [
        'user_id'    => $user->ID,
        'email'      => $user->data->user_email,
        'token'      => $token,
        'created_at' => \Carbon\Carbon::now()->format('d.m.Y H:i:s'),
    ],
        ['%d', '%s', '%s', '%s']);

    $sent = (new CampaignMonitor())->transactional('reset_password', $user, ['link' => add_query_arg(['token' => $token], home_url('passwort-setzen'))]);

    if($sent){
        $FormSession->set('passwort_reset', 'reset_success')->redirect();
    }else{
        $FormSession->addToErrorBag('passwort_reset_error', 'register_error')->redirect();
    }

});

add_action('wp_ajax_nopriv_resend_confirmation_email', function () {

    $user = get_user_by('email', sanitize_email($_POST['email']));

    if(is_wp_error($user)){
        wp_die('Bitte geben Sie ihre E-Mail Adresse ein! <span @click="resendConfirmation(\''.$user->data->user_email . '\')" class="font-semibold underline cursor-pointer">Nocheinmal senden.</span>', 404);
    }


    global $wpdb;
    $table = 'wp_user_activation_token';

    $wpdb->delete($table, ['email' => $user->data->user_email]);

    $token = wp_generate_uuid4();

    $wpdb->insert($table, [
        'user_id' => $user->ID,
        'email' => $user->data->user_email,
        'token' => $token,
        'created_at' => \Carbon\Carbon::now()->format('d.m.Y H:i:s')
    ],
        [ '%d', '%s', '%s', '%s' ]);

    wp_die((new CampaignMonitor())->transactional('confirm_email_address', $user, ['link' => add_query_arg(['token' => $token], home_url('login'))]));

});
