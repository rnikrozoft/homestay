<?php 
    require_once "imgRandNameFunc.php";
    require_once "../../controllers/connectDB.php";
    $execute = new connectDB;

    if(isset($_GET["delete"])){
        if($_GET["name"]=="homes"){
            $sql = "DELETE FROM img_slide_homes WHERE ID = '$_GET[imgID]'";
        }else if($_GET["name"]=="activities"){
            $sql = "DELETE FROM img_slide_acts WHERE ID = '$_GET[imgID]'";
        }else if($_GET["name"]=="attractions"){
            $sql = "DELETE FROM img_slide_atts WHERE ID = '$_GET[imgID]'";
        }else if($_GET["name"]=="products"){
            $sql = "DELETE FROM img_slide_prod WHERE ID = '$_GET[imgID]'";
        }
       $execute->connect()->query($sql);

    }else if(isset($_POST["insert"])){
        $image = $_FILES['file']['name'];
        $imgName = randomImg($image);

        $data = [
            "Header" => $_POST["header"],
            "SHeader" => $_POST["sub-header"],
            "Img" => $imgName
        ];
        
        if($_POST["name"]=="homes"){

            $sql = "INSERT INTO `img_slide_homes`(`imgName`, `header`, `subHeader`) 
                    VALUES ('$data[Img]','$data[Header]','$data[SHeader]')";
            $execute->connect()->query($sql);
            $path = "../../assets/img/imgSlide/homes/".$imgName;
            move_uploaded_file($_FILES['file']['tmp_name'], $path);

        }else if($_POST["name"]=="activities"){

            $sql = "INSERT INTO `img_slide_acts`(`imgName`, `header`, `subHeader`) 
                    VALUES ('$data[Img]','$data[Header]','$data[SHeader]')";
            $execute->connect()->query($sql);
            $path = "../../assets/img/imgSlide/activities/".$imgName;
            move_uploaded_file($_FILES['file']['tmp_name'], $path);

        }else if($_POST["name"]=="attractions"){

            $sql = "INSERT INTO `img_slide_atts`(`imgName`, `header`, `subHeader`) 
                    VALUES ('$data[Img]','$data[Header]','$data[SHeader]')";
            $execute->connect()->query($sql);
            $path = "../../assets/img/imgSlide/attractions/".$imgName;
            move_uploaded_file($_FILES['file']['tmp_name'], $path);

        }else if($_POST["name"]=="products"){

            $sql = "INSERT INTO `img_slide_prod`(`imgName`, `header`, `subHeader`) 
                    VALUES ('$data[Img]','$data[Header]','$data[SHeader]')";
            $execute->connect()->query($sql);
            $path = "../../assets/img/imgSlide/products/".$imgName;
            move_uploaded_file($_FILES['file']['tmp_name'], $path);
        }
    }
    header("Location:../../views/backend/img-slided.php?name=".$_REQUEST["name"]."");