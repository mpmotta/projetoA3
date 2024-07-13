<?php
	session_start();
	if(isset($_SESSION['logado']) && $_SESSION['logado'] == true ){
        $user = $_SESSION['usuario'];
	
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-secondary">
    <div class="container bg-light p-3">
        <h1>Atendimentos</h1>
        <a href="usuarios.php" class="btn btn-primary">Gerenciar Usuários</a>
        <a href="atendimentos.php" class="btn btn-primary">Gerenciar Atendimentos</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php

        if(isset($_GET['cadastro']) && $_GET['cadastro'] == 'ok'){
            echo  "<script src='js/cadastro.js'></script>";
        }

        if(isset($_GET['edit']) && $_GET['edit'] == 'ok'){
            echo  "<script src='js/editado.js'></script>";
        }

        if(isset($_GET['excluido'])){
            echo  "<script src='js/excluido.js'></script>";
        }

        if(isset($_GET['logado']) && $_GET['logado'] == 'true'){
            echo  "<script src='js/logado.js'></script>";
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
                    `../controller/usuarioController.php?id=${id}&action=excluirUsuario`;
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
                window.location.href = `../controller/usuarioController.php?action=sair`;
            }
        });
    }
    </script>


</body>

</html>
<?php
	}else{
		header('Location: index.php');
	}
?>