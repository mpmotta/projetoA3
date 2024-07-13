<?php
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    $user = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Atendimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-secondary">
    <div class="container bg-light p-0">
        <h1 class="bg-info-subtle text-center p-2">Lista de Atendimentos</h1>
        <section class="p-2">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>FORMA DE ATENDIMENTO</th>
                    <th>USUÁRIO</th>
                    <th>ATIVO</th>
                    <th>RESPOSTA</th>
                    <th>EDITAR</th>
                    <th>EXCLUIR</th>
                </tr>
                <?php
                require_once('../controller/atendimentoController.php');
                $Atendimento = new Atendimento();
                $consulta = $Atendimento->consultaAtendimentos();
                foreach ($consulta as $linha) {
                    $idAtendimento = $linha['idAtendimento'];
                    $formaAtendimento = $linha['formaAtendimento'];
                    $nomeUsuario = $linha['NomeUsuario'];
                    $ativo = ($linha['ativo'] == 'S') ? 'SIM' : 'NÃO';
                    $respostaAtendimento = $linha['respostaAtendimento'];
                ?>
                <tr>
                    <td><?php echo $idAtendimento; ?></td>
                    <td><?php echo $formaAtendimento; ?></td>
                    <td><?php echo $nomeUsuario; ?></td>
                    <td><?php echo $ativo; ?></td>
                    <td><?php echo $respostaAtendimento; ?></td>
                    <td><a class='btn btn-success'
                            href='editarAtendimento.php?id=<?php echo $idAtendimento; ?>'>Editar</a></td>
                    <td><a class='btn btn-danger' onclick='confirmDelete(<?php echo $idAtendimento; ?>)'
                            href='#'>Excluir</a></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="5">
                        <a class="btn btn-primary" href="cadastrarAtendimento.php">CADASTRAR</a>
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="logado.php">VOLTAR</a>
                    </td>
                    <td>
                        <a class="btn btn-dark" onclick="confirmSair()" href="#">SAIR</a>
                    </td>
                </tr>
            </table>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php
    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'ok') {
        echo "<script src='js/cadastro.js'></script>";
    }

    if (isset($_GET['edit']) && $_GET['edit'] == 'ok') {
        echo "<script src='js/editado.js'></script>";
    }

    if (isset($_GET['excluido'])) {
        echo "<script src='js/excluido.js'></script>";
    }

    if (isset($_GET['logado']) && $_GET['logado'] == 'true') {
        echo "<script src='js/logado.js'></script>";
    }
    ?>
    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Você tem certeza?",
            text: "Não será possível reverter essa ação!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#c00",
            cancelButtonColor: "#aaa",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sim, apagar!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href =
                    `../controller/atendimentoController.php?id=${id}&action=excluirAtendimento`;
            }
        });
    }

    function confirmSair() {
        Swal.fire({
            title: "DESLOGAR!",
            text: "VOCÊ TEM CERTEZA?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#060",
            cancelButtonColor: "#aaa",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Deslogar!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `../controller/atendimentoController.php?action=sair`;
            }
        });
    }
    </script>
</body>

</html>
<?php
} else {
    header('Location: index.php');
}
?>