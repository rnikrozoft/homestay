<div class="modal fade" id="add-rooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มห้องพัก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../routes/backend/route-homes.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="rooms">
                <input type="hidden" name="homeID" value="<?php echo $result["hmID"]; ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5">รูปภาพตัวอย่าง</label>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <img src="../../assets/img/homes/homePic-01.jpg" class="img-center img-fluid" id="img-preview-room1" style="width:230px;height: 220px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="h5">ชื่อห้องพัก</label>
                                        <input type="text" class="form-control form-control-alternative" placeholder="ตัวอย่าง : ห้องธรรมดา" name="name" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt--3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">ราคา / คืน</label>
                                        <input type="number" min="100" max="999" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 200" name="price" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">จำนวนแขกที่รองรับ</label>
                                        <input type="number" min="1" max="8" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 8" name="gqty" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="h5">เลือกรูปภาพ</label>
                                    <div class="form-group">
                                        <input type="file" id="file-add-room" modal-id="1" name="img" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="h5">รายละเอียด <small class="text-success">(สามารถปล่อยว่างได้)</small> </label>
                                <textarea class="form-control form-control-alternative" rows="8" name="detail"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="h5">หมายเหตุ <small class="text-success">(สามารถปล่อยว่างได้)</small> </label>
                                <textarea class="form-control form-control-alternative" rows="8" name="note"></textarea>
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

<div class="modal fade" id="edit-rooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มห้องพัก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../routes/backend/route-homes.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="rooms">
                <input type="hidden" name="defaultID" id="defaultID">
                <input type="hidden" name="defaultImg" id="defaultImg">
                <input type="hidden" name="homeID" value="<?php echo $result["hmID"]; ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5">รูปภาพตัวอย่าง</label>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <img class="img-center img-fluid" id="img-preview-room" style="width:230px;height: 220px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="h5">ชื่อห้องพัก</label>
                                        <input type="text" class="form-control form-control-alternative" placeholder="ตัวอย่าง : ห้องธรรมดา" name="name" required="" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt--3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">ราคา / คืน</label>
                                        <input type="number" min="100" max="9999" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 200" name="price" required="" id="price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">จำนวนแขกที่รองรับ</label>
                                        <input type="number" min="1" max="8" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 8" name="gqty" required="" id="qty">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="h5">เลือกรูปภาพ</label>
                                    <div class="form-group">
                                        <input type="file" id="file-edit-room" name="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="h5">รายละเอียด <small class="text-success">(สามารถปล่อยว่างได้)</small> </label>
                                <textarea class="form-control form-control-alternative" rows="8" name="detail" id="detail"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="h5">หมายเหตุ <small class="text-success">(สามารถปล่อยว่างได้)</small> </label>
                                <textarea class="form-control form-control-alternative" rows="8" name="note" id="note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="update">บันทึกข้อมูล</button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>