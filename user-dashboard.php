<html>
    <head>
        <link rel="stylesheet" href="style.css" />

    <script type="text/javascript">
        function redirect()
            {
                window.location="http://likestracker.com/index.php";
            }
    </script>
    </head>
    <body>
        <?php
        session_start();
        $fbid=$_SESSION['fbid'];
        $access_token=$_SESSION['access_token'];
        
        if(!isset($_SESSION['fbid']))
        {
            ?>
                    <script type="text/javascript">
                        alert("Session Not initiated Properly");
                        setTimeout(redirect(), 1000);
                    </script>
            <?php
        }

        include './leaderboard.php';
        require 'connect.php';
        
        $query="SELECT * FROM reg_users where fbid ='$fbid' ";
        $result = $db->query($query) or die ('There was an error during database access [' . $db->error . ']');

        if ($db->num_rows>1)
        {
            ?>
                <script type="text/javascript">
                        alert("Database Error");
                        setTimeout(redirect(), 1000);
                </script>
            <?php
        }
        $data=$result->fetch_assoc();

        echo "Hello " . $data['display_name'];  
        ?>
        <br>
        <img class="profile_pic" src='<?php echo $data['profile_pic']?>' >        

        <br><br>Your Referal Link is <a href = "http://likestracker.com/likes.php?fbid=<?php echo $fbid ?>">http://likestracker.com/likes.php?fbid=<?php echo $fbid ?>

        
        <br>
        <a href="logout.php">Log Out</a>
    </body>
</html>




