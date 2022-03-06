<?php 
    include("templates/header.php"); 
    if(!isset($_SESSION["logged"])){
        echo "<script>window.location.href='index.php';</script>";
    }
?>
<div class="main-content" id="panel">
    <?php include("templates/top-nav.php"); ?>
    <div class="header bg-primary pb-7"></div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">ข้อมูลลูกค้าหรือผู้ใช้</h3>
                            </div>
                            <div class="col-auto text-right">
                                <button class="btn btn-sm btn-neutral drop" name="customer" data-toggle="tooltip" data-placement="top" title="" data-original-title="ลบข้อมูลทั้งหมด"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th>รหัสลูกค้า</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>เบอร์โทร</th>
                                    <th>อีเมลล์</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($connectDB->connect()->query("SELECT * FROM `customers` WHERE cmID != 0") as $result) { ?>
                                <tr>
                                    <td><?php echo $result["cmID"]; ?></td>
                                    <td><?php echo $result["fname"]; ?></td>
                                    <td><?php echo $result["lname"]; ?></td>
                                    <td><?php echo $result["tel"]; ?></td>
                                    <td><?php echo $result["email"]; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger btn-icon-only del" name="customer" value="<?php echo $result["cmID"]; ?>" data-toggle="tooltip" data-original-title="ลบข้อมูลนี้">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include("templates/footer.php"); ?>
    </div>
</div>
<?php include("templates/footer-script.php"); ?>
</body>

</html>