<?php
session_start();
require_once "autoload.php";

if(isset($_POST['ok'])){
	$logar = new Logar;
	$logar->setLogin($_POST['login']);
  $logar->setSenha($_POST['senha']);
	$logar->login();

	if($logar->login()){
		header("Location: painel/");
	} else {

	 	$erro = $logar->getErro();
	}
}


?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Bootply.com - Bootstrap Bootstrap Login Form</title>
        <title>http://bootstrapzero.com/bootstrap-template/sign-in</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet" type="text/css">


        <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">



        <!-- CSS code from Bootply.com editor -->

        <style type="text/css">
            .modal-footer {   border-top: 0px; }
        </style>
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body>

        <!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h1 class="text-center">Login</h1>
      </div>
       <div>
		<?php   echo isset($erro) ? $erro : ""; ?>
	  </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" action="" method="post">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Login" name="login">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Senha" name="senha">
            </div>
            <div class="form-group">
              <input  type="submit" class="btn btn-primary btn-lg btn-block" name="ok" value="Logar"/>
              <span class="pull-right"><a href="#">Registrar</a></span><span><a href="#">ajuda?</a></span>
            </div>
          </form>

      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>
      </div>

  </div>
  </div>
</div>

    </body>
</html>