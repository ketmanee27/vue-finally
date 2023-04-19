<?php
session_start();
echo $user_id=$_SESSION['user_id'];
echo "<br/>";
echo $user_type=$_SESSION['user_type'];
?>