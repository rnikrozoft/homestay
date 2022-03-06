<?php 
    include("templates/header.php"); 

    $sql = "SELECT * FROM homes 
        JOIN members ON homes.mbID = members.mbID
        WHERE homes.hmID = :id";
    $stmt = $connectDB->connect()->prepare($sql);
    $stmt->execute(
        array(
            ":id" => $_GET["id"]
        )
    );

?>
<?php if ($stmt->rowCount() == 1) { $result = $stmt->fetch(PDO::FETCH_ASSOC); ?>
    <div class="header pb-6 d-flex align-items-center"
        style="min-height: 500px; background-image: url(../../assets/img/homes/<?php echo $result["hmImg"]; ?>); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-7"></span>
        <div class="container align-items-center">
            <!-- d-flex บรรทัดข้างบน -->
            <div class="row mb-4">
                <div class="col-lg-8 pt-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="index.php" class="text-white">บ้านพักโฮมสเตย์</a></li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $result["hmID"]; ?>">
                                    <span class="badge badge-pill badge-primary">
                                        <?php echo $result["hmName"]; ?>
                                    </span>
                                </a>
                            </li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <h4 class="text-uppercase text-white ls-1">เจ้าของบ้านพัก : <?php echo $result["mbPx"] . $result["fname"] . " " . $result["lname"]; ?></h4>
                        <h1 class="display-2 text-white"><?php echo $result["hmName"]; ?></h1>
                        <p class="text-white mt-0">
                            <?php echo $result["hmDetail"]; 
                                if($result["hmNote"]!=""){
                                    echo '<footer class="blockquote-footer text-white">
                                            <cite class="text-danger" title="หมายเหตุ">หมายเหตุ</cite>
                                            '.$result["hmNote"].'
                                        </footer>';
                                }
                            ?>
                        </p>
                        <?php if ($result["CAR"] == 1 || $result["WIFI"] == 1 || $result["PRI"] == 1) { ?>
                        <h5 class="text-white ls-1">อุปกรณ์อำนวยความสะดวกพิเศษ</h6>
                        <p class=" mb-0 text-sm">
                            <?php if($result["CAR"] == '1'){ ?>
                                <span class="badge badge-pill badge-warning">
                                    <i class="fas fa-car"></i>
                                    ที่จอดรถ
                                </span>
                            <?php } 
                                if($result["PRI"] == '1'){ ?>
                                <span class="badge badge-pill badge-info">
                                    <i class="fas fa-car"></i>
                                    Private
                                </span>
                            <?php } 
                                if($result["PRI"] == '1'){ ?>
                                <span class="badge badge-pill badge-success">
                                    <i class="fas fa-car"></i>
                                    Wi-fi
                                </span>
                            <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4 pt-5">
                    <div class="card-body">
                        <form id="form-selected-room" action="../../routes/frontend/route-setData.php" method="POST">
                        <input type="hidden" name="rooms" value="true">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select id="select-room-list" name="roomID"
                                            class="form-control form-control-alternative">
                                            <option value="0">เลือกห้องพัก</option>
                                            <?php
                                                foreach ($connectDB->connect()->query("SELECT rmID,rmName,rmPrice,rmGqty FROM rooms WHERE hmID = $result[hmID]") as $result_room_list) {
                                                    echo '<option value="' . $result_room_list["rmID"] . '">' . $result_room_list["rmName"] . ' - ' . $result_room_list["rmPrice"] . ' บาท รองรับ ' . $result_room_list["rmGqty"] . ' ท่าน</option>';
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-white" for="input-username">Check-in</label>
                                        <input class="form-control form-control-alternative bg-white" id="in"
                                                name="in" disabled readonly placeholder="เช็คอิน" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-white" for="input-first-name">Check-out</label>
                                        <input class="form-control form-control-alternative bg-white" id="out"
                                                name="out" disabled readonly placeholder="เช็คเอ้าท์" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                            <?php if(isset($_SESSION["logged"])){ ?>
                                            <button class="btn btn-outline-warning btn-lg btn-block" name="set">จองห้องพัก</button>
                                            <?php }else{
                                                echo '<button type="button" class="btn btn-outline-warning btn-block" data-toggle="modal" data-target="#login">จองห้องพัก</button>';
                                            } ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt--6">
        <div class="row justify-content-center">
        <?php
            $sql = "SELECT rooms.*,(SELECT COUNT(*) FROM likes_rooms WHERE likes_rooms.rmID = rooms.rmID) as 'countLike' FROM rooms WHERE hmID = $result[hmID]";
            foreach ($connectDB->connect()->query($sql) as $result_room) {
        ?>
            <div class="col-xl-10 col-md-6">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img class="card-img" src="../../assets/img/rooms/<?php echo $result_room["rmImg"]; ?>" style="object-fit:cover;height:345px;border-radius: 0;">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="display-4 mt-0"><?php echo $result_room["rmName"]; ?>
                        <?php if(isset($_SESSION["logged"])){?>
                        <button class="btn btn-outline-warning btn-sm like" name="rooms"
                            id="<?php echo $result_room["rmID"]; ?>"><?php echo $result_room["countLike"]; ?>
                            <i class='fas fa-thumbs-up'></i></button>
                        <?php }else{ ?>
                        <button class="btn btn-outline-warning btn-sm" data-toggle="modal"
                            data-target="#login"><?php echo $result_room["countLike"]; ?> <i
                                class='fas fa-thumbs-up'></i></button>
                        <?php } ?>
                        </h5>
                        
                        <p class="card-text">
                            <?php echo $result_room["rmDetail"]; 
                            if ($result_room["rmNote"] != null) { ?>
                            <footer class="blockquote-footer"><cite class="text-danger"
                                    title="หมายเหตุ">หมายเหตุ</cite> <?php echo $result_room["rmNote"]; ?></footer>
                            <?php } ?>
                        </p>
                        <div class="row">
                            <div class="col">
                                <label class="form-control-label">ราคา / คืน</label>
                                <h2 class="display-6 mt-0"><?php echo number_format($result_room["rmPrice"]); ?> บาท</h2>
                            </div>
                            <div class="col">
                                <label class="form-control-label">จำนวนที่รองรับ</label>
                                <h2 class="display-4 mt-0"><?php echo $result_room["rmGqty"]; ?> คน</h2>
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
            <div class="col-xl-12">
                <div class="card-header bg-secondary">
                    <h3 class="mb-0">รูปภาพบรรยากาศรอบบ้าน</h3>
                </div>
                <div class="card-body">
                    <div class="card-columns">
                        <?php foreach ($connectDB->connect()->query("SELECT imgName FROM imgs_hms WHERE hmID = $result[hmID]") as $result_img) { ?>
                        <div class="card" style="box-shadow: 0 0 2rem 0 rgba(0, 0, 0, 0);">
                            <img class="card-img"
                                src="../../assets/img/homes/details/<?php echo $result_img["imgName"]; ?>">
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


