<?php

/**
 * Description of User 
 *
 * @author Elton John Toledo
 */
class User  {

    private $id_user;
    private $username;
    private $password;
    private $dt_create;

    public function getId() {
        return $this->id_user;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDt_create() {
        return $this->dt_create;
    }

    public function setId($id) {
        $this->id_user = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setpassword($password) {
        $this->password = $password;
    }

    public function setDt_create($dt_create) {
        $this->dt_create = $dt_create;
    }

    public function loadById($id) {
        $sql = new sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE id_user = :id", array(
            ":id" => $id
        ));

        if (count($results) > 0) {
            $this->getResults($results);
        }
    }

    public static function getList() {
        $sql = new sql();
        return $sql->select("SELECT * FROM tb_users ORDER BY username");
    }

    public static function searchList($username) {
        $sql = new sql();
        return $sql->select("SELECT * FROM tb_users WHERE username LIKE :username ORDER BY username", array(
                    ":username" => '%' . $username . '%'
        ));
    }

    public function login($username, $password) {
        $sql = new sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE username = :username AND password = :pass", array(
            ":username" => $username,
            ":pass" => $password
        ));

        if (count($results) > 0) {
            $this->getResults($results);
        } else {
            throw new Exception("user or password incorrect, check your password and try again");
        }
    }

    public function insert($username, $password) {
         $this->setUsername($username);
        $this->setpassword($password);
        
        $sql = new sql();
        $results = $sql->select("CALL sp_user_insert(:username, :password)", array(
            ":username" => $this->getUsername(),
            ":password" => $this->getPassword()
        ));

        if (count($results) > 0) {
            $this->getResults($results);
        }
    }
    
    public function update($username, $password, $id) {
        $sql = new sql();
        $results = $sql->query("UPDATE tb_users SET username = :username, password = :password WHERE id_user = :id", array(
            ":username"=> $this->getUsername(),
            ":password"=> $this->getPassword(),
            ":id"=> $this->getId()
        ));
    }
    
    public function Delete($id) {
        $this->setId($id);
        $sql = new sql();
        $sql->query("DELETE FROM tb_users WHERE id_user = :id", array(
            ":id"=> $this->getId()
        ));
        $this->setId(0);
        $this->setUsername('');
        $this->setpassword('');
        $dt = new DateTime();
        $this->setDt_create($dt);
    }

    public function getResults($results) {
        $row = $results[0];
        $this->setId($row['id_user']);
        $this->setUsername($row['username']);
        $this->setpassword($row['password']);

        $dt = new DateTime($row['dt_create']);
        $this->setDt_create($dt->format('d-m-Y'));
    }

    public function __toString() {
        return json_encode(array(
            'id_user' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'dt_create' => $this->getDt_create()
        ));
    }

}
