<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/29/2018
 * Time: 12:52 PM
 */
?>
<?php

require ('config.php');

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions

$loginUrl = $helper->getLoginUrl('http://localhost/testphp/api/callback.php', $permissions);

//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
header('location:' .$loginUrl);


?>

