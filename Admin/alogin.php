<!DOCTYPE html>
<html>
<body style="background-image:url(doctordesk.jpg)">
<link rel="stylesheet" href="main.css">
	<form action="alogin.php" method="post">
	<div class="header">
				<ul>
					<li style="float:left;border-right:none"><strong> Admin เข้าสู่ระบบ</strong></li>
					<li><a href="cover.php">หน้าหลัก</a></li>
				</ul>
	</div>
	<div class="sucontainer">
		<label><b>ชื่อผู้ใช้:</b></label><br>
		<input type="text" placeholder="ใส่ชื่อผู้ใช้" name="uname" required><br>
	
		<label><b>รหัสผ่าน:</b></label><br>
		<input type="password" placeholder="ใส่รหัสผ่าน" name="pass" required><br><br>
		
		<div class="container" style="background-color:grey">
			<button type="submit" name="submit" style="float:right">เข้าสู่ระบบ</button>
		</div>
<?php 
function SignIn() 
{ 
session_start();
 {  
	if($_POST['uname']=='admin' && $_POST['pass']=='admin') 
	{ 
		$_SESSION['userName'] = 'admin'; 
		echo "กำลังเข้าสู่ระบบ..";
		header( "Refresh:3; url=mainpage.php");
	} 
	else { 
		echo "ข้อมุลไม่ถูกต้อง!"; 
		} 
	}
	} 
	if(isset($_POST['submit'])) 
	{ 
		SignIn(); 
	} 
?>
</body>
</html>