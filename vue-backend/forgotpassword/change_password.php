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
						Change PASSWORD
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="password" name="password1" placeholder="password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
						 
					</div>

                    <div class="wrap-input100 validate-input" >
						<input class="input100" type="password" name="password2" placeholder="password confirm" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
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
					$email=$_SESSION['email'];
                    $password1=$_POST['password1'];
                    $password2=$_POST['password2'];

                    if($password1==$password2)
                    {
                        $new_password=md5($password1);
                        $sql=" update user";
                        $sql.=" set";
                        $sql.=" user_password='$new_password'";
                        $sql.=" where";
                        $sql.=" user_email='$email'";
                       
                        $cls_conn->write_base($sql);


						 
                        $sql2=" update users";
                        $sql2.=" set";
                        $sql2.=" password='$new_password'";
                        $sql2.=" where";
                        $sql2.=" username='$email'";
                       
                        $cls_conn->write_base($sql2);


                        echo $cls_conn->show_message('เปลี่ยนรหัสผ่านสำเร็จ');
                    }
                    else
                    {
                        echo $cls_conn->show_message('รหัสผ่านไม่ตรงกัน');
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