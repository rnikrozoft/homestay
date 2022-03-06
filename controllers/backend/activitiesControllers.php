<?php
require_once '../../controllers/connectDB.php';

class activitiesControllers extends connectDB
{

    public function insert($data)
    {

        try {
            $sql = "INSERT INTO `activities`(`acName`, `acDetail`, `acDateOpen`, `acTime`, `acImg`, `acPrice`, `acNote`, mbID)
                    VALUES ('$data[NAME]','$data[DETAIL]','$data[DATE]','$data[TIME]','$data[IMGNAME]','$data[PRICE]','$data[NOTE]','$data[vName]')";
            $stmt = $this->connect()->query($sql);

            if ($stmt->rowCount() == 1) {
                $result = $this->connect()->query("SELECT acID FROM activities WHERE acName = '$data[NAME]'")->fetch(PDO::FETCH_ASSOC);
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
            $sql = "UPDATE `activities` SET `acName`='$data[NAME]',`acDetail`='$data[DETAIL]',`acDateOpen`='$data[DATE]',`acTime`='$data[TIME]',`acImg`='$data[IMGNAME]',`acPrice`='$data[PRICE]',`acNote`='$data[NOTE]',`mbID`='$data[vName]' WHERE acID = '$defaultID'";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 0 || $stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {

        $this->connect()->query("DELETE FROM `activities` WHERE acID = '$id'");
    }

    public function drop()
    {
        $this->connect()->query("DELETE FROM `activities`");
    }
}
