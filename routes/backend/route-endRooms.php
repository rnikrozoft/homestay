<?php 
    require_once "../../controllers/connectDB.php";
    $execute = new connectDB;
    $execute->connect()->query("UPDATE `ord_rooms` SET `status` = '1' WHERE cmID = $_POST[cmID] AND rmID = $_POST[rmID] AND date_save = '$_POST[datesave]'");