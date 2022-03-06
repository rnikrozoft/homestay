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
                        <h3 class="mb-0">ข้อมูลการเข้าร่วมกิจกรรม</h3>
                    </div>
                    <div class="accordion" id="order-tour-content">
                        <?php 
                            $num=1;
                            foreach($connectDB->connect()->query("SELECT DISTINCT checkIn FROM `ord_acts` ORDER BY checkIn DESC") as $date){
                                $sql = "SELECT activities.*, mbPx, fname,lname
                                        FROM ord_acts JOIN activities ON ord_acts.actsID = activities.acID JOIN members ON activities.mbID = members.mbID
                                        WHERE checkIN = '$date[checkIn]' GROUP BY ord_acts.actsID";
                        ?>
                            <div class="card-header collapsed get-content" date="<?php echo $date["checkIn"]; ?>" id="<?php echo $num; ?>" data-toggle="collapse" data-target="#collapse<?php echo $num; ?>" aria-expanded="false" aria-controls="collapse<?php echo $num; ?>"> 
                                <h5 class="mb-0">วันที่ <?php echo $date["checkIn"]; ?></h5>
                            </div>
                            <div id="collapse<?php echo $num; ?>" class="collapse" data-parent="#order-tour-content" aria-labelledby="<?php echo $num; ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach($connectDB->connect()->query($sql) as $result){ ?>
                                        <div class="col-4">
                                            <div class="card-body">
                                                <img src="../../assets/img/activities/<?php echo $result["acImg"]; ?>" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 140px;height:140px;">
                                                <div class="pt-4 text-center">
                                                    <h5 class="h3 title">
                                                        <span class="d-block mb-1"><?php echo $result["acName"]; ?></span>
                                                        <small class="h4 font-weight-light text-muted">เจ้าของกิจกรรม <?php echo $result["mbPx"].$result["fname"]." ".$result["lname"]; ?></small>
                                                    </h5>
                                                    <div class="mt-3">
                                                        <a href="#" class="btn btn-twitter btn-icon-only rounded-circle show-data" date="<?php echo $date["checkIn"]; ?>" acID="<?php echo $result["acID"]; ?>" acName="<?php echo $result["acName"]; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php $num++;} ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include("templates/footer.php"); ?>
    </div>
</div>
<?php include("templates/footer-script.php"); ?>
<script>
    // $(".get-content").click(function(){
    //     var id = $(this).attr("id");
    //     $.ajax({
    //         type: "POST",
    //         url: "../../routes/backend/get-order-tour.php",
    //         data: {
    //             date: $(this).attr("date")
    //         },
    //         success: function(data) {
    //             $("#data-content-" + id).html(data);
    //         }
    //     });
    // });
    $(".show-data").click(function(){
        var date = $(this).attr("date");
        var acName = $(this).attr("acName");

        $.ajax({
            type: "POST",
            url: "../../routes/backend/get-order-tour.php",
            data: {
                date: $(this).attr("date"),
                acID :$(this).attr("acID")
            },
            success: function(data) {
                $(".modal-title").html("วันที่ " + date + " <br><small class='text-muted ls-1'>" + acName + "</small>");
                $("#content").html(data);
                $(".show-modal").modal("show");
            }
        });
    });
</script>
<div class="modal fade show-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsie">
                <table class="table align-items-center">
                    <thead>
                        <th>ชื่อลูกค้า</th>
                        <th>วันที่บันทึกข้อมูล</th>
                    </thead>
                    <tbody id="content"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-neutral" style="color:#e45e5e;" data-dismiss="modal">ปิดหน้าต่างนี้</button>
            </div>
        </div>
    </div>
</div>
</body>

</html>