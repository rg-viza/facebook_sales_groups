<?php
/**
 * Created by PhpStorm.
 * User: npdav
 * Date: 10/24/2017
 * Time: 7:24 PM
 */

session_start();
require_once( 'Facebook/autoload.php' );

$fb = new Facebook\Facebook([
    'app_id' => '1125928294209166',
    'app_secret' => 'c21e86febb76d6b61c917d6f150a954f',
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('http://demo.phpgang.com/facebook-login-sdk-v5/callback.php', $permissions);
header("location: ".$loginUrl);

