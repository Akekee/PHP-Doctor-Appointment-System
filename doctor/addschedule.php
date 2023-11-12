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


if (isset($_POST['submit'])) {
$date = mysqli_real_escape_string($con,$_POST['date']);
$service = mysqli_real_escape_string($con,$_POST['service']);
$scheduleday  = mysqli_real_escape_string($con,$_POST['scheduleday']);
$starttime     = mysqli_real_escape_string($con,$_POST['starttime']);
$endtime     = mysqli_real_escape_string($con,$_POST['endtime']);
$bookavail         = mysqli_real_escape_string($con,$_POST['bookavail']);

//INSERT
$query = "INSERT INTO doctorschedule (service, scheduleDate, scheduleDay, startTime, endTime, bookAvail)
          VALUES ('$service', '$date', '$scheduleday', '$starttime', '$endtime', '$bookavail')";


$result = mysqli_query($con, $query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('เพิ่มกำหนดการเรียบร้อยแล้ว');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('เเกิดข้อผิดพลาด กรุณาลองอีกครั้ง.');
</script>
<?php
}

}
?>



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
        <link rel="icon" href="img/F1.png" type="image/png">

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
                    <a class="navbar-brand" href="doctordashboard.php">สวัสดีคุณ <?php echo $userRow['doctorFirstName'];?></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['doctorFirstName']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctorprofile.php"><i class="fa fa-fw fa-user"></i>ข้อมูลคลินิก</a>
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
                        <li class="active">
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i>การจัดการข้อมูลการจอง</a>
                        </li>
                        <li>
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i>การจัดการข้อมูลลูกค้า</a>
                        </li>
                        <li>
                            <a href="add_doctor.php"><i class="fa fa-fw fa-edit"></i>การจัดการข้อมูลทันตแพทย์</a>
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
                           การจัดการข้อมูลการจอง
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
                            <h3 class="panel-title">การจัดการข้อมูลการจอง</h3>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                            <div class="bootstrap-iso">
                             <div class="container-fluid">
                              <div class="row">
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                <form class="form-horizontal" method="post">
                                <div class="form-group form-group-lg">
                                <div class="form-group form-group-lg">
                                <label class="control-label col-sm-2 requiredField" for="date">
                                    วันที่
                                    <span class="asteriskField">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php $date = date('Y-m-d');  ?>
                                    <input class="form-control" id="date" name="date" type="date" min="<?= $date; ?>" required/>
                                    </div>
                                </div>
                                </div>

                                <!-- เพิ่มช่องกรอกสำหรับประเภทการให้บริการ -->
                                <div class="form-group form-group-lg">
                                <label class="control-label col-sm-2 requiredField" for="service">
                                    ทันตกรรมให้บริการ
                                    <span class="asteriskField">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="service" name="service" required>
                                    <option value="">-- เลือกประเภททันตกรรมด้าน --</option>
                                    <option value="ทันตกรรมทั่วไป">ทันตกรรมทั่วไป</option>
                                    <option value="ทันตกรรมความงาม">ทันตกรรมความงาม</option>
                                    </select>
                                </div>
                                </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="scheduleday">
                                   วัน
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <select class="select form-control" id="scheduleday" name="scheduleday" required>
                                    <option value="จันทร์">
                                     จันทร์
                                    </option>
                                    <option value="อังคาร">
                                     อังคาร
                                    </option>
                                    <option value="พุธ">
                                     พุธ
                                    </option>
                                    <option value="พฤหัสบดี">
                                     พฤหัสบดี
                                    </option>
                                    <option value="ศุกร์">
                                     ศุกร์
                                    </option>
                                    <option value="เสาร์">
                                     เสาร์
                                    </option>
                                    <option value="อาทิตย์">
                                     อาทิตย์
                                    </option>
                                   </select>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="starttime">
                                   เวลาเริ่ม
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  
                                  <div class="col-sm-10">
                                   <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                     <i class="fa fa-clock-o">
                                     </i>
                                    </div>
                                    <input class="form-control" id="starttime" name="starttime" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="endtime">
                                   เวลาสิ้นสุด
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                     <i class="fa fa-clock-o">
                                     </i>
                                    </div>
                                    <input class="form-control" id="endtime" name="endtime" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="bookavail">
                                   สถานะการใช้งาน
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <select class="select form-control" id="bookavail" name="bookavail" required>
                                    <option value="ว่าง">
                                     เปิดรับ
                                    </option> 
                                    <option value="ไม่ว่าง">
                                     ปิดรับ
                                    </option>
                                   </select>
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
                    <div class="panel panel-primary filterable">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">สรุปการจัดการข้อมูลการจอง</h3>
                            <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> ค้นหา</button>
                        </div>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                           <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="ลำดับ" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="ทันตกรรมด้าน" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="วันที่เปิดรับคิว" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="วันรับคิว" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="เวลาเริ่มต้น" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="เวลาสิ้นสุด" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="สถานะ" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="ลบข้อมูล" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $count=1;
                            $result=mysqli_query($con,"SELECT * FROM doctorschedule");
                            

                                  
                            while ($doctorschedule=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
                                echo "<tr>";
                                    echo "<td>" .  $count . "</td>";
                                    echo "<td>" . $doctorschedule['service'] . "</td>";
                                    echo "<td>" . $doctorschedule['scheduleDate'] . "</td>";
                                    echo "<td>" . $doctorschedule['scheduleDay'] . "</td>";
                                    echo "<td>" . $doctorschedule['startTime'] . "</td>";
                                    echo "<td>" . $doctorschedule['endTime'] . "</td>";
                                    echo "<td>" . $doctorschedule['bookAvail'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'><a href='#' id='".$doctorschedule['scheduleId']."' class='delete'><i class='bx bxs-trash'></i></a>
                            </td>";
                            $count++;
                            
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                       //echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                    </div>
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