<?php
session_start();
require_once("../../controllers/connectDB.php");
$connectDB = new connectDB;
if(isset($_SESSION["logged"])){
    $cmID = $_SESSION["logged"]["ID"];
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

    <!-- Page plugins -->
    <!-- <link rel="stylesheet" href="../../assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="../../assets/vendor/sweetalert2/dist/sweetalert2.min.css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="../../assets/css/argon.min9f1e.css?v=1.1.0" type="text/css">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">

    <style>
        .banner {
            background-image: url("../../assets/img/brand/footer.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        @media (max-width:767px) {

            .content-footer {
                text-align: center;
            }

            iframe {
                margin-top: 15px;
            }
        }

        .card-columns-custom .card {
            margin-bottom: 1.25rem
        }

        @media (min-width:576px) {
            .card-columns-custom {
                column-count: 2;
                column-gap: 1.25rem;
                orphans: 1;
                widows: 1
            }

            .card-columns-custom .card {
                display: inline-block;
                width: 100%
            }
        }

        @media (min-width:576px) {
            .card-columns-custom {
                column-count: 1
            }
        }

        @media (min-width:768px) {
            .card-columns-custom {
                column-count: 2
            }
        }

        @media (min-width:1200px) {
            .card-columns-custom {
                column-count: 2;
                column-gap: 1.25rem
            }
        }

        .badge-yellow {
            color: #8a7104;
            background-color: #ffd600
        }

        .badge-pink {
            color: #ca1138;
            background-color: #f3a4b5
        }

        .badge-purple {
            color: #361b75;
            background-color: #8965e0
        }
        
        .card-profile-image .card {
            position: absolute;
            left: 50%;
            width: 300px;
            max-width:400px;
            transform: translate(-50%, -50%) scale(1);
        }

        .position-ref {
            position: relative;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .full-height {
            height: 88vh;
        }
        .code {
            border-right: 2px solid;
            font-size: 30px;
            padding: 0 15px 0 15px;
            text-align: center;
        }
        .message {
            padding: 15px 15px 0 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-expand-xl navbar-light bg-white">
        <a class="navbar-brand" href="index.php"><img src="../../assets/img/brand/logo.png" width="150px" height="35px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">บ้านพักโฮมสเตย์</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="activities.php">กิจกรรมในชุมชนที่คุณอาจสนใจ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="attractions.php">สถานที่สำคัญของชุมชน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">สินค้าโอท็อป</a>
                </li>
            </ul>
            <?php
                if(isset($_SESSION["logged"])){ ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["logged"]["Email"]; ?></button>
                    <div class="dropdown-menu dropdown-menu-right mt-2">
                        <a class="dropdown-item" href="plans.php">แผนทัวร์ของฉัน</a>
                        <a class="dropdown-item" href="cart.php">ตะกร้าสินค้า</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="history-tour.php">การจองของฉัน</a>
                        <a class="dropdown-item" href="history-products.php">การซื้อสินค้า</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="setting.php">แก้ไขข้อมูลส่วนตัว</a>
                        <a class="dropdown-item" href="../../routes/frontend/route-authentications.php">ออกจากระบบ</a>
                    </div>
                </div>
            <?php
                }else{
                    echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">เข้าสู่ระบบ</button>';
                    echo '<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#register">สมัครสมาชิก</button>';
                }
            ?>
        </div>
    </nav>