<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}

$usersession = $_SESSION['patientSession'];


$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$usersession);

if ($res===false) {
	echo mysql_error();
} 

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
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
		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> -->
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
		
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
					<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo1.png" height="30px"></a>
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
									<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-file"></i>รายการจองของคุณ</a>
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
		
		<!-- 1st section start -->
		<section id="promo-1" class="content-block promo-1 min-height-200px bg-offwhite">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<h2>สวัสดีคุณ <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><br>ตารางการจองคิวสำหรับวันนี้</h2>
						<h3 style="color: red; font-size: 16px; font-weight: bold;">กรุณาเลือกวันที่ ที่คุณต้องการจอง!</h3>
					</div>
				</div>
				<div class="row">
					
					<div class="col-xl-12 col-md-9">
					
						
						<?php if ($userRow['patientMaritialStatus']=="") {
						// <!-- / notification start -->
						echo "<div class='row'>";
							echo "<div class='col-lg-12'>";
								echo "<div class='alert alert-danger alert-dismissable'>";
									echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
									echo " <i class='fa fa-info-circle'></i>  <strong>กรุณาเพิ่มข้อมูลเพิ่มเติมของคุณ</strong>" ;
								echo "  </div>";
							echo "</div>";
							// <!-- notification end -->
							
							} else { 
							}
							?>
							<!-- notification end -->
							
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon">
									<i class="fa fa-calendar">
									</i>
								</div>
								<input class="form-control" id="date" name="date" type="date" min="<?=date("Y-m-d"); ?>" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
							</div>
						</div>
						<!-- date textbox end -->
						<!-- script start -->
						<script>
							
							$data = document.getElementById("date").value  
							console.log($data);

							if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
								xmlhttp = new XMLHttpRequest();
							} else {
							// code for IE6, IE5
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange = function() {
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
								}
							};
							xmlhttp.open("GET","getschedule.php?q="+$data,true);
							console.log($data);
							xmlhttp.send();
							
							
							function showUser(str) {
								console.log(str);
							
								if (str == "") {
									document.getElementById("txtHint").innerHTML = "No data to be shown";
									return;
								} else {
									if (window.XMLHttpRequest) {
									// code for IE7+, Firefox, Chrome, Opera, Safari
										xmlhttp = new XMLHttpRequest();
									} else {
									// code for IE6, IE5
										xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
									}
									xmlhttp.onreadystatechange = function() {
										if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
											document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
										}
									};
									xmlhttp.open("GET","getschedule.php?q="+str,true);
									console.log(str);
									xmlhttp.send();
								}
							}
						</script>
						
						<!-- script start end -->
						
						<!-- table appointment start -->
						<!-- <div class="container"> -->
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-md-8">
									<div id="txtHint"></div>
								</div>
							</div>
						</div>
						<!-- </div> -->
						<!-- table appointment end -->
					</div>
				</div>
				<!-- /.row -->
			</div>
		</section>
		<!-- first section end --> 
		<!DOCTYPE html>
		<html>
		<head>
			<style>
				#myTable {
					width: 90%;
					margin: 0 auto;
					border-collapse: collapse;
					background-color: #f2f2f2;
					font-size: 20px;
				}

				#myTable th, #myTable td {
					border: 1px solid #ddd;
					padding: 8px;
					text-align: center;
				}

				#myTable th {
					background-color: #3366FF;
					color: white;
				}

				#myTable tr:nth-child(even) {
					background-color: #f2f2f2;
				}
			</style>
		</head>
		<body>
		<div class="container">
						<div class="underlined-title">
							<h1>ทันตแพทย์</h1>
							<hr>
							<h2>ความเชี่ยวชาญของทันตแพทย์</h2>
						</div>
			
			<table id="myTable">
				<?php
					include_once '../assets/conn/dbconnect.php';

					$sql = "SELECT * FROM doctordata";
					$result = mysqli_query($con, $sql);

					if (mysqli_num_rows($result) > 0) {
						echo "<tr>";
						echo "<th>ความเชี่ยวชาญด้านทันตกรรม</th>";
						echo "<th>ชื่อ</th>";
						echo "<th>นามสกุล</th>";
						echo "<th>เบอร์โทรศัพท์</th>";
						echo "</tr>";

						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>" . $row['doctor_service'] . "</td>";
							echo "<td>" . $row['doctor_Fname'] . "</td>";
							echo "<td>" . $row['doctor_Lname'] . "</td>";
							echo "<td>" . $row['doctor_phone'] . "</td>";
							echo "</tr>";
						}

					} else {
						echo "ไม่มีข้อมูลแพทย์";
					}

					mysqli_close($con);
				?>
			</table>
		</body>
		</html>
		 <!-- forth sections start -->
		 </section>
        <!-- forth sections start -->
		<section id="content-1-9" class="content-1-9 content-block">
			<div class="container">
				<div class="underlined-title">
					<h1>การรักษาของเรา</h1>
					<hr>
					<h2>คลินิกทันตกรรมทับปุดเปิดให้บริการเกี่ยวกับ</h2>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
                        <img src="assets/img/F2.png" alt="รูปภาพทันตกรรม" width="40" height="40">
						</div>
						<div class="col-xs-10">
							<h4>ทันตกรรมทั่วไป</h4>
							<p>บริการเกี่ยวกับ ขูดหินปูน อุดฟัน ถอนฟัน การรักษารากฟัน ผ่าฟันคุด </p>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-12 col-xs-12 pad25">
						<div class="col-xs-2">
                        <img src="assets/img/F5.png" alt="รูปภาพทันตกรรม" width="40" height="40">
						</div>
						<div class="col-xs-10">
							<h4>ทันตกรรมความงาม</h4>
							<p>บริการเกี่ยวกับ จัดฟัน  ฟอกสีฟัน ครอบฟัน สะพานฟัน ฟันปลอม</p>
						</div>
					</div>
					
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                            <img src="assets/img/F6.png" alt="รูปภาพทันตกรรม" width="40" height="40">
                        </div>
                        <div class="col-xs-10">
                            <h4>ปรึกษาทันตกรรม</h4>
                            <p>รับบริการปรึกษาเกี่ยวกับสุขภาพฟัน ปรึกษาฟรี</p>
                        </div>
                    </div>
                 
				</div>
				<!-- /.row -->
                
                </div>
            
		</section>
        <section id="content-1-9" class="content-1-9 content-block" style="background-color: #E9F5F5">
    <div class="container" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <div class="underlined-title">
            <h1>เกี่ยวกับเรา</h1>
            <hr>
            <h2>คลินิกทันตกรรมทับปุด</h2>
        </div>
        <iframe style="border:0; width: 90%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.8013280345754!2d98.63268307501293!3d8.518660991523683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3051059e47a70897%3A0xfdea44c74d815278!2z4LiE4Lil4Li04LiZ4Li04LiB4LiX4Lix4LiZ4LiV4LiB4Lij4Lij4Lih4LiX4Lix4Lia4Lib4Li44LiU!5e0!3m2!1sth!2sth!4v1698790513159!5m2!1sth!2sth"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p></p>
            <div>
                <p><strong>ตำแหน่งร้าน:</strong> ตรงข้ามตลาดเทศบาลทับปุด 6/9 ม.1 ต.ทับปุด อ.ทับปุด จ.พังงา 82180</p>
                <p><strong>เปิดให้บริการ:</strong>
                <span>จันทร์-ศุกร์ 17.00-20.00 น.</span>
                <span>เสาร์-อาทิตย์</span>
                <span>09.00-17.00 น.</span>
                </p>
                <p><strong>เบอร์โทร:</strong> 0636061970</p>
            </div>

    </div>
</section>
		<!-- forth section end -->
		
		<!-- footer start -->
		<div class="copyright-bar bg-black">
			<div class="container">
				<p class="pull-left small">ขอบคุณที่ไว้ใจ คลินิคทันตกรรมทับปุด </p>
				
			</div>
		</div>
		<!-- footer end -->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- date start -->
		<!-- <script>
		$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		})
		})
		</script> -->
		<!-- date end -->

	</body>
</html>