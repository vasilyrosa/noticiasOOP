 <?php
 header ('Content-type: text/html; charset=UTF-8');

/* Tratando dados vindo do alterar_categoria.php */

if(isset($_GET['id'])) {

	$id = (int)$_GET['id'];

	$categoria = new Categoria;
	$categoria->setCategoria($id);
	$dados = $categoria->cat_Id();

} else {
	echo "<p class='alert alert-danger'>Você deve escolher uma Categoria para editar !</p>";
	die();
}

/* Tratando dados vindo do formulário da própria página */

if(isset($_POST['alterar'])) {

	$id = (int)$_POST['id'];
	$categoriaEscolhida = trim($_POST['categoria']);
	$posicaoEscolhida = $_POST['posicao'];

	$c = new Categoria;
	$c->obrigatorio('categoria', $categoriaEscolhida);
	$erro = $c->getErro();

	if(!isset($erro)){
		$c->setCategoria($categoriaEscolhida);
		$c->setPosicao($posicaoEscolhida);
		$c->setId($id);
		$c->alterar();
		header('Refresh: 3 ;url=?p=alterar_categoria');
	} else {
		echo $erro;
	}
}

 ?>

 <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .row{
    margin-top:40px;
    padding: 0 10px;
}

.clickable{
    cursor: pointer;
}

label{display: block}
.panel-body{height: 330px; width: 800px;}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

  </style>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
 <body>
<div class="container">
    <div class="row">
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">ALTERAR CATEGORIA</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

<div class="form">

		<form action=""method="post" class="form-inline" enctype="multipart/form-data">

			<label for="categoria">Categoria:</label>
			<input type="text" name="categoria"  class="form-control" style="width: 200px" value="<?php  echo $dados->categoria_nome; ?>">

			<input type="hidden" name="id" value="<?php  echo $id; ?>" />
			<label for="posicao_destaque" >Posição Destaque</label>
			<select name="posicao" class="form-control">
				<?php
					$posicao = new Posicao;
					$dadosPosi = $posicao->listarPosicao();

					foreach ($dadosPosi as $key => $value) { ?>
				<option value="<?php echo $value->posicao_id; ?>"
				 <?php echo $value->posicao_id == $dados->categoria_posicao_destaque ? "selected ='selected'" : '' ?> ><?php echo $value->posicao_nome; ?></option>

				<?php } ?>
			</select>
			<br />
			<br>
			<label for="alterar"></label>
			<input type="submit" name="alterar" value="Alterar" class="btn btn-warning">

		</form>
</div>
				</div>
			</div>
		</div>
	</div>

</div><script type="text/javascript">
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})</script>