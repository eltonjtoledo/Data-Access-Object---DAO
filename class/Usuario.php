<?php

/**
 * Description of Usuario
 *
 * @author Elton John Toledo
 */
class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getId() {
        return $this->idusuario;
    }

    public function getlogin() {
        return $this->deslogin;
    }

    public function getsenha() {
        return $this->dessenha;
    }

    public function getdtcadastro() {
        return $this->dtcadastro;
    }

    public function setId($id) {
        $this->idusuario = $id;
    }

    public function setlogin($login) {
        $this->deslogin = $login;
    }

    public function setsenha($senha) {
        $this->dessenha = $senha;
    }

    public function setdtcadastro($dtcadastro) {
        $this->dtcadastro = $dtcadastro;
    }

    public function loadById($id) {
        $sql = new sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :id", array(
            ":id" => $id
        ));

        if (count($results) > 0) {
            $this->getResults($results);
        }
    }

    public static function getList() {
        $sql = new sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function searchList($login) {
        $sql = new sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :login ORDER BY deslogin", array(
                    ":login" => '%' . $login . '%'
        ));
    }

    public function logar($login, $password) {
        $sql = new sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :login AND dessenha = :pass", array(
            ":login" => $login,
            ":pass" => $password
        ));

        if (count($results) > 0) {
            $this->getResults($results);
        } else {
            throw new Exception("Login e/ou Senha invalidos, Verifique se você digitou corretamente!");
        }
    }

    public function insert($login, $password) {
         $this->setlogin($login);
        $this->setsenha($password);
        
        $sql = new sql();
        $results = $sql->select("CALL sp_usuario_insert(:login, :password)", array(
            ":login" => $this->getlogin(),
            ":password" => $this->getsenha()
        ));

        if (count($results) > 0) {
            $this->getResults($results);
        }
    }
    
    public function update($login, $password, $id) {
        $sql = new sql();
        $results = $sql->query("UPDATE tb_usuarios SET deslogin = :login, dessenha = :password WHERE idusuario = :id", array(
            ":login"=> $this->getlogin(),
            ":password"=> $this->getsenha(),
            ":id"=> $this->getId()
        ));
    }
    
    public function Delete($id) {
        $this->setId($id);
        $sql = new sql();
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :id", array(
            ":id"=> $this->getId()
        ));
        $this->setId(0);
        $this->setlogin('');
        $this->setsenha('');
        $dt = new DateTime();
        $this->setdtcadastro($dt);
    }

    public function getResults($results) {
        $row = $results[0];
        $this->setId($row['idusuario']);
        $this->setlogin($row['deslogin']);
        $this->setsenha($row['dessenha']);

        $dt = new DateTime($row['dtcadastro']);
        $this->setdtcadastro($dt->format('d-m-Y'));
    }

    public function __toString() {
        return json_encode(array(
            'idusuario' => $this->getId(),
            'deslogin' => $this->getlogin(),
            'dessenha' => $this->getsenha(),
            'dtcadastro' => $this->getdtcadastro()
        ));
    }

}
