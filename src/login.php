<?php
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

    if(!empty($_POST['redirect'])){
        wp_safe_redirect($_POST['redirect']);
    }else{
        wp_safe_redirect(get_field('field_601bc4580a4fc', 'option'));
    }
});
