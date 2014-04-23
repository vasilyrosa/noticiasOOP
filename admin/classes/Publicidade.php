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

	public function alterar() {

	}

	public function cadastrar() {
		$pdo = Conexao::getInstance();

		try {

			parent::$tabela = "publicidade";
			parent::$campoTabela = 'publicidade_titulo';
			parent::$campoEscolhido = $this->getTitulo();

			if(parent::existeCadastro()) {
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