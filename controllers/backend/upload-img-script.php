<?php
require_once '../../routes/backend/imgRandNameFunc.php';
require_once '../../controllers/connectDB.php';
$connectDB = new connectDB;

if ($_GET["name"] == "homes") {
    if (!empty($_FILES)) {

        $image = $_FILES['file']['name'];
        $imgName = randomImg($image);
        $path = "../../assets/img/homes/details/" . $imgName;

        $stmt = $connectDB->connect()->query("INSERT INTO `imgs_hms`(`imgName`, `hmID`) VALUES ('$imgName','$_GET[id]')");
        ($stmt->rowCount() >= 1) ? move_uploaded_file($_FILES['file']['tmp_name'], $path) : "";
    }
} else if ($_GET["name"] == "activities") {
    if (!empty($_FILES)) {

        $image = $_FILES['file']['name'];
        $imgName = randomImg($image);
        $path = "../../assets/img/activities/details/" . $imgName;

        $stmt = $connectDB->connect()->query("INSERT INTO `imgs_acts`(`imgName`, `acID`) VALUES ('$imgName','$_GET[id]')");
        ($stmt->rowCount() >= 1) ? move_uploaded_file($_FILES['file']['tmp_name'], $path) : "";
    }
} else if ($_GET["name"] == "attractions") {
    if (!empty($_FILES)) {

        $image = $_FILES['file']['name'];
        $imgName = randomImg($image);
        $path = "../../assets/img/attractions/details/" . $imgName;

        $stmt = $connectDB->connect()->query("INSERT INTO `imgs_atts`(`imgName`, `atID`) VALUES ('$imgName','$_GET[id]')");
        ($stmt->rowCount() >= 1) ? move_uploaded_file($_FILES['file']['tmp_name'], $path) : "";
    }
} else if ($_GET["name"] == "products") {
    if (!empty($_FILES)) {

        $image = $_FILES['file']['name'];
        $imgName = randomImg($image);
        $path = "../../assets/img/products/details/" . $imgName;

        $stmt = $connectDB->connect()->query("INSERT INTO `imgs_prod`(`imgName`, `pdID`) VALUES ('$imgName','$_GET[id]')");
        ($stmt->rowCount() >= 1) ? move_uploaded_file($_FILES['file']['tmp_name'], $path) : "";
    }
}
