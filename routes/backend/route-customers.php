<?php

if (isset($_POST["customers"])) {
    require_once "../../controllers/backend/customersControllers.php";
    $execute = new customersControllers;

    if (isset($_POST["delete"])) {

        $execute->delete($_POST["id"]);
    } else if (isset($_POST["drop"])) {
        $execute->drop();
    }
} else { }
