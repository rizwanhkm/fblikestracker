<?php
    
    include 'connect.php';


    $fbid =$_GET['fbid'];
    $start =$_GET['start'];
    $number =$_GET['number'];
   
    
    $query="SELECT * FROM `$likes` WHERE `referer_id` = '$fbid' AND `liked`='1'";
    $result_likers= $db->query($query) or die ('There was error fetching from database');

    
    $likers=1;

    $numberoflikers=$result_likers->num_rows;
    $nol=$numberoflikers-$start+1;

    echo "{";
    echo "\"rows\" : \"$nol\" ,";
    echo "\"liker\" : [";
    
    while($row=$result_likers->fetch_assoc())
    {
        if ($likers>=$start)
        {
            echo  json_encode($row);
        }
        else
        {
            $likers++;
            continue;
        }
        if (($likers<$start+$number-1)&&($numberoflikers>$likers))
        {
            echo ",";
        }
        else 
        {
            break;
        }
        $likers++;
    }
    echo "]}";
?>