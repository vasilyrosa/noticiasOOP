 <?php
 header ('Content-type: text/html; charset=UTF-8');
include_once '../classes/lib/Pager.php';
include_once '../classes/lib/Sliding.php';

if(isset($_POST['alterar_publicidade'])) {
	$p = new Publicidade;
	$p->obrigatorio('titulo', $_POST['titulo']);
	$erro = $p->getErro();

	if(!isset($erro)) {
		if(empty($_FILES['publicidade']['name'])) {
			$p->setId($_POST['id']);
			$dadosBanco = $p->pub_Id();
			$picture = $dadosBanco->publicidade_caminho;
		} else {

			/* Deletar foto do banco */
			$p->setId($_POST['id']);
			$dadosBanco = $p->pub_Id();
				unlink('../../'.$dadosBanco->publicidade_caminho);
				$foto = $_FILES['publicidade']['name'];
				$temp = $_FILES['publicidade']['tmp_name'];

				 /* explodir para pegar a extensao da foto */
				 @$explode = end(explode('.', $foto));
				 $novaFoto = uniqid().'.'.$explode;


				$resize =  WideImage::load($temp);
				$redimensionar = $resize->resize('531','72','fill');
				$redimensionar->saveToFile('../../publicidade/'.$novaFoto);
				$picture = 'publicidade/'.$novaFoto;
           }
           			/* GRavar dados no banco */

			    	$p->setTitulo(trim($_POST['titulo']));
			    	$p->setStatus(trim($_POST['status']));
			    	$p->setCaminho($picture);
			    	$p->alterar();
	} else {
		echo $erro;
	}
}//end
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
.panel-body{height: 350px; width: 800px;}

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
					<h3 class="panel-title">ALTERAR PUBLICIDADE</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

<div class="form">

		<form action=""method="post" class="form-inline" enctype="multipart/form-data">

			<table class="table table-bordered" border="1" style="width: 600px">

					<tr>
						<th>Titulo</th>
						<th>Publicidade</th>
						<th>Status</th>
						<th>Alterar</th>
					</tr>


				<?php
				$publicidade = new Publicidade;
				$dados = $publicidade->listar();

				$params = array(
				    'mode'       => 'sliding',
				    'perPage'    => 4,
				    'delta'      => 4,
				    'itemData'   => $dados
				);

				@$pager = & Pager::factory($params);
				$data  = $pager->getPageData();


				foreach ($data as  $value) {
					?>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $value->publicidade_id ?>">
					<tr>
						<td><input type="text" name="titulo" class="form-control"
							value="<?php  echo $value->publicidade_titulo; ?>"/></td>
							<td><input type="file" name="publicidade"/></td>
						<td>
							<select name="status" id="" class="form-control">
								<option value="ativo" <?php echo $value->publicidade_status == 'ativo' ? "selected='selected'": '' ?>>Ativo</option>
								<option value="inativo" <?php echo $value->publicidade_status == 'inativo' ? "selected='selected'": '' ?>>Inativo</option>
							</select>
						</td>

						<td style="text-align: center">
							<input type="submit" name="alterar_publicidade" value="Alterar" class="btn btn-warning" />

						</td>
					</tr>
				</form>
				<?php } ?>
					<tr>
						<td colspan="5" align="center" >

							<?php  $links = $pager->getLinks();
									echo $links['all'];
							 ?>
						</td>
					</tr>
			</table>

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