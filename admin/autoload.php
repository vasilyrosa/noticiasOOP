<?php

define(ROOT, $_SERVER[DOCUMENT_ROOT].'/backEnd/phpOOP/projeto-final/');
set_include_path(
	 "classes/".PATH_SEPARATOR
	."../classes/".PATH_SEPARATOR
	."interfaces/".PATH_SEPARATOR
	."../interfaces/"
	);


function autoloader( $classes ) {

	require $classes.'.php';
}

spl_autoload_register(autoloader);