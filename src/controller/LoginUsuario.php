<?php
session_start();

require_once '../dao/UsuarioDAO.php';
require_once '../model/Usuario.php';

// array para armarzenar todos os erros decorridos no cadastro  
$erros = array();

// Validação dos dados

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
    $erros[] = "Email inválido.";
endif;

$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
if(empty($senha)):
    $erros[] = "Informe sua senha.";
endif;


// login usuário

if(empty($erros)):
    $dao = new UsuarioDAO();

    $user = new Usuario();
    $user->setEmail($email);
    $user->setSenha($senha);
    
    $dados = $dao->login($user);

    // var_dump($dados);

    if(empty($dados)):
        $erros[] = "Email ou senha inválidos.";
        $_SESSION['erros'] = $erros;
        header('Location: ../pages/login.php'); 
    else:
        $_SESSION['email'] = $email;
        $_SESSION['logado'] = true;
    
        header('Location: ../pages/home.php');

    endif;

else:
    $_SESSION['erros'] = $erros;
    header('Location: ../pages/login.php');
endif;

