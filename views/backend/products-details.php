<?php
include("templates/header.php");
if(!isset($_SESSION["logged"])){
    echo "<script>window.location.href='index.php';</script>";
}
$sql = "SELECT * FROM products WHERE pdID = :id ";
$stmt = $connectDB->connect()->prepare($sql);
$stmt->execute(
    array(
        ":id" => $_GET["id"]
    )
);
?>
<div class="main-content" id="panel">
    <?php include("templates/top-nav.php");
    if ($stmt->rowCount() == 1) {
        $result = $stmt->fetch(); ?>
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../../assets/img/products/<?php echo $result["pdImg"]; ?>); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-4"></span>
        <div class="container-fluid align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white"><?php echo $result["pdName"]; ?></h1>
                    <p class="text-white mt-0 mb-5"><?php echo $result["pdDetail"]; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <form id="prod" action="../../routes/backend/route-prod.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="products" value="true">
            <input type="hidden" name="defaultImg" value="<?php echo $result["pdImg"]; ?>">
            <input type="hidden" name="defaultID" value="<?php echo $result["pdID"]; ?>">
            <div class="row">
                <div class="col-xl-5">
                    <img class="card-img-top" src="../../assets/img/products/<?php echo $result["pdImg"]; ?>" id="img-preview" style="width: 415px;height: 320px;">
                </div>
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <h3 class="mb-0">ข้อมูลของสินค้านี้</h3>
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">เมื่อแก้ไขเสร็จ คลิกที่ปุ่มบันทึกข้อมูล</h6>
                                </div>
                                <div class="col-5 text-right">
                                    <button type="button" class="btn btn-warning btn-sm save">แก้ไขข้อมูล</button>
                                    <button type="button" class="btn btn-danger btn-sm del" name="prod" value="<?php echo $result["pdID"]; ?>">ลบข้อมูลนี้</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-control-label">เลือกรูปภาพ</label>
                                        <div class="form-group">
                                            <input type="file" id="file-edit" modal-id="" name="img" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">ชื่อสินค้า</label>
                                            <input type="text" name="name" class="form-control" placeholder="ตัวอย่าง : แห่นางแมว" value="<?php echo $result["pdName"]; ?>" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-control-label">ราคา</label>
                                            <input type="number" min="1" name="price" class="form-control" placeholder="ตัวอย่าง : 150" value="<?php echo $result["pdPrice"]; ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-control-label">จำนวน</label>
                                            <input type="number" min="1" name="qty" class="form-control" placeholder="ตัวอย่าง : 150" value="<?php echo $result["qty"]; ?>" required disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">รายละเอียด</label>
                                        <textarea name="detail" rows="6" class="form-control" placeholder="เขียนรายละเอียดบางอย่างเกี่ยวกับสินค้านี้" disabled><?php echo $result["pdDetail"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">หมายเหตุ</label>
                                        <textarea name="note" rows="6" class="form-control" placeholder="เขียนหมายเหตุบางอย่างเกี่ยวกับสินค้านี้" disabled><?php echo $result["pdNote"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">รูปภาพเพิ่มเติม</h3>
                            </div>
                            <div class="col-lg-6 col-5 text-right">
                                <a href="upload-img.php?name=products&id=<?php echo $result["pdID"]; ?>" class="btn btn-sm btn-neutral">เพิ่มรูปภาพ</a>
                                <button class="btn btn-sm btn-danger drop" name="img-prod" value="<?php echo $result["pdID"]; ?>">ลบรูปภาพทั้งหมด</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-columns">
                            <?php foreach ($connectDB->connect()->query("SELECT * FROM imgs_prod WHERE pdID = $result[pdID]") as $result_img) { ?>
                            <div class="card card-i" style="box-shadow: 0 0 2rem 0 rgba(0, 0, 0, 0)">
                                <img src="../../assets/img/products/details/<?php echo $result_img["imgName"]; ?>" class="img-thumbnail">
                                <button type="button" name="img-prod" class="btn btn-outline-danger btn-sm btn-icon-only rounded-circle del" value="<?php echo $result_img["imgID"]; ?>" prod-id="<?php echo $result["pdID"]; ?>"><i class="fas fa-trash-alt"></i></button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("templates/footer.php"); ?>
    </div>
    <?php } else { ?>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12">
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <!-- <span class="alert-icon"><i class="ni ni-like-2"></i></span> -->
                    <span class="alert-text"><strong>ไม่พบข้อมูล </strong><a href="products.php">กลับสู่หน้าหลัก</a></span>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php include("templates/footer-script.php"); ?>
</body>

</html>