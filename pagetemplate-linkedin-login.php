<?php
/**
 * Template Name: linkedin login
 */

use Overtrue\Socialite\SocialiteManager;
use immobilien_redaktion_2020\CampaignMonitor;

$config = [
    'linkedin'   => [
        'client_id'     => '78q1kul4q95hsh',
        'client_secret' => 'mO7jlH6rG9bahUrX',
        'redirect'      => home_url('l-oauth'),
    ],
];

$socialite = new SocialiteManager($config);

$code = $_GET['code'];
$user = $socialite->create('linkedin')->userFromCode($code);

wp_die(var_dump($user));

$name = $user->getName();      // "安正超"
$email = $user->getEmail();     // "anzhengchao@gmail.com"

$name = explode(' ', $name);
$firstname = '';

if (count($name) > 1) {
    $firstname = array_shift($name);
}
$lastname = implode(' ', $name);

$user = get_user_by('email', $email);

if (!$user) {

    $wp_user = wp_create_user($firstname . ' ' . $lastname . ' ' . uniqid(), uniqid(), $email);
    wp_update_user([
        'ID'           => $wp_user,
        'display_name' => trim($firstname . ' ' . $lastname),
        'first_name'   => $firstname,
        'last_name'    => $lastname,
    ]);

    (new CampaignMonitor())->transactional('registration_activated', $wp_user);

}



wp_clear_auth_cookie();
wp_set_current_user($user->ID);
wp_set_auth_cookie($user->ID);

if(!empty($_GET['state'])){

    $decoded = base64_decode($_GET['state']);
    if(!$decoded){
        $decoded = sanitize_text_field($_GET['state']);
    }

    wp_redirect(urldecode_deep($decoded));
    exit();
}

wp_safe_redirect(get_field('field_601bc4580a4fc', 'option'));
exit();

