<?php
add_action('admin_post_nopriv_new_password', function (){

    if(!wp_verify_nonce(sanitize_text_field($_POST['set_password']), 'set_password')){
        $_SESSION['email_error'] = 'Wir konnten nicht validieren das diese Anfrage von einem Menschen geschickt wurde. Bitte laden Sie die Seite neu und versuchen Sie es noch einmal.';
        wp_safe_redirect( home_url($_POST['passwort-vergessen']) );
    }

    global $wpdb;
    $user = get_user_by('email', $wpdb->get_var('SELECT email FROM wp_user_activation_token WHERE token = "' . sanitize_text_field($_POST['token']) . '"'));

    if(!$user){
        $_SESSION['email_error'] = 'Wir konnten kein neues Passwort setzten, bitte veruschen Sie es noch einmal.';
        wp_safe_redirect( home_url($_POST['passwort-vergessen']) );
    }

    if(!in_array('subscriber', $user->roles)){
        $user->add_role('subscriber');
        $user->remove_role('registered');
    }

    wp_set_password(sanitize_text_field($_POST['pw']), $user->ID);

    $wpdb->delete('wp_user_activation_token', ['email' => $user->data->user_email]);

    $_SESSION['new_password'] = true;
    wp_safe_redirect( home_url('login') );

});



add_action('admin_post_nopriv_frontend_reset_password', function (){

    if(!wp_verify_nonce(sanitize_text_field($_POST['reset_password']), 'reset_password')){
        $_SESSION['email_error'] = 'Wir konnten nicht validieren das diese Anfrage von einem Menschen geschickt wurde. Bitte laden Sie die Seite neu und versuchen Sie es noch einmal.';
        wp_safe_redirect( home_url($_POST['_wp_http_referer']) );
    }

    $user = get_user_by('email', sanitize_email($_POST['email']));

    if(!$user){
        $_SESSION['email_error'] = 'Wir konnten zu dieser Adresse keinen Eintrag finden, bitte versuchen Sie es noch einmal.';
        wp_safe_redirect( home_url($_POST['_wp_http_referer']) );
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
        [
            '%d',
            '%s',
            '%s',
            '%s',
        ]);

    $result = wp_remote_post('https://api.createsend.com/api/v3.2/transactional/smartEmail/0fd34ccb-86f1-4aa5-99e0-43c64ddc6379/send', [
        'headers' => [
            'authorization' => 'Basic ' . base64_encode('fab3e169a5a467b38347a38dbfaaad6d'),
        ],
        'body'    => json_encode([
            'To'                  => $user->data->user_email,
            "Data"
                                  => [
                'fullname' => $user->data->display_name,
                'link'     => add_query_arg(['token' => $token], home_url('passwort-reset')),
            ],
            "AddRecipientsToList" => true,
            "ConsentToTrack"      => "Yes",
        ]),
    ]);

    $_SESSION['sent_success'] = 'Wir haben Ihnen ein E-Mail mit einem Link zum zurücksetzen Ihres Passwortes gesendet, bitte überprüfen Sie Ihre Posteingang';
    wp_safe_redirect( home_url($_POST['_wp_http_referer']) );

});