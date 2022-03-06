<?php
require_once '../../controllers/connectDB.php';

class membersControllers extends connectDB
{

    public function insert($data)
    {

        try {
            $sql = "INSERT INTO `members`(`mbID`, `mbPx`, `fname`, `lname`, `tel`, `img`) 
                    VALUES ('$data[ID]','$data[PREFIX]','$data[FNAME]','$data[LNAME]','$data[TEL]','$data[IMGNAME]')";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($data, $defaultID)
    {

        try {
            $sql = "UPDATE `members` SET `mbID`= '$data[ID]', `mbPx`= '$data[PREFIX]', `fname`= '$data[FNAME]', `lname`= '$data[LNAME]', `tel`= '$data[TEL]', `img` = '$data[IMGNAME]' WHERE mbID = '$defaultID'";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 1 || $stmt->rowCount() == 0) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {

        $this->connect()->query("DELETE FROM `members` WHERE mbID = '$id'");
    }

    public function drop()
    {
        $this->connect()->query("DELETE FROM `members`");
    }
}
