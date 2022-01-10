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

        $sql = "UPDATE inzeraty SET userEmail = '".$email."' where userEmail = '".$origEmail."'";
        $res = $this->conn->prepare($sql);
        $res->execute();
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

        foreach ($this->readAllAds("userEmail", $email) as $row) {
            $this->deleteAd($row["id"]);
        }
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
        return true;
    }

    public function createAd($email, $title, $popis, $kategoria, $cena) {
        $sql = "SELECT * FROM users where email = '".$email."'";

        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();
        $count = 0;
        foreach($res as $row) {
            $count = 1;
        }

        if ($count == 1) {
            $sql = "INSERT INTO inzeraty VALUES(NULL , '".$title. "', '" . $popis. "', '" . $kategoria. "', '" . $cena. "', '" . $email. "')";
            $res = $this->conn->prepare($sql);
            $res->execute();
            return true;
        }
        else {
            return false;
        }
    }

    public function readAllAds($colName, $colValue) {
        $sql = "SELECT * FROM inzeraty where $colName = '".$colValue."'";
        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();

        return $res;
    }

    public function deleteAd($id) {
        $sql = "SELECT * FROM inzeraty where id = '".$id."'";

        $res = $this->conn->prepare($sql);
        $res->execute();

        foreach ($res as $img) {
            $this->deleteImages($img["id"]);
        }

        $sql = "DELETE FROM inzeraty where id = '".$id."'";

        $res = $this->conn->prepare($sql);
        $res->execute();

    }

    public function updateAd($id, $title, $popis, $cena) {
        $sql = "UPDATE inzeraty SET title = '".$title."', popis = '".$popis."', cena = '".$cena."' where id = '".$id."'";

        $res = $this->conn->prepare($sql);
        $res->execute();

    }

    public function insertImage($path) {
        $sql = "INSERT INTO images VALUES(NULL, (SELECT MAX(id) FROM inzeraty),'".$path."')";

        $res = $this->conn->prepare($sql);
        $res->execute();
    }

    public function readImage($inzeratId) {
        $sql = "SELECT * FROM images where inzerat_id = '".$inzeratId."'";

        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();

        foreach ($res as $img) {
            return $img["imgPath"];
        }
    }

    public function readAllImages($inzeratId) {
        $sql = "SELECT * FROM images where inzerat_id = '".$inzeratId."'";

        $res = $this->conn->query($sql);
        $res->fetchAll();
        $res->execute();

        return $res;
    }

    public function deleteImages($inzeratId) {
        $sql = "SELECT * FROM images where inzerat_id = '".$inzeratId."'";

        $res = $this->conn->prepare($sql);
        $res->execute();

        foreach ($res as $img) {
            unlink($img["imgPath"]);
        }

        $sql = "DELETE FROM images where inzerat_id = '".$inzeratId."'";

        $res = $this->conn->prepare($sql);
        $res->execute();

    }
}
?>