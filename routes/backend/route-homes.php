<?php
require_once "imgRandNameFunc.php";
define("URL", "../../views/backend/homes-details.php?id=");

if (isset($_POST["homes"])) {
    require_once "../../controllers/backend/homesControllers.php";
    $execute = new homesControllers;
    if (isset($_POST["delete"])) {

        $execute->delete($_POST["id"]);
    } else if (isset($_POST["drop"])) {
        $execute->drop();
    } else {
        define("PATH", "../../assets/img/homes/");

        $data = array();

        if (empty($_FILES['img']['name'])) {
            $imgName = $_POST["defaultImg"];
        } else {
            $image = $_FILES['img']['name'];
            $imgName = randomImg($image);
        }
        $path = PATH . $imgName;

        $data = [
            "ID" => $_POST["id"],
            "NAME" => $_POST["name"],
            "VNAME" => $_POST["vname"],
            "CAR" => (@$_POST["car"]) ? 1 : 0,
            "PRI" => (@$_POST["pri"]) ? 1 : 0,
            "WIFI" => (@$_POST["wifi"]) ? 1 : 0,
            "DETAIL" => $_POST["detail"],
            "NOTE" => $_POST["note"],
            "IMGNAME" => $imgName
        ];


        if (isset($_POST["insert"])) {

            if ($execute->insert($data)) {
                move_uploaded_file($_FILES['img']['tmp_name'], $path);
                header("Location:" . URL . $data["ID"] . "");
            } else {
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
                echo "<script>window.location.href = '" . URL . $data["ID"] . "';</script>";
            }
        } else if (isset($_POST["update"])) {

            if ($execute->update($data, $_POST["defaultID"])) {
                if (!empty($_FILES['img']['name'])) {
                    move_uploaded_file($_FILES['img']['tmp_name'], $path);
                }
                header("Location:" . URL . $data["ID"] . "");
            } else {
                echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
                echo "<script>window.location.href = '" . URL . $data["ID"] . "';</script>";
            }
        }
    }
} else if (isset($_POST["rooms"])) {
    require_once "../../controllers/backend/roomsControllers.php";
    $execute = new roomsControllers;

    if (isset($_POST["delete"])) {

        $execute->delete($_POST["id"]);
    } else if (isset($_POST["drop"])) {

        $execute->drop();
    } else {

        define("PATH", "../../assets/img/rooms/");

        $data = array();

        if (empty($_FILES['img']['name'])) {
            $imgName = $_POST["defaultImg"];
        } else {
            $image = $_FILES['img']['name'];
            $imgName = randomImg($image);
        }
        $path = PATH . $imgName;

        $data = [
            "HOMEID" => $_POST["homeID"],
            "NAME" => $_POST["name"],
            "PRICE" => $_POST["price"],
            "QTY" => $_POST["gqty"],
            "DETAIL" => $_POST["detail"],
            "NOTE" => $_POST["note"],
            "IMGNAME" => $imgName
        ];

        if (isset($_POST["insert"])) {

            if ($execute->insert($data)) {
                move_uploaded_file($_FILES['img']['tmp_name'], $path);
                header("Location:" . URL . $data["HOMEID"] . "");
            } else {
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
                echo "<script>window.location.href = '" . URL . $data["HOMEID"] . "';</script>";
            }
        } else if (isset($_POST["update"])) {

            if ($execute->update($data, $_POST["defaultID"])) {
                if (!empty($_FILES['img']['name'])) {
                    move_uploaded_file($_FILES['img']['tmp_name'], $path);
                }
                header("Location:" . URL . $data["HOMEID"] . "");
            } else {
                echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
                echo "<script>window.location.href = '" . URL . $data["HOMEID"] . "';</script>";
            }
        }
    }
} else { }
