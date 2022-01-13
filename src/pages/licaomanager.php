<?php

    require_once '../dao/UsuarioDAO.php';
    require_once '../model/Usuario.php';
    require_once '../dao/LicaoDAO.php';
    require_once '../model/Licao.php';
    require_once '../../vendor/autoload.php';

    // Não deixar que alguem entrar em home sem autenticar
    session_start();
    if(!isset($_SESSION['logado']) || $_SESSION['usuario'][0]['tipo'] != 'P'):
        header('Location: login.php');
    endif;

    // Verificar se existe o id da lição, que é passado via GET
    if(isset($_GET['id'])):
        $daoLicao = new LicaoDAO();
        $licao = $daoLicao->getById($_GET['id'])[0];
    endif;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nova Lição </title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/novalicao.css">
    <!-- Google Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="inicio-mobile">
    
    <div class="container">

        <div class="menu-bar-perfil">
            <div class="menu-brand">
                <div class="menu-logo"></div>
                Libras+
            </div>
            
            <div class="menu-voltar">
                <span class="material-icons">arrow_back</span>
                <a href="home.php">Voltar</a>
            </div>
        </div>

    </div>

    <div class="menu-bar-bottom"></div>

    <form id="nova-licao-container" method="POST" enctype="multipart/form-data" action="../controller/LicaoManager.php">
        
        <h2><?php echo isset($licao) ? 'Editar Lição' : 'Nova Lição'; ?></h2>

        <input type="hidden" name="licao-id" value="<?php echo isset($licao) ? $licao['id'] : null;  ?>">

        <input type="file" name="icone" id="icone">
        <label for="icone" id="label-icone">
            <div>
                <img src="<?php echo isset($licao) ? '../uploads/licoes/icones/'.$licao['icone'] : '../uploads/licoes/icones/start-up.png';  ?>" alt="" id="preview-icone">
                <span id="texto-preview-icone" class="material-icons">add_a_photo</span>
            </div>
        </label>
        <div class="label-foto-desc">Adicionar ícone</div>
        
        <label for="titulo">Título da Lição</label>
        <input type="text" id="titulo" name="titulo" required value="<?php echo isset($licao) ? $licao['titulo'] : null;  ?>">
        
        <label for="video">Link do vídeo no YouTube</label>
        <input type="url" id="video" name="video" required value="<?php echo isset($licao) ? $licao['video'] : null;  ?>">

        <label for="posicao">Posição da Lição</label>
        <div id="posicao-container">        
            <div id="icone-posicao">
                <img src="<?php echo isset($licao) ? '../uploads/licoes/icones/'.$licao['icone'] : '../uploads/licoes/icones/start-up.png';  ?>" alt="" id="preview-posicao"> 
                <span id="texto-preview-posicao" class="material-icons">add_a_photo</span>
            </div>
            <input type="number" id="posicao" name="posicao" required value="<?php echo isset($licao) ? $licao['posicao'] : null;  ?>">
        </div>

        <div id="licoes">
            <div class="licao" id-licao="1">
                <img src="../uploads/licoes/icones/start-up.png" title="Introdução">
            </div>
            <div class="licao" id-licao="2">
                <img src="../uploads/licoes/icones/family.png" title="Introdução">
            </div>
            <div class="licao" id-licao="3">
                <img src="../uploads/licoes/icones/fast-food.png" title="Introdução">
            </div>
        </div>

        <label for="artigo">Artigo da Lição</label>
        <textarea name="artigo" id="artigo"><?php
                // o bloco de código abaixo se baseia em: 
                // 1. ler o arquiva da lição
                if(isset($licao)):
                    $pasta = "../uploads/licoes/artigos/";
                    $arquivoArtigo = fopen($pasta.$licao["artigo"], 'r');
                    $conteudo = fread($arquivoArtigo, filesize($pasta.$licao["artigo"]));
                    fclose($arquivoArtigo);   
                    echo $conteudo;
                endif;
            ?></textarea>

        <label>Preview do Artigo</label>
        <div id="artigo-preview"></div>

        <div id="form-butoes">
            <div><input type="submit" name="salvar" value="Salvar"></div>
            <div><div><a href="home.php">Cancelar</a></div></div>
        </div>

    </form>
    
    <!-- Script para exibir preview de imagem selecionada para perfil -->
    <script src="js/icone.js"></script>
    
    <!-- MD to html -->
    <script src="https://unpkg.com/showdown/dist/showdown.min.js"></script>
    <script src="js/md.js"></script>

</body>
</html>
