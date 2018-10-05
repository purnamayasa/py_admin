<?php

if ($action == "data") {

	require_once "data.php";

} else if ($action == "create") {

	require_once "form.php";

} else if ($action == "update") {

	require_once "form.php";

} else if ($action == "delete") {

	require_once "action.php";

} else if ($action == "save") {

	require_once "action.php";

} else {

	require_once "data.php";

}