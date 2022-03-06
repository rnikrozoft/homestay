<?php
include("../../controllers/frontend/AuthenticationController.php");
$conn = new AuthenticationController;

@define("URL", $_POST["url"]);

if (isset($_POST["login"])) {

    if ($row = $conn->getSalt($_POST["email"])) {

        $data = [
            "Email" => $_POST["email"],
            "Password" => sha1($_POST["password"] . $row["salt"])
        ];
        if ($row = $conn->login($data)) {
            session_start();
            $_SESSION["logged"] = [
                "ID" => $row["cmID"],
                "Email" => $row["email"]
            ];
            echo "<script>window.location.href='" . URL . "';</script>";
        } else {
            echo "<script>alert('ข้อมูลไม่ถูกต้อง');</script>";
            echo "<script>window.location.href='" . URL . "';</script>";
        }
    } else {
        echo "<script>alert('ไม่พบข้อมูลผู้ใช้นี้');</script>";
        echo "<script>window.location.href='" . URL . "';</script>";
    }
} else if (isset($_POST["register"])) {

    $data = [
        "ID" => $_POST["ID"],
        "Email" => $_POST["email"],
        "Password" => $_POST["password"],
        "Name" => $_POST["fname"],
        "Lastname" => $_POST["lname"],
        "Tel" => $_POST["tel"],
    ];

    if ($conn->register($data)) {
        if ($row_salt = $conn->getSalt($data["Email"])) {

            $data = [
                "Email" => $_POST["email"],
                "Password" => sha1($_POST["password"] . $row_salt["salt"])
            ];

            if ($row = $conn->login($data)) {
                session_start();
                $_SESSION["logged"] = [
                    "ID" => $row["cmID"],
                    "Email" => $row["email"]
                ];
                echo "<script>window.location.href='" . URL . "';</script>";
            }
        }
    }else{
        echo "<script>alert('ไม่สามารถสมัครสมาชิกได้');</script>";
        echo "<script>window.location.href='" . URL . "';</script>";
    }

} else if (isset($_POST["update"])) {
    if(isset($_POST["changePassword"])){
        if($result = $conn->changePassword($_POST["cmID"],$_POST["oldPwd"],$_POST["newPwd"])){
            echo "<script>window.location.href='" . URL . "';</script>";
        }else{
            echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง');</script>";
            echo "<script>window.location.href='" . URL . "';</script>";
        }
    }else{
        $data = [
            "ID" => $_POST["id"],
            "Email" => $_POST["email"],
            "Name" => $_POST["fname"],
            "Lastname" => $_POST["lname"],
            "Tel" => $_POST["tel"],
        ];

        if ($conn->update($data)) {
            header("Location:" . $_POST["url"] . "");
        }
    }
    
} else {
    session_start();
    session_destroy();
    header("Location:../../views/frontend/index.php");
}
