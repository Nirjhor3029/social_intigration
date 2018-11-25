<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/30/2018
 * Time: 1:14 PM
 */

include('init.php');

$page_AccessToken = $_SESSION['pageAccessToken'] ;
$page_ID = $_SESSION['page_ID'];

/*For page post read*/
/* PHP SDK v5.0.0 */
/* make the API call */
try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get(
        '/'.$page_ID.'/feed',
        $page_AccessToken
    );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
/*$page_post_graphNode = $response->getGraphNode();*/

$page_post_graphNode = $response->getGraphNodeF();

/*$page_post_graphNode = $response->getAccessToken();*/
/* handle the result */
/*For page post read*/
echo "<br><hr>";
print_r($page_post_graphNode);
echo "<br><hr>";

?>