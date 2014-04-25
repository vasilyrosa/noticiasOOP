<?php

class Publicidade extends Abstrata implements iCRUD {


	private $titulo;
	private $caminho;
	private $status;

	public function getTitulo()
	{
	    return $this->titulo;
	}

	public function setTitulo($titulo)
	{
	     $this->titulo = $titulo;
	}

	public function getCaminho()
	{
	    return $this->caminho;
	}

	public function setCaminho($caminho)
	{
	     $this->caminho = $caminho;
	}

	public function getStatus()
	{
	    return $this->status;
	}

	public function setStatus($status)
	{
	     $this->status = $status;
	}

	public function listar() {
		parent::$tabela = "publicidade";
		return parent::listar();
	}

	public function pub_Id() {

		return parent::pegarId('publicidade', 'publicidade_id', $this->getId());
	}

	public function alteraStatus(){
		$pdo = parent::getInstance();

		try {

			$alterar = $pdo->prepare('UPDATE publicidade SET   publicidade_status = :status
															   WHERE publicidade_id = :id');

			$alterar->bindValue(':status', 'inativo');
			$alterar->bindValue(':id', $this->getId());
			$alterar->execute();


			if($alterar->rowCount() == 1){
				echo '<p class="alert alert-success"><strong>Status</strong> alterado com sucesso !</p>';
			}else {
				echo '<p class="alert alert-danger">Erro ao alterar <strong>Status</strong>!</p>';
			}
		} catch (PDOException $e) {
			echo 'Erro : '.$e->getMessage();
		}
	}

	public function alterar() {
		$pdo = parent::getInstance();

		try {

			$alterar = $pdo->prepare('UPDATE publicidade SET  publicidade_titulo = :titulo,
															  publicidade_caminho = :caminho,
															  publicidade_status = :status
															   WHERE publicidade_id = :id');
			$alterar->bindValue(':titulo', $this->getTitulo());
			$alterar->bindValue(':caminho', $this->getCaminho());
			$alterar->bindValue(':status', $this->getStatus());
			$alterar->bindValue(':id', $this->getId());
			$alterar->execute();


			if($alterar->rowCount() == 1){
				echo '<p class="alert alert-success"><strong>Publicidade</strong> alterada com sucesso !</p>';
			}else {
				echo '<p class="alert alert-danger">Erro ao alterar <strong>Publicidade</strong>!</p>';
			}
		} catch (PDOException $e) {
			echo 'Erro : '.$e->getMessage();
		}
	}

	public function cadastrar() {
		$pdo = Conexao::getInstance();

		try {

			if(parent::existeCadastro('publicidade', 'publicidade_titulo', $this->getTitulo())) {
				echo '<p class="alert alert-danger">Essa publicidade já existe !</p>';
			} else {

			$cadastrar = $pdo->prepare("INSERT INTO publicidade (   publicidade_titulo,
															 publicidade_caminho,
															 publicidade_status
																 )
			VALUES(:titulo, :caminho, :status)");
			$cadastrar->bindValue(":titulo", 		$this->getTitulo());
			$cadastrar->bindValue(":caminho", 		$this->getCaminho());
			$cadastrar->bindValue(":status", 		$this->getStatus());
			$cadastrar->execute();

				 if ($cadastrar->rowCount() == 1){
	                echo '<p class="alert alert-success">Publicidade Cadastrado com sucesso !</p>';
	           	} else {
	                echo '<p class="alert alert-danger">Erro ao cadastrar Publicidade !</p>';
	            }
			}

		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}
	}

}