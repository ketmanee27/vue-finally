<!DOCTYPE html>
<html>
	<head>
		<?php include('header.php') ?>
        <?php 
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:home.php');
        }
        ?>
		<title>E-learning for Hens</title>
	</head>

	<body id='login-body' class="bg-light">

        <div class="card col-md-6 offset-md-3 text-center bg-primary mb-4">
		
            <h3 class="he3-responsive text-white">E-learning for Hens</h3>
        </div>
		<div class="card col-md-4 offset-md-4 mt-4">
                <div class="card-header-edge text-white">
                    <strong>Login <?=$_GET['user_email'];?> <?=$_GET['pass'];?> </strong>
                </div>
            <div class="card-body">
                     <form id="login-frm">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="username" name="username" value="<?=$_GET['user_email'];?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
							 
                            <input type="text" name="password" value="<?=$_GET['pass'];?>"  class="form-control">
                        </div> 
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block" type="submit" name="submit">Login</button>
                        </div>
                        
                    </form>
            </div>
        </div>

		</body>
		
		<script>
var auto_refresh = setInterval(function() { submitform(); }, 10000);

// function submitform()
// {
//   alert('test');
//   document.getElementById("login-frm").submit();
// }
function ajax_submit(){
	 alert('login');
	 
                    e.preventDefault()
                    $('#login-frm button').attr('disable',true)
                    $('#login-frm button').html('Please wait...')

                    $.ajax({
                        url:'./login_auth.php',
                        method:'POST',
                        data:$(this).serialize(),
                        error:err=>{
                            console.log(err)
                            alert('An error occured');
                            $('#login-frm button').removeAttr('disable')
                            $('#login-frm button').html('Login')
                        },
                        success:function(resp){
                            if(resp == 1){
                                location.replace('home.php')
                            }else{
                                alert("Incorrect username or password.")
                                $('#login-frm button').removeAttr('disable')
                                $('#login-frm button').html('Login')
                            }
                        }
                    })

             
}
</script>

        <script>
            $(document).ready(function(){
                $('#login-frm').submit(function(e){
                    e.preventDefault()
                    $('#login-frm button').attr('disable',true)
                    $('#login-frm button').html('Please wait...')

                    $.ajax({
                        url:'./login_auth.php',
                        method:'POST',
                        data:$(this).serialize(),
                        error:err=>{
                            console.log(err)
                            alert('An error occured');
                            $('#login-frm button').removeAttr('disable')
                            $('#login-frm button').html('Login')
                        },
                        success:function(resp){
                            if(resp == 1){
                                location.replace('home.php')
                            }else{
                                alert("Incorrect username or password.")
                                $('#login-frm button').removeAttr('disable')
                                $('#login-frm button').html('Login')
                            }
                        }
                    })

                })
            })
        </script>
</html>