<?php

    require_once("config.php");

    // Crrega um usuario
    // $user = new Usuario();
    // $user->loadById(3);

    // echo $user;

    // Carrega lista de usuários
    // $lista = Usuario::getList();

    // echo json_encode($lista);

    // Carrega uma lista de usuários buscando pelo login
    // $search = Usuario::search("jo");

    // echo json_encode($search);

    // Carrega um usuário usando o login e a senha
    $usuario = new Usuario();

    $usuario->login("josé", "1234567890");

    echo $usuario;

?>