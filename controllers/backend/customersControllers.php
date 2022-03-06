<?php
require_once '../../controllers/connectDB.php';

class customersControllers extends connectDB
{

    public function delete($id)
    {

        $this->connect()->query("DELETE FROM `customers` WHERE cmID = '$id'");
    }

    public function drop()
    {
        $this->connect()->query("DELETE FROM `customers` WHERE cmID !=0");
    }
}
