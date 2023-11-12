<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session= $_SESSION  ['patientSession'];
// $appid=null;
// $appdate=null;
if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
	$appdate =$_GET['scheduleDate'];
	$appid = $_GET['appid'];
}
// on b.icPatient = a.icPatient
$res = mysqli_query($con,"SELECT a.*, b.* FROM doctorschedule a INNER JOIN patient b
WHERE a.scheduleDate='$appdate' AND scheduleId=$appid AND b.icPatient=$session");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


	
//INSERT
if (isset($_POST['appointment'])) {
$patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
$scheduleid = mysqli_real_escape_string($con,$appid);
$symptom = mysqli_real_escape_string($con,$_POST['symptom']);
$comment = mysqli_real_escape_string($con,$_POST['comment']);
$avail = "ไม่ว่าง";


$query = "INSERT INTO appointment (  patientIc , scheduleId , appSymptom , appComment  )
VALUES ( '$patientIc', '$scheduleid', '$symptom', '$comment') ";

//update table appointment schedule
$sql = "UPDATE doctorschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid" ;
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
} 


$result = mysqli_query($con,$query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
header("Location: patientapplist.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: patient/patient.php");
}
//dapat dari generator end
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<title>จองคิวคลินิกทันตกรรมทับปุด </title>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">


		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

	</head>
	<body>
		<!-- navigation --> 
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo1.png" height="40px"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">หน้าหลัก</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">รายการจองของคุณ</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa fa-fw fa-user"></i>ประวัติส่วนตัว</a>
								</li>
								<li>
									<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-file"></i> รายการจองของคุณ</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i>ออกจากระบบ</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<img src="assets/img/ima1.png" class="img-responsive" />
								<div class="description">
									<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
									
									<p>
										เราพร้อมดูแลรอยยิ้มของคุณ ด้วยหัวใจ โปรดเพิ่มข้อมูลส่วนตัวของคุณเพิ่มเติม 
									</p>
									<hr />
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">แก้ไขข้อมูลส่วนตัว</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<form class="form" role="form" method="POST" accept-charset="UTF-8">
											<div class="panel panel-default">
												<div class="panel-heading">ข้อมูลของลูกค้า</div>
												<div class="panel-body">
													
													ชื่อ-นามสกุล: <?php echo $userRow['patientFirstName'] ?> <?php echo $userRow['patientLastName'] ?><br>
													เลขบัตรประชาชน: <?php echo $userRow['icPatient'] ?><br>
													เบอร์โทรศัพท์: <?php echo $userRow['patientPhone'] ?><br>
													ที่อยู่: <?php echo $userRow['patientAddress'] ?>
												</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-heading">ข้อมูลการจองนัดหมายทันตแพทย์</div>
												<div class="panel-body">
												    ประเภทรายการจอง: <?php echo $userRow['service'] ?><br>
													วันจอง: <?php echo $userRow['scheduleDay'] ?><br>
													วันที่จอง: <?php echo $userRow['scheduleDate'] ?><br>
													เวลาที่จอง: <?php echo $userRow['startTime'] ?> - <?php echo $userRow['endTime'] ?><br>
													

												</div>
											</div>
											<div class="form-group">
												<label for="service-type" class="control-label">ประเภททีรับบริการ</label>
												<select class="form-control" id="service-type" name="symptom" required>
													<optgroup label="ทันตกรรมทั่วไป">
													<option value="อุดฟัน">อุดฟัน</option>
													<option value="ถอนฟัน">ถอนฟัน</option>
													<option value="ขูดหินปูน">ขูดหินปูน</option>
													<option value="ผ่าฟันคุด">ผ่าฟันคุด</option>
													<option value="รักษารากฟัน">รักษารากฟัน</option>
													<option value="ปรึกษาทันตแพทย์">ปรึกษาทันตแพทย์</option>
													</optgroup>
													<optgroup label="ทันตกรรมความงาม">
													<option value="จัดฟัน">จัดฟัน</option>
													<option value="สะพานฟัน">สะพานฟัน</option>
													<option value="ฟันปลอม">ฟันปลอม</option>
													<option value="ฟอกสีฟัน">ฟอกสีฟัน</option>
													<option value="ตรอบฟัน">ครอบฟัน</option>
													<option value="ปรึกษาทันตแพทย์">ปรึกษาทันตแพทย์</option>
													</optgroup>
													
												</select>
												</div>

											<div class="form-group">
												<label for="message-text" class="control-label">อาการเพิ่มเติมของผู้ป่วย:</label>
												<textarea class="form-control" name="comment" required></textarea>
											</div>
											<div class="form-group">
												<input type="submit" name="appointment" id="submit" class="btn btn-primary" value="บันทึกข้อมูลเพื่อทำการจอง">
											</div>
										</form>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
				</body>
			</html>