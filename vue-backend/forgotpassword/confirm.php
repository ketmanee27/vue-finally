<?php session_start();
 include('class_conn.php');
 ?>
 <?php $cls_conn=new class_conn;?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>FORGOT PASSWORD</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="template/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="template/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/css/util.css">
	<link rel="stylesheet" type="text/css" href="template/css/main.css">
<!--===============================================================================================-->
<style type="text/css">
 

.container{
	display: flex;
	flex-flow: column;
	height: 100%;
	align-items: space-around;
	justify-content: center;
}

.userInput{
	display: flex;
	justify-content: center;
}

input{
	margin: 10px;
	height: 35px;
	width: 65px;
	border: none;
	border-radius: 5px;
	text-align: center;
	font-family: arimo;
	font-size: 1.2rem;
	background: #eef2f3;

}

h1{
	text-align: center;
	font-family: arimo;
	color: honeydew;
}


button{
	width: 150px;
	height: 40px;
	margin: 25px auto 0px auto;
	font-family: arimo;
	font-size: 1.1rem;
	border: none;
	border-radius: 5px;
	letter-spacing: 2px;
	cursor: pointer;
	background: #616161;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #9bc5c3, #616161);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #9bc5c3, #616161); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}



</style>
</head>
<body>
	<script type="text/javascript">
		

		function clickEvent(first,last){
			if(first.value.length){
				document.getElementById(last).focus();
			}
		}           
	</script>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="template/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						CONFIRM OTP
					</span>

				 
				 
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
					<div class="userInput">
			<input type="text" name="t1" id='ist' maxlength="1" onkeyup="clickEvent(this,'sec')">
			<input type="text" name="t2"  id="sec" maxlength="1" onkeyup="clickEvent(this,'third')">
			<input type="text" name="t3"  id="third" maxlength="1" onkeyup="clickEvent(this,'fourth')">
			<input type="text" name="t4"  id="fourth" maxlength="1" onkeyup="clickEvent(this,'fifth')">
			<input type="text" name="t5"  id="fifth" maxlength="1">
		</div>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="submit">
							Confirm
						</button>
					</div>

				 

				 
				</form>
				<?php
				if(isset($_POST['submit']))
				{
					$t1=$_POST['t1'];
					$t2=$_POST['t2'];
					$t3=$_POST['t3'];
					$t4=$_POST['t4'];
					$t5=$_POST['t5'];
					$otp=$t1.$t2.$t3.$t4.$t5;
					$user_email=$_SESSION['email'];
					
					$sql=" select * from otp";
					$sql.=" where";
					$sql.=" user_email='$user_email'";
					$sql.=" order by otp_id desc limit 1";
					$rs=$cls_conn->select_base($sql);
					while($row=mysqli_fetch_array($rs))
					{
						$otp_number=$row['otp_number'];
					}
					if($otp==$otp_number)
					{
						echo $cls_conn->goto_page(1,'change_password.php');
					}
					else
					{
						echo $cls_conn->show_message('รหัส otp ไม่ถูกต้อง');
					}
					
				}


				?>

			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="template/vendor/bootstrap/js/popper.js"></script>
	<script src="template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="template/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vtemplate/endor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="template/js/main.js"></script>

</body>
</html>