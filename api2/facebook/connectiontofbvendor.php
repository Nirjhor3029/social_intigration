<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/30/2018
 * Time: 11:17 AM
 */

require_once('vendor/autoload.php');

$fb = new Facebook\Facebook([
    'app_id' => '317967925653178',
    'app_secret' => '89a8e696fe5a7da02183835a96151134',
    'default_graph_version' => 'v3.2',
    // . . .
]);

$pageAccessToken = 'EAAVoWZCeKw2cBAIZBMCwf9tynrcwrliTr0ECvEGepZARRcoa0ZCB25kFN7Vb2fWUIPnvnO3Nx3GAvooUo55TAAAW2jUruO89G9X5pKHxAlHmVyZCOCWSzrlkPeQfTEnQhKu1eq9CpbVaitD3wWOC694bm98eE1wITlAvgAci32lY2EG4C8M8ZBX8u65g7lkePcEjgV29QMyAZDZD';

$msgBody = [
    'message' => "hello there",
];

try{
    $response = $fb->post('/me/feed',$msgBody,$pageAccessToken);


}catch(Facebook\Exceptions\FacebookResponseException $e){
    echo "Graph returned an error: ".$e->getMessage();
    exit;

}catch(Facebook\Exceptions\FacebookSDKException $e){
    echo "Facebook Sdk returned an error: ".$e->getMessage();
    exit;

}

$graphNode = $response->getGraphNode();
echo "ID: ".$graphNode['id'];
?>