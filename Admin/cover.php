<!DOCTYPE html>
<html>
<body style="background-image:url(1.jpg)">
<link rel="stylesheet" href="main.css">
			<div class="header">
				<ul>
					<li style="float:left;border-right:none"><a href="cover.php" class="logo"><img src="logo.png" width="30px" height="30px"><strong> นัดหมอ </strong>Online</a></li>
					<li><a href="locateus.php">ค้นหา</a></li>
					<li><a href="#home">หน้าหลัก</a></li>
				</ul>
			</div>
			<div class="center">
		
				<button onclick="document.getElementById('id01').style.display='block'" style="position:absolute;top:60%;left:18%">เข้าสุ่ระบบ</button>
				
			</div>	
			<div class="footer">
				<ul style="position:absolute;top:93%;background-color:black">
					<li><a href="alogin.php">Admin เข้าสุ่ระบบ</a></li>
					<li><a href="mlogin.php">Manager เข้าสุ่ระบบ</a></li>
				</ul>
			</div>
<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post" action="cover.php">
    <div class="imgcontainer">
		<span style="float:left"><h2>&nbsp&nbsp&nbsp&nbspเข้าสู่ระบบ</h2></span>
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
	
    <div class="container">
      <label><b>ชื่อผู้ใช้</b></label>
      <input type="text" placeholder="ใส่ชื่อผู้ใช้" name="uname" required>

      <label><b>รหัสผ่าน</b></label>
      <input type="password" placeholder="ใส่รหัสผ่าน" name="psw" required>
		<button type="submit" name="login">เข้าสู่ระบบ</button>
		
      <input type="checkbox" checked="checked"> จดจำฉัน
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">ยกเลิก</button>
      <button onclick="document.getElementById('id02').style.display='block';document.getElementById('id01').style.display='none'" style="float:right">ไมมีบัญชี?</button>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  
  <form class="modal-content animate" action="signup.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span><br>
    </div>

	<div class="imgcontainer">
      <img src="images/steps.png" alt="Avatar" class="avatar">
    </div>
	
    <div class="container">
	<p style="text-align:center;font-size:18px;"><b>ลงทะเบียน -> เลือกวันที่ของคุณ -> นัดหมอที่ต้องการ</b></p>
      <p style="text-align:center"><b>นัดหมอได้ง่ายกว่าที่เคย!</b></p>
      <p style="text-align:center"><b>3 ขั้นตอนเพื่อชีวิตที่ง่ายขึ้นและมีสุขภาพดี</b></p>
	  
    </div>
	
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">ยกเลิก</button>
	  <button type="submit" name="signup" style="float:right">สมัครสมาชิก</button>
    </div>
	
  </form>
</div>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

</script>
<?php
session_start();
$error=''; 
if (isset($_POST['login'])) {
if (empty($_POST['uname']) || empty($_POST['psw'])) {
$error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
}
else
{
	include 'dbconfig.php';
	$username=$_POST['uname'];
	$password=$_POST['psw'];

	$query = mysqli_query($conn,"select * from patient where password='$password' AND username='$username'");
	$rows = mysqli_fetch_assoc($query);
	$num=mysqli_num_rows($query);
	if ($num == 1) {
		$_SESSION['username']=$rows['username'];
		$_SESSION['user']=$rows['name'];
		header( "Refresh:1; url=ulogin.php"); 
	} 
	else 
	{
		$error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
	}
	mysqli_close($conn); 
}
}
?>
</body>
</html>
