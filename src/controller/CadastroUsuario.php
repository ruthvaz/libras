<?php

require_once '../dao/UsuarioDAO.php';
require_once '../model/Usuario.php';

$erros = array();
$formats = array("png", "jpeg", "jpg", "gif");
$extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

if(in_array($extension, $formats)):
    $dir = "../uploads/perfil/";
    $tmp = $_FILES['foto']['tmp_name'];
    $novo_nome = uniqid().".$extension";
    
    if(!move_uploaded_file($tmp, $dir.$novo_nome)):
        $message = "Não foi possível fazer o upload da foto.";
    endif;

else:
    $erros[] = "Formato de imagem inválido";
endif;

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);


/*
$dao = new UsuarioDAO();

$user = new Usuario();
$user->setNome("Luiz");
$user->setEmail("luiz@gmail.com");
$user->setSenha("dfghjmmjhgf");
$user->setFoto("asdfghj.jpg");
$user->setTipo('A');
*/