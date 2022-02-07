<?php 

class Sql extends PDO {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:dbname=phpcurso7;host=127.0.0.1", "guma", "@merda22");
    }

    private function setParams($statement, $parameters = array()) {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }


    private function setParam($statement, $key, $value) {
        $statement->bindParam($key, $value);
    }

    public function execQuery($rawQuery, $params = array()) {
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $params = array()):array {
       $stmt = $this->execQuery($rawQuery, $params);
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>