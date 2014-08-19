<html>
    <head>
    <link rel="text/stylesheet" href="login.css"/>
        
        <script type="text/javascript">
            function redirect(){

        window.location="https://www.facebook.com/dialog/oauth?client_id=694159134003863&redirect_uri=http://localhost/fblikes/login-process.php&scope=public_profile,user_friends,email";
            }
        </script>
        
    </head>
    <body>    
        <div class="login-message">
        For using this site Login with facebook:
            <br>
        <button onclick="redirect()" value="Login">login</button>
            
        </div>
    
    </body>

</html>