<?php
session_start();
require_once( 'Facebook/autoload.php' );
require_once( 'db.php' );

$fb = new Facebook\Facebook([
    'app_id' => '1125928294209166',
    'app_secret' => 'c21e86febb76d6b61c917d6f150a954f',
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error

    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues

    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}


try {
    // Get the Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());
//  print_r($response);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'ERROR: Graph ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'ERROR: validation fails ' . $e->getMessage();
    exit;
}
$me = $response->getGraphUser();
//print_r($me);
echo "Full Name: ".$me->getProperty('name')."<br>";
echo "First Name: ".$me->getProperty('first_name')."<br>";
echo "Last Name: ".$me->getProperty('last_name')."<br>";
echo "Email: ".$me->getProperty('email');
echo "Facebook ID: <a href='https://www.facebook.com/".$me->getProperty('id')."' target='_blank'>".$me->getProperty('id')."</a>";
?>