<?php
session_start();
session_destroy();
include 'app-details.php'

header("Location: $dirname/index.php");

?>