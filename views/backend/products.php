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
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">ข้อมูลสินค้า</h3>
                            </div>
                            <div class="col-auto text-right">
                                <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#add-productions"><i class="fas fa-plus"></i></button>
                                <button class="btn btn-sm btn-neutral drop" name="prod" data-toggle="tooltip" data-placement="top" title="" data-original-title="ลบข้อมูลทั้งหมด"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($connectDB->connect()->query("SELECT * FROM products") as $result) { ?>
                            <div class="col-3">
                                <div id="products-show-contents">
                                    <div class="card-body">
                                        <a href="products-details.php?id=<?php echo $result["pdID"]; ?>">
                                            <img src="../../assets/img/products/<?php echo $result["pdImg"]; ?>" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 140px;height:140px;">
                                        </a>
                                        <div class="pt-4 text-center">
                                            <h5 class="h3 title">
                                                <span class="d-block mb-1"><?php echo $result["pdName"]; ?></span>
                                                <small class="h4 font-weight-light text-muted"><?php echo $result["pdPrice"]; ?> บาท / เหลือ <?php echo $result["qty"]; ?> ชิ้น</small>
                                            </h5>
                                            <div class="mt-3">
                                                <a href="products-details.php?id=<?php echo $result["pdID"]; ?>" class="btn btn-primary btn-icon-only rounded-circle">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button class="btn btn-danger btn-icon-only rounded-circle del" name="prod" value="<?php echo $result["pdID"]; ?>" >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("templates/footer.php"); ?>
    </div>
</div>
<?php
include("templates/footer-script.php");
include("modals/productsModals.php");
?>
</body>

</html>