<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/30/2018
 * Time: 12:05 PM
 */
include('init.php');

$helper = $fb->getRedirectLoginHelper();

$permissions = ['manage_pages','publish_pages'];
$loginUrl = $helper->getLoginUrl('http://localhost/testphp/api3/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>

