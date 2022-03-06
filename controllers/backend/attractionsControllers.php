<?php
require_once '../../controllers/connectDB.php';

class attractionsControllers extends connectDB
{

    public function insert($data)
    {

        try {
            $sql = "INSERT INTO `attractions`(`atName`, `atDetail`, `atDateOpen`, `atImg`, `atPrice`, `atNote`)
                    VALUES ('$data[NAME]','$data[DETAIL]','$data[DATE]','$data[IMGNAME]','$data[PRICE]','$data[NOTE]')";
            $stmt = $this->connect()->query($sql);

            if ($stmt->rowCount() == 1) {
                $result = $this->connect()->query("SELECT atID FROM attractions WHERE atName = '$data[NAME]'")->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    public function update($data, $defaultID)
    {

        try {
            $sql = "UPDATE `attractions` SET `atName`='$data[NAME]',`atDetail`='$data[DETAIL]',`atDateOpen`='$data[DATE]',`atImg`='$data[IMGNAME]',`atPrice`='$data[PRICE]',`atNote`='$data[NOTE]' WHERE atID = '$defaultID'";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 0 || $stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {

        $this->connect()->query("DELETE FROM `attractions` WHERE atID = '$id'");
    }

    public function drop()
    {
        $this->connect()->query("DELETE FROM `attractions`");
    }
}
