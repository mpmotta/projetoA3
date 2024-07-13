<?php
require_once('../model/FormaAtendimentoModel.php');

class FormaAtendimentoController {
    public function consulta() {
        $formaAtendimentoModel = new FormaAtendimento();
        $result = $formaAtendimentoModel->consulta();
        return $result;
    }

    public function handleRequest() {
        if (isset($_GET['action']) && $_GET['action'] == 'consultarFormaAtendimento') {
            $this->consulta();
        }
    }
}

$FormaAtendimentoController = new FormaAtendimentoController();
$FormaAtendimentoController->handleRequest();
?>