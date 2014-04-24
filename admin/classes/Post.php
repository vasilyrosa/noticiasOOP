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
		$pdo = parent::getInstance();

		try {

			$alterar = $pdo->prepare('UPDATE post SET post_titulo    = :titulo,
													  post_categoria = :categoria,
													  post_foto      = :foto,
													  post_data      = :data,
													  post_autor     = :autor,
													  post_conteudo  = :conteudo
				WHERE post_id = :id');
			$alterar->bindValue(':titulo', 	 $this->getTitulo());
			$alterar->bindValue(':categoria',$this->getCategoria());
			$alterar->bindValue(':foto',	 $this->getFoto());
			$alterar->bindValue(':data', 	 $this->getData());
			$alterar->bindValue(':autor', 	 $this->getAutor());
			$alterar->bindValue(':conteudo', $this->getConteudo());
			$alterar->bindValue(':id', 		 $this->getId());
			$alterar->execute();


			if($alterar->rowCount() == 1){
				echo '<p class="alert alert-success">Post alterado com sucesso !</p>';
			}else {
				echo '<p class="alert alert-danger">Erro ao alterar Post !</p>';
			}
		} catch (PDOException $e) {
			echo 'Erro : '.$e->getMessage();
		}
	}


	public function listarPost() {
		parent::$tabela = "post";
		parent::$existeParametros = true;
		$this->setParametros(" INNER JOIN categoria INNER JOIN administrador ON
												post.post_categoria = categoria.categoria_id  AND
												post.post_autor = administrador.adm_id");
		 return parent::listar();
	}

	public function adm_Id() {

		return parent::pegarId('administrador', 'adm_nome', $this->getAutor());
	}

	public function post_Id() {

		return parent::pegarId('post', 'post_id', $this->getId());
	}

	public function cadastrar() {
		$pdo = Conexao::getInstance();

		try {

			if(parent::existeCadastro('post','post_titulo', $this->getTitulo())) {
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