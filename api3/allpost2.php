<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/30/2018
 * Time: 1:46 PM
 */

include('init.php');

$page_AccessToken = $_SESSION['pageAccessToken'];
$page_ID = $_SESSION['page_ID'];

$page_title = "Facebook page posts";

echo $page_title;

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $page_title; ?></title>

    <link rel="stylesheet" href="bootstrap.min.css">


    <style>
        .profile-info {
            overflow: hidden;
        }

        .profile-photo {
            float: left;
        }

        .profile-photo img {
            width: 40px;
            height: 40px;
        }

        .profile-name {
            float: left;
            margin: 0 0 0 .5em;
        }

        .time-ago {
            color: #999;
        }

        .profile-message {
            margin: 1em 0;
        }

        .post-link {
            text-decoration: none;
        }

        .post-content {
            background: #f6f7f9;
            border: 1px solid #d3dae8;
            overflow: hidden;
        }

        .post-content img {
            width: 100%;
        }

        .post-status {
            margin: .5em;
            font-weight: bold;
        }

        .post-picture {
            width: 25%;
            float: left;
        }

        .post-info {
            width: 70%;
            float: left;
            margin: .5em;
        }

        .post-info-name {
            font-weight: bold;
        }

        .post-info-description {
            color: #999;
        }
    </style>

</head>
<body>

<div class="container">
    <div class='col-lg-12'>

        <!-- page feed code will be here -->

        <?php
        echo "<h1 class='page-header'>{$page_title}</h1>";

        $fb_page_id = $page_ID;
        $profile_photo_src = "https://graph.facebook.com/{$fb_page_id}/picture?type=square";
        $access_token = $page_AccessToken;
        $fields = "id,message,picture,link,name,description,type,icon,created_time,from,object_id";
        $limit = 5;

        $json_link = "https://graph.facebook.com/{$fb_page_id}/feed?access_token={$access_token}&fields={$fields}&limit={$limit}";
        $json = file_get_contents($json_link);

        $obj = json_decode($json, true);

        echo "<pre>";
        print_r($obj);
        echo "</pre>";


        echo "<hr>";
        echo "<hr>";



/*        "https://graph.facebook.com/v3.2/195957211298300_196050921288929?fields=comments&access_token=EAAVoWZCeKw2cBAK9LSaZA8XvBVc7UOZAWy80gZAgqKCYS4ApjtinTbj7PZB0zpPZBV3ZCSfsO3a5NXAXfVxGmYwcqZBMjT9UcxIzBbLNbync0lnJyZB1ISltQZB8pflmDnV3WRw2FfwadOKxHE0ugfZAle0aLPfbfhJYXYfCaU57HJh5xS0xEZBIxnCZAoOnmfdrroxIZD"*/

        $fields = "comments";
        $json_link_for_comments = "https://graph.facebook.com/v3.2/{$obj['data'][0]['id']}?access_token={$access_token}&fields={$fields}&limit={$limit}";
        $json_for_comments = file_get_contents($json_link_for_comments);

        $obj_for_comments = json_decode($json_for_comments, true);

        echo "<pre>";
        print_r($obj_for_comments);
        echo "</pre>";


        //exit;






        $feed_item_count = count($obj['data']);


        /*edit*/
        $id = '';
        $picture_url = '';
        $link = '';
        $name = '';
        $description = '';
        $type = '';
        $id = '';
        $id = '';

        echo "<br>$feed_item_count<br>";

        for ($x = 0; $x < $feed_item_count; $x++) {

            echo $x."<br>";

            // to get the post id
            $id = $obj['data'][$x]['id'];
            $post_id_arr = explode('_', $id);
            $post_id = $post_id_arr[1];

            //echo $post_id;

            ///exit;
            // user's custom message
            $message = $obj['data'][$x]['message'];

            if(isset($obj['data'][$x]['picture'])){
                // picture from the link
                $picture = $obj['data'][$x]['picture'];
                $picture_url_arr = explode('&url=', $picture);
                $picture_url = urldecode($picture_url_arr[0]);


            }




            if(isset($obj['data'][$x]['link'])){
                // link posted
                $link = $obj['data'][$x]['link'];
            }


            if(isset($obj['data'][$x]['name'])){
                // name or title of the link posted
                $name = $obj['data'][$x]['name'];
            }


            if(isset($obj['data'][$x]['description'])){
                $description = $obj['data'][$x]['description'];
            }

            if(isset($obj['data'][$x]['type'])){
                $type = $obj['data'][$x]['type'];
            }


            // when it was posted
            $created_time = $obj['data'][$x]['created_time'];
            $converted_date_time = date('Y-m-d H:i:s', strtotime($created_time));
            $ago_value = time_elapsed_string($converted_date_time);

            // from
            $page_name = $obj['data'][$x]['from']['name'];

            if(isset($obj['data'][$x]['picture'])){


                // useful for photo
                $object_id = $obj['data'][$x]['object_id'];
            }


            /*design*/

            ?>


            <div class='row'>

                <div class='col-md-4'>

                    <div class='profile-info'>
                        <div class='profile-photo'>
                            <img src='<?php echo $profile_photo_src ?>'/>
                        </div>

                        <div class='profile-name'>
                            <div>
                                <a href='https://fb.com/{$fb_page_id}' target='_blank'><?php echo $page_name ?></a>
                                shared a
                                <?php
                                if ($type == "status") {
                                    $link = "https://www.facebook.com/{$fb_page_id}/posts/{$post_id}";
                                }
                                ?>

                                <a href='<?php echo $link ?>' target='_blank'><?php echo $type ?></a>
                            </div>
                            <div class='time-ago'><?php echo $ago_value ?></div>
                        </div>
                    </div>

                    <div class='profile-message'><?php echo $message ?></div>
                </div>


                <div class='col-md-8'>
                    <a href='<?php echo $link ?>' target='_blank' class='post-link'>

                        <div class='post-content'>

                            <?php
                            if ($type == "status") {
                                ?>

                                <div class='post-status'>
                                    View on Facebook
                                </div>
                                <?php
                            } else if ($type == "photo") {
                                ?>


                                <img src='https://graph.facebook.com/{$object_id}/picture'/>
                                <?php
                            } else {
                                if ($picture_url) {
                                    ?>


                                    <div class='post-picture'>
                                        <img src='{$picture_url}'/>
                                    </div>
                                <?php } ?>


                                <div class='post-info'>
                                    <div class='post-info-name'><?php echo $name ?></div>
                                    <div class='post-info-description'><?php $description ?></div>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                    </a>
                </div>


            </div>
            <hr/>
            <?php
        }
        ?>


    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</body>
</html>

<?php

// to get 'time ago' text
function time_elapsed_string($datetime, $full = false)
{

    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>
