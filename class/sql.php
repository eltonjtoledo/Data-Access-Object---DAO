<?php
/**
 * Description of sql
 *
 * @author Elton John Toledo
 */
class sql extends PDO{
    private $conn;
    
    public function __construct() {
        $this->conn = new PDO('mysql:host=localhost;dbname=dataAccess', 'elton', '123456');
    }    
    
    public function query($rowQuery, $params = array()) {
       $stmt = $this->conn->prepare($rowQuery);
       $this->setParams($stmt, $params);
       $stmt->execute();
       return $stmt;
    }
    
    public function select($rowQuery, $params = array()):array {
        $stmt = $this->query($rowQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function setParams($statment, $parameters = array()) {
        foreach ($parameters as $key => $value){
            $this->setParam($statment, $key, $value);
       }
    }
    
    private function setParam($statment, $key, $value) {
           $statment->bindParam($key, $value);
    }
    
}
