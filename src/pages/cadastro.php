<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Libras+ - Login </title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <!-- Google Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,700&display=swap" rel="stylesheet">
</head>
<body class="inicio-mobile">
    <div class="container">

        <div class="menu-login">

            <div class="login-brand">
                <div class="login-logo"></div>
                Libras+
            </div>
            
            <a class="login-voltar" href="../../">
                <div class="login-seta"><i data-feather="arrow-left"></i></div>
                <div class="login-link">Voltar</div>
            </a>
            
        </div>

        <form action="../controller/CadastroUsuario.php" method="POST" class="login-form" id="formCadastro" enctype="multipart/form-data">
            
            <div class="login-form-container">
                <div class="login-form-titulo">Cadastrar-se</div>
                
                <input type="file" name="foto" id="foto">
                <label for="foto" class="label-foto">
                    <div>
                        <img src="" alt="" id="preview">
                        <i data-feather="image" id="icone-foto"></i>
                    </div>
                </label>
                <div class="label-foto-desc">Adicionar imagem de perfil</div>

                <label for="nome">Seu nome</label>
                <input type="text" id="nome" name="nome" required>

                <label for="email">Seu email</label>
                <input type="email" id="email" name="email" required>

                <label for="senha">Informe uma senha</label>
                <input type="password" id="senha" name="senha" required>
                
                <div class="login-form-butoes">
                    <div><input type="submit" name="logar" value="Entrar"></div>
                    <div><a href="login.php">J?? tenho uma conta</a></div>
                </div>
            </div>
        </form>
        
    </div>
    <br><br>

    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
    <!-- Script para exibir preview de imagem selecionada para perfil -->
    <script src="js/foto-perfil.js"></script>
    
    <!-- Script para exibir erros de cadastro vindos do backend -->
    <?php
        if(isset($_SESSION['erros'])):
            $msg = implode(" ", $_SESSION['erros']);

            echo "<script> alert('$msg') </script>";
            
        endif;
        session_unset();
        session_destroy();

    ?>

</body>
</html>
