<?php
require_once '../../controllers/connectDB.php';

class AddressController extends connectDB
{

    public function insert($data)
    {

        try {
            $sql = "INSERT INTO `address`(`cmID`, `houseNo`, `moo`, `road`, `alley`, `villageName`, `subdistrict`, `district`, `province`, `zipcode`) 
                    VALUES (:cmID,:houseNo,:moo,:road,:alley,:villageName,:subdistrict,:district,:province,:zipcode)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(
                array(
                    ":cmID" => $data["cmID"],
                    ":houseNo" => $data["homeNo"],
                    ":moo" => $data["Moo"],
                    ":road" => $data["Road"],
                    ":alley" => $data["Alley"],
                    ":villageName" => $data["vName"],
                    ":subdistrict" => $data["sDistrict"],
                    ":district" => $data["District"],
                    ":province" => $data["Province"],
                    ":zipcode" => $data["Zipcode"]
                )
            );
            return ($stmt->rowCount() == 1)? true : false ;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($data,$defaultID)
    {
        try {
             $sql = "UPDATE `address` 
                    SET `houseNo`=:houseNo,
                        `moo`=:moo,
                        `road`=:road,
                        `alley`=:alley,
                        `villageName`=:villageName,
                        `subdistrict`=:subdistrict,
                        `district`=:district,
                        `province`=:province,
                        `zipcode`=:zipcode 
                    WHERE addID = $defaultID";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(
                array(
                    ":houseNo" => $data["homeNo"],
                    ":moo" => $data["Moo"],
                    ":road" => $data["Road"],
                    ":alley" => $data["Alley"],
                    ":villageName" => $data["vName"],
                    ":subdistrict" => $data["sDistrict"],
                    ":district" => $data["District"],
                    ":province" => $data["Province"],
                    ":zipcode" => $data["Zipcode"]
                )
            );
            return ($stmt->rowCount() == 1 || $stmt->rowCount() == 0)? true : false ;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($data)
    {
        $this->connect()->query("DELETE FROM address WHERE addID = $data");
    }

}
