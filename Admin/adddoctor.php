<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
</head>
<body background= "doctordesk.jpg">
<ul>
<li class="dropdown"><font color="yellow" size="10">ADMIN MODE</font></li>
<br>
<h2>
  <li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">หมอ</a>
    <div class="dropdown-content">
      <a href="adddoctor.php">เพิ่มหมอ</a>
      <a href="deletedoctor.php">ลบหมอ</a>
      <a href="showdoctor.php">แสดงหมอ</a>
	  <a href="showdoctorschedule.php">แสดงตารางานหมอ</a>
    </div>
  </li>
  
  <li class="dropdown">
  <a href="javascript:void(0)" class="dropbtn">คลินิก</a>
    <div class="dropdown-content">
      <a href="addclinic.php">เพิ่มคลินิก</a>
      <a href="deleteclinic.php">ลบคลินิก</a>
      <a href="adddoctorclinic.php">เพิ่มหมอเข้าคลินิก</a>
	  <a href="addmanagerclinic.php">เพิ่มผู้จัดการเข้าคลินิก</a>
	  <a href="deletedoctorclinic.php">ลบหมอออกจากคลินิก</a>
	  <a href="deletemanagerclinic.php">ลบผู้จัดการออกจากคลินิก</a>
	  <a href="showclinic.php">แสดงคลินิก</a>
    </div>
  </li>
  <li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">ผู้จัดการ</a>
    <div class="dropdown-content">
      <a href="addmanager.php">เพิ่มผู้จัดการ</a>
      <a href="deletemanager.php">ลบผู้จัดการ</a>
	  <a href="showmanager.php">แสดงผู้จัดการ</a>
    </div>
  </li>
   <li>  
	<form method="post" action="mainpage.php">	
	<button type="submit" class="cancelbtn" name="logout" style="float:right;font-size:22px"><b>ออกจากระบบ</b></button>
	</form>
  </li>
	
</ul>
</h2>
<center><h1>เพิ่มหมอ</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  ID หมอ:<input type="number" name="did" required>
  <br>
  ชื่อ: <input type="text" name="name" required>
  <br>
  เพศ:
  <input type="radio" name="gender" value="หญิง">หญิง
  <input type="radio" name="gender" value="ชาย">ชาย
  <br>
  วันเกิด: <input type="date" name="dob" required>
  <br>
  ประสบการณ์: <input type ="number" name="experience" required>
  <br>
  ความเชี่ยวชาญ:<input type="text" name="specialization" required>
  <br>
  การติดต่อ: <input type="number" name="contact" maxlength="10" minlength="10" required>
  <br>
  ที่อยู่: <input type="text" name="address" required>
  <br>
  ชื่อผู้ใช้: <input type="text" name="username" required>
  <br>
  รหัสผ่าน: <input type="password" name="pwd" required>
  <br>
  เมือง: <input type="text" name="region" required>
  <br>
  
  <button type="submit" name="Submit">ลงทะเบียน</button>
</form>
</font></b>
</center>
<?php
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
function newUser()
{
	include 'dbconfig.php';
		$did=$_POST['did'];
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$experience=$_POST['experience'];
		$specialization=$_POST['specialization'];
		$contact=$_POST['contact'];
		$address=$_POST['address'];
		$username=$_POST['username'];
		$password=$_POST['pwd'];
		$region=$_POST['region'];
		$sql = "INSERT INTO doctor (DID, Name, Gender, DOB, Experience, Specialization, Contact,Address,Username,Password,Region) VALUES ('$did','$name','$gender','$dob','$experience','$specialization','$contact','$address','$username','$password','$region') ";

	if (mysqli_query($conn, $sql)) 
	{
		echo "<h2>บันทึกสำเร็จแล้ว!! กำลังเปลี่ยนเส้นทางไปยังหน้าหลักของผู้ดูแลระบบ....</h2>";
		header( "Refresh:3; url=adddoctor.php");

	} 
	else
	{
    echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . mysqli_error($conn);
	}
}
function checkdid()
{
	include 'dbconfig.php';
	$did=$_POST['did'];
	$sql= "SELECT * FROM doctor WHERE DID = '$did'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
       {
			echo"<b><br>IDหมอนี้มีอยู่แล้ว!!";
       }
	else 
		if(isset($_POST['Submit']))
	{ 
		newUser();
	}

	
}
function checkusername()
{
	include 'dbconfig.php';
	$usn=$_POST['username'];
	$sql= "SELECT * FROM doctor WHERE Username = '$usn'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
       {
			echo"<b><br>ชื่อผู้นี้ใช้มีอยู่แล้ว!!";
       }
	else 
		if(isset($_POST['Submit']))
	{ 
		checkdid();
	}

	
}
if(isset($_POST['Submit']))
{
	if(!empty($_POST['did']) && !empty($_POST['username']) && !empty($_POST['pwd'])&& !empty($_POST['region']) &&!empty($_POST['experience']) &&!empty($_POST['specialization']) &&!empty($_POST['name']) &&!empty($_POST['dob'])&& !empty($_POST['gender']) &&!empty($_POST['address']) && !empty($_POST['contact']))
		checkusername();
	else
		echo "กรุณากรอกข้อมูลให้ครบถ้วน";
}

?>

</body>
</html>