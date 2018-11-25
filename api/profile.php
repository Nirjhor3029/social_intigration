<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/29/2018
 * Time: 1:22 PM
 */
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<?php

?>
<body>

<?php


    session_start();
    require 'Facebook/autoload.php';

    $fb = new Facebook\Facebook([
        'app_id' => '1522119087932263', // Replace {app-id} with your app id
        'app_secret' => 'dab5006761762d95f465818c2a94bdd4',
        'default_graph_version' => 'v3.2',
    ]);


    try {
        // Returns a `Facebook\FacebookResponse` object
        $response_User = $fb->get('/me?fields=id,name,email,cover,gender,picture,link', $_SESSION['fb_access_token']);

        /*Edit*/
        $response_image = $fb->get('/me/picture?redirect=false&width=250&height=250', $_SESSION['fb_access_token']);

        /*Edit*/

    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $user = $response_User->getGraphUser();
    $image = $response_image->getGraphUser();

    echo "<hr><br><pre>";
    print_r($user);
echo "<br><hr>";
    print_r($image);
    echo "</pre><hr><br>";
    echo 'Name: ' . $user['name'];
    // OR
    // echo 'Name: ' . $user->getName();
?>

<div>
    <img src="">
</div>
</body>
</html>
