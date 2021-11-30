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

    public function updateUserInfo($origEmail, $email, $password, $name, $surname) {
        $sql = "UPDATE users SET email = '".$email."', password = '".$password."', meno = '".$name."', priezvisko = '".$surname."' where email = '".$origEmail."'";

        $res = $this->conn->prepare($sql);
        $res->execute();
        $_SESSION["name"] = $email;
    }

    public function readFromTable($email, $columName) {
        $sql = "SELECT * FROM users where email = '".$email."'";

        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();

        foreach ($res as $user) {
            return $user[$columName];
        }

    }

    public function deleteUser($email) {
        $sql = "DELETE FROM users where email = '".$email."'";

        $res = $this->conn->prepare($sql);
        $res->execute();
    }

    public function createUser($email, $password, $name, $surname) {
        $sql = "SELECT * FROM users where email = '".$email."'";

        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();

        foreach($res as $row) {
            return false;
        }

        $sql = "INSERT INTO users VALUES('".$email."', '".$password."', '".$name."', '".$surname."')";

        $res = $this->conn->prepare($sql);
        $res->execute();
    }
}
?>