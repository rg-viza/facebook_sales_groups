<?php
/**
 * Created by PhpStorm.
 * User: npdav
 * Date: 10/23/2017
 * Time: 10:26 PM
 */

?>

<html>
    <head>

    </head>
    <body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1125928294209166',
                cookie     : true,
                xfbml      : true,
                version    : 'v2.10'
            });

            FB.AppEvents.logPageView();

        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];

            if (d.getElementById(id)) {alert(fjs.toString());return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    </body>
</html>
