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
                                <h3 class="mb-0">ข้อมูลสถานที่</h3>
                            </div>
                            <div class="col-auto text-right">
                                <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#add-attractions"><i class="fas fa-plus"></i></button>
                                <button class="btn btn-sm btn-neutral drop" name="atts" data-toggle="tooltip" data-placement="top" title="" data-original-title="ลบข้อมูลทั้งหมด"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <!-- Projects table -->
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th>ชื่อกิจกรรม</th>
                                    <th>วันที่เปิดให้บริการ</th>
                                    <th>ค่าธรรมเนียมเข้าชม</th>
                                    <th>คะแนนแนะนำ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT attractions.*,(SELECT COUNT(atID) FROM `likes_atts` WHERE atID = attractions.atID ) as 'count' FROM `attractions`";
                                foreach ($connectDB->connect()->query($sql) as $result) { ?>
                                <tr>
                                    <td class="table-user">
                                        <img src="../../assets/img/attractions/<?php echo $result["atImg"]; ?>" class="avatar rounded-circle mr-3">
                                        <b><?php echo $result["atName"]; ?></b>
                                    </td>
                                    <td><?php echo $result["atDateOpen"]; ?></td>
                                    <td> <?php echo ($result["atPrice"] == null || $result["atPrice"] == 0) ? "เข้าชมฟรี" : "ราคา " . $result["atPrice"] . " บาท"; ?></td>
                                    <td>
                                        <?php echo $result["count"] . " คะแนน"; ?>
                                    </td>
                                    <td>
                                        <a href="attractions-details.php?id=<?php echo $result["atID"]; ?>" class="btn btn-sm btn-outline-primary btn-icon-only" data-toggle="tooltip" data-original-title="ดูข้อมูลเพิ่มเติม">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger btn-icon-only del" name="atts" value="<?php echo $result["atID"]; ?>" data-toggle="tooltip" data-original-title="ลบข้อมูลนี้">
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
include("modals/attractionsModals.php");
?>
</body>

</html>