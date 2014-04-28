<?php
 header ('Content-type: text/html; charset=UTF-8');
include_once '../classes/lib/Pager.php';
include_once '../classes/lib/Sliding.php';

if(isset($_GET['ac'])){
	if($_GET['ac'] == 'deletar'){
		$publicidade = new Publicidade;
		$publicidade->setId((int)$_GET['id']);
		$dados_pub = $publicidade->pub_Id();

		if(unlink('../../'. $dados_pub->publicidade_caminho)) {
			if($publicidade->deletar()){
				echo '<p class="alert alert-success"><strong>Publicidade</strong> foi removido com sucesso !</p>';
		} else {
				echo '<p class="alert alert-danger"><strong>Publicidade</strong> não pode ser removido !</p>';
			}
	    } else {
	    	echo '<p class="alert alert-danger">Erro ao deletar arquivos em pasta!</p>';
			die();
	    }
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
					<h3 class="panel-title">DELETAR POST</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">

<div class="form">



			<table class="table table-bordered" border="1" style="width: 700px">

					<tr>
						<th>Titulo</th>
						<th>Status</th>
						<th>Deletar</th>

					</tr>


				<?php
				$p = new Publicidade;
				$dados = $p->listar();
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
					<tr>
						<td><?php  echo $value->publicidade_titulo ?></td>
						<td><?php  echo $value->publicidade_status ?></td>
						<td style="width: 100px"><a href="?p=deletar_administrador&ac=deletar&id=<?php  echo $value->adm_id ?>"><button class="btn btn-danger">Deletar</button></a></td>
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