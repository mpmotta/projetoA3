<?php
    require_once('../model/UsuarioModel.php');

    class UsuarioController {
		
		public function logar() {
            $usuarioModel = new Usuario();
            $loginUsuario = $_POST['loginUsuario'];
            $senhaUsuario = $_POST['senhaUsuario'];
            $senhaUsuario = md5($senhaUsuario);
			
            $usuarioModel->logar($loginUsuario, $senhaUsuario); 
        }
		
	    public function sair() {
            session_start();
            session_destroy();
            header('Location: ../view/index.php?user=deslogado');

        }	
		

        public function consulta() {
            $usuarioModel = new Usuario();
            $result = $usuarioModel->consulta();
            return $result;
        }

        public function consultaID($id) {
            $Usuario = new Usuario();
            $Usuario->consultaID($id);
            return $Usuario;
        }

        public function cadastrar() {

            $usuarioModel = new usuario();

            $usuarioModel->setNomeUsuario($_POST['nomeUsuario']);
            $usuarioModel->setEmailUsuario($_POST['emailUsuario']);
            $usuarioModel->setLoginUsuario($_POST['loginUsuario']);
            $usuarioModel->setSenhaUsuario(md5($_POST['senhaUsuario']));
            $usuarioModel->setTelefoneCelular($_POST['telefoneCelular']);
            $usuarioModel->setAtivo($_POST['ativo']);
           
            $usuarioModel->cadastrar($usuarioModel);
                header('Location: ../view/logado.php?cadastro=ok');

        }

        public function editar($usuario) {
                $usuarioModel = new usuario();
                $usuarioModel->editar($usuario, $usuario->getIdUsuario());
                header("Location: ../view/logado.php?edit=ok");
        }

        
        public function excluir() {
            $id = $_GET['id'];
            $Usuario = new Usuario();
            $Usuario->excluir($id);
            header( "Location: ../view/logado.php?excluido");
        }
        
        public function handleRequest() {
			if (isset($_GET['action']) && $_GET['action'] == 'logar'){
                $this->logar();
            }
            if (isset($_GET['action']) && $_GET['action'] == 'sair') {
                $this->sair();
            }
			
			
            if (isset($_GET['action']) && $_GET['action'] == 'cadastrarUsuario') {
                $this->cadastrar();
            }
            if (isset($_GET['action']) && $_GET['action'] == 'editarUsuario') {
                $usuario = new usuario();
                $usuario->setIdUsuario($_POST['meuid']);
                $usuario->setNomeUsuario($_POST['nomeUsuario']);
                $usuario->setEmailUsuario($_POST['emailUsuario']);
                $usuario->setLoginUsuario($_POST['loginUsuario']);
                $usuario->setSenhaUsuario($_POST['senhaUsuario']);
                $usuario->setTelefoneCelular($_POST['telefoneCelular']);
                $usuario->setAtivo($_POST['ativo']);
                $this->editar($usuario);
            }
            if (isset($_GET['action']) && $_GET['action'] == 'excluirUsuario') {
                $this->excluir();
            }
        }
    }
    $UsuarioController = new UsuarioController();
    $UsuarioController->handleRequest();