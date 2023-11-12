<?php
session_start();
// include_once '../connection/server.php';
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$_SESSION['patientSession']);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!-- update -->
<?php
if (isset($_POST['submit'])) {
//variables
$patientFirstName = $_POST['patientFirstName'];
$patientLastName = $_POST['patientLastName'];
$patientDOB = $_POST['patientDOB'];
$patient_pre = $_POST['patient_pre'];
$Homenumber = $_POST['Homenumber'];
$moo = $_POST['moo'];
$districts = $_POST['districts'];

$amphures = $_POST['amphures'];
$provinces = $_POST['provinces'];
$zipcode = $_POST['zipcode'];


$patientPhone = $_POST['patientPhone'];
$patientEmail = $_POST['patientEmail'];
// mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
$res=mysqli_query($con,"UPDATE patient SET patient_pre='$patient_pre', patientFirstName='$patientFirstName', patientLastName='$patientLastName',  patientDOB='$patientDOB',  Homenumber='$Homenumber',  moo='$moo',  districts='$districts',  amphures='$amphures',  provinces='$provinces',  zipcode='$zipcode',  Homenumber='$Homenumber', patientPhone='$patientPhone', patientEmail='$patientEmail' WHERE icPatient=".$_SESSION['patientSession']);
// $userRow=mysqli_fetch_array($res);
header( 'Location: profile.php' ) ;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>คลินิกทันตกรรมทับปุด</title>
		<link rel="icon" href="assets/img/F1.png" type="image/png">
		<!-- Bootstrap -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!-- <link href="assets/css/material.css" rel="stylesheet"> -->
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
									<a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> ออกจากระบบ</a>
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
										ให้เราดูแลรอยยิ้มของคุณ เราจะดูแลด้วยใจ กรุณากรอกข้อมูลเพิ่มเติมให้กับเรา 
									</p>
									<hr />
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">แก้ไขข้อมูลส่วนตัว</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<h3><?php echo $userRow['patient_pre']; ?> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?> </h3>
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" align="center">
											<tbody>
												
												
												<tr>
													<td>เลขบัตรประชาชน</td>
													<td><?php echo $userRow['icPatient']; ?></td>
												</tr>
												<tr>
													<td>วันเดือนปีเกิด:</td>
													<td><?php echo $userRow['patientDOB']; ?></td>
												</tr>
												
												<tr>
													<td>ที่อยู่:</td> 
													<td><?php echo $userRow['Homenumber']." หมู่". $userRow['moo']." ต.". $userRow['districts']." อ.". $userRow['amphures']." จ.". $userRow['provinces']." ". $userRow['zipcode']; ?> </td>
												</tr>
												<tr>
													<td>เบอร์โทรศัพท์:</td>
													<td><?php echo $userRow['patientPhone']; ?>	</td>
												</tr>
												<tr>
													<td>อีเมล์:</td>
													<td><?php echo $userRow['patientEmail']; ?>	</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal --> 
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">กรอกฟอร์มบันทึกข้อมูลส่วนตัว</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->
										<form action="<?php $_PHP_SELF ?>" method="post" >
											<table class="table table-user-information">
												<tbody>
													<tr>
														<td>เลขบัตรประชาชน:</td>
														<td><?php echo $userRow['icPatient']; ?></td>
														
													</tr>
													<tr>
													<tr>
														<td>คำนำหน้าชื่อ:</td>
														<td>
															<select class="form-control" name="patient_pre">
																<option value="นาย" <?php echo ($userRow['patient_pre'] == 'นาย') ? 'selected' : ''; ?>>นาย</option>
																<option value="นาง" <?php echo ($userRow['patient_pre'] == 'นาง') ? 'selected' : ''; ?>>นาง</option>
																<option value="นางสาว" <?php echo ($userRow['patient_pre'] == 'นางสาว') ? 'selected' : ''; ?>>นางสาว</option>
															</select>
														</td>
													</tr>

														<td>ชื่อ:</td>
														<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
													</tr>
													
													<tr>
														<td>นามสกุล</td>
														<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
													</tr>
													<tr>
														<td>วันเดือนปีเกิด</td>
														<td><input type="date" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td>
																												
													</tr>
													<tr>
														<td>เบอร์โทรศัพท์</td>
														<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
													</tr>
													<tr>
														<td>อีเมล์</td>
														<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
													</tr>
													<tr>
														<td>บ้านเลขที่</td>
														<td><input type="text" class="form-control" name="Homenumber" value="<?php echo $userRow['Homenumber']; ?>" /></td>
													</tr>
													<tr>
														<td>หมู่</td>
														<td><input type="text" class="form-control" name="moo" value="<?php echo $userRow['moo']; ?>" /></td>
													</tr>
													<tr>
														<td>ตำบล</td>
														<td><textarea class="form-control" name="districts" ><?php echo $userRow['districts']; ?></textarea></td>
													</tr>
													<tr>
														<td>อำเภอ</td>
														<td><textarea class="form-control" name="amphures" ><?php echo $userRow['amphures']; ?></textarea></td>
													</tr>
													<tr>
														<td>จังหวัด</td>
														<td><textarea class="form-control" name="provinces" ><?php echo $userRow['provinces']; ?></textarea></td>
													</tr>

													<tr>
														<td>รหัสไปรษณีย์</td>
														<td><textarea class="form-control" name="zipcode"  ><?php echo $userRow['zipcode']; ?></textarea></td>
													</tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="บันทึก"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					</div>
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>
			<!-- CONATINER END -->
			<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			
			<script type="text/javascript">
														$(function () {
														$('#patientDOB').datetimepicker();
														});
														</script>
		</body>
	</html>