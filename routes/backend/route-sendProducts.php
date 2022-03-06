<?php 
    require_once "../../controllers/connectDB.php";
    $execute = new connectDB;
    $execute->connect()->query("UPDATE `ord_prod` SET `status` = '1' WHERE ord_ID = $_POST[orderID]");
