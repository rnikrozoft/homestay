<?php 
    include("templates/header.php"); 

    $sql = "SELECT activities.*,(SELECT COUNT(*) FROM likes_acts WHERE likes_acts.acID = activities.acID) as 'countLike',members.* FROM activities 
        JOIN members ON activities.mbID = members.mbID
        WHERE activities.acID = :id";
    $stmt = $connectDB->connect()->prepare($sql);
    $stmt->execute(
        array(
            ":id" => $_GET["id"]
        )
    );

?>
<?php if ($stmt->rowCount() == 1) { $result = $stmt->fetch(PDO::FETCH_ASSOC); ?>
<div class="header pb-6 d-flex align-items-center"
    style="min-height: 500px; background-image: url(../../assets/img/activities/<?php echo $result["acImg"]; ?>); background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container align-items-center">
        <!-- d-flex บรรทัดข้างบน -->
        <div class="row">
            <div class="col-lg-7 pt-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-links">
                        <li class="breadcrumb-item"><a href="activities.php"
                                class="text-white">กิจกรรมในชุมชนที่คุณอาจสนใจ</a></li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $result["acID"]; ?>">
                                <span class="badge badge-pill badge-primary">
                                    <?php echo $result["acName"]; ?>
                                </span>
                            </a>
                        </li>
                    </ol>
                </nav>
                <div class="card-body">
                    <div class="fotorama" data-nav="thumbs" data-width="100%" data-height="400">
                        <img src="../../assets/img/activities/<?php echo $result["acImg"]; ?>">
                        <?php foreach ($connectDB->connect()->query("SELECT imgName FROM imgs_acts WHERE acID = $result[acID]") as $result_img){ ?>
                        <img src="../../assets/img/activities/details/<?php echo $result_img["imgName"]; ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pt-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9 col-xs-12">
                                <h4 class="text-uppercase ls-1">เจ้าของกิจกรรม :
                                    <p><?php echo $result["mbPx"] . $result["fname"] . " " . $result["lname"]; ?>
                                    </p>
                                </h4>
                            </div>
                            <div class="col-lg-3 col-xs-12 text-center">
                            <a href="#" class="avatar rounded-circle" data-toggle="tooltip" data-placement="top"
                                title="เจ้าของ : <?php echo $result["mbPx"].$result["fname"]." ".$result["lname"]; ?>">
                                <img src="../../assets/img/members/<?php echo $result["img"]; ?>">
                            </a>
                            </div>
                            <div class="col-auto">
                                <h5 class="ls-1">วันที่เปิดให้บริการ</h6>
                                    <p class="mb-0 text-sm">
                                        <?php 
                                                $dateExplode = explode(" ",$result["acDateOpen"]);
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
                            <div class="col-auto">
                                <h5 class="ls-1">ช่วงเวลากิจกรรม</h5>
                                <!-- <span class="text-uppercase ls-1 h6">อาจคาดเคลือนได้ตามความเหมาะสมและตามสภาพอากาศ</span> -->
                                <p class="mb-0 text-sm">
                                    <?php 
                                                if($result["acTime"]==1){
                                                    echo '<span class="badge badge-pill badge-info mr-1">
                                                            <i class="far fa-clock"></i> ช่วงเช้า
                                                        </span>';
                                                }

                                                if($result["acTime"]==2){
                                                    echo '<span class="badge badge-pill badge-warning mr-1">
                                                            <i class="far fa-clock"></i> ช่วงบ่าย
                                                        </span>';
                                                }

                                                if($result["acTime"]==3){
                                                    echo '<span class="badge badge-pill badge-success mr-1">
                                                            <i class="far fa-clock"></i> ช่วงเย็น
                                                        </span>';
                                                }
                                            
                                        ?>
                                </p>
                            </div>
                        </div>
                        <form id="form-selected-acts">
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h5 class="display-5">กรุณาเลือกวันที่เช็คอิน</h5>
                                    <input type="hidden" id="id-check-acName" value="<?php echo $result["acID"]; ?>">
                                    <input type="hidden" id="id-check-acTime" value="<?php echo $result["acTime"]; ?>">
                                    <input type="hidden" id="date-enabled" value='<?php echo $result["acDateOpen"]; ?>'>
                                    <input type="hidden" id="acID" value="<?php echo $result["acID"]; ?>">
                                    <input class="form-control form-control-alternative bg-white datepicker" id="in-acts" name="in-acts" readonly placeholder="วันที่จะเข้าร่วมกิจกรรม" type="text">
                                    <!-- <input type="text" id="input-username" class="form-control"
                                        placeholder="เลือกวันที่เช็คอิน"> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <?php if(isset($_SESSION["logged"])){ ?>
                                        <button type="submit" class="btn btn-outline-success btn-lg btn-block" name="set">เพิ่มลงแผนทัวร์
                                            <p class="display-5" 
                                                style="font-family: inherit;
                                                        font-size: 1.625rem;
                                                        font-weight: 600;
                                                        line-height: 1.5;
                                                        margin-bottom: .5rem;">
                                                <?php echo "฿ ".$result["acPrice"]." บาท"; ?>
                                            </p>
                                        </button>
                                    <?php }else { ?>
                                        <button type="button" class="btn btn-outline-success btn-lg btn-block" data-toggle="modal" data-target="#login">เพิ่มลงแผนทัวร์
                                            <p class="display-5" 
                                                style="font-family: inherit;
                                                        font-size: 1.625rem;
                                                        font-weight: 600;
                                                        line-height: 1.5;
                                                        margin-bottom: .5rem;">
                                                <?php echo "฿ ".$result["acPrice"]." บาท"; ?>
                                            </p>
                                        </button>
                                   <?php } ?>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <?php if(isset($_SESSION["logged"])){ ?>
                                    <button class="btn btn-outline-warning btn-lg btn-block like" name="acts" id="<?php echo $result["acID"]; ?>">ให้คะแนนแนะนำกิจกรรมนี้ | <?php echo $result["countLike"]; ?></button>
                                <?php } else { ?>
                                    <button class="btn btn-outline-warning btn-lg btn-block" data-toggle="modal" data-target="#login">ให้คะแนนแนะนำกิจกรรมนี้ | <?php echo $result["countLike"]; ?></button>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt--6">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card">
                <div class="card-header"><h1 class="display-2"><?php echo $result["acName"]; ?></h1></div>
                <div class="card-body">
                    <p class="mt-3">
                        <?php echo $result["acDetail"]; 
                                if($result["acNote"]!=""){
                                    echo '<footer class="blockquote-footer">
                                            <cite class="text-danger" title="หมายเหตุ">หมายเหตุ</cite>
                                            '.$result["acNote"].'
                                        </footer>';
                                }
                            ?>
                    </p>
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