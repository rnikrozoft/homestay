<!-- Argon Scripts -->
<!-- Core -->
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="../../assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>


<!-- Argon JS -->
<!-- <script src="../../assets/js/argon.min9f1e.js?v=1.1.0"></script> -->
<script src="../../assets/js/frontend.js"></script>

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">ยินดีต้อนรับเข้าสู่เว็บไซต์</h5>
                        <h6 class="text-uppercase text-muted ls-1 mb-1">โปรดกรอกข้อมูลเพื่อเข้าสู่ระบบ</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <form role="form" action="../../routes/frontend/route-authentications.php" method="POST">
                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control" name="email" placeholder="อีเมลล์" type="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" name="password" placeholder="รหัสผ่าน" type="password" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4" name="login" value="true">เข้าสู่ระบบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">ยินดีต้อนรับเข้าสู่เว็บไซต์</h5>
                        <h6 class="text-uppercase text-muted ls-1 mb-1">โปรดกรอกข้อมูลเพื่อเข้าสมัครสมาชิก</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <form action="../../routes/frontend/route-authentications.php" method="POST">
                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">เลขประจำตัวประชาชน 13 หลัก</label>
                                <input type="text" pattern="[0-9]{13}" class="form-control" placeholder="ตัวอย่าง : 1100501372859" name="ID" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">เบอรโทร</label>
                                <input type="text" pattern="[0-9]{10}" class="form-control" placeholder="ตัวอย่าง : 0987654321" name="tel" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">ชื่อ</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : สมคิด" name="fname" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">นามสกุล</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : จิตใจดี" name="lname" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">อีเมลล์</label>
                                <input type="email" class="form-control" placeholder="ตัวอย่าง : myemail@hotmail.com" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" placeholder="ควรมีอักษร 8 ตัวขึ้นไป" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="sumit" class="btn btn-outline-primary my-4" name="register">สมัครสมาชิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">ยินดีต้อนรับเข้าสู่เว็บไซต์</h5>
                        <h6 class="text-uppercase text-muted ls-1 mb-1">โปรดกรอกข้อมูลเพื่อเพิ่มข้อมูลที่อยู่ของคุณ</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <form action="../../routes/frontend/route-address.php" method="POST">
                    <input type="hidden" name="address" value="true">
                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">บ้านเลขที่</label>
                                <input type="number" class="form-control" placeholder="ตัวอย่าง : 7" name="homeID" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">หมู่ที่</label>
                                <input type="number" class="form-control" placeholder="ตัวอย่าง : 14" name="moo" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ถนน <small class="text-success">(สามารถว่างได้)</small></label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : แจ้งสนิท" name="road" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ซอย <small class="text-success">(สามารถว่างได้)</small></label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : อารีย์" name="alley" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ชื่อหมู่บ้าน <small class="text-success">(สามารถว่างได้)</small></label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : ทวีศักดิ์" name="vname" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ตำบล</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : ไทรน้อย" name="subDistrict" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">อำเภอ</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : เมือง" name="district" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">จังหวัด</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : 0987654321" name="province" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">รหัสไปรษณีย์</label>
                                <input type="number" class="form-control" placeholder="ตัวอย่าง : เชียงใหม่" name="zipcode" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="sumit" class="btn btn-outline-primary my-4" name="insert">บันทึกข้อมูล</button>
                        <button type="reset" class="btn btn-outline-danger my-4" data-dismiss="modal">ไว้ทีหลัง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">ยินดีต้อนรับเข้าสู่เว็บไซต์</h5>
                        <h6 class="text-uppercase text-muted ls-1 mb-1">โปรดกรอกข้อมูลเพื่อแก้ไขข้อมูลที่อยู่ของคุณ</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <form action="../../routes/frontend/route-address.php" method="POST">
                    <input type="hidden" name="address" value="true">
                    <input type="hidden" name="defaultID" id="defaultID">
                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">บ้านเลขที่</label>
                                <input type="number" class="form-control" placeholder="ตัวอย่าง : 7" name="homeID" id="homeID" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">หมู่ที่</label>
                                <input type="number" class="form-control" placeholder="ตัวอย่าง : 14" name="moo" id="moo" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ถนน <small class="text-success">(สามารถว่างได้)</small></label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : แจ้งสนิท" name="road" id="road">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ซอย <small class="text-success">(สามารถว่างได้)</small></label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : อารีย์" name="alley" id="alley">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ชื่อหมู่บ้าน <small class="text-success">(สามารถว่างได้)</small></label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : ทวีศักดิ์" name="vname" id="vname">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">ตำบล</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : ไทรน้อย" name="subDistrict" id="subDistrict" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">อำเภอ</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : เมือง" name="district" id="district" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">จังหวัด</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง : 0987654321" name="province" id="province" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">รหัสไปรษณีย์</label>
                                <input type="number" class="form-control" placeholder="ตัวอย่าง : เชียงใหม่" name="zipcode" id="zipcode" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="sumit" class="btn btn-outline-primary my-4" name="update">บันทึกข้อมูล</button>
                        <button type="reset" class="btn btn-outline-danger my-4" data-dismiss="modal">ไว้ทีหลัง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">ยินดีต้อนรับเข้าสู่เว็บไซต์</h5>
                        <h6 class="text-uppercase text-muted ls-1 mb-1">โปรดกรอกข้อมูลเพื่อแก้ไขข้อมูลที่อยู่ของคุณ</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <form action="../../routes/frontend/route-authentications.php" method="POST">
                    <input type="hidden" name="cmID" value="<?php echo $_SESSION["logged"]["ID"]; ?>">
                    <input type="hidden" name="changePassword" value="true">
                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">รหัสผ่านเก่า</label>
                                <input type="password" class="form-control" name="oldPwd" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">รหัสผ่านใหม่</label>
                                <input type="password" class="form-control" name="newPwd" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="sumit" class="btn btn-outline-primary my-4" name="update" value="true">บันทึกข้อมูล</button>
                        <button type="reset" class="btn btn-outline-danger my-4" data-dismiss="modal">ไว้ทีหลัง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>