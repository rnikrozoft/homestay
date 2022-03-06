<?php
include("templates/header.php");
if(!isset($_SESSION["logged"])){
    echo "<script>window.location.href='index.php';</script>";
}

$sql = "SELECT * FROM attractions WHERE atID = :id ";
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
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../../assets/img/attractions/<?php echo $result["atImg"]; ?>); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-4"></span>
        <div class="container-fluid align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white"><?php echo $result["atName"]; ?></h1>
                    <p class="text-white mt-0 mb-5"><?php echo $result["atDetail"]; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <form id="atts" action="../../routes/backend/route-atts.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="atts" value="true">
            <input type="hidden" name="defaultImg" value="<?php echo $result["atImg"]; ?>">
            <input type="hidden" name="defaultID" value="<?php echo $result["atID"]; ?>">
            <div class="row">
                <div class="col-xl-5">
                    <img class="card-img-top" src="../../assets/img/attractions/<?php echo $result["atImg"]; ?>" id="img-preview" style="width: 415px;height: 320px;">
                </div>
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <h3 class="mb-0">ข้อมูลของสถานที่นี้</h3>
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">เมื่อแก้ไขเสร็จ คลิกที่ปุ่มบันทึกข้อมูล</h6>
                                </div>
                                <div class="col-5 text-right">
                                    <button type="button" class="btn btn-warning btn-sm save">แก้ไขข้อมูล</button>
                                    <button type="button" class="btn btn-danger btn-sm del" name="atts" value="<?php echo $result["atID"]; ?>">ลบข้อมูลนี้</button>
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">ชื่อสถานที่</label>
                                            <input type="text" name="name" class="form-control" placeholder="ตัวอย่าง : แห่นางแมว" value="<?php echo $result["atName"]; ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">ค่าธรรมเนียมเข้าชม</label>
                                            <input type="number" max="999" name="price" class="form-control" placeholder="ตัวอย่าง : 150" value="<?php echo $result["atPrice"]; ?>" disabled>
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
                                <div class="col-lg-12">
                                    <label class="form-control-label">วันที่เปิดมีสถานที่</label>
                                    <div class="form-group">
                                        <?php $date = explode(" ", $result["atDateOpen"]); ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="mn" name="date[]" value="จันทร์" <?php echo (in_array("จันทร์", $date)) ? "checked" : ""; ?> disabled>
                                            <label class="form-check-label">จันทร์</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="tu" name="date[]" value="อังคาร" <?php echo (in_array("อังคาร", $date)) ? "checked" : ""; ?> disabled>
                                            <label class="form-check-label">อังคาร</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="wd" name="date[]" value="พุธ" <?php echo (in_array("พุธ", $date)) ? "checked" : ""; ?> disabled>
                                            <label class="form-check-label">พุธ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="th" name="date[]" value="พฤหัสบดี" <?php echo (in_array("พฤหัสบดี", $date)) ? "checked" : ""; ?> disabled>
                                            <label class="form-check-label">พฤหัสฯ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="fi" name="date[]" value="ศุกร์" <?php echo (in_array("ศุกร์", $date)) ? "checked" : ""; ?> disabled>
                                            <label class="form-check-label">ศุกร์</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="sa" name="date[]" value="เสาร์" <?php echo (in_array("เสาร์", $date)) ? "checked" : ""; ?> disabled>
                                            <label class="form-check-label">เสาร์</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="su" name="date[]" value="อาทิตย์" <?php echo (in_array("อาทิตย์", $date)) ? "checked" : ""; ?> disabled>
                                            <label class="form-check-label">อาทิตย์</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">รายละเอียด</label>
                                        <textarea name="detail" rows="6" class="form-control" placeholder="เขียนรายละเอียดบางอย่างเกี่ยวกับสถานที่นี้" disabled><?php echo $result["atDetail"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">หมายเหตุ</label>
                                        <textarea name="note" rows="6" class="form-control" placeholder="เขียนหมายเหตุบางอย่างเกี่ยวกับสถานที่นี้" disabled><?php echo $result["atNote"]; ?></textarea>
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
                                <a href="upload-img.php?name=attractions&id=<?php echo $result["atID"]; ?>" class="btn btn-sm btn-neutral">เพิ่มรูปภาพ</a>
                                <button class="btn btn-sm btn-danger drop" name="img-atts" value="<?php echo $result["atID"]; ?>">ลบรูปภาพทั้งหมด</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-columns">
                            <?php foreach ($connectDB->connect()->query("SELECT * FROM imgs_atts WHERE atID = $result[atID]") as $result_img) { ?>
                            <div class="card card-i" style="box-shadow: 0 0 2rem 0 rgba(0, 0, 0, 0)">
                                <img src="../../assets/img/attractions/details/<?php echo $result_img["imgName"]; ?>" class="img-thumbnail">
                                <button type="button" name="img-atts" class="btn btn-outline-danger btn-sm btn-icon-only rounded-circle del" value="<?php echo $result_img["imgID"]; ?>" atts-id="<?php echo $result["atID"]; ?>"><i class="fas fa-trash-alt"></i></button>
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
                    <span class="alert-text"><strong>ไม่พบข้อมูล </strong><a href="attractions.php">กลับสู่หน้าหลัก</a></span>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php include("templates/footer-script.php"); ?>
</body>

</html>