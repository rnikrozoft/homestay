<?php
session_start();
include("../../controllers/connectDB.php");
$conn = new connectDB;
$id = $_SESSION["logged"]["ID"];

if (isset($_GET["activities"])) {
    $sql = "SELECT COUNT(*) as 'count' FROM `likes_acts` WHERE cmID = '$id' AND acID = '$_GET[acID]' ";
    $count = $conn->connect()->query($sql)->fetch();

    if ($count["count"] == 0) {
        $sql = "INSERT INTO `likes_acts`(`cmID`, `acID`) VALUES ('$id','$_GET[acID]')";
        $conn->connect()->query($sql);
        $count["count"]++;
    } else {
        $sql = "DELETE FROM `likes_acts` WHERE cmID = '$id' AND acID = '$_GET[acID]'";
        $conn->connect()->query($sql);
        $count["count"]--;
    }
    echo $count["count"];
} else if (isset($_GET["attractions"])) {
    $sql = "SELECT COUNT(*) as 'count' FROM `likes_atts` WHERE cmID = '$id' AND atID = '$_GET[atID]' ";
    $count = $conn->connect()->query($sql)->fetch();

    if ($count["count"] <= 0) {

        $sql = "INSERT INTO `likes_atts`(`cmID`, `atID`) VALUES ('$id','$_GET[atID]')";
        $conn->connect()->query($sql);
        $count["count"]++;
    } else {
        $sql = "DELETE FROM `likes_atts` WHERE cmID = '$id' AND atID = '$_GET[atID]'";
        $conn->connect()->query($sql);
        $count["count"]--;
    }
    echo $count["count"];
} else if (isset($_GET["prod"])) {
    $sql = "SELECT COUNT(*) as 'count' FROM `likes_prod` WHERE cmID = '$id' AND pdID = '$_GET[pdID]' ";
    $count = $conn->connect()->query($sql)->fetch();

    if ($count["count"] == 0) {
        $sql = "INSERT INTO `likes_prod`(`cmID`, `pdID`) VALUES ('$id','$_GET[pdID]')";
        $conn->connect()->query($sql);
        $count["count"]++;
    } else {
        $sql = "DELETE FROM `likes_prod` WHERE cmID = '$id' AND pdID = '$_GET[pdID]'";
        $conn->connect()->query($sql);
        $count["count"]--;
    }
    echo $count["count"];
} else if (isset($_GET["rooms"])) {
    $sql = "SELECT COUNT(*) as 'count' FROM `likes_rooms` WHERE cmID = '$id' AND rmID = '$_GET[rmID]' ";
    $count = $conn->connect()->query($sql)->fetch();

    if ($count["count"] == 0) {
        $sql = "INSERT INTO `likes_rooms`(`cmID`, `rmID`) VALUES ('$id','$_GET[rmID]')";
        $conn->connect()->query($sql);
        $count["count"]++;
    } else {
        $sql = "DELETE FROM `likes_rooms` WHERE cmID = '$id' AND rmID = '$_GET[rmID]'";
        $conn->connect()->query($sql);
        $count["count"]--;
    }
    echo $count["count"];
}
