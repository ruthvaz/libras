<?php

    require_once '../dao/UsuarioDAO.php';
    require_once '../model/Usuario.php';
    require_once '../dao/LicaoDAO.php';
    require_once '../model/Licao.php';

    // Não deixar que alguem entrar em home sem autenticar
    session_start();
    if(!isset($_SESSION['logado'])):
        header('Location: login.php');
    endif;
    
    // pegar dados do usuario
    $user = new Usuario();
    $user->setEmail($_SESSION['email']);

    $daoUsuario = new UsuarioDAO();
    global $dadosUsuario;
    $dadosUsuario = $daoUsuario->getByEmail($user);
    $_SESSION['usuario'] = $dadosUsuario;

    // pegar dados das lições
    $daoLicao = new LicaoDAO();
    $licoes = $daoLicao->getAll();
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home </title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
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
            
            <div class="menu-perfil">
                <img src="../uploads/perfil/<?php echo $dadosUsuario[0]['foto'] == null ? "user.png" : $dadosUsuario[0]['foto']; ?>" alt="Perfil">
            </div>
        </div>

    </div>

    <div class="menu-bar-bottom"></div>

    <div class="container">

        <div class="perfil-menu">
            <div class="btn-close-menu"><span class="material-icons">close</span></div>
            <table>
                <tr>
                    <td> <?php echo $dadosUsuario[0]['nome']; ?> </td> 
                </tr>
                <tr>
                    <td> <a href="perfil.php">Perfil <span class="material-icons">account_circle</span> </a> </td> 
                </tr>
                <tr>
                    <td> <a href="#">Ajuda <span class="material-icons">help</span></a> </td> 
                </tr>
                <tr>
                    <td> <a href="../model/logout.php">Sair <span class="material-icons">exit_to_app</span></a> </td> 
                </tr>
            </table>
        </div>
        
        <div class="lessons-container">
            
            <?php

                foreach($licoes as $licao):
                    
            ?>
            
            <div class="lesson">
                <div class="lesson-icon">
                    <a href="licao.php?id=<?php echo $licao['id'] ?>">
                        <div class="lesson-border bom">
                            <div class="lesson-image">
                                <img src="../uploads/licoes/icones/<?php echo $licao['icone'] ?>">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="lesson-name"><?php echo $licao["titulo"] ?></div>
            </div>
            
            <?php
                endforeach;
            ?>
            <!--

            <div class="lesson">
                <div class="lesson-icon">
                    <a href="licao.php">
                        <div class="lesson-border bom">
                            <div class="lesson-image">
                                <img src="../uploads/licoes/icones/start-up.png" alt="Lesson">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="lesson-name">Introdução</div>
            </div>

            <div class="lesson">
                <div class="lesson-icon">
                    <a href="#">
                        <div class="lesson-border mediano">
                            <div class="lesson-image">
                                <img src="../uploads/licoes/icones/family.png" alt="Lesson">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="lesson-name">Família</div>
            </div>
            
            <div class="lesson">
                <div class="lesson-icon">
                    <a href="#">
                        <div class="lesson-border ruim">
                            <div class="lesson-image">
                                <img src="../uploads/licoes/icones/fast-food.png" alt="Lesson">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="lesson-name">Alimentos</div>
            </div>

            <div class="lesson">
                <div class="lesson-icon">
                    <a href="#">
                        <div class="lesson-border desbloqueado">
                            <div class="lesson-image">
                                <img src="../uploads/licoes/icones/dictionary.png" alt="Lesson">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="lesson-name">Vocabulário 1</div>
            </div>

            <div class="lesson">
                <div class="lesson-icon">
                    <a href="#">
                        <div class="lesson-border bloqueado">
                            <div class="lesson-image">
                                <img src="../uploads/licoes/icones/dictionary.png" alt="Lesson">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="lesson-name">Vocabulário 2</div>
            </div>
            
            <div class="lesson">
                <div class="lesson-icon">
                    <a href="#">
                        <div class="lesson-border nova-licao">
                            <div class="lesson-image">
                                <img src="../uploads/licoes/icones/dictionary.png" alt="Lesson">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="lesson-name">Vocabulário 3</div>
            </div>
            -->

            <?php

            if($dadosUsuario[0]['tipo'] == 'P'):
                echo '
                    <div class="lesson">
                        <div class="lesson-icon">
                            <a href="licaomanager.php">
                                <div class="lesson-border nova-licao">
                                    <div class="lesson-image">
                                        <span class="material-icons">add</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="lesson-name">Nova Lição</div>
                    </div>
                ';
            endif;

            ?>
        
	</div>

    </div>

     <!-- Script para menu -->
     <script src="js/perfil-menu.js"></script>
     <!-- Script para posicionar as lições com grid layout -->
     <script src="js/grid-divisor.js"></script>

</body>
</html>
