<?php
    include 'db_connect.php';
   include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php') ?>
    <title>แบบทดสอบ</title>
    <link rel="stylesheet" href="css/content.css">
    <style>
        .alert{
		background-color: #fff !important;
		border-style: solid !important;
  		border-color: #099fae !important;
		  border-radius: 5px;
          margin-left:auto;
    margin-right:auto;
	}
        .container-fluid{
	margin-top:40px
}
.card{
    margin-left:auto;
    margin-right:auto;
}
/* tr:nth-child(even){
    background-color: #fcad74;
    color: white;
} */
th {
  background-color: #fcad74;
  color: white;
}
table th {
    font-size: 1em !important;
    letter-spacing: .1em;
    text-transform: uppercase;
  }
    </style>
</head>
<body>
    <?php 
    include 'nav_bar.php';
    ?>

    <div class="container-fluid admin">
    <div class="col-md-12 alert">หน้าแรก</div>
    <br>
        <div class="card col-md-12">
            <div class="card-body">
                <table class="table table-bordered" id='table'>
                    <center><thead>
                        <th>บทเรียน</th>
                        <th>จำนวนคำถาม</th>
                        <?php if($_SESSION['login_user_type'] == 3): ?>
                        <th>สถานะ</th>
                        <?php else: ?>
                        <th>เข้าสอบ</th>
                        <?php endif; ?>
                    </thead></center>
                    <tbody>
                        <?php 
                            $where = '';
                            if($_SESSION['login_user_type'] == 2){
                                $where = " where u.id = ".$_SESSION['login_id']." ";
                            }
                            if($_SESSION['login_user_type'] == 3){
                                $where = " where q.id in (SELECT quiz_id from quiz_student_list where user_id = '".$_SESSION['login_id']."') ";
                            }
                            $qry = $conn->query("SELECT q.*,u.name as fname from quiz_list q left join users u on q.user_id = u.id ".$where." order by q.title asc ");
                                while($row= $qry->fetch_assoc()){
                                    $items = $conn->query("SELECT count(id) as item_count from questions where qid = '".$row['id']."' ")->fetch_array()['item_count'];
                                    $swhere ='';
                                     if($_SESSION['login_user_type'] == 3)
                                        $swhere= ' and user_id = '.$_SESSION['login_id'].' ';

                                    $taken = $conn->query("SELECT count(id) as item_count from answers where quiz_id = '".$row['id']."'  ".$swhere )->fetch_array()['item_count'];
                        ?>
                        <tr>
                        <td data-label="บทเรียน"><?php echo $row['title'] ?></td>
                        <td data-label="จำนวนคำถาม" ><?php echo $items ?> ข้อ</td>
                        <?php if($_SESSION['login_user_type'] == 3): ?>
                        <td data-label="สถานะ"><?php echo $taken > 1 ? 'สอบแล้ว' : 'ยังไม่ทำข้อสอบ' ?></td>
                        <?php else: ?>
                        <td data-label="เข้าสอบ" ><?php echo $taken ?> คน</td>
                        <?php endif; ?>
                        </tr>
                        <?php
                        }

                        ?>
                    </tbody>  
                </table>
            </div>
        </div>
       </div>
</body>
</html>