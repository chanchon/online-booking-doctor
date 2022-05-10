<html>
<head>
	<link rel="stylesheet" href="main.css">
</head>
<body style="background-image:url(images/signup.jpg)">
<div class="header">
				<ul>
					<li style="float:left;border-right:none"><a href="cover.php" class="logo"><img src="images/logo.png" width="30px" height="30px"><strong> นัดหมอ </strong>Online</a></li>
					<li><a href="locateus.php">ค้นหา</a></li>
					<li><a href="cover.php">หน้าหลัก</a></li>
				</ul>
</div>
<form action="signup.php" method="post">
	<div class="sucontainer">
		<label><b>ชื่อ:</b></label><br>
		<input type="text" placeholder="ใส่ชื่อ" name="fname" required><br>
	
		<label><b>วันเกิด:</b></label><br>
		<input type="date" name="dob" required><br><br>
	
		<label><b>เพศ</b></label><br>
		<input type="radio" name="gender" value="หญิง">หญิง
		<input type="radio" name="gender" value="ชาย">ชาย
		<input type="radio" name="gender" value="อื่นๆ">อื่นๆ<br><br>
		
		<label><b>การติดต่อ:</b></label><br>
		<input type="number" placeholder="ใส่เบอร์โทรศัพท์" name="contact" required><br>
		
		<label><b>ชื่อผู้ใช้:</b></label><br>
		<input type="text" placeholder="ใส่ชื่อผู้ใช้" name="username" required><br>
		
		<label><b>Email:</b></label><br>
		<input type="email" placeholder="ใส่อีเมล" name="email" required><br>

		<label><b>รหัสผ่าน:</b></label><br>
		<input type="password" placeholder="ใส่รหัสผ่าน" name="pwd" id="p1" required><br>

		<label><b>ยืนยันรหัสผ่าน:</b></label><br>
		<input type="password" placeholder="ใส่รหัสผ่านอีกครั้ง" name="pwdr" id="p2" required><br>
		<p style="color:white">ถ้าคุณสร้างบัญชีแล้วแสดงว่าคุณยอมทุกเงื่อนไข <a href="#" style="color:blue">ข้อตกลง & เงื่อนไข</a>.</p><br>

		<div class="container" style="background-color:grey">
			<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">ยกเลิก</button>
			<button type="submit" name="signup" style="float:right">สมัคร</button>
		</div>
  </div>
<?php

function newUser()
{
		include 'dbconfig.php';
		$name=$_POST['fname'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$contact=$_POST['contact'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$password=$_POST['pwd'];
		$prepeat=$_POST['pwdr'];
		$sql = "INSERT INTO Patient (Name, Gender, DOB,Contact,Email,Username,Password) VALUES ('$name','$gender','$dob','$contact','$email','$username','$password') ";

	if (mysqli_query($conn, $sql)) 
	{
		echo "<h2>บันทึกสำเร็จแล้ว!! กำลังเปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ....</h2>";
		header( "Refresh:3; url=cover.php");

	} 
	else
	{
    echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . mysqli_error($conn);
	}
}
function checkusername()
{
	include 'dbconfig.php';
	$usn=$_POST['username'];
	$sql= "SELECT * FROM Patient WHERE Username = '$username'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
		{
			echo"<b><br>ชื่อผู้ใช้นี้มีอยู่แล้ว!!";
		}
		else if($_POST['pwd']!=$_POST['pwdr'])
		{
			echo"รหัสผ่านไม่ตรงกัน";
		}
		else if(isset($_POST['signup']))
		{ 
			newUser();
		}

	
}
if(isset($_POST['signup']))
{
	if(!empty($_POST['username']) && !empty($_POST['pwd']) &&!empty($_POST['fname']) &&!empty($_POST['dob'])&& !empty($_POST['gender']) &&!empty($_POST['email']) && !empty($_POST['contact']))
			checkusername();
}
?>

</form>
</body>
</html>