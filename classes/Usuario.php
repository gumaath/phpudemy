<?php 

Class Usuario {
    private $iduisuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function setIduisuario($iduisuario) {
        $this->iduisuario = $iduisuario;
    }

    public function getIduisuario() {
        return $this->iduisuario;
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
        $this->dtcadastro = $dtcadastro;
    }
    
    public function getDtcadastro() {
        return $this->dtcadastro;
    }

    public function loadById($id) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if (isset($results)) {
            $row = $results[0];
            $this->setIduisuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
    }

    public function __toString() {
        return json_encode(array(
            "idusuario"=>$this->getIduisuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

}

?>