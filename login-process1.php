<?php
    
    error_reporting(1);
    
    //___________________________________________________________________________________________________________________________
    //Checking whether user granted permissions to the app.

        
    $error =$_GET['error'];
    $error_code = $_GET['error_code'];
    if ( $error == "access_denied" )
    {
        //-----------------------------------------------------------------------------------------------------------------------
        //User Denied Permission.... 
        //Redirecting to the Cover Page
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
        //_______________________________________________________________________________________________________________________
    }
    
    //___________________________________________________________________________________________________________________________
    //App details

    $code= $_GET['code'];
    $app_id='694159134003863';
    $app_secret = 'f22c633354f1cadb27d1c72310eab37d';
    
    
    
    //___________________________________________________________________________________________________________________________
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
        
    //__________________________________________________________________________________________________________________________________
    //curling facebook graph api and getting access token

    $url = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&redirect_uri=$current_url&client_secret=$app_secret&code=$code";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $cl=curl_exec($ch);
    $access_token=substr($cl, 13,-16);
  
    //_____________________________________________________________________________________________________________________________
    //getting user data from facebook
    
    $url="https://graph.facebook.com/v2.1/me?fields=id,name,first_name,last_name,email&access_token=$access_token";   
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $cl=curl_exec($ch);
    $fb_data=json_decode($cl);
    
    $fbid=$fb_data->id;
    $name=$fb_data->name;
    $first_name=$fb_data->first_name;
    $last_name=$fb_data->last_name;
    $email=$fb_data->email;
    echo "<br>".$fbid."<br>".$name."<br>".$first_name."<br>".$last_name."<br>".$email;
    


    //______________________________________________________________________________________________________________________________
    //Adding to Database

    //connecting to database
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="pass";
    $dbname="fblikes";
    
    $reg_user_table = "reg_users";

    $db = new mysqli($host, $user, $password, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());


    //Querying Database to find if registered before.
    $query="SELECT * FROM `$reg_user_table` WHERE '$reg_user_table`.`fbid`= `$fbid` ";
    $result = $db->query($query) or die ('There was an error during Database Entry [' . $db->error . ']');
    

    //Adding to database if no entry is found..
    if (!$result->num_rows)
    {
        $counter=0;        
        $query ="INSERT INTO '$reg_user_table'
                    (
                    `Fbid`,
                    `display_name`,
                    `first_name`,
                    `last_name`,
                    `email`,
                    `counter`)
                    VALUES
                    (
                     `$fbid`,
                     `$name`,
                     `$first_name`,
                     `$last_name`,
                     `$email`,
                     `$counter`
                    )";

            $db->query($query) or die ('There was an error Inserting Data into Databases [' . $db->error . ']');
    }
    
    $db->close();
    
    //_______________________________________________________________________________________________________________________________
    //Storing Data for current session

    session_start();
    $_SESSION['access_token']=$access_token;
    $_SESSION['userid']=$fbid;
    
    
    
    //______________________________________________________________________________________________________________________________
    //Redirecting User to dashboard

    header("Location: ./user-dashboard.php");
     
    //______________________________________________________________________________________________________________________________

?>
