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

                $this->setData($results[0]);
                
        }
    }

    public static function getList() {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login) {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(

            ':SEARCH' => "%" . $login . "%"
        ));
    }

    public function login($login, $password) {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $password
        ));

        if (count($results) > 0) {

                $row = $results[0];

               $this->setData($results[0]);
                
        } else {

            throw new Exception("Login e/ou senha inválidos");
            
        }
    }

    public function setData($data) {

        $this->setIdUsuario($data["idusuario"]);
        $this->setDesLogin($data["deslogin"]);
        $this->setDesSenha($data["dessenha"]);
        $this->setDtCadastro(new DateTime($data["dtcadastro"]));  
    }

    public function insert() {

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(

            ":LOGIN" => $this->getDesLogin(),
            ":PASSWORD" => $this->getDesSenha()
        ));

        if(count($results) > 0) {

            $this->setData($results[0]);
        }
    }

    public function update($login, $password) {

        $this->setDesLogin($login);
        $this->setDesSenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN desssenha = :PASSWORD WHERE idusuario = :ID,", array(

            ":LOGIN" => $this->getDesLogin(),
            ":PASSWORD" => $this->getDesSenha(),
            ":ID" => $this->getIdUsuario()
        ));
    }

    public function __construct($login = "", $password = "") {

        $this->setDeslogin($login);
        $this->setDesSenha($password);
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