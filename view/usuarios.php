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
    <div class="container bg-light p-0">
        <h1 class="bg-info-subtle text-center p-2">Lista de Usuários</h1>
        <section class="p-2">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>LOGIN</th>
                    <th>CELULAR</th>
                    <th>ATIVO</th>
                    <th>EDITAR</th>
                    <th>EXCLUIR</th>
                </tr>
                <?php
                        require_once('../controller/usuarioController.php');
                        $Usuario = new Usuario(); 
                        $consulta = $Usuario->consulta();	
                        foreach($consulta as $linha){
                            $idUsuario = $linha['idUsuario'];
                            $nomeUsuario = $linha['nomeUsuario'];
                            $emailUsuario = $linha['emailUsuario'];
                            $loginUsuario = $linha['loginUsuario'];
                            $telefoneCelular = $linha['telefoneCelular'];
                            $ativo = ($linha['ativo'] == 'S') ? 'SIM' : 'NÃO';
                        echo"
                        <tr>
                            <td>$idUsuario</td> 
                            <td>$nomeUsuario</td>
                            <td>$emailUsuario</td>
                            <td>$loginUsuario</td>
                            <td>$telefoneCelular</td>
                            <td>$ativo</td>
                            
                            <td><a class='btn btn-success' href='editarUsuario.php?id=$idUsuario'>Editar</a></td>

                            <td><a class='btn btn-danger' onclick='confirmDelete($idUsuario)' href='#'>Excluir</a></td>

                        </tr>    
                        ";
                    }
                ?>
                <tr>
                    <td colspan="6">
                        <a class="btn btn-primary" href="cadastrarUsuario.php">CADASTRAR</a>
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
                window.location.href = `../controller/usuarioController.php?id=${id}&action=excluirUsuario`;
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