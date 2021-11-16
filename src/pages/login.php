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
            
            <a class="login-voltar" href="../../index.html">
                <div class="login-seta"><i data-feather="arrow-left"></i></div>
                <div class="login-link">Voltar</div>
            </a>
            
        </div>

        <form action="../controller/LoginUsuario.php" method="POST" class="login-form">
            
            <div class="login-form-container">
                <div class="login-form-titulo">Entrar</div>

                <label for="email">Seu email</label>
                <input type="email" id="email" name="email" required>

                <label for="senha">Sua senha</label>
                <input type="password" id="senha" name="senha" required>
                
                <div class="login-form-butoes">
                    <div><input type="submit" name="logar" value="Entrar"></div>
                    <div><a href="cadastro.php">Ainda não tenho uma conta</a></div>
                </div>
            </div>
        </form>
        <br><br>
        
    </div>

    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

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
