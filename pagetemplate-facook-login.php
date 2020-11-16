<?php
/**
 * Template Name: Facebook login
 */
use Overtrue\Socialite\SocialiteManager;

$config = [
    'facebook' => [
        'client_id'     => '831950683917414',
        'client_secret' => 'd6d52d59ce1f1efdbf997b980dffe229',
        'redirect'      => home_url('fb-login'),
    ],
];

$socialite = new SocialiteManager($config);

$code = $_GET['code'];

$user = $socialite->create('facebook')->userFromCode($code);

$name = $user->getName();      // "安正超"
$email = $user->getEmail();     // "anzhengchao@gmail.com"

$name = explode(' ', $name);
$firstname = '';

if (count($name) > 1) {
    $firstname = array_shift($name);
}
$lastname = implode(' ', $name);

$user = get_user_by('email', $email);

if ( $user ) {
    wp_clear_auth_cookie();
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID);


    wp_safe_redirect(home_url('profil'));
    exit();
}else{

    $_SESSION['login_error'] = 'Wir konnten Sie mit dieser E-Mail Adresse nicht einloggen.';
    wp_safe_redirect(home_url($_POST['login']));
    exit;
}
