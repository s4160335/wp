<?php require_once "includes/db_connect.inc";
$_SESSION = [];
session_regenerate_id(true);

$_SESSION["flash_message"] = "You have been logged out successfully.";
$_SESSION["flash_type"] = "success";

header("Location: index.php");
exit;
