<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/navuser.css">
<link rel="stylesheet" href="css/content.css">
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <div class="sidebar-header">
                <h4><?php echo $name ?></h4>
            </div>
            <div id="sidebar-field">
  <a href="home.php" class="sidebar-item text-white">
                       <i class="fa fa-home"> </i> หน้าแรก
                </a>
</div>
            <?php if($_SESSION['login_user_type'] == 1): ?>

        <div id="sidebar-field">		
        <a href="faculty.php" class="sidebar-item text-white">
						<i class="fa fa-users"> </i>  จัดการแอดมิน
				</a></div>         	

        <div id="sidebar-field">
		<a href="student.php" class="sidebar-item text-white">
						<i class="fa fa-users"> </i>  จัดการนักศึกษา
				</a></div>
        <div id="sidebar-field">
				<a href="quiz.php" class="sidebar-item text-white">
						<i class="fa fa-list"> </i>  จัดการแบบทดสอบ
				</a></div>
        <div id="sidebar-field">
				<a href="history.php" class="sidebar-item text-white">
						<i class="fa fa-history"> </i>  จัดการประวัติการสอบ
				</a></div>
                <?php endif; ?>
</div>
<div class = "container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="main">
	<span><a href="javascript:void(0)" class="openbtn" onclick="openNav()">☰</a></span>
			<span ><h3 class = "navbar-text">E-learning for Hens</h3>
				</span>
			</nav>
			</div>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "200px";
  document.getElementById("main").style.marginLeft = "200px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
$(document).ready(function() {
  $('#sidebarCollapse').on('click', function() {
    $('#sidebar').toggleClass('active');
  });
});
</script>
   
</body>
</html> 