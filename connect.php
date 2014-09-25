<?php
    $host="localhost";

    $user="root";
    $password="pass";
    $dbname="fblikes";
    
    $db = new mysqli($host, $user, $password, $dbname)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    $reg_users = "reg_users";
    $likes = "likes";

?>
