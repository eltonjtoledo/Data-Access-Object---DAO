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
        
        if(count($results) > 0){
           $row = $results[0];

           $this->setId($row['idusuario']);
           $this->setlogin($row['deslogin']);
           $this->setsenha($row['dessenha']);
           
           $dt = new DateTime($row['dtcadastro']);
           $this->setdtcadastro($dt->format('d-m-Y'));
        }
    }
    
    public function __toString() {
        return json_encode(array(
               'idusuario' => $this->getId(),
               'deslogin' => $this->getlogin(),
               'dessenha' => $this->getsenha(),
               'dtcadastro' => $this->getdtcadastro()
           ),JSON_PRETTY_PRINT);
    }
}
