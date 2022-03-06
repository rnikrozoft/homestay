<div class="modal fade" id="add-homes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มบ้านพัก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../routes/backend/route-homes.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="homes" value="true">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5">รูปภาพตัวอย่าง</label>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <img src="../../assets/img/homes/homePic-01.jpg" class="img-center img-fluid" id="img-preview1" style="width:230px;height: 220px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">เลขรหัสประจำบ้าน 11 หลัก</label>
                                        <input type="text" pattern="[0-9]{11}" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 34045012769" name="id" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">ชื่อบ้าน</label>
                                        <input type="text" class="form-control form-control-alternative" placeholder="ตัวอย่าง : บ้านทรายทอง" name="name" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt--3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">เจ้าของบ้าน</label>
                                        <select class="form-control form-control-alternative" name="vname">
                                            <?php foreach ($connectDB->connect()->query("SELECT `mbID`, `mbPx`, `fname`, `lname` FROM `members`") as $result_members) { ?>
                                            <option value="<?php echo $result_members["mbID"]; ?>"><?php echo $result_members["mbPx"] . $result_members["fname"] . " " . $result_members["lname"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="h5">สิ่งอำนวยความสะดวก</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="car">
                                            <label class="form-check-label">ที่จอดรถ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="wifi">
                                            <label class="form-check-label">Wifi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="pri">
                                            <label class="form-check-label">Private Feature</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="h5">เลือกรูปภาพ</label>
                                    <div class="form-group">
                                        <input type="file" id="file-add" name="img" required modal-id="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="h5">รายละเอียด <small class="text-success">(สามารถปล่อยว่างได้)</small> </label>
                                <textarea class="form-control form-control-alternative" rows="8" name="detail" placeholder="รายละเอียดของบ้านพัก เช่น บ้านหลังนี้ติดลำธาร บรรยากาศดี อากาศรอบตัวบ้านเย็น มีอาหารเช้าและอาหารเย็นฟรี เป็นต้น"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="h5">หมายเหตุ <small class="text-success">(สามารถปล่อยว่างได้)</small> </label>
                                <textarea class="form-control form-control-alternative" rows="8" name="note" placeholder="หมายเหตุของบ้านพัก เช่น บ้านหลังนี้ติดลำธาร อาจมีตะไคร้น้ำเกิดขึ้นเยอะตามทางเดิน อาจก่อให้เกิดอุบัติเหตุลื่นล้มได้ โปรดระมัดระวัง"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="insert">บันทึกข้อมูล</button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>