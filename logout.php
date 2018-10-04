<?php

ini_set("display_errors", 1);

session_start();
 
$_SESSION = array();
 
session_destroy();
 
header("location: login.php");
exit;