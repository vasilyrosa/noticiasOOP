<?php
include_once "autoload.php";
include_once "functions/functions.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//PT">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Portal de Noticias</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
        <div id="container">

            <div id="header">
                <div id="logo">
                    Portal NetNotícias<br />
                    <span id="sub">seu portal de noticias online</span>
                </div><!--HEADER-->
                <div id="publicidade">
                    <span id="titulo_publicidade">Publicidade</span>
                    <?php  $publicidade = new Publicidade;
                           $pub = $publicidade->listarPublicidade();
                           //tentando não usar um foreach
                    ?>
                    <img src="<?php echo $pub[0]->publicidade_caminho ?>" alt="">
                </div><!--PUBLICIDADE-->

            </div><!--HEADER-->


            <div class="fix"></div>

            <div id="nav">
                <ul>
                    <li><a href="http://localhost/backEnd/phpOOP/projeto-final/" class="first">INICIAL/</a></li>
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
            </div><!--NAV-->


            <div id="conteudo_pricipal">
                <div id="ultimas">
                    <h1>Últimas Noticías</h1>

                        <?php
                        $noticias = new Post;
                        $ultimas = $noticias->listarUltimas();
                        foreach ($ultimas as $key => $ulti) : ?>
                        <div id="noticias">
                            <h2><a href="?p=noticia&id=<?php  echo $ulti->post_id ?>"><?php echo $ulti->post_titulo; ?><a/></h2>
                            <p class="paragrafo_ultimas">
                                <?php echo limitarCaracteres($ulti->post_conteudo, 250); ?><br />
                                 <span class="Autor">Autor: <?php echo $ulti->adm_nome; ?> /
                                Data: <?php echo date("d/m/Y", strtotime($ulti->post_data)); ?></span>
                          </p>
                        </div><!-- noticias-->
                    <?php endforeach;    ?>

                </div><!-- ultimas-->
                <div id="destaques">

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

            </div><!--CONTEUDO PRINCIPAL-->

        </div><!--CONTAINER-->
    </div><!--CONTAINER-->
     <div id="footer">Portal de NetNotícias <?php echo date("Y"); ?> - Todos direitos reservados</div><!--RODAPE-->

</body>
</html>