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
                        ?>
                            <div class="card-header collapsed get-content" date="<?php echo $date["checkIn"]; ?>" id="<?php echo $num; ?>" data-toggle="collapse" data-target="#collapse<?php echo $num; ?>" aria-expanded="false" aria-controls="collapse<?php echo $num; ?>"> 
                                <h5 class="mb-0">วันที่ <?php echo $date["checkIn"]; ?></h5>
                            </div>
                            <div id="collapse<?php echo $num; ?>" class="collapse" data-parent="#order-tour-content" aria-labelledby="<?php echo $num; ?>">
                                <div class="table-responsive" id="data-content-<?php echo $num; ?>"></div>
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
    $(".get-content").click(function(){
        var id = $(this).attr("id");
        $.ajax({
            type: "POST",
            url: "../../routes/backend/get-order-tour.php",
            data: {
                date: $(this).attr("date")
            },
            success: function(data) {
                $("#data-content-" + id).html(data);
            }
        });
    });
</script>
</body>

</html>