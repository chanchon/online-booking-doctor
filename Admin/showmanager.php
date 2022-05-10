<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
<style>
table{
    width: 75%;
    border-collapse: collapse;
	border: 4px solid black;
    padding: 5px;
	font-size: 25px;
}

th{
border: 4px solid black;
	background-color: #4CAF50;
    color: white;
	text-align: left;
}
tr,td{
	border: 4px solid black;
	background-color: white;
    color: black;
}
</style>

</head>
<body background= "managerview.jpg">
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
<center><h1>แสดงผู้จัดการ</h1><hr>
<?php
session_start();
$con = mysqli_connect('localhost','root','','wt_database');
if (!$con)
{
    die('Could not connect: ' . mysqli_error($con));
}
$sql="SELECT * FROM manager order by MID ASC";
$result = mysqli_query($con,$sql);
echo "<br><h2>ผู้จัดการทั้งหมดในฐานข้อมูล=<b>".mysqli_num_rows($result)."</b></h2><br>";
echo "<table>
<tr>
<th>ID ผู้จัดการ</th>
<th>ชื่อผู้จัดการ</th>
<th>วันเกิด</th>
<th>ที่อยู่</th>
<th>การติดต่อ</th>
<th>เมือง</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
	echo "<td>" . $row['mid'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['dob'] . "</td>";
	echo "<td>" . $row['address'] . "</td>";
	echo "<td>" . $row['contact'] . "</td>";
	echo "<td>" . $row['region'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
?>
</body>
</html>