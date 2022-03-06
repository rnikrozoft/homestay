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
                    <li class="breadcrumb-item active" aria-current="page">แผนทัวร์ของคุณ</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-8">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-0">สินค้าของคุณ</h3>
                        </div>
                    </div>
                </div>
                <?php if (!isset($_SESSION["listP"])) { ?>
                <div class="card-body">
                    ไม่มีข้อมูล
                    <p class="small">
                        หากคุณต้องการสินค้า โปรดคลิกที่เมนู <a href="products.php">สินค้าโอท็อป</a>
                    </p>
                </div>
                <?php } else { ?>
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>สินค้า</th>
                                <th>ราคา / ชิ้น</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php 
                                $priceP = 0;
                                for($i=0;$i<count($_SESSION["listP"]);$i++){ ?>
                            <tr>
                                <td class="table-user">
                                    <img src="../../assets/img/products/<?php echo $_SESSION["listP"][$i]["Img"]; ?>" class="avatar rounded-circle mr-3">
                                    <b><?php echo $_SESSION["listP"][$i]["Name"]; ?></b>
                                </td>
                                <td>
                                    <?php echo $_SESSION["listP"][$i]["Price"]; ?> บาท
                                </td>
                                <td>
                                    <?php echo $_SESSION["listP"][$i]["QTY"]; ?> ชิ้น
                                </td>
                                <td>
                                    <?php echo $total_price = $_SESSION["listP"][$i]["Price"]*$_SESSION["listP"][$i]["QTY"]; ?> บาท
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger btn-icon-only rounded-circle del-list" name="prod" value="<?php echo $_SESSION["listP"][$i]["ID"]; ?>">
                                        <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                                    </button>
                                </td>
                            </tr>
                            <?php 
                                $priceP += $total_price;
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">ราคารวม <?php echo $priceP; ?> บาท</th>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php if (isset($_SESSION["listP"])){ ?>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="heading-title text-warning mb-0">สรุปข้อมูล ORDER ของคุณ</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="../../routes/frontend/route-checkout.php">
                        <input type="hidden" name="products" value="true">
                        <input type="hidden" name="priceP" value="<?php echo $priceP; ?>">
                        <?php 
                            $i=1;
                            $sql = "SELECT * FROM `address` WHERE cmID = $cmID";
                            $stmt = $connectDB->connect()->query($sql);
                            if($stmt->rowCount()==0){
                                echo 'ยังไม่มีข้อมูลที่อยู่ที่จัดส่ง <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#add-address">เพิ่มข้อมูลที่อยู่ </button>';
                            }else{
                                echo '<h3 class="text-header">ข้อมูลการจัดส่ง</h3>';
                                foreach($stmt as $result){ ?>
                                    <div class="mb-3">
                                        <input type="radio" <?php echo ($i == 1) ? "checked" : ""; ?> name="address" value="<?php echo $result["addID"]; ?>">
                                        <label class="h5 kanit">ที่อยู่ <?php echo $i; ?> :</label>
                                        <span class="text-sm kanit">
                                            <?php echo $result["houseNo"]; ?> หมู่ที่ <?php echo $result["moo"]; ?>
                                            ต.<?php echo $result["subdistrict"]; ?>
                                            <?php echo $result["province"]; ?> <?php echo $result["zipcode"]; ?>
                                        </span>
                                    </div>
                                    
                        <?php $i++; } ?>
                        <hr>
                        <script type="text/javascript" src="https://cdn.omise.co/card.js" 
                            data-key="pkey_test_5go63y8qeb6vf8sg36i" 
                            data-image="../../assets/img/brand/logo.png" 
                            data-frame-label="ชุมชนโฮมสเตย์" 
                            data-button-label="ยอดชำระรวมทั้งหมด <?php echo $priceP; ?> บาท" 
                            data-submit-label="Submit" 
                            data-amount="<?php echo $priceP* 100; ?>" 
                            data-currency="thb">
                        </script>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php include 'templates/footer.php'; ?>
<?php include 'templates/footer-script.php' ?>
</body>

</html>