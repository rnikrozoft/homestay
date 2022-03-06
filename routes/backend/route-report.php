<?php
require_once "../../controllers/connectDB.php";
$execute = new connectDB;
include "functions.php";

if ($_POST["mode"] == "acts") {

    if (isset($_POST["findDateForList"])) {
        $sql = 'SELECT DISTINCT DATE_FORMAT(checkIn,"%Y") as "date" FROM `ord_acts` WHERE actsID = ' . $_POST["acID"] . ' ORDER BY checkIn';
        $data = array();
        foreach ($execute->connect()->query($sql) as $result) {
            $data[] = $result["date"];
        }
        echo json_encode($data);
    } else if (isset($_POST["render"])) {
        $sql = "SELECT DATE_FORMAT(checkIn,'%m') as 'month', SUM(acPrice) as 'price' 
                FROM `ord_acts` JOIN activities ON ord_acts.actsID = activities.acID
                WHERE DATE_FORMAT(checkIn,'%Y') = " . $_POST["year_value"] . " AND actsID = " . $_POST["id"] . " GROUP BY DATE_FORMAT(checkIn,'%Y-%m')";
        $data = array();
        foreach ($execute->connect()->query($sql) as $result) {
            $xx = ThaiDate($result["month"]);
            $data[] = [
                "month" => $xx,
                "price" => $result["price"]
            ];
        }
        echo json_encode($data);
    }
} else if ($_POST["mode"] == "rooms") {

    if (isset($_POST["findDateForList"])) {
        $sql = 'SELECT DISTINCT DATE_FORMAT(ord_rooms.date,"%Y") as "year" 
                FROM `ord_rooms` 
                JOIN rooms ON ord_rooms.rmID = rooms.rmID 
                JOIN homes ON homes.hmID = rooms.hmID
                WHERE homes.hmID = '.$_POST["hmID"].'
                ORDER BY ord_rooms.date';
        $data = array();
        foreach ($execute->connect()->query($sql) as $result) {
            $data[] = $result["year"];
        }
        echo json_encode($data);
    } else if (isset($_POST["render"])) {
        $sql = "SELECT DATE_FORMAT(ord_rooms.date,'%m') as 'month', 
                SUM(rooms.rmPrice) as 'price' 
                FROM `ord_rooms` 
                JOIN rooms ON ord_rooms.rmID = rooms.rmID 
                JOIN homes ON rooms.hmID = homes.hmID
                WHERE DATE_FORMAT(ord_rooms.date,'%Y') = ".$_POST["year_value"]." AND homes.hmID = ".$_POST["id"]."
                GROUP BY DATE_FORMAT(ord_rooms.date,'%Y-%m')";
        $data = array();
        foreach ($execute->connect()->query($sql) as $result) {
            $xx = ThaiDate($result["month"]);
            $data[] = [
                "month" => $xx,
                "price" => $result["price"]
            ];
        }
        echo json_encode($data);
    }
}
