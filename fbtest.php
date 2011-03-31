
<html>
    <head>

    </head>
    <body>



        <?php
            include_once "inc/fbmain.php";
            $config['baseurl']  =   "http://wikirace.christopherdebeer.com";

            if ($fbme) {
                echo "<br />Profile Pic: <img src='http://graph.facebook.com/".$fbme['id']."/picture' alt='' />";
                echo "<br />Name: " . $fbme['first_name'] . " " . $fbme['last_name'];
                echo "<br />UID: " . $fbme['id'];
                echo "<br />Email: " . $fbme['email'];
                echo "<br />DOB: " . $fbme['birthday'];
            } else {
                echo "FBME object returned false.";
            }

            $ispagefan = $facebook->api_client->pages_isFan('113686942037525');
            echo $ispagefan;





        ?>


        <fb:like></fb:like>
        <div id="fb-root"></div>
        <script>window.fbAsyncInit = function() {
        FB.init({appId: '113686942037525', status: true, cookie: true,
        xfbml: true});
        };
        (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
        }());</script>
    </body>
</html>

