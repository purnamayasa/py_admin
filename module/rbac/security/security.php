<?php

if ($action === "login") {

	require_once "login.php";

} else if ($action === "login-process") {

	require_once "login-process.php";

} else if ($action === "logout") {

	require_once "logout.php";

} else if ($action === "register") {

	require_once "register.php";

} else if ($action === "register-process") {

	require_once "register-process.php";

} else if ($action === "reset-password") {

	require_once "reset-password.php";

} else if ($action === "reset-password-process") {

	require_once "reset-password-process.php";

}