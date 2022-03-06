<?php
require_once '../../controllers/connectDB.php';
$connectDB = new connectDB;

if (isset($_POST["home"])) {
    if (isset($_POST["delete"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_hms` WHERE imgID = '$_POST[id]'");
    } else if (isset($_POST["drop"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_hms` WHERE hmID = '$_POST[id]'");
    }
} else if (isset($_POST["acts"])) {
    if (isset($_POST["delete"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_acts` WHERE imgID = '$_POST[id]'");
    } else if (isset($_POST["drop"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_acts` WHERE acID = '$_POST[id]'");
    }
} else if (isset($_POST["atts"])) {
    if (isset($_POST["delete"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_atts` WHERE imgID = '$_POST[id]'");
    } else if (isset($_POST["drop"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_atts` WHERE atID = '$_POST[id]'");
    }
} else if (isset($_POST["prod"])) {
    if (isset($_POST["delete"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_prod` WHERE imgID = '$_POST[id]'");
    } else if (isset($_POST["drop"])) {
        $connectDB->connect()->query("DELETE FROM `imgs_prod` WHERE pdID = '$_POST[id]'");
    }
}
