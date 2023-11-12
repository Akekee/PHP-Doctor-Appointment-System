<?php

include_once 'assets/conn/dbconnect.php';
$q = $_GET['q'];
// echo $q;
$res = mysqli_query($con,"SELECT * FROM doctorschedule WHERE scheduleDate='$q'");



if (!$res) {
die("Error running $sql: " . mysqli_error());
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    
</head>
<body>
     <?php 

        if (mysqli_num_rows($res)==0) {

            echo "<div class='alert alert-danger' role='alert'>ตารางการจองคิวเลือกวันทีที่ต้องการ หากต้องการจองกรุณาสมัครสมาชิกเพื่อทำการจอง</div>";
                
            } else {
             echo "   <table class='table table-hover'>";
        echo " <thead>";
            echo " <tr>";
                echo " <th>ทันตกรรมด้าน</th>";
                echo " <th>วัน</th>";
                echo " <th>วันเดือนปี</th>";
               echo "  <th>เริ่มเวลา</th>";
               echo "  <th>เวลาสิ้นสุด</th>";
                echo " <th>สถานะ</th>";
            echo " </tr>";
       echo "  </thead>";
       echo "  <tbody>";
       
         while($row = mysqli_fetch_array($res)) { 

            ?>

            <tr>
                <?php

                // $avail=null;
                if ($row['bookAvail']!='เปิดรับ') {
                $avail="danger";
                } else {
                $avail="primary";
                
            }
                echo "<td>" . $row['service'] . "</td>";
                echo "<td>" . $row['scheduleDay'] . "</td>";
                echo "<td>" . $row['scheduleDate'] . "</td>";
                echo "<td>" . $row['startTime'] . "</td>";
                echo "<td>" . $row['endTime'] . "</td>";
                echo "<td> <span class='label label-".$avail."'>". $row['bookAvail'] ."</span></td>";
                ?>
            </tr>
        <?php
    }
}
    ?>
        </tbody>
    </body>
</html>