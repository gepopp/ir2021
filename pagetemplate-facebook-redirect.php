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

$user->getId();        // 1472352
$user->getNickname();  // "overtrue"
$user->getUsername();  // "overtrue"
$user->getName();      // "安正超"
$user->getEmail();     // "anzhengchao@gmail.com"