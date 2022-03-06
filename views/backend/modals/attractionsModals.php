<div class="modal fade" id="add-attractions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มบ้านพัก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="atts" action="../../routes/backend/route-atts.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="atts" value="true">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5">รูปภาพตัวอย่าง</label>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <img src="../../assets/img/attractions/attr-Pic.jpg" class="img-center img-fluid" id="img-preview1" style="width:230px;height: 220px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">ชื่อสถานที่</label>
                                        <input type="text" class="form-control form-control-alternative" placeholder="ตัวอย่าง : วัดพระแก้ว" name="name" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">ค่าธรรมเนียม</label>
                                        <small class="text-success">(สามารถปล่อยว่างได้)</small>
                                        <input type="number" min="20" max="999" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 50" name="price">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt--3">
                                <div class="col-md-12">
                                    <label class="h5">วันที่เปิดให้บริการ</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="mn" type="checkbox" name="date[]" value="จันทร์">
                                            <label class="form-check-label">จันทร์</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="tu" type="checkbox" name="date[]" value="อังคาร">
                                            <label class="form-check-label">อังคาร</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="wd" type="checkbox" name="date[]" value="พุธ">
                                            <label class="form-check-label">พุธ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="th" type="checkbox" name="date[]" value="พฤหัสบดี">
                                            <label class="form-check-label">พฤหัสฯ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="fi" type="checkbox" name="date[]" value="ศุกร์">
                                            <label class="form-check-label">ศุกร์</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="sa" type="checkbox" name="date[]" value="เสาร์">
                                            <label class="form-check-label">เสาร์</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="su" type="checkbox" name="date[]" value="อาทิตย์">
                                            <label class="form-check-label">อาทิตย์</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="h5">เลือกรูปภาพ</label>
                                    <div class="form-group">
                                        <input type="file" id="file-add" name="img" modal-id="1" required="">
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