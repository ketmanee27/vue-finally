<?php 
	include 'db_connect.php';
	session_start();

	 extract($_GET);
 
	$type = '';
	//echo $_GET['username'];
	//$password=md5($password);
	$qry = $conn->query("SELECT * FROM users where username='$username' and password = '$password' $type ");
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $val){
			if($k != 'password')
			$_SESSION['login_'.$k] = $val;
		}
		//echo 1;
		  header( "refresh: 2; url=home.php");

	}else{
		//echo 2;
	}
?>