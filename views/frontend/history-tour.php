<?php
    include 'templates/header.php';
    if(!isset($_SESSION["logged"])){
        session_destroy();
        echo "<script>window.location.href='index.php'</script>";
    }
    $currentDate = date("Y-m-d");

    foreach ($connectDB->connect()->query("SELECT  ID, `checkIn` FROM `ord_acts`") as $result_date) {
        if ($currentDate > $result_date["checkIn"]) {
            $connectDB->connect()->query("UPDATE `ord_acts` SET `status`= '1' WHERE ID = $result_date[ID]");
        }
    }
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-links">
                    <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ประวัติการจองห้องพักและการเข้าร่วมกิจกรรมของคุณ</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="h3">ประวัติการจองห้องพักของคุณ</h5>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>ชื่อห้องพัก</th>
                                <th>ชื่อบ้านพัก</th>
                                <th>ราคา</th>
                                <th>เช็คอิน - เช็คเอ้าท์</th>
                                <th>ราคารวม</th>
                                <th>วันที่บันทึกข้อมูล</th>
                                <th class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = "SELECT ord_rooms.rmID,
                                                 ord_rooms.cmID,
                                                 rmImg,
                                                 rmName,
                                                 rmPrice,
                                                 SUM(rmPrice) as 'total_price',
                                                 hmName,
                                                 fname,
                                                 lname, 
                                                 date,
                                                 checkOut, 
                                                 `date_save`, 
                                                 `status` 
                                          FROM `ord_rooms` 
                                          JOIN rooms ON ord_rooms.rmID = rooms.rmID
                                          JOIN homes ON homes.hmID = rooms.hmID
                                          JOIN customers ON ord_rooms.cmID = customers.cmID
                                          WHERE ord_rooms.cmID = '$cmID'
                                          GROUP BY cmID,rmID,date_save";
                            foreach($connectDB->connect()->query($sql)as $result){
                                $date_explode = explode(",",$result["date"]);
                        ?>
                        <tr>
                            <td class="table-user">
                                <?php 
                                    echo '<img src="../../assets/img/rooms/'.$result["rmImg"].'" class="avatar rounded-circle mr-3 mt-2">'; 
                                    echo '<b>'.$result["rmName"].'</b>';
                                ?> 
                            </td>
                            <td>
                                <?php echo $result["hmName"]; ?>
                            </td>
                            <td>
                                <?php echo $result["rmPrice"]; ?> บาท
                            </td>
                            <td>
                                <?php echo reset($date_explode)." ถึง ".$result["checkOut"]; ?>
                            </td>
                            <td>
                                <?php echo number_format($result["total_price"]); ?> บาท
                            </td>
                            <td>
                                <?php echo $result["date_save"]; ?>
                            </td>
                            <td class="text-center">
                                <?php echo ($result["status"]=='0')?"<span class='text-red'>อยู่ในระหว่างการจอง / เข้าพัก</span>":"<span class='text-success'>สิ้นสุดการจอง / เข้าพักแล้ว</span>"; ?>
                            </td>
                        </tr>
                        <?php } ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="h3">ประวัติการเข้าร่วมกิจกรรมของคุณ</h5>
                        </div>
                    </div>
                </div>
                    <div class="table-responsive">
                    <?php
                        $sql = "SELECT customers.fname, customers.lname, GROUP_CONCAT(activities.acName) as 'acName', 
                                       ord_acts.cmID, ord_acts.checkIn, GROUP_CONCAT(activities.acTime) as 'acTime',
                                       ord_acts.status
                                FROM `ord_acts` 
                                JOIN customers on ord_acts.cmID = customers.cmID 
                                JOIN activities ON ord_acts.actsID = activities.acID
                                WHERE ord_acts.cmID = '$cmID' GROUP BY checkIn,cmID ORDER BY checkIn DESC";
                        $stmt = $connectDB->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <table class="table align-items-center" id="datatable-basic1">
                            <thead class="thead-light">
                                <tr>
                                    <th>วันที่</th>
                                    <th>กิจกรรม - เช้า</th>
                                    <th>กิจกรรม - บ่าย</th>
                                    <th>กิจกรรม - เย็น</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php 
                                    foreach($stmt as $result){
                                        echo '<tr><td>'.$result["checkIn"].'</td>';

                                        $acTime = explode(",",$result["acTime"]);
                                        $acName = explode(",",$result["acName"]);

                                        for($j=1;$j<=3;$j++){
                                            $num = 0;
                                            for($k=0;$k<count($acTime);$k++){
                                                if($j==$acTime[$k]){
                                                    $num ++;
                                                    echo "<td>".$acName[$k]."</td>";
                                                }
                                            }
                                            echo ($num == 0) ? "<td>ไม่มีข้อมูล</td>" : "";
                                        }

                                        echo "<td>";
                                        if($result["status"]=='0'){
                                            echo "<span class='text-red'>อยู่ในระหว่างทัวร์</span>";
                                        }else{
                                            echo "<span class='text-success'>สิ้นสุดการทัวร์แล้ว</span>";
                                        }
                                        echo "</td>";

                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>
<?php include 'templates/footer-script.php' ?>
</body>

</html>