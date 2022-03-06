<?php 
    session_start();
    include("../../controllers/frontend/AddressController.php");
    $conn = new AddressController;
    
    if(isset($_POST["address"])){
        if (isset($_POST["delete"])) {
            $conn->delete($_POST["id"]);
        } else {
            
            define("URL", $_POST["url"]);
            $data = [
                "cmID" => $_SESSION["logged"]["ID"],
                "homeNo" => $_POST["homeID"],
                "Moo" => $_POST["moo"],
                "Road" => $_POST["road"],
                "Alley" => $_POST["alley"],
                "vName" => $_POST["vname"],
                "sDistrict" => $_POST["subDistrict"],
                "District" => $_POST["district"],
                "Province" => $_POST["province"],
                "Zipcode" => $_POST["zipcode"]
            ];
            
            if (isset($_POST["insert"])) {
            
                if ($conn->insert($data)) {
                    header("Location:".URL."");
                }else{
                    echo "<script>alert('ไม่สามารถเพิ่มข้อมูลที่อยู่ได้');</script>";
                    echo "<script>window.location.href='" . URL . "';</script>";
                }
            
            } else if (isset($_POST["update"])) {
            
                if ($conn->update($data,$_POST["defaultID"])) {
                    header("Location:".URL."");
                }else{
                    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลที่อยู่ได้');</script>";
                    echo "<script>window.location.href='" . URL . "';</script>";
                }

            }
        }  
        
    }