<?php
    require_once "../../controllers/connectDB.php";
    $connectDB = new connectDB;
    // $sql = "SELECT customers.fname, customers.lname, GROUP_CONCAT(activities.acName) as 'acName', ord_acts.cmID, ord_acts.checkIn, GROUP_CONCAT(activities.acTime) as 'acTime' 
    // FROM `ord_acts` JOIN customers on ord_acts.cmID = customers.cmID JOIN activities ON ord_acts.actsID = activities.acID
    // WHERE checkIn = '$_POST[date]' GROUP BY checkIn,cmID ORDER BY checkIn DESC";
    // $stmt = $connectDB->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- <table class="table align-items-center" id="datatable-basic1">
    <thead class="thead-light">
        <tr>
            <th>รหัสลูกค้า</th>
            <th>ชื่อลูกค้า</th>
            <th>กิจกรรม - เช้า</th>
            <th>กิจกรรม - บ่าย</th>
            <th>กิจกรรม - เย็น</th>
        </tr>
    </thead>
    <tbody class="list">
        <?php 
            foreach($stmt as $result){
                echo'<tr>
                        <th>'.$result["cmID"].'</th>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">'.$result["fname"]." ".$result["lname"].'</span>
                                </div>
                            </div>
                        </th>';

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
                echo '</tr>';
            }
        ?>
    </tbody>
</table> -->
<?php 
    $sql= "SELECT customers.cmID, fname, lname, date_save 
            FROM ord_acts JOIN customers ON ord_acts.cmID = customers.cmID 
            WHERE checkIn = '$_POST[date]' AND actsID = '$_POST[acID]'";
    foreach($connectDB->connect()->query($sql) as $result){ ?>
    <tr>
        <td>
            <?php echo $result["fname"]." ".$result["lname"]; ?>
        </td>
        <td>
            <?php echo $result["date_save"]; ?>
        </td>
    </tr>
    <?php } ?>
                    