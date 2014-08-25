<html>
    <body>
        
        

        
    </body>
</html>
    
    
    
<html>
    <head>
    <link rel="stylesheet" href="style1.css"/>
        
        <script type="text/javascript">
            function redirect(){

        window.location="https://www.facebook.com/dialog/oauth?client_id=694159134003863&redirect_uri=http://likestracker.com/login-process.php&scope=public_profile,user_friends,email";
            }
            
            
                    
        </script>
        
    </head>
    <body id='body'> 
        <? 

        include 'session-check.php';

//        include './leaderboard.php';
        require 'connect.php';
        
        $query="SELECT * FROM reg_users where fbid ='$fbid' ";
        $result = $db->query($query) or die ('There was an error during database access [' . $db->error . ']');

        if ($result->num_rows>1)
        {
            ?>
                <script type="text/javascript">
                        alert("Database Error");
                        setTimeout(redirect(), 1000);
                </script>
            <?php
        }
        $data=$result->fetch_assoc();

        ?>
    
       <div class="nav">
        <ul class="left">
           <li><a href="https://www.facebook.com/delta.nit.trichy"><img src="./images/delta.png"></a> </li>
           <li><a href="leaderboard.php">Leaderboard</a> </li>
          <li><a href="updates.php">Updates</a> </li>


            
        </ul>
        <ul class="right">
            <li><a href="logout.php">Logout</a>
                
            </li>
           
           
        </ul>
        
       </div>
        
        <div class="content">
            
            <div class="dashboard">
             <? echo "Hello " . $data['display_name'];  
        ?>
        <br><br>
        <img class="profile_pic" src='<?php echo $data['profile_pic']?>' >        

        <br><p id="refferal_link"> Your Referal Link is <a href = "http://likestracker.com/likes.php?fbid=<?php echo $fbid ?>">http://likestracker.com/likes.php?fbid=<?php echo $fbid ?></p>
            <p id="likes"> You Refered <?php echo $data['counter']; ?> friends to like our page</p>

            </div>

        </div>

   
    </body>

</html>



