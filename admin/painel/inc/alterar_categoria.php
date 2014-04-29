 <?php
 header ('Content-type: text/html; charset=UTF-8');
include_once '../classes/lib/Pager.php';
include_once '../classes/lib/Sliding.php';
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

			<table class="table table-bordered" border="1" style="width: 600px">

					<tr>
						<th>Categoria</th>
						<th>Posição no site</th>
						<th>Alterar</th>
					</tr>


				<?php
				$categoria = new Categoria;
				$dados = $categoria->listarCategoria();

				$params = array(
				    'mode'       => 'sliding',
				    'perPage'    => 5,
				    'delta'      => 4,
				    'itemData'   => $dados
				);

				@$pager = & Pager::factory($params);
				$data  = $pager->getPageData();


				foreach ($data as  $value) {
					?>
					<tr>
						<td><?php  echo $value->categoria_nome; ?></td>
						<td><?php  echo $value->categoria_posicao_destaque == 0?"Nehuma posição no site" :
						 $value->posicao_nome; ?></td>
						<td style="text-align: center">
							<a href="?p=update/update_categoria&id=<?php echo $value->categoria_id ?>" class="glyphicon glyphicon-pencil"></a>
						</td>
					</tr>

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