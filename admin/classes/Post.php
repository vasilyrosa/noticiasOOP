<?php

class Post extends Abstrata implements iCRUD {

	private $titulo;
	private $categoria;
	private $foto;
	private $data;
	private $autor;
	private $conteudo;

	public function getTitulo()
	{
	    return $this->titulo;
	}

	public function setTitulo($titulo)
	{
	     $this->titulo = $titulo;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	     $this->categoria = $categoria;
	}

	public function getFoto()
	{
	    return $this->foto;
	}

	public function setFoto($foto)
	{
	     $this->foto = $foto;
	}

	public function getData()
	{
	    return $this->data;
	}

	public function setData($data)
	{
	     $this->data = $data;
	}

	public function getAutor()
	{
	    return $this->autor;
	}

	public function setAutor($autor)
	{
	     $this->autor = $autor;
	}

	public function getConteudo()
	{
	    return $this->conteudo;
	}

	public function setConteudo($conteudo)
	{
	     $this->conteudo = $conteudo;
	}
	/* métodos funcionais */

	public function alterar() {

	}

	public function pegarId() {

		parent::$tabela = 'administrador';
		parent::$campoTabela = 'adm_nome';
		parent::$campoEscolhido = $this->getAutor();
		return parent::pegarId();
	}

	public function cadastrar() {
		$pdo = Conexao::getInstance();

		try {

			parent::$tabela = "post";
			parent::$campoTabela = 'post_titulo';
			parent::$campoEscolhido = $this->getTitulo();

			if(parent::existeCadastro()) {
				echo '<p class="alert alert-danger">Esse post já existe !</p>';
			} else {

			$cadastrar = $pdo->prepare("INSERT INTO post (   post_titulo,
															 post_categoria,
															 post_foto,
															 post_data,
															 post_autor,
															 post_conteudo
															  )
			VALUES(:titulo, :categoria, :foto, :data, :autor, :conteudo)");
			$cadastrar->bindValue(":titulo", 		$this->getTitulo());
			$cadastrar->bindValue(":categoria", 	$this->getCategoria());
			$cadastrar->bindValue(":foto", 			$this->getFoto());
			$cadastrar->bindValue(":data", 			$this->getData());
			$cadastrar->bindValue(":autor", 		$this->getAutor());
			$cadastrar->bindValue(":conteudo", 		$this->getConteudo());
			$cadastrar->execute();

				 if ($cadastrar->rowCount() == 1){
	                echo '<p class="alert alert-success">Post Cadastrado com sucesso !</p>';
	           	} else {
	                echo '<p class="alert alert-danger">Erro ao cadastrar Post !</p>';
	            }
			}

		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}
	}


}//endclass