<?php 
    include 'templates/header.php';
    $sql_banner = "SELECT `imgName`, `header`, `subHeader` FROM `img_slide_atts`";
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
            <img src="../../assets/img/imgSlide/attractions/<?php echo $result_banner["imgName"]; ?>"
                class="d-block w-100" alt="...">
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
            <h6 class="h2 d-inline-block mb-0">สถานที่สำคัญของหมู่บ้าน</h6>
            <p class="mb-0">เราเชื่อว่าสถานที่เหล่านี้ของหมู่บ้านเรา จะทำให้คุณตื่นตาตื่นใจ</p>
        </div>
    </div>
    <div class="row">
        <?php 
            $perpage = 6;
            isset($_GET['page'])?$page = $_GET['page']:$page = 1;
            $start = ($page - 1) * $perpage;
            $sql = "SELECT attractions.*, (SELECT COUNT(*) FROM likes_atts WHERE atID = attractions.atID) as 'countLike' FROM `attractions` LIMIT $start,$perpage";
            foreach($connectDB->connect()->query($sql) as $result){ 
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="card card-profile" style="margin-bottom:35%;">
                <img src="../../assets/img/attractions/<?php echo $result["atImg"]; ?>" height="260px" class="card-img"
                    style="object-fit: cover;">
                <div class="row justify-content-center">
                    <div class="col-lg-11 order-lg-2">
                        <div class="card-profile-image">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase mb-0">
                                                <span class="text-warning">คะแนน <?php echo $result["countLike"] ?>
                                                </span>
                                                <span class="text-muted">|</span>
                                                <span class="text-success">
                                                    <?php echo ($result["atPrice"]==0 || $result["atPrice"]=="")? "เข้าชมฟรี":"฿ ".$result["atPrice"]." บาท"; ?></span>
                                            </h5>
                                            <a href="attraction-details.php?id=<?php echo $result["atID"]; ?>">
                                                <span class="h2 font-weight-bold mb-0">
                                                    <?php echo $result["atName"]; ?>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="attraction-details.php?id=<?php echo $result["atID"]; ?>"
                                                class="btn btn-outline-primary icon icon-shape rounded-circle shadow"
                                                data-query="attractions" value="<?php echo $result["atID"]; ?>">
                                                <i class="fa fa-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <h6 class="ls-1 card-title text-uppercase text-muted mt-3 mb--2">
                                        วันที่เปิดให้บริการ</h6>
                                    <p class="mt-3 mb-0 text-sm">
                                    <?php 
                                        $dateExplode = explode(" ",$result["atDateOpen"]);
                                        for($i=0;$i<count($dateExplode);$i++){
                                            if($dateExplode[$i]=="จันทร์"){
                                                echo '<span class="badge badge-pill badge-yellow mr-1 mb-1">
                                                        <i class="fas fa-calendar-day"></i>
                                                        จันทร์
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="อังคาร"){
                                                echo '<span class="badge badge-pill badge-pink mr-1 mb-1"><i class="fas fa-calendar-day"></i>
                                                        อังคาร
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="พุธ"){
                                                echo '<span class="badge badge-pill badge-success mr-1 mb-1"><i class="fas fa-calendar-day"></i>
                                                        พุธ
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="พฤหัสฯ"){
                                                echo '<span class="badge badge-pill badge-warning mr-1 mb-1"><i class="fas fa-calendar-day"></i>
                                                        พฤหัสบดี
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="ศุกร์"){
                                                echo '<span class="badge badge-pill badge-info mr-1 mb-1"><i class="fas fa-calendar-day"></i>
                                                        ศุกร์
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="เสาร์"){
                                                echo '<span class="badge badge-pill badge-purple mr-1 mb-1"><i class="fas fa-calendar-day"></i>
                                                        เสาร์
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="อาทิตย์"){
                                                echo '<span class="badge badge-pill badge-danger mr-1 mb-1"><i class="fas fa-calendar-day"></i>
                                                        อาทิตย์
                                                        </span>';
                                            }
                                        }
                                    ?>
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
            $sql = "SELECT * FROM attractions";
            $stmt = $connectDB->connect()->query($sql);
            $result = $stmt->rowCount();
            $total_page = ceil($result / $perpage);
        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?page=1" aria-label="Previous">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for($i=1;$i<=$total_page;$i++){ ?>
                    <li class="page-item"><a class="page-link"
                            href="<?php echo $_SERVER["PHP_SELF"]; ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $_SERVER["PHP_SELF"]; ?>?page=<?php echo $total_page;?>"
                            aria-label="Next">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php 
    include("templates/footer.php"); 
    include('templates/footer-script.php');
?>