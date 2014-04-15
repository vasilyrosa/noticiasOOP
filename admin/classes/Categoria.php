<?php

class Categoria extends Abstrata implements iCRUD{

	private $posicao;
	private $categoria;


	public function getPosicao()
	{
	    return $this->posicao;
	}

	public function setPosicao($posicao)
	{
	     $this->posicao = $posicao;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	     $this->categoria = $categoria;
	}

	public function listar() {
		parent::$tabela = "categoria";
		return parent::listar();
	}

	public function alterar() {
		echo 'ola mundo';
	}

	public function cadastrar() {
		$pdo = Conexao::getInstance();

		try {

			parent::$tabela = "categoria";
			parent::$campoTabela = 'categoria_nome';
			parent::$campoEscolhido = $this->getCategoria();

			if(parent::existeCadastro()) {
				echo '<p class="alert alert-danger">Essa categoria já existe !</p>';
			} else {

			$cadastrar = $pdo->prepare("INSERT INTO categoria (categoria_nome, categoria_posicao_destaque)
			VALUES(:categoria, :posicao)");
			$cadastrar->bindValue(":categoria", $this->getCategoria());
			$cadastrar->bindValue("posicao", $this->getPosicao());
			$cadastrar->execute();

				 if ($cadastrar->rowCount() == 1){
	                echo '<p class="alert alert-success">Categoria Cadastrada com sucesso !</p>';
	           	} else {
	                echo '<p class="alert alert-danger">Erro ao cadastrar categoria !</p>';
	            }
			}

		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}
	}
}