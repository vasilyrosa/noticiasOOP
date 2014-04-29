
<?php

if(isset($_GET['id'])){
	$id = (int)$_GET['id'];
	$categoria = new Categoria;
	$categoria->setId($id);
	$dadosCategoria = $categoria->listarCategoriaEscolhida();

	if(empty($dadosCategoria)){ ?>
	<div class="col-md-8">
		<div class="panel panel-default">
			<?php
		echo '<p class="alert alert-warning">Nehuma notícia cadastrada para essa categoria</p>';
			?>
			</div>
		</div>
<?php
	}else{ ?>



<div class="col-md-8">

		<?php
		foreach ($dadosCategoria as $key => $cat) { ?>
	<div class="panel panel-default">
		<div class="well"><h3><?php  echo $cat->categoria_nome?>/</h3></div>
		<h4 style="margin: 5px"><a href="?p=noticia&id=<?php  echo $cat->post_id ?>"><?php  echo $cat->post_titulo ?></a></h4>
		<p>
				<div class="panel-body">
				<?php echo limitarCaracteres($cat->post_conteudo, 300); ?><br />
				<span class="Autor">Autor: <?php echo $cat->adm_nome; ?> /
	                Data: <?php echo date("d/m/Y", strtotime($cat->post_data)); ?></span>
	            </div>
			</p>
	</div>
	<?php	}
	}



}
?>
</div>
