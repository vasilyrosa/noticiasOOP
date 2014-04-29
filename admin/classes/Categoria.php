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

	public function cat_Id() {

		return parent::pegarId('categoria', 'categoria_id', $this->getCategoria());
	}

	public function listar() {
		parent::$tabela = "categoria";
		return parent::listar();
	}

	public function deletar() {
		parent::$tabela = "categoria";
		parent::$campoTabela = "categoria_id";
		return parent::deletar();
	}

	public function listarCategoria() {
		parent::$tabela = "categoria";
		parent::$existeParametros = true;
		$this->setParametros(" LEFT JOIN posicao_destaque ON categoria.categoria_posicao_destaque = posicao_destaque.posicao_id");
		 return parent::listar();
	}


	public function alterar() {
		$pdo = parent::getInstance();

		try {

			$alterar = $pdo->prepare('UPDATE categoria SET categoria_nome = :nome,
				categoria_posicao_destaque = :destaque WHERE categoria_id = :id');
			$alterar->bindValue(':nome', $this->getCategoria());
			$alterar->bindValue(':destaque', $this->getPosicao());
			$alterar->bindValue(':id', $this->getId());
			$alterar->execute();


			if($alterar->rowCount() == 1){
				echo '<p class="alert alert-success">Categoria alterada com sucesso !</p>';
			}else {
				echo '<p class="alert alert-danger">Erro ao alterar categoria !</p>';
			}
		} catch (PDOException $e) {
			echo 'Erro : '.$e->getMessage();
		}
	}

	public function cadastrar() {
		$pdo = Conexao::getInstance();

		try {

			if(parent::existeCadastro('categoria', 'categoria_nome', $this->getCategoria())) {
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