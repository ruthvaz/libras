<?php
session_start();

require_once '../dao/UsuarioDAO.php';
require_once '../model/Usuario.php';

// array para armarzenar todos os erros decorridos no cadastro  
$erros = array();

// upload de foto

$formats = array("png", "jpeg", "jpg", "gif");
$extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

$foto = null;

if($_FILES['foto']['name'] != ''):
    if(in_array($extension, $formats)):
        $dir = "../uploads/perfil/";
        $tmp = $_FILES['foto']['tmp_name'];
        $novo_nome = uniqid().".$extension";

        if(move_uploaded_file($tmp, $dir.$novo_nome)):
            $foto = $novo_nome;
        else:
            $erros[] = "Não foi possível fazer o upload da foto.";
        endif;
    else:
        $erros[] = "Formato de imagem inválido";
    endif;
endif;

// Validação dos dados

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
if(empty($nome)):
    $erros[] = "Informe seu nome.";
endif;

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
    $erros[] = "Email inválido.";
endif;

$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
if(empty($senha)):
    $erros[] = "Informe sua senha.";
endif;

// Cadastrar usuário

if(empty($erros)):
    $dao = new UsuarioDAO();

    $user = new Usuario();
    $user->setNome($nome);
    $user->setEmail($email);

    $senha_segura = password_hash($senha, PASSWORD_DEFAULT);

    $user->setSenha($senha_segura);
    
    $user->setFoto($foto);
    $user->setTipo('A');

    $dao->create($user);

    $_SESSION['email'] = $email;
    $_SESSION['logado'] = true;
    header('Location: ../pages/home.php');
else:
    $_SESSION['erros'] = $erros;
    header('Location: ../pages/cadastro.php');
    // echo '<script> location.replace("../pages/cadastro.php"); </script>';
endif;
