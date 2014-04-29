<?php

class Categoria extends Abstrata {

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

	public function listarCategoria() {
		parent::$tabela = "categoria";
		parent::$existeParametros = true;
		$this->setParametros(" INNER JOIN posicao_destaque ON categoria.categoria_posicao_destaque = posicao_destaque.posicao_id");
		 return parent::listar();
	}

	public function listarCategoriaEscolhida(){
		parent::$tabela = "categoria";
		parent::$existeParametros = true;
		$this->setParametros(" INNER JOIN post INNER JOIN administrador ON categoria.categoria_id = post.post_categoria
			WHERE categoria_id = ".$this->getId());
		 return parent::listar();
	}

}