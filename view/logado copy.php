<?php
	session_start();
	if(isset($_SESSION['logado']) && $_SESSION['logado'] == true ){
	require_once('../controller/usuarioController.php');
	$Usuario = new Usuario(); 
	$consulta = $Usuario->consulta();	
	foreach($consulta as $linha){
		 $idUsuario = $linha['idUsuario'];
		 $nomeUsuario = $linha['nomeUsuario'];
		 $emailUsuario = $linha['emailUsuario'];
		 $loginUsuario = $linha['loginUsuario'];
		 $senhaUsuario = $linha['senhaUsuario'];
		 $telefoneCelular = $linha['telefoneCelular'];
		 $ativo = $linha['ativo'];

		
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
	<h1>Logado</h1>
   
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>   
 <?php
        if(isset($_GET['logado']) && $_GET['logado'] == 'true'){
            echo  "<script src='js/logado.js'></script>";
        }
 ?> 


	<section>
		<form action="../controller/usuarioController.php?action=editarUsuario" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="number" class="form-control" id="id" name="idUsuario" value="<?=$idUsuario; ?>">
            </div>
            <div class="form-group">
                <label for="nomeUsuario">Nome do Usuário:</label>
                <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" value="<?=$nomeUsuario; ?>">
            </div>
            <div class="form-group">
                <label for="emailUsuario">E-mail do Usuário:</label>
                <input type="email" class="form-control" id="emailUsuario" name="emailUsuario" value="<?=$emailUsuario; ?>">
            </div>
            <div class="form-group">
                <label for="loginUsuario">Login do Usuário:</label>
                <input type="text" class="form-control" id="loginUsuario" name="loginUsuario" value="<?=$loginUsuario; ?>">
            </div>
            <div class="form-group">
                <label for="senhaUsuario">Senha do Usuário:</label>
                <input type="password" class="form-control" id="senhaUsuario" name="senhaUsuario" value="<?=$senhaUsuario; ?>">
            </div>
            <div class="form-group">
                <label for="telefoneCelular">Telefone Celular:</label>
                <input type="tel" class="form-control" id="telefoneCelular" name="telefoneCelular" value="<?=$telefoneCelular; ?>">
            </div>
            <div class="form-group">
                <label for="ativo">Ativo:</label>
                <input type="ativo" class="form-control" id="ativo" name="ativo" value="<?=$ativo; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
	<?php } ?>
	
	</section>
	<div class="row">
	<div class="col-sm-10"></div>
	<div class="col-sm-2">
		<a class="btn btn-dark" onclick="confirmSair()" href="#">SAIR</a>
	</div>	

	</div>
<script>
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
