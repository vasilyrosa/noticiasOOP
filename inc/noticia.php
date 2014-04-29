
<?php

if(isset($_GET['id'])){
	$id = (int)$_GET['id'];
	$post = new Post;
	$post->setId($id);
	$dadosPost = $post->listarPost();

	if(empty($dadosPost)){
		echo '<p class="alert alert-warning">Você tentou acessar uma página sem notícias</p>';
		die();
	}else{ ?>



<div class="col-md-8">
	<?php

		foreach ($dadosPost as $key => $pos) { ?>
	<div class="panel panel-default">
		<div class="panel-heading"><h3><?php  echo $pos->post_titulo ?></h3></div>
		<p>
			<div id="picture">
				<img src="<?php echo $pos->post_foto ?>" alt="">
			</div>
			<div class="panel-body">
			<?php echo $pos->post_conteudo; ?><br />
			<span class="Autor">Autor: <?php echo $pos->adm_nome; ?> /
                Data: <?php echo date("d/m/Y", strtotime($pos->post_data)); ?></span>
             </div>
		</p>
	</div>
	<?php	}
	}



}
?>
</div>
