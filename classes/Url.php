<?php

class Url {


	public static function mudaUrl($url){
		if(isset($url)) {
			if(is_file("inc/".$url.'.php')) {
				include_once "inc/".$url.'.php';
			} else {
				 include_once "inc/404.php";
			}
		}
	}
}