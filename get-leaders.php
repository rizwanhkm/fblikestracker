<?php

include 'connect.php';

$query= "SELECT * FROM 'reg_users' ORDER BY  counter";
$result = $db->query($query) or die ('There was an error Inserting Data into Databases [' . $db->error . ']');

while($row=$result->fetch_assoc())
{
    $fbid=$row['fbid'];
    $query="SELECT * FROM 'likes' WHERE 'referer_id' = $fbid";
    $result_likers= $db->query($query) or die ('There was error fetching from database');
    echo "{";
    
    while($row1==$result->fetch_assoc())
    {
        
        
    }

    echo "}";
}

?>