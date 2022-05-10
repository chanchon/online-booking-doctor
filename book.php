<html>
<head>
<link rel="stylesheet" href="main.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head><?php include "dbconfig.php"; ?>
<script>
function getTown(val) {
	$.ajax({
	type: "POST",
	url: "get_town.php",
	data:'countryid='+val,
	success: function(data){
		$("#town-list").html(data);
	}
	});
}
function getClinic(val) {
	$.ajax({
	type: "POST",
	url: "getclinic.php",
	data:'townid='+val,
	success: function(data){
		$("#clinic-list").html(data);
	}
	});
}
function getDoctorday(val) {
	$.ajax({
	type: "POST",
	url: "getdoctordaybooking.php",
	data:'cid='+val,
	success: function(data){
		$("#doctor-list").html(data);
	}
	});
}

function getDay(val) {
	var cidval=document.getElementById("clinic-list").value;
	var didval=document.getElementById("doctor-list").value;
	$.ajax({
	type: "POST",
	url: "getDay.php",
	data:'date='+val+'&cidval='+cidval+'&didval='+didval,
	success: function(data){
		$("#datestatus").html(data);
	}
	});
}

</script>
<body style="background-image:url(images/2.jpg)">
	<div class="header">
		<ul>
			<li style="float:left;border-right:none"><a href="ulogin.php" class="logo"><img src="images/logo.png" width="30px" height="30px"><strong> นัดหมอ </strong>Online</a></li>
			<li><a href="book.php">นัดตอนนี้</a></li>
			<li><a href="ulogin.php">หน้าหลัก</a></li>
		</ul>
	</div>
	<form action="book.php" method="post">
	<div class="sucontainer" style="background-image:url(images/3.jpg)">
		<label><b>ชื่อ:</b></label><br>
		<input type="text" placeholder="ใส่ชื่อผู้ป่วย" name="fname" required><br>
		
		<label><b>เพศ</b></label><br>
		<input type="radio" name="gender" value="หญิง">หญิง
		<input type="radio" name="gender" value="ชาย">ชาย
		<input type="radio" name="gender" value="อื่นๆ">อื่นๆ<br><br>
	
		<label style="font-size:20px" >เมือง:</label><br>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getTown(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">เลือกเมือง</option>
		<?php
		$sql1="SELECT distinct(city) FROM clinic";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["city"]; ?>"><?php echo $rs["city"]; ?></option>
		<?php
		}
		?>
		</select>
        <br>
	
		<label style="font-size:20px" >จังหวัด:</label><br>
		<select id="town-list" name="Town" onChange="getClinic(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">เลือกจังหวัด</option>
		</select><br>
		
		<label style="font-size:20px" >คลินิก:</label><br>
		<select id="clinic-list" name="Clinic" onChange="getDoctorday(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">เลือกคลินิก</option>
		</select><br>
		
		<label style="font-size:20px" >หมอ:</label><br>
		<select id="doctor-list" name="Doctor" onChange="getDate(this.value);" style="width:100%;height:35px;border-radius:9px">
		<option value="">เลือกหมอ</option>
		</select><br>
		
		
		<label><b>วันที่ต้องการนัด:</b></label><br>
		<input type="date" name="dov" onChange="getDay(this.value);" min="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" required><br><br>
		<div id="datestatus"> </div>
		
		<div class="container">
			<button type="submit" style="position:center" name="submit" value="Submit">ยืนยัน</button>
		</div>
<?php
session_start();
if(isset($_POST['submit']))
{
		
		include 'dbconfig.php';
		$fname=$_POST['fname'];
		$gender=$_POST['gender'];
		$username=$_SESSION['username'];
		$cid=$_POST['Clinic'];
		$did=$_POST['Doctor'];
		$dov=$_POST['dov'];
		$status="นัดหมอเสร็จแล้วรอการอัพเดท...";
		$timestamp=date('Y-m-d H:i:s');
		$sql = "INSERT INTO book (Username,Fname,Gender,CID,DID,DOV,Timestamp,Status) VALUES ('$username','$fname','$gender','$cid','$did','$dov','$timestamp','$status') ";
		if(!empty($_POST['fname'])&&!empty($_POST['gender'])&&!empty($_SESSION['username'])&&!empty($_POST['Clinic'])&&!empty($_POST['Doctor']) && !empty($_POST['dov']))
		{
			$checkday = strtotime($dov);
			$compareday = date("l", $checkday);
			$flag=0;
			require_once("dbconfig.php");
			$query ="SELECT * FROM doctor_availability WHERE DID = '" .$did. "' AND CID='".$cid."'";
			$results = $conn->query($query);
			while($rs=$results->fetch_assoc())
			{
				if($rs["day"]==$compareday)
				{
					$flag++;
					break;
				}
			}
			if($flag==0)
			{
				echo "<h2>เลือกวันที่อื่นที่หมอว่าง ".$compareday."</h2>";
			}
			else
			{
				if (mysqli_query($conn, $sql)) 
				{
						echo "<h2>นัดหมอเรียบร้อยแล้ว!! กำลังเปลี่ยนเส้นทางไปยังหน้าแรก....</h2>";
						header( "Refresh:2; url=ulogin.php");

				} 
				else
				{
					echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
		}
		else
		{
			echo "ใส่ข้อมูลให้ถูกต้อง!!";
		}
}
?>
	</form>
</body>
</html>