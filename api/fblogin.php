<?php
/**
 * Created by PhpStorm.
 * User: Nirjhor
 * Date: 10/29/2018
 * Time: 2:12 PM
 */?>

<div class="page-header">
    <h1>Share Dialog</h1>
</div>

<p>Click the button below to trigger a Share Dialog</p>

<button id="shareBtn" class="btn btn-success clearfix">Share</button>

<p style="margin-top: 50px">
<hr />
<a class="btn btn-small"  href="https://developers.facebook.com/docs/sharing/reference/share-dialog">Share Dialog Documentation</a>
</p>

<script>
    document.getElementById('shareBtn').onclick = function() {

        alert("cick");
        FB.ui({
            method: 'share',
            display: 'popup',
            href: 'https://developers.facebook.com/docs/',
        }, function(response){});
    }
</script>
