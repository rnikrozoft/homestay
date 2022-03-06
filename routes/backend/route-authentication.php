<?php 
    if ($_REQUEST["authen"]) {
        require_once "../../controllers/backend/authenticationController.php";
        $conn = new authenticationController();

        if (isset($_POST["login"])) {
            if ($salt = $conn->getSalt($_POST["id"])) {

                $data = [
                    "ID" => $_POST["id"],
                    "Password" => sha1($_POST["password"] . $salt["salt"])
                ];

                if ($row = $conn->login($data)) {
                    session_start();
                    $_SESSION["logged"] = "Administrator";
                    header("Location:../../views/backend/dashboard.php");
                } else {
                    echo "<script>alert('รหัสผ่านไม่ถูกต้อง');</script>";
                    echo "<script>window.location.href= '../../views/backend/index.php';</script>"; 
                }
            } else {
                echo "<script>alert('ไม่พบข้อมูลผู้ใช้นี้');</script>";
                echo "<script>window.location.href= '../../views/backend/index.php';</script>"; 
            }
        }

        if (isset($_GET["logout"])) {
            session_start();
            session_destroy();
            header("Location:../../views/backend/index.php");
        }
    }