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