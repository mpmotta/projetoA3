<?php
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    $id = $_GET['id'];
    require_once('../controller/atendimentoController.php');
    $atendimentoController = new AtendimentoController();
    $atendimento = $atendimentoController->consultaID($id);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Atendimento</title>
</head>

<body>
    <div class="container">
        <h1>Editar Atendimento</h1>
        <form method="post" action="../controller/atendimentoController.php?action=editarAtendimento">
            <input type="hidden" name="idAtendimento" value="<?php echo $id ?>">
            <div class="m-3">
                <label for="idFormaAtendimento" class="form-label">Forma de Atendimento:</label>
                <input type="text" required id="idFormaAtendimento"
                    value="<?php echo $atendimento->getidFormaAtendimento(); ?>" name="idFormaAtendimento"
                    class="form-control" />
            </div>
            <div class="m-3">
                <label for="idUsuario" class="form-label">Usuário:</label>
                <input type="text" required id="idUsuario" value="<?php echo $atendimento->getidUsuario(); ?>"
                    name="idUsuario" class="form-control">
            </div>
            <div class="m-3">
                <label for="ativo" class="form-label">Ativo:</label>
                <input type="text" required id="ativo" value="<?php echo $atendimento->getAtivo(); ?>" name="ativo"
                    class="form-control">
            </div>
            <div class="m-3">
                <label for="respostaAtendimento" class="form-label">Resposta do Atendimento:</label>
                <input type="text" required id="respostaAtendimento"
                    value="<?php echo $atendimento->getRespostaAtendimento(); ?>" name=" respostaAtendimento"
                    class="form-control">
            </div>

            <div class="m-3">
                <a href="logado.php" class="btn btn-secondary mb-3">Voltar</a>
                <button type="submit" class="btn btn-success mb-3">
                    Editar
                </button>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php
    if (isset($_GET['campoVazio'])) {
        echo "<script src='js/erro-vazio.js'></script>";
    }
    ?>
</body>

</html>
<?php
} else {
    header('Location: index.php');
}
?>