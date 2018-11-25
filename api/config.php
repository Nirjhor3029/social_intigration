<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/29/2018
 * Time: 4:31 PM
 */

session_start();
require 'Facebook/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '1522119087932263', // Replace {app-id} with your app id
    'app_secret' => 'dab5006761762d95f465818c2a94bdd4',
    'default_graph_version' => 'v3.2',
]);
?>


