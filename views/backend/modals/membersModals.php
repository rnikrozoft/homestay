<div class="modal fade" id="add-members" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มสมาชิก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../routes/backend/route-members.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="members" value="true">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5">รูปภาพตัวอย่าง</label>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <img src="../../assets/img/members/members.jpg" class="img-center img-fluid shadow shadow-lg--hover" id="img-preview1" style="width:230px;height: 220px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">เลขประจำตัวประชาชน 13 หลัก</label>
                                        <input type="text" pattern="[0-9]{13}" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 1100572845938" name="id" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">เบอร์โทร</label>
                                        <input type="text" pattern="[0-9]{10}" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 0987654321" name="tel" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt--3">
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="h5">คำนำหน้าชื่อ</label>
                                        <select name="prefix" class="form-control form-control-alternative">
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="h5">ชื่อ</label>
                                        <input class="form-control form-control-alternative" placeholder="ตัวอย่าง : ประกาษิศย์" name="fname" type="text" required="" style="width:10.5rem;">
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="h5">นามสกุล</label>
                                        <input class="form-control form-control-alternative" placeholder="ตัวอย่าง : นิติโรชภาณิชฐ์" name="lname" type="text" required="" style="width:10.5rem;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="h5">เลือกรูปภาพ</label>
                                    <div class="form-group">
                                        <input type="file" id="file-add" name="img" modal-id="1" required>
                                    </div>
                                </div>
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

<div class="modal fade" id="edit-members" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสมาชิก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../routes/backend/route-members.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="members" value="true">
                <input type="hidden" name="defaultImg" id="defaultImg">
                <input type="hidden" name="defaultID" id="defaultID">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5">รูปภาพตัวอย่าง</label>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <img id="img-preview" class="img-center img-fluid shadow shadow-lg--hover" id="img-preview2" style="width:230px;height: 220px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">เลขประจำตัวประชาชน 13 หลัก</label>
                                        <input type="text" pattern="[0-9]{13}" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 1100572845938" name="id" id="id" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">เบอร์โทร</label>
                                        <input type="text" pattern="[0-9]{10}" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 0987654321" name="tel" id="tel" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt--3">
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="h5">คำนำหน้าชื่อ</label>
                                        <select name="prefix" class="form-control form-control-alternative" id="prefix">
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="h5">ชื่อ</label>
                                        <input class="form-control form-control-alternative" placeholder="ตัวอย่าง : ประกาษิศย์" name="fname" id="fname" type="text" required="" style="width:10.5rem;">
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="h5">นามสกุล</label>
                                        <input class="form-control form-control-alternative" placeholder="ตัวอย่าง : นิติโรชภาณิชฐ์" name="lname" id="lname" type="text" required="" style="width:10.5rem;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="h5">เลือกรูปภาพ</label>
                                    <div class="form-group">
                                        <input type="file" id="file-edit" name="img" modal-id="">
                                    </div>
                                </div>
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