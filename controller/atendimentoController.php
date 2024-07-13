<?php
require_once('../model/AtendimentoModel.php');

class AtendimentoController {
    public function consulta() {
        $atendimentoModel = new Atendimento();
        $result = $atendimentoModel->consulta();
        return $result;
    }

    public function consultaAtendimentos(){
        $atendimentoModel = new Atendimento();
        $result = $atendimentoModel->consultaAtendimentos();
        return $result;
    }

    public function consultaID($idAtendimento) {
        $atendimento = new Atendimento();
        $atendimento->consultaID($idAtendimento);
        return $atendimento;
    }

    public function cadastrar() {
        $atendimentoModel = new Atendimento();

        $atendimentoModel->setIdFormaAtendimento($_POST['idFormaAtendimento']);
        $atendimentoModel->setIdUsuario($_POST['idUsuario']);
        $atendimentoModel->setAtivo($_POST['ativo']);
        $atendimentoModel->setRespostaAtendimento($_POST['respostaAtendimento']);

        $atendimentoModel->cadastrar($atendimentoModel);
        header('Location: ../view/logado.php?cadastro=ok');
    }

    public function editar($idFormaAtendimento,$idUsuario,$ativo,$respostaAtendimento,$id) {
        $atendimento = new Atendimento();
        $result = $atendimento->editar($idFormaAtendimento,$idUsuario,$ativo,$respostaAtendimento,$id);
            header("Location: ../view/atendimentos.php?edit=ok");
            
    }

    public function excluir() {
        $id = $_GET['id'];
        $atendimento = new Atendimento();
        $atendimento->excluir($id);
        header("Location: ../view/logado.php?excluido");
    }

    public function handleRequest() {
        if (isset($_GET['action']) && $_GET['action'] == 'cadastrarAtendimento') {
            $this->cadastrar();
        }
        if (isset($_GET['action']) && $_GET['action'] == 'editarAtendimento') {
            $id = $_POST['idAtendimento'];
            $idFormaAtendimento = $_POST['idFormaAtendimento'];
            $idUsuario = $_POST['idUsuario'];
            $ativo = $_POST['ativo'];
            $respostaAtendimento = $_POST['respostaAtendimento'];
            $this->editar($idFormaAtendimento,$idUsuario,$ativo,$respostaAtendimento,$id);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'excluirAtendimento') {
            $this->excluir();
        }
    }
}

$AtendimentoController = new AtendimentoController();
$AtendimentoController->handleRequest();