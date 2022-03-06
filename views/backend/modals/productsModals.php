<div class="modal fade" id="add-productions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../routes/backend/route-prod.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="products" value="true">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="h5">รูปภาพ</label>
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <img src="../../assets/img/products/prod-Pic.jpg" class="img-center img-fluid" id="img-preview1" style="width:230px;height: 220px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="h5">ชื่อสินค้า</label>
                                        <input type="text" class="form-control form-control-alternative" placeholder="ตัวอย่าง : หมูยอผสมแหนมเนือง" name="name" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">ราคา</label>
                                        <input type="number" min="1" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 300" name="price" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="h5">จำนวน</label>
                                        <input type="number" min="1" class="form-control form-control-alternative" placeholder="ตัวอย่าง : 30" name="qty" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
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