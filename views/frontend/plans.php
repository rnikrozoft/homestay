<?php
    include 'templates/header.php';
    if(!isset($_SESSION["logged"])){
        session_destroy();
        echo "<script>window.location.href='index.php'</script>";
    }
    function array_orderby(){
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-8">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-0">ห้องพักของคุณ</h3>
                        </div>
                    </div>
                </div>
                <?php if (!isset($_SESSION["listR"])) { ?>
                <div class="card-body">
                    ไม่มีข้อมูล
                    <p class="small">
                        หากคุณต้องการหาที่พัก โปรดคลิกที่เมนู <a href="index.php">บ้านพักโฮมสเตย์</a>
                    </p>
                </div>
                <?php } else {
                    $priceR = $_SESSION["listR"]["rPrice"]*count($_SESSION["listR"]["date"]); ?>
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>ห้องพัก</th>
                                <th>บ้านพัก</th>
                                <th>ราคา / คืน</th>
                                <th>ระยะเวลา</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">ราคารวม <?php echo $price_room = $_SESSION["listR"]["rPrice"] * count($_SESSION["listR"]["date"]); ?> บาท</th>
                            </tr>
                        </tfoot>
                        <tbody class="list">
                            <tr>
                                <td class="table-user">
                                    <img src="../../assets/img/rooms/<?php echo $_SESSION["listR"]["rIMG"]; ?>" class="avatar rounded-circle mr-3">
                                    <b><?php echo $_SESSION["listR"]["rName"]; ?></b>
                                </td>
                                <td>
                                    <?php echo $_SESSION["listR"]["hName"]; ?>
                                </td>
                                <td>
                                    <?php echo $_SESSION["listR"]["rPrice"]; ?> บาท
                                </td>
                                <td>
                                    <?php echo reset($_SESSION["listR"]["date"]) . " ถึง<br>" . end($_SESSION["listR"]["date"]) . " (" . count($_SESSION["listR"]["date"]) . " วัน)"; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger btn-icon-only rounded-circle del-list" name="rooms">
                                        <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">แผนทัวร์กิจกรรมของคุณ</h3>
                        </div>
                    </div>
                </div>
                <?php if (isset($_SESSION["listA"])) { ?>
                <div class="card-body">
                    <?php
                        $_SESSION["listA"] = array_orderby($_SESSION["listA"], 'Date', SORT_ASC, 'Time', SORT_ASC);
                        $priceA = 0; $date = null; 

                        for ($i = 0; $i < count($_SESSION["listA"]); $i++) {
                            $priceA += $_SESSION["listA"][$i]["Price"];
                            if ($date != $_SESSION["listA"][$i]["Date"]) {
                                $date = $_SESSION["listA"][$i]["Date"];
                                if ($i == 0) {
                                    echo '<h4 class="mb-4"> วันที่ : ' . $date . '</h4>';
                                } else {
                                    echo '<h4 class="mt-4 mb-4">วันที่ : ' . $date . '</h4>';
                                }
                                $time = "";
                            }
                    ?>
                    <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                        <div class="timeline-block">
                            <?php 
                                if ($time != $_SESSION["listA"][$i]["Time"]) {
                                    $time = $_SESSION["listA"][$i]["Time"];
                                    if ($time == 1) {
                                        echo '<span class="timeline-step badge-info text-sm">
                                                เช้า
                                            </span>';
                                    } else if ($time == 2) {
                                        echo '<span class="timeline-step badge-warning text-sm">
                                                บ่าย
                                            </span>';
                                    } else if ($time == 3) {
                                        echo '<span class="timeline-step badge-success text-sm">
                                                เย็น
                                            </span>';
                                    }
                                }
                            ?>
                            <div class="timeline-content">
                                <span class="text-muted font-weight-bold"></span>
                                <div class="pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <a href="activitie-details.php?id=<?php echo $_SESSION["listA"][$i]["ID"]; ?>" class="avatar avatar-xl rounded-circle">
                                                <img src="../../assets/img/activities/<?php echo $_SESSION["listA"][$i]["Img"]; ?>" width="74" height="74">
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="mb-0">
                                                <a href="activitie-details.php?id=<?php echo $_SESSION["listA"][$i]["ID"]; ?>"><?php echo $_SESSION["listA"][$i]["Name"]; ?></a>
                                            </h4>
                                            <p class="text-sm text-muted mb-0"><?php echo $_SESSION["listA"][$i]["Price"] . " บาท"; ?></p>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-sm btn-danger del-list" name="acts" id="<?php echo $_SESSION["listA"][$i]["ID"]; ?>" date="<?php echo $_SESSION["listA"][$i]["Date"]; ?>">ลบ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } else {
                        echo '<div class="card-body">
                                ไม่มีข้อมูล
                                <p class="small">
                                    หากคุณต้องการหากิจกรรมเพื่อสร้างแผนทัวร์ โปรดคลิกที่เมนู <a href="activities.php">กิจกรรมในชุมชนที่คุณอาจสนใจ</a>
                                </p>
                            </div>';
                    } 
                ?>
            </div>
        </div>
        <?php if (isset($_SESSION["listA"]) || isset($_SESSION["listR"])) { ?>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="heading-title text-warning mb-0">สรุปข้อมูล ORDER ของคุณ</h3>
                </div>
                <div class="card-body">
                    <?php 
                        if(isset($_SESSION["listR"])){ ?>
                        <h3 class="text-header">ข้อมูลการจองห้องพัก</h3>
                        <p>ห้องพัก : <?php echo $_SESSION["listR"]["rName"]."&nbsp;(".$_SESSION["listR"]["hName"].")"; ?></p>
                        <p>ราคา/คืน : <?php echo $_SESSION["listR"]["rPrice"]; ?> บาท</p>
                        <p>วันที่เช็คอิน : <?php echo reset($_SESSION["listR"]["date"]); ?> ถึง <?php echo end($_SESSION["listR"]["date"]); ?> (<?php echo count($_SESSION["listR"]["date"]); ?> วัน)</p>
                        <p>ราคารวม : <?php echo $priceR; ?> บาท</p>
                        <hr>
                    <?php } 
                        if(isset($_SESSION["listA"])){ 
                            $found = false; ?>

                        <h3 class="text-header">ข้อมูลแผนทัวร์</h3>
                        <p>ราคารวมกิจกรรมทั้งหมด : <?php echo $priceA; ?> บาท</p>     
                        <hr>

                    <?php 
                        //หาช่วงเวลาซ้ำของกิจกรรมในวันที่เดียวกัน
                        if (count($_SESSION["listA"]) > 1) {
                            for ($i = 0; $i < count($_SESSION["listA"]) - 1; $i++) {
                                for ($j = $i + 1; $j < count($_SESSION["listA"]); $j++) {
                                    if ($_SESSION["listA"][$i]["Date"] == $_SESSION["listA"][$j]["Date"] && $_SESSION["listA"][$i]["Time"] == $_SESSION["listA"][$j]["Time"]) {
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                        } 
                    } 

                    if(!@$found || isset($_SESSION["listR"])){
                        echo '<form method="POST" action="../../routes/frontend/route-checkout.php">
                                <input type="hidden" name="tour" value="true">
                                <input type="hidden" name="priceR" value="'.@$priceR.'">
                                <input type="hidden" name="priceA" value="'.@$priceA.'">
                                <script type="text/javascript" src="https://cdn.omise.co/card.js" 
                                        data-key="pkey_test_5go63y8qeb6vf8sg36i" 
                                        data-image="../../assets/img/brand/logo.png" 
                                        data-frame-label="ชุมชนโฮมสเตย์" 
                                        data-button-label="ยอดชำระรวมทั้งหมด '.(@$priceR+@$priceA).' บาท" 
                                        data-submit-label="Submit" 
                                        data-amount="'.((@$priceR+@$priceA) * 100).'" 
                                        data-currency="thb"></script>
                                </form>';
                    }else{
                        echo '<p class="text-warning">
                                    <strong>โปรดทราบ</strong> ใน 1 วัน ท่านสามารถเลือกกิจกรรมในแต่ละช่วงเวลาได้แค่ 1 กิจกรรม เนื่องจากเหตุผลด้านเวลาของแต่ละกิจกรรมที่ไม่อาจคำนวนได้
                                </p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php include 'templates/footer.php'; ?>
<?php include 'templates/footer-script.php' ?>
</body>

</html>