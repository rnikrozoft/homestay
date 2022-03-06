

<?php 
    include 'templates/header.php';
    $sql = "SELECT attractions.*,(SELECT count(*) FROM likes_atts WHERE likes_atts.atID = attractions.atID) as 'countLike' FROM attractions WHERE atID = :id";
    $stmt = $connectDB->connect()->prepare($sql);
    $stmt->execute(
        array(
            ":id" => $_GET["id"]
        )
    );

?>
<?php if ($stmt->rowCount() == 1) { $result = $stmt->fetch(PDO::FETCH_ASSOC); ?>
    <div class="header pb-6 d-flex align-items-center"
        style="min-height: 500px; background-image: url(../../assets/img/attractions/<?php echo $result["atImg"]; ?>); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-7"></span>
        <div class="container align-items-center">
            <!-- d-flex บรรทัดข้างบน -->
            <div class="row">
                <div class="col-lg-8 pt-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="attractions.php" class="text-white">สถานที่สำคัญของหมู่บ้าน</a></li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $result["atID"]; ?>">
                                    <span class="badge badge-pill badge-primary">
                                        <?php echo $result["atName"]; ?>
                                    </span>
                                </a>
                            </li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h1 class="display-2 text-white"><?php echo $result["atName"]; ?></h1>
                        <p class="text-white mt-0">
                            <?php echo $result["atDetail"]; 
                                if($result["atNote"]!=""){
                                    echo '<footer class="blockquote-footer text-white">
                                            <cite class="text-danger" title="หมายเหตุ">หมายเหตุ</cite>
                                            '.$result["atNote"].'
                                        </footer>';
                                }
                            ?>
                        </p>
                        
                        <div class="row">
                            <div class="col-auto">
                                <h5 class="text-white ls-1">ราคาค่าธรรมเนียมการเข้าร่วม</h5>
                                <h1 class="display-2 text-warning"><?php echo ($result["atPrice"]==0 || $result["atPrice"]=="")? "เข้าชมฟรี":"฿ ".$result["atPrice"]." บาท"; ?></h1>
                            </div>
                            <div class="col-auto">
                                <h5 class="text-white ls-1">วันที่เปิดให้บริการ</h6>
                                <p class="text-sm">
                                    <?php 
                                        $dateExplode = explode(" ",$result["atDateOpen"]);
                                        for($i=0;$i<count($dateExplode);$i++){
                                            if($dateExplode[$i]=="จันทร์"){
                                                echo '<span class="badge badge-pill badge-yellow mr-1">
                                                        <i class="fas fa-calendar-day"></i>
                                                        จันทร์
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="อังคาร"){
                                                echo '<span class="badge badge-pill badge-pink mr-1"><i class="fas fa-calendar-day"></i>
                                                        อังคาร
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="พุธ"){
                                                echo '<span class="badge badge-pill badge-success mr-1"><i class="fas fa-calendar-day"></i>
                                                        พุธ
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="พฤหัสฯ"){
                                                echo '<span class="badge badge-pill badge-warning mr-1"><i class="fas fa-calendar-day"></i>
                                                        พฤหัสบดี
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="ศุกร์"){
                                                echo '<span class="badge badge-pill badge-info mr-1"><i class="fas fa-calendar-day"></i>
                                                        ศุกร์
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="เสาร์"){
                                                echo '<span class="badge badge-pill badge-purple mr-1"><i class="fas fa-calendar-day"></i>
                                                        เสาร์
                                                        </span>';
                                            }

                                            if($dateExplode[$i]=="อาทิตย์"){
                                                echo '<span class="badge badge-pill badge-danger mr-1"><i class="fas fa-calendar-day"></i>
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
                <div class="col-lg-4 pt-5">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <img class="card-img-top" src="../../assets/img/attractions/<?php echo $result["atImg"]; ?>" height="260" style="object-fit:cover;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <?php if(isset($_SESSION["logged"])){ ?>
                                    <button class="btn btn-outline-warning btn-lg btn-block like" name="atts" id="<?php echo $result["atID"]; ?>">ให้คะแนนแนะนำสถานที่นี้ | <?php  echo $result["countLike"];?></button>'
                                <?php } else { 
                                    echo '<button class="btn btn-outline-warning btn-lg btn-block" data-toggle="modal" data-target="#login">ให้คะแนนแนะนำสถานที่นี้ | '.$result["countLike"].'</button>';
                                } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card-header bg-secondary">
                    <h3 class="mb-0">รูปภาพบรรยากาศกิจกรรม</h3>
                </div>
                <div class="card-body">
                    <div class="card-columns">
                        <?php foreach ($connectDB->connect()->query("SELECT imgName FROM imgs_atts WHERE atID = $result[atID]") as $result_img) { ?>
                        <div class="card" style="box-shadow: 0 0 2rem 0 rgba(0, 0, 0, 0);">
                            <img class="card-img"
                                src="../../assets/img/attractions/details/<?php echo $result_img["imgName"]; ?>">
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    include("templates/footer.php"); 
    }else{ ?>
        <div class="flex-center position-ref full-height">
            <div class="code">404</div>
            <div class="message">
                Not Found
                <p class="small"><a href="index.php">กลับสู่หน้าแรก</a></p>
            </div>
        </div>
<?php    
    } include('templates/footer-script.php');
?>
