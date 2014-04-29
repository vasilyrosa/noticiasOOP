<?php

class Conexao {

	const USER = "root";
	const PASS = "";
	const HOST = "localhost";
	const DB = "noticia";
	private static $instance = null;

	 public static function getInstance(){

		try {
			if(self::$instance == null){
			$dns = "mysql:host=".self::HOST.";dbname=".self::DB;
			 self::$instance = new PDO($dns, self::USER, self::PASS,array(
			   	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
			   	));
			 self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		} catch (PDOException $e) {
			echo 'Erro :'.$e->getMessage();
		}
		return self::$instance;
	}
}

//Conexao::getInstance();



