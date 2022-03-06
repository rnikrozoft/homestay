<?php 
    include("templates/header.php"); 

    $sql = "SELECT products.*,(SELECT COUNT(*) FROM likes_prod WHERE likes_prod.pdID = products.pdID) as 'countLike' FROM products 
        WHERE products.pdID = :id";
    $stmt = $connectDB->connect()->prepare($sql);
    $stmt->execute(
        array(
            ":id" => $_GET["id"]
        )
    );

?>
<?php if ($stmt->rowCount() == 1) { $result = $stmt->fetch(PDO::FETCH_ASSOC); ?>
<div class="header pb-6 d-flex align-items-center"
    style="min-height: 500px; background-image: url(../../assets/img/products/<?php echo $result["pdImg"]; ?>); background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container align-items-center">
        <!-- d-flex บรรทัดข้างบน -->
        <div class="row">
            <div class="col-lg-7 pt-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-links">
                        <li class="breadcrumb-item"><a href="products.php"
                                class="text-white">กิจกรรมในชุมชนที่คุณอาจสนใจ</a></li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $result["pdID"]; ?>">
                                <span class="badge badge-pill badge-primary">
                                    <?php echo $result["pdName"]; ?>
                                </span>
                            </a>
                        </li>
                    </ol>
                </nav>
                <div class="card-body">
                    <div class="fotorama" data-nav="thumbs" data-width="100%" data-height="400">
                        <img src="../../assets/img/products/<?php echo $result["acImg"]; ?>">
                        <?php foreach ($connectDB->connect()->query("SELECT imgName FROM imgs_prod WHERE pdID = $result[pdID]") as $result_img){ ?>
                        <img src="../../assets/img/products/details/<?php echo $result_img["imgName"]; ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pt-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <label class="form-control-label">ราคา</label>
                                <div class="form-group">
                                    <h1 class="text-warning"><?php echo $result["pdPrice"]; ?> บาท</h1>                              
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="form-control-label">จำนวนในสต็อก</label>
                                    <div class="form-group">
                                        <h1 class="text-warning"> <?php echo ($result["qty"]!=0)? $result["qty"]." ชิ้น":"สินค้าหมด"; ?> </h1>                           
                                    </div>
                            </div>
                        </div>
                        <form id="form-selected-prod">
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h5 class="display-5">กรุณาใส่จำนวนสินค้าที่ต้องการ</h5>
                                        <input type="hidden" id="pdID" value="<?php echo $result["pdID"]; ?>">
                                            <input class="form-control form-control-alternative bg-white" id="qty" min="1" max="<?php echo $result["qty"]; ?>" placeholder="ตัวอย่าง : 15" type="number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <?php if(isset($_SESSION["logged"])){ ?>
                                            <button type="submit" class="btn btn-outline-success btn-lg btn-block" name="set">เพิ่มใส่ตะกร้า
                                                <p class="display-5" 
                                                    style="font-family: inherit;
                                                            font-size: 1.625rem;
                                                            font-weight: 600;
                                                            line-height: 1.5;
                                                            margin-bottom: .5rem;">
                                                    <?php echo "฿ ".$result["pdPrice"]." บาท"; ?>
                                                </p>
                                            </button>
                                        <?php }else{
                                            echo '<button type="button"  class="btn btn-outline-success btn-lg btn-block" data-toggle="modal" data-target="#login">เพิ่มใส่ตะกร้า
                                                    <p class="display-5" 
                                                        style="font-family: inherit;
                                                                font-size: 1.625rem;
                                                                font-weight: 600;
                                                                line-height: 1.5;
                                                                margin-bottom: .5rem;">
                                                        <?php echo "฿ ".$result["pdPrice"]." บาท"; ?>
                                                    </p>
                                                </button>';
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <?php if(isset($_SESSION["logged"])){ ?>
                                        <button class="btn btn-outline-warning btn-lg btn-block like" name="prod" id="<?php echo $result["pdID"]; ?>">ให้คะแนนแนะนำสินค้านี้ | <?php echo $result["countLike"]; ?></button>
                                    <?php }else{
                                        echo '<button class="btn btn-outline-warning btn-lg btn-block" data-toggle="modal" data-target="#login">ให้คะแนนแนะนำสินค้านี้ | '.$result["countLike"].'</button>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt--6">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card">
                <div class="card-header"><h1 class="display-2"><?php echo $result["pdName"]; ?></h1></div>
                <div class="card-body">
                    <p class="mt-3">
                        <?php echo $result["pdDetail"]; 
                                if($result["pdNote"]!=""){
                                    echo '<footer class="blockquote-footer">
                                            <cite class="text-danger" title="หมายเหตุ">หมายเหตุ</cite>
                                            '.$result["pdNote"].'
                                        </footer>';
                                }
                            ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include("templates/footer.php"); 
    }else{ ?>
<div class="flex-center position-ref full-height">
    <div class="code">404</div>
    <div class="message">
        Not Found
        <p class="small"><a href="index.php">กลับสู่หน้าแรก</a></p>
    </div>
</div>
<?php    
    } include('templates/footer-script.php');
?>