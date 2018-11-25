<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/30/2018
 * Time: 12:04 PM
 */
session_start();

require_once('Facebook/autoload.php');

$fb = new Facebook\Facebook([
    'app_id' => '1522119087932263',
    'app_secret' => 'dab5006761762d95f465818c2a94bdd4',
    'default_graph_version' => 'v3.2',
]);

?>


