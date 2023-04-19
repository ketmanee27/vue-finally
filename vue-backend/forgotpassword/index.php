<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
 include('class_conn.php');?>
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
						FORGOT PASSWORD
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						 
					</div>
					<div class="container-login100-form-btn">
						<button  type="submit" name="submit" class="login100-form-btn">
							SEND E-MAIL
						</button>
					</div>
				 
				  

				 
				</form>
				<?php
				if(isset($_POST['submit']))
				{
					$email=$_POST['email'];

					$sql=" select * from user";
					$sql.=" where user_email='$email'";
					 
					$check=$cls_conn->select_numrows($sql);


					if($check==0)
					{
						
						echo $cls_conn->show_message('ไม่พบอีเมลล์นี้');



					}
					else
					{
						echo $cls_conn->show_message('กรุณาตรวจสอบอีเมลล์ของท่าน');
						
						
						$SixDigitRandomNumber = mt_rand(10000,99999);
						$_SESSION['email']=$email;
						//$_SESSION['otp']=$otp;
						//echo $SixDigitRandomNumber;
						$datettime=date('Y-m-d H:i:s');

						$sql=" insert into otp(otp_number,user_email,otp_datetime)";
						$sql.=" values ('$SixDigitRandomNumber','$email','$datettime')";
						$cls_conn->write_base($sql);
									
						
						

						 {
						$name = 'OTP Verification';
						$email = $email;
						$header = 'OTP for reset password';
						$detail =  $SixDigitRandomNumber;
						 }
				

							require_once "PHPMailer/PHPMailer.php";
							require_once "PHPMailer/SMTP.php";
							require_once "PHPMailer/Exception.php";

							$mail = new PHPMailer();

							
							$mail->isSMTP();
							$mail->Host = "smtp.gmail.com";
							$mail->SMTPAuth = true;
							$mail->Username = "doyoung9899@gmail.com"; 
							$mail->Password = "lxgspjlmbyzuhfgs";
							$mail->Port = 465;
							$mail->SMTPSecure = "ssl";

							$mail->isHTML(true);
							$mail->setFrom($email, $name);
							$mail->addAddress($email); 
							$mail->Subject = $header;
							$mail->Body = $detail;

							if($mail->send()) {
								$status = "success";
								$response = "Email is sent";
								echo $cls_conn->goto_page(1,'confirm.php');
							} else {
								$status = "failed";
								$response = "Something is wrong" . $mail->ErrorInfo;
							}

						
					 
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