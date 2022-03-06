<?php
require_once '../../controllers/connectDB.php';

class authenticationController extends connectDB
{

    public function getSalt($id)
    {

        try {
            $sql = "SELECT salt FROM customers WHERE cmID = :ID";
            $stmt = $this->connect()->prepare($sql);

            $stmt->execute(
                array(
                    ":ID" => $id
                )
            );

            if ($stmt->rowCount() == 1) {

                $salt = $stmt->fetch(PDO::FETCH_ASSOC);
                return $salt;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($data)
    {

        try {
            $sql = "SELECT cmID FROM customers WHERE cmID = :ID AND pwd = :PWD ";
            $stmt = $this->connect()->prepare($sql);

            $stmt->execute(
                array(
                    ":ID" => $data["ID"],
                    ":PWD" => $data["Password"]
                )
            );

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
