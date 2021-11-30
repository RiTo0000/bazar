<?php

class DBStorage
{


    /**
     * @var PDO
     */
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=db_bazar", "root", "dtb456");
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function findUser($email, $password) {
        $sql = "SELECT * FROM users where email = '".$email."' AND password = '".$password."'";

        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();

        foreach($res as $row) {
            return true;
        }

        return false;

    }

    public function updateUserInfo($email, $password, $name, $surname) {
        $sql = "SELECT * FROM users where email = '".$email."' AND password = '".$password."'";

        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();

        foreach($res as $row) {
            return true;
        }

        return false;

    }
}
?>