<?php

$dbserver = 'localhost';
$dbport = '3306';
$dbusername = 'root';
$dbpassword = 'root';
$dbname = 'rbac';

$link = mysqli_connect($dbserver, $dbusername, $dbpassword, $dbname, $dbport);
 
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}