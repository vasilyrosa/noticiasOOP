<?php

class Posicao extends Abstrata {

public function listarPosicao() {
		parent::$tabela = "posicao_destaque";
		 return parent::listar();
	}

}