<?php 
    include("templates/header.php"); 
    if(!isset($_SESSION["logged"])){
        echo "<script>window.location.href='index.php';</script>";
    }
?>
<div class="main-content" id="panel">
    <?php include("templates/top-nav.php"); ?>
    <div class="header bg-primary pb-7"></div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">ข้อมูลการจองห้องพัก</h3>
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
                                    <th>ผู้จอง</th>
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
                                          GROUP BY cmID,rmID,date_save";
                                  foreach($connectDB->connect()->query($sql)as $result){
                                    //   $date_explode = explode(",",$result["date"]);
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
                                        <?php echo $result["date"]." ถึง ".$result["checkOut"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $result["total_price"]; ?> บาท
                                    </td>
                                    <td>
                                        <?php 
                                          echo "รหัสลูกค้า : ".$result["cmID"]."<br>";
                                          echo "ชื่อลูกค้า : ".$result["fname"]." ".$result["lname"]."<br>";
                                          echo "วันที่บันทึกข้อมูล : " .$result["date_save"];
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                          if($result["status"]==0){
                                            echo '<button type="button" class="btn btn-secondary btn-sm end" cmID="'.$result["cmID"].'" rmID="'.$result["rmID"].'" datesave="'.$result["date_save"].'">สิ้นสุดการเข้าพัก</button>';
                                          }else{
                                            echo "สิ้นสุดการเข้าพักแล้ว";
                                          }
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include("templates/footer.php"); ?>
    </div>
</div>
<?php include("templates/footer-script.php"); ?>
</body>

</html>