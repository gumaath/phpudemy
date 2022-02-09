<?php 

Class Usuario {
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setDeslogin($deslogin) {
        $this->deslogin = $deslogin;
    }

    public function getDeslogin() {
        return $this->deslogin;
    }

    public function setDessenha($dessenha) {
        $this->dessenha = $dessenha;
    }

    public function getDessenha() {
        return $this->dessenha;
    }

    public function setDtcadastro($dtcadastro) {
        $this->dtcadastro = $dtcadastro ;
    }
    
    public function getDtcadastro() {
        return $this->dtcadastro;
    }

    public function loadById($id) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public static function getList() {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios");
    }

    public static function search($login) {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%". $login ."%"
        ));
    }

    public function login($login, $password) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN and dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos");
        }
    }

    public function setData($data) {
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }
    
    public function insert() {
        $sql = new Sql();
        
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function update($login, $password) {
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();
        $sql->execQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }

    public function __construct($login="", $password="") {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }


    public function __toString() {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

}

?>