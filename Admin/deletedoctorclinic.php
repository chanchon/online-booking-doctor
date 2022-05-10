<html>
<head>
<script src="jquerypart.js" type="text/javascript"></script>
<link rel="stylesheet" href="adminmain.css"> 
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "getclinic.php",
	data:'city='+val,
	success: function(data){
		$("#clinic-list").html(data);
	}
	});
}
function getDoctorday(val) {
	$.ajax({
	type: "POST",
	url: "getdoctorday.php",
	data:'cid='+val,
	success: function(data){
		$("#doctor-list").html(data);
	}
	});
}

</script>
</head>
<body background= "clinic.jpg">
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
<center><h1>ลบหมออกจากคลินิก</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<label style="font-size:20px" >เมือง:</label>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getState(this.value);">
		<option value="">เลือกเมือง</option>
		<?php
		include 'dbconfig.php';
		$sql1="SELECT distinct City FROM clinic";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["City"]; ?>"><?php echo $rs["City"]; ?></option>
		<?php
		}
		?>
		</select>
        
	
		<label style="font-size:20px" >คลินิก:</label>
		<select id="clinic-list" name="clinic" onchange="getDoctorday(this.value);" >
		<option value="">เลือกคลินิก</option>
		</select>
		
		<label style="font-size:20px" >วัน & เวลา:</label>
		<select name="doctor" id="doctor-list" >
		<option value="">เลือกวัน & เวลา</option>
		</select>
		
		
		<button name="Submit" type="submit">ยืนยัน</button>
	</form>
<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['Submit']))
{
	$cid=$_POST['clinic'];
	$rest=$_POST['doctor'];
	$sql = "DELETE FROM doctor_availability WHERE CID= $cid AND DID= $rest";

	if (mysqli_query($conn, $sql))
		{
		echo "ลบเรียบร้อยแล้ว รอสักครู่....";
		header( "Refresh:2; url=deletedoctorclinic.php");
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