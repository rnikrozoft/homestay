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
                                <h3 class="mb-0">
                                    รูปแบนเนอร์เมนู
                                    <?php
                                    switch ($_GET["name"]) {
                                        case "homes":
                                            echo "บ้านพักโฮมสเตย์";
                                            $sql = "SELECT * FROM `img_slide_homes`";
                                            $path = "homes";
                                            break;
                                        case "activities":
                                            echo "กิจกรรมในหมู่บ้าน";
                                            $sql = "SELECT * FROM `img_slide_acts`";
                                            $path = "activities";
                                            break;
                                        case "attractions":
                                            echo "สถานที่ภายในหมู่บ้าน";
                                            $sql = "SELECT * FROM `img_slide_atts`";
                                            $path = "attractions";
                                            break;
                                        case "products":
                                            echo "สินค้าโอท็อปของหมู่บ้าน";
                                            $sql = "SELECT * FROM `img_slide_prod`";
                                            $path = "products";
                                            break;
                                    } ?>
                                </h3>
                            </div>
                            <div class="col-auto text-right">
                                <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#image-slide"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $round = 0;
                        foreach ($connectDB->connect()->query($sql) as $result) { ?>
                            <div class="row <?php echo ($round == 0) ? "" : "mt-4"; ?>">
                                <div class="col">
                                    <div class="card bg-dark text-white border-0">
                                        <img class="card-img" src="../../assets/img/imgSlide/<?php echo $path ?>/<?php echo $result["imgName"]; ?>" alt="Card image">
                                        <div class="card-img-overlay d-flex align-items-center">
                                            <div>
                                                <h5 class="h2 card-title text-white mb-2"><?php echo $result["header"]; ?></h5>
                                                <p class="card-text"><?php echo $result["subHeader"]; ?></p>
                                                <p class="card-text text-sm font-weight-bold">
                                                    <a onclick="return confirm('ยืนยันการลบรูปนี้');" href="../../routes/backend/route-img-slide.php?delete=true&name=<?php echo $path; ?>&imgID=<?php echo $result["ID"]; ?>" class="btn btn-danger btn-sm btn-icon-only rounded-circle">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $round++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include("templates/footer.php"); ?>
    </div>
</div>
<?php
include("templates/footer-script.php");
include("modals/image-slideModal.php");
?>
</body>

</html>