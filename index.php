<?php
include_once 'assets/conn/dbconnect.php';

// include_once 'assets/conn/server.php';
?>


<!-- login -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
header("Location: patient/patient.php");
}
if (isset($_POST['login']))
{
$icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
if ($row['password'] == $password)
{
$_SESSION['patientSession'] = $row['icPatient'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: patient/patient.php");
} else {
?>
<script>
alert('ข้อมูลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง ');
</script>
<?php
}
}
?>

<?php
$showAlert = true; // เพิ่มตัวแปร flag เพื่อตรวจสอบการแจ้งเตือน

if (isset($_POST['signup'])) {
    $patientFirstName = mysqli_real_escape_string($con, $_POST['patientFirstName']);
    $patientLastName  = mysqli_real_escape_string($con, $_POST['patientLastName']);
    $patientEmail     = mysqli_real_escape_string($con, $_POST['patientEmail']);
    $patientPhone     = mysqli_real_escape_string($con, $_POST['patientPhone']);
    $icPatient        = mysqli_real_escape_string($con, $_POST['icPatient']);
    $password         = mysqli_real_escape_string($con, $_POST['password']);
    $patientDOB       = mysqli_real_escape_string($con, $_POST['patientDOB']);
    $patient_pre      = mysqli_real_escape_string($con, $_POST['patient_pre']);
    $Homenumber     = mysqli_real_escape_string($con, $_POST['Homenumber']);
    $moo             = mysqli_real_escape_string($con, $_POST['moo']);
    $districts       = mysqli_real_escape_string($con, $_POST['districts']);
    $amphures         = mysqli_real_escape_string($con, $_POST['amphures']);
    $provinces       = mysqli_real_escape_string($con, $_POST['provinces']);
    $zipcode        = mysqli_real_escape_string($con, $_POST['zipcode']);


    // Check if the email is already registered
    $checkEmailQuery = "SELECT * FROM patient WHERE patientEmail = '$patientEmail'";
    $checkEmailResult = mysqli_query($con, $checkEmailQuery);

    // Check if the Phone is already registered
    $checkPhoneQuery = "SELECT * FROM patient WHERE patientPhone = '$patientPhone'";
    $checkPhoneResult = mysqli_query($con, $checkPhoneQuery);

   

    // Check if the IC number is already registered
    $checkICQuery = "SELECT * FROM patient WHERE icPatient = '$icPatient'";
    $checkICResult = mysqli_query($con, $checkICQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        // The email is already registered
        if ($showAlert) {
            ?>
            <script type="text/javascript">
            alert('อีเมล์นี้ถูกใช้แล้ว!! กรุณาเปลี่ยนอีเมล์ใหม่');
            </script>
            <?php
            $showAlert = false; // เปลี่ยนค่า flag เพื่อไม่แสดงการแจ้งเตือนซ้ำ
        }
    } elseif (mysqli_num_rows($checkICResult) > 0) {
        // The IC number is already registered
        if ($showAlert) {
            ?>
            <script type="text/javascript">
            alert('เลขบัตรประชาชนนี้ถูกใช้แล้ว!! กรุณาเปลี่ยนเลขบัตรประชาชนใหม่');
            </script>
            <?php
            $showAlert = false; // เปลี่ยนค่า flag เพื่อไม่แสดงการแจ้งเตือนซ้ำ
        }
    } else {
        // ไม่มีอีเมลและเลขบัตรประชาชนที่ซ้ำกัน, ดำเนินการลงทะเบียนต่อไป
        $query = "INSERT INTO patient (icPatient, password, patientFirstName, patientLastName, patientDOB, patient_pre, patientEmail,patientPhone,Homenumber,moo,districts,amphures,provinces,zipcode)
        VALUES ('$icPatient', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patient_pre', '$patientEmail','$patientPhone', '$Homenumber', '$moo', '$districts','$amphures', '$provinces', '$zipcode')";

        $result = mysqli_query($con, $query);

        if ($result) {
            ?>
            <script type="text/javascript">
            alert('ลงทะเบียนสำเร็จ กรุณาเข้าสู่ระบบเพื่อทำการนัดหมาย');
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
            alert('การลงทะเบียนไม่สำเร็จ. กรุณาลองอีกครั้ง.');
            </script>
            <?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>คลิกนิกทันตกกรมทับปุด</title>
        <link rel="icon" href="img/F1.png" type="image /png">
      

        <!-- Bootstrap -->
        <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" /> -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="assets/css/material.css" rel="stylesheet">
    </head>
    <body>
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img alt="Brand" src="assets/img/logo1.png" height="40px"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                        
                        <li><a href="#" data-toggle="modal" data-target="#myModal">สร้างบัญชีใหม่</a></li>
                                          
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>เข้าสู่ระบบ</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="icPatient">Email</label>
                                                    <input type="text" class="form-control" name="icPatient" placeholder="เลขบัตรประชาชน" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- navigation -->

        <!-- modal container start -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- modal content -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">สร้างบัญชี</h3>
                    </div>
                    <!-- modal body start -->
                    <div class="modal-body">
                        
                        <!-- form start -->
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                        <h4>กรุณากรอกข้อมูลของคุณให้ครบทุกช่อง</h4>
                                        <div class="row">
                                            <div class="col-md-3 mb-3 mb-sm-0">
                                                <label class="form-label">คำนำหน้าชื่อ</label><br>
                                                <select class="form-control" aria-label="Default select example" name="patient_pre" style="border-radius: 25px;" required>
                                                    <option value="">กรุณาเลือก....</option>
                                                    <option value="นาย">นาย</option>
                                                    <option value="นาง">นาง</option>
                                                    <option value="นางสาว">นางสาว</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-0 mb-sm-1">
                                                <label class="form-label">ชื่อ</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px; border: .5rem" name="patientFirstName" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">นามสกุล</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px;" name="patientLastName" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-8 mb-3 mb-sm-0">
                                                <label class="form-label">อีเมล</label><br>
                                                <input type="email" class="form-control" style="border-radius: 25px;" name="patientEmail" required>
                                            </div>
                                        <div class="col-md-4">
                                            <label class="form-label">เบอร์โทรศัพท์</label><br>
                                            <input type="tel" class="form-control" style="border-radius: 25px;" minlength="10" maxlength="10" name="patientPhone" required>
                                        </div>
                                         </div>
                                        <div class="form-group row">
                                            <div class="col-sm-8 mb-3 mb-sm-0">
                                                <label class="form-label">เลขบัตรประจำตัวประชาชน</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px;" minlength="13" maxlength="13" name="icPatient" required>
                                            </div>
                                            <div class="col-md-4">
                                                 <?php $date = date('Y-m-d'); ?>
                                                <label class="form-label">วัน/เดือน/ปี ที่เกิด</label><br>
                                                <input type="date" name="patientDOB" class="form-control" style="border-radius: 25px;" max="<?= $date; ?>"  required>
                                            </div>
                                            
                                            <div class="col-md-3 mb-0 mb-sm-1">
                                                <label class="form-label">บ้านเลขที่</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px;"  name="Homenumber" required>
                                            </div>
                                            <div class="col-md-2 mb-0 mb-sm-1">
                                                <label class="form-label">หมู่</label><br>
                                                <input type="number" class="form-control" style="border-radius: 25px;"  name="moo" required>
                                            </div>
                                            <div class="col-md-3 mb-0 mb-sm-1">
                                                <label class="form-label">ตำบล</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px;"  name="districts" required>
                                            </div>
                                            <div class="col-md-4 mb-0 mb-sm-1">
                                                <label class="form-label">อำเภอ</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px;"  name="amphures" required>
                                            </div>
                                            <div class="col-md-4 mb-0 mb-sm-1">
                                                <label class="form-label">จังหวัด</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px;"  name="provinces" required>
                                            </div>
                                            <div class="col-md-3 mb-0 mb-sm-1">
                                                <label class="form-label">รหัสไปรษณีย์</label><br>
                                                <input type="text" class="form-control" style="border-radius: 25px;" minlength="5" maxlength="5" name="zipcode" required>
                                            </div>

                                            
                                        </div>
                                       
                                        <hr>
                                        <div class="col-md-6 mb-0 mb-sm-1">
                                                <label class="form-label">รหัสผ่าน</label><br>
                                                <input type="password" class="form-control" value=""style="border-radius: 25px;" name="password" required>
                                        </div>
                                        <div class="col-md-6 mb-0 mb-sm-1">
                                                <label class="form-label">ยืนยันรหัสผ่านรหัสผ่าน</label><br>
                                                <input type="password" class="form-control" value=""style="border-radius: 25px;" name="confirm_password" required>
                                        </div>   

                                        <br />
                                        <span class="help-block">เมื่อคลิกสร้างบัญชีของคุณ แสดงว่าคุณยอมรับข้อกำหนดของเรา และคุณได้อ่านนโยบายการใช้ข้อมูลของเรา รวมถึงการใช้คุกกี้ของเราแล้ว</span>
                                        
                                        <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">ยืนยันการสร้างบัญชี</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->


        
        <!-- modal container end -->  
 
        <!-- 1st section start -->
        <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
            <div class="container">
            <h2 >ระบบจองคิวคลินิกทันตกรรมทับปุด</h2>
            <p style="font-size: 18px; font-weight: bold; color:#333333">กรุณา เข้าสู่ระบบ หรือ สร้างบัญชีใหม่ เพื่อใช้งานระบบ</p>

            <div class="col-md-5">
    <p>

    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="text-transform: uppercase; padding: 10px 20px; margin-right: 10px; font-size: 16px; border-radius: 60px;"><b>สร้างบัญชีใหม่</b></a>

     </p>
</div>



                     
                            
                        <!-- date textbox -->
                       
                        <div class="input-group" style="margin-bottom:10px;">
                            <div class="input-group-addon">
                                
                            </div>
                            
                        </div>
                       
                                           
                        <!-- table appointment start -->
                        <div id="txtHint"><b> </b></div>
                        
                        <!-- table appointment end -->
                    </div>
                    <!-- /.col -->
                   <!--  <div class="col-md-6 col-md-offset-1">
                        <div class="video-wrapper">
                            <iframe width="560" height="315" src="http://www.youtube.com/embed/FEoQFbzLYhc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div> -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
             
        </section>
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
                    <p></p>
                    <h1>ทันตแพทย์</h1>
					<hr>
					<h2>ความเชี่ยวชาญของทันตแพทย์</h2>
				</div>
    
    <table id="myTable">
        <?php
            include_once 'assets/conn/dbconnect.php';

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
        <div class="info-box">
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
        
        <!-- forth section end -->
        <!-- footer start -->
        
        <div class="copyright-bar bg-blue">
            <div class="container">
                <p class="pull-left small">คลินิคทันตกรรมทับปุด<a href ="https://projectworlds.in/">โดย นายสถาพร ประสพมิตร </a></p>
                
            </div>
        </div>
        <!-- footer end -->
        
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>
    <!-- date start -->
  
<script>
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

</script>

    <!-- date end -->
   
</body>
</html>