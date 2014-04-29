<?php

class Publicidade extends Abstrata {


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

public function listarPublicidade() {
		parent::$tabela = "publicidade";
		parent::$existeParametros = true;
		$this->setParametros(" WHERE publicidade_status = 'ativo' ORDER BY RAND() LIMIT 1");
		 return parent::listar();
	}

	public function pub_Id() {

		return parent::pegarId('publicidade', 'publicidade_id', $this->getId());
	}

}