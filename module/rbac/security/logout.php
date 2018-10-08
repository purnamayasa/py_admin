<?php
 
$_SESSION = array();
 
session_destroy();
 
header("location: index.php?module=rbac/security&action=login");
exit;