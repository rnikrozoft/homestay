<?php
require_once "imgRandNameFunc.php";
define("URL", "../../views/backend/products-details.php?id=");

if (isset($_POST["products"])) {
    require_once "../../controllers/backend/productsControllers.php";
    $execute = new productsControllers;

    if (isset($_POST["delete"])) {
        $execute->delete($_POST["id"]);
    } else if (isset($_POST["drop"])) {
        $execute->drop();
    } else {
        define("PATH", "../../assets/img/products/");
        $data = array();

        if (empty($_FILES['img']['name'])) {
            $imgName = $_POST["defaultImg"];
        } else {
            $image = $_FILES['img']['name'];
            $imgName = randomImg($image);
        }
        $path = PATH . $imgName;

        $data = array();
        $data = [
            "NAME" => $_POST["name"],
            "PRICE" => $_POST["price"],
            "QTY" => $_POST["qty"],
            "IMGNAME" => $imgName,
            "DETAIL" => $_POST["detail"],
            "NOTE" => $_POST["note"]
        ];

        if (isset($_POST["insert"])) {

            if ($result = $execute->insert($data)) {
                move_uploaded_file($_FILES['img']['tmp_name'], $path);
                header("Location:" . URL . $result["pdID"] . "");
            } else {
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
                echo "<script>window.location.href = '../../views/backend/products.php';</script>";
            }
        } else if (isset($_POST["update"])) {

            if ($execute->update($data, $_POST["defaultID"])) {
                move_uploaded_file($_FILES['img']['tmp_name'], $path);
                header("Location:" . URL . $_POST["defaultID"] . "");
            } else {
                echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
                echo "<script>window.location.href = '" . URL . $_POST["defaultID"] . "';</script>";
            }
        }
    }
}
