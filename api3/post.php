<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/30/2018
 * Time: 12:19 PM
 */

include('init.php');

/*$page_AccessToken = $_GET['pageAccessToken'] ;
$page_ID = $_GET['page_ID'];*/

$page_AccessToken = $_SESSION['pageAccessToken'] ;
$page_ID = $_SESSION['page_ID'];

echo "Page Access Token : ".$page_AccessToken;
echo "<br><hr>";
echo "Page Id: ".$page_ID;









?>

<!--include('init.php');

$arr = array('message' => 'Testing Post for our new tutorial. Graph API.');

$res = $fb->post('PAGE_ID/feed/', $arr,	'ACCESS_TOKEN');-->

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

        $msg_body = $_POST['post'];
        $arr = array('message' => $msg_body);

        $res = $fb->post($page_ID.'/feed/', $arr,	$page_AccessToken);

        echo "<pr><hr>";
        print_r($res->getGraphNode());
        echo "<pr><hr>";



    }



    ?>
    <div class="container">
        <h2>Facebook post</h2>
        <form action="" method="post">

            <div class="form-group">
                <label for="pwd">Post:</label>
                <textarea  class="form-control" id="" placeholder="Enter Facebook Post" name="post"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Post on Facebook</button>
        </form>
    </div>
</div>

<?php



?>

</body>
</html>
