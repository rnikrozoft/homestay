<?php
session_start();
require_once("../../controllers/connectDB.php");
$connectDB = new connectDB;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Argon Dashboard PRO - Premium Bootstrap 4 Admin Template</title>

    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

    <!-- Page plugins -->
    <link rel="stylesheet" href="../../assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/vendor/sweetalert2/dist/sweetalert2.min.css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="../../assets/css/argon.min9f1e.css?v=1.1.0" type="text/css">
    <style>
        .card-i .btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="./dashboard.php">
                    <img src="../../assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#sub-menu" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
                                <i class="fas fa-list-alt text-primary"></i>
                                <span class="nav-link-text">ORDER</span>
                            </a>
                            <div class="collapse" id="sub-menu">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="dashboard.php" class="nav-link">ห้องพัก</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="order-tour.php" class="nav-link">กิจกรรม</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="order-products.php" class="nav-link">สินค้า</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members.php">
                                <i class="fas fa-portrait text-orange"></i>
                                <span class="nav-link-text">ข้อมูลสมาชิก</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="homes.php">
                                <i class="fas fa-home text-info"></i>
                                <span class="nav-link-text">ข้อมูลบ้านและห้องพัก</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="activities.php">
                                <i class="fas fa-hiking text-pink"></i>
                                <span class="nav-link-text">ข้อมูลกิจกรรม</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="attractions.php">
                                <i class="fas fa-landmark"></i>
                                <span class="nav-link-text">ข้อมูลสถานที่</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <i class="fas fa-socks text-primary"></i>
                                <span class="nav-link-text">ข้อมูลสินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customers.php">
                                <i class="fas fa-users text-green"></i>
                                <span class="nav-link-text">ข้อมูลลูกค้าหรือผู้ใช้</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">จัดการรูปบนเว็บไซต์</h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="img-slided.php?name=homes">
                                <span class="nav-link-text">● เมนูบ้านพัก</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="img-slided.php?name=activities">
                                <span class="nav-link-text">● เมนูกิจกรรม</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="img-slided.php?name=attractions">
                                <span class="nav-link-text">● เมนูสถานที่</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="img-slided.php?name=products">
                                <span class="nav-link-text">● เมนูสินค้า</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>