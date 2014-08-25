<?php

//_____________________________________________________________________________________________________________________________
//Sessions Check
session_start();

if (!isset($_SESSION['fbid']))
{

    //Sending Data back to 'likethepage'
    echo "{";
    echo "\"redirect\": 1";
    echo "}";       
    die();
}

//_______________________________________________________________________________________________________________________________

$liked= $_GET['liked'];
$access_token=$_SESSION['access_token'];
$fbid=$_SESSION['fbid'];
            
//Getting Data From Facebook about the liker    
$url="https://graph.facebook.com/v2.1/me?fields=id,name,picture.height(1000).width(1000)&access_token=$access_token";   
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$cl=curl_exec($ch);

$fb_data=json_decode($cl);

$fbid_liker=$fb_data->id;
$name_liker=$fb_data->name;

//connecting to database
include 'connect.php';

//___________________________________________________________________________________________________________________________________
//User Disliked The Page

if ($liked==0)
{
    //Liker disliked the page
    $query="UPDATE `likes` SET `liked` = 0, `referer_id`='$fbid' WHERE `invitees_id` ='$fbid_liker' ";
    $db->query($query) or die ('There was an error Updating Data into Databases [' . $db->error . ']');
      
    //Sending Data back to 'likethepage'
    echo "{";
    echo "\"data\": \"$liked You Have Not Liked The Page. \"";
    echo "}";
    die();
}


//____________________________________________________________________________________________________________________________________
//Liker Liked The Page


else if ($liked==1)
{
    

    //Querying Database to find if registered before.
    
    $query="SELECT * FROM reg_users where fbid ='$fbid_liker' ";
    $result = $db->query($query) or die ('There was an error during Database Entry [' . $db->error . ']');

    $query="SELECT * FROM likes where invitees_id ='$fbid_liker' ";
    $result1 = $db->query($query) or die ('There was an error during Database Entry [' . $db->error . ']');

     if(!($result->num_rows+$result1->num_rows))
    {
        //_____________________________________________________________________________________________________________________________
        //Data about the liker not present in DB
        //Getting profile picture of the user and savig it as fbid.jpg

        $profile_pic_url =$fb_data->picture->data->url;
        $path_parts = pathinfo($profile_pic_url);
        $extension = substr($path_parts['extension'], 0, strpos($path_parts['extension'], '?'));
        $file_name="./images/$fbid.$extension";
        $file = file_get_contents($profile_pic_url);
        file_put_contents($file_name,$file);

        //Adding to Database
        $query ="INSERT INTO likes
                (
                `referer_id`,
                `invitees_id`,
                `name`,
                `profile_pic`
                )
                VALUES
                (
                 '$fbid',
                 '$fbid_liker',
                 '$name_liker',
                 '$file_name'
                 )";

        $db->query($query) or die ('There was an error Inserting Data into Databases [' . $db->error . ']');
        //_____________________________________________________________________________________________________________________
    }
    else if(($result1->num_rows)==0)
    {
        //_____________________________________________________________________________________________________________________
        //Liker have Registered As Referer.. copying data from reg_users.

        $data=$result->fetch_assoc();
        $file_name=$data['profile_pic'];

        $query ="INSERT INTO likes
            (
            `referer_id`,
            `invitees_id`,
            `name`,
            `profile_pic`
            )
            VALUES
            (
             '$fbid',
             '$fbid_liker',
             '$name_liker',
             '$file_name'
             )";

        $db->query($query) or die ('There was an error Inserting Data into Databases [' . $db->error . ']');
        //____________________________________________________________________________________________________________________
    }
    else if($result1->num_rows>0)
    {
        //____________________________________________________________________________________________________________________
        //Liker liked and disliked before
        $query="UPDATE `likes` SET `liked` = 1, `referer_id`='$fbid' WHERE `invitees_id` ='$fbid_liker' ";
        $db->query($query) or die ('There was an error Updating Data into Databases [' . $db->error . ']');
        //____________________________________________________________________________________________________________________
    }

    //________________________________________________________________________________________________________________________
    //Sending Data back to 'likethepage'
    echo "{";
    echo "\"data\": \"$liked You Have Liked The Page. \"";
    echo "}";
    die();  
        
}

