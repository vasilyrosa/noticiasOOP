<?php


	function limitarCaracteres( $texto, $caracteres){

	    $limite = substr(strip_tags($texto), 0, $caracteres);
	    $corta_texto = strrpos($limite, " ");
		 return substr($limite, 0, $corta_texto).' ...';
	}