<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
</head>
<body background= "clinic.jpg" behavior="fixed">
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
	  <a href="showdoctorschedule.php">แสดงตารางงานหมอ</a>
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
<center><h1>เพิ่มคลินิก</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  ID คลินิก:<input type="number" name="cid" required>
  <br>
  ชื่อคลินิก: <input type="text" name="name" required>
  <br>
  ที่อยู่: <input type="text" name="address" required>
  <br>
  จังหวัด: <input type="text" name="town" required>
  <br>
  เมือง: <input type="text" name="city" required>
  <br>
  การติดต่อ.: <input type="number" name="contact" maxlength="10" minlength="10" required>
  <br>
  <button type="submit" name="Submit">ลงทะบียน</button>
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
function newclinic()
{
	include 'dbconfig.php';
		$cid=$_POST['cid'];
		$name=$_POST['name'];
		$town=$_POST['town'];
		$city=$_POST['city'];
		$contact=$_POST['contact'];
		$address=$_POST['address'];
		$sql = "INSERT INTO clinic (CID, Name, Address, Town, City, Contact, mid) VALUES ('$cid','$name','$address','$town','$city','$contact','')";

	if (mysqli_query($conn, $sql)) 
	{
		echo "<h2>บันทึกสำเร็จแล้ว!! กำลังเปลี่ยนเส้นทางไปยังหน้าหลักของผู้ดูแลระบบ....</h2>";
		header( "Refresh:3; url=addclinic.php");

	} 
	else
	{
    echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . mysqli_error($conn);
	}
}
function checkcid()
{
	include 'dbconfig.php';
	$cid=$_POST['cid'];
	$sql= "SELECT * FROM clinic WHERE cid = '$cid'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
       {
			echo"<b><br>ID คลินิกนี้มีอยู่แล้ว!!";
       }
	else 
		if(isset($_POST['Submit']))
	{ 
		newclinic();
	}

	
}
if(isset($_POST['Submit']))
{
	if(!empty($_POST['cid'])&&!empty($_POST['name'])&&!empty($_POST['address'])&&!empty($_POST['town'])&&!empty($_POST['city']) && !empty($_POST['contact']))
			checkcid();
	else
		echo "กรุณากรอกข้อมูลให้ครบถ้วน";
}

?>

</body>
</html>
