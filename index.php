<?php include 'app-details.php' ?>
<html>
    <head>
    <link rel="stylesheet" href="style1.css"/>
        <script type="text/javascript">
            function redirect(){
        window.location="https://www.facebook.com/dialog/oauth?client_id=<?php echo $app_id;?>&redirect_uri=<?php echo $dirname;?>/login-process.php&scope=public_profile,user_friends,email";
            }
        </script>
    </head>
    <body id='body'> 
       <div class="nav">
            <ul class="left">
               <li><a href="https://www.facebook.com/delta.nit.trichy"><img src="./images/delta.png"></a> </li>
               <li><a href="leaderboard.php">Leaderboard</a> </li>

            </ul>
            <ul class="right">
                <li><a href="logout.php">Logout</a></li>

            </ul>
       </div>
       <div class="content">
            <div class="login_message">
                Register For The Facebook Likes Challenge
                <br><br>
                Login with Facebook
                <br><br>
                <button onclick="redirect()" value="Login" class="login">Login</button>
            </div>
       </div>
    </body>
</html>