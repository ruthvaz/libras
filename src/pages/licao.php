<?php
    require_once '../dao/LicaoDAO.php';
    require_once '../model/Licao.php';
    require_once '../../vendor/autoload.php';

    // Não deixar que alguem entrar em home sem autenticar
    session_start();
    if(!isset($_SESSION['logado'])):
        header('Location: login.php');
    endif;

    // Verificar se existe o id da lição, que é passado via GET
    if(isset($_GET['id'])):
        $daoLicao = new LicaoDAO();
        $licao = $daoLicao->getById($_GET['id'])[0];
    endif;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Perfil </title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/licao.css">
    <!-- Google Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="inicio-mobile">
    <div class="container">

        <!-- Barra de menu com Logo -->
        <div class="menu-bar-perfil">
            <div class="menu-brand">
                <div class="menu-logo"></div>
                Libras+
            </div>
        </div>

    </div>
    
    <!-- Barra de divisão inferior do menu -->
    <div class="menu-bar-bottom"></div>
    
    <!-- conteúdo -->
    <div class="container">
        
        <div id="licao">
            
            <!-- Menu da lição -->
            <div id="licao-menu">
                <span id="licao-botao-voltar" class="material-icons">arrow_back</span>
                <a id="licao-titulo" href="home.php"><?php echo $licao["titulo"]; ?></a>
                
                <button id="licao-botao-questoes">Questões</button>
            </div>

            <div id="licao-conteudo-container">
                
                <?php 
                    // pegar somente o codico do video
                    $partes_url = explode("/", $licao["video"]);
                    $code_video = $partes_url[count($partes_url) - 1];
                ?>

                <!-- Vídeo da lição -->
                <div id="licao-video">
                    <iframe 
                            id="licao-video-iframe"
                            width="100%"
                            src="https://www.youtube.com/embed/<?php echo $code_video; ?>"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>

                <!-- Artigo da lição -->
                <div id="licao-artigo">
                    <?php
                        // o bloco de código abaixo se baseia em: 
                        // 1. ler o arquiva da lição
                        // 2. converter o conteúdo do arquivo, que está em md, para html
                        // 3. inserir o html na página

                        $pasta = "../uploads/licoes/artigos/";
                        $arquivoArtigo = fopen($pasta.$licao["artigo"], 'r');
                        $conteudo = fread($arquivoArtigo, filesize($pasta.$licao["artigo"]));
                        fclose($arquivoArtigo);

                        // usamos a biblioteca League\CommonMark para a conversão de md para html
                        use League\CommonMark\CommonMarkConverter;
                        
                        $converter = new CommonMarkConverter([
                            'html_input' => 'strip',
                            'allow_unsafe_links' => false,
                        ]);

                        echo $converter->convertToHtml($conteudo);

                    ?>
                </div>
                
                <?php
                    if($_SESSION['usuario'][0]['tipo'] == 'P'):
                ?>
                
                <form id="botoes" action="../controller/LicaoDelete.php" method="POST" style="margin-top: 1em;">
                    <button style="
                        color: #fff;
                        background-color: #E2335D;
                        padding: .3em;
                        border-radius: 10px;
                    ">Deletar</button>
                    <input 
                        type="hidden" 
                        name="delete" 
                        value="<?php echo $licao['id'];?>"
                    >
                    <a href="licaomanager?id=<?php echo $licao['id'];?>">Editar</a>
                </form>
                
                <?php
                    endif;
                ?>

            </div>     
        </div>
    
    </div>
    
</body>
</html>