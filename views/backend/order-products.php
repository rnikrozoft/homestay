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
                        <h3 class="mb-0">ข้อมูลการสั่งซื้อสินค้า</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ที่อยู่จัดส่ง</th>
                                    <th class="text-center">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT ord_ID, status as 'สถานะ', customers.fname as 'ชื่อลูกค้า', customers.lname as 'นามสกุลลูกค้า', GROUP_CONCAT(products.pdName) as 'ชื่อสินค้า', GROUP_CONCAT(ord_prod.ord_QTY) as 'จำนวน', date as 'วันที่สั่งซื้อ',address.*
                                    FROM ord_prod JOIN customers ON ord_prod.cmID = customers.cmID JOIN products ON ord_prod.pdID = products.pdID JOIN address ON ord_prod.addID = address.addID
                                    GROUP BY ord_ID, ord_prod.cmID, date, status";
                                    $stmt = $connectDB->connect()->query($sql);
                                    foreach($stmt as $result){
                                        $product_explode = explode(",",$result["ชื่อสินค้า"]);
                                        $qty_explode = explode(",",$result["จำนวน"]);
                                ?>
                                <tr>
                                    <td><?php echo $result["วันที่สั่งซื้อ"] ?></td>
                                    <td class="table-user">
                                        <?php 
                                            for($index=0;$index<count($product_explode);$index++){
                                                echo $product_explode[$index]." จำนวน ".$qty_explode[$index]." ชิ้น<br>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        รหัสลูกค้า <?php echo $result["cmID"] ?>
                                        ชื่อ<?php echo $result["ชื่อลูกค้า"]." ".$result["นามสกุลลูกค้า"] ?><br>
                                    <?php
                                        echo $result["houseNo"] . " ";
                                        echo "หมู่ที่ " . $result["moo"] . " ";
                                        if ($result["road"] != null) {
                                            echo "ถ. " . $result["road"] . " ";
                                        }
                                        if ($result["alley"] != null) {
                                            echo "ซ. " . $result["alley"] . " ";
                                        }
                                        if ($result["villageName"] != null) {
                                            echo $result["villageName"] . " ";
                                        }
                                        echo "ต. " . $result["subdistrict"] . "<br>";
                                        echo $result["province"] . " ";
                                        echo $result["zipcode"];
                                    ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            if($result["สถานะ"]==0){
                                                echo '<button class="btn btn-sm btn-success send" value="'.$result["ord_ID"].'">จัดส่ง</button>';
                                            }else{
                                                echo 'จัดส่งแล้ว';
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
<!-- <script src="../../assets/js/order-products-backend.js"></script> -->
</body>

</html>