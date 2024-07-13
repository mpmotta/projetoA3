<?php
require_once 'conexao.php';

class Usuario extends Conexao {
    private $idUsuario;
    private $nomeUsuario;
    private $emailUsuario;
    private $loginUsuario;
    private $senhaUsuario;
	private $telefoneCelular;
	private $ativo;
    private $tabela = 'usuario';

    // construtor
    public function __construct() {
        parent::__construct();
    }

	//getter e setter
   public function getIdUsuario(){
		return $this->idUsuario;
	}

    public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getNomeUsuario(){
		return $this->nomeUsuario;
	}

	public function setNomeUsuario($nomeUsuario){
		$this->nomeUsuario = $nomeUsuario;
	}

	public function getEmailUsuario(){
		return $this->emailUsuario;
	}

	public function setEmailUsuario($emailUsuario){
		$this->emailUsuario = $emailUsuario;
	}

	public function getLoginUsuario(){
		return $this->loginUsuario;
	}

	public function setLoginUsuario($loginUsuario){
		$this->loginUsuario = $loginUsuario;
	}

	public function getSenhaUsuario(){
		return $this->senhaUsuario;
	}

	public function setSenhaUsuario($senhaUsuario){
		$this->senhaUsuario = $senhaUsuario;
	}

	public function getTelefoneCelular(){
		return $this->telefoneCelular;
	}

	public function setTelefoneCelular($telefoneCelular){
		$this->telefoneCelular = $telefoneCelular;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	} 


 // Método de login
    public function logar($loginUsuario, $senhaUsuario) {
        $sql = "SELECT loginUsuario, senhaUsuario, ativo FROM $this->tabela WHERE loginUsuario = :loginUsuario AND senhaUsuario = :senhaUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':loginUsuario', $loginUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':senhaUsuario', $senhaUsuario, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($result['ativo'] == 'S') {
                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['usuario'] = $loginUsuario;
                header('Location: ../view/logado.php?logado=true');
            } else {
                header('Location: ../view/index.php?inativo');
            }
        } else {
            header('Location: ../view/index.php?erro=login');
        }
    }




    // consulta no banco
	
	 public function consulta() {
        $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, loginUsuario,
		senhaUsuario, telefoneCelular, ativo FROM $this->tabela";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function consultaID($id) {
        $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, loginUsuario, senhaUsuario, telefoneCelular, ativo FROM $this->tabela WHERE idUsuario = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->setNomeUsuario($result['nomeUsuario']);
            $this->setEmailUsuario($result['emailUsuario']);
            $this->setLoginUsuario($result['loginUsuario']);
            $this->setSenhaUsuario($result['senhaUsuario']);
            $this->setTelefoneCelular($result['telefoneCelular']);
            $this->setAtivo($result['ativo']);
        }
    }

    public function cadastrar($usuario) {
        $nomeUsuario = $usuario->getNomeUsuario();
        $emailUsuario = $usuario->getEmailUsuario();
        $loginUsuario = $usuario->getLoginUsuario();
        $senhaUsuario = $usuario->getSenhaUsuario();
        $telefoneCelular = $usuario->getTelefoneCelular();
        $ativo = $usuario->getAtivo();
        
        $sql = "INSERT INTO $this->tabela (nomeUsuario, emailUsuario,
		 loginUsuario, senhaUsuario, telefoneCelular, ativo) 
         VALUES (:nomeUsuario, :emailUsuario,  :loginUsuario, :senhaUsuario, :telefoneCelular, :ativo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':emailUsuario', $emailUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':loginUsuario', $loginUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':senhaUsuario', $senhaUsuario, PDO::PARAM_STR);
		$stmt->bindParam(':telefoneCelular', $telefoneCelular, PDO::PARAM_STR);
		$stmt->bindParam(':ativo', $ativo, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function editar($usuario, $id) {
        $nomeUsuario = $usuario->getNomeUsuario();
        $emailUsuario = $usuario->getEmailUsuario();
        $loginUsuario = $usuario->getLoginUsuario();
        $senhaUsuario = $usuario->getSenhaUsuario();
        $telefoneCelular = $usuario->getTelefoneCelular();
        $ativo = $usuario->getAtivo();
    
        $sql = "UPDATE $this->tabela SET nomeUsuario = :nomeUsuario, emailUsuario = :emailUsuario,
               loginUsuario = :loginUsuario, senhaUsuario = :senhaUsuario,
               telefoneCelular = :telefoneCelular, ativo = :ativo
               WHERE idUsuario = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':emailUsuario', $emailUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':loginUsuario', $loginUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':senhaUsuario', $senhaUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':telefoneCelular', $telefoneCelular, PDO::PARAM_STR);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    

    public function excluir($id) {
        $sql = "DELETE FROM $this->tabela WHERE idUsuario = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>