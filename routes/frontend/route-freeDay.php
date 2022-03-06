<?php
include "../../controllers/connectDB.php";
$connectDB = new connectDB;

$date = array();
foreach ($connectDB->connect()->query("SELECT date FROM `ord_rooms`WHERE rmID = $_POST[roomID] AND status = '0'") as $result) {
    $date[] = $result["date"];
}

echo json_encode($date);
