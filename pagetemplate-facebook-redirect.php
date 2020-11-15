<?php
/**
 * Template Name: Facebook OAuth
 */

use Overtrue\Socialite\SocialiteManager;

$config = [
    'facebook' => [
        'client_id'     => '831950683917414',
        'client_secret' => 'd6d52d59ce1f1efdbf997b980dffe229',
        'redirect'      => home_url('fb-oauth'),
    ],
];

$socialite = new SocialiteManager($config);

$code = $_GET['code'];

$user = $socialite->create('facebook')->userFromCode($code);

$name = $user->getName();      // "安正超"
$email =  $user->getEmail();     // "anzhengchao@gmail.com"

$name = explode(' ', $name);
$firstname = '';

if(count($name) > 1){
    $firstname = array_shift($name);
}
$lastname = implode(' ', $name);

$_SESSION['fristname'] = $firstname;
$_SESSION['lastname'] = $lastname;
$_SESSION['email'] = $email;

wp_safe_redirect(home_url('login'));