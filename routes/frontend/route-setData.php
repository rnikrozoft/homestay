<?php
session_start();
require_once "../../controllers/connectDB.php";
$connectDB = new connectDB;
$cmID = $_SESSION["logged"]["ID"];

if (isset($_POST["rooms"])) {
    if (isset($_POST["set"])) {
        $distance = (strtotime($_POST["out"]) - strtotime($_POST["in"])) / (60 * 60 * 24) + 2;
        $date = array();
        for ($i = 0; $i < $distance; $i++) {
            $date[] = date("Y-m-d", strtotime("+" . $i . " days", strtotime($_POST["in"])));
            $stmt = $connectDB->connect()->query("SELECT date FROM `ord_rooms` WHERE rmID = $_POST[roomID] AND date = '" . $date[$i] . "'")->fetch(PDO::FETCH_ASSOC);
            if ($stmt["date"] == $date[$i]) {
                break;
            }
        }
        array_splice($date, count($date) - 1);

        $roomData = $connectDB->connect()->query("SELECT `rmID`, `rmName`, `rmImg`, `rmPrice`, rooms.`hmID`, homes.`hmName` FROM `rooms` JOIN homes ON rooms.hmID = homes.hmID WHERE rmID = $_POST[roomID]")->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION["listR"] = [
            "rID" => $_POST["roomID"],
            "rName" => $roomData["rmName"],
            "rIMG" => $roomData["rmImg"],
            "rPrice" => $roomData["rmPrice"],
            "hmID" => $roomData["hmID"],
            "hName" => $roomData["hmName"],
            "date" => $date
        ];

    } else if (isset($_POST["delete"])) {
        unset($_SESSION["listR"]);
    }
    header("Location:../../views/frontend/plans.php");
} else if (isset($_POST["acts"])) {
    if (isset($_POST["set"])) {

        //หาเวลาใน database ว่าชนกันกับที่เลือกหรือไม่
        $sql = "SELECT COUNT(*) as 'row' FROM `ord_acts` JOIN activities ON ord_acts.actsID = activities.acID
                WHERE cmID = $cmID AND acTime = '$_POST[acTime]' AND checkIn = '$_POST[date]'";
        $row = $connectDB->connect()->query($sql)->fetch(PDO::FETCH_ASSOC);
        
        if($row["row"] == 1){
            echo "found";
        }else{
            $row = $connectDB->connect()->query("SELECT `acID`, `acName`, `acTime`, `acImg`, `acPrice` FROM activities WHERE acID = '$_POST[acID]'")->fetch(PDO::FETCH_ASSOC);
            $countItem = (isset($_SESSION["listA"])) ? count($_SESSION["listA"]) : 0;
            $found = false;
            $index = $countItem;
    
            for ($i = 0; $i < $countItem; $i++) {
                if ($row["acName"] == $_SESSION["listA"][$i]["Name"] && $_POST["date"] == $_SESSION["listA"][$i]["Date"]) {
                    $found = true;
                }
            }
    
            if (!$found) {
                $_SESSION["listA"][] = [
                    "ID" => $row["acID"],
                    "Name" => $row["acName"],
                    "Price" => $row["acPrice"],
                    "Img" => $row["acImg"],
                    "Date" => $_POST["date"],
                    "Time" => $row["acTime"]
                ];
            }
        }
    } else if(isset($_POST["delete"])){

        $count = count($_SESSION["listA"]);
        for ($i = 0; $i < $count; $i++) {
            if ($_POST["acID"] == $_SESSION["listA"][$i]["ID"] && $_POST["date"] == $_SESSION["listA"][$i]["Date"]) {
                array_splice($_SESSION["listA"], $i, 1);
            }
        }
        $count = count($_SESSION["listA"]);
        if ($count == 0) {
            unset($_SESSION["listA"]);
        }

    }
}else if(isset($_POST["prod"])){
    if (isset($_POST["set"])) {
        $row = $connectDB->connect()->query("SELECT * FROM products WHERE pdID = '$_POST[id]'")->fetch(PDO::FETCH_ASSOC);
        $countItem = (isset($_SESSION["listP"])) ? count($_SESSION["listP"]) : 0;
        $found = false;

        for ($i = 0; $i < $countItem; $i++) {
            if ($row["pdName"] == $_SESSION["listP"][$i]["Name"]) {
                $_SESSION["listP"][$i]["QTY"] += $_POST["qty"];
                $found = true;
            }
        }

        if (!$found) {
            $_SESSION["listP"][] = [
                "ID" => $row["pdID"],
                "Name" => $row["pdName"],
                "Price" => $row["pdPrice"],
                "Img" => $row["pdImg"],
                "QTY" => $_POST["qty"]
            ];
        }

    } else if(isset($_POST["delete"])){
        $count = count($_SESSION["listP"]);
        for ($i = 0; $i < $count; $i++) {
            if ($_POST["pdID"] == $_SESSION["listP"][$i]["ID"]) {
                array_splice($_SESSION["listP"], $i, 1);
            }
        }
        $count = count($_SESSION["listP"]);
        if ($count == 0) {
            unset($_SESSION["listP"]);
        }
    }

}
