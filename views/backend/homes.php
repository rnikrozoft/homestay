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
                                <h3 class="mb-0">ข้อมูลบ้านพัก</h3>
                            </div>
                            <div class="col-auto text-right">
                                <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#add-homes"><i class="fas fa-plus"></i></button>
                                <button class="btn btn-sm btn-neutral drop" name="homes" data-toggle="tooltip" data-placement="top" title="" data-original-title="ลบข้อมูลทั้งหมด"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th>เลขรหัสประจำบ้าน</th>
                                    <th>ชื่อบ้าน</th>
                                    <th>เจ้าของบ้าน</th>
                                    <th data-toggle="tooltip" data-placement="top" title="ที่จอดรถ"><i class="fas fa-car"></i></th>
                                    <th data-toggle="tooltip" data-placement="top" title="ไวฟาย"><i class="fas fa-wifi"></i></th>
                                    <th data-toggle="tooltip" data-placement="top" title="Private Featrue"><i class="fas fa-user-shield"></i></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($connectDB->connect()->query("SELECT * FROM `homes` JOIN members ON  homes.mbID = members.mbID") as $result) { ?>
                                <tr>

                                    <td><?php echo $result["hmID"]; ?></td>
                                    <td class="table-user">
                                        <img src="../../assets/img/homes/<?php echo $result["hmImg"]; ?>" class="avatar rounded-circle mr-3">
                                        <?php echo $result["hmName"]; ?>
                                    </td>
                                    <td><?php echo $result["mbPx"] . "" . $result["fname"] . " " . $result["lname"]; ?></td>
                                    <td><?php echo ($result["CAR"] == '1') ? '<i class="fas fa-check-circle text-success" value="1">' : '<i class="fas fa-minus-circle text-danger" value="0">'; ?></td>
                                    <td><?php echo ($result["WIFI"] == '1') ? '<i class="fas fa-check-circle text-success" value="1">' : '<i class="fas fa-minus-circle text-danger" value="0">'; ?></td>
                                    <td><?php echo ($result["PRI"] == '1') ? '<i class="fas fa-check-circle text-success" value="1">' : '<i class="fas fa-minus-circle text-danger" value="0">'; ?></td>
                                    <td>
                                        <a href="homes-details.php?id=<?php echo $result["hmID"]; ?>" class="btn btn-sm btn-outline-primary btn-icon-only" data-toggle="tooltip" data-original-title="ดูข้อมูลเพิ่มเติม">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger btn-icon-only del" name="homes" value="<?php echo $result["hmID"]; ?>"  data-toggle="tooltip" data-original-title="ลบข้อมูลนี้">
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
<?php
include("templates/footer-script.php");
include("modals/homesModals.php");
?>
</body>

</html>