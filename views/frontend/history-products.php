<?php
    include 'templates/header.php';
    if(!isset($_SESSION["logged"])){
        session_destroy();
        echo "<script>window.location.href='index.php'</script>";
    }
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-links">
                    <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ประวัติการซื้อสินค้าของคุณ</li>
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
                            <h5 class="h3">ประวัติการซื้อสินค้าของคุณ</h5>
                        </div>
                    </div>
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
                                $sql = "SELECT status as 'สถานะ', GROUP_CONCAT(products.pdName) as 'ชื่อสินค้า', GROUP_CONCAT(ord_prod.ord_QTY) as 'จำนวน', date as 'วันที่สั่งซื้อ',address.*
                                FROM ord_prod JOIN customers ON ord_prod.cmID = customers.cmID JOIN products ON ord_prod.pdID = products.pdID JOIN address ON ord_prod.addID = address.addID
                                WHERE ord_prod.cmID = '$cmID' GROUP BY ord_ID, ord_prod.cmID, date, status";
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
                                    <?php echo ($result["สถานะ"]==0)?"ยังไม่ได้จัดส่ง":"จัดส่งแล้ว"; ?>
                                </td>
                            </tr>
                            <?php } ?>
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