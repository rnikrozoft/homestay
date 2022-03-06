<?php
require_once '../../controllers/connectDB.php';

class AuthenticationController extends connectDB
{

    public function generateRandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getSalt($data)
    {

        try {
            $stmt = $this->connect()->prepare("SELECT salt FROM customers WHERE email = :email");
            $stmt->execute(
                array(
                    ":email" => $data
                )
            );
            return ($stmt->rowCount() == 1)? $result = $stmt->fetch(PDO::FETCH_ASSOC) : false ;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($data)
    {

        try {
            $stmt = $this->connect()->prepare("SELECT cmID,email FROM customers WHERE email = :email AND pwd = :password");
            $stmt->execute(
                array(
                    ":email" => $data["Email"],
                    ":password" => $data["Password"]
                )
            );
            return ($stmt->rowCount() == 1)? $result = $stmt->fetch(PDO::FETCH_ASSOC) : false ;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function register($data)
    {

        try {

            $salt = $this->generateRandomString();
            $sql = "INSERT INTO `customers`(`cmID`, `fname`, `lname`, `tel`, `email`, `pwd`, `salt`) 
                    VALUES (:ID,:Fname,:Lname,:Tel,:Email,:Password,:Salt)";
            $stmt = $this->connect()->prepare($sql);

            $stmt->execute(
                array(
                    ":ID" => $data["ID"],
                    ":Fname" => $data["Name"],
                    ":Lname" => $data["Lastname"],
                    ":Tel" => $data["Tel"],
                    ":Email" => $data["Email"],
                    ":Password" => sha1($data["Password"] . $salt),
                    ":Salt" => $salt
                )
            );
            return ($stmt->rowCount() == 1)? true : false ;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($data)
    {
        try {

            $sql = "UPDATE `customers` 
                    SET `fname`= :Fname,
                        `lname`= :Lname,
                        `tel`= :Tel,
                        `email`= :Email
                    WHERE cmID = :ID";
            $stmt = $this->connect()->prepare($sql);

            $stmt->execute(
                array(
                    ":ID" => $data["ID"],
                    ":Fname" => $data["Name"],
                    ":Lname" => $data["Lastname"],
                    ":Tel" => $data["Tel"],
                    ":Email" => $data["Email"]
                )
            );
            return ($stmt->rowCount() == 1)? true : false ;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function changePassword($cmID,$old,$new)
    {
        try {
            $oldPassword = $this->connect()->query("SELECT pwd,salt FROM `customers` WHERE cmID = $cmID")->fetch(PDO::FETCH_ASSOC);
            $checkPassword = sha1($old.$oldPassword["salt"]);
            if($checkPassword == $oldPassword["pwd"]){
                $salt = $this->generateRandomString();
                $newPassword = sha1($new.$salt);
                $stmt = $this->connect()->query("UPDATE `customers` SET `pwd`='$newPassword',`salt`='$salt' WHERE cmID = '$cmID'");
                return true;
            }else{
                return false;
            }
            
        } catch (PDOException $e) {
            return false;
        }
    }
}
