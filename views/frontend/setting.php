<?php
    include 'templates/header.php';
    if(!isset($_SESSION["logged"])){
        session_destroy();
        echo "<script>window.location.href='index.php'</script>";
    }
    $result = $connectDB->connect()->query("SELECT * FROM customers WHERE cmID = $cmID")->fetch(PDO::FETCH_ASSOC);
?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-links">
                        <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                        <li class="breadcrumb-item active" aria-current="page">แผนทัวร์ของคุณ</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-xl-5">
                <div class="card">
                    <form id="edit-information">
                        
                        <div class="card-header bg-transparent">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-0">ข้อมูลของคุณ</h3>
                                </div>
                                <div class="col-auto text-right">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">บันทึกข้อมูล</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#change-password">เปลี่ยนรหัสผ่าน</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-control-label">เลขประจำตัวประชาชน</label>
                                    <div class="form-group">
                                        <input class="form-control" readonly type="text" id="id" value="<?php echo $result["cmID"]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-control-label">ชื่อ</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="text" id="fname" value="<?php echo $result["fname"]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">นามสกุล</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="text" id="lname" value="<?php echo $result["lname"]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Input groups with icon -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-control-label">เบอร์โทร</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" pattern="[0-9]{10}" type="text" id="tel" value="<?php echo $result["tel"]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">อีเมลล์</label>
                                    <div class="form-group">
                                        <input class="form-control" type="email" id="email" value="<?php echo $result["email"]; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-7">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">ข้อมูลที่อยู่</h3>
                            </div>
                            <div class="col-auto text-right">
                                <button type="submit" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#add-address">เพิ่มข้อมูล</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>ข้อมูล</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($connectDB->connect()->query("SELECT * FROM address WHERE cmID = $cmID") as $result) {
                                    $dataAddress = [
                                        "ID" => $result["addID"],
                                        "HouseNo" => $result["houseNo"],
                                        "Moo" => $result["moo"],
                                        "Road" => $result["road"],
                                        "Alley" => $result["alley"],
                                        "VillageName" => $result["villageName"],
                                        "SubDistrict" => $result["subdistrict"],
                                        "District" => $result["district"],
                                        "Province" => $result["province"],
                                        "Zipcode" => $result["zipcode"],
                                    ];
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $result["houseNo"]; ?> หมู่ที่ <?php echo $result["moo"]; ?>
                                        <?php
                                        if ($result["road"] != null) {
                                            echo "ถ." . $result["road"];
                                        }

                                        if ($result["alley"] != null) {
                                            echo " ซ." . $result["alley"];
                                        }
                                        if ($result["villageName"] != null) {
                                            echo " " . $result["villageName"];
                                        }
                                        ?>
                                        ต.<?php echo $result["subdistrict"]; ?> อ.<?php echo $result["district"]; ?>
                                        จ.<?php echo $result["province"]; ?>
                                        <?php echo $result["zipcode"]; ?>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item edit-address" href="javascript:void(0)" data='<?php echo json_encode($dataAddress, JSON_UNESCAPED_UNICODE); ?>'><i class="fas fa-cog"></i> แก้ไขข้อมูล</a>
                                                <button class="dropdown-item del-address" href="javascript:void(0)" value="<?php echo $result["addID"]; ?>">
                                                    <i class="fas fa-trash"></i> ลบข้อมูล
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'templates/footer.php'; ?>
    <?php include 'templates/footer-script.php' ?>
    </body>

    </html>