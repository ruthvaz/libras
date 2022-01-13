<?php
session_start();

require_once '../dao/LicaoDAO.php';
require_once '../model/Licao.php';

// array para armarzenar todos os erros decorridos no cadastro  
$erros = array();

// upload de foto

$id = filter_input(INPUT_POST, 'licao-id', FILTER_SANITIZE_SPECIAL_CHARS);

$formats = array("png", "svg");
$extension = pathinfo($_FILES['icone']['name'], PATHINFO_EXTENSION);

$icone = null;

if($_FILES['icone']['name'] != ''):

    if(in_array($extension, $formats)):
        $dir = "../uploads/licoes/icones/";
        $tmp = $_FILES['icone']['tmp_name'];
        $novo_nome = uniqid().".$extension";

        if($id != null):
            $daoLicaoDell = new LicaoDAO();
            $licao = $daoLicaoDell->getById($id)[0];
            unlink($dir.$licao['icone']);
        endif;

        if(move_uploaded_file($tmp, $dir.$novo_nome)):
            $icone = $novo_nome;
        else:
            $erros[] = "Não foi possível fazer o upload do ícone.";
        endif;

    else:
        $erros[] = "Formato de imagem inválido";
    endif;

endif;

// Validação dos dados

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
if(empty($titulo)):
    $erros[] = "Informe um Título.";
endif;

$video = filter_input(INPUT_POST, 'video', FILTER_SANITIZE_URL);
if(!filter_var($video, FILTER_VALIDATE_URL)):
    $erros[] = "Vídeo inválido.";
endif;

$posicao = filter_input(INPUT_POST, 'posicao', FILTER_SANITIZE_SPECIAL_CHARS);
if(empty($posicao)):
    $erros[] = "Informe uma posicao.";
endif;

$artigo = $_POST['artigo'];
/*
$artigo = filter_input(INPUT_POST, 'artigo', FILTER_SANITIZE_SPECIAL_CHARS);
*/
if(empty($artigo)):
    $erros[] = "Informe um artigo.";
endif;


// Cadastrar lição

if(empty($erros)):
    $dao = new LicaoDAO();

    $licao = new Licao();
    $licao->setTitulo($titulo);
    $licao->setVideo($video);
    $licao->setPosicao($posicao);
    
    // criação do arquico em MarkDown
    $nome_artigo = uniqid().".md";
    $pasta = "../uploads/licoes/artigos/";
    
    if($id != null):
        $daoLicaoArt = new LicaoDAO();
        $l = $daoLicaoArt->getById($id)[0];
        $arquivoArtigo = fopen($pasta.$l['artigo'], 'w');
        fwrite($arquivoArtigo, $artigo);
        fclose($arquivoArtigo);
    else:
        $arquivoArtigo = fopen($pasta.$nome_artigo, 'w');
        fwrite($arquivoArtigo, $artigo);
        fclose($arquivoArtigo);
        if($pasta.$arquivoArtigo == false):
            $erros[] = "Não foi possível criar o arquivo.";
            header('Location: ../pages/licaomanager.php');
        endif; 
    
        $licao->setArtigo($nome_artigo);
    endif;
     
    $licao->setIcone($icone); 
    
    if($id != null):
        $licao->setId($id);
        $dao->update($licao);
    else:
        $dao->create($licao);
    endif;
    

    header('Location: ../pages/home.php');

else:
    $_SESSION['erros'] = $erros;
    header('Location: ../pages/licaomanager.php');
    // echo '<script> location.replace("../pages/cadastro.php"); </script>';
endif;