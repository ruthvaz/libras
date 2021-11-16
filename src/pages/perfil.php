<?php

    require_once '../dao/UsuarioDAO.php';
    require_once '../model/Usuario.php';

    // Não deixar que alguem entrar em home sem autenticar
    session_start();
    if(!isset($_SESSION['logado'])):
        header('Location: login.php');
    endif;

    // pegar dados do usuario
    $user = new Usuario();
    $user->setEmail($_SESSION['email']);

    $dao = new UsuarioDAO();
    $dados = $dao->getByEmail($user);

    // var_dump($dados);

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
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/perfil.css">
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

        <form action="" method="POST" class="login-form" id="formPerfil">
        
            <div class="login-form-container">
                
                <input type="file" name="foto" id="foto">
                <label for="foto" class="label-foto">
                    <div>
                        <img src="../uploads/perfil/<?php echo $dados[0]['foto'] == null ? "user.png" : $dados[0]['foto']; ?>" alt="" id="preview" style="display: flex;">
                        <i data-feather="image" id="icone-foto"></i>
                    </div>
                </label>
                <div class="nome-user"> 
                    <?php echo $dados[0]['nome']; ?> 
                    <span class="material-icons">edit</span> 
                </div>

                <label for="senha-atual">Senha atual</label>
                <input type="password" id="senha-atual" name="senha-atual">

                <label for="nova-senha">Nova senha</label>
                <input type="password" id="nova-senha" name="nova-senha">
                
                <div class="perfil-form-butoes">
                    <div><input type="submit" name="salvar" value="Salvar"></div>
                    <div><div><a href="#">Cancelar</a></div></div>
                </div>
            </div>
        </form>
        
    </div>

    <!-- Script para exibir preview de imagem selecionada para perfil -->
    <script src="js/foto-perfil.js"></script>

    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

</body>
</html>