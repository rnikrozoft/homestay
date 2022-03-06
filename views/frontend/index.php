<?php 
    include 'templates/header.php';
    $sql_banner = "SELECT `imgName`, `header`, `subHeader` FROM `img_slide_homes`";
    $num1 = 0;
    $num2 = 0;
?>

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($connectDB->connect()->query($sql_banner) as $result_banner){ ?>
        <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $num1; ?>"
            class="<?php echo ($num1==0)?"active":""; ?>"></li>
        <?php $num1++; } ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach($connectDB->connect()->query($sql_banner) as $result_banner){ ?>
        <div class="carousel-item <?php echo ($num2==0)?"active":""; ?>">
            <img src="../../assets/img/imgSlide/homes/<?php echo $result_banner["imgName"]; ?>" class="d-block w-100"
                alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5 class="display-1 text-white"><?php echo $result_banner["header"]; ?></h5>
                <p><?php echo $result_banner["subHeader"]; ?></p>
            </div>
        </div>
        <?php $num2++; } ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container mb-7">
    <div class="row align-items-center py-4">
        <div class="col-lg-auto">
            <h6 class="h2 d-inline-block mb-0">บ้านพักของเรา</h6>
            <p class="mb-0">ต้องการที่พักสัมผัสธรรมชาติใช่ไหม ? ลองหาที่พักจากรายการเหล่านี้ดูสิ</p>
        </div>
    </div>
    <div class="row">
        <?php 
            $perpage = 6;
            isset($_GET['page'])?$page = $_GET['page']:$page = 1;
            $start = ($page - 1) * $perpage;
            $sql = "SELECT homes.*, members.*, (SELECT COUNT(*) FROM rooms WHERE hmID = homes.hmID) as 'roomQTY' FROM `homes` 
                    JOIN members ON homes.mbID = members.mbID LIMIT $start,$perpage";
            foreach($connectDB->connect()->query($sql) as $result){ 
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="card card-profile" style="margin-bottom:35%;">
                <img src="../../assets/img/homes/<?php echo $result["hmImg"]; ?>" height="260px" class="card-img-top"
                    style="object-fit: cover;">
                <div class="row justify-content-center">
                    <div class="col-lg-11 order-lg-2">
                        <div class="card-profile-image">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-warning mb-0">จำนวนห้อง
                                                : <?php echo $result["roomQTY"] ?> ห้อง</h5>
                                            <a href="home-details.php?id=<?php echo $result["hmID"]; ?>"><span
                                                    class="h2 font-weight-bold mb-0"><?php echo $result["hmName"]; ?></span></a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="home-details.php?id=<?php echo $result["hmID"]; ?>" class="avatar rounded-circle" data-toggle="tooltip"
                                                data-placement="top"
                                                title="เจ้าของ : <?php echo $result["mbPx"].$result["fname"]." ".$result["lname"]; ?>">
                                                <img src="../../assets/img/members/<?php echo $result["img"]; ?>"
                                                    style="margin-top:50%;">
                                            </a>
                                        </div>
                                    </div>
                                    <h6 class="ls-1 card-title text-uppercase text-muted mt-3 mb--2">
                                        อุปกรณ์อำนวยความสะดวกพิเศษ</h6>
                                    <p class="mt-3 mb-0 text-sm">
                                        <?php if($result["PRI"] == '1'){ ?>
                                        <span class="badge badge-pill badge-info">
                                            <i class="fas fa-car"></i>
                                            Private
                                        </span>
                                        <?php } ?>
                                        <?php if($result["CAR"] == '1'){ ?>
                                        <span class="badge badge-pill badge-warning">
                                            <i class="fas fa-car"></i>
                                            ที่จอดรถ
                                        </span>
                                        <?php } ?>
                                        <?php if($result["WIFI"] == '1'){ ?>
                                        <span class="badge badge-pill badge-success">
                                            <i class="fas fa-car"></i>
                                            Wi-fi
                                        </span>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-auto">
        <?php
            $sql = "SELECT * FROM homes";
            $stmt = $connectDB->connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->rowCount();
            $total_page = ceil($result / $perpage);
        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=1" aria-label="Previous">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                        <?php for($i=1;$i<=$total_page;$i++){ ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $total_page;?>" aria-label="Next">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>
<?php include 'templates/footer-script.php' ?>
</body>

</html>