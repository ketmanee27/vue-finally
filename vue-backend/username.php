<?php
	session_start();
	if(!ISSET($_SESSION['user_id'])){
		header('location:index.php');
	} else {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT ');
        header("Access-Control-Allow-Headers: Content-Type");
    
    $connect = new PDO("mysql:host=localhost;dbname=project", "root", "");
    $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
 
				echo "<h2 class='text-success'>".$fetch['username']."</h2>";
}


?>
