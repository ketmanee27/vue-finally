<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT ');
header("Access-Control-Allow-Headers: Content-Type");

unset($_SESSION["user_id"]);
unset($_SESSION["user_type"]);
unset($_SESSION["user_firstname"]);
unset($_SESSION["user_lastname"]);
unset($_SESSION["user_email"]);
unset($_SESSION["user_birthday"]);
unset($_SESSION["user_age"]);
unset($_SESSION["user_district"]);
unset($_SESSION["user_province"]);
unset($_SESSION["create_at"]);
// header("Location:login.php");
?>