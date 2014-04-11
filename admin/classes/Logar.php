<?php


class Logar extends Conexao implements iLogin{

	private $login;
	private $senha;
	private $erro;

	public function getLogin()
	{
	    return $this->login;
	}

	public function setLogin($login)
	{
	     $this->login = $login;
	}

	public function getSenha()
	{
	    return $this->senha;
	}

	public function setSenha($senha)
	{
	     $this->senha = $senha;
	}

	public function getErro()
	{
	    return $this->erro;
	}

	public function setErro($erro)
	{
	     $this->erro = $erro;
	}

	public function login() {
		try {
			$pdo = Conexao::getInstance();
			$sql = "SELECT * FROM administrador WHERE adm_login = :login  AND adm_senha = :senha";
			$logar = $pdo->prepare($sql);
			$logar->bindValue(':login', $this->getLogin());
			$logar->bindValue(':senha', $this->getSenha());
			$logar->execute();

			if($logar->rowCount() == 1) {
				$dados = $logar->fetch(PDO::FETCH_OBJ); //retorna registro
				$_SESSION['logado'] = true;
				$_SESSION['nome_adm'] = $dados->adm_nome;
				return true;
			} else {
				$this->setErro('<p class="alert alert-danger">Erro ao logar: Login ou Senha invalidos !</p>');
				return false;
			}

		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}

	}

	public function deslogar() {

	}

	public static function verificaLogin() {

		if(!isset($_SESSION['logado'])){
			header("Location: ../index.php");
		}
	}



}