<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1773133156318821',
            xfbml      : true,
            version    : 'v2.10'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Init PHP Sessions
session_start();

$fb = new Facebook([
'app_id' => '1773133156318821',
'app_secret' => '3b1d7235a0b8444e2b02448773506b1b',
]);

$helper = $fb->getRedirectLoginHelper();

if (!isset($_SESSION['facebook_access_token'])) {
$_SESSION['facebook_access_token'] = null;
}

if (!$_SESSION['facebook_access_token']) {
$helper = $fb->getRedirectLoginHelper();
try {
$_SESSION['facebook_access_token'] = (string) $helper->getAccessToken();
} catch(FacebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
exit;
} catch(FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}
}

if ($_SESSION['facebook_access_token']) {
echo "You are logged in!";
} else {
$permissions = ['ads_management'];
$loginUrl = $helper->getLoginUrl('http://localhost:8888/marketing-api/', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook</a>';
}