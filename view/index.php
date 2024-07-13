
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type=text], input[type=password] {
            width: calc(100% - 10px);
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="../controller/usuarioController.php?action=logar">
        <h2>Tela de Login</h2>
                <label for="username">Usuário:</label>
        <input type="text" id="username" name="loginUsuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senhaUsuario" required>
        <br>
        <input type="submit" name="login" value="Login">
    </form>
	    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php
        if(isset($_GET['erro']) && $_GET['erro'] == 'login'){
            echo  "<script src='js/erro-login.js'></script>";
        }

        if(isset($_GET['user']) && $_GET['user'] == 'deslogado'){
            echo  "<script src='js/deslogado.js'></script>";
        }
    ?>
</body>
</html>

