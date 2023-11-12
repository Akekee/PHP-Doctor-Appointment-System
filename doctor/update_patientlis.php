<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
// insert

// แก้ตรงนี้ ตาราง เเละเลือก ตัวเเปรไม่ซ้ำ หน้าเเก้ไข
if (isset($_REQUEST['edit'])) {
    $passid = $_REQUEST['edit'];
    $pass=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$passid);
    $docRow=mysqli_fetch_array($pass,MYSQLI_ASSOC);
    


    // $doctor_Fname   = mysqli_real_escape_string($con,$_POST['doctor_Fname']);
    // $doctor_Lname   = mysqli_real_escape_string($con,$_POST['doctor_Lname']);
    // $doctor_phone   = mysqli_real_escape_string($con,$_POST['doctor_phone']);
    // $doctor_passid  = mysqli_real_escape_string($con,$_POST['doctor_passid']);
    // $doctor_service = mysqli_real_escape_string($con,$_POST['doctor_service']);

}


if (isset($_POST['submit'])) {
    //variables
    $icPatient = $_POST['icPatient'];
    $patientFirstName = $_POST['patientFirstName'];
    $patientLastName = $_POST['patientLastName'];
    $patientDOB = $_POST['patientDOB'];
    $patient_pre = $_POST['patient_pre'];
    $patientPhone = $_POST['patientPhone'];
    $Homenumber = $_POST['Homenumber'];
    $moo = $_POST['moo'];
    $zipcode = $_POST['zipcode'];
    $districts = $_POST['districts'];
    $amphures = $_POST['amphures'];
    $provinces = $_POST['provinces'];
    $patientEmail = $_POST['patientEmail'];


    
    // mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
    $res=mysqli_query($con,"UPDATE patient SET icPatient='$icPatient', patientFirstName='$patientFirstName', patientLastName='$patientLastName',  patientDOB='$patientDOB',  patient_pre='$patient_pre',  patientPhone='$patientPhone',  Homenumber='$Homenumber',  moo='$moo',  zipcode='$zipcode',  districts='$districts',  amphures='$amphures',  provinces='$provinces',  patientEmail='$patientEmail' WHERE icPatient='$passid'");
    // $userRow=mysqli_fetch_array($res);
    header( 'Location: patientlist.php' ) ;
    }




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ยินดีต้อนรับ <?php echo $userRow['doctorFirstName'];?> </title>
        <link rel="icon" href="assets/img/F1.png" type="image/png">

        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- Inline CSS based on choices in "Settings" tab -->
        <style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

        <!-- Custom Fonts -->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">ไม่ต้องสลับช่องทาง</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="doctordashboard.php">สวัสดีคุณ <?php echo $userRow['doctorFirstName'];?> </a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['doctorFirstName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctorprofile.php"><i class="fa fa-fw fa-user"></i> ประวัติส่วนตัว</a>
                            </li>
                            
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> ออกจากระบบ</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="doctordashboard.php"><i class="fa fa-fw fa-dashboard"></i>การติดตามสถานะการจอง</a>
                        </li>
                        <li >
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i>การจัดการข้อมูลการจอง</a>
                        </li>
                        <li class="active">
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i> การจัดการข้อมูลข้อมูลลูกค้า</a>

                        </li>
                        <li >
                            <a href="add_doctor.php"><i class="fa fa-fw fa-edit"></i>การจัดการข้อมูลทันแพทย์</a>
                        </li>
                        <li>
                            <a href="board.php"><i class="fa fa-fw fa-edit"></i>สรุปรายการต่างๆ</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <!-- navigation end -->

            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                           การจัดการข้อมูลทันแพทย์
                            </h2>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-calendar"></i> Schedule
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary">
                        
                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">การจัดการข้อมูลทันแพทย์ </h3>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                            <div class="bootstrap-iso">
                             <div class="container-fluid">
                              <div class="row">
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                                <div class="form-group form-group-lg">
                                <div class="form-group form-group-lg">
                                <!-- เพิ่มช่องกรอกสำหรับประเภทการให้บริการ -->
                                <div class="form-group form-group-lg">
                                <label class="control-label col-sm-2 requiredField" for="service">
                                   คำนำหน้าชื่อ
                                    <span class="asteriskField">*</span>
                                </label>
                                <div class="col-sm-10">
                                
                                    <select class="form-control"  name="patient_pre"  required>
                                    <option value="">-- เลือกคำนำหน้าชื่อ --</option>
                                    <option value="นาย" <?php echo ($docRow['patient_pre'] == 'นาย') ? 'selected' : ''; ?>>นาย</option>
                                    <option value="นาง" <?php echo ($docRow['patient_pre'] == 'นาง') ? 'selected' : ''; ?>>นาง</option>
                                    <option value="นางสาว" <?php echo ($docRow['patient_pre'] == 'นางสาว') ? 'selected' : ''; ?>>นางสาว</option>
                                    
                                    </select>
                                </div>
                                </div>
                                 
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service" >
                                        ชื่อ
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="patientFirstName" class="form-control" value="<?= $docRow['patientFirstName'];?>" required>
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                        นามสกุล
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text"name="patientLastName" class="form-control"  value="<?= $docRow['patientLastName'];?>"required>
                                    </div>
                                </div>
                                
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                        วันเดือนปีเกิด
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="date"name="patientDOB" max="<?= $date; ?>"  class="form-control"  value="<?= $docRow['patientDOB'];?>"required>
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                        เบอร์โทร
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="patientPhone" class="form-control"  value="<?= $docRow['patientPhone'];?>"required>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                        อีเมล์
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="patientEmail" class="form-control"  value="<?= $docRow['patientEmail'];?>"required>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                       เลขบัตรประจำตัวประชาชน
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="icPatient" class="form-control"  value="<?= $docRow['icPatient'];?>" required  >
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                       บ้านเลขที่
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="Homenumber" class="form-control"  value="<?= $docRow['Homenumber'];?>" required  >
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                       หมู่
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="moo" class="form-control"  value="<?= $docRow['moo'];?>" required  >
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                       ตำบล
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="districts" class="form-control"  value="<?= $docRow['districts'];?>" required  >
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                       อำเภอ
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="amphures" class="form-control"  value="<?= $docRow['amphures'];?>" required  >
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                       จังหวัด
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="provinces" class="form-control"  value="<?= $docRow['provinces'];?>" required  >
                                    </div>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label class="control-label col-sm-2 requiredField" for="service">
                                       รหัสไปรษณีย์
                                        <span class="asteriskField">*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" name="zipcode" class="form-control"  value="<?= $docRow['zipcode'];?>" required  >
                                    </div>
                                </div>

                                 <div class="form-group">
                                  <div class="col-sm-10 col-sm-offset-2">
                                   <button class="btn btn-primary " name="submit" type="submit">
                                    บันทึก
                                   </button>
                                  </div>
                                 </div>
                                </form>
                               </div>
                              </div>
                             </div>
                            </div>                        
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                    </div>
                    <!-- panel start -->

                     <!-- panel start -->
                    
                    <!-- panel start -->
                </div>
            </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<!-- <script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        }) 
    })
</script> -->
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
 <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var id = element.attr("id");
var info = 'id=' + id;
if(confirm("คุณแน่ใจหรือไม่ว่าต้องการลบสิ่งนี้"))
{
 $.ajax({
   type: "POST",
   url: "deleteschedule.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>
<script type="text/javascript">
            /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */
            $(document).ready(function(){
                $('.filterable .btn-filter').click(function(){
                    var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });Schedule added successfully.

                $('.filterable .filters input').keyup(function(e){
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function(){
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">ไม่พบผลลัพธ์</td></tr>'));
                    }
                });
            });
        </script>

    </body>
</html>