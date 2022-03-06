<?php
require_once '../../controllers/connectDB.php';

class homesControllers extends connectDB
{

    public function insert($data)
    {

        try {
            $sql = "INSERT INTO `homes`(`hmID`, `hmName`, `hmDetail`, `hmImg`, `mbID`, `CAR`, `WIFI`, `PRI`, `hmNote`) 
                    VALUES ('$data[ID]','$data[NAME]','$data[DETAIL]','$data[IMGNAME]','$data[VNAME]','$data[CAR]','$data[WIFI]','$data[PRI]','$data[NOTE]')";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($data, $defaultID)
    {

        try {
            $sql = "UPDATE `homes` SET `hmID`='$data[ID]',`hmName`='$data[NAME]',`hmDetail`='$data[DETAIL]',`hmImg`='$data[IMGNAME]',`mbID`='$data[VNAME]',`CAR`='$data[CAR]',`WIFI`='$data[WIFI]',`PRI`='$data[PRI]',`hmNote`='$data[NOTE]' WHERE hmID = '$defaultID'";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 0 || $stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {

        $this->connect()->query("DELETE FROM `homes` WHERE hmID = '$id'");
    }

    public function drop()
    {
        $this->connect()->query("DELETE FROM `homes`");
    }
}
