<?php
include("templates/header.php");
if(!isset($_SESSION["logged"])){
    echo "<script>window.location.href='index.php';</script>";
}
include("../../routes/backend/functions.php");

$sql = "SELECT * FROM activities WHERE acID = :id ";
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
        <input type="hidden" id="id-check" value="<?php echo $_GET["id"]; ?>">
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../../assets/img/activities/<?php echo $result["acImg"]; ?>); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-4"></span>
        <div class="container-fluid align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white"><?php echo $result["acName"]; ?></h1>
                    <p class="text-white mt-0 mb-5"><?php echo $result["acDetail"]; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-5">
                <img class="card-img-top" src="../../assets/img/activities/<?php echo $result["acImg"]; ?>" id="img-preview">
                <div class="card mt-3">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">6 อันดับแรกล่าสุด</h6>
                                <h5 class="h3 mb-0">สถิติรายได้ย้อนหลัง <?php echo date('Y'); ?></h5>
                            </div>
                            <div class="col text-right">
                                <?php
                                    $sql = "SELECT DATE_FORMAT(checkIn,'%m') as 'date', SUM(acPrice) as 'price' 
                                            FROM `ord_acts` JOIN activities ON ord_acts.actsID = activities.acID
                                            WHERE DATE_FORMAT(checkIn,'%Y') = " . date('Y') . " AND actsID = " . $result["acID"] . " GROUP BY DATE_FORMAT(checkIn,'%Y-%m') LIMIT 6";
                                    $data_month_order = array();
                                    $data_price_order = array();

                                    foreach ($connectDB->connect()->query($sql) as $result_date_order) {
                                        $xx = ThaiDate($result_date_order["date"]);
                                        $data_month_order[] = $xx;
                                        $data_price_order[] = $result_date_order["price"];
                                    }
                                    ?>
                                <button id="date-order" class="btn btn-sm btn-neutral order" name="acts" value="<?php echo $result["acID"]; ?>" data-month='<?php echo json_encode($data_month_order, JSON_UNESCAPED_UNICODE); ?>' data-price='<?php echo json_encode($data_price_order, JSON_UNESCAPED_UNICODE); ?>'>ดูข้อมูล</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="report-content-top6" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="card">
                    <form id="acts" action="../../routes/backend/route-acts.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="acts" value="true">
                        <input type="hidden" name="defaultImg" value="<?php echo $result["acImg"]; ?>">
                        <input type="hidden" name="defaultID" value="<?php echo $result["acID"]; ?>">

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <h3 class="mb-0">ข้อมูลของกิจกรรมนี้</h3>
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">เมื่อแก้ไขเสร็จ คลิกที่ปุ่มบันทึกข้อมูล</h6>
                                </div>
                                <div class="col-5 text-right">
                                    <button type="button" class="btn btn-warning btn-sm save">แก้ไขข้อมูล</button>
                                    <button type="button" class="btn btn-danger btn-sm del" name="acts" value="<?php echo $result["acID"]; ?>">ลบข้อมูลนี้</button>
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
                                            <label class="form-control-label">ชื่อกิจกรรม</label>
                                            <input type="text" name="name" class="form-control" placeholder="ตัวอย่าง : แห่นางแมว" value="<?php echo $result["acName"]; ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">ค่าธรรมเนียมเข้าร่วม</label>
                                            <input type="number" min="20" max="999" name="price" class="form-control" placeholder="ตัวอย่าง : 150" value="<?php echo $result["acPrice"]; ?>" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="form-control-label">วันที่เปิดมีกิจกรรม</label>
                                        <div class="form-group">
                                            <?php $date = explode(" ", $result["acDateOpen"]); ?>
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
                                    <div class="col-md-6">
                                        <label class="h5">เจ้าของกิจกรรม</label>
                                        <div class="form-group">
                                            <select class="form-control form-control-alternative" name="vname" disabled>
                                                <?php foreach ($connectDB->connect()->query("SELECT `mbID`, `mbPx`, `fname`, `lname` FROM `members`") as $result_members) { ?>
                                                <option value="<?php echo $result_members["mbID"]; ?>" <?php echo ($result_members["mbID"]==$result["mbID"])?"selected":""; ?>><?php echo $result_members["mbPx"] . $result_members["fname"] . " " . $result_members["lname"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="h5">ช่วงเวลาของกิจกรรม</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="time" value="1" <?php echo ($result["acTime"] == 1) ? "checked" : ""; ?> disabled>
                                                <label class="form-check-label">เช้า</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="time" value="2" <?php echo ($result["acTime"] == 2) ? "checked" : ""; ?> disabled>
                                                <label class="form-check-label">บ่าย</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="time" value="3" <?php echo ($result["acTime"] == 3) ? "checked" : ""; ?> disabled>
                                                <label class="form-check-label">เย็น</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">รายละเอียด</label>
                                    <textarea name="detail" rows="6" class="form-control" placeholder="เขียนรายละเอียดบางอย่างเกี่ยวกับกิจกรรมนี้" disabled><?php echo $result["acDetail"]; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">หมายเหตุ</label>
                                    <textarea name="note" rows="6" class="form-control" placeholder="เขียนหมายเหตุบางอย่างเกี่ยวกับกิจกรรมนี้" disabled><?php echo $result["acNote"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">รูปภาพเพิ่มเติม</h3>
                                <h6 class="text-uppercase text-muted ls-1 mb-1">รูปภาพบรรยากาศต่างๆ ของกิจกรรม</h6>
                            </div>
                            <div class="col-lg-6 col-5 text-right">
                                <a href="upload-img.php?name=activities&id=<?php echo $result["acID"]; ?>" class="btn btn-sm btn-neutral">เพิ่มรูปภาพ</a>
                                <button class="btn btn-sm btn-danger drop" name="img-acts" value="<?php echo $result["acID"]; ?>">ลบรูปภาพทั้งหมด</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-columns">
                            <?php foreach ($connectDB->connect()->query("SELECT * FROM imgs_acts WHERE acID = $result[acID]") as $result_img) { ?>
                            <div class="card card-i" style="box-shadow: 0 0 2rem 0 rgba(0, 0, 0, 0)">
                                <img src="../../assets/img/activities/details/<?php echo $result_img["imgName"]; ?>" class="img-thumbnail">
                                <button type="button" name="img-acts" class="btn btn-outline-danger btn-sm btn-icon-only rounded-circle del" value="<?php echo $result_img["imgID"]; ?>" acts-id="<?php echo $result["acID"]; ?>"><i class="fas fa-trash-alt"></i></button>
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
                    <span class="alert-text"><strong>ไม่พบข้อมูล </strong><a href="activities.php">กลับสู่หน้าหลัก</a></span>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php
include("templates/footer-script.php");
include("modals/reportModal.php");
?>
</body>

</html>