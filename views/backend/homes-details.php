<?php 
include("templates/header.php");
if(!isset($_SESSION["logged"])){
  echo "<script>window.location.href='index.php';</script>";
}
include("../../routes/backend/functions.php");
$sql = "SELECT * FROM homes JOIN members ON homes.mbID = members.mbID WHERE homes.hmID = :id ";
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
  <div class="header pb-6 d-flex align-items-center"
    style="min-height: 500px; background-image: url(../../assets/img/homes/<?php echo $result["hmImg"]; ?>); background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-4"></span>
    <div class="container-fluid align-items-center">
      <!-- d-flex บรรทัดข้างบน -->
      <div class="row">
        <div class="col-lg-12 col-md-10">
          <h1 class="display-2 text-white"><?php echo $result["hmName"]; ?></h1>
          <p class="text-white mt-0 mb-5"><?php echo $result["hmDetail"]; ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-5">
        <img class="card-img-top" src="../../assets/img/homes/<?php echo $result["hmImg"]; ?>" id="img-preview">
        <div class="card mt-3">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">6 อันดับแรกล่าสุด</h6>
                <h5 class="h3 mb-0">สถิติรายได้ย้อนหลัง <?php echo date('Y'); ?></h5>
              </div>
              <div class="col text-right">
                <?php
                  $sql = "SELECT DATE_FORMAT(date,'%m') as 'month', 
                          SUM(rooms.rmPrice) as 'price' 
                          FROM `ord_rooms` 
                          JOIN rooms ON ord_rooms.rmID = rooms.rmID 
                          JOIN homes ON rooms.hmID = homes.hmID 
                          WHERE DATE_FORMAT(ord_rooms.date,'%Y') = ".date('Y')." 
                          AND homes.hmID = ".$result["hmID"]." 
                          GROUP BY DATE_FORMAT(ord_rooms.date,'%Y-%m') LIMIT 6";
                  $data_month_order = array();
                  $data_price_order = array();
                  foreach ($connectDB->connect()->query($sql) as $result_date_order) {
                    $xx = ThaiDate($result_date_order["month"]);
                    $data_month_order[] = $xx;
                    $data_price_order[] = $result_date_order["price"];
                  }
                  ?>
                <button id="date-order" class="btn btn-sm btn-neutral order" name="rooms"
                  value="<?php echo $result["hmID"]; ?>"
                  data-month='<?php echo json_encode($data_month_order, JSON_UNESCAPED_UNICODE); ?>'
                  data-price='<?php echo json_encode($data_price_order, JSON_UNESCAPED_UNICODE); ?>'>ดูข้อมูล</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <canvas id="report-content-top6" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
      <div class="col-xl-7">
        <form id="homes" action="../../routes/backend/route-homes.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="homes" value="true">
          <input type="hidden" name="defaultImg" value="<?php echo $result["hmImg"]; ?>">
          <input type="hidden" name="defaultID" value="<?php echo $result["hmID"]; ?>">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-7">
                  <h3 class="mb-0">ข้อมูลของบ้านหลังนี้</h3>
                  <h6 class="text-uppercase text-muted ls-1 mb-1">เมื่อแก้ไขเสร็จ คลิกที่ปุ่มบันทึกข้อมูล</h6>
                </div>
                <div class="col-5 text-right">
                  <button type="button" class="btn btn-warning btn-sm save">แก้ไขข้อมูล</button>
                  <button type="button" class="btn btn-danger btn-sm del" name="homes"
                    value="<?php echo $result["hmID"]; ?>">ลบข้อมูลบ้านนี้</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-12">
                    <label for="" class="form-control-label">เลือกรูปภาพ</label>
                    <div class="form-group">
                      <input type="file" id="file-edit" name="img" modal-id="" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label">เลขรหัสประจำบ้าน 11 หลัก</label>
                      <input type="text" pattern="[0-9]{11}" name="id" class="form-control"
                        placeholder="ตัวอย่าง : 34045012376" value="<?php echo $result["hmID"]; ?>" required disabled>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label">ชื่อบ้าน</label>
                      <input type="text" name="name" class="form-control" placeholder="ตัวอย่าง : บ้านจรูญเนตร"
                        value="<?php echo $result["hmName"]; ?>" required disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <label class="form-control-label">อุปกรณ์อำนวยความสะดวกพิเศษ</label>
                    <div class="form-group">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="car" type="checkbox" name="car"
                          <?php echo ($result["CAR"] == '1') ? "checked" : ""; ?> disabled>
                        <label class="form-check-label">มีที่จอดรถ</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="wifi" type="checkbox" name="wifi"
                          <?php echo ($result["WIFI"] == '1') ? "checked" : ""; ?> disabled>
                        <label class="form-check-label">มี Wi-fi</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="pri" type="checkbox" name="pri"
                          <?php echo ($result["PRI"] == '1') ? "checked" : ""; ?> disabled>
                        <label class="form-check-label">Private Feature</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">เจ้าของบ้าน</label>
                      <select name="vname" class="form-control" disabled>
                        <?php foreach ($connectDB->connect()->query("SELECT `mbID`, `mbPx`, `fname`, `lname` FROM `members`") as $result_member) { ?>
                        <option value="<?php echo $result_member["mbID"]; ?>"
                          <?php echo ($result_member["mbID"] == $result["mbID"]) ? 'selected="selected"' : ""; ?>>
                          <?php echo $result_member["mbPx"] . $result_member["fname"] . " " . $result_member["lname"]; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pl-lg-4">
                <div class="form-group">
                  <label class="form-control-label">รายละเอียดเกี่ยวกับบ้านหลังนี้</label> <small
                    class="text-success">(สามารถว่างได้)</small>
                  <textarea rows="5" name="detail" class="form-control"
                    placeholder="เขียนรายละเอียดบางอย่างเกี่ยวกับบ้านหลังนี้"
                    disabled><?php echo $result["hmDetail"]; ?></textarea>
                </div>
                <div class="form-group">
                  <label class="form-control-label">หมายเหตุ</label> <small class="text-success">(สามารถว่างได้)</small>
                  <textarea rows="5" name="note" class="form-control"
                    placeholder="เขียนหมายเหตุบางอย่างเกี่ยวกับบ้านหลังนี้"
                    disabled><?php echo $result["hmNote"]; ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <h3 class="mb-0">รูปภาพเพิ่มเติม</h3>
                <h6 class="text-uppercase text-muted ls-1 mb-1">รูปภาพรอบตัวบ้าน, รูปภาพบรรยากาศต่างๆภายในบ้าน</h6>
              </div>
              <div class="col-lg-6 col-5 text-right">
                <a href="upload-img.php?name=homes&id=<?php echo $result["hmID"]; ?>"
                  class="btn btn-sm btn-neutral">เพิ่มรูปภาพ</a>
                <button class="btn btn-sm btn-danger drop" name="img-home"
                  value="<?php echo $result["hmID"]; ?>">ลบรูปภาพทั้งหมด</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="card-columns">
              <?php foreach ($connectDB->connect()->query("SELECT * FROM imgs_hms WHERE hmID = $result[hmID]") as $result_img) { ?>
              <div class="card card-i" style="box-shadow: 0 0 2rem 0 rgba(0, 0, 0, 0)">
                <img src="../../assets/img/homes/details/<?php echo $result_img["imgName"]; ?>" class="img-thumbnail">
                <button type="button" name="img-home"
                  class="btn btn-outline-danger btn-sm btn-icon-only rounded-circle del"
                  value="<?php echo $result_img["imgID"]; ?>" home-id="<?php echo $result["hmID"]; ?>"><i
                    class="fas fa-trash-alt"></i></button>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card-header bg-secondary">
          <div class="row">
            <div class="col">
              <h3 class="mb-0">ข้อมูลห้องพัก</h3>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#add-rooms">เพิ่มห้องพัก</button>
              <button class="btn btn-sm btn-danger drop" name="room"
                home-id="<?php echo $result["hmID"]; ?>">ลบข้อมูลห้องพักทั้งหมด</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="card-columns">
            <?php foreach ($connectDB->connect()->query("SELECT rooms.*,(SELECT COUNT(*) FROM `likes_rooms` WHERE rmID = rooms.rmID) as 'count' FROM `rooms` WHERE hmID = $result[hmID]") as $result_room) {
                $data = [
                  "ID" => $result_room["rmID"],
                  "NAME" => $result_room["rmName"],
                  "PRICE" => $result_room["rmPrice"],
                  "QTY" => $result_room["rmGqty"],
                  "IMG" => $result_room["rmImg"],
                  "DETAIL" => $result_room["rmDetail"],
                  "NOTE" => $result_room["rmNote"]
                ];
                ?>
            <div class="card">
              <img class="card-img-top" src="../../assets/img/rooms/<?php echo $result_room["rmImg"]; ?>"
                alt="Image placeholder">
              <div class="card-body">
                <h5 class="h2 card-title mb-0"><?php echo $result_room["rmName"]; ?></h5>
                <small class="text-success">ราคา <?php echo $result_room["rmPrice"]; ?> บาท</small> /
                <small class="text-info">รองรับ <?php echo $result_room["rmGqty"]; ?> คน</small> /
                <small class="text-warning"><?php echo $result_room["count"]; ?> คะแนน</small>
                <p class="card-text mt-4">
                  <?php echo $result_room["rmDetail"]; ?>
                  <?php echo ($result_room["rmNote"] != null) ? '<footer class="blockquote-footer"><cite class="text-danger" title="หมายเหตุ">หมายเหตุ</cite> ' . $result_room["rmNote"] . '</footer>' : ""; ?>
                </p>
                <div class="form-group">
                  <button class="btn btn-warning btn-sm edit" name="room"
                    data='<?php echo json_encode($data, JSON_UNESCAPED_UNICODE); ?>'>แก้ไขข้อมูลห้องนี้</button>
                  <button class="btn btn-danger btn-sm del" name="room" value="<?php echo $result_room["rmID"]; ?>"
                    home-id="<?php echo $result["hmID"]; ?>">ลบข้อมูลห้องนี้</button>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php
      include("templates/footer.php"); ?>
  </div>
  <?php } else { ?>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-12">
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <!-- <span class="alert-icon"><i class="ni ni-like-2"></i></span> -->
          <span class="alert-text"><strong>ไม่พบข้อมูล </strong><a href="homes.php">กลับสู่หน้าหลัก</a></span>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<?php
include("templates/footer-script.php");
include("modals/homesModals.php");
include("modals/roomsModals.php");
include("modals/reportModal.php");
?>
</body>

</html>