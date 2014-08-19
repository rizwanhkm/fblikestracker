<?php

    //Checking whether user granted permissions to the app.
        
    $error =$_GET['error'];
    $error_code = $_GET['error_code'];
    if ( $error == "access_denied" )
    {
            //User Denied Permission.... Redirecting to the Cover Page
?>
         <script type="text/javascript">

             function redirect()
             {
                 window.location = "http://localhost/fblikes/index.php";
             }

             alert("You have denied permissions for the app. Redirecting to Login Page");

             setTimeout(redirect(),1000);

        </script>
     
<?
    die() ;

    }
    
    //User granted required permissions



    //App details

    
    $code= $_GET['code'];
    $app_id='694159134003863';
    $app_secret = 'f22c633354f1cadb27d1c72310eab37d';

    //getting the current page url for recieving access token

    $current_url = 'http://';
    if ($_SERVER["SERVER_PORT"] != "80") 
        {
            $current_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }
    else 
        {
            $current_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
    echo $current_url;
    
    $url = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&redirect_uri=$current_url&client_secret=$app_secret&code=$code";
    echo '<br><br>';
    echo $url;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    echo '<br><br>';

    $cl=curl_exec($ch);
    echo $cl;
    $access_token=substr($cl, 13,-16);
    echo '<br><br>';
    echo $access_token;

    //creating a session to store access token
    
    
    

    





