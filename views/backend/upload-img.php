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
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <?php if ($_GET["name"] == "homes" || $_GET["name"] == "activities" || $_GET["name"] == "attractions" || $_GET["name"] == "products") { ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">เพิ่มรูปภาพเพิ่มเติม</h3>
                            </div>
                            <div class="col-auto text-right">
                                <a href="<?php echo $_GET["name"]; ?>-details.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-sm btn-neutral">บันทึกข้อมูลและกลับสู่หน้าหลัก</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dropzone dropzone-multiple" data-toggle="dropzone" data-dropzone-multiple data-dropzone-url="../../controllers/backend/upload-img-script.php?name=<?php echo $_GET["name"]; ?>&id=<?php echo $_GET["id"]; ?>">
                            <div class="fallback">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileUploadMultiple" multiple>
                                    <label class="custom-file-label" for="customFileUploadMultiple">Choose
                                        file</label>
                                </div>
                            </div>
                            <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar">
                                                <img class="avatar-img rounded" src="...html" alt="..." data-dz-thumbnail>
                                            </div>
                                        </div>
                                        <div class="col ml--3">
                                            <h4 class="mb-1" data-dz-name>...</h4>
                                            <p class="small text-muted mb-0" data-dz-size>...</p>
                                        </div>
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item" data-dz-remove>Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } else {
                    echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
                          <span class="alert-text"><strong>ไม่พบข้อมูล </strong><a href="homes.php">กลับสู่หน้าหลัก</a></span>
                        </div>';
                } ?>
            </div>
        </div>
        <?php include("templates/footer.php"); ?>
    </div>
</div>
<?php include("templates/footer-script.php"); ?>
</body>

</html>