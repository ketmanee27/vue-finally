<?php
    
    session_start();
    include('connectDB.php');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    
 
    if (!isset($_SESSION['user_email']) ||(trim ($_SESSION['user_passwor']) == '')){
        header('location:Login.vue');
    }
 
    $sql="SELECT * FROM user WHERE user_id='".$_SESSION['user_email']."'";
    $query=$conn->query($sql);
    $row=$query->fetch_array();
 
?>