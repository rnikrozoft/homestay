<?php 
    session_start();
    require_once "../../omise-php/lib/Omise.php";
    define('OMISE_PUBLIC_KEY', 'pkey_test_5go63y8qeb6vf8sg36i');
    define('OMISE_SECRET_KEY', 'skey_test_5go63y8qndhei0qmviu');

    if(isset($_POST["tour"])){
        
        $charge = OmiseCharge::create(array(
            'amount' => (($_POST["priceR"] + $_POST["priceA"]) * 100),
            'currency' => 'thb',
            'card' => $_POST["omiseToken"]
        ));
        
        if ($charge["status"] == "successful") {
            require_once "../../controllers/connectDB.php";
            $connectDB = new connectDB;

            $cmID = $_SESSION["logged"]["ID"];
            $dateSave = date('Y-m-d H:i:s');

            if (isset($_SESSION["listR"])) {
                $roomID = $_SESSION["listR"]["rID"];
                $checkOut = end($_SESSION["listR"]["date"]);

                for($i=0;$i<count($_SESSION["listR"]["date"]);$i++){
                    $date = $_SESSION["listR"]["date"][$i];

                    //บันทึกลงตาราง order_rooms
                    $sql = "INSERT INTO `ord_rooms`(`cmID`, `rmID`, `date`, `checkOut`, `date_save`) 
                            VALUES ('$cmID',$roomID,'$date','$checkOut','$dateSave')";
                    $connectDB->connect()->query($sql);
                }
                unset($_SESSION["listR"]);
            }

            if (isset($_SESSION["listA"])) {
                for($i=0;$i<count($_SESSION["listA"]);$i++){
                    $actsID = $_SESSION["listA"][$i]["ID"];
                    $acName = $_SESSION["listA"][$i]["Name"];
                    $acImg = $_SESSION["listA"][$i]["Img"];
                    $acTime = $_SESSION["listA"][$i]["Time"];
                    $price = $_SESSION["listA"][$i]["Price"];
                    $checkIn = $_SESSION["listA"][$i]["Date"];

                    $sql = "INSERT INTO `ord_acts`(`cmID`, `actsID`, `checkIn`, `date_save`, `status`) 
                            VALUES ($cmID,$actsID,'$checkIn','$dateSave','0')";
                    $connectDB->connect()->query($sql);
                }
                unset($_SESSION["listA"]);
            }
            header("Location:../../views/frontend/history-tour.php");
        } 
        
    }else if(isset($_POST["products"])){
        //products
        require_once "../../controllers/connectDB.php";
        $connectDB = new connectDB;

        $cmID = $_SESSION["logged"]["ID"];
        $dateSave = date('Y-m-d H:i:s');

        $charge = OmiseCharge::create(array(
            'amount' => (($_POST["priceP"]) * 100),
            'currency' => 'thb',
            'card' => $_POST["omiseToken"]
        ));

        if ($charge["status"] == "successful") {
            $count = count($_SESSION["listP"]);
            $result_lastID = $connectDB->connect()->query("SELECT DISTINCT ord_ID from ord_prod ORDER BY ord_ID DESC")->fetch(PDO::FETCH_ASSOC);
            if($result_lastID["ord_ID"]==""){
                $lastOrderID = 0;
            }else{
                $lastOrderID = ($result_lastID["ord_ID"]+1);
            }
            
            for ($i = 0; $i < $count; $i++) {
                $qty = $_SESSION["listP"][$i]["QTY"];
                $pdID = $_SESSION["listP"][$i]["ID"];
                $totalPrice = $_SESSION["listP"][$i]["Price"] * $qty;
                $pdName = $_SESSION["listP"][$i]["Name"];
                $pdImg = $_SESSION["listP"][$i]["Img"];
    
                $sql = "INSERT INTO `ord_prod`(ord_ID,`cmID`, `pdID`, `ord_QTY`,  `date`, `addID`) 
                    VALUES ($lastOrderID,$cmID,$pdID,$qty,'$dateSave','$_POST[address]')";
                $connectDB->connect()->query($sql);
    
                $sql = "UPDATE `products` SET `qty`= qty-$qty WHERE pdID = $pdID";
                $connectDB->connect()->query($sql);
                
            }
            unset($_SESSION["listP"]);
        }
        header("Location:../../views/frontend/history-products.php");
    }