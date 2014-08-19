<?php

session_start();
include './leaderboard.php';

$userid=$_SESSION['access_token'];
echo "Hello ".$userid;

if(!isset($_SESSION['access_token']))
{
    ?>
            <script type="text/javascript">
            
                function redirect()
                {
                    window.location="http://localhost/fblikes/index.php";
                }
                
                alert("Session Not initiated Properly");
                setTimeout(redirect(), 1000);
            </script>



    <?php
}

$userid=$_SESSION['userid'];

echo "Your Referal Link is <a href = \"http://localhost/fblikes/likes.php?$userid\">http://localhost/fblikes/likes.php?$userid ";

?>
<a href="logout.php">Log Out</a>





