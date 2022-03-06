<?php
require_once '../../controllers/connectDB.php';

class productsControllers extends connectDB
{

    public function insert($data)
    {

        try {
            $sql = "INSERT INTO `products`(`pdName`, `pdDetail`,  `pdImg`, `pdPrice`, `pdNote`,`qty`)
                    VALUES ('$data[NAME]','$data[DETAIL]','$data[IMGNAME]','$data[PRICE]','$data[NOTE]','$data[QTY]')";
            $stmt = $this->connect()->query($sql);

            if ($stmt->rowCount() == 1) {
                $result = $this->connect()->query("SELECT pdID FROM products WHERE pdName = '$data[NAME]'")->fetch(PDO::FETCH_ASSOC);
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
            $sql = "UPDATE `products` SET `pdName`='$data[NAME]',`pdDetail`='$data[DETAIL]',`pdImg`='$data[IMGNAME]',`pdPrice`='$data[PRICE]',`pdNote`='$data[NOTE]',`qty`='$data[QTY]' WHERE pdID = '$defaultID'";
            $stmt = $this->connect()->query($sql);
            return ($stmt->rowCount() == 0 || $stmt->rowCount() == 1) ?  true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {

        $this->connect()->query("DELETE FROM `products` WHERE pdID = '$id'");
    }

    public function drop()
    {
        $this->connect()->query("DELETE FROM `products`");
    }
}
