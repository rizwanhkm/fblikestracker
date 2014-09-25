<?php
    
    include 'app-details.php';

    //______________________________________________________________________________________________________________________________________
    //Getting Referall ID
    
    $fbid=$_GET['fbid'];
    session_start();
    $_SESSION['fbid']=$fbid;
    $_SESSION['referer']=$fbid;
    
    //This page redirects the user for getting permisions to get the likers likes and other details
?>
    

<html >
<script>
        function redirect(){

        window.location="https://www.facebook.com/dialog/oauth?client_id=<?php echo $app_id;?>&redirect_uri=<?php echo $dirname;?>/likes-process.php&scope=public_profile";
            }
        </script>
    <body onload="redirect();">
    </body>
   </html>