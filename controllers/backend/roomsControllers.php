<?php
require_once '../../controllers/connectDB.php';

class roomsControllers extends connectDB
{

    public function insert($data)
    {

        try {
            $sql = "INSERT INTO `rooms` (`rmName`, `rmDetail`, `rmImg`, `hmID`, `rmNote`, `rmPrice`, `rmGqty`) 
                    VALUES ('$data[NAME]', '$data[DETAIL]', '$data[IMGNAME]', '$data[HOMEID]', '$data[NOTE]', '$data[PRICE]', '$data[QTY]')";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($data, $defaultID)
    {

        try {
            $sql = "UPDATE `rooms` SET `rmName`='$data[NAME]',`rmDetail`='$data[DETAIL]',`rmImg`='$data[IMGNAME]',`rmNote`='$data[NOTE]',`rmPrice`='$data[PRICE]',`rmGqty`='$data[QTY]' WHERE rmID = $defaultID";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 0 || $stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {

        $this->connect()->query("DELETE FROM `rooms` WHERE rmID = '$id'");
    }

    public function drop()
    {
        $this->connect()->query("DELETE FROM `rooms`");
    }
}
