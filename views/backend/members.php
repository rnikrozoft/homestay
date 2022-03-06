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
                                <h3 class="mb-0">ข้อมูลสมาชิกในหมู่บ้าน</h3>
                            </div>
                            <div class="col-auto text-right">
                                <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#add-members"><i class="fas fa-user-plus"></i></button>
                                <button class="btn btn-sm btn-neutral drop" name="member" data-toggle="tooltip" data-placement="top" title="" data-original-title="ลบข้อมูลทั้งหมด"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <!-- Projects table -->
                        <table class="table align-items-center table-hover" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th>เลขประจำตัวประชาชน</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>เบอร์โทร</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($connectDB->connect()->query("SELECT * FROM `members`") as $result) {
                                    $data = [
                                        "ID" => $result["mbID"],
                                        "PREFIX" => $result["mbPx"],
                                        "FNAME" => $result["fname"],
                                        "LNAME" => $result["lname"],
                                        "TEL" => $result["tel"],
                                        "IMG" => $result["img"]
                                    ];
                                    ?>
                                <tr>
                                    <td><?php echo $result["mbID"]; ?></td>
                                    <td class="table-user">
                                        <img src="../../assets/img/members/<?php echo $result["img"]; ?>" class="avatar rounded-circle mr-3">
                                        <?php echo $result["mbPx"] . $result["fname"]; ?>
                                    </td>
                                    <td><?php echo $result["lname"]; ?></td>
                                    <td><?php echo $result["tel"]; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-warning btn-icon-only edit" name="member" data-toggle="tooltip" data-original-title="แก้ไขข้อมูลนี้" data='<?php echo json_encode($data, JSON_UNESCAPED_UNICODE); ?>'>
                                            <i class="fas fa-user-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger btn-icon-only del" name="member" value="<?php echo $result["mbID"]; ?>" data-toggle="tooltip" data-original-title="ลบข้อมูลนี้">
                                            <i class="fas fa-user-minus"></i>
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
<?php
include("templates/footer-script.php");
include("modals/membersModals.php");
?>

</body>

</html>