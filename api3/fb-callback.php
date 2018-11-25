<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/30/2018
 * Time: 12:11 PM
 */
include('init.php');

$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];

try {

    $accessToken = $helper->getAccessToken();

} catch(Facebook\Exceptions\FacebookResponseException $e) {

    echo 'Graph returned an error: ' . $e->getMessage();
    exit;

} catch(Facebook\Exceptions\FacebookSDKException $e) {

    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;

}

if (! isset($accessToken)) {
    echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
    exit;
}

try {

    $response = $fb->get('me/accounts', $accessToken->getValue());
    $response = $response->getDecodedBody();

} catch(Facebook\Exceptions\FacebookResponseException $e) {

    echo 'Graph returned an error: ' . $e->getMessage();
    exit;

} catch(Facebook\Exceptions\FacebookSDKException $e) {

    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;

}

echo "<pre>";
print_r($response);

echo "</pre><hr>";

$pageAccessToken = $response['data'][0]['access_token'];
$page_ID = $response['data'][0]['id'];

echo "Page Access Token : ".$pageAccessToken;
echo "<br><hr>";
echo "Page Id: ".$page_ID;

/*
exit;*/

$_SESSION['pageAccessToken'] = $pageAccessToken;
$_SESSION['page_ID'] = $page_ID;

/*header("Location: post.php?pageAccessToken=".$pageAccessToken."&&page_ID=".$page_ID."");*/
header("Location: post.php");



?>