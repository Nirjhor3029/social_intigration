<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/29/2018
 * Time: 1:47 PM
 */



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <?php



    if(isset($_POST['submit'])){

        require 'config.php';


        $url = $_POST['url'];
        $post = $_POST['post'];

        echo "$url <br> $post<br>";


        /*fb code*/
        $linkData = [
            'link' => $url,
            'message' => $post,
        ];

        try{
            //  Returns a `Facebook\FacebookResponse` object

            $response = $fb->post('/me/feed',$linkData,$_SESSION['fb_access_token']);
        }catch(Facebook\Exceptions\FacebookResponseException $e){
            echo "Graph returned an error :".$e->getMessage();
            exit;
        }catch(Facebook\Exceptions\FacebookSDKException $e){
            echo "Facebook SDK returned an error :".$e->getMessage();
            exit;
        }

        $graphnode = $response->getGraphNode();

        echo 'Posted with id: '.$graphnode['id'];

    }



    ?>
    <div class="container">
        <h2>Facebook post</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Url:</label>
                <input type="text" class="form-control" id="" placeholder="Enter Url" name="url">
            </div>
            <div class="form-group">
                <label for="pwd">Post:</label>
                <textarea  class="form-control" id="" placeholder="Enter Facebook Post" name="post"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Post on Facebook</button>
        </form>
    </div>
</div>

</body>
</html>
