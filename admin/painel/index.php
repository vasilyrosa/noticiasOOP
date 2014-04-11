<?php
session_start();
require_once "../autoload.php";

Logar::verificaLogin();


/* DESLOGAR DO SISTEMA */
if(isset( $_GET['ac']) ) {
  if($_GET['ac'] == 'logout') {
    if(isset($_SESSION['logado'])){
      //unset($_SESSION['logado']);
      session_destroy();
      header("Location: ../index.php");
    }
  }
}/* GET[AC] */


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Portal de Noticias</title>

        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
       <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">



        <!-- CSS code from Bootply.com editor -->

        <style type="text/css">
            .navbar-static-top {
  margin-bottom:20px;
}

i {
  font-size:18px;
}

html, body, .container, .content {
    height: 100%;
}

#container {margin}

footer {
  margin-top:20px;
  padding-top:20px;
  padding-bottom:20px;
  background-color:#efefef;
}

.nav>li .count {
  position: absolute;
  bottom: 12px;
  right: 8px;
  font-size: 10px;
  font-weight: normal;
  background: rgba(51,200,51,0.55);
  color: rgba(255,255,255,0.9);
  line-height: 1em;
  padding: 2px 4px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  -ms-border-radius: 10px;
  -o-border-radius: 10px;
  border-radius: 10px;
}
footer{
position: relative;
  float: left;
  clear: both;
  bottom:0;
  width:100%;
}
        </style>
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body  >

        <!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand glyphicon glyphicon-home " href="#">  Painel </a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#">
            <i class="glyphicon glyphicon-user "></i><?php  echo '  Olá '. $_SESSION['nome_adm'];  ?></a>
            <li><a href="?ac=logout"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>

        </li>
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">

  <!-- upper section -->
  <div class="row">
	<div class="col-md-3">
      <!-- left -->
      <a href="#"><strong><i class="glyphicon glyphicon-briefcase"></i> Toolbox</strong></a>
      <hr>

      <ul class="nav nav-pills nav-stacked">
        <li><a href="?p=cadastrar_categoria"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar Categoria</a></li>
        <li><a href="?p=cadastrar_post"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar Post</a></li>
        <li><a href="?p=cadastrar_publicidade"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar Publicidade </a></li>
        <li><a href="?p=cadastrar_administrador"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar Administrador</a></li>
        <hr>
        <li><a href="?p=alterar_categoria"><i class="glyphicon glyphicon-pencil"></i> Alterar Categoria</a></li>
        <li><a href="?p=alterar_post"><i class="glyphicon glyphicon-pencil"></i> Alterar Post</a></li>
        <li><a href="?p=alterar_publicidade"><i class="glyphicon glyphicon-pencil"></i> Alterar Publicidade </a></li>
        <li><a href="?p=alterar_administrador"><i class="glyphicon glyphicon-pencil"></i> Alterar Administrador</a></li>
        <hr>
        <li><a href="?p=deletar_categoria"><i class="glyphicon glyphicon-remove"></i> Deletar Categoria</a></li>
        <li><a href="?p=deletar_post"><i class="glyphicon glyphicon-remove"></i> Deletar Post</a></li>
        <li><a href="?p=deletar_publicidade"><i class="glyphicon glyphicon-remove"></i> Deletar Publicidade </a></li>
        <li><a href="?p=deletar_administrador"><i class="glyphicon glyphicon-remove"></i> Deletar Administrador</a></li>
      </ul>

      <hr>

  	</div><!-- /span-3 -->
    <div class="col-md-9">

      <!-- column 2 -->


       <a href="#"><strong><h2>Painel Administrativo</h2></strong></a>

       <hr>

	   <div class="row">
            <!-- center left-->
         	<div class="col-md-12">
			  <!--<div class="well">Inbox Messages <span class="badge pull-right">3</span></div>

              <hr>-->

              <div class="panel panel-default">
                  <div class="panel-heading"><h4>Processing Status</h4></div>
                    <div id="conteudo">
                      <?php

                      if(isset($_GET['p'])) {
                          Url::mudaUrl($_GET['p']);
                      }

                      ?>
                    </div>



              </div><!--/panel-->

          	</div><!--/col-->

            <!--center-right-->


       </div><!--/row-->
  	</div><!--/col-span-9-->

  </div><!--/row-->
  <!-- /upper section -->

  <!-- lower section -->



</div><!--/container-->

<footer class="text-center">Area Administrativa - <a href="#"><strong> Noticias.com </strong></a></footer>

    </body>
</html>