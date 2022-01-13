<?php
require_once '../dao/LicaoDAO.php';
require_once '../model/Licao.php';

session_start();
if(!isset($_SESSION['logado'])):
    header('Location: login.php');
endif;

// Verificar se existe o id da lição, que é passado via GET
if(isset($_POST['delete'])):
    $daoLicao = new LicaoDAO();
    $licao = $daoLicao->getById($_POST['delete'])[0];
    
    $dir = '../uploads/licoes/';
    unlink($dir.'artigos/'.$licao['artigo']);
    unlink($dir.'icones/'.$licao['icone']);
    
    $daoLicao->deleteById($_POST['delete']);
    
endif;

header('Location: ../pages/home.php');
