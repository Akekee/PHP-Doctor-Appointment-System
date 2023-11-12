<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (isset($_GET['appid'])) {
$appid=$_GET['appid'];
}
$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
JOIN appointment b
On a.icPatient = b.patientIc
JOIN doctorschedule c
On b.scheduleId=c.scheduleId
WHERE b.appId  =".$appid);

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ใบการจองทันตกรรมทับปุด</title>
        <link rel="icon" href="assets/img/F1.png" type="image/png">
        
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="assets/img/logo1.png" style="width:100%; max-width:300px;">
                                </td>
                                
                                <td>
                                Appointment ID: <?php echo $userRow['appId'];?><br>
                                    ทำรายการวันที่: <?php echo date("d-m-Y");?><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr> 
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <?php echo $userRow['patientAddress'];?>
                                </td>
                                
                                <td><?php echo $userRow['patientIc'];?><br>
                                    <?php echo $userRow['patientFirstName'];?> <?php echo $userRow['patientLastName'];?><br>
                                    <?php echo $userRow['patientEmail'];?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                
                
                <tr class="heading">
                    <td>
                        รายละเอียดการจอง
                    </td>
                    
                    <td>
                        
                    </td>
                </tr>
                
                <tr class="item">
                    <td>
                        Appointment ID:
                    </td>
                    
                    <td>
                       <?php echo $userRow['appId'];?>
                    </td>
                </tr>
                
                <!-- <tr class="item">
                    <td>
                        Schedule ID(รหัสกำหนดการ):
                    </td> -->
                    
                    <!-- <td>
                        <?php echo $userRow['scheduleId'];?>
                    </td>
                </tr> -->

                <tr class="item">
                    <td>
                        วันจอง:
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDay'];?>
                    </td>
                </tr>
                

                 <tr class="item">
                    <td>
                        วันเดือนปีที่จอง:
                    </td>
                    
                    <td>
                        <?php echo $userRow['scheduleDate'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        เวลาที่จอง:
                    </td>
                    
                    <td>
                        <?php echo $userRow['startTime'];?> - <?php echo $userRow['endTime'];?>
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        ประเภทันตกรรม:
                    </td>
                    
                    <td>
                        <?php echo $userRow['service'];?>
                    </td>

                 <tr class="item">
                    <td>
                        ประเภทรับบริการ:
                    </td>
                
                    <td>
                        <?php echo $userRow['appSymptom'];?> 
                    </td>
                </tr>
                <tr class="item">
                    <td>
                        <font color="red" size="3"><strong>หมายเหตุ</strong></font><br>
                        <font color="red" size="2"><strong>*กรุณามาตามวันและเวลาที่ท่านทำการจอง</strong></font><br>
                        <font color="red" size="2"><strong>*กรุณาแสดงใบยืนยันการจองต่อเจ้าหน้าที</strong></font>
                    </td>
                </tr>

</tr>

                
            </table>
        </div>
        <div class="print">
        <button onclick="myFunction()">Print this page</button>
</div>
<script>
function myFunction() {
    window.print();
}
</script>
    </body>
</html>