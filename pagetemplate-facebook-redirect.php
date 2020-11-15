<?php
/**
 * Template Name: Facebook OAuth
 */

use Overtrue\Socialite\SocialiteManager;

$config = [
    'github' => [
        'client_id' => 'your-app-id',
        'client_secret' => 'your-app-secret',
        'redirect' => 'http://localhost/socialite/callback.php',
    ],
];

$socialite = new SocialiteManager($config);

$code = $_GET['code'];

$user = $socialite->create('facebook')->userFromCode($code);

$user->getId();        // 1472352
$user->getNickname();  // "overtrue"
$user->getUsername();  // "overtrue"
$user->getName();      // "安正超"
$user->getEmail();     // "anzhengchao@gmail.com"