<?php
add_action('admin_post_nopriv_frontend_login', function (){


    if(!wp_verify_nonce(sanitize_text_field($_POST['frontend_login']), 'frontend_login')){
        $_SESSION['login_error'] = "Wir konnten nicht verifizieren dass, das Formular von einem Menschen geschickt wurde. Bitte laden Sie die Seite neu und versuchen Sie es noch einmal.";
        wp_safe_redirect(home_url($_POST['_wp_http_referer']));
        exit;
    }

    $user = get_user_by('email', sanitize_email($_POST['email']));
    $role = $user->roles[0];

    if ($role == 'registered') {
        $_SESSION['login_error'] = __('Sie haben Ihre E-Mail Adresse noch nicht bestätigt, bitte überprüfen Sie Ihr E-Mail Postfach. Sollten Sie kein E-Mail erhalten haben können Sie <span @click="resendConfirmation(\''. sanitize_email($_POST['email']) . '\')" class="font-semibold underline cursor-pointer">hier ein neues anfordern.</span>');
        $_SESSION['email'] = sanitize_email($_POST['email']);
        wp_safe_redirect(home_url($_POST['_wp_http_referer']));
        exit;
    }

    $user = wp_signon([
        'user_login'    => sanitize_email($_POST['email']),
        'user_password' => sanitize_text_field($_POST['password']),
        'remember'      => isset($_POST['remember']) ? (bool) $_POST['remember'] : false
    ], false);


    if (is_wp_error($user)) {
        $_SESSION['login_error'] = 'Wir konnten Sie mit dieser Kombination aus E-Mail und Passwort nicht einloggen. Bitte versuchen Sie es erneut.';
        wp_safe_redirect(home_url($_POST['_wp_http_referer']));
        exit;
    }

    if(!empty(sanitize_text_field($_POST['redirect']))){
        wp_safe_redirect(home_url($_POST['redirect']));
        exit;
    }

    wp_safe_redirect(home_url('profil'));

});

add_action('admin_post_nopriv_frontend_register', function (){

    if(!wp_verify_nonce($_POST['frontend_register'], 'frontend_register')){
        $_SESSION['register_error'] = "Wir konnten nicht verifizieren dass, das Formular von einem Menschen geschickt wurde. Bitte laden Sie die Seite neu und versuchen Sie es noch einmal.";
        wp_safe_redirect(home_url($_POST['_wp_http_referer']));
        exit;
    }

    if(sanitize_text_field($_POST['agb']) != 'on'){
        $_SESSION['register_error'] = "Bitte akzeptieren Sie die AGB.";
        wp_safe_redirect(home_url($_POST['_wp_http_referer']));
        exit;
    }


    $gender     = sanitize_text_field($_POST['register_gender']);
    $firstname  = sanitize_text_field($_POST['fist_name']);
    $lastname   = sanitize_text_field($_POST['last_name']);
    $email      = sanitize_email($_POST['register_email']);
    $password   = sanitize_text_field($_POST['password']);


    $username = trim($firstname . ' ' . $lastname . ' ' . uniqid());

    $user = wp_create_user( $username,  $password, $email );

    if(is_wp_error($user)){
        $_SESSION['register_error'] = "Wir konnten Ihre Daten nicht speichern, bitte versuchen Sie es später noch einmal.";
        wp_safe_redirect(home_url($_POST['_wp_http_referer']));
        exit;
    }

    update_user_meta($user, 'first_name', $firstname);
    update_user_meta($user, 'last_name', $lastname);
    wp_update_user( array( 'ID' => $user, 'display_name' => trim($firstname . ' ' . $lastname ) ) );

    update_field('field_5fb6bc5f82e62', $gender, 'user_' . $user);

    $user = get_user_by('ID', $user);

    $user->add_role('registered');
    $user->remove_role('subscriber');

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
        [
            '%d',
            '%s',
            '%s',
            '%s',
        ]);

    $result = wp_remote_post('https://api.createsend.com/api/v3.2/transactional/smartEmail/7b1481ba-8715-48a0-8b4f-d17127675e23/send', [
        'headers' => [
            'authorization' => 'Basic ' . base64_encode('fab3e169a5a467b38347a38dbfaaad6d'),
        ],
        'body'    => json_encode([
            'To'                  => $user->data->user_email,
            "Data"
                                  => [
                'fullname' => $user->data->display_name,
                'link'     => add_query_arg(['token' => $token], home_url('login')),
            ],
            "AddRecipientsToList" => true,
            "ConsentToTrack"      => "Yes",
        ]),
    ]);

    $_SESSION['register_sent_success'] = 'Registrierung erfolgreich! Wir haben Ihnen ein E-Mail mit einem Link zum bestätigen Ihrer E-Mail Adresse, bitte überprüfen Sie Ihre Posteingang';
    wp_safe_redirect( home_url($_POST['_wp_http_referer']) );

});

add_action('admin_post_update_profile', function (){

    if(!wp_verify_nonce($_POST['frontend_register'], 'frontend_register')){
        $_SESSION['profile_error'] = "Wir konnten nicht verifizieren dass, das Formular von einem Menschen geschickt wurde. Bitte laden Sie die Seite neu und versuchen Sie es noch einmal.";
        wp_safe_redirect(home_url($_POST['_wp_http_referer']));
        exit;
    }

    $user = wp_get_current_user();

    $gender     = sanitize_text_field($_POST['register_gender']);
    $firstname  = sanitize_text_field($_POST['fist_name']);
    $lastname   = sanitize_text_field($_POST['last_name']);

    update_user_meta($user->ID, 'first_name', $firstname);
    update_user_meta($user->ID, 'last_name', $lastname);
    wp_update_user( array( 'ID' => $user->ID, 'display_name' => trim($firstname . ' ' . $lastname ) ) );

    update_field('field_5fb6bc5f82e62', $gender, 'user_' . $user->ID);

    $_SESSION['profile_success'] = 'Ihre Daten wurden aktualisiert.';
    wp_safe_redirect( home_url($_POST['_wp_http_referer']) );

});