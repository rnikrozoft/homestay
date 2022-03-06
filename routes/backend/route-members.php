<?php

if (isset($_POST["members"])) {
    require_once "../../controllers/backend/membersControllers.php";
    $execute = new membersControllers;

    if (isset($_POST["delete"])) {

        $execute->delete($_POST["id"]);
    } else if (isset($_POST["drop"])) {

        $execute->drop($_POST["id"]);
    } else {
        require_once "imgRandNameFunc.php";
        define("URL", "../../views/backend/members.php");
        define("PATH", "../../assets/img/members/");

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
            "PREFIX" => $_POST["prefix"],
            "FNAME" => $_POST["fname"],
            "LNAME" => $_POST["lname"],
            "TEL" => $_POST["tel"],
            "IMGNAME" => $imgName
        ];

        if (isset($_POST["insert"])) {

            if ($execute->insert($data)) {
                move_uploaded_file($_FILES['img']['tmp_name'], $path);
                header("Location:" . URL . "");
            } else {
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
                echo "<script>window.location.href = '" . URL . "';</script>";
            }
        } else if (isset($_POST["update"])) {

            if ($execute->update($data, $_POST["defaultID"])) {
                if (!empty($_FILES['img']['name'])) {
                    move_uploaded_file($_FILES['img']['tmp_name'], $path);
                }
                header("Location:" . URL . "");
            } else {
                echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
                echo "<script>window.location.href = '" . URL . "';</script>";
            }
        } else { }
    }
} else { }
