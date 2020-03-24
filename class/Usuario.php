<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    // GET E SETERS DO ID USUARIO
    public function getIdUsuario() {

        return $this->idusuario;
    }

    public function setIdUsuario($value) {

        $this->idusuario = $value;
    }

    // GET E SETERS DO DESLOGIN
    public function getDesLogin() {

        return $this->deslogin;
    }

    public function setDesLogin($value) {

        $this->deslogin = $value;
    }

    // GET E SETERS DO DESSENHA
    public function getDesSenha() {

        return $this->dessenha;
    }

    public function setDesSenha($value) {

        $this->dessenha = $value;
    }

    // GET E SETERS DA DATA DO CADASTRO
    public function getDtCadastro() {

        return $this->dtcadastro;
    }

    public function setDtCadastro($value) {

        $this->dtcadastro = $value;
    }

    public function loadById($id) {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID" => $id
        ));

        if (count($results) > 0) {

                $row = $results[0];

                $this->setIdUsuario($row["idusuario"]);
                $this->setDesLogin($row["deslogin"]);
                $this->setDesSenha($row["dessenha"]);
                $this->setDtCadastro(new DateTime($row["dtcadastro"]));
                
        }
    }

    public function __toString() {

        return json_encode(array(

            "idusuario" => $this->getIdUsuario(),
            "deslogin" => $this->getDesLogin(),
            "dessenha" => $this->getDesSenha(),
            "dtcadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }

}

?>  