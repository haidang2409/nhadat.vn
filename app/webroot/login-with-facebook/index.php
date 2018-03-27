<?php
session_start();
require_once 'Facebook/autoload.php';
$fb = new Facebook\Facebook ([
    'app_id' => '177466519511280',
    'app_secret' => '2a13971b11ad0885d0590b4ef688497b',
    'default_graph_version' => 'v2.4',
    'persistent_data_handler'=>'session'
  ]);

$helper = $fb->getRedirectLoginHelper();


try
{
    $accessToken = $helper->getAccessToken();
}
catch(Facebook\Exceptions\FacebookResponseException $e)
{
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
}
catch(Facebook\Exceptions\FacebookSDKException $e)
{
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    $permissions = array('public_profile','email'); // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://nhadatphong.com/login-with-facebook/', $permissions);
    header("Location: ".$loginUrl);  
  exit;
}

try {
  // Returns a `Facebook\FacebookResponse` object
  $fields = array('id', 'name', 'email');
  $response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo '<br />Faceook ID: ' . $user['id'];
echo '<br />Faceook Name: ' . $user['name'];
echo '<br />Faceook Email: ' . $user['email'];
?>