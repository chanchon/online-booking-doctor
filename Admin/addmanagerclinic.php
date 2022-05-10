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
function getManagerRegion(val) {
	$.ajax({
	type: "POST",
	url: "getmanagerregion.php",
	data:'city='+val,
	success: function(data){
		$("#manager-list").html(data);
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
<center><h1>เพิ่มผู้จัดการเข้าคลินิก</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<label style="font-size:20px" >เมือง:</label>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getState(this.value);getManagerRegion(this.value);">
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
		<select id="clinic-list" name="clinic" >
		<option value="">เลือกคลินิก</option>
		</select>
		
		<label style="font-size:20px" >ผู้จัดการ:</label>
		<select name="manager" id="manager-list">
		<option value="">เลือกผู้จัดการ</option>
		</select>

		<button name="Submit" type="submit">ยืนยัน</button>
	</form>
<?php
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
if(isset($_POST['Submit']))
{
		include 'dbconfig.php';
		$cid=$_POST['clinic'];
		$mid=$_POST['manager'];
		
				$sql = "INSERT INTO manager_clinic (CID, MID) VALUES ('$cid','$mid')";
				$sql1="update clinic set MID=$mid where CID=$cid";
				if (mysqli_query($conn, $sql)) 
				{
							echo "<h2>บันทึกเรียบร้อยแล้ว!!( CID=$cid MID=$mid )!!</h2>";
							echo "รอสักครู่ กำลังรีเฟรชอยู่...";
							header( "Refresh:2; url=addmanagerclinic.php");

				} 
				else
				{
					echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . mysqli_error($conn);
				}
				if (mysqli_query($conn, $sql1)) 
				{
							echo "<h2>บันทึกเรียบร้อยแล้ว!!( CID=$cid MID=$mid )in CLINIC TABLE!!</h2>";
							echo "รอสักครู่ กำลังรีเฟรชอยู่...";
							header( "Refresh:2; url=addmanagerclinic.php");

				} 
				else
				{
					echo "เกิดข้อผิดพลาด!!: " . $sql1 . "<br>" . mysqli_error($conn);
				}
				
}

?>

</body>
</html>