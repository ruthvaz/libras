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
                <a id="licao-titulo" href="home.php">Introdução</a>
                
                <button id="licao-botao-questoes">Questões</button>
            </div>

            <div id="licao-conteudo-container">
            
                <!-- Vídeo da lição -->
                <div id="licao-video">
                    <iframe 
                            id="licao-video-iframe"
                            width="100%"
                            src="https://www.youtube.com/embed/fXedubQsvXg"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>

                <!-- Artigo da lição -->
                <div id="licao-artigo">
                    
                    <h1>Libras</h1>
                    <p>A <b>Língua Brasileira de Sinais</b> é a língua de sinais ou gestual usada por surdos
                        dos centros urbanos brasileiros e legalmente reconhecida como meio de 
                        <a href="#">comunicação</a> e expressão. </p>
                    
                    <h1>História</h1>
                    <p>O antigo Instituto dos Surdos, hoje, Instituto Nacional da Educação de Surdos (INES) 
                        foi a primeira escola para surdos no Brasil, fundada em 1857 por <b>Dom Pedro II</b> 
                        e teve como primeira denominação o nome Collégio Nacional para Surdos (de ambos os sexos). </p>

                </div>
                
            </div>     
        </div>
    
</div>

</body>
</html>