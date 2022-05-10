<html>
<head>
<link rel="stylesheet" href="main.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head><?php include "dbconfig.php"; ?>
<body style="background-image:url(images/2.jpg)">
	<div class="header">
		<ul>
			<li style="float:left;border-right:none"><a href="ulogin.php" class="logo"><img src="images/logo.png" width="30px" height="30px"><strong> นัดหมอ </strong>Online</a></li>
			<li><a href="ulogin.php">หน้าหลัก</a></li>
		</ul>
	</div>
	<form action="cancelbookingpatient.php" method="post">
	<div class="sucontainer">
		<label style="font-size:20px" >เลือกนัดที่ต้องการยกเลิก:</label><br>
		<select name="appointment" id="appointment-list" class="demoInputBox"  style="width:100%;height:35px;border-radius:9px">
		<option value="">เลือกนัด</option>
		<?php
		session_start();
		$username=$_SESSION['username'];
		$date= date('Y-m-d');
		$sql1="SELECT * from book where username='".$username."'and status not like 'ยกเลิกโดยผู้ป่วย' and DOV >='$date'";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) {
			$sql2="select * from doctor where did=".$rs["DID"];
			$results2=$conn->query($sql2);
				while($rs2=$results2->fetch_assoc()) {
					$sql3="select * from clinic where cid=".$rs["CID"];
					$results3=$conn->query($sql3);
		while($rs3=$results3->fetch_assoc()) {
			
		?>
		<option value="<?php echo $rs["Timestamp"]; ?>"><?php echo "Doctor: ".$rs["Fname"]." Day: ".$rs["DOV"]." -Dr.".$rs2["name"]." -คลินิก: ".$rs3["name"]." -town: ".$rs3["town"]." - book on:".$rs["Timestamp"]; ?></option>
		<?php
		}
		}
		}
		?>
		</select>
		

			<button type="submit" style="position:center" name="submit" value="Submit">ยืนยัน</button>
	</form>
	<?php
if(isset($_POST['submit']))
{
		$username=$_SESSION['username'];
		$timestamp=$_POST['appointment'];
		$updatequery="update book set Status='ยกเลิกโดยผู้ป่วย' where username='$username' and timestamp= '$timestamp'";
				if (mysqli_query($conn, $updatequery)) 
				{
							echo "ยกเลิกการนัดหมายเรียบร้อยแล้ว	..!!<br>";
							header( "Refresh:2; url=ulogin.php");

				} 
				else
				{
					echo "เกิดข้อผิดพลาด: " . $updatequery . "<br>" . mysqli_error($conn);
				}

}
?>
</body>
</html>