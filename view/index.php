<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tela de Login</title>
    <style>
    form {
        width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    </style>
</head>

<body>
    <form method="post" action="../controller/usuarioController.php?action=logar">
        <h2>Tela de Login</h2>
        <label for="username" class="form-label">Usuário:</label>
        <input type="text" class="form-control" id="username" name="loginUsuario" required>
        <label for="senha" class="form-label">Senha:</label>
        <input type="password" class="form-control" id="senha" name="senhaUsuario" required>
        <input type="submit" class="form-control btn btn-success mt-3" name="login" value="Login">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script><?php if(isset($_GET['erro']) && $_GET['erro']=='login') {
            echo "<script src='js/erro-login.js'></script>";
        }

        if(isset($_GET['inativo'])) {
            echo "<script src='js/inativo.js'></script>";
        }

        if(isset($_GET['user']) && $_GET['user']=='deslogado') {
            echo "<script src='js/deslogado.js'></script>";
        }

        ?>
</body>

</html>