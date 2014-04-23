<?php

class Administrador extends Abstrata implements iCRUD {


	private $nome;
	private $email;
	private $login;
	private $senha;

	public function getNome()
	{
	    return $this->nome;
	}

	public function setNome($nome)
	{
	     $this->nome = $nome;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	     $this->email = $email;
	}

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

	public function alterar() {

	}

	public function cadastrar() {
		$pdo = Conexao::getInstance();

		try {

			if(parent::existeCadastro('administrador', 'adm_login', $this->getLogin())) {
				echo ('<p class="alert alert-danger">Já existe um usuário com este Login !</p>');
			} else if(parent::existeCadastro('administrador', 'adm_email', $this->getEmail())){
				echo ('<p class="alert alert-danger">Já existe um usuário com este Email!</p>');
			} else if(parent::existeCadastro('administrador', 'adm_nome', $this->getNome())){
				echo ('<p class="alert alert-danger">Já existe um usuário com este Nome!</p>');
			}else {

			$cadastrar = $pdo->prepare("INSERT INTO administrador (adm_nome,
																	 adm_email,
																	 adm_login,
																	 adm_senha
																   )
			VALUES(:nome, :email, :login, :senha)");
			$cadastrar->bindValue(":nome", 			$this->getNome());
			$cadastrar->bindValue(":email", 		$this->getEmail());
			$cadastrar->bindValue(":login", 		$this->getLogin());
			$cadastrar->bindValue(":senha", 		$this->getSenha());
			$cadastrar->execute();

				 if ($cadastrar->rowCount() == 1){
	                echo '<p class="alert alert-success">Administrador Cadastrado com sucesso !</p>';
	           	} else {
	               echo ('<p class="alert alert-danger">Erro ao cadastrar Administrador !</p>');
	            }
			}

		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}
	}
}