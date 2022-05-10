<!DOCTYPE html>
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
<h1>
<center><h1>ลบหมอ</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
ใส่ ID หมอ:<center><input type="number" name="did"></center>
			<button type="submit" name="Submit1">ลบ</button>

</form>			
<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['Submit1']))
{
	$did=$_POST['did'];
	$sql = "DELETE FROM doctor WHERE DID= $did ";
	$sqlda = "DELETE FROM doctor_availability WHERE DID= $did ";
	if (mysqli_query($conn, $sql))
		{
		echo "ลบเรียบร้อยแล้ว รอสักครู่....";
		header( "Refresh:3; url=deletedoctor.php");
		}
	else
		{
			echo "เกิดข้อผิดผลาดในการลบ: " . mysqli_error($conn);
		}
}
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
?>			
</body>
</html>