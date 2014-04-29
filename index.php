<?php
include_once "autoload.php";
include_once "functions/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Portal de Notícias</title>
        <meta name="generator" content="Bootply" />
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">


        <!-- CSS code from Bootply.com editor -->

        <style type="text/css">
            header {
	margin-bottom:30px;
}
ul{margin-bottom: 30px}
 a:hover{text-decoration: none;}
 p{color: black}
 h3 h2{color: black}
 #foto_destaque ,#picture{float: left; margin-right: 20px;}
 #texto_destaque{margin: 10px; padding: 8px;}
 #principal{margin-bottom: 60px;}
  #texto_destaque span ,.Auto{color: orange;}
  .publicidade img{padding-left:50px}
  .publicidade img ,p{text-align: center}

        </style>
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body  >


<header class="navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">

      <a href="http://localhost/backEnd/phpOOP/projeto-final/admin" class="navbar-brand">Administrator</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
         <ul class="nav navbar-nav">

      </ul>
      <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>

    </nav>
  </div>
</header>

<!-- Begin Body -->
<div class="container">
	<div class="row">
  			<div class="col-md-3" id="leftCol">

				<div class="nav nav-pills nav-stacked">

               <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="http://localhost/backEnd/phpOOP/projeto-final/" class="first">INICIAL</a></li>
                    <?php
                    $categorias = new Categoria;
                    $categoriasCadastradas = $categorias->listar();
                    foreach ($categoriasCadastradas as $key => $categoria): ?>
                         <li>
                            <a href="?p=categoria&id=<?php echo $categoria->categoria_id  ?>">
                                <?php  echo strtoupper($categoria->categoria_nome) ?>
                            </a>
                        </li>

                    <?php  endforeach; ?>
                </ul>
  				</div>
          <div class="well">
                    <h3>Últimas Noticías</h3>
                        <?php
                        $noticias = new Post;
                        $ultimas = $noticias->listarUltimas();
                        foreach ($ultimas as $key => $ulti) : ?>
                        <div>
                            <h4><a href="?p=noticia&id=<?php  echo $ulti->post_id ?>"><?php echo $ulti->post_titulo; ?><a/></h4>
                            <p>
                                <?php echo limitarCaracteres($ulti->post_conteudo, 200); ?><br />
                                 <i>Autor: <?php echo $ulti->adm_nome; ?> /
                                Data: <?php echo date("d/m/Y", strtotime($ulti->post_data)); ?></i>
                          </p>
                        </div>
                    <?php endforeach;    ?>

                </div><!-- ultimas-->

      		</div>
             <?php
                try {
                    if (isset($_GET['p'])):
                        $url = new Url();
                        $url->mudaUrl($_GET['p']);
                    else:
                       include_once "inc/home.php";
                    endif;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                ?>
  	</div>
</div>



        <!-- JavaScript jQuery code from Bootply.com editor -->

        <script type='text/javascript'>

        $(document).ready(function() {




        });

        </script>

    </body>
</html>