<div class="modal fade" id="image-slide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มรูปภาพแบนเนอร์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../routes/backend/route-img-slide.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="name" value="<?php echo $path; ?>">
        <div class="modal-body">
            <label class="form-control-label">รูปภาพ <small>(ขนาดแนะนำ 1350 x 415 px)</small></label>
            <div class="form-group">
                <input type="file" name="file" required>
            </div>
            <label class="form-control-label">Header</label>
            <div class="form-group">
                <input type="text" name="header" class="form-control form-control-alternative" required>
            </div>
            <label class="form-control-label">Sub-Header</label>
            <div class="form-group">
                <input type="text" name="sub-header" class="form-control form-control-alternative">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="insert">บันทึกข้อมูล</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
      </form>
    </div>
  </div>
</div>