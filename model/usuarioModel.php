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
        $sql = "SELECT loginUsuario, senhaUsuario FROM $this->tabela WHERE loginUsuario = :loginUsuario AND senhaUsuario = :senhaUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':loginUsuario', $loginUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':senhaUsuario', $senhaUsuario, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		 if ($result) {
			session_start();
				$_SESSION['logado'] = true;
				header('Location: ../view/logado.php?logado=true');
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
        $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, loginUsuario, senhaUsuario, telefoneCelular, ativo FROM $this->tabela WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->setCategoria($result['categoria']);
            $this->setNome($result['nome']);
            $this->setDescricao($result['descricao']);
            $this->setValor($result['valor']);
        }
    }

    public function inserir($nomeUsuario, $emailUsuario,
		 $loginUsuario, $senhaUsuario, $telefoneCelular, $ativo) {
        $sql = "INSERT INTO $this->tabela (SELECT nomeUsuario, emailUsuario,
		 loginUsuario, senhaUsuario, telefoneCelular, ativo) VALUES (:nomeUsuario, :emailUsuario,  :loginUsuario, :senhaUsuario, :telefoneCelular, :ativo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':emailUsuario', $emailUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':loginUsuario', $loginUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':senhaUsuario', $senhaUsuario, PDO::PARAM_STR);
		$stmt->bindParam(':telefoneCelular', $telefoneCelular, PDO::PARAM_STR);
		$stmt->bindParam(':ativo', $ativo, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function editar($Usuario, $idUsuario) {
        $sql = "UPDATE $this->tabela SET nomeUsuario = :nomeUsuario, emailUsuario = :emailUsuario, loginUsuario = :loginUsuario, senhaUsuario = :senhaUsuario, telefoneCelular = :telefoneCelular, ativo = :ativo  WHERE idUsuario = :idUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':emailUsuario', $emailUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':loginUsuario', $loginUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':senhaUsuario', $senhaUsuario, PDO::PARAM_STR);
		$stmt->bindParam(':telefoneCelular', $telefoneCelular, PDO::PARAM_STR);
		$stmt->bindParam(':ativo', $ativo, PDO::PARAM_STR);
		$stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM $this->tabela WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>