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

        public function inserir() {

            $categoria = $_POST['txtCategoria'];
            $nome = $_POST['txtNome'];
            $descricao = $_POST['txtDescricao'];
            $valor = $_POST['txtValor'];
           
            if(strlen( $categoria ) == 0 || strlen( $nome ) == 0 || strlen( $descricao ) == 0 || strlen( $valor ) == 0  ){
                 header( "Location: ../view/Usuarios.php?campoVazio");
            }elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $Usuario = new Usuario();
                $Usuario->inserir($categoria, $nome, $descricao, $valor);
                header('Location: ../view/Usuarios.php?nome='.$nome);
            } else {
                header( "Location: ../view/Usuarios.php?erro");
            }
        }

        public function editar($Usuario, $Id) {
            
                $Usuario = new Usuario();
                $Usuario->editar($Usuario, $Id);
                header( "Location: ../view/logado.php?editado=ok");
       
        }

        
        public function excluir() {
            $id = $_GET['id'];
            $Usuario = new Usuario();
            $Usuario->excluir($id);
            header( "Location: ../view/Usuarios.php?excluido");
        }
        
        public function handleRequest() {
			if (isset($_GET['action']) && $_GET['action'] == 'logar'){
                $this->logar();
            }
            if (isset($_GET['action']) && $_GET['action'] == 'sair') {
                $this->sair();
            }
			
			
            if (isset($_GET['action']) && $_GET['action'] == 'inserirUsuario') {
                $this->inserir();
            }
            if (isset($_GET['action']) && $_GET['action'] == 'editarUsuario'){
                
			$id = $_POST['idUsuario'];
			
			$usuario = new Usuario();	
			$usuario->setNomeUsuario($_POST['nomeUsuario']);
			$usuario->setEmailUsuario($_POST['emailUsuario']);
			$usuario->setLoginUsuario($_POST['loginUsuario']);
			$usuario->setSenhaUsuario($_POST['senhaUsuario']);
			$usuario->setTelefoneCelular($_POST['telefoneCelular']);
			$usuario->setAtivo($_POST['ativo']);
			
			$this->editar($usuario, $id);
			
            }
            if (isset($_GET['action']) && $_GET['action'] == 'excluirUsuario') {
                $this->excluir();
            }
        }
    }
    $UsuarioController = new UsuarioController();
    $UsuarioController->handleRequest();